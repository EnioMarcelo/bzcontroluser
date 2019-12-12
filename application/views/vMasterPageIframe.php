<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 01/08/2017, 11:32:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?= bz_remove_strip_tags_content($this->config->item('config_system')['CONF_TITULO_SISTEMA']); ?></title>
        <?= $this->config->item('config_system')['CONF_ICON']; ?>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- Bootstrap 3.3.4 -->
        <link href="<?= base_url('assets'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap ClockPicker -->
        <link href="<?= base_url('assets'); ?>/bootstrap/css/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Button Toggle -->
        <link href="<?= base_url('assets'); ?>/plugins/button-toggle/bootstrap-toggle.min.css" rel="stylesheet" type="text/css"/>
        <!--Select 2-->
        <link href="<?= base_url('assets'); ?>/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style iCheck-->
        <link href="<?= base_url('assets'); ?>/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Toaster CSS -->
        <link href="<?= base_url('assets'); ?>/css/jquery.toast.css" rel="stylesheet" type="text/css"/>
        <!-- Stick de Mensagens - NOTIFIT -->
        <link href="<?= base_url('assets'); ?>/css/notifIt.css" rel="stylesheet" type="text/css"/>
        <!-- Stick de Mensagens - NICE - http://demo.hackandphp.com/jquery-nice-notify-notification-messages/ -->
        <link href="<?= base_url('assets'); ?>/css/jquery.nice.css" rel="stylesheet" type="text/css"/>
        <!-- Stick de Mensagens trigger notify -->
        <link href="<?= base_url('assets'); ?>/css/trigger_notify.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome Icons -->
        <link href="<?= base_url('assets'); ?>/font/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Ionicons -->
        <link href="<?= base_url('assets'); ?>/dist/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!--Bootstrap DateTimepicker-->
        <!--<link href="<?= base_url('assets'); ?>/plugins/datepicker/datepicker2.css" rel="stylesheet" type="text/css"/>-->
        <link href="<?= base_url('assets'); ?>/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets'); ?>/plugins/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets'); ?>/plugins/timepicker/bootstrap-timepicker.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets'); ?>/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets'); ?>/plugins/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets'); ?>/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
        <!--Numbered Line TextArea-->
        <link href="<?= base_url('assets'); ?>/plugins/linedtextarea/jquery-linedtextarea.css" rel="stylesheet" type="text/css"/>
        <!--jQueryUI 1.12.1 CSS--> 
        <link href="<?= base_url('assets'); ?>/plugins/jQueryUI/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!--Lightbox Popup-->
        <!--https://lokeshdhakar.com/projects/lightbox2/#examples-->
        <link href="<?= base_url(); ?>/assets/plugins/lightbox/css/lightbox.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?= base_url('assets'); ?>/dist/css/AdminLTE.BZ.min.css" rel="stylesheet" type="text/css"/>
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="<?= base_url('assets'); ?>/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
        <!--bootstrap-wysihtml5-->
        <link href="<?= base_url('assets'); ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css"/>


        <?php
        /**
         * EXTERNAL CSS FILE
         */
        if (!empty($external_css)) {
            echo "<!-- EXTERNAL CSS FILE -->" . PHP_EOL;

            foreach ($external_css as $css):
                echo "<link rel='stylesheet' href='" . $css . '?' . date('YmdHis') . "' rel=\"stylesheet\" type=\"text/css\"/>" . PHP_EOL;
            endforeach;

            echo "<!-- END EXTERNAL CSS FILE -->" . PHP_EOL;
        }
        /* EXTERNAL CSS FILE */
        ?>


        <!-- BOOT BUZA -->
        <link href="<?= base_url('assets'); ?>/css/boot-buza.css" rel="stylesheet" type="text/css" />
        <!-- CSS DEFAULT MASTER PAGE IFRAME -->
        <link href="<?= base_url('assets'); ?>/css/custom-masterPageIframe.css" rel="stylesheet" type="text/css" />





        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="<?= base_url('assets'); ?>/dist/js/html5shiv.min.js"></script>
        <script src="<?= base_url('assets'); ?>/dist/js/respond.min.js"></script>
        <![endif]-->





        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="<?= base_url('assets'); ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery-UI 1.12.1 -->
        <script src="<?= base_url('assets'); ?>/plugins/jQueryUI/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?= base_url('assets'); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Bootstrap ClockPicker -->
        <script src="<?= base_url('assets'); ?>/bootstrap/js/bootstrap-clockpicker.min.js" type="text/javascript"></script>
        <!-- Bootstrap Button Toggle -->
        <!--bootstrap-wysihtml5-->
        <script src="<?= base_url('assets'); ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets'); ?>/plugins/button-toggle/bootstrap-toggle.min.js" type="text/javascript"></script>
        <!-- slimScroll -->
        <script src="<?= base_url('assets'); ?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?= base_url('assets'); ?>/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('assets'); ?>/dist/js/app.min.js" type="text/javascript"></script>
        <!-- Toaster jQuery -->
        <script src="<?= base_url('assets'); ?>/js/jquery.toast.js" type="text/javascript"></script>
        <!-- SweetAlert JS -->
        <script src="<?= base_url('assets'); ?>/js/jquery.sweetalert.min.js" type="text/javascript"></script>
        <!-- Stick de Mensagens - NOTIFIT -->
        <script src="<?= base_url('assets'); ?>/js/notifIt.js" type="text/javascript"></script>
        <!-- NOTIFIT MENSAGENS-->
        <script src="<?= base_url('assets'); ?>/js/notifit-mensagens.js" type="text/javascript"></script>
        <!-- NICE MENSAGENS-->
        <script src="<?= base_url('assets'); ?>/js/jquery.nice.js" type="text/javascript"></script>
        <!-- Stick de Mensagens trigger notify -->
        <script src="<?= base_url('assets'); ?>/js/Jquery.trigger_notify.js" type="text/javascript"></script>
        <!-- MD5 -->
        <script src="<?= base_url('assets'); ?>/js/jquery.md5.js" type="text/javascript"></script>
        <!-- BASE64 https://github.com/carlo/jquery-base64 -->
        <script src="<?= base_url('assets'); ?>/js/jquery.base64.min.js" type="text/javascript"></script>
        <!-- Select2 -->
        <script src="<?= base_url('assets'); ?>/plugins/select2/select2.full.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets'); ?>/plugins/select2/select2_lang_pt-br.js" type="text/javascript"></script>
        <!--Bootstrap DateTimePicker-->
        <script src="<?= base_url('assets'); ?>/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="<?= base_url('assets'); ?>/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js" type="text/javascript"></script>
        <script src="<?= base_url('assets'); ?>/plugins/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?= base_url('assets'); ?>/plugins/datetimepicker/bootstrap-datetimepicker.pt-BR.js" type="text/javascript"></script>
        <script src="<?= base_url('assets'); ?>/plugins/timepicker/bootstrap-timepicker.js" type="text/javascript"></script>
        <script src="<?= base_url('assets'); ?>/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="<?= base_url('assets'); ?>/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
        <!--jQueryMask-->
        <script src="<?= base_url('assets'); ?>/plugins/jQueryMask/jquery.mask.min.js" type="text/javascript"></script>
        <!--Numbered Line TextArea-->
        <script src="<?= base_url('assets'); ?>/plugins/linedtextarea/jquery-linedtextarea.js" type="text/javascript"></script>
        <!--Code Editor Textarea-->
        <script src="<?= base_url('assets'); ?>/plugins/editareafull/edit_area_full.js" type="text/javascript"></script>
        <!--Lightbox Popup-->
        <!--https://lokeshdhakar.com/projects/lightbox2/#examples-->
        <script src="<?= base_url(); ?>/assets/plugins/lightbox/js/lightbox.min.js" type="text/javascript"></script>
        <!--COPY TO CLIPBOARD - https://www.jqueryscript.net/text/jQuery-Plugin-To-Copy-Any-Text-Into-Your-Clipboard-Copy-to-Clipboard.html-->
        <script src="<?= base_url(); ?>/assets/js/jquery.copy-to-clipboard.js" type="text/javascript"></script>
        <!--CKEDITOR-->
        <script src="<?= base_url(); ?>/assets/plugins/ckeditorFull/ckeditor.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/plugins/ckeditorFull/config.js" type="text/javascript"></script>


        <?php
        /**
         * EXTERNAL JS FILE
         */
        if (!empty($external_js)) {
            echo "<!-- EXTERNAL JS FILE -->" . PHP_EOL;

            foreach ($external_js as $js):
                echo "<script src='" . $js . '?v=' . date('YmdHis') . "' type=\"text/javascript\"></script>" . PHP_EOL;
            endforeach;

            echo "<!-- END EXTERNAL JS FILE -->" . PHP_EOL;
        }
        /* EXTERNAL JS FILE */
        ?>


        <!--COMMON JS-->
        <script src="<?= base_url('assets'); ?>/js/common-js.js" type="text/javascript"></script>
        <!-- ROTINAS JQUERY/JAVASCRIPT -->
        <?php $this->load->view('js/common-js-MasterPageIframe'); ?>
        <!-- END ROTINAS JQUERY/JAVASCRIPT -->

    </head>




    <body class="skin-<?= ___BZ_LAYOUT_SKINCOLOR___; ?> sidebar-mini fixed" style="background-color: transparent;">


        <!-- Content Wrapper. Contains page content -->
        <div class="container-fluid">

            <!-- Main content -->


            <div class="clearfix"></div>

            <!-- CONTENT -->

            <?php
            if (!empty($_conteudo_masterPageIframe)):
                $this->load->view($_conteudo_masterPageIframe);
            endif;
            ?>

            <!-- END CONTENT -->

            <div class="clearfix"></div>

            <?php if (get_setting('time_render') == 'SIM'): ?>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="md-xs-12 pull-right">Página renderizada em <strong>{elapsed_time}</strong> segundos. </p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="clearfix"></div>


        </div><!-- /.content-wrapper -->

    </body>
</html>


<!-- MODAL CONFIRM -->
<div id="modal-confirm-delete" class="modal modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">ATENÇÃO</h4>
            </div>
            <div class="modal-body">
                <p>Deseja deletar este registro ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete-cancel" class="btn btn-outline pull-left btn-show-modal-aguarde" data-dismiss="modal">NÃO</button>
                <button type="button" id="delete-confirmed" class="btn btn-outline btn-show-modal-aguarde">SIM</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL CONFIRM -->


<!-- MODAL AGUARDE -->
<div id="modal-aguarde" class="bz-aguarde-modal">
    <div class="bz-aguarde-modal-dialog">
        <div class="bz-aguarde-modal-content">

            <div class="bz-aguarde-modal-body">
                <p class="text-center">Aguarde</p>
                <p class="text-center"><img src="<?= base_url('assets'); ?>/img/Facebook.gif" width="50px" style="margin-top: -20px;"></p>
            </div>

        </div><!-- /.bz-aguarde-modal-content -->
    </div><!-- /.bz-aguarde-modal-dialog -->
</div><!-- /.bz-aguarde-modal -->
<!-- END MODAL AGUARDE -->

