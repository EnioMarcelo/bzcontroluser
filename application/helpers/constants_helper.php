<?php

    /*
      Created on : 09/05/2017, 14:02:00
      Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
     */



    defined('BASEPATH') OR exit('No direct script access allowed');



    /*
      |--------------------------------------------------------------------------
      | CUSTOM CONSTANTS
      |--------------------------------------------------------------------------
      |
      | CONSTANTES PARA SUPORTE DO SISTEMA
      |
     */



    /**
     * ========================================================================================================================================================================
     * SISTEMA
     * ========================================================================================================================================================================
     */
    define('___BZ_TITULO_SISTEMA___', 'BUZZAControl');
    define('___BZ_NOME_SISTEMA___', '<b>BUZZA</b>Control');
    define('___BZ_NOME_SISTEMA_ABREVIADO___', '<b>BZ</b>CN');

    /**
     * ========================================================================================================================================================================
     * END DIVERSOS
     * ========================================================================================================================================================================
     */



    /**
     * ========================================================================================================================================================================
     * PARA ENVIAR EMAIL PELO SISTEMA
     * ========================================================================================================================================================================
     */
    define('___EMAIL_SMTP_HOST___', 'smtp.sendgrid.net');
    define('___EMAIL_SMTP_PORT___', '587');
    define('___EMAIL_SMTP_PROTOCOL___', 'smtp');
    define('___EMAIL_SMTP_TIMEOUT___', '60');
    define('___EMAIL_SMTP_CRYPTO___', 'TLS'); //SSL ou TLS

    define('___EMAIL_SMTP_CHARSET___', 'utf-8');
    define('___EMAIL_SMTP_NEWLINE___', '\r\n');
    define('___EMAIL_SMTP_VALIDATION___', '');

    define('___EMAIL_SMTP_USER___', 'apikey');
    define('___EMAIL_SMTP_PASS___', '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');
    define('___EMAIL_FROM_EMAIL___', 'no-reply@eniomarcelo.com.br');
    /**
     * ========================================================================================================================================================================
     * END PARA ENVIAR EMAIL PELO SISTEMA
     * ========================================================================================================================================================================
     */



    /**
     * ========================================================================================================================================================================
     *  MENSAGENS DO SISTEMA
     * ========================================================================================================================================================================
     */

    //MENSAGENS DO FORM ADD/UPDATE/DEL/CHANGE STATUS
    define('___MSG_ADD_REGISTRO___', 'Registro Cadastrado com Sucesso.');
    define('___MSG_UPDATE_REGISTRO___', 'Registro Atualizado com Sucesso.');
    define('___MSG_ERROR_UPDATE_REGISTRO___', 'Erro ao Atualizar Registro.');
    define('___MSG_ERROR_SELECT_UPDATE_REGISTRO___', 'Nenhum Registro Selecionado para Editar.');
    define('___MSG_DEL_REGISTRO___', 'Registro Deletado com Sucesso.');
    define('___MSG_ERROR_DEL_REGISTRO___', 'Erro ao Deletar Registro(s).');
    define('___MSG_ERROR_DE_VALIDACAO___', 'Erro de Validação de Dados.');
    define('___MSG_STATUS_REGISTRO___', 'Status do Registro Atualizado com Sucesso.');
    define('___MSG_ERROR_STATUS_REGISTRO___', 'Erro ao Atualizar Status do Registro.');
    define('___MSG_NOT_FIND_REGISTRO___', 'Nenhum Registro Encontrado.');
    define('___MSG_NOT_DELETE_RELAT_REGISTRO___', 'Registro não pode ser deletado.');
    define('___MSG_GENERIC_UNEXPECTED_ERROR___', 'Ocorreu um ERRO Inesperado, Contacte o Administrador do Sistema.');

    // MENSAGENS DE AUDITORIA
    define('___MSG_AUDITORIA_ADD_SUCCESS___', 'Registro Cadastrado com Sucesso');
    define('___MSG_AUDITORIA_UPDATE_SUCCESS___', 'Registro Atualizado com Sucesso');
    define('___MSG_AUDITORIA_UPDATE_ERROR___', 'Erro ao Atualizar Registro');
    define('___MSG_AUDITORIA_DEL_SUCCESS___', 'Registro Deletado com Sucesso');
    define('___MSG_AUDITORIA_STATUS_REGISTRO_SUCCESS___', 'Status do Registro Atualizado com Sucesso');
    define('___MSG_AUDITORIA_STATUS_REGISTRO_ERROR___', 'Erro ao Atualizar Status do Registro');
    define('___MSG_AUDITORIA_NOT_FIND_REGISTRO___', 'Nenhum Registro Encontrado');
    define('___MSG_AUDITORIA_NOT_DELETE_RELAT_REGISTRO___', 'Registro não pode ser deletado por motivo de ralcionamento com tabela filho');

    /*
     * ========================================================================================================================================================================
     * END MENSAGENS DO SISTEMA
     * ========================================================================================================================================================================
     */
