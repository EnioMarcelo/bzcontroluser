<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--
/**
  Created on : "{{created-date}}", "{{created-time}}"
  Author     : "{{author-name}}" - "{{author-email}}"
 */
-->


<section class='content-header header-dashboard row' style='margin-top: 0px; margin-left: -15px; margin-bottom: 20px;'>

    <div class="row">


        <div class="col-md-5 col-sm-5 col-xs-12 margin-left-15" style="font-size: 1.8em;">

            <i class='<?= $_font_icon; ?> margin-right-5'></i><?= $_titulo_app; ?>

        </div>


        <div class="col-md-6 col-sm-6 col-xs-12  margin-left-15 btn-group">
            <div class='input-group-btn'>

                <a href='<?= site_url($this->router->fetch_class() . '/add' . '?' . bz_app_parametros_url()); ?>' class='btn btn-sm btn-info btn-show-modal-aguarde margin-right-5' name='btn-add' value='btn-add'>
                    <span class='glyphicon glyphicon-plus'></span> Novo
                </a>

                <button type='button' id='btn-delete' class='btn btn-sm btn-danger disabled margin-right-5' name='btn-del' value='btn-del'>
                    <span class='glyphicon glyphicon-trash'></span> Deleta
                </button>

                <?php if ($_exportReport): ?>
                    <a href='<?= site_url($this->router->fetch_class() . '/export' . '?' . bz_app_parametros_url()); ?>' class='btn btn-sm btn-primary btn-show-modal-aguarde' name='btn-export' value='btn-export'>
                        <span class='glyphicon glyphicon-print'></span> Imprimir
                    </a>
                <?php endif; ?>

                <?php if ($_methodCalendar): ?>
                    <a href='<?= site_url($this->router->fetch_class() . '/calendar' . '?' . bz_app_parametros_url()); ?>' class='btn btn-sm btn-warning btn-show-modal-aguarde margin-left-5' name='btn-calendar' value='btn-calendar'>
                        <span class='glyphicon glyphicon-calendar'></span> Calendário
                    </a>
                <?php endif; ?>


            </div>
        </div>

    </div>

</section>


<!-- MENSAGEM DO SISTEM -->
<div class="message-toastr"></div>
<?= get_mensagem(); ?>
<!-- END MENSAGEM DO SISTEM -->


<div class='row hide-reload-screen'>

    <div class='box <?= bz_box_color(___BZ_LAYOUT_SKINCOLOR___); ?>'>

        <!-- HEADER -->
        <div class='box-header'>
            <h3 class='box-title'></h3>
            <div class='box-tools'>

                <!-- FORM DE PESQUISA -->
                <?= form_open('', 'id="IdFormSearch_' . $this->router->fetch_class() . '" role="form" method="GET"'); ?>
                <div class='input-group margin-top-10'>


                    <!-- BOTÕES AVULSOS -->
                    <a id="buttons-loose-before-inputsearch" class="pull-right"></a>
                    <!-- BOTÕES AVULSOS -->

                    "{{grid-list-input-search}}"

                    <!-- BOTÕES AVULSOS -->
                    <a id="buttons-loose-after-inputsearch" class="pull-right"></a>
                    <!-- BOTÕES AVULSOS -->


                    <div class='input-group-btn "{{grid-list-div-buttons}}"'>


                        <!-- BOTÕES AVULSOS -->
                        <a id="buttons-loose-before"></a>
                        <!-- BOTÕES AVULSOS -->


                        "{{grid-list-button-search}}"

                        "{{grid-list-button-clear}}"


                        <!-- BOTÕES AVULSOS -->
                        <a id="buttons-loose-after"></a>
                        <!-- BOTÕES AVULSOS -->


                    </div>

                </div>
                <?= form_close(); ?>
                <!-- END FORM DE PESQUISA -->

            </div>
        </div><!-- /.box-header -->
        <!-- END HEADER -->



        <!-- CONTEÚDO DA TABLE -->
        <div class='box-body table-responsive no-padding margin-top-20'>


            <!-- TABLE -->
            <table id="IdTableGridList_<?= $this->router->fetch_class(); ?>" class='table table-hover table-striped table-bordered table-mark-row'>

                <!-- HEADER DA TABLE -->
                <thead class='thead-inverse bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>'>
                    <tr id="IdTableGridListTheadTr">
                        <th class='text-center' style='width:3%;'><input class='checkbox-all flat-red' type='checkbox'></th>
                        <th class='text-center' style='width:3%;'>#</th>

                        "{{grid-list-header-table}}"

                        <th class='col-md-1 text-center'>Ação</th>
                    </tr>
                </thead>
                <!-- END HEADER DA TABLE -->

                <!-- DADOS DA TABLE -->
                <tbody>

                    <?php $_c = 0; ?>
                    <?php $_class_tr = ''; ?>
                    <?php $_style_tr = ''; ?>

                    <?php foreach ($_result['results_paginacao_array'] as $_key => $_row): ?> 

                        <?php $_row['btn-action'] = ''; ?>

                        <?php $_c++; ?>
                    
                        <?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row['"{{primary_key_field}}"'] . '?' . bz_app_parametros_url()); ?>

                        <?php
                            "{{grid-list-on-record}}"
                        ?>

                        <tr id="<?= $_row['"{{primary_key_field}}"']; ?>" style="<?= $_style_tr; ?>" class="ClTableGridListTbodyTr <?= $_class_tr; ?>" data-action="<?= $_edit; ?>">
                            <!-- MARCA REGISTRO PARA SER DELETADO -->
                            <td class="text-center" style='width:3%;'><input class="checkbox checkbox-unit flat-red text-center" type="checkbox" name="btn-delete[]" value="<?= $_row['"{{primary_key_field}}"']; ?>"></td>
                            <!-- END MARCA REGISTRO PARA SER DELETADO -->

                            <td class='text-center'><?= $_c; ?></td>

                            <!-- CAMPOS DA TABLE -->
                            "{{grid-list-fields-table}}"
                            <!-- CAMPOS DA TABLE -->

                            <!-- BTN ACTION'S -->
                            <td class="tdBtnAction">
                                <!-- BTN EDITA REGISTRO -->
                                <a href="<?= $_edit; ?>" class="btn btn-xs btn-primary btn-show-modal-aguarde ">
                                    <span class="glyphicon glyphicon-edit j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar"></span>
                                </a>
                                <!-- END BTN EDITA REGISTRO -->

                                <!-- BTN ACTION CUSTOM -->
                                <?php
                                if (!empty($_row['btn-action'])):
                                    echo $_row['btn-action'];
                                endif;
                                ?>
                                <!-- BTN ACTION CUSTOM -->
                            </td>
                            <!-- END BTN ACTION'S -->

                        </tr>

                <?php endforeach; ?>


                </tbody>
                <!-- END DADOS DA TABLE -->


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


    <!--MODAL mc_modal() GRID LIST-->
    <?php
    if (!empty($modalGridList)) {
        echo $modalGridList;
    }
    ?>
    <!--END MODAL mc_modal() GRID LIST-->

</div>


"{{grid-list-scripts-css}}"

"{{grid-list-scripts-js}}"

