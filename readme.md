# Laravel/VueJs application by Anass Baba

## Getting Started

This application is built using Laravel and Vuejs. A user create account and list products, this items he list containing picture, title and description. all users items for public access. the application provide users to update their password. so let's describe and anatomy the applicaiton. so let's describe and explain how it's work.

## Installation

Please check the official laravel 6.0.3 installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/6.0.3/installation#installation)


Clone the repository

    git clone git@github.com:anassbaba/Laravel-VueJS-coding-challenge.git

Switch to the repo folder

    cd Laravel-VueJS-coding-challenge

Install all the dependencies using composer

    composer install

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

requires at least node v.8.5.0.

    npm install

And run the following in your terminal/console

    npm run dev

Export with

    npm run export




# interactions

##### Browser
##### Guest

This model pages accessed by worldwide you don't need authentication.

1. Register.
2. Login.
3. Preview all product items.

#### Use

This model pages needs authentication.

1. Preview all products items.
2. Preview created items.
3. Create new item.
4. Remove item.
4. Update password.

#### Command line

##### create new user

```sh
$ php artisan user:create
```

##### Update user password

```sh
$ php artisan user:update-password
```

##### fake data (100000 itemes products/ 100 users)

```sh
$ php artisan fake:data
```

### Questions?

If you have any questions, contact me :

    Full name : Anass baba
	Email : anasss.contact@gmail.com
	Phone : +212 602860326
