<?php

/*
  Created on : 09/05/2017, 15:39:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Read extends MY_model {

    public function __construct() {
        parent::__construct();
    }

    public function ExecRead($table_name, $termos = NULL, $array = array()) {

        $_distinct = '*';


        if ($table_name != NULL) :
            $this->default_fields($table_name);
        endif;

        if (isset($array['distinct'])):
            $_distinct = 'DISTINCT ' . $array['distinct'];
        endif;

        if ($table_name != NULL):
            $sql = "SELECT $_distinct FROM " . $table_name . " " . $termos;
            $result = $this->db->query($sql);
            return $result;
        else:
            return FALSE;
        endif;
    }

    public function ExecReadField($table_name, $fields, $termos = NULL) {

        if ($table_name != NULL):
            $sql = "SELECT " . $fields . " FROM " . $table_name . " " . $termos;
            $result = $this->db->query($sql);
            return $result;
        else:
            return FALSE;
        endif;
    }

}
