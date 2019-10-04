<style>


    /*  BUTTON TOGGLE */
    .toggle.btn {
        /*min-width: 140px !important;*/
    }


    /* EFEITO FADE IN */
    @keyframes fadeIn {
        0% {
            transform: scale(1);
            opacity: 0;
        }
    }

    /* MODAL */
    .bz_modal{
        display: block;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        z-index: 98;

    }

    .bz_modal_box{
        z-index: 99;
        display: flex;
        position: relative;
        width: 90%;
        max-width: 90%;
        height: 90%;
        max-width: 90%;
        /*background: rgba(255,255,255,0.3);*/
        margin: 3% auto;
        /*padding: 10px;*/
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;

        animation-duration: 1s;
        animation-name: fadeIn;

    }

    .bz_modal_box_close{
        position: absolute;
        top: -8px;
        right: -8px;
        font-size: 0.9em;
        font-weight: bold;
        padding: 7px 11px;
        cursor: pointer;
        background: #000;
        border: 2px double #ccc;
        border-radius: 50%;
        -moz-border-radius:  50%;
        -webkit-border-radius:  50%;
        z-index: 99;

    }

    .bz_modal_box_close:hover{
        background: #999999;
        color: black;
    }

    .bz_modal_box .header{
        padding: 0px;
        color: #fff;
        /*text-align: center;*/
        border-radius: 3px 3px 0 0;
        -moz-border-radius: 3px 3px 0 0;
        -webkit-border-radius: 3px 3px 0 0;
    }

    .bz_modal_box .header p{
        font-weight: 500;
        font-size: 1.5em;
        text-shadow: 1px 1px 0 #555;
    }

    .bz_modal_box #bz_modal_content{
        padding: 0px;
        background: #fff;
        border-radius: 0 0 3px 3px;
        -moz-border-radius: 0 0 3px 3px;
        -webkit-border-radius: 0 0 3px 3px;
    }

    #bz_modal_content {
        width: 100%;
        text-align: center;
        box-sizing: border-box;
        overflow:scroll;

    }
    #bz_modal_content *{
        box-sizing: border-box; 
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }

    #bz_modal_content img, #bz_modal_content iframe{
        max-width: 100%;
        width: 100%;
        height: 100%;
        max-height: 100%;
    }

    /* CORES */
    .color_blue{color: #0E96E5;}
    .color_green{color: #56b748;}
    .color_yellow{color: #F2AA27;}
    .color_red{color: #F43E33;}
    .color_purple{color: #7551CD;}
    .color_pink{color: #B873CD;}

    .bg_blue{background-color: #0E96E5;}
    .bg_green{background-color: #56b748;}
    .bg_yellow{background-color: #F2AA27;}
    .bg_red{background-color: #F43E33;}
    .bg_purple{background-color: #7551CD;}
    .bg_pink{background-color: #B873CD;}

    #modal-btn-edit-field-table-formaddedit{ display:none; }

    #bz_modal_content iframe {
        display: flex;
        height: 100%;
        max-height: 100%;

    }

</style>


<!--MODAL EDIT CAMPOS DO FORM ADD/ADIT DO APP-->
<div id="modal-btn-edit-field-table-formaddedit" style="display:none;" class="bz_modal">

    <div class="bz_modal_box">

        <div class="header bz_modal_box_close j_btn_modal_box_close">
            <span class="bz_modal_box_close j_btn_modal_box_close">X</span>
        </div>

        <div id="bz_modal_content">

            <button type="button" class="btn btn-primary btn-show-modal-aguarde j_btn_save_form_formAddEdit pull-right margin-top-10 margin-right-25"><i class="fa fa-fw fa-save margin-right-5"></i>Salvar</button>

            <div class="content">

                <h4 style="margin-top:0 !important; margin-bottom:10 !important;">Form ADD/EDIT</h4>

                <h3 class="border-bottom-1 padding-bottom-10 margin-top-0" >Editando Campo : <i id="form_add_edit_modal_field_name" style="font-weight: 200"></i></h3>


                <div id="formaddedit" class="tab-pane fade in active text-left">

                    <?= form_open(site_url($this->router->fetch_class() . '/setup_formaddedit'), 'id="formAddEdit" class="col-md-12 margin-left-0 padding-left-0 margin-right-0 padding-right-0" role="form"'); ?>

                    <input type="hidden" name="task" value="save">
                    <input type="hidden" name="modal_projeto_id" value="">
                    <input type="hidden" name="field_name" value="">
                    <input type="hidden" name="screen_type" value="">
                    <input type="hidden" name="primary_key" value="">


                    <div class="row margin-left-0 padding-left-0 margin-right-0 padding-right-0 margin-top-20">

                        <!--COLUNA 1-->
                        <div class="col-md-4 margin-left-0 padding-left-0">

                            <!--EXIBE O CAMPO NO FORM SIM/NÃO-->
                            <div class="col-md-12">
                                <label>Exibir:</label>
                                <div class="form-group">
                                    <label class="margin-right-15 text-normal">
                                        SIM
                                        <input type="radio" id="form_add_edit_field_show_on" name="form_add_edit_field_show" class="flat-green" value="on">
                                    </label>
                                    <label class="text-normal">
                                        NÃO 
                                        <input type="radio" id="form_add_edit_field_show_off" name="form_add_edit_field_show" class="flat-red hover checked" aria-checked="true" value="off">
                                    </label>
                                </div>
                            </div>

                            <!--TIPO DO CAMPO-->
                            <div class="form-group col-md-12">
                                <label>Tipo do Campo:</label>
                                <select class="form-control input-sm" name="form_add_edit_field_type">
                                    <option value="">Selecione...</option>
                                    <option value="text">Texto</option>
                                    <option value="text-long">Texto Longo</option>
                                    <option value="text-ckeditor">Editor Texto HTML - cKeditor</option>
                                    <option value="email">E-Mail</option>
                                    <option value="date">Data</option>
                                    <option value="time">Hora</option>
                                    <option value="datetime">Data e Hora</option>
                                    <option value="number">Número Inteiro</option>
                                    <option value="number-decimal">Número Decimal</option>
                                    <option value="moeda">Moeda</option>
                                    <option value="senha">Senha</option>
                                    <option value="upload-imagem">Upload de Imagem</option>
                                    <option value="select-manual">Select Dropdown - Manual</option>
                                    <option value="select-dinamic">Select Dropdown - Dinâmico</option>
                                    <option value="select-multiple-manual">Select Multiplo - Manual</option>
                                    <option value="select-multiple-dinamic">Select Multiplo - Dinâmico</option>
                                    <option value="radio-manual">Radio Button - Manual</option>
                                    <option value="radio-dinamic">Radio Button - Dinâmico</option>
                                    <option value="checkbox-manual">CheckBox - Manual</option>
                                    <option value="checkbox-multiple-manual">CheckBox Multiplo - Manual</option>
                                    <option value="checkbox-multiple-dinamic">CheckBox Multiplo - Dinâmico</option>
                                </select>
                            </div>

                            <!--LABEL DO CAMPO-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Label:</label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group-addon bg-green-active j-tooltip j-flag-pk" data-placement="bottom" data-toggle="tooltip" data-original-title="Chave Primária">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <input class="form-control input-sm" type="text" placeholder="Label" name="form_add_edit_field_label" value="">
                                </div>
                            </div>

                            <!--PLACEHOLDER DO CAMPO-->
                            <div class="form-group col-md-12">
                                <label>Placeholder:</label>
                                <input class="form-control input-sm" type="text" placeholder="Placeholder do Campo" name="form_add_edit_field_placeholder" value="">
                            </div>

                            <!--MASCARA DO CAMPO-->
                            <div class="form-group col-md-12 hide">
                                <label>Mascara: <span style=" font-size: 1em; font-weight: 100">Lib jQuery Mask</span></label>
                                <input class="form-control input-sm" type="text" placeholder="Mascara do Campo" name="form_add_edit_field_mask" value="">
                            </div>


                            <!--COMPLEMENTO DA MASCARA DO CAMPO-->
                            <div class="form-group col-md-12 hide">
                                <label>Complemento da Mascara: <span style=" font-size: 1em; font-weight: 100">Lib jQuery Mask</span></label>
                                <textarea class="form-control input-sm" name="form_add_edit_field_mask_complement" placeholder="Complemento da Mascara do Campo" rows="3" wrap="hard" value=""></textarea>
                            </div>

                            <!--SE O CAMPO FOR SELECT DROPDOWN MANUAL, VALORES DO SELECT: VALOR1|LABEL1,VALOR2|LABEL2-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Select. <span style=" font-size: 0.9em; font-weight: 100">Ex:VALOR1|LABEL1,VALOR2|LABEL2</span></label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="form_add_edit_field_value_select_manual" placeholder="Ex:VALOR1|LABEL1,VALOR2|LABEL2" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>

                            <!--SE O CAMPO FOR SELECT DROPDOWN DINÂMICO-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Select. <span style=" font-size: 0.9em; font-weight: 100">QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao</span></label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="form_add_edit_field_value_select_dinamic" placeholder="QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>

                            <!--SE O CAMPO FOR SELECT MULTIPLO MANUAL, VALORES DO SELECT MULTIPLO: VALOR1|LABEL1,VALOR2|LABEL2-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Select Multiplo Dinâmico. <span style=" font-size: 0.9em; font-weight: 100">Ex:VALOR1|LABEL1,VALOR2|LABEL2</span></label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="form_add_edit_field_value_select_multiple_manual" placeholder="Ex:VALOR1|LABEL1,VALOR2|LABEL2" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>

                            <!--SE O CAMPO FOR SELECT MULTIPLO DINÂMICO-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Select Multiplo Dinâmico. <span style=" font-size: 0.9em; font-weight: 100">QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao</span></label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="form_add_edit_field_value_select_multiple_dinamic" placeholder="QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>

                            <!--SE O CAMPO FOR CHECKBOX MANUAL, VALOR DO CHECKBOX ON E OFF-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor do Checkbox ON:</label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control input-sm" type="text" placeholder="Valor Padrão do Checkbox ON" name="form_add_edit_field_value_checkbox_manual_on" value="">
                                </div>
                            </div>

                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor do Checkbox OFF:</label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control input-sm" type="text" placeholder="Valor Padrão do Checkbox OFF" name="form_add_edit_field_value_checkbox_manual_off" value="">
                                </div>
                            </div>

                            <!--SE O CAMPO FOR RADIO BUTTON MANUAL, VALORES DO RADIO: VALOR1|LABEL1,VALOR2|LABEL2-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Radio Button. <span style=" font-size: 0.9em; font-weight: 100">Ex:VALOR1|LABEL1,VALOR2|LABEL2</span></label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="form_add_edit_field_value_radiobutton_manual" placeholder="Ex:VALOR1|LABEL1,VALOR2|LABEL2" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>


                            <!--SE O CAMPO FOR RADIO BUTTON DINÂMICO-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Select. <span style=" font-size: 0.9em; font-weight: 100">QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao</span></label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="form_add_edit_field_value_radiobutton_dinamic" placeholder="QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>


                            <!--SE O CAMPO FOR CHECKBOX MULTIPLO MANUAL, VALORES DO CKECKBOX: VALOR1|LABEL1,VALOR2|LABEL2-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Checkbox Multiplo. <span style=" font-size: 0.9em; font-weight: 100">Ex:VALOR1|LABEL1,VALOR2|LABEL2</span></label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="form_add_edit_field_value_checkbox_multiple_manual" placeholder="Ex:VALOR1|LABEL1,VALOR2|LABEL2" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>


                            <!--SE O CAMPO FOR CHECKBOX MULTIPLO DINÂMICO-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Valor(es) do Checkbox Multiplo Dinâmico. <span style=" font-size: 0.9em; font-weight: 100">QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao</span></label>

                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control input-sm" name="form_add_edit_field_value_checkbox_multiple_dinamic" placeholder="QUERY Ex: SELECT id,profissao FROM cad_profissao ORDER BY profissao" rows="3" wrap="hard" value=""></textarea>
                                </div>
                            </div>


                        </div>
                        <!--END COLUNA 1-->


                        <!--COLUNA 2-->
                        <div class="col-md-4 padding-left-0">
                            <fieldset>
                                <legend class="text-center">Validação</legend>

                                <!--HIDDEN-->
                                <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Oculto:</label>
                                    <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="checkbox" class="form-control input-sm btn_form_add_edit_field_hidden" data-toggle="toggle" data-on="ON" data-off="OFF" name="form_add_edit_field_hidden">

                                        <select class="input-sm margin-left-20 hide" name="form_add_edit_field_hidden_in_form">
                                            <option value="todos">Todos</option>
                                            <option value="formadd">Somente Form ADD</option>
                                            <option value="formedit">Somente Form EDIT</option>

                                        </select>
                                    </div>
                                </div>


                                <!--READ ONLY-->
                                <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Somente Leitura:</label>
                                    <div class="input-group">
                                        <input type="checkbox" class="form-control input-sm btn_form_add_edit_field_read_only" data-toggle="toggle" data-on="ON" data-off="OFF" name="form_add_edit_field_read_only" />

                                        <select class="input-sm margin-left-20 hide" name="form_add_edit_field_read_only_in_form">
                                            <option value="todos">Todos</option>
                                            <option value="formadd">Somente Form ADD</option>
                                            <option value="formedit">Somente Form EDIT</option>

                                        </select>
                                    </div>
                                </div>




                                <!--REQUIRED-->
                                <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Obrigatório:</label>
                                    <div class="input-group">
                                        <input type="checkbox" class="form-control input-sm" data-toggle="toggle" data-on="ON" data-off="OFF" name="form_add_edit_field_required" />

                                        <select class="input-sm margin-left-20 hide" name="form_add_edit_field_required_in_form">
                                            <option value="todos">Todos</option>
                                            <option value="formadd">Somente Form ADD</option>
                                            <option value="formedit">Somente Form EDIT</option>

                                        </select>
                                    </div>
                                </div>






                            </fieldset>
                        </div>
                        <!--END COLUNA 2-->



                        <!--COLUNA 3-->
                        <div class="col-md-4">

                            <!--COLUNAS-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Colunas:</label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control input-sm" name="form_add_edit_field_column">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>



                            <!--UPPERCASAE / LOWERCASE-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Converte Letra:</label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control input-sm" name="form_add_edit_field_convert_letter_into">
                                        <option value="">Normal</option>
                                        <option value="uppercase">Todas em Maiusculas</option>
                                        <option value="lowercase">Todas em Minuscuslas</option>
                                    </select>
                                </div>
                            </div>



                            <!--TIPO DE CARACTERES - SOMENTE LETRAS, SOMENTE NÚMEROS OU LETRAS E NÚMEROS-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Caracteres:</label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control input-sm" name="form_add_edit_field_type_characters">
                                        <option value="">Todos</option>
                                        <option value="only_numbers">Somente Números</option>
                                        <option value="only_letters">Somente Letras</option>
                                        <option value="letters_and_numbers">Letras e Números</option>
                                    </select>
                                </div>
                            </div>



                            <!--MÍNIMO DE CARACTERES NO INPUT-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Mínimno de Caracteres:</label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control input-sm" type="number" placeholder="Quantidade mínima de caracteres no campo." name="form_add_edit_field_min_length" value="" patter="[0-9]">
                                </div>
                            </div>



                            <!--MÁXIMO DE CARACTERES NO INPUT-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Máximo de Caracteres:</label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control input-sm" type="number" placeholder="Quantidade máxima de caracteres no campo." name="form_add_edit_field_max_length" value="" patter="[0-9]">
                                </div>
                            </div>



                            <!--ALTURA DO CKEDITOR-->
                            <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12 hide">
                                <label>Altura do Editor:</label>
                                <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control input-sm" style="text-transform: lowercase;" type="text" placeholder="Altura do editor vai refletir na quantidade de linhas de texto." name="form_add_edit_field_editorhtml_ckeditor_line_height" value="">
                                </div>
                                <span class="margin-left-0" style="font-size: 0.9em; font-weight: 100;">Unidade de Medida: px, em, vh</span>
                            </div>



                            <!--UPLOAD IMAGEM-->
                            <div id="id-div-upload-imagem" class="col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Extensões Permitidas:</label>
                                    <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input class="form-control input-sm" type="text" name="form_add_edit_field_upload_imagem_extensao_permitida" value="">
                                    </div>
                                </div>

                                <div class="form-group col-bg-12 col-md-12 col-sm-12 col-xs-12" style="line-height: 1.2em;">
                                    <label>Tamanho máximo do arquivo (em kilobytes):</label>
                                    <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input class="form-control input-sm" type="number" name="form_add_edit_field_upload_imagem_tamanho_maximo" value="">
                                    </div>
                                    <span class="margin-left-0" style="font-size: 0.9em; font-weight: 100;">Nota: A maioria das instalações do PHP tem seu próprio limite, conforme especificado no arquivo php.ini. Geralmente 2 MB (ou 2048 KB) por padrão.</span>
                                </div>

                                <div class="col-bg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div class="col-bg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10" style="line-height: 0.8em">
                                        <label>Dimensões da Imagem (em pixels).</label> <span class="margin-left-5" style=" font-size: 0.9em; font-weight: 100">Definido como zero para nenhum limite.</span>
                                    </div>
                                    <div class="col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group col-bg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label style="font-weight: normal">Largura Máxima:</label>
                                            <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input class="form-control input-sm" type="number" name="form_add_edit_field_upload_imagem_max_width" value="">
                                            </div>
                                        </div>

                                        <div class="form-group col-bg-6 col-md-6 col-sm-6 col-xs-6">
                                            <label style="font-weight: normal">Altura Máxima:</label>
                                            <div class="input-group col-bg-12 col-md-12 col-sm-12 col-xs-12">
                                                <input class="form-control input-sm" type="number" name="form_add_edit_field_upload_imagem_max_height" value="">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>
                        <!--END COLUNA 3-->

                    </div>


                    <div class="box-footer text-center">
                        <button type="button" class="btn btn-primary btn-show-modal-aguarde j_btn_save_form_formAddEdit pull-right"><i class="fa fa-fw fa-save margin-right-5"></i>Salvar</button>
                    </div>


                    <?= form_close(); ?>

                </div>
                <!--END FORM ADD/EDIT TAB-->





            </div>

        </div>

    </div>

</div>
<!--END MODAL EDIT CAMPOS DO FORM ADD/ADIT DO APP-->



<script>

    $(function () {

        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '';

        if (csrfHash === '') {
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        }

        function hide_notifit_msg() {
            $("#ui_notifIt").remove();
        }

        //GET DADOS
        function get_dados(_screen_type, _projeto_id, _field_name, _primary_key) {

            csrfHash = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").val();
            $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', '<?php echo $this->security->get_csrf_hash(); ?>');

            $.ajax({
                type: "POST",
                url: "<?= site_url($this->router->fetch_class() . '/setup_formaddedit'); ?>",
                data: {[csrfName]: csrfHash, task: 'get-dados', screen_type: _screen_type, projeto_id: _projeto_id, field_name: _field_name},
                dataType: "json",
                beforeSend: function () {

                }, //END beforeSend
                success: function (result) {

                    /**
                     * RENEW TOKEN CSRF
                     */
                    if (result.csrf_token) {
                        csrfHash = result.csrf_token;
                    }
                    $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', csrfHash);
                    /* END RENEW TOKEN CSRF */


                    //RESET CAMPOS
                    $('input[name="form_add_edit_field_show"]').filter(':radio').iCheck('uncheck');
                    $('select[name="form_add_edit_field_type"]').val('text');
                    $('select[name="form_add_edit_field_read_only_in_form"]').val('todos');
                    $('select[name="form_add_edit_field_hidden_in_form"]').val('todos');
                    $('select[name="form_add_edit_field_hidden"]').val('');
                    $('select[name="form_add_edit_field_required_in_form"]').val('todos');
                    $('select[name="form_add_edit_field_required"]').val('');
                    $('input[name="form_add_edit_field_mask"]').val('');
                    $('textarea[name="form_add_edit_field_mask_complement"]').val('');
                    $('input[name="form_add_edit_field_label"]').val('');
                    $('input[name="form_add_edit_field_placeholder"]').val('');
                    $('textarea[name="form_add_edit_field_value_select_dinamic"]').val('');
                    $('textarea[name="form_add_edit_field_value_radiobutton_dinamic"]').val('');
                    $('textarea[name="form_add_edit_field_value_checkbox_multiple_dinamic"]').val('');
                    $('select[name="form_add_edit_field_column"]').val('');
                    $('select[name="form_add_edit_field_convert_letter_into"]').val('');
                    $('select[name="form_add_edit_field_type_characters"]').val('');
                    $('input[name="form_add_edit_field_min_length"]').val('');
                    $('input[name="form_add_edit_field_max_length"]').val('');
                    $('input[name="form_add_edit_field_editorhtml_ckeditor_line_height"]').val('');
//                    $('input[name="form_add_edit_field_upload_imagem_extensao_permitida"]').val('');
//                    $('input[name="form_add_edit_field_upload_imagem_tamanho_maximo"]').val('');


                    if (_primary_key == 1) {
                        $('.j-flag-pk').show();
                    } else {
                        $('.j-flag-pk').hide();
                    }

                    //CARREGA CAMPOS
                    if (result.form_add_edit_field_show === 'on') {
                        $('input[id="form_add_edit_field_show_on"]').filter(':radio').iCheck('check');
                    } else {
                        $('input[id="form_add_edit_field_show_off"]').filter(':radio').iCheck('check');
                    }

                    $('select[name="form_add_edit_field_type"]').removeAttr('selected').val(result.form_add_edit_field_type).attr('selected', true);
                    $('select[name="form_add_edit_field_read_only_in_form"]').removeAttr('selected').val(result.form_add_edit_field_read_only_in_form).attr('selected', true);
                    $('select[name="form_add_edit_field_hidden_in_form"]').removeAttr('selected').val(result.form_add_edit_field_hidden_in_form).attr('selected', true);
                    $('select[name="form_add_edit_field_required_in_form"]').removeAttr('selected').val(result.form_add_edit_field_required_in_form).attr('selected', true);


                    //INPUT MASK
                    if (result.form_add_edit_field_type == 'text' || result.form_add_edit_field_type == 'number-decimal') {
                        $('input[name="form_add_edit_field_mask"]').parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_mask_complement"]').parent().removeClass('hide');
                    } else {
                        $('input[name="form_add_edit_field_mask"]').parent().addClass('hide');
                        $('textarea[name="form_add_edit_field_mask_complement"]').parent().addClass('hide');
                    }

                    //INPUT UPPERCASE / LOWERCASE
                    if (result.form_add_edit_field_type == 'text' || result.form_add_edit_field_type == 'text-long' || result.form_add_edit_field_type == 'senha') {
                        $('select[name="form_add_edit_field_convert_letter_into"]').parent().parent().removeClass('hide');
                    } else {
                        $('select[name="form_add_edit_field_convert_letter_into"]').parent().parent().addClass('hide');
                    }

                    //INPUT TYPE CHARACTERS
                    if (result.form_add_edit_field_type == 'text' || result.form_add_edit_field_type == 'senha') {
                        $('select[name="form_add_edit_field_type_characters"]').parent().parent().removeClass('hide');
                    } else {
                        $('select[name="form_add_edit_field_type_characters"]').parent().parent().addClass('hide');
                    }

                    //INPUT MIN LENGHT
                    if (result.form_add_edit_field_type == 'text' || result.form_add_edit_field_type == 'text-long' || result.form_add_edit_field_type == 'email' || result.form_add_edit_field_type == 'number' || result.form_add_edit_field_type == 'number-decimal' || result.form_add_edit_field_type == 'moeda' || result.form_add_edit_field_type == 'senha') {
                        $('input[name="form_add_edit_field_min_length"]').parent().parent().removeClass('hide');
                    } else {
                        $('input[name="form_add_edit_field_min_length"]').parent().parent().addClass('hide');
                    }

                    //INPUT MAX LENGHT
                    if (result.form_add_edit_field_type == 'text' || result.form_add_edit_field_type == 'text-long' || result.form_add_edit_field_type == 'email' || result.form_add_edit_field_type == 'number' || result.form_add_edit_field_type == 'number-decimal' || result.form_add_edit_field_type == 'moeda' || result.form_add_edit_field_type == 'senha') {
                        $('input[name="form_add_edit_field_max_length"]').parent().parent().removeClass('hide');
                    } else {
                        $('input[name="form_add_edit_field_max_length"]').parent().parent().addClass('hide');
                    }

                    // INPUT LINE HEIGHT CKEDITOR
                    if (result.form_add_edit_field_type == 'text-ckeditor') {
                        $('input[name="form_add_edit_field_editorhtml_ckeditor_line_height"]').val(result.form_add_edit_field_editorhtml_ckeditor_line_height);
                        $('input[name="form_add_edit_field_editorhtml_ckeditor_line_height"]').parent().parent().removeClass('hide');
                    } else {
                        $('input[name="form_add_edit_field_editorhtml_ckeditor_line_height"]').parent().parent().addClass('hide');
                    }

                    //INPUT UPLOAD IMAGEM upload-imagem
                    if (result.form_add_edit_field_type == 'upload-imagem') {
                        $('#id-div-upload-imagem').removeClass('hide');
                        $('input[name="form_add_edit_field_upload_imagem_extensao_permitida"]').val(result.form_add_edit_field_upload_imagem_extensao_permitida);
                        $('input[name="form_add_edit_field_upload_imagem_tamanho_maximo"]').val(result.form_add_edit_field_upload_imagem_tamanho_maximo);
                        $('input[name="form_add_edit_field_upload_imagem_max_width"]').val(result.form_add_edit_field_upload_imagem_max_width);
                        $('input[name="form_add_edit_field_upload_imagem_max_height"]').val(result.form_add_edit_field_upload_imagem_max_height);
                        $('input[name="form_add_edit_field_placeholder"]').parent().addClass('hide');
                        $('.btn_form_add_edit_field_hidden').parent().parent().parent().addClass('hide');
                        $('.btn_form_add_edit_field_read_only').parent().parent().parent().addClass('hide');
                        $('select[name="form_add_edit_field_required_in_form"]').addClass('hide');

                    } else {
                        $('#id-div-upload-imagem').addClass('hide');
                        $('input[name="form_add_edit_field_upload_imagem_extensao_permitida"]').val('');
                        $('input[name="form_add_edit_field_upload_imagem_tamanho_maximo"]').val('');
                        $('input[name="form_add_edit_field_upload_imagem_max_width"]').val('0');
                        $('input[name="form_add_edit_field_upload_imagem_max_height"]').val('0');
                        $('input[name="form_add_edit_field_placeholder"]').parent().removeClass('hide');
                        $('.btn_form_add_edit_field_hidden').parent().parent().parent().removeClass('hide');
                        $('.btn_form_add_edit_field_read_only').parent().parent().parent().removeClass('hide');
                        $('select[name="form_add_edit_field_required_in_form"]').removeClass('hide');

                    }


                    if (result.form_add_edit_field_type === 'select-manual') {
                        $('textarea[name="form_add_edit_field_value_select_manual"]').parent().parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_value_select_manual"]').val(result.form_add_edit_field_value_select_manual);

                    } else {
                        $('input[name="form_add_edit_field_value_select_manual"]').parent().parent().addClass('hide');
                        $('input[name="form_add_edit_field_value_select_manual"]').val('');

                    }

                    if (result.form_add_edit_field_type === 'select-dinamic') {
                        $('textarea[name="form_add_edit_field_value_select_dinamic"]').parent().parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_value_select_dinamic"]').val(result.form_add_edit_field_value_select_dinamic);

                    } else {
                        $('textarea[name="form_add_edit_field_value_select_dinamic"]').parent().parent().addClass('hide');
                        $('textarea[name="form_add_edit_field_value_select_dinamic"]').val('');
                    }

                    if (result.form_add_edit_field_type === 'select-multiple-manual') {
                        $('textarea[name="form_add_edit_field_value_select_multiple_manual"]').parent().parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_value_select_multiple_manual"]').val(result.form_add_edit_field_value_select_multiple_manual);

                    } else {
                        $('textarea[name="form_add_edit_field_value_select_multiple_manual"]').parent().parent().addClass('hide');
                        $('textarea[name="form_add_edit_field_value_select_multiple_manual"]').val('');
                    }

                    if (result.form_add_edit_field_type === 'select-multiple-dinamic') {
                        $('textarea[name="form_add_edit_field_value_select_multiple_dinamic"]').parent().parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_value_select_multiple_dinamic"]').val(result.form_add_edit_field_value_select_multiple_dinamic);

                    } else {
                        $('textarea[name="form_add_edit_field_value_select_multiple_dinamic"]').parent().parent().addClass('hide');
                        $('textarea[name="form_add_edit_field_value_select_multiple_dinamic"]').val('');
                    }


                    if (result.form_add_edit_field_type === 'radio-manual') {
                        $('textarea[name="form_add_edit_field_value_radiobutton_manual"]').parent().parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_value_radiobutton_manual"]').val(result.form_add_edit_field_value_radiobutton_manual);

                    } else {
                        $('textarea[name="form_add_edit_field_value_radiobutton_manual"]').parent().parent().addClass('hide');
                        $('textarea[name="form_add_edit_field_value_radiobutton_manual"]').val('');
                    }


                    if (result.form_add_edit_field_type === 'radio-dinamic') {
                        $('textarea[name="form_add_edit_field_value_radiobutton_dinamic"]').parent().parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_value_radiobutton_dinamic"]').val(result.form_add_edit_field_value_radiobutton_dinamic);

                    } else {
                        $('textarea[name="form_add_edit_field_value_radiobutton_dinamic"]').parent().parent().addClass('hide');
                        $('textarea[name="form_add_edit_field_value_radiobutton_dinamic"]').val('');
                    }


                    if (result.form_add_edit_field_type === 'checkbox-manual') {
                        $('input[name="form_add_edit_field_value_checkbox_manual_on"]').parent().parent().removeClass('hide');
                        $('input[name="form_add_edit_field_value_checkbox_manual_off"]').parent().parent().removeClass('hide');
                        $('input[name="form_add_edit_field_value_checkbox_manual_on"]').val(result.form_add_edit_field_value_checkbox_manual_on);
                        $('input[name="form_add_edit_field_value_checkbox_manual_off"]').val(result.form_add_edit_field_value_checkbox_manual_off);

                    } else {
                        $('input[name="form_add_edit_field_value_checkbox_manual_on"]').parent().parent().addClass('hide');
                        $('input[name="form_add_edit_field_value_checkbox_manual_off"]').parent().parent().addClass('hide');
                        $('input[name="form_add_edit_field_value_checkbox_manual_on"]').val('');
                        $('input[name="form_add_edit_field_value_checkbox_manual_off"]').val('');
                    }

                    if (result.form_add_edit_field_type === 'checkbox-multiple-manual') {
                        $('textarea[name="form_add_edit_field_value_checkbox_multiple_manual"]').parent().parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_value_checkbox_multiple_manual"]').val(result.form_add_edit_field_value_checkbox_multiple_manual);

                    } else {
                        $('textarea[name="form_add_edit_field_value_checkbox_multiple_manual"]').parent().parent().addClass('hide');
                        $('textarea[name="form_add_edit_field_value_checkbox_multiple_manual"]').val('');
                    }

                    if (result.form_add_edit_field_type === 'checkbox-multiple-dinamic') {
                        $('textarea[name="form_add_edit_field_value_checkbox_multiple_dinamic"]').parent().parent().removeClass('hide');
                        $('textarea[name="form_add_edit_field_value_checkbox_multiple_dinamic"]').val(result.form_add_edit_field_value_checkbox_multiple_dinamic);

                    } else {
                        $('textarea[name="form_add_edit_field_value_checkbox_multiple_dinamic"]').parent().parent().addClass('hide');
                        $('textarea[name="form_add_edit_field_value_checkbox_multiple_dinamic"]').val('');
                    }



                    $('input[name="form_add_edit_field_mask"]').val(result.form_add_edit_field_mask);
                    $('textarea[name="form_add_edit_field_mask_complement"]').val(result.form_add_edit_field_mask_complement);

                    $('input[name="form_add_edit_field_label"]').val(result.form_add_edit_field_label);

                    $('input[name="form_add_edit_field_placeholder"]').val(result.form_add_edit_field_placeholder);

                    // HIDDEN
                    if (result.form_add_edit_field_hidden === 'on') {
                        $('input[name="form_add_edit_field_hidden"]').bootstrapToggle('on');
                        //$('select[name="form_add_edit_field_hidden_in_form"]').removeClass('hide');
                    } else {
                        $('input[name="form_add_edit_field_hidden"]').bootstrapToggle('off');
                        //$('select[name="form_add_edit_field_hidden_in_form"]').addClass('hide');
                        //$('select[name="form_add_edit_field_hidden_in_form"]').val('todos');
                    }

                    // READ ONLY
                    if (result.form_add_edit_field_read_only === 'on') {
                        $('input[name="form_add_edit_field_read_only"]').bootstrapToggle('on');
                        //$('select[name="form_add_edit_field_read_only_in_form"]').removeClass('hide');


                    } else {
                        $('input[name="form_add_edit_field_read_only"]').bootstrapToggle('off');
                        //$('select[name="form_add_edit_field_read_only_in_form"]').addClass('hide');
                        //$('select[name="form_add_edit_field_read_only_in_form"]').val('todos');
                    }

                    // REQUIRED
                    if (result.form_add_edit_field_required === 'on') {
                        $('input[name="form_add_edit_field_required"]').bootstrapToggle('on');
                        //$('select[name="form_add_edit_field_read_only_in_form"]').removeClass('hide');


                    } else {
                        $('input[name="form_add_edit_field_required"]').bootstrapToggle('off');
                        //$('select[name="form_add_edit_field_read_only_in_form"]').addClass('hide');
                        //$('select[name="form_add_edit_field_read_only_in_form"]').val('todos');
                    }


                    // REQUIRED
                    /*if (result.form_add_edit_field_hidden !== 'on' || result.form_add_edit_field_read_only !== 'on') {
                     $('input[name="form_add_edit_field_required"]').bootstrapToggle('off');
                     $('input[name="form_add_edit_field_required"]').val('');
                     } else {
                     $('input[name="form_add_edit_field_required"]').bootstrapToggle('on');
                     }*/


                    $('select[name="form_add_edit_field_column"]').removeAttr('selected').val(result.form_add_edit_field_column).attr('selected', true);

                    $('select[name="form_add_edit_field_convert_letter_into"]').removeAttr('selected').val(result.form_add_edit_field_convert_letter_into).attr('selected', true);

                    $('select[name="form_add_edit_field_type_characters"]').removeAttr('selected').val(result.form_add_edit_field_type_characters).attr('selected', true);

                    $('input[name="form_add_edit_field_min_length"]').val(result.form_add_edit_field_min_length);

                    $('input[name="form_add_edit_field_max_length"]').val(result.form_add_edit_field_max_length);

                    $('input[name="form_add_edit_field_max_length"]').val(result.form_add_edit_field_editorhtml_ckeditor_line_height);

                    $('#modal-btn-edit-field-table-formaddedit').css('display', 'block');

                }, //END success
                complete: function (result) {

                    $('#modal-aguarde').modal('hide');

                }, //END complete
                error: function () {
                    notfit_msg_error('Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.');
                }//END error
            });//END AJAX

        }


        $(document).keyup(function (e) {

            var _visible_modal = $('#modal-btn-edit-field-table-formaddedit').is(":visible");

            if (e.which == 27) {
                if (_visible_modal) {
                    $('#modal-btn-edit-field-table-formaddedit').fadeOut(100);
                    hide_notifit_msg();
                }
            }

        });


        //MODAL CLOSE
        $('.j_btn_modal_box_close').click(function () {
            $('#modal-btn-edit-field-table-formaddedit').fadeOut(100);
            hide_notifit_msg();
        });//END $('.j_btn_modal_box_close').click()




        //QUANDO O CAMPO Tipo do Campo É SELECIONADO
        $('select[name="form_add_edit_field_type"]').change(function (e) {
            var _selected = $(this).val();

            $('textarea[name="form_add_edit_field_value_select_manual"]').val('');
            $('textarea[name="form_add_edit_field_value_select_dinamic"]').val('');
            $('textarea[name="form_add_edit_field_value_select_multiple_manual"]').val('');
            $('textarea[name="form_add_edit_field_value_select_multiple_dinamic"]').val('');
            $('textarea[name="form_add_edit_field_value_radiobutton_manual"]').val('');
            $('textarea[name="form_add_edit_field_value_radiobutton_dinamic"]').val('');
            $('input[name="form_add_edit_field_value_checkbox_manual_on"]').val('');
            $('input[name="form_add_edit_field_value_checkbox_manual_off"]').val('');
            $('textarea[name="form_add_edit_field_value_checkbox_multiple_manual"]').val('');
            $('textarea[name="form_add_edit_field_value_checkbox_multiple_dinamic"]').val('');
            $('input[name="form_add_edit_field_mask"]').val('');
            $('input[name="form_add_edit_field_complement"]').val('');
            $('input[name="form_add_edit_field_min_length"]').val('');
            $('input[name="form_add_edit_field_max_length"]').val('');
            $('input[name="form_add_edit_field_editorhtml_ckeditor_line_height"]').val('');
            $('select[name="form_add_edit_field_convert_letter_into"]').val('');
            $('select[name="form_add_edit_field_type_characters"]').val('');
            $('input[name="form_add_edit_field_upload_imagem_extensao_permitida"]').val('');
            $('input[name="form_add_edit_field_upload_imagem_tamanho_maximo"]').val('');



            //INPUT MASK
            if (_selected == 'text' || _selected == 'number-decimal') {
                $('input[name="form_add_edit_field_mask"]').parent().removeClass('hide');
                $('textarea[name="form_add_edit_field_mask_complement"]').parent().removeClass('hide');
            } else {
                $('input[name="form_add_edit_field_mask"]').parent().addClass('hide');
                $('textarea[name="form_add_edit_field_mask_complement"]').parent().addClass('hide');
            }

            //INPUT UPPERCASE / LOWERCASE
            if (_selected == 'text' || _selected == 'text-long' || _selected == 'senha') {
                $('select[name="form_add_edit_field_convert_letter_into"]').parent().parent().removeClass('hide');
            } else {
                $('select[name="form_add_edit_field_convert_letter_into"]').parent().parent().addClass('hide');
            }

            //INPUT SENHA
            if (_selected == 'text' || _selected == 'senha') {
                $('select[name="form_add_edit_field_type_characters"]').parent().parent().removeClass('hide');
            } else {
                $('select[name="form_add_edit_field_type_characters"]').parent().parent().addClass('hide');
            }

            //INPUT MIN LENGHT
            if (_selected == 'text' || _selected == 'text-long' || _selected == 'email' || _selected == 'number' || _selected == 'number-decimal' || _selected == 'moeda' || _selected == 'senha') {
                $('input[name="form_add_edit_field_min_length"]').parent().parent().removeClass('hide');
            } else {
                $('input[name="form_add_edit_field_min_length"]').parent().parent().addClass('hide');

            }

            //INPUT MAX LENGHT
            if (_selected == 'text' || _selected == 'text-long' || _selected == 'email' || _selected == 'number' || _selected == 'number-decimal' || _selected == 'moeda' || _selected == 'senha') {
                $('input[name="form_add_edit_field_max_length"]').parent().parent().removeClass('hide');
            } else {
                $('input[name="form_add_edit_field_max_length"]').parent().parent().addClass('hide');
            }

            //INPUT MAX LENGHT
            if (_selected == 'text-ckeditor') {
                $('input[name="form_add_edit_field_editorhtml_ckeditor_line_height"]').parent().parent().removeClass('hide');
            } else {
                $('input[name="form_add_edit_field_editorhtml_ckeditor_line_height"]').parent().parent().addClass('hide');
            }



            //INPUT UPLOAD IMAGEM upload-imagem
            if (_selected == 'upload-imagem') {
                $('#id-div-upload-imagem').removeClass('hide');
                $('input[name="form_add_edit_field_upload_imagem_extensao_permitida"]').val('jpg|jpeg|gif|png');
                $('input[name="form_add_edit_field_upload_imagem_tamanho_maximo"]').val('100');
                $('input[name="form_add_edit_field_upload_imagem_max_width"]').val('0');
                $('input[name="form_add_edit_field_upload_imagem_max_height"]').val('0');
                $('input[name="form_add_edit_field_placeholder"]').parent().addClass('hide');
                $('.btn_form_add_edit_field_hidden').parent().parent().parent().addClass('hide');
                $('.btn_form_add_edit_field_read_only').parent().parent().parent().addClass('hide');
                $('select[name="form_add_edit_field_required_in_form"]').addClass('hide');

            } else {
                $('#id-div-upload-imagem').addClass('hide');
                $('input[name="form_add_edit_field_placeholder"]').parent().removeClass('hide');
                $('.btn_form_add_edit_field_hidden').parent().parent().parent().removeClass('hide');
                $('.btn_form_add_edit_field_read_only').parent().parent().parent().removeClass('hide');
                $('select[name="form_add_edit_field_required_in_form"]').removeClass('hide');
            }


            if (_selected == 'select-manual') {
                $('textarea[name="form_add_edit_field_value_select_manual"]').parent().parent().removeClass('hide');

            } else {
                $('textarea[name="form_add_edit_field_value_select_manual"]').parent().parent().addClass('hide');
            }


            if (_selected == 'select-dinamic') {
                $('textarea[name="form_add_edit_field_value_select_dinamic"]').parent().parent().removeClass('hide');
            } else {
                $('textarea[name="form_add_edit_field_value_select_dinamic"]').parent().parent().addClass('hide');
            }


            if (_selected == 'select-multiple-manual') {
                $('textarea[name="form_add_edit_field_value_select_multiple_manual"]').parent().parent().removeClass('hide');
            } else {
                $('textarea[name="form_add_edit_field_value_select_multiple_manual"]').parent().parent().addClass('hide');
            }


            if (_selected == 'select-multiple-dinamic') {
                $('textarea[name="form_add_edit_field_value_select_multiple_dinamic"]').parent().parent().removeClass('hide');
            } else {
                $('textarea[name="form_add_edit_field_value_select_multiple_dinamic"]').parent().parent().addClass('hide');
            }



            if (_selected == 'radio-manual') {
                $('textarea[name="form_add_edit_field_value_radiobutton_manual"]').parent().parent().removeClass('hide');
            } else {
                $('textarea[name="form_add_edit_field_value_radiobutton_manual"]').parent().parent().addClass('hide');
            }


            if (_selected == 'radio-dinamic') {
                $('textarea[name="form_add_edit_field_value_radiobutton_dinamic"]').parent().parent().removeClass('hide');
            } else {
                $('textarea[name="form_add_edit_field_value_radiobutton_dinamic"]').parent().parent().addClass('hide');
            }


            if (_selected == 'checkbox-manual') {
                $('input[name="form_add_edit_field_value_checkbox_manual_on"]').parent().parent().removeClass('hide');
                $('input[name="form_add_edit_field_value_checkbox_manual_off"]').parent().parent().removeClass('hide');
            } else {
                $('input[name="form_add_edit_field_value_checkbox_manual_on"]').parent().parent().addClass('hide');
                $('input[name="form_add_edit_field_value_checkbox_manual_off"]').parent().parent().addClass('hide');
            }


            if (_selected == 'checkbox-multiple-manual') {
                $('textarea[name="form_add_edit_field_value_checkbox_multiple_manual"]').parent().parent().removeClass('hide');
            } else {
                $('textarea[name="form_add_edit_field_value_checkbox_multiple_manual"]').parent().parent().addClass('hide');
            }


            if (_selected == 'checkbox-multiple-dinamic') {
                $('textarea[name="form_add_edit_field_value_checkbox_multiple_dinamic"]').parent().parent().removeClass('hide');
            } else {
                $('textarea[name="form_add_edit_field_value_checkbox_multiple_dinamic"]').parent().parent().addClass('hide');
            }

        });


        //QUANDO ABRE A MODAL DE EDIÇÃO DOS INPUTS
        $('.j_btn_modal_edit_fields_table_formaddedit').click(function (e) {
            e.preventDefault();

            var _projeto_id = $(this).parent('tr:first').attr('rel-projeto-id');
            var _field_name = $(this).parent('tr:first').attr('id');
            var _primary_key = $(this).parent('tr:first').attr('rel-primary-key');
            var _screen_type = $(this).parent().parent().parent().attr('id');

            if (_screen_type === 'tableGridlistFormAddEdit') {
                _screen_type = 'formaddedit';
            } else {
                _screen_type = '';
            }

            $('#form_add_edit_modal_field_name').html(_field_name);

            $('input[name="modal_projeto_id"]').val(_projeto_id);
            $('input[name="field_name"]').val(_field_name);
            $('input[name="screen_type"]').val(_screen_type);
            $('input[name="primary_key"]').val(_primary_key);

            get_dados(_screen_type, _projeto_id, _field_name, _primary_key);


        });//END $('.j_btn_modal_edit_fields_table_formaddedit').click()


        //BUTTON READ ONLY / SOMENTE LEITURA CLICK
        $('input[name="form_add_edit_field_read_only"]').on('change', function (e) {

            var _r = $(this).parent().hasClass('off');

            var _r = $(this).parent().hasClass('off');
            if (_r === true) {
                $('select[name="form_add_edit_field_read_only_in_form"]').val('todos');
                $('select[name="form_add_edit_field_read_only_in_form"]').addClass('hide');

            } else {
                $('select[name="form_add_edit_field_read_only_in_form"]').removeClass('hide');
                //$('input[name="form_add_edit_field_required"]').bootstrapToggle('off');
                //$('input[name="form_add_edit_field_required"]').parent().addClass('disabled');
            }

        });


        //BUTTON HIDE / OCULTO CLICK
        $('input[name="form_add_edit_field_hidden"]').on('change', function (e) {

            var _r = $(this).parent().hasClass('off');
            var _v = $(this).children().children().val();

            if (_r === true) {
                $('select[name="form_add_edit_field_hidden_in_form"]').val('todos');
                $('select[name="form_add_edit_field_hidden_in_form"]').addClass('hide');
//                $('input[name="form_add_edit_field_read_only"]').parent().removeClass('disabled');
//                $('input[name="form_add_edit_field_required"]').parent().removeClass('disabled');

            } else {

                $('select[name="form_add_edit_field_hidden_in_form"]').removeClass('hide');
                //$('input[name="form_add_edit_field_required"]').bootstrapToggle('off');
                //$('input[name="form_add_edit_field_required"]').parent().addClass('disabled');
            }

        });
        //END BUTTON HIDE / OCULTO CLICK


        //BUTTON HIDE / OCULTO CLICK
        $('input[name="form_add_edit_field_required"]').on('change', function (e) {

            var _r = $(this).parent().hasClass('off');

            if (_r === true) {
                $('select[name="form_add_edit_field_required_in_form"]').val('todos');
                $('select[name="form_add_edit_field_required_in_form"]').addClass('hide');

                //$('input[name="form_add_edit_field_required"]').parent().removeClass('disabled');
            } else {
                $('select[name="form_add_edit_field_required_in_form"]').removeClass('hide');

                //$('input[name="form_add_edit_field_required"]').bootstrapToggle('off');
                //$('input[name="form_add_edit_field_required"]').parent().addClass('disabled');
            }

            if ($('.btn_form_add_edit_field_hidden').parent().parent().parent().hasClass('hide')) {
                $('select[name="form_add_edit_field_required_in_form"]').addClass('hide');
                $('input[name="form_add_edit_field_hidden"]').bootstrapToggle('off');
                $('input[name="form_add_edit_field_read_only"]').bootstrapToggle('off');
            }

//                if ($('.btn_form_add_edit_field_read_only').parent().parent().parent().hasClass('hide')) {
//                    $('select[name="form_add_edit_field_required_in_form"]').addClass('hide');
//                }

        });


        //SUBMIT FORM formAddEdit
        $(".j_btn_save_form_formAddEdit").click(function (e) {
            e.preventDefault();

            var _btn_save = $(this);
            var _label_field_name = $('input[name="form_add_edit_field_label"]').val();
            var _field_name = $('#form_add_edit_modal_field_name').text();

            var _action = $('#formAddEdit').attr('action');
            var _data = $('#formAddEdit').serialize();
            var _dataArray = $('#formAddEdit').serializeArray();

            var _projeto_id = $('input[name="modal_projeto_id"]').val();
            var _screen_type = $('input[name="screen_type"]').val();
            var _primary_key = $('input[name="primary_key"]').val();

            btnDataObj = {};

            $(_dataArray).each(function (i, field) {
                btnDataObj[field.name] = field.value;
            });


            //if (btnDataObj['form_add_edit_field_hidden'] === 'on' || btnDataObj['form_add_edit_field_read_only'] === 'on') {

            /*btnDataObj['form_add_edit_field_required'] = 'off';
             $('input[name="form_add_edit_field_required"]').bootstrapToggle('off');*/

            /*btnDataObj['form_add_edit_field_read_only'] = 'off';
             $('input[name="form_add_edit_field_read_only"]').bootstrapToggle('off');*/


            //} else {

            /*btnDataObj['form_add_edit_field_required'] = 'off';
             $('input[name="form_add_edit_field_required"]').bootstrapToggle('on');*/

            //}


            _data = btnDataObj;


            $.ajax({
                type: "POST",
                url: _action,
                data: _data,
                dataType: "json",
                beforeSend: function () {

                    _btn_save.hide();

                }, //END beforeSend
                success: function (result) {

                    /**
                     * RENEW TOKEN CSRF
                     */
                    if (result.csrf_token) {
                        csrfHash = result.csrf_token;
                    }
                    $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']").attr('value', csrfHash);

                    /* END RENEW TOKEN CSRF */

                    if (result.return === 'SAVE-SETUP-FORMADDEDIT-OK') {

                        /*
                         * MARCA REGISTRO OFF PARA MOSTRAR NA VIEW
                         */
                        $('.fields_table_formaddedit tr').each(function () {
                            if ($(this).attr('id') == _field_name) {

                                dataObj = {};

                                $(_dataArray).each(function (i, field) {
                                    dataObj[field.name] = field.value;
                                });
                                if (dataObj['form_add_edit_field_show'] === 'off') {
                                    $(this).addClass('font-color-gray-light');
                                    $(this).children().first().next().children().removeClass('text-green').removeClass('fa-toggle-on').addClass('fa-toggle-off');
                                } else {
                                    $(this).removeClass('font-color-gray-light');
                                    $(this).children().first().next().children().addClass('text-green').removeClass('fa-toggle-off').addClass('fa-toggle-on');
                                }
                            }
                        });/*END MARCA REGISTRO OFF PARA MOSTRAR NA VIEW*/
                        notfit_msg_success('SETUP do Campo <b>' + _label_field_name + '</b> Atualizado com Sucesso.');



                        get_dados(_screen_type, _projeto_id, _field_name, _primary_key);

                    } else {

                        notfit_msg_error('Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.' + result.return);
                    }


                }, //END success
                complete: function (result) {

                    $('#modal-aguarde').modal('hide');
                    _btn_save.show();

                }, //END complete
                error: function (xhr, error) {

                    if (xhr.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (xhr.status == 404) {
                        alert('Requested page not found. [404]');
                    } else if (xhr.status == 500) {
                        alert('Internal Server Error [500].');
                    } else if (error === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (error === 'timeout') {
                        alert('Time out error.');
                    } else if (error === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error.\n' + xhr.responseText);
                    }

                    notfit_msg_error('Ocorreu um ERRO Inesperado ao Atualizar Registro, Contacte o Administrador do Sistema.');

                }//END error
            });//END AJAX




        });//END $(".j_btn_save_form_GridList").click()


    });

</script>