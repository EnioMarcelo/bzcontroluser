<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 21/02/2017, 07:29:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->
<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 23px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
        <small class=" ">
            Edição
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i
                        class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class=""><a href="<?= site_url($this->router->fetch_class()); ?>" class="btn-show-modal-aguarde"><i
                        class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
        <li class="active"><i class="glyphicon glyphicon-edit margin-right-5"></i>Editando <?= $_titulo_app; ?></li>
    </ol>
</section>


<?= get_mensagem(); ?>


<?= form_open($this->router->fetch_class() . '/edit/' . $dados->id . '?' . bz_app_parametros_url(), 'role="form"'); ?>

<div class="row">

    <div class="box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?>">

        <!-- HEADER -->
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools">

                <div class="input-group margin-top-10">


                    <div class="input-group-btn text-right">

                        <a href="<?= $this->session->flashdata('btn_voltar_link'); ?>"
                           class="btn btn-sm btn-default btn-show-modal-aguarde margin-right-5">
                            <span class="fa fa-reply margin-right-5"></span> Voltar
                        </a>

                        <button type="submit" id="btn-editar"
                                class="btn btn-sm btn-primary btn-show-modal-aguarde margin-right-5" name="btn-editar"
                                value="btn-editar">
                            <span class="fa fa-save margin-right-5" aria-hidden="true"></span> Salvar
                        </button>


                        <a href="<?= site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()); ?>"
                           class="btn btn-sm btn-info btn-show-modal-aguarde" name="btn-add" value="btn-add">
                            <span class="glyphicon glyphicon-plus"></span> Novo
                        </a>


                    </div>

                </div>

            </div>
        </div><!-- /.box-header -->
        <!-- END HEADER -->

        <div class="box-body no-padding padding-bottom-10 margin-top-5">


            <div class="box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?> margin-top-15 padding-right-10">
                <div class="box-header">
                </div><!-- /.box-header -->


                <div class="box-body">

                    <div class="form-group has-feedback">
                        <label for="id">ID : <span class=""><?= $dados->id; ?></span></label>
                    </div>


                    <!-- NOME -->
                    <?php $_error = form_error("nome", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="nome"><i class="fa fa-asterisk margin-right-5 text-error"
                                             style="font-size: 0.7em;"></i>Nome do Usuário</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="nome" class="form-control" placeholder="Nome do Usuário"
                                   value="<?= (set_value('nome')) ? set_value('nome') : $dados->nome; ?>"
                                   maxlength="250" autofocus/>
                        </div>
                        <?= $_error; ?>
                    </div>

                    <!-- EMAIL -->
                    <?php $_error = form_error("email", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="email"><i class="fa fa-asterisk margin-right-5 text-error"
                                              style="font-size: 0.7em;"></i>Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input type="text" class="form-control" placeholder="Email do Usuário"
                                   value="<?= (set_value('email')) ? set_value('email') : $dados->email; ?>"
                                   maxlength="250" disabled/>
                        </div>
                        <?= $_error; ?>
                    </div>

                    <!-- SEXO -->
                    <!--                    --><?php //$_error = form_error("sexo", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <!--                    <div class="form-group has-feedback">-->
                    <!--                        <label for="sexo"><i class="fa fa-asterisk margin-right-5 text-error"-->
                    <!--                                             style="font-size: 0.7em;"></i>Sexo</label>-->
                    <!--                        --><?php
                    //                        $options = array(
                    //                            ' ' => 'Selecione...',
                    //                            'M' => 'MASCULINO',
                    //                            'F' => 'FEMININO',
                    //                        );
                    //                        echo form_dropdown('sexo', $options, (set_value('sexo')) ? set_value('sexo') : $dados->sexo, 'class="form-control input-lg select2"');
                    //                        ?>
                    <!--                        --><? //= $_error; ?>
                    <!--                    </div>-->

                    <!-- GRUPOS -->
                    <?php $_error = form_error("grupos", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="grupos">Grupos</label>
                        <select name="grupos[]" class="form-control select2-multiple-selection" multiple=""
                                data-placeholder=" Selecione..." style="width: 100%;" tabindex="-1"
                                aria-hidden="true" value="<?= set_value('grupos'); ?>">
                            <?php
                            $_c = 0;
                            $x_s = explode(';', $dados->grupos);
                            $_s = $_grupos['_relat'];

                            if ($_grupos['_result']):
                                foreach ($_grupos['_result'] as $grupo_row):

                                    $_c++;

                                    if (in_array($grupo_row->id, $_s)):
                                        echo '<option selected value="' . $grupo_row->id . '">' . $_c . ' - ' . $grupo_row->descricao . '</option>';
                                    else:
                                        echo '<option value="' . $grupo_row->id . '">' . $_c . ' - ' . $grupo_row->descricao . '</option>';
                                    endif;

                                endforeach;

                            endif;
                            ?>
                        </select>
                        <?= $_error; ?>
                    </div>


                    <!-- APPS -->
                    <div class="form-group has-feedback">
                        <label for="apps">Aplicativos</label>
                        <select class="form-control select2-multiple-selection disabled" multiple=""
                                style="width: 100%;" disabled="disabled">
                            <?php
                            $_apps = $this->user_acl_groups->_get_acl_user(array('string_filter' => $dados->id, 'key_filter' => 'by_user_id'));
                            $_c = 0;
                            $_app_select = '';

                            if ($_apps):
                                foreach ($_apps as $_apps_row):
                                    $_c++;

                                    if (!strpos($_app_select, $_apps_row['app_name'])):
                                        $_app_select .= '<option selected value="' . $_apps_row['app_name'] . '">' . $_apps_row['app_descricao'] . '</option>';
                                    endif;

                                endforeach;
                            endif;

                            echo $_app_select;
                            ?>
                        </select>
                    </div>

                    <!-- DROPDOWN APP INICIAL -->
                    <div class="form-group has-feedback">
                        <label for="grupos">Aplicativo Inicial</label>
                        <?php echo form_dropdown('app_inicial', $_app_inicial['_dropdown'], $dados->app_inicial, 'class="form-control select"'); ?>
                    </div>


                    <div class="container-fluid padding-top-15">
                        <!-- SUPER ADMIN -->
                        <?php $_error = form_error("super_admin", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                        <div class="form-group has-feedback col-md-2 col-sm-2 col-xs-6">
                            <label for="super_admin">Super Admin</label>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="super_admin"
                                           class="flat-green" <?= ($dados->super_admin == 'Y' || $dados->super_admin == 'on') ? 'checked' : ''; ?>>
                                    Ativado
                                </label>
                            </div>
                            <?= $_error; ?>
                        </div>


                        <!-- ATIVO -->
                        <?php $_error = form_error("ativo", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                        <div class="form-group has-feedback col-md-2 col-sm-2 col-xs-6">
                            <label for="ativo">Status</label>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="ativo"
                                           class="flat-green" <?= ($dados->ativo == 'Y' || $dados->ativo == 'on') ? 'checked' : ''; ?>>
                                    Ativado
                                </label>
                            </div>
                            <?= $_error; ?>
                        </div>
                    </div>


                    <input type="hidden" name="id" value="<?= (set_value('id')) ? set_value('id') : $dados->id; ?>"
                           readonly/>
                    <input type="hidden" name="email"
                           value="<?= (set_value('email')) ? set_value('email') : $dados->email; ?>" readonly/>
                    <input type="hidden" class="" name="task" value="edit-app" readonly/>


                    <div class="box-footer text-right">

                        <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error"
                                                    style="font-size: 0.7em;"></i> Campos Obrigatórios
                        </div>

                    </div>

                </div>


            </div>

        </div>


    </div>


    <?= form_close(); ?>


