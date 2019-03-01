<?php

/*
  Created on : 09/08/2017, 07:50:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria extends MY_Controller {

    public function __construct() {
        parent::__construct();

        /*
         * TÍTULO DA APLICAÇÃO
         */
        $this->dados['_titulo_app'] = 'Auditoria';
        $this->dados['_font_icon'] = 'fa fa-map-o';

        /*
         * TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->table_name = 'sec_auditoria';
        
    }

//END function __construct()


    public function index() {

        /*
         * CARREGA REGISTROS COM PAGINAÇÃO
         */
        $this->dados['_result'] = $this->get_paginacao();

        /*
         * TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA
         */
        $this->dados['_conteudo_masterPageIframe'] = 'vAuditoria';
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /*
     * CARREGA REGISTROS COM PAGINAÇÃO
     */

    private function get_paginacao() {

        $_filter = $this->input->get();
        unset($_filter['pg']);
        unset($_filter['search']);

        /*
         * DADOS PARA PAGINAÇÃO
         */
        $_dados_pag['table'] = $this->table_name;
        if ($this->input->get('search', TRUE)):
            $_dados_pag['search'] = array('_concat_fields' => 'inserted_date, username, application, method, creator, ip_user, action, description, last_query, user_agent', '_string' => $this->input->get('search', TRUE));
        endif;
        $_dados_pag['filter'] = $_filter;
        $_dados_pag['order_by'] = 'inserted_date DESC';
        $_dados_pag['programa'] = $this->router->fetch_class();
        $_dados_pag['per_page'] = '10';

        $_result_pag = bz_paginacao($_dados_pag);

        return $_result_pag;
    }

//END function index()
}

//END class


