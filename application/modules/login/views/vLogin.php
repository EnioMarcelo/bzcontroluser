<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 02/08/2017, 15:09:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ADMIN <?= bz_remove_strip_tags_content(___BZ_TITULO_SISTEMA___); ?>| Log in</title>
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
        <!-- Stick de Mensagens - NOTIFIT -->
        <link href="<?= base_url('assets'); ?>/css/notifIt.css" rel="stylesheet" type="text/css"/>
        <!-- CUSTOM MASTERPAGE -->
        <link href="<?= base_url('assets'); ?>/css/custom-masterpage.css" rel="stylesheet" type="text/css" />
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
        <!-- Stick de Mensagens - NOTIFIT -->
        <script src="<?= base_url('assets'); ?>/js/notifIt.js" type="text/javascript"></script>
        <!-- NOTIFIT MENSAGENS-->
        <script src="<?= base_url('assets'); ?>/js/notifit-mensagens.js" type="text/javascript"></script>
        <!-- SweetAlert JS -->
        <script src="<?= base_url('assets'); ?>/js/jquery.sweetalert.min.js" type="text/javascript"></script>


    </head>


    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?= site_url(); ?>"><b>Admin</b><?= ___BZ_TITULO_SISTEMA___; ?></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Faça login para iniciar sua sessão</p>


                <?= get_mensagem(); ?>

                <?= form_open('', 'role="form"'); ?>

                <?php $_error = form_error("email", "<small class='text-danger'>", "</small>"); ?>
                <div class="form-group has-feedback <?= $_error ? 'has-error' : ''; ?>">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>" maxlength="250" autofocus/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <?= $_error; ?>
                </div>

                <?php $_error = form_error("senha", "<small class='text-danger'>", "</small>"); ?>

                <div class="form-group has-feedback <?= $_error ? 'has-error' : ''; ?>">
                    <div id="" class=""></div>
                    <input type="password" name="senha" class="form-control" placeholder="Senha" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <?= $_error; ?>
                </div>


                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in margin-right-5" aria-hidden="true"></i>Logar</button>
                    </div><!-- /.col -->
                </div>
                <?= form_close(); ?></form></form>



                <div class="margin-top-10">
                    <a href="<?= site_url('changepass'); ?>">Esqueci minha senha.</a><br>
                </div>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
        
    </body>
</html>



<?php
$this->load->view($this->router->fetch_class() . '/ajax/ajax-js');
?>









