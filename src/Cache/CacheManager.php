<?php

namespace ByTIC\Oembed\Cache;

/**
 * Class CacheManager
 * @package ByTIC\Oembed\Cache
 */
class CacheManager
{
    protected static $path = __DIR__ . '/../../cache';

    /**
     * @param string $url
     * @param array|null $options
     * @return bool
     */
    public static function has($url, array $options = null)
    {
        $filename = static::path(static::filename($url, $options));
        return file_exists($filename);
    }

    /**
     * @param string $url
     * @param array|null $options
     * @return false|string
     */
    public static function get($url, array $options = null)
    {
        $filename = static::path(static::filename($url, $options));
        return unserialize(file_get_contents($filename));
    }

    /**
     * @param $data
     * @param string $url
     * @param array|null $options
     * @return false|string
     */
    public static function set($data, $url, array $options = null)
    {
        $filename = static::path(static::filename($url, $options));
        return file_put_contents($filename, serialize($data));
    }

    /**
     * @param $url
     * @param array|null $options
     */
    public static function clear($url, array $options = null)
    {
        $filename = static::path(static::filename($url, $options));
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    /**
     * @param null $filename
     * @return string
     */
    protected static function path($filename = null)
    {
        return realpath(static::$path) . ($filename ? '/' . $filename : '');
    }

    /**
     * @param $url
     * @param array|null $options
     * @return string|string[]|null
     */
    protected static function filename($url, array $options = null)
    {
        $filename = preg_replace("/[^a-zA-Z]/", "", $url);
        $filename .= '--' . sha1(serialize($options));
        $filename .= '.serialized';
        return $filename;
    }

    /**
     * @param string $path
     */
    public static function setPath(string $path)
    {
        self::$path = $path;
    }
}
