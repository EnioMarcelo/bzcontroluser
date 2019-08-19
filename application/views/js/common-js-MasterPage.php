<?php
/**
 * Created on : 18/12/2018, 11:28:28
 * Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */
?>


<script>
    /*
     *  FUNÇÃO TESTA O TIMEOUT DA SESSÃO DO USUÁRIO
     */
    var count = 0;
    setTimeout(transition, <?= ($this->config->item('sess_expiration') * 1000) + 1000; ?>);

    function transition() {

        $.get("Checktimesession", function (data) {
            if (data == 'EXPIRED') {
                window.location.replace("<?= site_url('logout'); ?>");
            }
        });

        setTimeout(transition, <?= ($this->config->item('sess_expiration') * 1000) + 1000; ?>);
    }




    /*
     * Mensagem Toastr
     * @param {type} _titulo
     * @param {type} _mensagem
     * @param {type} _position
     * @param {type} _tipo
     * @returns {undefined}
     */
    function msg_toastr(_titulo, _mensagem, _position, _tipo) {
        $.toast({
            heading: _titulo,
            text: _mensagem,
            position: _position,
            icon: _tipo
        });
    }

    /**
     * FUNÇÃO QUE FECHA A ABA DO MENU EM ABAS
     * @param {type} _nameModulo
     * @returns {undefined}
     */
    function fcnCloseNavTab(_nameModulo) {
        var _id = _nameModulo + '-tab';
        document.getElementById(_id).parentNode.remove();

        var _id = _nameModulo;
        document.getElementById(_id).remove();

        var _t = document.getElementById('bzTab').childNodes.length;
        if (_t == 0) {
            window.location.replace("<?= site_url(); ?>");
        } else {

            var _lastChild = document.getElementById("bzTab").lastChild;
            var _lastChildID = _lastChild.id;
            document.getElementById(_lastChildID).children[0].click();
        }

    }
    /* END FUNÇÃO QUE FECHA A ABA DO MENU EM ABAS */


    /*
     *  FUNÇÃO QUE CARREGA O MODULO DO SISTEMA DENTRO DO IFRAME DO PAINEL PRINCIPAL
     */

    $(function () {


        function _sizeContainer(_iframe_modulo) {
            var _container_fluid_width = $('.content-wrapper').width();
            var _container_fluid_height = $('.sidebar').height() - 20;
            $('.iframe-modulo-' + _iframe_modulo).parent().css('height', _container_fluid_height);
        }


        $('.j-btn-linkmenu').click(function () {
            event.preventDefault();

            $('#modal-aguarde').modal({
                backdrop: 'static',
                keyboard: false,
                show: true,
            });

            var nameModulo = $(this).attr('href');
            nameModulo = nameModulo.replace("#", "");


            $("li a").removeClass("bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>-active");
            $(this).addClass('bg-<?= ___BZ_LAYOUT_SKINCOLOR___; ?>-active');


            $('.header-dashboard').remove();
            var url = '<?= site_url(); ?>/' + $(this).attr('href');
            url = url.replace("#", "");


            var _iframe_modulos_content = $('.iframe-modulos').val();

            $('body').removeClass('sidebar-open');

            if ($("#bz-tab-modulos").find("#" + nameModulo + "-tab").length) {

                $('#modal-aguarde').modal('hide');
                $('.iframe-modulo-' + nameModulo).attr('src', url);

            } else {

                var _n = $("#bzTab").children().length + 1;

                $('#bz-tab-modulos #bzTab').append('<li id="bzTabModulos-bzTabNavItem-' + _n + '" class="nav-item"><a class="nav-link" id="' + nameModulo + '-tab" data-toggle="tab" href="#' + nameModulo + '" role="tab" aria-controls="' + nameModulo + '" aria-selected="true">' + $(this).html() + '<span onclick="fcnCloseNavTab(\'' + nameModulo + '\');" class="margin-left-5 mouse-cursor-pointer">×</span></a></li>');
                $('#bz-tab-modulos #bzTabContent').append('<div class="tab-pane fade" id="' + nameModulo + '" role="tabpanel" aria-labelledby="' + nameModulo + '-tab"></div>');

                $('#bz-tab-modulos #bzTabContent #' + nameModulo).html('<iframe class="iframe-modulo-' + nameModulo + ' invisible margin-top-0" src="" width="100%"  scrolling="yes" style="border: none; min-height: 100% !important"></iframe>');

                $('.iframe-modulo-' + nameModulo).attr('src', url);
                $('.iframe-modulo-' + nameModulo).removeClass('invisible');


            }

            $('#' + nameModulo + '-tab').trigger("click");

            _sizeContainer(nameModulo);

        });


    });


    /*
     * AJAX FORM SETTINGS
     */
    $(function () {
        $('.btn-salvar-formsettings').click(function () {

            $('#modal-aguarde').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
            });

            var _site_url = '<?= site_url('dashboard'); ?>';

            var add_url = _site_url + '/formSettings?acao=add-form-settings';
            var dados = $('form[name="form-settings"] ').serialize();

            $.ajax({
                'type': 'POST',
                'url': add_url,
                'data': dados,
                'cache': false,
                'dataType': 'html',
                'beforeSend': function () {
                },
                'error': function () {
                },
                'success': function (retorno) {

                    if ($.trim(retorno) == 'OK') {
                        //msg_toastr('SUCESSO', 'Configurações Gerais Alterado com Sucesso.', 'top-center', 'success');
                        location.reload(true);

                        //swal('SUCESSO', 'Configurações Gerais Alterado com Sucesso.', 'success')
                        //    .then((value) => {
                        //        //window.location.href = "<? ////= site_url();                                                                                                                         ?>////";
                        //        location.reload(true);
                        //    });

                        var em_manutencao = $("input[name='em_manutencao']").is(':checked') ? 'SIM' : 'NAO';

                        if (em_manutencao == 'SIM') {
                            $('.j-em-manutencao').removeClass('hidden');
                        } else {
                            $('.j-em-manutencao').addClass('hidden');
                        }

                    } else {

                        alert('ERRO INESPERADO - ' + $.trim(retorno));

                    }

                },
                'complete': function () {
                    $('#modal-aguarde').modal('hide');
                }
            });


            return false;
        });


    });
</script>