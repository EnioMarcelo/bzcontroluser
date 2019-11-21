<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 18/06/2018, 13:48:00
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
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active btn-show-modal-aguarde"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class=""><a href="<?= site_url($this->router->fetch_class()); ?>" class="btn-show-modal-aguarde"><i class="<?= $_font_icon; ?>"></i><?= $_titulo_app; ?></a></li>
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

                        <a href="<?= $this->session->flashdata('btn_voltar_link'); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde margin-right-5">
                            <span class="fa fa-reply margin-right-5"></span> Voltar
                        </a>

                        <button type="submit" id="btn-editar" class="btn btn-sm btn-primary btn-show-modal-aguarde margin-right-5" name="btn-editar" value="btn-editar">
                            <span class="fa fa-save margin-right-5" aria-hidden="true"></span> Salvar
                        </button>


                        <a href="<?= site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()); ?>" class="btn btn-sm btn-info btn-show-modal-aguarde" name="btn-add" value="btn-add">
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
                        <label for="id">ID : <span class="" ><?= $dados->id; ?></span></label>
                    </div>


                    <?php $_error = form_error("descricao", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="nome_menu"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Nome Menu</label>
                        <input type="text" name="nome_menu" class="form-control" placeholder="Nome Menu" value="<?= (set_value('nome_menu')) ? set_value('nome_menu') : $dados->nome_menu; ?>" maxlength="250" autofocus/>
                        <?= $_error; ?>
                    </div>





                    <div class="form-group has-feedback">
                        <label for="menu_icon">Menu Icone</label>
                        <div class="input-group">
                            <input id="menu_icon" type="text" name="menu_icon" class="form-control" placeholder="Menu Icon" value="<?= (set_value('menu_icon')) ? set_value('menu_icon') : $dados->menu_icon; ?>" maxlength="250" />
                            <div class="input-group-addon btn j-btn-menu-icon">
                                <i class="fa fa-image j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Icones"></i>
                            </div>
                        </div><!-- /.input group -->
                    </div>




                    <div class="form-group has-feedback">
                        <label for="descricao_menu"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Descrição Menu</label>
                        <input type="text" name="descricao_menu" class="form-control" placeholder="Descrição Menu" value="<?= (set_value('descricao_menu')) ? set_value('descricao_menu') : $dados->descricao_menu; ?>" maxlength="250" />

                    </div>

                    <?php
                    //echo '-- > ' . (set_value('descricao_menu')) ? set_value('descricao_menu') : $dados->descricao_menu;
                    ?>


                    <div class="form-group has-feedback">
                        <label for="app_name">Aplicativo</label>
                        <select name="app_name" class="form-control select2" data-placeholder="Selecione APP" style="width: 100%;" tabindex="-1" aria-hidden="true" value="">
                            <?php
                            $_c = 0;

                            if ($_apps['_result']):

                                foreach ($_apps['_result'] as $app_row):

                                    $_c++;

                                    if ($app_row->app_name == $dados->app_name):
                                        echo '<option selected value="' . $app_row->app_name . '">' . $app_row->app_descricao . '</option>';
                                    else:

                                        if ($_c == 1):
                                            echo '<option value=""></option>';
                                        endif;

                                        echo '<option value="' . $app_row->app_name . '">' . $app_row->app_descricao . '</option>';
                                    endif;

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

                                    if ($menupai_row->id == $dados->parent_id):
                                        echo '<option selected value="' . $menupai_row->id . '">' . $menupai_row->nome_menu . '</option>';
                                    else:

                                        if ($_c == 1):
                                            echo '<option value=""></option>';
                                        endif;

                                        echo '<option value="' . $menupai_row->id . '">' . $menupai_row->nome_menu . '</option>';
                                    endif;

                                endforeach;

                            endif;
                            ?>
                        </select>
                    </div>




                    <div class="form-group has-feedback">
                        <label for="ativo">Status</label>
                        <!--                        <input type="text" name="ativo" class="form-control" placeholder="Status do APP" value="<?= (set_value('ativo')) ? set_value('ativo') : $dados->ativo; ?>"/>-->

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="ativo" class="flat-green" <?= ($dados->ativo == 'Y' || $dados->ativo == 'on') ? 'checked' : ''; ?>>
                                Ativado
                            </label>
                        </div>
                    </div>




                    <input type="hidden" name="id" value="<?= (set_value('id')) ? set_value('id') : $dados->id; ?>" readonly/>
                    <input type="hidden" class="" name="task" value="edit-app" readonly/>




                    <div class="box-footer text-right">

                        <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i> Campos Obrigatórios</div>

                    </div>

                </div>




            </div>

        </div>


    </div>


    <?= form_close(); ?>

    <?php $this->load->view('modalIcons'); ?>


