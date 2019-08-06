<?php

/*
  Created on : 06/08/2019, 16:18PM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */


  defined('BASEPATH') OR exit('No direct script access allowed');

  class Appblank005 extends MY_Controller {


    /* function  __construct() */
  	public function __construct() {
        parent::__construct();

      /* LOAD MODEL */
      $this->load->model('Appblank005_model', 'm', TRUE);

      /* TÍTULO DA APLICAÇÃO */
      $this->dados['_titulo_app'] = 'Aplicação Blank';
      $this->dados['_font_icon'] = 'fa fa-bus';

    }
    /* END function __construct() */



    /* function index() */
    public function index() {

        $this->load->view("vAppblank005");

    }
    /* END function index() */

    /* METODO PHP - fcn_teste */
public function fcn_teste($_p = null) {
$titulo = 'Mensagem de Teste.' ;
$mensagem = '1 2 3 Testando...' ;


//set_mensagem_notfit($titulo);
//set_mensagem_toastr($titulo, $mensagem);
set_mensagem_sweetalert($titulo, $mensagem);


redirect('appblank005');

}
/* END METODO PHP - fcn_teste */



}
/* END class Appblank005 */
