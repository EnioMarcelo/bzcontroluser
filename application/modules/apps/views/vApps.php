<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> 
<!--


/*
  Created on : 09/08/2017, 07:47:00
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

    <div class="box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?>">


        <!-- HEADER -->
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools">

                <?= form_open('', 'role="form" method="GET"'); ?>
                <div class="input-group margin-top-10">

                    <input type="text" name="search" value="<?= $this->input->get('search'); ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Pesquisar" autofocus>

                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-primary btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Pesquisa"><i class="fa fa-search"></i></button>
                        <a href="<?= site_url($this->router->fetch_class()); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Limpar"><i class="glyphicon glyphicon-minus"></i></a>

                        <a href="<?= site_url($this->router->fetch_class()); ?>?app_ativo=Y<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>" class="btn btn-sm btn-success btn-show-modal-aguarde j-tooltip margin-left-10 <?= (strtoupper($this->input->get('app_ativo', TRUE)) == 'Y') ? 'disabled' : ''; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="ATIVADO"><i class="fa fa-check-circle-o"></i></a>
                        <a href="<?= site_url($this->router->fetch_class()); ?>?app_ativo=N<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>" class="btn btn-sm btn-danger btn-show-modal-aguarde j-tooltip <?= (strtoupper($this->input->get('app_ativo', TRUE)) == 'N') ? 'disabled' : ''; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="DESATIVADO"><i class="fa fa-circle-o"></i></a>

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
                        <th class="text-center" style="width:5px;"><input class="checkbox-all flat-red" type="checkbox"></th>
                        <th class="text-center" style="width:5px;">#</th>
                        <th class="col-md-2">Nome</th>
                        <th class="col-md-7">Descrição</th>
                        <th class="col-md-1 text-center">Status</th>
                        <th class="col-md-1 text-center">Ação</th>
                    </tr>
                </thead>



                <tbody>

                    <?php $_c_linha = 0; ?>
                    <?php foreach ($_result['results_paginacao'] as $_row): ?>  

                        <?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row->app_name . '?' . bz_app_parametros_url()); ?>
                        <?php $_j_btn_edit = 'j-btn-edit btn-show-modal-aguarde mouse-cursor-pointer'; ?>
                        <?php $_c_linha++; ?>

                        <tr id="<?= $_row->app_name; ?>" class="ClTableGridListTbodyTr" data-action="<?= $_edit; ?>">
                            <td class="text-center"><input class="checkbox checkbox-unit flat-red text-center" type="checkbox" name="btn-delete[]" value="<?= $_row->app_name; ?>"></td>
                            <td class="text-center" style="width:5px;"><?= $_c_linha; ?></td>
                            <td class="col-md-3 <?= $_j_btn_edit; ?>"><?= $_row->app_name; ?></td>
                            <td class="col-md-7" data-action="<?= $_edit; ?>">

                                <span class="<?= $_j_btn_edit; ?> col-md-11"><?= $_row->app_descricao; ?></span>

                                <?php
                                /*
                                 * GET ACL - APPS E GRUPOS DOS USUÁRIOS
                                 */
                                $_ca = $this->user_acl_groups->_get_acl_user(array('string_filter' => $_row->app_name, 'key_filter' => 'by_app_name'));


                                /*
                                 * PREPARA A TAG DOS USUÁRIOS
                                 */

                                $_usu = '';
                                $_usu_arr = [];

                                $_c = 0;

                                if ($_ca):
                                    foreach ($_ca as $_u):
                                        $_usu_arr[$_c]['usuario_id'] = $_u['usuario_id'];
                                        $_usu_arr[$_c]['usuario_email'] = $_u['usuario_email'];
                                        $_usu_arr[$_c]['usuario_nome'] = $_u['usuario_nome'];
                                        $_usu_arr[$_c]['usuario_ativo'] = $_u['usuario_ativo'];

                                        $_c++;
                                    endforeach;

                                    foreach ($_usu_arr as $_urr):
                                        if (!strpos($_usu, $_urr['usuario_nome'])):
                                            $_usu_class_inativo = ($_urr['usuario_ativo'] == 'N') ? "class='text-gray'" : '';
//                                            $_usu .= "<a " . $_usu_class_inativo . " href='" . site_url('usuarios/edit/') . $_urr['usuario_id'] . "?btnvoltarorigem=apps&" . bz_app_parametros_url() . "'><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_urr['usuario_nome'] . '</div></a>';
                                            $_usu .= "<a " . $_usu_class_inativo . "><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_urr['usuario_nome'] . '</div></a>';
                                        endif;
                                    endforeach;
                                endif;

                                /*
                                 * PREPARA A TAG DOS GRUPOS
                                 */
                                $_grupos = '';
                                $_grupos_arr = [];

                                $_c = 0;

                                if ($_ca):
                                    foreach ($_ca as $_g):
                                        $_grupos_arr[$_c]['grupo_id'] = $_g['grupo_id'];
                                        $_grupos_arr[$_c]['grupo_descricao'] = $_g['grupo_descricao'];
                                        $_grupos_arr[$_c]['grupo_ativo'] = $_g['grupo_ativo'];

                                        $_c++;
                                    endforeach;

                                    foreach ($_grupos_arr as $_grr):
                                        if (!strpos($_grupos, $_grr['grupo_descricao'])):
                                            $_gr_class_inativo = ($_grr['grupo_ativo'] == 'N') ? "class='text-gray'" : '';
//                                            $_grupos .= "<a " . $_gr_class_inativo . " href='" . site_url('grupos/edit/') . $_grr['grupo_id'] . "?btnvoltarorigem=apps&" . bz_app_parametros_url() . "'><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_grr['grupo_descricao'] . '</div></a>';
                                            $_grupos .= "<a " . $_gr_class_inativo . "><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_grr['grupo_descricao'] . '</div></a>';
                                        endif;
                                    endforeach;
                                endif;
                                ?>

                                <!-- APRESENTA A TAG DOS USUÁRIOS -->
                                <?php if ($_usu): ?>
                                    <small class="label pull-right bg-aqua" style="cursor: pointer" title="<p style='font-size:1.2em'>Usuários</p>" data-placement="bottom" data-toggle="popover" data-content="<?= $_usu; ?>">U</small>
                                <?php endif; ?>
                                <!-- END TAG DOS USUÁRIOS -->

                                <!-- APRESENTA A TAG DOS GRUPOS -->
                                <?php if ($_grupos): ?>
                                    <small class="label pull-right bg-aqua-active margin-right-5" style="cursor: pointer" title="<p style='font-size:1.2em'>Grupos</p>" data-placement="bottom" data-toggle="popover" data-content="<?= $_grupos; ?>">G</small>
                                <?php endif; ?>
                                <!-- END TAG DOS GRUPOS -->



                            </td>

                            <!-- BTN ATIVA/DESATIVA STATUS-->
                            <td class="col-md-1 text-center">
                                <?php
                                $_redirect = site_url($this->router->fetch_class() . '/status/' . $_row->app_name . '?' . bz_app_parametros_url());

                                if (strtoupper($_row->app_ativo) == 'Y'):
                                    echo '<a href="' . $_redirect . '" class="btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Desativar"><span class="label label-success">ATIVADO</span></a>';
                                else:
                                    echo '<a href="' . $_redirect . '" class="btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Ativar"><span class="label label-danger">DESATIVADO</span></a>';
                                endif;
                                ?>
                            </td>
                            <!-- END BTN ATIVA/DESATIVA STATUS-->

                            <td class="text-center">
                                <?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row->app_name . '?' . bz_app_parametros_url()); ?>
                                <a href="<?= $_edit; ?>" class="btn btn-xs btn-primary">
                                    <span class="glyphicon glyphicon-edit j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar"></span>
                                </a>

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

