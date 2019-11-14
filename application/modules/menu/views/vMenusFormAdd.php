<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 15/06/2018, 11:01:00
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


                    <?php $_error = form_error("nome_menu", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="nome_menu"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Nome Menu</label>
                        <input type="text" name="nome_menu" class="form-control" placeholder="Nome Menu" value="<?= set_value('nome_menu'); ?>" maxlength="250" autofocus/>
                        <?= $_error; ?>
                    </div>




                    <div class="form-group has-feedback">
                        <label for="menu_icon">Menu Icone</label>
                        <div class="input-group">
                            <input id="menu_icon" type="text" class="form-control" name="menu_icon" placeholder="Menu Icone" value="<?= set_value('menu_icon'); ?>" maxlength="250">
                            <div class="input-group-addon btn j-btn-menu-icon">
                                <i class="fa fa-image j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Icones"></i>
                            </div>
                        </div><!-- /.input group -->
                    </div>




                    <div class="form-group has-feedback">
                        <label for="descricao_menu">Descrição Menu</label>
                        <input type="text" name="descricao_menu" class="form-control" placeholder="Descrição Menu" value="<?= set_value('descricao_menu'); ?>" maxlength="250" />
                    </div>




                    <div class="form-group has-feedback">
                        <label for="app_name">Aplicativo</label>
                        <select name="app_name" class="form-control select2" data-placeholder="Selecione APP" style="width: 100%;" tabindex="-1" aria-hidden="true" value="">
                            <?php
                            $_c = 0;
                            if ($_apps['_result']):

                                foreach ($_apps['_result'] as $app_row):

                                    $_c++;

                                    if ($_c == 1):
                                        echo '<option value=""></option>';
                                    endif;

                                    echo '<option value="' . $app_row->app_name . '">' . $_c . ' - ' . $app_row->app_descricao . '</option>';

                                endforeach;

                            endif;
                            ?>
                        </select>
                    </div>




                    <div class="form-group has-feedback">
                        <label for="parent_id">Menu Pai</label>
                        <select name="parent_id" class="form-control select2" data-placeholder="Selecione Menu Pai" style="width: 100%;" tabindex="-1" aria-hidden="true" value="">
                            <?php
                            $_c = 0;
                            if ($_menupai['_result']):

                                foreach ($_menupai['_result'] as $menupai_row):

                                    $_c++;

                                    if ($_c == 1):
                                        echo '<option value=""></option>';
                                    endif;

                                    echo '<option value="' . $menupai_row->id . '">' . $_c . ' - ' . $menupai_row->nome_menu . '</option>';

                                endforeach;

                            endif;
                            ?>
                        </select>
                    </div>




                    <div class="form-group has-feedback">
                        <label for="ativo">Status</label>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="ativo" class="flat-green" <?= ($this->input->post('ativo') == 'on') ? 'checked' : ''; ?>>
                                Ativado
                            </label>
                        </div>
                    </div>



                    <div class="box-footer text-right">
                        <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i> Campos Obrigatórios</div>
                    </div>

                </div>




            </div>

        </div>


    </div>


    <?= form_close(); ?>


    <?php $this->load->view('modalIcons'); ?>