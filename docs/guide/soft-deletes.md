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