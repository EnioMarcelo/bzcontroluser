<?php

/*
  Created on : 03/08/2017, 09:59:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Changepass extends MY_Controller {

    function __construct() {
        parent::__construct(false);

        $this->load->helper(array('captcha'));

        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'sec_usuarios';

        if ($this->input->post()) {
            $this->newpass();
        }
    }

    public function index() {
        $this->session->set_flashdata('btn_voltar_link', site_url($this->router->fetch_class()) . '?' . bz_app_parametros_url());
        /*
         * CHECK SE USUÁRIO ESTÁ LOGADO, SE OK, REDIRECIONA PARA O PAINEL.
         */
        if (check_is_user_login()) {
            redirect('dashboard');
        }

        /*
         * CREATE CAPTCHA
         */
        $cap = $this->captcha_create();
        $this->dados['captcha']['image'] = $cap['image'];
        $this->dados['captcha']['word'] = $cap['word'];


        /*
         * CHAMA A MASTER PAGE DO SISTEMA PASSANDO O PARÂMETRO dados
         */
        $this->load->view('vChangepass', $this->dados);
    }

    /*
     * GERA O CODIGO CAPTCHA
     */

    private function captcha_create() {
        $_expiration = 90;

        $vals = array(
            'word' => mc_random_number(6, 6, true, true),
            'img_path' => './captcha/',
            'img_url' => base_url() . '/captcha/',
            'font_path' => './assets/fonts/verdana.ttf',
            'img_width' => '283',
            'img_height' => 50,
            'expiration' => $_expiration,
            'word_length' => 8,
            'font_size' => 33,
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(211, 211, 211),
                'text' => array(247, 43, 43),
                'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);
        $cap['time_expired'] = time() + $_expiration;

        $this->session->set_userdata('cod_captcha', $cap['word']);
        $this->session->set_userdata('cod_captcha_time_expired', $cap['time_expired']);

        return $cap;
    }

    /*
     * REFAZ A SENHA DO USUÁRIO E ENVIA PARA O EMAIL DO MESMO.
     */

    private function newpass() {

        $this->form_validation->set_rules('email', '<b>Email</b>', 'trim|required|valid_email');
        $this->form_validation->set_rules('captcha', '<b>Captcha</b>', 'trim|required|callback__validate_captcha');

        if ($this->form_validation->run() == TRUE) {

            /*
             * CHECK REQUEST REPEAT email
             */

            /* if ($this->request_repeat(xss_clean($this->input->post('email', TRUE)))){
              set_mensagem_sweetalert('Oooops!!!', 'Você já tentou este email antes.', 'warning');
              redirect(site_url('changepass'));
              exit;
              } */


            /*
             * VERIFICA SE O EMAIL INFORMADO ESTÁ CADASTRADO E ATIVO NO SISTEMA
             */
            $termosDB = array();
            $termosDB = 'WHERE email = "' . xss_clean($this->input->post('email', TRUE)) . '" AND ativo = "Y" LIMIT 1';
            $result = $this->read->exec($this->table_name, $termosDB);

            if ($result->result()) {
                /*
                 * GERA UM NOVA SENHA PARA O USUÁRIO.
                 */
                $newpass = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnm0123456789'), 0, 6);
                $newpassMD5 = do_hash($newpass, 'md5');

                /*
                 * GRAVA A NOVA SENHA NA TABELA usuarios
                 */
                $termosDB = array();
                $dados = array();
                $dados['email'] = $result->row()->email;
                $dados['senha'] = $newpassMD5;
                $termosDB = 'WHERE email = "' . $result->row()->email . '"';

                if ($this->update->exec($this->table_name, $dados, $termosDB)) {

                    //GRAVA AUDITORIA
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'change pass';
                    $dados_auditoria['description'] = 'O email[ ' . $result->row()->email . ' ] Solicitou Alteração de Senha';
                    add_auditoria($dados_auditoria);

                    /*
                     * ENVIA EMAIL COM A NOVA SENHA PARA O EMAIL INFORMADO.
                     */
                    $mensagem = '<p>Você solicitou uma nova senha, a partir de agora use a seguinte senha para ter acesso ao sistema - [ E-MAIL: <strong> ' . $dados['email'] . ' - </strong> SENHA : <strong> ' . $newpass . ' </strong> ]</p><p><b>Assim que fizer o login no sistema, troque esta senha para uma nova senha.</b></p><p><a href="' . site_url() . '">PARA ACESSAR O SISTEMA CLIQUE AQUI.</a></p>';

                    if (bz_enviar_email($dados['email'], 'Solicitação de uma nova senha de acesso - ' . $this->config->item('config_system')['CONF_NOME_SISTEMA'], $mensagem)) {
                        //GRAVA AUDITORIA
                        $dados_auditoria['description'] = 'Nova Senha Enviada para o Email[ ' . $result->row()->email . ' ]';
                        add_auditoria($dados_auditoria);
                        //set_mensagem('SUCESSO !!!', 'Sua nova senha foi enviado para o email informado.', 'fa-thumbs-up', 'success');
                        //set_mensagem_toastr('SUCESSO !!!', 'Sua nova senha foi enviado para o email informado.', 'success', 'top-center');
                        set_mensagem_sweetalert('SUCESSO', 'Sua nova senha foi enviado para o email informado.', 'success');
                        redirect(site_url('login'));
                    } else {
                        //GRAVA AUDITORIA
                        $dados_auditoria['description'] = 'Erro ao Enviar Email[ ' . $result->row()->email . ' ] Com Nova Senha';
                        add_auditoria($dados_auditoria);
                        //set_mensagem('ERRO !!!', 'ERRO AO ENVIAR EMAIL COM SUA NOVA SENHA. AVISE O ADMINISTRADOR DO SISTEMA.', 'fa-thumbs-down', 'danger');
                        //set_mensagem_toastr('ERRO !!!', 'ERRO AO ENVIAR EMAIL COM SUA NOVA SENHA. AVISE O ADMINISTRADOR DO SISTEMA.', 'error', 'top-center');
                        set_mensagem_sweetalert('ERRO', 'ERRO AO ENVIAR EMAIL COM SUA NOVA SENHA. AVISE O ADMINISTRADOR DO SISTEMA.', 'error');
                        redirect(site_url('login'));
                    }
                } else {
                    //GRAVA AUDITORIA
                    $dados_auditoria['description'] = 'Erro ao Atualizar Nova Senha Tabela';
                    add_auditoria($dados_auditoria);
                    //set_mensagem('ERRO !!!', 'ERRO AO ATUALIZAR SUA NOVA SENHA. AVISE O ADMINISTRADOR DO SISTEMA.', 'fa-thumbs-down', 'danger');
                    //set_mensagem_toastr('ERRO !!!', 'ERRO AO ATUALIZAR SUA NOVA SENHA. AVISE O ADMINISTRADOR DO SISTEMA.', 'error', 'top-center');
                    set_mensagem_sweetalert('ERRO', 'ERRO AO ATUALIZAR SUA NOVA SENHA. AVISE O ADMINISTRADOR DO SISTEMA.', 'error');
                    redirect(site_url('login'));
                }
            } else {
                //set_mensagem('ERRO !!!', 'Este <b>EMAIL</b> não existe ou está temporáriamente inativo neste sistema.', 'fa-thumbs-down', 'danger');
                //set_mensagem_toastr('ERRO !!!', 'Este <b>EMAIL</b> não existe ou está temporáriamente inativo neste sistema.', 'error', 'top-center');
                set_mensagem_sweetalert('ATENÇÃO', 'Este EMAIL não existe ou está\ntemporáriamente inativo neste sistema.', 'warning');
                redirect(site_url('login'));
            }
        } else {
            /* $mensagem = validation_errors();
              set_mensagem('Erro Validação !!!', $mensagem, 'fa-thumbs-down', 'danger');
              echo get_mensagem();
             * 
             */
        }
    }

    /*
     * FAZ A VALIDAÇÃO DO CÓDIGO CAPTCHA DIGITADO.
     */

    public function _validate_captcha() {


        if ($this->session->userdata('user_login')) {
            $this->form_validation->set_message('_validate_captcha', 'O código <b>CAPTCHA</a> expirou. Recarregue a tela e tente novamente.');
            return false;
        }


        if (time() > $this->session->userdata['cod_captcha_time_expired']) {
            $this->form_validation->set_message('_validate_captcha', 'O código <b>CAPTCHA</a> expirou. Recarregue a tela e tente novamente.');
            return false;
        }


        if (strlen(xss_clean($this->input->post('captcha', TRUE))) == 0) {
            $this->form_validation->set_message('_validate_captcha', 'O campo <b>CAPTCHA</b> é obrigatório.');
            return false;
        }


        if (strtolower(xss_clean($this->input->post('captcha', TRUE))) != strtolower($this->session->userdata['cod_captcha'])) {
            $this->form_validation->set_message('_validate_captcha', 'O campo <b>CAPTCHA</b> não confere.');
            return false;
        } else {
            return true;
        }
    }

    /*
     * NÃO DEIXA O USUÁRIO PEDIR MAIS DE UMA VEZ UMA NOVA SENHA PARA O MESMO EMAIL
     */

    protected function request_repeat($email) {

        if (!empty($this->session->userdata('changepassemail')) && $this->session->userdata('changepassemail') == $email) {
            return true;
            exit;
        }

        $this->session->set_userdata('changepassemail', $email);
        return false;
        exit;
    }

}
