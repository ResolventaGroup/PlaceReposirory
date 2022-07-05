<?php

namespace Resolventa\PlaceRepository;

final class Place
{
    private string $id;
    private string $formattedAddress;
    private string $country;
    private float $latitude;
    private float $longitude;

    public function __construct(string $id, string $formattedAddress, string $country, float $latitude, float $longitude)
    {
        $this->id = $id;
        $this->formattedAddress = $formattedAddress;
        $this->country = $country;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFormattedAddress(): string
    {
        return $this->formattedAddress;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
