## Database
Mysql ( Backend-hpp.sql)

## Postman
BackendHPP.postman_collection.json

## Seeder

- TrasactionSeeder untuk data awal transaksi
- TransactionInsertSeeder untuk data sisipan
- TransactionEndSeeder untuk data lengkap seperti pada contoh
### Command Seeder
php artisan db:seed --class=TransactionSeeder
php artisan db:seed --class=TransactionInsertSeeder
php artisan db:seed --class=TransactionEndSeeder
