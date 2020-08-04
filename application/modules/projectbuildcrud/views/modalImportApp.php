<!-- Modal -->
<div id="modalImportApp" style="z-index: 99999"  class="modal fade shadow-lg" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Importar App</h3>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="app_nome">Nome do Aplicativo:</label>
                    <input type="text" class="form-control" id="app_nome" name="app_nome">
                </div>

                <div class="form-group">
                    <label for="comment">Cole [CTRL+V] aqui o código do APP que foi exportado:</label>
                    <textarea name="code_app_import" class="form-control" rows="10" id="comment"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" id="btnImportApp" class="btn bg-yellow-gradient text-black" data-dismiss="modal">
                    <span class="glyphicon glyphicon-import"></span> Importar APP
                </button>
            </div>
        </div>

    </div>
</div>
<!-- End Modal -->