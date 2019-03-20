<?php

namespace ByTIC\Oembed\Utilities;

use ByTIC\Oembed\Embeds\Params\Processor;
use ByTIC\Oembed\Oembed;
use Embed\Adapters\Adapter;

/**
 * Class VideoPlayers
 * @package ByTIC\Oembed\Utilities
 */
class VideoPlayers
{
    /**
     * @param $url
     * @param $config
     * @param $backupUrl
     * @return mixed
     */
    public static function embed($url, $config = [], $backupUrl = null)
    {
        /** @var Adapter $abstract */
        $abstract = Oembed::get($url);

        if ($abstract->type != 'video' && $backupUrl) {
            return static::embed($backupUrl, $config);
        }

        $code = $abstract->code;

        if ($abstract->type != 'video' && $backupUrl) {
            return static::embed($backupUrl, $config);
        }
        if (count($config) > 0) {
            $code = Processor::run($abstract, $config);
        }
        return $code;
    }

    /**
     * Replace the string with the given value.
     *
     * @return string
     */
    private function replaceTag($code, $tag, $value)
    {
        $pattern = "/" . $tag . "=\"[0-9]*\"/";
        return preg_replace($pattern, $tag . "='" . $value . "'", $code);
    }
}
