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

                    <input type="text" name="search" value="<?= $this->input->get('search'); ?>" class="form-control input-sm pull-right" style ="width: 150px;" placeholder="Pesquisar" autofocus>

                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-primary btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Pesquisa"><i class="fa fa-search"></i></button>
                        <a href="<?= site_url($this->router->fetch_class()); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Limpar"><i class="glyphicon glyphicon-minus"></i></a>

                        <a href="<?= site_url($this->router->fetch_class()); ?>?ativo=Y<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>" class="btn btn-sm btn-success btn-show-modal-aguarde j-tooltip margin-left-10 <?= (strtoupper($this->input->get('ativo', TRUE)) == 'Y') ? 'disabled' : ''; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="ATIVADO"><i class="fa fa-check-circle-o"></i></a>
                        <a href="<?= site_url($this->router->fetch_class()); ?>?ativo=N<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>" class="btn btn-sm btn-danger btn-show-modal-aguarde j-tooltip <?= (strtoupper($this->input->get('ativo', TRUE)) == 'N') ? 'disabled' : ''; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="DESATIVADO"><i class="fa fa-circle-o"></i></a>

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
                        <th class="text-center" style="width:5px; color:#ccc">ID</th>
                        <th class="col-md-10">Nome do Grupo</th>
                        <th class="col-md-1 text-center">Status</th>
                        <th class="col-md-1 text-center">Ação</th>
                    </tr>
                </thead>



                <tbody>

                    <?php $_c = 0; ?>
                    <?php foreach ($_result['results_paginacao'] as $_row): ?>  

                        <?php $_c++; ?>  

                        <tr>
                            <td class="text-center"><input class="checkbox checkbox-unit flat-red text-center" type="checkbox" name="btn-delete[]" value="<?= $_row->id; ?>"></td>
                            <td class="text-center" style="width:5px;"><?= $_c; ?></td>
                            <td class="text-center" style="width:5px; color:#ccc"><?= $_row->id; ?></td>
                            <td class="col-md-3"><?= $_row->descricao; ?>

                                <?php
                                /*
                                 * GET ACL - APPS E GRUPOS DOS USUÁRIOS
                                 */
                                $_ca = $this->user_acl_groups->_get_acl_user(array('string_filter' => $_row->id, 'key_filter' => 'by_grupo_id'));

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
//                                            $_usu .= "<a " . $_usu_class_inativo . " href='" . site_url('usuarios/edit/') . $_urr['usuario_id'] . "?btnvoltarorigem=grupos&" . bz_app_parametros_url() . "'><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_urr['usuario_nome'] . '</div></a>';
                                            $_usu .= "<a " . $_usu_class_inativo . "><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_urr['usuario_nome'] . '</div></a>';
                                        endif;
                                    endforeach;
                                endif;
                                /*
                                 * PREPARA A TAG DOS APPS
                                 */

                                $_app = '';
                                $_app_arr = [];

                                $_c = 0;

                                if ($_ca):
                                    foreach ($_ca as $_u):
                                        $_app_arr[$_c]['app_name'] = $_u['app_name'];
                                        $_app_arr[$_c]['app_descricao'] = $_u['app_descricao'];
                                        $_app_arr[$_c]['app_ativo'] = $_u['app_ativo'];

                                        $_c++;
                                    endforeach;

                                    foreach ($_app_arr as $_arr):
                                        if (!strpos($_app, $_arr['app_name'])):
                                            $_app_class_inativo = ($_arr['app_ativo'] == 'N') ? "class='text-gray'" : '';
//                                            $_app .= "<a " . $_app_class_inativo . " href='" . site_url('apps/edit/') . $_arr['app_name'] . "?btnvoltarorigem=grupos&" . bz_app_parametros_url() . "'><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_arr['app_descricao'] . '</div></a>';
                                            $_app .= "<a " . $_app_class_inativo . "><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_arr['app_descricao'] . '</div></a>';
                                        endif;
                                    endforeach;
                                endif;
                                
                                ?>



                                <!-- APRESENTA A TAG DOS USUÁRIOS -->
                                <?php if ($_usu): ?>
                                    <small class="label pull-right bg-aqua" style="cursor: pointer" title="<p style='font-size:1.2em'>Usuários</p>" data-placement="bottom" data-toggle="popover" data-content="<?= $_usu; ?>">U</small>
                                <?php endif; ?>
                                <!-- END TAG DOS USUÁRIOS -->

                                <!-- APRESENTA A TAG DOS APPS -->
                                <?php if ($_app): ?>
                                    <small class="label pull-right bg-aqua-active margin-right-5" style="cursor: pointer" title="<p style='font-size:1.2em'>Aplicativos</p>" data-placement="bottom" data-toggle="popover" data-content="<?= $_app; ?>">A</small>
                                <?php endif; ?>
                                <!-- END TAG DOS APPS -->

                            </td>


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