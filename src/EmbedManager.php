<?php

namespace ByTIC\Oembed;

use Embed\Embed as EmbedLibrary;

/**
 * Class EmbedManager
 * @package ByTIC\Oembed
 */
class EmbedManager
{
    /**
     * @param $url
     * @param array|null $config
     * @return \Embed\Adapters\Adapter
     */
    public static function create($url, array $config = null)
    {
        return static::createEmbedLibrary($url, $config = null);
    }

    /**
     * @param $url
     * @param array|null $config
     * @return \Embed\Adapters\Adapter
     */
    public static function createEmbedLibrary($url, array $config = null)
    {
        return EmbedLibrary::create($url, $config);
    }
}
