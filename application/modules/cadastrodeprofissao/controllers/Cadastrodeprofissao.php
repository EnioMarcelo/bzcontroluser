<?php

/*
  Created on : 11/03/2019, 09:22AM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */


  defined('BASEPATH') OR exit('No direct script access allowed');

  class Cadastrodeprofissao extends MY_Controller {


    /* function  __construct() */
  	public function __construct() {
  		parent::__construct();

      /* LOAD MODEL */
      $this->load->model('Cadastrodeprofissao_model', 'm', TRUE);


      /* TÍTULO DA APLICAÇÃO */
      $this->dados['_titulo_app'] = 'Cadastro de Profissões';
      $this->dados['_font_icon'] = 'fa fa-bullhorn';

      /* VIEW DA APLICAÇÃO */
      $this->dados['_view_app_list'] = 'vCadastrodeprofissao';
      $this->dados['_view_app_add'] = 'vCadastrodeprofissaoFormAdd';
      $this->dados['_view_app_edit'] = 'vCadastrodeprofissaoFormEdit';

      /* TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
      $this->table_gridlist_name = 'cad_profissao';
      $this->table_formaddedit_name = 'cad_profissao';

      $this->fcn_onScriptinit();


    }
    /* END function __construct() */



    /* function index() */
    public function index() {

      /* CARREGA OS REGISTROS COM PAGINAÇÃO */
      $this->dados['_result'] = $this->get_paginacao();

      /* TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
      $this->dados['_conteudo_masterPageIframe'] = $this->router->fetch_class() . '/' . $this->dados['_view_app_list'];
      $this->load->view('vMasterPageIframe', $this->dados);

    }
    /* END function index() */



    /* function add() */
    public function add(){

      if ($this->input->post() && $this->input->post('btn-salvar') == 'btn-salvar'):


        /* VALIDAÇÃO DOS DADOS */
        $this->form_validation->set_rules('profissao', '<b>Profissão</b>', 'trim|strtoupper|max_length[255]|required');

        /* END VALIDAÇÃO DOS DADOS */

        

        if ($this->form_validation->run() == true ):

          $_dados = $this->input->post();

          unset($_dados['btn-salvar']);
          
          

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
            $dados_auditoria['last_query'] = str_replace("VALUES (''", "VALUES ('".$result['last_id_add']."'", $dados_auditoria['last_query']);

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
  public function edit($_id = null){

    /* SE $_id FOR INFORMADO E A VALIDAÇÃO DOS DADOS FOR true, ENTÃO SERÁ FEITO O UPDATE DOS DADOS */
    if ($this->input->post() && $this->input->post('btn-editar') == 'btn-editar'):

      /* VALIDAÇÃO DOS DADOS */
      $this->form_validation->set_rules('profissao', '<b>Profissão</b>', 'trim|strtoupper|max_length[255]|required');

      /* END VALIDAÇÃO DOS DADOS */

      

      if ($this->form_validation->run() == true ):

         $_dados = $this->input->post();

         unset($_dados['btn-editar']);
         
         
         

         /* UPDATE REGISTRO */

         $_where_update = 'WHERE id = "'.$_id.'"';
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
  $_where = 'WHERE id = "' . $_id . '" LIMIT 1';
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
public function del(){

 /* CERTIFICA SE O ACESSO A ESTA FUNCTION REALMENTE ESTÁ SENDO FEITO POR AJAX. */
 bz_check_is_ajax_request();

 $this->form_validation->set_rules('btndel', '<b>BTN Del</b>', 'trim|required');
 $this->form_validation->set_rules('dadosdel', '<b>REGISTROS DEL</b>', 'trim|required');

 

 if ($this->form_validation->run() == TRUE):

  $_dados = $this->input->post('dadosdel', TRUE);
  $_dados = explode(',', $_dados);

  /* DELETA OS REGISTROS */
  $this->db->where_in('id', $_dados);
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
                            $_dados_pag['search'] = array('_concat_fields' => 'id,profissao', '_string' => $this->input->get('search', TRUE));
                        endif;

  $_dados_pag['filter'] = $_filter;
  $_dados_pag['order_by'] = 'profissao ASC';
  $_dados_pag['programa'] = $this->router->fetch_class();
  $_dados_pag['per_page'] = (!empty($this->page['per_page']) ? $this->page['per_page'] : '10' );

  $_result_pag = bz_paginacao($_dados_pag);

  $_y = [];
  if($_y):
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


/* METODO PHP - fcn_onScriptInit */
public function fcn_onScriptInit($_p = null) {
$this->page['per_page'] = 150;
}
/* END METODO PHP - fcn_onScriptInit */





}
/* END class Cadastrodeprofissao */
