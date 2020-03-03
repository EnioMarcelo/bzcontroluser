<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Projectbuildcrud_model
 */
class Projectbuildcrud_model extends MY_Model
{
    /**
     * Projectbuildcrud_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $_code_git
     * @param $_proj_build_id
     * @param int $_limit
     */
    public function limit_code_git($_code_git, $_proj_build_id, $_limit = 10)
    {
        $this->db->where('code_git', $_code_git);
        $this->db->where('proj_build_id', $_proj_build_id);
        $this->db->order_by('id DESC');
        $_c = 0;
        foreach ($this->db->get('proj_build_git')->result() as $_row) {
            $_c++;
            if ($_c >= $_limit) {
                $this->db->where('id', $_row->id);
                $this->db->delete('proj_build_git');
            }
        }

        return;

    }


    /**
     * @param array $_data
     */
    public function save_code_git($_data = [])
    {
        $this->create->exec(
            'proj_build_git', $_data
        );

        return;

    }


    /**
     * @param $_proj_build_id
     * @param $_code_git
     * @return mixed
     */
    public function get_code_git($_proj_build_id, $_code_git)
    {
        return $this->read->exec("proj_build_git", "WHERE proj_build_id = $_proj_build_id  AND
                      code_git = '$_code_git' ORDER BY created_at DESC")->result();
    }


    /**
     * @param $_proj_build_id
     * @param $_code_git
     */
    public function delete_code_git($_proj_build_id, $_code_git)
    {
        $this->db->where('proj_build_id', $_proj_build_id);
        $this->db->where('code_git', $_code_git);
        $this->db->delete('proj_build_git');

        return;

    }


    /**
     * @param $_proj_build_id
     */
    public function delete_code_git_by_proj_build_id($_proj_build_id)
    {
        $this->db->where('proj_build_id', $_proj_build_id);
        $this->db->delete('proj_build_git');

        return;

    }


}

