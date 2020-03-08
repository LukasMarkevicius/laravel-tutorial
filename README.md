# Laravel Tutorial

This is a repository for a Laravel series in which you can learn the basics of Laravel. You can learn:
* CRUD
* How to create slugs
* How to upload images

## Requirements
Make sure your system meets the requirements and has necessary extensions. You can look up official [Laravel Requirements](https://laravel.com/docs/master/installation#server-requirements)

## Setup
Clone this repository into your personal directory and in terminal run command:

`$ cd personal_directory/laravel-tutorial`

Depending in which part of a Laravel series you are you might want to checkout to certain point of a tutorial:

`$ git checkout <tag-name> -b <your-branch-name>`

Now you need to install composer packages so in your terminal run:

`$ composer install`

You need to copy `.env.example` file for all the different variables that your application might require:

`$ cp .env.example .env`

Inside `.env` file make sure you change database credentials and generate an app key by running command:

`$ php artisan key:generate`

Now you need to migrate your database:

`$ php artisan migrate`

And that's it! Now if you are using [Homestead](https://laravel.com/docs/master/homestead) your server should already be running after you run `$ vagrant up` command. If you don't use this solution you can run `$ php artisan serve` which will start your development server at `http://localhost:8000`
