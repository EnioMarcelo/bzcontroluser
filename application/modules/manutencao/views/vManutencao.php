<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 09/08/2017, 10:28:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ADMIN <?= bz_remove_strip_tags_content(___BZ_TITULO_SISTEMA___); ?>| Manutenção</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="<?= base_url('assets'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?= base_url('assets'); ?>/font/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?= base_url('assets'); ?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?= base_url('assets'); ?>/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="<?= base_url('assets'); ?>/dist/js/html5shiv.min.js"></script>
            <script src="<?= base_url('assets'); ?>/dist/js/respond.min.js"></script>
        <![endif]-->

        <!-- Toaster CSS -->
        <link href="<?= base_url('assets'); ?>/css/jquery.toast.css" rel="stylesheet" type="text/css"/>

        <!-- BOOT BUZA -->
        <link href="<?= base_url('assets'); ?>/css/boot-buza.css" rel="stylesheet" type="text/css" />




        <!-- jQuery 2.1.4 -->
        <script src="<?= base_url('assets'); ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= base_url('assets'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?= base_url('assets'); ?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- Toaster Jquery -->
        <script src="<?= base_url('assets'); ?>/js/jquery.toast.js" type="text/javascript"></script>
        <!-- SweetAlert JS -->
        <script src="<?= base_url('assets'); ?>/js/jquery.sweetalert.min.js" type="text/javascript"></script>

    </head>


    <body class="login-page">
        <div class="text-center" style="margin: 7% auto;">
            <div class="login-logo">
                <a href="<?= site_url(); ?>"><b>Admin</b><?= ___BZ_TITULO_SISTEMA___; ?></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">



                <?= get_mensagem(); ?>


                <div class="row">

                    <div class="text-center" style="width: 100%">
                        <img style="margin: 0 auto !important" class="img-responsive" src="<?= base_url('assets'); ?>/img/em-manutencao.jpg" alt=""/>
                    </div>


                    <div class="row col-xs-offset-1 col-xs-10 col-sm-offset-4 col-sm-4 col-lg-offset-5 col-lg-2 col-md-offset-4 col-md-4">
                        <a href="<?= site_url(); ?>" class="col-md-6 btn btn-instagram btn-block btn-flat"><i class="fa fa-reply margin-right-5" aria-hidden="true"></i>Voltar</a>                     
                    </div>

                </div>







            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->


    </body>
</html>



<?php
$this->load->view($this->router->fetch_class() . '/ajax/ajax-js');
?>











