<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  Created on : 21/09/2017, 08:38:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */

/**
 * Class MY_Model
 */
class MY_Model extends CI_Model {
    /**
     * ========================================================================================================================================================================
     * TABELAS QUE NÃO PRECISAM DOS default_fields
     * ========================================================================================================================================================================
     */

    /**
     * @var array
     */
    protected $notTableCreatFields = array(
        'ci_sessions',
        'sec_auditoria',
        'sec_settings',
        'sec_usuarios_has_sec_grupos',
        'sec_grupos_has_sec_aplicativos',
        'proj_build_fields'
    );

    // END TABELAS QUE NÃO PRECISAM QUE TENHA OS default_fields

    /**
     * MY_Model constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * FUNÇÃO QUE CRIA AS DEFAULTS FIELDS NA TABELA
     * @param null $table_name
     */
    public function default_fields($table_name = NULL) {

        /*
         * VERIFICA SE EXISTE OS CAMPOS NA TABELA. SE NÃO EXISTIR, SERÃO CRIADOS.
         */
        if ($table_name):

            $table_name = str_replace('vw_', '', $table_name);

            $this->load->dbforge();

            if (in_array($table_name, $this->notTableCreatFields) == 0):

                if ($this->db->field_exists('created', $table_name) == 0):
                    $fields = array(
                        'created' => array('type' => 'DATETIME')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                endif;

                if ($this->db->field_exists('user_created', $table_name) == 0):
                    $fields = array(
                        'user_created' => array('type' => 'VARCHAR', 'constraint' => '250')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                endif;

                if ($this->db->field_exists('updated', $table_name) == 0):
                    $fields = array(
                        'updated' => array('type' => 'DATETIME')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                endif;

                if ($this->db->field_exists('user_updated', $table_name) == 0):
                    $fields = array(
                        'user_updated' => array('type' => 'VARCHAR', 'constraint' => '250')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                endif;

            endif;

        endif;
    }

    //END function default_fields()

    /**
     * Get All Data in the database
     *
     * @param type $_dataBaseName
     * @param type $_orderBY
     * @return type
     */
    public function findAll($_dataBaseName, $_orderBY = NULL) {
        if ($_orderBY != NULL) {
            $this->db->order_by($_orderBY);
        }

        echo '<pre class="vardump">';
        var_dump($this->order_by);
        echo '</pre>';
        exit;

        return $this->db->get($_dataBaseName);
    }

    //END function findAll()

    /**
     * Get Data by ID in the database
     * @param string $_dataBaseName
     * @param integer $_id
     * @return mixed
     */
    public function findById($_dataBaseName, $_id) {
        $this->db->where("id", $_id);
        return $this->db->get($_dataBaseName);
    }

    //END function findById()

    /**
     * Get Data Filtered in the database
     * 
     * @param type $_dataBaseName
     * @param type $_field
     * @param type $_value
     * @param type $_condition
     * @param type $_orderBY
     * @return type
     */
    public function findByField($_dataBaseName, $_field, $_value, $_condition = NULL, $_orderBY = NULL) {
        if ($_orderBY != NULL) {
            $this->db->order_by($_orderBY);
        }

        if ($_condition == 'like') {
            $this->db->like($_field, $_value);
        } else {
            $this->db->where($_field, $_value);
        }

        return $this->db->get($_dataBaseName);
    }

    //END function findByField();
}

//END class MY_Model
