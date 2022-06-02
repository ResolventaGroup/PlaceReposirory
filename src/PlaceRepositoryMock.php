<?php

namespace App\Module\PlaceRepository;

final class PlaceRepositoryMock implements PlaceRepositoryInterface
{
    public const STOCKHOLM_LATITUDE = 59.334_591;
    public const STOCKHOLM_LONGITUDE = 18.063_240;

    private bool $isSearchEnabled = true;

    public function findByAddress(string $address): ?Place
    {
        return $this->isSearchEnabled ? new Place('place_id', $address, 'country', self::STOCKHOLM_LATITUDE, self::STOCKHOLM_LONGITUDE) : null;
    }

    public function disableSearch(): void
    {
        $this->isSearchEnabled = false;
    }

    public function enableSearch(): void
    {
        $this->isSearchEnabled = true;
    }
}
