<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 09/08/2017, 07:52:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->


<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 23px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active"><i class="<?= $_font_icon; ?> margin-right-5"></i><?= $_titulo_app; ?></li>
    </ol>
</section>



<?= get_mensagem(); ?>



<div class="row">

    <div class="box">


        <!-- HEADER -->
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools">

                <?= form_open('', 'role="form" method="GET"'); ?>
                <div class="input-group margin-top-10">

                    <input type="text" name="search" value="<?= $this->input->get('search'); ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Pesquisar" autofocus>

                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-primary btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Pesquisa"><i class="fa fa-search"></i></button>
                        <a href="<?= site_url($this->router->fetch_class()); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Limpar"><i class="fa fa-refresh"></i></a>

                        <!-- BTN FULL SCREEN -->
                        <a class='btn btn-sm btn-flat j-btn-open-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Tela Cheia'><i class='fa fa-external-link'></i></a>
                        <!-- BTN FULL SCREEN -->	

                        <!-- BTN CLOSE FULL SCREEN -->
                        <a style="display: none" class='btn btn-sm btn-flat j-btn-close-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Fechar Tela'><i class='fa fa-close'></i></a>
                        <!-- BTN CLOSE FULL SCREEN -->	


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
                <thead class="thead-inverse  bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>">
                    <tr>

                        <th class="text-center" style="width:5px;">#</th>
                        <th class="">User Agent</th>
                        <th class="col-md-2 text-center">Date</th>
                        <th class="">User</th>
                        <th class=" text-center">Application</th>
                        <th class=" text-center">Method</th>
                        <th class=" text-center">Creator</th>
                        <th class=" text-center">IP User</th>
                        <th class=" text-center">Action</th>
                        <th class="">Description</th>

                    </tr>
                </thead>



                <tbody>

                    <?php $_c = 0; ?>
                    <?php foreach ($_result['results_paginacao'] as $_row): ?>  

                        <?php $_c++; ?>  

                        <tr data-toggle="modal" data-target="#myModal">

                            <?php
                            $_userAgent = str_replace('Navegador:', '<b>NAV:</b>', $_row->user_agent);
                            $_userAgent = str_replace('Sistema Operacional:', '<b>SO:</b>', $_userAgent);
                            ?>

                            <td class="text-center" style="width:5px;"><?= $_c; ?></td>
                            <td class="text-left"><?= $_userAgent; ?></td>
                            <td class="text-center"><?= bz_formatData($_row->inserted_date, 'd/m/Y H:i:s'); ?></td>
                            <td class=""><?= $_row->username; ?></td>
                            <td class="text-center"><?= $_row->application; ?></td>
                            <td class="text-center"><?= $_row->method; ?></td>
                            <td class="text-center"><?= $_row->creator; ?></td>
                            <td class="text-center"><?= $_row->ip_user; ?></td>
                            <td class="text-center"><?= $_row->action; ?></td>
                            <td <?= ($_row->last_query) ? 'style="cursor:pointer" class="j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Ver Query"' : ''; ?>><?= ($_row->last_query) ? '<i class="glyphicon glyphicon-option-vertical"></i>' : ''; ?><?= $_row->description; ?></td>
                            <td class="hidden"><?= $_row->user_agent; ?></td>
                            <td class="hidden last-query"><?= $_row->last_query; ?></td>



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


<!-- MODAL LAST QUERY -->
<div id="myModal" class="modal modal-primary">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">LAST QUERY</h4>
            </div>

            <div class="modal-body" style="overflow-wrap: break-word;">
                ...
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END MODAL LAST QUERY -->



<?php
$this->load->view($this->router->fetch_class() . '/ajax/ajax-js');
?>