# backend-challenge 🎯
Hi 😃 👋, This project is a backend technical exam

[The challenge](https://docs.google.com/document/d/1invNapmD-rJ-vGG4qR08m2l9gVuTl546C0iejnhp0mQ/edit)

Requirements:

    -php 8 or superior
    -composer
    -A web server like Apache to up phpmyadmin
    -A develop with common sense and more 👨🏽‍💻
    
Setup:

    1- clone project
    2- cd backend-challenge
    3- copy and rename the .env.example file to .env
    4- composer install
    5- php artisan migrate
    6- php artisan serve and go in the experience 🚀


URL Actions:

    /orders/{id} [get a order]
    /orders [get all orders grouped by group_id with total_orders and total_amount]
    /orders/delete/{id} [delete a order if it exists in the database]
    /orders/store/{id} [create or update an order]
