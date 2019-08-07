<?php
/*
  Created on : 07/08/2019, 13:35PM
  Author     : Enio Marcelo - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- MENSAGEM DO SISTEM -->
<?= get_mensagem(); ?>
<!-- END MENSAGEM DO SISTEM -->

<!-- BREADCUMBS -->
<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 23px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class=""><a href="<?= site_url($this->router->fetch_class()); ?>" class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
    </ol>
</section>
<!-- END BREADCUMBS -->

<div class="row hide-reload-screen">

    <div class="box">

        <!-- HEADER BOTÕES-->
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools">

                <div class="input-group margin-top-10">

                    <div class="input-group-btn text-right"></div>

                </div>


                <!-- BTN FULL SCREEN -->
                <a class='btn btn-sm btn-flat j-btn-open-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Tela Cheia'><i class='fa fa-external-link'></i></a>
                <!-- BTN FULL SCREEN -->	

                <!-- BTN CLOSE FULL SCREEN -->
                <a style="display: none" class='btn btn-sm btn-flat j-btn-close-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Fechar Tela'><i class='fa fa-close'></i></a>
                <!-- BTN CLOSE FULL SCREEN -->	

            </div>
        </div><!-- /.box-header -->
        <!-- END HEADER BOTÕES-->


        <div class="box-body no-padding padding-left-10 padding-right-10 margin-top-20">

            <div class="box box-primary">
                <div class="box-header">
                </div><!-- /.box-header -->

                <div class="box-body inputs">

                    <div class="clearfix"></div>

                    <!-- BLANK CODE - blank -->
<script>

     $(function(){
     
          /*$('h1').css('color','green');*/
     
     });

</script>


<div class="jumbotron text-center">
       <h1>Entrou na INDEX</h1>
  <p>Resize this responsive page to see the effect!</p> 
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Column 1</h3>
      <p><?=$this->m->fcn_get_genero( ['genero'=>'MASCULINO'] );?></p>
    </div>
    <div class="col-sm-4">
      <h3>Column 2</h3>
      <p><?=$this->m->fcn_get_genero( ['genero'=>'FEMININO']) ;?></p>
    </div>
    <div class="col-sm-4">
      <h3>Column 3</h3> 
      <p><?=$this->m->fcn_get_genero( ['genero'=>'INDEFINIDO']) ;?></p>
    </div>
  </div>
</div>

<!-- END BLANK CODE - blank -->



                    <div class="clearfix"></div>

                </div><!--END INPUTS -->

            </div><!--END BOX PRIMARY -->

        </div><!--END BOX-BODY -->


        <!-- FOOTER -->
        <div class="text-right padding-bottom-15">
            <div class="text-center"></div>
        </div>
        <!-- END FOOTER -->



    </div><!--END BOX -->







