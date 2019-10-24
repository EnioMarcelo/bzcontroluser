<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 03/08/2017, 10:01:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ADMIN <?= bz_remove_strip_tags_content(___CONF_TITULO_SISTEMA___); ?>| Esqueci minha senha</title>
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
        <!-- SweetAlert JS -->
        <script src="<?= base_url('assets'); ?>/js/jquery.sweetalert.min.js" type="text/javascript"></script>
        <!-- Stick de Mensagens - NICE - http://demo.hackandphp.com/jquery-nice-notify-notification-messages/ -->
        <link href="<?= base_url('assets'); ?>/css/jquery.nice.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet" type="text/css"/>
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
        <!-- SweetAlert JS -->
        <script src="<?= base_url('assets'); ?>/js/jquery.sweetalert.min.js" type="text/javascript"></script>
        <!-- NICE MENSAGENS-->
        <script src="<?= base_url('assets'); ?>/js/jquery.nice.js" type="text/javascript"></script>

        <!-- Common JS -->
        <script src="<?= base_url('assets'); ?>/js/common-js.js" type="text/javascript"></script>


    </head>


    <body class="login-page" <?= (___CONF_LOGIN_CHANGE_PASS_BG_IMAGE___) ? ___CONF_LOGIN_CHANGE_PASS_BG_IMAGE___ : ''; ?>>
        <div class="login-box">

            <div class="login-logo">

                <!-- LOGO -->
                <?php if (___CONF_LOGIN_CHANGE_PASS_LOGO___): ?>
                    <div class="login-logo-img">
                        <?= ___CONF_LOGIN_CHANGE_PASS_LOGO___; ?>
                    </div>
                <?php else: ?>
                    <a href="<?= site_url(); ?>"><b>Admin</b><?= ___CONF_TITULO_SISTEMA___; ?></a>
                <?php endif; ?>
                <!-- LOGO -->

            </div><!-- /.login-logo -->

            <div class="login-box-body">
                <p class="login-box-msg">Digite seu e-mail para receber a nova senha.</p>


                <?= get_mensagem(); ?>

                <?= form_open('', ' role="form" autocomplete="off" '); ?>

                <?php $_error = form_error("email", "<small class='text-danger'>", "</small>"); ?>
                <div class="form-group has-feedback <?= $_error ? 'has-error' : ''; ?>">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>" maxlength="250" autofocus/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <?= $_error; ?>
                </div>


                <?php $_error = form_error("captcha", "<small class='text-danger'>", "</small>"); ?>
                <div class="form-group has-feedback <?= $_error ? 'has-error' : ''; ?>">
                    <input type="text" name="captcha" class="form-control" placeholder="Digite o Código" value="" maxlength="20" autocomplete="off"/>
                    <span class="glyphicon glyphicon-retweet form-control-feedback"></span>
                    <?= $_error; ?>
                </div>

                <div class="form-group has-feedback">
                    <div style="margin-top: 10px;" class="text-center"><?= $captcha['image']; ?></div>
                </div>


                <div class="row margin-top-30 hidden-xs hidden-sm">
                    <div class="col-md-6 margin-bottom-10">
                        <a href="<?= site_url(); ?>" class="col-md-6 btn btn-default btn-block btn-flat"><i class="fa fa-sign-in margin-right-5" aria-hidden="true"></i>Login</a>
                    </div><!-- /.col -->
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat btn-show-modal-aguarde"><i class="fa fa-lightbulb-o margin-right-5" aria-hidden="true"></i>Enviar Nova Senha</button>
                    </div><!-- /.col -->
                </div>

                <div class="row margin-top-30 hidden-md hidden-lg">
                    <div class="col-md-6 margin-bottom-10">
                        <button type="submit" class="btn btn-primary btn-block btn-flat btn-show-modal-aguarde"><i class="fa fa-lightbulb-o margin-right-5" aria-hidden="true"></i>Enviar Nova Senha</button>
                    </div><!-- /.col -->
                    <div class="col-md-6">
                        <a href="<?= site_url(); ?>" class="col-md-6 btn btn-default btn-block btn-flat"><i class="fa fa-sign-in margin-right-5" aria-hidden="true"></i>Login</a>
                    </div><!-- /.col -->
                </div>

                <?= form_close(); ?>


            </div><!-- /.login-box-body -->



            <!-- FOOTER -->
            <?php if (___CONF_LOGIN_CHANGE_PASS_FOOTER___): ?>
                <div class="login-footer">
                    <?= ___CONF_LOGIN_CHANGE_PASS_FOOTER___; ?>
                </div><!-- /.login-footer -->
            <?php endif; ?>                
            <!-- FOOTER -->

        </div><!-- /.login-box -->



    </body>
</html>


<!-- MODAL AGUARDE -->
<!--<div id="modal-aguarde" class="bz-aguarde-modal">
    <div class="bz-aguarde-modal-dialog">
        <div class="bz-aguarde-modal-content">

            <div class="bz-aguarde-modal-body">
                <p class="text-center">Aguarde</p>
                <p class="text-center"><img src="<?= base_url('assets'); ?>/img/Facebook.gif" width="50px" style="margin-top: -20px;"></p>
            </div>

        </div> /.bz-aguarde-modal-content 
    </div> /.bz-aguarde-modal-dialog 
</div> /.bz-aguarde-modal -->
<!-- END MODAL AGUARDE -->


<?php
$this->load->view($this->router->fetch_class() . '/js/ajax-js');
?>