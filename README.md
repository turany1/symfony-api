My Symfony REST API Project
Author : Stepan Turani


For this project I used :

- PHP 8.4.3 (cli)

- Symfony CLI 5.10.6

- Composer 2.8.5

- MySQL Server 8.0

- OpenSSL 3.4.0


There is an instruction how to run my application :

1. Clone the Repository : 

        git clone https://github.com/turany1/symfony-api.git

2. Change to the project directory by running :

        cd symfony-api

3. Install install the project's dependencies by running :

        composer install

4. Open the .env file and set the required environment variables :

        DATABASE_URL="mysql://root:db_password@127.0.0.1:3306/symfony-api?serverVersion=8.0.32&charset=utf8mb4"
        (Change db_password to your MySql Server password)

5. Set Up the Database : 
    Create a database for the project : 

        php bin/console doctrine:database:create

6. Run Database Migrations : 

        php bin/console doctrine:migrations:migrate

7. Generate public and private jwt keys:

        php bin/console lexik:jwt:generate-keypair

8. Start the Server : 

        symfony server:start

9. Open a web browser and navigate to http://localhost:8000 to access the application.

10. Open POSTMAN and use the API. 

The collection of requests in Postman is located : 

        \symfony-api\symfony-app.postman_collection.json

Data Fixtures :
    
    Load Data : php bin/console doctrine:fixtures:load

Custom CLI commands :

    AddUser : php bin/console app:add-user user@example.com yourpassword
    
    ListUsers : php bin/console app:list-users

PHP Unit tests :

        php bin/phpunit

Bhat tests : 

        vendor/bin/behat