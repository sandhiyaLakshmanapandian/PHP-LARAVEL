Tasks

Change any one existing form submission to an AJAX request.

Cache the authenticated user’s role name and display it using the cache.

Using a view composer, get the authenticated user's blog count from the session and pass it to the sidebar.

Create a blog_comments table with blog_id and user_id foreign keys.

Create relationships:

Blog hasMany comments

Comment belongsTo blog

Add a comment option for blogs (1-level comment).

Include comments count in the blogs list table.

When clicking the show icon, redirect to the blog details page and show the blog details and comments.

Check and fix any N+1 query issues for all the above items.

Write a test case using a factory to create one blog and verify that the blog is created.

Check code coverage for the written test cases — at least 75% of the code must be covered.

Note

Push the code to BitBucket and create a Pull Request.

Follow PSR-12 coding standards.

Add the raw SQL query as a comment next to every Eloquent query (as shown in the screenshot).

Follow the base code setup steps in the README file.
