<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--

/*
  Created on : 15/08/2018, 11:07
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->
<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 23px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
        <small class=" ">
            <span style=" font-size: 1.8em; color:#2c3b41"> - Code Editor</span> <b> - <?= strtoupper(str_replace('-', ' ', $_parametros['code_type'])); ?></b> <?= ($_parametros['code_type'] == 'onrecord' ? '' : $_parametros['code_screen_title']); ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class=""><a href="<?= site_url($this->router->fetch_class() . '/edit/' . $_dados_projeto->id); ?>" class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
        <li class="active"><i class="glyphicon glyphicon-edit margin-right-5"></i>Editando <b><?= strtoupper(str_replace('-', ' ', $_parametros['code_type'])); ?></b> <?= ( $_parametros['code_type'] == 'onrecord' ? '' : $_parametros['code_screen_title']); ?></li>
    </ol>
</section>

<?= get_mensagem(); ?>

<?= form_open(site_url($this->router->fetch_class() . '/codeeditor/' . $_dados_projeto->id . '/' . $_parametros['code_screen'] . '/' . $_parametros['code_type'] . '?' . bz_app_parametros_url()), 'id="formCodeEditor" role="form"'); ?>

<div class="box box-info">

    <div class="box-header margin-top-10">
        <h3 class="box-title">Nome do Aplicativo:
            <small style=" font-size: 0.9em;"><?= $_dados_projeto->app_nome; ?></small>
        </h3>

        <h3 class="box-title"> - Título:
            <small style=" font-size: 0.9em;"><?= $_dados_projeto->app_titulo; ?></small>
        </h3>

        <h3 class="box-title"> - Tabela:
            <small style=" font-size: 0.9em;"><?= $_dados_projeto->tabela; ?></small>
        </h3>

        <div class="pull-right">

            <a href="<?= site_url($this->router->fetch_class() . '/edit/' . $_dados_projeto->id . '?' . bz_app_parametros_url()); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde margin-right-5">
                <span class="fa fa-reply margin-right-5"></span> Voltar
            </a>

            <button type="submit" id="btn-save-code-editor" class="btn btn-sm btn-primary btn-show-modal-aguarde margin-right-5" name="btn-save-code-editor" value="btn-save-code-editor">
                <span class="fa fa-save margin-right-5" aria-hidden="true"></span> Salvar
            </button>

            <?php if ($_parametros['code_type'] == 'metodo-php' || $_parametros['code_type'] == 'model-php'): ?>
                <button type="button" id="btn-del-code-editor" class="btn btn-sm btn-danger margin-right-5" name="btn-del-code-editor" value="btn-del-code-editor">
                    <span class="fa fa-trash" aria-hidden="true"></span>
                </button>
            <?php endif; ?>

            <!-- BTN GERAR APLICAÇÃO-->
            <?php $_buildApp = site_url($this->router->fetch_class() . '/build_app/' . $_dados_projeto->id . '?' . bz_app_parametros_url()); ?>
            <a class="btn btn-sm bg-purple margin-left-20" data-toggle="modal" data-target="#modalBuildApp" data-build="<?= $_buildApp; ?>" data-width="50%" data-height="350px" data-title="Gerando Aplicação">
                <span class="fa fa-gears j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Gerar"></span>
            </a>
            <!-- END BTN GERAR APLICAÇÃO-->

            <!-- BTN EXECUTAR APLICAÇÃO-->
            <?php $_buildApp = site_url($_dados_projeto->app_nome); ?>
            <a class="btn btn-sm bg-maroon margin-left-20" data-toggle="modal" data-target="#modalBuildApp" data-build="<?= $_buildApp; ?>" data-width="90%" data-height="500px" data-title="Executando Aplicação">
                <span class="fa fa-external-link-square j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Executar Aplicação"></span>
            </a>
            <!-- END BTN EXECUTAR APLICAÇÃO-->

        </div>

    </div>
    <!-- /.box-header -->

    <div class="box-body pad codeeditor">

        <input type="hidden" name="proj_build_id" value="<?= $_dados_projeto->id; ?>">
        <input type="hidden" name="code_screen" value="<?= $_parametros['code_screen']; ?>">
        <input type="hidden" name="code_type" value="<?= $_parametros['code_type']; ?>">

        <textarea id="codeeditor_1"  class="col-xs-12" name="code_script" rows="30" width=="100%" autofocus /><?= (($_parametros['code_script']) ? base64_decode($_parametros['code_script']) : null); ?></textarea>


    </div>
</div>


<?= form_close(); ?>


<script>

    $(function () {

        $("#btn-del-code-editor").on("click", function (e) {

            var t = '';
            t = 'Deseja deletar este método PHP ?';

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

        });//END ("#btn-del-code-editor")


    });//END function




</script>




<?php $this->load->view('modalBuildApp'); ?>
