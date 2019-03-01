<?php

/*
  Created on : 28/06/2017, 13:46:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Page404 extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = 'vPage404';

        /*
         * CHAMA A MASTER PAGE DO SISTEMA PASSANDO O PARÂMETRO dados
         */
        $this->output->set_status_header('404');
        $this->load->view('vMasterPageIframe', $this->dados);
    }

}
