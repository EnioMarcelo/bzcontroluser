<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 25/06/2018, 16:18:00
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


<?= form_open(site_url($this->router->fetch_class() . '/edit/' . $dados->id . '?' . bz_app_parametros_url()), 'role="form"'); ?>

<!--BUTTON FIXED GERAR APP-->
<div class="input-group-btn text-right fixa hide" style="z-index:100;" >

    <!-- BTN GERAR APLICAÇÃO-->
    <?php $_buildApp = site_url($this->router->fetch_class() . '/build_app/' . $dados->id . '?' . bz_app_parametros_url()); ?>
    <a class="btn btn-sm bg-purple margin-left-20" data-toggle="modal" data-target="#modalBuildApp" data-build="<?= $_buildApp; ?>" data-width="50%" data-height="350px" data-title="Gerando Aplicação">
        <span class="fa fa-gears j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Gerar"></span>
    </a>
    <!-- END BTN GERAR APLICAÇÃO-->

    <!-- BTN EXECUTAR APLICAÇÃO-->
    <?php $_buildApp = site_url($dados->app_nome); ?>
    <a class="btn btn-sm bg-maroon margin-left-20" data-toggle="modal" data-target="#modalBuildApp" data-build="<?= $_buildApp; ?>" data-width="90%" data-height="500px" data-title="Executando Aplicação">
        <span class="fa fa-external-link-square j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Executar Aplicação"></span>
    </a>
    <!-- END BTN EXECUTAR APLICAÇÃO-->


</div>
<!--END BUTTON FIXED GERAR APP-->


<div class="row">

    <div class="box">

        <!-- HEADER -->
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools">

                <div class="input-group margin-top-10 margin-bottom-0">


                    <div class="input-group-btn text-right">

                        <a href="<?= site_url($this->router->fetch_class()); ?>" class="btn btn-sm btn-default btn-show-modal-aguarde margin-right-5">
                            <span class="fa fa-reply margin-right-5"></span> Voltar
                        </a>

                        <button type="submit" id="btn-editar" class="btn btn-sm btn-primary btn-show-modal-aguarde margin-right-5" name="btn-editar" value="btn-editar">
                            <span class="fa fa-save margin-right-5" aria-hidden="true"></span> Salvar
                        </button>


                        <a href="<?= site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()); ?>" class="btn btn-sm btn-info btn-show-modal-aguarde" name="btn-add" value="btn-add">
                            <span class="glyphicon glyphicon-plus"></span> Novo
                        </a>


                        <!--BUTTON EDIT CODE EVENTOS PHP-->
                        <div class="btn-group margin-left-20">
                            <button type="button" class="btn btn-sm btn-vk btn-flat"><i class="fa fa-fw fa-code"></i> EVENTOS PHP</button>
                            <button type="button" class="btn btn-sm btn-vk btn-flat dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only"></span>
                            </button>

                            <ul class="dropdown-menu" role="menu">
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onScriptInit/evento-php'); ?>"><?= ( (!empty($_eventos_php['fcn_onScriptInit']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onScriptInit</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onBeforeInsert/evento-php'); ?>"><?= ((!empty($_eventos_php['fcn_onBeforeInsert']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onBeforeInsert</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onAfterInsert/evento-php'); ?>"><?= ((!empty($_eventos_php['fcn_onAfterInsert']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onAfterInsert</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onBeforeUpdate/evento-php'); ?>"><?= ((!empty($_eventos_php['fcn_onBeforeUpdate']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onBeforeUpdate</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onAfterUpdate/evento-php'); ?>"><?= ((!empty($_eventos_php['fcn_onAfterUpdate']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onAfterUpdate</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onBeforeDelete/evento-php'); ?>"><?= ((!empty($_eventos_php['fcn_onBeforeDelete']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onBeforeDelete</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onAfterDelete/evento-php'); ?>"><?= ((!empty($_eventos_php['fcn_onAfterDelete']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onAfterDelete</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/onRecord/onrecord'); ?>"><?= ((!empty($_eventos_php['onRecord']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onRecord</a></li>

                                <hr class="separator margin-0 margin-top-10 margin-bottom-10"></li>

                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onScriptInitExport/evento-php'); ?>"><?= ( (!empty($_eventos_php['fcn_onScriptInitExport']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onScriptInitExport</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onScriptBeforeExport/evento-php'); ?>"><?= ( (!empty($_eventos_php['fcn_onScriptBeforeExport']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onBeforeExport</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onScriptAfterExport/evento-php'); ?>"><?= ( (!empty($_eventos_php['fcn_onScriptAfterExport']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onAfterExport</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/fcn_onScriptEndExport/evento-php'); ?>"><?= ( (!empty($_eventos_php['fcn_onScriptEndExport']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onEndExport</a></li>
                                <li class="text-left"><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/onRecordExport/onrecordexport'); ?>"><?= ((!empty($_eventos_php['onRecordExport']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>onRecordExport</a></li>

                            </ul>
                        </div>
                        <!--BUTTON EDIT CODE EVENTOS PHP-->


                        <!--BUTTON EDIT CODE MÉTODOS PHP-->
                        <div class="btn-group margin-left-5" data-url="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id); ?>">
                            <button type="button" class="btn btn-sm btn-bitbucket btn-flat j-btn-add-new-metodo-php"><i class="fa fa-fw fa-code"></i> MÉTODOS PHP</button>
                            <button type="button" class="btn btn-sm btn-bitbucket btn-flat dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="text-center margin-bottom-10" data-url="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id); ?>"><a class="j-btn-add-new-metodo-php"><i class="fa fa-plus"></i>Novo Método</a></li>
                                <li class="border-bottom-1 margin-bottom-5"><span><b>&nbsp;MÉTODOS PHP</b></span></li>
                                <?php foreach ($_metodos_php as $_metodo_php): ?>
                                    <li class="text-center"><a href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/' . $_metodo_php['code_screen'] . '/' . $_metodo_php['code_type']); ?>"><?= $_metodo_php['code_screen']; ?>()</a></li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                        <!--BUTTON EDIT CODE MÉTODOS PHP-->


                        <!--BUTTON EDIT CODE MODELS PHP-->
                        <div class="btn-group margin-left-5" data-url="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id); ?>">
                            <button type="button" class="btn btn-sm btn-primary btn-flat j-btn-add-new-models-php"><i class="fa fa-fw fa-code"></i> MODELS PHP</button>
                            <button type="button" class="btn btn-sm btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="text-center margin-bottom-10" data-url="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id); ?>"><a class="j-btn-add-new-models-php"><i class="fa fa-plus"></i>Novo Model</a></li>
                                <li class="border-bottom-1 margin-bottom-5"><span><b>&nbsp;MODELS PHP</b></span></li>
                                <?php foreach ($_models_php as $_model_php): ?>
                                    <li class="text-center"><a href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/' . $_model_php['code_screen'] . '/' . $_model_php['code_type']); ?>"><?= $_model_php['code_screen']; ?>()</a></li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                        <!--BUTTON EDIT CODE MODELS PHP-->




                        <!-- BTN GERAR APLICAÇÃO-->
                        <?php $_buildApp = site_url($this->router->fetch_class() . '/build_app/' . $dados->id . '?' . bz_app_parametros_url()); ?>
                        <a class="btn btn-sm bg-purple margin-left-20" data-toggle="modal" data-target="#modalBuildApp" data-build="<?= $_buildApp; ?>" data-width="50%" data-height="350px" data-title="Gerando Aplicação">
                            <span class="fa fa-gears j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Gerar"></span>
                        </a>
                        <!-- END BTN GERAR APLICAÇÃO-->

                        <!-- BTN EXECUTAR APLICAÇÃO-->
                        <?php $_buildApp = site_url($dados->app_nome); ?>
                        <a class="btn btn-sm bg-maroon margin-left-20" data-toggle="modal" data-target="#modalBuildApp" data-build="<?= $_buildApp; ?>" data-width="90%" data-height="500px" data-title="Executando Aplicação">
                            <span class="fa fa-external-link-square j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Executar Aplicação"></span>
                        </a>
                        <!-- END BTN EXECUTAR APLICAÇÃO-->





                    </div>

                </div>

            </div>
        </div><!-- /.box-header -->
        <!-- END HEADER -->

        <div class="box-body no-padding padding-left-10 padding-right-10 padding-bottom-10 margin-top-0">

            <div class="margin-top-0 padding-top-0">
                <div class="box-header">
                </div><!-- /.box-header -->

                <!-- .box-sucess -->
                <div class="box box-success collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados do APP</h3><p></p>

                        <!-- Dados do APP -->
                        <div class="form-group has-feedback col-xs-12" style="font-size: 1.3em; padding-right: 0;">
                            <label for="id">ID : <span class="" ><spam class="text-normal"><?= $dados->id; ?></span></label>
                            <label for="app_nome" class="margin-left:5px"> | Nome Aplicativo : <span class="" ><spam class="text-normal"><?= $dados->app_nome; ?></span></span></label>
                            <label for="tabela" class="margin-left:5px"> | Tabela : <span class="" ><spam class="text-normal"><?= $dados->tabela; ?></span></span></label>
                            <span class="padding-left-20">



                            </span>
                        </div>
                        <!-- END Dados do APP -->

                        <div class="box-tools bg-blue-gradient pull-right">
                            <button type="button" style="color:white; padding: 3px 8px 3px 8px; align-content: center" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body margin-left-10">
                        <div class="row">

                            <!--NOME APP-->
                            <div class="col-xs-12 col-sm-4 col-md-4 form-group hide">
                                <div class="form-group has-feedback">
                                    <label for="app_nome">Nome do Aplicativo</label>
                                    <input type="hidden" name="app_nome" class="form-control" placeholder="Nome do Aplicativo" value="<?= $dados->app_nome; ?>" maxlength="250" disabled/>
                                </div>
                            </div>
                            <!--END NOME APP-->


                            <!--TITULO DO APLICATIVO-->
                            <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                <?php $_error = form_error("app_titulo", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                <div class="form-group has-feedback">
                                    <label for="app_titulo"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Título do APP</label>
                                    <input type="text" name="app_titulo" class="form-control" placeholder="Título do APP" value="<?= (set_value('app_titulo')) ? set_value('app_titulo') : $dados->app_titulo; ?>" maxlength="250" />
                                    <?= $_error; ?>
                                </div>
                            </div>
                            <!--END TITULO DO APLICATIVO-->



                            <!--ICONE DO APLICATIVO-->
                            <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                                <label for="menu_icon">Icone APP</label>
                                <div class="input-group">
                                    <input id="app_icone" type="text" name="app_icone" class="form-control" placeholder="Icone do Aplicativo" value="<?= (set_value('app_icone')) ? set_value('app_icone') : $dados->app_icone; ?>" maxlength="50" />
                                    <div class="input-group-addon btn j-btn-app-icon">
                                        <i class="fa fa-image j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Icones"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>
                            <!--END ICONE DO APLICATIVO-->



                            <!--TABELAS-->
                            <div class="col-xs-12 col-sm-4 col-md-4 form-group hide">
                                <div class="form-group has-feedback">
                                    <label for="tabela">Tabela</label>
                                    <input type="hidden" name="tabela" class="form-control" placeholder="Tabela" value="<?= $dados->tabela; ?>" maxlength="250" disabled />
                                </div>
                            </div>
                            <!--END TABELAS-->

                            <!--PRIMARY KEY-->
                            <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                                <div class="form-group has-feedback">
                                    <label for="primary_key">Chave Primária</label>
                                    <select id="primary_key" class="form-control" name="primary_key">

                                        <?php
                                        foreach ($_fields_table_gridlist['_result'] as $_row_field_table_gridlist):
                                            echo '<option ' . ($_row_field_table_gridlist['primary_key'] == 1 ? 'selected' : '') . '  value="' . $_row_field_table_gridlist['field_name'] . '">' . $_row_field_table_gridlist['field_name'] . '</option>';
                                        endforeach;
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <!--END PRIMARY KEY-->

                            <!--ORDER BY-->
                            <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                                <div class="form-group has-feedback">
                                    <label for="order_by">Campos Order By</label>
                                    <input type="text" name="order_by" class="form-control" placeholder="Ex: campo1 ASC, campos2 DESC" value="<?= (set_value('order_by')) ? set_value('order_by') : $dados->order_by; ?>"/>
                                </div>
                            </div>
                            <!--END ORDER BY-->



                        </div>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box-success -->



                <!-- Table Grid List / Form Add/EDIT -->
                <div class="box box-info">
                    <div class="box-body margin-left-10">

                        <!--TABLE FIELDs proj_build_fields-->
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <ul class="nav nav-pills">
                                    <li class="<?= ($this->input->get('tab') == 'gridlist') ? 'active' : ((empty($this->input->get('tab'))) ? 'active' : null); ?>"><a data-toggle="pill" href="#gridlist">Grid List</a></li>
                                    <li class="<?= ($this->input->get('tab') == 'formaddedit') ? 'active' : null; ?>"><a data-toggle="pill" href="#gridformaddedit">Form ADD/EDIT</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="gridlist" class="tab-pane fade <?= ($this->input->get('tab') == 'gridlist') ? 'in active' : ((empty($this->input->get('tab'))) ? 'in active' : null); ?>">

                                        <!--BUTTON EDIT CODE CSS/JQUERY-->
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn btn-info j_btn_modal_add_fields_table_gridlist margin-right-10" rel-projeto-id='<?= $dados->id; ?>'><span class="glyphicon glyphicon-plus"></span> Campo Virtual</button>

                                            <button type="button" class="btn btn-default btn-flat"><i class="fa fa-fw fa-code"></i> GRID LIST SCRIPTS</button>
                                            <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/gridlist/css?tab=gridlist'); ?>"><?= ( (!empty($_gridlist_css['code_script']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>CSS</a></li>
                                                <li><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/gridlist/jquery?tab=gridlist'); ?>"><?= ( (!empty($_gridlist_jquery['code_script']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>jQuery</a></li>
                                            </ul>
                                        </div>
                                        <!--BUTTON EDIT CODE CSS/JQUERY-->



                                        <h3>Campos GRID LIST</h3>
                                        <div class="table-responsive">          
                                            <table id="tableGridlist" class="table table-striped table-bordered table-mark-row">
                                                <thead class="bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>">
                                                    <tr>
                                                        <th class="text-center" style="width:5px;">#</th>
                                                        <th class="text-center" style="width:5px;"><span class="label label-default text-center mouse-cursor-pointer j-tooltip" tabindex="0" data-placement="top" data-toggle="tooltip" data-original-title="Status dos Campos">S</span></th>
                                                        <th class="text-center" style="width:5px;"><span class="label label-default text-center mouse-cursor-pointer j-tooltip" tabindex="0" data-placement="top" data-toggle="tooltip" data-original-title="Pesquisa dos Campos">P</span></th>
                                                        <th class="text-center" style="width:5px;"><span class="label label-default text-center mouse-cursor-pointer j-tooltip" tabindex="0" data-placement="top" data-toggle="tooltip" data-original-title="Exportar/Imprimir">E</span></th>
                                                        <th class="text-center" style="width:5px;"><span class="label label-default text-center mouse-cursor-pointer j-tooltip" tabindex="0" data-placement="top" data-toggle="tooltip" data-original-title="Ordenação dos Campos">O</span></th>
                                                        <th>Campo</th>
                                                        <th>Caracteres</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fields_table">
                                                    <?php
                                                    $_c = 0;

                                                    foreach ($_fields_table_gridlist['_result'] as $_row_field_table_gridlist):

                                                        $_c++;

                                                        $_json = json_decode($_row_field_table_gridlist['param_gridlist']);
                                                        $_bg_color_grid_list_show = ($_json->grid_list_show == 'off') ? 'font-color-gray-light' : '';
                                                        $_btn_switch_grid_list_show = ($_json->grid_list_show == 'off') ? 'fa-toggle-off' : 'fa-toggle-on text-green';

                                                        $_bg_color_grid_list_search = ($_json->grid_list_search == 'off') ? 'font-color-gray-light' : '';
                                                        $_btn_switch_grid_list_search = ($_json->grid_list_search == 'off') ? 'fa-toggle-off' : 'fa-toggle-on text-green';

                                                        if (!empty($_json->grid_list_export)) {
                                                            $_bg_color_grid_list_export = ($_json->grid_list_export == 'off') ? 'font-color-gray-light' : '';
                                                            $_btn_switch_grid_list_export = ($_json->grid_list_export == 'off') ? 'fa-toggle-off' : 'fa-toggle-on text-green';
                                                        }else{
                                                            
                                                            $_json->grid_list_export = 'font-color-gray-light' ;
                                                            $_btn_switch_grid_list_export = 'fa-toggle-off';
                                                            
                                                        }


                                                        //SE O CAMPO FOR VIRTUAL HABILITA O BOTÃO DE DELETAR O CAMPO
                                                        if (!empty($_json->grid_list_field_type) && $_json->grid_list_field_type == 'virtual'):
                                                            $_grid_list_field_type_trash_icon = '<small class="label margin-left-5 bg-red j-tooltip j-btn-delete-virtual-field" data-placement="bottom" data-toggle="tooltip" data-original-title="Deletar Campo" rel-field-name="' . $_row_field_table_gridlist['field_name'] . '"><i class="fa fa-fw fa-trash text-whrite"></i></small>';
                                                        else:
                                                            $_grid_list_field_type_trash_icon = '';
                                                        endif;

                                                        echo "<tr id='" . $_row_field_table_gridlist['field_name'] . "' rel-projeto-id='" . $dados->id . "' rel-primary-key='" . $_row_field_table_gridlist['primary_key'] . "' class='j_drag_active_gridlist mouse-cursor-pointer " . $_bg_color_grid_list_show . "' />";
                                                        echo "<td class='text-center table-line-order' style='width:5px;'>" . $_c . "</td>";
                                                        echo "<td><i class='fa fa-fw {$_btn_switch_grid_list_show} j-btn-switch-list-show-field' rel-screen-type='gridlist'></i></td>";
                                                        echo "<td><i class='fa fa-fw {$_btn_switch_grid_list_search} j-btn-switch-list-search-field' rel-screen-type='gridlist'></i></td>";
                                                        echo "<td><i class='fa fa-fw {$_btn_switch_grid_list_export} j-btn-switch-list-export-field' rel-screen-type='gridlist'></i></td>";
                                                        echo "<td class='text-center j_order_gridlist' style='width:5px;'><i class='fa fa-arrows'></i></td>";
                                                        echo "<td class='j_btn_modal_edit_fields_table_gridlist btn-show-modal-aguarde'>" . $_row_field_table_gridlist['field_name'] . $_grid_list_field_type_trash_icon . (($_row_field_table_gridlist['primary_key'] == 1) ? '<small class="label margin-left-5 bg-green j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Chave Primária"><i class="fa fa-fw fa-key text-whrite"></i></small>' : '') . "</td>";
                                                        echo "<td class='j_btn_modal_edit_fields_table_gridlist btn-show-modal-aguarde'>" . $_row_field_table_gridlist['field_length'] . "</td>";
                                                        echo "</tr>";


                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div id="gridformaddedit" class="tab-pane fade <?= ($this->input->get('tab') == 'formaddedit') ? 'in active' : null; ?>">
                                        <!--BUTTON EDIT CODE CSS/JQUERY-->
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn btn-default btn-flat"><i class="fa fa-fw fa-code"></i> FORM SCRIPTS</button>
                                            <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="border-bottom-1"><span><b>FORM ADD</b></span></li>
                                                <li><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/formadd/css?tab=formaddedit'); ?>"><?= ( (!empty($_formadd_css_jquery['css']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>CSS</a></li>
                                                <li><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/formadd/jquery?tab=formaddedit'); ?>"><?= ( (!empty($_formadd_css_jquery['jquery']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>jQuery</a></li>

                                                <br/>

                                                <li class="border-bottom-1"><span><b>FORM EDIT</b></span></li>
                                                <li><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/formedit/css?tab=formaddedit'); ?>"><?= ( (!empty($_formedit_css_jquery['css']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>CSS</a></li>
                                                <li><a class="padding-left-5" href="<?= site_url($this->router->fetch_class() . '/codeeditor/' . $dados->id . '/formedit/jquery?tab=formaddedit'); ?>"><?= ( (!empty($_formedit_css_jquery['jquery']) ) ? '<i class="fa fa-fw fa-check-square-o color_blue margin-right-5"></i>' : '<i class="fa fa-fw margin-right-5"></i>'); ?>jQuery</a></li>
                                            </ul>
                                        </div>
                                        <!--BUTTON EDIT CODE CSS/JQUERY-->



                                        <h3>Campos Form ADD/EDIT</h3>
                                        <div class="table-responsive">          
                                            <table id="tableGridlistFormAddEdit" class="table table-striped table-bordered table-mark-row">
                                                <thead class="ENIO bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>">
                                                    <tr>
                                                        <th class="text-center" style="width:5px;">#</th>
                                                        <th class="text-center" style="width:5px;"><span class="label label-default text-center mouse-cursor-pointer j-tooltip" tabindex="0" data-placement="top" data-toggle="tooltip" data-original-title="Status dos Campos<br/>Ativo ou Inativo">S</span></th>
                                                        <th class="text-center" style="width:5px;"><span class="label label-default text-center mouse-cursor-pointer j-tooltip" tabindex="0" data-placement="top" data-toggle="tooltip" data-original-title="Ordenação dos Campos">O</span></th>
                                                        <th>Campo</th>
                                                        <th>Caracteres</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fields_table_formaddedit">
                                                    <?php
                                                    $_c = 0;

                                                    foreach ($_fields_table_formAddEdit['_result'] as $_row_field_table_formAddEdit):

                                                        $_c++;

                                                        $_json = json_decode($_row_field_table_formAddEdit['param_formaddedit']);
                                                        $_bg_color_grid_list_show = ($_json->form_add_edit_field_show == 'off') ? 'font-color-gray-light' : '';
                                                        $_btn_switch_form_add_edit_field_show = ($_json->form_add_edit_field_show == 'off') ? 'fa-toggle-off' : 'fa-toggle-on text-green';

                                                        echo "<tr id='" . $_row_field_table_formAddEdit['field_name'] . "' rel-projeto-id='" . $dados->id . "' rel-primary-key='" . $_row_field_table_formAddEdit['primary_key'] . "' class='j_drag_active_gridlist_formAddEdit mouse-cursor-pointer " . $_bg_color_grid_list_show . "' />";
                                                        echo "<td class='j_btn_modal_edit_fields_table_formaddedit btn-show-modal-aguarde text-center table-line-order' style='width:5px;'>" . $_c . "</td>";
                                                        echo "<td><i class='fa fa-fw {$_btn_switch_form_add_edit_field_show} j-btn-switch-list-show-field' rel-screen-type='formaddedit'></i></td>";
                                                        echo "<td class='text-center j_order_gridlist_formAddEdit' style='width:5px;'><i class='fa fa-arrows'></i></td>";
                                                        echo "<td class='j_btn_modal_edit_fields_table_formaddedit btn-show-modal-aguarde'>" . $_row_field_table_formAddEdit['field_name'] . (($_row_field_table_formAddEdit['primary_key'] == 1) ? '<small class="label margin-left-5 bg-green j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Chave Primária"><i class="fa fa-fw fa-key text-whrite"></i></small>' : '') . "</td>";
                                                        echo "<td>" . $_row_field_table_formAddEdit['field_length'] . "</td>";
                                                        echo "</tr>";


                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>






                            </div>
                        </div>
                        <!--END TABLE FIELDs proj_build_fields-->



                        <input type="hidden" name="id" value="<?= (set_value('id')) ? set_value('id') : $dados->id; ?>" readonly/>
                        <input type="hidden" class="" name="task" value="edit-app" readonly/>


                        <div class="box-footer text-right">

                            <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i> Campos Obrigatórios</div>

                        </div>

                    </div>
                </div>
                <!-- END Table Grid List / Form Add/EDIT -->




            </div>

        </div>


    </div>


    <?= form_close(); ?>

    <?php $this->load->view('modalBuildApp'); ?>

    <?php $this->load->view('modalIcons'); ?>

    <?php $this->load->view('modalEditFieldTableGridList'); ?>

    <?php $this->load->view('modalEditFieldTableFormAddEdit'); ?>




    <script>

        $(function () {

            $(window).scroll(function () {

                var _s = $(window).scrollTop();

                if (_s > 140) {
                    $('.fixa').css({"top": $(window).scrollTop() - 50});
                    $('.fixa').removeClass('hide');
                } else {
                    $('.fixa').addClass('hide');
                }

            });


            /**
             * REORDER LINE GRID LIST
             */
            $('html').on('mouseenter', '.j_order_gridlist', function () {

                $(this).css({'cursor': 'move'});

                $('.j_drag_active_gridlist').attr('draggable', 'true');

                $('html').on('drag', '.j_drag_active_gridlist', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    dragIndexGridList = $(this).index();
                    dragContentGridList = $(this);

                });

                $('html').on('dragover', '.j_drag_active_gridlist', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    $(this).css('border', '2px dashed #ccc');

                });

                $('html').on('dragleave', '.j_drag_active_gridlist', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    $(this).css('border', 'none');
                    $(this).css({'cursor': 'pointer'});

                });

                $('html').on('drop', '.j_drag_active_gridlist', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    dropElementGridList = $(this);

                    $(this).css('border', 'none');

                    if (dragIndexGridList > dropElementGridList.index()) {
                        dropElementGridList.before(dragContentGridList);
                    } else {
                        dropElementGridList.after(dragContentGridList);
                    }


                    var _c = 0;
                    $('#tableGridlist > tbody tr').each(function () {

                        _c++;

                        $(this).find("td:first").text(_c);
                        var _r = $(this).find("td:first").text();
                        var _projeto_id = $(this).parent().find('tr:first').attr('rel-projeto-id');
                        var _field_name = $(this).find("td:eq(5)").text();
                        var _screen_type = $(this).parent().parent().attr('id');

                        if (_screen_type === 'tableGridlist') {
                            _screen_type = 'gridlist';
                        } else {
                            _screen_type = '';
                        }

                        $.ajax({
                            type: "POST",
                            url: "<?= site_url($this->router->fetch_class() . '/reorder_linegridlist'); ?>",
                            data: {'task': 'SAVE-REORDER-GRID-LIST', 'screen_type': _screen_type, 'projeto_id': _projeto_id, 'field_name': _field_name, 'order_field_gridlist': _r},
                            dataType: "json",
                            beforeSend: function () {


                            }, //END beforeSend
                            success: function (result) {

                                if (result.message === 'SAVE-REORDER-FIELDS-GRIDLIST-OK') {
                                    /**/
                                } else {

                                    $.toast({
                                        heading: 'ATENÇÃO !!!',
                                        text: 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.',
                                        position: 'top-center',
                                        icon: 'error'
                                    });

                                }



                            }, //END success
                            complete: function () {

                                parent.$('#modal-aguarde').modal('hide');

                            }, //END complete
                            error: function () {
                                $.toast({
                                    heading: 'ATENÇÃO !!!',
                                    text: 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.',
                                    position: 'top-center',
                                    icon: 'error'
                                });
                            }//END error
                        }); //END AJAX



                    });// END $('table tbody tr').each()

                    $(dragContentGridList).fadeTo('slow', 0.5).fadeTo('slow', 1.0).fadeTo('slow', 0.5).fadeTo('slow', 1.0);

                });



            });


            $('html').on('mouseleave', '.j_order_gridlist', function () {
                $('.j_drag_active_gridlist').removeAttr('draggable');
                $('html').unbind('drag dragover dragleave drop');
            });
            // END REORDER LINE GRID LIST



            /**
             * REORDER LINE GRID LIST FORM ADD/EDIT
             */
            $('html').on('mouseenter', '.j_order_gridlist_formAddEdit', function () {

                $(this).css({'cursor': 'move'});

                $('.j_drag_active_gridlist_formAddEdit').attr('draggable', 'true');

                $('html').on('drag', '.j_drag_active_gridlist_formAddEdit', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    dragIndexGridList = $(this).index();
                    dragContentGridList = $(this);

                });

                $('html').on('dragover', '.j_drag_active_gridlist_formAddEdit', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    $(this).css('border', '2px dashed #ccc');

                });

                $('html').on('dragleave', '.j_drag_active_gridlist_formAddEdit', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    $(this).css('border', 'none');
                    $(this).css({'cursor': 'pointer'});

                });

                $('html').on('drop', '.j_drag_active_gridlist_formAddEdit', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    dropElementGridList = $(this);

                    $(this).css('border', 'none');

                    if (dragIndexGridList > dropElementGridList.index()) {
                        dropElementGridList.before(dragContentGridList);
                    } else {
                        dropElementGridList.after(dragContentGridList);
                    }

                    var _c = 0;

                    $('#tableGridlistFormAddEdit > tbody tr').each(function () {

                        _c++;

                        $(this).find("td:first").text(_c);
                        var _r = $(this).find("td:first").text();
                        var _projeto_id = $(this).parent().find('tr:first').attr('rel-projeto-id');
                        var _field_name = $(this).find("td:eq(3)").text();
                        var _screen_type = $(this).parent().parent().attr('id');

                        if (_screen_type === 'tableGridlistFormAddEdit') {
                            _screen_type = 'formaddedit';
                        } else {
                            _screen_type = '';
                        }

                        $.ajax({
                            type: "POST",
                            url: "<?= site_url($this->router->fetch_class() . '/reorder_linegridlist'); ?>",
                            data: {'task': 'SAVE-REORDER-GRID-LIST-FORM-ADD-EDIT', 'screen_type': _screen_type, 'projeto_id': _projeto_id, 'field_name': _field_name, 'order_field_form': _r},
                            dataType: "json",
                            beforeSend: function () {


                            }, //END beforeSend
                            success: function (result) {

                                if (result.message === 'SAVE-REORDER-FIELDS-GRIDLIST-OK') {
                                    /**/
                                } else {

                                    $.toast({
                                        heading: 'ATENÇÃO !!!',
                                        text: 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.',
                                        position: 'top-center',
                                        icon: 'error'
                                    });

                                }

                            }, //END success
                            complete: function () {

                                parent.$('#modal-aguarde').modal('hide');

                            }, //END complete
                            error: function () {
                                $.toast({
                                    heading: 'ATENÇÃO !!!',
                                    text: 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.',
                                    position: 'top-center',
                                    icon: 'error'
                                });
                            }//END error
                        }); //END AJAX



                    });// END $('table tbody tr').each()


                    $(dragContentGridList).fadeTo('slow', 0.5).fadeTo('slow', 1.0).fadeTo('slow', 0.5).fadeTo('slow', 1.0);

                });



            });


            $('html').on('mouseleave', '.j_order_gridlist_formAddEdit', function () {
                $('.j_drag_active_gridlist_formAddEdit').removeAttr('draggable');
                $('html').unbind('drag dragover dragleave drop');
            });
            // END REORDER LINE GRID LIST FORM ADD/EDIT


            /**
             * BUTTON SWITCH STATUS FIELD
             */
            $(".j-btn-switch-list-show-field").click(function () {

                var _c = $(this).hasClass("fa-toggle-off");
                var _screen_type = $(this).attr('rel-screen-type');

                if (_screen_type === 'gridlist') {
                    var _field_name = $(this).closest("td").next().next().next().next().text();
                } else if (_screen_type === 'formaddedit') {
                    var _field_name = $(this).closest("td").next().next().text();
                }

                var _switch = '';

                if (_c) {
                    $(this).removeClass("fa-toggle-off").addClass("text-green").addClass("fa-toggle-on").parent().parent().removeClass("font-color-gray-light");
                    _switch = 'on';
                } else {
                    $(this).removeClass("fa-toggle-on").removeClass("text-green").addClass("fa-toggle-off").parent().parent().addClass("font-color-gray-light");

                    if (_screen_type == 'gridlist') {
                        $(this).parent().next().children().removeClass("fa-toggle-on").removeClass("text-green").addClass("fa-toggle-off").parent().parent().addClass("font-color-gray-light");
                        $(this).parent().next().next().children().removeClass("fa-toggle-on").removeClass("text-green").addClass("fa-toggle-off").parent().parent().addClass("font-color-gray-light");
                    }

                    _switch = 'off';
                }


                $.post("<?= site_url($this->router->fetch_class() . '/switch_show_field_on_off'); ?>",
                        {
                            task: "SAVE-SWITCH",
                            screen_type: _screen_type,
                            project_id: "<?= $dados->id; ?>",
                            field_name: _field_name,
                            grid_list_show: _switch

                        },
                        function (data, status) {

                            if (data.message === 'SAVE-SWITCH-OK') {
                            } else {
                                $.toast({
                                    heading: 'ATENÇÃO !!!',
                                    text: 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.',
                                    position: 'top-center',
                                    icon: 'error'
                                });
                            }

                        }, 'json');

            });
            /**
             * END BUTTON SWITCH STATUS FIELD
             */


            /**
             * BUTTON SWITCH SEARCH FIELD
             */
            $(".j-btn-switch-list-search-field").click(function () {

                var _c = $(this).hasClass("fa-toggle-off");
                var _field_name = $(this).closest("td").next().next().next().text();
                var _screen_type = $(this).attr('rel-screen-type');
                var _switch = '';

                var _t = $(this).parent().prev().children().hasClass("fa-toggle-off");
                if (_t) {
//                    return false;
                }

                if (_c) {
                    $(this).removeClass("fa-toggle-off").addClass("text-green").addClass("fa-toggle-on").parent().parent().removeClass("font-color-gray-light");
                    _switch = 'on';
                } else {
                    $(this).removeClass("fa-toggle-on").removeClass("text-green").addClass("fa-toggle-off");
                    _switch = 'off';
                }


                $.post("<?= site_url($this->router->fetch_class() . '/switch_search_field_on_off'); ?>",
                        {
                            task: "SAVE-SWITCH",
                            screen_type: _screen_type,
                            project_id: "<?= $dados->id; ?>",
                            field_name: _field_name,
                            grid_list_search: _switch

                        },
                        function (data, status) {

                            if (data.message === 'SAVE-SWITCH-OK') {
                            } else {
                                $.toast({
                                    heading: 'ATENÇÃO !!!',
                                    text: 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.',
                                    position: 'top-center',
                                    icon: 'error'
                                });
                            }

                        }, 'json');

            });
            /**
             * END BUTTON SWITCH SEARCH FIELD
             */



            /**
             * BUTTON SWITCH EXPORT FIELD
             */
            $(".j-btn-switch-list-export-field").click(function () {

                var _c = $(this).hasClass("fa-toggle-off");
                var _field_name = $(this).closest("td").next().next().text();
                var _screen_type = $(this).attr('rel-screen-type');
                var _switch = '';

                var _t = $(this).parent().prev().children().hasClass("fa-toggle-off");
                if (_t) {
//                    return false;
                }

                if (_c) {
                    $(this).removeClass("fa-toggle-off").addClass("text-green").addClass("fa-toggle-on").parent().parent().removeClass("font-color-gray-light");
                    _switch = 'on';
                } else {
                    $(this).removeClass("fa-toggle-on").removeClass("text-green").addClass("fa-toggle-off");
                    _switch = 'off';
                }


                $.post("<?= site_url($this->router->fetch_class() . '/switch_export_field_on_off'); ?>",
                        {
                            task: "SAVE-SWITCH",
                            screen_type: _screen_type,
                            project_id: "<?= $dados->id; ?>",
                            field_name: _field_name,
                            grid_list_export: _switch

                        },
                        function (data, status) {

                            if (data.message === 'SAVE-SWITCH-OK') {
                            } else {
                                $.toast({
                                    heading: 'ATENÇÃO !!!',
                                    text: 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.',
                                    position: 'top-center',
                                    icon: 'error'
                                });
                            }

                        }, 'json');

            });
            /**
             * END BUTTON SWITCH EXPORT FIELD
             */




            //ADD NEW METODO PHP
            $(".j-btn-add-new-metodo-php").click(function () {

                $(document).keydown(function (e) {
                    if (e.keyCode == 32) {
                        return false;
                    }
                });

                var _url = $(this).parent().attr("data-url");
                var _xmetodo = '';


                swal({
                    title: 'Método PHP',
                    text: 'Método',

                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "Digite o Nome do Método PHP Aqui...",
                            type: "text",
                        },

                    },
                    button: {
                        text: "Novo",
                        closeModal: false,
                    },

                }).then(_metodophp => {
                    if (!_metodophp) {
                        swal.stopLoading();
                        swal.close();
//                        swal("Opss!", "Favor Informar o Nome do Método PHP", "warning");
                        return false;
                    }

                    var _xmetodo = _metodophp.replace(/[^A-Za-z0-9_]+/g, '');
                    _url = _url + '/fcn_' + _xmetodo + '/metodo-php';

                    window.location = _url;



                });





            });



            //ADD NEW MODELS PHP
            $(".j-btn-add-new-models-php").click(function () {

                $(document).keydown(function (e) {
                    if (e.keyCode == 32) {
                        return false;
                    }
                });

                var _url = $(this).parent().attr("data-url");
                var _xmodel = '';


                swal({
                    title: 'Model PHP',
                    text: 'Model',

                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "Digite o Nome do Model PHP Aqui...",
                            type: "text",
                        },

                    },
                    button: {
                        text: "Novo",
                        closeModal: false,
                    },

                }).then(_modelphp => {
                    if (!_modelphp) {
                        swal.stopLoading();
                        swal.close();
//                        swal("Opss!", "Favor Informar o Nome do Método PHP", "warning");
                        return false;
                    }

                    var _xmodel = _modelphp.replace(/[^A-Za-z0-9_]+/g, '');
                    _url = _url + '/fcn_' + _xmodel + '/model-php';
                    window.location = _url;

                });





            });



        });

    </script>



