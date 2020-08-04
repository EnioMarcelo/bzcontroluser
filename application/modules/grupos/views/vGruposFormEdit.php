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


            <div class="box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?> margin-top-15">
                <div class="box-header">
                </div><!-- /.box-header -->


                <div class="box-body">

                    <div class="form-group has-feedback">
                        <label for="id">ID : <span class=""><?= $dados->id; ?></span></label>
                    </div>


                    <?php $_error = form_error("descricao", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="descricao"><i class="fa fa-asterisk margin-right-5 text-error"
                                                  style="font-size: 0.7em;"></i>Nome do Grupo</label>
                        <input type="text" name="descricao" class="form-control" placeholder="Nome do Grupo"
                               value="<?= (set_value('descricao')) ? set_value('descricao') : $dados->descricao; ?>"
                               maxlength="250" autofocus/>
                        <?= $_error; ?>
                    </div>


                    <?php $_error = form_error("apps", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="apps"><i class="fa fa-asterisk margin-right-5 text-error"
                                             style="font-size: 0.7em;"></i>Aplicativos</label>
                        <select name="apps[]" class="form-control select2-multiple-selection" multiple=""
                                data-placeholder="Selecione..." style="width: 100%;" tabindex="-1" aria-hidden="true"
                                value="<?= set_value('apps'); ?>">
                            <?php
                            $_c = 0;
                            $x_s = explode(';', $dados->apps);
                            $_s = $_apps['_relat'];

                            if ($_apps['_result']):
                                foreach ($_apps['_result'] as $app_row):

                                    $_c++;

                                    if (in_array($app_row->app_name, $_s)):
                                        echo '<option selected value="' . $app_row->app_name . '">' . $_c . ' - ' . $app_row->app_descricao . '</option>';
                                    else:
                                        echo '<option value="' . $app_row->app_name . '">' . $_c . ' - ' . $app_row->app_descricao . '</option>';
                                    endif;

                                endforeach;

                            endif;
                            ?>
                        </select>
                        <?= $_error; ?>
                    </div>


                    <!-- USUÁRIOS -->
                    <div class="form-group has-feedback">
                        <label for="usuarios">Usuários</label>
                        <select class="form-control select2-multiple-selection disabled" multiple=""
                                style="width: 100%;" disabled="disabled">
                            <?php
                            $_ca = $this->user_acl_groups->_get_acl_user(array('string_filter' => $dados->id, 'key_filter' => 'by_grupo_id'));
                            $_c = 0;
                            $_ca_select = '';

                            if ($_ca):
                                foreach ($_ca as $_ca_row):
                                    $_c++;

                                    if (!strpos($_ca_select, $_ca_row['usuario_id'])):
                                        $_ca_select .= '<option selected value="' . $_ca_row['usuario_id'] . '">' . $_ca_row['usuario_nome'] . '</option>';
                                    endif;

                                endforeach;
                            endif;

                            echo $_ca_select;
                            ?>
                        </select>
                    </div>

                    <!-- DROPDOWN APP INICIAL -->
                    <div class="form-group has-feedback">
                        <label for="grupos">Aplicativo Inicial</label>
                        <?php echo form_dropdown('app_inicial', $_app_inicial['_dropdown'], $dados->app_inicial, 'class="form-control select"'); ?>
                    </div>


                    <?php $_error = form_error("ativo", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="ativo">Status</label>
                        <!--                        <input type="text" name="ativo" class="form-control" placeholder="Status do APP" value="<?= (set_value('ativo')) ? set_value('ativo') : $dados->ativo; ?>"/>-->

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="ativo"
                                       class="flat-green" <?= ($dados->ativo == 'Y' || $dados->ativo == 'on') ? 'checked' : ''; ?>>
                                Ativado
                            </label>
                        </div>
                        <?= $_error; ?>
                    </div>


                    <input type="hidden" name="id" value="<?= (set_value('id')) ? set_value('id') : $dados->id; ?>"
                           readonly/>
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


