<?php

/*
  Created on : 26/03/2018, 08:06:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        /** TÍTULO DA APLICAÇÃO */
        $this->dados['_titulo_app'] = 'Cadastro de Usuários';
        $this->dados['_font_icon'] = 'fa fa-user';

        /*
         * VIEW DA APLICAÇÃO
         */
        $this->dados['_view_app_list'] = 'vUsuarios';
        $this->dados['_view_app_add'] = 'vUsuariosFormAdd';
        $this->dados['_view_app_edit'] = 'vUsuariosFormEdit';

        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'sec_usuarios';
    }

    /** END function __construct() */


    public function index()
    {
        $this->session->set_flashdata('btn_voltar_link', site_url($this->router->fetch_class()) . '?' . bz_app_parametros_url());
        /** CARREGA OS REGISTROS COM PAGINAÇÃO */
        $this->dados['_result'] = $this->get_paginacao();

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = $this->router->fetch_class() . '/' . $this->dados['_view_app_list'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /** END function index() */


    /**
     * FUNÇÃO CADASTRO
     */

    public function add()
    {

        /** CARREGA OS DADOS DOS GRUPOS */
        $this->dados['_grupos']['_result'] = $this->read->exec('sec_grupos', 'ORDER BY descricao')->result();

        /** CARREGA APPs PARA DROPDOWN*/
        $this->dados['_app_inicial']['_result'] = $this->db
            ->select('app_name,app_descricao')
            ->order_by('app_descricao')
            ->get('sec_aplicativos')
            ->result_array();

        if ($this->dados['_app_inicial']['_result']) {
            $this->dados['_app_inicial']['_dropdown'][''] = 'Nenhum';
            foreach ($this->dados['_app_inicial']['_result'] as $_value) {
                $this->dados['_app_inicial']['_dropdown'][$_value['app_name']] = $_value['app_descricao'];
            }
        } else {
            $this->dados['_app_inicial']['_dropdown'][''] = 'Não existem APPs cadastrados até o momento';
        }


        if ($this->input->post()) {

            /** VALIDAÇÃO DOS CAMPOS */
            $this->form_validation->set_rules('nome', '<b>NOME DO USUÁRIO</b>', 'trim|required|min_length[5]|max_length[250]');
            $this->form_validation->set_rules('email', '<b>EMAIL</b>', 'trim|required|valid_email|is_unique[sec_usuarios.email]|min_length[10]|min_length[10]|max_length[250]');
//            $this->form_validation->set_rules('sexo', '<b>SEXO</b>', 'trim|required');
//            $this->form_validation->set_rules('grupos', '<b>GRUPOS</b>', 'callback_valid_grupos');

            if ($this->form_validation->run() == TRUE) {

                $_dados = $this->input->post();

                $_grupos = $_dados['grupos'];

                unset($_dados['btn-salvar']);
                unset($_dados['task']);
                unset($_dados['grupos']);


                if (isset($_dados['super_admin'])) {
                    if ($_dados['super_admin'] == 'on') {
                        $_dados['super_admin'] = 'Y';
                    } else {
                        $_dados['super_admin'] = 'N';
                    }
                } else {
                    $_dados['super_admin'] = 'N';
                }


                if (isset($_dados['ativo'])) {
                    if ($_dados['ativo'] == 'on') {
                        $_dados['ativo'] = 'Y';
                    } else {
                        $_dados['ativo'] = 'N';
                    }
                } else {
                    $_dados['ativo'] = 'N';
                }

                /** GERA UMA SENHA RANDOMINCA */
                $_senha = mc_random_number(6, 6, false, true, true);
                $_dados['senha'] = password_hash($_senha, PASSWORD_DEFAULT);

                /** DADOS FILLABLE */
                $_dadosFillable = $_dados;
                $_dados = [];
                if (!empty($_dadosFillable["nome"])) {
                    $_dados["nome"] = $_dadosFillable["nome"];
                } else {
                    $_dados["nome"] = NULL;
                }

                if (!empty($_dadosFillable["email"])) {
                    $_dados["email"] = $_dadosFillable["email"];
                } else {
                    $_dados["email"] = NULL;
                }

                if (!empty($_dadosFillable["app_inicial"])) {
                    $_dados["app_inicial"] = $_dadosFillable["app_inicial"];
                } else {
                    $_dados["app_inicial"] = NULL;
                }

//                if (!empty($_dadosFillable["sexo"])) {
//                    $_dados["sexo"] = $_dadosFillable["sexo"];
//                } else {
//                    $_dados["sexo"] = NULL;
//                }

                if (!empty($_dadosFillable["super_admin"])) {
                    $_dados["super_admin"] = $_dadosFillable["super_admin"];
                } else {
                    $_dados["super_admin"] = NULL;
                }

                if (!empty($_dadosFillable["ativo"])) {
                    $_dados["ativo"] = $_dadosFillable["ativo"];
                } else {
                    $_dados["ativo"] = NULL;
                }

                if (!empty($_dadosFillable["senha"])) {
                    $_dados["senha"] = $_dadosFillable["senha"];
                } else {
                    $_dados["senha"] = NULL;
                }

                /** END DADOS FILLABLE */


                /** Grava registro */
                $result = $this->create->exec($this->table_name, $_dados);

                if ($result) {

                    /** GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'add';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_ADD_SUCCESS___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    $dados_auditoria['last_query'] = str_replace($this->table_name . ' (', $this->table_name . ' (id, ', $dados_auditoria['last_query']);
                    $dados_auditoria['last_query'] = str_replace('VALUES (', 'VALUES ("' . $result['last_id_add'] . '", ', $dados_auditoria['last_query']);

                    add_auditoria($dados_auditoria);

                    /** GRAVA RELACIONAMENTO COM TABELA sec_agrupos */
                    $_last_id_add_usuario = $result['last_id_add'];
                    $this->db->trans_start();
                    foreach ($_grupos as $_value) {
                        $this->db->insert('sec_usuarios_has_sec_grupos', array('sec_usuarios_id' => $_last_id_add_usuario, 'sec_grupos_id' => $_value));
                    }
                    $this->db->trans_complete();

                    /** GRAVA A DESCRIÇÃO DOS GRUPOS E OS NOMES DOS APPS QUE O USUÁRIO PERTENCE PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST */
                    $_acl_user = $this->user_acl_groups->_get_acl_user_by_email($_dados['email']);

                    $_a = '';
                    $_g = '';
                    foreach ($_acl_user as $value) {

                        if (strpos($_a, $value['app_name']) == false) {
                            $_a .= '|' . $value['app_name'];
                        }

                        if (strpos($_g, $value['grupo_descricao']) == false) {
                            $_g .= '|' . $value['grupo_descricao'];
                        }
                    }

                    $this->db->reset_query();
                    $this->db->set('app_name', $_a);
                    $this->db->set('grupo_descricao', $_g);
                    $this->db->where('id', $_last_id_add_usuario);
                    $this->db->update($this->table_name);
                    /**  END GRAVA A DESCRIÇÃO DOS GRUPOS E OS NOMES DOS APPS QUE O USUÁRIO PERTENCE PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST */


                    /** GRAVA AUDITORIA */
                    $this->db->reset_query();
                    $this->db->where('sec_usuarios_id', $_last_id_add_usuario);
                    $_r = $this->db->get('sec_usuarios_has_sec_grupos');
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'add alc groups';
                    $dados_auditoria['description'] = 'ACL Grupo de Acesso';
                    $dados_auditoria['last_query'] = print_r($_r->result(), true);
                    add_auditoria($dados_auditoria);

                    set_mensagem_sweetalert('SUCESSO', 'Usuário Cadastrado com Sucesso\n\nLogin: ' . $_dados['email'] . ' - Senha: ' . $_senha, 'success');
                } else {
                    echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_name);
                    exit;
                }

                redirect($this->_redirect . '/add');
            }
        }


        /** TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_add'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /** END public function add() */


    /**
     * FUNÇÃO EDIÇÃO
     */

    public function edit()
    {

        /** CARREGA OS DADOS DOS GRUPOS  */
        $this->dados['_grupos']['_result'] = $this->read->exec('sec_grupos', 'ORDER BY descricao')->result();

        /** CARREGA APPs PARA DROPDOWN*/
        $this->dados['_app_inicial']['_result'] = $this->db
            ->select('app_name,app_descricao')
            ->order_by('app_descricao')
            ->get('sec_aplicativos')
            ->result_array();

        if ($this->dados['_app_inicial']['_result']) {
            $this->dados['_app_inicial']['_dropdown'][''] = 'Nenhum';
            foreach ($this->dados['_app_inicial']['_result'] as $_value) {
                $this->dados['_app_inicial']['_dropdown'][$_value['app_name']] = $_value['app_descricao'];
            }
        } else {
            $this->dados['_app_inicial']['_dropdown'][''] = 'Nao existem APPs cadastrados até o momento';
        }

        if ($this->input->post()) {

            if ($this->input->post('btn-editar') == 'btn-editar') {

                $this->form_validation->set_rules('nome', '<b>NOME DO USUÁRIO</b>', 'trim|required|min_length[5]|max_length[250]');
//                $this->form_validation->set_rules('sexo', '<b>SEXO</b>', 'trim|required');
//                $this->form_validation->set_rules('grupos', '<b>GRUPOS</b>', 'callback_valid_grupos');

                if ($this->form_validation->run() == TRUE) {

                    $_dados = $this->input->post();

                    $_grupos = $_dados['grupos'];
                    $_email = $_dados['email'];

                    unset($_dados['btn-editar']);
                    unset($_dados['task']);
                    unset($_dados['grupos']);
                    unset($_dados['email']);


                    /** GRAVA ALTERAÇÃO DOS DADOS DO GRUPO */

                    if (isset($_dados['super_admin'])) {
                        if ($_dados['super_admin'] == 'on') {
                            $_dados['super_admin'] = 'Y';
                        } else {
                            $_dados['super_admin'] = 'N';
                        }
                    } else {
                        $_dados['super_admin'] = 'N';
                    }


                    if (isset($_dados['ativo'])) {
                        if ($_dados['ativo'] == 'on') {
                            $_dados['ativo'] = 'Y';
                        } else {
                            $_dados['ativo'] = 'N';
                        }
                    } else {
                        $_dados['ativo'] = 'N';
                    }


                    /** SE O USUÁRIO FOR O USUÁRIO CORRENTE/LOGADO DO SISTEMA, ELE NÃO PODERÁ PERDER O STATUS DE SUPER ADMIN NEM SER DESATIVADO DO SISTEMA */
                    if ($this->current_super_admin($this->input->post('id')) == FALSE) {
                        $_dados['super_admin'] = 'Y';
                        $_dados['ativo'] = 'Y';
                    }
                    /** END SE O USUÁRIO FOR O USUÁRIO CORRENTE/LOGADO DO SISTEMA, ELE NÃO PODERÁ PERDER O STATUS DE SUPER ADMIN NEM SER DESATIVADO DO SISTEMA */


                    /** DADOS FILLABLE */
                    $_dadosFillable = $_dados;
                    $_dados = [];

                    $_dados["id"] = $_dadosFillable["id"];

                    if (!empty($_dadosFillable["nome"])) {
                        $_dados["nome"] = $_dadosFillable["nome"];
                    } else {
                        $_dados["nome"] = NULL;
                    }

//                    if (!empty($_dadosFillable["sexo"])) {
//                        $_dados["sexo"] = $_dadosFillable["sexo"];
//                    } else {
//                        $_dados["sexo"] = NULL;
//                    }

                    if (!empty($_dadosFillable["super_admin"])) {
                        $_dados["super_admin"] = $_dadosFillable["super_admin"];
                    } else {
                        $_dados["super_admin"] = NULL;
                    }

                    if (!empty($_dadosFillable["ativo"])) {
                        $_dados["ativo"] = $_dadosFillable["ativo"];
                    } else {
                        $_dados["ativo"] = NULL;
                    }

                    if (!empty($_dadosFillable["app_inicial"])) {
                        $_dados["app_inicial"] = $_dadosFillable["app_inicial"];
                    } else {
                        $_dados["app_inicial"] = NULL;
                    }

                    /** END DADOS FILLABLE */


                    $_where = 'WHERE id = "' . $this->input->post('id') . '"';

                    if ($this->update->exec($this->table_name, $_dados, $_where)) {

                        /* GRAVA AUDITORIA */
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_SUCCESS___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

                        /** GRAVA ALTERAÇÕES NA TABELA FILHO sec_usuarios_has_sec_grupos */
                        /* DELETA OS REGISTROS QUE FORAM REMOVIDOS DO CADASTRO */
                        $this->db->trans_start();
                        $this->db->reset_query();
                        $this->db->where('sec_usuarios_id', $this->input->post('id'));
                        $this->db->where_not_in('sec_grupos_id', $_grupos);
                        $this->db->delete('sec_usuarios_has_sec_grupos');
                        $this->db->trans_complete();


                        /** GRAVA OS REGISTRO NOVOS */
                        $this->db->trans_start();
                        $this->db->reset_query();
                        foreach ($_grupos as $_value) {
                            $this->db->replace('sec_usuarios_has_sec_grupos', array('sec_usuarios_id' => $this->input->post('id'), 'sec_grupos_id' => $_value));
                        }
                        $this->db->trans_complete();

                        $this->db->reset_query();
                        $this->db->where('sec_usuarios_id', $this->input->post('id'));
                        $_r = $this->db->get('sec_usuarios_has_sec_grupos');

                        /** GRAVA AUDITORIA */
                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'update acl groups';
                        $dados_auditoria['description'] = 'ACL Grupo de Acesso';
                        $dados_auditoria['last_query'] = print_r($_r->result(), true);
                        add_auditoria($dados_auditoria);


                        /** GRAVA A DESCRIÇÃO DOS GRUPOS E OS NOMES DOS APPS QUE O USUÁRIO PERTENCE PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST */
                        $_acl_user = $this->user_acl_groups->_get_acl_user_by_email($_email);

                        $_a = '';
                        $_g = '';
                        foreach ($_acl_user as $value) {

                            if (strpos($_a, $value['app_name']) == false) {
                                $_a .= '|' . $value['app_name'];
                            }

                            if (strpos($_g, $value['grupo_descricao']) == false) {
                                $_g .= '|' . $value['grupo_descricao'];
                            }
                        }

                        $this->db->reset_query();
                        $this->db->set('app_name', $_a);
                        $this->db->set('grupo_descricao', $_g);
                        $this->db->where('id', $this->input->post('id'));
                        $this->db->update($this->table_name);
                        /** END GRAVA A DESCRIÇÃO DOS GRUPOS E OS NOMES DOS APPS QUE O USUÁRIO PERTENCE PARA UTILIZAR NA FILTRAGEM DA PAGINAÇÃO E FILTRAGEM DE GRID/LIST */

                        set_mensagem_trigger_notifi(___MSG_UPDATE_REGISTRO___, 'success');

                    } else {

                        /** GRAVA AUDITORIA */
                        $dados_auditoria['creator'] = 'system';
                        $dados_auditoria['action'] = 'error edit';
                        $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_ERROR___;
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);

//set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_UPDATE_REGISTRO_, 'error', 'top-center');
                        set_mensagem_trigger_notifi(___MSG_ERROR_UPDATE_REGISTRO___, 'error');
                    }
                }
            }
        }

        $_id = $this->uri->segment(3);

        if ($_id) {

            /** BUSCA OS DADOS */
            $_where = 'WHERE id = "' . $_id . '" LIMIT 1';
            $_result = $this->read->exec($this->table_name, $_where);

            if ($_result->result()) {
                $this->dados['dados'] = $_result->row();

                /** GET DADOS DOS GRUPOS RELACIONADOS COM A TEBALA sec_usuarios */
                $this->db->where('sec_usuarios_id', $_id);
                $this->dados['_grupos']['_relat'] = $this->db->get('sec_usuarios_has_sec_grupos')->result();
                $_r = [];
                foreach ($this->dados['_grupos']['_relat'] as $value) {

                    $_r[] = $value->sec_grupos_id;
                }
                $this->dados['_grupos']['_relat'] = $_r;
            } else {
//set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_SELECT_UPDATE_REGISTRO_, 'error', 'top-center');
                set_mensagem_trigger_notifi(___MSG_ERROR_SELECT_UPDATE_REGISTRO___, 'error');
                redirect($this->_redirect_parametros_url);
            }
        } else {
            redirect($this->_redirect_parametros_url);
        }

        /** TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_edit'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /** END public function edit() */


    /**
     * FUNÇÃO DELETAR
     */

    public function del()
    {

        /** CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX */
        bz_check_is_ajax_request();

        $this->form_validation->set_rules('btndel', '<b>BTN Del</b>', 'trim|required');
        $this->form_validation->set_rules('dadosdel', '<b>REGISTROS DEL</b>', 'trim|required');


        if ($this->form_validation->run() == TRUE) {

            $_dados = $this->input->post('dadosdel', TRUE);
            $_dados = explode(',', $_dados);


            /** SE O USUÁRIO FOR O USUÁRIO CORRENTE/LOGADO DO SISTEMA, ELE NÃO PODERÁ SER DELETADO */
            foreach ($_dados as $_vId) {
                if ($this->current_super_admin($_vId) == FALSE) {
                    set_mensagem_trigger_notifi('Este USUÁRIO [ ID:' . $_vId . ' ] não pode ser DELETADO.', 'warning');
                    return false;
                }
            }
            /** END SE O USUÁRIO FOR O USUÁRIO CORRENTE/LOGADO DO SISTEMA, ELE NÃO PODERÁ SER DELETADO */

            /** DELETA OS REGISTROS */
            $this->db->where_in('id', $_dados);
            $this->db->delete($this->table_name);


            if ($this->db->affected_rows()) {
                if (count($_dados) > 1) {
//set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', str_replace('Registro Deletado', 'Registros Deletados', _MSG_DEL_REGISTRO_), 'success', 'top-center');
                    set_mensagem_trigger_notifi(str_replace('Registro Deletado', 'Registros Deletados', ___MSG_DEL_REGISTRO___), 'success');
                    $dados_auditoria['description'] = str_replace('Registro Deletado', 'Registros Deletados', ___MSG_AUDITORIA_DEL_SUCCESS___);
                } else {
//set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_DEL_REGISTRO_, 'success', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_DEL_REGISTRO___, 'success');
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_DEL_SUCCESS___;
                }

                /* GRAVA AUDITORIA */
                $dados_auditoria['creator'] = 'user';
                $dados_auditoria['action'] = 'del';
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);
            } else {
//set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_DEL_REGISTRO_, 'error', 'top-center');
                set_mensagem_trigger_notifi(___MSG_ERROR_DEL_REGISTRO___, 'error');
            }
        } else {
//set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_DE_VALIDACAO_, 'error', 'top-center');
            set_mensagem_trigger_notifi(___MSG_ERROR_DE_VALIDACAO___, 'error');
        }

        exit;
    }

    /** END public function del() */


    /**
     * FUNÇÃO  ATIVA/DESATIVA STATUS
     */

    public function status()
    {

        $_id = $this->uri->segment(3);

        if ($_id) {

            /** SE O USUÁRIO FOR O USUÁRIO CORRENTE/LOGADO DO SISTEMA, ELE NÃO PODERÁ SER DESATIVADO */
            if ($this->current_super_admin($_id) == FALSE) {
                set_mensagem_trigger_notifi('Este USUÁRIO [ ID:' . $_id . ' ] não pode ser DESATIVADO.', 'warning');

                /** CARREGA OS REGISTROS COM PAGINAÇÃO */
                $_result_paginacao = $this->get_paginacao();
                redirect($this->_redirect_parametros_url);

                return false;
            }
            /** END SE O USUÁRIO FOR O USUÁRIO CORRENTE/LOGADO DO SISTEMA, ELE NÃO PODERÁ SER DESATIVADO */


            /** BUSCA O USUÁRIO NO SISTEMA PARA CONSULTAR SE ESTÁ ATIVO OU INATIVO NO SISTEMA */
            $_where = 'WHERE id = "' . $_id . '" LIMIT 1';
            $_result = $this->read->exec($this->table_name, $_where);

            if ($_result->result()) {

                /** GRAVA ALTERAÇÃO DO STATUS */
                $dados['ativo'] = ($_result->row()->ativo == 'Y') ? 'N' : 'Y';
                $dados['id'] = $_result->row()->id;
                $_where = 'WHERE id = "' . $_result->row()->id . '"';

                if ($this->update->exec($this->table_name, $dados, $_where)) {
                    /* GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'status change';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_STATUS_REGISTRO_SUCCESS___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    add_auditoria($dados_auditoria);

//set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-up" style="font-size: 1.5em"></i>', _MSG_STATUS_REGISTRO_, 'success', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_STATUS_REGISTRO___, 'success');
                } else {
                    /** GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'system';
                    $dados_auditoria['action'] = 'error status change';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_STATUS_REGISTRO_ERROR___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    add_auditoria($dados_auditoria);

//set_mensagem_toastr('<i class="fa fa-fw fa-thumbs-o-down" style="font-size: 1.5em"></i>', _MSG_ERROR_STATUS_REGISTRO_, 'error', 'top-center');
                    set_mensagem_trigger_notifi(___MSG_ERROR_STATUS_REGISTRO___, 'error');
                }
            } else {
                /** GRAVA AUDITORIA */
                $dados_auditoria['creator'] = 'system';
                $dados_auditoria['action'] = 'error status change';
                $dados_auditoria['description'] = ___MSG_AUDITORIA_NOT_FIND_REGISTRO___;
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);

//set_mensagem_toastr('ATENÇÃO', _MSG_NOT_FIND_REGISTRO_, 'warning', 'top-center');
                set_mensagem_trigger_notifi(___MSG_NOT_FIND_REGISTRO___, 'warning');
            }


            /** CARREGA OS REGISTROS COM PAGINAÇÃO */
            $_result_paginacao = $this->get_paginacao();
            redirect($this->_redirect_parametros_url);
        }
    }

    /** END public function status() */


    /*
     * VALIDA POR CALLBACK O CAMPO GRUPOS DO FORM
     */
    public function valid_grupos()
    {

        $p = $this->input->post('grupos');
        $r = $result = count($p);

        if ($r > 0) {
            return true;
        }

        $this->form_validation->set_message('valid_grupos', 'O campo {field} é obrigatório.');
        return false;
    }

    /** END public function valid_grupos() */


    /**
     * DESCONECTA USUÁRIO DO SISTEMA
     */

    public function poweroff()
    {

        $_r = array('success' => 'false');

        if ($_POST && $_POST['task'] == 'poweroffuser') {

            $_id = $this->input->post('id');
            $_email = $this->input->post('email');
            $_nome = strtoupper($this->input->post('nome'));

            $_r = '';

            if ($this->session->userdata('user_login')['user_email'] == $_email) {
                $_r = array('notpoweroff' => 'true', 'csrf_token' => $this->security->get_csrf_hash());
                echo json_encode($_r);
                exit;
            } else {

                $this->db->like('data', $_email);
                $this->db->delete('ci_sessions');

                if ($this->db->affected_rows()) {

                    /* GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'poweroff user';
                    $dados_auditoria['description'] = "Usuário: {$_nome} - Email: {$_email}, Desconectado do Sistema pelo ADMIN.";
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    add_auditoria($dados_auditoria);

                    $_r = array('success' => 'true', 'csrf_token' => $this->security->get_csrf_hash());
                    echo json_encode($_r);
                    exit;
                }
            }
        }

        echo json_encode($_r);

        exit;
    }

    /** END public function poweroff() */


    /**
     * CHANGE PASS - ALTERA A SENHA DO USUÁRIO
     */

    public function changepass()
    {

        /** CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX */
        bz_check_is_ajax_request();

        $_r = array('success' => 'false');

        if ($_POST && $_POST['task'] == 'changepass') {

            $_id = $this->input->post('id');
            $_email = $this->input->post('email');
            $_pass = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);

            /** BUSCA OS DADOS */
            $_where = 'WHERE id = ' . $_id . ' AND email = "' . $_email . '" LIMIT 1';
            $_result = $this->read->exec($this->table_name, $_where);

            if ($_result->result()) {

                /** ALTERA A SENHA DO USUÁRIO */

                $_dados['senha'] = $_pass;

                if ($this->update->exec($this->table_name, $_dados, $_where)) {

                    $_r = array('success' => 'true', 'csrf_token' => $this->security->get_csrf_hash());

                    /* GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'change pass admin';
                    $dados_auditoria['description'] = 'Alteração de Senha feito pelo Admin';
                    add_auditoria($dados_auditoria);
                }
            }
        }

        echo json_encode($_r);

        exit;
    }

    /** END public function changepass() */


    /**
     * CARREGA REGISTROS COM PAGINAÇÃO
     */

    private function get_paginacao()
    {

        $_filter = $this->input->get();
        unset($_filter['pg']);
        unset($_filter['search']);

        /** DADOS PARA PAGINAÇÃO */
        $_dados_pag['table'] = $this->table_name;
        if ($this->input->get('search', TRUE)) {
            $_dados_pag['search'] = array('_concat_fields' => 'nome, email, super_admin, ativo, id, app_name, grupo_descricao', '_string' => $this->input->get('search', TRUE));
        }
        $_dados_pag['filter'] = $_filter;
        $_dados_pag['order_by'] = 'nome';
        $_dados_pag['programa'] = $this->router->fetch_class();
        $_dados_pag['per_page'] = '10';

        $_result_pag = bz_paginacao($_dados_pag);

        return $_result_pag;
    }

    /** END private function get_paginacao() */


    /**
     * SUPER ADMIN COUNT
     */
    private function current_super_admin($_id)
    {

        $_where = 'WHERE id = "' . $_id . '"';
        $_result = $this->read->exec($this->table_name, $_where)->row();

        if ($_result) {

            $user_data_email = $this->session->userdata('user_login')['user_email'];

            if ($_result->email == $user_data_email) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    /** END private function current_super_admin() */
}

/** END class */


