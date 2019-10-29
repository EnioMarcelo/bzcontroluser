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
    return base_url(___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___) . $_image_name;
}

/**
 * GERA UM LINK DA IMAGEM COM CLICK LIGHTBOX 
 *
 * @param type $_image_name
 * @param string $_type         [ single ] para uma única image / [ group ] para um grupo de imagens, tipo galeria de fotos
 * @return string
 */
function mc_image_link_modal($_image_name, $_image_folder = NULL, $_type = 'single') {

    $_imagem = '';

    if ($_type == 'single') {

        $_url_imagem = base_url(___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . $_image_folder) . $_image_name;

        $_imagem = '<div class="btn-copy-to-clipboard btn-image-link-lightbox" ><a href="' . $_url_imagem . '" data-lightbox="' . $_image_name . '" data-title="" ><i class="fa fa-fw fa-camera"></i> </a></div>';

        $_btn_view_copy_image = '<div class="btn-group btn-xs">'
                . '<button type="button" class="btn btn-default btn-xs j-tooltip" data-toggle="tooltip" data-original-title="Download"><a href="' . $_url_imagem . '" download="' . $_image_name . '"><i class="fa fa-download"></i></a></button>'
                . '<button type="button" class="btn btn-default btn-xs j-tooltip" data-toggle="tooltip" data-original-title="Copiar Link" data-clipboard-message="Link da imagem copiado com sucesso." data-clipboard-text="' . $_url_imagem . '"><a><i class="fa fa-copy"></i></a></button>'
                . '<button type="button" class="btn btn-default btn-xs btn-image-link-lightbox j-tooltip" data-toggle="tooltip" data-original-title="Ver Imagem">' . $_imagem . '</button>'
                . '</div>';

        return $_btn_view_copy_image;
    } elseif ($_type = 'group') {
        
    }
}

/**
 * GERA UM LINK PARA DOWNLOAD DO ARQUIVO 
 *
 * @param type $_file_name
 * @param type $_type              [ single ] para um único arquivo / [ group ] para um grupo de arquivos
 * @return string
 */
function mc_file_link_download($_file_name, $_file_folder = NULL, $_type = 'single') {

    $_file = '';

    if ($_type == 'single') {

        $_url_file = base_url(___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_FILE_DIR___ . ($_file_folder ? $_file_folder . DIRECTORY_SEPARATOR : $_file_folder)) . $_file_name;

        $_file = '<div class="btn-copy-to-clipboard btn-file-link-lightbox" ><i class="fa fa-fw fa-camera"></i> </a></div>';

        $_btn_view_copy_file = '<div class="btn-group btn-xs">'
                . '<button type="button" class="btn btn-default btn-xs j-tooltip" data-toggle="tooltip" data-original-title="Download"><a href="' . $_url_file . '" download="' . $_file_name . '"><i class="fa fa-download"></i></a></button>'
                . '<button type="button" class="btn btn-default btn-xs j-tooltip" data-toggle="tooltip" data-original-title="Copiar Link" data-clipboard-message="Link da imagem copiado com sucesso." data-clipboard-text="' . $_url_file . '"><a><i class="fa fa-copy"></i></a></button>'
                . '</div>';

        return $_btn_view_copy_file;
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
function mc_image_thumb_modal($_image_name, $_image_folder = NULL, $_type = 'single') {

    $_imagem = '';

    if ($_type == 'single') {

        $_url_imagem = base_url(___CONF_UPLOAD_DIR___ . ___CONF_UPLOAD_IMAGE_DIR___ . $_image_folder) . ($_image_folder ? DIRECTORY_SEPARATOR . $_image_name : $_image_name);
        $_imagem = '<a class="btn-image-thumb-lightbox" href="' . $_url_imagem . '" data-lightbox="' . $_image_name . '"><img class="img-responsive" src="' . $_url_imagem . '"></a>';

        $_btn_view_copy_image = '<div class="display-flex display-flex-wrap display-flex-justify-content-right">'
                . '     <div class="margin-bottom-0"><div class="btn-image-link-lightbox j-tooltip" data-toggle="tooltip" data-placement="right" data-original-title="Ver Imagem">' . $_imagem . '</div></div>'
                . '     <div class="btn btn-default btn-xs margin-bottom-0 margin-top-3"><a href="' . $_url_imagem . '" download="' . $_image_name . '" class="j-tooltip" data-toggle="tooltip" data-original-title="Download"><i class="fa fa-download"></i></a>'
                . '                                                                      &nbsp;&nbsp;|&nbsp;&nbsp;<a class="j-tooltip" data-toggle="tooltip" data-original-title="Copiar Link"  data-clipboard-message="Link da imagem copiado com sucesso." data-clipboard-text="' . $_url_imagem . '"><i class="fa fa-copy"></i></a></div>'
                . '</div>';


        return $_btn_view_copy_image;
    } elseif ($_type = 'group') {
        
    }
}

/**
 *  ==================================================================================================================================================================
 *      ARRAY's
 *  ==================================================================================================================================================================
 */

/**
 * FILTRA O CONTEÚDO DE UM ARRAY POR UM CAMPO ESPECÍFICO.
 *
 * 
 * $_filterArray['array']            Passa o ARRAY para ser filtrado
 * $_filterArray['field']            Passa o NOME DO CAMPO que contém o valor a ser filtrado
 * $_filterArray['value']            Passa o VALOR do CAMPO a ser filtrado
 * $_filterArray['like_value']       Y = Se contém a ocorrência em qualquer parte do campo ou N = Procura pelo valor exato da ocorrência no campo
 */
function mc_filter_field_array($_p) {

    return bz_filter_array($_p);
}

/**
 * FILTRA O CONTEÚDO DE UM ARRAY QUE CONTENHA UMA OCORRÊNCIA EM QUALQUER CAMPO DO ARRAY.
 * 
 * @param array $array       Passa o ARRAY para ser filtrado
 * @param string $search      Passa o VALOR a ser pesquisado dentro do ARRAY
 *
 * @return array
 */
function mc_filter_like_array($array, $search) {

    $_returnArray = [];

    foreach ($array as $row) {
        $_json = json_encode($row, JSON_UNESCAPED_UNICODE);

        if (mb_stristr($_json, $search)) {
            array_push($_returnArray, $row);
        }
    }

    return $_returnArray;
}

/* END function mc_search_like_array() */

/**
 * ALTERAR PARA MAIÚSCULO OU MINÚSCULO OS VALORES DO ARRAY RECURSIVAMENTE (SUPORTA UTF8 / MULTIBYTE)
 * 
 * Prâmetros: (CASE_LOWER: para minúsculo | CASE_UPPER: para maiúsculo)
 * 
 * @param array $array The array
 * @param int $case Case to transform (CASE_LOWER | CASE_UPPER)
 * @return array Final array
 * @return array
 */
function mc_change_values_case_array(array $array, $case = CASE_LOWER) {
    if (!is_array($array)) {
        return [];
    }

    /** @var integer $theCase */
    $theCase = ($case === CASE_LOWER) ? MB_CASE_LOWER : MB_CASE_UPPER;

    foreach ($array as $key => $value) {
        $array[$key] = is_array($value) ? mc_change_values_case_array($value, $case) : mb_convert_case($array[$key], $theCase, 'UTF-8');
    }

    return $array;
}

/**
 * EXCLUI UMA OU MAIS COLUNAS DE UM ARRAY
 *
 * @param array $array     Passa o array com os dados.
 * @param array $fields    Nome das Colunas/Campos do array que serão exluidas. EX: array('field-1','field-2','field-3');
 *
 * @return array
 */
function mc_exclude_column_array(array $array, array $fields) {

    foreach ($fields as $field):
        $array = bz_queryResultExcludeCol($array, $field);
    endforeach;

    return $array;
}

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
 * SETA OS ALERTAS DO SISTEMA EM TRIGGER NOTIFITI MESSENGER
 * Type : info, error, warning, success
 * 
 * @param type $mensagem
 * @param type $tipo
 * @param type $duration
 * @return type
 */
function mc_alertTriggerNotifi($mensagem = 'Sua mensagem aqui.', $tipo = 'info', $duration = 3200) {
    set_mensagem_trigger_notifi($mensagem, $tipo, $duration);
    return;
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

/**
 * SETA OS ALERTAS DO SISTEMA EM BOOTSTRAP DEFAULT
 * danger, warning, success, info
 * @param type $titulo
 * @param type $mensagem
 * @param type $fa_icon
 * @param type $tipo
 * @return type
 */
function mc_alert($titulo = NULL, $mensagem = NULL, $fa_icon = 'fa-times', $tipo = NULL) {
    set_mensagem($titulo, $mensagem, $fa_icon, $tipo);
    return;
}

/* function mc_alert() */

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
    return $CI->m->findByField($_dataBaseName, $_field, $_value, $_condition, $_orderBY);
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
    return $CI->read->exec($table_name, $where, $param);
}

/**
 * INSERT DATA ON DATABASE
 *
 * @param type $table_name
 * @param array $dados
 * @return type
 */
function mc_insertDataDB($table_name, array $dados) {
    $CI = & get_instance();
    return $CI->create->exec($table_name, $dados);
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
    return $CI->update->exec($table_name, $dados, $termos);
}

/**
 * MACRO DELETE DATA ON DATABASE
 *
 * @param type $table_name
 * @param type $termos
 * @return type
 */
function mc_deleteDataDB($table_name, $termos) {
    $CI = & get_instance();
    return $CI->update->ExecDelete($table_name, $termos);
}

/* ================================================================================================================================================================== */

/**
 *  ==================================================================================================================================================================
 *      EMAIL
 *  ==================================================================================================================================================================
 */

/**
 * MACRO ENVIAR EMAIL
 *
 * @param string $para              Para quem vai ser mandado este email - DESTINO
 * @param string $assunto           Qual o assunto do email
 * @param string $mensagem          Mensagem/Corpo do email
 * @param string $formato           Por padrão será HTML
 */
function mc_send_mail($para, $assunto, $mensagem, $formato = 'html') {
    return bz_enviar_email($para, $assunto, $mensagem, $formato);
}

/**
 *  ==================================================================================================================================================================
 *      DIVERSOS
 *  ==================================================================================================================================================================
 */

/**
 * MACRO REDIRECT PAGE
 * 
 * @param string $_redirectApp      Nome do APP para onde deverá ser redirecionado
 * @param string $_parametros       Parâmetros para do redirecionamento. Ex. search=nome&field=text
 */
function mc_redirect($_redirectApp = NULL, $_parametros = NULL) {
    $CI = & get_instance();

    if (empty($_redirectApp)) {
        $_redirectApp = $CI->router->fetch_class();
    }

    if (empty($_parametros)) {
        redirect($CI->_redirect . '/' . $_redirectApp . '?' . mc_get_parameters_url());
    } else {
        redirect($CI->_redirect . '/' . $_redirectApp . '?' . $_parametros);
    }
}

/**
 * MACRO QUE PEGA OS PARÂMETROS DA URL
 *
 * @return type
 */
function mc_get_parameters_url() {
    return bz_app_parametros_url();
}

/**
 * MACRO GRAVAR AUDITORIA
 *
 * @param array $dados  Array com os dados para gravar auditoria
 * 
 * $dados['action'] = 'add';
 * $dados['description'] = 'Mensagem da Auditoria';
 *
 * @return type
 */
function mc_add_auditoria($dados = array()) {
    return add_auditoria($dados);
}

/**
 * MACRO CONVERTE DATA PARA O PADRÃO QUE FOR PASSADO NO PARAMETRO $mascara
 *
 * Exemplo : mc_format_date(DATA,'d/m/Y H:i:s');
 * 
 * @param date $data
 * @param type $mascara
 * @return type
 */
function mc_format_date($data, $mascara) {
    return bz_formatdata($data, $mascara);
}

/**
 * MACRO PARA FORMATAÇÃO DE VALORES
 *
 * Exemplo : mc_format_date(DATA,'d/m/Y H:i:s');
 * 
 * @param type $valor
 * @param type $decimal
 * @param type $lang
 * @param type $cifrao
 * @return boolean
 */
function mc_format_moeda($valor, $decimal = 2, $lang = "br", $cifrao = null) {
    if ($lang == 'br') {
        return bz_converteMoedaBrasil($valor, $decimal, $cifrao);
    } elseif ($lang == 'en') {
        return bz_converteMoedaAmericana($valor, $decimal, $cifrao);
    } else {
        return false;
    }
}

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

