<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--


/*
  Created on : 20/06/2018, 10:58:00
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
                <div class="box-header">
                </div><!-- /.box-header -->

                <div class="box-body margin-left-15">


                    <div class="row">
                        <!--TYPE PROJECT-->

                        <?php
                        $type_project_list = array(
                            'crud' => 'CRUD',
                            'blank' => 'BLANK',
                        );
                        ?>

                        <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                            <?php $_error = form_error("type_project", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                            <div class="form-group has-feedback">
                                <label for="type_project"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Projeto</label>
                                <?= form_dropdown('type_project', $type_project_list, (set_value('type_project') ? set_value('type_project') : "crud"), ' id="type_project" class="form-control"'); ?>
                                <?= $_error; ?>
                            </div>
                        </div>
                        <!--END TYPE PROJECT-->
                    </div>



                    <div class="row">

                        <!--NOME APP-->
                        <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                            <?php $_error = form_error("app_nome", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                            <div class="form-group has-feedback">
                                <label for="app_nome"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Nome do Aplicativo</label>
                                <input type="text" name="app_nome" class="form-control" placeholder="Nome do Aplicativo" value="<?= set_value('app_nome'); ?>" maxlength="250" autofocus/>
                                <?= $_error; ?>
                            </div>
                        </div>
                        <!--END NOME APP-->



                        <!--TITULO DO APLICATIVO-->
                        <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                            <?php $_error = form_error("app_titulo", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                            <div class="form-group has-feedback">
                                <label for="app_titulo"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Título do Aplicativo</label>
                                <input type="text" name="app_titulo" class="form-control" placeholder="Título do Aplicativo" value="<?= set_value('app_titulo'); ?>" maxlength="250" />
                                <?= $_error; ?>
                            </div>
                        </div>
                        <!--END TITULO DO APLICATIVO-->



                        <!--ICONE DO APLICATIVO-->
                        <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                            <label for="app_icone">Icone APP</label>
                            <div class="input-group">
                                <input id="app_icone" type="text" class="form-control" name="app_icone" placeholder="Icone do Aplicativo" value="<?= set_value('app_icone'); ?>" maxlength="50">
                                <div class="input-group-addon btn j-btn-app-icon">
                                    <i class="fa fa-image j-tooltip" data-placement="bottom" data-toggle="tooltip" data-original-title="Icones"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <!--END ICONE DO APLICATIVO-->







                    </div>


                    <div class="row row-table-data">

                        <!--TABELAS-->
                        <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                            <div class="form-group has-feedback">
                                <?php $_error = form_error("tabela", "<small class='text-danger col-xs-12 bz-input-error'>", "</small>"); ?>
                                <div class="form-group has-feedback">
                                    <label for="tabela"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i>Tabela</label>
                                    <select id="tabela" name="tabela" class="form-control select2" data-placeholder="Selecione a Tabela" style="width: 100%;" tabindex="-1" aria-hidden="true" value="" />
                                    <?php
                                    $_c = 0;
                                    if ($_tabelas):
                                        foreach ($_tabelas as $tabela_row):

                                            $_c++;

                                            if ($tabela_row == $this->input->post('tabela')):
                                                echo '<option selected value="' . $tabela_row . '">' . $_c . ' - ' . $tabela_row . '</option>';
                                            else:
                                                if ($_c == 1):
                                                    echo '<option selected value="">Selecione a Tabela...</option>';
                                                endif;

                                                echo '<option value="' . $tabela_row . '">' . $_c . ' - ' . $tabela_row . '</option>';
                                            endif;

                                        endforeach;

                                    endif;
                                    ?>
                                    </select>
                                    <?= $_error; ?>
                                </div>


                            </div>
                        </div>
                        <!--END TABELAS-->


                        <!--PRIMARY KEY-->
                        <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                            <div class="form-group has-feedback">
                                <label for="primary_key">Chave Primária</label>
                                <select id="primary_key" class="form-control" name="primary_key"></select>
                            </div>
                        </div>
                        <!--END PRIMARY KEY-->


                        <!--ORDER BY-->
                        <div class="col-xs-12 col-sm-4 col-md-4 form-group">
                            <div class="form-group has-feedback">
                                <label for="order_by">Campos Order By</label>
                                <input type="text" name="order_by" class="form-control" placeholder="Ex: campo1 ASC, campos2 DESC" value="<?= set_value('order_by'); ?>"/>
                            </div>
                        </div>
                        <!--END ORDER BY-->

                    </div>




                    <!--TABLE FIELDs proj_build_fields-->
                    <div class="row row-table-data">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <h3>Campos</h3>
                            <div class="table-responsive">          
                                <table class="table table-striped table-bordered table-mark-row"">
                                    <thead class="bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>">
                                        <tr>
                                            <th class="text-center" style="width:5px;">#</th>
                                            <th class="text-center" style='width:5px;'>PK</th>
                                            <th>Campo</th>
                                            <th>Tipo</th>
                                            <th>Caracteres</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fields_table">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--END TABLE FIELDs proj_build_fields-->



                    <div class="box-footer text-right">
                        <div class="text-center"><i class="fa fa-asterisk margin-right-5 text-error" style="font-size: 0.7em;"></i> Campos Obrigatórios</div>
                    </div>

                </div>




            </div>

        </div>



    </div>


    <?= form_close(); ?>

    <?php $this->load->view('modalIcons'); ?>



    <script>

        $(function () {

            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var csrfHash = '';

            if (csrfHash === '') {
                csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            }



            $('#type_project').change(function () {

                var _selected = $(this).val()

                if (_selected == 'blank') {
                    $('.row-table-data').hide();
                } else {
                    $('.row-table-data').show();
                }

            });



            $('#primary_key').change(function () {
                var _pk = $(this).val();

                $('.td-pk').each(function (index, element) {

                    $(element).html('');

                    var _field_name = $(element).parent().find('.td-field-name').html();
                    var _field_name_selected = $("#primary_key").val();

                    if (_field_name === _field_name_selected) {
                        $(element).html('<i class="fa fa-fw fa-check text-green"></i>');
                    }

                });

            });



            $("#tabela").change(function () {

                csrfHash = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val();
                $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', '<?php echo $this->security->get_csrf_hash(); ?>');

                var table = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
                var dataString = "table=" + table + "&" + [csrfName] + '=' + csrfHash;

                if (table.length > 0) {
                    $.ajax({/* THEN THE AJAX CALL */
                        type: "POST",
                        url: "<?= site_url('projectbuildcrud/ajax_get_fields_table') ?>",
                        data: dataString,
                        beforeSend: function () {

                            $("#primary_key").html('<option value="">Selecione...</option>');

                        },
                        success: function (result) {

                            var _c = 0;
                            var _body_table = '';

                            jQuery.each(result, function (index, itemData) {

                                _c++;

                                _body_table += "<tr id='" + itemData.field_name + "'>";
                                _body_table += "<td class='text-center' style='width:5px;'>" + _c + "</td>";
                                _body_table += "<td class='td-pk text-center' style='width:5px;'>" + ((itemData.primary_key === 1) ? '<i class="fa fa-fw fa-check text-green"></i>' : '') + "</td>";
                                _body_table += "<td class='td-field-name'>" + itemData.field_name + "</td>";
                                _body_table += "<td>" + itemData.field_type + "</td>";
                                _body_table += "<td>" + itemData.field_length + "</td>";
                                _body_table += "</tr>";


                                if (itemData.primary_key === 1) {
                                    $("#primary_key").append('<option selected value="' + itemData.field_name + '">' + itemData.field_name + '</option>');
                                } else {
                                    $("#primary_key").append('<option value="' + itemData.field_name + '">' + itemData.field_name + '</option>');
                                }

                                if (itemData.csrf_token) {
                                    csrfHash = itemData.csrf_token;
                                }

                                $("input[name='" + [csrfName] + "']").val(csrfHash);

                            });

                            $(".fields_table").html(_body_table);

                        }
                    });
                }

            });




        });




    </script>




