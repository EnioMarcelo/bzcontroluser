<!--SIDEBAR CASE MACROS-->

<aside class="control-sidebar control-sidebar-light" style="position: fixed; max-height: 100%; overflow: auto; padding-bottom: 50px;">
    <div id="" class="" style="margin-top:-50px; text-align: center;"><h4>Macros</h4></div>

    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

        <li class="active"><a href="#control-sidebar-database-tab" data-toggle="tab"><i class="fa fa-database"></i></a></li>
        <li><a href="#control-sidebar-modelo-tab" data-toggle="tab"><i class="fa fa-language"></i></a></li>
        <li><a href="#control-sidebar-diversos-tab" data-toggle="tab"><i class="fa fa-puzzle-piece"></i></a></li>
        <li><a><span class="fa fa-close j-tooltip mouse-cursor-pointer" data-toggle="control-sidebar" data-placement="bottom" data-toggle="tooltip" data-original-title="Fechar"></span></a></li>

    </ul>




    <!-- Stats tab content -->
    <div class="tab-content">


        <!-- Data Base tab content -->
        <div class="tab-pane active" id="control-sidebar-database-tab" style="margin-top:-15px;">

            <h4 class='control-sidebar-heading'>
                <spam>Data Base</spam>
            </h4>

            <ul class="list-unstyled clearfix" style="margin-top:-10px">
                <li style="float:left; width: 100%; padding: 0px;">

                    <ul class="list-unstyled">
                        <li class="margin-bottom-3">Insert, Update, Delete</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DATABASE_INSERT___); ?>">Insert</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DATABASE_UPDATE___); ?>">Update</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DATABASE_DELETE___); ?>">Delete</button></li>

                        <li class="margin-bottom-3 margin-top-10">Find Data Query</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_ARRAY_FIND_ALL___); ?>">Find All Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_ARRAY_FIND_BY_ID___); ?>">Find By ID Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_ARRAY_FIND_BY_FIELD___); ?>">Find By Field Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_ARRAY_FIND_WHERE_PARAM___); ?>">Find By Where Data</button></li>

                        <li class="margin-bottom-3 margin-top-10">Auditoria</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_AUDITORIA_ADD___); ?>">Auditoria Add</button></li>

                        <li class="margin-bottom-3 margin-top-10">Depuração</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_VAR_DUMP___); ?>">var_dump()</button></li>

                    </ul>


                </li>
            </ul>
        </div>
        <!-- Data Base tab content -->

        <!-- Modelo 1 tab content -->
        <div class="tab-pane" id="control-sidebar-modelo-tab" style="margin-top:-15px;">

            <h4 class='control-sidebar-heading'>
                Modelos
            </h4>

            <ul class="list-unstyled clearfix" style="margin-top:-10px">
                <li style="float:left; width: 100%; padding: 0px;">

                    <ul class="list-unstyled">
                        <li class="margin-bottom-3">Modals e Alerts</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_MODAL___); ?>">Modal</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ALERT_BOOTSTRAP_DEFAULT___); ?>">Alert Default</button></li>                        
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ALERT_NOTFIT___); ?>">Alert NotFit</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ALERT_SWEET___); ?>">Alert Sweet</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ALERT_TOAST___); ?>">Alert Toast</button></li>

                        <li class="margin-bottom-3 margin-top-10">Email</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_SEND_MAIL___); ?>">Send Mail</button></li>

                        <li class="margin-bottom-3 margin-top-10">Array Filter</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ARRAY_FILTER_FIELD___); ?>">Array Filter Field</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ARRAY_FILTER_LIKE___); ?>">Array Filter Like</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ARRAY_CASE_SENSITIVE___); ?>">Array Case Sensitive</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ARRAY_EXCLUDE_FIELD___); ?>">Array Exclude Fields</button></li>



                        <li class="margin-bottom-3 margin-top-10">Depuração</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_VAR_DUMP___); ?>">var_dump()</button></li>


                    </ul>


                </li>
            </ul>
        </div>
        <!-- Modelo 1 tab content -->

        <!-- Modelo 2 tab content -->
        <div class="tab-pane" id="control-sidebar-diversos-tab" style="margin-top:-15px;">

            <h4 class='control-sidebar-heading'>
                Diversos
            </h4>

            <ul class="list-unstyled clearfix" style="margin-top:-10px">
                <li style="float:left; width: 100%; padding: 0px;">

                    <ul class="list-unstyled">

                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_CUT_WORDS___); ?>">String Corta Palavras</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_MONTH_DATE___); ?>">Mês de uma Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_EXTENSIVE_VALUE___); ?>">Valor por Extenso</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_FARMAT_DATE___); ?>">Formata Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_CONTAINS_STRING___); ?>">Contem na String</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_FORMAT_MOEDA___); ?>">Formatação de Moeda</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_RANDOM_STRING___); ?>">String Randômica</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_FILL_STRING___); ?>">Preenche String</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_REDIRECT_APP___); ?>">Redirect</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_PARAMETERS_URL___); ?>">Parâmetros da URL</button></li>




                        <li class="margin-bottom-3 margin-top-10">Depuração</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_VAR_DUMP___); ?>">var_dump()</button></li>

                    </ul>


                </li>
            </ul>
        </div>
        <!-- Modelo 2 tab content -->




    </div><!-- /.tab-pane -->
    <!-- Stats tab content -->


</aside>



<!--END SIDEBAR CASE MACROS-->
