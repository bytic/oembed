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
     * @return string
     */
    public static function embed($url, $config = [])
    {
//        try {
//            /** @var \Embed\OEmbed $abstract */
        $abstract = Oembed::get($url);
//        } catch (\Embed\Exceptions\EmbedException $e) {
//            return '';
//        }

        $backupUrl = null;
        if (isset($config['fallback'])) {
            $backupUrl = $config['fallback'];
            unset($config['fallback']);
        }

        if ($abstract->get('type') != 'video' && $backupUrl) {
            return static::embed($backupUrl, $config);
        }

        $code = $abstract->get('html');

        if (count($config) > 0) {
            $code = Processor::run($code, $config);
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
