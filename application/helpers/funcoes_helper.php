<?php

/*
  Created on : 09/05/2017, 11:44:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */


defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BOX COLOR FUNCTION
 *
 * @param type $color
 */
function bz_box_color($color)
{

    $_box = 'box-';

    if (mc_contains_in_string('black', $color)) {
        return $_box . 'default';
    } elseif (mc_contains_in_string('blue', $color)) {
        return $_box . 'primary';
    } elseif (mc_contains_in_string('red', $color)) {
        return $_box . 'danger';
    } elseif (mc_contains_in_string('yellow', $color)) {
        return $_box . 'warning';
    } elseif (mc_contains_in_string('green', $color)) {
        return $_box . 'success';
    } elseif (mc_contains_in_string('purple', $color)) {
        return $_box . 'purple';
    }
}

/**
 * GET TABELAS DO SISTEMA
 */
function get_tables_system()
{

    $CI = &get_instance();

    $_tabelas = $CI->db->list_tables();

    foreach ($_tabelas as $key => $row) {

        if (strpos($row, 'sec_') !== false || strpos($row, '_sessions') !== false || strpos($row, 'proj_build') !== false) {
            unset($_tabelas[$key]);
        }
    }

    return $_tabelas;
}

//END get_tables_system()

/**
 * GET FIELDS GRIDLIST TABLE PROJECT
 *
 * @param type $_table
 * @return type
 */
function get_fields_gridlist_project($_id)
{
    $CI = &get_instance();

    $_fields = $CI->db->from('proj_build_fields')->where(array('proj_build_id' => $_id, 'screen_type' => 'gridlist'))->order_by('order_field_gridlist')->get()->result();

    $_row[] = array();
    $_c = 0;

    foreach ($_fields as $_field) {

        $_row[$_c]['field_name'] = $_field->field_name;
        $_row[$_c]['csrf_token'] = $CI->security->get_csrf_hash();

        $_c++;
    }

    return $_row;
}

//END get_fields_gridlist_project($_table);

/**
 * CHECK SE USUÁRIO É SUPER ADMIN
 */
function check_is_user_super_admin()
{

    $CI = &get_instance();

    if ($CI->session->userdata('user_login')['user_super_admin'] == 'Y') {
        return true;
    } else {
        return false;
    }
}

//END check_is_user_super_admin()

/**
 * CHECK SE USUÁRIO ESTÁ LOGADO NO SISTEMA
 */
function check_is_user_login()
{
    $CI = &get_instance();

    return $CI->session->has_userdata('user_login');
}

//END check_is_user_login()

/**
 * CHECK SE SISTEMA ESTÁ EM MANUTENÇÃO
 */
function check_system_is_manutencao()
{
    $CI = &get_instance();

    if (get_setting('em_manutencao') == 'SIM') {
        return true;
    } else {
        return false;
    }
}

//END check_system_is_manutencao()

/**
 * SETA OS ALERTAS DO SISTEMA EM TRIGGER NOTIFITI
 * Type : info, error, warning, success
 *
 * @param type $mensagem
 * @param type $tipo
 * @param type $icon
 * @param type $duration
 * @return string
 */
function set_mensagem_trigger_notifi($mensagem = 'Sua mensagem aqui.', $tipo = 'info', $duration = 3200)
{
    $CI = &get_instance();

    $result = "<script>" . PHP_EOL
        . "     $(window).on('pageshow',function(){ " . PHP_EOL
        . "         var param_" . $tipo . " = [];" . PHP_EOL
        . "         param_" . $tipo . "['title'] = '" . $mensagem . "';" . PHP_EOL
        . "         param_" . $tipo . "['icon'] = '';" . PHP_EOL
        . "         param_" . $tipo . "['color'] = '" . $tipo . "';" . PHP_EOL
        . "         param_" . $tipo . "['timer'] = " . $duration . ";" . PHP_EOL
        . ""
        . "         triggerNotify(param_" . $tipo . ");" . PHP_EOL
        . ""
        . "     });" . PHP_EOL
        . "</script>" . PHP_EOL;


    $CI->session->set_flashdata('mensagem_sistema', $result);

    return;
}

/**
 * SETA OS ALERTAS DO SISTEMA EM NOTFIT MESSENGER
 * Type : info, error, warning, success
 * Position: tr=Top Right, tr=Top Left, tc=Top Center
 *           br=Bottom Right, br=Bottom Left, bc=Bottom Center
 *
 * @param type $titulo
 * @param type $mensagem
 * @param string $tipo
 * @param type $position
 * @return boolean
 */
function set_mensagem_nice($titulo = NULL, $mensagem = NULL, $tipo = 'info', $position = 'br', $duration = 3200)
{
    $CI = &get_instance();
    if (empty($mensagem)) {
        return false;
    }

    $_tipo = '.';

    if ($tipo == 'success') {
        $_tipo .= 'notice';
    } elseif ($tipo == 'error') {
        $_tipo .= 'error';
    } elseif ($tipo == 'warning') {
        $_tipo .= 'warning';
    } else {
        $_tipo = '';
    }

    $result = "<script>"
        . "$(function () {"
        . "     $.HP" . $_tipo . "({"
        . "         message: '" . $mensagem . "',"
        . "         title: '" . $titulo . "',"
        . "         location: '" . $position . "',"
        . "         duration:  " . $duration
        . "     });"
        . "});"
        . "</script>";

    $CI->session->set_flashdata('mensagem_sistema', $result);

    return;
}

/**
 * SETA OS ALERTAS DO SISTEMA EM NOTFIT MESSENGER
 * info, error, warning, success
 * @param string $mensagem Mensagem de erro ou aviso
 * @param string $tipo Informa o tipo de mensagem a ser mostrado: info, warning, error, success
 *
 */
function set_mensagem_notfit($mensagem = NULL, $tipo = 'info')
{
    $CI = &get_instance();
    if (empty($mensagem) or empty($tipo)) {
        return false;
    }

    $result = "<script>
        notfit_msg_" . $tipo . "('" . $mensagem . "');
    </script>";

    $CI->session->set_flashdata('mensagem_sistema', $result);

    return;
}

//END set_mensagem_notfit()

/**
 * SETA OS ALERTAS DO SISTEMA EM SWEET ALERT
 * error, warning, success
 * @param string $titulo Informa o titulo da mensagem
 * @param string $mensagem Mensagem de erro ou aviso
 * @param string $tipo Informa o tipo de mensagem a ser mostrado: info, warning, error, success
 *
 * https://sweetalert.js.org/guides/
 *
 */
function set_mensagem_sweetalert($titulo = NULL, $mensagem = NULL, $tipo = 'info')
{
    $CI = &get_instance();
    if (empty($mensagem) or empty($titulo) or empty($tipo)) {
        return false;
    }

    $result = "<script>
        swal('" . $titulo . "', '" . $mensagem . "', '" . $tipo . "');
    </script>";

    $CI->session->set_flashdata('mensagem_sistema', $result);

    return;
}

//END set_mensagem_sweetalert()

/**
 * SETA OS ALERTAS DO SISTEMA EM TOASTR
 * error, warning, success
 * @param string $titulo Informa o titulo da mensagem
 * @param string $mensagem Mensagem de erro ou aviso
 * @param string $tipo Informa o tipo de mensagem a ser mostrado: info, warning, error, success
 */
function set_mensagem_toastr($titulo = NULL, $mensagem = NULL, $tipo = 'info', $position = 'top-right')
{
    $CI = &get_instance();
    if (empty($mensagem) or empty($titulo) or empty($tipo)) {
        return false;
    }

    if ($tipo == 'info') {
        $_loaderBg = '#29a7d8';
    } elseif ($tipo == 'warning') {
        $_loaderBg = '#f29a0c';
    } elseif ($tipo == 'error') {
        $_loaderBg = '#8e0705';
    } elseif ($tipo == 'success') {
        $_loaderBg = '#0c660f';
    } else {
        $_loaderBg = '#777373';
    }

    $result = "<script>
    $.toast({
        heading: '" . $titulo . "',
        text: '" . $mensagem . "',
        position: '" . $position . "',
        icon: '" . $tipo . "',
        loaderBg: '" . $_loaderBg . "'
    });

    </script>";

    $CI->session->set_flashdata('mensagem_sistema', $result);

    return;
}

//END set_mensagem_toastr()

/**
 * SETA OS ALERTAS DO SISTEMA
 * danger, warning, success, info
 * @param string $titulo Informa o titulo da mensagem
 * @param string $mensagem Mensagem de erro ou aviso
 * @param string $fa -icon Icone Font-awesome
 * @param string $tipo Informa o tipo de mensagem a ser mostrado: danger, warning, success, info
 */
function set_mensagem($titulo = NULL, $mensagem = NULL, $fa_icon = 'fa-times', $tipo = NULL)
{
    $CI = &get_instance();
    if (empty($mensagem) or empty($tipo)) {
        return false;
    }

    $result = '<div class="alert alert-' . $tipo . '" role="alert">';
    $result .= '     <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    $result .= '         <span aria-hidden="true">&times;</span>';
    $result .= '     </button>';

    if (!empty($titulo)) {
        $result .= '     <h4 class="alert-heading">' . ($fa_icon ? '<i class = "margin-right-5 fa ' . $fa_icon . '">' : '') . '</i>' . $titulo . '</h4>';
    }

    $result .= '    ' . $mensagem;
    $result .= '     <br />';
    $result .= '</div>';

    $CI->session->set_flashdata('mensagem_sistema', $result);

    return;
}

//END set_mensagem()

/**
 * PEGA OS ALERTAS DO SISTEMA QUE FORAM SETADOS PELO set_mensagem()
 */
function get_mensagem()
{
    $CI = &get_instance();

    if ($CI->session->flashdata('mensagem_sistema')) {
        $result = $CI->session->flashdata('mensagem_sistema');
        $CI->session->unset_userdata('mensagem_sistema');
        return $result;
    }
}

//END get_mensagem()

/**
 * CHECK SE O ACESSO A ALGUMA FUNCTION AJAX ESTÁ SENDO DIRETO PELA URL OU POR AJAX MESMO.
 */
function bz_check_is_ajax_request()
{

    $CI = &get_instance();

    if (!$CI->input->is_ajax_request()) {
        exit('<pre>eingang verboten.</pre><pre>unauthorized access.</pre><pre>acesso não permitido.</pre>');
    }
}

//END bz_check_is_ajax_request()

/**
 * FUNÇÃO PARA ENVIAR EMAIL.
 *
 * @param string $para Para quem vai ser mandado este email - DESTINO
 * @param string $assunto Qual o assunto do email
 * @param string $mensagem Mensagem/Corpo do email
 * @param string $formato Por padrão será HTML
 */
function bz_enviar_email($para, $assunto, $mensagem, $formato = 'html')
{

    $CI = &get_instance();

    $CI->load->library('email');


    $servidor_email = false;

    $config['mailtype'] = $formato;

    if (strlen($CI->config->item('config_email')['CONF_EMAIL_SMTP_HOST']) > 0 AND
        strlen($CI->config->item('config_email')['CONF_EMAIL_SMTP_HOST']) > 0 AND
        strlen($CI->config->item('config_email')['CONF_EMAIL_SMTP_USER']) > 0 AND
        strlen($CI->config->item('config_email')['CONF_EMAIL_SMTP_PASS']) > 0 AND
        strlen($CI->config->item('config_email')['CONF_EMAIL_FROM_EMAIL']) > 0) {
        $servidor_email = true;
    }
    /**/
    if ($servidor_email) {
        $config['mailtype'] = $formato;
        $config['protocol'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_PROTOCOL'];
        $config['smtp_host'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_HOST'];
        $config['smtp_port'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_PORT'];
        $config['smtp_timeout'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_TIMEOUT'];
        $config['smtp_user'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_USER'];
        $config['smtp_pass'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_PASS'];
        $config['charset'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_CHARSET'];
        $config['newline'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_NEWLINE'];

        if ($CI->config->item('config_email')['CONF_EMAIL_SMTP_CRYPTO']) {
            $config['smtp_crypto'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_CRYPTO'];
        }

        if ($CI->config->item('config_email')['CONF_EMAIL_SMTP_VALIDATION']) {
            $config['validation'] = $CI->config->item('config_email')['CONF_EMAIL_SMTP_VALIDATION'];
        }
    }

    $CI->email->initialize($config);

    if (!$servidor_email) {
        exit('DADOS INCOMPLETOS DA CONTA DO USUÁRIO DO EMAIL. FAVOR VERIFICAR AS VARIÁVEIS CONSTANTES DO SERVIDOR DO EMAIL.');
    }

    $CI->email->from($CI->config->item('config_email')['CONF_EMAIL_FROM_EMAIL']);
    $CI->email->to($para);
    $CI->email->subject($assunto);
    $CI->email->message($mensagem);
    if ($CI->email->send()) {
        return TRUE;
    } else {
//echo show_error($CI->email->print_debugger());
//        echo '<hr>ERRO AO ENVIAR EMAIL.';
        return FALSE;
    }
}

//END bz_enviar_email()

/**
 * PROCURA UMA OCORRÊNCIA EXATA DENTRO DE UM ARRAY E RETORNA UM ARRAY
 * COM OS DADOS FILTRADOS.
 *
 * @param type $elem
 * @param type $array
 * @return boolean
 */
function bz_find_in_multiarray($elem, $array)
{

    $_new_array = array();

    while (current($array) !== false) {

        if (current($array) == $elem) {
            $_new_array[] = current($array);
        } elseif (is_array(current($array))) {
            if (bz_find_in_multiarray($elem, current($array))) {
                $_new_array[] = current($array);
            }
        }
        next($array);
    }
    return $_new_array;
}

/**
 * FUNÇÃO QUE FILTRA O CONTEUDO DE UM ARRAY.
 *
 * @param string $_p ['array']       Passa o ARRAY para ser filtrado
 * @param string $_p ['field']       Passa o NOME DO CAMPO que contém o valor a ser filtrado
 * @param string $_p ['value']       Passa o VALOR do CAMPO a ser filtrado
 * @param string $_p ['like_value']  Y = Se contém a ocorrência no campo ou N = Procura pelo valor exato da ocorrência no campo
 *
 */
function bz_filter_array($_p = array())
{

    if (array($_p)) {

        $_array = $_p['array'];
        $_new_array = array();

        foreach ($_array as $_key => $_data) {

            if (isset($_data[$_p['field']])) {


                if (!empty($_p['like_value']) && $_p['like_value'] == 'Y') {

                    if (stristr($_data[$_p['field']], $_p['value'])) {
                        $_new_array[] = $_data;
                    } else {
                        unset($_array[$_key]);
                    }
                } else {

                    if ($_data[$_p['field']] != $_p['value']) {
                        unset($_array[$_key]);
                    } else {
                        $_new_array[] = $_data;
                    }
                }
            }
        }

        return $_new_array;
    }
}

//END function bz_filter_array();

/**
 * MACRO QUE GERA UMA STRING RANDOMICA.
 *
 * @param string $chars_min = 6                     Mínimo de caracteres a ser gerado
 * @param string $chars_max = 6                     Máximo de caracteres a ser gerado
 * @param string $use_upper_case = false            Retorna caracteres maiuslos ou minusculos
 * @param string $include_letter = false            Se vai ter letras na string
 * @param string $include_numbers = true            Se vai ter números na string
 * @param string $include_special_chars = false     Se vai ter caracteres especiais na string
 * @return type
 */
function mc_random_number($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_letter = false, $include_numbers = true, $include_special_chars = false)
{
    $length = mt_rand($chars_min, $chars_max);
    $selection = '';
    if ($include_letter) {
        $selection .= "aeubcdefgh";
    }
    if ($include_numbers) {
        $selection .= "1234567890";
    }
    if ($include_special_chars) {
        $selection .= "!@\"#$%&[]{}?|";
    }

    $_string = "";
    for ($i = 0; $i < $length; $i++) {
        $current_letter = $use_upper_case ? (mt_rand(0, 1) ? mb_strtoupper($selection[(mt_rand() % strlen($selection))]) : $selection[(mt_rand() % strlen($selection))]) : $selection[(mt_rand() % strlen($selection))];

        if ($use_upper_case) {
            $current_letter = mb_strtoupper($current_letter);
        }

        $_string .= $current_letter;
    }
    return $_string;
}

//END get_random_number()

/**
 * FUNÇÃO QUE PEGA URL DO APP COM OS PARÂMETROS.
 *
 */
function bz_app_parametros_url()
{

    $CI = &get_instance();

    if (strrchr($_SERVER['REQUEST_URI'], "?")) {
        $pos = strpos($_SERVER['REQUEST_URI'], '?') + 1;
        $param = substr($_SERVER['REQUEST_URI'], $pos);
        return $param;
    } else {
        return false;
    }
}

//END bz_current_url()

/**
 * FUNÇÃO QUE RETORNA O CAMINHO ABSOLUTO DO SERVIDOR ONDE ESTÁ SUA APLICAÇÃO HOSPEDADA.
 *
 */
function bz_absolute_path($_param = '')
{
//    return $_SERVER['DOCUMENT_ROOT'] . $_param;
    return ___CONF_APP_ABSOLUTE_PATH___ . $_param;
}

//END bz_absolute_path()

/**
 * FUNÇÃO QUE GERA UM INPUT SELECT.
 *
 * @param string $table Nome do Campo
 * @param string $field
 * @param string $pk Chave Primária do Registro ou ID
 * @param string $selected ID do Registro SELECIONADO
 *
 */
function ger_select_input($name, $table, $field, $pk, $selected = "")
{

    $CI = &get_instance();
    $select = '<select id="' . $name . '"  name="' . $name . '" class="form-control">';
    $data = $CI->db->get($table)->result();

    $select .= "<option value=''>Selecione...</option>";

    foreach ($data as $d) {

        $select .= "<option value='" . $d->$pk . "'";
        $select .= $selected == $d->$pk ? " selected='selected'" : "";
        $select .= ">" . mb_strtoupper($d->$field) . "</option>";
    }

    $select .= "</select>";

    return $select;
}

//END bz_converteMoedaBrasil()

/**
 * Converte valor monetário para o padrão Brasileiro
 *
 * @param string $get_valor Valor a ser convertido
 * @param string $decimal Casas Decimais - Default é 2
 * @param string $cifrap Cifrão Monetário: Brasil R$, EUA U$...
 */
function bz_converteMoedaBrasil($get_valor, $decimal = 2, $cifrao = null)
{
    $valor = number_format($get_valor, $decimal, ',', '.');

    if ($cifrao) {
        return $cifrao . $valor; //retorna o valor formatado para gravar no banco
    } else {
        return $valor; //retorna o valor formatado para gravar no banco
    }
}

//END bz_converteMoedaBrasil()

/**
 * Converte valor monetário para o padrão Americano
 *
 * @param string $get_valor Valor a ser convertido
 * @param string $decimal Casas Decimais - Default é 2
 * @param string $cifrap Cifrão Monetário: Brasil R$, EUA U$...
 */
function bz_converteMoedaAmericana($get_valor, $decimal = 2, $cifrao = null)
{
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor);

    if ($cifrao) {
        return $cifrao . $valor; //retorna o valor formatado para gravar no banco
    } else {
        return $valor; //retorna o valor formatado para gravar no banco
    }
}

//END bz_converteMoedaAmericana()

/**
 * PESQUISA UM OCORRÊNCIA DENTRO DE UMA STRING
 *
 * Usando a analogia de encontrar uma agulha em um palheiro.
 *
 * @param string $_agulha Agulha - O quê vc deseja encontrar
 * @param string $_palheiro Palheiro - Onde você deseja encontrar
 * @return boolean
 */
function mc_contains_in_string($_agulha, $_palheiro)
{
    $_r = strstr($_palheiro, $_agulha);

    if ($_r) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * MACRO QUE PREENCHE UMA STRING COM CARACTERES
 *
 * @param string $string Passa a string com os dados
 * @param string $orientacao Esquerda LEFT, Diretia RIGHT. Por padrão será LEFT
 * @param string $caracter Qual o tipo de caractar que será adicionado a String. Por padrão será *
 * @param string $quantidade Quantidade de caractar que será adicionado a String
 */
function mc_fill_string($string = '', $orientacao = "LEFT", $caracter = "*", $quantidade = '10')
{
    $tamanhoString = strlen(trim($string));
    $quantidade = ($quantidade - $tamanhoString) + 3;
    $retorno = $string;

    if ($orientacao == 'LEFT') {
        return str_pad($retorno, $quantidade, $caracter, STR_PAD_LEFT);
    } elseif ($orientacao == 'RIGHT') {
        return str_pad($retorno, $quantidade, $caracter);
    } elseif ($orientacao == 'BOTH') {
        return str_pad($retorno, $quantidade, $caracter, STR_PAD_BOTH);
    }
}

//END mc_fill_string()

/**
 * Exclui uma coluna específica de uma Query Result
 *
 * Exemplo : _queryResultExcluideCol('Array com o resultado da query', 'Nome da Coluna que será excluiuda da query')
 *
 * @param string $_query_result Passa o resultado da query select o result_array() como parâmetro.
 * @param string $_ColumnExclude Nome da Coluna/Campo da query result que será exluida do array.
 */
function bz_queryResultExcludeCol($_query_result = array(), $_ColumnExclude = NULL)
{

    foreach ($_query_result as $key => $value) {
        unset($_query_result[$key][$_ColumnExclude]);
    }

    return $_query_result;
}

//END bz_queryResultExcluideCol()

/**
 * Converte data para o padrão que for passado no parametro $mascara
 *
 * Exemplo : bz_formatdata(DATA,'d/m/Y H:i:s')
 *
 * @param string $data Passa a string com a data
 * @param string $mascara Como a data será formatada. Exemplo: 'd/m/Y H:i:s'
 */
function bz_formatdata($data, $mascara = 'd/m/Y')
{

    if (date('Y', strtotime(str_replace('/', '-', $data))) == '-0001' || empty($data)) {
        return;
    }

    return date($mascara, strtotime(str_replace('/', '-', $data)));
}

//END bz_formatdata()

/**
 * FAZ A PAGINAÇÃO DE RESULTADOS DE UMA GRID.
 *
 * Os parametros são passados em array(''=>'').
 *
 * A FUNÇÃO RETORNARÁ DOIS array's
 *
 * $data["results_paginacao"]     Array Com os dados/registros da GRID LIST.
 * $data["links_paginacao"]       Array Com a Paginção dos dados/registros da GRID LIST.
 * $data["dados_paginacao"]       Array Com a Quantidade de Registros Paginados.
 *
 *
 * @param string    programa              Nome do Classe do Controller. Se não for informado o padrão será $CI->router->fetch_class().
 * @param integer   per_page              Quantidade de Registros por Página. Se não for informado o padrão será 10 linhas por página.
 * @param string    search                Fltra os dados/registros da GRID LIST. Exemplpo: 'search'=>array('_concat_fields'=>'descricao, nome', '_string'=>'maria').
 * @param string    where                 Complemento da parâmetro SEARCH. Fltra os dados/registros da GRID LIST. Exemplpo: array('name' => $name, 'title' => $title, 'status !=' => $status).
 * @param string    join                  Faz um INNER JOIN na tabela relacionada
 * @param string    table                 Nome da Tabela
 * @param string    order_by              Campos para Ordenação
 *
 *
 */
function bz_paginacao($param = array())
{

    $CI = &get_instance();

    $_current_page = ($CI->input->get('pg', TRUE) - 1);
    $_tabela = $param['table'];
    $_search = (isset($param['search'])) ? $param['search'] : '';
    $_filter = (isset($param['filter'])) ? $param['filter'] : '';
    $_where = (isset($param['where'])) ? $param['where'] : '';
    $_or_where = (isset($param['or_where'])) ? $param['or_where'] : '';

    $_programa = (isset($param['programa'])) ? $param['programa'] : $CI->router->fetch_class();


    if ($_filter) {
        $CI->db->like($_filter);
    }

    if (!empty($_where) || !empty($_search)) {

        if (!empty($_where)) {
            $CI->db->where($_where);
        }

        if (!empty($_or_where)) {
            $CI->db->or_where($_or_where);
        }

        if (!empty($_search)) {

            $_fields = explode(',', $_search['_concat_fields']);

            foreach ($_fields as $_f) {
                $CI->db->or_like('LOWER(' . $_f . ')', mb_strtolower($_search['_string']));
            }


        }
    }

    /* COUNT QUANTIDADE DE REGISTROS NA TABELA */
    $_total_row = $CI->db->get($_tabela)->num_rows();
    /* END COUNT QUANTIDADE DE REGISTROS NA TABELA */

    /* QUANTIDADE DE LINHAS PARA PAGINAÇÃO DOS DADOS */
    if (isset($param['per_page'])) {
        if ($param['per_page'] == 0) {
            $_per_page = $_total_row;
        } else {
            $_per_page = $param['per_page'];
        }
    } else {
        $_per_page = 10;
    }
    /* END QUANTIDADE DE LINHAS PARA PAGINAÇÃO DOS DADOS */


    $_num_links = ceil($_total_row / $_per_page) - 1;

    if ($_current_page > $_num_links) {
        $_current_page = $_num_links;
    } elseif ($_current_page < 0) {
        $_current_page = 0;
    }

    $config = array();

    $config["base_url"] = site_url() . $_programa;
    $config["total_rows"] = $_total_row;
    $config["per_page"] = $_per_page;
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = 3;
    $config['cur_tag_open'] = '&nbsp;<a class="current">';
    $config['cur_tag_close'] = '</a>';
    $config['next_link'] = 'Next';
    $config['prev_link'] = 'Previous';
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 'pg';
    $config['display_pages'] = TRUE;
    $config['reuse_query_string'] = TRUE;


    /*
     * FORMATAÇÃO DOS LINKS PARA BOOTSTRAP
     */
    $config["full_tag_open"] = '<ul class="pagination pagination-sm no-margin pull-right">';
    $config["full_tag_close"] = '</ul>';
    $config["first_link"] = "<span class='tooltip-open-event' title='Primeira Página'>&laquo;</span>";
    $config["first_tag_open"] = "<li class='btn-show-modal-aguarde'>";
    $config["first_tag_close"] = "</li>";
    $config["last_link"] = "<span class='tooltip-open-event' title='Última Página'>&raquo;</span>";
    $config["last_tag_open"] = "<li class='btn-show-modal-aguarde'>";
    $config["last_tag_close"] = "</li>";
    $config['next_link'] = "<span class='tooltip-open-event' title='Próxima Página'>&gt;</span>";
    $config['next_tag_open'] = "<li class='btn-show-modal-aguarde'>";
    $config['next_tag_close'] = "<li class='btn-show-modal-aguarde'>";
    $config['prev_link'] = "<span class='tooltip-open-event' title='Página Anterior'>&lt;</span>";
    $config['prev_tag_open'] = "<li class='btn-show-modal-aguarde'>";
    $config['prev_tag_close'] = "<li class='btn-show-modal-aguarde'>";
    $config['cur_tag_open'] = " <li class='active'><a> ";
    $config['cur_tag_close'] = "</a></li>";
    $config['num_tag_open'] = "<li class='btn-show-modal-aguarde'>";
    $config['num_tag_close'] = "</li>";

    /*
     * END FORMATAÇÃO DOS LINKS PARA BOOTSTRAP
     */


    $CI->pagination->initialize($config);


    /* WHERE GLOBAL DO CONTROLLER PAI - MY_CONTROLLER */
    if (!empty($CI->where)) {
        $CI->db->where($CI->where);
    }
    /* END WHERE GLOBAL DO CONTROLLER PAI - MY_CONTROLLER */


    if (!empty($_where) || !empty($_search)) {

        if (!empty($_where)) {
            $CI->db->where($_where);
        }

        if (!empty($_or_where)) {
            $CI->db->or_where($_or_where);
        }

        if (!empty($_search['_string'])) {

            $_fields = explode(',', $_search['_concat_fields']);

            foreach ($_fields as $_f) {
                $CI->db->or_like('LOWER(' . $_f . ')', mb_strtolower($_search['_string']));
            }

        }
    }

    if (!empty($_filter)) {
        $CI->db->like($_filter);
    }


    if (isset($param['order_by'])) {
        $CI->db->order_by($param['order_by']);
    }

    $CI->db->limit(abs($_per_page), abs($_per_page * $_current_page));

    $_results = $CI->db->get($_tabela);


    $data["results_paginacao"] = $_results->result();
    $data["results_paginacao_array"] = $_results->result_array();
    $data["links_paginacao"] = $CI->pagination->create_links();
    $_mostrando_de = ($_per_page * $_current_page) + 1;
    $_mostrando_ate = $_per_page * ($_current_page + 1);

    if ($_mostrando_ate > $_total_row) {
        $_mostrando_ate = $_total_row;
    }

    $data["dados_paginacao"] = 'Mostrando de ' . (($_total_row > 0) ? $_mostrando_de : 0) . ' até ' . $_mostrando_ate . ' de ' . $_total_row . ' registros';
    $data["paginacao_total_paginas"] = ($_current_page + 1);

    return $data;
}

//END bz_paginacao()

/**
 * DELETA ARQUIVOS COM TEMPO DE VIDA MAIOR X MINUTOS
 *
 * Ex: bz_delete_file_for_expired_lifetime('folder-name',5);
 * Este exemplo irá apagar todos os arquivos que tem seu tempo de criação maior ou igual a 5 minutos.
 * Se não informar o último parâmetro o padrão será 1 minuto.
 *
 * @param type $_source_dir
 * @param type $_minutes
 * @return type
 */
function bz_delete_file_for_expired_lifetime($_source_dir, $_minutes = 1)
{

    $CI = &get_instance();
    $CI->load->helper('directory');

    $_diretoryMap = directory_map(FCPATH . $_source_dir, 1);
    $_diretoryMap = array_diff($_diretoryMap, ['.', '..', 'index.html']);

    foreach ($_diretoryMap as $file) {

        $_fileTTL = filemtime(FCPATH . $_source_dir . '/' . $file) + (60 * $_minutes);
        $_fileDel = FCPATH . $_source_dir . '/' . $file;

        if (time() > $_fileTTL) {
            if (file_exists($_fileDel)) {
                unlink($_fileDel);
            }
        }
    }

    return;
}

/**
 * FUNÇÃO QUE DELETA ARQUIVOS QUE ESTÃO SEM CADASTRO EM UMA TABELA, ÓRFÃOS.
 *
 * @param string $_path_file Caminho absoluto onde está o arquivo
 * @param string $_table_name Tabela onde será procurado o arquivo
 * @param string $_field_name Nome do campo onde está gravado o nome do arquivo
 *
 */
function bz_delete_files_orphans($_path_file, $_table_name, $_field_name)
{
    $CI = &get_instance();
    $CI->load->helper('directory');

    $_scan = directory_map($_path_file);
    $_scan = array_diff($_scan, ['.', '..', 'index.html']);

    foreach ($_scan as $key => $file) {

        /*
         * PROCURA NA TABELA O NOME DO ARQUIVO
         */
        $termosDB = array();
        $termosDB = 'WHERE ' . $_field_name . ' LIKE "%' . $file . '%" LIMIT 1';
        $result = $CI->read->exec($_table_name, $termosDB);

        if ($result->num_rows() == 0) {
            /*
             * SE NÃO ENCONTROU NA TABELA, APAGA O ARQUIVO.
             */
            $_filepath = $_path_file . $file;

            if (is_file($_filepath)) {
                unlink($_filepath);
            }
        }
    }
}

//END bz_delete_files_orphans()

/**
 * FUNÇÃO QUE PEGA A EXTENSÃO DE UM ARQUIVO.
 *
 * Os parametros são passados em array(''=>'').
 *
 * @param string $_param ['path_file']            Caminho Absoluto onde está o arquivo
 * @param string $_param ['name_file']           Nome do Arquivo
 *
 */
function bz_extension_file($_param = array())
{

    if ($_param['path_file'] && $_param['name_file']) {
        return pathinfo($_param['path_file'] . $_param['name_file'], PATHINFO_EXTENSION);
    } else {
        return false;
    }
}

//bz_extension_file()

/**
 *
 * RECUPERAR O IP REAL DO USUÁRIO
 *
 */
function bz_get_client_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//END bz_get_client_ip()


/*
 * Salva ou atualiza uma config no BD
 */
function set_setting($nome, $valor = '')
{
    $CI = &get_instance();
    $CI->load->model('settings_model', 'settings');
    if ($CI->settings->get_bynome($nome)->num_rows() == 1) {
        if (trim($valor) == '') {
            $CI->settings->do_delete(array('nome_config' => $nome), FALSE);
        } else {
            $dados = array(
                'nome_config' => $nome,
                'valor_config' => $valor
            );
            $CI->settings->do_update($dados, array('nome_config' => $nome), FALSE);
        }
    } else {
        $dados = array(
            'nome_config' => $nome,
            'valor_config' => $valor
        );
        $CI->settings->do_insert($dados, FALSE);
    }
}

/*
 * Retorna uma config do BD
 *
 * Exemplo:
 * if (get_setting('time_zone')){
 *       date_default_timezone_set(get_setting('time_zone'));
 *   }
 */

function get_setting($nome)
{
    $CI = &get_instance();
    $CI->load->model('settings_model', 'settings');
    $setting = $CI->settings->get_bynome($nome);
    if ($setting->num_rows() == 1) {
        $setting = $setting->row();
        return $setting->valor_config;
    } else {
        return NULL;
    }
}

//END get_setting()


/*
 * CRIA O FORM COM AS CONFIGURAÇÕES GERAIS DO SISTEMA sec_settings
 */

function settingsConfig($_p)
{
    $CI = &get_instance();
    $dadosForm = '';

    /*
     * FORM Configurações Gerais - Carrega.
     */
    if ($_p == 'gerais') {

        /*
         * Campo Time Zone da Aplicação
         */
        $CI->db->where('nome_config', 'time_zone');
        $CI->db->limit(1);
        $time_zone = $CI->db->get('sec_settings')->row();
        if ($time_zone) {
            $time_zone = ($time_zone->valor_config) ? $time_zone->valor_config : '';
        } else {
            $time_zone = '';
        }
        $dadosForm .= '
            <div class="form-group">
            <label class="control-sidebar-subheading">
            Time Zone
            <input type="text" name="time_zone" class="text-blue" style="width:100%" value="' . $time_zone . '" />
            </label>
            <p>
            Configura O Fuso Horário Padrão do Sistema.
            </p>
            </div>
            ';
        /* END Campo Modo Debug da Aplicação */


        /*
         * Campo Sistema em Manutenção
         */
        $CI->db->where('nome_config', 'em_manutencao');
        $CI->db->limit(1);
        $em_manutencao = $CI->db->get('sec_settings')->row();
        if ($em_manutencao) {
            $em_manutencao = ($em_manutencao->valor_config == 'SIM') ? 'checked' : '';
        } else {
            $em_manutencao = '';
        }
        $dadosForm .= '
            <div class="form-group">
            <label class="control-sidebar-subheading">
            Sistema em Manutenção 
            <input type="checkbox" name="em_manutencao" class="pull-right" ' . $em_manutencao . ' />
            </label>
            <p>
            Suspende o uso do sistema para manutenção.
            </p>
            </div>
            ';
//END Campo Sistema em Manutenção

        /*
         * Campo Multiplos Logins
         */
        $CI->db->where('nome_config', 'multiplos_logins');
        $CI->db->limit(1);
        $multiplos_logins = $CI->db->get('sec_settings')->row();
        if ($multiplos_logins) {
            $multiplos_logins = ($multiplos_logins->valor_config == 'SIM') ? 'checked' : '';
        } else {
            $multiplos_logins = '';
        }
        $dadosForm .= '
            <div class="form-group">
            <label class="control-sidebar-subheading">
            Multiplos Logins
            <input type="checkbox" name="multiplos_logins" class="pull-right" ' . $multiplos_logins . ' />
            </label>
            <p>
            Aceita o usuário utilizar a mesma senha para mais de um computador ao mesmo tempo.
            </p>
            </div>
            ';
//END Campo Multiplos Logins


        /*
         * Campo Tempo de Renderização do APP
         */
        $CI->db->where('nome_config', 'time_render');
        $CI->db->limit(1);
        $time_render = $CI->db->get('sec_settings')->row();
        if ($time_render) {
            $time_render = ($time_render->valor_config == 'SIM') ? 'checked' : '';
        } else {
            $time_render = '';
        }
        $dadosForm .= '
            <div class="form-group">
            <label class="control-sidebar-subheading">
            Time Render
            <input type="checkbox" name="time_render" class="pull-right" ' . $time_render . ' />
            </label>
            <p>
            Ativa o display que mostra o tempo de Renderização de um APP.
            </p>
            </div>
            ';
//END Campo Tempo de Renderização do APP


        /*
         * Campo Modo Debug da Aplicação
         */
        $CI->db->where('nome_config', 'debug_mode');
        $CI->db->limit(1);
        $debug_mode = $CI->db->get('sec_settings')->row();
        if ($debug_mode) {
            $debug_mode = ($debug_mode->valor_config == 'SIM') ? 'checked' : '';
        } else {
            $debug_mode = '';
        }
        $dadosForm .= '
            <div class="form-group">
            <label class="control-sidebar-subheading">
            Modo Debug
            <input type="checkbox" name="debug_mode" class="pull-right" ' . $debug_mode . ' />
            </label>
            <p>
            Ativa o modo de Debug da Aplicação.
            </p>
            </div>
            ';
//END Campo Modo Debug da Aplicação
    }
    /*
     * END FORM Configurações Gerais - Carrega.
     */


    /*
     * FORM DE SKINS
     */
    if ($_p == 'skins') {
        $CI->db->where('nome_config', 'layout_skin');
        $CI->db->limit(1);
        $layout_skin = $CI->db->get('sec_settings')->row();

        $dadosForm .= '
        <ul class="list-unstyled clearfix margin-bottom-20">
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Blue</p>
                <p class="text-center no-margin"><input type="radio" value="blue" name="layout_skin[]" id="skin-blue" ' . (($layout_skin->valor_config == 'blue') ? 'checked' : '') . ' /></p>
                
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Black</p>
                <p class="text-center no-margin"><input type="radio" value="black" name="layout_skin[]" id="skin-black" ' . (($layout_skin->valor_config == 'black') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Purple</p>
                <p class="text-center no-margin"><input type="radio" value="purple" name="layout_skin[]" id="skin-purple" ' . (($layout_skin->valor_config == 'purple') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Green</p>
                <p class="text-center no-margin"><input type="radio" value="green" name="layout_skin[]" id="skin-green" ' . (($layout_skin->valor_config == 'green') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Red</p>
                <p class="text-center no-margin"><input type="radio" value="red" name="layout_skin[]" id="skin-red" ' . (($layout_skin->valor_config == 'red') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin">Yellow</p>
                <p class="text-center no-margin"><input type="radio" value="yellow" name="layout_skin[]" id="skin-yellow" ' . (($layout_skin->valor_config == 'yellow') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin" style="font-size: 12px">Blue Light</p>
                <p class="text-center no-margin"><input type="radio" value="blue-light" name="layout_skin[]" id="skin-blue-light" ' . (($layout_skin->valor_config == 'blue-light') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin" style="font-size: 12px">Black Light</p>
                <p class="text-center no-margin"><input type="radio" value="black-light" name="layout_skin[]" id="skin-black-light" ' . (($layout_skin->valor_config == 'black-light') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin" style="font-size: 12px">Purple Light</p>
                <p class="text-center no-margin"><input type="radio" value="purple-light" name="layout_skin[]" id="skin-purple-light" ' . (($layout_skin->valor_config == 'purple-light') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin" style="font-size: 12px">Green Light</p>
                <p class="text-center no-margin"><input type="radio" value="green-light" name="layout_skin[]" id="skin-green-light" ' . (($layout_skin->valor_config == 'green-light') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin" style="font-size: 12px">Red Light</p>
                <p class="text-center no-margin"><input type="radio" value="red-light" name="layout_skin[]" id="skin-red-light" ' . (($layout_skin->valor_config == 'red-light') ? 'checked' : '') . '/></p>
            </li>
            <li style="float:left; width: 33.33333%; padding: 5px;">
                <a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                    <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span>
                    </div>
                    <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span>
                    </div>
                </a>
                <p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>
                <p class="text-center no-margin"><input type="radio" value="yellow-light" name="layout_skin[]" id="skin-yellow-light" ' . (($layout_skin->valor_config == 'yellow-light') ? 'checked' : '') . '/></p>
            </li>
        </ul>            
        ';
//END SKINS
    }
    /*
     * END FORM DE SKINS
     */


    /*
     * FORM Configurações de Layout do Sistema
     */
    if ($_p == 'other-config') {


        /*
         * Menu Collapse
         */
        $CI->db->where('nome_config', 'sidebar_collapsed');
        $CI->db->limit(1);
        $sidebarCollapse = $CI->db->get('sec_settings')->row();
        if ($sidebarCollapse) {
            $sidebarCollapse = ($sidebarCollapse->valor_config == 'SIM') ? 'checked' : '';
        } else {
            $sidebarCollapse = '';
        }
        $dadosForm .= '
            <div class="form-group">
            <label class="control-sidebar-subheading">
            Menu Fechado 
            <input type="checkbox" name="sidebar_collapsed" class="pull-right" ' . $sidebarCollapse . ' />
            </label>
            <p>
            Inicia o Sistema com o Menu Fechado.
            </p>
            </div>
            ';
//END Campos Configurações Sistema
    }
    /*
     * END FORM Configurações de Layout do Sistema
     */


    return $dadosForm;
}

//END settingsConfig()


/*
 * GRAVA UMA AUDITORIA
 */
function add_auditoria($dados = array())
{

    $CI = &get_instance();

    if (!is_array($dados)) {
        return FALSE;
    }

    if (empty($dados['creator'])) {
        $dados['creator'] = 'user';
    }

    /*
     * Insert Dados
     */
    $dados['inserted_date'] = date('y-m-d H:i:s');
    $dados['ip_user'] = $CI->input->ip_address();
    $dados['user_agent'] = getAgentUser(true);

    if ($CI->session->has_userdata('user_login')) {
        $dados['username'] = $CI->session->userdata('user_login')['user_nome'] . ' - ' . $CI->session->userdata('user_login')['user_email'];
    }

    $dados['application'] = $CI->router->fetch_class();
    $dados['method'] = $CI->router->fetch_method();

    if (isset($dados['last_query'])) {
        $dados['last_query'] = str_replace("'", '"', $dados['last_query']);
    }


    $result = $CI->create->exec('sec_auditoria', $dados);

    return $result;
}

//END add_auditoria()

/*
 * RENOMEIA DIRETÓRIO PARA SER DELETADO ACRESCENTANDO A PALAVRA DELETE NO NOME DO DIRETÓRIO
 */

function bz_renamedir($dir, $file)
{

    $CI = &get_instance();
    $CI->load->helper('date_helper');

    $_dateTime = time();

    if (is_dir($dir . $file)) {

        if (rename($dir . $file, $dir . 'DELETE-' . $file . '-' . $_dateTime)) {
            return true;
        } else {
            return false;
        }
    }
}

//END function bz_renamedir()

/**
 * FAZ UMA LIMPEZA NA STRING DEIXANDO SOMENTE LETRAS, NÚMERO E UNDERLINE
 */
function bz_limpa_string($str)
{
    $str = str_replace(' ', '_', $str);
    return preg_replace("/[^A-Za-z0-9_]/", "", $str);
}

//END function bz_limpa_string()


/*
 * Pega o AgetUser e o Sistema Operacional que está sendo utilizado.
 */
function getAgentUser($auditoria = FALSE)
{

    $CI = &get_instance();

    if ($CI->agent->is_browser()) {
        $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
    } elseif ($CI->agent->is_robot()) {
        $agent = $CI->agent->robot();
    } elseif ($CI->agent->is_mobile()) {
        $agent = $CI->agent->mobile();
    } else {
        $agent = 'Unidentified User Agent';
    }


    if (!$auditoria) {
        return '<br><br> <b>IP:</b> ' . $CI->input->ip_address() . ' <b>- Data/Hora:</b> ' . date('d/m/Y H:i:s') . 'Hs. <b>- Navegador:</b> ' . $agent . ' <b>- Sistema Operacional:</b> ' . $CI->agent->platform();
    } else {
        return 'Navegador: ' . $agent . ' - Sistema Operacional: ' . $CI->agent->platform();
    }
}

//END getAgentUser()


/*
 * MACRO QUE RETORNA O MÊS DE UMA DATA
 * Se nome=true, retorna o mês por extenso.
 *
 * @param date $data
 * @param boolean $nome
 * @return boolean|string
 */

function mc_month_date($data = null, $extenso = FALSE)
{

    if ($data != NULL) {
        $data = bz_formatdata($data, 'Y-m-d');
        $mes = date("m", strtotime($data));
        if ($extenso == TRUE) {
            $mes_extenso = array('01' => 'JANEIRO', '02' => 'FEVEREIRO', '03' => 'MARÇO', '04' => 'ABRIL', '05' => 'MAIO', '06' => 'JUNHO', '07' => 'JULHO', '08' => 'AGOSTO', '09' => 'SETEMBRO', '10' => 'OUTUBRO', '11' => 'NOVEMBRO', '12' => 'DEZEMBRO');
            return $mes_extenso[$mes];
        } else {
            return $mes;
        }
    } else {
        return false;
    }
}

//END mc_month_date()


/*
 * MACRO CORTA PALAVRAS DE UMA STRING
 *
 * @param string $string
 * @param string $palavras
 * @param boolean $decodifica_html
 * @param boolean $remove_tags
 * @return boolean|string
 */

function mc_cut_word_string($string = NULL, $palavras = 50, $decodifica_html = TRUE, $remove_tags = TRUE)
{
    if ($string != NULL) {
        if ($decodifica_html)
            $string = to_html($string);
        if ($remove_tags)
            $string = strip_tags($string);
        $retorno = word_limiter($string, $palavras);
        return $retorno;
    } else {
        return FALSE;
    }
}

//END mc_cut_word_string() MACRO CORTA PALAVRAS DE UMA STRING


/*
 * Converter dados do bd para html válido
 */
function to_html($string = NULL)
{
    return html_entity_decode($string);
}

//END Converter dados do bd para html válido


/*
 * Escreve um valor por extenso.
 * Alguns exemplos de uso da função:
 *
 *
 * //Vai exibir na tela "um milhão, quatrocentos e oitenta e sete mil, duzentos e cinquenta e sete e cinquenta e cinco"
 * echo valorPorExtenso("R$ 1.487.257,55", false, false);
 *
 * //Vai exibir na tela "um milhão, quatrocentos e oitenta e sete mil, duzentos e cinquenta e sete reais e cinquenta e cinco centavos"
 * echo valorPorExtenso("R$ 1.487.257,55", true, false);
 *
 * //Vai exibir na tela "duas mil e setecentas e oitenta e sete"
 * echo valorPorExtenso("2787", false, true);ENIO
 */
function mc_extensive_value($valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false)
{

    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $valor);

    $singular = null;
    $plural = null;

    if ($bolExibirMoeda) {
        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");
    } else {
        $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("", "", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");
    }

    $c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
    $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
    $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");


    if ($bolPalavraFeminina) {

        if ($valor == 1) {
            $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
        } else {
            $u = array("", "um", "duas", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
        }


        $c = array("", "cem", "duzentas", "trezentas", "quatrocentas", "quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
    }


    $z = 0;

    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);

    for ($i = 0; $i < count($inteiro); $i++) {
        for ($ii = mb_strlen($inteiro[$i]); $ii < 3; $ii++) {
            $inteiro[$i] = "0" . $inteiro[$i];
        }
    }

// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
    $rt = null;
    $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
    for ($i = 0; $i < count($inteiro); $i++) {
        $valor = $inteiro[$i];
        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
        $t = count($inteiro) - 1 - $i;
        $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($valor == "000")
            $z++;
        elseif ($z > 0)
            $z--;

        if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
            $r .= (($z > 1) ? " de " : "") . $plural[$t];

        if ($r)
            $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    $rt = mb_substr($rt, 1);

    return ($rt ? trim($rt) : "zero");
}

//END Escreve um valor por extenso.

/**
 * CREATE MODAL
 *
 * @param array $_p
 * @return string
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

function bz_modal($_p = [])
{

    if (empty($_p['modalTitle'])) {
        $_p['modalTitle'] = '<p></p>';
    }
    if (empty($_p['modalText'])) {
        $_p['modalText'] = 'SEU TEXTO AQUI.';
    }

    if (empty($_p['modalSize'])) {
        $_p['modalSize'] = 'modal-md';
    } elseif ($_p['modalSize'] == 'large') {
        $_p['modalSize'] = 'modal-lg';
    } elseif ($_p['modalSize'] == 'small') {
        $_p['modalSize'] = 'modal-sm';
    } else {
        $_p['modalSize'] = 'modal-md';
    }

    if (empty($_p['modalShow'])) {
        $_p['modalShow'] = false;
    }


    $_modal = '';

    $_modal .= '<div id="bzModal' . (!empty($_p['modalName']) ? $_p['modalName'] : '') . '" class="modal fade ' . (!empty($_p['modalClassCss']) ? $_p['modalClassCss'] : '') . '">' . PHP_EOL;
    $_modal .= '    <div class="modal-dialog ' . $_p['modalSize'] . '">' . PHP_EOL;
    $_modal .= '        <div class="modal-content">' . PHP_EOL;
    $_modal .= '            <div class="modal-header">' . PHP_EOL;
    $_modal .= '                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' . PHP_EOL;
    $_modal .= '                <h4 class="modal-title">' . (!empty($_p['modalTitle']) ? $_p['modalTitle'] : '') . '</h4>' . PHP_EOL;
    $_modal .= '            </div>' . PHP_EOL;
    $_modal .= '            <div class="modal-body">' . PHP_EOL;
    $_modal .= '                <p>' . (!empty($_p['modalText']) ? $_p['modalText'] : '') . '</p>' . PHP_EOL;

    if (!empty($_p["modalTextSmall"])) {
        $_modal .= '                <p class="text-warning"><small>' . $_p['modalTextSmall'] . '</small></p>' . PHP_EOL;
    }

    $_modal .= '            </div>' . PHP_EOL;

    if (!empty($_p["modalBtnClose"]) || !empty($_p["modalBtnConfirm"])) {
        $_modal .= '            <div class="modal-footer">' . PHP_EOL;
        if (!empty($_p["modalBtnClose"])) {
            $_modal .= '                <button type="button" id="' . (!empty($_p['modalBtnCloseIdCss']) ? $_p['modalBtnCloseIdCss'] : '') . '" class="btn btn-default" data-dismiss="modal">' . (!empty($_p['modalBtnClose']) ? $_p['modalBtnClose'] : '') . '</button>' . PHP_EOL;
        }
        if (!empty($_p["modalBtnConfirm"])) {
            $_modal .= '                    <button type="button" id="' . (!empty($_p['modalBtnConfirmIdCss']) ? $_p['modalBtnConfirmIdCss'] : '') . '" class="btn btn-primary">' . (!empty($_p['modalBtnConfirm']) ? $_p['modalBtnConfirm'] : '') . '</button>' . PHP_EOL;
        }
        $_modal .= '            </div>' . PHP_EOL;
    }

    $_modal .= '        </div>' . PHP_EOL;
    $_modal .= '    </div>' . PHP_EOL;
    $_modal .= '</div>' . PHP_EOL;

    if ($_p['modalShow']) {
        $_modal .= '<script>$(function(){$("#bzModal' . (!empty($_p['modalName']) ? $_p['modalName'] : '') . '").modal();});</script>' . PHP_EOL;
    }

    return $_modal;
}

/**
 * REMOVE THE HTML TAGS ALONG WITH THEIR CONTENTS
 *
 * @param type $string
 * @return type
 */
function bz_remove_strip_tags_content($string)
{

// ----- remove HTML TAGs ----- 
    $string = preg_replace('/<[^>]*>/', ' ', $string);

// ----- remove control characters ----- 
    $string = str_replace("\r", '', $string);    // --- replace with empty space
    $string = str_replace("\n", ' ', $string);   // --- replace with space
    $string = str_replace("\t", ' ', $string);   // --- replace with space
// ----- remove multiple spaces ----- 
    $string = trim(preg_replace('/ {2,}/', ' ', $string));

    return $string;
}

/**
 * UPLOAD IMAGE
 *
 * PASSA UM ARRAY COMO PARÂMETRO
 *
 * @param type $_file_name
 * @param type $_upload_path
 * @param type $_allowed_types
 * @param type $_max_size
 * @param type $_max_width
 * @param type $_max_height
 * @return string
 */
function bz_upload_file($_file_name, $_file, $_upload_path, $_allowed_types, $_max_size = 1024, $_max_width = 0, $_max_height = 0)
{

    /* VALIDATION UPLOAD FILE */
    if (empty($_file_name) || empty($_file)) {
        $_error['error']['message'] = 'Nenhum arquivo enviado para Upload.';
        return $_error;
    }
    /* END VALIDATION UPLOAD FILE */

    $_original_files = $_FILES;
    $_FILES = $_file;

    $CI = &get_instance();

    $_FILES[$_file_name]['name'] = $CI->security->sanitize_filename($_FILES[$_file_name]['name']);

    $config['upload_path'] = bz_absolute_path() . ___CONF_UPLOAD_DIR___ . $_upload_path;

    /** CHECK SE EXISTE A PASTA PARA DOWNLOAD, SE NÃO EXISTIR, CRIA A PASTA */
    if (!is_dir($config['upload_path'])) {
        bz_createFolder($config['upload_path']);
    }
    /** END CHECK SE EXISTE A PASTA PARA DOWNLOAD, SE NÃO EXISTIR, CRIA A PASTA */

    $config['allowed_types'] = $_allowed_types;
    $config['max_size'] = $_max_size;

    if (strpos($_FILES[$_file_name]['type'], 'image/') == 1) {
        $config['max_width'] = $_max_width;
        $config['max_height'] = $_max_height;
        $config['xss_clean'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['file_ext_tolower'] = TRUE;
    }

    $config['encrypt_name'] = TRUE;
    $CI->load->library('upload', $config);

    $_error = array();

    $CI->upload->initialize($config);

    if (!$CI->upload->do_upload($_file_name)) {

        $_FILES = $_original_files;

        $_error['error']['file'] = $_file_name;
        $_error['error']['message'] = trim($CI->upload->display_errors());

        return $_error;
    } else {

        $_rUp = $CI->upload->data();
        $_FILES = $_original_files;

        return $_rUp;
    }
}

/**
 * DELETE FILE IN SERVER
 *
 * @param type $_file_name
 * @param type $_file_path
 * @return boolean
 *
 */
function bz_delete_file($_file_name, $_file_path)
{
    $CI = &get_instance();
    $CI->load->helper("file");
    $CI->load->helper("directory");

    $_fileDelete = $_file_path . $_file_name;


    if (!empty($_file_name) && file_exists($_fileDelete)) {
        unlink($_fileDelete);
    }

    $_r = array_filter(explode('/', $_file_path));

    $x = '';
    while (true) {

        if (!is_dir($_file_path)) {
            break;
        }

        $_folderContent = directory_map($_file_path, 1);
        $_folderContent = array_diff($_folderContent, ['.', '..', 'index.html']);

        if (count($_folderContent) == 0) {
            delete_files($_file_path, true, false, 1);
        } else {
            break;
        }

        $x = array_pop($_r);

        if (!empty($x)) {
            if (mc_contains_in_string($x, ___CONF_UPLOAD_DIR___)) {
                break;
            }
        }

        $_file_path = '/' . implode('/', $_r) . '/';
    }

    return;
}

/**
 * CREATE FOLDER
 *
 * @param type $p
 * @param type $mask
 * @return boolean
 */
function bz_createFolder($p, $mask = 0777)
{
    /** Get the CodeIgniter super object */
    $CI = &get_instance();

    if (empty($p)) {
        return false;
    }

    if (!is_dir($p)) {
        if (mkdir($p, $mask, TRUE)) {
            $CI->load->helper('file');
            $paths = explode('/', $p);
            $_i = '';
            $_data = ___DEFAULT_FILE_INDEX_CONTENT___;

            foreach ($paths as $path) {
                $_i .= $path . '/';

                if (strpos($_i, str_replace('/', '', ___CONF_UPLOAD_DIR___))) {
                    write_file($_i . 'index.html', base64_decode($_data));
                }
            }
        }
    }
}

/**
 * Thumb()
 * FUNÇÃO PARA GERAR MINIATURAS DE IMAGENS EM TEMPO REAL
 *
 * @param type $absPathFile
 * @param type $fullname
 * @param type $width
 * @param type $height
 * @return string
 */
function bz_thumb($absPathFileOrg, $fullname, $width, $height, $relatPathThumbDest = '/assets/cache/thumb')
{
    /** Path to image thumbnail in your root */
    $dir = $absPathFileOrg . '/';
    $url = base_url() . $absPathFileOrg;
    /** Get the CodeIgniter super object */
    $CI = &get_instance();
    /** get src file's extension and file name */
    $extension = pathinfo($fullname, PATHINFO_EXTENSION);
    $filename = pathinfo($fullname, PATHINFO_FILENAME);
    $image_org = bz_absolute_path() . $dir . $filename . "." . $extension;
    $image_thumb = bz_absolute_path() . $relatPathThumbDest . '/' . $filename . "-" . $height . '_' . $width . "." . $extension;
    $image_returned = $relatPathThumbDest . '/' . $filename . "-" . $height . '_' . $width . "." . $extension;

    /**
     * CREATE FOLDER FOR THUMBS
     */
    bz_createFolder($relatPathThumbDest);

    if (!file_exists($image_thumb)) {
        /** LOAD LIBRARY */
        $CI->load->library('image_lib');

        /** CONFIGURE IMAGE LIBRARY */
        $config['source_image'] = $image_org;
        $config['new_image'] = $image_thumb;
        $config['x_axis'] = '10';
        $config['y_axis'] = '10';
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width - 10;
        $config['height'] = $height - 10;

        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();
        $CI->image_lib->clear();
    }
    return $image_returned;
}

/**
 * REMOVE A TAG HTTP OU HTTPS DA URL
 *
 * @param type $url
 * @return type
 */
function bz_remove_http($url = '')
{
    if ($url == 'http://' OR $url == 'https://') {
        return $url;
    }
    $matches = substr($url, 0, 7);
    if ($matches == 'http://') {
        $url = substr($url, 7);
    } else {
        $matches = substr($url, 0, 8);
        if ($matches == 'https://')
            $url = substr($url, 8);
    }
    return $url;
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param integer $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function bz_get_gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://s.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

/**
 * REMOVE LINHAS EM BRANCO DE UM ARQUIVO
 *
 * @param type $string
 * @return mixed
 */
function bz_removeEmptyLines($string)
{

    if (empty($string)) {
        return false;
    }

    $string = remove_invisible_characters($string);
    $string = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);

    return $string;
}

/**
 *
 * MACRO QUE CARREGA UM TEMPLATE
 *
 * @param string $_pathTemplate - Caminho Relativo onde está o template
 * @param array $_dados - Dados do template
 *
 */
function mc_load_view_template($bzPathTemplate, $bzDados = array())
{

    if (empty($bzPathTemplate)) {
        return false;
    }

    if ($bzDados) {
        extract($bzDados);
    }

    /**
     * IMPORTA O TEMPLATE
     */
    if (file_exists($bzPathTemplate)) {
        include FCPATH . $bzPathTemplate;
    } else {
        echo "Template <b>$bzPathTemplate</b> não existe.";
    }
}
