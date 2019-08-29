## Base de um MVC simples 

A ideia é criar uma estrutura básica de um MVC com um sistema de rotas e conexao com banco de dados MySqL.

# Instruções gerais

## Usar RewriteModule

* No Linux /etc/apache2/sites-avaliable/000-default.conf
* No Windows C:/Windows/System32/Drivers/etc/hosts

```
<VirtualHost *:80>
    <Directory /var/www/raizdoprojeto>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [QSA,L]
    </Directory>

    . . .
</VirtualHost>

```
## DataBase SQL

Criar um BD.
Alterar o arqivo Classes/Dao/Database.php com os dados do BD utilizado.

## config.php

* Dentro do arquivo, adicionar ao array $folders o caminho das pastas onde estarão os arquivos que vao ser lidos automaticamente sem a necessidade de usar include ou require.

# PROJETO ::::::::

- A ideia do projeto é criar um framework (ou algo parecido com um) simples com o minimo de recursos utilizando apenas elementos nativos do PHP, HTML, CSS e talvez um pouco de javascript.

- Todos podem participar e ajudar!

# Tarefa 1 ::::::::

* Dar nome ao projeto, criar um logo e fazer a pagina Home (Views/home/index.phtml)

