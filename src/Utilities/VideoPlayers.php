<?php

namespace ByTIC\Oembed\Utilities;

use ByTIC\Oembed\Embeds\Params\Processor;
use ByTIC\Oembed\Oembed;

/**
 * Class VideoPlayers
 * @package ByTIC\Oembed\Utilities
 */
class VideoPlayers
{
    /**
     * @param $url
     * @param array $config
     * @return string
     */
    public static function embed($url, $config = []): string
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

        if (empty($code)) {
            return '';
        }

        if (count($config) > 0) {
            $code = Processor::run($code, $config);
        }
        return $code;
    }
}
