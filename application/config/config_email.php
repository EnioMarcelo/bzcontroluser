<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
  |--------------------------------------------------------------------------
  | PARA ENVIAR EMAIL PELO SISTEMA
  |--------------------------------------------------------------------------
  |
  | Dados do Servidor de Email
  |
  |
  |
 */
$config['CONF_EMAIL_SMTP_USER'] = '';
$config['CONF_EMAIL_SMTP_PASS'] = '';
$config['CONF_EMAIL_FROM_EMAIL'] = 'no-reply@seu-dominio-aqui.com';
$config['CONF_EMAIL_SMTP_HOST'] = '';
//
$config['CONF_EMAIL_SMTP_PORT'] = 587;
$config['CONF_EMAIL_SMTP_PROTOCOL'] = 'smtp';
$config['CONF_EMAIL_SMTP_TIMEOUT'] = 60;
$config['CONF_EMAIL_SMTP_CRYPTO'] = 'TLS'; //SSL ou TLS
//
$config['CONF_EMAIL_SMTP_CHARSET'] = 'utf-8';
$config['CONF_EMAIL_SMTP_NEWLINE'] = '\r\n';
$config['CONF_EMAIL_SMTP_VALIDATION'] = '';



