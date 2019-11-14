<?php

/*
  Created on : 09/08/2017, 07:49:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos extends MY_Controller {

    public function __construct() {
        parent::__construct();

        /*
         * TÍTULO DA APLICAÇÃO
         */
        $this->dados['_titulo_app'] = 'Grupo de Usuários';
        $this->dados['_font_icon'] = 'fa fa-group';

        /*
         * VIEW DA APLICAÇÃO
         */
        $this->dados['_view_app_list'] = 'vGrupos';
        $this->dados['_view_app_add'] = 'vGruposFormAdd';
        $this->dados['_view_app_edit'] = 'vGruposFormEdit';

        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'sec_grupos';
    }

    // END function __construct()


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

//END function index()


    /*
     * FUNÇÃO CADASTRO
     */

    public function add() {

        /*
         * CARREGA OS DADOS DOS APLICATIVOS
         */
        $this->dados['_apps']['_result'] = $this->read->exec('sec_aplicativos', 'ORDER BY app_descricao')->result();

        if ($this->input->post()) :

            $this->form_validation->set_rules('descricao', '<b>NOME DO GRUPO</b>', 'trim|required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('apps', '<b>APLICATIVOS</b>', 'callback_valid_apps');

            if ($this->form_validation->run() == TRUE):

                $_dados = $this->input->post();

                $_apps = $_dados['apps'];

                unset($_dados['btn-salvar']);
                unset($_dados['task']);
                unset($_dados['apps']);

                if (isset($_dados['ativo'])):
                    if ($_dados['ativo'] == 'on'):
                        $_dados['ativo'] = 'Y';
                    else:
                        $_dados['ativo'] = 'N';
                    endif;
                else:
                    $_dados['ativo'] = 'N';
                endif;


                /**
                 * DADOS FILLABLE
                 */
                $_dadosFillable = $_dados;
                $_dados = [];
                if (!empty($_dadosFillable["descricao"])) {
                    $_dados["descricao"] = $_dadosFillable["descricao"];
                } else {
                    $_dados["descricao"] = NULL;
                }

                if (!empty($_dadosFillable["ativo"])) {
                    $_dados["ativo"] = $_dadosFillable["ativo"];
                } else {
                    $_dados["ativo"] = NULL;
                }

                /* END DADOS FILLABLE */



                /**
                 * Grava registro
                 */
                $result = $this->create->exec($this->table_name, $_dados);

                if ($result):

                    //GRAVA AUDITORIA
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'add';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_ADD_SUCCESS___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    $dados_auditoria['last_query'] = str_replace($this->table_name . ' (', $this->table_name . ' (id, ', $dados_auditoria['last_query']);
                    $dados_auditoria['last_query'] = str_replace('VALUES (', 'VALUES ("' . $result['last_id_add'] . '", ', $dados_auditoria['last_query']);

                    add_auditoria($dados_auditoria);


                    /**
                     * GRAVA RELACIONAMENTO COM TABELA sec_aplicativos
                     */
                    $_last_id_add_grupo = $result['last_id_add'];
                    $_app_name = '';
                    $this->db->trans_start();
                    foreach ($_apps as $_value):
                        $this->db->insert('sec_grupos_has_sec_aplicativos', array('sec_grupos_id' => $_last_id_add_grupo, 'sec_aplicativos_app_name' => $_value));
                        $_app_name .= '|' . $_value;
                    endforeach;

                    /*
                     * GRAVA OS NOMES DOS APPS QUE O GRUPO TEM RELACIONADO A ELES PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST
                     */
                    $this->db->reset_query();
                    $this->db->where('id', $_last_id_add_grupo);
                    $this->db->update($this->table_name, array('app_name' => $_app_name));
                    /*
                     * END GRAVA OS NOMES DOS APPS QUE O GRUPO TEM RELACIONADO A ELES PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST
                     */

                    $this->db->trans_complete();

                    //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_ADD_REGISTRO_, 'success', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_ADD_REGISTRO___, 'success');

                else:
                    echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_name);
                    exit;
                endif;

                redirect($this->_redirect . '/add');

            endif;

        endif;


        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_add'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

//END public function add()    

    /*
     * FUNÇÃO EDIÇÃO
     */

    public function edit() {

        /*
         * CARREGA OS DADOS DOS APLICATIVOS
         */
        $this->dados['_apps']['_result'] = $this->read->exec('sec_aplicativos', 'ORDER BY app_descricao')->result();

        if ($this->input->post()):

            if ($this->input->post('btn-editar') == 'btn-editar'):

                $this->form_validation->set_rules('descricao', '<b>NOME DO GRUPO</b>', 'trim|required|min_length[3]|max_length[250]');
                $this->form_validation->set_rules('apps', '<b>APLICATIVOS</b>', 'callback_valid_apps');

                if ($this->form_validation->run() == TRUE):

                    $_dados = $this->input->post();

                    $_apps = $_dados['apps'];

                    unset($_dados['btn-editar']);
                    unset($_dados['task']);
                    unset($_dados['apps']);

                    /*
                     * GRAVA ALTERAÇÃO DOS DADOS DO GRUPO
                     */
                    if (isset($_dados['ativo'])):
                        if ($_dados['ativo'] == 'on'):
                            $_dados['ativo'] = 'Y';
                        else:
                            $_dados['ativo'] = 'N';
                        endif;
                    else:
                        $_dados['ativo'] = 'N';
                    endif;


                    /**
                     * DADOS FILLABLE
                     */
                    $_dadosFillable = $_dados;
                    $_dados = [];
                    if (!empty($_dadosFillable["descricao"])) {
                        $_dados["descricao"] = $_dadosFillable["descricao"];
                    } else {
                        $_dados["descricao"] = NULL;
                    }

                    if (!empty($_dadosFillable["ativo"])) {
                        $_dados["ativo"] = $_dadosFillable["ativo"];
                    } else {
                        $_dados["ativo"] = NULL;
                    }

                    /* END DADOS FILLABLE */


                    $_where = 'WHERE id = "' . $this->input->post('id') . '"';

                    if ($this->update->exec($this->table_name, $_dados, $_where)):

                        //GRAVA AUDITORIA
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_SUCCESS___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);



                        /**
                         * GRAVA ALTERAÇÕES NA TABELA FILHO sec_grupos_has_sec_aplicativos
                         */
                        /* DELETA OS REGISTROS QUE FORAM REMOVIDOS DO CADASTRO */
                        $this->db->trans_start();
                        $this->db->reset_query();
                        $this->db->where('sec_grupos_id', $this->input->post('id'));
                        $this->db->where_not_in('sec_aplicativos_app_name', $_apps);
                        $this->db->delete('sec_grupos_has_sec_aplicativos');
                        $this->db->trans_complete();

                        /* GRAVA OS REGISTRO NOVOS */
                        $this->db->reset_query();
                        $this->db->trans_start();
                        $_app_name = '';
                        foreach ($_apps as $_value):
                            $this->db->replace('sec_grupos_has_sec_aplicativos', array('sec_grupos_id' => $this->input->post('id'), 'sec_aplicativos_app_name' => $_value));
                            $_app_name .= '|' . $_value;
                        endforeach;

                        /*
                         * GRAVA OS NOMES DOS APPS QUE O GRUPO TEM RELACIONADO A ELES PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST
                         */
                        $this->db->reset_query();
                        $this->db->where('id', $this->input->post('id'));
                        $this->db->update($this->table_name, array('app_name' => $_app_name));
                        /*
                         * END GRAVA OS NOMES DOS APPS QUE O GRUPO TEM RELACIONADO A ELES PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST
                         */

                        $this->db->trans_complete();

                        //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_UPDATE_REGISTRO_, 'success', 'top-center');
                        set_mensagem_trigger_notifi(___MSG_UPDATE_REGISTRO___, 'success');

                    else:
                        //GRAVA AUDITORIA
                        $dados_auditoria['creator'] = 'system';
                        $dados_auditoria['action'] = 'error edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_ERROR___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

                        //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_UPDATE_REGISTRO_, 'error', 'top-center');
                        set_mensagem_trigger_notifi(___MSG_ERROR_UPDATE_REGISTRO___, 'error');


                    endif;

                endif;

            endif;

        endif;

        $_id = $this->uri->segment(3);

        if ($_id):

            /*
             * BUSCA OS DADOS
             */
            $_where = 'WHERE id = "' . $_id . '" LIMIT 1';
            $_result = $this->read->exec($this->table_name, $_where);

            if ($_result->result()):
                $this->dados['dados'] = $_result->row();

                /**
                 * GET DADOS DOS APPS RELACIONADOS COM A TEBALA sec_grupos
                 */
                $this->db->where('sec_grupos_id', $_id);
                $this->dados['_apps']['_relat'] = $this->db->get('sec_grupos_has_sec_aplicativos')->result();
                $_r = '';
                foreach ($this->dados['_apps']['_relat'] as $value):

                    $_r[] = $value->sec_aplicativos_app_name;

                endforeach;
                $this->dados['_apps']['_relat'] = $_r;

            else:
                //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_SELECT_UPDATE_REGISTRO_, 'error', 'top-center');
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


        if ($this->form_validation->run() == TRUE):

            $_dados = $this->input->post('dadosdel', TRUE);
            $_dados = explode(',', $_dados);

            /**
             * CHECK RELACIONAMENTO DA TABELA sec_grupos COM sec_usuarios
             */
            $_qr = $this->db->where_in('sec_grupos_id', $_dados);
            $_qr = $this->db->get('sec_usuarios_has_sec_grupos');
            if ($_qr->result()):

                $dados_auditoria['creator'] = 'user';
                $dados_auditoria['action'] = 'del';
                $dados_auditoria['description'] = ___MSG_AUDITORIA_NOT_DELETE_RELAT_REGISTRO___ . ' - ' . 'Relacionamento com a tabela sec_usuarios';
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);

                set_mensagem_sweetalert('ATENÇÃO', ___MSG_NOT_DELETE_RELAT_REGISTRO___ . '\n' . 'Existe um relacionamento com a tabela sec_usuarios.', 'warning');

                exit;
            endif;
            /*
             * END CHECK RELACIONAMENTO DA TABELA sec_grupos COM sec_usuarios
             */


            /*
             * DELETA OS REGISTROS
             */
            $this->db->where_in('id', $_dados);
            $this->db->delete($this->table_name);


            if ($this->db->affected_rows()):
                if (count($_dados) > 1):
                    //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', str_replace('Registro Deletado', 'Registros Deletados', _MSG_DEL_REGISTRO_), 'success', 'top-center');
                    set_mensagem_trigger_notifi(str_replace('Registro Deletado', 'Registros Deletados', ___MSG_DEL_REGISTRO___), 'success');
                    $dados_auditoria['description'] = str_replace('Registro Deletado', 'Registros Deletados', ___MSG_AUDITORIA_DEL_SUCCESS___);
                else:
                    //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_DEL_REGISTRO_, 'success', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_DEL_REGISTRO___, 'success');
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_DEL_SUCCESS___;
                endif;

                //GRAVA AUDITORIA
                $dados_auditoria['creator'] = 'user';
                $dados_auditoria['action'] = 'del';
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);

            else:
                //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_DEL_REGISTRO_, 'error', 'top-center');
                set_mensagem_trigger_notifi(___MSG_ERROR_DEL_REGISTRO___, 'error');
            endif;

        else:
            //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_DE_VALIDACAO_, 'error', 'top-center');
            set_mensagem_trigger_notifi(___MSG_ERROR_DE_VALIDACAO___, 'error');
        endif;

        exit;
    }

//END public function del()


    /*
     * FUNÇÃO  ATIVA/DESATIVA STATUS
     */

    public function status() {


        $_id = $this->uri->segment(3);

        if ($_id):

            /*
             * BUSCA O USUÁRIO NO SISTEMA PARA CONSULTAR SE ESTÁ ATIVO OU INATIVO NO SISTEMA
             */
            $_where = 'WHERE id = "' . $_id . '" LIMIT 1';
            $_result = $this->read->exec($this->table_name, $_where);

            if ($_result->result()):

                /*
                 * GRAVA ALTERAÇÃO DO STATUS
                 */
                $dados['ativo'] = ($_result->row()->ativo == 'Y') ? 'N' : 'Y';
                $dados['id'] = $_result->row()->id;
                $_where = 'WHERE id = "' . $_result->row()->id . '"';

                if ($this->update->exec($this->table_name, $dados, $_where)):
                    //GRAVA AUDITORIA
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'status change';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_STATUS_REGISTRO_SUCCESS___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    add_auditoria($dados_auditoria);

                    //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_STATUS_REGISTRO_, 'success', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_STATUS_REGISTRO___, 'success');

                else:
                    //GRAVA AUDITORIA
                    $dados_auditoria['creator'] = 'system';
                    $dados_auditoria['action'] = 'error status change';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_STATUS_REGISTRO_ERROR___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    add_auditoria($dados_auditoria);

                    //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_STATUS_REGISTRO_, 'error', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_ERROR_STATUS_REGISTRO___, 'error');

                endif;
            else:
                //GRAVA AUDITORIA
                $dados_auditoria['creator'] = 'system';
                $dados_auditoria['action'] = 'error status change';
                $dados_auditoria['description'] = ___MSG_AUDITORIA_NOT_FIND_REGISTRO___;
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);

                //set_mensagem_toastr('ATENÇÃO', _MSG_NOT_FIND_REGISTRO_, 'warning', 'top-center');
                set_mensagem_trigger_notifi(___MSG_NOT_FIND_REGISTRO___, 'warning');

            endif;


            /*
             * CARREGA OS REGISTROS COM PAGINAÇÃO
             */
            $_result_paginacao = $this->get_paginacao();
            redirect($this->_redirect_parametros_url);

        endif;
    }

//END public function status()           

    /*
     * VALIDA POR CALLBACK O CAMPO APPS DO FORM
     */
    public function valid_apps() {

        $p = $this->input->post('apps');
        $r = $result = count($p);

        if ($r > 0):
            return true;
        endif;

        $this->form_validation->set_message('valid_apps', 'O campo {field} é obrigatório.');
        return false;
    }

//END public function valid_apps()       


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
        if ($this->input->get('search', TRUE)):
            $_dados_pag['search'] = array('_concat_fields' => 'descricao, ativo, id, app_name', '_string' => $this->input->get('search', TRUE));
        endif;
        $_dados_pag['filter'] = $_filter;
        $_dados_pag['order_by'] = 'descricao';
        $_dados_pag['programa'] = $this->router->fetch_class();
        $_dados_pag['per_page'] = '10';

        $_result_pag = bz_paginacao($_dados_pag);

        return $_result_pag;
    }

//END private function get_paginacao()       
}

//END class


