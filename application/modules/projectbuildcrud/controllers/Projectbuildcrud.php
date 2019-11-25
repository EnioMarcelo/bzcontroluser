<?php

/*
  Created on : 20/06/2018, 10:16:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */

defined('BASEPATH') or exit('No direct script access allowed');

class ProjectbuildCrud extends MY_Controller {
    /*
     * VARIÁVEIS DO APP BLANK
     */

// CONTROLLER
    protected $_blankCode = '';

    /*
     * VARIÁVEIS DO APP
     */
    protected $_security = '';
    protected $_templatePadrao = 'TRUE';
    protected $_project_id = '';
    protected $_app_nome = '';
    protected $_directory = '';
    protected $_dadosController = '';
    protected $_dadosControllerCalendar = '';
    protected $_dadosModel = '';
    protected $_dadosView = '';
    protected $_dadosViewCalendar = '';
    protected $_dadosFormAdd = '';
    protected $_dadosAdd = 'Add';
    protected $_dadosEdit = 'Edit';
    protected $_appTitulo = '';
    protected $_appIcone = '';
    protected $_appTableName = '';
    protected $_appArrayDados = '';
    protected $_primary_key_field = '';
    protected $_appCalendarInputs = [];
// CONTROLLER
    protected $_controller_metodos_php = '';
    protected $_controller_onScriptinit = '';
    protected $_controller_onBeforeInsert = '';
    protected $_controller_onAfterInsert = '';
    protected $_controller_onBeforeUpdate = '';
    protected $_controller_onAfterUpdate = '';
    protected $_controller_onBeforeDelete = '';
    protected $_controller_onAfterDelete = '';
    protected $_controller_onScriptInitExport = '';
    protected $_controller_onScriptBeforeExport = '';
    protected $_controller_onScriptAfterExport = '';
    protected $_controller_onScriptEndExport = '';
    protected $_controller_DeleteFileFunction = '';
//MODELS
    protected $_models_metodos_php = '';
// EXPORT
    protected $_exportCodeEditorOnRecord = '';
    protected $_gridListHeaderTableExport = '';
    protected $_gridListFieldsTableExport = '';
// GRID LIST
    protected $_gridListCodeEditorCSS = '';
    protected $_gridListCodeEditorJS = '';
    protected $_gridListCodeEditorOnRecord = '';
    protected $_gridListFieldsOrderBy = '';
    protected $_gridListSearchFields = '';
    protected $_gridListFields = '';
    protected $_gridListDivButtons = '';
    protected $_gridListSearchInput = '';
    protected $_gridListSearchButton = '';
    protected $_gridListClearhButton = '';
    protected $_gridListHeaderTable = '';
    protected $_gridListFieldsTable = '';
    protected $_gridListStatusDados = 'N';
    protected $_gridListVirtualFieldsTable = [];
// FORM ADD/EDIT
    protected $_formAddCodeEditorCSS = '';
    protected $_formAddCodeEditorJS = '';
    protected $_formAddEditFields = '';
    protected $_formAddEditConfigInput = '';
    protected $_formAddEditConfigInputClassCSS = '';
    protected $_formAddEditConfigInputAtributos = '';
    protected $_formAddEditConfigInputValidation = '';
    protected $_formAddEditConfigInputMask = '';
    protected $_formAddEditConfigInputValidationAtributos = '';
    protected $_formAddEditConfigInputValidationCallback = '';
    protected $_formAddEditConfigFormOpen = 'form_open';
// FORM ADD
    protected $_formAddConvertDadosToDatabase = '';
    protected $_formAddFields = '';
    protected $_form_add_unset_fields = '';
    protected $_formAddConfigInputValidation = '';
    protected $_formAddConfigInputValidationAtributos = '';
    protected $_formAddDadosFillable = '$_dadosFillable = $_dados;' . '$_dados = [];' . PHP_EOL;
// FORM EDIT
    protected $_formEditFields = '';
    protected $_form_edit_unset_fields = '';
    protected $_formEditConfigInputValidation = '';
    protected $_formEditConfigInputValidationAtributos = '';
    protected $_formEditDadosFillable = '$_dadosFillable = $_dados;' . '$_dados = [];' . PHP_EOL;
    protected $_formEditConvertDadosToDatabase = '';
    protected $_formEditUnsetPrimaryKey = '';
    protected $_formEditWhereUpdateFields = '';
    protected $_formEditCodeEditorCSS = '';
    protected $_formEditCodeEditorJS = '';

    public function __construct() {
        parent::__construct();

        /*
         * TÍTULO DA APLICAÇÃO
         */
        $this->dados['_titulo_app'] = 'Projeto';
        $this->dados['_font_icon'] = 'fa fa-codepen';

        /*
         * VIEW DA APLICAÇÃO
         */
        $this->dados['_view_app_list'] = 'vProjectbuildCrud';
        $this->dados['_view_app_add'] = 'vProjectbuildCrudFormAdd';
        $this->dados['_view_app_edit'] = 'vProjectbuildCrudFormEdit';

        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'proj_build';
    }

    /* END function __construct() */

    public function index() {
        $this->session->set_flashdata('btn_voltar_link', site_url($this->router->fetch_class()) . '?' . bz_app_parametros_url());
        /*
         * CARREGA OS REGISTROS COM PAGINAÇÃO
         */
        $this->dados['_result'] = $this->get_paginacao();

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = $this->router->fetch_class() . '/' . $this->dados['_view_app_list'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /* END function index() */

    /*
     * FUNÇÃO EDIT FIELDS GRID LIST
     */

    public function setup_gridlist() {

        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        if ($this->input->post()):

            $_dados = $_POST;
            $_screen_type = $this->input->post('screen_type');

            unset($_dados['task']);
            unset($_dados['projeto_id']);
            unset($_dados['field_name']);
            unset($_dados['screen_type']);

            if ($this->input->post('task') == 'save'):

                $_dados['grid_list_field_value_select'] = base64_encode($_dados['grid_list_field_value_select']);

                $_where = 'WHERE proj_build_id = ' . $this->input->post('projeto_id') . ' AND field_name = "' . $this->input->post('field_name') . '" AND screen_type = "' . $_screen_type . '"';
                if ($this->update->exec('proj_build_fields', array('param_gridlist' => json_encode($_dados, JSON_UNESCAPED_UNICODE)), $_where)):

                    $_r = array('csrf_token' => $this->security->get_csrf_hash(), 'return' => 'SAVE-SETUP-GRIDLIST-OK');
                    echo json_encode($_r);
                    exit;

                endif;

            elseif ($this->input->post('task') == 'get-dados'):

                $_projeto_id = $this->input->post('projeto_id');
                $_field_name = $this->input->post('field_name');

                $_setupGridList = $this->read->exec('proj_build_fields', 'WHERE proj_build_id = ' . $_projeto_id . ' AND field_name = "' . $_field_name . '" AND screen_type = "' . $_screen_type . '"')->row()->param_gridlist;

                $_r = json_decode($_setupGridList);

                if (isset($_r->grid_list_field_value_select)):
                    $_r->grid_list_field_value_select = base64_decode($_r->grid_list_field_value_select);
                endif;

                $_r->csrf_token = $this->security->get_csrf_hash();

                echo json_encode($_r);
                exit;

            endif;

        endif; //END $_POST
    }

    /* END function gridlist_save() */

    /*
     * FUNÇÃO EDIT FIELDS FORM ADD/EDIT
     */

    public function setup_formaddedit() {

        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        if ($this->input->post()):

            $_dados = $_POST;
            $_screen_type = $this->input->post('screen_type');

            unset($_dados['task']);
            unset($_dados['modal_projeto_id']);
            unset($_dados['field_name']);
            unset($_dados['screen_type']);
            unset($_dados['primary_key']);

            if ($this->input->post('task') == 'save'):

                $_dados['form_add_edit_field_value_select_dinamic'] = base64_encode($_dados['form_add_edit_field_value_select_dinamic']);
                $_dados['form_add_edit_field_value_radiobutton_dinamic'] = base64_encode($_dados['form_add_edit_field_value_radiobutton_dinamic']);
                $_dados['form_add_edit_field_value_select_multiple_dinamic'] = base64_encode($_dados['form_add_edit_field_value_select_multiple_dinamic']);
                $_dados['form_add_edit_field_value_checkbox_multiple_dinamic'] = base64_encode($_dados['form_add_edit_field_value_checkbox_multiple_dinamic']);
                $_dados['form_add_edit_field_mask_complement'] = base64_encode($_dados['form_add_edit_field_mask_complement']);

                /*
                 * REGRAS DE VALIDAÇÃO DO BOTÃO "OCULTO/HIDDEN" DO FORM ADD/EDIT DAS CONFIGURAÇÕES DOS INPUTS DO FORM.
                 */
                if (!empty($_dados['form_add_edit_field_hidden'])):
                    if ($_dados['form_add_edit_field_hidden'] == 'on'):

                        /* SE O BOTÃO OCULTO ESTIVER ON E A OPÇÃO ESTIVER EM TODOS, DESATIVA O BOTÃO SOMENTE LEITURA E O BOTÃO OBRIGATÓRIO. */
                        if ($_dados['form_add_edit_field_hidden_in_form'] == 'todos'):
                            $_dados['form_add_edit_field_read_only'] = '';
                            $_dados['form_add_edit_field_read_only_in_form'] = 'todos';
                            $_dados['form_add_edit_field_required'] = '';
                            $_dados['form_add_edit_field_required_in_form'] = 'todos';

                        elseif ($_dados['form_add_edit_field_hidden_in_form'] == 'formadd'):

                            /*
                             * E O BOTÃO OCULTO ESTIVER ON E A OPÇÃO ESTIVER EM SOMENT FORM ADD, DESATIVA O BOTÃO OBRIGATÓRIO E PERMITE SOMENTE A OPÇÃO
                             * FORM EDIT DO BOTÃO SOMENTE LEITURA.
                             */

                            if (!empty($_dados['form_add_edit_field_read_only'])):
                                if ($_dados['form_add_edit_field_read_only'] == 'on'):
                                    if ($_dados['form_add_edit_field_read_only_in_form'] !== 'formedit'):
                                        $_dados['form_add_edit_field_read_only'] = '';
                                        $_dados['form_add_edit_field_read_only_in_form'] = 'todos';
                                        $_dados['form_add_edit_field_required'] = '';
                                        $_dados['form_add_edit_field_required_in_form'] = 'todos';
                                    endif;
                                endif;
                            endif;

                        elseif ($_dados['form_add_edit_field_hidden_in_form'] == 'formedit'):

                            /*
                             * SE O BOTÃO OCULTO ESTIVER ON E A OPÇÃO ESTIVER EM SOMENT FORM EDIT, DESATIVA O BOTÃO OBRIGATÓRIO E PERMITE SOMENTE A OPÇÃO
                             * SOMETE FORM ADD DO BOTÃO SOMENTE LEITURA.
                             */
                            if (!empty($_dados['form_add_edit_field_read_only'])):
                                if ($_dados['form_add_edit_field_read_only'] == 'on'):
                                    if ($_dados['form_add_edit_field_read_only_in_form'] !== 'formadd'):
                                        $_dados['form_add_edit_field_read_only'] = '';
                                        $_dados['form_add_edit_field_read_only_in_form'] = 'todos';
                                        $_dados['form_add_edit_field_required'] = '';
                                        $_dados['form_add_edit_field_required_in_form'] = 'todos';
                                    endif;
                                endif;
                            endif;

                        endif;
                    endif;
                endif;
                /* END REGRAS DE VALIDAÇÃO DO BOTÃO "OCULTO/HIDDEN" DO FORM ADD/EDIT DAS CONFIGURAÇÕES DOS INPUTS DO FORM */

                /*
                 * REGRAS DE VALIDAÇÃO DO BOTÃO "SOMENTE LEITURA/READ ONLY" DO FORM ADD/EDIT DAS CONFIGURAÇÕES DOS INPUTS DO FORM
                 */
                if (!empty($_dados['form_add_edit_field_read_only'])):
                    if ($_dados['form_add_edit_field_read_only'] == 'on'):

                        /* SE O BOTÃO SOMENTE ESTIVER ON E A OPÇÃO ESTIVER EM TODOS, DESATIVA O BOTÃO OBRIGATÓRIO. */
                        if ($_dados['form_add_edit_field_read_only_in_form'] == 'todos'):
                            $_dados['form_add_edit_field_required'] = '';
                            $_dados['form_add_edit_field_required_in_form'] = 'todos';

                        elseif ($_dados['form_add_edit_field_read_only_in_form'] == 'formadd'):

                            /*
                             * SE O BOTÃO SOMENTE LEITURA ESTIVER ON E A OPÇÃO ESTIVER EM SOMENT FORM ADD, PERMITE SOMENTE A OPÇÃO
                             * FORM EDIT DO BOTÃO OBRIGATORIO.
                             */
                            if (!empty($_dados['form_add_edit_field_required'])):
                                if ($_dados['form_add_edit_field_required'] == 'on'):
                                    if ($_dados['form_add_edit_field_required_in_form'] !== 'formedit'):
                                        $_dados['form_add_edit_field_required'] = '';
                                        $_dados['form_add_edit_field_required_in_form'] = 'todos';
                                    endif;
                                endif;
                            endif;

                        elseif ($_dados['form_add_edit_field_read_only_in_form'] == 'formedit'):

                            /*
                             * SE O BOTÃO SOMENTE LEITURA ESTIVER ON E A OPÇÃO ESTIVER EM SOMENT FORM EDIT, PERMITE SOMENTE A OPÇÃO
                             * FORM ADD DO BOTÃO OBRIGATORIO.
                             */
                            if (!empty($_dados['form_add_edit_field_required'])):
                                if ($_dados['form_add_edit_field_required'] == 'on'):
                                    if ($_dados['form_add_edit_field_required_in_form'] !== 'formadd'):
                                        $_dados['form_add_edit_field_required'] = '';
                                        $_dados['form_add_edit_field_required_in_form'] = 'todos';
                                    endif;
                                endif;
                            endif;

                        endif;

                    endif;
                endif;
                /* END REGRAS DE VALIDAÇÃO DO BOTÃO "SOMENTE LEITURA/READ ONLY" DO FORM ADD/EDIT DAS CONFIGURAÇÕES DOS INPUTS DO FORM */

                /*
                 * REGRAS DE VALIDAÇÃO DO BOTÃO "OBRIGATÓRIO/REQUIRED" DO FORM ADD/EDIT DAS CONFIGURAÇÕES DOS INPUTS DO FORM
                 */
                if (!empty($_dados['form_add_edit_field_hidden'])):
                    if ($_dados['form_add_edit_field_hidden'] == 'on'):

                        /*
                         * SE O BOTÃO OCULTO ESTIVER NA OPÇÃO SOMENTE FORM ADD E O BOTÃO OBRIGATÓRIO ESTIVER NA OPÇÃO SOMENTE FORM ADD,
                         * ENTÃO DELIGUE O BOTÃO OBRIGATÓRIO.
                         */
                        if ($_dados['form_add_edit_field_hidden_in_form'] == 'formadd'):
                            if (!empty($_dados['form_add_edit_field_required'])):
                                if ($_dados['form_add_edit_field_required'] == 'on'):
                                    if ($_dados['form_add_edit_field_required_in_form'] == 'formadd'):
                                        $_dados['form_add_edit_field_required'] = '';
                                        $_dados['form_add_edit_field_required_in_form'] = 'todos';
                                    endif;
                                endif;
                            endif;

                        /*
                         * SE O BOTÃO OCULTO ESTIVER NA OPÇÃO SOMENTE FORM EDIT E O BOTÃO OBRIGATÓRIO ESTIVER NA OPÇÃO SOMENTE FORM EDIT,
                         * ENTÃO DELIGUE O BOTÃO OBRIGATÓRIO.
                         */
                        elseif ($_dados['form_add_edit_field_hidden_in_form'] == 'formedit'):
                            if (!empty($_dados['form_add_edit_field_required'])):
                                if ($_dados['form_add_edit_field_required'] == 'on'):
                                    if ($_dados['form_add_edit_field_required_in_form'] == 'formedit'):
                                        $_dados['form_add_edit_field_required'] = '';
                                        $_dados['form_add_edit_field_required_in_form'] = 'todos';
                                    endif;
                                endif;
                            endif;
                        endif;

                    endif;
                endif;

                /* END REGRAS DE VALIDAÇÃO DO BOTÃO "OBRIGATÓRIO/REQUIRED" DO FORM ADD/EDIT DAS CONFIGURAÇÕES DOS INPUTS DO FORM */

                /* if (empty($_dados['form_add_edit_field_hidden'])):
                  $_dados['form_add_edit_field_hidden_in_form'] = '';
                  endif;

                  if (empty($_dados['form_add_edit_field_read_only']) || !empty($_dados['form_add_edit_field_hidden'])):
                  $_dados['form_add_edit_field_read_only_in_form'] = '';
                  endif; */

                $_where = 'WHERE proj_build_id = ' . $this->input->post('modal_projeto_id') . ' AND field_name = "' . $this->input->post('field_name') . '" AND screen_type = "' . $_screen_type . '"';
                if ($this->update->exec('proj_build_fields', array('param_formaddedit' => json_encode($_dados, JSON_UNESCAPED_UNICODE)), $_where)):

                    $_r = array('csrf_token' => $this->security->get_csrf_hash(), 'return' => 'SAVE-SETUP-FORMADDEDIT-OK');
                    echo json_encode($_r);
                    exit;

                endif;

            elseif ($this->input->post('task') == 'get-dados'):

                $_projeto_id = $this->input->post('projeto_id');
                $_field_name = $this->input->post('field_name');

                $_setupFormAddEdit = $this->read->exec('proj_build_fields', 'WHERE proj_build_id = ' . $_projeto_id . ' AND field_name = "' . $_field_name . '" AND screen_type = "' . $_screen_type . '"')->row()->param_formaddedit;

                $_r = json_decode($_setupFormAddEdit);

                if (isset($_r->form_add_edit_field_value_select_dinamic)):
                    $_r->form_add_edit_field_value_select_dinamic = base64_decode($_r->form_add_edit_field_value_select_dinamic);
                endif;

                if (isset($_r->form_add_edit_field_value_radiobutton_dinamic)):
                    $_r->form_add_edit_field_value_radiobutton_dinamic = base64_decode($_r->form_add_edit_field_value_radiobutton_dinamic);
                endif;

                if (isset($_r->form_add_edit_field_value_select_multiple_dinamic)):
                    $_r->form_add_edit_field_value_select_multiple_dinamic = base64_decode($_r->form_add_edit_field_value_select_multiple_dinamic);
                endif;

                if (isset($_r->form_add_edit_field_value_checkbox_multiple_dinamic)):
                    $_r->form_add_edit_field_value_checkbox_multiple_dinamic = base64_decode($_r->form_add_edit_field_value_checkbox_multiple_dinamic);
                endif;

                if (isset($_r->form_add_edit_field_mask_complement)):
                    $_r->form_add_edit_field_mask_complement = base64_decode($_r->form_add_edit_field_mask_complement);
                endif;

                $_r->csrf_token = $this->security->get_csrf_hash();

                echo json_encode($_r);
                exit;

            endif;

        endif; //END $_POST
    }

    /* END function setup_formaddedit() */

    /**
     * FUNÇÃO CADASTRO DE CAMPO DA GRIDLIST
     */
    public function addFieldGridList() {

        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        $_response = [];
        $_response['csrf_token'] = $this->security->get_csrf_hash();

        if ($this->input->post()):

            $_post = $this->input->post();

            if ($_post['task'] == 'add-field-gridlist'):

                $this->form_validation->set_rules('proj_build_id', '<b>PROJETO ID</b>', 'trim|required');
                $this->form_validation->set_rules('field_name', '<b>NOME DO CAMPO</b>', 'trim|required');

                if ($this->form_validation->run() == true):

                    unset($_post['task']);

                    $_post['field_name'] = 'vrt_' . $_post['field_name'];
                    $_post['field_type'] = 'varchar';
                    $_post['field_length'] = '255';
                    $_post['param_gridlist'] = '{"grid_list_show":"on","grid_list_search":"off","grid_list_export":"off","grid_list_label":"' . $_post['field_name'] . '","grid_list_aligne_label":"text-left","grid_list_field_length":"10%","grid_list_field_aligne":"text-left","grid_list_field_type":"virtual"}';

                    $result = $this->create->exec('proj_build_fields', $_post);

                    if ($result):

                        $_response['title'] = 'OK !!!';
                        $_response['msg'] = 'Campo da Grid List Gravado com Sucesso.';
                        $_response['type'] = 'success';

                        set_mensagem_trigger_notifi($_response['msg'], $_response['type']);

                        echo json_encode($_response);

                    endif;

                    exit;

                else:

                    $_response['title'] = 'ATENÇÃO !!!';
                    $_response['msg'] = 'Favor informar o nome do campo da Grid List.';
                    $_response['type'] = 'warning';

                    echo json_encode($_response);
                    exit;

                endif;

            elseif ($_post['task'] == 'delete-field-gridlist'):

                $termosDB = "WHERE proj_build_id = '{$_post['proj_build_id']}' AND field_name = '{$_post['field_name']}'";
                $_d = $this->delete->exec('proj_build_fields', $termosDB);

                if ($_d):
                    $_response['title'] = 'OK !!!';
                    $_response['msg'] = 'Campo da Grid List Deletado com Sucesso.';
                    $_response['type'] = 'success';

                    set_mensagem_trigger_notifi($_response['msg'], $_response['type']);
                else:
                    $_response['title'] = 'ERRO !!!';
                    $_response['msg'] = ___MSG_GENERIC_UNEXPECTED_ERROR___;
                    $_response['type'] = 'error';

                    set_mensagem_trigger_notifi($_response['msg'], $_response['type']);
                endif;

                echo json_encode($_response);
                exit;

            endif;

        endif;
    }

    /* END FUNÇÃO CADASTRO DE CAMPO DA GRIDLIST */

    /*
     * FUNÇÃO CADASTRO
     */

    public function add() {

        /*
         * ADD OS DADOS DO APLICATIVO
         */
        if ($this->input->post()):

            if ($this->input->post('type_project') == 'crud') {
                $this->form_validation->set_rules('tabela', '<b>TABELA</b>', 'trim|required|max_length[250]');
                $this->form_validation->set_rules('primary_key', '<b>CHAVE PRIMÁRIA</b>', 'trim|required|max_length[50]');
            }

            $this->form_validation->set_rules('app_nome', '<b>NOME DO APLICATIVO</b>', 'trim|required|max_length[250]|callback_check_name_app_exist');
            $this->form_validation->set_rules('app_titulo', '<b>TÍTULO DO APLICATIVO</b>', 'trim|required|max_length[250]');

            if ($this->form_validation->run() == true):

                $_dados = $this->input->post();

                $_dados['app_nome'] = $this->_app_nome;

                $this->_primary_key_field = (!empty($_dados['primary_key']) ? $_dados['primary_key'] : "");

                unset($_dados['btn-salvar']);
                unset($_dados['task']);
                unset($_dados['apps']);
                unset($_dados['primary_key']);

                /**
                 * Grava registro
                 */
                $result = $this->create->exec($this->table_name, $_dados);

                if ($result):

                    if ($_dados['type_project'] == 'crud') {

                        /*
                         * GRAVA CAMPOS DA TABELA DA GRIDLIST
                         */
                        $this->save_fields_project($_dados['tabela'], $result['last_id_add'], 'gridlist');

                        /*
                         * GRAVA CAMPOS DA TABELA DO FORM ADD/EDIT
                         */
                        $this->save_fields_project(str_replace('vw_', '', $_dados['tabela']), $result['last_id_add'], 'formaddedit');

                        /**/
                    } elseif ($_dados['type_project'] == 'blank') {

                        /**
                         * GRAVA O CODE EDITOR NA TABELA proj_build_codeeditor DO APP BLANK
                         */
                        $_dadosCodeEditor = array(
                            'proj_build_id' => $result['last_id_add'],
                            'code_type' => 'blank',
                            'code_screen' => 'blank',
                        );
                        $this->create->exec('proj_build_codeeditor', $_dadosCodeEditor);

                        /**/
                    }

                    /* GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'add';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_ADD_SUCCESS___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    $dados_auditoria['last_query'] = str_replace($this->table_name . ' (', $this->table_name . ' (id, ', $dados_auditoria['last_query']);
                    $dados_auditoria['last_query'] = str_replace('VALUES (', 'VALUES ("' . $result['last_id_add'] . '", ', $dados_auditoria['last_query']);

                    add_auditoria($dados_auditoria);
                    set_mensagem_trigger_notifi(___MSG_ADD_REGISTRO___, 'success');

                    /**
                     * GRAVA O APP NA TABELA sec_aplicativos
                     */
                    $_dados_sec_aplicativos['app_name'] = $_dados['app_nome'];
                    $_dados_sec_aplicativos['app_descricao'] = $_dados['app_titulo'];
                    $result_create_sec_aplicativos = $this->create->exec('sec_aplicativos', $_dados_sec_aplicativos);

                    if ($result_create_sec_aplicativos):

                        /* GRAVA AUDITORIA */
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'add';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_ADD_SUCCESS___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

                    else:
                        echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_name);
                        exit;
                    endif;

                else:
                    echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_name);
                    exit;
                endif;

                redirect($this->_redirect . '/edit/' . $result['last_id_add']);

            endif;

        endif;

        $this->dados['_tabelas'] = get_tables_system();

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_add'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /* END public function add() */

    /*
     * FUNÇÃO EDIÇÃO
     */

    public function edit($_id) {

        /* GRAVA OS DADOS DA EDIÇÃO DO REGISTRO */
        if ($this->input->post()):

            if ($this->input->post('btn-editar') == 'btn-editar'):

                $this->form_validation->set_rules('app_titulo', '<b>TÍTULO DO APLICATIVO</b>', 'trim|required|max_length[250]');

                if ($this->input->post('type_project') == 'crud') {
                    $this->form_validation->set_rules('primary_key', '<b>CHAVE PRIMÁRIA</b>', 'trim|required|max_length[50]');
                }

                if (!empty($this->input->post('calendarCheckboxAtivar')) && $this->input->post('calendarCheckboxAtivar') == 'on') {
                    $this->form_validation->set_rules('calendarInputTitulo', '<b>TÍTULO</b> ', 'trim|required');
                    $this->form_validation->set_rules('calendarInputDescricao', '<b>DESCRIÇÃO</b> ', 'trim|required');
                    $this->form_validation->set_rules('calendarInputDataStart', '<b>DATA INÍCIO</b> ', 'trim|required');
                    $this->form_validation->set_rules('calendarInputDataEnd', '<b>DATA FINAL</b> ', 'trim|required');
                }


                if ($this->form_validation->run() == true):

                    $_dados = $this->input->post();

                    /**
                     * PREPARA OS DADOS DOS CAMPOS DO CALENDÁRIO PARA GRAVAR
                     */
                    $_calendarInputs = [];


                    foreach ($_dados as $key => $calendarInput) {
                        if (mc_contains_in_string('calendarInput', $key) || mc_contains_in_string('calendarCheckboxAtivar', $key)) {

                            if ($this->input->post('calendarCheckboxAtivar') == 'on') {
                                $_calendarInputs[$key] = $calendarInput;
                            } else {
                                $_calendarInputs[$key] = '';
                            }

                            unset($_dados[$key]);
                        }
                    }

                    $_dados['calendar_inputs'] = json_encode($_calendarInputs);

                    /* END PREPARA OS DADOS DOS CAMPOS DO CALENDÁRIO PARA GRAVAR */

                    $_dados['code_script'] = $this->input->post('code_script', false);

                    if ($this->input->post('type_project') == 'crud') {
                        $this->_primary_key_field = $_dados['primary_key'];
                    }

                    $_dadosCodeEditor['code_script'] = base64_encode($_dados['code_script']);

                    unset($_dados['btn-editar']);
                    unset($_dados['task']);
                    unset($_dados['primary_key']);
                    unset($_dados['type_project']);
                    unset($_dados['code_script']);
                    unset($_dados['id']);

                    $_where = 'WHERE id = "' . $this->input->post('id') . '"';

                    if ($this->update->exec($this->table_name, $_dados, $_where)):

                        /**
                         * UPDATE CODEEDITOR APP BLANK
                         */
                        if ($this->input->post('type_project') == 'blank') {

                            $_whereCodeEditor = 'WHERE proj_build_id = "' . $this->input->post('id') . '" AND code_type = "blank" AND code_screen = "blank"';
                            $this->update->exec('proj_build_codeeditor', $_dadosCodeEditor, $_whereCodeEditor);

                            /**/
                        }
                        /* END GRAVA CODEEDITOR APP BLANK */

                        /* GRAVA AUDITORIA */
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_SUCCESS___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

                        set_mensagem_trigger_notifi(___MSG_UPDATE_REGISTRO___, 'success');

                        if ($this->input->post('type_project') == 'crud') {
                            $this->db->where('proj_build_id', $this->input->post('id'));
                            $this->db->set('primary_key', '0');
                            $this->db->update('proj_build_fields');

                            $this->db->where('proj_build_id', $this->input->post('id'));
                            $this->db->where('field_name', $this->_primary_key_field);
                            $this->db->set('primary_key', '1');
                            $this->db->update('proj_build_fields');
                        }

                        /* GRAVA AUDITORIA */
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_SUCCESS___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

                        $this->form_validation->clear_field_data();

                    else:
                        /* GRAVA AUDITORIA */
                        $dados_auditoria['creator'] = 'system';
                        $dados_auditoria['action'] = 'error edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_ERROR___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

                        set_mensagem_trigger_notifi(___MSG_ERROR_UPDATE_REGISTRO___, 'error');

                    endif;

                endif;

            endif;

        endif;

        /* GET DADOS PARA EDIÇÃO DOS REGISTROS */
        if ($_id):

            /*
             * BUSCA OS DADOS
             */
            $_where = 'WHERE id = "' . $_id . '" LIMIT 1';
            $_result = $this->read->exec($this->table_name, $_where);

            if ($_result->row()->type_project == 'crud') {
                $this->dados['_titulo_app'] .= ' CRUD';
            } else {
                $this->dados['_titulo_app'] .= ' BLANK';
            }

            if ($_result->result()):

                $this->dados['dados'] = $_result->row();

                /**
                 * GET DADOS CODE EDITOR APP BLANK
                 */
                if ($this->dados['dados']->type_project == 'blank') {

                    $_whereCodeEditorBlank = 'WHERE proj_build_id = "' . $_id . '" AND code_type = "blank" AND code_screen = "blank" LIMIT 1';
                    $_resultCodeEditorBlank = $this->read->exec('proj_build_codeeditor', $_whereCodeEditorBlank);
                    $this->dados['dados']->_codeEditorBlank = $_resultCodeEditorBlank->row();
                }
                /* END GET DADOS CODE EDITOR APP BLANK */

                if ($this->dados['dados']->type_project == 'crud'):
                    /*
                     * GRAVA CAMPOS DA GRID LIST
                     */
                    $this->save_fields_project($this->dados['dados']->tabela, $this->dados['dados']->id, 'gridlist');

                    /*
                     * GRAVA CAMPOS DO FORM ADD/EDIT
                     */
                    $this->save_fields_project(str_replace('vw_', '', $this->dados['dados']->tabela), $this->dados['dados']->id, 'formaddedit');

                    /*
                     * CARREGA OS CAMPOS DA GRID LIST
                     */
                    $this->dados['_fields_table_gridlist']['_result'] = $this->read->exec('proj_build_fields', 'WHERE proj_build_id = ' . $_id . ' AND screen_type = "gridlist" ORDER BY order_field_gridlist')->result_array();

                    /*
                     * CARREGA OS CAMPOS DO FORM ADD/EDIT
                     */
                    $this->dados['_fields_table_formAddEdit']['_result'] = $this->read->exec('proj_build_fields', 'WHERE proj_build_id = ' . $_id . ' AND screen_type = "formaddedit" ORDER BY order_field_form')->result_array();

// GET EVENTOS PHP
                    $_r_eventos_php = $this->db->get_where('proj_build_codeeditor', array('code_type' => 'evento-php', 'proj_build_id' => $_id))->result_array();
                    foreach ($_r_eventos_php as $_key_r_evento_php => $_value_r_evento_php):
                        $this->dados["_eventos_php"][$_value_r_evento_php['code_screen']] = $_value_r_evento_php['code_script'];
                    endforeach;

// GET ON RECORD PHP
                    $_r_eventos_php = $this->db->get_where('proj_build_codeeditor', array('code_type' => 'onrecord', 'proj_build_id' => $_id))->result_array();
                    foreach ($_r_eventos_php as $_key_r_evento_php => $_value_r_evento_php):
                        $this->dados["_eventos_php"][$_value_r_evento_php['code_screen']] = $_value_r_evento_php['code_script'];
                    endforeach;

// GET ON RECORD EXPORT PHP
                    $_r_eventos_php = $this->db->get_where('proj_build_codeeditor', array('code_type' => 'onrecordexport', 'proj_build_id' => $_id))->result_array();
                    foreach ($_r_eventos_php as $_key_r_evento_php => $_value_r_evento_php):
                        $this->dados["_eventos_php"][$_value_r_evento_php['code_screen']] = $_value_r_evento_php['code_script'];
                    endforeach;

// GET CSS GRIDLIST
                    $this->dados["_gridlist_css"] = $this->db->get_where('proj_build_codeeditor', array('code_type' => 'css', 'code_screen' => 'gridlist', 'proj_build_id' => $_id))->row_array();

// GET JQUERY GRIDLIST
                    $this->dados["_gridlist_jquery"] = $this->db->get_where('proj_build_codeeditor', array('code_type' => 'jquery', 'code_screen' => 'gridlist', 'proj_build_id' => $_id))->row_array();

// GET CSS/JQUERY FORM ADD
                    $_r_formadd_css_jquery = $this->db->get_where('proj_build_codeeditor', array('code_screen' => 'formadd', 'proj_build_id' => $_id))->result_array();
                    foreach ($_r_formadd_css_jquery as $_key_r_formadd_css_jquery => $_value_r_formadd_css_jquery):
                        $this->dados["_formadd_css_jquery"][$_value_r_formadd_css_jquery['code_type']] = $_value_r_formadd_css_jquery['code_script'];
                    endforeach;

// GET CSS/JQUERY FORM EDIT
                    $_r_formedit_css_jquery = $this->db->get_where('proj_build_codeeditor', array('code_screen' => 'formedit', 'proj_build_id' => $_id))->result_array();
                    foreach ($_r_formedit_css_jquery as $_key_r_formedit_css_jquery => $_value_r_formedit_css_jquery):
                        $this->dados["_formedit_css_jquery"][$_value_r_formedit_css_jquery['code_type']] = $_value_r_formedit_css_jquery['code_script'];
                    endforeach;

                endif;

                /* GET METODOS PHP */
                $this->dados["_metodos_php"] = $this->db->get_where('proj_build_codeeditor', array('code_type' => 'metodo-php', 'proj_build_id' => $_id))->result_array();

                /* GET MODELS PHP */
                $this->dados["_models_php"] = $this->db->get_where('proj_build_codeeditor', array('code_type' => 'model-php', 'proj_build_id' => $_id))->result_array();

            else:

                set_mensagem_trigger_notifi(___MSG_ERROR_SELECT_UPDATE_REGISTRO___, 'error');
                redirect($this->_redirect_parametros_url);
            endif;

        else:
            redirect($this->_redirect_parametros_url);
        endif;

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_edit'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

//END public function edit()

    /*
     * FUNÇÃO DELETAR
     */

    public function del() {

        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        $this->form_validation->set_rules('btndel', '<b>BTN Del</b>', 'trim|required');
        $this->form_validation->set_rules('dadosdel', '<b>REGISTROS DEL</b>', 'trim|required');

        if ($this->form_validation->run() == true):

            $_dados = $this->input->post('dadosdel', true);
            $_dados = explode(', ', $_dados);

            foreach ($_dados as $_rowdel):

                /*
                 * GET NOME DO APP
                 */
                $this->db->where('id', $_rowdel);
                $this->_app_nome = $this->db->get($this->table_name)->row()->app_nome;
                $this->_directory = FCPATH . 'application/modules/';

                /*
                 * RENAME FOLDER APP PARA DELETAR
                 */
                bz_renamedir($this->_directory, strtolower($this->_app_nome));

                /*
                 * DELETA OS REGISTROS
                 */
                $this->db->where('id', $_rowdel);
                $this->db->delete($this->table_name);

                if ($this->db->affected_rows()):
                    if (count($_dados) > 1):
                        set_mensagem_trigger_notifi(str_replace('Registro Deletado', 'Registros Deletados', ___MSG_DEL_REGISTRO___), 'success');
                        $dados_auditoria['description'] = str_replace('Registro Deletado', 'Registros Deletados', ___MSG_AUDITORIA_DEL_SUCCESS___);
                    else:
                        set_mensagem_trigger_notifi(___MSG_DEL_REGISTRO___, 'success');
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_DEL_SUCCESS___;
                    endif;

                    /* GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'del';
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    add_auditoria($dados_auditoria);

                    /**
                     * DELETA O APP DA TABELA sec_aplicativos
                     */
                    $this->db->where_in('app_name', $this->_app_nome);
                    $this->db->delete('sec_aplicativos');

                    if ($this->db->affected_rows()):
//GRAVA AUDITORIA
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'del';
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);
                    endif;

                else:
//set_mensagem_toastr('<i class = "fa fa-fw fa-thumbs-o-down" style = "font-size: 1.5em"></i>', _MSG_ERROR_DEL_REGISTRO_, 'error', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_ERROR_DEL_REGISTRO___, 'error');
                endif;

            endforeach;

        else:
//set_mensagem_toastr('<i class = "fa fa-fw fa-thumbs-o-down" style = "font-size: 1.5em"></i>', _MSG_ERROR_DE_VALIDACAO_, 'error', 'top-center');
            set_mensagem_trigger_notifi(___MSG_ERROR_DE_VALIDACAO___, 'error');
        endif;

        exit;
    }

//END public function del()

    /*
     * REORDER LINE TABLE GRID LIST
     */
    public function reorder_linegridlist() {

        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        $_response['csrf_token'] = $this->security->get_csrf_hash();

        if ($this->input->post()):

            if ($this->input->post('task') == 'SAVE-REORDER-GRID-LIST'):

                $_dados = $_POST;
                $_screen_type = $this->input->post('screen_type');

                unset($_dados['task']);
                unset($_dados['screen_type']);

                $_where = 'WHERE proj_build_id = "' . $_dados['projeto_id'] . '" AND field_name  = "' . $_dados ['field_name'] . '  " AND  screen_type  =  "' . $_screen_type . ' "';
                if ($this->update->exec('proj_build_fields', array('order_field_gridlist' => $_dados['order_field_gridlist']), $_where)):
                /**/
                endif;

                $_response['message'] = 'SAVE-REORDER-FIELDS-GRIDLIST-OK';
                echo json_encode($_response);
                exit;

            elseif ($this->input->post('task') == 'SAVE-REORDER-GRID-LIST-FORM-ADD-EDIT'):

                $_dados = $_POST;
                $_screen_type = $this->input->post('screen_type');

                unset($_dados['task']);
                unset($_dados['screen_type']);

                $_where = 'WHERE proj_build_id = "' . $_dados['projeto_id'] . '" AND field_name = "' . $_dados['field_name'] . '" AND screen_type = "' . $_screen_type . '"';
                if ($this->update->exec('proj_build_fields', array('order_field_form' => $_dados['order_field_form']), $_where)):
                /**/
                endif;

                $_response['message'] = 'SAVE-REORDER-FIELDS-GRIDLIST-OK';
                echo json_encode($_response);
                exit;

            else:

                $_response['message'] = 'ERRO...';
                echo json_encode($_response);
                exit;

            endif;

        else:

            $_response['message'] = 'ERRO...';
            echo json_encode($_response);
            exit;

        endif;

        exit;
    }

//END public function reorder_linegridlist()

    /*
     * MARCA O FIELD PARA PESQUISA NA GRID LIST
     */
    public function switch_search_field_on_off() {
        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        if ($this->input->post('task') == 'SAVE-SWITCH'):

            $_response['post'] = $this->input->post();

            /* GET DADOS FIELDS */
            $_r = $this->db->get_where('proj_build_fields', array('proj_build_id' => $this->input->post('project_id'), 'field_name' => $this->input->post('field_name'), 'screen_type' => $this->input->post('screen_type')))->row();
            $_r_param_gridlist = $_r->param_gridlist;
            $_r_param_formaddedit = $_r->param_formaddedit;
            $_dados = '';
            $_response = [];
            $_response['csrf_token'] = $this->security->get_csrf_hash();

            if ($_r):

                if ($this->input->post('screen_type') == 'gridlist'):

                    $_dados = json_decode($_r_param_gridlist, true);
                    $_dados['grid_list_search'] = $this->input->post('grid_list_search');
                    $_grid_list_show = $_dados['grid_list_show'];
                    $_dados = json_encode($_dados, JSON_UNESCAPED_UNICODE);

                    /* if ($_grid_list_show == 'off') {
                      $_response['message'] = 'SAVE-SWITCH-OK';
                      echo json_encode($_response);
                      exit;
                      } */

                    $this->db->set('param_gridlist', $_dados);
                    $this->db->where('proj_build_id', $this->input->post('project_id'));
                    $this->db->where('field_name', $this->input->post('field_name'));
                    $this->db->where('screen_type', $this->input->post('screen_type'));
                    $_response['update'] = $this->db->update('proj_build_fields');

                    $_response['message'] = 'SAVE-SWITCH-OK';
                    echo json_encode($_response);
                    exit;

                endif;

            endif;

        endif;

        exit;
    }

//END public function switch_search_field_on_off()

    /*
     * MARCA O FIELD PARA EXPORTAR
     */
    public function switch_export_field_on_off() {
        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        if ($this->input->post('task') == 'SAVE-SWITCH'):

            $_response['post'] = $this->input->post();

            /* GET DADOS FIELDS */
            $_r = $this->db->get_where('proj_build_fields', array('proj_build_id' => $this->input->post('project_id'), 'field_name' => $this->input->post('field_name'), 'screen_type' => $this->input->post('screen_type')))->row();
            $_r_param_gridlist = $_r->param_gridlist;
            $_r_param_formaddedit = $_r->param_formaddedit;
            $_dados = '';
            $_response = [];
            $_response['csrf_token'] = $this->security->get_csrf_hash();

            if ($_r):

                if ($this->input->post('screen_type') == 'gridlist'):

                    $_dados = json_decode($_r_param_gridlist, true);
                    $_dados['grid_list_export'] = $this->input->post('grid_list_export');
                    $_grid_list_show = $_dados['grid_list_show'];
                    $_dados = json_encode($_dados, JSON_UNESCAPED_UNICODE);

                    /* if ($_grid_list_show == 'off') {
                      $_response['message'] = 'SAVE-SWITCH-OK';
                      echo json_e ncode($_response);
                      exit;
                      } */

                    $this->db->set('param_gridlist', $_dados);
                    $this->db->where('proj_build_id', $this->input->post('project_id'));
                    $this->db->where('field_name', $this->input->post('field_name'));
                    $this->db->where('screen_type', $this->input->post('screen_type'));
                    $_response['update'] = $this->db->update('proj_build_fields');

                    $_response['message'] = 'SAVE-SWITCH-OK';
                    echo json_encode($_response);
                    exit;

                endif;

            endif;

        endif;

        exit;
    }

//END public function switch_export_field_on_off()

    /*
     * MARCA O FIELD PARA MOSTRAR OU NÃO NA GRID LIST E/OU FORM ADD/EDIT
     */
    public function switch_show_field_on_off() {

        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        if ($this->input->post('task') == 'SAVE-SWITCH'):

            $_response['post'] = $this->input->post();

            /* GET DADOS FIELDS */
            $_r = $this->db->get_where('proj_build_fields', array('proj_build_id' => $this->input->post('project_id'), 'field_name' => $this->input->post('field_name'), 'screen_type' => $this->input->post('screen_type')))->row();
            $_r_param_gridlist = $_r->param_gridlist;
            $_r_param_formaddedit = $_r->param_formaddedit;
            $_dados = '';
            $_response = [];
            $_response['csrf_token'] = $this->security->get_csrf_hash();

            if ($_r):

                if ($this->input->post('screen_type') == 'gridlist') {

                    $_dados = json_decode($_r_param_gridlist, true);
                    $_dados['grid_list_show'] = $this->input->post('grid_list_show');

                    if ($this->input->post('grid_list_show') == 'off') {
                        $_dados['grid_list_search'] = 'off';
                        $_dados['grid_list_export'] = 'off';
                    }

                    $_dados = json_encode($_dados, JSON_UNESCAPED_UNICODE);

                    $this->db->set('param_gridlist', $_dados);
                    $this->db->where('proj_build_id', $this->input->post('project_id'));
                    $this->db->where('field_name', $this->input->post('field_name'));
                    $this->db->where('screen_type', $this->input->post('screen_type'));
                    $_response['update'] = $this->db->update('proj_build_fields');

                    $_response['message'] = 'SAVE-SWITCH-OK';

                    echo json_encode($_response);
                    exit;
                } elseif ($this->input->post('screen_type') == 'formaddedit') {

                    $_dados = json_decode($_r_param_formaddedit, true);
                    $_dados['form_add_edit_field_show'] = $this->input->post('grid_list_show');
                    $_dados = json_encode($_dados, JSON_UNESCAPED_UNICODE);

                    $this->db->set('param_formaddedit', $_dados);
                    $this->db->where('proj_build_id', $this->input->post('project_id'));
                    $this->db->where('field_name', $this->input->post('field_name'));
                    $this->db->where('screen_type', $this->input->post('screen_type'));
                    $_response['update'] = $this->db->update('proj_build_fields');

                    $_response['message'] = 'SAVE-SWITCH-OK';

                    echo json_encode($_response);
                    exit;
                }

            endif;

        endif;

        exit;
    }

//END public function switch_show_field_on_off()

    /*
     * CARREGA REGISTROS COM PAGINAÇÃO
     */

    private function get_paginacao() {

        $_filter = $this->input->get();
        unset($_filter['pg']);
        unset($_filter['search']);

        /*
         * DADOS PARA PAGINAÇÃO
         */
        $_dados_pag['table'] = $this->table_name;
        if ($this->input->get('search', true)):
            $_dados_pag['search'] = array('_concat_fields' => 'tabela, app_nome, app_titulo', '_string' => $this->input->get('search', true));
        endif;

        $_dados_pag['filter'] = $_filter;
        $_dados_pag['order_by'] = 'tabela';
        $_dados_pag['programa'] = $this->router->fetch_class();
        $_dados_pag['per_page'] = '10';

        $_result_pag = bz_paginacao($_dados_pag);

        return $_result_pag;
    }

//END private function get_paginacao()

    /*
     * ICONES
     */

    public function icons() {
        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = $this->router->fetch_class() . '/vIcons';
        $this->load->view('vMasterPageIframe', $this->dados);
    }

//END public function icons()

    /*
     * GRAVA CAMPOS DA TABELA DO PROJETO
     */

    private function save_fields_project($_tabela, $_proj_build_id, $_screen_type) {

        $_fields = $this->db->field_data($_tabela);

        foreach ($_fields as $_field):

            $_dadosTable = array();

            if (!$this->read->exec('proj_build_fields', 'WHERE proj_build_id = ' . $_proj_build_id . ' AND field_name = "' . $_field->name . '" AND screen_type = "' . $_screen_type . '"')->result()):

                $_dadosTable['proj_build_id'] = $_proj_build_id;
                $_dadosTable['field_name'] = $_field->name;
                $_dadosTable['field_type'] = $_field->type;
                $_dadosTable['field_length'] = $_field->max_length;
                $_dadosTable['screen_type'] = $_screen_type;

                if ($this->_primary_key_field):
                    if ($this->_primary_key_field == $_field->name):
                        $_dadosTable['primary_key'] = 1;
                    endif;
                else:
                    $_dadosTable['primary_key'] = $_field->primary_key;
                endif;

                /**
                 * TIPOS DE CAMPOS DA GRIDLIST E DO FORM
                 */
                $_input_type = 'text';

                if ($_dadosTable['field_type'] == "int") {
                    $_input_type = 'number';
                } elseif ($_dadosTable['field_type'] == "longtext") {
                    $_input_type = 'text-long';
                } elseif ($_dadosTable['field_type'] == "date") {
                    $_input_type = 'date';
                } elseif ($_dadosTable['field_type'] == "time") {
                    $_input_type = 'time';
                } elseif ($_dadosTable['field_type'] == "datetime") {
                    $_input_type = 'datetime';
                }
                /* END TIPOS DE CAMPOS DA GRIDLIST E DO FORM */

                /*
                 * PARÂMETROS DO CAMPO
                 */
                if ($_screen_type == 'gridlist'):
                    $_dadosTable['param_gridlist'] = '{"grid_list_show":"on", "grid_list_search":"on", "grid_list_export":"on", "grid_list_field_input_type":"' . $_input_type . '", "grid_list_label":"' . $_dadosTable['field_name'] . '", "grid_list_aligne_label":"text-left", "grid_list_field_length":"", "grid_list_field_aligne":"text-left"}';
                elseif ($_screen_type == 'formaddedit'):
                    $_dadosTable['param_formaddedit'] = '{"form_add_edit_field_show":"on", "form_add_edit_field_type":"' . $_input_type . '", "form_add_edit_field_label":"' . $_dadosTable['field_name'] . '", "form_add_edit_field_placeholder":"", "form_add_edit_field_max_length":"' . (($_dadosTable['field_length'] > 0) ? $_dadosTable['field_length'] : '') . '"}';
                endif;
                /* END PARÂMETROS DO CAMPO */

                $this->create->exec('proj_build_fields', $_dadosTable);

            endif;

        endforeach;
    }

//END private function save_fields_project()

    /*
     * GRAVA OS DADOS DO FORM DE CONFIGURAÇÃO POUP DA GRID LIST
     */

    public function ajax_get_fields_table() {

        /*
         * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
         */
        bz_check_is_ajax_request();

        $_tableName = $this->input->post('table');
        $_fields = $this->db->field_data($_tableName);
        $_rows[] = array();
        $_c = 0;

        foreach ($_fields as $_field):

            $_rows[$_c]['field_name'] = $_field->name;
            $_rows[$_c]['field_type'] = $_field->type;
            $_rows[$_c]['field_length'] = $_field->max_length;
            $_rows[$_c]['primary_key'] = $_field->primary_key;
            $_rows[$_c]['csrf_token'] = $this->security->get_csrf_hash();

            $_c++;

        endforeach;

        header("Content-type:application/json");
        echo json_encode($_rows);

        exit;
    }

//END public function ajax_get_fields_table()

    /*
     * EDITOR DECÓDIGOS DO PROJETO
     */

    public function codeeditor($_idProjeto = null, $_code_screen = null, $_code_type = null) {

        /*
         * CHECK SE EXISTE
         */
        if (($_code_type == 'metodo-php' || 'model-php' || $_code_type == 'evento-php') && !empty($_idProjeto)):

            $this->dados['_parametros']['code_screen_title'] = ' [' . $_code_screen . ' ($_p = null)]';

        else:

            if (empty($_idProjeto) || empty($_code_screen) || empty($_code_type)):
                set_mensagem_trigger_notifi('Nenhum parâmetro foi passado ou inconsistentes para Editor de Códigos.', 'warning');
                redirect(site_url('projectbuildcrud'));
                exit;
            endif;

            if ($_code_screen == 'gridlist' || $_code_screen == 'formadd' || $_code_screen == 'formedit'):
            else:
                set_mensagem_trigger_notifi('Foram passados parâmetros inconsistentes para o Editor de Códigos do Projeto.', 'warning');
                redirect(site_url('projectbuildcrud'));
                exit;
            endif;

            if ($_code_type == 'css' || $_code_type == 'jquery'):
            else:
                set_mensagem_trigger_notifi('Foram passados parâmetros inconsistentes para o Editor de Códigos do Projeto.', 'warning');
                redirect(site_url('projectbuildcrud'));
                exit;
            endif;

        endif;

        /*
         * CHECK POST SAVE
         */
        if ($this->input->post()):

            /*
             * SAVE DADOS DO EDITOR DE CÓDIGOS
             */
            if ($this->input->post('btn-save-code-editor')):

                /*
                 * CHECK SE EXISTE O REGISTRO GRAVADO
                 */
                $_where = 'WHERE proj_build_id = "' . $this->input->post('proj_build_id') . '" AND ' .
                        'code_screen = "' . $this->input->post('code_screen') . '" AND ' .
                        'code_type = "' . $this->input->post('code_type') . '"';

                $_query = $this->read->exec('proj_build_codeeditor', $_where);

                if ($_query->result_array()):
                    /*
                     * SE EXISTIR FAZ O UPDATE
                     */
                    $_data_code_editor = array(
                        'code_access_ajax_only' => ($this->input->post('code_access_ajax_only') == 'on' ? 1 : 0),
                        'code_type_method' => ($this->input->post('code_access_ajax_only') == 'on' ? 'public' : $this->input->post('code_type_method')),
                        'code_script' => base64_encode($this->input->post('code_script', false)),
                    );
                    $this->update->exec('proj_build_codeeditor', $_data_code_editor, $_where);

                    set_mensagem_trigger_notifi(strtoupper(str_replace('-', ' ', $this->input->post('code_type'))) . ' Atualizado com Sucesso.', 'success');

                else:
                    /*
                     * SE NÃO EXISTIR CRIA O REGISTRO
                     */

                    $_data_code_editor = array(
                        'proj_build_id' => $this->input->post('proj_build_id'),
                        'code_screen' => $this->input->post('code_screen'),
                        'code_type' => $this->input->post('code_type'),
                        'code_access_ajax_only' => ($this->input->post('code_access_ajax_only') == 'on' ? 1 : 0),
                        'code_type_method' => ($this->input->post('code_access_ajax_only') == 'on' ? 'public' : $this->input->post('code_type_method')),
                        'code_script' => base64_encode($this->input->post('code_script', false)),
                    );
                    $this->create->exec('proj_build_codeeditor', $_data_code_editor);

                    set_mensagem_trigger_notifi(strtoupper(str_replace('-', ' ', $this->input->post('code_type'))) . ' Adicionado com Sucesso.', 'success');

                endif;

            elseif ($this->input->post('btn-del-code-editor')):

                $_dados_del_code = $this->input->post();
                unset($_dados_del_code['btn-del-code-editor']);
                unset($_dados_del_code['code_script']);

                $this->db->where('proj_build_id', $_dados_del_code['proj_build_id']);
                $this->db->where('code_screen', $_dados_del_code['code_screen']);
                $this->db->where('code_type', $_dados_del_code['code_type']);
                $_r_del_code_editor = $this->db->delete('proj_build_codeeditor');

                if ($_r_del_code_editor):
                    set_mensagem_trigger_notifi(strtoupper(str_replace('-', ' ', $_dados_del_code['code_type'])) . ': ' . $_dados_del_code['code_screen'] . ' () Deletado com Sucesso.', 'success');
                    redirect('projectbuildcrud/edit/' . $_dados_del_code['proj_build_id'] . '?tab = gridlist');
                else:

                endif;

            endif;

        endif;

        /*
         * PARÂMETROS
         */
        $this->dados['_parametros']['code_screen'] = $_code_screen;

        if (( $_code_screen == 'gridlist')):
            $this->dados['_parametros']['code_screen_title'] = 'GRID LIST';
        elseif (($_code_screen == 'formadd')):
            $this->dados['_parametros']['code_screen_title'] = 'FORM ADD';
        elseif (($_code_screen == 'formedit')):
            $this->dados['_parametros']['code_screen_title'] = 'FORM EDIT';
        endif;

        $this->dados['_parametros']['code_type'] = $_code_type;

        $this->dados['_parametros']['code_script'] = '';
        $this->dados['_parametros']['code_access_ajax_only'] = '';
        $this->dados['_parametros']['code_type_method'] = 'public';

        /*
         * GET DADOS DO PROJETO
         */
        $_where = 'WHERE id = "' . $_idProjeto . '" LIMIT 1';
        $_result = $this->read->exec($this->table_name, $_where);

        if ($_result->result()):

            $this->dados['_dados_projeto'] = $_result->row();

            /* TITULO APP */
            if ($this->dados['_dados_projeto']->type_project == 'blank') {
                $this->dados['_titulo_app'] .= ' BLANK';
            } elseif ($this->dados['_dados_projeto']->type_project == 'crud') {
                $this->dados['_titulo_app'] .= ' CRUD';
            }

            /*
             * GET CODE SCRIPT
             */
            $_where = array(
                'proj_build_id' => $_idProjeto,
                'code_screen' => $_code_screen,
                'code_type' => $_code_type,
            );

            $_r_CodeEditor = $this->db->get_where('proj_build_codeeditor', $_where)->row_array();

            if ($_r_CodeEditor):
                $this->dados['_parametros']['code_access_ajax_only'] = ($_r_CodeEditor['code_access_ajax_only'] == '1' ? 'checked' : '');
                $this->dados['_parametros']['code_type_method'] = $_r_CodeEditor['code_type_method'];
                $this->dados['_parametros']['code_script'] = $_r_CodeEditor['code_script'];
                $this->dados['_parametros']['type_project'] = $this->dados['_dados_projeto']->type_project;
            endif;

        else:

            set_mensagem_trigger_notifi('O parâmetro passado para Editor de Códigos do Projeto não confere.', 'warning');
            redirect(site_url('projectbuildcrud?search = ' . $this->_app_nome));
            exit;

        endif;

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = $this->router->fetch_class() . '/vProjectbuildCrudCodeEditor';
        $this->load->view('vMasterPageIframe', $this->dados);
    }

//END public function codeeditor()

    /*
     * CHECK SE O NOME DO APP EXISTE NA TABELA
     */

    public function check_name_app_exist() {

        $this->load->helper('file');

        $_app_nome = $this->input->post('app_nome');

        $_app_nome = ucfirst(bz_limpa_string(strtolower($_app_nome)));
        $_app_nome = str_replace('_', '', $_app_nome);

        $this->_app_nome = $_app_nome;
        $this->_appTitulo = $this->input->post('app_titulo');
        $this->_appTableName = $this->input->post('tabela');

        $this->_directory = FCPATH . 'application/modules/' . strtolower($this->_app_nome);

        /*
         * CHECK SE O DIRETORIO MODULES TEM PREMISSÃO PARA SER GRAVADO
         */
        if (!is_writable(str_replace('/' . strtolower($this->_app_nome), '', $this->_directory))):
            $this->form_validation->set_message('check_name_app_exist', 'O Diretório <b>MODULES</b> não tem permissão para gravação. ' . str_replace('/' . $this->_app_nome, '', $this->_directory));
            return false;
        endif;

        /*
         * CHECK SE O DIRETÓRIO DO APP JÁ EXISTE
         */
        if (is_dir($this->_directory)):
            $this->form_validation->set_message('check_name_app_exist', 'O Diretório <b>' . $this->_directory . '</b> já existe. ');
            return false;
        endif;

        /*
         * CHECK SE O NOME DO APP JÁ FOI CADASTRADO
         */
        $_where = 'WHERE app_nome = "' . $_app_nome . '" AND type_project = "crud" LIMIT 1';
        $_result = $this->read->exec($this->table_name, $_where);

        if ($_result->result()):
            $this->form_validation->set_message('check_name_app_exist', 'Este Aplicativo <b>' . $_app_nome . '</b> já existe.');
            return false;
        else:

            /*
             * CRIA O APP NO SERVIDOR
             */

            $_dados_index_html = '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';

            if (!is_dir($this->_directory)):
                mkdir($this->_directory, 0755);
                mkdir($this->_directory . '/controllers', 0755);
                mkdir($this->_directory . '/models', 0755);
                mkdir($this->_directory . '/views', 0755);
                mkdir($this->_directory . '/views/css', 0755);
                mkdir($this->_directory . '/views/js', 0755);

                write_file($this->_directory . '/index.html', $_dados_index_html);
                write_file($this->_directory . '/controllers/index.html', $_dados_index_html);
                write_file($this->_directory . '/models/index.html', $_dados_index_html);
                write_file($this->_directory . '/views/index.html', $_dados_index_html);
                write_file($this->_directory . '/views/css/index.html', $_dados_index_html);
                write_file($this->_directory . '/views/js/index.html', $_dados_index_html);

//                write_file($this->_directory . '/views/v' . $this->_app_nome . 'FormAdd.php', $this->_dadosAdd);
            //                    write_file($this->_directory . '/views/v' . $this->_app_nome . 'FormEdit.php', $this->_dadosEdit);

            endif;

            return true;

        endif;
    }

//END public function check_name_app_exist()

    /*
     * GERA O APP
     */

    public function build_app($_projectID) {

        /*
         * CARREGA OS HELPERS
         */
        $this->load->helper('file');

        /*
         * VARIÁVEIS
         */
        $this->_project_id = $_projectID;

        /*
         * GET TYPE PROJECT
         */
        $_appProject = $this->db->get_where('proj_build', array('id' => $this->_project_id))->row();

        if ($_appProject->type_project == 'blank'):

            $this->_project_id = $_appProject->id;
            $this->_security = ($_appProject->app_security == 'SIM' ? '' : 'FALSE');
            $this->_templatePadrao = $_appProject->app_template_padrao;
            $this->_app_nome = $_appProject->app_nome;
            $this->_appTitulo = $_appProject->app_titulo;
            $this->_appIcone = $_appProject->app_icone;

            $this->_directory = FCPATH . 'application/modules/' . strtolower($this->_app_nome);

            /**
             * GERANDO
             */
            echo "<link href=\"" . base_url('assets/dist/css/AdminLTE.BZ.min.css') . "\" rel=\"stylesheet\" type=\"text/css\"/>";

            /*
             * GERA O CONTROLLER DO APP BLANK
             */
            echo '<div class = "callout callout-success">
                        Gerando Controller do App Blank...
                        </div>';
            $this->ger_controllerBlank();

            /*
             * GERA O MODEL DO APP BLANK
             */
            echo '<div class = "callout callout-success">
                        Gerando Model do App Blank...
                        </div>';
            $this->ger_modelsBlank();

            /*
             * GERA O VIEW DO APP BLANK
             */
            echo '<div class = "callout callout-success">
                        Gerando View do App Blank...
                        </div>';
            $this->ger_viewBlank();

        else:

            /**
             * CARREGA DADOS DO PROJETO PARA GRID LIST VIEW
             */
            $this->db->select('*');
            $this->db->from('proj_build a');
            $this->db->join('proj_build_fields b', 'b.proj_build_id = a.id', 'left');
            $this->db->where('a.id', $this->_project_id);
            $this->db->where('b.screen_type', 'gridlist');
            $this->db->order_by('order_field_gridlist');
            $_r_projetc = $this->db->get();

            if ($_r_projetc->num_rows() != 0):

                /*
                 * VARIÁVEIS
                 */

                $this->_app_nome = $_r_projetc->row()->app_nome;
                $this->_appTitulo = $_r_projetc->row()->app_titulo;
                $this->_appIcone = $_r_projetc->row()->app_icone;
                $this->_appTableName = $_r_projetc->row()->tabela;
                $this->_appArrayDados = $_r_projetc->result_array();
                $this->_directory = FCPATH . 'application/modules/' . strtolower($this->_app_nome);
                $this->_gridListFieldsOrderBy = $_r_projetc->row()->order_by;
                $this->_gridListVirtualFieldsTable = [];
                $this->_appCalendarInputs = json_decode($_r_projetc->row()->calendar_inputs);


                /*
                 * CHECK SE O DIRETÓRIO DO APP JÁ EXISTE
                 */
                if (is_dir($this->_directory)):

                    /*
                     * CARREGA AS VARIÁVEIS COM OS DADOS DOS FIELDS DO PROJETO
                     */
                    $_r = '';
                    $_c = 0;

                    foreach ($this->_appArrayDados as $_row):

                        $_c++;

                        $_class = '';
                        $_width_field = '';

                        $_param_gridListField = json_decode($_row['param_gridlist'], true);
                        $_param_formAddEditField[$_row['field_name']] = mc_selectDataDB('proj_build_fields', 'WHERE proj_build_id = ' . $_row['proj_build_id'] . ' AND screen_type = "formaddedit" AND field_name = "' . $_row['field_name'] . '"')->row();

                        if ($_row['primary_key'] == 1):
                            $this->_primary_key_field = $_row['field_name'];
                        endif;

                        /* CAMPOS PARA FILTRAGEM DOS DADOS */
                        if ($_param_gridListField['grid_list_search'] == 'on' && (empty($_param_gridListField['grid_list_field_type']) || $_param_gridListField['grid_list_field_type'] != 'virtual')):
                            if ($this->_gridListSearchFields) {
                                $this->_gridListSearchFields .= ',' . $_row['field_name'];
                            } else {
                                $this->_gridListSearchFields .= $_row['field_name'];
                            }

                        endif;
                        /* END CAMPOS PARA FILTRAGEM DOS DADOS */

                        /*
                         * CAMPOS QUE SERÃO MOSTRADOS NA GRID LIST
                         */
                        if ($_param_gridListField['grid_list_show'] == 'on'):

                            /* CAMPOS VIRTUAIS */
                            if (!empty($_param_gridListField['grid_list_field_type'])):
                                if ($_param_gridListField['grid_list_field_type'] == 'virtual'):
                                    $this->_gridListVirtualFieldsTable[] = $_row['field_name'];
                                endif;
                            endif;
                            /* END CAMPOS VIRTUAIS */

                            if (strtolower($_row['field_name']) == 'status_active'):
                                $this->_gridListStatusDados = 'Y';
                            else:
                                $_class = (!empty($_param_gridListField['grid_list_aligne_label'])) ? $_param_gridListField['grid_list_aligne_label'] : 'text-left';
                                $_width_field .= (!empty($_param_gridListField['grid_list_field_length'])) ? 'width:' . $_param_gridListField['grid_list_field_length'] : '';

                                if (!empty($_param_gridListField['grid_list_aligne_label'])):
                                    if ($_param_gridListField['grid_list_aligne_label'] == 'text-left'):
                                        if (!empty($_width_field)):
                                            $_width_field .= ';
                        text-align:left';
                                        else:
                                            $_width_field .= 'text-align:left';
                                        endif;
                                    elseif ($_param_gridListField['grid_list_aligne_label'] == 'text-center'):
                                        if (!empty($_width_field)):
                                            $_width_field .= ';
                        text-align:center';
                                        else:
                                            $_width_field .= 'text-align:center';
                                        endif;
                                    elseif ($_param_gridListField['grid_list_aligne_label'] == 'text-right'):
                                        if (!empty($_width_field)):
                                            $_width_field .= ';
                        text-align:right';
                                        else:
                                            $_width_field .= 'text-align:right';
                                        endif;
                                    endif;
                                endif;

                                $this->_gridListFields .= $_row['field_name'] . ', ';
                                $this->_gridListHeaderTable .= '<th class = "thCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style = "' . $_width_field . '">' . $_param_gridListField['grid_list_label'] . '</th>' . PHP_EOL;

                                /**
                                 * FORMATAÇÃO DOS CAMPOS DA GRIDLIST $_ROW[] CONFORME SELEÇÃO DO CAMPO SELECT grid_list_field_input_type
                                 */
                                $_classBtnEdit = ' j-btn-edit btn-show-modal-aguarde mouse-cursor-pointer ';

                                if (!empty($_param_gridListField['grid_list_field_input_type'])) {

                                    /* CAMPO SELECT MODAL IMAGEM grid_list_field_type_modal_image  */
                                    if ($_param_gridListField['grid_list_field_input_type'] == 'upload-imagem') {

                                        /* CAMPO SELECT MODAL IMAGEM grid_list_field_type_modal_image  */
                                        if (!empty($_param_gridListField['grid_list_field_type_modal_image'])) {

                                            $_folderUploadImagem = json_decode($_param_formAddEditField[$_row['field_name']]->param_formaddedit)->form_add_edit_field_upload_imagem_folder;

                                            if ($_param_gridListField['grid_list_field_type_modal_image'] == 'icon-link') {
                                                $this->_gridListFieldsTable .= '<td class = "tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style = "' . $_width_field . '"><? = mc_image_link_modal ($_row["' . $_row['field_name'] . '"], "' . $_folderUploadImagem . '");
                        ?></td>' . PHP_EOL;
                                            } else if ($_param_gridListField['grid_list_field_type_modal_image'] == 'thumb') {
                                                $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= mc_image_thumb_modal ($_row["' . $_row['field_name'] . '"], "' . $_folderUploadImagem . '"); ?></td>' . PHP_EOL;
                                            } else if ($_param_gridListField['grid_list_field_type_modal_image'] == 'multi-upload') {
                                                $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= mc_image_thumb_modal ($_row["' . $_row['field_name'] . '"], "' . $_folderUploadImagem . '", "multi"); ?></td>' . PHP_EOL;
                                            }
                                        }

                                        /* END CAMPO SELECT MODAL IMAGEM grid_list_field_type_modal_image  */
                                        /**/
                                        /* CAMPO SELECT MODAL ARQUIVO grid_list_field_type_modal_arquivo  */
                                    } elseif ($_param_gridListField['grid_list_field_input_type'] == 'upload-arquivo') {

                                        $_folderUploadAquivo = json_decode($_param_formAddEditField[$_row['field_name']]->param_formaddedit)->form_add_edit_field_upload_arquivo_folder;

                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= mc_file_link_download ($_row["' . $_row['field_name'] . '"], "' . $_folderUploadAquivo . '"); ?></td>' . PHP_EOL;

                                        /* END CAMPO SELECT MODAL ARQUIVO grid_list_field_type_modal_arquivo  */
                                        /**/
                                        /* CAMPO INPUT NUMBER DECIMAL grid_list_field_input_type  */
                                    } elseif ($_param_gridListField['grid_list_field_input_type'] == 'number-decimal') {

                                        $_class .= $_classBtnEdit;
                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= bz_converteMoedaBrasil ($_row["' . $_row['field_name'] . '"]); ?></td>' . PHP_EOL;

                                        /* END CAMPO INPUT NUMBER DECIMAL grid_list_field_input_type */
                                        /**/
                                        /* CAMPO INPUT MOEDA grid_list_field_input_type  */
                                    } elseif ($_param_gridListField['grid_list_field_input_type'] == 'moeda') {

                                        $_class .= $_classBtnEdit;
                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '">R$ <?= bz_converteMoedaBrasil ($_row["' . $_row['field_name'] . '"]); ?></td>' . PHP_EOL;

                                        /* END CAMPO INPUT MOEDA grid_list_field_input_type */
                                        /**/
                                        /* CAMPO INPUT NUMBER INTENGER grid_list_field_input_type  */
                                    } elseif ($_param_gridListField['grid_list_field_input_type'] == 'number') {

                                        $_class .= $_classBtnEdit;
                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= number_format ($_row["' . $_row['field_name'] . '"], 0, "", ""); ?></td>' . PHP_EOL;

                                        /* END CAMPO INPUT NUMBER INTENGER grid_list_field_input_type */
                                        /**/
                                        /* CAMPO INPUT DATE grid_list_field_input_type  */
                                    } elseif ($_param_gridListField['grid_list_field_input_type'] == 'date') {

                                        $_class .= $_classBtnEdit;
                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= bz_formatdata ($_row["' . $_row['field_name'] . '"]); ?></td>' . PHP_EOL;

                                        /* END CAMPO INPUT DATE grid_list_field_input_type */
                                        /**/
                                        /* CAMPO INPUT TIME grid_list_field_input_type  */
                                    } elseif ($_param_gridListField['grid_list_field_input_type'] == 'time') {

                                        $_class .= $_classBtnEdit;
                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= bz_formatdata ($_row["' . $_row['field_name'] . '"], "H:i:s"); ?></td>' . PHP_EOL;

                                        /* END CAMPO INPUT TIME grid_list_field_input_type */
                                        /**/
                                        /* CAMPO INPUT DATETIME grid_list_field_input_type  */
                                    } elseif ($_param_gridListField['grid_list_field_input_type'] == 'datetime') {

                                        $_class .= $_classBtnEdit;
                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= bz_formatdata ($_row["' . $_row['field_name'] . '"], "d/m/Y H:i:s"); ?></td>' . PHP_EOL;

                                        /* END CAMPO INPUT DATETIME grid_list_field_input_type */
                                        /**/
                                        /* CAMPO INPUT SELECT grid_list_field_input_type  */
                                    } elseif ($_param_gridListField['grid_list_field_input_type'] == 'select') {

                                        $_class .= $_classBtnEdit;
                                        $_pkSelect = strtolower(base64_decode($_param_gridListField['grid_list_field_value_select']));
                                        $_pkSelect = substr($_pkSelect, 7, (strpos($_pkSelect, ',') - 7));

                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= $this->db->query ("' . base64_decode($_param_gridListField['grid_list_field_value_select']) . ' WHERE ' . $_pkSelect . ' = ".$_row["' . $_row['field_name'] . '"])->row ()->' . str_replace('_id', '', $_row['field_name']) . '; ?></td>' . PHP_EOL;

                                        /* END CAMPO INPUT SELECT grid_list_field_input_type */
                                        /**/
                                    } else {
                                        /**/
                                        $_class .= $_classBtnEdit;
                                        $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= $_row["' . $_row['field_name'] . '"]; ?></td>' . PHP_EOL;
                                        /**/
                                    }

                                    /**/
                                } else {

                                    $this->_gridListFieldsTable .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= $_row["' . $_row['field_name'] . '"]; ?></td>' . PHP_EOL;

                                    /**/
                                }
                            /* END FORMATAÇÃO DOS CAMPOS DA GRIDLIST $_ROW[] CONFORME SELEÇÃO DO CAMPO SELECT grid_list_field_input_type */

                            /**/
                            endif;

                        endif;
                        /* END CAMPOS QUE SERÃO MOSTRADOS NA GRID LIST */


                        /*
                         * CAMPOS QUE SERÃO MOSTRADOS NA EXPORT
                         */
                        if (isset($_param_gridListField['grid_list_export']) && $_param_gridListField['grid_list_export'] == 'on'):

                            /* CAMPOS VIRTUAIS */
                            if (!empty($_param_gridListField['grid_list_field_type'])):
                                if ($_param_gridListField['grid_list_field_type'] == 'virtual'):
                                    $this->_gridListVirtualFieldsTable[] = $_row['field_name'];
                                endif;
                            endif;
                            /* END CAMPOS VIRTUAIS */

                            if (strtolower($_row['field_name']) == 'status_active'):
                                $this->_gridListStatusDados = 'Y';
                            else:
                                $_class = (!empty($_param_gridListField['grid_list_aligne_label'])) ? $_param_gridListField['grid_list_aligne_label'] : 'text-left';
                                $_width_field .= (!empty($_param_gridListField['grid_list_field_length'])) ? 'width:' . $_param_gridListField['grid_list_field_length'] : '';

                                if (!empty($_param_gridListField['grid_list_aligne_label'])):
                                    if ($_param_gridListField['grid_list_aligne_label'] == 'text-left'):
                                        if (!empty($_width_field)):
                                            $_width_field .= '; text-align:left';
                                        else:
                                            $_width_field .= 'text-align:left';
                                        endif;
                                    elseif ($_param_gridListField['grid_list_aligne_label'] == 'text-center'):
                                        if (!empty($_width_field)):
                                            $_width_field .= '; text-align:center';
                                        else:
                                            $_width_field .= 'text-align:center';
                                        endif;
                                    elseif ($_param_gridListField['grid_list_aligne_label'] == 'text-right'):
                                        if (!empty($_width_field)):
                                            $_width_field .= '; text-align:right';
                                        else:
                                            $_width_field .= 'text-align:right';
                                        endif;
                                    endif;
                                endif;

                                $this->_gridListHeaderTableExport .= '<th class="thCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '">' . $_param_gridListField['grid_list_label'] . '</th>' . PHP_EOL;
                                $this->_gridListFieldsTableExport .= '<td class="tdCl' . ucfirst($_row['field_name']) . ' ' . $_class . '" style="' . $_width_field . '"><?= $_row["' . $_row['field_name'] . '"]; ?></td>' . PHP_EOL;
                            endif;

                        endif;

                    endforeach;

                    /**
                     * FIELDS SEARCH PARA FILTRAGEM
                     */
                    if ($this->_gridListSearchFields) {
                        $this->_gridListSearchFields = "if (\$this->input->get('search', TRUE)):
                        \$_dados_pag['search'] = array('_concat_fields' => '" . $this->_gridListSearchFields . "', '_string' => \$this->input->get('search', TRUE));
                        endif;";

                        $this->_gridListSearchInput = "<!-- INPUT SEARCH -->
                        <input type='text' name='search' value='<?= \$this->input->get ('search'); ?>' class='form-control input-sm pull-right' style ='width: 150px;' placeholder='Pesquisar' autofocus>
                        <!-- INPUT SEARCH -->";

                        $this->_gridListSearchButton = "<!-- BTN SEARCH -->
                        <button class='btn btn-sm btn-primary btn-show-modal-aguarde j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Pesquisa'><i class='fa fa-search'></i></button>
                        <!-- BTN SEARCH -->";

                        $this->_gridListClearhButton = "<!-- BTN LIMPAR -->
                        <a href='<?= site_url (\$this->router->fetch_class ()); ?>' class='btn btn-sm btn-default btn-show-modal-aguarde j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Limpar'><i class='glyphicon glyphicon-minus'></i></a>
                        <!-- BTN LIMPAR -->";
                    } else {
                        $this->_gridListDivButtons = 'pull-right margin-right-25';
                    }

                    $this->_gridListFields = substr($this->_gridListFields, 0, -1);

                    /*
                     * GET CODE EDITOR GRID LIST
                     */
                    $_where_getCode_GridList = array(
                        'proj_build_id' => $this->_project_id,
                        'code_screen' => 'gridlist',
                    );

                    $_query_getCode_GridList = $this->db->get_where('proj_build_codeeditor', $_where_getCode_GridList)->result();

                    foreach ($_query_getCode_GridList as $_row_getCode_GridList):

                        if ($_row_getCode_GridList->code_type == 'css' && !empty(trim($_row_getCode_GridList->code_script))):

                            $this->_gridListCodeEditorCSS .= "<!--" . PHP_EOL;
                            $this->_gridListCodeEditorCSS .= " * CSS SCRIPT" . PHP_EOL;
                            $this->_gridListCodeEditorCSS .= "-->" . PHP_EOL;
                            $this->_gridListCodeEditorCSS .= "<style>" . PHP_EOL . PHP_EOL;
                            $this->_gridListCodeEditorCSS .= html_entity_decode(base64_decode($_row_getCode_GridList->code_script, ENT_QUOTES)) . PHP_EOL . PHP_EOL;
                            $this->_gridListCodeEditorCSS .= "</style>" . PHP_EOL;
                            $this->_gridListCodeEditorCSS .= "<!--" . PHP_EOL;
                            $this->_gridListCodeEditorCSS .= " * END CSS SCRIPT" . PHP_EOL;
                            $this->_gridListCodeEditorCSS .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;

                        endif;

                        if ($_row_getCode_GridList->code_type == 'jquery' && !empty(trim($_row_getCode_GridList->code_script))):

                            $this->_gridListCodeEditorJS .= "<!--" . PHP_EOL;
                            $this->_gridListCodeEditorJS .= " * JQUERY SCRIPT" . PHP_EOL;
                            $this->_gridListCodeEditorJS .= "-->" . PHP_EOL;
                            $this->_gridListCodeEditorJS .= "<script>" . PHP_EOL . PHP_EOL;
                            $this->_gridListCodeEditorJS .= "$(function(){" . PHP_EOL . PHP_EOL;
                            $this->_gridListCodeEditorJS .= html_entity_decode(base64_decode($_row_getCode_GridList->code_script), ENT_QUOTES) . PHP_EOL . PHP_EOL;
                            $this->_gridListCodeEditorJS .= "});" . PHP_EOL . PHP_EOL;
                            $this->_gridListCodeEditorJS .= "</script>" . PHP_EOL;
                            $this->_gridListCodeEditorJS .= "<!--" . PHP_EOL;
                            $this->_gridListCodeEditorJS .= " * END JQUERY SCRIPT" . PHP_EOL;
                            $this->_gridListCodeEditorJS .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;

                        endif;

                    endforeach;

                /*
                 * END GET CODE EDITOR GRID LIST
                 */

                else:

                    set_mensagem_trigger_notifi('APP Não foi Gerado.', 'warning');
                    redirect(site_url('projectbuildcrud?search=' . $this->_app_nome));
                    exit;

                endif;

            else:
                set_mensagem_trigger_notifi('Um ERRO Inesperado Ocorreu ao gerar GRID LIST.', 'error');
                redirect(site_url('projectbuildcrud'));
                exit;
            endif;

            /* END CARREGA DADOS DO PROJETO PARA GRID LIST VIEW */

            /**
             * CARREGA DADOS DO PROJETO PARA FORM ADD/EDIT
             */
            $this->db->select('*');
            $this->db->from('proj_build a');
            $this->db->join('proj_build_fields b', 'b.proj_build_id=a.id', 'left');
            $this->db->where('a.id', $this->_project_id);
            $this->db->where('b.screen_type', 'formaddedit');
            $this->db->order_by('order_field_form');
            $_r_projetcFormAddEdit = $this->db->get();

            if ($_r_projetcFormAddEdit->num_rows() != 0):

                /*
                 * VARIÁVEIS
                 */
                $this->_appArrayDados = $_r_projetcFormAddEdit->result_array();

                /*
                 * CHECK SE O DIRETÓRIO DO APP JÁ EXISTE
                 */
                if (is_dir($this->_directory)):

                    /*
                     * CARREGA AS VARIÁVEIS COM OS DADOS DOS FIELDS DO PROJETO
                     */
                    $_r = '';
                    $_c = 0;
                    $_autofocus = 'false';

                    foreach ($this->_appArrayDados as $_row):

                        $_c++;

                        $_param_formAddEditField = json_decode($_row['param_formaddedit'], true);

                        /*
                         * CAMPOS QUE SERÃO MOSTRADOS NO FORM ADD/EDIT
                         */
                        if ($_param_formAddEditField['form_add_edit_field_show'] == 'on'):

                            /*
                             * VARIÁVEIS
                             */
                            $this->_formAddEditConfigInput = '';
                            $this->_formAddEditConfigInputClassCSS = '';
                            $this->_formAddEditConfigInputAtributos = '';
                            $_classDisabledReadOnlyAsterisk = '';

                            $this->_formAddEditConfigInputValidationAtributos = 'trim';
                            $this->_formAddConfigInputValidationAtributos = 'trim';
                            $this->_formEditConfigInputValidationAtributos = 'trim';

                            //                        if (!empty($_param_formAddEditField['form_add_edit_field_read_only'])):
                            //                            if ($_param_formAddEditField['form_add_edit_field_read_only'] == 'on'):
                            //                                if ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'todos'):
                            //                                    echo $_row['field_name'] . ' - READ ONLY TODOS...';
                            //
                        //                                elseif ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formadd'):
                            //                                    echo $_row['field_name'] . ' - READ ONLY SOMENTE FORM ADD...';
                            //
                        //                                endif;
                            //                            endif;
                            //                        endif;
                            //
                        //
                        //
                        //                        if (!empty($_param_formAddEditField['form_add_edit_field_hidden'])):
                            //                            if ($_param_formAddEditField['form_add_edit_field_hidden'] == 'on'):
                            //                                if ($_param_formAddEditField['form_add_edit_field_hidden_in_form'] == 'todos'):
                            //                                /**/
                            //                                elseif ($_param_formAddEditField['form_add_edit_field_hidden_in_form'] == 'formadd'):
                            //
                        //                                    if (!empty($_param_formAddEditField['form_add_edit_field_read_only'])):
                            //                                        if ($_param_formAddEditField['form_add_edit_field_read_only'] == 'on'):
                            //                                            if ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formedit'):
                            //                                                echo $_row['field_name'] . ' - SOMENTE LEITURA -> ' . $_param_formAddEditField['form_add_edit_field_read_only_in_form'] . '<br/><br/>';
                            //                                            endif;
                            //                                        endif;
                            //
                        //                                    endif;
                            //
                        //                                elseif ($_param_formAddEditField['form_add_edit_field_hidden_in_form'] == 'formedit'):
                            //
                        //                                    if (!empty($_param_formAddEditField['form_add_edit_field_read_only'])):
                            //                                        if ($_param_formAddEditField['form_add_edit_field_read_only'] == 'on'):
                            //                                            if ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formadd'):
                            //                                                echo $_row['field_name'] . ' - SOMENTE LEITURA -> ' . $_param_formAddEditField['form_add_edit_field_read_only_in_form'] . '<br/><br/>';
                            //                                            endif;
                            //                                        endif;
                            //
                        //                                    endif;
                            //
                        //                                endif;
                            //
                        //                            endif;
                            //                        endif;

                            /**
                             * UNSET NO FIELD PRIMARY KEY NO EDIT
                             */
                            if ($_row['primary_key'] == 1):
                                $this->_formEditUnsetPrimaryKey .= "unset(\$_dados['" . $this->_primary_key_field . "']);" . PHP_EOL;
                            endif;
                            /* END UNSET NO FIELD PRIMARY KEY NO EDIT */

                            /*
                             * VALIDAÇÕES DOS INPUTS
                             */
                            /* AUTO FOCUS */
                            if ($_autofocus == 'false' && empty($_param_formAddEditField['form_add_edit_field_read_only'])):
                                $_autofocus = 'true';
                                $this->_formAddEditConfigInputAtributos .= 'autofocus ';
                            endif;

                            /* READ ONLY */
                            if (!empty($_param_formAddEditField['form_add_edit_field_read_only'])):
                                if ($_param_formAddEditField['form_add_edit_field_read_only'] == 'on'):

                                    if ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formadd'):
                                        $this->_formAddEditConfigInputAtributos .= 'disabled-formadd ';
                                    elseif ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formedit'):
                                        $this->_formAddEditConfigInputAtributos .= 'disabled-formedit ';
                                    else:
                                        $this->_formAddEditConfigInputAtributos .= 'disabled ';
                                    endif;

                                endif;
                            endif;

                            /* QUANTIDADE DE COLUNAS DO INPUT FIELD */
                            if (!empty($_param_formAddEditField['form_add_edit_field_column'])):
                                if (strlen($this->_formAddEditConfigInputClassCSS) > 0):
                                    $this->_formAddEditConfigInputClassCSS .= ' col-sm-' . (($_param_formAddEditField['form_add_edit_field_column'] > 0) ? $_param_formAddEditField['form_add_edit_field_column'] : '12');
                                else:
                                    $this->_formAddEditConfigInputClassCSS = 'col-sm-' . (($_param_formAddEditField['form_add_edit_field_column'] > 0) ? $_param_formAddEditField['form_add_edit_field_column'] : '12');
                                endif;
                            else:
                                if (strlen($this->_formAddEditConfigInputClassCSS) > 0):
                                    $this->_formAddEditConfigInputClassCSS .= ' col-sm-12';
                                else:
                                    $this->_formAddEditConfigInputClassCSS = 'col-sm-12';
                                endif;
                            endif;

                            /*
                             * GERA OS TIPOS DOS CAMPOS
                             */

                            // SE O CAMPO FOR READ ONLY, DESABILITA ALGUMAS FUNÇÕES

                            $_geraFormAddDadosFillable = true;
                            $_geraFormEditDadosFillable = true;

                            $_enableFormAddConvertDadosToDatabase = true;
                            $_enableFormEditConvertDadosToDatabase = true;

                            if (isset($_param_formAddEditField['form_add_edit_field_read_only']) && $_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'on') {

                                if ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'todos') {
                                    /**/
                                    $_geraFormAddDadosFillable = false;
                                    $_geraFormEditDadosFillable = false;
                                    /**/
                                    $_enableFormAddConvertDadosToDatabase = false;
                                    $_enableFormEditConvertDadosToDatabase = false;
                                    /**/
                                } elseif ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formedit') {
                                    /**/
                                    $_geraFormEditDadosFillable = false;
                                    /**/
                                    $_enableFormEditConvertDadosToDatabase = false;
                                    /**/
                                } elseif ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formadd') {
                                    /**/
                                    $_geraFormAddDadosFillable = false;
                                    /**/
                                    $_enableFormAddConvertDadosToDatabase = false;
                                    /**/
                                }
                            }


                            if ($_param_formAddEditField['form_add_edit_field_type'] == 'text'):

                                $this->_formAddEditConfigInput = '<input type="text" name="' . $_row['field_name'] . '" class="form-control ' . (!empty($_param_formAddEditField['form_add_edit_field_convert_letter_into']) ? $_param_formAddEditField['form_add_edit_field_convert_letter_into'] : null) . ' ' . ((!empty($_param_formAddEditField['form_add_edit_field_mask'])) ? 'j-mask-' . $_row['field_name'] : '') . ' " placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" ' . $this->_formAddEditConfigInputAtributos . ' value="<?= set_value ("' . $_row['field_name'] . '", !empty ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" />';

                                if ($_row['field_type'] == 'int'):
                                    if ($_enableFormAddConvertDadosToDatabase)
                                        $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = preg_replace("/[^0-9]/", "", $_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;
                                    if ($_row['primary_key'] == 0):
                                        if ($_enableFormEditConvertDadosToDatabase)
                                            $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = preg_replace("/[^0-9]/", "", $_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;
                                    endif;
                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'text-long'):

                                $this->_formAddEditConfigInput = '<textarea rows="5" name="' . $_row['field_name'] . '" class="form-control" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" ' . $this->_formAddEditConfigInputAtributos . '/><?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?></textarea>';

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'text-ckeditor'):

                                $this->_formAddEditConfigInput = '<textarea id="ckeditor-' . $_row['field_name'] . '" rows="5" name="' . $_row['field_name'] . '" class="form-control" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" ' . $this->_formAddEditConfigInputAtributos . '/><?= set_value  ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?></textarea>';

                                if ($_enableFormAddConvertDadosToDatabase)
                                    $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = $this->input->post("' . $_row['field_name'] . '",FALSE);';

                                if ($_enableFormEditConvertDadosToDatabase)
                                    $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = $this->input->post("' . $_row['field_name'] . '",FALSE);';

                                /* FORM ADD */
                                $this->_formAddCodeEditorJS .= "<!--" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= " * JQUERY SCRIPT - EDITOR DE TEXTO HTML - CKEDITOR" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "-->" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "<script>" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "    $(function(){" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "        CKEDITOR.replace('ckeditor-" . $_row['field_name'] . "', {" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "            height: ['" . $_param_formAddEditField['form_add_edit_field_editorhtml_ckeditor_line_height'] . "']" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "        });" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "    });" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "</script>" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "<!--" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= " * END JQUERY SCRIPT - EDITOR DE TEXTO HTML - CKEDITOR" . PHP_EOL;
                                $this->_formAddCodeEditorJS .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;

                                /* FORM EDIT */
                                $this->_formEditCodeEditorJS .= "<!--" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= " * JQUERY SCRIPT - EDITOR DE TEXTO HTML - CKEDITOR" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "-->" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "<script>" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "   $(function(){" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "       CKEDITOR.replace('ckeditor-" . $_row['field_name'] . "', {" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "           height: ['" . $_param_formAddEditField['form_add_edit_field_editorhtml_ckeditor_line_height'] . "']" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "       });" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "   });" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "</script>" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "<!--" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= " * END JQUERY SCRIPT - EDITOR DE TEXTO HTML - CKEDITOR" . PHP_EOL;
                                $this->_formEditCodeEditorJS .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'date'):

                                $this->_formAddEditConfigInput = '<input type="text" name="' . $_row['field_name'] . '" class="form-control datepicker j-mask-data-ptbr j-mask-' . $_row['field_name'] . '" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? bz_formatdata ($dados->' . $_row['field_name'] . ', "d/m/Y") : set_value ("' . $_row['field_name'] . '")); ?>" ' . $this->_formAddEditConfigInputAtributos . ' />';
                                $this->_formAddEditConfigInputMask .= '$(".j-mask-' . $_row['field_name'] . '").mask("00/00/0000", {placeholder: "__/__/____"});' . PHP_EOL;

                                if ($_enableFormAddConvertDadosToDatabase)
                                    $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = bz_formatdata($_dados["' . $_row['field_name'] . '"],"Y-m-d");' . PHP_EOL;
                                if ($_row['primary_key'] == 0):
                                    if ($_enableFormEditConvertDadosToDatabase)
                                        $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = bz_formatdata($_dados["' . $_row['field_name'] . '"],"Y-m-d");' . PHP_EOL;
                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'datetime'):

                                $this->_formAddEditConfigInput = '<input type="text" name="' . $_row['field_name'] . '" class="form-control datetimepicker j-mask-datahora-ptbr j-mask-' . $_row['field_name'] . '" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? bz_formatdata ($dados->' . $_row['field_name'] . ', "d/m/Y H:i:s") : set_value ("' . $_row['field_name'] . '")); ?>" ' . $this->_formAddEditConfigInputAtributos . ' />';
                                $this->_formAddEditConfigInputMask .= '$(".j-mask-' . $_row['field_name'] . '").mask("00/00/0000 00:00", {placeholder: "__/__/____ __:__"});' . PHP_EOL;

                                if ($_enableFormAddConvertDadosToDatabase)
                                    $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = bz_formatdata($_dados["' . $_row['field_name'] . '"],"Y-m-d H:i:s");' . PHP_EOL;
                                if ($_row['primary_key'] == 0):
                                    if ($_enableFormEditConvertDadosToDatabase)
                                        $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = bz_formatdata($_dados["' . $_row['field_name'] . '"],"Y-m-d H:i:s");' . PHP_EOL;
                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'time'):

                                $this->_formAddEditConfigInput = '<input type="text" name="' . $_row['field_name'] . '" class="form-control timepicker j-mask-hora-ptbr j-mask-' . $_row['field_name'] . '" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? bz_formatdata ($dados->' . $_row['field_name'] . ', "H:i:s") : set_value ("' . $_row['field_name'] . '")); ?>" ' . $this->_formAddEditConfigInputAtributos . ' />';
                                $this->_formAddEditConfigInputMask .= '$(".j-mask-' . $_row['field_name'] . '").mask("00:00", {placeholder: "__:__"});' . PHP_EOL;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'number'):

                                $this->_formAddEditConfigInput = '<input type="number" name="' . $_row['field_name'] . '" class="form-control" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" pattern="[0-9]" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0" ' . $this->_formAddEditConfigInputAtributos . ' />';

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'number-decimal'):

                                $this->_formAddEditConfigInput = '<input type="text" name="' . $_row['field_name'] . '" class="form-control ' . ((!empty($_param_formAddEditField['form_add_edit_field_mask'])) ? 'j-mask-' . $_row['field_name'] : '') . '" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 44 || event.charCode == 0" ' . $this->_formAddEditConfigInputAtributos . ' />';

                                if ($_enableFormAddConvertDadosToDatabase)
                                    $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = str_replace(",",".",str_replace(".","",$_dados["' . $_row['field_name'] . '"]));';
                                if ($_row['primary_key'] == 0):
                                    if ($_enableFormEditConvertDadosToDatabase)
                                        $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = str_replace(",",".",str_replace(".","",$_dados["' . $_row['field_name'] . '"]));';
                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'moeda'):

                                $this->_formAddEditConfigInput = '<input type="text" name="' . $_row['field_name'] . '" class="form-control j-mask-moeda-ptbr" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 44 || event.charCode == 0" ' . $this->_formAddEditConfigInputAtributos . ' />';

                                if ($_enableFormAddConvertDadosToDatabase)
                                    $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = str_replace(",",".",str_replace(".","",$_dados["' . $_row['field_name'] . '"]));';
                                if ($_row['primary_key'] == 0):
                                    if ($_enableFormEditConvertDadosToDatabase)
                                        $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = str_replace(",",".",str_replace(".","",$_dados["' . $_row['field_name'] . '"]));';
                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'email'):

                                $this->_formAddEditConfigInput = '<input type="text" name="' . $_row['field_name'] . '" class="form-control" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" ' . $this->_formAddEditConfigInputAtributos . ' />';

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'senha'):

                                $this->_formAddEditConfigInput = '<input type="password" name="' . $_row['field_name'] . '" class="form-control" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" ' . $this->_formAddEditConfigInputAtributos . ' />';

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-imagem'):

                                $_fileExtension = '.' . str_replace('|', ',.', $_param_formAddEditField['form_add_edit_field_upload_imagem_extensao_permitida']);

                                $this->task['multiUploadImagem'] = ((!empty($_param_formAddEditField['form_add_edit_active_multi_upload_imagem']) && $_param_formAddEditField['form_add_edit_active_multi_upload_imagem'] == 'on') ? 1 : 0);

                                /* $this->_formAddEditConfigInput = '<input type="file" name="' . $_row['field_name'] . '" class="form-control-file margin-bottom-10" placeholder="" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>"  />'; */


                                if ($this->task['multiUploadImagem']) {


                                    $this->_formAddEditConfigInput = '<input type="file" name="' . $_row['field_name'] . '[]" class="form-control-file margin-bottom-10" placeholder="" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" accept="' . $_fileExtension . '"  multiple/>' . PHP_EOL
                                            . '<?php if ($this->uri->segment (2) == "edit"): ?>' . PHP_EOL
                                            . ''
                                            . '     <?php $images = json_decode ($dados->' . $_row['field_name'] . '); ?>' . PHP_EOL
                                            . '     <?php $galleryID = mc_random_number (); ?>' . PHP_EOL
                                            . ''
                                            . '     <?php foreach ($images as $image): ?>' . PHP_EOL
                                            . '         <?php $_linkImg = base_url () . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . "' . $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . '/" . $image; ?>'
                                            . ''
                                            . '         <div class="pull-left margin-bottom-5 margin-right-10">' . PHP_EOL
                                            . '             <a class="" href="<?= $_linkImg; ?>" rel="lightbox[\' <?= $galleryID ?> \']">' . PHP_EOL
                                            . '                 <img class="img-thumbnail" style="width:150px; height: 100px; object-fit: cover;" src="<?= $_linkImg; ?>">' . PHP_EOL
                                            . '             </a>' . PHP_EOL
                                            . '             <div class="text-right text-normal mouse-cursor-pointer margin-right-5 j-btn-del-image" style="font-size:0.8em" data-image="<?= $image; ?>" data-id="<?= $dados->id; ?>">Excluir Imagem<i class="fa fa-trash text-normal margin-left-5"></i></div>' . PHP_EOL
                                            . '         </div>' . PHP_EOL
                                            . '     <?php endforeach ; ?>' . PHP_EOL
                                            . ''
                                            . '<?php else: ?>' . PHP_EOL
                                            . ''
                                            . '<?php endif; ?>' . PHP_EOL;


                                    if ($_enableFormAddConvertDadosToDatabase) {
                                        $this->_formAddConvertDadosToDatabase .= ""
                                                . "if( \$this->task['uploaded_image']==TRUE && !empty(\$this->task['files_uploaded']) ):" . PHP_EOL
                                                . "     \$_dados['" . $_row['field_name'] . "'] = json_encode(\$this->task['files_uploaded']);" . PHP_EOL
                                                . "endif;" . PHP_EOL
                                                . "";
                                    }



                                    $this->_controller_metodos_php .= ""
                                            . "/**" . PHP_EOL
                                            . " * DELETE IMAGE" . PHP_EOL
                                            . " */" . PHP_EOL
                                            . ""
                                            . "public function del_image() {" . PHP_EOL
                                            . "     /* CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX. */" . PHP_EOL
                                            . "     bz_check_is_ajax_request();" . PHP_EOL
                                            . ""
                                            . "     if (\$this->input->post('data')) {" . PHP_EOL
                                            . "         \$_data = \$this->input->post('data');" . PHP_EOL
                                            . "         \$_imageDel = \$_data['image'];" . PHP_EOL
                                            . "         \$_IdImageDel = \$_data['id'];" . PHP_EOL
                                            . "         \$_pathImage = '';" . PHP_EOL
                                            . ""
                                            . "         \$_data = \$this->read->exec(\$this->table_formaddedit_name, 'WHERE id=' . \$_IdImageDel)->row()->" . $_row['field_name'] . ";" . PHP_EOL
                                            . "         \$_data = json_decode(\$_data);" . PHP_EOL
                                            . ""
                                            . "         foreach (\$_data as \$key => \$image) {" . PHP_EOL
                                            . "             if (\$image == \$_imageDel) {" . PHP_EOL
                                            . "                 unset(\$_data[\$key]);" . PHP_EOL
                                            . "             }" . PHP_EOL
                                            . "         }" . PHP_EOL
                                            . ""
                                            . "         \$_data = array_values(\$_data);" . PHP_EOL
                                            . ""
                                            . "         \$_data = json_encode(\$_data);" . PHP_EOL
                                            . ""
                                            . "         \$_resultDelDB = \$this->update->exec(\$this->table_formaddedit_name, ['" . $_row['field_name'] . "' => \$_data], 'WHERE id=' . \$_IdImageDel);" . PHP_EOL
                                            . ""
                                            . "         if (\$_resultDelDB) {" . PHP_EOL
                                            . "             bz_delete_file(\$_imageDel, bz_absolute_path() . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . "/');" . PHP_EOL
                                            . "             \$json['message']['triggernotifi']['mensagem'] = 'Imagem excluida com sucesso.';" . PHP_EOL
                                            . "             \$json['message']['triggernotifi']['tipo'] = 'success';" . PHP_EOL
                                            . "             \$json['data'] = 'OK';" . PHP_EOL
                                            . "         } else {" . PHP_EOL
                                            . "             \$json['message']['triggernotifi']['mensagem'] = 'Erro ao excluir imagem.';" . PHP_EOL
                                            . "             \$json['message']['triggernotifi']['tipo'] = 'error';" . PHP_EOL
                                            . "             \$json['data'] = 'ERRO';" . PHP_EOL
                                            . "         }" . PHP_EOL
                                            . ""
                                            . "         echo json_encode(\$json);" . PHP_EOL
                                            . ""
                                            . "     }" . PHP_EOL
                                            . "}" . PHP_EOL
                                            . "/* END DELETE IMAGE */" . PHP_EOL;

                                    /**/
                                } else {

                                    $this->_formAddEditConfigInput = '<input type="file" name="' . $_row['field_name'] . '" class="form-control-file margin-bottom-10" placeholder="" value="<?= set_value("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" accept="' . $_fileExtension . '"  />' . PHP_EOL
                                            . '<?php if ($this->uri->segment (2) == "edit"): ?>' . PHP_EOL
                                            . '     <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2"><?= mc_image_thumb_modal ($dados->' . $_row['field_name'] . ', "' . $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . '"); ?></div>' . PHP_EOL
                                            /* . '     <div class="btn-ver-imagem margin-top-5 margin-bottom-5" style="font-size: 0.8em"><i class="fa fa-fw fa-camera"></i> <?= anchor (___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . "' . $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . ($_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] ? DIRECTORY_SEPARATOR : '') . '" . set_value ("imagem_nome", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")), "xxxxVer Imagem", "data-lightbox=\'' . $_row['field_name'] . '\'"); ?></div>' . PHP_EOL */
                                            . '     <input type="hidden" name="' . $_row['field_name'] . '" value="<?= $dados->' . $_row['field_name'] . '; ?>">' . PHP_EOL
                                            . '     ' . PHP_EOL
                                            . '<?php else: ?>' . PHP_EOL
                                            . '     ' . PHP_EOL
                                            . '     ' . PHP_EOL
                                            . '     ' . PHP_EOL
                                            . '<?php endif; ?>' . PHP_EOL;


                                    $this->_formAddConvertDadosToDatabase .= "" . PHP_EOL
                                            . "if( !empty(\$this->task['result_upload']['file_name']) ):" . PHP_EOL
                                            . "     \$_dados['" . $_row['field_name'] . "'] = \$this->task['result_upload']['file_name'];" . PHP_EOL
                                            . "endif;" . PHP_EOL
                                            . "";
                                }

                                $this->_formEditConvertDadosToDatabase .= $this->_formAddConvertDadosToDatabase;

                                if ($this->task['multiUploadImagem']):
                                    $this->_controller_DeleteFileFunction .= ""
                                            . "/**" . PHP_EOL
                                            . " * DELETA IMAGEM" . PHP_EOL
                                            . " */" . PHP_EOL
                                            . ""
                                            . "foreach (\$_dados as \$_value):" . PHP_EOL
                                            . "     \$_files = mc_findByIdDataDB(\$this->table_formaddedit_name, \$_value)->row()->" . $_row['field_name'] . ";" . PHP_EOL
                                            . "     \$_files = json_decode(\$_files);" . PHP_EOL
                                            . ""
                                            . "     foreach (\$_files as \$_file):" . PHP_EOL
                                            . "         bz_delete_file(\$_file, bz_absolute_path() . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . '" . ($_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] ? $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . DIRECTORY_SEPARATOR : $_param_formAddEditField['form_add_edit_field_upload_imagem_folder']) . "');" . PHP_EOL
                                            . "     endforeach;" . PHP_EOL
                                            . ""
                                            . "endforeach;" . PHP_EOL
                                            . ""
                                            . "/* END DELETA IMAGEM */" . PHP_EOL
                                            . ""
                                            . "";

                                else:

                                    $this->_controller_DeleteFileFunction .= "/**" . PHP_EOL
                                            . " * DELETA IMAGEM" . PHP_EOL
                                            . " */" . PHP_EOL
                                            . "foreach (\$_dados as \$_value):" . PHP_EOL
                                            . "     \$_file_name = mc_findByIdDataDB(\$this->table_formaddedit_name, \$_value)->row()->" . $_row['field_name'] . ";" . PHP_EOL
                                            . "     bz_delete_file(\$_file_name, bz_absolute_path() . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . '" . ($_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] ? $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . DIRECTORY_SEPARATOR : $_param_formAddEditField['form_add_edit_field_upload_imagem_folder']) . "');" . PHP_EOL
                                            . "endforeach;" . PHP_EOL
                                            . "/* END DELETA IMAGEM */";

                                    $this->_form_edit_unset_fields .= "/**" . PHP_EOL . PHP_EOL
                                            . " * DELETA IMAGEM" . PHP_EOL
                                            . " */" . PHP_EOL
                                            . "if (isset(\$this->task['uploaded_image']) && \$this->task['uploaded_image']) {" . PHP_EOL
                                            . "     \$_file_name = mc_findByIdDataDB(\$this->table_formaddedit_name, \$_id)->row()->" . $_row['field_name'] . ";" . PHP_EOL
                                            . "     bz_delete_file(\$_file_name, bz_absolute_path() . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . '" . ($_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] ? $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . DIRECTORY_SEPARATOR : $_param_formAddEditField['form_add_edit_field_upload_imagem_folder']) . "');" . PHP_EOL
                                            . "}" . PHP_EOL
                                            . "/* END DELETA IMAGEM */";
                                endif;

                            /**/

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-arquivo'):

                                $_fileExtension = '.' . str_replace('|', ',.', $_param_formAddEditField['form_add_edit_field_upload_arquivo_extensao_permitida']);

                                $this->_formAddEditConfigInput = '<input type="file" name="' . $_row['field_name'] . '" class="form-control-file margin-bottom-10" placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" value="<?= set_value ("' . $_row['field_name'] . '", isset ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")); ?>" ' . $this->_formAddEditConfigInputAtributos . ' accept="' . $_fileExtension . '" />' . PHP_EOL
                                        . '<?php if ($this->uri->segment (2) == "edit"): ?>' . PHP_EOL
                                        . '     <input type="hidden" name="' . $_row['field_name'] . '" value="<?= $dados->' . $_row['field_name'] . '; ?>" />' . PHP_EOL
                                        . '     <div id="" class=""><?= mc_file_link_download ($dados->' . $_row['field_name'] . ', "' . $_param_formAddEditField['form_add_edit_field_upload_arquivo_folder'] . '"); ?></div>' . PHP_EOL
                                        . '<?php else: ?>' . PHP_EOL
                                        . '     ' . PHP_EOL
                                        . '     ' . PHP_EOL
                                        . '     ' . PHP_EOL
                                        . '<?php endif; ?>' . PHP_EOL;

                                $this->_formAddConvertDadosToDatabase .= "if( !empty(\$this->task['result_upload']['file_name']) ):" . PHP_EOL
                                        . "     \$_dados['" . $_row['field_name'] . "'] = \$this->task['result_upload']['file_name'];" . PHP_EOL
                                        . "endif;";

                                $this->_formEditConvertDadosToDatabase .= $this->_formAddConvertDadosToDatabase;

                                $this->_controller_DeleteFileFunction = "/**" . PHP_EOL
                                        . " * DELETA ARQUIVO" . PHP_EOL
                                        . " */" . PHP_EOL
                                        . "foreach (\$_dados as \$_value):" . PHP_EOL
                                        . "     \$_file_name = mc_findByIdDataDB(\$this->table_formaddedit_name, \$_value)->row()->" . $_row['field_name'] . ";" . PHP_EOL
                                        . "     bz_delete_file(\$_file_name, bz_absolute_path() . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_FILE_DIR___ . '" . ($_param_formAddEditField['form_add_edit_field_upload_arquivo_folder'] ? $_param_formAddEditField['form_add_edit_field_upload_arquivo_folder'] . DIRECTORY_SEPARATOR : $_param_formAddEditField['form_add_edit_field_upload_arquivo_folder']) . "');" . PHP_EOL
                                        . "endforeach;" . PHP_EOL
                                        . "/* END DELETA ARQUIVO */";

                                $this->_form_edit_unset_fields .= "/**" . PHP_EOL . PHP_EOL
                                        . " * DELETA ARQUIVO" . PHP_EOL
                                        . " */" . PHP_EOL
                                        . "if (isset(\$this->task['uploaded_file']) && \$this->task['uploaded_file']) {" . PHP_EOL
                                        . "     \$_file_name = mc_findByIdDataDB(\$this->table_formaddedit_name, \$_id)->row()->" . $_row['field_name'] . ";" . PHP_EOL
                                        . "     bz_delete_file(\$_file_name, bz_absolute_path() . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_FILE_DIR___ . '" . ($_param_formAddEditField['form_add_edit_field_upload_arquivo_folder'] ? $_param_formAddEditField['form_add_edit_field_upload_arquivo_folder'] . DIRECTORY_SEPARATOR : $_param_formAddEditField['form_add_edit_field_upload_arquivo_folder']) . "');" . PHP_EOL
                                        . "}" . PHP_EOL
                                        . "/* END DELETA ARQUIVO */";

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'select-manual'):

                                $_selectValue = explode(',', $_param_formAddEditField['form_add_edit_field_value_select_manual']);
                                $_s = '';

                                foreach ($_selectValue as $_selectValue_value):
                                    $_s = explode('|', $_selectValue_value);
                                    $this->_formAddEditConfigInput .= '<option value="' . $_s[0] . '" <?= (set_value ("' . $_row['field_name'] . '", !empty ($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value ("' . $_row['field_name'] . '")) == "' . $_s[0] . '") ? "selected" : null; ?> />' . $_s[1] . '</option>' . PHP_EOL;
                                endforeach;

                                $_s = '<p class="margin-bottom-0">' . PHP_EOL;
                                $_s .= '<select name="' . $_row['field_name'] . '" class="form-control select2" data-placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" ' . $this->_formAddEditConfigInputAtributos . ' style="width:100%;"/>' . PHP_EOL;
                                $_s .= '<option value= ""/></option>' . PHP_EOL;
                                $_s .= $this->_formAddEditConfigInput;
                                $_s .= '</select>' . PHP_EOL;
                                $_s .= '</p>' . PHP_EOL;

                                $this->_formAddEditConfigInput = $_s;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'select-dinamic'):

                                if (!empty($_param_formAddEditField['form_add_edit_field_value_select_dinamic'])):

                                    $_param_formAddEditField["form_add_edit_field_value_select_dinamic"] = str_replace('"', "'", base64_decode($_param_formAddEditField["form_add_edit_field_value_select_dinamic"]));
                                    $_query = $this->db->query($_param_formAddEditField["form_add_edit_field_value_select_dinamic"])->result_array();
                                    $_r = '';

                                    if ($_query):

                                        $_r .= '<p style="margin-bottom: 0">' . PHP_EOL;
                                        $_r .= "<?php
                            " . PHP_EOL;
                                        $_r .= "\$_results_" . $_row['field_name'] . " = \$this->db->query (\"" . $_param_formAddEditField['form_add_edit_field_value_select_dinamic'] . "\");" . PHP_EOL;
                                        $_r .= "\$_last_query_" . $_row['field_name'] . " = strtolower(\$this->db->last_query());" . PHP_EOL;
                                        $_r .= "\$_options_" . $_row['field_name'] . " = \$_results_" . $_row['field_name'] . "->result_array();" . PHP_EOL;
                                        $_r .= "\$_options_" . $_row['field_name'] . " = \$_options_" . $_row['field_name'] . "[0];" . PHP_EOL;
                                        $_r .= "\$_keyOptions_" . $_row['field_name'] . " = array();" . PHP_EOL;
                                        $_r .= "\$_list_" . $_row['field_name'] . "[0] = '" . $_param_formAddEditField['form_add_edit_field_placeholder'] . "' ;" . PHP_EOL;
                                        $_r .= "foreach (\$_options_" . $_row['field_name'] . " as \$key => \$value_" . $_row['field_name'] . "):" . PHP_EOL;
                                        $_r .= "\$_keyOptions_" . $_row['field_name'] . "[] = \$key;" . PHP_EOL;
                                        $_r .= "endforeach;" . PHP_EOL;
                                        $_r .= "foreach (\$_results_" . $_row['field_name'] . "->result_array() as \$_r_" . $_row['field_name'] . "):" . PHP_EOL;
                                        $_r .= "\$_list_" . $_row['field_name'] . "[ \$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[0] ] ] = \$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[1] ];" . PHP_EOL;
                                        $_r .= "endforeach;" . PHP_EOL;
                                        $_r .= "echo form_dropdown('" . $_row['field_name'] . "', \$_list_" . $_row['field_name'] . ", set_value('" . $_row['field_name'] . "',isset(\$dados->" . $_row['field_name'] . ") ? \$dados->" . $_row['field_name'] . " : set_value('" . $_row['field_name'] . "')), 'class=\"form-control select2\" " . $this->_formAddEditConfigInputAtributos . " style=\"width:100%;\"');" . PHP_EOL;
                                        $_r .= "?>" . PHP_EOL;
                                        $_r .= "</p>" . PHP_EOL;

                                    endif;

                                    $this->_formAddEditConfigInput = $_r;

                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'select-multiple-manual'):

                                $_selectMultipleValue = explode(',', $_param_formAddEditField['form_add_edit_field_value_select_multiple_manual']);
                                $_s = '';

                                foreach ($_selectMultipleValue as $_selectMultipleValue_value):
                                    $_s = explode('|', $_selectMultipleValue_value);
                                    $this->_formAddEditConfigInput .= '<option value="' . $_s[0] . '" <?=(!empty($_select_multiple_manual_' . $_row['field_name'] . ')) ? ((in_array("' . $_s[0] . '",$_select_multiple_manual_' . $_row['field_name'] . ')) ? "selected" : "null") : "";?> />' . $_s[1] . '</option>' . PHP_EOL;
                                endforeach;

                                $_s = '<p class="margin-bottom-0">' . PHP_EOL;
                                $_s .= '<?php' . PHP_EOL;
                                $_s .= '$_select_multiple_manual_' . $_row['field_name'] . ' = "";' . PHP_EOL;
                                $_s .= 'if( !empty($this->input->post("' . $_row['field_name'] . '")) ):' . PHP_EOL;
                                $_s .= '$_select_multiple_manual_' . $_row['field_name'] . ' = $this->input->post("' . $_row['field_name'] . '") ;' . PHP_EOL;
                                $_s .= 'elseif( !empty($dados->' . $_row['field_name'] . ') ):' . PHP_EOL;
                                $_s .= '$_select_multiple_manual_' . $_row['field_name'] . ' = json_decode($dados->' . $_row['field_name'] . ');' . PHP_EOL;
                                $_s .= 'endif;' . PHP_EOL;
                                $_s .= '?>' . PHP_EOL;
                                $_s .= '<select name="' . $_row['field_name'] . '[]" style="width:100%" class="form-control select2-multiple-selection" multiple="true" data-placeholder="' . $_param_formAddEditField['form_add_edit_field_placeholder'] . '" ' . $this->_formAddEditConfigInputAtributos . ' />' . PHP_EOL;
                                $_s .= $this->_formAddEditConfigInput;
                                $_s .= '</select>' . PHP_EOL;
                                $_s .= '</p>' . PHP_EOL;

                                $this->_formAddEditConfigInput = $_s;

                                if ($_enableFormAddConvertDadosToDatabase)
                                    $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = json_encode($_dados["' . $_row['field_name'] . '"]);';
                                if ($_row['primary_key'] == 0):
                                    if ($_enableFormEditConvertDadosToDatabase)
                                        $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = json_encode($_dados["' . $_row['field_name'] . '"]);';
                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'select-multiple-dinamic'):

                                if (!empty($_param_formAddEditField['form_add_edit_field_value_select_multiple_dinamic'])):

                                    $_param_formAddEditField["form_add_edit_field_value_select_multiple_dinamic"] = str_replace('"', "'", base64_decode($_param_formAddEditField["form_add_edit_field_value_select_multiple_dinamic"]));
                                    $_query = $this->db->query($_param_formAddEditField["form_add_edit_field_value_select_multiple_dinamic"])->result_array();
                                    $_r = '';

                                    if ($_query):

                                        $_r .= '<p class="margin-bottom-0">' . PHP_EOL;
                                        $_r .= "<?php" . PHP_EOL;
                                        $_r .= "\$_results_" . $_row['field_name'] . " = \$this->db->query(\"" . $_param_formAddEditField['form_add_edit_field_value_select_multiple_dinamic'] . "\");" . PHP_EOL;
                                        $_r .= "\$_last_query_" . $_row['field_name'] . " = strtolower(\$this->db->last_query());" . PHP_EOL;
                                        $_r .= "\$_options_" . $_row['field_name'] . " = \$_results_" . $_row['field_name'] . "->result_array();" . PHP_EOL;
                                        $_r .= "\$_options_" . $_row['field_name'] . " = \$_options_" . $_row['field_name'] . "[0];" . PHP_EOL;
                                        $_r .= "\$_keyOptions_" . $_row['field_name'] . " = array();" . PHP_EOL;
                                        $_r .= "foreach (\$_options_" . $_row['field_name'] . " as \$key => \$value_" . $_row['field_name'] . "):" . PHP_EOL;
                                        $_r .= "\$_keyOptions_" . $_row['field_name'] . "[] = \$key;" . PHP_EOL;
                                        $_r .= "endforeach;" . PHP_EOL . PHP_EOL;

                                        $_r .= "\$_select_multiple_dinamic_" . $_row['field_name'] . " = '';" . PHP_EOL;
                                        $_r .= "if( !empty(\$this->input->post('" . $_row['field_name'] . "')) ):" . PHP_EOL;
                                        $_r .= "\$_select_multiple_dinamic_" . $_row['field_name'] . " = \$this->input->post('" . $_row['field_name'] . "');" . PHP_EOL;
                                        $_r .= "elseif( !empty(\$dados->" . $_row['field_name'] . ") ):" . PHP_EOL;
                                        $_r .= "\$_select_multiple_dinamic_" . $_row['field_name'] . " = json_decode(\$dados->" . $_row['field_name'] . ");" . PHP_EOL;
                                        $_r .= "endif;" . PHP_EOL . PHP_EOL;

                                        $_r .= "echo '<select name=\"" . $_row['field_name'] . "[]\" style=\"width:100%\" class=\"form-control select2-multiple-selection\" multiple=\"true\" data-placeholder=\"" . $_param_formAddEditField['form_add_edit_field_placeholder'] . "\" />' . PHP_EOL;" . PHP_EOL . PHP_EOL;

                                        $_r .= "foreach (\$_results_" . $_row['field_name'] . "->result_array() as \$_r_" . $_row['field_name'] . "):" . PHP_EOL;
                                        $_r .= "\$_list_" . $_row['field_name'] . "[ \$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[0] ] ] = \$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[1] ];" . PHP_EOL;
                                        $_r .= "?>" . PHP_EOL;
                                        $_r .= '<option value="<?=$_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[0] ];?>" <?=(!empty($_select_multiple_dinamic_' . $_row['field_name'] . ')) ? ((in_array($_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[0] ],$_select_multiple_dinamic_' . $_row['field_name'] . ')) ? "selected" : "null") : "";?>/> <?=$_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[1] ];?> </option><?=PHP_EOL;?>' . PHP_EOL;
                                        $_r .= "<?php" . PHP_EOL;
                                        $_r .= "endforeach;" . PHP_EOL;
                                        $_r .= "echo '</select>'. PHP_EOL;" . PHP_EOL;
                                        $_r .= "?>" . PHP_EOL;
                                        $_r .= "</p>" . PHP_EOL;

                                        if ($_enableFormAddConvertDadosToDatabase)
                                            $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = json_encode($_dados["' . $_row['field_name'] . '"]);';
                                        if ($_row['primary_key'] == 0):
                                            if ($_enableFormEditConvertDadosToDatabase)
                                                $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = json_encode($_dados["' . $_row['field_name'] . '"]);';
                                        endif;

                                    endif;

                                    $this->_formAddEditConfigInput = $_r;

                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'radio-manual'):

                                $_radioValue = explode(',', $_param_formAddEditField['form_add_edit_field_value_radiobutton_manual']);
                                $_r = "";

                                foreach ($_radioValue as $_radioValue_value):
                                    $_r = explode('|', $_radioValue_value);
                                    $this->_formAddEditConfigInput .= '<input class="flat-green" type="radio" name="' . $_row['field_name'] . '" value="' . $_r[0] . '" <?= ($_radiobutton_manual_' . $_row['field_name'] . '=="' . $_r[0] . '") ? "checked" : null ;?> ' . $this->_formAddEditConfigInputAtributos . '/> ' . $_r[1] . '<i class="margin-right-10"></i>' . PHP_EOL;
                                endforeach;

                                $_r = "" . PHP_EOL;
                                $_r .= "<?php" . PHP_EOL;
                                $_r .= "\$_radiobutton_manual_" . $_row['field_name'] . " = '';" . PHP_EOL;
                                $_r .= "if( !empty(\$this->input->post('" . $_row['field_name'] . "')) ):" . PHP_EOL;
                                $_r .= "\$_radiobutton_manual_" . $_row['field_name'] . " = \$this->input->post('" . $_row['field_name'] . "');" . PHP_EOL;
                                $_r .= "elseif( !empty(\$dados->" . $_row['field_name'] . ") ):" . PHP_EOL;
                                $_r .= "\$_radiobutton_manual_" . $_row['field_name'] . " = \$dados->" . $_row['field_name'] . ";" . PHP_EOL;
                                $_r .= "endif;" . PHP_EOL;
                                $_r .= "?>" . PHP_EOL . PHP_EOL;

                                $_r .= '<p class="margin-bottom-5">' . PHP_EOL . $this->_formAddEditConfigInput . PHP_EOL . '</p>';

                                $this->_formAddEditConfigInput = $_r;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'radio-dinamic'):

                                if (!empty($_param_formAddEditField['form_add_edit_field_value_radiobutton_dinamic'])):

                                    $_param_formAddEditField["form_add_edit_field_value_radiobutton_dinamic"] = str_replace('"', "'", base64_decode($_param_formAddEditField["form_add_edit_field_value_radiobutton_dinamic"]));
                                    $_query = $this->db->query($_param_formAddEditField["form_add_edit_field_value_radiobutton_dinamic"])->result_array();
                                    $_r = '';

                                    if ($_query):

                                        $_r .= '<p class="margin-bottom-5">' . PHP_EOL;
                                        $_r .= "<?php" . PHP_EOL;
                                        $_r .= "\$_results_" . $_row['field_name'] . " = \$this->db->query(\"" . $_param_formAddEditField['form_add_edit_field_value_radiobutton_dinamic'] . "\");" . PHP_EOL;
                                        $_r .= "\$_last_query_" . $_row['field_name'] . " = strtolower(\$this->db->last_query());" . PHP_EOL;
                                        $_r .= "\$_options_" . $_row['field_name'] . " = \$_results_" . $_row['field_name'] . "->result_array();" . PHP_EOL;
                                        $_r .= "\$_options_" . $_row['field_name'] . " = \$_options_" . $_row['field_name'] . "[0];" . PHP_EOL;
                                        $_r .= "\$_keyOptions_" . $_row['field_name'] . " = array();" . PHP_EOL;
                                        $_r .= "\$_list_" . $_row['field_name'] . "[0] = '" . $_param_formAddEditField['form_add_edit_field_placeholder'] . "' ;" . PHP_EOL;
                                        $_r .= "foreach (\$_options_" . $_row['field_name'] . " as \$key => \$value_" . $_row['field_name'] . "):" . PHP_EOL;
                                        $_r .= "\$_keyOptions_" . $_row['field_name'] . "[] = \$key;" . PHP_EOL;
                                        $_r .= "endforeach;" . PHP_EOL . PHP_EOL;

                                        $_r .= "\$_radiobutton_dinamic_" . $_row['field_name'] . " = '';" . PHP_EOL;
                                        $_r .= "if( !empty(\$this->input->post('" . $_row['field_name'] . "')) ):" . PHP_EOL;
                                        $_r .= "\$_radiobutton_dinamic_" . $_row['field_name'] . " = \$this->input->post('" . $_row['field_name'] . "') ;" . PHP_EOL;
                                        $_r .= "elseif( !empty(\$dados->" . $_row['field_name'] . ") ):" . PHP_EOL;
                                        $_r .= "\$_radiobutton_dinamic_" . $_row['field_name'] . " = \$dados->" . $_row['field_name'] . ";" . PHP_EOL;
                                        $_r .= "endif;" . PHP_EOL . PHP_EOL;

                                        $_r .= "foreach (\$_results_" . $_row['field_name'] . "->result_array() as \$_r_" . $_row['field_name'] . "):" . PHP_EOL;
                                        $_r .= "\$_list_" . $_row['field_name'] . "[ \$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[0] ] ] = \$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[1] ];" . PHP_EOL;
                                        $_r .= "?>" . PHP_EOL;
                                        $_r .= '<input class="flat-green" type="radio" name="' . $_row['field_name'] . '"  value="<?=$_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[0] ];?>" <?= ($_radiobutton_dinamic_' . $_row['field_name'] . '==$_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[0] ]) ? "checked" : null ;?> /> <?=$_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[1] ];?><i class="margin-right-10"></i>' . PHP_EOL;
                                        $_r .= "<?php" . PHP_EOL;
                                        $_r .= "endforeach;" . PHP_EOL;
                                        $_r .= "?>" . PHP_EOL;
                                        $_r .= "</p>" . PHP_EOL;

                                    endif;

                                    $this->_formAddEditConfigInput = $_r;

                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'checkbox-manual'):

                                $_r = "" . PHP_EOL;
                                $_r .= "<?php" . PHP_EOL;
                                $_r .= "\$_checkbox_manual_" . $_row['field_name'] . " = '';" . PHP_EOL;
                                $_r .= "if( !empty(\$this->input->post('" . $_row['field_name'] . "')) ):" . PHP_EOL;
                                $_r .= "\$_checkbox_manual_" . $_row['field_name'] . " = \$this->input->post('" . $_row['field_name'] . "') ;" . PHP_EOL;
                                $_r .= "elseif( !empty(\$dados->" . $_row['field_name'] . ") ):" . PHP_EOL;
                                $_r .= "\$_checkbox_manual_" . $_row['field_name'] . " = \$dados->" . $_row['field_name'] . ";" . PHP_EOL;
                                $_r .= "endif;" . PHP_EOL;
                                $_r .= "?>" . PHP_EOL . PHP_EOL;

                                $_r .= '<p class="margin-bottom-5">' . PHP_EOL . '<input class="flat-green" type="checkbox" name="' . $_row['field_name'] . '" value="' . $_param_formAddEditField['form_add_edit_field_value_checkbox_manual_on'] . '" <?= ($_checkbox_manual_' . $_row['field_name'] . '=="' . $_param_formAddEditField['form_add_edit_field_value_checkbox_manual_on'] . '") ? "checked" : null ;?> />' . PHP_EOL . '</p>';

                                $this->_formAddEditConfigInput .= $_r;

                                if ($_enableFormAddConvertDadosToDatabase)
                                    $this->_formAddConvertDadosToDatabase .= '(isset($_dados["' . $_row['field_name'] . '"])) ? ($_dados["' . $_row['field_name'] . '"] == "' . $_param_formAddEditField['form_add_edit_field_value_checkbox_manual_on'] . '") ? $_dados["' . $_row['field_name'] . '"] : "' . $_param_formAddEditField['form_add_edit_field_value_checkbox_manual_off'] . '" : "' . $_param_formAddEditField['form_add_edit_field_value_checkbox_manual_off'] . '";' . PHP_EOL;
                                if ($_row['primary_key'] == 0):
                                    if ($_enableFormEditConvertDadosToDatabase)
                                        $this->_formEditConvertDadosToDatabase .= '(isset($_dados["' . $_row['field_name'] . '"])) ? ($_dados["' . $_row['field_name'] . '"] == "' . $_param_formAddEditField['form_add_edit_field_value_checkbox_manual_on'] . '") ? $_dados["' . $_row['field_name'] . '"] : "' . $_param_formAddEditField['form_add_edit_field_value_checkbox_manual_off'] . '" : "' . $_param_formAddEditField['form_add_edit_field_value_checkbox_manual_off'] . '";' . PHP_EOL;
                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'checkbox-multiple-manual'):

                                $_checkboxMultipleValue = explode(',', $_param_formAddEditField['form_add_edit_field_value_checkbox_multiple_manual']);
                                $_c = '';
                                $_r = '';

                                foreach ($_checkboxMultipleValue as $_checkboxMultipleValue_value):
                                    $_c = explode('|', $_checkboxMultipleValue_value);
                                    $this->_formAddEditConfigInput .= '<input class="flat-green" type="checkbox" name="' . $_row['field_name'] . '[' . $_c[0] . ']" value="' . $_c[0] . '" <?= isset($_checkbox_multiple_manual_' . $_row['field_name'] . '["' . $_c[0] . '"]) ? (($_checkbox_multiple_manual_' . $_row['field_name'] . '["' . $_c[0] . '"]) == "' . $_c[0] . '") ? "checked" : null : null; ?> ' . $this->_formAddEditConfigInputAtributos . '/> ' . $_c[1] . '<i class="margin-right-10"></i>' . PHP_EOL;
                                endforeach;

                                $_r .= "" . PHP_EOL;
                                $_r .= "<?php" . PHP_EOL;
                                $_r .= "\$_checkbox_multiple_manual_" . $_row['field_name'] . " = '';" . PHP_EOL;
                                $_r .= "if( !empty(\$this->input->post('" . $_row['field_name'] . "')) ):" . PHP_EOL;
                                $_r .= "    \$_checkbox_multiple_manual_" . $_row['field_name'] . " = \$this->input->post('" . $_row['field_name'] . "');" . PHP_EOL;
                                $_r .= "elseif( !empty(\$dados->" . $_row['field_name'] . ") ):" . PHP_EOL;
                                $_r .= "    \$_checkbox_multiple_manual_" . $_row['field_name'] . " = json_decode(\$dados->" . $_row['field_name'] . ", true);" . PHP_EOL;
                                $_r .= "endif;" . PHP_EOL;
                                $_r .= "?>" . PHP_EOL . PHP_EOL;

                                $_r .= '<p class="margin-bottom-5">' . PHP_EOL . $this->_formAddEditConfigInput . PHP_EOL . '</p>' . PHP_EOL;

                                $this->_formAddEditConfigInput = $_r . PHP_EOL;

                                if ($_enableFormAddConvertDadosToDatabase)
                                    $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = json_encode($_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;
                                if ($_row['primary_key'] == 0):
                                    if ($_enableFormEditConvertDadosToDatabase)
                                        $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = json_encode($_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;
                                endif;

                            elseif ($_param_formAddEditField['form_add_edit_field_type'] == 'checkbox-multiple-dinamic'):

                                if (!empty($_param_formAddEditField['form_add_edit_field_value_checkbox_multiple_dinamic'])):

                                    $_param_formAddEditField["form_add_edit_field_value_checkbox_multiple_dinamic"] = str_replace('"', "'", base64_decode($_param_formAddEditField["form_add_edit_field_value_checkbox_multiple_dinamic"]));
                                    $_query = $this->db->query($_param_formAddEditField["form_add_edit_field_value_checkbox_multiple_dinamic"])->result_array();
                                    $_r = '';

                                    if ($_query):

                                        $_r .= '<p class="margin-bottom-5">' . PHP_EOL;
                                        $_r .= "<?php" . PHP_EOL;
                                        $_r .= "\$_results_" . $_row['field_name'] . " = \$this->db->query(\"" . $_param_formAddEditField['form_add_edit_field_value_checkbox_multiple_dinamic'] . "\");" . PHP_EOL;
                                        $_r .= "\$_last_query_" . $_row['field_name'] . " = strtolower(\$this->db->last_query());" . PHP_EOL;
                                        $_r .= "\$_options_" . $_row['field_name'] . " = \$_results_" . $_row['field_name'] . "->result_array();" . PHP_EOL;
                                        $_r .= "\$_options_" . $_row['field_name'] . " = \$_options_" . $_row['field_name'] . "[0];" . PHP_EOL;
                                        $_r .= "\$_keyOptions_" . $_row['field_name'] . " = array();" . PHP_EOL;
                                        $_r .= "\$_list_" . $_row['field_name'] . "[0] = '" . $_param_formAddEditField['form_add_edit_field_placeholder'] . "' ;" . PHP_EOL;
                                        $_r .= "foreach (\$_options_" . $_row['field_name'] . " as \$key => \$value_" . $_row['field_name'] . "):" . PHP_EOL;
                                        $_r .= "    \$_keyOptions_" . $_row['field_name'] . "[] = \$key;" . PHP_EOL;
                                        $_r .= "endforeach;" . PHP_EOL . PHP_EOL;

                                        $_r .= "\$_checkbox_multiple_dinamic_" . $_row['field_name'] . " = '';" . PHP_EOL;
                                        $_r .= "if( !empty(\$this->input->post('" . $_row['field_name'] . "')) ):" . PHP_EOL;
                                        $_r .= "    \$_checkbox_multiple_dinamic_" . $_row['field_name'] . " = \$this->input->post('" . $_row['field_name'] . "');" . PHP_EOL;
                                        $_r .= "elseif( !empty(\$dados->" . $_row['field_name'] . ") ):" . PHP_EOL;
                                        $_r .= "    \$_checkbox_multiple_dinamic_" . $_row['field_name'] . " = json_decode(\$dados->" . $_row['field_name'] . ", true);" . PHP_EOL;
                                        $_r .= "endif;" . PHP_EOL . PHP_EOL;

                                        $_r .= "foreach (\$_results_" . $_row['field_name'] . "->result_array() as \$_r_" . $_row['field_name'] . "):" . PHP_EOL;
                                        $_r .= "    \$_checked = '';" . PHP_EOL;
                                        $_r .= "    \$_lst_" . $_row['field_name'] . "[ \$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[0] ] ] = \$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[1] ];" . PHP_EOL;
                                        $_r .= "    if( \$_checkbox_multiple_dinamic_" . $_row['field_name'] . " ):" . PHP_EOL;
                                        $_r .= "        if (in_array(\$_r_" . $_row['field_name'] . "[ \$_keyOptions_" . $_row['field_name'] . "[0] ], \$_checkbox_multiple_dinamic_" . $_row['field_name'] . ")):" . PHP_EOL;
                                        $_r .= "            \$_checked = 'checked';" . PHP_EOL;
                                        $_r .= "        endif;" . PHP_EOL;
                                        $_r .= "    endif;" . PHP_EOL;
                                        $_r .= "    ?>" . PHP_EOL;

                                        $_r .= '    <input class="flat-green" type="checkbox" name="' . $_row['field_name'] . '[<?=$_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[1] ];?>]" value="<?=$_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[0] ];?>" <?= $_checked; ?> /> <?=$_r_' . $_row['field_name'] . '[ $_keyOptions_' . $_row['field_name'] . '[1] ];?><i class="margin-right-10"></i>' . PHP_EOL;

                                        $_r .= "    <?php" . PHP_EOL;
                                        $_r .= "endforeach;" . PHP_EOL;
                                        $_r .= "?>" . PHP_EOL;
                                        $_r .= "</p>" . PHP_EOL;

                                    endif;

                                    $this->_formAddEditConfigInput = $_r;

                                    if ($_enableFormAddConvertDadosToDatabase)
                                        $this->_formAddConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = json_encode($_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;
                                    if ($_row['primary_key'] == 0):
                                        if ($_enableFormEditConvertDadosToDatabase)
                                            $this->_formEditConvertDadosToDatabase .= '$_dados["' . $_row['field_name'] . '"] = json_encode($_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;
                                    endif;

                                    /**
                                     * SE O BOTÃO DE SOMENTE LEITURA DO CAMPO DO FORM ESTIVER LIGADO
                                     */
                                    if (!empty($_param_formAddEditField['form_add_edit_field_read_only']) && $_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'todos') {
                                        
                                    } elseif (!empty($_param_formAddEditField['form_add_edit_field_read_only']) && $_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formadd') {
                                        
                                    } elseif (!empty($_param_formAddEditField['form_add_edit_field_read_only']) && $_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formedit') {
                                        
                                    }





                                endif;

                            endif;

                            if (!empty($this->_formAddEditConfigInput)):

                                /*
                                 * MONTA O CAMPO GERADO COM AS LABELS E ATTRIBUTOS
                                 */

                                if (!empty($_param_formAddEditField['form_add_edit_field_hidden'])):
                                    if ($_param_formAddEditField['form_add_edit_field_hidden'] == 'on'):

                                        if ($_param_formAddEditField['form_add_edit_field_hidden_in_form'] == 'formadd'):
//echo '- > ' . $_row['field_name'] . ' - Hidden ONLY Form ADD';
                                            $this->_formAddEditConfigInputClassCSS .= ' hidden-formadd ';
                                        elseif ($_param_formAddEditField['form_add_edit_field_hidden_in_form'] == 'formedit'):
//echo '- > ' . $_row['field_name'] . ' - Hidden ONLY Form EDIT';
                                            $this->_formAddEditConfigInputClassCSS .= ' hidden-formedit ';
                                        else:
//echo '- > ' . $_row['field_name'] . ' - Hidden Todos';
                                            $this->_formAddEditConfigInputClassCSS .= ' hidden ';
                                        endif;

                                    /* $this->_formAddEditConfigInput = '';
                                      $this->_formAddEditFields .= '<input type="hidden" name="' . $_row['field_name'] . '" value="<?=set_value("' . $_row['field_name'] . '",!empty($dados->' . $_row['field_name'] . ') ? $dados->' . $_row['field_name'] . ' : set_value("' . $_row['field_name'] . '"));?>" />' . PHP_EOL; */
                                    endif;
                                endif;

//JQUERY MASK
                                if (isset($_param_formAddEditField['form_add_edit_field_mask'])):
                                    if (!empty($_param_formAddEditField['form_add_edit_field_mask'])):
                                        $this->_formAddEditConfigInputMask .= '$(".j-mask-' . $_row['field_name'] . '").mask("' . $_param_formAddEditField['form_add_edit_field_mask'] . '", ' . html_entity_decode(base64_decode($_param_formAddEditField['form_add_edit_field_mask_complement']), ENT_QUOTES) . ');' . PHP_EOL;
                                    endif;
                                endif;

//VALDATION ATRIBUTO EMAIL
                                if ($_param_formAddEditField['form_add_edit_field_type'] == 'email'):
                                    if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                        $this->_formAddEditConfigInputValidationAtributos .= 'valid_email|strtolower';
                                    else:
                                        $this->_formAddEditConfigInputValidationAtributos .= '|valid_email|strtolower';
                                    endif;
                                endif;

//VALDATION ATRIBUTO NÚMERO INTEIRO
                                if ($_param_formAddEditField['form_add_edit_field_type'] == 'number'):
                                    if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                        $this->_formAddEditConfigInputValidationAtributos .= 'numeric|integer';
                                    else:
                                        $this->_formAddEditConfigInputValidationAtributos .= '|numeric|integer';
                                    endif;
                                endif;

//VALDATION ATRIBUTO UPEPRCASE / LOWERCASE
                                if (isset($_param_formAddEditField['form_add_edit_field_convert_letter_into'])):
                                    if ($_param_formAddEditField['form_add_edit_field_convert_letter_into'] == 'uppercase'):
                                        if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                            $this->_formAddEditConfigInputValidationAtributos .= 'strtoupper';
                                        else:
                                            $this->_formAddEditConfigInputValidationAtributos .= '|strtoupper';
                                        endif;
                                    elseif ($_param_formAddEditField['form_add_edit_field_convert_letter_into'] == 'lowercase'):
                                        if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                            $this->_formAddEditConfigInputValidationAtributos .= 'strtolower';
                                        else:
                                            $this->_formAddEditConfigInputValidationAtributos .= '|strtolower';
                                        endif;

                                    endif;
                                endif;

//VALDATION ONLY NUMBERS, ONLY CHARACTERS OR ALL CHARACTERS
                                if (isset($_param_formAddEditField['form_add_edit_field_type_characters'])):
                                    if ($_param_formAddEditField['form_add_edit_field_type_characters'] == 'only_numbers'):
                                        if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                            $this->_formAddEditConfigInputValidationAtributos .= 'numeric';
                                        else:
                                            $this->_formAddEditConfigInputValidationAtributos .= '|numeric';
                                        endif;
                                    elseif ($_param_formAddEditField['form_add_edit_field_type_characters'] == 'only_letters'):
                                        if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                            $this->_formAddEditConfigInputValidationAtributos .= 'alpha';
                                        else:
                                            $this->_formAddEditConfigInputValidationAtributos .= '|alpha';
                                        endif;
                                    elseif ($_param_formAddEditField['form_add_edit_field_type_characters'] == 'letters_and_numbers'):
                                        if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                            $this->_formAddEditConfigInputValidationAtributos .= 'alpha_numeric';
                                        else:
                                            $this->_formAddEditConfigInputValidationAtributos .= '|alpha_numeric';
                                        endif;
                                    endif;
                                endif;

//VALDATION ATRIBUTO FIELD MIN LENGHT
                                if (isset($_param_formAddEditField['form_add_edit_field_min_length'])):
                                    if ($_param_formAddEditField['form_add_edit_field_min_length'] > 0):
                                        if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                            $this->_formAddEditConfigInputValidationAtributos .= 'min_length[' . $_param_formAddEditField['form_add_edit_field_min_length'] . ']';
                                        else:
                                            $this->_formAddEditConfigInputValidationAtributos .= '|min_length[' . $_param_formAddEditField['form_add_edit_field_min_length'] . ']';
                                        endif;
                                    endif;
                                endif;

//VALDATION ATRIBUTO FIELD MAX LENGHT
                                if (isset($_param_formAddEditField['form_add_edit_field_max_length'])):
                                    if ($_param_formAddEditField['form_add_edit_field_max_length'] > 0):
                                        if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                            $this->_formAddEditConfigInputValidationAtributos .= 'max_length[' . $_param_formAddEditField['form_add_edit_field_max_length'] . ']';
                                        else:
                                            $this->_formAddEditConfigInputValidationAtributos .= '|max_length[' . $_param_formAddEditField['form_add_edit_field_max_length'] . ']';
                                        endif;
                                    endif;
                                endif;

//VALDATION DATE
                                if (isset($_param_formAddEditField['form_add_edit_field_type'])):
                                    if ($_param_formAddEditField['form_add_edit_field_type'] == "date"):
                                        if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                            $this->_formAddEditConfigInputValidationAtributos .= 'date';
                                        else:
                                            $this->_formAddEditConfigInputValidationAtributos .= '|date';
                                        endif;
                                    endif;
                                endif;

                                if (!empty($_param_formAddEditField['form_add_edit_field_required'])):

                                    /* INPUT REQUIRED */
                                    if ($_param_formAddEditField['form_add_edit_field_required'] == 'on'):

                                        if (!empty($_param_formAddEditField['form_add_edit_field_read_only'])):
                                            if ($_param_formAddEditField['form_add_edit_field_read_only'] == 'on'):

                                                if ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'todos'):
                                                    echo '<br>todos' . '<br>';

                                                    $_classDisabledReadOnlyAsterisk = 'hide-all-form';
                                                    $this->_form_add_unset_fields .= 'unset($_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;
                                                    $this->_form_edit_unset_fields .= 'unset($_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;

                                                elseif ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formadd'):

                                                    echo '<br>ADD' . '<br>';
                                                    $_classDisabledReadOnlyAsterisk = 'hide-formadd';
                                                    $this->_form_add_unset_fields .= 'unset($_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;

                                                elseif ($_param_formAddEditField['form_add_edit_field_read_only_in_form'] == 'formedit'):

                                                    echo '<br>EDIT' . '<br>';
                                                    $_classDisabledReadOnlyAsterisk = 'hide-formedit';
                                                    $this->_form_edit_unset_fields .= 'unset($_dados["' . $_row['field_name'] . '"]);' . PHP_EOL;

                                                endif;

                                            endif;
                                        endif;

//echo '-- > ' . $_classDisabledReadOnlyAsterisk;

                                        $this->_formAddEditFields .= ''
                                                . '<?php $_error = form_error("' . $_row['field_name'] . '", "<small class=\'text-danger col-xs-12 bz-input-error\'>", "</small>"); ?>' . PHP_EOL
                                                . '<div id="' . $_row['field_name'] . '" class="form-group has-feedback ' . $this->_formAddEditConfigInputClassCSS . '">' . PHP_EOL
                                                . '<label for="' . $_row['field_name'] . '"><i class="fa fa-asterisk margin-right-5 text-error ' . $_classDisabledReadOnlyAsterisk . '" style="font-size: 0.7em;"></i>' . $_param_formAddEditField['form_add_edit_field_label'] . '</label>' . PHP_EOL
                                                . '' . $this->_formAddEditConfigInput . '' . PHP_EOL
                                                . '<?= $_error; ?>' . PHP_EOL
                                                . ' </div>' . PHP_EOL
                                                . '' . PHP_EOL . PHP_EOL . PHP_EOL;


                                        /* VALDATION ATRIBUTO REQUIRED */
                                        if ($_param_formAddEditField['form_add_edit_field_type'] == 'checkbox-multiple-manual' || $_param_formAddEditField['form_add_edit_field_type'] == 'checkbox-multiple-dinamic' || $_param_formAddEditField['form_add_edit_field_type'] == 'select-multiple-manual' || $_param_formAddEditField['form_add_edit_field_type'] == 'select-dinamic' || $_param_formAddEditField['form_add_edit_field_type'] == 'select-multiple-dinamic' || $_param_formAddEditField['form_add_edit_field_type'] == 'radio-dinamic'):

                                            if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                                $this->_formAddEditConfigInputValidationAtributos .= 'callback_validation_required_' . $_row["field_name"];
                                            else:
                                                $this->_formAddEditConfigInputValidationAtributos .= '|callback_validation_required_' . $_row["field_name"];
                                            endif;

                                            $this->_formAddEditConfigInputValidationCallback .= ""
                                                    . ""
                                                    . "/* VALIDAÇÃO POR CALLBACK DO CAMPO " . $_row["field_name"] . ". */" . PHP_EOL
                                                    . "public function validation_required_" . $_row["field_name"] . "() {" . PHP_EOL
                                                    . "     if (\$this->input->post('" . $_row["field_name"] . "')) return true;" . PHP_EOL
                                                    . "         \$this->form_validation->set_message('validation_required_" . $_row["field_name"] . "', 'O campo <b>" . $_param_formAddEditField['form_add_edit_field_label'] . "</b> é obrigatório.');" . PHP_EOL
                                                    . "         return false;" . PHP_EOL
                                                    . "     }" . PHP_EOL
                                                    . "/* END VALIDAÇÃO POR CALLBACK DO CAMPO " . $_row["field_name"] . ". */" . PHP_EOL . PHP_EOL . PHP_EOL;

                                        else:

                                            /**
                                             * VALIDAÇÃO PARA CAMPOS OBRIGATÓRIO
                                             */
                                            if ($_param_formAddEditField['form_add_edit_field_type'] != 'upload-imagem' && $_param_formAddEditField['form_add_edit_field_type'] != 'upload-arquivo'):

                                                if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                                    $this->_formAddEditConfigInputValidationAtributos .= 'required';
                                                else:
                                                    $this->_formAddEditConfigInputValidationAtributos .= '|required';
                                                endif;

                                            endif;

                                            /**
                                             * CALLBACK UPLOAD IMAGES - VALIDATION REQUIRED
                                             */
                                            if ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-imagem') {

                                                $this->_formAddEditConfigFormOpen = 'form_open_multipart';

                                                if ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-imagem'):
                                                    if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                                        $this->_formAddEditConfigInputValidationAtributos .= 'callback_validation_upload_images_' . $_row["field_name"];
                                                    else:
                                                        $this->_formAddEditConfigInputValidationAtributos .= '|callback_validation_upload_images_' . $_row["field_name"];
                                                    endif;

                                                    if ($this->task['multiUploadImagem']) {
                                                        $this->_formAddEditConfigInputValidationAtributos .= "[' . (!empty(\$_id) ? \$_id : '') . ']";
                                                    }


                                                endif;

                                                /**
                                                 * SE BOTÃO DE MULTI UPLOAD ESTIVER LIGADO ON
                                                 */
                                                if ($this->task['multiUploadImagem']) {

                                                    $this->_formAddEditConfigInputValidationCallback .= ""
                                                            . "/* VALIDAÇÃO POR CALLBACK MULTI UPLOAD DE IMAGENS " . $_row["field_name"] . ". */" . PHP_EOL
                                                            . "public function validation_upload_images_" . $_row["field_name"] . "(\$_str = NULL, \$_id = NULL) {" . PHP_EOL
                                                            . "     /**" . PHP_EOL
                                                            . "      * VALIDAÇÃO DE UPLOAD DE ARQUIVOS" . PHP_EOL
                                                            . "      */" . PHP_EOL
                                                            . ""
                                                            . "     /* REQUIRED */" . PHP_EOL
                                                            . "     \$_count = 0;" . PHP_EOL
                                                            . "     foreach (\$_FILES['" . $_row["field_name"] . "']['name'] as \$file){" . PHP_EOL
                                                            . "         if (\$file) {" . PHP_EOL
                                                            . "             \$_count++;" . PHP_EOL
                                                            . "         }" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . "     if (\$_count == 0) {" . PHP_EOL
                                                            . "         \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', 'Nenhuma imagem selecionada para ser enviada.');" . PHP_EOL
                                                            . "         return false;" . PHP_EOL
                                                            . "     }else if (\$_count > " . $_param_formAddEditField['form_add_edit_active_multi_upload_imagem_max_file'] . ") {" . PHP_EOL
                                                            . "         \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', 'Quantidade de imagens selecionadas é maior que o permitido. Quantidade máxima permitida é de " . $_param_formAddEditField['form_add_edit_active_multi_upload_imagem_max_file'] . " imagens.');" . PHP_EOL
                                                            . "         return false;" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . ""
                                                            . "     /* END REQUIRED */" . PHP_EOL
                                                            . ""
                                                            . "     /* ONLY IMAGES FILE */" . PHP_EOL
                                                            . "     \$_count = 0;" . PHP_EOL
                                                            . "     \$_total = 0;" . PHP_EOL
                                                            . "     foreach (\$_FILES['" . $_row["field_name"] . "']['type'] as \$type){" . PHP_EOL
                                                            . "         \$_total++;" . PHP_EOL
                                                            . "         if (strpos(\$type, 'image/') !== 0) {" . PHP_EOL
                                                            . "             \$_count++;" . PHP_EOL
                                                            . "         }" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . "     if (\$_count > 0) {" . PHP_EOL
                                                            . "         if (\$_total == 1) {" . PHP_EOL
                                                            . "             \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', 'Arquivo enviado não é um arquivo de imagem.');" . PHP_EOL
                                                            . "         } else {" . PHP_EOL
                                                            . "             \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', 'Algum arquivo enviado não é um arquivo de imagem.');" . PHP_EOL
                                                            . "         }" . PHP_EOL
                                                            . "         return false;" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . "     /* END ONLY IMAGES FILE */" . PHP_EOL
                                                            . ""
                                                            . "     /* SIZE FILE */" . PHP_EOL
                                                            . "     \$_count = 0;" . PHP_EOL
                                                            . "     \$_total = 0;" . PHP_EOL
                                                            . "     \$_fizeFile = " . $_param_formAddEditField['form_add_edit_field_upload_imagem_tamanho_maximo'] . ";" . PHP_EOL
                                                            . "     foreach (\$_FILES['" . $_row["field_name"] . "']['size'] as \$size){" . PHP_EOL
                                                            . "         \$_total++;" . PHP_EOL
                                                            . "         if ((\$size / 1000) > \$_fizeFile) {" . PHP_EOL
                                                            . "             \$_count++;"
                                                            . "         }" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . "     if (\$_count > 0) {" . PHP_EOL
                                                            . "         if (\$_total == 1) {" . PHP_EOL
                                                            . "             \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', 'Arquivo enviado tem tamanho maior que o permitido.');" . PHP_EOL
                                                            . "         } else {" . PHP_EOL
                                                            . "             \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', 'Algum arquivo enviado tem tamanho maior que o permitido.');" . PHP_EOL
                                                            . "         }" . PHP_EOL
                                                            . "         return false;" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . ""
                                                            . "     /* END SIZE FILE */" . PHP_EOL
                                                            . ""
                                                            . "     /* END VALIDAÇÃO DE UPLOAD DE ARQUIVO */" . PHP_EOL
                                                            . ""
                                                            . ""
                                                            . "     /* UPLOAD FILE */" . PHP_EOL
                                                            . ""
                                                            . "     \$_count = 0;" . PHP_EOL
                                                            . "     \$_count = count(\$_FILES['" . $_row["field_name"] . "']['name']);" . PHP_EOL
                                                            . "     \$_uploadFILES = \$_FILES;" . PHP_EOL
                                                            . "     \$_filesUploaded = [];" . PHP_EOL
                                                            . ""
                                                            . "     for (\$i = 0; \$i < \$_count; \$i++) {" . PHP_EOL
                                                            . ""
                                                            . "         \$_FILES = [];" . PHP_EOL
                                                            . "         \$_FILES['" . $_row["field_name"] . "']['name'] = \$_uploadFILES['" . $_row["field_name"] . "']['name'][\$i];" . PHP_EOL
                                                            . "         \$_FILES['" . $_row["field_name"] . "']['type'] = \$_uploadFILES['" . $_row["field_name"] . "']['type'][\$i];" . PHP_EOL
                                                            . "         \$_FILES['" . $_row["field_name"] . "']['tmp_name'] = \$_uploadFILES['" . $_row["field_name"] . "']['tmp_name'][\$i];" . PHP_EOL
                                                            . "         \$_FILES['" . $_row["field_name"] . "']['error'] = \$_uploadFILES['" . $_row["field_name"] . "']['error'][\$i];" . PHP_EOL
                                                            . "         \$_FILES['" . $_row["field_name"] . "']['size'] = \$_uploadFILES['" . $_row["field_name"] . "']['size'][\$i];" . PHP_EOL
                                                            . ""
                                                            . "     \$this->task['result_upload'] = bz_upload_file('" . $_row["field_name"] . "', ___CONF_UPLOAD_IMAGE_DIR___ . '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_extensao_permitida'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_tamanho_maximo'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_max_width'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_max_height'] . "');" . PHP_EOL
                                                            . ""
                                                            . "         if (isset(\$this->task['result_upload']['error'])) {" . PHP_EOL
                                                            . "             \$_path_file = bz_absolute_path() . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . '" . ($_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] ? $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . DIRECTORY_SEPARATOR : $_param_formAddEditField['form_add_edit_field_upload_imagem_folder']) . "';" . PHP_EOL
                                                            . "             \$_table_name = \$this->table_formaddedit_name;" . PHP_EOL
                                                            . "             \$_field_name = '" . $_row["field_name"] . "';" . PHP_EOL
                                                            . "             bz_delete_files_orphans(\$_path_file, \$_table_name, \$_field_name);" . PHP_EOL
                                                            . ""
                                                            . "             \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', \$this->task['result_upload']['error']['message']);" . PHP_EOL
                                                            . "             return false;" . PHP_EOL
                                                            . "         }" . PHP_EOL
                                                            . ""
                                                            . "         \$_filesUploaded[] = \$this->task['result_upload']['file_name'];" . PHP_EOL
                                                            . ""
                                                            . "     }" . PHP_EOL
                                                            . ""
                                                            . "     /* END UPLOAD FILE */" . PHP_EOL
                                                            . ""
                                                            . "     if (!empty(\$this->input->post('btn-editar')) && !empty(\$_id)) {" . PHP_EOL
                                                            . "         \$_json_" . $_row["field_name"] . " = \$this->read->exec(\$this->table_formaddedit_name, 'WHERE id=' . \$_id)->row()->" . $_row["field_name"] . ";" . PHP_EOL
                                                            . "         if (\$_json_" . $_row["field_name"] . ") {" . PHP_EOL
                                                            . "             \$_json_" . $_row["field_name"] . " = json_decode(\$_json_" . $_row["field_name"] . ");" . PHP_EOL
                                                            . "             \$this->task['files_uploaded'] = array_merge(\$_json_" . $_row["field_name"] . ", \$_filesUploaded);" . PHP_EOL
                                                            . "         }" . PHP_EOL
                                                            . "     } else {" . PHP_EOL
                                                            . "         \$this->task['files_uploaded'] = \$_filesUploaded;" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . ""
                                                            . "     \$this->task['uploaded_image'] = true;" . PHP_EOL
                                                            . ""
                                                            . "}" . PHP_EOL
                                                            . "/* END VALIDAÇÃO POR CALLBACK MULTI UPLOAD DE IMAGENS " . $_row["field_name"] . ". */" . PHP_EOL . PHP_EOL . PHP_EOL;
                                                } else {

                                                    /**
                                                     * SE BOTÃO DE MULTI UPLOAD ESTIVER DESLIGADO OFF
                                                     */
                                                    $this->_formAddEditConfigInputValidationCallback .= ""
                                                            . "/* VALIDAÇÃO POR CALLBACK UPLOAD DE IMAGENS " . $_row["field_name"] . ". */" . PHP_EOL
                                                            . ""
                                                            . "public function validation_upload_images_" . $_row["field_name"] . "() {" . PHP_EOL
                                                            . ""
                                                            . "     if (empty(\$_FILES['" . $_row["field_name"] . "']['name']) && !empty(\$this->input->post('" . $_row["field_name"] . "')) ) {" . PHP_EOL
                                                            . "         return true;" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . ""
                                                            . "     if (empty(\$_FILES['" . $_row["field_name"] . "']['name'])) {" . PHP_EOL
                                                            . "         \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', 'Nenhuma imagem selecionada para ser enviada.');" . PHP_EOL
                                                            . "         return false;" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . ""
                                                            . "     if (strpos(\$_FILES['" . $_row["field_name"] . "']['type'], 'image/') !== 0) {" . PHP_EOL
                                                            . "         \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', 'Este arquivo não é um arquivo de imagem.');" . PHP_EOL
                                                            . "         return false;" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . ""
                                                            . "     \$this->task['result_upload'] = bz_upload_file('" . $_row["field_name"] . "', ___CONF_UPLOAD_IMAGE_DIR___ . '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_extensao_permitida'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_tamanho_maximo'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_max_width'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_max_height'] . "');" . PHP_EOL
                                                            . ""
                                                            . "     if (isset(\$this->task['result_upload']['error'])) {" . PHP_EOL
                                                            . "         \$_path_file = bz_absolute_path() . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . '" . ($_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] ? $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . DIRECTORY_SEPARATOR : $_param_formAddEditField['form_add_edit_field_upload_imagem_folder']) . "';" . PHP_EOL
                                                            . "         \$_table_name = \$this->table_formaddedit_name;" . PHP_EOL
                                                            . "         \$_field_name = '" . $_row["field_name"] . "';" . PHP_EOL
                                                            . "         bz_delete_files_orphans(\$_path_file, \$_table_name, \$_field_name);" . PHP_EOL
                                                            . ""
                                                            . "         \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', \$this->task['result_upload']['error']['message']);" . PHP_EOL
                                                            . "         return false;" . PHP_EOL
                                                            . "     }" . PHP_EOL
                                                            . ""
                                                            . "     \$this->task['uploaded_image'] = true;" . PHP_EOL
                                                            . ""
                                                            . "}" . PHP_EOL
                                                            . "/* END VALIDAÇÃO POR CALLBACK UPLOAD DE IMAGENS " . $_row["field_name"] . ". */" . PHP_EOL . PHP_EOL;
                                                }
                                            }

                                            /**
                                             * CALLBACK UPLOAD FILES - VALIDATION REQUIRED
                                             */
                                            if ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-arquivo'):

                                                $this->_formAddEditConfigFormOpen = 'form_open_multipart';

                                                if ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-arquivo'):
                                                    if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                                        $this->_formAddEditConfigInputValidationAtributos .= 'callback_validation_upload_files_' . $_row["field_name"];
                                                    else:
                                                        $this->_formAddEditConfigInputValidationAtributos .= '|callback_validation_upload_files_' . $_row["field_name"];
                                                    endif;
                                                endif;

                                                $this->_formAddEditConfigInputValidationCallback .= "
																											                                                 /* VALIDAÇÃO POR CALLBACK UPLOAD DE ARQUIVOS " . $_row["field_name"] . ". */
																											                                                  public function validation_upload_files_" . $_row["field_name"] . "() {

																											                                                        if (empty(\$_FILES['" . $_row["field_name"] . "']['name']) && !empty(\$this->input->post('" . $_row["field_name"] . "')) ) {
																											                                                            return true;
																											                                                        }

																											                                                        if (empty(\$_FILES['" . $_row["field_name"] . "']['name'])) {
																											                                                            \$this->form_validation->set_message('validation_upload_files_" . $_row["field_name"] . "', 'Nenhuma arquivo selecionado para ser enviado.');
																											                                                            return false;
																											                                                        }

																											                                                        \$this->task['result_upload'] = bz_upload_file('" . $_row["field_name"] . "', ___CONF_UPLOAD_FILE_DIR___ . '" . $_param_formAddEditField['form_add_edit_field_upload_arquivo_folder'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_arquivo_extensao_permitida'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_arquivo_tamanho_maximo'] . "', '', '');

																											                                                        if (isset(\$this->task['result_upload']['error'])) {
																											                                                            \$this->form_validation->set_message('validation_upload_files_" . $_row["field_name"] . "', \$this->task['result_upload']['error']['message']);
																											                                                            return false;
																											                                                        }

																											                                                        \$this->task['uploaded_file'] = true;
																											                                                  }
																											                                                  /* END VALIDAÇÃO POR CALLBACK UPLOAD DE ARQUIVOS " . $_row["field_name"] . ". */" . PHP_EOL . PHP_EOL . PHP_EOL;
                                            endif;

                                        endif;

                                    else:

                                        /* INPUT NOT REQUIRED */
                                        $this->_formAddEditFields .= '
																					                                                <?php $_error = form_error("' . $_row['field_name'] . '", "<small class=\'text-danger col-xs-12 bz-input-error\'>", "</small>"); ?>
																					                                                <div id="' . $_row['field_name'] . '" class="form-group has-feedback ' . $this->_formAddEditConfigInputClassCSS . '">
																					                                                    <label for="' . $_row['field_name'] . '">' . $_param_formAddEditField['form_add_edit_field_label'] . '</label>
																					                                                    ' . $this->_formAddEditConfigInput . '
																					                                                    <?= $_error; ?>
																					                                                </div>
																					                                                ' . PHP_EOL;

                                    endif;

                                else:

                                    /**
                                     * CALLBACK UPLOAD IMAGES - NOT REQUIRED
                                     */
                                    if ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-imagem'):

                                        $this->_formAddEditConfigFormOpen = 'form_open_multipart';

                                        if ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-imagem'):
                                            if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                                $this->_formAddEditConfigInputValidationAtributos .= 'callback_validation_upload_images_' . $_row["field_name"];
                                            else:
                                                $this->_formAddEditConfigInputValidationAtributos .= '|callback_validation_upload_images_' . $_row["field_name"];
                                            endif;
                                        endif;

                                        $this->_formAddEditConfigInputValidationCallback .= "
																					                                                 /* VALIDAÇÃO POR CALLBACK UPLOAD DE IMAGENS " . $_row["field_name"] . ". */
																					                                                  public function validation_upload_images_" . $_row["field_name"] . "() {
																					                                                      if (!empty(\$_FILES['" . $_row["field_name"] . "']['name'])) {
																					                                                            \$this->task['result_upload'] = bz_upload_file('" . $_row["field_name"] . "', ___CONF_UPLOAD_IMAGE_DIR___ . '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_folder'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_extensao_permitida'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_tamanho_maximo'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_max_width'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_imagem_max_height'] . "');

																					                                                            if (strpos(\$_FILES['" . $_row["field_name"] . "']['type'], 'image/') !== 0) {
																					                                                                \$this->form_validation->set_message('validation_upload_images_imagem_nome', 'Este arquivo não é um arquivo de imagem.');
																					                                                                return false;
																					                                                            }


																					                                                            if (isset(\$this->task['result_upload']['error'])) {
																					                                                                \$this->form_validation->set_message('validation_upload_images_" . $_row["field_name"] . "', \$this->task['result_upload']['error']['message']);
																					                                                                return false;
																					                                                            }

																					                                                            \$this->task['uploaded_image'] = true;
																					                                                      }
																					                                                  }
																					                                                  /* END VALIDAÇÃO POR CALLBACK UPLOAD DE IMAGENS " . $_row["field_name"] . ". */" . PHP_EOL . PHP_EOL . PHP_EOL;
                                    endif;

                                    /**
                                     * CALLBACK UPLOAD FILES - NOT REQUIRED
                                     */
                                    if ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-arquivo'):

                                        $this->_formAddEditConfigFormOpen = 'form_open_multipart';

                                        if ($_param_formAddEditField['form_add_edit_field_type'] == 'upload-arquivo'):
                                            if (empty($this->_formAddEditConfigInputValidationAtributos)):
                                                $this->_formAddEditConfigInputValidationAtributos .= 'callback_validation_upload_files_' . $_row["field_name"];
                                            else:
                                                $this->_formAddEditConfigInputValidationAtributos .= '|callback_validation_upload_files_' . $_row["field_name"];
                                            endif;
                                        endif;

                                        $this->_formAddEditConfigInputValidationCallback .= "
																					                                                 /* VALIDAÇÃO POR CALLBACK UPLOAD DE ARQUIVOS " . $_row["field_name"] . ". */
																					                                                  public function validation_upload_files_" . $_row["field_name"] . "() {
																					                                                      if (!empty(\$_FILES['" . $_row["field_name"] . "']['name'])) {
																					                                                            \$this->task['result_upload'] = bz_upload_file('" . $_row["field_name"] . "', ___CONF_UPLOAD_FILE_DIR___ . '" . $_param_formAddEditField['form_add_edit_field_upload_arquivo_folder'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_arquivo_extensao_permitida'] . "', '" . $_param_formAddEditField['form_add_edit_field_upload_arquivo_tamanho_maximo'] . "', '', '');

																					                                                            if (isset(\$this->task['result_upload']['error'])) {
																					                                                                \$this->form_validation->set_message('validation_upload_files_" . $_row["field_name"] . "', \$this->task['result_upload']['error']['message']);
																					                                                                return false;
																					                                                            }

																					                                                            \$this->task['uploaded_file'] = true;
																					                                                      }
																					                                                  }
																					                                                  /* END VALIDAÇÃO POR CALLBACK UPLOAD DE ARQUIVOS " . $_row["field_name"] . ". */" . PHP_EOL . PHP_EOL . PHP_EOL;
                                    endif;

                                    /* INPUT NOT REQUIRED */
                                    $this->_formAddEditFields .= '
																		                                            <?php $_error = form_error("' . $_row['field_name'] . '", "<small class=\'text-danger col-xs-12 bz-input-error\'>", "</small>"); ?>
																		                                            <div id="' . $_row['field_name'] . '" class="form-group has-feedback ' . $this->_formAddEditConfigInputClassCSS . '">
																		                                                <label for="' . $_row['field_name'] . '">' . $_param_formAddEditField['form_add_edit_field_label'] . '</label>
																		                                                ' . $this->_formAddEditConfigInput . '
																		                                                <?= $_error; ?>
																		                                            </div>
																		                                            ' . PHP_EOL;

                                endif;

                                /*
                                 * MONTA AS VALIDAÇÕES DOS CAMPOS
                                 */
                                //echo 'AAA-> ' . $_row['field_name'] . ' - Required : ' . (isset($_param_formAddEditField['form_add_edit_field_required']) ? $_param_formAddEditField['form_add_edit_field_required'] : 'OFF') . ' - XX: ' . $_param_formAddEditField['form_add_edit_field_required_in_form'];

                                if (!empty($_param_formAddEditField['form_add_edit_field_required_in_form'])):

                                    if ($_param_formAddEditField['form_add_edit_field_required_in_form'] == 'formadd'):

                                        $this->_formAddConfigInputValidationAtributos = $this->_formAddEditConfigInputValidationAtributos;

                                    //echo 'FORM ADD<br><br>';
                                    else:
                                    //$this->_formAddConfigInputValidationAtributos = str_replace('required', 'add-required', $this->_formAddConfigInputValidationAtributos);
                                    endif;
                                endif;

                                if (!empty($_param_formAddEditField['form_add_edit_field_required_in_form'])):
                                    if ($_param_formAddEditField['form_add_edit_field_required_in_form'] == 'formedit'):

                                        $this->_formEditConfigInputValidationAtributos = $this->_formAddEditConfigInputValidationAtributos;

//echo 'FORM EDIT<br><br>';
                                    else:
//$this->_formEditConfigInputValidationAtributos = str_replace('required', 'edit-required', $this->_formEditConfigInputValidationAtributos);
                                    endif;
                                endif;

                                if (!empty($_param_formAddEditField['form_add_edit_field_required_in_form'])):
                                    if ($_param_formAddEditField['form_add_edit_field_required_in_form'] == 'todos'):

                                        $this->_formAddConfigInputValidationAtributos = $this->_formAddEditConfigInputValidationAtributos;
                                        $this->_formEditConfigInputValidationAtributos = $this->_formAddEditConfigInputValidationAtributos;

                                    endif;
                                endif;

                                if (!empty($this->_formAddConfigInputValidationAtributos)):
                                    $this->_formAddConfigInputValidation .= "\$this->form_validation->set_rules('" . $_row['field_name'] . "', '<b>" . $_param_formAddEditField['form_add_edit_field_label'] . "</b>', '" . $this->_formAddConfigInputValidationAtributos . "');" . PHP_EOL;
                                endif;

                                if (!empty($this->_formEditConfigInputValidationAtributos)):
                                    $this->_formEditConfigInputValidation .= "\$this->form_validation->set_rules('" . $_row['field_name'] . "', '<b>" . $_param_formAddEditField['form_add_edit_field_label'] . "</b>', '" . $this->_formEditConfigInputValidationAtributos . "');" . PHP_EOL;
                                endif;

                            endif;

                            /**
                             * DADOS FILLABLE
                             */
                            if ($_geraFormAddDadosFillable) {
                                $this->_formAddDadosFillable .= 'if( !empty( $_dadosFillable["' . $_row['field_name'] . '"] ) ){' . PHP_EOL
                                        . '     $_dados["' . $_row['field_name'] . '"] = $_dadosFillable["' . $_row['field_name'] . '"];' . PHP_EOL
                                        . '}else{' . PHP_EOL
                                        . '     $_dados["' . $_row['field_name'] . '"] = NULL;' . PHP_EOL
                                        . '}' . PHP_EOL . PHP_EOL;
                            }

                            if ($_geraFormEditDadosFillable) {
                                $this->_formEditDadosFillable .= 'if( !empty( $_dadosFillable["' . $_row['field_name'] . '"] ) ){' . PHP_EOL
                                        . '     $_dados["' . $_row['field_name'] . '"] = $_dadosFillable["' . $_row['field_name'] . '"];' . PHP_EOL
                                        . '}else{' . PHP_EOL
                                        . '     $_dados["' . $_row['field_name'] . '"] = NULL;' . PHP_EOL
                                        . '}' . PHP_EOL . PHP_EOL;
                            }

                        endif;
                        /* END CAMPOS QUE SERÃO MOSTRADOS NO FORM ADD/EDIT */

                    endforeach;

                    /*
                     * DIVIDE OS formAddEditFields
                     */
                    $this->_formAddFields = $this->_formAddEditFields;
                    $this->_formEditFields = $this->_formAddEditFields;
                    /* END DIVIDE OS formAddEditFields */

                    /**
                     * GERA CLAUSULA WHERE PARA GRAVAÇÃO DO FORM EDIT/UPDATE
                     */
                    $this->_formEditWhereUpdateFields = "'WHERE " . $this->_primary_key_field . " = \"'.\$_id.'\"';";
                    /* END GERA CLAUSULA WHERE PARA GRAVAÇÃO DO FORM EDIT/UPDATE */

                    /**
                     * JQUERY MASK
                     */
                    if (!empty($this->_formAddEditConfigInputMask)):
                        $_r_jquery_mask = "<!--" . PHP_EOL;
                        $_r_jquery_mask .= " * JQUERY MASK" . PHP_EOL;
                        $_r_jquery_mask .= "-->" . PHP_EOL;
                        $_r_jquery_mask .= "<script>" . PHP_EOL . PHP_EOL;
                        $_r_jquery_mask .= "$(function(){" . PHP_EOL . PHP_EOL;
                        $_r_jquery_mask .= $this->_formAddEditConfigInputMask . PHP_EOL;
                        $_r_jquery_mask .= "});" . PHP_EOL . PHP_EOL;
                        $_r_jquery_mask .= "</script>" . PHP_EOL;
                        $_r_jquery_mask .= "<!--" . PHP_EOL;
                        $_r_jquery_mask .= " * END JQUERY MASK" . PHP_EOL;
                        $_r_jquery_mask .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;
                        $this->_formAddEditConfigInputMask = $_r_jquery_mask;
                    endif;
                    /* END JQUERY MASK */

                    /*
                     * GET CODE EDITOR METODOS PHP CONTROLLER
                     */
                    $_where_getCode_ControllerMetodosPHP = array('proj_build_id' => $this->_project_id,
                        'code_type' => 'evento-php',
                    );
                    $this->db->order_by('code_screen DESC');
                    $_query_getCode_ControllerMetodosPHP = $this->db->get_where('proj_build_codeeditor', $_where_getCode_ControllerMetodosPHP)->result();

                    foreach ($_query_getCode_ControllerMetodosPHP as $_row_getCode_ControllerMetodosPHP):
                        if (!empty(trim($_row_getCode_ControllerMetodosPHP->code_script))):

                            if ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onScriptInit') {
                                $this->_controller_onScriptinit = "\$this->fcn_onScriptinit();" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onBeforeInsert') {
                                $this->_controller_onBeforeInsert = "\$this->fcn_onBeforeInsert(array('post' => \$this->input->post()));" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onAfterInsert') {
                                $this->_controller_onAfterInsert = "\$this->fcn_onAfterInsert(array('result' => \$result, 'post' => \$this->input->post()));" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onBeforeUpdate') {
                                $this->_controller_onBeforeUpdate = "\$this->fcn_onBeforeUpdate(array('id' => \$_id, 'post' => \$this->input->post()));" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onAfterUpdate') {
                                $this->_controller_onAfterUpdate = "\$this->fcn_onAfterUpdate(array('result' => \$_result_update, 'post' => \$this->input->post()));" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onBeforeDelete') {
                                $this->_controller_onBeforeDelete = "\$this->fcn_onBeforeDelete(array('post' => \$this->input->post()));" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onAfterDelete') {
                                $this->_controller_onAfterDelete = "\$this->fcn_onAfterDelete(array('post' => \$this->input->post()));" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onScriptInitExport') {
                                $this->_controller_onScriptInitExport = "\$this->fcn_onScriptInitExport();" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onScriptBeforeExport') {
                                $this->_controller_onScriptBeforeExport = "\$this->fcn_onScriptBeforeExport();" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onScriptAfterExport') {
                                $this->_controller_onScriptAfterExport = "\$this->fcn_onScriptAfterExport();" . PHP_EOL;
                            } elseif ($_row_getCode_ControllerMetodosPHP->code_screen == 'fcn_onScriptEndExport') {
                                $this->_controller_onScriptEndExport = "\$this->fcn_onScriptEndExport();" . PHP_EOL;
                            }

                            $this->_controller_metodos_php .= "/* METODO PHP - " . $_row_getCode_ControllerMetodosPHP->code_screen . ' */' . PHP_EOL;
                            $this->_controller_metodos_php .= "private function " . $_row_getCode_ControllerMetodosPHP->code_screen . '($_p = null) {' . PHP_EOL;
                            $this->_controller_metodos_php .= html_entity_decode(base64_decode($_row_getCode_ControllerMetodosPHP->code_script), ENT_QUOTES) . PHP_EOL;
                            $this->_controller_metodos_php .= "}" . PHP_EOL;
                            $this->_controller_metodos_php .= "/* END METODO PHP - " . $_row_getCode_ControllerMetodosPHP->code_screen . ' */' . PHP_EOL . PHP_EOL;
                        endif;
                    endforeach;
                    /* END GET CODE EDITOR METODOS PHP CONTROLLER */

                    /*
                     * GET CODE EDITOR METODOS PHP CONTROLLER
                     */
                    $_where_getCode_ControllerMetodosPHP = array(
                        'proj_build_id' => $this->_project_id, 'code_type' => 'metodo-php',);
                    $_query_getCode_ControllerMetodosPHP = $this->db->get_where('proj_build_codeeditor', $_where_getCode_ControllerMetodosPHP)->result();
                    foreach ($_query_getCode_ControllerMetodosPHP as $_row_getCode_ControllerMetodosPHP):
                        if (!empty(trim($_row_getCode_ControllerMetodosPHP->code_script))):
                            $this->_controller_metodos_php .= "/* METODO PHP - " . $_row_getCode_ControllerMetodosPHP->code_screen . ' */' . PHP_EOL;

                            if ($_row_getCode_ControllerMetodosPHP->code_access_ajax_only == 1) {

                                $this->_controller_metodos_php .= "public function " . $_row_getCode_ControllerMetodosPHP->code_screen . '($_p = null) {' . PHP_EOL;

                                $this->_controller_metodos_php .= '/*' . PHP_EOL;
                                $this->_controller_metodos_php .= ' * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.' . PHP_EOL;
                                $this->_controller_metodos_php .= ' */' . PHP_EOL;
                                $this->_controller_metodos_php .= 'bz_check_is_ajax_request();' . PHP_EOL;
                                $this->_controller_metodos_php .= '/* END CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX. */' . PHP_EOL;
                                $this->_controller_metodos_php .= '/**/' . PHP_EOL;
                            } else {

                                $this->_controller_metodos_php .= $_row_getCode_ControllerMetodosPHP->code_type_method . " function " . $_row_getCode_ControllerMetodosPHP->code_screen . '($_p = null) {' . PHP_EOL;
                            }

                            $this->_controller_metodos_php .= html_entity_decode(base64_decode($_row_getCode_ControllerMetodosPHP->code_script), ENT_QUOTES) . PHP_EOL;
                            $this->_controller_metodos_php .= "}" . PHP_EOL;
                            $this->_controller_metodos_php .= "/* END METODO PHP - " . $_row_getCode_ControllerMetodosPHP->code_screen . ' */' . PHP_EOL . PHP_EOL;
                        endif;


                    endforeach;
                    /* END GET CODE EDITOR METODOS PHP CONTROLLER */

                    /*
                     * GET CODE EDITOR METODOS PHP MODELS
                     */
                    $_where_getCode_ModelsMetodosPHP = array(
                        'proj_build_id' => $this->_project_id,
                        'code_type' => 'model-php',);
                    $_query_getCode_ModelsMetodosPHP = $this->db->get_where('proj_build_codeeditor', $_where_getCode_ModelsMetodosPHP)->result();
                    foreach ($_query_getCode_ModelsMetodosPHP as $_row_getCode_ModelsMetodosPHP):
                        if (!empty(trim($_row_getCode_ModelsMetodosPHP->code_script))):
                            $this->_models_metodos_php .= "/* MODELS PHP - " . $_row_getCode_ModelsMetodosPHP->code_screen . ' */' . PHP_EOL;
                            $this->_models_metodos_php .= "public function " . $_row_getCode_ModelsMetodosPHP->code_screen . '($_p = null) {' . PHP_EOL;
                            $this->_models_metodos_php .= html_entity_decode(base64_decode($_row_getCode_ModelsMetodosPHP->code_script), ENT_QUOTES) . PHP_EOL;
                            $this->_models_metodos_php .= "}" . PHP_EOL;
                            $this->_models_metodos_php .= "/* END MODELS PHP - " . $_row_getCode_ModelsMetodosPHP->code_screen . ' */' . PHP_EOL . PHP_EOL;
                        endif;
                    endforeach;
                    /* END GET CODE EDITOR METODOS PHP MODELS */

                    /*
                     * GET CODE EDITOR ON RECORD
                     */
                    $_where_getCode_onRecord = array(
                        'proj_build_id' => $this->_project_id,
                        'code_type' => 'onrecord',
                    );
                    $_query_getCode_onRecord = $this->db->get_where('proj_build_codeeditor', $_where_getCode_onRecord)->result();
                    foreach ($_query_getCode_onRecord as $_row_getCode_onRecord):
                        if (!empty(trim($_row_getCode_onRecord->code_script))):
                            $this->_gridListCodeEditorOnRecord .= "/* ON RECORD */" . PHP_EOL;
                            $this->_gridListCodeEditorOnRecord .= html_entity_decode(base64_decode($_row_getCode_onRecord->code_script), ENT_QUOTES) . PHP_EOL;
                            $this->_gridListCodeEditorOnRecord .= "/* END ON RECORD */" . PHP_EOL . PHP_EOL;
                        endif;
                    endforeach;
//END GET CODE EDITOR ON RECORD

                    /*
                     * GET CODE EDITOR ON RECORD EXPORT
                     */
                    $_where_getCode_onRecordExport = array(
                        'proj_build_id' =>
                        $this->_project_id, 'code_type' => 'onrecordexport',
                    );
                    $_query_getCode_onRecordExport = $this->db->get_where(' proj_build_codeeditor', $_where_getCode_onRecordExport)->result();
                    foreach ($_query_getCode_onRecordExport as $_row_getCode_onRecordExport):
                        if (!empty(trim($_row_getCode_onRecordExport->code_script))):
                            $this->_exportCodeEditorOnRecord .= "/* ON RECORD EXPORT */" . PHP_EOL;
                            $this->_exportCodeEditorOnRecord .= html_entity_decode(base64_decode($_row_getCode_onRecordExport->code_script), ENT_QUOTES) . PHP_EOL;
                            $this->_exportCodeEditorOnRecord .= "/* END ON RECORD EXPORT */" . PHP_EOL . PHP_EOL;
                        endif;
                    endforeach;
//END GET CODE EDITOR ON RECORD EXPORT

                    /*
                     * GET CODE EDITOR FORM ADD
                     */
                    $_where_getCode_FormAddEdit = array(
                        'proj_build_id' => $this->_project_id,
                        'code_screen' => 'formadd',
                    );
                    $_query_getCode_FormAddEdit = $this->db->get_where('proj_build_codeeditor', $_where_getCode_FormAddEdit)->result();
                    foreach ($_query_getCode_FormAddEdit as $_row_getCode_FormAddEdit):
                        if ($_row_getCode_FormAddEdit->code_type == 'css' && !empty(trim($_row_getCode_FormAddEdit->code_script))):
                            $this->_formAddCodeEditorCSS .= "<!--" . PHP_EOL;
                            $this->_formAddCodeEditorCSS .= " * CSS SCRIPT" . PHP_EOL;
                            $this->_formAddCodeEditorCSS .= "-->" . PHP_EOL;
                            $this->_formAddCodeEditorCSS .= "<style>" . PHP_EOL . PHP_EOL;
                            $this->_formAddCodeEditorCSS .= html_entity_decode(base64_decode($_row_getCode_FormAddEdit->code_script), ENT_QUOTES) . PHP_EOL . PHP_EOL;
                            $this->_formAddCodeEditorCSS .= "</style>" . PHP_EOL;
                            $this->_formAddCodeEditorCSS .= "<!--" . PHP_EOL;
                            $this->_formAddCodeEditorCSS .= " * END CSS SCRIPT" . PHP_EOL;
                            $this->_formAddCodeEditorCSS .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;
                        endif;
                        if ($_row_getCode_FormAddEdit->code_type == 'jquery' && !empty(trim($_row_getCode_FormAddEdit->code_script))):

                            $this->_formAddCodeEditorJS .= "<!--" . PHP_EOL;
                            $this->_formAddCodeEditorJS .= " * JQUERY SCRIPT" . PHP_EOL;
                            $this->_formAddCodeEditorJS .= "-->" . PHP_EOL;
                            $this->_formAddCodeEditorJS .= "<script>" . PHP_EOL . PHP_EOL;
                            $this->_formAddCodeEditorJS .= "$(function(){" . PHP_EOL . PHP_EOL;
                            $this->_formAddCodeEditorJS .= html_entity_decode(base64_decode($_row_getCode_FormAddEdit->code_script), ENT_QUOTES) . PHP_EOL . PHP_EOL;
                            $this->_formAddCodeEditorJS .= "});" . PHP_EOL . PHP_EOL;
                            $this->_formAddCodeEditorJS .= "</script>" . PHP_EOL;
                            $this->_formAddCodeEditorJS .= "<!--" . PHP_EOL;
                            $this->_formAddCodeEditorJS .= " * END JQUERY SCRIPT" . PHP_EOL;
                            $this->_formAddCodeEditorJS .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;
                        endif;
                    endforeach;
//END GET CODE EDITOR FORM ADD

                    /*
                     * GET CODE EDITOR FORM EDIT
                     */
                    $_where_getCode_FormAddEdit = array(
                        'proj_build_id' => $this->_project_id, 'code_screen' => 'formedit',);

                    $_query_getCode_FormAddEdit = $this->db->get_where('proj_build_codeeditor', $_where_getCode_FormAddEdit)->result();
                    foreach ($_query_getCode_FormAddEdit as $_row_getCode_FormAddEdit):
                        if ($_row_getCode_FormAddEdit->code_type == 'css' && !empty(trim($_row_getCode_FormAddEdit->code_script))):
                            $this->_formEditCodeEditorCSS .= "<!--" . PHP_EOL;
                            $this->_formEditCodeEditorCSS .= " * CSS SCRIPT" . PHP_EOL;
                            $this->_formEditCodeEditorCSS .= "-->" . PHP_EOL;
                            $this->_formEditCodeEditorCSS .= "<style>" . PHP_EOL . PHP_EOL;
                            $this->_formEditCodeEditorCSS .= html_entity_decode(base64_decode($_row_getCode_FormAddEdit->code_script), ENT_QUOTES) . PHP_EOL . PHP_EOL;
                            $this->_formEditCodeEditorCSS .= "</style>" . PHP_EOL;
                            $this->_formEditCodeEditorCSS .= "<!--" . PHP_EOL;
                            $this->_formEditCodeEditorCSS .= " * END CSS SCRIPT" . PHP_EOL;
                            $this->_formEditCodeEditorCSS .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;
                        endif;
                        if ($_row_getCode_FormAddEdit->code_type == 'jquery' && !empty(trim($_row_getCode_FormAddEdit->code_script))):
                            $this->_formEditCodeEditorJS .= "<!--" . PHP_EOL;
                            $this->_formEditCodeEditorJS .= " * JQUERY SCRIPT" . PHP_EOL;
                            $this->_formEditCodeEditorJS .= "-->" . PHP_EOL;
                            $this->_formEditCodeEditorJS .= "<script>" . PHP_EOL . PHP_EOL;
                            $this->_formEditCodeEditorJS .= "$(function(){" . PHP_EOL . PHP_EOL;
                            $this->_formEditCodeEditorJS .= html_entity_decode(base64_decode($_row_getCode_FormAddEdit->code_script), ENT_QUOTES) . PHP_EOL . PHP_EOL;
                            $this->_formEditCodeEditorJS .= "});" . PHP_EOL . PHP_EOL;
                            $this->_formEditCodeEditorJS .= "</script>" . PHP_EOL;
                            $this->_formEditCodeEditorJS .= "<!--" . PHP_EOL;
                            $this->_formEditCodeEditorJS .= " * END JQUERY SCRIPT" . PHP_EOL;
                            $this->_formEditCodeEditorJS .= "-->" . PHP_EOL . PHP_EOL . PHP_EOL;
                        endif;
                    endforeach;
//END GET CODE EDITOR FORM ADD

                else:

                    set_mensagem_trigger_notifi('APP Não foi Gerado.', 'warning');
                    redirect(site_url('projectbuildcrud?search=' . $this->_app_nome));
                    exit;

                endif;

            else:
                set_mensagem_trigger_notifi('Um ERRO Inesperado Ocorreu ao gerar FORM ADD/EDIT.', 'error');
                redirect(site_url('projectbuildcrud'));
                exit;
            endif;
            /* END CARREGA DADOS DO PROJETO PARA FORM ADD/EDIT */

            /**
             * GERANDO
             */
            echo "<link href=\"" . base_url('assets/dist/css/AdminLTE.BZ.min.css') . "\" rel=\"stylesheet\" type=\"text/css\"/>";

            /*
             * GERA O CONTROLLER DO APP
             */
            echo '<div class="callout callout-success">
                Gerando Controller...
                </div>';
            $this->ger_controller();

            /*
             * GERA O MODEL DO APP
             */
            echo '<div class="callout callout-success">
                Gerando Model...
                </div>';
            $this->ger_models();

            /*
             * GERA A VIEW LIST
             */
            echo '<div class="callout callout-success">
                Gerando Grid List...
                 </div>';
            $this->ger_gridList();

            /*
             * GERA FORM ADD
             */
            echo '<div class="callout callout-success">
                Gerando Form Add...
                </div>';

            $this->ger_formAdd();

            /*
             * GERA FORM EDIT
             */
            echo '<div class="callout callout-success">
                Gerando Form Edit...
                </div>';

            $this->ger_formEdit();

        endif;
    }

    /* END public function build_app() */

    /*
     * GERA O CONTROLLER DO APP BLANK
     */

    private function ger_controllerBlank() {

        /*
         * IMPORTA O TEMPLATE DO CONTROLLER
         */
        $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplControllerBlank.php');
        $this->_dadosController = '';

        foreach ($_template as $_row):
            $this->_dadosController .= $_row;
        endforeach;

        /*
         * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
         */

        $this->_dadosController = str_replace('{{created-date}}', date('d/m/Y'), $this->_dadosController);
        $this->_dadosController = str_replace('{{created-time}}', date('H:i') . ((date('H') > 11) ? 'PM' : 'AM'), $this->_dadosController);
        $this->_dadosController = str_replace('{{author-name}}', $this->session->userdata('user_login')['user_nome'], $this->_dadosController);
        $this->_dadosController = str_replace('{{author-email}}', $this->session->userdata('user_login')['user_email'], $this->_dadosController);
        $this->_dadosController = str_replace(
                '{{class-name}}', $this->_app_nome, $this->_dadosController);

        $this->_dadosController = str_replace('{{titulo-app}}', $this->_appTitulo, $this->_dadosController);

        if (strlen($this->_appIcone) > 0):
            $this->_dadosController = str_replace('{{icone-app}}', $this->_appIcone, $this->_dadosController);
        else:
            $this->_dadosController = str_replace('{{icone-app}}', 'fa-angle-right', $this->_dadosController);
        endif;

        $this->_dadosController = str_replace('{{app-nome}}', $this->_app_nome, $this->_dadosController);

        $this->_dadosController = str_replace('{{controller-security}}', $this->_security, $this->_dadosController);

        if ($this->_templatePadrao == 'SIM') {

            $_t = "";
            $_t .= "/* TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */" . PHP_EOL;
            $_t .= "\$this->dados['_conteudo_masterPageIframe'] = \$this->router->fetch_class() . '/' . 'v" . $this->_app_nome . "';" . PHP_EOL;
            $_t .= "\$this->load->view('vMasterPageIframe', \$this->dados);" . PHP_EOL;

            $this->_dadosController = str_replace('{{controller-blank}}', $_t, $this->_dadosController);
        } else {
            $this->_dadosController = str_replace('{{controller-blank}}', '$this->load->view("v' . $this->_app_nome . '");', $this->_dadosController);
        }

        /*
         * GET CODE EDITOR METODOS PHP CONTROLLER
         */
        $_where_getCode_ControllerMetodosPHP = array(
            'proj_build_id' => $this->_project_id,
            'code_type' => 'metodo-php',
        );
        $this->db->order_by('code_screen DESC');
        $_query_getCode_ControllerMetodosPHP = $this->db->get_where('proj_build_codeeditor', $_where_getCode_ControllerMetodosPHP)->result();

        foreach ($_query_getCode_ControllerMetodosPHP as $_row_getCode_ControllerMetodosPHP):
            if (!empty(trim($_row_getCode_ControllerMetodosPHP->code_script))):
                $this->_controller_metodos_php .= "/* METODO PHP - " . $_row_getCode_ControllerMetodosPHP->code_screen . ' */' . PHP_EOL;

                if ($_row_getCode_ControllerMetodosPHP->code_access_ajax_only == 1) {

                    $this->_controller_metodos_php .= "public function " . $_row_getCode_ControllerMetodosPHP->code_screen . '($_p = null) {' . PHP_EOL;

                    $this->_controller_metodos_php .= '/*' . PHP_EOL;
                    $this->_controller_metodos_php .= ' * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.' . PHP_EOL;
                    $this->_controller_metodos_php .= ' */' . PHP_EOL;
                    $this->_controller_metodos_php .= 'bz_check_is_ajax_request();' . PHP_EOL;
                    $this->_controller_metodos_php .= '/* END CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX. */' . PHP_EOL . PHP_EOL . PHP_EOL;
                    $this->_controller_metodos_php .= '/* */' . PHP_EOL . PHP_EOL . PHP_EOL;
                } else {

                    $this->_controller_metodos_php .= $_row_getCode_ControllerMetodosPHP->code_type_method . " function " . $_row_getCode_ControllerMetodosPHP->code_screen . '($_p = null) {' . PHP_EOL;
                }

                $this->_controller_metodos_php .= html_entity_decode(base64_decode($_row_getCode_ControllerMetodosPHP->code_script), ENT_QUOTES) . PHP_EOL;
                $this->_controller_metodos_php .= "}" . PHP_EOL;
                $this->_controller_metodos_php .= "/* END METODO PHP - " . $_row_getCode_ControllerMetodosPHP->code_screen . ' */' . PHP_EOL . PHP_EOL;
            endif;
        endforeach;
        /* END GET CODE EDITOR METODOS PHP CONTROLLER */

        /* MÉTODOS METODOS PHP CONTROLLER */
        $this->_dadosController = str_replace('{{controller-metodos-php}}', $this->_controller_metodos_php, $this->_dadosController);

        /* GERA O ARQUIVO controller DO APP BLANK */
        write_file($this->_directory . '/controllers/' . $this->_app_nome . '.php', bz_removeEmptyLines($this->_dadosController));
        /* END GERA O ARQUIVO controller DO APP BLANK */

        $this->_dadosController = '';
    }

    /* END private function ger_controllerBlank() */

    /*
     * GERA O VIEW DO APP BLANK
     */

    private function ger_viewBlank() {

        /*
         * IMPORTA O TEMPLATE DO CONTROLLER
         */
        if ($this->_templatePadrao == 'NAO') {
            $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplBlankView.php');
        } else {
            $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplBlankViewDefaultTemplate.php');
        }

        $this->_dadosController = '';

        foreach ($_template as $_row):
            $this->_dadosController .= $_row;
        endforeach;

        /*
         * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
         */
        $this->_dadosController = str_replace('{{created-date}}', date('d/m/Y'), $this->_dadosController);
        $this->_dadosController = str_replace('{{created-time}}', date('H:i') . ((date('H') > 11) ? 'PM' : 'AM'), $this->_dadosController);
        $this->_dadosController = str_replace('{{author-name}}', $this->session->userdata('user_login')['user_nome'], $this->_dadosController);
        $this->_dadosController = str_replace('{{author-email}}', $this->session->userdata('user_login')['user_email'], $this->_dadosController);

        $this->_dadosController = str_replace('{{titulo-app}}', $this->_appTitulo, $this->_dadosController);

        if (strlen($this->_appIcone) > 0):
            $this->_dadosController = str_replace('{{icone-app}}', $this->_appIcone, $this->_dadosController);
        else:
            $this->_dadosController = str_replace('{{icone-app}}', 'fa-angle-right', $this->_dadosController);
        endif;

        $this->_dadosController = str_replace('{{app-nome}}', $this->_app_nome, $this->_dadosController);

        /*
         * GET CODE EDITOR BLANK CODE
         */
        $_where_getCode_Blank = array(
            'proj_build_id' => $this
            ->_project_id,
            'code_type' => 'blank',
        );
        $this->db->order_by('code_screen DESC');
        $_query_getCode_Blank = $this->db->get_where('proj_build_codeeditor', $_where_getCode_Blank)->result();

        foreach ($_query_getCode_Blank as $_row_getCode_Blank):
            if (!empty(trim($_row_getCode_Blank->code_script))):
                $this->_blankCode .= "<!-- BLANK CODE - " . $_row_getCode_Blank->code_screen . ' -->' . PHP_EOL;
                $this->_blankCode .= base64_decode($_row_getCode_Blank->code_script) . PHP_EOL;
                $this->_blankCode .= "<!-- END BLANK CODE - " . $_row_getCode_Blank->code_screen . ' -->' . PHP_EOL . PHP_EOL;
            endif;
        endforeach;
        /* END GET CODE EDITOR BLANK CODE */

        /* BLANK CODE */
        $this->_dadosController = str_replace('{{blank-code}}', $this->_blankCode, $this->_dadosController);

        /* GERA O ARQUIVO controller DO APP BLANK */
        write_file($this->_directory . '/views/v' . $this->_app_nome . '.php', bz_removeEmptyLines($this->_dadosController));
        /* END GERA O ARQUIVO controller DO APP BLANK */

        $this->_dadosController = '';
    }

    /*
     * GERA O MODEL DO APP BLANK
     */

    private function ger_modelsBlank() {

        /*
         * GET CODE EDITOR METODOS PHP MODELS
         */
        $_where_getCode_ModelsMetodosPHP = array(
            'proj_build_id' => $this->_project_id,
            'code_type' => 'model-php',);
        $_query_getCode_ModelsMetodosPHP = $this->db->get_where('proj_build_codeeditor', $_where_getCode_ModelsMetodosPHP)->result();
        foreach ($_query_getCode_ModelsMetodosPHP as $_row_getCode_ModelsMetodosPHP):
            if (!empty(trim($_row_getCode_ModelsMetodosPHP->code_script))):
                $this->_models_metodos_php .= "/* MODELS PHP - " . $_row_getCode_ModelsMetodosPHP->code_screen . ' */' . PHP_EOL;
                $this->_models_metodos_php .= "public function " . $_row_getCode_ModelsMetodosPHP->code_screen . '($_p = null) {' . PHP_EOL;
                $this->_models_metodos_php .= html_entity_decode(base64_decode($_row_getCode_ModelsMetodosPHP->code_script), ENT_QUOTES) . PHP_EOL;
                $this->_models_metodos_php .= "}" . PHP_EOL;
                $this->_models_metodos_php .= "/* END MODELS PHP - " . $_row_getCode_ModelsMetodosPHP->code_screen . ' */' . PHP_EOL . PHP_EOL;
            endif;
        endforeach;
        /* END GET CODE EDITOR METODOS PHP MODELS */

        $this->ger_models();
    }

    /* END private function ger_controllerBlank() */

    /*
     * GERA O CONTROLLER DO APP
     */

    private function ger_controller() {

        /*
         * IMPORTA O TEMPLATE DO CONTROLLER
         */
        $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplController.php');
        $this->_dadosController = '';

        foreach ($_template as $_row):
            $this->_dadosController .= $_row;
        endforeach;

        /*
         * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
         */
        $this->_dadosController = str_replace('{{created-date}}', date('d/m/Y'), $this->_dadosController);
        $this->_dadosController = str_replace('{{created-time}}', date('H:i') . ((date('H') > 11) ? 'PM' : 'AM' ), $this->_dadosController);
        $this->_dadosController = str_replace('{{author-name}}', $this->session->userdata('user_login')['user_nome'], $this->_dadosController);
        $this->_dadosController = str_replace('{{author-email}}', $this->session->userdata('user_login')['user_email'], $this->_dadosController);

        $this->_dadosController = str_replace('{{class-name}}', $this->_app_nome, $this->_dadosController);

        $this->_dadosController = str_replace('{{titulo-app}}', $this->_appTitulo, $this->_dadosController);

        if (strlen($this->_appIcone) > 0):
            $this->_dadosController = str_replace('{{icone-app}}', $this->_appIcone, $this->_dadosController);
        else:
            $this->_dadosController = str_replace('{{icone-app}}', 'fa-angle-right', $this->_dadosController);
        endif;

        $this->_dadosController = str_replace('{{app-nome}}', $this->_app_nome, $this->_dadosController);

        if ($this->_formAddConvertDadosToDatabase):
            $this->_formAddConvertDadosToDatabase = '/* CONVERTE DADOS PARA GRAVAR NA TABELA */' . PHP_EOL . $this->_formAddConvertDadosToDatabase . PHP_EOL . '/* CONVERTE DADOS PARA GRAVAR NA TABELA */' . PHP_EOL;
        endif;
        $this->_dadosController = str_replace('{{form-add-convert-dados-to-database}}', $this->_formAddConvertDadosToDatabase, $this->_dadosController);

        $this->_dadosController = str_replace('{{form-add-dados-fillable}}', $this->_formAddDadosFillable, $this->_dadosController);
        $this->_dadosController = str_replace('{{form-edit-dados-fillable}}', $this->_formEditDadosFillable, $this->_dadosController);

        if ($this->_formEditConvertDadosToDatabase):
            $this->_formEditConvertDadosToDatabase = '/* CONVERTE DADOS PARA GRAVAR NA TABELA */' . PHP_EOL . $this->_formEditConvertDadosToDatabase . PHP_EOL . '/* CONVERTE DADOS PARA GRAVAR NA TABELA */' . PHP_EOL;
        endif;
        $this->_dadosController = str_replace('{{form-edit-convert-dados-to-database}}', $this->_formEditConvertDadosToDatabase, $this->_dadosController);

        $this->_dadosController = str_replace('{{table-gridlist-name}}', $this->_appTableName, $this->_dadosController);
        $this->_dadosController = str_replace('{{table-formaddedit-name}}', str_replace('vw_', '', $this->_appTableName), $this->_dadosController);

        $this->_dadosController = str_replace('{{primary_key_field}}', $this->_primary_key_field, $this->_dadosController);
        $this->_dadosController = str_replace('{{grid-list-fields-order-by}}', $this->_gridListFieldsOrderBy, $this->_dadosController);
        $this->_dadosController = str_replace('{{grid-list-search-fields}}', $this->_gridListSearchFields, $this->_dadosController);

        $this->_dadosController = str_replace('{{add-validation}}', $this->_formAddConfigInputValidation, $this->_dadosController);
        $this->_dadosController = str_replace('{{edit-validation}}', $this->_formEditConfigInputValidation, $this->_dadosController);

        $this->_dadosController = str_replace('{{form-edit-unset-primary-key}}', $this->_formEditUnsetPrimaryKey, $this->_dadosController);

        $this->_dadosController = str_replace('{{form-add-unset-fields}}', $this->_form_add_unset_fields, $this->_dadosController);
        $this->_dadosController = str_replace('{{form-edit-unset-fields}}', $this->_form_edit_unset_fields, $this->_dadosController);

        $this->_dadosController = str_replace('{{callback-validation}}', $this->_formAddEditConfigInputValidationCallback, $this->_dadosController);

        $this->_dadosController = str_replace('{{form-edit-where-update-fields}}', $this->_formEditWhereUpdateFields, $this->_dadosController);


        /* CAMPOS VIRTUAIS DA GRIDLIST */
        $this->_dadosController = str_replace('{{controller-virtual-field}}', ( (count($this->_gridListVirtualFieldsTable) > 0) ? "'" . implode("','", $this->_gridListVirtualFieldsTable) . "'" : ''), $this->_dadosController);
        /* END CAMPOS VIRTUAIS DA GRIDLIST */

        /* EXPORT REPORT */
        $this->_dadosController = str_replace('{{grid-list-header-table-export}}', $this->_gridListHeaderTableExport, $this->_dadosController);
        $this->_dadosController = str_replace('{{grid-list-fields-table-export}}', $this->_gridListFieldsTableExport, $this->_dadosController);
        $this->_dadosController = str_replace("<?= ", "'.", $this->_dadosController);
        $this->_dadosController = str_replace("; ?>", ".'", $this->_dadosController);

        $this->_dadosController = str_replace('{{export-on-record}}', $this->_exportCodeEditorOnRecord, $this->_dadosController);

        /* END EXPORT REPORT */



        /**
         * ########################################################################################################################################################################
         * 
         * CALENDAR CONTROLLER/VIEW
         * 
         * ########################################################################################################################################################################
         */
        if (!empty($this->_appCalendarInputs->calendarCheckboxAtivar) && $this->_appCalendarInputs->calendarCheckboxAtivar == 'on') {

            /**
             *  IMPORTA O TEMPLATE CONTROLLER DO CALENDAR 
             */
            $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplControllerCalendar.php');
            $this->_dadosControllerCalendar = '';

            foreach ($_template as $_row):
                $this->_dadosControllerCalendar .= $_row;
            endforeach;

            /*
             * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
             */
            $this->_dadosController = str_replace('{{calendar-view-app}}', '$this->dados[\'_view_app_calendar\'] = \'v' . $this->_app_nome . 'Calendar\';', $this->_dadosController);
            $this->_dadosController = str_replace('{{calendar-controller}}', $this->_dadosControllerCalendar, $this->_dadosController);

            /* CALENDAR EVENTS */
            $this->_dadosController = str_replace('{{calendar-input-title}}', $this->_appCalendarInputs->calendarInputTitulo, $this->_dadosController);
            $this->_dadosController = str_replace('{{calendar-input-description}}', $this->_appCalendarInputs->calendarInputDescricao, $this->_dadosController);
            $this->_dadosController = str_replace('{{calendar-input-date-start}}', $this->_appCalendarInputs->calendarInputDataStart, $this->_dadosController);
            $this->_dadosController = str_replace('{{calendar-input-date-end}}', $this->_appCalendarInputs->calendarInputDataEnd, $this->_dadosController);
            $this->_dadosController = str_replace('{{calendar-input-id}}', 'id', $this->_dadosController);
            /* END CALENDAR EVENTS */

            /* METHOD CALENDAR */
            $this->_controller_onScriptinit .= '/* METHOD CALENDAR */' . PHP_EOL;
            $this->_controller_onScriptinit .= '$this->_methodCalendar = true;' . PHP_EOL . PHP_EOL;



            /* ############################################################################################################################################################ */


            /**
             *  IMPORTA O TEMPLATE VIEW DO CALENDAR 
             */
            $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplViewCalendar.php');
            $this->_dadosViewCalendar = '';

            foreach ($_template as $_row):
                $this->_dadosViewCalendar .= $_row;
            endforeach;

            /*
             * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
             */
            $this->_dadosViewCalendar = str_replace('{{created-date}}', date('d/m/Y'), $this->_dadosViewCalendar);
            $this->_dadosViewCalendar = str_replace('{{created-time}}', date('H:i') . ((date('H') > 11) ? 'PM' : 'AM' ), $this->_dadosViewCalendar);
            $this->_dadosViewCalendar = str_replace('{{author-name}}', $this->session->userdata('user_login')['user_nome'], $this->_dadosViewCalendar);
            $this->_dadosViewCalendar = str_replace('{{author-email}}', $this->session->userdata('user_login')['user_email'], $this->_dadosViewCalendar);

            /* TIME REFESH SCREEN CALENDAR */
            if ($this->_appCalendarInputs->calendarInputTimeRefresh > 0) {
                $this->_dadosViewCalendar = str_replace('{{calendar-time-refresh-screen}}', ($this->_appCalendarInputs->calendarInputTimeRefresh ? $this->_appCalendarInputs->calendarInputTimeRefresh : 0), $this->_dadosViewCalendar);
            } else {
                $this->_dadosViewCalendar = str_replace('{{calendar-time-refresh-screen}}', '0', $this->_dadosViewCalendar);
            }

            /* GERA O ARQUIVO view DO CALENDAR */
            write_file($this->_directory . '/views/v' . $this->_app_nome . 'Calendar.php', bz_removeEmptyLines($this->_dadosViewCalendar));
            /* END GERA O ARQUIVO view DO CALENDAR */


            $this->_dadosViewCalendar = '';


            /**/
        } else {
            $this->_dadosController = str_replace('{{calendar-view-app}}', '', $this->_dadosController);
            $this->_dadosController = str_replace('{{calendar-controller}}', '', $this->_dadosController);

            if (is_file($this->_directory . '/views/v' . $this->_app_nome . 'Calendar.php')) {
                unlink($this->_directory . '/views/v' . $this->_app_nome . 'Calendar.php');
            }
        }

        /* ########################################################################################################################################################################
         * END CALENDAR CONTROLLER/VIEW
         * ########################################################################################################################################################################
         */





        /* EXPORT REPORT */
        if (!empty($this->_gridListHeaderTableExport)) {
            $this->_controller_onScriptinit .= '/* EXPORT REPORT */' . PHP_EOL;
            $this->_controller_onScriptinit .= '$this->_exportReport = true;' . PHP_EOL . PHP_EOL;
        }


        /* MÉTODOS */
        $this->_dadosController = str_replace('{{controller-metodos-php}}', $this->_controller_metodos_php, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onScriptInit}}', $this->_controller_onScriptinit, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onBeforeInsert}}', $this->_controller_onBeforeInsert, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onAfterInsert}}', $this->_controller_onAfterInsert, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onBeforeUpdate}}', $this->_controller_onBeforeUpdate, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onAfterUpdate}}', $this->_controller_onAfterUpdate, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onBeforeDelete}}', $this->_controller_onBeforeDelete, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller_DeleteFileFunction}}', $this->_controller_DeleteFileFunction, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onAfterDelete}}', $this->_controller_onAfterDelete, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onScriptInitExport}}', $this->_controller_onScriptInitExport, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onScriptBeforeExport}}', $this->_controller_onScriptBeforeExport, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onScriptAfterExport}}', $this->_controller_onScriptAfterExport, $this->_dadosController);
        $this->_dadosController = str_replace('{{controller-onScriptEndExport}}', $this->_controller_onScriptEndExport, $this->_dadosController);
        /* END MÉTODOS */


        /* GERA O ARQUIVO controller DA APLICAÇÃO */
        write_file($this->_directory . '/controllers/' . $this->_app_nome . '.php', bz_removeEmptyLines($this->_dadosController));
        /* END GERA O ARQUIVO controller DA APLICAÇÃO */


        $this->_dadosController = '';
        $this->_dadosControllerCalendar = '';
    }

    /* END private function ger_controller() */

    /*
     * GERA O MODEL DO APP
     */

    private function ger_models() {
        /*
         * IMPORTA O TEMPLATE DO MODEL
         */
        $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplModels.php');
        $this->_dadosModel = '';

        foreach ($_template as $_row):
            $this->_dadosModel .= $_row;

        endforeach;

        /*
         * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
         */
        $this->_dadosModel = str_replace('{{created-date}}', date('d/m/Y'), $this->_dadosModel);
        $this->_dadosModel = str_replace('{{created-time}}', date('H:i') . ((date('H') > 11) ? 'PM' : 'AM'), $this->_dadosModel);
        $this->_dadosModel = str_replace('{{author-name}}', $this->session->userdata('user_login')['user_nome'], $this->_dadosModel);
        $this->_dadosModel = str_replace('{{author-email}}', $this->session->userdata('user_login')['user_email'], $this->_dadosModel);

        $this->_dadosModel = str_replace('{{model-name}}', $this->_app_nome, $this->_dadosModel);
        $this->_dadosModel = str_replace('{{models-metodos-php}}', $this->_models_metodos_php, $this->_dadosModel);

        /* GERA O ARQUIVO model DA APLICAÇÃO */
        write_file($this->_directory . '/models/' . $this->_app_nome . '_model.php', bz_removeEmptyLines($this->_dadosModel));
        /* END GERA O ARQUIVO model DA APLICAÇÃO */

        $this->_dadosModel = '';
    }

    /* END private function ger_models() */

    /*
     * GERA A VIEW LIST
     */

    private function ger_gridList() {

        /*
         * IMPORTA O TEMPLATE DO CONTROLLER
         */
        $_dados = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplGridList.php');

        foreach ($_dados as $_row):
            $this->_dadosView .= $_row;
        endforeach;

        /*
         * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
         */

        $this->_dadosView = str_replace('{{created-date}}', date('d/m/Y'), $this->_dadosView);
        $this->_dadosView = str_replace('{{created-time}}', date('H:i') . ((date('H') > 11) ? 'PM' : 'AM'), $this->_dadosView);
        $this->_dadosView = str_replace('{{author-name}}', $this->session->userdata('user_login')['user_nome'], $this->_dadosView);
        $this->_dadosView = str_replace('{{author-email}}', $this->session->userdata('user_login')['user_email'], $this->_dadosView);

        $this->_dadosView = str_replace('{{primary_key_field}}', $this->_primary_key_field, $this->_dadosView);

        $this->_dadosView = str_replace('{{grid-list-header-table}}', $this->_gridListHeaderTable, $this->_dadosView);
        $this->_dadosView = str_replace('{{grid-list-fields-table}}', $this->_gridListFieldsTable, $this->_dadosView);
        $this->_dadosView = str_replace('{{grid-list-show-status}}', $this->_gridListStatusDados, $this->_dadosView);

        $this->_dadosView = str_replace('{{grid-list-on-record}}', $this->_gridListCodeEditorOnRecord, $this->_dadosView);

//INPUT SEARCH E BUTTONS DA PESQUISA
        $this->_dadosView = str_replace('{{grid-list-div-buttons}}', $this->_gridListDivButtons, $this->_dadosView);

//INPUT SEARCH E BUTTONS DA PESQUISA
        $this->_dadosView = str_replace('{{grid-list-input-search}}', $this->_gridListSearchInput, $this->_dadosView);

//BUTTON SEARCH
        $this->_dadosView = str_replace('{{grid-list-button-search}}', $this->_gridListSearchButton, $this->_dadosView);

//BUTTON CLEAR
        $this->_dadosView = str_replace('{{grid-list-button-clear}}', $this->_gridListClearhButton, $this->_dadosView);

        /* CSS */
        $this->_dadosView = str_replace('{{grid-list-scripts-css}}', "<?php \$this->load->view(\$this->router->fetch_class() . '/css/css-gridlist');?>", $this->_dadosView);

        /* SCRIPT JS */
        $this->_dadosView = str_replace('{{grid-list-scripts-js}}', "<?php \$this->load->view(\$this->router->fetch_class() . '/js/js-gridlist');?>", $this->_dadosView);


        /* GERA O ARQUIVO VIEW gridlist DA APLICAÇÃO */
        write_file($this->_directory . '/views/v' . $this->_app_nome . '.php', bz_removeEmptyLines($this->_dadosView));
        /* EDND GERA O ARQUIVO VIEW gridlist DA APLICAÇÃO */

        $this->_dadosView = '';


        /**
         * GERA O ARQUIVO CSS
         */
        $_dados = '';

        if ($this->_gridListCodeEditorCSS) {
            $_dados = fopen($this->_directory . '/views/css/css-gridlist.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fwrite($_dados, bz_removeEmptyLines($this->_gridListCodeEditorCSS));
            fclose($_dados);
        } else {
            $_dados = fopen($this->_directory . '/views/css/css-gridlist.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fclose($_dados);
        }
        /* END GERA O ARQUIVO CSS */


        /**
         * GERA O ARQUIVO JS
         */
        $_dados = '';

        if ($this->_gridListCodeEditorJS) {
            $_dados = fopen($this->_directory . '/views/js/js-gridlist.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fwrite($_dados, bz_removeEmptyLines($this->_gridListCodeEditorJS));
            fclose($_dados);
        } else {
            $_dados = fopen($this->_directory . '/views/js/js-gridlist.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fclose($_dados);
        }
        /* END GERA O ARQUIVO JS */


        /**/
    }

    /* END private function ger_gridList() */

    /*
     * GERA O FORM ADD DO APP
     */

    private function ger_formAdd() {
        /*
         * IMPORTA O TEMPLATE DO FORM ADD
         */
        $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplFormAdd.php');
        $this->_dadosFormAdd = '';

        foreach ($_template as $_row):
            $this->_dadosFormAdd .= $_row;
        endforeach;

        /*
         * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
         */

        $this->_formAddFields = str_replace('disabled-formadd', 'disabled', $this->_formAddFields);
        $this->_formAddFields = str_replace('disabled-formaedit', '', $this->_formAddFields);

        $this->_formAddFields = str_replace('hidden-formadd', 'hidden', $this->_formAddFields);
        $this->_formAddFields = str_replace('hidden-formedit', '', $this->_formAddFields);

        $this->_dadosFormAdd = str_replace('disabled-formedit', '', $this->_dadosFormAdd);
        $this->_dadosFormAdd = str_replace('disabled-formadd', 'disabled', $this->_dadosFormAdd);

        $this->_dadosFormAdd = str_replace('{{created-date}}', date('d/m/Y'), $this->_dadosFormAdd);
        $this->_dadosFormAdd = str_replace('{{created-time}}', date('H:i') . ((date('H') > 11) ? 'PM' : 'AM'), $this->_dadosFormAdd);
        $this->_dadosFormAdd = str_replace('{{author-name}}', $this->session->userdata('user_login')['user_nome'], $this->_dadosFormAdd);
        $this->_dadosFormAdd = str_replace('{{author-email}}', $this->session->userdata('user_login')['user_email'], $this->_dadosFormAdd);

        $this->_dadosFormAdd = str_replace('{{form-addedit-input-form-open}}', $this->_formAddEditConfigFormOpen, $this->_dadosFormAdd);
        $this->_dadosFormAdd = str_replace('{{form-add-input-fields}}', $this->_formAddFields, $this->_dadosFormAdd);


        /* CSS */
        $this->_dadosFormAdd = str_replace('{{form-add-scripts-css}}', "<?php \$this->load->view(\$this->router->fetch_class() . '/css/css-formAdd');?>", $this->_dadosFormAdd);

        /* SCRIPT JS */
        $this->_dadosFormAdd = str_replace('{{form-add-scripts-js}}', "<?php \$this->load->view(\$this->router->fetch_class() . '/js/js-formAdd');?>", $this->_dadosFormAdd);

        /* SCRIPT JQUERY MASK */
        $this->_dadosFormAdd = str_replace('{{form-add-scripts-js-mask}}', "<?php \$this->load->view(\$this->router->fetch_class() . '/js/js-mask-formAdd');?>", $this->_dadosFormAdd);



        /* GERA O ARQUIVO VIEW formadd DA APLICAÇÃO */
        write_file($this->_directory . '/views/v' . $this->_app_nome . 'FormAdd.php', bz_removeEmptyLines($this->_dadosFormAdd));
        /* END GERA O ARQUIVO VIEW formadd DA APLICAÇÃO */


        $this->_dadosFormAdd = '';



        /**
         * GERA O ARQUIVO CSS
         */
        $_dados = '';

        if ($this->_formAddCodeEditorCSS) {
            $_dados = fopen($this->_directory . '/views/css/css-formAdd.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fwrite($_dados, bz_removeEmptyLines($this->_formAddCodeEditorCSS));
            fclose($_dados);
        } else {
            $_dados = fopen($this->_directory . '/views/css/css-formAdd.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fclose($_dados);
        }
        /* END GERA O ARQUIVO CSS */


        /**
         * GERA O ARQUIVO JS
         */
        $_dados = '';

        if ($this->_formAddCodeEditorJS) {
            $_dados = fopen($this->_directory . '/views/js/js-formAdd.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fwrite($_dados, bz_removeEmptyLines($this->_formAddCodeEditorJS));
            fclose($_dados);
        } else {
            $_dados = fopen($this->_directory . '/views/js/js-formAdd.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fclose($_dados);
        }
        /* END GERA O ARQUIVO JS */


        /**
         * GERA O ARQUIVO JS JQUERY MASK
         */
        $_dados = '';

        if ($this->_formAddEditConfigInputMask) {
            $_dados = fopen($this->_directory . '/views/js/js-mask-formAdd.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fwrite($_dados, bz_removeEmptyLines($this->_formAddEditConfigInputMask));
            fclose($_dados);
        } else {
            $_dados = fopen($this->_directory . '/views/js/js-mask-formAdd.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fclose($_dados);
        }
        /* END GERA O ARQUIVO JS JQUERY MASK */


        /**/
    }

    /* END private function ger_formAdd() */

    /*
     * GERA O FORM EDIT DO APP
     */

    private function ger_formEdit() {
        /*
         * IMPORTA O TEMPLATE DO FORM ADD
         */
        $_template = file(FCPATH . 'application/modules/projectbuildcrud/views/tpl/tplFormEdit.php');
        $this->_dadosFormEdit = '';

        foreach ($_template as $_row):
            $this->_dadosFormEdit .= $_row;
        endforeach;

        /*
         * FAZ AS SUBSTITUIÇÕES DOS MARCADORES PELOS CÓDIGOS GERADOS
         */

        $this->_formEditFields = str_replace('disabled-formadd', '', $this->_formEditFields);
        $this->_formEditFields = str_replace('disabled-formedit', 'disabled', $this->_formEditFields);

        $this->_formEditFields = str_replace('hidden-formadd', '', $this->_formEditFields);
        $this->_formEditFields = str_replace('hidden-formedit', 'hidden', $this->_formEditFields);

        $this->_dadosFormEdit = str_replace('{{created-date}}', date('d/m/Y'), $this->_dadosFormEdit);
        $this->_dadosFormEdit = str_replace('{{created-time}}', date('H:i') . ((date('H') > 11) ? 'PM' : 'AM' ), $this->_dadosFormEdit);
        $this->_dadosFormEdit = str_replace('{{author-name}}', $this->session->userdata('user_login')['user_nome'], $this->_dadosFormEdit);
        $this->_dadosFormEdit = str_replace('{{author-email}}', $this->session->userdata('user_login')['user_email'], $this->_dadosFormEdit);

        $this->_dadosFormEdit = str_replace('{{form-addedit-input-form-open}}', $this->_formAddEditConfigFormOpen, $this->_dadosFormEdit);
        $this->_dadosFormEdit = str_replace('{{primary_key_field}}', $this->_primary_key_field, $this->_dadosFormEdit);

        $this->_dadosFormEdit = str_replace('{{form-edit-input-fields}}', $this->_formEditFields, $this->_dadosFormEdit);

//        $this->_dadosFormEdit = str_replace('{{form-edit-scripts-css}}', $this->_formEditCodeEditorCSS, $this->_dadosFormEdit);
//        $this->_dadosFormEdit = str_replace('{{form-edit-scripts-js}}', $this->_formEditCodeEditorJS, $this->_dadosFormEdit);
//        $this->_dadosFormEdit = str_replace('{{form-edit-scripts-js-mask}}', $this->_formAddEditConfigInputMask, $this->_dadosFormEdit);



        /* CSS */
        $this->_dadosFormEdit = str_replace('{{form-edit-scripts-css}}', "<?php \$this->load->view(\$this->router->fetch_class() . '/css/css-formEdit');?>", $this->_dadosFormEdit);

        /* SCRIPT JS */
        $this->_dadosFormEdit = str_replace('{{form-edit-scripts-js}}', "<?php \$this->load->view(\$this->router->fetch_class() . '/js/js-formEdit');?>", $this->_dadosFormEdit);

        /* SCRIPT JQUERY MASK */
        $this->_dadosFormEdit = str_replace('{{form-edit-scripts-js-mask}}', "<?php \$this->load->view(\$this->router->fetch_class() . '/js/js-mask-formEdit');?>", $this->_dadosFormEdit);




        /**
         * GERA O ARQUIVO CSS
         */
        $_dados = '';

        if ($this->_formEditCodeEditorCSS) {
            $_dados = fopen($this->_directory . '/views/css/css-formEdit.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fwrite($_dados, bz_removeEmptyLines($this->_formEditCodeEditorCSS));
            fclose($_dados);
        } else {
            $_dados = fopen($this->_directory . '/views/css/css-formEdit.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fclose($_dados);
        }
        /* END GERA O ARQUIVO CSS */


        /**
         * GERA O ARQUIVO JS
         */
        $_dados = '';

        if ($this->_formEditCodeEditorJS) {
            $_dados = fopen($this->_directory . '/views/js/js-formEdit.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fwrite($_dados, bz_removeEmptyLines($this->_formEditCodeEditorJS));
            fclose($_dados);
        } else {
            $_dados = fopen($this->_directory . '/views/js/js-formEdit.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fclose($_dados);
        }
        /* END GERA O ARQUIVO JS */


        /**
         * GERA O ARQUIVO JS JQUERY MASK
         */
        $_dados = '';

        if ($this->_formAddEditConfigInputMask) {
            $_dados = fopen($this->_directory . '/views/js/js-mask-formEdit.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fwrite($_dados, bz_removeEmptyLines($this->_formAddEditConfigInputMask));
            fclose($_dados);
        } else {
            $_dados = fopen($this->_directory . '/views/js/js-mask-formEdit.php', 'w');
            fwrite($_dados, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>" . PHP_EOL . PHP_EOL);
            fclose($_dados);
        }
        /* END GERA O ARQUIVO JS JQUERY MASK */


        /**/




        /* GERA O ARQUIVO VIEW formedit DA APLICAÇÃO */
        write_file($this->_directory . '/views/v' . $this->_app_nome . 'FormEdit.php', bz_removeEmptyLines($this->_dadosFormEdit));
        /* END GERA O ARQUIVO VIEW formedit DA APLICAÇÃO */

        $this->_dadosFormEdit = '';
    }

    /* END private function ger_formAdd() */
}

/* END class */     

            

                     