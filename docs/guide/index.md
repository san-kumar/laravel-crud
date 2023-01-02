# Laravel CRUD Generator

![laravel-crud-generator](https://cdn.articlevideorobot.com/hosted/16-12-2022/laravel-crud-152f.webp)

## Introduction

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

:::warning The package is still in _alpha_

You should only use it with new projects. If you are using
it in an existing project, make sure to back up (or commit)
any project changes before running the command.
:::

The aim of the CRUD generator is to save you time by
generating common boilerplate CRUD code for any database
table instantly.

But this code is **not** intended to be used as-is. You
should always customize the generated code to fit your needs
and manually review the generated files before deploying it
to production.
