<style>

    /* EFEITO FADE IN */
    @keyframes fadeIn {
        0% {
            transform: scale(1);
            opacity: 0;
        }
    }

    /* MODAL */
    .bz_modal{
        display: block;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        z-index: 98;

    }

    .bz_modal_box{
        z-index: 99;
        display: flex;
        position: relative;
        width: 90%;
        max-width: 90%;
        height: 90%;
        max-width: 90%;
        /*background: rgba(255,255,255,0.3);*/
        margin: 3% auto;
        /*padding: 10px;*/
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;

        animation-duration: 1s;
        animation-name: fadeIn;




    }

    .bz_modal_box_close{
        position: absolute;
        top: -8px;
        right: -8px;
        font-size: 0.9em;
        font-weight: bold;
        padding: 7px 11px;
        cursor: pointer;
        background: #000;
        border: 2px double #ccc;
        border-radius: 50%;
        -moz-border-radius:  50%;
        -webkit-border-radius:  50%;
        z-index: 99;

    }

    .bz_modal_box_close:hover{
        background: #999999;
        color: black;
    }

    .bz_modal_box .header{
        padding: 0px;
        color: #fff;
        /*text-align: center;*/
        border-radius: 3px 3px 0 0;
        -moz-border-radius: 3px 3px 0 0;
        -webkit-border-radius: 3px 3px 0 0;
    }

    .bz_modal_box .header p{
        font-weight: 500;
        font-size: 1.5em;
        text-shadow: 1px 1px 0 #555;
    }

    .bz_modal_box #bz_modal_content{
        padding: 0px;
        background: #fff;
        border-radius: 0 0 3px 3px;
        -moz-border-radius: 0 0 3px 3px;
        -webkit-border-radius: 0 0 3px 3px;
    }

    #bz_modal_content {
        width: 100%;
        text-align: center;
        box-sizing: border-box;

    }
    #bz_modal_content *{
        box-sizing: border-box; 
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }

    #bz_modal_content img, #bz_modal_content iframe{
        max-width: 100%;
        width: 100%;
        height: 100%;
        max-height: 100%;
    }

    /* CORES */
    .color_blue{color: #0E96E5;}
    .color_green{color: #56b748;}
    .color_yellow{color: #F2AA27;}
    .color_red{color: #F43E33;}
    .color_purple{color: #7551CD;}
    .color_pink{color: #B873CD;}

    .bg_blue{background-color: #0E96E5;}
    .bg_green{background-color: #56b748;}
    .bg_yellow{background-color: #F2AA27;}
    .bg_red{background-color: #F43E33;}
    .bg_purple{background-color: #7551CD;}
    .bg_pink{background-color: #B873CD;}

    #modal-btn-edit-field-table-gridlist{ display:none; }

    #bz_modal_content iframe {
        display: flex;
        height: 100%;
        max-height: 100%;

    }

</style>



<!--MODAL EDIT CAMPOS DA GRID LIST DO APP-->
<div id="modal-btn-edit-field-table-gridlist" class="bz_modal">

    <div class="bz_modal_box">

        <div class="header bz_modal_box_close j_btn_modal_box_close">
            <span class="bz_modal_box_close j_btn_modal_box_close">X</span>
        </div>

        <div id="bz_modal_content">

            <div class="content">
                <h4 style="margin-top:0 !important; margin-bottom:10 !important;">Grid List</h4>

                <h3 class="border-bottom-1 padding-bottom-10 margin-top-0" >Editando Campo : <i id="modal_field_name" style="font-weight: 200"></i></h3>

                <div id="gridlist" class="tab-pane fade in active text-left">

                    <?= form_open($this->router->fetch_class() . '/setup_gridlist', 'id="formGridList" class="col-md-12 margin-left-0 padding-left-0 margin-right-0 padding-right-0" role="form"'); ?>

                    <input type="hidden" name="task" value="save">
                    <input type="hidden" name="projeto_id" value="">
                    <input type="hidden" name="field_name" value="">
                    <input type="hidden" name="screen_type" value="">
                    <input type="hidden" name="grid_list_field_type" value="">


                    <div class="row margin-left-0 padding-left-0 margin-right-0 padding-right-0 margin-top-20">

                        <!--COLUNA 1-->
                        <div class="col-md-4 margin-left-0 padding-left-0">


                            <div class="col-md-4" >
                                <label>Exibir:</label>
                                <div class="form-group">
                                    <label class="margin-right-15 text-normal">
                                        SIM
                                        <input type="radio" id="grid_list_show_on" name="grid_list_show" class="flat-green" value="on">
                                    </label>
                                    <label class="text-normal">
                                        NÃO 
                                        <input type="radio" id="grid_list_show_off" name="grid_list_show" class="flat-red hover checked" aria-checked="true" value="off">
                                    </label>
                                </div>
                            </div>


                            <div id="grid_list_search" class="col-md-4">
                                <label>Pesquisar:</label>
                                <div class="form-group">
                                    <label class="margin-right-15 text-normal">
                                        SIM
                                        <input type="radio" id="grid_list_search_on" name="grid_list_search" class="flat-green" checked="" value="on">
                                    </label>
                                    <label class="text-normal">
                                        NÃO 
                                        <input type="radio" id="grid_list_search_off" name="grid_list_search" class="flat-red" value="off">
                                    </label>
                                </div>
                            </div>


                            <div id="grid_list_export" class="col-md-4">
                                <label>Exportar:</label>
                                <div class="form-group">
                                    <label class="margin-right-15 text-normal">
                                        SIM
                                        <input type="radio" id="grid_list_export_on" name="grid_list_export" class="flat-green" checked="" value="on">
                                    </label>
                                    <label class="text-normal">
                                        NÃO 
                                        <input type="radio" id="grid_list_export_off" name="grid_list_export" class="flat-red" value="off">
                                    </label>
                                </div>
                            </div>

                            <!--TIPO DO CAMPO-->
                            <div class="form-group col-md-12">
                                <label>Tipo do Campo:</label>
                                <select class="form-control input-sm" name="grid_list_field_input_type">
                                    <option value="text">Texto</option>
                                    <!--<option value="text-long">Texto Longo</option>-->
                                    <!--<option value="email">E-Mail</option>-->
                                    <option value="date">Data</option>
                                    <option value="time">Hora</option>
                                    <option value="datetime">Data e Hora</option>
                                    <option value="number">Número Inteiro</option>
                                    <option value="number-decimal">Número Decimal</option>
                                    <option value="moeda">Moeda</option>
                                    <!--<option value="senha">Senha</option>-->
                                    <option value="upload-imagem">Upload de Imagem</option>
                                    <option value="upload-arquivo">Upload de Arquivo</option>
                                    <!--<option value="select-manual">Select Dropdown - Manual</option>-->
                                    <option value="select">Select</option>
                                    <!--<option value="select-multiple-manual">Select Multiplo - Manual</option>-->
                                    <!--<option value="select-multiple-dinamic">Select Multiplo - Dinâmico</option>-->
                                    <!--<option value="radio-manual">Radio Button - Manual</option>-->
                                    <!--<option value="radio-dinamic">Radio Button - Dinâmico</option>-->
                                    <!--<option value="checkbox-manual">CheckBox - Manual</option>-->
                                    <!--<option value="checkbox-multiple-manual">CheckBox Multiplo - Manual</option>-->
                                    <!--<option value="checkbox-multiple-dinamic">CheckBox Multiplo - Dinâmico</option>-->
                                </select>
                            </div>


                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Label:</label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group-addon bg-green-active j-tooltip j-flag-pk" data-placement="bottom" data-toggle="tooltip" data-original-title="Chave Primária">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <input class="form-control input-sm" type="text" placeholder="Label" name="grid_list_label" value="">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Alinhamento Label:</label>
                                <select class="form-control input-sm" name="grid_list_aligne_label">
                                    <option value="text-left">Esquerda</option>
                                    <option value="text-right">Direita</option>
                                    <option value="text-center">Centro</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Alinhamento Campo:</label>
                                <select class="form-control input-sm" name="grid_list_field_aligne">
                                    <option value="text-left">Esquerda</option>
                                    <option value="text-right">Direita</option>
                                    <option value="text-center">Centro</option>
                                </select>
                            </div>


                        </div>
                        <!--END COLUNA 1-->


                        <!--COLUNA 2-->
                        <div class="col-md-4">


                            <div class="form-group col-md-12">
                                <label>Tamanho do Campo:</label>
                                <input class="form-control input-sm" type="text" placeholder="Tamanho do Campo em PX ou %" name="grid_list_field_length" value="">
                            </div>



                            <div class="form-group col-md-12">
                                <label>Modal Imagem:</label>
                                <select class="form-control input-sm" name="grid_list_field_type_modal_image">
                                    <option value="icon-link">Icon Link</option>
                                    <option value="thumb">Thumbnail</option>
                                    <option value="multi-upload">Multi Upload</option>
                                </select>
                            </div>



                            <!--SELECT-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Select. <span style="font-size: 0.9em; font-weight: 100">QUERY Ex: SELECT id,profissao FROM cad_profissao</span></label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="grid_list_field_value_select" placeholder="QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>



                        </div>
                        <!--END COLUNA 2-->



                        <!--COLUNA 3-->
                        <div class="col-md-4">

                        </div>
                        <!--END COLUNA 3-->

                    </div>


                    <div class="box-footer text-center">
                        <button type="button" class="btn btn-primary btn-show-modal-aguarde j_btn_save_form_GridList"><i class="fa fa-fw fa-save margin-right-5"></i>Salvar</button>
                    </div>


                    <?= form_close(); ?>

                </div>
                <!--END GRID LIST TAB-->





            </div>

        </div>

    </div>

</div>
<!--END MODAL EDIT CAMPOS DA GRID LIST DO APP-->




<script>






    $(function () {

        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        if (csrfHash === '') {
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        }



        function hide_notifit_msg() {
            $("#ui_notifIt").remove();
        }

        $(document).keyup(function (e) {

            var _visible_modal = $('#modal-btn-edit-field-table-gridlist').is(":visible");

            if (e.which == 27) {
                if (_visible_modal) {
                    $('#modal-btn-edit-field-table-gridlist').fadeOut(100);
                    hide_notifit_msg();
                }
            }
        });

        //MODAL CLOSE
        $('.j_btn_modal_box_close').click(function () {
            $('#modal-btn-edit-field-table-gridlist').fadeOut(100);
            hide_notifit_msg();
        });//END $('.j_btn_modal_box_close').click()



        //DELETE VIRTUAL FIELD
        $('.j-btn-delete-virtual-field').click(function (e) {
            e.preventDefault();

//            $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('type', 'text');
//            $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").addClass('container');

            var _projeto_id = $(this).parent().parent().attr('rel-projeto-id');
            var _field_name = $(this).attr('rel-field-name');

            $(document).keydown(function (e) {
                if (e.keyCode == 32) {
                    return false;
                }
            });

            swal({
                title: "ATENÇÃO",
                text: 'Deseja deletar este campo virtual: ' + _field_name + ' ?',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                    .then((willDelete) => {
                        if (willDelete) {

                            $('#modal-aguarde').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true,
                            });

                            /*
                             * DELETA O REGISTRO
                             */

                            csrfHash = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val();
                            $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', '<?php echo $this->security->get_csrf_hash(); ?>');


                            $.ajax({
                                type: "POST",
                                url: "<?= site_url($this->router->fetch_class() . '/addFieldGridList'); ?>",
                                data: {[csrfName]: csrfHash, task: 'delete-field-gridlist', screen_type: 'gridlist', proj_build_id: _projeto_id, field_name: _field_name},
                                dataType: "json",
                                beforeSend: function () {


                                }, //END beforeSend
                                success: function (result) {

                                    if (result.type === 'success') {
                                        window.location.href = "<?= site_url($this->router->fetch_class() . '/edit/"+_projeto_id+"/' . '?' . bz_app_parametros_url()); ?>";
                                    } else {
                                        notfit_msg_error('Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.');
                                    }

                                }, //END success
                                complete: function (result) {

                                    $('#modal-aguarde').modal('hide');

                                }, //END complete
                                error: function () {
                                    notfit_msg_error('Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.');
                                }//END error
                            });//END AJAX

                        } else {

                            $('#modal-aguarde').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: false,
                            });

                        }
                    });

            return false;

        });//END //DELETE VIRTUAL FIELD



        //MODAL ADD VIRTUAL FIELD OPEN
        $('.j_btn_modal_add_fields_table_gridlist').click(function (e) {
            e.preventDefault();

//            $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('type', 'text');
//            $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").addClass('container');

            var _projeto_id = $(this).attr('rel-projeto-id');

            $(document).keydown(function (e) {
                if (e.keyCode == 32) {
                    return false;
                }
            });

            swal({
                title: 'Campo da Grid List',
                text: '',

                content: {
                    element: "input",
                    attributes: {
                        placeholder: "Nome do Campo da Grid List",
                        type: "text",
                    },

                },
                button: {
                    text: "Novo",
                    closeModal: false,
                },

            }).then(_field_name => {
                if (!_field_name) {
                    swal.stopLoading();
                    swal.close();
//                        swal("Opss!", "Favor Informar o Nome do Método PHP", "warning");
                    return false;
                } else {

                    swal.stopLoading();
                    swal.close();

                    var _field_name = _field_name.replace(/[^A-Za-z0-9]+/g, '');

                    $('#modal-aguarde').modal('show');

                    csrfHash = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val();
                    $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', '<?php echo $this->security->get_csrf_hash(); ?>');

                    $.ajax({
                        type: "POST",
                        url: "<?= site_url($this->router->fetch_class() . '/addFieldGridList'); ?>",
                        data: {[csrfName]: csrfHash, task: 'add-field-gridlist', screen_type: 'gridlist', proj_build_id: _projeto_id, field_name: _field_name},
                        dataType: "json",
                        beforeSend: function () {


                        }, //END beforeSend
                        success: function (result) {

                            if (result.type === 'warning') {
                                swal(result.title, result.msg, 'warning');
                            } else if (result.type === 'success') {
                                window.location.href = "<?= site_url($this->router->fetch_class() . '/edit/"+_projeto_id+"/' . '?' . bz_app_parametros_url()); ?>";
                            }

                        }, //END success
                        complete: function (result) {

                            $('#modal-aguarde').modal('hide');

                        }, //END complete
                        error: function () {
                            notfit_msg_error('Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.');
                        }//END error
                    });//END AJAX


                }


            });

        });//END MODAL ADD VIRTUAL FIELD OPEN .j_btn_modal_add_fields_table_gridlist


        /**
         * QUANDO O SELECT Tipo do Campo É SELECIONADO
         */
        $('select[name="grid_list_field_input_type"]').change(function (e) {
            e.preventDefault();
            var _selected = $(this).val();

            /* SELECT TYPE IMAGEM MODAL */
            if (_selected == 'upload-imagem') {
                $('select[name="grid_list_field_type_modal_image"]').parent().removeClass('hide');
            } else {
                $('select[name="grid_list_field_type_modal_image"]').parent().addClass('hide');
            }

        });


        /**
         * QUANDO O SELECT Tipo do Campo É SELECIONADO
         */
        $('select[name="grid_list_field_input_type"]').change(function (e) {
            e.preventDefault();
            var _selected = $(this).val();

            /* SELECT */
            if (_selected == 'select') {
                $('*[name="grid_list_field_value_select"]').parent().parent().removeClass('hide');
            } else {
                $('*[name="grid_list_field_value_select"]').parent().parent().addClass('hide');
                $('*[name="grid_list_field_value_select"]').val('');
                $('*[name="grid_list_field_value_select"]').val('');
            }

        });


        /**
         * MODAL EDIT FIELDS OPEN
         */
        $('.j_btn_modal_edit_fields_table_gridlist').click(function (e) {
            e.preventDefault();

            var _projeto_id = $(this).parent('tr:first').attr('rel-projeto-id');
            var _field_name = $(this).parent('tr:first').attr('id');
            var _primary_key = $(this).parent('tr:first').attr('rel-primary-key');
            var _screen_type = $(this).parent().parent().parent().attr('id');

            if (_screen_type === 'tableGridlist') {
                _screen_type = 'gridlist';
            } else {
                _screen_type = '';
            }

            $('#modal_field_name').html(_field_name);

            $('input[name="projeto_id"]').val(_projeto_id);
            $('input[name="field_name"]').val(_field_name);
            $('input[name="screen_type"]').val(_screen_type);

            $('input[name="grid_list_label"]').val(_field_name);

            console.clear();

            csrfHash = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val();
            $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', '<?php echo $this->security->get_csrf_hash(); ?>');

            $.ajax({
                type: "POST",
                url: "<?= site_url($this->router->fetch_class() . '/setup_gridlist'); ?>",
                data: {[csrfName]: csrfHash, task: 'get-dados', screen_type: _screen_type, projeto_id: _projeto_id, field_name: _field_name},
                dataType: "json",
                beforeSend: function () {

                }, //END beforeSend
                success: function (result) {

                    /**
                     * RENEW TOKEN CSRF
                     */
                    if (result.csrf_token) {
                        csrfHash = result.csrf_token;
                    }
                    $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', csrfHash);
                    /* END RENEW TOKEN CSRF */


                    //RESET CAMPOS
                    $('input[name="grid_list_show"]').filter(':radio').iCheck('uncheck');
                    $('input[name="grid_list_search"]').filter(':radio').iCheck('uncheck');
                    $('input[name="grid_list_export"]').filter(':radio').iCheck('uncheck');
                    $('input[name="grid_list_field_input_type"]').val('text');
                    $('input[name="grid_list_label"]').val('');
                    $('select[name="grid_list_aligne_label"]').val('text-left');
                    $('select[name="grid_list_field_length"]').val('');
                    $('select[name="grid_list_field_aligne"]').val('text-left');
                    $('select[name="grid_list_field_type"]').val('');
                    $('select[name="grid_list_field_type_modal_image"]').val('icon-link');
                    $('*[name="grid_list_field_value_select"]').val('');
                    $('*[name="grid_list_field_value_select"]').text('');



                    if (_primary_key == 1) {
                        $('.j-flag-pk').show();
                    } else {
                        $('.j-flag-pk').hide();
                    }


                    //CARREGA CAMPOS
                    $('input[name="grid_list_label"]').val(result.grid_list_label);

                    if (result.grid_list_show === 'on') {
                        $('input[id="grid_list_show_on"]').filter(':radio').iCheck('check');
                    } else {
                        $('input[id="grid_list_show_off"]').filter(':radio').iCheck('check');

                    }

                    if (result.grid_list_field_type === 'virtual') {
                        $('input[id="grid_list_search_off"]').filter(':radio').iCheck('check');
                        $('#grid_list_search').hide();
                    } else {
                        $('#grid_list_search').show();
                        if (result.grid_list_search === 'on') {
                            $('input[id="grid_list_search_on"]').filter(':radio').iCheck('check');
                        } else {
                            $('input[id="grid_list_search_off"]').filter(':radio').iCheck('check');
                        }

                        $('#grid_list_export').show();
                        if (result.grid_list_export === 'on') {
                            $('input[id="grid_list_export_on"]').filter(':radio').iCheck('check');
                        } else {
                            $('input[id="grid_list_export_off"]').filter(':radio').iCheck('check');
                        }
                    }


                    /* INPUT TIPO DE CAMPO  */
                    if (result.grid_list_field_input_type) {
                        $('select[name="grid_list_field_input_type"]').removeAttr('selected').val(result.grid_list_field_input_type).attr('selected', true);
                    }
                    /* END INPUT TIPO DE CAMPO  */


                    $('select[name="grid_list_aligne_label"]').removeAttr('selected').val(result.grid_list_aligne_label).attr('selected', true);

                    $('input[name="grid_list_field_length"]').val(result.grid_list_field_length);

                    $('select[name="grid_list_field_aligne"]').removeAttr('selected').val(result.grid_list_field_aligne).attr('selected', true);

//                    alert(result.grid_list_field_input_type);

                    /* SELECT TYPE IMAGEM MODAL  */
                    if (result.grid_list_field_input_type == 'upload-imagem') {
                        $('select[name="grid_list_field_type_modal_image"]').removeAttr('selected').val(result.grid_list_field_type_modal_image).attr('selected', true);
                        $('select[name="grid_list_field_type_modal_image"]').parent().removeClass('hide');
                    } else {
                        $('select[name="grid_list_field_type_modal_image"]').removeAttr('selected').val('icon-link').attr('selected', true);
                        $('select[name="grid_list_field_type_modal_image"]').parent().addClass('hide');

                    }
                    /* END SELECT TYPE IMAGEM MODAL  */


                    /* SELECT */
                    if (result.grid_list_field_input_type == 'select') {
                        $('*[name="grid_list_field_value_select"]').parent().parent().removeClass('hide');
                        $('*[name="grid_list_field_value_select"]').val(result.grid_list_field_value_select);
                    } else {
                        $('*[name="grid_list_field_value_select"]').parent().parent().addClass('hide');
                        $('*[name="grid_list_field_value_select"]').val('');
                        $('*[name="grid_list_field_value_select"]').text('');
                    }
                    /* END SELECT  */

                    $('input[name="grid_list_field_type"]').val(result.grid_list_field_type);

                    $('#modal-btn-edit-field-table-gridlist').css('display', 'block');

                }, //END success
                complete: function (result) {

                    $('#modal-aguarde').modal('hide');

                }, //END complete
                error: function () {
                    notfit_msg_error('Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.');
                }//END error
            });//END AJAX

        });//END $('.j_btn_modal_edit_fields_table').click()



        /**
         * SUBMIT FORM formGridList
         */
        $(".j_btn_save_form_GridList").click(function (e) {
            e.preventDefault();

//            if( $('input[id="grid_list_show_off"]').val() == 'off' ){
//                
//                $('input[name="grid_list_search"]').filter(':radio').iCheck('uncheck');
//                $('input[id="grid_list_search_off"]').filter(':radio').iCheck('check');
//                
//                $('input[name="grid_list_export"]').filter(':radio').iCheck('uncheck');
//                $('input[id="grid_list_export_off"]').filter(':radio').iCheck('check');
//                
//            }



            /**
             * RESET CAMPOS ANTES DE GRAVAR
             */
            if ($('select[name="grid_list_field_input_type"]').val() !== 'upload-imagem') {
                $('select[name="grid_list_field_type_modal_image"]').val('icon-link');
            }


//            if (result.grid_list_field_input_type !== 'select') {
//                $('*[name="grid_list_field_value_select"]').val('');
//            }

            /* RESET CAMPOS ANTES DE GRAVAR */



            var _btn_save = $(this);
            var _label_field_name = $('input[name="grid_list_label"]').val();
            var _field_name = $('#modal_field_name').text();
            var _screen_type = $(this).parent().parent().parent().attr('id');

            var _action = $('#formGridList').attr('action');
            var _data = $('#formGridList').serialize();
            var _dataArray = $('#formGridList').serializeArray();


            $.ajax({
                type: "POST",
                url: _action,
                data: _data,
                dataType: "json",
                beforeSend: function () {
                    _btn_save.hide();
                }, //END beforeSend
                success: function (result) {

                    /**
                     * RENEW TOKEN CSRF
                     */
                    if (result.csrf_token) {
                        csrfHash = result.csrf_token;
                    }
                    $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', csrfHash);
                    /* END RENEW TOKEN CSRF */

                    if (result.return === 'SAVE-SETUP-GRIDLIST-OK') {

                        /*
                         * MARCA REGISTRO OFF PARA MOSTRAR NA VIEW
                         */
                        $('.fields_table tr').each(function () {
                            if ($(this).attr('id') == _field_name) {

                                dataObj = {};

                                $(_dataArray).each(function (i, field) {
                                    dataObj[field.name] = field.value;
                                });

                                if (dataObj['grid_list_show'] === 'off') {

//                                    dataObj['grid_list_search'] = 'off' ;
//                                    dataObj['grid_list_export'] = 'off' ;

                                    $(this).addClass('font-color-gray-light');
                                    $(this).children().first().next().children().removeClass('text-green').removeClass('fa-toggle-on').addClass('fa-toggle-off');

                                } else {
                                    $(this).removeClass('font-color-gray-light');
                                    $(this).children().first().next().children().addClass('text-green').removeClass('fa-toggle-off').addClass('fa-toggle-on');

                                }


                                if (dataObj['grid_list_search'] === 'off') {
                                    $(this).children().first().next().next().children().removeClass('text-green').removeClass('fa-toggle-on').addClass('fa-toggle-off');

                                } else {
                                    $(this).children().first().next().next().children().addClass('text-green').removeClass('fa-toggle-off').addClass('fa-toggle-on');
                                }


                                if (dataObj['grid_list_export'] === 'off') {
                                    $(this).children().first().next().next().next().children().removeClass('text-green').removeClass('fa-toggle-on').addClass('fa-toggle-off');

                                } else {
                                    $(this).children().first().next().next().next().children().addClass('text-green').removeClass('fa-toggle-off').addClass('fa-toggle-on');
                                }


                            }
                        });/*END MARCA REGISTRO OFF PARA MOSTRAR NA VIEW*/

//                        notfit_msg_success('SETUP do Campo <b>' + _label_field_name + '</b> Atualizado com Sucesso.');

                        var param = [];
                        param['title'] = 'SETUP do Campo <b>' + _label_field_name + '</b> Atualizado com Sucesso.';
                        param['color'] = "success";
                        param['timer'] = 3000;
                        triggerNotify(param);



                    } else {
//                        notfit_msg_error('Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.');

                        var param = [];
                        param['title'] = 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema. ' + result.return;
                        param['color'] = "error";
                        param['timer'] = 3000;
                        triggerNotify(param);
                    }


                }, //END success
                complete: function (result) {

                    $('#modal-aguarde').modal('hide');
                    _btn_save.show();

                }, //END complete
                error: function () {
//                    notfit_msg_error('Ocorreu um ERRO Inesperado ao Atualizar Registro, Contacte o Administrador do Sistema.');

                    var param = [];
                    param['title'] = 'Ocorreu um ERRO Inesperado ao Atualizar Registro, Contacte o Administrador do Sistema.';
                    param['color'] = "error";
                    param['timer'] = 3000;
                    triggerNotify(param);


                }//END error
            });//END AJAX
        });//END $(".j_btn_save_form_GridList").click()


    });
</script>