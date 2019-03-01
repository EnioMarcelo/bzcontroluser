<?php

    /*
      Created on : 19/06/2017, 13:33:00
      Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
     */


    defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends MY_Controller {

        private $menuUsuario = '';

        function __construct() {
            parent::__construct();

            /**
             * CARREGA OS MENUS QUE O USUÁRIO LOGADO TEM ACESSO
             */
            $_acl_user = $this->user_acl_groups->_get_acl_user_by_email($this->session->userdata('user_login')['user_email']);
            $_apps_user = array_unique(array_column($_acl_user, 'app_name'));
            $_r = $this->read->ExecRead('sec_menus', 'WHERE (parent_id IS NULL OR parent_id = 0) AND ativo = "Y" ORDER BY nome_menu');
            $_s = [];
            $_m = [];
            $_menu = [];

            foreach ($_r->result_array() as $key => $menu):

                $_s = $this->read->ExecRead('sec_menus', 'WHERE (parent_id > 0) AND ativo = "Y" AND parent_id = ' . $menu['id'] . ' AND app_name IN ("' . implode('","', $_apps_user) . '") ORDER BY nome_menu')->result_array();
                if ($_s) {
                    $_m[$menu['nome_menu']][] = $_s;
                }

            endforeach;

            foreach ($_m as $key => $value) :

                $_menu[$key] = [];

                foreach ($value as $row):
                    foreach ($row as $resultKey => $result):

                        $_menu[$key][$resultKey]['nome_menu'] = $result['nome_menu'];
                        $_menu[$key][$resultKey]['app'] = $result['app_name'];
                        $_menu[$key][$resultKey]['icon'] = $result['menu_icon'];
                        $_menu[$key][$resultKey]['id_menu_pai'] = $result['parent_id'];

                    endforeach;

                endforeach;

            endforeach;

            $this->menuUsuario = $_menu;

            /* END CARREGA OS MENUS QUE O USUÁRIO LOGADO TEM ACESSO */
        }

        /** END function __construct() **/


        public function index() {
            //$this->load->view('welcome_message');
            /*
             * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
             */
            $this->dados['_conteudo_masterPage'] = 'vDashboard';
            $this->dados['_menu_usuario'] = $this->menuUsuario;
            $this->load->view('vMasterPage', $this->dados);

            /**
             * MOSTRA TODAS AS CONSTANTES DO SISTEMA
             */
//            echo '<pre class="vardump">';
//            var_dump(get_defined_constants(true)['user']);
//            echo '</pre>';
            /** END MOSTRA TODAS AS CONSTANTES DO SISTEMA **/
        }

        /*
         * GRAVA AS CONFIGURAÇÕES PADRÃO DO SISTEMA sec_settings
         */

        public function formSettings() {

            /*
             * CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX.
             */
            bz_check_is_ajax_request();


            if (check_is_user_super_admin()):

                $acao = $this->input->get_post('acao', TRUE);

                if ($acao == 'get-form-settings'):

                    //echo settingsConfig();

                elseif ($acao == 'add-form-settings'):

                    $settings = elements(array('multiplos_logins', 'em_manutencao'), $this->input->post());

                    $settings['multiplos_logins'] = ($this->input->post('multiplos_logins', TRUE) == 'on') ? 'SIM' : 'NAO';
                    $settings['em_manutencao'] = ($this->input->post('em_manutencao', TRUE) == 'on') ? 'SIM' : 'NAO';
                    $settings['debug_mode'] = ($this->input->post('debug_mode', TRUE) == 'on') ? 'SIM' : 'NAO';
                    $settings['time_render'] = ($this->input->post('time_render', TRUE) == 'on') ? 'SIM' : 'NAO';
                    $settings['time_zone'] = $this->input->post('time_zone', TRUE);
                    $settings['layout_skin'] = $this->input->post('layout_skin', TRUE)[0];

                    foreach ($settings as $nome_config => $valor_config):
                        set_setting($nome_config, $valor_config);
                        //GRAVA AUDITORIA

                        $dados_auditoria['creator'] = 'user';
                        $dados_auditoria['action'] = 'update settings';
                        $dados_auditoria['description'] = 'Confirgurações Gerais Atualizados com Sucesso';
                        $dados_auditoria['last_query'] = $this->db->last_query();
                        add_auditoria($dados_auditoria);
                    endforeach;
                    set_mensagem_sweetalert('SUCESSO !!!', 'Configurações Gerais Alterado com Sucesso.', 'success');
                    echo 'OK';
                    exit;

                else:
                    echo 'ERROACAO';
                endif;

            else:
                echo 'NOTADMIN';
            endif;
        }

    }
