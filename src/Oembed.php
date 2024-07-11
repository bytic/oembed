<?php

namespace ByTIC\Oembed;

use ByTIC\Oembed\Cache\CacheManager;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class Oembed
 * @package ByTIC\Oembed
 */
class Oembed
{
    use SingletonTrait;

    protected $cacheManager;
    protected $embedLibrary;

    /**
     * @param $cacheManager
     */
    public function __construct($cacheManager = null)
    {
        $this->cacheManager = $cacheManager ?? new CacheManager();
    }


    /**
     * @param $url
     * @param array|null $options
     * @return \Embed\OEmbed
     */
    public static function get($url, array $options = [])
    {
        return self::instance()->doGet($url, $options);
    }

    protected function doGet($url, array $options = [])
    {
        return $this->cacheManager->getOrSet($url, $options, function () use ($options, $url) {
            return $this->fetch($url, $options);
        });
    }

    /**
     * @param $url
     * @param array|null $options
     * @return \Embed\OEmbed
     */
    protected function fetch($url, array $options = [])
    {
        return $this->embedLibrary()::create($url, $options);
    }

    /**
     * @return EmbedManager
     */
    protected function embedLibrary()
    {
        if ($this->embedLibrary === null) {
            $this->embedLibrary = new EmbedManager();
        }
        return $this->embedLibrary;
    }

    /**
     * @param EmbedManager $embedLibrary
     */
    public static function setEmbedLibrary($embedLibrary)
    {
        self::instance()->embedLibrary = $embedLibrary;
    }
}
