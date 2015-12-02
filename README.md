Blog Package
============
Package Status: In development - Not currently usable.

A package for Laravel 5 which provides routes, views and controllers for a basic extendable blog.

### Features ###

Provides out of the box blog post management and views, can be used in conjunction with bootstrap.

The package favours convention over configuration but does have configurable elements.

The package allows user the option of specifying whether the blog should be served from the home page, or from /blog.

### Installation ###

To install the package add the following line to your composer.json

<code>
"require": {
    "taskforcedev/blog": "5.*"
}
</code>

After doing this you should run composer update, then a dump autoload preferably using artisan

<code>php artisan dump-autoload</code>


#### Service Provider ####

After this you should add the following service provider to your config/app.php

<code>Taskforcedev\Blog\ServiceProvider::class,</code>

#### Overwriting Config ####
The package comes with default config however you will likely wish to publish this and overwrite with your own config settings.

<code>php artisan vendor:publish --tag="taskforce-blog"</code>
