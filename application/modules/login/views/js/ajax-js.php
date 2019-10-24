<script>
    $(function () {

        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });


        setTimeout(function () {

            $('.alert').fadeOut(1000);

        }, 3000);
    });
</script>