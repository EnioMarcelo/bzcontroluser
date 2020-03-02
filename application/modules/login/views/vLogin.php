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
    <meta http-equiv="refresh" content="<?= ($_sess_expiration - 5); ?>">


    <title>ADMIN <?= bz_remove_strip_tags_content($this->config->item('config_system')['CONF_TITULO_SISTEMA']); ?>| Log
        in</title>
    <?= $this->config->item('config_system')['CONF_ICON']; ?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?= base_url('assets'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="<?= base_url('assets'); ?>/font/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="<?= base_url('assets'); ?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <!-- iCheck -->
    <link href="<?= base_url('assets'); ?>/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css"/>

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
    <!-- Stick de Mensagens - NICE - http://demo.hackandphp.com/jquery-nice-notify-notification-messages/ -->
    <link href="<?= base_url('assets'); ?>/css/jquery.nice.css<?= '?' . date('YmdHis'); ?>" rel="stylesheet"
          type="text/css"/>
    <!-- CUSTOM MASTERPAGE -->
    <link href="<?= base_url('assets'); ?>/css/custom-masterpage.css" rel="stylesheet" type="text/css"/>
    <!-- BOOT BUZA -->
    <link href="<?= base_url('assets'); ?>/css/boot-buza.css" rel="stylesheet" type="text/css"/>


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
    <!-- NICE MENSAGENS-->
    <script src="<?= base_url('assets'); ?>/js/jquery.nice.js" type="text/javascript"></script>


</head>


<body class="login-page" <?= ($this->config->item('config_system')['CONF_LOGIN_BG_IMAGE']) ? $this->config->item('config_system')['CONF_LOGIN_BG_IMAGE'] : ''; ?> >
<div class="login-box">

    <div class="login-logo">

        <!-- LOGO -->
        <?php if ($this->config->item('config_system')['CONF_LOGIN_LOGO']): ?>
            <div class="login-logo-img">
                <?= $this->config->item('config_system')['CONF_LOGIN_LOGO']; ?>
            </div>
        <?php else: ?>
            <a href="<?= site_url(); ?>"><b>Admin</b><?= $this->config->item('config_system')['CONF_TITULO_SISTEMA']; ?>
            </a>
        <?php endif; ?>
        <!-- LOGO -->

    </div><!-- /.login-logo -->

    <div class="login-box-body">
        <p class="login-box-msg">Faça login para iniciar sua sessão</p>


        <?= get_mensagem(); ?>

        <?= form_open('', ' role="form" autocomplete="off" '); ?>

        <?php $_error = form_error("email", "<small class='text-danger'>", "</small>"); ?>
        <div class="form-group has-feedback <?= $_error ? 'has-error' : ''; ?>">
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>"
                   maxlength="250" autofocus/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <?= $_error; ?>
        </div>

        <?php $_error = form_error("senha", "<small class='text-danger'>", "</small>"); ?>

        <div class="form-group has-feedback <?= $_error ? 'has-error' : ''; ?>">
            <div id="" class=""></div>
            <input type="password" name="senha" class="form-control" placeholder="Senha"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <?= $_error; ?>
        </div>


        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in margin-right-5"
                                                                                    aria-hidden="true"></i>Logar
                </button>
            </div><!-- /.col -->
        </div>
        <?= form_close(); ?>


        <div class="margin-top-10">
            <?= anchor('changepass', 'Esqueci minha senha.'); ?><br/>
        </div>

    </div><!-- /.login-box-body -->


    <!-- FOOTER -->
    <?php if ($this->config->item('config_system')['CONF_LOGIN_FOOTER']): ?>
        <div class="login-footer">
            <?= $this->config->item('config_system')['CONF_LOGIN_FOOTER']; ?>
        </div><!-- /.login-footer -->
    <?php endif; ?>
    <!-- FOOTER -->

</div><!-- /.login-box -->

</body>
</html>


<?php
$this->load->view($this->router->fetch_class() . '/js/ajax-js');
?>
