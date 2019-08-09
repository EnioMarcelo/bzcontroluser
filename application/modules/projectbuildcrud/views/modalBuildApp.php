<!--MODAL BUILD APP-->

<div id="modalBuildApp" class="modal" style="margin-top:-20px;" tabindex="-1" role="dialog" aria-labelledby="modalBuildAppLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Gerando APP</h4>
                <button type="button" style="margin-top:-20px;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="modalBuildAppIframe" src="" style="border:none;" width="100%" height="200px;"></iframe>
            </div>
        </div>
    </div>
</div>


<script>

    $(function () {

        $('#modalBuildApp').on('show.bs.modal', function (event) {

            var _button = $(event.relatedTarget);
            var _src = _button.data('build');
            var _width = _button.data('width');
            var _height = _button.data('height');
            var _title = _button.data('title');

            $("#modalBuildApp .modal-title").html(_title);
            $("#modalBuildApp .modal-dialog").css('width', _width);
            $("#modalBuildApp").find('iframe').css('height', _height);
            $("#modalBuildApp").find('iframe').attr('src', _src);
            // $("#modalBuildApp").find('iframe').hide();

            $('#modalBuildAppIframe').load(function () {
                $('#modalBuildAppIframe').contents().find(".j-btn-open-modal-fullscreen").remove();
                // $("#modalBuildApp").find('iframe').show();
            });

        });


    });

</script>

<!--END MODAL BUILD APP-->