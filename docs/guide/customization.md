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

