# Product manager

## Table of contents

* General info
* Technologies
* Setup

## General info
This is Product Manager App where user can list, add or delete product items.
By clicking "Add" user is allowed to create new product, set its name, type, attributes etc.
For deleting one or multiple product items, user must tick the product checkbox and click "Mass delete"<br>

## Technologies

Project is created with:

* PHP 7.4
* HTML5
* SCSS
* JavaScript

## Setup

**1. install Composer:**

```
$ composer install
```
**2. set up database:** <br>
[Database](app/Database.php) - provide connection parameters - 'dbname', 'user', 'password' <br>
[Database Schema ](schema.sql) can be found here <br>

**3. open project locally**

## Packages & documentation: <br>

* [Nikic/Fast-route](https://github.com/nikic/FastRoute) - request router
* [Doctrine/Dbal](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/) - database abstraction layer
* [Twig](https://twig.symfony.com/doc/3.x/) - template language for PHP
* [PHP-DI](https://php-di.org/doc/) - dependency injection container for PHP


