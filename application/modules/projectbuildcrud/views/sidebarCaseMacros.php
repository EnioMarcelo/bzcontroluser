<!--SIDEBAR CASE MACROS-->

<aside class="control-sidebar control-sidebar-light"
       style="position: fixed; max-height: 100%; overflow: auto; padding-bottom: 50px;">
    <div id="" class="" style="margin-top:-50px; text-align: center;"><h4 id="title-sidebar-tabs">
            Macros <?= ($_parametros['code_type'] == 'jquery') ? 'jQuery' : ''; ?></h4></div>

    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <?php if ($_parametros['code_type'] !== 'jquery'): ?>
            <li class="active"><a href="#control-sidebar-database-tab" data-toggle="tab"><i class="fa fa-database"></i></a>
            </li>
            <li><a href="#control-sidebar-modelo-tab" data-toggle="tab"><i class="fa fa-language"></i></a></li>
            <li><a href="#control-sidebar-diversos-tab" data-toggle="tab"><i class="fa fa-puzzle-piece"></i></a></li>
        <?php elseif ($_parametros['code_type'] == 'jquery'): ?>
            <li class="active"><a href="#control-sidebar-jquery-tab" data-toggle="tab"><i class="">jQuery</i></a></li>
        <?php endif; ?>

        <?php if ($_parametros['code_type'] == 'onrecord' || $_parametros['code_type'] == 'onrecordexport'): ?>
            <li><a href="#control-sidebar-fields-table-tab" data-toggle="tab"><i
                            class="glyphicon glyphicon-indent-left"></i></a></li>
        <?php endif; ?>
        <li><a><span class="fa fa-close j-tooltip mouse-cursor-pointer" data-toggle="control-sidebar"
                     data-placement="bottom" data-toggle="tooltip" data-original-title="Fechar"></span></a></li>

    </ul>


    <!-- Stats tab content -->
    <div class="tab-content">

        <?php if ($_parametros['code_type'] !== 'jquery'): ?>
            <!-- Data Base tab content -->
            <div class="tab-pane active" id="control-sidebar-database-tab" style="margin-top:-15px;">

                <h4 class='control-sidebar-heading'>
                    <spam>Data Base</spam>
                </h4>

                <ul class="list-unstyled clearfix" style="margin-top:-10px">
                    <li style="float:left; width: 100%; padding: 0px;">

                        <ul class="list-unstyled">
                            <li class="margin-bottom-3">Insert, Update, Delete</li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DATABASE_INSERT___; ?>">Insert
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DATABASE_UPDATE___; ?>">Update
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DATABASE_DELETE___; ?>">Delete
                                </button>
                            </li>

                            <li class="margin-bottom-3 margin-top-10">Find Data Query</li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_ARRAY_FIND_ALL___; ?>">Find All Data
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_ARRAY_FIND_BY_ID___; ?>">Find By ID Data
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_ARRAY_FIND_BY_FIELD___; ?>">Find By Field Data
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_ARRAY_FIND_WHERE_PARAM___; ?>">Find By Where
                                    Data
                                </button>
                            </li>

                            <li class="margin-bottom-3 margin-top-10">Auditoria</li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_AUDITORIA_ADD___; ?>">Auditoria Add
                                </button>
                            </li>

                            <li class="margin-bottom-3 margin-top-10">Depuração</li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_VAR_DUMP___; ?>">var_dump()
                                </button>
                            </li>

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
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_MODAL___; ?>">Modal
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ALERT_BOOTSTRAP_DEFAULT___; ?>">Alert
                                    Default
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ALERT_TRIGGER_NOTFI___; ?>">Alert
                                    Trigger NotFit
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ALERT_NOTFIT___; ?>">Alert NotFit
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ALERT_SWEET___; ?>">Alert Sweet
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ALERT_TOAST___; ?>">Alert Toast
                                </button>
                            </li>

                            <li class="margin-bottom-3 margin-top-10">Email</li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_SEND_MAIL___; ?>">Send Mail
                                </button>
                            </li>

                            <li class="margin-bottom-3 margin-top-10">Array Filter</li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ARRAY_FILTER_FIELD___; ?>">Array Filter
                                    Field
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ARRAY_FILTER_LIKE___; ?>">Array Filter
                                    Like
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ARRAY_CASE_SENSITIVE___; ?>">Array Case
                                    Sensitive
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_MODELO_ARRAY_EXCLUDE_FIELD___; ?>">Array
                                    Exclude Fields
                                </button>
                            </li>


                            <li class="margin-bottom-3 margin-top-10">Depuração</li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_VAR_DUMP___; ?>">var_dump()
                                </button>
                            </li>


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

                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_FARMAT_DATE___; ?>">Formata Data
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_MONTH_DATE___; ?>">Mês de uma Data
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_CALC_DATE_DIFF___; ?>">Diferença
                                    entre datas
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_CALC_TIME_DIFF___; ?>">Diferença
                                    entre horas
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_EXTENSIVE_VALUE___; ?>">Valor por
                                    Extenso
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_CONTAINS_STRING___; ?>">Contém na
                                    String
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_LIMIT_CHARS___; ?>">String Limit
                                    Chars
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_LIMIT_WORDS___; ?>">String Limit
                                    Words
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_FORMAT_MOEDA___; ?>">Formata Moeda
                                </button>
                            </li>
                            <button type="button"
                                    class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                    data-toggle="control-sidebar"
                                    data-clipboard-message="Copiado com sucesso."
                                    data-clipboard-text="<?= ___MACRO_DIVERSOS_FORMAT_CPF_CNPJ___; ?>">Formata CPF/CNPJ
                            </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_RANDOM_STRING___; ?>">String
                                    Randômica
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_FILL_STRING___; ?>">Preenche String
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_REDIRECT_APP___; ?>">Redirect
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_PARAMETERS_URL___; ?>">Parâmetros da
                                    URL
                                </button>
                            </li>


                            <li class="margin-bottom-3 margin-top-10">Depuração</li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_DIVERSOS_VAR_DUMP___; ?>">var_dump()
                                </button>
                            </li>

                        </ul>


                    </li>
                </ul>
            </div>
            <!-- Modelo 2 tab content -->
        <?php elseif ($_parametros['code_type'] == 'jquery'): ?>

            <!-- jQuery tab content -->
            <div class="tab-pane active" id="control-sidebar-jquery-tab" style="margin-top:-15px;">

                <ul class="list-unstyled clearfix" style="margin-top:-10px">
                    <li style="float:left; width: 100%; padding: 0px;">

                        <ul class="list-unstyled">
                            <li class="margin-bottom-3">Scripts</li>

                            <!--TODOS-->
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_JS_AJAX_POST___; ?>">Ajax Post
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_JS_OPEN_MODAL___; ?>">Open Modal
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_JS_CLOSE_MODAL___; ?>">Close Modal
                                </button>
                            </li>
                            <li>
                                <button type="button"
                                        class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                        data-toggle="control-sidebar"
                                        data-clipboard-message="Copiado com sucesso."
                                        data-clipboard-text="<?= ___MACRO_JS_ALERT_SWEET_ALERT___; ?>">Alert Sweet
                                </button>
                            </li>
                            <button type="button"
                                    class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                    data-toggle="control-sidebar"
                                    data-clipboard-message="Copiado com sucesso."
                                    data-clipboard-text="<?= ___MACRO_JS_ALERT_NOTFIT___; ?>">Alert NotFit
                            </button>
                            <button type="button"
                                    class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                    data-toggle="control-sidebar"
                                    data-clipboard-message="Copiado com sucesso."
                                    data-clipboard-text="<?= ___MACRO_JS_ALERT_TOASTER___; ?>">Alert Toaster
                            </button>
                            </li>

                            <!--GRID LIST-->
                            <?php if (mc_slug($_parametros['code_screen_title']) == 'grid-list'): ?>
                                <li>
                                    <button type="button"
                                            class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                            data-toggle="control-sidebar"
                                            data-clipboard-message="Copiado com sucesso."
                                            data-clipboard-text="<?= ___MACRO_JS_BUTTONS_GRIDLIST___; ?>">Buttons Grid
                                        List
                                    </button>
                                </li>
                                <li>
                                    <button type="button"
                                            class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                            data-toggle="control-sidebar"
                                            data-clipboard-message="Copiado com sucesso."
                                            data-clipboard-text="<?= ___MACRO_JS_SEARCH_BAR_ELEMENT_GRIDLIST___; ?>">
                                        Search Element
                                    </button>
                                </li>
                            <?php endif; ?>

                            <!--FORM ADD/EDIT-->
                            <?php if (mc_slug($_parametros['code_screen_title']) == 'form-add' || mc_slug($_parametros['code_screen_title']) == 'form-edit'): ?>
                                <li>
                                    <button type="button"
                                            class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                            data-toggle="control-sidebar"
                                            data-clipboard-message="Copiado com sucesso."
                                            data-clipboard-text="<?= ___MACRO_JS_BUTTONS_FORM_ADD_EDIT___; ?>">Buttons
                                        Form Add/Edit
                                    </button>
                                </li>

                                <li>
                                    <button type="button"
                                            class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                            data-toggle="control-sidebar"
                                            data-clipboard-message="Copiado com sucesso."
                                            data-clipboard-text="<?= ___MACRO_JS_REMOVE_JQUERY_MASK_ON_SAVE_OR_EDIT___; ?>">Remove Input Mask<br/>SAVE/EDIT
                                    </button>
                                </li>
                            <?php endif; ?>
                        </ul>

                    </li>
                </ul>
            </div>
            <!-- jQuery tab content -->

        <?php endif; ?>

        <?php if ($_parametros['code_type'] == 'onrecord' || $_parametros['code_type'] == 'onrecordexport'): ?>

            <div class="tab-pane" id="control-sidebar-fields-table-tab" style="margin-top:-15px;">
                <ul class="list-unstyled clearfix" style="margin-top:20px">
                    <li style="float:left; width: 100%; padding: 0px;">
                        <ul class="list-unstyled">
                            <?php foreach ($_fields_table as $_field): ?>
                                <li class="hover">
                                    <button type="button" style="margin: 0; padding: 0; "
                                            class="btn btn-defaultx btn-block margin-bottom-3 j-btn-sidebar-database-insert"
                                            data-toggle="control-sidebar"
                                            data-clipboard-message="Copiado com sucesso."
                                            data-clipboard-text="<?= base64_encode('{{' . $_field['field_name'] . '}}'); ?>"><?= $_field['field_name']; ?></button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>

        <?php endif; ?>


    </div><!-- /.tab-pane -->
    <!-- Stats tab content -->


</aside>


<style>

    li.hover > button {
        background: #f4f4f5;
    }

    li.hover > button:hover {
        background: #357FA9;
        color: white !important;
    }

    li.hover > button:active {
        background: #76B3D3;
    }

</style>


<!--END SIDEBAR CASE MACROS-->
