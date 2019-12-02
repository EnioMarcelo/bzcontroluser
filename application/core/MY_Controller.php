<?php

/*
  Created on : 09/05/2017, 13:45:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

    protected $table_name;
    protected $dados;
    protected $task;
    protected $page;
    protected $export;
    protected $where;
    protected $or_where;
    protected $order_by;
    protected $_redirect = '';
    protected $_redirect_parametros_url = '';
    private $saveAuditoria = false;

    public function __construct($_security = true) {

        parent::__construct();


        /**
         * CARREGA O ARQUIVO application/config/config_system
         * Dados Gerais do Systema
         */
        $this->config->load('config_system', TRUE);

        /**
         * CARREGA O ARQUIVO application/config/config_email
         * Dados do Servidor de Email
         */
        $this->config->load('config_email', TRUE);


        /**
         * LAYOUT SKINS/COLOR AND TITILES SYSTEM
         */
        $this->db->where('nome_config', 'layout_skin');
        $this->db->limit(1);
        $layout_skin = $this->db->get('sec_settings')->row('valor_config');
        define('___BZ_LAYOUT_SKINCOLOR___', $layout_skin);
        /*
         *  END LAYOUT SKINS/COLOR AND TITILES SYSTEM
         */

        /**
         * HMVC
         */
        $this->form_validation->CI = & $this;

        /**
         * REDIRECT
         */
        $this->_redirect = site_url($this->router->fetch_class());
        $this->_redirect_parametros_url = site_url($this->router->fetch_class() . '?' . bz_app_parametros_url());


        /*
         * AUDITORIA
         */
        if ($this->router->fetch_class() != 'login' && $this->router->fetch_class() != 'changepass' && $this->router->fetch_class() != 'auditoria' && $this->router->fetch_class() != 'dashboard') {
            if (check_is_user_login()) {
                $dados_auditoria['username'] = $this->session->userdata('user_login')['user_nome'] . ' - ' . $this->session->userdata('user_login')['user_email'];
            }
            $dados_auditoria['application'] = $this->router->fetch_class();
            $dados_auditoria['creator'] = 'system';
            $dados_auditoria['action'] = 'access';

            $this->saveAuditoria = true;
        }

        /**
         * ARRAY DE APPs QUE NÃO PRECISAM CHEGAR SE FEZ LOGIN OU SE TEM PERMISSÃO DE ACESSO.
         */
        $_notCheckLoginApp = [
            'login',
            'changepass',
            ''
        ];

        if (!in_array($this->router->fetch_class(), $_notCheckLoginApp)) {
            
            /*
             * CHECK SE USUÁRIO ESTÁ LOGADO, SE OK, REDIRECIONA PARA O PAINEL.
             */
            if (!check_is_user_login() && $_security) {

                /* GRAVA AUDITORIA */
                $dados_auditoria['description'] = 'Acesso não Permitido';
                add_auditoria($dados_auditoria);

                //set_mensagem('Erro de Acesso', 'Acesso não Permitido.', 'fa-thumbs-o-down', 'danger');
                //set_mensagem_toastr('Erro de Acesso', 'Acesso não Permitido.', 'error', 'top-center');

                if (check_system_is_manutencao()) {
                    set_mensagem_sweetalert('Atenção', 'Sistema em Manutenção.', 'warning');
                } else {
                    set_mensagem_sweetalert('Erro de Acesso', 'Acesso não Permitido.', 'error');
                }
                echo '<script>window.open("' . site_url() . '", "_top");</script>';
                exit;
            }


            /*
             * CHECK SE SISTEMA ESTÁ REALMENTE EM MANUTENÇÃO
             */
            if (check_system_is_manutencao()) {
                if (!check_is_user_super_admin()) {
                    $this->session->unset_userdata('user_login');
                    //$this->session->set_tempdata('manutencao', 'Y', 5);
                    echo '<script>window.open("' . site_url('manutencao') . '", "_top");</script>';
                    exit;
                }
            }


            /*
             * CHECK SE USUÁRIO TEM PERMISSÃO PARA ACESSAR O MÓDULO DO SISTEMA
             */

            if ($this->session->userdata('user_login')['user_super_admin'] !== 'Y' && $_security) {

                /*
                 * GET ACL DO USUÁRIO LOGADO NO SISTEMA
                 */
                $_acl_user = $this->user_acl_groups->_get_acl_user(array('string_filter' => $this->session->userdata('user_login')['user_email'], 'key_filter' => 'by_user_email'));

                /*
                 * ACL APPS QUE OS USUÁRIOS TEM ACESSO LIBERADO NO SISTEMA
                 */
                $_defaults_apps_access = array('dashboard', 'userprofile', 'login', 'changepass', 'assets', 'favicon.ico'); //APPS DEFAULT
                $_acl_users_access_modules = $_defaults_apps_access;

                foreach ($_acl_user as $_app) {
                    $_acl_users_access_modules[] = strtolower($_app['app_name']);
                }

                /*
                 * CHECK SE O USUÁRIO TE PERMISSÃO DE ACESSO AOS APLICATIVOS DO SISTEMA
                 */

                if (!in_array($this->router->fetch_class(), $_acl_users_access_modules)) {
                    /* GRAVA AUDITORIA */
                    $dados_auditoria['description'] = 'Usuário não tem Permissão para Acessar';
                    add_auditoria($dados_auditoria);

                    //set_mensagem('Erro de Permissão', 'Acesso não Permitido.', 'fa-thumbs-o-down', 'danger');
                    //set_mensagem_toastr('Erro de Permissão', 'Acesso não Permitido.', 'error', 'top-center');
                    set_mensagem_sweetalert('Erro de Permissão', 'Acesso não Permitido para: ' . strtolower($this->uri->segment(1)), 'error');
                    echo '<script>window.open("' . site_url('login') . '", "_top");</script>';
                    exit;
                } else {

                    $_r = bz_filter_array(array('array' => $_acl_user, 'field' => 'app_name', 'value' => $this->router->fetch_class()));

                    if (!in_array($this->router->fetch_class(), $_defaults_apps_access)) {
                        if ($_r[0]['app_name'] == $this->router->fetch_class() && $_r[0]['app_ativo'] == 'Y' && $_r[0]['grupo_ativo'] == 'Y') {
                            
                        } else {
                            /* GRAVA AUDITORIA */
                            $dados_auditoria['description'] = 'Aplicativo sem Permissão para Acessar. GRUPO ou APP INATIVO.';
                            add_auditoria($dados_auditoria);

                            set_mensagem_sweetalert('ATENÇÃO', 'Aplicativo: ' . strtolower($this->uri->segment(1)) . ' EM MANUTENÇÃO.', 'error');
                            echo '<script>window.open("' . site_url('dashboard') . '", "_top");</script>';
                            exit;
                        }
                    }
                }
            }
            /*
             * END CHECK SE USUÁRIO TEM PERMISSÃO PARA ACESSAR O MÓDULO DO SISTEMA
             */
        }

        /* GRAVA AUDITORIA */
        if ($this->saveAuditoria) {
            //add_auditoria($dados_auditoria);
        }


        //TIME ZONE DO SISTEMA
        date_default_timezone_set(get_setting('time_zone'));


        $this->task = $this->input->get('task');
        $this->page = $this->input->get('page');


        //ATIVA/DESATIVA O MODO DEBUG DA APLIAÇÃO
        if (get_setting('debug_mode') == 'SIM') {
            $this->output->enable_profiler(TRUE);
        }


        /*
         * BOTÃO DE VOLTAR DO FORM
         */

        if ($this->input->get('btnvoltarorigem')) {
            $this->session->set_flashdata('btn_voltar_origem', $this->input->get('btnvoltarorigem'));
        }

        if ($this->session->flashdata('btn_voltar_link')) {

//                $this->session->set_flashdata('btn_voltar_link', site_url($this->router->fetch_class()) . '?' . bz_app_parametros_url());

            $this->session->keep_flashdata('btn_voltar_link');
        } else {
            $this->session->set_flashdata('btn_voltar_link', site_url($this->router->fetch_class()) . '?' . bz_app_parametros_url());
            $this->session->set_flashdata('btn_voltar_origem', '');
        }
    }

}
