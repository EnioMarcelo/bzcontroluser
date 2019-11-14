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

                    <!-- NOME -->
                    <?php $_error = form_error("nome", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="nome"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Nome do Usuário</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="nome" class="form-control" placeholder="Nome do Usuário" value="<?= set_value('nome'); ?>" maxlength="250" autofocus/>
                        </div>
                        <?= $_error; ?>
                    </div>

                    <!-- EMAIL -->
                    <?php $_error = form_error("email", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="email"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input type="text" name="email" class="form-control" placeholder="Email do Usuário" value="<?= set_value('email'); ?>" maxlength="250"/>
                        </div>
                        <?= $_error; ?>
                    </div>

                    <!-- SEXO -->
                    <?php $_error = form_error("sexo", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="sexo"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Sexo</label>
                        <?php
                        $options = array(
                            ' ' => 'Selecione...',
                            'M' => 'MASCULINO',
                            'F' => 'FEMININO',
                        );
                        echo form_dropdown('sexo', $options, set_value('sexo'), 'class="form-control select2"');
                        ?>
                        <?= $_error; ?>
                    </div>

                    <!-- GRUPOS -->
                    <?php $_error = form_error("grupos", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="grupos"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Grupos</label>
                        <select name="grupos[]" class="form-control select2-multiple-selection " multiple="true" data-placeholder="Selecione Grupos" style="width: 100%;" tabindex="-1" aria-hidden="true" value="<?= set_value('grupos'); ?>">
                            <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                            <?php
                            $_c = 0;
                            if ($_grupos['_result']):

                                foreach ($_grupos['_result'] as $grupo_row):

                                    $_c++;

                                    if (in_array($grupo_row->id, $this->input->post('grupos'))):
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


                    <!-- SUPER ADMIN -->
                    <?php $_error = form_error("super_admin", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="super_admin">Super Admin</label>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="super_admin" class="flat-green" <?= ($this->input->post('super_admin') == 'on') ? 'checked' : ''; ?>>
                                Ativado
                            </label>
                        </div>
                        <?= $_error; ?>
                    </div>


                    <!-- ATIVO -->
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




