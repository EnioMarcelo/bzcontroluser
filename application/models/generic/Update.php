<?php

/*
  Created on : 09/05/2017, 15:39:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends MY_model {

    public function __construct() {
        parent::__construct();

        $this->load->model('generic/read');
    }

    /**
     * 
     * @param type $table_name
     * @param array $dados
     * @param type $termos
     * @return boolean
     */
    public function exec($table_name, array $dados, $termos) {

        if ($table_name != NULL && $dados != NULL && $termos != NULL):

            if (in_array($table_name, $this->notTableCreatFields) == 0):
                $dados['updated_at'] = date('Y-m-d H:i:s');
                $dados['user_updated_at'] = $this->session->userdata('user_login')['user_nome'] . ' - ' . $this->session->userdata('user_login')['user_email'];
            endif;

            $result = $this->read->exec($table_name, $termos);

            if ($result->result()):

                foreach ($dados as $fields => $values) {
                    $campos[] = "$fields = '$values'";
                }

                $campos = implode(", ", $campos);
                $qrUpdate = "UPDATE {$table_name} SET $campos {$termos}";

                $this->db->trans_start();
                $stUpdate = $this->db->query($qrUpdate);
                $this->db->trans_complete();

                if ($stUpdate):
                    return true;
                else:
                    return FALSE;
                endif;

            endif;

        else:
            return FALSE;
        endif;
    }

}
