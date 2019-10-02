<?php
/*
  Created on : 02/10/2019, 14:36PM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */


  defined('BASEPATH') OR exit('No direct script access allowed');
  ?>

  <!-- BREADCUMBS -->
  <section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 23px;">
  	<h1>
  		<i class="<?= $_font_icon; ?>"></i>
  		<?= $_titulo_app; ?>
  		<small class=" ">
  			Edição
  		</small>
  	</h1>
  	<ol class="breadcrumb">
  		<li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  		<li class=""><a href="<?= site_url($this->router->fetch_class()); ?>" class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
  		<li class="active"><i class="fa fa-plus margin-right-5"></i>Edição <?= $_titulo_app; ?></li>
  	</ol>
  </section>
  <!-- END BREADCUMBS -->




  <!-- MENSAGENS -->
  <div class="message-toastr"></div>
  <?= get_mensagem(); ?>
  <!--END MENSAGENS -->




  <!-- OPEN FORM -->
  <?= form_open_multipart(site_url($this->router->fetch_class() . '/edit/'. $dados->id . '?' . bz_app_parametros_url()), 'id="IdFormEDIT_'.$this->router->fetch_class().'" name="formEDIT_'.$this->router->fetch_class().'" role="form" ' ); ?>

  <div class="row hide-reload-screen">

  	<div class="box">

  		<!-- HEADER BOTÕES-->
  		<div class="box-header">
  			<h3 class="box-title"></h3>
  			<div class="box-tools">

  				<div class="input-group margin-top-10">

  					<div class="input-group-btn text-right">

  						<a href="<?= $this->session->flashdata('btn_voltar_link'); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde margin-right-5">
  							<span class="fa fa-reply margin-right-5"></span> Voltar
  						</a>

  						<button type="submit" id="btn-editar" class="btn btn-sm btn-primary btn-show-modal-aguarde margin-right-5" name="btn-editar" value="btn-editar">
                <span class="fa fa-save margin-right-5" aria-hidden="true"></span> Salvar
              </button>


              <a href="<?= site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()); ?>" class="btn btn-sm btn-info btn-show-modal-aguarde" name="btn-edit" value="btn-edit">
                <span class="glyphicon glyphicon-plus"></span> Novo
              </a>
            </div>

          </div>

        </div>
      </div><!-- /.box-header -->
      <!-- END HEADER BOTÕES-->



      <div class="box-body no-padding padding-left-10 padding-right-10 margin-top-20">

       <div class="box box-primary">
        <div class="box-header">
        </div><!-- /.box-header -->

        <div class="box-body inputs">


          <div class="clearfix"></div>

          <!-- FORM FIELDS -->

          
                                                <?php $_error = form_error("nome", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                                <div id="nome" class="form-group has-feedback col-sm-12">
                                                    <label for="nome"><i class="fa fa-asterisk margin-right-5 text-error " style="font-size: 0.7em;"></i>Nome</label>
                                                    <input type="text" name="nome" class="form-control uppercase  " placeholder="" autofocus  value="<?=set_value("nome",!empty($dados->nome) ? $dados->nome : set_value("nome"));?>" />
                                                    <?= $_error; ?>
                                                </div>
                                                

                                                <?php $_error = form_error("profissao", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                                <div id="profissao" class="form-group has-feedback col-sm-12">
                                                    <label for="profissao"><i class="fa fa-asterisk margin-right-5 text-error " style="font-size: 0.7em;"></i>Profissão</label>
                                                    <p style="margin-bottom: 0">
<?php
$_results_profissao = $this->db->query("SELECT id,UPPER(profissao) FROM cad_profissao ORDER BY profissao");
$_last_query_profissao = strtolower($this->db->last_query());
$_options_profissao = $_results_profissao->result_array();
$_options_profissao = $_options_profissao[0];
$_keyOptions_profissao = array();
$_list_profissao[0] = 'Selecione...' ;
foreach ($_options_profissao as $key => $value_profissao):
$_keyOptions_profissao[] = $key;
endforeach;
foreach ($_results_profissao->result_array() as $_r_profissao):
$_list_profissao[ $_r_profissao[ $_keyOptions_profissao[0] ] ] = $_r_profissao[ $_keyOptions_profissao[1] ];
endforeach;
echo form_dropdown('profissao', $_list_profissao, set_value('profissao',isset($dados->profissao) ? $dados->profissao : set_value('profissao')), 'class="form-control select2"  style="width:100%;"');
?>
</p>

                                                    <?= $_error; ?>
                                                </div>
                                                

                                                <?php $_error = form_error("genero", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                                <div id="genero" class="form-group has-feedback col-sm-12">
                                                    <label for="genero"><i class="fa fa-asterisk margin-right-5 text-error " style="font-size: 0.7em;"></i>Gênero</label>
                                                    <p style="margin-bottom: 0">
<?php
$_results_genero = $this->db->query("SELECT id,genero FROM cad_genero ORDER BY genero");
$_last_query_genero = strtolower($this->db->last_query());
$_options_genero = $_results_genero->result_array();
$_options_genero = $_options_genero[0];
$_keyOptions_genero = array();
$_list_genero[0] = 'Selecione...' ;
foreach ($_options_genero as $key => $value_genero):
$_keyOptions_genero[] = $key;
endforeach;
foreach ($_results_genero->result_array() as $_r_genero):
$_list_genero[ $_r_genero[ $_keyOptions_genero[0] ] ] = $_r_genero[ $_keyOptions_genero[1] ];
endforeach;
echo form_dropdown('genero', $_list_genero, set_value('genero',isset($dados->genero) ? $dados->genero : set_value('genero')), 'class="form-control select2"  style="width:100%;"');
?>
</p>

                                                    <?= $_error; ?>
                                                </div>
                                                

                                                <?php $_error = form_error("imagem_nome", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                                <div id="imagem_nome" class="form-group has-feedback col-sm-12">
                                                    <label for="imagem_nome"><i class="fa fa-asterisk margin-right-5 text-error " style="font-size: 0.7em;"></i>Enviar Foto</label>
                                                    <input type="file" name="imagem_nome" class="form-control" placeholder="" value="<?=set_value("imagem_nome",isset($dados->imagem_nome) ? $dados->imagem_nome : set_value("imagem_nome"));?>"  />
<div class="btn-ver-imagem margin-top-5 margin-bottom-5" style="font-size: 0.8em"><i class="fa fa-fw fa-camera"></i> <?= anchor(___CONF_UPLOAD_DIR___ . "/" . ___CONF_UPLOAD_IMAGE_DIR___ . "/" . set_value("imagem_nome", isset($dados->imagem_nome) ? $dados->imagem_nome : set_value("imagem_nome")), "Ver Imagem", "data-lightbox='imagem_nome'"); ?></div>
                                                    <?= $_error; ?>
                                                </div>
                                                


          <!-- END FORM FIELDS -->

          <div class="clearfix"></div>


        </div><!--END INPUTS -->

      </div><!--END BOX PRIMARY -->

    </div><!--END BOX-BODY -->



    <!-- FOOTER -->
    <div class="text-right padding-bottom-15">
      <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i> Campos Obrigatórios</div>
    </div>
    <!-- END FOOTER -->



  </div><!--END BOX -->
    
    
</div><!--END ROW -->

<?= form_close(); ?>
<!--END  OPEN FORM -->


  
  
<!--MODAL mc_modal() FORM ADD-->
<?php
if( !empty($modalFormEdit) ){
  echo $modalFormEdit;
}
?>
<!--END MODAL mc_modal() FORM ADD-->
  
  
  









