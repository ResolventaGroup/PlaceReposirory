<?php

namespace App\Module\PlaceRepository\Cache;

use App\Module\PlaceRepository\Place;
use App\Module\PlaceRepository\PlaceRepositoryInterface;
use Carbon\Carbon;
use Psr\Cache\CacheItemPoolInterface;

final class CachedPlaceRepository implements PlaceRepositoryInterface
{
    private const PLACE_CACHE_KEY_PREFIX = 'place-';

    private PlaceRepositoryInterface $decoratedPlaceRepository;
    private CacheItemPoolInterface $cache;

    public function __construct(PlaceRepositoryInterface $decoratedPlaceRepository, CacheItemPoolInterface $cache)
    {
        $this->decoratedPlaceRepository = $decoratedPlaceRepository;
        $this->cache = $cache;
    }

    public function findByAddress(string $address): ?Place
    {
        $place = $this->findPlaceInCacheByAddress($address);

        if ($place) {
            return $place;
        }

        $place = $this->decoratedPlaceRepository->findByAddress($address);

        if (!$place) {
            return null;
        }

        $this->writePlaceToCache($address, $place);

        return $place;
    }

    private function findPlaceInCacheByAddress(string $address): ?Place
    {
        return $this->cache->getItem(self::getCacheKeyByAddress($address))->get();
    }

    private function writePlaceToCache(string $address, Place $place): void
    {
        $cacheItem = $this->cache->getItem(self::getCacheKeyByAddress($address));
        $cacheItem
            ->set($place)
            ->expiresAt(Carbon::now()->addMonth());

        $this->cache->saveDeferred($cacheItem);
        $this->cache->commit();
    }

    private static function getCacheKeyByAddress(string $address): string
    {
        return sprintf('%s-%s', self::PLACE_CACHE_KEY_PREFIX, md5($address));
    }
}
