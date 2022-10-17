## Product CSV importer

A Laravel application to import products from a CSV file to the database, with simple table products display and pagination.

## Requirements
Create a Laravel application and write a solution to import the given product data ( products.csv ) into its database. You'll need to write migrations with a sensible database structure along with the importer. No front end is required.

How the file is provided to the application is up to you. For example, you could write an artisan command for it or create a very basic file uploader.

Things we might be looking for:

- Usage of composer / community packages
- Migrations / database design
- Logging of errors
- Ability to handle empty, malformed, or extremely large files
- Potential to accept different file formats, i.e JSON or XML Documentation
- Validation
- Testing
- OOP / SOLID principles

## Libraries used

- [Maatwebsite Laravel 3.1.44](https://laravel-excel.com/) for importing CSV files has 11.1k stars on Github. I choose this one because it's easy to use and it's well-documented. This package is also up to date with Laravel 9. This package also provides us with a lot of features not only importing CSV files.  
- [Laravel 9.19](https://laravel.com/) base framework, version.
- [TailWinCSS 3.1.8](https://tailwindcss.com/) CDN for quick styling the view version.

## Installation

- Clone the repository
- Run `composer install`
- Copy `.env.example` to `.env`
- Run `php artisan key:generate`
- Setup database credentials in `.env` file
- Run `php artisan migrate`
- Run `php artisan serve`
- Visit `http://localhost:8000/products`
- Upload the CSV file with file `test/data/products.csv` in the root directory of the project.
- Click on `Import Product` button
- You can see the imported products in the table

## Testing

- Run `php artisan test` command to test the application

## Application Structure

- `app/Http/Controllers/ProductController.php` - This controller is responsible for displaying the form to upload CSV file, and products in the table.
- `app/Models/Product.php` - This model is responsible for the database table.
- `app/Services/ProductsImport.php` - This service is responsible for importing the CSV file to the database.
- `database/migrations/2022_10_14_152325_create_products_table.php` - This migration is responsible for creating the database `products` table.
- `database/migrations/2022_10_14_154003_create_product_attributes_table.php` - This migration is responsible for creating the database `product_attributes` table.
- `database/migrations/2022_10_14_154107_create_product_asin_table.php` - This migration is responsible for creating the database `product_asin` table.
- `resources/views/products/index.blade.php` - This view is responsible for displaying the form to upload CSV file and products in the table.
- `tests/Feature/ImportProductTest.php` - This test is responsible for testing the application.
- `routes/web.php` - This file is responsible for defining the routes of the application.
- `composer.json` - This file is responsible for defining the dependencies of the application.
- `phpunit.xml` - This file is responsible for defining the configuration of the PHPUnit.
- `README.md` - This file is responsible for defining the documentation of the application.
- `test/data/products.csv` - This file is responsible for defining the CSV file to be imported.

## Task completed

- [x] Usage of composer / community packages
- [x] Migrations / database design
- [ ] Logging of errors
- [ ] Ability to handle empty, malformed, or extremely large files
- [ ] Potential to accept different file formats, i.e JSON or XML Documentation
- [x] Validation
- [x] Testing
- [x] OOP / SOLID principles
