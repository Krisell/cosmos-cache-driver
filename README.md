# CosmosDB Cache Driver for Laravel
This package adds support to use Microsoft Azure CosmosDB as a cache driver for your Laravel project. It uses the MongoDB-API, so make sure you configure that on the Azure end.

## Prerequisities
Make sure you have a driver for the mongodb connection installed, for instance `jenssegers/mongodb`. Note that you also need to enable the pecl extension for mongodb.

## Configuration
Add the following configurations

database.php
```php
'cosmos' => [
    'driver'   => 'mongodb',
    'database' => env('COSMOS_DATABASE'),
    'dsn' => env('COSMOS_CONNECTION'),
],
```

cache.php
```php
'cosmos' => [
    'driver' => 'cosmos',
    'table' => env('COSMOS_TABLE', 'cache_'.config('app.env')),
],
```

So, in your .env, add
```
COSMOS_DATABASE=database_name
COSMOS_CONNECTION=database_connection_string (something like mongodb://)
COSMOS_TABLE=table_name (optional, defaults to cache_{{env}})
```

The database and table are created automatically by CosmosDB.
