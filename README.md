# Bluedel-beads

# INSTALLATION

## Preparation
* Before everything else, check that you have a proper installation of PHP, PHPMyAdmin or similar, as well as Composer on your computer
* Check that your MySQL server is running
* Clone the repository

## Dependencies and database
* run the command "composer install" in the root directory of the project
* create a .env.local file in the root directory, containing the following line (replace the username, password and port with your own database system credentials)
				```
				DATABASE_URL=mysql://username:password@127.0.0.1:port/bluedel
				```
* Run the command "doctrine:database:create" (to create the database)
* Run the command "doctrine:migrations:migrate" (to create all the tables in the database)
* Run the command "doctrine:fixtures:load" (to fill the database with default values)

## Running the project
* Make sure your MySQL is running and you can properly access your database
* run the command "php bin/console server:run" to get the server running
* You can now access the web app in your browser, at localhost:8000 (or another port depending on your php.ini settings)
