<?php

/**
 * MY_Upload
 *
 * EXTENDENDO A CLASSE UPLOAD
 * FUNÇÃO QUE CRIA UM DIRETÓRIO PARA UPLOAD DE ARQUIVOS SE O MESMO NÃO EXISTIR.
 * 
 * @author Enio Marcelo Buzaneli
 * @date 26/06/2019
 * @time 08h28
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Upload extends CI_Upload {

    public function __construct($config = array()) {

        parent::__construct($config);

        if (!file_exists($config['upload_path'])) {
            bz_createFolder($config['upload_path']);
        }
    }

}
