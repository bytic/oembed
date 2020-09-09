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
     * @return \Embed\OEmbed
     */
    public static function create($url, array $config = [])
    {
        return static::createEmbedLibrary($url, $config);
    }

    /**
     * @param $url
     * @param array|null $config
     * @return \Embed\OEmbed
     */
    public static function createEmbedLibrary($url, array $config = [])
    {
        $embed = new EmbedLibrary();
        $result = $embed->get($url);
        $result->setSettings($config);
        return $result->getOEmbed();
    }
}
