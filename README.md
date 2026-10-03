# CodeIgniter POS Forms and File Upload

A CodeIgniter 4 Point-of-Sale application with database-backed customer and user accounts, validated create/edit forms, and prepared user avatar uploads.

## Live Demo

[Open the hosted POS application](https://yuan-pos-foundations.freehosting.dev/public/)

## Pages

- Home
- About
- Customer Accounts: list, create, and edit
- User Accounts: list, create, edit, and upload an avatar

## TFA3 Features

- Required full name and valid email validation for customers
- Required, unique usernames and required full names for users
- Validation errors displayed beside fields while preserving submitted text
- Pre-filled customer and user edit forms
- Optional JPG/PNG avatar upload on the user edit page
- Maximum avatar size of 2 MB
- Prepared 300 x 300 avatar images stored in `public/uploads/avatars`
- Only the generated filename is saved in the `users.avatar` column
- Placeholder image for users without an uploaded avatar

## Database Setup

1. Create a MySQL database named `pos_foundations`.
2. Import `database/pos_foundations.sql`.
3. Copy or rename `env` to `.env`.
4. Configure the database connection in `.env`:

   database.default.hostname = localhost
   database.default.database = pos_foundations
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306

5. Start the application:

   php spark serve

## Requirements

- PHP 8.2 or newer
- PHP GD extension for preparing avatar images
- Composer
- CodeIgniter 4

## How to Run the Project

1. Download or clone the project.
2. Open a terminal inside the project folder.
3. Install the dependencies:

   composer install

4. Rename the `env` file to `.env`.
5. Set the base URL inside `.env`.
6. Start the development server:

   php spark serve

7. Open the address shown in the terminal.

If avatar processing reports that the GD handler is unavailable in XAMPP, open XAMPP's `php.ini`, enable `extension=gd`, save it, and restart Apache.

### Upgrading an Existing TFA2 Database

For an existing database, either run the migration:

   php spark migrate

or import `database/tfa3_upgrade.sql` once. Do not run both methods against the same database.

Make sure `public/uploads/avatars` is writable by the web server. The repository includes the placeholder image, while uploaded user images are intentionally ignored by Git.

## Routes

- `/` — Home page
- `/about` — About page
- `/customers` — Customer Accounts
- `/customers/new` — New Customer form
- `/customers/{id}/edit` — Edit Customer form
- `/users` — User Accounts
- `/users/new` — New User form
- `/users/{id}/edit` — Edit User form and avatar upload
