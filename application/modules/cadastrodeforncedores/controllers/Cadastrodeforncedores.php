    <?php

/*
  Created on : 11/12/2018, 16:53PM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Cadastrodeforncedores
 */
class Cadastrodeforncedores extends MY_Controller {
    /* function  __construct() */

    public function __construct() {
        parent::__construct();

        /* LOAD MODEL */
        $this->load->model('Cadastrodeforncedores_model', 'm', TRUE);


        /* TÍTULO DA APLICAÇÃO */
        $this->dados['_titulo_app'] = 'Cadastro de Fornecedores';
        $this->dados['_font_icon'] = 'fa fa-briefcase';

        /* VIEW DA APLICAÇÃO */
        $this->dados['_view_app_list'] = 'vCadastrodeforncedores';
        $this->dados['_view_app_add'] = 'vCadastrodeforncedoresFormAdd';
        $this->dados['_view_app_edit'] = 'vCadastrodeforncedoresFormEdit';

        /* TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
        $this->table_gridlist_name = 'cad_fornecedor';
        $this->table_formaddedit_name = 'cad_fornecedor';
    }

    /* END function __construct() */



    /* function index() */

    public function index() {


        $this->load->library('Lib_RouterOS');

        // define required values
        $router = '192.168.100.100:8728';
        $username = 'admin';
        $password = '102030';

        // basic informational command to send
//        $command = '/system/resource/print';
//        $command = '/ip/hotspot/active/print';
//        $command = '/ip/hotspot/user/print';
//        
//        $command = '/ip/hotspot/user/enable';
//        $command = '/ip/hotspot/user/remove';


        $args = [];

        // LOG

        $command_log_info = '/log/info';
        $command_log_warning = '/log/warning';
        $command_log_error = '/log/error';


        // DEL USER
//        $command_del_user = '/ip/hotspot/user/remove';
//        $args_del_user = array(
//            '.id' => '*7C8'
//        );
        
        
        
        // DEL MANGLE
        $command_del_mangle = '/ip/firewall/mangle/remove';
        $args_del_mangle = array(
            '.id' => '*C44'
        );


        // ADD USER
//        $command_add_user = '/ip/hotspot/user/add';
//        $args_add_user = array(
//            'server' => 'hotspot1',
//            'name' => 'buzza',
//            'password' => 'buza',
//            'profile' => 'hsprof1',
//            'comment' => 'INFORMATICA - ENIO MARCELO BUZANELI - User: buzza - Disp: Celular'
//        );


        // ADD MANGLE USER
//        $command_add_mangle = '/ip/firewall/mangle/add';
//        $args_add_mangle = array(
//            'chain' => 'prerouting',
//            'src-mac-address' => '00:00:00:00:00:00',
//            'action' => 'mark-routing',
//            'new-routing-mark' => 'generica_rede',
//            'passthrough' => 'yes',
//            'comment' => 'INFORMATICA - ENIO MARCELO BUZANELI - User: buzza - Disp: Celular'
//        );




        $mikrotik = new Lib_RouterOS();
        $mikrotik->setDebug(false);



        try {
            // establish connection to router; throws exception if connection fails
            $mikrotik->connect($router);

            // send login sequence; throws exception on invalid username/password
            $mikrotik->login($username, $password);
            
            //DEL USER
//            $mikrotik->send($command_del_user, $args_del_user);
//            $response_del_user = $mikrotik->read();
//            echo '<pre class="vardump">';
//            var_dump($response_del_user);
//            echo '</pre>';
            
            
            //DEL MANGLE
//            $mikrotik->send($command_del_mangle, $args_del_mangle);
//            $response_del_mangle = $mikrotik->read();
//            echo '<pre class="vardump">';
//            var_dump($response_del_mangle);
//            echo '</pre>';
            

            // encodes and send command to router; throws exception if connection lost
//            $mikrotik->send($command_add_user, $args_add_user);
//            $response_add_user = $mikrotik->read();
//            echo '<br/>User ID:' . $response_add_user['!done']['ret'];
//
//            $args_log = array(
//                'message' => 'USER BUZZA ADD HOTSPOT'
//            );
//            $mikrotik->send($command_log_warning, $args_log);
//            $response_log = $mikrotik->read();
//
//            $mikrotik->send($command_add_mangle, $args_add_mangle);
//            $response_add_mangle = $mikrotik->read();
//            echo '<br/>Mangle ID:' . $response_add_mangle['!done']['ret'];
//
//            $args_log = array(
//                'message' => 'MANGLE USER BUZZA ADD'
//            );
//            $mikrotik->send($command_log_warning, $args_log);
//            $response_log = $mikrotik->read();
            
            
            // read response to command; throws exception if command was invalid (!trap,
            // !fatal etc), connection terminated, or recv'd unexpected data
//            $response = $mikrotik->read();
            // show the structure of the parsed response




//            echo '<pre>';
//            var_dump($response_add_user, $response_add_mangle);
//            echo '<pre>';
        } catch (Exception $ex) {
            echo "Caught exception from router: " . $ex->getMessage() . "\n";
        }




        exit;



//            $_r = $this->m->findAll('cad_profissao');
        //$_r = $this->m->findById($this->table_gridlist_name, 17)->result();
//            $this->m->orderBy('profissao ASC');
//            $_r = $this->m->findByField('cad_profissao', 'profissao', 'aeronauti', 'like');
//            $_r = $this->m->findById('cad_profissao', '10115');
        //$_r = $this->m->findAll('cad_genero')->result();
//            echo '<pre>';
//
//            var_dump( $_r->result() );
//
//            echo '</pre>';





        exit;

        /* CARREGA OS REGISTROS COM PAGINAÇÃO */
        $this->dados['_result'] = $this->get_paginacao();

        /* TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
        $this->dados['_conteudo_masterPageIframe'] = $this->router->fetch_class() . '/' . $this->dados['_view_app_list'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /* END function index() */



    /* function add() */

    public function add() {

        if ($this->input->post() && $this->input->post('btn-salvar') == 'btn-salvar'):


            /* VALIDAÇÃO DOS DADOS */
            $this->form_validation->set_rules('cpf', '<b>cpf</b>', 'trim');
            $this->form_validation->set_rules('nome', '<b>nome</b>', 'trim|strtoupper|min_length[5]|max_length[255]');

            /* END VALIDAÇÃO DOS DADOS */



            if ($this->form_validation->run() == true):

                $_dados = $this->input->post();

                unset($_dados['btn-salvar']);

                //** CONVERTE DADOS PARA GRAVAR NA TABELA **//
                $_dados["cpf"] = preg_replace("/[^0-9]/", "", $_dados["cpf"]);

// CONVERTE DADOS PARA GRAVAR NA TABELA //


                /* GRAVA REGISTRO */

                $result = $this->create->ExecCreate($this->table_formaddedit_name, $_dados);
                if ($this->db->trans_status() === FALSE):
                    $this->db->trans_rollback();
                    echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_formaddedit_name);
                    exit;
                else:
                    $this->db->trans_commit();
                endif;

                if ($result):

                    /* GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'add';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_ADD_SUCCESS___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    $dados_auditoria['last_query'] = str_replace($this->table_formaddedit_name . ' (', $this->table_formaddedit_name . ' (id, ', $dados_auditoria['last_query']);
                    $dados_auditoria['last_query'] = str_replace('VALUES (', 'VALUES ("' . $result['last_id_add'] . '", ', $dados_auditoria['last_query']);

                    add_auditoria($dados_auditoria);

                    set_mensagem_notfit(___MSG_ADD_REGISTRO___, 'success');



                else:
                    echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_formaddedit_name);
                    exit;
                endif;


                redirect($this->_redirect . '/add');

            /* END GRAVA REGISTRO */

            endif;

        endif;




        /* TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_add'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /* END function add() */




    /* function edit() */

    public function edit($_id = null) {

        /* SE $_id FOR INFORMADO E A VALIDAÇÃO DOS DADOS FOR true, ENTÃO SERÁ FEITO O UPDATE DOS DADOS */
        if ($this->input->post() && $this->input->post('btn-editar') == 'btn-editar'):

            /* VALIDAÇÃO DOS DADOS */
            $this->form_validation->set_rules('cpf', '<b>cpf</b>', 'trim');
            $this->form_validation->set_rules('nome', '<b>nome</b>', 'trim|strtoupper|min_length[5]|max_length[255]');

            /* END VALIDAÇÃO DOS DADOS */



            if ($this->form_validation->run() == true):

                $_dados = $this->input->post();

                unset($_dados['btn-editar']);

                unset($_dados['cpf']);



                /* UPDATE REGISTRO */

                $_where_update = 'WHERE cpf = "' . $_id . '"';
                $_result_update = $this->update->ExecUpdate($this->table_formaddedit_name, $_dados, $_where_update);

                if ($this->db->trans_status() === FALSE):
                    $this->db->trans_rollback();
                    echo 'Erro ao atualizar Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_formaddedit_name);
                    exit;
                else:
                    $this->db->trans_commit();
                endif;

                if ($_result_update):

                    /* GRAVA AUDITORIA */
                    $dados_auditoria['creator'] = 'user';
                    $dados_auditoria['action'] = 'edit';
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_UPDATE_SUCCESS___;
                    $dados_auditoria['last_query'] = $this->db->last_query();
                    add_auditoria($dados_auditoria);

                    set_mensagem_notfit(___MSG_UPDATE_REGISTRO___, 'success');



                else:
                    echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_formaddedit_name);
                    exit;
                endif;
            /* END UPDATE REGISTRO */

            endif;

        endif;


        /* GET DADOS PARA CARREGAR O FORM DE EDIT */
        if ($_id):

            /* GET DADOS */
            $_where = 'WHERE cpf = "' . $_id . '" LIMIT 1';
            $_result = $this->read->ExecRead($this->table_formaddedit_name, $_where);

            if ($_result->result()):
                $this->dados['dados'] = $_result->row();
            else:
                set_mensagem_notfit(___MSG_ERROR_SELECT_UPDATE_REGISTRO___, 'error');
                redirect($this->_redirect_parametros_url);
            endif;

        else:
            redirect($this->_redirect_parametros_url);
        endif;
        /* END GET DADOS PARA CARREGAR O FORM DE EDIT */

        /* TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
        $this->dados['_conteudo_masterPageIframe'] = $this->dados['_view_app_edit'];
        $this->load->view('vMasterPageIframe', $this->dados);
    }

    /* END function edit() */




    /* function del() */

    public function del() {

        /* CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX. */
        bz_check_is_ajax_request();

        $this->form_validation->set_rules('btndel', '<b>BTN Del</b>', 'trim|required');
        $this->form_validation->set_rules('dadosdel', '<b>REGISTROS DEL</b>', 'trim|required');



        if ($this->form_validation->run() == TRUE):

            $_dados = $this->input->post('dadosdel', TRUE);
            $_dados = explode(',', $_dados);

            /* DELETA OS REGISTROS */
            $this->db->where_in('cpf', $_dados);
            $this->db->delete($this->table_formaddedit_name);
            if ($this->db->trans_status() === FALSE):
                $this->db->trans_rollback();
                echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_formaddedit_name);
                exit;
            else:
                $this->db->trans_commit();
            endif;


            if ($this->db->affected_rows()):
                if (count($_dados) > 1):
                    set_mensagem_notfit(str_replace('Registro Deletado', 'Registros Deletados', ___MSG_DEL_REGISTRO___), 'success');
                    $dados_auditoria['description'] = str_replace('Registro Deletado', 'Registros Deletados', ___MSG_AUDITORIA_DEL_SUCCESS___);
                else:
                    set_mensagem_notfit(___MSG_DEL_REGISTRO___, 'success');
                    $dados_auditoria['description'] = ___MSG_AUDITORIA_DEL_SUCCESS___;
                endif;

                /* GRAVA AUDITORIA */
                $dados_auditoria['creator'] = 'user';
                $dados_auditoria['action'] = 'del';
                $dados_auditoria['last_query'] = $this->db->last_query();
                add_auditoria($dados_auditoria);



            else:
                set_mensagem_notfit(___MSG_ERROR_DEL_REGISTRO___, 'error');
            endif;

        else:
            set_mensagem_notfit(___MSG_ERROR_DE_VALIDACAO___, 'error');
        endif;

        exit;
    }

    /* END function del() */



    /* CARREGA REGISTROS COM PAGINAÇÃO */

    private function get_paginacao() {
        $_filter = $this->input->get();
        unset($_filter['pg']);
        unset($_filter['search']);

        /* DADOS PARA PAGINAÇÃO */
        $_dados_pag['table'] = $this->table_gridlist_name;
        if ($this->input->get('search', TRUE)):
            $_dados_pag['search'] = array('_concat_fields' => 'cpf,nome,endereco,email,telefone,ativo,created,user_created,updated,user_updated', '_string' => $this->input->get('search', TRUE));
        endif;
        $_dados_pag['filter'] = $_filter;
        $_dados_pag['order_by'] = 'nome ASC';
        $_dados_pag['programa'] = $this->router->fetch_class();
        $_dados_pag['per_page'] = '10';

        $_result_pag = bz_paginacao($_dados_pag);

        $_y = [];
        if ($_y):
            $_z = $_result_pag['results_paginacao_array'];
            foreach ($_y as $_y_key => $_y_row):
                foreach ($_z as $_z_key => $_z_row):
                    $_result_pag['results_paginacao_array'][$_z_key][$_y_row] = '';
                endforeach;
            endforeach;
        endif;

        return $_result_pag;
    }

    /* END function get_paginacao()  */
}

/* END class Cadastrodeforncedores */
