
<script>

    $(function () {

        $('.table-bordered>tbody>tr').click(function () {

            var _r = $(this);
            var _s = _r.find(".last-query").text();


            if (_s) {
                $('.modal-body').html(_s);
                _r.addClass('clickedtr');
            } else {
                return false;
            }

        });

        $("#myModal").on('hidden.bs.modal', function () {
            $('.table>tbody>tr.clickedtr').removeClass('clickedtr');
        });


    });

</script>
