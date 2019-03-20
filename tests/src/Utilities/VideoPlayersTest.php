<?php

namespace ByTIC\Oembed\Tests\Utilities;

use ByTIC\Oembed\Tests\AbstractTest;
use ByTIC\Oembed\Utilities\VideoPlayers;

/**
 * Class VideoPlayersTest
 * @package ByTIC\Oembed\Tests\Utilities
 */
class VideoPlayersTest extends AbstractTest
{
    public static function testEmbed()
    {
        $embed = VideoPlayers::embed('https://www.youtube.com/watch?v=Yq7Eh6JTKIg');

        static::assertIsString($embed);
        static::assertStringStartsWith('<iframe', $embed);
        static::assertStringEndsWith('</iframe>', $embed);
        static::assertStringContainsString('Yq7Eh6JTKIg', $embed);
    }

    public static function testEmbedWithConfig()
    {
        $embed = VideoPlayers::embed(
            'https://www.youtube.com/watch?v=Yq7Eh6JTKIg',
            ['width' => '100%','test' => 'value']
        );

        static::assertStringContainsString('width="100%"', $embed);
        static::assertStringContainsString('test="value"', $embed);
    }

    public static function testEmbedWithBackupURL()
    {
        $embed = VideoPlayers::embed(
            'https://www.youtube.com/watch?v=789789789789',
            ['fallback' => 'https://www.youtube.com/watch?v=Yq7Eh6JTKIg']
        );

        static::assertStringContainsString('Yq7Eh6JTKIg', $embed);
    }
}
