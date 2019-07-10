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