<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--
/*
  Created on : 09/10/2019, 15:06PM
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
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


            </div>
        </div>

        <!--        <div class="col-md-12 col-xs-12 padding-top-5 margin-left-15">
                    <ol class='breadcrumb col-md-12' style="margin-bottom:-10px;">
                        <li><a href='<?= site_url('dashboard'); ?>' target='_top' class='active btn-show-modal-aguarde'><i class='fa fa-dashboard margin-left-5'></i>&nbsp;Dashboard</a></li>
                        <li class='active'><i class='<?= $_font_icon; ?> margin-right-5'></i><?= $_titulo_app; ?></li>
                    </ol>
                </div>-->

    </div>

</section>


<!-- MENSAGEM DO SISTEM -->
<div class="message-toastr"></div>
<?= get_mensagem(); ?>
<!-- END MENSAGEM DO SISTEM -->


<div class='row hide-reload-screen'>

    <div class='box'>

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

                    <!-- INPUT SEARCH -->
                            <input type='text' name='search' value='<?= $this->input->get('search'); ?>' class='form-control input-sm pull-right' style ='width: 150px;' placeholder='Pesquisar' autofocus>
                            <!-- INPUT SEARCH -->

                    <!-- BOTÕES AVULSOS -->
                    <a id="buttons-loose-after-inputsearch" class="pull-right"></a>
                    <!-- BOTÕES AVULSOS -->


                    <div class='input-group-btn '>


                        <!-- BOTÕES AVULSOS -->
                        <a id="buttons-loose-before"></a>
                        <!-- BOTÕES AVULSOS -->


                        <!-- BTN SEARCH -->
                            <button class='btn btn-sm btn-primary btn-show-modal-aguarde j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Pesquisa'><i class='fa fa-search'></i></button>
                            <!-- BTN SEARCH -->

                        <!-- BTN LIMPAR -->
                            <a href='<?= site_url($this->router->fetch_class()); ?>' class='btn btn-sm btn-default btn-show-modal-aguarde j-tooltip' data-placement='bottom' data-toggle='tooltip' data-original-title='Limpar'><i class='glyphicon glyphicon-minus'></i></a>
                            <!-- BTN LIMPAR -->



                        <!-- BOTÕES AVULSOS -->
                        <a id="buttons-loose-after"></a>
                        <!-- BOTÕES AVULSOS -->



                        <!-- BTN ATIVO/INATIVO -->
                        <?php if ('N' == 'Y'): ?>
                            <!-- BTN ATIVO -->
                            <a href='<?= site_url($this->router->fetch_class()); ?>?ativo=Y<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>' class='btn btn-sm btn-success btn-show-modal-aguarde j-tooltip margin-left-10 <?= (strtoupper($this->input->get('ativo', TRUE)) == 'Y') ? 'disabled' : ''; ?>' data-placement='bottom' data-toggle='tooltip' data-original-title='ATIVADO'><i class='fa fa-check-circle-o'></i></a>
                            <!-- BTN ATIVO -->

                            <!-- BTN INATIVO -->
                            <a href='<?= site_url($this->router->fetch_class()); ?>?ativo=N<?= (($this->input->get('search')) ? '&search=' . $this->input->get('search') : ''); ?>' class='btn btn-sm btn-danger btn-show-modal-aguarde j-tooltip <?= (strtoupper($this->input->get('ativo', TRUE)) == 'N') ? 'disabled' : ''; ?>' data-placement='bottom' data-toggle='tooltip' data-original-title='DESATIVADO'><i class='fa fa-circle-o'></i></a>
                            <!-- BTN INATIVO -->
                        <?php endif; ?>                       


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

                        <th class="thClGenero" class="text-left" style="text-align:left">Gênero</th>


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

                        <?php
                            
                        ?>

                        <tr id="<?= $_row['id']; ?>" style="<?= $_style_tr; ?>" class="ClTableGridListTbodyTr <?= $_class_tr; ?>">
                            <!-- MARCA REGISTRO PARA SER DELETADO -->
                            <td class="text-center" style='width:3%;'><input class="checkbox checkbox-unit flat-red text-center" type="checkbox" name="btn-delete[]" value="<?= $_row['id']; ?>"></td>
                            <!-- END MARCA REGISTRO PARA SER DELETADO -->

                            <td class='text-center'  ><?= $_c; ?></td>

                            <!-- CAMPOS DA TABLE -->
                            <td class="tdClGenero" class="text-left" style="text-align:left"><?= $_row["genero"]; ?></td>

                            <!-- CAMPOS DA TABLE -->

                            <!-- BTN ACTION'S -->
                            <td class="tdBtnAction">
                                <!-- BTN EDITA REGISTRO -->
    <?php $_edit = site_url($this->router->fetch_class() . '/edit/' . $_row['id'] . '?' . bz_app_parametros_url()); ?>
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






