<?php

namespace ByTIC\Oembed;

use Embed\Embed as EmbedLibrary;

/**
 * Class Oembed
 * @package ByTIC\Oembed
 */
class Oembed
{

    /**
     * @param $url
     * @param array|null $options
     * @return mixed
     */
    public static function get($url, array $options = null)
    {
        return EmbedLibrary::create($url, $options);
    }
}
