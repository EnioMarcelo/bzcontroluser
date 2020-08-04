<?php

/*
  Created on : 27/03/2018, 17:19:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class User_acl_groups extends MY_model {

    public function __construct() {
        parent::__construct();
    }

    /*
     * GET ACL DO USUÁRIO
     * RETORNA UM ARRAY COM TODAS AS PERMISSÕES DE GRUPOS E APPS DO USUÁRIO
     *
     * @param string $_p['string_filter'] ID do Usuário
     * @param string $_p['key_filter'] Chave de Pesquisa para Filtragem.
     * ( by_user_id ) Filtra pelo ID do Usuário,
     * ( by_user_email ) Filtra pelo EMAIL do Usuário,
     * ( by_grupo_id ) Filtra pelo ID do GRUPO que o Usuário Pertence,
     * ( by_app_name ) Filtra pelo NAME do APP que o Usuário tem permissão de acesso.
     */

    function _get_acl_user($_p = array()) {

        if (is_array($_p)) {

            $this->db->select('u.id as usuario_id, u.nome as usuario_nome, u.email as usuario_email, u.ativo as usuario_ativo, u.app_inicial as usuario_app_inicial, '
                    . 'g.id as grupo_id, g.ativo as grupo_ativo, g.descricao as grupo_descricao, g.app_inicial as grupo_app_inicial,'
                    . 'a.app_descricao as app_descricao, LOWER(a.app_name) as app_name, a.app_ativo as app_ativo');

            $this->db->from('sec_usuarios u');

            if ($_p['key_filter'] == 'by_user_id') {
                $this->db->where('u.id', $_p['string_filter']);
            } elseif ($_p['key_filter'] == 'by_user_email') {
                $this->db->where('u.email', $_p['string_filter']);
            } elseif ($_p['key_filter'] == 'by_grupo_id') {
                $this->db->where('g.id', $_p['string_filter']);
            } elseif ($_p['key_filter'] == 'by_app_name') {
                $this->db->where('a.app_name', $_p['string_filter']);
            }

            $this->db->order_by('u.nome, g.descricao, a.app_descricao');

            $this->db->join('sec_usuarios_has_sec_grupos ug', 'ug.sec_usuarios_id = u.id', 'left');
            $this->db->join('sec_grupos g', 'ug.sec_grupos_id = g.id', 'left');
            $this->db->join('sec_grupos_has_sec_aplicativos ga', 'ga.sec_grupos_id = g.id', 'left');
            $this->db->join('sec_aplicativos a', 'a.app_name = ga.sec_aplicativos_app_name', 'left');

            $_query = $this->db->get()->result_array();

            return $_query;
        } else {
            return false;
        }
    }

//END bz_get_acl_user()



    /*
     * GET USER AND ACL ACCES BY email - GROUPS AND APPS
     */

    public function _get_acl_user_by_email($_email) {

        $this->db->select('sec_usuarios.id as usuario_id, sec_usuarios.nome as usuario_nome, sec_usuarios.email as usuario_email, sec_usuarios.app_inicial as usuario_app_inicial, '
                . 'sec_grupos.id as grupo_id, sec_grupos.descricao as grupo_descricao, sec_grupos.app_inicial as grupo_app_inicial,'
                . 'sec_aplicativos.app_name as app_name, sec_aplicativos.app_descricao as app_descricao');
        $this->db->from('sec_usuarios');
        $this->db->join('sec_usuarios_has_sec_grupos', 'sec_usuarios.id = sec_usuarios_has_sec_grupos.sec_usuarios_id', 'inner');
        $this->db->join('sec_grupos', 'sec_usuarios_has_sec_grupos.sec_grupos_id = sec_grupos.id', 'inner');
        $this->db->join('sec_grupos_has_sec_aplicativos', 'sec_grupos_has_sec_aplicativos.sec_grupos_id = sec_grupos.id', 'inner');
        $this->db->join('sec_aplicativos', 'sec_aplicativos.app_name = sec_grupos_has_sec_aplicativos.sec_aplicativos_app_name', 'inner');

        $this->db->order_by('sec_usuarios.nome');

        $this->db->where('sec_usuarios.email', $_email);

        $query = $this->db->get();

        return $query->result_array();
    }

// END GET USER AND ACL ACCES BY email - GROUPS AND APPS



    /*
     * GET SPECIFIC APP USER ACL BY email AND app_name
     */

    public function _get_acl_apps_user($_email, $_app) {

        $this->db->select('sec_usuarios.id as usuario_id, sec_usuarios.nome as usuario_nome, sec_usuarios.email as usuario_email, sec_usuarios.app_inicial as usuario_app_inicial, '
                . 'sec_grupos.id as grupo_id, sec_grupos.descricao as grupo_descricao, g.app_inicial as grupo_app_inicial,'
                . 'sec_aplicativos.app_name as app_name, sec_aplicativos.app_descricao as app_descricao');
        $this->db->from('sec_usuarios');
        $this->db->join('sec_usuarios_has_sec_grupos', 'sec_usuarios.id = sec_usuarios_has_sec_grupos.sec_usuarios_id', 'inner');
        $this->db->join('sec_grupos', 'sec_usuarios_has_sec_grupos.sec_grupos_id = sec_grupos.id', 'inner');
        $this->db->join('sec_grupos_has_sec_aplicativos', 'sec_grupos_has_sec_aplicativos.sec_grupos_id = sec_grupos.id', 'inner');
        $this->db->join('sec_aplicativos', 'sec_aplicativos.app_name = sec_grupos_has_sec_aplicativos.sec_aplicativos_app_name', 'inner');

        $this->db->where('sec_usuarios.email', $_email);
        $this->db->where('sec_usuarios.ativo', 'Y');

        $this->db->where('sec_grupos.ativo', 'Y');

        $this->db->where('sec_aplicativos.app_name', $_app);
        $this->db->where('sec_aplicativos.app_ativo', 'Y');

        $query = $this->db->get();

        return $query->result_array();
    }

//END GET SPECIFIC APP USER ACL BY email AND app_name
}
