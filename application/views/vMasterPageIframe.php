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
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- Bootstrap 3.3.4 -->
        <link href="<?= base_url('assets'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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


<!-- MODAL GERANDO ARQUIVO -->
<div id="modal-gerando-arquivo" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalGerandoArquivoLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content no-border border-shadow" >
            <div class="modal-body">
                <div id="carregando" class="text-center">
                    <img style="" src='data:image/gif;base64,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cCYlAuypFCMCUBbQAEJGYyWaABiaCqAHOJAiLQdkUgB2cQ3ywJ65eEmPOZbOuIAADeA5iD6lmPnLOSgKYikAe6qiJD1EVhIkn7g+1Mqtu7Ko6SlMPgIpMSVdScqtiT60iamUBpMoRbsWMMitbi4TZK8CPlQYt79qK8iU0o1KDzDcRruqdIrAuu2inHAI718DkHjvvvz220ggADsAAAAAAAAAAAA8YnIgLz4KPGI+V2FybmluZzwvYj46ICBteXNxbF9xdWVyeSgpIFs8YSBocmVmPSdmdW5jdGlvbi5teXNxbC1xdWVyeSc+ZnVuY3Rpb24ubXlzcWwtcXVlcnk8L2E+XTogQ2FuJ3QgY29ubmVjdCB0byBsb2NhbCBNeVNRTCBzZXJ2ZXIgdGhyb3VnaCBzb2NrZXQgJy92YXIvcnVuL215c3FsZC9teXNxbGQuc29jaycgKDIpIGluIDxiPi9ob21lL2FqYXhsb2FkL3d3dy9saWJyYWlyaWVzL2NsYXNzLm15c3FsLnBocDwvYj4gb24gbGluZSA8Yj42ODwvYj48YnIgLz4KPGJyIC8+CjxiPldhcm5pbmc8L2I+OiAgbXlzcWxfcXVlcnkoKSBbPGEgaHJlZj0nZnVuY3Rpb24ubXlzcWwtcXVlcnknPmZ1bmN0aW9uLm15c3FsLXF1ZXJ5PC9hPl06IEEgbGluayB0byB0aGUgc2VydmVyIGNvdWxkIG5vdCBiZSBlc3RhYmxpc2hlZCBpbiA8Yj4vaG9tZS9hamF4bG9hZC93d3cvbGlicmFpcmllcy9jbGFzcy5teXNxbC5waHA8L2I+IG9uIGxpbmUgPGI+Njg8L2I+PGJyIC8+CjxiciAvPgo8Yj5XYXJuaW5nPC9iPjogIG15c3FsX3F1ZXJ5KCkgWzxhIGhyZWY9J2Z1bmN0aW9uLm15c3FsLXF1ZXJ5Jz5mdW5jdGlvbi5teXNxbC1xdWVyeTwvYT5dOiBDYW4ndCBjb25uZWN0IHRvIGxvY2FsIE15U1FMIHNlcnZlciB0aHJvdWdoIHNvY2tldCAnL3Zhci9ydW4vbXlzcWxkL215c3FsZC5zb2NrJyAoMikgaW4gPGI+L2hvbWUvYWpheGxvYWQvd3d3L2xpYnJhaXJpZXMvY2xhc3MubXlzcWwucGhwPC9iPiBvbiBsaW5lIDxiPjY4PC9iPjxiciAvPgo8YnIgLz4KPGI+V2FybmluZzwvYj46ICBteXNxbF9xdWVyeSgpIFs8YSBocmVmPSdmdW5jdGlvbi5teXNxbC1xdWVyeSc+ZnVuY3Rpb24ubXlzcWwtcXVlcnk8L2E+XTogQSBsaW5rIHRvIHRoZSBzZXJ2ZXIgY291bGQgbm90IGJlIGVzdGFibGlzaGVkIGluIDxiPi9ob21lL2FqYXhsb2FkL3d3dy9saWJyYWlyaWVzL2NsYXNzLm15c3FsLnBocDwvYj4gb24gbGluZSA8Yj42ODwvYj48YnIgLz4KPGJyIC8+CjxiPldhcm5pbmc8L2I+OiAgbXlzcWxfcXVlcnkoKSBbPGEgaHJlZj0nZnVuY3Rpb24ubXlzcWwtcXVlcnknPmZ1bmN0aW9uLm15c3FsLXF1ZXJ5PC9hPl06IENhbid0IGNvbm5lY3QgdG8gbG9jYWwgTXlTUUwgc2VydmVyIHRocm91Z2ggc29ja2V0ICcvdmFyL3J1bi9teXNxbGQvbXlzcWxkLnNvY2snICgyKSBpbiA8Yj4vaG9tZS9hamF4bG9hZC93d3cvbGlicmFpcmllcy9jbGFzcy5teXNxbC5waHA8L2I+IG9uIGxpbmUgPGI+Njg8L2I+PGJyIC8+CjxiciAvPgo8Yj5XYXJuaW5nPC9iPjogIG15c3FsX3F1ZXJ5KCkgWzxhIGhyZWY9J2Z1bmN0aW9uLm15c3FsLXF1ZXJ5Jz5mdW5jdGlvbi5teXNxbC1xdWVyeTwvYT5dOiBBIGxpbmsgdG8gdGhlIHNlcnZlciBjb3VsZCBub3QgYmUgZXN0YWJsaXNoZWQgaW4gPGI+L2hvbWUvYWpheGxvYWQvd3d3L2xpYnJhaXJpZXMvY2xhc3MubXlzcWwucGhwPC9iPiBvbiBsaW5lIDxiPjY4PC9iPjxiciAvPgo=' />
                    <h4>Aguarde, gerando Arquivo...</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL GERANDO ARQUIVO -->
