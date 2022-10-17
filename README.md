## Product CSV importer

This is a quick project to import products from a CSV file into database.

## Libraries used

- [Maatwebsite Laravel](https://laravel-excel.com/)
- [Laravel](https://laravel.com/)
- [TailWinCSS](https://tailwindcss.com/)

## Installation

- Clone the repository
- Run `composer install`
- Copy `.env.example` to `.env`
- Run `php artisan key:generate`
- Setup database credentials in `.env` file
- Run `php artisan migrate`
- Run `php artisan serve`
- Visit `http://localhost:8000/products`
- Upload the CSV file
- Click on `Import Product` button
- You can see the imported products in the table
