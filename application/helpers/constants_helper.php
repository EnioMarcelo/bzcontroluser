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
 * PATHs
 * ========================================================================================================================================================================
 */
/* CAMINHO RELATIVO DA PASTA ONDE ESTÁ SISTEMA */
define('___CONF_APP_ABSOLUTE_PATH___', FCPATH);

/**
 * ========================================================================================================================================================================
 * END PATHs
 * ========================================================================================================================================================================
 */
/**
 * ========================================================================================================================================================================
 * UPLOAD
 * ========================================================================================================================================================================
 */
define("___CONF_UPLOAD_DIR___", "storage/");
define("___CONF_UPLOAD_IMAGE_DIR___", "images/");
define("___CONF_UPLOAD_FILE_DIR___", "files/");
define("___CONF_UPLOAD_MEDIA_DIR___", "medias/");
/**
 * ========================================================================================================================================================================
 * END UPLOAD
 * ========================================================================================================================================================================
 */
/**
 * ========================================================================================================================================================================
 *  MENSAGENS DO SISTEMA
 * ========================================================================================================================================================================
 */
//MENSAGENS DO FORM ADD/UPDATE/DEL/CHANGE STATUS
define('___MSG_ADD_REGISTRO___', 'Cadastrado com Sucesso.');
define('___MSG_UPDATE_REGISTRO___', 'Atualizado com Sucesso.');
define('___MSG_ERROR_UPDATE_REGISTRO___', 'Erro ao Atualizar.');
define('___MSG_ERROR_SELECT_UPDATE_REGISTRO___', 'Nenhum Registro Selecionado para Editar.');
define('___MSG_DEL_REGISTRO___', 'Deletado com Sucesso.');
define('___MSG_ERROR_DEL_REGISTRO___', 'Erro ao Deletar.');
define('___MSG_ERROR_DE_VALIDACAO___', 'Erro de Validação de Dados.');
define('___MSG_ERROR_CAMPOS_OBRIGATORIOS___', 'Erro de Validação dos Campos.');
define('___MSG_STATUS_REGISTRO___', 'Status Atualizado com Sucesso.');
define('___MSG_ERROR_STATUS_REGISTRO___', 'Erro ao Atualizar Status.');
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


/**
 * ARQUIVO INDEX.HTML DEFAULT Directory access is forbidden
 */
define('___DEFAULT_FILE_INDEX_CONTENT___', 'PCFET0NUWVBFIGh0bWw+DQo8aHRtbD4NCjxoZWFkPg0KCTx0aXRsZT40MDMgRm9yYmlkZGVuPC90aXRsZT4NCjwvaGVhZD4NCjxib2R5Pg0KDQo8cD5EaXJlY3RvcnkgYWNjZXNzIGlzIGZvcmJpZGRlbi48L3A+DQoNCjwvYm9keT4NCjwvaHRtbD4=');
