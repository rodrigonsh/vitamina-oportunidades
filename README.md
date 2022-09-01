# Vitamina - Oportunidades

Este repositório é minha demonstração de desenvolvimento fullstack para a Vitamina.web

Trata-se de um CRM baseado na temática do Rick & Morty

# Requerimentos

php8.1+

nvm ( https://tecadmin.net/how-to-install-nvm-on-debian-11/ ) 

# Instalação

Clone o repo

Crie um banco de dados

Renomeie o .env.example e preencha os dados do DB

    composer install
    npm install
    php artisan key:generate
    php artisan storage:link
    php artisan migrate
    php artisan db:seed
    php artisan serve

# Logins

**Admin**
email: admin@vitaminaweb.com.br
senha: vitaminaweb

O Admin pode filtrar por vendedores


**Rick Sanchez**
email: rick@sanchez.com
senha: 80085

**Morty**
email: morty@hotmiau.com
senha: jessica

