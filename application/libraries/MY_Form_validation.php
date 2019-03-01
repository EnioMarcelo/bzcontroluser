<?php

/*
  Created on : 13/03/2017, 13:51:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */

class MY_Form_validation extends CI_Form_validation {

    public $CI;

    /**
     * Is Unique
     *
     * Check if the input value doesn't already exist
     * in the specified database field.
     *
     * @param   string  $str
     * @param   string  $field
     * @return  bool
     */
    public function is_unique($str, $field) {
        sscanf($field, '%[^.].%[^.]', $table, $field);
        //return isset($this->CI->db)
        return is_object($this->CI->db) ? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 0) : FALSE;
    }

}
