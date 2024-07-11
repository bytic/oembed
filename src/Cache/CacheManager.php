<?php
declare(strict_types=1);

namespace ByTIC\Oembed\Cache;

use Nip\Cache\Cacheable\HasCacheStore;

/**
 * Class CacheManager
 * @package ByTIC\Oembed\Cache
 */
class CacheManager
{
    use HasCacheStore;

    public function getOrSet($url, array $options = null, $callback)
    {
        $name = $this->name($url, $options);
        if ($this->cacheStore()->has($name)) {
            return $this->cacheStore()->get($name);
        }
        $data = $callback();
        $this->cacheStore()->set($name, $data, 30*24*60*60);
        return $data;
    }

    /**
     * @param string $url
     * @param array|null $options
     * @return false|\Embed\OEmbed
     */
    public function get($url, array $options = null)
    {
        $name = $this->name($url, $options);
        return$this->cacheStore()->get($name);
    }

    /**
     * @param $url
     * @param array|null $options
     * @return string|string[]|null
     */
    protected function name($url, array $options = null)
    {
        $filename = 'oembed.';
        $filename .= preg_replace("/[^a-zA-Z0-9]/", "", $url);
        $filename .= '--' . sha1(serialize([$url, $options]));
        $filename .= '.serialized';
        return $filename;
    }

    /**
     * @param string $path
     */
    public static function setPath(string $path)
    {
//        self::$path = $path;
    }
}
