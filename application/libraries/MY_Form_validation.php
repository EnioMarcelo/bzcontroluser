<?php

/*
  Created on : 13/03/2017, 13:51:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class MY_Form_validation
 */
class MY_Form_validation extends CI_Form_validation
{

    /**
     * @var
     */
    public $CI;

    /**
     * clear_field_data
     *
     * @return $this
     */
    public function clear_field_data()
    {

        $_POST = array();
        $this->_field_data = array();
        return $this;
    }

    /* END function clear_field_data() */


    /**
     * @param $str
     * @return false|string|string[]|null
     */
    function strtoupper($str)
    {
        return mb_strtoupper($str);
    }


    /**
     * @param $str
     * @return false|string|string[]|null
     */
    function strtolower($str)
    {
        return mb_strtolower($str);

    }

    /**
     * is_unique
     *
     * Check if the input value doesn't already exist
     * in the specified database field.
     *
     * @param string $str
     * @param string $field
     * @return  bool
     */
    public function is_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.]', $table, $field);
        //return isset($this->CI->db)
        return is_object($this->CI->db) ? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 0) : FALSE;
    }

    /* END function is_unique() */

    /**
     * valid_cpf
     *
     * VERIFICA SE O CPF INFORMADO É VALIDO
     *
     * @param type $cpf
     * @return boolean
     */
    function valid_cpf($cpf)
    {

        $this->CI->form_validation->set_message('valid_cpf', 'O campo {field} não contém um CPF válido.');

        // Verifiva se o número digitado contém todos os digitos
        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);

        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 ||
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

    /* END function valid_cpf() */

    /**
     * valid_cep
     *
     * VERIFICA SE CEP É VÁLIDO
     *
     * @access    public
     * @param string
     * @return    bool
     */
    function valid_cep($cep)
    {

        $this->CI->form_validation->set_message('valid_cep', 'O campo {field} não contém um CEP válido.');

        $cep = str_replace('.', '', $cep);
        $cep = str_replace('-', '', $cep);
        $url = 'http://republicavirtual.com.br/web_cep.php?cep=' . urlencode($cep) . '&formato=query_string';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 0);
        $resultado = curl_exec($ch);
        curl_close($ch);
        if (!$resultado)
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
        $resultado = urldecode($resultado);
        $resultado = utf8_encode($resultado);
        parse_str($resultado, $retorno);
        if ($retorno['resultado'] == 1 || $retorno['resultado'] == 2)
            return TRUE;
        else
            return FALSE;
    }

    /* END function valid_cep() */

    /**
     * valid_cnpj
     *
     * Verifica se o CNPJ é valido
     *
     * @param string
     * @return     bool
     */
    function valid_cnpj($str)
    {

        $this->CI->form_validation->set_message('valid_cnpj', 'O campo {field} não contém um CNPJ valido.');

        // Deixa o CNPJ com apenas números
        $cnpj = preg_replace('/[^0-9]/', '', $str);

        if (empty($cnpj))
            return false;

        if (strlen(trim($cnpj)) != 14)
            return false;

        // Elimina CNPJs invalidos conhecidos
        if ($cnpj == "00000000000000" ||
            $cnpj == "11111111111111" ||
            $cnpj == "22222222222222" ||
            $cnpj == "33333333333333" ||
            $cnpj == "44444444444444" ||
            $cnpj == "55555555555555" ||
            $cnpj == "66666666666666" ||
            $cnpj == "77777777777777" ||
            $cnpj == "88888888888888" ||
            $cnpj == "99999999999999")
            return false;

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    /* END function valid_cnpj() */
}
