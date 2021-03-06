<?php

namespace ByTIC\Oembed;

use ByTIC\Oembed\Cache\CacheManager;

/**
 * Class Oembed
 * @package ByTIC\Oembed
 */
class Oembed
{
    protected static $cacheManager;
    protected static $embedLibrary;

    /**
     * @param $url
     * @param array|null $options
     * @return \Embed\OEmbed
     */
    public static function get($url, array $options = [])
    {
        if (!CacheManager::has($url, $options)) {
            $data = self::fetch($url, $options);
            CacheManager::set($data, $url, $options);
            return $data;
        }
        return CacheManager::get($url, $options);
    }

    /**
     * @param $url
     * @param array|null $options
     * @return \Embed\OEmbed
     */
    protected static function fetch($url, array $options = [])
    {
        return static::embedLibrary()::create($url, $options);
    }

    /**
     * @return EmbedManager
     */
    protected static function embedLibrary()
    {
        if (static::$embedLibrary === null) {
            static::$embedLibrary = new EmbedManager();
        }
        return static::$embedLibrary;
    }

    /**
     * @param EmbedManager $embedLibrary
     */
    public static function setEmbedLibrary($embedLibrary)
    {
        self::$embedLibrary = $embedLibrary;
    }
}
