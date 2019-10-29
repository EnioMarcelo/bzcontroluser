<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 26/03/2018, 08:06:00
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
        <li class="active"><i class="fa <?= $_font_icon; ?> margin-right-5"></i><?= $_titulo_app; ?></li>
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
                <thead class="thead-inverse  bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>">
                    <tr>
                        <th class="text-center" style="width:5px;"><input class="checkbox-all flat-red" type="checkbox"></th>
                        <th class="text-center" style="width:5px;">#</th>
                        <th class="text-center" style="width:5px; color:#ccc">ID</th>
                        <th class="col-md-7">Nome Usuário</th>
                        <th class="col-md-3">Email</th>
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
                            <td class="col-md-7">
                                <?= $_row->nome; ?>

                                <!-- TAG GRUPOS E APPS DO USUÁRIO -->
                                <?php
                                /*
                                 * GET ACL - APPS E GRUPOS DOS USUÁRIOS
                                 */
                                $_qr_grupos_apps_user = $this->user_acl_groups->_get_acl_user(array('string_filter' => $_row->id, 'key_filter' => 'by_user_id'));

                                /*
                                 * PREPARA A TAG DOS GRUPOS E APPS
                                 */
                                $_grupos = '';
                                $_grupos_arr = [];

                                $_apps = '';
                                $_apps_arr = [];

                                $_c = 0;

                                if ($_qr_grupos_apps_user):
                                    foreach ($_qr_grupos_apps_user as $_r):
                                        $_grupos_arr[$_c]['grupo_id'] = $_r['grupo_id'];
                                        $_grupos_arr[$_c]['grupo_descricao'] = $_r['grupo_descricao'];
                                        $_grupos_arr[$_c]['grupo_ativo'] = $_r['grupo_ativo'];

                                        $_apps_arr[$_c]['app_descricao'] = $_r['app_descricao'];
                                        $_apps_arr[$_c]['app_name'] = $_r['app_name'];
                                        $_apps_arr[$_c]['app_ativo'] = $_r['app_ativo'];

                                        $_c++;
                                    endforeach;


                                    foreach ($_grupos_arr as $_grr):
                                        if (!strpos($_grupos, $_grr['grupo_descricao'])):
                                            $_gr_class_inativo = ($_grr['grupo_ativo'] == 'N') ? "class='text-gray'" : '';
//                                            $_grupos .= "<a " . $_gr_class_inativo . " href='" . site_url('grupos/edit/') . $_grr['grupo_id'] . "?btnvoltarorigem=usuarios&" . bz_app_parametros_url() . "'><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_grr['grupo_descricao'] . '</div></a>';
                                            $_grupos .= "<a " . $_gr_class_inativo . "><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_grr['grupo_descricao'] . '</div></a>';
                                        endif;
                                    endforeach;


                                    foreach ($_apps_arr as $_arr):
                                        if (!strpos($_apps, $_arr['app_name'])):
                                            $_app_class_inativo = ($_arr['app_ativo'] == 'N') ? "class='text-gray'" : '';
//                                            $_apps .= "<a " . $_app_class_inativo . " href='" . site_url('apps/edit/') . $_arr['app_name'] . "?btnvoltarorigem=usuarios&" . bz_app_parametros_url() . "'><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_arr['app_descricao'] . '</div></a>';
                                            $_apps .= "<a " . $_app_class_inativo . "><div class='text-left'><i class='fa fa-fw fa-check-square margin-right-5'></i>" . $_arr['app_descricao'] . '</div></a>';
                                        endif;
                                    endforeach;
                                endif;
                                ?>

                                <!-- APRESENTA A TAG DOS GRUPOS E APPS -->
                                <?php if ($_apps): ?>
                                    <small class="label pull-right bg-aqua" style="cursor: pointer" title="<p style='font-size:1.2em'>Aplicativos</p>" data-placement="bottom" data-toggle="popover" data-content="<?= $_apps; ?>">A</small>
                                <?php endif; ?>

                                <?php if ($_grupos): ?>
                                    <small class="label pull-right bg-aqua-active margin-right-5" style="cursor: pointer" title="<p style='font-size:1.2em'>Grupos</p>" data-placement="bottom" data-toggle="popover" data-content="<?= $_grupos; ?>">G</small>
                                <?php endif; ?>
                                <!-- END TAG GRUPOS E APPS DO USUÁRIO -->

                                <!-- TAG DE USUÁRIO SUPER ADMIN -->
                                <?php if ($_row->super_admin == 'Y'): ?>
                                    <small class="label pull-right bg-black-active j-tooltip margin-right-5" style="cursor: pointer" data-toggle="tooltip" data-original-title="Super Admin" data-placement="bottom">SA</small>
                                <?php endif; ?>
                                <!-- END TAG DE USUÁRIO SUPER ADMIN -->


                            </td>

                            <td class="col-md-3"><?= $_row->email; ?></td>


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


                            <!-- AÇÃO-->
                            <td class="text-center">

                                <!-- BTN EDIT -->
                                <?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row->id . '?' . bz_app_parametros_url()); ?>
                                <a href="<?= $_edit; ?>" class="btn btn-xs btn-primary">
                                    <span class="glyphicon glyphicon-edit j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar"></span>
                                </a>
                                <!-- END EDIT -->

                                <!-- BTN ALTERA SENHA DO USUÁRIO -->
                                <a class="btn btn-xs btn-warning j-btn-change-pass-user" data-id="<?= $_row->id; ?>" data-email="<?= $_row->email; ?>" data-nome="<?= $_row->nome; ?>" >
                                    <span class="fa fa-key j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Alterar Senha"></span>
                                </a>
                                <!-- END BTN ALTERA SENHA DO USUÁRIO -->


                                <!-- BTN DESCONECTA USUÁRIO -->
                                <?php
                                $_btn_conected = 'btn-default';
                                $_btn_conected_tooltip_msg = 'Usuário Desconectado';
                                $_btn_conected_status = 'poweroff';

                                $_conected = $this->read->exec('ci_sessions', 'WHERE data LIKE "%' . $_row->email . '%"')->result();
                                if ($_conected):
                                    $_btn_conected = 'btn-success';
                                    $_btn_conected_tooltip_msg = 'Desconectar Usuário';
                                    $_btn_conected_status = 'poweron';
                                endif;

                                $_btn_conected_disable = (($this->session->userdata('user_login')['user_email'] == $_row->email) ? 'disabled' : '');
                                ?>

                                <a id="<?= $_row->id; ?>" class="btn btn-xs <?= $_btn_conected; ?> btn-show-modal-aguarde j-btn-poweroff-user <?= (($_btn_conected_status == 'poweroff') ? 'disabled' : ''); ?> <?= $_btn_conected_disable; ?>" data-rel="<?= $_btn_conected_status; ?>" data-id="<?= $_row->id; ?>" data-email="<?= $_row->email; ?>" data-nome="<?= $_row->nome; ?>" >
                                    <span class="fa fa-power-off j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="<?= $_btn_conected_tooltip_msg; ?>"></span>
                                </a>
                                <!-- END BTN DESCONECTA USUÁRIO -->

                            </td>
                            <!-- END AÇÃO-->


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



<?php
$this->load->view($this->router->fetch_class() . '/js/ajax-js');
?>