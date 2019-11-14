<?php

/*
  Created on : 09/08/2017, 07:46:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends MY_Controller {

    public function __construct() {
        parent::__construct();

        /*
         * TÍTULO DA APLICAÇÃO
         */
        $this->dados['_titulo_app'] = 'Aplicativos';
        $this->dados['_font_icon'] = 'fa fa-code';

        /*
         * VIEW DA APLICAÇÃO
         */
        $this->dados['_view_app_list'] = 'vApps';
        $this->dados['_view_app_add'] = 'vAppsFormAdd';
        $this->dados['_view_app_edit'] = 'vAppsFormEdit';

        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'sec_aplicativos';
    }

    // END function __construct()


    public function index() {
        $this->session->set_flashdata('btn_voltar_link', site_url($this->router->fetch_class()) . '?' . bz_app_parametros_url());
        /*
         * GRAVA A DESCRIÇÃO DOS GRUPOS QUE O APP PERTENCE PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST
         */
        $_r = $this->db->get($this->table_name)->result_array();

        foreach ($_r as $key => $_value):

            $_app_name = $_value['app_name'];

            $this->db->like('app_name', $_app_name);
            $this->db->order_by('app_name');
            $this->db->select('descricao');
            $_rg = $this->db->get('sec_grupos')->result_array();

            $_g = '';
            foreach ($_rg as $row):
                $_g .= '|' . $row['descricao'];
            endforeach;

            $this->db->reset_query();
            $this->db->where('app_name', $_app_name);
            $this->db->update($this->table_name, array('grupo_descricao' => $_g));

        endforeach;
        /*
         * END GRAVA A DESCRIÇÃO DOS GRUPOS QUE O APP PERTENCE PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST
         */


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

        if ($this->input->post()) :


            //Somente Letras/Números e Underlines
            $_POST['app_name'] = bz_limpa_string($_POST['app_name']);

            $this->form_validation->set_rules('app_name', '<b>NOME APP</b>', 'trim|required|min_length[3]|max_length[50]|is_unique[sec_aplicativos.app_name]');
            $this->form_validation->set_rules('app_descricao', '<b>DESCRIÇÃO APP</b>', 'trim|required|min_length[10]|min_length[10]|max_length[250]');

            if ($this->form_validation->run() == TRUE):

                $_dados = $this->input->post();

                unset($_dados['btn-salvar']);
                unset($_dados['task']);

                if (isset($_dados['app_ativo'])):
                    if ($_dados['app_ativo'] == 'on'):
                        $_dados['app_ativo'] = 'Y';
                    else:
                        $_dados['app_ativo'] = 'N';
                    endif;
                else:
                    $_dados['app_ativo'] = 'N';
                endif;


                /**
                 * DADOS FILLABLE
                 */
                $_dadosFillable = $_dados;
                $_dados = [];
                if (!empty($_dadosFillable["app_name"])) {
                    $_dados["app_name"] = $_dadosFillable["app_name"];
                } else {
                    $_dados["app_name"] = NULL;
                }

                if (!empty($_dadosFillable["app_descricao"])) {
                    $_dados["app_descricao"] = $_dadosFillable["app_descricao"];
                } else {
                    $_dados["app_descricao"] = NULL;
                }

                if (!empty($_dadosFillable["app_ativo"])) {
                    $_dados["app_ativo"] = $_dadosFillable["app_ativo"];
                } else {
                    $_dados["app_ativo"] = NULL;
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
                    add_auditoria($dados_auditoria);

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

        if ($this->input->post()):

            if ($this->input->post('btn-editar') == 'btn-editar'):

                $this->form_validation->set_rules('app_descricao', '<b>DESCRIÇÃO APP</b>', 'trim|required|min_length[10]|min_length[10]|max_length[250]');

                if ($this->form_validation->run() == TRUE):

                    unset($_POST['btn-editar']);
                    unset($_POST['task']);

                    /*
                     * GRAVA ALTERAÇÃO DOS DADOS DO APP
                     */
                    $_dados = $this->input->post();

                    if (isset($_dados['app_ativo'])):
                        if ($_dados['app_ativo'] == 'on'):
                            $_dados['app_ativo'] = 'Y';
                        else:
                            $_dados['app_ativo'] = 'N';
                        endif;
                    else:
                        $_dados['app_ativo'] = 'N';
                    endif;

                    /**
                     * DADOS FILLABLE
                     */
                    $_dadosFillable = $_dados;
                    $_dados = [];
                    if (!empty($_dadosFillable["app_name"])) {
                        $_dados["app_name"] = $_dadosFillable["app_name"];
                    } else {
                        $_dados["app_name"] = NULL;
                    }

                    if (!empty($_dadosFillable["app_descricao"])) {
                        $_dados["app_descricao"] = $_dadosFillable["app_descricao"];
                    } else {
                        $_dados["app_descricao"] = NULL;
                    }

                    if (!empty($_dadosFillable["app_ativo"])) {
                        $_dados["app_ativo"] = $_dadosFillable["app_ativo"];
                    } else {
                        $_dados["app_ativo"] = NULL;
                    }
                    /* END DADOS FILLABLE */

                    $_where = 'WHERE app_name = "' . $this->input->post('app_name') . '"';

                    if ($this->update->exec($this->table_name, $_dados, $_where)):
                        //GRAVA AUDITORIA
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_SUCCESS___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

                        //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_UPDATE_REGISTRO_, 'success', 'top-center');
                        set_mensagem_trigger_notifi(___MSG_UPDATE_REGISTRO___, 'success');

                    else:
                        //GRAVA AUDITORIA
                        $dados_auditoria['creator'] = 'system';
                        $dados_auditoria['action'] = 'error edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_ERROR___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

                        //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_ERROR_UPDATE_REGISTRO_, 'error', 'top-center');
                        set_mensagem_trigger_notifi(___MSG_ERROR_UPDATE_REGISTRO___, 'error');

                    endif;

                endif;

            endif;

        endif;

        $_id = $this->uri->segment(3);

        if ($_id):

            /*
             * BUSCA OS DADOS DO APP
             */
            $_where = 'WHERE app_name = "' . $_id . '" LIMIT 1';
            $_result = $this->read->exec($this->table_name, $_where);

            if ($_result->result()):

                $this->dados['dados'] = $_result->row();


            else:
                //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_ERROR_SELECT_UPDATE_REGISTRO_, 'error', 'top-center');
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

            $this->db->where_in('app_name', $_dados);
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
                //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_ERROR_DEL_REGISTRO_, 'error', 'top-center');
                set_mensagem_trigger_notifi(___MSG_ERROR_DEL_REGISTRO___, 'error');
            endif;



        else:
            //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_ERROR_DE_VALIDACAO_, 'error', 'top-center');
            set_mensagem_trigger_notifi(___MSG_ERROR_DE_VALIDACAO___, 'error');
        endif;

        exit;
    }

//END public function del()

    /*
     * FUNÇÃO ATIVA/DESATIVA STATUS
     */

    public function status() {

        $_id = $this->uri->segment(3);

        if ($_id):

            /*
             * BUSCA O USUÁRIO NO SISTEMA PARA CONSULTAR SE ESTÁ ATIVO OU INATIVO NO SISTEMA
             */
            $_where = 'WHERE app_name = "' . $_id . '" LIMIT 1';
            $_result = $this->read->exec($this->table_name, $_where);

            if ($_result->result()):

                /*
                 * GRAVA ALTERAÇÃO DO STATUS DO APP
                 */
                $dados['app_ativo'] = ($_result->row()->app_ativo == 'Y') ? 'N' : 'Y';
                $dados['app_name'] = $_result->row()->app_name;
                $_where = 'WHERE app_name = "' . $_result->row()->app_name . '"';

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

                    //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_ERROR_STATUS_REGISTRO_, 'error', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_ERROR_STATUS_REGISTRO___, 'error');
                endif;
            else:
                //GRAVA AUDITORIA
                $dados_auditoria['creator'] = 'system';
                $dados_auditoria['action'] = 'error status change';
                $dados_auditoria['description'] = ___MSG_AUDITORIA_NOT_FIND_REGISTRO___;
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);

                //set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_NOT_FIND_REGISTRO_, 'warning', 'top-center');
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
            $_dados_pag['search'] = array('_concat_fields' => 'app_name, app_descricao, app_ativo, app_name, grupo_descricao', '_string' => $this->input->get('search', TRUE));
        endif;
        $_dados_pag['filter'] = $_filter;
        $_dados_pag['order_by'] = 'app_name';
        $_dados_pag['programa'] = $this->router->fetch_class();
        $_dados_pag['per_page'] = '10';

        $_result_pag = bz_paginacao($_dados_pag);


        return $_result_pag;
    }

//END private function get_paginacao()       
}

//END class


