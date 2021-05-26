<?php

namespace ByTIC\Oembed\Tests;

use ByTIC\Oembed\EmbedManager;
use Embed\OEmbed as EmbedAdapter;

/**
 * Class EmbedManagerTest
 * @package ByTIC\Oembed\Tests
 */
class EmbedManagerTest extends AbstractTest
{
    public function test_create()
    {
        $info = EmbedManager::create('https://www.youtube.com/watch?v=Yq7Eh6JTKIg');
        self::assertInstanceOf(EmbedAdapter::class, $info);
        self::assertSame('video', $info->get('type'));
    }
}