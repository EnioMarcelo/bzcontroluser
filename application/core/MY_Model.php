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
        'sec_grupos_has_sec_aplicativos'
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
        if ($table_name) {

            $table_name = str_replace('vw_', '', $table_name);

            $this->load->dbforge();

            if (in_array($table_name, $this->notTableCreatFields) == 0) {

                if ($this->db->field_exists('created_at', $table_name) == 0) {
                    $fields = array(
                        'created_at' => array('type' => 'DATETIME')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                }

                if ($this->db->field_exists('user_created_at', $table_name) == 0) {
                    $fields = array(
                        'user_created_at' => array('type' => 'VARCHAR', 'constraint' => '250')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                }

                if ($this->db->field_exists('updated_at', $table_name) == 0) {
                    $fields = array(
                        'updated_at' => array('type' => 'DATETIME')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                }

                if ($this->db->field_exists('user_updated_at', $table_name) == 0) {
                    $fields = array(
                        'user_updated_at' => array('type' => 'VARCHAR', 'constraint' => '250')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                }

                if ($this->db->field_exists('deleted_at', $table_name) == 0) {
                    $fields = array(
                        'deleted_at' => array('type' => 'DATETIME')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                }

                if ($this->db->field_exists('user_deleted_at', $table_name) == 0) {
                    $fields = array(
                        'user_deleted_at' => array('type' => 'VARCHAR', 'constraint' => '250')
                    );
                    $this->dbforge->add_column($table_name, $fields);
                }



                if (mc_contains_in_string('proj_build', $table_name) || mc_contains_in_string('sec_', $table_name)) {
                    if ($this->db->field_exists('created', $table_name)) {
                        $_columns = ['created', 'user_created', 'updated', 'user_updated'];
                        foreach ($_columns as $_column):
                            $this->dbforge->drop_column($table_name, $_column);
                        endforeach;
                    }
                }
            }
        }
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
