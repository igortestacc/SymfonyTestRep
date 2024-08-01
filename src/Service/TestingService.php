<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TestingService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache,
        #[Autowire('%kernel.debug')]
        private bool $isDebug
    ) { }

    public function getAllInfo(): array
    {
        // save data from http request to cache app
        return $this->cache->get('music', function (CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter($this->isDebug ? 60 : 5);
            $responce = $this->httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');

            return $responce->toArray();
        });
    }
}