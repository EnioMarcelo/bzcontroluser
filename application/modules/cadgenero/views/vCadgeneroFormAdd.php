<?php
/*
  Created on : 07/10/2019, 11:35AM
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
  			Novo
  		</small>
  	</h1>
  	<ol class="breadcrumb">
  		<li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  		<li class=""><a href="<?= site_url($this->router->fetch_class()); ?>" class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
  		<li class="active"><i class="fa fa-plus margin-right-5"></i>Novo <?= $_titulo_app; ?></li>
  	</ol>
  </section>
  <!-- END BREADCUMBS -->




  <!-- MENSAGENS -->
  <div class="message-toastr"></div>
  <?= get_mensagem(); ?>
  <!--END MENSAGENS -->




  <!-- OPEN FORM -->
  <?= form_open(site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()), 'id="IdFormADD_'.$this->router->fetch_class().'" name="formADD_'.$this->router->fetch_class().'" role="form" ' ); ?>

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

  						<button type="submit" id="btn-salvar" class="btn btn-sm btn-primary btn-show-modal-aguarde" name="btn-salvar" value="btn-salvar">
  							<span class="fa fa-save margin-right-5" aria-hidden="true"></span> Salvar
  						</button>
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

            
                                            <?php $_error = form_error("id", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                            <div id="id" class="form-group has-feedback col-sm-12">
                                                <label for="id">id</label>
                                                <input type="number" name="id" class="form-control" placeholder="" value="<?=set_value("id",isset($dados->id) ? $dados->id : set_value("id"));?>" pattern="[0-9]" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 0 " autofocus  />
                                                <?= $_error; ?>
                                            </div>
                                            

                                            <?php $_error = form_error("genero", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                            <div id="genero" class="form-group has-feedback col-sm-12">
                                                <label for="genero">genero</label>
                                                <input type="text" name="genero" class="form-control   " placeholder=""  value="<?=set_value("genero",!empty($dados->genero) ? $dados->genero : set_value("genero"));?>" />
                                                <?= $_error; ?>
                                            </div>
                                            

                                            <?php $_error = form_error("created", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                            <div id="created" class="form-group has-feedback col-sm-12">
                                                <label for="created">created</label>
                                                <input type="text" name="created" class="form-control datetimepicker j-mask-datahora-ptbr j-mask-created" placeholder="" value="<?=set_value("created",isset($dados->created) ? bz_formatdata($dados->created,"d/m/Y H:i:s") : set_value("created"));?>"  />
                                                <?= $_error; ?>
                                            </div>
                                            

                                            <?php $_error = form_error("user_created", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                            <div id="user_created" class="form-group has-feedback col-sm-12">
                                                <label for="user_created">user_created</label>
                                                <input type="text" name="user_created" class="form-control   " placeholder=""  value="<?=set_value("user_created",!empty($dados->user_created) ? $dados->user_created : set_value("user_created"));?>" />
                                                <?= $_error; ?>
                                            </div>
                                            

                                            <?php $_error = form_error("updated", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                            <div id="updated" class="form-group has-feedback col-sm-12">
                                                <label for="updated">updated</label>
                                                <input type="text" name="updated" class="form-control datetimepicker j-mask-datahora-ptbr j-mask-updated" placeholder="" value="<?=set_value("updated",isset($dados->updated) ? bz_formatdata($dados->updated,"d/m/Y H:i:s") : set_value("updated"));?>"  />
                                                <?= $_error; ?>
                                            </div>
                                            

                                            <?php $_error = form_error("user_updated", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                            <div id="user_updated" class="form-group has-feedback col-sm-12">
                                                <label for="user_updated">user_updated</label>
                                                <input type="text" name="user_updated" class="form-control   " placeholder=""  value="<?=set_value("user_updated",!empty($dados->user_updated) ? $dados->user_updated : set_value("user_updated"));?>" />
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
  if( !empty($modalFormAdd) ){
      echo $modalFormAdd;
  }
  ?>
  <!--END MODAL mc_modal() FORM ADD-->
  
  
  

  

  

  <!--
 * JQUERY MASK
-->
<script>

$(function(){

$(".j-mask-created").mask("00/00/0000 00:00", {placeholder: "__/__/____ __:__"});
$(".j-mask-updated").mask("00/00/0000 00:00", {placeholder: "__/__/____ __:__"});

});

</script>
<!--
 * END JQUERY MASK
-->






