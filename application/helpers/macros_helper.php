<?php

/*
 * MACROS
 * 
 * Created on : 27/03/2019, 08:33:00
 * Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  ==================================================================================================================================================================
 *      IMAGES
 *  ==================================================================================================================================================================
 */

/**
 * GERA UM LINK URL DA IMAGEM
 * 
 * @param type $_image_name
 * @return type
 */
function mc_image_url($_image_name) {
    return base_url(___CONF_UPLOAD_DIR___ . '/' . ___CONF_UPLOAD_IMAGE_DIR___ . '/') . $_image_name;
}

/**
 * GERA UM LINK DA IMAGEM COM CLICK LIGHTBOX 
 *
 * @param type $_image_name
 * @param type $_model              [ single ] para uma única image / [ group ] para um grupo de imagens, tipo galeria de fotos
 * @return string
 */
function mc_image_link_modal($_image_name, $_type = 'single') {

    $_imagem = '';

    if ($_type == 'single') {

        $_url_imagem = base_url(___CONF_UPLOAD_DIR___ . '/' . ___CONF_UPLOAD_IMAGE_DIR___ . '/') . $_image_name;

        $_btn_copy_url_imagem = '<span style="color:#87A0B9" class="mouse-cursor-pointer j-tooltip margin-right-5" data-toggle="tooltip" data-original-title="Copiar Link Imagem" data-clipboard-text="' . $_imagem . '"> <i class="fa fa-copy (alias)"></i></span>';

        $_imagem = '<div class="btn-copy-to-clipboard btn-image-link-lightbox" ><a href="' . $_url_imagem . '" data-lightbox="' . $_image_name . '" data-title="" ><i class="fa fa-fw fa-camera"></i> </a></div>';

        $_btn_view_copy_image = '<div class="btn-group btn-xs">'
                . '<button type="button" class="btn btn-default j-tooltip" data-toggle="tooltip" data-original-title="Copiar Link Imagem"  data-clipboard-text="' . $_url_imagem . '"><a><i class="fa fa-copy"></i></a></button>'
                . '<button type="button" class="btn btn-default btn-image-link-lightbox j-tooltip" data-toggle="tooltip" data-original-title="Ver Imagem">' . $_imagem . '</button>'
                . '</div>';


        return $_btn_view_copy_image;
    } elseif ($_type = 'group') {
        
    }
}

/**
 * GERA UMA MINIATURA DA IMAGEM COM CLICK LIGHTBOX 
 *
 * @param type $_image_name
 * @param type $_model              [ single ] para uma única image / [ group ] para um grupo de imagens, tipo galeria de fotos
 * @return string
 */
function mc_image_thumb_modal($_image_name, $_type = 'single') {

    $_imagem = '';

    if ($_type == 'single') {

        $_url_imagem = base_url(___CONF_UPLOAD_DIR___ . '/' . ___CONF_UPLOAD_IMAGE_DIR___ . '/') . $_image_name;
        $_imagem = '<a class="btn-image-thumb-lightbox" href="' . $_url_imagem . '" data-lightbox="' . $_image_name . '"><img src="' . $_url_imagem . '" style="width:15%;"></a>';


        $_btn_view_copy_image = '<div class="btn-group btn-xs">'
                . '<div class="btn-image-link-lightbox j-tooltip" data-toggle="tooltip" data-placement="left" data-original-title="Ver Imagem">' . $_imagem . '</div>'
                . '<button type="button" style="margin-top:-33px;" class="btn btn-default j-tooltip" data-toggle="tooltip" data-placement="left" data-original-title="Copiar Link Imagem"  data-clipboard-text="' . $_url_imagem . '"><a><i class="fa fa-copy"></i></a></button>'
                . '</div>';

        return $_btn_view_copy_image;
    } elseif ($_type = 'group') {
        
    }
}

/**
 *  ==================================================================================================================================================================
 *      ARRAY SERACH'S
 *  ==================================================================================================================================================================
 */

/**
 * FILTRA O CONTEUDO DE UM ARRAY POR UM FIELD ESPECÍFICO.
 *
 * 
 * @param type $_array              ARRAY COM OS DADOS A SEREM PESQUISADOS
 * @param type $_field              NOME DO CAMPO/COLUNA DO ARRAY
 * @param type $_value              VALOR A SER PESQUISADO NO CAMPO/COLUNA DO ARRAY
 * @return type
 */
function mc_search_exact_field_array($_array, $_field, $_value) {

    $p['array'] = $_array;
    $p['field'] = $_field;
    $p['value'] = $_value;

    return bz_filter_array($_p);
}

/**
 * SEARCH AS IN THE ARRAY IN ALL THE COLUMNS
 * 
 * @param type $array
 * @param type $search
 * @return type
 */
function mc_search_like_array($array, $search) {

    $_returnArray = [];

    foreach ($array as $row) {
        $_json = json_encode($row);
        $_pos = strpos($_json, $search);

        if ($_pos > 0) {
            array_push($_returnArray, $row);
        }
    }

    return $_returnArray;
}

/* END function mc_search_like_array() */

/**
 *  ==================================================================================================================================================================
 *      ALERTS MESSAGES AND MODALS
 *  ==================================================================================================================================================================
 */

/**
 * MODAL
 * 
 * @param type $_configModal
 * @return type
 * 
 * PARÂMETROS PASSADOS COMO ARRAY. Ex: $config['modalName'] = 'modalDeTeste';
 * 
 * modalName            Nome da Modal, se não for informado o nome padrão será bzModal
 * modalClass           Para adicionar uma classe CSS na modal
 * modalSize            Determina o tamanho da modal - Ex: large para Grande, small para Pequeno. Se não for informado nada o tamnho padrão será Médio
 * modalTitle           O Título para a Modal
 * modalText            O Texto no corpo da Modal
 * modalTextSmall       O Texto de tamanho reduzino no corpo da Modal
 * modalBtnCloseID      ID do botão que fecha a Modal
 * modalBtnConfirmID    ID do botão de confirmação da Modal
 * modalBtnClose        Texto do botão que fecha a Modal
 * modalBtnConfirm      Texto o botão de confirmação da Modal
 * modalShow            Se informado como TRUE a Modal é executada automaticamente
 * 
 */
function mc_modal($_configModal = []) {

    return bz_modal($_configModal);
}

/**
 * SETA OS ALERTAS DO SISTEMA EM NOTFIT MESSENGER
 * info, error, warning, success
 *
 * @param type $mensagem
 * @param string $tipo
 * @return type
 */
function mc_alertNotfit($mensagem = NULL, $tipo = 'info') {
    set_mensagem_notfit($mensagem, $tipo);
    return;
}

/* END function mc_alertNotfit() */

/**
 * SETA OS ALERTAS DO SISTEMA EM SWEET ALERT
 * error, warning, success
 * @param string $titulo        Informa o titulo da mensagem
 * @param string $mensagem      Mensagem de erro ou aviso
 * @param string $tipo          Informa o tipo de mensagem a ser mostrado: info, warning, error, success
 *
 * https://sweetalert.js.org/guides/
 *
 */
function mc_alertSweet($titulo = NULL, $mensagem = NULL, $tipo = 'info') {
    set_mensagem_sweetalert($titulo, $mensagem, $tipo);
    return;
}

/* function mc_alertSweet() */

/**
 * SETA OS ALERTAS DO SISTEMA EM TOASTR
 * error, warning, success
 * @param string $titulo        Informa o titulo da mensagem
 * @param string $mensagem      Mensagem de erro ou aviso
 * @param string $tipo          Informa o tipo de mensagem a ser mostrado: info, warning, error, success
 */
function mc_alertToast($titulo, $mensagem, $tipo = 'info', $position = 'top-right') {
    set_mensagem_toastr($titulo, $mensagem, $tipo, $position);
    return;
}

/* function mc_alertToast() */

function mc_alert($titulo = NULL, $mensagem = NULL, $fa_icon = 'fa-times', $tipo = NULL) {
    set_mensagem($titulo, $mensagem, $fa_icon, $tipo);
    return;
}

/* ================================================================================================================================================================== */

/**
 *  ==================================================================================================================================================================
 *      DATABASE
 *  ==================================================================================================================================================================
 */

/**
 * GET ALL DATA IN DATABASE
 * 
 * @param type $_dataBaseName
 * @param type $_orderBY
 * @return type
 */
function mc_findAllDataDB($_dataBaseName, $_orderBY = NULL) {
    $CI = & get_instance();
    return $CI->m->findAll($_dataBaseName, $_orderBY);
}

/* END function mc_findAllDataDB() */

/**
 * GET DATA BY ID IN DATABASE
 *
 * @param type $_dataBaseName       Nome da Tabela
 * @param type $_id                 ID DATA
 * @return boolean
 */
function mc_findByIdDataDB($_dataBaseName, $_id) {
    $CI = & get_instance();
    return $CI->m->findById($_dataBaseName, $_id);
}

/* END function mc_findByIdDataDB() */

/**
 * GET DATA BY FIELD AND VALUE FIELD IN DATABASE
 *
 * @param type $_dataBaseName
 * @param type $_field
 * @param type $_value
 * @param type $_condition
 * @param type $_orderBY
 * @return type
 */
function mc_findByFieldDataDB($_dataBaseName, $_field, $_value, $_condition = NULL, $_orderBY = NULL) {
    $CI = & get_instance();
    return $CI->m->findByField($_dataBaseName, $_field, $_value, $_condition);
}

/* END function mc_findByFieldDataDB() */

/**
 * SELECT DATA ON DATABASE
 * 
 * @param type $table_name
 * @param type $where
 * @param type $param           FIELD DISTINCT Ex: $_param['distinct'] = 'name_field';
 *                                                 $_param['group_by'] = 'name_field_1,name_field_2,name_field_3'
 * @return type
 */
function mc_selectDataDB($table_name, $where = NULL, $param = array()) {
    $CI = & get_instance();
    return $CI->read->ExecRead($table_name, $where, $param);
}

/**
 * UPDATE DATA ON DATABASE
 * 
 * @param type $table_name
 * @param array $dados
 * @param type $termos
 * @return type
 */
function mc_updateDataDB($table_name, array $dados, $termos) {
    $CI = & get_instance();
    return $CI->update->ExecUpdate($table_name, $dados, $termos);
}

/* ================================================================================================================================================================== */

/**
 *  ==================================================================================================================================================================
 *      SESSION DATA
 *  ==================================================================================================================================================================
 */

/**
 * RETORNA OS DADOS DA SESSION DE LOGIN DO USUÁRIO
 * 
 * @return type
 */
function mc_user_login() {
    $CI = & get_instance();
    return $CI->session->userdata('user_login');
}

/* ================================================================================================================================================================== */

