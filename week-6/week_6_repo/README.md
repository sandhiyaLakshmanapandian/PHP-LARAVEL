Tasks

1. Role CRUD with Permission Selection

Implement Role Create, Read, Update, Delete with permission selection using the Spatie Laravel Permission package.
Reference: https://spatie.be/docs/laravel-permission

2. Add Required Roles and Permissions

Create the following roles:

Admin

Customers

Create the following permissions:

Blog Read

Blog Write

User Profile Read

User Profile Write

3. Restrict Access Based on Permissions

Ensure each module and action (view, create, edit, delete) is accessible only to users who have the necessary permissions.

4. Add Pagination Wherever Needed

Apply pagination wherever it is needed in your project.

5. Implement Relationships

Create the following Eloquent relationships:

User hasMany Blogs

Blog belongsTo User

6. Blogs Listing

List all blogs in a table with:

Blog details

Corresponding user name

A "Show" icon for viewing details

7. Users Listing

List all users in a table with:

User details

Assigned role

A "Show" icon for viewing details

8. Check and Fix N+1 Issues

Review all blog/user listing queries for N+1 problems and fix them using appropriate techniques.

