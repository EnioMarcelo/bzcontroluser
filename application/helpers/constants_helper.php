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
define('___CONF_TITULO_SISTEMA___', 'BUZZAControl');
define('___CONF_NOME_SISTEMA___', '<b>BUZZA</b>Control');
define('___CONF_NOME_SISTEMA_ABREVIADO___', '<b>BZ</b>CN');

/* LOGIN */
define('___CONF_LOGIN_BG_IMAGE___', 'style="background: url(assets/img/bg-login.jpg) no-repeat center center; background-size:cover"');
define('___CONF_LOGIN_LOGO___', '<div style="color:#000000"><b>Admin</b>' . ___CONF_TITULO_SISTEMA___ . '</a></div>');
define('___CONF_LOGIN_FOOTER___', '<div style="text-align: center; margin-top: 5px; font-size: 0.8em;"><a style="color:#ffffff">ENIO MARCELO</a><p><a style="color:#ffffff">&copy 2017</a></p></div>');

/* LOGIN - CHANGE PASSWORD */
define('___CONF_LOGIN_CHANGE_PASS_BG_IMAGE___', 'style="background: url(assets/img/bg-login.jpg) no-repeat center center; background-size:cover"');
define('___CONF_LOGIN_CHANGE_PASS_LOGO___', '<div style="color:#000000"><b>Admin</b>' . ___CONF_TITULO_SISTEMA___ . '</a></div>');
define('___CONF_LOGIN_CHANGE_PASS_FOOTER___', '<div style="text-align: center; margin-top: 5px; font-size: 0.8em;"><a style="color:#ffffff">ENIO MARCELO</a><p><a style="color:#ffffff">&copy 2017</a></p></div>');


/**
 * ========================================================================================================================================================================
 * END SISTEMA
 * ========================================================================================================================================================================
 */
/**
 * ========================================================================================================================================================================
 * UPLOAD
 * ========================================================================================================================================================================
 */
define("___CONF_UPLOAD_DIR___", "storage");
define("___CONF_UPLOAD_IMAGE_DIR___", "images");
define("___CONF_UPLOAD_FILE_DIR___", "files");
define("___CONF_UPLOAD_MEDIA_DIR___", "medias");
/**
 * ========================================================================================================================================================================
 * END UPLOAD
 * ========================================================================================================================================================================
 */
/**
 * ========================================================================================================================================================================
 * PARA ENVIAR EMAIL PELO SISTEMA
 * ========================================================================================================================================================================
 */
define('___CONF_EMAIL_SMTP_HOST___', 'smtp.sendgrid.net');
define('___CONF_EMAIL_SMTP_PORT___', '587');
define('___CONF_EMAIL_SMTP_PROTOCOL___', 'smtp');
define('___CONF_EMAIL_SMTP_TIMEOUT___', '60');
define('___CONF_EMAIL_SMTP_CRYPTO___', 'TLS'); //SSL ou TLS

define('___CONF_EMAIL_SMTP_CHARSET___', 'utf-8');
define('___CONF_EMAIL_SMTP_NEWLINE___', '\r\n');
define('___CONF_EMAIL_SMTP_VALIDATION___', '');

define('___CONF_EMAIL_SMTP_USER___', 'apikey');
define('___CONF_EMAIL_SMTP_PASS___', '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');
define('___CONF_EMAIL_FROM_EMAIL___', 'no-reply@eniomarcelo.com.br');
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
