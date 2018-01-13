# Shyplite PHP And Laravel SDK


## [shyplite.com](http://shyplite.com/)

## Installing
Composer is the best friend to install any php libraries / dependancies with their dependancies.
If you haven't already installed then follow the link
[Composer](https://getcomposer.org/)

Then run following command in your terminal/command prompt where your application is installed.

```composer
composer require md-adil/shyplite dev-master
```


## Login

Before making any request you need to set token first.

Getting token

```php
use Adil\Shyplite\Shyplite;

$congis = [
    'username'=> '<email-id>',
    'password' => '<password>',
    'app_id' => '<app-id>', // Your app's ID
    'seller_id' => '<seller-id>',   // Your seller ID
    'key' => '<key>'
];

$shyplite = new Shyplite($configs); // Constructor takes config array as argument
$response = $shyplite->login();
$shyplite->setToken($response->userToken);
```

## Order

To create order

```php
$orders = $shyplite->order()->add([/*order array provided in official doc*/])
    ->add([/*Add more order not more than 25*/])
    ->create() // finally create order and return array of Order model which hold the values you provided with response id and success status
    // or

foreach($orders as $order) {
    echo $order->id; // response success id
    echo $order->getError(); // if error on particular order
    echo $order->hasError(); // true or false
}

```

To cancel order

```php
$shyplite->order()->cancel([/* array of order id */])

```

## Shipment

Getting slip

```php
$slip = $shyplite->shipment()->getSlip(/* order id */);

echo $slip->name; // name of slip

echo $slip->download(/* download location */);

```

Getting manifest

```php

$menifest = $shyplite->shipment()->menifest(/* menifest id provided by getSlip function */);
echo $menifest->name; // name of menifest
echo $menifest->path // path to download menifest
$menifest->download(/*path to download*/);

```
## Service

To check service availability.

```php

$available = $shyplite->service()->availability($sourcePincode, $destinationPincode);

print_r($avaialable);

```

## Configuration

Required:
```php
$config = [
    'username'=> '<email-id>',
    'password' => '<password>',
    'app_id' => '<app-id>', // Your app's ID
    'seller_id' => '<seller-id>',   // Your seller ID
    'key' => '<key>'
];
```

Default:
```php
protected $configs = [
    'verified_request' => false,
    'base_uri' => 'https://api.shyplite.com',
    'order_uri' => 'order',
    'get_slip_uri' => 'getSlip',
    'availablity_uri' => 'getserviceability',
    'track_uri' => 'track',
    'manifest_uri' => 'getManifestPDF',
    'ordercancel_uri' => 'ordercancel'
];
```
You can override default configs by providing the key your own config like:
```php
$configs = [
    /* our configs */,
    'verified_request' => true, // Now you need to add certificate to make verified reques.
    'order_uri' => 'orders', // If later on shyplite decide to change their uri.
]
```

## Laravel Integration
Let the laravel know about your plugin.

`configs/app.php`
```php
    return [

        // providers section.
      
        'providers' => [
            // ...,
            Adil\Shyplite\Laravel\ShypliteServiceProvider::class
        ],

        'aliases' => [

            // ...
            'Shyplite' => Adil\Shyplite\Laravel\Facade\Shyplite::class

        ]
      
    ];

    // use it in your app

Shyplite::setToken($yourtoken);
Shyplite::order()->add()->create();
```
Now add shyplite specific settings in your configs directory.

`configs/shyplite.php`
```php
return [
    'username'=> '<email-id>',
    'password' => '<password>',
    'app_id' => '<app-id>', // Your app's ID
    'seller_id' => '<seller-id>',   // Your seller ID
    'key' => '<key>'
];

```

This is unofficial shyplite sdk for php / laravel.

I appreciate your feedback. If you find any issues please don't forget to letme know either mail me or create github issue.
if you like my efforts please dont forget to give star.

# Thank you :)

