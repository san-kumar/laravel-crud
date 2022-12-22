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
to [create your own templates](/guide/customization).

## Alpha version

You should only use it with new projects. If you are using
it in an existing project, make sure to back up (or commit)
any project changes before running the command.
