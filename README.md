# INF1005 Project

This LAMP stack project is built with the MVC model, with the latest PHP 8 features and OOP style.
As this project is made from scratch, it provides a deeper level of understanding into how frameworks such as Laravel operate.

Includes the following concepts:
- Models
- Views
- Controllers
- Routing
- Migrations
- Seeding
- QueryBuilder
- Middlewares
- JWT Tokens
- Rest API

## Project Structure

`/app`

Where the code for the Controller and Model resides. The `/app/lib` folder stores necessary code to start the server, no need to touch.

`/database`

Database table migrations are stored here. This is where you can configure columns and attributes.

`/logs`

Log files can be viewed from here to check where an error comes from during development. Actually not used.

`/public`

Store assets to be used in the frontend, such as `.css`, `.js`, `.png`.

`/routes`

Where the main HTML code resides. All code is under the body tag.

`/vendor`

Stores necessary libraries used by the project, no need to touch.

`/views`

The HTML templates are stored here. Things like navigation bar, footer and carousels.

`.htaccess`

A configuration file for Apache. Used to redirect users to the main index.php, where it will route through to specified pages.
This also ensures the URL does not contain a `.php` at the end, to make it look nicer.

`Config.php`

Stores necessary static variables that are used by the server.

`Hakimator.php`

A script to execute database migrations and seeding. Used only during development.

`index.php`

Entry point for all URLs.

## Setup

### httpd.conf 

#### Apache
- Find the line: `Options Indexes FollowSymLinks` and remove `Indexes`. This prevents the end user from accessing critical server directories such as `app` or `vendor`.
Replace `Listen 8080` with `Listen 80`.

#### Frontend
No setup for frontend is needed, but do note the following endpoints:
- `/` - Website
- `/api/v1/` - API

#### Backend
If the project is returning an internal server error (status 500), follow the following steps.
You need to have composer installed in your environment.

- Delete the folder `vendor` and file `composer.lock`.
- Run `composer install`.

#### Database
- To clear a database schema and its tables, run `php hakimator.php clear $schema`.
- To create the database tables, run `php hakimator.php migrate`.
- To insert prebuilt data to the database, run `php hakimator.php seed`.

### Project folder
Git clone this repository to your apache /var/www folder. 

## Development Guide
Note: This is for development only, not setting up.

### How to create a new route (URL)

1. Copy and rename the `Template.php` file in `routes` to your page name. For naming convention, follow like this: `ShoppingCart`, `Contact`. This will be where the frontend HTML content will be.
2In `index.php`, create the route, like the following:

```php
Router::get('/example', fn() => include("routes/Template.php"));
```

Notes:
- All Bootstrap CSS and JS have already been loaded once inside `views/template/elements/Head.php`. Any additional libraries should be inserted here, not in the routes.
- Common elements used across webpages are stored under `views/template`.

### How to create a new MySQL table in PHP and without opening MySQL Workbench.

To create tables, we use what are called 'migrations'. They are located in `database/migrations`.
Migrations are useful in quickly creating tables and helps a lot in development, especially in setting up in another environment.
Instead of manually creating tables and running SQL commands, all these can be done with one command.
`hakimator.php` is a small program which will help you in building and pushing migrations. This is heavily inspired by Laravel.

1. To create a migration, run `php hakimator.php make:migrate create_myTable_table`. It has to follow the format (`create_myTable_table`).
2. A new php file should be created in `database/migrations`. Modify the file to include table columns, primary and foreign keys etc.
3. To push the migrations to the MySQL database, run `php hakimator.php migrate`. Do note this will override and clear your existing table data.

In your migrations file, to create a column:
```php
$builder->addColumn("id", "INT", true, true);
```
This will create a column named `id`, of type `int` which is set to `not null` and `auto increment`.

To set a column as primary key:
```php
$builder->setPrimaryKey("id");
```