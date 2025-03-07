<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 20/06/2018, 10:43:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->
<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 20px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
        <small class="input-group-btn margin-left-10">


            <a href="<?= site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()); ?>"
               class="btn btn-sm btn-info btn-show-modal-aguarde" name="btn-add" value="btn-add">
                <span class="glyphicon glyphicon-plus"></span> Novo
            </a>

            <button type="button" id="btn-delete" class="btn btn-sm btn-danger disabled" name="btn-del" value="btn-del">
                <span class="glyphicon glyphicon-trash"></span> Deleta
            </button>

            <button type="button" id="btn-import-app" class="btn btn-sm bg-yellow-gradient text-black margin-left-15"
                    name="btn-import-app" value="btn-import-app" data-toggle="modal" data-target="#modalImportApp">
                <span class="glyphicon glyphicon-import"></span> Importar APP
            </button>


        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i
                        class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active"><i class="<?= $_font_icon; ?> margin-right-5"></i><?= $_titulo_app; ?></li>
    </ol>
</section>


<?= get_mensagem(); ?>


<div class="row">

    <div class="box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?>">


        <!-- HEADER -->
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools">

                <?= form_open('', 'role="form" method="GET"'); ?>
                <div class="input-group margin-top-10">

                    <input type="text" name="search" value="<?= $this->input->get('search'); ?>"
                           class="form-control input-sm pull-right" style="width: 150px;" placeholder="Pesquisar"
                           autofocus>

                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-primary btn-show-modal-aguarde j-tooltip" data-placement="bottom"
                                data-toggle="tooltip" data-original-title="Pesquisa"><i class="fa fa-search"></i>
                        </button>
                        <a href="<?= site_url($this->router->fetch_class()); ?>"
                           class="btn btn-sm btn-default btn-show-modal-aguarde j-tooltip" data-placement="bottom"
                           data-toggle="tooltip" data-original-title="Limpar"><i class="glyphicon glyphicon-minus"></i></a>

                    </div>

                </div>
                <?= form_close(); ?>

            </div>
        </div><!-- /.box-header -->
        <!-- END HEADER -->


        <!-- CONTEÚDO DA TABLE -->
        <div class="box-body table-responsive no-padding margin-top-20">


            <!-- TABLE -->
            <table class="table table-hover table-striped table-bordered table-mark-row">
                <thead class="thead-inverse bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>">
                <tr>
                    <th class="text-center" style="width:5px;"><input class="checkbox-all flat-red" type="checkbox">
                    </th>
                    <th class="text-center" style="width:5px;">#</th>
                    <th class="text-center" style="width:5px; color:#ccc">ID</th>
                    <th class="col-md-3">&nbsp;Nome APP</th>
                    <th class="col-md-5">&nbsp;Título do APP</th>
                    <th class="col-md-2">&nbsp;Tabela</th>
                    <th class="col-md-2 text-center">Ação</th>
                </tr>
                </thead>


                <tbody>

                <?php $_c = 0; ?>
                <?php foreach ($_result['results_paginacao'] as $_row): ?>

                    <?php $_c++; ?>

                    <?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row->id . '?tab=gridlist' . bz_app_parametros_url()); ?>
                    <tr data-action="<?= $_edit; ?>">
                        <td class="j-btn-edit btn-show-modal-aguarde mouse-cursor-pointer text-center"><input
                                    class="checkbox checkbox-unit flat-red text-center" type="checkbox"
                                    name="btn-delete[]" value="<?= $_row->id; ?>"></td>
                        <td class="j-btn-edit btn-show-modal-aguarde mouse-cursor-pointer text-center"
                            style="width:5px;"><?= $_c; ?></td>
                        <td class="j-btn-edit btn-show-modal-aguarde mouse-cursor-pointer text-center"
                            style="width:5px; color:#ccc"><?= $_row->id; ?></td>
                        <td class="j-btn-edit btn-show-modal-aguarde mouse-cursor-pointer">
                            &nbsp;<?= $_row->app_nome; ?></td>
                        <td class="j-btn-edit btn-show-modal-aguarde mouse-cursor-pointer">
                            &nbsp;<?= $_row->app_titulo; ?></td>
                        <td class="j-btn-edit btn-show-modal-aguarde mouse-cursor-pointer">
                            &nbsp;<?= $_row->tabela; ?></td>


                        <td class="text-center">

                            <!-- BTN EDIT-->
                            <?php // $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row->id . '?tab=gridlist' . bz_app_parametros_url()); ?>
                            <!--                                <a href="<?= $_edit; ?>" class="btn btn-xs btn-primary btn-show-modal-aguarde">
                                    <span class="glyphicon glyphicon-edit j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar"></span>
                                </a>-->
                            <!-- END BTN EDIT-->

                            <!-- BTN GERAR APLICAÇÃO-->
                            <?php $_buildApp = site_url($this->router->fetch_class() . '/build_app/' . $_row->id . '?tab=gridlist' . bz_app_parametros_url()); ?>
                            <a class="btn btn-xs bg-purple" data-toggle="modal" data-target="#modalBuildApp"
                               data-build="<?= strtolower($_buildApp); ?>" data-width="50%" data-height="350px"
                               data-title="Gerando Aplicação">
                                <span class="fa fa-gears j-tooltip" data-placement="bottom" data-toggle="tooltip"
                                      data-original-title="Gerar"></span>
                            </a>
                            <!-- END BTN GERAR APLICAÇÃO-->

                            <!-- BTN EXECUTAR APLICAÇÃO-->
                            <?php $_buildApp = site_url($_row->app_nome); ?>
                            <a class="btn btn-xs bg-maroon-gradient margin-right-5" data-toggle="modal"
                               data-target="#modalBuildApp"
                               data-build="<?= strtolower($_buildApp); ?>" data-width="90%" data-height="500px"
                               data-title="Executando Aplicação">
                                <span class="fa fa-external-link-square" j-tooltip="Executar Aplicação"
                                      data-placement="bottom" data-toggle="tooltip"
                                      data-original-title="Executar Aplicação"></span>
                            </a>
                            <!-- END BTN EXECUTAR APLICAÇÃO-->

                            <!-- BTN EXPORTAR APLICAÇÃO-->
                            <?php $_buildApp = site_url($_row->app_nome); ?>
                            |
                            <a class="btn btn-xs bg-yellow-gradient btn-show-modal-aguarde j-btn-export-app margin-left-5"
                               data-appnome="<?= $_row->app_nome; ?>">
                                <span style="color:black;" class="glyphicon glyphicon-export" j-tooltip="Exportar App"
                                      data-placement="bottom" data-toggle="tooltip"
                                      data-clipboard-message="Código APP copiado com sucesso"
                                      data-original-title="Exportar App"></span>
                            </a>
                            <!-- END BTN EXPORTAR APLICAÇÃO-->

                        </td>


                    </tr>

                <?php endforeach; ?>

                </tbody>


            </table>
            <!-- END TABLE -->


            <!-- PAGINAÇÃO -->
            <div class="box-footer clearfix">
                <div class="text-center paginacao-links pagination pagination-sm no-margin pull-right">
                    <?= $_result['links_paginacao']; ?>
                </div>
                <div class="text-left paginacao-links pagination pagination-sm no-margin text-primary">
                    <div class="padding-top-5">
                        <?= $_result['dados_paginacao']; ?>
                    </div>
                </div>
            </div>
            <!-- END PAGINAÇÃO -->


        </div><!-- /.box-body -->
        <!-- END CONTEÚDO DA TABLE -->


    </div><!-- /.box -->

</div>


<?php $this->load->view('modalBuildApp'); ?>
<?php $this->load->view('js/backupAppJs'); ?>
<?php $this->load->view('modalImportApp'); ?>

