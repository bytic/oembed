<?php

namespace ByTIC\Oembed\Tests\Cache;

use ByTIC\Oembed\Cache\CacheManager;
use ByTIC\Oembed\Tests\AbstractTest;

/**
 * Class CacheManagerTest
 * @package ByTIC\Oembed\Tests\Cache
 */
class CacheManagerTest extends AbstractTest
{
    /**
     * @dataProvider data_get_set
     */
    public function test_get_set($url, $options)
    {
        CacheManager::setPath(TEST_FIXTURE_PATH . '/cache');

        self::assertFalse(CacheManager::has($url, $options));
        $data = serialize([$url, $options]);
        CacheManager::set($data, $url, $options);

        self::assertTrue(CacheManager::has($url, $options));
        self::assertSame($data, CacheManager::get($url, $options));
        CacheManager::setPath(TEST_FIXTURE_PATH . '/cache');
    }

    public function data_get_set()
    {
        return [
            ['https://vimeo.com/331290131', ['']],
            ['https://vimeo.com/331290131', ['option1']],
            ['https://vimeo.com/331290131', ['option2']],
            ['https://vimeo.com/123565469', ['']],
            ['https://vimeo.com/123565469', null],
            ['https://vimeo.com/221548066', ['']],
        ];
    }

}