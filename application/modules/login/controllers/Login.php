<?php

    /*
      Created on : 01/08/2017, 09:59:00
      Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
     */


    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends MY_Controller {

        function __construct() {
            parent::__construct();

            /*
             * SE SISTEMA ESTIVER EM MANUTENÇÃO, SERÁ REDIRCIONADO PARA TELA DE AVISO
             */
            if ($this->session->tempdata('manutencao') == 'Y'):
                redirect('manutencao', 'refresh');
                exit;
            endif;


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

                if ($this->form_validation->run() == TRUE):

                    $_POST['email'] = xss_clean($this->input->post('email', TRUE));
                    $_POST['senha'] = do_hash(xss_clean($this->input->post('senha', TRUE)), 'md5');

                    $this->login();

                endif;
            }
        }

        public function index() {

            /*
             * CHECK SE USUÁRIO ESTÁ LOGADO, SE OK, REDIRECIONA PARA O PAINEL.
             */
            if (check_is_user_login()):
                redirect('dashboard');
            endif;

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

            if ($result->num_rows() > 0):
                $termosDB = "WHERE (timestamp+" . $this->config->item('sess_expiration') . ") <= " . time();
                $this->delete->ExecDelete('ci_sessions', $termosDB);
            endif;
        }

        /*
         * FAZ A AUTENTICAÇÃO DO USUÁRIO NO SISTEMA
         */

        private function login() {

            /*
             * VERIFICA OS DADOS DO USUÁRIO DIGITADOS NA TELA DE LOGIN, SE FOR VERDADEIRO AUTORIZA O ACESSO AO SISTEMA.
             */
            $termosDB = array();
            $termosDB = 'WHERE email = "' . $this->input->post('email', TRUE) . '" AND senha = "' . $this->input->post('senha', TRUE) . '" AND ativo = "Y" ';
            $result = $this->read->ExecRead($this->table_name, $termosDB);


            //CHECK MULTIPLOS LOGINS
            if ($result->result()):
                if (get_setting('multiplos_logins') == 'NAO'):
                    if ($result->row()->super_admin == 'N'):

                        //CHECK SE EXISTE USUÁRIO LOGADO, SE EXISTIR REDIRECIONA PARA AVISO DE ERRO E NÃO DEIXA ENTRAR NO SISTEMA
                        $result_multiplo_login = $this->read->ExecRead('ci_sessions', 'WHERE data LIKE "%' . $this->input->post('email', TRUE) . '%"');

                        if ($result_multiplo_login->result()):
                            $this->session->unset_userdata('user_login');
                            set_mensagem_toastr('ATENÇÃO', 'Usuário já está logado no sistema.', 'warning', 'top-center');
                            redirect('login', 'refresh');
                            exit;
                        endif;

                    endif;
                endif;
            endif;


            //GRAVA A DATA E HORA DO ÚLTIMO LOGIN
            if ($result->result()):
                $_ultimoLogin = $result->row()->ultimo_login;
                $this->update->ExecUpdate($this->table_name, array('ultimo_login' => date('Y-m-d H:i:s')), $termosDB);
            endif;


            //CARREGA A SESSÃO DO USUÁRIO COM OS DADOS
            if ($result->result()):
                $session_data = array(
                    'user_nome' => $result->row()->nome,
                    'user_sexo' => $result->row()->sexo,
                    'user_email' => $result->row()->email,
                    'user_super_admin' => $result->row()->super_admin,
                    'user_token' => session_id(),
                    'user_ultimo_login' => $_ultimoLogin,
                );

                //GERA A SESSÃO DO USUÁRIO
                $this->session->set_userdata('user_login', $session_data);

                //GRAVA AUDITORIA
                $dados_auditoria['creator'] = 'user';
                $dados_auditoria['action'] = 'login';
                $dados_auditoria['description'] = 'Entrou no Sistema';
                add_auditoria($dados_auditoria);

                //set_mensagem('Login OK', 'Login Efetuado com Sucesso.', 'fa-thumbs-o-up', 'info');
                //set_mensagem_toastr('Login OK', 'Login Efetuado com Sucesso.', 'info', 'top-center');
                set_mensagem_notfit('Login Efetuado com Sucesso.', 'success');
                redirect(site_url('dashboard'), 'refresh');

            else:
                //GRAVA AUDITORIA
                $dados_auditoria['creator'] = 'user';
                $dados_auditoria['action'] = 'login';
                $dados_auditoria['description'] = 'Erro ao Efetuar o Login, Email ou Senha não Conferem. Email[ ' . $this->input->post('email', TRUE) . ' ]';
                add_auditoria($dados_auditoria);


                //set_mensagem('Erro ao efetuar o Login', 'Email ou Senha não conferem.', 'fa-thumbs-o-down', 'danger');
                //set_mensagem_toastr('Erro ao efetuar o Login', 'Email ou Senha não conferem.', 'error', 'top-center');
                set_mensagem_sweetalert('Erro ao efetuar o Login', 'Email ou Senha não conferem.', 'error');

                redirect(site_url(), 'refresh');

            endif;
        }

        /*
         * DISCONECTA O USUÁRIO DO SISTEMA MATANDO A SESSÃO DE ACESSO
         */

        public function logout() {

            if (isset($this->session->userdata['user_login'])):

                //GRAVA AUDITORIA
                $dados_auditoria['creator'] = 'user';
                $dados_auditoria['action'] = 'logout';
                $dados_auditoria['description'] = 'Saiu do Sistema';
                add_auditoria($dados_auditoria);

                $this->session->unset_userdata('user_login');

                //set_mensagem('Logout', 'Usuário Saiu do Sistema com Sucesso.', 'fa-thumbs-o-up', 'info');
                //set_mensagem_toastr('Logout', 'Usuário Saiu do Sistema com Sucesso.', 'info', 'top-center');
                set_mensagem_notfit('Usuário Saiu do Sistema com Sucesso.', 'success');

            endif;

            redirect(site_url(), 'refresh');
        }

        /*
         * Insert Dados
         */
//        $dados = array();
//        $dados['nome'] = 'Teste NEW 2';
//        $dados['dados'] = 'TESTE NEW INSERT';
//        $result = $this->create->ExecCreate($this->table_name, $dados) ;
//        if ($result):
//            echo 'OK INSERT...';
//        else:
//            echo 'Erro ao inserir Dados...';
//        endif;



        /*
         * Delete Dados
         */
//        $termosDB = "WHERE id = 10";
//
//        if ($this->delete->ExecDelete($this->table_name, $termosDB)):
//            echo 'Deletado OK...';
//        else:
//            echo 'Erro ao Deletar...';
//        endif;



        /*
         * Update Dados
         */
//        $termosDB = array();
//        $dados = array();
//        
//        $dados['nome'] = 'zzzzzzzzzzz';
//        $dados['dados'] = '1 2 23 34 4  zzzzzzzz';
//        $termosDB = 'WHERE id = 20';
//
//        if ($this->update->ExecUpdate($this->table_name, $dados, $termosDB)):
//            echo 'Atualizado OK...';
//        else:
//            echo 'Erro ao Atualizar...';
//        endif;





        /*
         * Read Dados
         */
//        $termosDB = array();
//        
//        $termosDB = 'WHERE nome LIKE "%teste%"';
//        
//        $result = $this->read->ExecRead($this->table_name, $termosDB) ;
//        
//        if ($result->result()):
////            echo 'Leitura OK...<hr><pre>';
////            var_dump($result->result_object());
////            echo '</pre>';
//            
////            foreach ($result->result_object() as $value):
////                echo '<hr>ID : ' . $value->id . ' - NOME : ' . $value->nome;
////            endforeach;
//            
//            echo '--> ' . count($result->result_object()) ;
//            
//        else:
//            echo 'Nenhum Registro Encontrado...';
//        endif;
    }
