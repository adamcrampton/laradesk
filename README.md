(*** ABANDONED PROJECT :( ***)

A Laravel 4.2 based helpdesk ticketing system.

Recommend that you use Scotchbox Vagrant for setting this up:

- Install Scotchbox as documented here: https://box.scotch.io/
- Configure your database app (I recommend Navicat) using the connection details in the documentation provided in the above link, and create a database called 'scotchbox'
- Clone this repo inside the Scotchbox directory, and run composer install
- Run php artisan migrate to set up database tables
- Run php artisan db:seed to seed the database

If using the database seed, use 'admin@companyname.com.au' as the login, with the password 'password'.

Note: This project is in very early stages of development, and as such I'm not accepting pull requests at this stage. As of July 2015, it is not functional, but I will update this README once usable.

Note: This project will be updated to use Laravel 5.1 once complete.
