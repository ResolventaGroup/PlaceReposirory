<?php

namespace App\Module\PlaceRepository;

interface PlaceRepositoryInterface
{
    public function findByAddress(string $address): ?Place;
}
