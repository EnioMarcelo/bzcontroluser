<?php

/*
  Created on : {{created-date}}, {{created-time}}
  Author     : {{author-name}} - {{author-email}}
 */


  defined('BASEPATH') OR exit('No direct script access allowed');

  class {{class-name}} extends MY_Controller {


    /* function  __construct() */
  	public function __construct() {
        parent::__construct({{controller-security}});

      /* LOAD MODEL */
      $this->load->model('{{app-nome}}_model', 'm', TRUE);

      /* TÍTULO DA APLICAÇÃO */
      $this->dados['_titulo_app'] = '{{titulo-app}}';
      $this->dados['_font_icon'] = 'fa {{icone-app}}';

    }
    /* END function __construct() */



    /* function index() */
    public function index() {

        {{controller-blank}}

    }
    /* END function index() */

    {{controller-metodos-php}}

}
/* END class {{class-name}} */
