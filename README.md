# XML Data Parser

This is a command line programm that read a local xml file, process data and store it into database.

## Features

1. The program is easily extendable, e.g., we could use different data storage to
read data from or to push data to. This should be configurable.
2. Errors are written to a logfile
3. The application should be tested.

## Requirements

- PHP >= 8.2
- Composer

## Tech
- Laravel framework v11

## Installation

**Clone the Repository**

```sh
git clone https://github.com/samadfcibd/XML-file-processor.git
```
**Install Dependencies**
Use Composer to install the necessary dependencies.
N.B. Maybe project repository require permission for composer installing.
```sh
composer install
```

**Generate Application Key**
```sh
php artisan key:generate
```
**Run Project**

Once everything has been installed, start Laravel's local development server using Laravel Artisan's serve command:
```sh
php artisan serve
```
Once you have started the Artisan development server, your application will be accessible in your web browser at http://localhost:8000.

## DB Configuration and migration

**Set Up Environment File**
Copy the example environment file and update the database configuration.
```sh
cp .env.example .env
```

We can use mysql, mariadb or sqlite as our preference.

if you wish to use MySQL, update your .env configuration file's DB_* variables like so:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
if you wish to use sqlite, then just create a file named `database.sqlite` inside the `database` folder and update .env configuration like so:
```sh
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/your/database.sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

If you choose to use a database other than SQLite, you will need to create the database file at first.

**Run Migrations**
Create the necessary database tables by running migrations.
```sh
php artisan migrate
```

#### Process XML file

By default, we keep the XML file in project root, you can replace `feed.xml` with the actual path to your XML file.
You have to run just following command to process and store the file:
```sh
php artisan app:process-feed feed.xml
```
This command will read the file, process data and store into database. There is a table named `item` in the database, all items from xml file will be stored there.


- `app/Console/Commands/ProcessFeed.php` this is the command file which process and store XML file. We can easily extend this script for any other type of file e.g. JSON. 

- Laravel makes interacting with databases extremely simple across a variety of supported databases using raw SQL, a fluent query builder, and the Eloquent ORM.

    I used Laravel ORM to create a table and store data in that table.
    item migration script `app/Models/Item.php`
    item model `database/migrations/2024_07_03_220241_create_items_table.php`

- All errors will be logged to the `storage/logs/laravel.log` file.
## Testing

Run the tests:
```sh
php artisan test
```

Feature testing with phpUnit. Test script file `tests/Feature/ProcessFeedTest.php`