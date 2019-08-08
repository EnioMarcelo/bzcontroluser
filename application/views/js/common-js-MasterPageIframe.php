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
     * AJAX FORM SUBMIT POST
     */
    $(function () {

        /**
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
         * $json['message']['toastr']['titulo'] = 'ATENÇÃO !!!';
         * $json['message']['toastr']['mensagem'] = 'POST OK';
         * $json['message']['toastr']['tipo'] = 'info';
         * $json['message']['toastr']['icon'] = 'fa-thumbs-up';
         *
         * MENSAGENS E AVISOS SESSION TEMP
         *
         * set_mensagem_sweetalert('TITULO', 'MENSAGEM', 'warning');
         *
         * set_mensagem_notfit('MENSAGEM', 'info');
         *
         * set_mensagem('TITULO','MENSAGEM', 'fa-times', 'info');
         *
         * echo json_encode( $json );
         *
         */

        $(".j_ajax_form").submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr("action");
            console.log(url);

            $.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                data: form.serialize(),
                beforeSend: function () {
                },
                success: function (response) {

                    //redirect
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }

                    //reload
                    if (response.reload) {
                        window.location.reload();
                    }

                    //reset
                    if (response.reset) {
                        form[0].reset();
                    }

                    //message toastr
                    if (response.message && response.message.toastr) {
                        var icon = '';
                        if (response.message.toastr.icon) {
                            icon = response.message.toastr.icon;
                        } else {
                            icon = 'fa-info-circle';
                        }

                        if (icon.length) {
                        } else {
                            icon = 'fa-circle';
                        }
                        var msg = '<div class="alert alert-' + response.message.toastr.tipo + '" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                                '<h4 class="alert-heading"><i class = "margin-right-5 fa ' + icon + '"></i>' + response.message.toastr.titulo + '</h4>' + response.message.toastr.mensagem + '<br /></div>';
                        $('.message-toastr').html(msg);
                        setTimeout(function () {
                            $('.alert').fadeOut(1000);
                        }, 3000);

                    }

                    //message swal
                    if (response.message && response.message.swal) {
                        swal(response.message.swal.titulo, response.message.swal.mensagem, response.message.swal.tipo);
                    }

                    //message notfit
                    if (response.message && response.message.notfit) {
                        if (response.message.notfit.tipo == 'warning') {
                            notfit_msg_warning(response.message.notfit.mensagem);
                        } else if (response.message.notfit.tipo == 'error') {
                            notfit_msg_error(response.message.notfit.mensagem);
                        } else if (response.message.notfit.tipo == 'success') {
                            notfit_msg_success(response.message.notfit.mensagem);
                        } else {
                            notfit_msg_info(response.message.notfit.mensagem);
                        }
                    }

                },
                complete: function () {
                    modalAguardeOff();
                },
                error: function () {
                    var message = "Desculpe mas não foi possível processar a requisição. Avise o responsável pelo sistema !";
                    swal('ATENÇÃO !!!', message, 'error');
                }
            });




        });



    });


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


    /**
     * OPEN AND CLOSE MODAL FULL SCREEN
     */
    $(function () {
        $('.j-btn-open-modal-fullscreen').on('click', function (event) {

            event.preventDefault();

            $('#modal-aguarde').modal({
                backdrop: 'static',
                keyboard: false,
                show: true,
            });

            parent.$('#bzModalFullscreen').modal({
                backdrop: 'static',
                keyboard: false,
                show: true,
            });

            var me = parent.$('#bzModalFullscreen').contents().find('iframe');
            parent.$('#bzModalFullscreen').addClass('iframe-fullscreen');

            me.contents().find(".j-btn-open-modal-fullscreen").remove();
            me.contents().find(".j-btn-close-modal-fullscreen").show();

            parent.$('#bzModalFullscreen').find(".iframe-modulos").get(0).contentDocument.location.reload();

            return false;

        });

        $('.j-btn-close-modal-fullscreen').on('click', function (event) {

            event.preventDefault();

            $('#modal-aguarde').modal({
                backdrop: 'static',
                keyboard: false,
                show: true,
            });

            parent.$('#bzModalFullscreen').modal('hide');

            var openFullScreen = parent.$('#bzModalFullscreen').contents().find('iframe');
            parent.$('#bzModalFullscreen').removeClass('iframe-fullscreen');

            openFullScreen.contents().find(".j-btn-open-modal-fullscreen").hide();

            parent.$('.iframe-modulos').get(0).contentDocument.location.reload();

            return false;

        });

        var closeFullScreen = parent.$('#bzModalFullscreen').hasClass('iframe-fullscreen');
        if (closeFullScreen) {
            $('.j-btn-open-modal-fullscreen').hide();
            $('.j-btn-close-modal-fullscreen').show();
        }

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
                , start_highlight: true
                , allow_toggle: false
                , language: "pt"
                , syntax: "html"
                , toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
                , syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
                , is_multi_files: true
                , EA_load_callback: "editAreaLoaded"
                , show_line_colors: true
            });

            editAreaLoader.init({
                id: "codeeditor_3"	// id of the textarea to transform
                , start_highlight: true
                , font_size: "8"
                , font_family: "verdana, monospace"
                , allow_resize: "y"
                , allow_toggle: false
                , language: "fr"
                , syntax: "css"
                , toolbar: "new_document, save, load, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
                , load_callback: "my_load"
                , save_callback: "my_save"
                , plugins: "charmap"
                , charmap_default: "arrows"

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
                                var formData = {btndel: "btn-del", dadosdel: deleteditems}; //Array

                                $.ajax({
                                    url: "<?= site_url($this->router->fetch_class() . '/del'); ?>",
                                    type: "POST",
                                    data: formData,
                                    success: function (formData, textStatus, jqXHR) {
                                        window.location.href = "<?= site_url($this->router->fetch_class() . '?' . bz_app_parametros_url()); ?>";
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

                                window.location.href = "<?= site_url($this->router->fetch_class() . '?' . bz_app_parametros_url()); ?>";
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
            $(".sidebar-menu .bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>-active", window.parent.document).removeClass().addClass('sidebar-menu j-btn-linkmenu');
            $(".sidebar-menu a[href*='<?= $this->router->fetch_class(); ?>']", window.parent.document).addClass('bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>-active');
        });
    });
    // END MARCA O MENU CORRESPONDENTE A APLICAÇÃO COMO ATIVO css class bg-blue-active

    /*
     * DATE AND TIME PICKER
     */
    $(function () {
        $('.datepicker').datepicker({todayHighlight: true, toggleActive: true, format: "dd/mm/yyyy", autoclose: true, language: 'pt-BR'});
        $('.datetimepicker').datetimepicker({format: "dd/mm/yyyy HH:ii", use24hours: true, autoclose: true, language: 'pt-BR'});
        $('.timepicker').timepicker({format: "HH:ii", showMeridian: false, autoclose: true, defaultTime: ''});
    });
    //END DATE AND TIME PICKER


    //REMOVE ELEMENTOS MARCADOS COM A CLASSE .hide-formadd ou .hide-formedit
    $(function () {

        $('#IdFormADD_<?= $this->router->fetch_class(); ?>').find(".hide-formadd").parent().next().removeAttr('placeholder');
        $('#IdFormADD_<?= $this->router->fetch_class(); ?>').find(".hide-formadd").remove();

        $('#IdFormEDIT_<?= $this->router->fetch_class(); ?>').find(".hide-formedit").parent().next().removeAttr('placeholder');
        $('#IdFormEDIT_<?= $this->router->fetch_class(); ?>').find(".hide-formedit").remove();

    });
    //END REMOVE ELEMENTOS MARCADOS COM A CLASSE .hide-formadd ou .hide-formedit


    //EXECUTA QUANDO TERMINAR DE CARREGAR A PÁGINA
    $(document).ready(function () {
        $('.hide-reload-screen').show();
    });
    //END EXECUTA QUANDO TERMINAR DE CARREGAR A PÁGINA


</script>






