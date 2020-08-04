<!-- Modal -->
<div style="z-index: 99999" class="modal fade" id="modalBackupAppExport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalBackupAppExportLongTitle">APP Exportado com sucesso !!!</h5>
            </div>
            <div class="modal-body hidden">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" id="modalBackupAppExportBtnCopyCode" class="btn btn-primary">Copiar Código
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {

        /** EXPORT APP */
        $('.j-btn-export-app').on('click', function (e) {
            e.preventDefault();

            var _btn = $(this);
            var _app_nome = _btn.data('appnome');

            var _url = "<?=site_url('projectbuildcrud/backupapp');?>";
            var _jsonData = {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'app_name': _app_nome,
                'action': 'export'
            };

            $.post(_url, _jsonData, function (response) {

                if (response.msg) {

                    $('#modalBackupAppExport .modal-body').html(response.msg.app_exported);
                    $('#modalBackupAppExport .modal-body').CopyToClipboard('Código do APP Exportado com Sucesso');

                    swal(
                        response.msg.title,
                        response.msg.text,
                        response.msg.type
                    );

                }

            }, "json")
                .done(function (response) {

                })
                .fail(function () {
                    swal(
                        'Erro!!!',
                        'Um erro inesperado ocorreu.',
                        'error'
                    );
                })
                .always(function () {
                    modalAguardeOff();
                });


        });


        /** IMPORT APP */

        /** QUANDO O BOTÃO DE ABRIR O MODAL IMPORT FOR CLICADO */
        $('#modalImportApp').on('show.bs.modal', function () {

            $('#modalImportApp').css('background-color', 'rgba(255, 255, 255, 0.8);');

            $('textarea[name=code_app_import]').val('');
            $('input[name=app_nome]').val('');

        });

        /** QUANDO O BOTÃO DE FECHAR O MODAL IMPORT FOR CLICADO */
        $('#modalImportApp').on('hide.bs.modal', function () {
            $('#modalImportApp').css('background-color', 'transparent;');
        });


        /** QUANDO O BOTÃO DE IMPORTAR O CÓDIGO DO APP FOR CLICADO */
        $('#modalImportApp').on('click', '#btnImportApp', function () {

            var _appNome = $('input[name=app_nome]').val();
            var _codeImportLenght = $('textarea[name=code_app_import]').val().length;
            var _codeImport = $('textarea[name=code_app_import]').val();

            if (_codeImportLenght === 0) {
                swal(
                    'Atenção!!!',
                    'Nenhum código para importação foi informado.',
                    'warning'
                );
                return false;
            }

            var _url = "<?=site_url('projectbuildcrud/backupapp');?>";
            var _jsonData = {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'app_name': _appNome,
                'code_app_import': _codeImport,
                'action': 'import'
            };

            modalAguardeOn();

            $.post(_url, _jsonData, function (response) {

                if (response.msg) {

                    swal(
                        response.msg.title,
                        response.msg.text,
                        response.msg.type
                    );
                }

            }, "json")
                .done(function (response) {
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                })
                .fail(function () {

                    modalAguardeOff();

                    swal(
                        'Erro!!!',
                        'Um erro inesperado ocorreu.',
                        'error'
                    );
                })
                .always(function () {
                    modalAguardeOff();
                });

        });


    });
</script>
