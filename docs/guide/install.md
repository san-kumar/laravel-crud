# Installation

## Install with Composer

Via [composer](http://getcomposer.org):

```bash
$ composer require san-kumar/laravel-crud --dev
```

## Generate files

:::warning Important!

Make sure to create the db tables and run migrations before
starting the crud generator.
:::

After installing the package you should see a
new `crud:generate` command in your Artisan commands list.

To generate the Controller, Model, Policy, routes, etc use
the following command:

```bash
# Create CRUD for authors table
$ php artisan crud:generate authors

# Create CRUD for the authors &gt; posts table
$ php artisan crud:generate authors.posts

# Create CRUD for the authors &gt; posts &gt; comments table  
$ php artisan crud:generate authors.posts.comments
```

## Including the generated routes

By default, the generated routes are placed in
the `./routes/crud/` directory. To include the generated
routes just open your `routes/web.php` file and add the
following line at the end of the file:

```php
/* inside routes/web.php */

\San\Crud\Crud::routes(); 
```

This will `glob` all the generated route files and include
them in the `routes/web.php` file for you.

Alternatively, you can copy-paste the generated routes from
the `./routes/crud/` directory to your `routes/web.php`
file. This way you make any changes to the generated route
code as per your needs.

## Location of the generated files

The `crud:generate` command will generate the following
files and place them in the appropriate directories:

- Resource Controller
  - `app/Http/Controllers/[Name].php`
- Model
  - `app/Model/[Name].php`
- Policy
  - `app/Policies/[Name]Policy.php`
- Routes
  - `routes/crud/[name].php`
- Views
  - `resources/views/[name]/(index|edit|create|show).blade.php`

By default, the generated code will not overwrite any
existing files. If you want to overwrite the existing files,
you can use the `--force` option.
