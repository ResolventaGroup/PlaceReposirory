<?php

namespace Resolventa\PlaceRepository\Google;

use Resolventa\PlaceRepository\Place;
use Resolventa\PlaceRepository\PlaceRepositoryInterface;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

final class GoogleGeocodePlaceRepository implements PlaceRepositoryInterface
{
    private const BASE_URL = 'https://maps.googleapis.com/maps/api/';

    private string $googleApiKey;
    private Client $client;
    private LoggerInterface $logger;

    public function __construct(string $googleApiKey, LoggerInterface $logger)
    {
        $this->googleApiKey = $googleApiKey;
        $this->logger = $logger;
        $this->client = new Client([
            'base_uri' => self::BASE_URL,
            'timeout' => 5,
        ]);
    }

    public function findByAddress(string $address): ?Place
    {
        try {
            $placesInformation = $this->requestPlacesInformation($address);
            $placeInformation = self::findPlaceInformationContainingCountry($placesInformation);

            if (!$placeInformation) {
                return null;
            }

            return new Place(
                $placeInformation['id'],
                $placeInformation['formattedAddress'],
                $placeInformation['country'],
                $placeInformation['latitude'],
                $placeInformation['longitude'],
            );
        } catch (\Throwable $exception) {
            $this->logger->error(sprintf('Search for a place in google geocode failed. %s', $exception->getMessage()));

            return null;
        }
    }

    /**
     * @return mixed[]
     */
    private function requestPlacesInformation(string $address): array
    {
        $response = $this->client->request('GET', 'geocode/json', [
            'query' => [
                'key' => $this->googleApiKey,
                'address' => $address,
                'language' => 'en',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['results'] ?? [];
    }

    /**
     * @param mixed[] $placesInformation
     *
     * @return string[]|null
     */
    private static function findPlaceInformationContainingCountry(array $placesInformation): ?array
    {
        foreach ($placesInformation as $placeInformation) {
            $placeCountry = self::findCountryNameInAddressComponents($placeInformation['address_components']);

            if ($placeCountry) {
                return [
                    'id' => $placeInformation['place_id'],
                    'formattedAddress' => $placeInformation['formatted_address'],
                    'country' => $placeCountry,
                    'latitude' => $placeInformation['geometry']['location']['lat'],
                    'longitude' => $placeInformation['geometry']['location']['lng'],
                ];
            }
        }

        return null;
    }

    /**
     * @param mixed[] $addressComponents
     */
    private static function findCountryNameInAddressComponents(array $addressComponents): ?string
    {
        foreach ($addressComponents as $addressComponent) {
            if (in_array('country', $addressComponent['types'], true)) {
                return $addressComponent['long_name'];
            }
        }

        return null;
    }
}
