<?php

/*
  Created on : 15/03/2019, 13:38PM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */


  defined('BASEPATH') OR exit('No direct script access allowed');

  class Cadastrodeclientes extends MY_Controller {


    /* function  __construct() */
  	public function __construct() {
  		parent::__construct();

      /* LOAD MODEL */
      $this->load->model('Cadastrodeclientes_model', 'm', TRUE);


      /* TÍTULO DA APLICAÇÃO */
      $this->dados['_titulo_app'] = 'Cadastro de Clientes';
      $this->dados['_font_icon'] = 'fa fa-user-plus';

      /* VIEW DA APLICAÇÃO */
      $this->dados['_view_app_list'] = 'vCadastrodeclientes';
      $this->dados['_view_app_add'] = 'vCadastrodeclientesFormAdd';
      $this->dados['_view_app_edit'] = 'vCadastrodeclientesFormEdit';

      /* TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
      $this->table_gridlist_name = 'cad_cliente';
      $this->table_formaddedit_name = 'cad_cliente';

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
        $this->form_validation->set_rules('id', '<b>ID</b>', 'trim|max_length[11]');
$this->form_validation->set_rules('nome', '<b>Nome</b>', 'trim|strtoupper|max_length[255]|required');
$this->form_validation->set_rules('genero_id', '<b>Gênero</b>', 'trim|callback_validation_required_genero_id');
$this->form_validation->set_rules('telefone', '<b>Senha</b>', 'trim|alpha_numeric');

        /* END VALIDAÇÃO DOS DADOS */

        

        if ($this->form_validation->run() == true ):

          $_dados = $this->input->post();

          unset($_dados['btn-salvar']);
          
          //** CONVERTE DADOS PARA GRAVAR NA TABELA **//
$_dados["id"] = preg_replace("/[^0-9]/", "", $_dados["id"]);

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
      $this->form_validation->set_rules('id', '<b>ID</b>', 'trim|max_length[11]');
$this->form_validation->set_rules('nome', '<b>Nome</b>', 'trim|strtoupper|max_length[255]|required');
$this->form_validation->set_rules('genero_id', '<b>Gênero</b>', 'trim|callback_validation_required_genero_id');
$this->form_validation->set_rules('telefone', '<b>Senha</b>', 'trim|alpha_numeric');

      /* END VALIDAÇÃO DOS DADOS */

      

      if ($this->form_validation->run() == true ):

         $_dados = $this->input->post();

         unset($_dados['btn-editar']);
         
         unset($_dados['id']);

         

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


/* function export() - Print Report */
    public function export() {
            
    
        
    /* CARREGA O HELPER */
//    $this->load->helper('printtopdf');
    
    /* VARIABLES */
    $this->export['_loadHtml'] = '';

        
    /* QUANTIDADE DE LINHAS NO PDF - ZERO = TODAS OS REGISTROS DA TABELA */    
    $this->page['per_page'] = 0;
    
    
        
    /* CARREGA OS REGISTROS COM PAGINAÇÃO */
    $this->export['_dados'] = $this->get_paginacao();
    
    
    
    
    
    /* GERA O RELATÓRIO PARA SER EXPORTADO */
    
    $this->export['_loadHtml'] .= '<html>';
    $this->export['_loadHtml'] .= '  <head>';
    $this->export['_loadHtml'] .= '      <meta charset="UTF-8">';
    $this->export['_loadHtml'] .= "      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>";
    $this->export['_loadHtml'] .= "      <!-- Bootstrap 3.3.4 -->";
    $this->export['_loadHtml'] .= '      <link href="'.site_url().'/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />';
    $this->export['_loadHtml'] .= '      <!-- Font Awesome Icons -->';
    $this->export['_loadHtml'] .= '      <link href="'.site_url().'/assets/font/font-awesome.min.css" rel="stylesheet" type="text/css"/>';
    $this->export['_loadHtml'] .= '      <!-- BOOT BUZA -->';
    $this->export['_loadHtml'] .= '      <link href="'.base_url('assets').'/css/boot-buza.css" rel="stylesheet" type="text/css" />';
    $this->export['_loadHtml'] .= '      <!-- CSS DEFAULT MASTER PAGE IFRAME -->';
    $this->export['_loadHtml'] .= '      <link href="'.base_url('assets').'/css/custom-masterPageIframe.css" rel="stylesheet" type="text/css" />';
    $this->export['_loadHtml'] .= '      <style>';
    $this->export['_loadHtml'] .= '         table { border-collapse:unset; }';
    $this->export['_loadHtml'] .= '         .table>thead>tr>td, .table>thead>tr>th{ font-size:14px; line-height:1em; }';
    $this->export['_loadHtml'] .= '         .table>tbody>tr>td, .table>tbody>tr>th{ font-size:12px; line-height:0.5em; }';
    $this->export['_loadHtml'] .= '         .table>tfoot>tr>td, .table>tfoot>tr>th{ font-size:12px; line-height:0.5em; }';
    $this->export['_loadHtml'] .= '         a, a:hover, a:visited, a:link, a:active{ color: black !important; text-decoration: none !important; }';
    $this->export['_loadHtml'] .= '         .pointer {cursor: pointer;}';
    $this->export['_loadHtml'] .= '      </style>';
    $this->export['_loadHtml'] .= "  </head>";
    $this->export['_loadHtml'] .= "  <body>";
    
    $this->export['_loadHtml'] .= " <!-- TABLE -->";
    $this->export['_loadHtml'] .= "<div class='container'>";
    $this->export['_loadHtml'] .= '<h3 class="pointer" style="margin-top:5; margin-botom:15px" title="Voltar">';
    $this->export['_loadHtml'] .= "<i class='".$this->dados['_font_icon']."'></i>";
    $this->export['_loadHtml'] .= '<spam style="margin-left:10px;">'.$this->dados["_titulo_app"].'</spam>';
    $this->export['_loadHtml'] .= "</h3>";
	$this->export['_loadHtml'] .= "	<table class='table table-striped'>";
	$this->export['_loadHtml'] .= "     <!-- HEADER DA TABLE -->";
	$this->export['_loadHtml'] .= "     <thead style='background-color:black;color:white'>";
	$this->export['_loadHtml'] .= "         <tr id='IdTableGridListTheadTr'>";
	$this->export['_loadHtml'] .= "             <th class='text-center' style='width:3%;'>#</th>";
	$this->export['_loadHtml'] .= '             <th class="thClId" class="text-center" style="width:6%; text-align:center">ID</th>
<th class="thClNome" class="text-left" style="text-align:left">Nome</th>
<th class="thClEndereco" class="text-left" style="text-align:left">Endereço</th>
<th class="thClGenero_id" class="text-left" style="text-align:left">Gênero</th>
';
	$this->export['_loadHtml'] .= "			</tr>";
	$this->export['_loadHtml'] .= "		</thead>";
	$this->export['_loadHtml'] .= "     <!-- END HEADER DA TABLE -->";
    
    $this->export['_loadHtml'] .= "     <!-- ON RECORD EXPORT TABLE -->";
	$this->export['_loadHtml'] .= "     <tbody>";
        
        /* ON RECORD EXPORT */
        $_c = 0; 
        $_class_tr = ''; 
        $_style_tr = '';

        foreach ($this->export['_dados']['results_paginacao_array'] as $_key => $_row):

            $_c++;
        
            

            $this->export['_loadHtml'] .= "<tr class='".$_class_tr."' style='font-size:12px;line-height: 0.6em; ".$_style_tr."'>";
            
            $this->export['_loadHtml'] .= "    <td class='text-center'  >".$_c."</td>";

            $this->export['_loadHtml'] .= "    <!-- CAMPOS DA TABLE -->";
            $this->export['_loadHtml'] .= '     <td class="tdClId" class="text-center" style="width:6%; text-align:center">'.$_row["id"].'</td>
<td class="tdClNome" class="text-left" style="text-align:left">'.$_row["nome"].'</td>
<td class="tdClEndereco" class="text-left" style="text-align:left">'.$_row["endereco"].'</td>
<td class="tdClGenero_id" class="text-left" style="text-align:left">'.$_row["genero_id"].'</td>
';
            $this->export['_loadHtml'] .= "    <!-- CAMPOS DA TABLE -->";

            $this->export['_loadHtml'] .= "</tr>";

        endforeach;
        /* EBD ON RECORD EXPORT */
    
    
    $this->export['_loadHtml'] .= "     </tbody>";
    $this->export['_loadHtml'] .= "     <!-- ON RECORD EXPORT DADOS DA TABLE -->";
    $this->export['_loadHtml'] .= " </table>";
    $this->export['_loadHtml'] .= " <!-- END TABLE -->";
    
    $this->export['_loadHtml'] .= "</div>";
    $this->export['_loadHtml'] .= '</body>';
    $this->export['_loadHtml'] .= '</html>';
    
    /* JQUERY */ 
    $this->export['_loadHtml'] .= '<!-- jQuery 2.1.4 -->';
    $this->export['_loadHtml'] .= '<script src="' . site_url() . '/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>';
    
    $this->export['_loadHtml'] .= '<script>';
    /* IMPRIME A PÁGINA */
    $this->export['_loadHtml'] .= 'window.print();';

    /* VOLTAR PÁGINA */
    $this->export['_loadHtml'] .= '$(function(){'
            . '$( "h3" ).on( "click", function() {'
            . 'window.location.replace("' . $this->_redirect_parametros_url . '");'
            . '});'
            . '})';

    $this->export['_loadHtml'] .= '</script>';
    
    
    
    /* IMPRIME */
    echo $this->export['_loadHtml'] ;
    
    

}
/* END function export() - Print Report */



/* CARREGA REGISTROS COM PAGINAÇÃO */
private function get_paginacao() {
  $_filter = $this->input->get();
  unset($_filter['pg']);
  unset($_filter['search']);

  /* DADOS PARA PAGINAÇÃO */
  $_dados_pag['table'] = $this->table_gridlist_name;

  if ($this->input->get('search', TRUE)):
                            $_dados_pag['search'] = array('_concat_fields' => 'nome,endereco', '_string' => $this->input->get('search', TRUE));
                        endif;

  $_dados_pag['filter'] = $_filter;
  $_dados_pag['order_by'] = 'nome ASC';
  $_dados_pag['programa'] = $this->router->fetch_class();
  
  /* QUANTIDADE DE LINHAS PARA PAGINAÇÃO DOS DADOS*/
  if (isset($this->page['per_page'])){
      if ( $this->page['per_page'] > 0 ){
          $_dados_pag['per_page'] = $this->page['per_page'];
      }elseif( $this->page['per_page'] == 0 || !empty($this->page['per_page']) ){
          $_dados_pag['per_page'] = 0 ;
      }else{
          $_dados_pag['per_page'] = 10 ;
      }
  }else{
     $_dados_pag['per_page'] = 10 ; 
  }
  
  /* END QUANTIDADE DE LINHAS PARA PAGINAÇÃO DOS DADOS */

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
//$this->page['per_page']= 3 ;
}
/* END METODO PHP - fcn_onScriptInit */




                                                 /* VALIDAÇÃO POR CALLBACK DO CAMPO genero_id. */
                                                  public function validation_required_genero_id() {
                                                      if ($this->input->post('genero_id')) return true;
                                                      $this->form_validation->set_message('validation_required_genero_id', 'O campo <b>Gênero</b> é obrigatório.');
                                                      return false;
                                                  }
                                                  /* END VALIDAÇÃO POR CALLBACK DO CAMPO genero_id. */




}
/* END class Cadastrodeclientes */
