<?php

/*
  Created on : 09/05/2017, 15:39:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Create extends MY_model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $table_name
     * @param array $dados
     * @return boolean
     */
    public function exec($table_name, array $dados) {

        if ($table_name != NULL) :
            $this->default_fields($table_name);
        endif;


        if ($table_name != NULL && $dados != NULL) :

            if (in_array($table_name, $this->notTableCreatFields) == 0) :
                $dados['created'] = date('Y-m-d H:i:s');
                $dados['user_created'] = $this->session->userdata('user_login')['user_nome'] . ' - ' . $this->session->userdata('user_login')['user_email'];
            endif;

            $fields = implode(", ", array_keys($dados));
            $values = "'" . implode("', '", array_values($dados)) . "'";
            $qrCreate = "INSERT INTO {$table_name} ($fields) VALUES ($values)";

            $this->db->trans_start();
            $stCreate = $this->db->query($qrCreate);
            $_result_add['last_id_add'] = $this->db->insert_id();
            $this->db->trans_complete();

            if ($stCreate) :
                return $_result_add;
            else :
                return FALSE;
            endif;

        else :
            return FALSE;
        endif;
    }

}
