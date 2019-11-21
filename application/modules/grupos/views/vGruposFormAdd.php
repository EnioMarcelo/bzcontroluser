<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 19/02/2018, 08:13:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->

<section class="content-header header-dashboard" style="margin-top: 0px; margin-left: -15px; margin-bottom: 23px;">
    <h1>
        <i class="<?= $_font_icon; ?>"></i>
        <?= $_titulo_app; ?>
        <small class=" ">
            Novo
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class=""><a href="<?= site_url($this->router->fetch_class()); ?>" class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
        <li class="active"><i class="fa fa-plus margin-right-5"></i>Novo <?= $_titulo_app; ?></li>
    </ol>
</section>


<?= get_mensagem(); ?>


<?= form_open($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url(), 'id="form1" role="form"'); ?>

<div class="row">

    <div class="box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?>">

        <!-- HEADER -->
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools">

                <div class="input-group margin-top-10">


                    <div class="input-group-btn text-right">

                        <a href="<?= $this->session->flashdata('btn_voltar_link'); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde margin-right-5">
                            <span class="fa fa-reply margin-right-5"></span> Voltar
                        </a>

                        <button type="submit" id="btn-salvar" class="btn btn-sm btn-primary btn-show-modal-aguarde" name="btn-salvar" value="btn-salvar">
                            <span class="fa fa-save margin-right-5" aria-hidden="true"></span> Salvar
                        </button>
                    </div>

                </div>

            </div>
        </div><!-- /.box-header -->
        <!-- END HEADER -->

        <div class="box-body no-padding padding-bottom-10 margin-top-5">


            <div class="box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?> margin-top-15">

                <div class="box-body">


                    <?php $_error = form_error("descricao", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="descricao"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Nome do Grupo</label>
                        <input type="text" name="descricao" class="form-control" placeholder="Nome do Grupo" value="<?= set_value('descricao'); ?>" maxlength="250" autofocus/>
                        <?= $_error; ?>
                    </div>


                    <?php $_error = form_error("apps", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="apps"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Aplicativos</label>
                        <select name="apps[]" class="form-control select2-multiple-selection " multiple="true" data-placeholder="Selecione APPs" style="width: 100%;" tabindex="-1" aria-hidden="true" value="<?= set_value('apps'); ?>">
                            <?php
                            $_c = 0;
                            if ($_apps['_result']):

                                foreach ($_apps['_result'] as $app_row):

                                    $_c++;

                                    if (in_array($app_row->app_name, $this->input->post('apps'))):
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


                    <?php $_error = form_error("ativo", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="ativo">Status</label>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="ativo" class="flat-green" <?= ($this->input->post('ativo') == 'on') ? 'checked' : ''; ?>>
                                Ativado
                            </label>
                        </div>
                        <?= $_error; ?>
                    </div>



                    <div class="box-footer text-right">
                        <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i> Campos Obrigatórios</div>
                    </div>

                </div>




            </div>

        </div>


    </div>


    <?= form_close(); ?>




