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
