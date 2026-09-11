# CodeIgniter POS Foundations

A basic four-page Point-of-Sale website created with CodeIgniter 4.

## Live Demo

[Open the hosted POS application](https://codeigniter-pos-foundations.onrender.com/)

## Pages

- Home
- About
- Customer Accounts
- User Accounts

The Customer Accounts and User Accounts pages display sample records stored in static PHP arrays. No database is used in this version.

## Requirements

- PHP 8.2 or newer
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

## Routes

- `/` — Home page
- `/about` — About page
- `/customers` — Customer Accounts
- `/users` — User Accounts