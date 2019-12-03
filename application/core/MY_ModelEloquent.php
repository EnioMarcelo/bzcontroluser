<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  Created on : 21/09/2017, 08:38:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MY_Model
 */
class MY_ModelEloquent extends Model {

    use SoftDeletes;

    protected $table;
    protected $primaryKey;
    public $timestamps = true;

    /**
     * MY_Model constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $table
     */
    public function table($_table) {
        $this->table = $_table;
    }

    /**
     * 
     * @param type $primaryKey
     */
    public function primaryKey($_primaryKey) {
        $this->primaryKey = $_primaryKey;
    }

}

//END class MY_ModelEloquent
