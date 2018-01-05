# Shyplite PHP And Laravel SDK


[shyplite.com](shyplite.com)

## login

before making any request you need to set token first.

Getting token

```php
use Adil\Shyplite\Shyplite;

$shyplite = new Shyplite($configs);
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

## Laravel Integration

```php
    // cnofig/app.php
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
Shyplite:order()->add()->create();
```

# Thank you :)

