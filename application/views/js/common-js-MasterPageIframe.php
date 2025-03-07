<?php
/**
 * Created on : 18/12/2018, 11:29:45
 * Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */
?>

<script>

    /**
     * CONTA QUANTIDADE DE CHECKBOX DELETE MARCADOS
     */
    function checkbox_count() {

        var numberOfChecked = $('tbody input:checkbox:checked').length;
        if (numberOfChecked > 0) {
            $('#btn-delete').removeClass('disabled');
            $('.btn-enable-gridlist-checkbox-mark').removeClass('disabled');
        } else {
            $('#btn-delete').addClass('disabled');
            $('.btn-enable-gridlist-checkbox-mark').addClass('disabled');
            $('.checkbox-all').prop("checked", false);
        }

    }

    /**
     * FUNCTION DESLIGA MODAL AGUARDE
     */
    function modalAguardeOff() {
        $('#modal-aguarde').modal('hide');
    }

    /**
     * FUNCTION LIGA MODAL AGUARDE
     */
    function modalAguardeOn() {
        $('#modal-aguarde').modal('show');
    }

    /**
     * MARCO AJAX POST
     */
    var mc_post_ajax = function (_url, _data = null, callback) {
        
        var url = _url;
        var jsonData = {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'};

        $.post(url, jsonData, function (response, status) {

            $( "#post_ajax_return" ).empty().append( response + ' - ' + status );

        });


    }


    /**
     *
     * FUNCTION DELETE IMAGE AJAX - MULTI UPLOAD IMAGE
     */
    $(function () {

        $('.j-btn-del-image').on('click', function () {

            var _image = $(this);
            var t = 'Deseja excluir esta imagem ?';

            modalAguardeOn();

            swal({
                title: "ATENÇÃO",
                text: t,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {

                        /**
                         * MACRO AJAX
                         */
                        var _method = '/del_image';
                        var _url = '<?=site_url() . $this->router->fetch_class();?>' + _method;
                        var _data = {
                            'id': _image.data('id'),
                            'field_name': _image.data('field_name'),
                            'folder_image': _image.data('folder_image'),
                            'image': _image.data('image')
                        };

                        $.post(_url, {
                                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                'data': _data
                            },
                            function (response) {

                                //message trigger notfiti
                                if (response.message && response.message.triggernotifi) {

                                    var _param = [];
                                    _param['color'] = response.message.triggernotifi.tipo;
                                    _param['title'] = response.message.triggernotifi.mensagem;
                                    _param['timer'] = response.message.triggernotifi.timer;
                                    if (_param['color'] == 'undefined' || _param['color'] == null || _param['color'] == '') {
                                        _param['color'] = 'info';
                                    }

                                    if (_param['title'] == 'undefined' || _param['title'] == null || _param['title'] == '') {
                                        _param['title'] = 'Faltou informar o texto.';
                                    }

                                    if (_param['timer'] == 'undefined' || _param['timer'] == null || _param['timer'] == '') {
                                        _param['timer'] = 3200;
                                    }

                                    triggerNotify(_param);
                                }
                                //end message trigger notfiti¸

                            }, "json")
                            .done(function (response) {

                                if (response['data'] == 'OK') {
                                    _image.parent().fadeOut(500, function () {
                                        _image.remove();
                                    });
                                }

                            })
                            .fail(function () {

                                var message = "Desculpe mas não foi possível processar a requisição ajax. Avise o responsável pelo sistema !";
                                swal('ATENÇÃO !!!', message, 'error');

                            })
                            .always(function () {

                                modalAguardeOff();

                            });

                        /** END MACRO AJAX */


                    } else {

                        modalAguardeOff();

                    }
                });

        });

    });

    /* END FUNCTION DELETE IMAGE AJAX - MULTI UPLOAD IMAGE */


    /**
     *
     * FUNÇÃO QUE DISPARA UM AJAX POST
     *
     * @param {type} _url
     * @param {type} _data
     * @param {type} _arr
     * @returns {undefined}
     *
     *
     *
     * Exemplos de Uso:
     *
     * DENTRO DE UMA FUNCTION NO CONTROLLER
     *
     * REDIRECIONA TELA
     * $json['redirect'] = site_url('dashboard') ;
     *
     * RECARREGA TELA
     * $json['reload'] = true ;
     *
     * RESET DE TODOS OS CAMPOS DO FORM
     * $json['reset'] = true ;
     *
     * RETORNA OS DADOS DO POST OU QUALQUER OUTRO DADO INFORMADO
     * $json['data'] = $_POST;
     *
     * MENSAGENS E AVISOS AJAX
     *
     * $json['message']['swal']['titulo'] = 'ATENÇÃO !!!';
     * $json['message']['swal']['mensagem'] = 'POST OK';
     * $json['message']['swal']['tipo'] = 'info';
     *
     * $json['message']['notfit']['mensagem'] = 'POST OK';
     * $json['message']['notfit']['tipo'] = 'info';
     *
     * $json['message']['nice']['title'] = 'Titulo';
     * $json['message']['nice']['text'] = 'POST OK';
     * $json['message']['nice']['tipo'] = 'info';
     * $json['message']['nice']['position'] = 'br';
     * $json['message']['nice']['duration'] = 3200;
     *
     * $json['message']['toastr']['titulo'] = 'ATENÇÃO !!!';
     * $json['message']['toastr']['mensagem'] = 'POST OK';
     * $json['message']['toastr']['tipo'] = 'info';
     * $json['message']['toastr']['icon'] = 'fa-thumbs-up';
     *
     * $json['message']['triggernotifi']['mensagem'] = 'POST OK';
     * $json['message']['triggernotifi']['tipo'] = 'info';
     * $json['message']['triggernotifi']['timer'] = 3200;
     *
     * MENSAGENS E AVISOS SESSION TEMP
     *
     * set_mensagem_sweetalert('TITULO', 'MENSAGEM', 'warning');
     *
     * set_mensagem_notfit('MENSAGEM', 'info');
     *
     * set_mensagem_trigger_notifi('MENSAGEM', 'info' );
     *
     * set_mensagem('TITULO','MENSAGEM', 'fa-times', 'info');
     *
     * echo json_encode( $json );
     *
     *
     *      DEPRECATED -DEPRECATED -DEPRECATED -DEPRECATED -DEPRECATED -DEPRECATED -DEPRECATED -DEPRECATED -DEPRECATED -DEPRECATED -DEPRECATED
     *
     */
    //var response_ajax = new Array();
    //var mc_ajax_post = function (_url, _data, _arr) {
    //
    //    $.ajax({
    //        url: _url,
    //        type: "POST",
    //        dataType: "json",
    //        data: {
    //            '<?php //echo $this->security->get_csrf_token_name(); ?>//': '<?php //echo $this->security->get_csrf_hash(); ?>//',
    //            'data': _data
    //        },
    //        beforeSend: function () {
    //            modalAguardeOn();
    //        },
    //        success: function (response) {
    //
    //            //redirect
    //            if (response.redirect) {
    //                window.location.href = response.redirect;
    //            }
    //
    //            //reload
    //            if (response.reload) {
    //                window.location.reload();
    //            }
    //
    //            //debug
    //            if (response.debug) {
    //                console.log('Debug:');
    //                console.log(response.debug);
    //            }
    //
    //            //data
    //            if (response.data) {
    //                response_ajax[_arr] = response.data;
    //            }
    //
    //
    //            //message toastr
    //            if (response.message && response.message.toastr) {
    //                var icon = '';
    //                if (response.message.toastr.icon) {
    //                    icon = response.message.toastr.icon;
    //                } else {
    //                    icon = 'fa-info-circle';
    //                }
    //
    //                if (icon.length) {
    //                } else {
    //                    icon = 'fa-circle';
    //                }
    //                var msg = '<div class="alert alert-' + response.message.toastr.tipo + '" role="alert">' +
    //                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
    //                    '<span aria-hidden="true">&times;</span>' +
    //                    '</button>' +
    //                    '<h4 class="alert-heading"><i class = "margin-right-5 fa ' + icon + '"></i>' + response.message.toastr.titulo + '</h4>' + response.message.toastr.mensagem + '<br /></div>';
    //                $('.message-toastr').html(msg);
    //                setTimeout(function () {
    //                    $('.alert').fadeOut(1000);
    //                }, 3000);
    //            }//end message toastr
    //
    //
    //            //message swal
    //            if (response.message && response.message.swal) {
    //                swal(response.message.swal.titulo, response.message.swal.mensagem, response.message.swal.tipo);
    //            }//end message swal
    //
    //
    //            //message notfit
    //            if (response.message && response.message.notfit) {
    //                if (response.message.notfit.tipo == 'warning') {
    //                    notfit_msg_warning(response.message.notfit.mensagem);
    //                } else if (response.message.notfit.tipo == 'error') {
    //                    notfit_msg_error(response.message.notfit.mensagem);
    //                } else if (response.message.notfit.tipo == 'success') {
    //                    notfit_msg_success(response.message.notfit.mensagem);
    //                } else {
    //                    notfit_msg_info(response.message.notfit.mensagem);
    //                }
    //            }//end message notfit
    //
    //
    //            //message trigger notfiti
    //            if (response.message && response.message.triggernotifi) {
    //
    //                var _param = [];
    //                _param['color'] = response.message.triggernotifi.tipo;
    //                _param['title'] = response.message.triggernotifi.mensagem;
    //                _param['timer'] = response.message.triggernotifi.timer;
    //                if (_param['color'] == 'undefined' || _param['color'] == null || _param['color'] == '') {
    //                    _param['color'] = 'info';
    //                }
    //
    //                if (_param['title'] == 'undefined' || _param['title'] == null || _param['title'] == '') {
    //                    _param['title'] = 'Faltou informar o texto.';
    //                }
    //
    //                if (_param['timer'] == 'undefined' || _param['timer'] == null || _param['timer'] == '') {
    //                    _param['timer'] = 3200;
    //                }
    //
    //                triggerNotify(_param);
    //            }
    //            //end message trigger notfiti
    //
    //
    //            //message nice
    //            if (response.message && response.message.nice) {
    //                var type = response.message.nice.type;
    //                var text = response.message.nice.text;
    //                var title = response.message.nice.title;
    //                var position = response.message.nice.position;
    //                var duration = response.message.nice.duration;
    //                if (text == 'undefined' || text == null) {
    //                    text = 'Faltou informar o texto.';
    //                }
    //
    //                if (title == 'undefined' || title == null) {
    //                    title = '';
    //                }
    //
    //                if (position == 'undefined' || position == null) {
    //                    position = 'br';
    //                }
    //
    //                if (duration == 'undefined' || duration == null) {
    //                    duration = '3200';
    //                }
    //
    //                if (type == 'success') {
    //                    $.HP.notice({
    //                        message: text,
    //                        title: title,
    //                        location: position,
    //                        duration: duration
    //                    });
    //                } else if (type == 'error') {
    //                    $.HP.error({
    //                        message: text,
    //                        title: title,
    //                        location: position,
    //                        duration: duration
    //                    });
    //                } else if (type == 'warning') {
    //                    $.HP.warning({
    //                        message: text,
    //                        title: title,
    //                        location: position,
    //                        duration: duration
    //                    });
    //                } else {
    //                    $.HP({
    //                        message: text,
    //                        title: title,
    //                        location: position,
    //                        duration: duration
    //                    });
    //                }
    //
    //                return;
    //            }//end message nice
    //
    //        },
    //        complete: function () {
    //            modalAguardeOff();
    //        },
    //        error: function () {
    //            var message = "Desculpe mas não foi possível processar a requisição ajax. Avise o responsável pelo sistema !";
    //            swal('ATENÇÃO !!!', message, 'error');
    //        }
    //    });
    //}


    /**
     * LIGA O MODAL DE AGUARDE DEPOIS QUE CARREGA TODO O CONTEÚDO
     */

    $(function () {
        $('.btn-show-modal-aguarde').on('click', function (event) {
            $('#modal-aguarde').modal({
                backdrop: 'static',
                keyboard: false,
                show: true,
            });
        });
    });
    /*
     * BUTTON BACK PAGE
     */
    $(document).ready(function () {
        $(".j-btn-backLink").click(function (event) {
            event.preventDefault();
            history.back(1);
        });
    });
    /*
     * MARCA A LINHA SELECIONADA
     */
    $(function () {
        $('.table-mark-row').on('click', 'tbody tr', function (event) {
            $("input:checkbox").each(function () {
                if ($(this).is(":checked")) {
                    $(this).parent().parent().find("td").addClass('bg-danger');
                } else {
                    $(this).parent().parent().find("td").removeClass('bg-danger');
                }
            });
            checkbox_count();
        });
    });
    /*
     * CODE EDITOR TEXTAREA
     */
    $(function () {

        window.onload = function () {
            // initialisation
            editAreaLoader.init({
                id: "codeeditor_1"	// id of the textarea to transform
                , start_highlight: true	// if start with highlight
                , font_size: "10"
                , font_family: "verdana, monospace"
                , allow_resize: "both"
                , allow_toggle: false
                , word_wrap: true
                , show_line_colors: true
                , language: "pt"
                , syntax: "php"
                , syntax_selection_allow: "css,html,js,php"
                , toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection,|, help"
                , replace_tab_by_spaces: 5
            });
            editAreaLoader.init({
                id: "codeeditor_2"	// id of the textarea to transform
                ,
                start_highlight: true
                ,
                allow_toggle: false
                ,
                language: "pt"
                ,
                syntax: "html"
                ,
                toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
                ,
                syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
                ,
                is_multi_files: true
                ,
                EA_load_callback: "editAreaLoaded"
                ,
                show_line_colors: true
            });
            editAreaLoader.init({
                id: "codeeditor_3"	// id of the textarea to transform
                ,
                start_highlight: true
                ,
                font_size: "8"
                ,
                font_family: "verdana, monospace"
                ,
                allow_resize: "y"
                ,
                allow_toggle: false
                ,
                language: "fr"
                ,
                syntax: "css"
                ,
                toolbar: "new_document, save, load, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
                ,
                load_callback: "my_load"
                ,
                save_callback: "my_save"
                ,
                plugins: "charmap"
                ,
                charmap_default: "arrows"

            });
        };
    });
    /*
     * MARCA E DESMARCA TODAS AS LINHAS DA TABLE
     */
    $(function () {

        $('.checkbox-all').on('ifChecked ifUnchecked', function (event) {
            if (event.type == 'ifChecked') {
                $('input.checkbox-unit').iCheck('check');
            } else {
                $('input.checkbox-unit').iCheck('uncheck');
            }
        });
        $('.checkbox-all').on('ifUnchecked', function (event) {
            $('input.checkbox-unit').iCheck('uncheck');
        });
    });
    /*
     * MARCA E DESMARCA LINHA POR LINHA (INDIVIDUAL) DA TABLE
     */
    $(function () {

        $('input.checkbox-unit').on('ifChecked', function (event) {
            $(this).closest("input").attr('checked', true);
            $(this).parent().parent().parent().find("td").addClass('bg-danger');
            checkbox_count();
        });
        $('input.checkbox-unit').on('ifUnchecked', function (event) {
            $(this).closest("input").attr('checked', false);
            $(this).parent().parent().parent().find("td").removeClass('bg-danger');
            checkbox_count();
        });
    });
    /*
     * iCheck
     */
    $(function () {

        /* iCheck for checkbox and radio inputs */
        $('input[type="checkbox"].minimal-blue, input[type="radio"].minimal-blue').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
        $('input[type="checkbox"].minimal-green, input[type="radio"].minimal-green').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green'
        });
        $('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        /* Red color scheme for iCheck */
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        /* Flat red color scheme for iCheck */
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });
    });
    /**
     * SELECT 2
     * Initialize Select2 Elements
     */
    $(function () {
        $('.select2').select2({
            language: "pt-BR",
            placeholder: "Selecione...",
            allowClear: true


        });
        $('.select2-multiple-selection').select2({
            language: "pt-BR",
            placeholder: "Selecione...",
            allowClear: true,
            multiple: true,
            closeOnSelect: false

        });
    });
    /**
     * NUMBERED LINE TEXTAREA
     */
    //$(function () {
    //    // Target all classed with ".lined"
    //    $(".textarea-lined").linedtextarea(
    //            {selectedLine: 0}
    //    );
    //
    //});


    /**
     * INPUT UPPERCASE AND LOWERCASE
     */
    $(function () {
        $(".uppercase").bind('keyup', function (e) {
            var input = $(this);
            var start = input[0].selectionStart;
            $(this).val(function (_, val) {
                return val.toUpperCase();
            });
            input[0].selectionStart = input[0].selectionEnd = start;
        });
        $(".lowercase").bind('keyup', function (e) {
            var input = $(this);
            var start = input[0].selectionStart;
            $(this).val(function (_, val) {
                return val.toLowerCase();
            });
            input[0].selectionStart = input[0].selectionEnd = start;
        });
    });
    /**
     * MÁSCARAS COM JQUERY MASK INPUT
     */
    $(function () {

        /** VALOR MOEDA PT BR **/
        $('.j-mask-moeda-ptbr').mask('#.##0,00', {reverse: true});
        /** DATA PT BR **/
        $('.j-mask-data-ptbr').mask('00/00/0000');
        /** HORA PT BR **/
        $('.j-mask-hora-ptbr').mask('00:00');
        /** DATA E HORA PT BR **/
        $('.j-mask-datahora-ptbr').mask('00/00/0000 00:00');


    });
    /*
     * BOTÃO DELETA REGISTROS
     */
    $(function () {

        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '';
        if (csrfHash === '') {
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        }

        $("#btn-delete").on("click", function () {

            var deleteditems = $('input:checkbox[name="btn-delete[]"]:checked')
                .map(function () {
                    return $(this).val();
                })
                .get()
                .join(",");
            if (!deleteditems) {

                swal("ATENÇÃO !", "Nenhum registro selecionado", "warning");
                return false;
            } else {

                var p = deleteditems.indexOf(",");
                var t = '';
                if (p > 0) {
                    t = 'Deseja deletar estes registros ?';
                } else {
                    t = 'Deseja deletar este registro ?';
                }

                swal({
                    title: "ATENÇÃO",
                    text: t,
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
                            var formData = {[csrfName]: csrfHash, btndel: "btn-del", dadosdel: deleteditems}; //Array

                            $.ajax({
                                url: "<?=site_url($this->router->fetch_class() . '/del');?>",
                                type: "POST",
                                data: formData,
                                success: function (formData, textStatus, jqXHR) {
                                    window.location.href = "<?=site_url($this->router->fetch_class() . '?' . bz_app_parametros_url());?>";
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    swal("ERRO !", "Erro ao deletar registro", "error");
                                }
                            });
                        } else {

                            $('#modal-aguarde').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true,
                            });
                            window.location.href = "<?=site_url($this->router->fetch_class() . '?' . bz_app_parametros_url());?>";
                        }
                    });
            }

        });
    });
    //END BOTÃO DELETA REGISTROS


    /*
     * MARCA O MENU CORRESPONDENTE A APLICAÇÃO COMO ATIVO css class bg-blue-active
     */
    $(function () {
        $('.sidebar-menu', window.parent.document).each(function () {
            $(".sidebar-menu .bg-<?=___BZ_LAYOUT_SKINCOLOR___;?>-active", window.parent.document).removeClass().addClass('sidebar-menu j-btn-linkmenu');
            $(".sidebar-menu a[href*='<?=$this->router->fetch_class();?>']", window.parent.document).addClass('bg-<?=___BZ_LAYOUT_SKINCOLOR___;?>-active');
        });
    });
    // END MARCA O MENU CORRESPONDENTE A APLICAÇÃO COMO ATIVO css class bg-blue-active

    /*
     * DATE AND TIME PICKER
     */
    $(function () {
        $('.datepicker').datepicker({
            todayHighlight: true,
            toggleActive: true,
            format: "dd/mm/yyyy",
            autoclose: true,
            language: 'pt-BR'
        });
        $('.datetimepicker').datetimepicker({
            format: "dd/mm/yyyy HH:ii",
            use24hours: true,
            autoclose: true,
            language: 'pt-BR'
        });
        $('.timepicker').timepicker({format: "HH:ii", showMeridian: false, autoclose: true, defaultTime: ''});

        $('.clockpicker').clockpicker({
            placement: 'center',
            align: 'left',
            autoclose: true,
            donetext: 'OK'
        });

    });
    //END DATE AND TIME PICKER


    //REMOVE ELEMENTOS MARCADOS COM A CLASSE .hide-formadd ou .hide-formedit
    $(function () {

        $('#IdFormADD_<?=$this->router->fetch_class();?>').find(".hide-formadd").parent().next().removeAttr('placeholder');
        $('#IdFormADD_<?=$this->router->fetch_class();?>').find(".hide-formadd").remove();
        $('#IdFormEDIT_<?=$this->router->fetch_class();?>').find(".hide-formedit").parent().next().removeAttr('placeholder');
        $('#IdFormEDIT_<?=$this->router->fetch_class();?>').find(".hide-formedit").remove();
    });
    //END REMOVE ELEMENTOS MARCADOS COM A CLASSE .hide-formadd ou .hide-formedit


    //EXECUTA QUANDO TERMINAR DE CARREGAR A PÁGINA
    $(document).ready(function () {
        $('.hide-reload-screen').show();
    });
    //END EXECUTA QUANDO TERMINAR DE CARREGAR A PÁGINA


    //GRID LIST LINE CLICK EDIT
    $(function () {
        $(".j-btn-edit").on('click', function (e) {

            e.preventDefault();
            var _action = $(this).parent().data('action');
            window.location.href = _action;
        });
    });
    //END GRID LIST LINE CLICK EDIT


    // VALIDA A QUANTIDADE DE ARQUIVOS QUE O SERVIDOR PERMITE SER ENVIADO PARA UPLOAD
    $(function () {
        $("input[type='file']").on('change', function (e) {
            e.preventDefault();
            var $fileUpload = $(this);
            var message = "Quantidade máxima permitida de upload para este servidor é de <?=ini_get('max_file_uploads');?> arquivos.";

            if (parseInt($fileUpload.get(0).files.length) > <?=ini_get('max_file_uploads');?>) {
                swal('ATENÇÃO !!!', message, 'error');
                $fileUpload.val('');
                modalAguardeOff();
            }
        });
    });
    // END VALIDA A QUANTIDADE DE ARQUIVOS QUE O SERVIDOR PERMITE SER ENVIADO PARA UPLOAD


</script>

