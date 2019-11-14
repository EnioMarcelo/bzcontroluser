<?php

/*
  Created on : 04/08/2017, 09:47:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function do_insert($dados = NULL) {
        if ($dados != NULL):
            $this->db->insert('sec_settings', $dados);
            if ($this->db->affected_rows() > 0):
                //add_auditoria('ADD: CONFIGURAÇÕES GERAIS', 'Uma nova configuração foi cadastrada no sistema');
            endif;
        endif;
    }

    public function do_update($dados = NULL, $condicao = NULL, $redir = TRUE) {
        if ($dados != NULL && is_array($condicao)):
            $this->db->update('sec_settings', $dados, $condicao);

            if ($this->db->affected_rows() > 0):
                //add_auditoria('EDIT: CONFIGURAÇÕES GERAIS', 'Foi alterado os dados da configuração');
            endif;

        endif;
    }

    public function do_delete($condicao = NULL, $redir = TRUE) {
        if ($condicao != NULL && is_array($condicao)):
            $this->db->delete('sec_settings', $condicao);
            if ($this->db->affected_rows() > 0):
                //add_auditoria('DEL: CONFIGURAÇÕES GERAIS', 'Uma configuração foi deletado do sistema');
            endif;

        endif;
    }

    public function get_bynome($nome = NULL) {
        if ($nome != NULL):
            $this->db->where('nome_config', $nome);
            $this->db->limit(1);
            return $this->db->get('sec_settings');
        else:

            return FALSE;
        endif;
    }

}

/* End of file settings_model.php */
/* Location: ./application/models/settings_model.php */