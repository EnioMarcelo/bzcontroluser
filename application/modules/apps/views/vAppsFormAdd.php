<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 15/08/2017, 10:59:00
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


<?= form_open(site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()), 'role="form"'); ?>

<div class="row">

    <div class="box">

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

        <div class="box-body no-padding padding-left-10 padding-right-10 padding-bottom-10 margin-top-20">


            <div class="box box-primary margin-top-15">
                <div class="box-header">
                </div><!-- /.box-header -->


                <div class="box-body">

                    <?php $_error = form_error("app_name", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="app_name"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Nome APP</label>
                        <input type="text" name="app_name" class="form-control" placeholder="Nome do APP" value="<?= set_value('app_name'); ?>" maxlength="50" autofocus/>
                        <?= $_error; ?>
                    </div>

                    <?php $_error = form_error("app_descricao", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="app_descricao"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Descrição APP</label>
                        <input type="text" name="app_descricao" class="form-control" placeholder="Descrição do APP" value="<?= set_value('app_descricao'); ?>" maxlength="250"/>
                        <?= $_error; ?>
                    </div>

                    <?php $_error = form_error("app_ativo", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="app_ativo">Status APP</label>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="app_ativo" class="flat-green" <?= ($this->input->post('app_ativo') == 'on') ? 'checked' : ''; ?>>
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
