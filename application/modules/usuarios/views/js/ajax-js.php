<script>


    $(function () {

        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '';

        if (csrfHash === '') {
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        }


        $(".j-btn-change-pass-user").click(function () {

            $(document).keydown(function (e) {
                if (e.keyCode == 32) {
                    return false;
                }
            });

            var _id = $(this).attr('data-id');
            var _email = $(this).attr('data-email');
            var _name = $(this).attr('data-nome');
            var _xpass = '';

            swal({
                title: 'Alterar Senha',
                text: 'Usuário: ' + _name + '\n E-Mail: ' + _email,

                content: {
                    element: "input",
                    attributes: {
                        placeholder: "Digite a Senha Aqui...",
                        type: "password",
                    },

                },
                button: {
                    text: "Alterar Senha",
                    closeModal: false,
                },

            }).then(_pass => {
                if (!_pass) {
                    swal.stopLoading();
                    swal.close();
                    return false;
                }


                var _dados = {
                    [csrfName]: csrfHash,
                    id: _id,
                    email: _email,
                    pass: _pass,
                    task: 'changepass'
                };


                $.ajax({
                    type: "POST",
                    url: "<?= site_url($this->router->fetch_class() . '/changepass'); ?>",
                    data: _dados,
                    dataType: "json",
                    beforeSend: function () {

                        /* SEU CÓDIGO AQUI... */

                    }, success: function (data) {

                        if (data.csrf_token) {
                            csrfHash = data.csrf_token;
                        }

                        if (data.success === 'true') {
                            swal("SUCESSO!", "Senha do usuário " + _name + " foi alterada com sucesso!", "success");
                        } else {
                            return swal("ATENÇÃO!", "Senha do usuário " + _name + " não foi alterada! ", "warning");
                        }



                    }, error: function (error) {

                        swal("Opss!", "A solicitação via AJAX falhou! - Error: " + error.status, "error");
                        swal.stopLoading();
                        swal.close();

                    }


                });


            });





        });



        $(".j-btn-poweroff-user").click(function () {

            var _status = $(this).attr('data-rel');
            var _id = $(this).attr('data-id');
            var _email = $(this).attr('data-email');
            var _name = $(this).attr('data-nome');

            if (_status === 'poweron') {

                var _dados = {
                    [csrfName]: csrfHash,
                    id: _id,
                    email: _email,
                    nome: _name,
                    task: 'poweroffuser'
                };

                $.ajax({
                    type: "POST",
                    url: "<?= site_url($this->router->fetch_class() . '/poweroff'); ?>",
                    data: _dados,
                    dataType: "json",
                    beforeSend: function () {

                        /* SEU CÓDIGO AQUI... */

                    }, success: function (data) {

                        if (data.notpoweroff === 'true') {
                            swal("ATENÇÃO!", "O Usuário " + _name + "\nnão pode ser DESCONECTADO do Sistema!", "warning");
                        }

                        if (data.success === 'true') {

                            $('#' + _id).removeClass('btn-success').addClass('btn-default');
                            $('#' + _id + ' span').attr('data-original-title', 'Usuário Desconectado');

                            swal("SUCESSO!", "O Usuário " + _name + "\nfoi DESCONECTADO do Sistema!", "success");
                        }

                        if (data.csrf_token) {
                            csrfHash = data.csrf_token;
                        }

                    }, complete: function () {

//                        parent.$('#modal-aguarde').modal('hide');
                        $('#modal-aguarde').modal('hide');

                    }, error: function (error) {

                        swal("Opss!", "A solicitação via AJAX falhou! - Error: " + error.status, "error");
                        swal.stopLoading();
                        swal.close();

                    }


                });


            }

            parent.$('#modal-aguarde').modal('hide');
            return false;

        });


    });


</script>