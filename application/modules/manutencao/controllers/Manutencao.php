<?php

/*
  Created on : 09/08/2017, 10:27:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Manutencao extends MY_Controller {

    function __construct() {
        parent::__construct(FALSE);
    }

    public function index() {

        /*
         * CHECK SE USUÁRIO ESTÁ LOGADO, SE OK, REDIRECIONA PARA O PAINEL.
         */
        if (check_is_user_login()) {
            redirect('dashboard');
        }

        /*
         * CHECK SE SISTEMA ESTÁ REALMENTE EM MANUTENÇÃO
         */
        if (!check_system_is_manutencao()) {
            redirect('login');
        }

        /*
         * CHAMA A MASTER PAGE DO SISTEMA PASSANDO O PARÂMETRO dados
         */
        $this->load->view('vManutencao', $this->dados);
    }

}
