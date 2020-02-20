<?php
/*
  Created on : "{{created-date}}", "{{created-time}}"
  Author     : "{{author-name}}" - "{{author-email}}"
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
    <!--    <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class=""><a href="<?= site_url($this->router->fetch_class()); ?>" class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
        </ol>-->
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

            </div>
        </div><!-- /.box-header -->
        <!-- END HEADER BOTÕES-->


        <div class="box-body no-padding padding-left-10 padding-right-10 margin-top-20">

            <div class="box box-primary">
                <div class="box-header">
                </div><!-- /.box-header -->

                <div class="box-body inputs">

                    <div class="clearfix"></div>

                    "{{blank-code}}"

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







