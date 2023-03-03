# INF1005 Project

This LAMP stack project is built with the MVC model. 

## Project Structure

`/app`

Where the code for the Controller and Model resides. The `/app/lib` folder stores necessary code to start the server, no need to touch.

`/logs`

Log files can be viewed from here to check where an error comes from during development.

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

Stores necessary static variables that are used by the server, such as database credentials.

## Setup

### httpd.conf 

Find the line: `Options Indexes FollowSymLinks` and remove `Indexes`.
This prevents the end user from accessing critical server directories such as `app` or `vendor`.

Replace `Listen 8080` with `Listen 80`.

### Project folder
Git clone this repository to your apache /var/www folder. 

## How to create a new route (URL)

1. Copy and rename the `Template.php` file in `routes` to your page name. For naming convention, follow like this: `ShoppingCart`, `Contact`. This will be where the frontend HTML content will be.
2. Create a file of the same name in `app/controller`, and copy the contents from present Controllers (`Home.php`). Make sure the class names are renamed accordingly.
3. In `index.php`, create the route, like the following:

```php
Router::get('/example', function () {
    (new Example())->indexAction();
});
```

Notes:
- All Bootstrap CSS and JS have already been loaded once inside `views/template/elements/Head.php`.
- Common elements used across webpages are stored under `views/template`.
- Please create a new branch to commit changes. DO NOT push to main branch, main is for code that has been finalized.
