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
