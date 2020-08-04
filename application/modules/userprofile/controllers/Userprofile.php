<?php

/*
  Created on : 01/08/2017, 11:05:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Userprofile extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $_task = $this->input->get('task');

        if ($_task == 'changepass') {
            $this->dados['_pane1changepasssactive'] = '';
            $this->dados['_pane2changepasssactive'] = 'Y';
        } else {
            $this->dados['_pane1changepasssactive'] = 'Y';
            $this->dados['_pane2changepasssactive'] = '';
        }

        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'sec_usuarios';

        if ($this->input->post()) {

            if ($this->input->post('task') == 'update_user') {

                /*
                 * VALIDAÇÃO DOS DADOS DO FORMULÁRIO
                 */
                $this->form_validation->set_rules('nome', '<b>Nome</b>', 'trim|required|min_length[10]|max_length[250]|xss_clean');
//                $this->form_validation->set_rules('sexo', '<b>Sexo</b>', 'trim|required|xss_clean');

                if ($this->form_validation->run() == TRUE) {

                    $this->save_user();
                } else {
                    set_mensagem_trigger_notifi(___MSG_ERROR_DE_VALIDACAO___, 'error');
                }
            } elseif ($this->input->post('task') == 'user_change_pass') {

                $this->dados['_pane1changepasssactive'] = '';
                $this->dados['_pane2changepasssactive'] = 'Y';

                /*
                 * FAZ A VALIDAÇÃO DOS CAMPOS DO FORMULÁRIO.
                 */
//$this->form_validation->set_message('matches', 'O Campo %s está diferente do campo %s.');
                $this->form_validation->set_rules('email', '<b>Email</b>', 'trim|required|min_length[10]|max_length[250]|xss_clean');
                $this->form_validation->set_rules('senha_atual', '<b>Senha Atual</b>', 'trim|required|min_length[6]|max_length[20]');
                $this->form_validation->set_rules('nova_senha', '<b>Nova Senha</b>', 'trim|required|min_length[6]|strtolower|xss_clean');
                $this->form_validation->set_rules('confirme_nova_senha', '<b>Confirme Nova Senha</b>', 'trim|required|min_length[6]|strtolower|xss_clean|matches[nova_senha]');

                if ($this->form_validation->run() == TRUE) {

                    $_POST['email'] = xss_clean($this->input->post('email', TRUE));
                    $_POST['senha_atual'] = $this->input->post('senha_atual', TRUE);

                    if (!$this->check_senha_atual($_POST['email'], $_POST['senha_atual'])) {
                        set_mensagem_sweetalert('Erro', 'Senha Atual Não Confere.', 'error');
                        redirect(site_url('userprofile'), 'refresh');
                        exit;
                    }


                    if ($this->change_pass_user($_POST['email'], $_POST['confirme_nova_senha'])) {

                        set_mensagem_trigger_notifi('Senha Alterada com Sucesso.', 'success');
                    } else {

                        set_mensagem_trigger_notifi('Erro ao Alterar sua Senha.', 'error');
                    }
                } else {

                    set_mensagem_trigger_notifi(___MSG_ERROR_DE_VALIDACAO___, 'error');
                }
            } else {
                set_mensagem_trigger_notifi(___MSG_ERROR_DE_VALIDACAO___, 'error');
            }
        }
    }

    /* END function __construct() */

    public function index() {

        /*
         * GET DADOS USUÁRIO
         */
        $termosDB = array();
        $termosDB = 'WHERE email = "' . $this->session->userdata['user_login']['user_email'] . '" LIMIT 1';

        $result = $this->read->exec($this->table_name, $termosDB)->row();

        if ($result) {

            unset($result->senha);

            $this->dados['_dados_usuario'] = $result;
        }

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = 'vUserprofile';
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /* END function index() */

    /*
     * SAVE USER DADOS
     */

    private function save_user() {

        $_id = $this->input->post('id', TRUE);

        unset($_POST['id']);
        unset($_POST['task']);


        /**
         * DADOS FILLABLE
         */
        $_dadosFillable = $this->input->post();
        $_dados = [];

        $_dados["nome"] = $_dadosFillable["nome"];
//        $_dados["sexo"] = $_dadosFillable["sexo"];

        /* END DADOS FILLABLE */

        $termosDB = 'WHERE id = ' . $_id;

        $result = $this->update->exec($this->table_name, $_dados, $termosDB);

        if ($result) {
            /* GRAVA AUDITORIA */
            $dados_auditoria['creator'] = 'user';
            $dados_auditoria['action'] = 'update user';
            $dados_auditoria['description'] = 'Dados do Usuário Atualizados com Sucesso';
            $dados_auditoria['last_query'] = $this->db->last_query();
            add_auditoria($dados_auditoria);
            set_mensagem_trigger_notifi(___MSG_UPDATE_REGISTRO___, 'success');
        }
    }

    /* END function save_user() */

    private function change_pass_user($_email, $_senha) {

        $_senha = password_hash($_senha, PASSWORD_DEFAULT);

        $termosDB = 'WHERE email = "' . $_email . '" AND ativo = "Y" ';

        $result = $this->update->exec($this->table_name, ['email' => $_email, 'senha' => $_senha], $termosDB);

        if ($result) {

            /* GRAVA AUDITORIA */
            $dados_auditoria['creator'] = 'user';
            $dados_auditoria['action'] = 'change pass';
            $dados_auditoria['description'] = 'Fez Alteração de Senha pelo Sistema';
            add_auditoria($dados_auditoria);

            return true;
        } else {
            return false;
        }
    }

    /* END function change_pass_user() */

    private function check_senha_atual($_email, $_senha) {

        $termosDB = 'WHERE email = "' . $_email . '" AND ativo = "Y" LIMIT 1';
        $result = $this->read->exec($this->table_name, $termosDB);

        if (password_verify($_senha, $result->row()->senha)) {
            return true;
        } else {
            return false;
        }
    }

    /* END function check_senha_arual() */
}

/* END class ClassName */





