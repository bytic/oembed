<?php

namespace ByTIC\Oembed\Tests;

use ByTIC\Oembed\Cache\CacheManager;
use ByTIC\Oembed\EmbedManager;
use ByTIC\Oembed\Oembed;
use Embed\Adapters\Adapter as EmbedAdapter;
use Mockery as m;

/**
 * Class OembedTest
 * @package ByTIC\Oembed\Tests
 */
class OembedTest extends AbstractTest
{
    public function test_cache_fetch()
    {
        CacheManager::clear('https://www.youtube.com/watch?v=Yq7Eh6JTKIg');

        $adapter = unserialize(file_get_contents(TEST_FIXTURE_PATH . '/youtube.serialized'));
        $embedLibrary = m::mock(EmbedManager::class)->makePartial();
        $embedLibrary->shouldReceive('create')->once()->andReturn($adapter);

        Oembed::setEmbedLibrary($embedLibrary);
        $data1 = Oembed::get('https://www.youtube.com/watch?v=Yq7Eh6JTKIg');
        $data2 = Oembed::get('https://www.youtube.com/watch?v=Yq7Eh6JTKIg');
        $data3 = Oembed::get('https://www.youtube.com/watch?v=Yq7Eh6JTKIg');

        self::assertInstanceOf(EmbedAdapter::class, $data1);
        self::assertInstanceOf(EmbedAdapter::class, $data2);
        self::assertInstanceOf(EmbedAdapter::class, $data3);
    }
}
