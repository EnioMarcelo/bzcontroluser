<?php

/*
  Created on : 01/08/2017, 09:59:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    private $_sess_expiration;

    function __construct() {

        parent::__construct(false);

        $this->_sess_expiration = $this->config->config['sess_expiration'];

        /**
         * DELATA OS ARQUIVOS DE IMAGEM CAPTCHA DO MÚDLO DE RECUPERAR SENHA changepass 
         */
        bz_delete_file_for_expired_lifetime('captcha');

        /*
         * SE SISTEMA ESTIVER EM MANUTENÇÃO, SERÁ REDIRCIONADO PARA TELA DE AVISO
         */
        if ($this->session->tempdata('manutencao') == 'Y') {
            redirect('manutencao', 'refresh');
            exit;
        }


        /*
         * EXCLUI AS SESSÕES DA TABELA ci_sessions QUE EXPIROU/VENCEU.
         */
        $this->last_activity_session();


        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'sec_usuarios';


        if ($this->input->post()) {

            /*
             * VALIDAÇÃO DOS DADOS DO FORMULÁRIO
             */
            $this->form_validation->set_rules('email', '<b>Email</b>', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('senha', '<b>Senha</b>', 'trim|required|min_length[6]|xss_clean');

            if ($this->form_validation->run() == TRUE) {

                $_POST['email'] = xss_clean($this->input->post('email', TRUE));
                $_POST['senha'] = xss_clean($this->input->post('senha', TRUE));

                $this->login($_POST['email'], $_POST['senha']);
            }
        }
    }

    public function index() {

        /*
         * CHECK SE USUÁRIO ESTÁ LOGADO, SE OK, REDIRECIONA PARA O PAINEL.
         */
        if (check_is_user_login()) {
            redirect('dashboard');
        }

        /**
         * TIME THE SESSION EXPIRES
         */
        $this->dados['_sess_expiration'] = $this->_sess_expiration;


        /*
         * CHAMA A MASTER PAGE DO SISTEMA PASSANDO O PARÂMETRO dados
         */
        $this->load->view('vLogin', $this->dados);
    }

    /*
     * EXCLUI AS SESSÕES DA TABELA ci_sessions QUE EXPIROU/VENCEU.
     */

    private function last_activity_session() {

        $result = $this->db->get_where('ci_sessions', array('(timestamp+' . $this->config->item('sess_expiration') . ') <=' => time()));

        if ($result->num_rows() > 0) {
            $termosDB = "WHERE (timestamp+" . $this->config->item('sess_expiration') . ") <= " . time();
            $this->delete->exec('ci_sessions', $termosDB);
        }
    }

    /*
     * FAZ A AUTENTICAÇÃO DO USUÁRIO NO SISTEMA
     */

    private function login($_email, $_senha) {

        $_is_login = false;

        /*
         * VERIFICA OS DADOS DO USUÁRIO DIGITADOS NA TELA DE LOGIN, SE FOR VERDADEIRO AUTORIZA O ACESSO AO SISTEMA.
         */
        $termosDB = array();
        $termosDB = 'WHERE email = "' . $_email . '" AND ativo = "Y" LIMIT 1';
        $result = $this->read->exec($this->table_name, $termosDB);

        if (password_verify($_senha, $result->row()->senha)) {
            $_is_login = true;
        }


        //CHECK MULTIPLOS LOGINS
        if ($_is_login) {
            if (get_setting('multiplos_logins') == 'NAO') {
                if ($result->row()->super_admin == 'N') {

                    //CHECK SE EXISTE USUÁRIO LOGADO, SE EXISTIR REDIRECIONA PARA AVISO DE ERRO E NÃO DEIXA ENTRAR NO SISTEMA
                    $result_multiplo_login = $this->read->exec('ci_sessions', 'WHERE data LIKE "%' . $this->input->post('email', TRUE) . '%"');

                    if ($result_multiplo_login->result()) {
                        $this->session->unset_userdata('user_login');
                        set_mensagem_trigger_notifi('ATENÇÃO... Usuário já está logado no sistema.', 'warning');
                        redirect('login', 'refresh');
                        exit;
                    }
                }
            }
        }


        //GRAVA A DATA E HORA DO ÚLTIMO LOGIN
        if ($_is_login) {
            $_ultimoLogin = $result->row()->ultimo_login;
            $this->update->exec($this->table_name, array('ultimo_login' => date('Y-m-d H:i:s')), $termosDB);
        }


        //CARREGA A SESSÃO DO USUÁRIO COM OS DADOS
        if ($_is_login) {
            $session_data = array(
                'user_nome' => $result->row()->nome,
                'user_sexo' => $result->row()->sexo,
                'user_email' => $result->row()->email,
                'user_super_admin' => $result->row()->super_admin,
                'user_token' => session_id(),
                'user_ultimo_login' => $_ultimoLogin,
                'user_gravatar' => bz_get_gravatar($result->row()->email),
            );

            //GERA A SESSÃO DO USUÁRIO
            $this->session->set_userdata('user_login', $session_data);

            /* GRAVA AUDITORIA */
            $dados_auditoria['creator'] = 'user';
            $dados_auditoria['action'] = 'login';
            $dados_auditoria['description'] = 'Entrou no Sistema';
            add_auditoria($dados_auditoria);

            //set_mensagem('Login OK', 'Login Efetuado com Sucesso.', 'fa-thumbs-o-up', 'info');
            //set_mensagem_toastr('Login OK', 'Login Efetuado com Sucesso.', 'info', 'top-center');
//            set_mensagem_notfit('Login Efetuado com Sucesso.', 'success');
            set_mensagem_trigger_notifi('Login Efetuado com Sucesso.', 'success');

            redirect(site_url('dashboard'), 'refresh');
        } else {
            /* GRAVA AUDITORIA */
            $dados_auditoria['creator'] = 'user';
            $dados_auditoria['action'] = 'login';
            $dados_auditoria['description'] = 'Erro ao Efetuar o Login, Email ou Senha não Conferem. Email[ ' . $this->input->post('email', TRUE) . ' ]';
            add_auditoria($dados_auditoria);


            //set_mensagem('Erro ao efetuar o Login', 'Email ou Senha não conferem.', 'fa-thumbs-o-down', 'danger');
            //set_mensagem_toastr('Erro ao efetuar o Login', 'Email ou Senha não conferem.', 'error', 'top-center');
            set_mensagem_sweetalert('Erro ao efetuar o Login', 'Email ou Senha não conferem.', 'error');

            redirect(site_url(), 'refresh');
        }
    }

    /*
     * DISCONECTA O USUÁRIO DO SISTEMA MATANDO A SESSÃO DE ACESSO
     */

    public function logout() {

        if (isset($this->session->userdata['user_login'])) {

            /* GRAVA AUDITORIA */
            $dados_auditoria['creator'] = 'user';
            $dados_auditoria['action'] = 'logout';
            $dados_auditoria['description'] = 'Saiu do Sistema';
            add_auditoria($dados_auditoria);
        }

        $this->session->sess_destroy();

        redirect(site_url(), 'refresh');
    }

}
