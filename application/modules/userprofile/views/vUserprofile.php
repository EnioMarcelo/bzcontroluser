<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 02/08/2017, 17:12:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


-->


<section class="content-header header-dashboard" style="margin-bottom: 20px;">
    <h1>
        <?php if (empty($_pane2changepasssactive)): ?>
            <i class="fa fa-user"></i>
            Meus Dados
            <small></small>
        <?php else: ?>
            <i class="fa fa-key"></i>
            Alterar Senha
            <small></small>
        <?php endif; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard'); ?>" target="_top" class="active"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active"><i class="fa fa-user margin-right-5"></i>Meus Dados</li>
    </ol>
</section>

<?= get_mensagem(); ?>


<div class="row">

    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <?php if (empty($_pane2changepasssactive)):; ?>
                <li class="<?= ($_pane1changepasssactive == 'Y') ? 'active' : ''; ?>"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Meus Dados</a></li>
            <?php endif; ?>

            <li class="<?= ($_pane2changepasssactive == 'Y') ? 'active' : ''; ?>"><a href="#tab_2" data-toggle="tab" aria-expanded="true">Alterar Senha</a></li>
        </ul>

        <div class="tab-content">

            <?php if (empty($_pane2changepasssactive)):; ?>
                <div class="tab-pane <?= ($_pane1changepasssactive == 'Y') ? 'active' : ''; ?>" id="tab_1">

                    <!-- FORM MEUS DADOS -->
                    <?= form_open('', 'role="form"'); ?>
                    <div class="margin-top-5">



                        <!-- NOME -->
                        <?php $_error = form_error("nome", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                        <div class="form-group has-feedback">
                            <label for="nome"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Nome</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="nome" class="form-control input-lg" placeholder="Seu Nome" value="<?= $_dados_usuario->nome; ?>" maxlength="250" autofocus/>
                                <span class="glyphicon glyphicon glyphicon-remove form-control-feedback <?= $_error ? '' : 'invisible'; ?>"></span>
                            </div>
                            <?= $_error; ?>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                <input type="text" class="form-control input-lg" placeholder="Email" value="<?= $_dados_usuario->email; ?>" disabled/>
                            </div>
                        </div>

                        <!-- SEXO -->
<!--                        --><?php //$_error = form_error("sexo", "<small class='text-danger bz-input-error'>", "</small>"); ?>
<!--                        <div class="form-group has-feedback">-->
<!--                            <label for="sexo"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Sexo</label>-->
<!--                            <div class="input-group col-md-12">-->
<!--                                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>-->
<!--                                --><?php
//                                $options = array(
//                                    '' => 'Selecione...',
//                                    'M' => 'MASCULINO',
//                                    'F' => 'FEMININO',
//                                );
//                                echo form_dropdown('sexo', $options, $_dados_usuario->sexo, 'class="form-control input-lg select2"');
//                                ?>
<!--                            </div>-->
<!--                            --><?//= $_error; ?>
<!--                        </div>-->

                        <br>

                        <div style="margin-left:3px;" class="row">
                            <div class="col-md-4">
                                <!-- DATA CADASTRO-->
                                <div class="form-group has-feedback">
                                    <label for="cadastro_data">Data de Cadastro</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" placeholder="Data de Cadastro" value="<?= bz_formatdata($_dados_usuario->cadastro_data, 'd/m/Y'); ?>" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- HORA CADASTRO-->
                                <div class="form-group has-feedback">
                                    <label for="cadastro_data">Hora de Cadastro</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" class="form-control" placeholder="Hora de Cadastro" value="<?= bz_formatdata($_dados_usuario->cadastro_data, 'H:i:s'); ?>" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- ÚLTIMO LOGIN -->
                                <div class="form-group has-feedback">
                                    <label for="ultimo_login">Último Login</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-hourglass-end"></i></span>
                                        <input type="text" class="form-control" placeholder="Data Último Login" value="<?= bz_formatdata($this->session->userdata('user_login')['user_ultimo_login'], 'd/m/Y H:i:s'); ?>" disabled/>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" class="" name="id" value="<?= $_dados_usuario->id; ?>" readonly>
                        <input type="hidden" class="" name="task" value="update_user" readonly>


                        <div class="box-footer text-right">
                            <button class="btn btn-primary btn-show-modal-aguarde"><i class="fa fa-floppy-o margin-right-5" aria-hidden="true"></i>Gravar</button>
                        </div><!-- /.box-footer-->

                        <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i> Campos Obrigatórios</div>


                    </div>
                    <?= form_close(); ?>
                    <!-- END FORM MEUS DADOS -->

                </div><!-- /.tab-pane -->
            <?php endif; ?>

            <div class="tab-pane <?= ($_pane2changepasssactive == 'Y') ? 'active' : ''; ?>" id="tab_2">

                <!-- ALTERAR SENHA -->
                <?= form_open('', 'role="form"'); ?>
                <div class="margin-top-5">

                    <!-- EMAIL -->
                    <?php $_error = form_error("email", "<small class='text-danger'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input type="email" name="email" class="form-control input-lg" placeholder="Seu Email" value="<?= $_dados_usuario->email; ?>" maxlength="250" readonly/>
                            <span class="glyphicon glyphicon glyphicon-remove form-control-feedback <?= $_error ? '' : 'invisible'; ?>"></span>
                        </div>
                        <?= $_error; ?>
                    </div>

                    <!-- SENHA ATUAL -->
                    <?php $_error = form_error("senha_atual", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="senha_atual"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Senha Atual</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="senha_atual" class="form-control input-lg" placeholder="Senha Atual" value="" maxlength="20" autofocus/>
                            <span class="glyphicon glyphicon glyphicon-remove form-control-feedback <?= $_error ? '' : 'invisible'; ?>"></span>
                        </div>
                        <?= $_error; ?>
                    </div>

                    <!-- NOVA SENHA -->
                    <?php $_error = form_error("nova_senha", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="nova_senha"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Nova Senha</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="nova_senha" class="form-control input-lg" placeholder="Nova Senha" value="" maxlength="20"/>
                            <span class="glyphicon glyphicon glyphicon-remove form-control-feedback <?= $_error ? '' : 'invisible'; ?>"></span>
                        </div>
                        <?= $_error; ?>
                    </div>

                    <!-- CONFIRME NOVA SENHA -->
                    <?php $_error = form_error("confirme_nova_senha", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                    <div class="form-group has-feedback">
                        <label for="confirme_nova_senha"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Confirme Nova Senha</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="confirme_nova_senha" class="form-control input-lg" placeholder="Confirme Nova Senha" value="" maxlength="20"/>
                            <span class="glyphicon glyphicon glyphicon-remove form-control-feedback <?= $_error ? '' : 'invisible'; ?>"></span>
                        </div>
                        <?= $_error; ?>
                    </div>

                    <input type="hidden" class="" name="id" value="<?= $_dados_usuario->id; ?>" readonly>
                    <input type="hidden" class="" name="task" value="user_change_pass" readonly>


                    <div class="box-footer text-right">
                        <button class="btn btn-primary btn-show-modal-aguarde"><i class="fa fa-floppy-o margin-right-5" aria-hidden="true"></i>Alterar Senha</button>
                    </div><!-- /.box-footer-->

                    <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i> Campos Obrigatórios</div>


                </div><!-- /.tab-pane -->
                <?= form_close(); ?>
                <!-- END ALTERAR SENHA -->


            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
    </div><!-- /.col -->


</div>




