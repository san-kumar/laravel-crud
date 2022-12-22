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