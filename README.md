# Laravel CRUD Generator

![laravel-crud-generator](https://cdn.articlevideorobot.com/hosted/16-12-2022/laravel-crud-152f.webp)

## Introduction

[![Software License](https://img.shields.io/badge/license-MIT-green.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/circleci/project/github/san-kumar/laravel-crud.svg?style=flat-square)](https://circleci.com/gh/san-kumar/laravel-crud)
[![Coverage Status](https://img.shields.io/badge/coverage-94%25-brightgreen)](https://raw.githack.com/san-kumar/laravel-crud/main/build/coverage/index.html)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/san-kumar/laravel-crud.svg?style=flat-square)](https://packagist.org/packages/san-kumar/laravel-crud)
[![Total Downloads](https://img.shields.io/packagist/dt/san-kumar/laravel-crud.svg?style=flat-square)](https://img.shields.io/packagist/dt/san-kumar/laravel-crud.svg?style=flat-square)



> ## Please see the [**full documentation here**](https://san-kumar.github.io/laravel-crud/).


This package adds a **crud:generate** command to Artisan in
your Laravel project. With this command you can generate
CRUD (Create, Read, Update, Delete) for your db tables
instantly!

The generated CRUD includes a Controller, Model, Policy,
routes, validations, and 4 view files (index, create, edit,
show). It also supports relations between tables, so you can
generate nested CRUDs, for example: generating CRUD for
comments inside a blog post.

The output is fully customizable and supports
both [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
and [Tailwind CSS](https://tailwindcss.com/).

## Demo Video

[![Laravel crud generator package](https://cdn.articlevideorobot.com/hosted/02-01-2023/laravel-crud-generator-5d81.webp)](https://www.youtube.com/watch?v=N_N2FqPDLvQ)

## Screenshots

### Index page

Laravel-crud can generate nested CRUDs. For example, you can
generate CRUD for customers > tickets > replies by simply
running:

```bash
$ php artisan crud:generate customers.tickets.replies
```

#### Table layout

> ![Table index](https://cdn.articlevideorobot.com/hosted/22-12-2022/image-2-dbed.webp)  
> (Automatically generated index page with responsive table
> layout)

The generated views are fully customizable and template
based. For example, you can change the look of the index
page by using different templates like table, cards or
chat (included in the package).

#### Card layout

```bash
$ php artisan crud:generate customers.tickets.replies -i cards
```

> ![Card layout](https://cdn.articlevideorobot.com/hosted/22-12-2022/selection-303-4a64.webp)  
> (Card layout)

#### Chat layout

```bash
$ php artisan crud:generate customers.tickets.replies -i chat
```

> ![Chat layout](https://cdn.articlevideorobot.com/hosted/22-12-2022/selection-304-c429.webp)  
> (Chat layout)

#### Create / Edit Forms

Laravel CRUD generator can automatically generate the FORM
for creating and editing records. It can also generate the
validation rules for the form.

> ![Example of generated fields](https://cdn.articlevideorobot.com/hosted/22-12-2022/selection-307-f402.webp)  
> (Example of generated fields)

## Heads up!

>  The package is still in _alpha_
> 
> You should only use it with new projects. If you are using
> it in an existing project, make sure to back up (or commit)
> any project changes before running the command.
> 

The aim of the CRUD generator is to save you time by
generating common boilerplate CRUD code for any database
table instantly.

But this code is **not** intended to be used as-is. You
should always customize the generated code to fit your needs
and manually review the generated files before deploying it
to production.

# Installation

## Install with Composer

Via [composer](http://getcomposer.org):

```bash
$ composer require san-kumar/laravel-crud --dev
```

## Generate files

>  Important!
> 
> Make sure to create the db tables and run migrations before
> starting the crud generator.
> 

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

# Options

### CSS Framework: Bootstrap 5, and TailwindCSS.

You can choose between Bootstrap 5 and Tailwind CSS or you
can use your own CSS framework. By default, Bootstrap 5 is
used when nothing is specified.

```bash
# Create CRUD for authors table using Tailwind CSS
$ php artisan crud:generate authors --css=tailwind

# Shortcut for Tailwind CSS
$ php artisan crud:generate authors -t
```

```bash
# Create CRUD for authors table using layout 'layouts/admin.blade.php'
$ php artisan crud:generate authors --layout=admin
$ php artisan crud:generate authors --section=mysection
```

### Prefix

You can add a route prefix for the generated CRUD by passing
a `--prefix` option.

```bash
# Create CRUD for authors table using Tailwind CSS
$ php artisan crud:generate authors --prefix=admin
```

This will change the route from `/authors` to
`/admin/authors` in all the generated files.

### Index templates

You can choose between 3 ready-made index templates: table,
cards and chat. By default, the table template is used.

```bash
# Create CRUD for authors table using cards template
$ php artisan crud:generate authors -i cards

# Create CRUD for authors table using chat template
$ php artisan crud:generate authors -i chat
```

Please see the [index page here](https://san-kumar.github.io/laravel-crud/guide/index.md#screenshots) 
for screenshots.

### Single create and edit form

In some cases, you may want to use a single form for both
creating and editing a resource. You can do that by passing
`--merge-forms` option.

```bash
# Create CRUD for authors table using a single form
$ php artisan crud:generate authors --merge-forms
```

This will generate a single `view` file called
`create-edit.blade.php` and update the controller code
accordingly so that it can be used for both creating and
editing a resource.

### Layout and section names

By default, the generated views use `layouts/app.blade.php`
for layout and `content` for section name. You can change
these default names by passing your own layout and section
names.


# Relational tables and nesting

In addition to generating simple CRUD for a single table,
you can also generate CRUD for tables related to each other.

## Example #1

For example, let's say we have the following tables:

- Authors
  - Posts
    - Comments

To generate CRUD for these tables you can use the dot
notation to specify the parent tables like this:
`authors.posts.comments`.

```bash

```bash
# Create CRUD for authors table
$ php artisan crud:generate authors

# Create CRUD for posts table
$ php artisan crud:generate authors.posts

# Create CRUD for comments table
$ php artisan crud:generate authors.posts.comments
```

This will generate CRUD files for the `authors` table, so
you can view, create, edit and delete authors using the
`/authors` route.

Then for each author, you can view, create, edit and delete
posts using the `/authors/{author}/posts` route.

And for each post, you can view, create, edit and delete
comments using the `/authors/{author}/posts/{post}/comments`
route.

## Example #2

On the other hand, if you want to generate CRUD for the
`posts` table without nesting it under the `authors` route,
you can do this:

```bash
# Create CRUD for posts table
$ php artisan crud:generate posts

# Create CRUD for comments table
$ php artisan crud:generate posts.comments
```

So now you can view, create, edit and delete all posts
regardless of the author using the `/posts` route and then
for each post, you can view, create, edit and delete
comments using the `/posts/{post}/comments` route.
# Authentication

Laravel CRUD generator uses the default Laravel
authentication
package [laravel/ui](https://laravel.com/docs/7.x/authentication#included-routing)
for handling user authentication. The CRUD generator will
automatically add authentication to routes (using the
`auth` middleware) and generate Policy classes for Models.

## `user_id` field in table

If you generate CRUD for any table that has a `user_id`
field, then the generated CRUD will automatically generate a
Policy file for the Model and add the
[`authorizeResource`](https://laravel.com/docs/7.x/authorization#authorizing-actions-using-policies)
method to the Resource Controller.

## `user_id` in parent tables

If you generate CRUD for a table that has a `user_id` field
in the parent tables (i.e. `authors.posts.comments` has a
`user_id` field in the `authors` table), then the generated
CRUD will automatically generate a Policy file for
the `Authors` Model and add it to your Resource Controller
in the appropriate places.

This way access to `posts` and `comments` will be restricted
to the owner of the `authors` table only.


# Create and Edit records

Laravel CRUD generator can automatically generate the FORM
for creating and editing records. It can also generate the
validation rules for the form.

## Form fields

The form fields are generated based on the database table
columns. The following column types are supported:

> ![Example of generated fields](https://cdn.articlevideorobot.com/hosted/22-12-2022/selection-307-f402.webp)  
> (Example of generated fields)

- `string` (input type text)
- `text` (textarea)
- `integer` (input type number)
- `enum` (select)
- `boolean` (radio buttons)
- `relation` (select with hydrated options)
- and so on...

It can also infer the field type from the column names. For
example, if the column name is `email`, the field type will
be `email`.

## Validation rules

By default, all non-nullable fields are required. Columns
with a `unique` index are also validated to be unique in the
table.

Some additional validation rules are also added based on the
column name. For example, if the column name is `email`, the
validation rule will be `email`.

## Relation fields

If the table has any foreign key columns, the generator will
automatically add a select field for that column. The
options for the select field will be hydrated from the
related table.

For example, if your table has a `country_id` column and if
the `country` table exists: the generator will add a select
field for country (as shown in the image above) and the
options for that select field will be hydrated from
the `countries` table (if the country table has a `user_id`
column, the options will be filtered by the current user).

## Quick note about relation fields

You do need to add relation fields manually or create any
foreign key columns in the database. The relation is
inferred from the column name only. Any column name that
matches the pattern `*_id` are considered relation.

For example, if the column name is `country_id`, the
generator will look for a `countries` table and add if that
exists (and if the current user has permission to access
that table) it will add a select field for that column and
hydrate the options from the `countries` table.

# Soft deletes

Laravel provides a simple way to implement soft deletes on
your Eloquent models. Soft deletes allow you to keep a
record of a model's deletion without actually deleting the
model from your database. This allows you to restore the
model at a later time if needed.

Laravel CRUD generator handles tables with soft deletes
automatically and generates the appropriate code for you to
restore or purge deleted records.

> ![Handling soft deletes](https://cdn.articlevideorobot.com/hosted/22-12-2022/selection-305-e2e0.webp)  
> (Handling soft deletes)

To show deleted records in the list view, just append
`?trashed=1` to the URL (this link isn't added to the
navigation menu by default, so you have to add it manually).
# Inbuilt search

A very simple search is added to the list view by default.
It searches the first text column of the table and filters
the results.

This generated search code is just a placeholder, and you
should customize it as per your own needs.

> ![Inbuilt search](https://cdn.articlevideorobot.com/hosted/22-12-2022/selection-306-99d5.webp)  
> (Inbuilt search)

To modify the search algorithm just edit the `index` method
of the Resource controller for that route.
# Customization

## Using your own templates

At the heart of Laravel CRUD generator are the templates
files that are used to generate the CRUD files.

The templates files included with this package are stored in
the `./vendor/san-kumar/laravel-crud/src/template`
directory.

It contains all the stub files that are used to generate the
Controller, Model, Policy, routes, etc.

## Customizing the templates

You can customize the templates by copying the template into
a new directory and then modifying the template files.

To make this simple Laravel CRUD generator provides an
artisan command that will copy the template files into a new
directory for you.

```bash
# Copy the template files into a new directory
$ php artisan crud:template newname 
```

This will copy the template files into a new directory
`./templates/newname/` directory.

It you want to specify a different directory to copy the
template files into you can use the `--directory` or
`-d` option.

```bash
# Copy the template files into a new directory
$ php artisan crud:template newname -d etc/templates
```

This will copy the template files into a new directory
`./etc/templates/newname/` directory.

## Using your own templates

To use your own templates you need to specify the template
directory in the `config/crud.php` file.

```php
// config/crud.php

return [
    'template_dir' => 'etc/templates/newname',
];

```

Alternatively you can specify the template directory using
the `--template` or `-t` option while generating the CRUD.

```bash
# Generate the CRUD using the new template
$ php artisan crud:generate Post --template etc/templates/newname
```

## Customizing the templates

You will need to modify the template files in the new
directory to customize the generated files.

You will find multiple variables that are used in the
template files that are replaced with the actual values when
the files are generated.

To see the full list of variables that are used in the
template files check out the source code for 
[GenerateCrud.php](https://github.com/san-kumar/laravel-crud/blob/main/src/Commands/CrudGenerate.php#L49)


# Known Gotchas

## Laravel Jetstream

Laravel CRUD generator doesn't seem to work with
[Laravel jetstream](https://jetstream.laravel.com/)
just yet. If you are using jetstream, you can still use the
package, but you will have to manually modify some generated
code to fix the layout and authentication issues.

## Inbuilt search

A very simple search is added to the list view by default.
It searches the first text column of the table and filters
the results. But this generated search code is just a
rudimentary placeholder, and you should customize the search
algorithm as per your own needs.

## Opinionated code

While the package tries to be as flexible as possible, it
still generates some opinionated code. For example, the
generated CRUD uses Laravel's `Policy` classes for handling
authorization. But you may prefer to use something else
like `spatie/laravel-permission`, which can be done but
requires you
to [create your own templates](https://san-kumar.github.io/laravel-crud/guide/customization).

## Alpha version

You should only use it with new projects. If you are using
it in an existing project, make sure to back up (or commit)
any project changes before running the command.

# Removing the generated CRUD files

## Remove files

Laravel CRUD Generator allows you to remove the generated
files using the `artisan crud:remove` command.

```bash
$ php artisan crud:remove customers.tickets.replies
```

This will remove all the files generated by
the `crud:generate` for this table.

## Backup

If you want to keep the generated files, you can use the
`--backup` option to move the files into a Zip archive
instead.

```bash
$ php artisan crud:remove customers.tickets.replies --backup=backup.zip
```

This too will remove the files from the disk but will also
create a Zip archive of all the removed files too.


# License

The software is licensed using a MIT License. It means you
can do whatever you want with it (including using it for
commercial purposes freely), as long as you include the
original copyright and license notice in any copy of the
software/source.

# Roadmap

- Add support for Livewire
- Add support for Laravel Jetstream

# About

**Found any bugs?** Report them on the [issue tracker](https://github.com/san-kumar/laravel-crud/issues).

**Want to contribute?** Fork the project on GitHub and send a
pull request.

**Like the project?** Star it on GitHub.
