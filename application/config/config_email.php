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
$config['CONF_EMAIL_SMTP_USER'] = 'apikey';
$config['CONF_EMAIL_SMTP_PASS'] = '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';
$config['CONF_EMAIL_FROM_EMAIL'] = 'no-reply@eniomarcelo.com.br';
$config['CONF_EMAIL_SMTP_HOST'] = 'smtp.sendgrid.net';
//
$config['CONF_EMAIL_SMTP_PORT'] = 587;
$config['CONF_EMAIL_SMTP_PROTOCOL'] = 'smtp';
$config['CONF_EMAIL_SMTP_TIMEOUT'] = 60;
$config['CONF_EMAIL_SMTP_CRYPTO'] = 'TLS'; //SSL ou TLS
//
$config['CONF_EMAIL_SMTP_CHARSET'] = 'utf-8';
$config['CONF_EMAIL_SMTP_NEWLINE'] = '\r\n';
$config['CONF_EMAIL_SMTP_VALIDATION'] = '';



