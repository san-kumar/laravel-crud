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

Please see
the [index page here](/guide/index.md#screenshots) for
screenshots.

### Layout and section names

By default, the generated views use `layouts/app.blade.php`
for layout and `content` for section name. You can change
these default names by passing your own layout and section
names.

