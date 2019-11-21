<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

    public function __construct() {
        parent::__construct();

        /*
         * TÍTULO DA APLICAÇÃO
         */
        $this->dados['_titulo_app'] = 'Menu';
        $this->dados['_font_icon'] = 'fa fa-list';

        /*
         * VIEW DA APLICAÇÃO
         */
        $this->dados['_view_app_list'] = 'vMenus';
        $this->dados['_view_app_add'] = 'vMenusFormAdd';
        $this->dados['_view_app_edit'] = 'vMenusFormEdit';

        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'sec_menus';
    }

    // END function __construct()

    public function index() {
        $this->session->set_flashdata('btn_voltar_link', site_url($this->router->fetch_class()) . '?' . bz_app_parametros_url());

        /*
         * CARREGA OS REGISTROS COM PAGINAÇÃO
         */
        $this->dados['_result'] = $this->get_paginacao();

        /*
         * CARREGA MENU PAI
         */
        $this->dados['_menupai']['_result'] = $this->read->exec('sec_menus', 'WHERE nivel_menu = 0 ORDER BY nome_menu')->result();

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = $this->router->fetch_class() . '/' . $this->dados['_view_app_list'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /*
     * FUNÇÃO CADASTRO
     */

    public function add() {

        /*
         * CARREGA OS DADOS DOS APLICATIVOS
         */
        $this->dados['_apps']['_result'] = $this->read->exec('sec_aplicativos', 'ORDER BY app_descricao')->result();

        /*
         * CARREGA MENU PAI
         */
        $this->dados['_menupai']['_result'] = $this->read->exec('sec_menus', 'WHERE nivel_menu = 0 ORDER BY nome_menu')->result();


        if ($this->input->post()) :

            $this->form_validation->set_rules('nome_menu', '<b>NOME MENU</b>', 'trim|required|min_length[3]|max_length[250]');

            if ($this->form_validation->run() == TRUE):

                $_dados = $this->input->post();

                unset($_dados['btn-salvar']);

                if (isset($_dados['ativo'])):
                    if ($_dados['ativo'] == 'on'):
                        $_dados['ativo'] = 'Y';
                    else:
                        $_dados['ativo'] = 'N';
                    endif;
                else:
                    $_dados['ativo'] = 'N';
                endif;

                if ($_dados['parent_id']):
                    $_NivelMenuiID = $this->read->exec('sec_menus', 'WHERE id = ' . $_dados['parent_id'] . ' ORDER BY nome_menu')->row()->nivel_menu;
                    $_dados['nivel_menu'] = $_NivelMenuiID + 1;
                endif;


                /**
                 * DADOS FILLABLE
                 */
                $_dadosFillable = $_dados;
                $_dados = [];

                if (!empty($_dadosFillable["nome_menu"])) {
                    $_dados["nome_menu"] = $_dadosFillable["nome_menu"];
                } else {
                    $_dados["nome_menu"] = NULL;
                }

                if (!empty($_dadosFillable["menu_icon"])) {
                    $_dados["menu_icon"] = $_dadosFillable["menu_icon"];
                } else {
                    $_dados["menu_icon"] = NULL;
                }

                if (!empty($_dadosFillable["descricao_menu"])) {
                    $_dados["descricao_menu"] = $_dadosFillable["descricao_menu"];
                } else {
                    $_dados["descricao_menu"] = NULL;
                }

                if (!empty($_dadosFillable["app_name"])) {
                    $_dados["app_name"] = $_dadosFillable["app_name"];
                } else {
                    $_dados["app_name"] = NULL;
                }

                if (!empty($_dadosFillable["parent_id"])) {
                    $_dados["parent_id"] = $_dadosFillable["parent_id"];
                } else {
                    $_dados["parent_id"] = NULL;
                }

                if (!empty($_dadosFillable["ativo"])) {
                    $_dados["ativo"] = $_dadosFillable["ativo"];
                } else {
                    $_dados["ativo"] = NULL;
                }

                if (!empty($_dadosFillable["nivel_menu"])) {
                    $_dados["nivel_menu"] = $_dadosFillable["nivel_menu"];
                } else {
                    $_dados["nivel_menu"] = NULL;
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

        /*
         * CARREGA MENU PAI
         */
        $this->dados['_menupai']['_result'] = $this->read->exec('sec_menus', 'WHERE nivel_menu = 0 ORDER BY nome_menu')->result();

        if ($this->input->post()):

            if ($this->input->post('btn-editar') == 'btn-editar'):

                $this->form_validation->set_rules('nome_menu', '<b>NOME MENU</b>', 'trim|required|min_length[3]|max_length[250]');

                if ($this->form_validation->run() == TRUE):

                    $_dados = $this->input->post();

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

                    $_dados["id"] = $_dadosFillable["id"];

                    if (!empty($_dadosFillable["nome_menu"])) {
                        $_dados["nome_menu"] = $_dadosFillable["nome_menu"];
                    } else {
                        $_dados["nome_menu"] = NULL;
                    }

                    if (!empty($_dadosFillable["menu_icon"])) {
                        $_dados["menu_icon"] = $_dadosFillable["menu_icon"];
                    } else {
                        $_dados["menu_icon"] = NULL;
                    }

                    if (!empty($_dadosFillable["descricao_menu"])) {
                        $_dados["descricao_menu"] = $_dadosFillable["descricao_menu"];
                    } else {
                        $_dados["descricao_menu"] = NULL;
                    }

                    if (!empty($_dadosFillable["app_name"])) {
                        $_dados["app_name"] = $_dadosFillable["app_name"];
                    } else {
                        $_dados["app_name"] = NULL;
                    }

                    if (!empty($_dadosFillable["parent_id"])) {
                        $_dados["parent_id"] = $_dadosFillable["parent_id"];
                    } else {
                        $_dados["parent_id"] = NULL;
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
             * CHECK SE TEM MENU FILHO
             */
            $_qr = $this->db->where_in('parent_id', $_dados);
            $_qr = $this->db->get($this->table_name);
            if ($_qr->result()):

                $dados_auditoria['creator'] = 'user';
                $dados_auditoria['action'] = 'del';
                $dados_auditoria['description'] = ___MSG_AUDITORIA_NOT_DELETE_RELAT_REGISTRO___ . ' - ' . 'Relacionamento com Menu Filho.';
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);

                set_mensagem_sweetalert('ATENÇÃO', ___MSG_NOT_DELETE_RELAT_REGISTRO___ . '\n' . 'Existe um relacionamento com Menu Filho.', 'warning');

                exit;
            endif;
            /*
             * END CHECK SE TEM MENU FILHO
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
             * BUSCA O MENU NO SISTEMA PARA CONSULTAR SE ESTÁ ATIVO OU INATIVO NO SISTEMA
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

                /**
                 *
                 * GRAVA ALTERAÇÃO DO STATUS NOS APPS
                 * 
                 * QUANDO UM MENU PAI MUDA SEU STATUS (ATIVO/INATIVO), TODOS OS MENUS FILHOE E OS APPS QUE ESTÃO ATRELADOS A ESTES MENUS
                 * TAMBÉM SOFREM A ALTERAÇÃO EM SEU STATUS. O STATUS DOS APPS SERÁ O MESMO DO STATUS DO MENU PAI 
                 */
                sleep(1);
                // QUANDO SOMENTE O MENU FILHO SOFRE ALTERAÇÃO EM SEU STATUS
                if (!empty($_result->row()->app_name)):

                    $dados_app = [];
                    $dados_app['app_ativo'] = ($_result->row()->ativo == 'Y') ? 'N' : 'Y';
                    $dados_app['app_name'] = $_result->row()->app_name;
                    $_where_app = 'WHERE app_name = "' . $dados_app['app_name'] . '"';

                    // GRAVA A AUDITORIA DA ALTERAÇÃO
                    if ($this->update->exec('sec_aplicativos', $dados_app, $_where_app)):
                        //GRAVA AUDITORIA
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'status change Aplicativos by the Menus';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_STATUS_REGISTRO_SUCCESS___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);
                    else:
                        //GRAVA AUDITORIA
                        $dados_auditoria['creator'] = 'system';
                        $dados_auditoria['action'] = 'error status change Aplicativos by the Menus';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_STATUS_REGISTRO_ERROR___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);
                    endif;

                // QUANDO SOMENTE O MENU PAI SOFRE ALTERAÇÃO EM SEU STATUS
                elseif (empty($_result->row()->parent_id) && $_result->row()->nivel_menu == 0):

                    $dados_menu['ativo'] = ($_result->row()->ativo == 'Y') ? 'N' : 'Y';
                    $_where_menu = 'WHERE parent_id = ' . $_result->row()->id;
                    $_r_menu = $this->update->exec('sec_menus', $dados_menu, $_where_menu);

                    if ($_r_menu):

                        $this->db->where('parent_id', $_result->row()->id);
                        $_q_menu = $this->db->get('sec_menus');

                        foreach ($_q_menu->result_array() as $_row_menu) :
                            $dados_app = [];
                            $dados_app['app_ativo'] = ($_result->row()->ativo == 'Y') ? 'N' : 'Y';
                            $dados_app['app_name'] = $_row_menu['app_name'];
                            $_where_app = 'WHERE app_name = "' . $dados_app['app_name'] . '"';

                            // GRAVA A AUDITORIA DAS ALTERAÇÕES
                            if ($this->update->exec('sec_aplicativos', $dados_app, $_where_app)):
                                //GRAVA AUDITORIA
                                $dados_auditoria['creator'] = 'user';
                                $dados_auditoria['action'] = 'status change Aplicativos by the Menus';
                                $dados_auditoria['description'] = ___MSG_AUDITORIA_STATUS_REGISTRO_SUCCESS___;
                                $dados_auditoria['last_query'] = $this->db->last_query();
                                add_auditoria($dados_auditoria);
                            else:
                                //GRAVA AUDITORIA
                                $dados_auditoria['creator'] = 'system';
                                $dados_auditoria['action'] = 'error status change Aplicativos by the Menus';
                                $dados_auditoria['description'] = ___MSG_AUDITORIA_STATUS_REGISTRO_ERROR___;
                                $dados_auditoria['last_query'] = $this->db->last_query();
                                add_auditoria($dados_auditoria);
                            endif;
                        endforeach;
                    endif;
                endif; // END GRAVA ALTERAÇÃO DO STATUS NOS APPS

            else:
                //GRAVA AUDITORIA
                $dados_auditoria['creator'] = 'system';
                $dados_auditoria['action'] = 'error status change';
                $dados_auditoria['description'] = ___MSG_AUDITORIA_NOT_FIND_REGISTRO___;
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);
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
        if (!empty($_filter['search_menu_pai'])):
            $_menuPai = $_filter['search_menu_pai'];
        endif;
        unset($_filter['search_menu_pai']);
        unset($_filter['pg']);
        unset($_filter['search']);

        /*
         * DADOS PARA PAGINAÇÃO
         */
        $_dados_pag['table'] = $this->table_name;
        if ($this->input->get('search', TRUE)):
            $_dados_pag['search'] = array('_concat_fields' => 'nome_menu, descricao_menu, app_name, ativo', '_string' => $this->input->get('search', TRUE));
        endif;
        $_dados_pag['filter'] = $_filter;

        if (!empty($_menuPai)):
            $_dados_pag['where'] = '(id=' . $_menuPai;
            $_dados_pag['or_where'] = 'parent_id=' . $_menuPai . ')';
        endif;

        $_dados_pag['order_by'] = 'nivel_menu, nome_menu';

        $_dados_pag['programa'] = $this->router->fetch_class();
        $_dados_pag['per_page'] = '999';

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

}
