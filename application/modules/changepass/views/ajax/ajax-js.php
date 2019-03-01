
<script>

    <!-- AO CLICAR NA JANELA DE AVISO DE ENVIO DE EMAIL COM SUCESSO, SERÁ REDIRECIONADO AUTOMATICAMENTE PARA TELA DE LOGIN -->
    $(function () {
        $('.swal-button--confirm').on("click", function () {
            window.location.href = "<?= site_url('login'); ?>";
        });
    });



    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });



    $(function () {
        setTimeout(function () {
            //$('.alert').fadeOut(1000);
        }, 3000);
    });


</script>