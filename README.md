## Ledger

To get up-and-running fast you can run the following commands in your terminal of choice (assuming Mac OS/Linux):
```
composer install

// move and edit your env file to match your environment
mv .env.example .env

php artisan key:generate

php artisan migrate

// optionally seed the database with some fake data after migrating
php artisan db:seed

php artisan serve
```

## License

This repo is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
