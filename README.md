# PlaceRepository
PHP API library for getting location by address via Google Maps API.

## Requirements
* PHP >= 8.1
* guzzlehttp/guzzle
* nesbot/carbon
* symfony/validator
* psr/cache
* pst/log

## Installation

```bash
composer require resolventa/place-repository
```

## Usage
```php
<?php

use Resolventa\PlaceRepository\Google\GoogleGeocodePlaceRepository;

include 'vendor/autoload.php';

/**
 * Create a new GoogleGeocodePlaceRepository instance with the given API key and default settings.
 */
$placeRepository = new GoogleGeocodePlaceRepository('WDSAwrFdafdsafaewaeadR234', new Psr\Log\NullLogger());

/**
 * Find a place by address.
 */
$place = $placeRepository->findByAddress('123 Main St, New York, NY');

/**
 * See the place object.
 */
var_dump($place);
```
