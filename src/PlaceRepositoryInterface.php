<?php

namespace Resolventa\PlaceRepository;

interface PlaceRepositoryInterface
{
    public function findByAddress(string $address): ?Place;
}
