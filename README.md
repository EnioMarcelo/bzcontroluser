# BUZZAControl
Ferramenta RAD para desenvolvimento de sistemas CRUD em PHP utilizando o Framwork Codigniter 3.x, JQuery e o Template AdminLTE

# Requisitos do servidor
##### Recomenda-se o PHP versão 5.6 ou mais recente e o Composer.

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

Partindo do princípo que os servidores de Banco de Dados MySql e o de Páginas Web Apache estejam instalados e configurados corretamente.

###### Instalar o Composer
- curl -s https://getcomposer.org/installer | php
- mv composer.phar /usr/local/bin/composer
      
###### Instalar o BUZZAControl
- git clone https://github.com/EnioMarcelo/bzcontroluser.git www

###### Agora terá que executar o seguinte comando
- composer install para a instalação das dependências que o BUZZAControl utiliza.

###### Depois de terminar o composer terá que editar os seguintes arquivos:

- nano application/config/config.php 

- $base_url = 'http://localhost:8080/'; // URL da sua instalação
  
- $encryption_key = ''; // Um Código para o ferramenta criptografar sua sessão, uma string contendo numero, letras e caracteres especiais do no mínio 10 caracteres.



# Autor
Enio Marcelo Buzaneli - Email: eniomarcelo@gmail.com
