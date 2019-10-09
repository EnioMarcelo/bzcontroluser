<?php

/*
  Created on : 08/10/2019, 18:06PM
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


  defined('BASEPATH') OR exit('No direct script access allowed');

  class Cadcliente extends MY_Controller {
    
    /* EXPORT REPORT*/
    protected $_exportReport = false;

    /* function  __construct() */
  	public function __construct() {
  		parent::__construct();

      /* LOAD MODEL */
      $this->load->model('Cadcliente_model', 'm', TRUE);


      /* TÍTULO DA APLICAÇÃO */
      $this->dados['_titulo_app'] = 'Cadastro de Clientes';
      $this->dados['_font_icon'] = 'fa fa-adjust';

      /* VIEW DA APLICAÇÃO */
      $this->dados['_view_app_list'] = 'vCadcliente';
      $this->dados['_view_app_add'] = 'vCadclienteFormAdd';
      $this->dados['_view_app_edit'] = 'vCadclienteFormEdit';

      /* TABELA QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
      $this->table_gridlist_name = 'cad_cliente';
      $this->table_formaddedit_name = 'cad_cliente';

      /* EXPORT REPORT */
$this->_exportReport = true;



    }
    /* END function __construct() */



    /* function index() */
    public function index() {

      /* CARREGA OS REGISTROS COM PAGINAÇÃO */
      $this->dados['_result'] = $this->get_paginacao();
      
      /* EXPORT REPORT */
      $this->dados['_exportReport'] = $this->_exportReport;

      
      /* TEMPLATE QUE SERÁ USADO PELO MÓDULO DO SISTEMA */
      $this->dados['_conteudo_masterPageIframe'] = $this->router->fetch_class() . '/' . $this->dados['_view_app_list'];
      $this->load->view('vMasterPageIframe', $this->dados);

    }
    /* END function index() */



    /* function add() */
    public function add(){

      if ($this->input->post() && $this->input->post('btn-salvar') == 'btn-salvar'):


        /* VALIDAÇÃO DOS DADOS */
        $this->form_validation->set_rules('nome', '<b>Nome</b>', 'trim|strtoupper|max_length[255]|required');
$this->form_validation->set_rules('arquivo_nome', '<b>Arquivo</b>', 'trim|callback_validation_upload_images_arquivo_nome');

        /* END VALIDAÇÃO DOS DADOS */

        

        if ($this->form_validation->run() == true ):

          $_dados = $this->input->post();

          unset($_dados['btn-salvar']);
          
          /* CONVERTE DADOS PARA GRAVAR NA TABELA */
if( !empty($this->task['result_upload']['file_name']) ):
     $_dados['arquivo_nome'] = $this->task['result_upload']['file_name'];
endif;
/* CONVERTE DADOS PARA GRAVAR NA TABELA */


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

            set_mensagem_nice('',___MSG_ADD_REGISTRO___, 'success','br');

            

          else:
            echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_formaddedit_name);
            exit;
          endif;


        redirect($this->_redirect . '/add');

        /* END GRAVA REGISTRO */
                
      else:
            set_mensagem_nice('', ___MSG_ERROR_CAMPOS_OBRIGATORIOS___, 'error', 'br');
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
      $this->form_validation->set_rules('nome', '<b>Nome</b>', 'trim|strtoupper|max_length[255]|required');
$this->form_validation->set_rules('arquivo_nome', '<b>Arquivo</b>', 'trim|callback_validation_upload_images_arquivo_nome');

      /* END VALIDAÇÃO DOS DADOS */

      

      if ($this->form_validation->run() == true ):

         $_dados = $this->input->post();

         unset($_dados['btn-editar']);
         /**

 * DELETA IMAGEM
 */
if (isset($this->task['uploaded_image']) && $this->task['uploaded_image']) {
     $_file_name = mc_findByIdDataDB($this->table_formaddedit_name, $_id)->row()->arquivo_nome;
     bz_delete_file($_file_name, bz_absolute_path(___CONF_APP_RELATIVE_PATH___) . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___);
}
/* END DELETA IMAGEM */
         
         /* CONVERTE DADOS PARA GRAVAR NA TABELA */
if( !empty($this->task['result_upload']['file_name']) ):
     $_dados['arquivo_nome'] = $this->task['result_upload']['file_name'];
endif;
/* CONVERTE DADOS PARA GRAVAR NA TABELA */


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

          set_mensagem_nice('',___MSG_UPDATE_REGISTRO___, 'success');

          

      else:
          echo 'Erro ao inserir Dados... SQL: ' . $this->db->set($dados)->get_compiled_insert($this->table_formaddedit_name);
          exit;
      endif;
      /* END UPDATE REGISTRO */
  else:
      set_mensagem_nice('', ___MSG_ERROR_CAMPOS_OBRIGATORIOS___, 'error', 'br');
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
    set_mensagem_nice('',___MSG_ERROR_SELECT_UPDATE_REGISTRO___, 'error');
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

  /**
 * DELETA IMAGEM
 */
foreach ($_dados as $_value):
     $_file_name = mc_findByIdDataDB($this->table_formaddedit_name, $_value)->row()->arquivo_nome;
     bz_delete_file($_file_name, bz_absolute_path(___CONF_APP_RELATIVE_PATH___) . ___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___);
endforeach;
/* END DELETA IMAGEM */
  
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
      set_mensagem_nice('',str_replace('Registro Deletado', 'Registros Deletados', ___MSG_DEL_REGISTRO___), 'success');
      $dados_auditoria['description'] = str_replace('Registro Deletado', 'Registros Deletados', ___MSG_AUDITORIA_DEL_SUCCESS___);
    else:
      set_mensagem_nice('',___MSG_DEL_REGISTRO___, 'success');
      $dados_auditoria['description'] = ___MSG_AUDITORIA_DEL_SUCCESS___;
    endif;

    /* GRAVA AUDITORIA */
    $dados_auditoria['creator'] = 'user';
    $dados_auditoria['action'] = 'del';
    $dados_auditoria['last_query'] = $this->db->last_query();
    add_auditoria($dados_auditoria);

    

  else:
    set_mensagem_nice('',___MSG_ERROR_DEL_REGISTRO___, 'error');
  endif;

else:
  set_mensagem_notfit('',___MSG_ERROR_DE_VALIDACAO___, 'error');
endif;

exit;
}
/* END function del() */


/* function export() - Print Report */
    public function export() {
        
    if( !$this->_exportReport ){
        redirect($this->_redirect_parametros_url);
    }
            
    
        
    /* CARREGA O HELPER */
    /* $this->load->helper('printtopdf'); */
    
    /* VARIABLES */
    $this->export['_loadHtml'] = '';

        
    /* QUANTIDADE DE LINHAS NO PDF - ZERO = TODAS OS REGISTROS DA TABELA */    
    $this->page['per_page'] = 0;
    
    
        
    /* CARREGA OS REGISTROS COM PAGINAÇÃO */
    $this->export['_dados'] = $this->get_paginacao();
    
    
    
    
    
    /* GERA O RELATÓRIO PARA SER EXPORTADO */
    
    $this->export['_loadHtml'] .= '<html>' . PHP_EOL;
    $this->export['_loadHtml'] .= '  <head>' . PHP_EOL;
    $this->export['_loadHtml'] .= '      <meta charset="UTF-8">' . PHP_EOL;
    $this->export['_loadHtml'] .= "      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>" . PHP_EOL;
    $this->export['_loadHtml'] .= "      <!-- Bootstrap 3.3.4 -->" . PHP_EOL;
    $this->export['_loadHtml'] .= '      <link href="'.site_url().'/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />' . PHP_EOL;
    $this->export['_loadHtml'] .= '      <!-- Font Awesome Icons -->' . PHP_EOL;
    $this->export['_loadHtml'] .= '      <link href="'.site_url().'/assets/font/font-awesome.min.css" rel="stylesheet" type="text/css"/>' . PHP_EOL;
    $this->export['_loadHtml'] .= '      <!-- BOOT BUZA -->' . PHP_EOL;
    $this->export['_loadHtml'] .= '      <link href="'.base_url('assets').'/css/boot-buza.css" rel="stylesheet" type="text/css" />' . PHP_EOL;
    $this->export['_loadHtml'] .= '      <!-- CSS DEFAULT MASTER PAGE IFRAME -->' . PHP_EOL;
    $this->export['_loadHtml'] .= '      <link href="'.base_url('assets').'/css/custom-masterPageIframe.css" rel="stylesheet" type="text/css" />' . PHP_EOL;
    $this->export['_loadHtml'] .= '      <!-- Theme style -->';
    $this->export['_loadHtml'] .= '      <link href="'.base_url('assets').'/dist/css/AdminLTE.BZ.min.css" rel="stylesheet" type="text/css"/>';
    
    
    $this->export['_loadHtml'] .= '      <style>' . PHP_EOL;
    $this->export['_loadHtml'] .= '         table { border-collapse:unset; }' . PHP_EOL;
    $this->export['_loadHtml'] .= '         .table>thead>tr>td, .table>thead>tr>th{ font-size:14px; padding:1px; }' . PHP_EOL;
    $this->export['_loadHtml'] .= '         .table>tbody>tr>td, .table>tbody>tr>th{ font-size:12px; padding:1px; }' . PHP_EOL;
    $this->export['_loadHtml'] .= '         .table>tfoot>tr>td, .table>tfoot>tr>th{ font-size:12px; padding:1px; }' . PHP_EOL;
    $this->export['_loadHtml'] .= '         a, a:hover, a:visited, a:link, a:active{ color: black !important; text-decoration: none !important; }' . PHP_EOL;
    $this->export['_loadHtml'] .= '         .pointer {cursor: pointer;}' . PHP_EOL;
    $this->export['_loadHtml'] .= '      </style>' . PHP_EOL;
    $this->export['_loadHtml'] .= "  </head>" . PHP_EOL;
    $this->export['_loadHtml'] .= "  <body>" . PHP_EOL;
    
    $this->export['_loadHtml'] .= " <!-- TABLE -->" . PHP_EOL;
    $this->export['_loadHtml'] .= "<div id='exportreport' class='container'>" . PHP_EOL;
    $this->export['_loadHtml'] .= '<h3 class="pointer btn-show-modal-aguarde" style="margin-top:5; margin-botom:15px" title="Voltar">' . PHP_EOL;
    $this->export['_loadHtml'] .= "<i class='".$this->dados['_font_icon']."'></i>" . PHP_EOL;
    $this->export['_loadHtml'] .= '<spam style="margin-left:10px;">'.$this->dados["_titulo_app"].'</spam>' . PHP_EOL;
    $this->export['_loadHtml'] .= "</h3>" . PHP_EOL;
    
    
//    $this->export['_loadHtml'] .= "<a class='btn btn-sm btn-primary btn-show-modal-aguarde xmargin-left-15' name='btn-export' value='btn-export'>";
//    $this->export['_loadHtml'] .= "            <span class='glyphicon glyphicon-print'></span> Imprimir";
//    $this->export['_loadHtml'] .= "        </a>";
    
    
	$this->export['_loadHtml'] .= "	<table class='table table-striped'>" . PHP_EOL;
	$this->export['_loadHtml'] .= "     <!-- HEADER DA TABLE -->" . PHP_EOL;
	$this->export['_loadHtml'] .= "     <thead class='bg-black'" . PHP_EOL;
	$this->export['_loadHtml'] .= "         <tr id='IdTableGridListTheadTr'>" . PHP_EOL;
	$this->export['_loadHtml'] .= "             <th class='text-center' style='width:3%;'>#</th>" . PHP_EOL;
	$this->export['_loadHtml'] .= '             <th class="thClNome" class="text-left" style="text-align:left; text-align:left">Nome</th>
<th class="thClArquivo_nome" class="text-center" style="width:10%; text-align:centerwidth:10%; text-align:center">Arquivo</th>
' . PHP_EOL;
	$this->export['_loadHtml'] .= "			</tr>" . PHP_EOL;
	$this->export['_loadHtml'] .= "		</thead>" . PHP_EOL;
	$this->export['_loadHtml'] .= "     <!-- END HEADER DA TABLE -->" . PHP_EOL;
    
    $this->export['_loadHtml'] .= "     <!-- ON RECORD EXPORT TABLE -->" . PHP_EOL;
	$this->export['_loadHtml'] .= "     <tbody>" . PHP_EOL;
        
        /* ON RECORD EXPORT */
        $_c = 0; 
        $_class_tr = ''; 
        $_style_tr = '';

        foreach ($this->export['_dados']['results_paginacao_array'] as $_key => $_row):

            $_c++;
        
            

            $this->export['_loadHtml'] .= "<tr class='".$_class_tr."' style='font-size:12px;line-height: 0.6em; ".$_style_tr."'>" . PHP_EOL;
            
            $this->export['_loadHtml'] .= "    <td class='text-center'  >".$_c."</td>" . PHP_EOL;

            $this->export['_loadHtml'] .= "    <!-- CAMPOS DA TABLE -->" . PHP_EOL;
            $this->export['_loadHtml'] .= '     <td class="tdClNome" class="text-left" style="text-align:left; text-align:left">'.$_row["nome"].'</td>
<td class="tdClArquivo_nome" class="text-center" style="width:10%; text-align:centerwidth:10%; text-align:center">'.$_row["arquivo_nome"].'</td>
' . PHP_EOL;
            $this->export['_loadHtml'] .= "    <!-- CAMPOS DA TABLE -->" . PHP_EOL;

            $this->export['_loadHtml'] .= "</tr>" . PHP_EOL;

        endforeach;
        /* END ON RECORD EXPORT */
    
    
    $this->export['_loadHtml'] .= "     </tbody>" . PHP_EOL;
    $this->export['_loadHtml'] .= "     <!-- ON RECORD EXPORT DADOS DA TABLE -->" . PHP_EOL;
    $this->export['_loadHtml'] .= " </table>" . PHP_EOL;
    $this->export['_loadHtml'] .= " <!-- END TABLE -->" . PHP_EOL;
    
    $this->export['_loadHtml'] .= "</div>" . PHP_EOL;
    
    $this->export['_loadHtml'] .= '<!-- MODAL AGUARDE -->';
    $this->export['_loadHtml'] .= '<div id="modal-aguarde" class="bz-aguarde-modal">';
    $this->export['_loadHtml'] .= '    <div class="bz-aguarde-modal-dialog">';
    $this->export['_loadHtml'] .= '        <div class="bz-aguarde-modal-content">';
    $this->export['_loadHtml'] .= '            <div class="bz-aguarde-modal-body">';
    $this->export['_loadHtml'] .= '                <p class="text-center">Aguarde</p>';
    $this->export['_loadHtml'] .= '                <p class="text-center"><img src="'.base_url("assets").'/img/Facebook.gif" width="50px" style="margin-top: -20px;"></p>';
    $this->export['_loadHtml'] .= '            </div>';
    $this->export['_loadHtml'] .= '        </div><!-- /.bz-aguarde-modal-content -->';
    $this->export['_loadHtml'] .= '    </div><!-- /.bz-aguarde-modal-dialog -->';
    $this->export['_loadHtml'] .= '</div><!-- /.bz-aguarde-modal -->';
    $this->export['_loadHtml'] .= '<!-- END MODAL AGUARDE -->';
            
    $this->export['_loadHtml'] .= '</body>' . PHP_EOL;
    $this->export['_loadHtml'] .= '</html>' . PHP_EOL;
    
    /* JQUERY */ 
    $this->export['_loadHtml'] .= '<!-- jQuery 2.1.4 -->' . PHP_EOL;
    $this->export['_loadHtml'] .= '<script src="' . site_url() . 'assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>' . PHP_EOL;
    
    $this->export['_loadHtml'] .= '<!-- Bootstrap 3.3.2 JS -->';
    $this->export['_loadHtml'] .= '<script src="'.base_url("assets").'/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>';
    
    $this->export['_loadHtml'] .= '<script>' . PHP_EOL;
    /* IMPRIME A PÁGINA */
    //$this->export['_loadHtml'] .= 'window.print();' . PHP_EOL;
    

    /* VOLTAR PÁGINA */
    $this->export['_loadHtml'] .= '$(function(){'
            . '$( "h3" ).on( "click", function() {'
            . '     window.location.replace("' . $this->_redirect_parametros_url . '");'
            . '});'
            . "	$('.btn-show-modal-aguarde').on('click', function (event) {"
            . "		$('#modal-aguarde').modal({"
            . "			backdrop: 'static',"
            . "         keyboard: false,"
            . "         show: true,"
            . "     });"
            . " });"
            . 'window.print();'
            . '});' . PHP_EOL;

    $this->export['_loadHtml'] .= '</script>' . PHP_EOL;
    
    
    
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
                            $_dados_pag['search'] = array('_concat_fields' => 'nome,arquivo_nome', '_string' => $this->input->get('search', TRUE));
                        endif;

  $_dados_pag['filter'] = $_filter;
  $_dados_pag['order_by'] = 'nome';
  $_dados_pag['programa'] = $this->router->fetch_class();
        
  /* WHERE GLOBAL DO CONTROLLER PAI - MY_CONTROLLER */
  if( !empty($this->where) ){
      $_dados_pag['where'] = $this->where;
  }

  if( !empty($this->or_where) ){
      $_dados_pag['or_where'] = $this->or_where;
  }
  /* END WHERE GLOBAL DO CONTROLLER PAI - MY_CONTROLLER */
  
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





                                                 /* VALIDAÇÃO POR CALLBACK UPLOAD DE IMAGENS arquivo_nome. */
                                                  public function validation_upload_images_arquivo_nome() {
                                                      
                                                        if (empty($_FILES['arquivo_nome']['name']) && !empty($this->input->post('arquivo_nome')) ) {
                                                            return true;
                                                        }

                                                        if (empty($_FILES['arquivo_nome']['name'])) {
                                                            $this->form_validation->set_message('validation_upload_images_arquivo_nome', 'Nenhuma imagem selecionada para ser enviada.');
                                                            return false;
                                                        }
                                                        
                                                        if (strpos($_FILES['arquivo_nome']['type'], 'image/') !== 0) {
                                                            $this->form_validation->set_message('validation_upload_images_arquivo_nome', 'Este arquivo não é um arquivo de imagem.');
                                                            return false;
                                                        }

                                                        $this->task['result_upload'] = bz_upload_file('arquivo_nome', ___CONF_UPLOAD_IMAGE_DIR___, 'jpg|jpeg|gif|png', '2048', '0', '0');

                                                        if (isset($this->task['result_upload']['error'])) {
                                                            $this->form_validation->set_message('validation_upload_images_arquivo_nome', $this->task['result_upload']['error']['message']);
                                                            return false;
                                                        }
                                                        
                                                        $this->task['uploaded_image'] = true;
                                                  }
                                                  /* END VALIDAÇÃO POR CALLBACK UPLOAD DE IMAGENS arquivo_nome. */




}
/* END class Cadcliente */
