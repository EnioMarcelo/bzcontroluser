<?php

/*
  Created on : 15/10/2019, 18:09PM
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


  defined('BASEPATH') OR exit('No direct script access allowed');

  class Appblank extends MY_Controller {


    /* function  __construct() */
  	public function __construct() {
        parent::__construct(FALSE);

      /* LOAD MODEL */
      $this->load->model('Appblank_model', 'm', TRUE);

      /* TÍTULO DA APLICAÇÃO */
      $this->dados['_titulo_app'] = 'Aplicação Blank';
      $this->dados['_font_icon'] = 'fa fa-anchor';

    }
    /* END function __construct() */



    /* function index() */
    public function index() {

        $this->load->view("vAppblank");

    }
    /* END function index() */

    

}
/* END class Appblank */
