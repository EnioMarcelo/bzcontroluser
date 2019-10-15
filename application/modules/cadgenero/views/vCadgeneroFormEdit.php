<?php
/*
  Created on : 09/10/2019, 15:06PM
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
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
  <?= form_open(site_url($this->router->fetch_class() . '/edit/'. $dados->id . '?' . bz_app_parametros_url()), 'id="IdFormEDIT_'.$this->router->fetch_class().'" name="formEDIT_'.$this->router->fetch_class().'" role="form" ' ); ?>

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

          
                                            <?php $_error = form_error("genero", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                            <div id="genero" class="form-group has-feedback col-sm-12">
                                                <label for="genero">Gênero</label>
                                                <input type="text" name="genero" class="form-control uppercase  " placeholder="" autofocus  value="<?=set_value("genero",!empty($dados->genero) ? $dados->genero : set_value("genero"));?>" />
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
  
  
  









