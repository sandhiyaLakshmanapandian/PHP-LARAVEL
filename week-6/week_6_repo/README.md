# Laravel User & Blog CRUD Application

A Laravel application with User and Blog CRUD operations, built with Laravel UI (Bootstrap).

## Features

- **User Management**: Full CRUD operations for users (Create, Read, Update, Delete)
- **Blog Management**: Full CRUD operations for blogs (Create, Read, Update, Delete)
- **Authentication**: Laravel UI authentication system (Login, Register, Logout)
- **Database Factories**: Factories for generating test data
- **Database Seeders**: Seeders for populating the database with sample data

## Requirements

- PHP >= 8.2
- Composer
- Node.js and NPM
- MySQL (default) or PostgreSQL/SQLite

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/prasanth-j/base-code.git
cd base-code
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install
```

### 4. Environment setup

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Update the `.env` file with your MySQL database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Database setup

The application uses MySQL by default. Create a MySQL database:

```sql
CREATE DATABASE your_database_name;
```

Make sure your `.env` file has the correct MySQL credentials (see step 4).

### 7. Run migrations

```bash
php artisan migrate
```

### 8. Seed the database (optional)

This will create sample users and blogs:

```bash
php artisan db:seed
```

Or run migrations and seed together:

```bash
php artisan migrate:fresh --seed
```

### 9. Build frontend assets

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

## Running the Application

### Start the development server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### Using the dev script (includes server, queue, logs, and vite)

```bash
composer run dev
```

## Database Structure

### Users Table
- `id` - Primary key
- `name` - User's name
- `email` - User's email (unique)
- `email_verified_at` - Email verification timestamp
- `password` - Hashed password
- `remember_token` - Remember me token
- `created_at` - Creation timestamp
- `updated_at` - Update timestamp

### Blogs Table
- `id` - Primary key
- `title` - Blog title
- `content` - Blog content
- `user_id` - Foreign key to users table
- `created_at` - Creation timestamp
- `updated_at` - Update timestamp

## Routes

### Authentication Routes
- `GET /login` - Login page
- `POST /login` - Login action
- `GET /register` - Registration page
- `POST /register` - Registration action
- `POST /logout` - Logout action

### User CRUD Routes (Protected by auth)
- `GET /users` - List all users
- `GET /users/create` - Show create user form
- `POST /users` - Store new user
- `GET /users/{user}/edit` - Show edit user form
- `PUT /users/{user}` - Update user
- `DELETE /users/{user}` - Delete user

### Blog CRUD Routes (Protected by auth)
- `GET /blogs` - List all blogs
- `GET /blogs/create` - Show create blog form
- `POST /blogs` - Store new blog
- `GET /blogs/{blog}/edit` - Show edit blog form
- `PUT /blogs/{blog}` - Update blog
- `DELETE /blogs/{blog}` - Delete blog

## Seeders

### UserSeeder
Creates:
- 1 test user (test@example.com)
- 10 additional random users

### BlogSeeder
Creates:
- 3 blogs per user

## Factories

### UserFactory
Generates fake user data with:
- Random name
- Unique email
- Hashed password (default: "password")

### BlogFactory
Generates fake blog data with:
- Random title
- Random content (3 paragraphs)
- Associated user_id

## Default Test User

After seeding, you can login with:
- **Email**: test@example.com
- **Password**: password

## Usage

1. Register a new account or login with the test user
2. Navigate to "Users" in the navigation menu to manage users
3. Navigate to "Blogs" in the navigation menu to manage blogs
4. Create, edit, or delete users and blogs as needed

## Development

### Code Formatting

```bash
./vendor/bin/pint
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
