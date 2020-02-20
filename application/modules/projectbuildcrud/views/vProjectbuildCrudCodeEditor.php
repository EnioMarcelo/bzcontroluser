<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--

/*
  Created on : 15/08/2018, 11:07
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->

<?php
if (mc_contains_in_string('metodo', $_parametros['code_type'])) {
    $_code_type = str_replace('metodo-php', 'MÉTODO PHP', $_parametros['code_type']);
} else {
    $_code_type = strtoupper(str_replace('-', ' ', $_parametros['code_type']));
}
?>

<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 23px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
        <small class=" ">
            <span style=" font-size: 1.8em; color:#2c3b41"> - Code Editor</span> <b> - <?= $_code_type; ?></b>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i
                        class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class=""><a href="<?= site_url($this->router->fetch_class() . '/edit/' . $_dados_projeto->id); ?>"
                        class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
        <li class="active"><i class="glyphicon glyphicon-edit margin-right-5"></i>Editando <b><?= $_code_type; ?></b>
        </li>
    </ol>
</section>

<?= get_mensagem(); ?>

<?= form_open($this->router->fetch_class() . '/codeeditor/' . $_dados_projeto->id . '/' . $_parametros['code_screen'] . '/' . $_parametros['code_type'] . '?' . bz_app_parametros_url(), 'id="formCodeEditor" role="form"'); ?>

<div class="box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?>">

    <div class="box-header margin-top-10">
        <h3 class="box-title">Nome do Aplicativo:
            <small style=" font-size: 0.9em;"><?= $_dados_projeto->app_nome; ?></small>
        </h3>

        <h3 class="box-title"> - Título:
            <small style=" font-size: 0.9em;"><?= $_dados_projeto->app_titulo; ?></small>
        </h3>

        <?php if (!empty($_parametros['type_project']) && $_parametros['type_project'] !== 'blank'): ?>
            <h3 class="box-title"> - Tabela:
                <small style=" font-size: 0.9em;"><?= $_dados_projeto->tabela; ?></small>
            </h3>
        <?php endif; ?>

        <div class="row pull-right margin-right-5">

            <a href="<?= site_url($this->router->fetch_class() . '/edit/' . $_dados_projeto->id . '?' . bz_app_parametros_url()); ?>"
               class="btn btn-sm btn-default btn-show-modal-aguarde margin-right-5">
                <span class="fa fa-reply margin-right-5"></span> Voltar
            </a>

            <button type="submit" id="btn-save-code-editor"
                    class="btn btn-sm btn-primary btn-show-modal-aguarde margin-right-5" name="btn-save-code-editor"
                    value="btn-save-code-editor">
                <span class="fa fa-save margin-right-5" aria-hidden="true"></span> Salvar
            </button>

            <?php if ($_parametros['code_type'] == 'metodo-php' || $_parametros['code_type'] == 'model-php'): ?>
                <button type="button" id="btn-del-code-editor" class="btn btn-sm btn-danger margin-right-5"
                        name="btn-del-code-editor" value="btn-del-code-editor">
                    <span class="fa fa-trash" aria-hidden="true"></span>
                </button>
            <?php endif; ?>

            <!-- BTN SIDEBAR INPUT FILDS-->
            <?php if ($_parametros['code_type'] == 'onrecord' || $_parametros['code_type'] == 'onrecordexport'): ?>
                <a id="j-btn-control-sidebar-fields-database" class="btn btn-sm bg-black margin-left-20 j-tooltip"
                   data-toggle="control-sidebar" data-placement="bottom" data-toggle="tooltip"
                   data-original-title="Campos da Tabela">
                    <span class="glyphicon glyphicon-indent-left"></span>
                </a>
            <?php endif; ?>
            <!-- END BTN SIDEBAR INPUT FIELDS-->


            <!-- BTN SIDEBAR MACRO CASE-->
            <?php if ($_parametros['code_type'] !== 'css'): ?>
                <a id="j-btn-control-sidebar-macros" class="btn btn-sm bg-fuchsia-active margin-left-20 j-tooltip"
                   data-toggle="control-sidebar" data-placement="bottom" data-toggle="tooltip"
                   data-original-title="Estojo de Macros">
                    <span class="fa fa-code"></span>
                </a>
            <?php endif; ?>
            <!-- END BTN SIDEBAR MACRO CASE-->

            <!-- BTN GERAR APLICAÇÃO-->
            <?php $_buildApp = site_url($this->router->fetch_class() . '/build_app/' . $_dados_projeto->id . '?' . bz_app_parametros_url()); ?>
            <a class="btn btn-sm bg-purple margin-left-20" data-toggle="modal" data-target="#modalBuildApp"
               data-build="<?= strtolower($_buildApp); ?>" data-width="50%" data-height="350px"
               data-title="Gerando Aplicação">
                <span class="fa fa-gears j-tooltip" data-placement="bottom" data-toggle="tooltip"
                      data-original-title="Gerar"></span>
            </a>
            <!-- END BTN GERAR APLICAÇÃO-->

            <!-- BTN EXECUTAR APLICAÇÃO-->
            <?php $_buildApp = site_url($_dados_projeto->app_nome); ?>
            <a id="j-btn-exec-app" class="btn btn-sm bg-maroon margin-left-20" data-toggle="modal"
               data-target="#modalBuildApp" data-build="<?= strtolower($_buildApp); ?>" data-width="90%"
               data-height="500px" data-title="Executando Aplicação">
                <span class="fa fa-external-link-square j-tooltip" data-placement="bottom" data-toggle="tooltip"
                      data-original-title="Executar Aplicação"></span>
            </a>
            <!-- END BTN EXECUTAR APLICAÇÃO-->

        </div>


        <div class="row margin-left-1 margin-top-10">
            <?php if ($_parametros['code_type'] == 'metodo-php'): ?>

                <?php if (!$_parametros['code_access_ajax_only']) { ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="" style="">
                                Tipo:
                            </label>
                            <?php
                            $_code_type_method_options = [
                                'public' => 'public',
                                'private' => 'private',
                                'protected' => 'protected'
                            ];

                            echo form_dropdown('code_type_method', $_code_type_method_options, $_parametros['code_type_method'], 'id="code_type_method" class="" style=""');
                            ?>
                        </div>
                    </div>
                <?php } ?>


                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" style="">
                            <input <?= $_parametros['code_access_ajax_only']; ?> type="checkbox"
                                                                                 id="code_access_ajax_only"
                                                                                 name="code_access_ajax_only"
                                                                                 class="flat-green"
                                                                                 style="position: absolute; opacity: 0;"
                                                                                 kl_vkbd_parsed="true">
                        </label>
                        <label>
                            &nbsp;Acesso somente por AJAX ?
                        </label>
                    </div>
                </div>

            <?php endif; ?>

            <?php if ($_parametros['code_type'] !== 'onrecord' && $_parametros['code_type'] !== 'onrecordexport'): ?>
                <div class="col-md-3"><b>Evento: </b> <?= $_parametros['code_screen_title']; ?></div>

                <?php if ($_parametros['code_screen_title'] == 'FORM ADD'): ?>
                    <div class="col-md-3"
                    <div class="form-group">
                        <label class="" style="">
                            <input <?= $_parametros['copy_script_js_from_form_add_to_form_edit']; ?> type="checkbox"
                                                                                                     id="copy_script_js_from_form_add_to_form_edit"
                                                                                                     name="copy_script_js_from_form_add_to_form_edit"
                                                                                                     class="flat-green"
                                                                                                     style="position: absolute; opacity: 0;"
                                                                                                     kl_vkbd_parsed="true">
                        </label>
                        <label>
                            &nbsp;Utilizar este SCRIPT JS no FORM EDIT ?
                        </label>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>


    </div>
    <!-- /.box-header -->

    <div class="box-body pad codeeditor">

        <input type="hidden" name="proj_build_id" value="<?= $_dados_projeto->id; ?>">
        <input type="hidden" name="code_screen" value="<?= $_parametros['code_screen']; ?>">
        <input type="hidden" name="code_type" value="<?= $_parametros['code_type']; ?>">
        <input type="hidden" name="btn-save-code-editor" value="btn-save-code-editor">

        <textarea id="codeeditor_1" class="col-xs-12" name="code_script" rows="30" width=="100%"
                  autofocus/><?= (($_parametros['code_script']) ? base64_decode($_parametros['code_script']) : null); ?></textarea>

    </div>

</div>

<?= form_close(); ?>

<script>

    $(function () {

        /**
         * ############################################################################################################################################################
         * BTN DEL CODE EDITOR
         * ############################################################################################################################################################
         */
        $("#btn-del-code-editor").on("click", function (e) {

            var t = '';
            t = 'Deseja deletar este <?= strtoupper($_code_type); ?> ?';

            swal({
                title: "ATENÇÃO",
                text: t,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {

                        swal.close();

                        $(this).attr('type', 'submit');
                        $(this).click();

                    } else {

                        swal.close();

                    }
                });

        });
        /**
         *
         * END ("#btn-del-code-editor")
         * ############################################################################################################################################################
         */


        /**
         * ############################################################################################################################################################
         * BTN ON CHANGE EXECUTE BTN code_type_method TO SAVE
         * ############################################################################################################################################################
         */
        $('#code_type_method').on('change', function (e) {
            e.preventDefault();
            $('#btn-save-code-editor').trigger("click");
        });
        /**
         *
         * END BTN ON CHANGE EXECUTE BTN code_type_method TO SAVE
         * ############################################################################################################################################################
         */


        /**
         * ############################################################################################################################################################
         * BTN ON CHANGE EXECUTE BTN code_access_ajax_only TO SAVE
         * ############################################################################################################################################################
         */
        $('#code_access_ajax_only').on('ifChecked', function (e) {
            e.preventDefault();
            $(this).filter(':radio').iCheck('check');
            $('#btn-save-code-editor').trigger("click");

        });

        $('#code_access_ajax_only').on('ifUnchecked', function (e) {
            e.preventDefault();
            $(this).filter(':radio').iCheck('uncheck');
            $('#btn-save-code-editor').trigger("click");
        });
        /**
         * END BTN ON CHANGE EXECUTE BTN code_access_ajax_only TO SAVE
         * ############################################################################################################################################################
         */
        /* 
         
         /**
         * ############################################################################################################################################################
         * BTN OPEN SIDE MENU 
         * ############################################################################################################################################################
         */
        <?php if ($_parametros['code_type'] !== 'jquery'): ?>

        /* BTN OPEN SIDE MENU FIELDS DATABASE */
        $('#j-btn-control-sidebar-fields-database').on('click', function () {
            $('#title-sidebar-tabs').html('Campos');

            $('#control-sidebar-fields-table-tab').removeClass('hidden');
            $('a[href="#control-sidebar-fields-table-tab"]').parent().removeClass('hidden');

            $('#control-sidebar-database-tab').addClass('hidden');
            $('a[href="#control-sidebar-database-tab"]').parent().addClass('hidden');

            $('#control-sidebar-modelo-tab').addClass('hidden');
            $('a[href="#control-sidebar-modelo-tab"]').parent().addClass('hidden');

            $('#control-sidebar-diversos-tab').addClass('hidden');
            $('a[href="#control-sidebar-diversos-tab"]').parent().addClass('hidden');

            $('.control-sidebar').find('.active').removeClass('active');
            $('a[href="#control-sidebar-fields-table-tab"]').parent().addClass('active');
            $('#control-sidebar-fields-table-tab').addClass('active');

        });
        /* END BTN OPEN SIDE MENU FIELDS DATABASE */

        /* BTN OPEN SIDE MENU MACROS */
        $('#j-btn-control-sidebar-macros').on('click', function () {
            $('#title-sidebar-tabs').html('Macros');

            $('#control-sidebar-fields-table-tab').addClass('hidden');
            $('a[href="#control-sidebar-fields-table-tab"]').parent().addClass('hidden');

            $('#control-sidebar-database-tab').removeClass('hidden');
            $('a[href="#control-sidebar-database-tab"]').parent().removeClass('hidden');

            $('#control-sidebar-modelo-tab').removeClass('hidden');
            $('a[href="#control-sidebar-modelo-tab"]').parent().removeClass('hidden');

            $('#control-sidebar-diversos-tab').removeClass('hidden');
            $('a[href="#control-sidebar-diversos-tab"]').parent().removeClass('hidden');

            $('.control-sidebar').find('.active').removeClass('active');
            $('a[href="#control-sidebar-database-tab"]').parent().addClass('active');
            $('#control-sidebar-database-tab').addClass('active');

        });
        /* END BTN OPEN SIDE MENU MACROS */

        <?php endif; ?>
        /**
         * END BTN OPEN SIDE MENU
         * ############################################################################################################################################################
         */


    });//END function


</script>


<?php $this->load->view('modalBuildApp'); ?>


<?php $this->load->view('sidebarCaseMacros'); ?>

