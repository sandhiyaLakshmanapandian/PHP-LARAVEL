# Laravel User & Blog CRUD Application

A Laravel application with User and Blog CRUD operations, built with Laravel UI (Bootstrap). Includes role-based access control (RBAC) using Spatie Laravel Permission package.

## Requirements

- XAMPP (includes PHP >= 8.2 and MySQL)
- Composer

## Installation

### 1. Extract the project zip file

1. **Extract the zip file** to your XAMPP `htdocs` directory:
   - **Windows**: `C:\xampp\htdocs\`
   - **macOS/Linux**: `/Applications/XAMPP/htdocs/` or your XAMPP installation path

2. **Rename the extracted folder** (if needed) to your preferred project name (e.g., `laravel-app`)

3. **Open a terminal/command prompt** and navigate to the project directory:
   ```bash
   cd C:\xampp\htdocs\laravel-app
   ```
   Or on macOS/Linux:
   ```bash
   cd /Applications/XAMPP/htdocs/laravel-app
   ```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Start XAMPP services

1. **Open XAMPP Control Panel**
2. **Start Apache** (click the "Start" button)
3. **Start MySQL** (click the "Start" button)

### 4. Environment setup

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Update the `.env` file with your MySQL database credentials. For XAMPP, use these default settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=root
DB_PASSWORD=
```

> **Note**: XAMPP's default MySQL username is `root` with no password. If you've set a password, update `DB_PASSWORD` accordingly.

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Database setup

Create a MySQL database using phpMyAdmin:

1. **Open phpMyAdmin** in your browser: `http://localhost/phpmyadmin`
2. **Click on "New"** in the left sidebar
3. **Enter database name**: `laravel_app` (or the name you used in `.env`)
4. **Click "Create"**

Alternatively, you can create the database using SQL:

1. Go to the **SQL** tab in phpMyAdmin
2. Run this command:
   ```sql
   CREATE DATABASE laravel_app;
   ```

Make sure the database name matches the `DB_DATABASE` value in your `.env` file (see step 4).

### 7. Run migrations

```bash
php artisan migrate
```

### 8. Seed the database (recommended)

This will create roles, permissions, a super admin user, sample users, and blogs:

```bash
php artisan db:seed
```

Or run migrations and seed together:

```bash
php artisan migrate:fresh --seed
```

**Note**: After seeding, you can login with the super admin account:
- **Email**: `admin@example.com`
- **Password**: `password`

The seeder creates:
- **Roles**: Admin (with all permissions) and Customers (with read-only permissions)
- **Permissions**: Full CRUD permissions for Users, Blogs, and Roles
- **Super Admin**: A user with the Admin role
- **Sample Data**: Additional users and blogs for testing

## Running the Application

### Start the development server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
