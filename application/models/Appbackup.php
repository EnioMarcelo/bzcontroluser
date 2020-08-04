<?php
/**
 * Created on : 09/04/2020, 14:03:00
 * Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */

/**
 * FAZ O BACKUP DE UM APP, EXPORTA E IMPORTA.
 *
 * Class Appbackup
 */
class Appbackup extends CI_Model
{

    /**
     * @var null
     */
    protected $_app_nome = null;

    /**
     * @var null
     */
    protected $_table_name = null;

    /**
     * Appbackup constructor.
     * @param $app_name
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @param $app_name
     * @return string
     */
    public function export($app_nome)
    {
        $_result = [];
        $_proj_build_id = NULL;

        /** EXPORT APP DATA TABLE proj_build */
        $_r = [];
        $this->db->where('app_nome', $app_nome);
        $_r = $this->db->get('proj_build')->row_array();
        $this->_table_name = $_r['tabela'];

        if (!$_r) {
            $_json['msg']['title'] = 'Error!!!';
            $_json['msg']['text'] = 'APP não encontrado: ' . $app_nome;
            $_json['msg']['type'] = 'error';
            echo json_encode($_json);
            exit;
        }

        $_proj_build_id = $_r['id'];

        unset($_r['id']);
        unset($_r['created_at']);
        unset($_r['user_created_at']);
        unset($_r['updated_at']);
        unset($_r['user_updated_at']);
        unset($_r['deleted_at']);
        unset($_r['user_deleted_at']);

        $_result['table']['proj_build'] = $_r;


        /** EXPORT APP DATA TABLE proj_build_fields */
        $_r = [];
        $this->db->where('proj_build_id', $_proj_build_id);

        foreach ($this->db->get('proj_build_fields')->result_array() as $_v) {

            unset($_v['id']);
            unset($_v['proj_build_id']);
            unset($_v['created_at']);
            unset($_v['user_created_at']);
            unset($_v['updated_at']);
            unset($_v['user_updated_at']);
            unset($_v['deleted_at']);
            unset($_v['user_deleted_at']);

            $_r[] = $_v;
        }

        $_result['table']['proj_build_fields'] = $_r;


        /** EXPORT APP DATA TABLE proj_build_codeeditor */
        $_r = [];
        $this->db->where('proj_build_id', $_proj_build_id);

        foreach ($this->db->get('proj_build_codeeditor')->result_array() as $_v) {

            unset($_v['id']);
            unset($_v['proj_build_id']);
            unset($_v['created_at']);
            unset($_v['user_created_at']);
            unset($_v['updated_at']);
            unset($_v['user_updated_at']);
            unset($_v['deleted_at']);
            unset($_v['user_deleted_at']);

            $_r[] = $_v;
        }

        $_result['table']['proj_build_codeeditor'] = $_r;


        /** EXPORT STRUCTURE TABLE */
        if ($this->_table_name) {
            $_result['structure_table'] = $this->appbackup->export_structure_table($this->_table_name);
        }

        return base64_encode(json_encode($_result));

    }


    /**
     * @param $code_app_import
     * @param $app_nome
     * @return bool
     */
    public function import($code_app_import, $app_nome = NULL)
    {
        $_data = NULL;
        $_proj_build_id = NULL;
        $_app_exist = NULL;

        /** IMPORT APP DATA TABLE proj_build */
        $_data = json_decode(base64_decode($code_app_import), true);
        $_data = $_data['table']['proj_build'];

        if ($app_nome) {
            $_data['app_nome'] = $app_nome;
        }

        $_data['app_nome'] = ucfirst(bz_limpa_string(strtolower($_data['app_nome'])));
        $_data['app_nome'] = str_replace('_', '', $_data['app_nome']);

        $this->db->where('app_nome', $_data['app_nome']);
        $_app_exist = $this->db->get('proj_build')->result();

        if ($_app_exist) {
            $_json['msg']['title'] = 'Error!!!';
            $_json['msg']['text'] = 'Nome ' . $app_nome . ' do APP já existe.';
            $_json['msg']['type'] = 'error';
            echo json_encode($_json);
            exit;
        }

        $this->_app_nome = $_data['app_nome'];
        $this->_table_name = $_data['tabela'];

        $_proj_build_id = mc_insertDataDB('proj_build', $_data)['last_id_add'];

        if (!$_proj_build_id) {
            $_json['msg']['title'] = 'Error!!!';
            $_json['msg']['text'] = 'Erro na importação do APP na tabela proj_build.';
            $_json['msg']['type'] = 'error';
            echo json_encode($_json);
            exit;
        }

        /** IMPORT APP DATA TABLE proj_build_fields */
        $_data = NULL;
        $_data = json_decode(base64_decode($code_app_import), true);
        $_data = $_data['table']['proj_build_fields'];
        $_d = NULL;

        foreach ($_data as $_k => $_v) {

            $_d = [];
            $_v['proj_build_id'] = $_proj_build_id;
            $_d[] = $_v;

            mc_insertDataDB('proj_build_fields', $_d[0]);

        }

        /** IMPORT APP DATA TABLE proj_build_codeeditor */
        $_data = NULL;
        $_data = json_decode(base64_decode($code_app_import), true);
        $_data = $_data['table']['proj_build_codeeditor'];
        $_d = NULL;

        foreach ($_data as $_k => $_v) {

            $_d = [];
            $_v = (array)$_v;
            $_v['proj_build_id'] = $_proj_build_id;
            $_d[] = $_v;

            mc_insertDataDB('proj_build_codeeditor', $_d[0]);

        }

        /** IMPORT STRUCTURE TABLE */
        $_data = NULL;
        $_data = json_decode(base64_decode($code_app_import), true);
        if (!empty($_data['structure_table'])) {
            $this->appbackup->import_structure_table($this->_table_name, $_data['structure_table']);
        }

        /** CREATE DIRECTORY APP */
        if (!$this->make_dir($this->_app_nome)) {
            return false;
        }

        return true;

    }


    /**
     * @param $database_name
     * @return string
     */
    public function export_structure_table($database_name)
    {
        $query = $this->db->query('SHOW CREATE TABLE ' . $database_name);
        $queryResultArray = $query->result_array();

        return $queryResultArray[0]['Create Table'] . ';' . PHP_EOL . PHP_EOL;

    }


    /**
     * @param $database_name
     * @param $structure_script
     */
    public function import_structure_table($database_name, $structure_script)
    {
        $_r = 'DROP TABLE IF EXISTS `' . $database_name . '`;';
        $this->db->query($_r);

        if ($this->db->query($structure_script)) {

            $_r = 'ALTER TABLE `' . $database_name . '` AUTO_INCREMENT=1;';
            $this->db->query($_r);

        }


    }


    /**
     * @param $app_nome
     * @return bool
     */
    private function make_dir($app_nome)
    {
        $this->load->helper('file');

        $app_nome = ucfirst(bz_limpa_string(strtolower($app_nome)));
        $app_nome = str_replace('_', '', $app_nome);

        $folder = FCPATH . 'application/modules/' . strtolower($app_nome);

        /** CHECK SE O DIRETÓRIO MODULES TEM PREMISSÃO PARA SER GRAVADO */
        if (!is_writable(str_replace('/' . strtolower($app_nome), '', $folder))) {
            $_json['msg']['title'] = 'Error!!!';
            $_json['msg']['text'] = 'O Diretório MODULES não tem permissão para gravação. ' . str_replace('/' . $app_nome, '', $folder);
            $_json['msg']['type'] = 'error';
            echo json_encode($_json);
            exit;
        }

        /** CHECK SE O DIRETÓRIO DO APP JÁ EXISTE */
        if (is_dir($folder)) {
            $_json['msg']['title'] = 'Error!!!';
            $_json['msg']['text'] = 'O Diretório ' . $folder . ' já existe.';
            $_json['msg']['type'] = 'error';
            echo json_encode($_json);
            exit;

        }

        /** CRIA O APP NO SERVIDOR */

        $_dados_index_html = '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>';

        if (!is_dir($folder)) {
            mkdir($folder, 0755);
            mkdir($folder . '/controllers', 0755);
            mkdir($folder . '/models', 0755);
            mkdir($folder . '/views', 0755);
            mkdir($folder . '/views/css', 0755);
            mkdir($folder . '/views/js', 0755);

            write_file($folder . '/index.html', $_dados_index_html);
            write_file($folder . '/controllers/index.html', $_dados_index_html);
            write_file($folder . '/models/index.html', $_dados_index_html);
            write_file($folder . '/views/index.html', $_dados_index_html);
            write_file($folder . '/views/css/index.html', $_dados_index_html);
            write_file($folder . '/views/js/index.html', $_dados_index_html);
        }

        return true;

    }

}