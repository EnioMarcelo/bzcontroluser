# BUZZAControl
Ferramenta RAD para desenvolvimento de sistemas CRUD em PHP utilizando o Framwork Codigniter 3.x, JQuery e o Template AdminLTE

# Requisitos do servidor
### Recomenda-se o PHP versão 7.1 ou mais recente e o Composer.

##### Banco de Dados
- MySQL (5.1+) por meio dos drivers mysql (obsoleto), mysqli e pdo
- Oracle por meio dos drivers oci8 e pdo
- PostgreSQL via drivers postgre e pdo
- MS SQL através da mssql , sqlsrv (versão 2005 e superior) e DOP motoristas
- SQLite através dos drivers sqlite (versão 2), sqlite3 (versão 3) e pdo
- CUBRID através dos drivers cubrid e pdo
- Interbase / Firebird através dos drivers ibase e pdo
- ODBC por meio dos drivers odbc e pdo (você deve saber que ODBC é na verdade uma camada de abstração)

# Intalação

Partindo do princípo que o ervidor de Banco de Dados MariaDB/MySql e o servidor de Páginas Web Apache estejam instalados e configurados corretamente.

#### Instalar o Composer
- curl -s https://getcomposer.org/installer | php
- mv composer.phar /usr/local/bin/composer
      
#### Instalar o BUZZAControl
- git clone https://github.com/EnioMarcelo/bzcontroluser.git buzzacontrol

#### Agora terá que executar o comando abaixo para a instalação das dependências que o BUZZAControl utiliza
- composer update

#### Depois de terminar o composer terá que editar os seguintes arquivos:

- mv application/config/config.php-dist application/config/config.php
- mv application/config/config_email.php-dist application/config/config_email.php
- mv application/config/database.php-dist application/config/database.php

- nano application/config/config.php 
###### URL da sua instalação 
- $base_url = 'http://localhost:8080/';
###### Um Código para o ferramenta criptografar sua sessão, uma string contendo numero, letras e caracteres especiais do no mínio 10 caracteres.
- $encryption_key = '';

##### Configurar a conexão com banco de dados

- nano application/config/database.php

###### Preencha as variáveis com os dados de conexão do MariaDB/MySql

- $_hostname = 'localhost';
- $_username = '';
- $_password = '';
- $_database = '';

##### Configurar servidor de email

- nano application/config/config_email.php

###### Preencha as variáveis com os dados do seu servidor de email

- $config['CONF_EMAIL_SMTP_USER'] = '';
- $config['CONF_EMAIL_SMTP_PASS'] = '';
- $config['CONF_EMAIL_FROM_EMAIL'] = '';
- $config['CONF_EMAIL_SMTP_HOST'] = '';
//
- $config['CONF_EMAIL_SMTP_PORT'] = 587;
- $config['CONF_EMAIL_SMTP_PROTOCOL'] = 'smtp';
- $config['CONF_EMAIL_SMTP_TIMEOUT'] = 60;
- $config['CONF_EMAIL_SMTP_CRYPTO'] = 'TLS'; //SSL ou TLS






# Autor
Enio Marcelo Buzaneli - Email: eniomarcelo@gmail.com
