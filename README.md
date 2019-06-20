## About Gif Browsing Core

This is the core of the GIF Browsing app. It is a REST API connected to GIPHY's API. This core is built with Laravel 5.7 inside a Docker container. We use Docker Compose to set the database and webserver containers as well.

## Setting up the project

First you need the following software installed:

- Docker
- Docker Compose

Once you have installed the depencies, open a terminal in the root folder of the project and run the following command:

`docker-compose up -d`

The first time is going to download and build the containers so it's going to take a while. Once the process is finish you can check that everything went right with the following command:

`docker-compose ps`

You should have three containers up and running. In the next step, you need to enter the container and execute some PHP and Laravel commands to finish the set up. Use the following commands in project's root:

`docker-compose exec core-app php artisan migrate --seed`

This command is going to create the entire database structure and it is going to create the test user. The email is `test@gmail.com` and the password is `secret`.

`docker-compose exec core-app php artisan passport:install --force`

This command is going to install the credentials for the JWT authentication.

And this is it, you now have the core of the app up and running.

