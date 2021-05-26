<?php

namespace ByTIC\Oembed\Tests;

use ByTIC\Oembed\Cache\CacheManager;
use ByTIC\Oembed\EmbedManager;
use ByTIC\Oembed\Oembed;
use Embed\OEmbed as EmbedAdapter;
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

//        $info = EmbedManager::create('https://www.youtube.com/watch?v=Yq7Eh6JTKIg');
//        file_put_contents(TEST_FIXTURE_PATH . '/youtube.serialized', serialize($info));

        $adapter = unserialize(file_get_contents(TEST_FIXTURE_PATH . '/youtube.serialized'));
        $embedLibrary = m::mock(EmbedManager::class)->makePartial();
        $embedLibrary->shouldReceive('create')->once()->andReturn($adapter);

        Oembed::setEmbedLibrary($embedLibrary);

        foreach ([1, 2, 2] as $count) {
            $abstract = Oembed::get('https://www.youtube.com/watch?v=Yq7Eh6JTKIg');
            self::assertInstanceOf(EmbedAdapter::class, $abstract);
            self::assertSame('video', $abstract->get('type'));
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Oembed::setEmbedLibrary(null);
    }
}
