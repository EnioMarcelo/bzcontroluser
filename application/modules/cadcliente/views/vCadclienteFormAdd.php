<?php
/*
  Created on : 11/07/2019, 11:23AM
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

            
                                                <?php $_error = form_error("nome", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                                <div id="nome" class="form-group has-feedback col-sm-12">
                                                    <label for="nome"><i class="fa fa-asterisk margin-right-5 text-error " style="font-size: 0.7em;"></i>Nome</label>
                                                    <input type="text" name="nome" class="form-control uppercase  " placeholder="" autofocus  value="<?=set_value("nome",!empty($dados->nome) ? $dados->nome : set_value("nome"));?>" />
                                                    <?= $_error; ?>
                                                </div>
                                                

                                            <?php $_error = form_error("valor", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                            <div id="valor" class="form-group has-feedback col-sm-12">
                                                <label for="valor">Valor</label>
                                                <input type="text" name="valor" class="form-control j-mask-moeda-ptbr" placeholder="" value="<?=set_value("valor",isset($dados->valor) ? $dados->valor : set_value("valor"));?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 44 || event.charCode == 0 "  />
                                                <?= $_error; ?>
                                            </div>
                                            

                                                <?php $_error = form_error("data", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                                <div id="data" class="form-group has-feedback col-sm-2">
                                                    <label for="data"><i class="fa fa-asterisk margin-right-5 text-error " style="font-size: 0.7em;"></i>Data</label>
                                                    <input type="text" name="data" class="form-control datepicker j-mask-data-ptbr j-mask-data" placeholder="" value="<?=set_value("data",isset($dados->data) ? bz_formatdata($dados->data,"d/m/Y") : set_value("data"));?>"  />
                                                    <?= $_error; ?>
                                                </div>
                                                

                                                <?php $_error = form_error("data_hora", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                                <div id="data_hora" class="form-group has-feedback col-sm-2">
                                                    <label for="data_hora"><i class="fa fa-asterisk margin-right-5 text-error " style="font-size: 0.7em;"></i>Data/Hora</label>
                                                    <input type="text" name="data_hora" class="form-control datetimepicker j-mask-datahora-ptbr j-mask-data_hora" placeholder="" value="<?=set_value("data_hora",isset($dados->data_hora) ? bz_formatdata($dados->data_hora,"d/m/Y H:i:s") : set_value("data_hora"));?>"  />
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
    
    <!--MODAL bzModal() FORM ADD-->
    <?php
    if( !empty($_modalFormAdd) ){
        echo $_modalFormAdd;
    }
    ?>
    <!--END MODAL bzModal() FORM ADD-->

  </div><!--END ROW -->

  <?= form_close(); ?>
  <!--END  OPEN FORM -->


  

  

  <!--
 * JQUERY MASK
-->
<script>

$(function(){

$(".j-mask-data").mask("00/00/0000", {placeholder: "__/__/____"});
$(".j-mask-data_hora").mask("00/00/0000 00:00", {placeholder: "__/__/____ __:__"});

});

</script>
<!--
 * END JQUERY MASK
-->






