<?php

/*
  Created on : 09/08/2019, 14:29PM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Appblank005_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }
    //END function __construct()

    
    /* MODELS PHP - fcn_get_genero */
public function fcn_get_genero($_p = null) {
return 'MODEL GET GENERO: '.$_p['genero'];
}
/* END MODELS PHP - fcn_get_genero */


    
   
}

//END model
