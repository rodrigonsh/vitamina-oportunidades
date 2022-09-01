# Vitamina - Oportunidades

Este repositório é minha demonstração de desenvolvimento fullstack para a Vitamina.web

Trata-se de um CRM baseado na temática do Rick & Morty

# EXEMPLOS

Como solicitado, na pasta EXEMPLOS eu disponibilizei alguns códigos de 
projetos antigos

# Requerimentos

php8.1+

nvm ( https://tecadmin.net/how-to-install-nvm-on-debian-11/ ) 

# Instalação

Clone o repo

Crie um banco de dados

Copie o .env.example e preencha os dados do DB

    cp .env.example .env
    composer install
    npm install
    npm run build
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

