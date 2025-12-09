Tasks

When creating or updating a blog, trigger an event.

The listener must send an email to the admin or the blog's email ID using a Markdown Mailable (Laravel components).

Create another email using your own custom Blade styling.

When the event is dispatched:

Create blog → Send markdown mail

Update blog → Send custom-styled mail

Both emails must contain the blog details.

The event must have two listeners:

One listener for the Markdown mail

One listener for the custom template mail

All emails must be sent using queues.

Create an Artisan command that runs every midnight and sends an email containing all blogs created on the previous day.

Notes

Push the code to BitBucket and create a Pull Request.

Follow PSR-12 coding standards.

Add the raw SQL query as a comment next to every Eloquent query (same format as raw_query.png).

Follow the base code setup instructions in the project README.
