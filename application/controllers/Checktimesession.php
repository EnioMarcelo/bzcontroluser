<?php

/**
  Created on : 09/08/2017, 07:46:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Checktimesession extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    //END function __construct()


    public function index() {

        if (!check_is_user_login()) {

            /* GRAVA AUDITORIA */
            $dados_auditoria['creator'] = 'system';
            $dados_auditoria['action'] = 'logout';
            $dados_auditoria['description'] = 'Sessão Expirou, Logout Automático';
            add_auditoria($dados_auditoria);

            //set_mensagem('Logout', 'Sua Sessão Expirou.', 'fa-thumbs-o-up', 'info');
            //set_mensagem_toastr('Logout', 'Sua Sessão Expirou.', 'info', 'top-center');


            echo 'EXPIRED';
        } else {
            echo 'OK';
        }

        exit;
    }

//END function index()
}

//END class


