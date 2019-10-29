<?php

/*
  Created on : 09/05/2017, 15:39:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $table_name
     * @param type $termos
     * @return boolean
     */
    public function exec($table_name, $termos) {

        if ($table_name != NULL && $termos != NULL):

            $this->load->model('generic/read');
            $result = $this->read->exec($table_name, $termos);

            if ($result->result()):
                $qrDelete = "DELETE FROM {$table_name} {$termos}";

                $this->db->trans_start();
                $stDelete = $this->db->query($qrDelete);
                $this->db->trans_complete();

                if ($stDelete):
                    return TRUE;
                else:
                    return FALSE;
                endif;
            else:
                return FALSE;
            endif;

        else:
            return FALSE;
        endif;
    }

}
