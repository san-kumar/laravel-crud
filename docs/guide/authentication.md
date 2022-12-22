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

