<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 09/08/2017, 07:48:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->
<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 20px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
        <small class="input-group-btn margin-left-10">


            <a href="<?= site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()); ?>" class="btn btn-sm btn-info btn-show-modal-aguarde" name="btn-add" value="btn-add">
                <span class="glyphicon glyphicon-plus"></span> Novo
            </a>

            <button type="button" id="btn-delete" class="btn btn-sm btn-danger disabled" name="btn-del" value="btn-del">
                <span class="glyphicon glyphicon-trash"></span> Deleta
            </button>


        </small>
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

                    <!--<input type="text" name="search" value="<?= $this->input->get('search'); ?>" class="form-control input-sm pull-right" style ="width: 150px;" placeholder="Pesquisar">-->
                    <!--<input type="text" name="search_menu_pai" value="<?= $this->input->get('search_menu_pai'); ?>" class="form-control input-sm pull-right margin-right-5" style ="width: 150px;" placeholder="Menu Pai">-->
                    <select name="search_menu_pai" onchange="this.form.submit()" class="form-control input-sm pull-right margin-right-5" style="width:200px;">
                        <?php
                        $c_menupai = 0;
                        foreach ($_menupai['_result'] as $row_menupai):
                            if ($row_menupai->id == $this->input->get('search_menu_pai')):
                                echo '<option selected value="' . $row_menupai->id . '">' . $row_menupai->nome_menu . '</option>';
                            else:
                                if ($c_menupai == 0):
                                    echo '<option value="">Menu Pai... Selecione....</option>';
                                endif;
                                echo '<option value="' . $row_menupai->id . '">' . $row_menupai->nome_menu . '</option>';
                            endif;
                            $c_menupai++;
                        endforeach;
                        ?>
                    </select>

                    &nbsp;


                    <div class="input-group-btn">
                        <!--<button class="btn btn-sm btn-primary btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Pesquisa"><i class="fa fa-search"></i></button>-->
                        <a href="<?= site_url($this->router->fetch_class()); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Limpar"><i class="fa fa-refresh"></i></a>

                        <!-- BTN FULL SCREEN -->
						<a class='btn btn-sm btn-flat j-btn-open-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Tela Cheia'><i class='fa fa-external-link'></i></a>
						<!-- BTN FULL SCREEN -->	

                        <!-- BTN CLOSE FULL SCREEN -->
                        <a style="display: none" class='btn btn-sm btn-flat j-btn-close-modal-fullscreen j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Fechar Tela'><i class='fa fa-close'></i></a>
                        <!-- BTN CLOSE FULL SCREEN -->		
                        
                        <!--<a href="<?= site_url($this->router->fetch_class()); ?>?ativo=Y<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?><?= (($this->input->get('search_menu_pai')) ? '&search_menu_pai=' . $this->input->get('search_menu_pai') : ''); ?>" class="btn btn-sm btn-success btn-show-modal-aguarde j-tooltip margin-left-10 <?= (strtoupper($this->input->get('ativo', TRUE)) == 'Y') ? 'disabled' : ''; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="ATIVADO"><i class="fa fa-check-circle-o"></i></a>-->
                        <!--<a href="<?= site_url($this->router->fetch_class()); ?>?ativo=N<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?><?= (($this->input->get('search_menu_pai')) ? '&search_menu_pai=' . $this->input->get('search_menu_pai') : ''); ?>" class="btn btn-sm btn-danger btn-show-modal-aguarde j-tooltip <?= (strtoupper($this->input->get('ativo', TRUE)) == 'N') ? 'disabled' : ''; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="DESATIVADO"><i class="fa fa-circle-o"></i></a>-->
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
                        <th class="text-center" style="width:5px;"><input class="checkbox-all flat-red" type="checkbox"></th>
                        <th class="text-center" style="width:5px;">#</th>
                        <th class="text-center" style="width:5px; color:#ccc">ID</th>
                        <th class="col-md-2">Nome Menu</th>
                        <th class="col-md-3">Descrição</th>
                        <th class="col-md-2">APP</th>
                        <th class="col-md-2">Menu Pai</th>
                        <th class="col-md-1 text-center">Status</th>
                        <th class="col-md-1 text-center">Ação</th>
                    </tr>
                </thead>



                <tbody>


                    <?php $_c = 0; ?>
                    <?php foreach ($_result['results_paginacao'] as $_row): ?>  

                        <?php $_c++; ?>  

                        <?php if ($_row->nivel_menu == 0) : ?>

                            <tr>
                                <td class="text-center"><input class="checkbox checkbox-unit flat-red text-center" type="checkbox" name="btn-delete[]" value="<?= $_row->id; ?>"></td>
                                <td class="text-center" style="width:5px;"><?= $_c; ?></td>
                                <td class="text-center" style="width:5px; color:#ccc"><?= $_row->id; ?></td>
                                <td class="col-md-2"><?= ($_row->parent_id > 0) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_row->nome_menu : '<i class="fa fa-th-list margin-right-5"></i><b>' . $_row->nome_menu . '</b>'; ?></td>
                                <td class="col-md-3"><?= ($_row->parent_id > 0) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_row->descricao_menu : '<i class="fa fa-th-list margin-right-5"></i><b>' . $_row->descricao_menu; ?></b></td>
                                <td class="col-md-2"><?= $_row->app_name; ?></td>
                                <td class="col-md-2 text-uppercase"><?= ($_row->parent_id == 0) ? '' : $this->read->ExecRead('sec_menus', 'WHERE id = ' . $_row->parent_id . ' ORDER BY nome_menu')->row()->nome_menu; ?></td>


                                <!-- BTN ATIVA/DESATIVA STATUS-->
                                <td class="col-md-1 text-center">
                                    <?php
                                    $_redirect = site_url($this->router->fetch_class() . '/status/' . $_row->id . '?' . bz_app_parametros_url());

                                    if (strtoupper($_row->ativo) == 'Y'):
                                        echo '<a href="' . $_redirect . '" class="btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Desativar"><span class="label label-success">ATIVADO</span></a>';
                                    else:
                                        echo '<a href="' . $_redirect . '" class="btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Ativar"><span class="label label-danger">DESATIVADO</span></a>';
                                    endif;
                                    ?>
                                </td>
                                <!-- END BTN ATIVA/DESATIVA STATUS-->

                                <td class="text-center">
                                    <?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row->id . '?' . bz_app_parametros_url()); ?>
                                    <a href="<?= $_edit; ?>" class="btn btn-xs btn-primary">
                                        <span class="glyphicon glyphicon-edit j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar"></span>
                                    </a>

                                </td>


                            </tr>


                            <?php foreach ($_result['results_paginacao'] as $_row_menu_filho): ?>

                                <?php if ($_row_menu_filho->parent_id == $_row->id): ?>

                                    <?php $_c++; ?> 

                                    <tr>
                                        <td class="text-center"><input class="checkbox checkbox-unit flat-red text-center" type="checkbox" name="btn-delete[]" value="<?= $_row_menu_filho->id; ?>"></td>
                                        <td class="text-center" style="width:5px;"><?= $_c; ?></td>
                                        <td class="text-center" style="width:5px; color:#ccc"><?= $_row_menu_filho->id; ?></td>
                                        <td class="col-md-2"><?= ($_row_menu_filho->parent_id > 0) ? '&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right margin-right-5"></i>' . $_row_menu_filho->nome_menu : $_row_menu_filho->nome_menu; ?></td>
                                        <td class="col-md-3"><?= ($_row_menu_filho->parent_id > 0) ? '&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right margin-right-5"></i>' . $_row_menu_filho->descricao_menu : $_row_menu_filho->descricao_menu; ?></td>
                                        <td class="col-md-2"><?= $_row_menu_filho->app_name; ?></td>
                                        <td class="col-md-2 text-uppercase"><i class="fa fa-th-list margin-right-5"></i><b><?= ($_row_menu_filho->parent_id == 0) ? '' : $this->read->ExecRead('sec_menus', 'WHERE id = ' . $_row_menu_filho->parent_id . ' ORDER BY nome_menu')->row()->nome_menu; ?></b></td>


                                        <!-- BTN ATIVA/DESATIVA STATUS-->
                                        <td class="col-md-1 text-center">
                                            <?php
                                            $_redirect = site_url($this->router->fetch_class() . '/status/' . $_row_menu_filho->id . '?' . bz_app_parametros_url());

                                            if (strtoupper($_row_menu_filho->ativo) == 'Y'):
                                                echo '<a href="' . $_redirect . '" class="btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Desativar"><span class="label label-success">ATIVADO</span></a>';
                                            else:
                                                echo '<a href="' . $_redirect . '" class="btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Ativar"><span class="label label-danger">DESATIVADO</span></a>';
                                            endif;
                                            ?>
                                        </td>
                                        <!-- END BTN ATIVA/DESATIVA STATUS-->

                                        <td class="text-center">
                                            <?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row_menu_filho->id . '?' . bz_app_parametros_url()); ?>
                                            <a href="<?= $_edit; ?>" class="btn btn-xs btn-primary">
                                                <span class="glyphicon glyphicon-edit j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar"></span>
                                            </a>

                                        </td>


                                    </tr>
                                <?php endif; ?>

                            <?php endforeach; ?>

                        <?php endif; ?>

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