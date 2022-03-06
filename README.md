## Setup

Create a new .env file. Copy contents of .env.example to the new .env file.

Install dependencies

```
composer install
```

```
npm install & npm run dev
```

Create a MySQL database named 'employee_management', then migrate and seed the database

```
php artisan migrate --seed
```

Run the app

```
php artisan serve
```
