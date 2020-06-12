# Warehouse API

Sample project

## Setup
1. Install composer dependencies ``composer install``
2. Run PostgreSQL and set connection info in .env
3. Create database ``php bin/console doctrine:database:create``
4. Run migrations ``php bin/console doctrine:migrations:migrate``
5. Start application ``php -S localhost:8000 -t public``
6. Browse documentation at [documentation url](http://localhost:8000/api/doc)
7. OPTIONAL: Import data to database from [warehouse.sql](warehouse.sql)
8. OPTIONAL: Import Postman calls from [Warehouse.postman_collection.json](Warehouse.postman_collection.json)

## Running tests
1. Build Codeception ``vendor/bin/codecept build``
2. Start application ``php -S localhost:8000 -t public``
3. Run tests ``vendor/bin/codecept run``

## Built using
- PostgreSQL 10
- PHP 7.2.9
- Symfony 4.2
- NelmioApiDocBundle 3.4
- Codeception 2.5.5

### Author
* **Adam Benovič**