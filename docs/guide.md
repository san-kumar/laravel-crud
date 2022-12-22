![laravel-crud-generator](https://cdn.articlevideorobot.com/hosted/16-12-2022/laravel-crud-152f.webp)

# Laravel CRUD Generator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-circleci]][link-circleci]
[![StyleCI][ico-styleci]][link-styleci]

This package adds a **make:crud** commands to Artisan in
your Laravel project. With this command you can generate a
CRUD (Create, Read, Update, Delete) for any table in just
one command.

The generated CRUD includes a Controller, Model, Policy,
routes, validations, and 4 view files (index, create, edit,
show). It also supports relations between tables, so you can
generate nested CRUDs, for example: generating CRUD for
comments inside a blog post.

The output is fully customizable and supports both Bootstrap
5 and Tailwind CSS.

## Table of Contents

- [Demo video](#demo-video)
- [Installation](#installation)
- [Usage](#usage)
- [Options](#options)
- [Contributing](#contributing)
- [License](#license)

## Demo video

[![Laravel CRUD Generator Demo](http://img.youtube.com/vi/rjDX5ItsOnQ/0.jpg)](http://www.youtube.com/watch?v=rjDX5ItsOnQ "Video Title")

## Installation

Via [composer](http://getcomposer.org):

```bash
$ composer require san-kumar/laravel-crud --dev
```

After installing the package you should see a
new `make:crud` command in your Artisan commands list.

## Usage

```bash
# Create CRUD for authors table
$ php artisan make:crud authors

# Create CRUD for the authors &gt; posts table
$ php artisan make:crud authors.posts

# Create CRUD for the authors &gt; posts &gt; comments table  
$ php artisan make:crud authors.posts.comments
```

## Options

### CSS Framework

You can choose between Bootstrap 5 and Tailwind CSS. By
default, Bootstrap 5 is used.

```bash
# Create CRUD for authors table using Tailwind CSS
$ php artisan make:crud authors --css=tailwind
```

### Layout

By default, the generated views use the `layouts.app`
layout. You can change this by passing the `--layout`
option.

```bash
# Create CRUD for authors table using Tailwind CSS
$ php artisan make:crud authors --layout=layouts.admin
```

### Prefix

You can add a prefix to the generated routes by passing the
`--prefix` option.

```bash
# Create CRUD for authors table using Tailwind CSS
$ php artisan make:crud authors --prefix=admin
```

## Contributing

All contributions (in the form on pull requests, issues and
feature-requests) are welcome. 

## License

`san-kumar/laravel-crud` is licenced under the MIT License (
MIT). Please see the [license file](LICENSE.md) for more
information.

[ico-version]: https://img.shields.io/packagist/v/san-kumar/laravel-crud.svg?style=flat-square

[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square

[ico-downloads]: https://img.shields.io/packagist/dt/san-kumar/laravel-crud.svg?style=flat-square

[ico-circleci]: https://img.shields.io/circleci/project/github/san-kumar/laravel-crud.svg?style=flat-square

[ico-styleci]: https://styleci.io/repos/56054783/shield

[link-packagist]: https://packagist.org/packages/san-kumar/laravel-crud

[link-downloads]: https://packagist.org/packages/san-kumar/laravel-crud

[link-circleci]: https://circleci.com/gh/san-kumar/laravel-crud

[link-styleci]: https://styleci.io/repos/539648789
