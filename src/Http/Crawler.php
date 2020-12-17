<?php

namespace ByTIC\Oembed\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class Crawler
 * @package ByTIC\Oembed\Http
 */
class Crawler extends \Embed\Http\Crawler
{
    /**
     * @inheritDoc
     */
    public function createRequest(string $method, $uri): RequestInterface
    {
        $uri = $this->checkForYoutube($uri);
        return parent::createRequest($method, $uri);
    }

    /**
     * @param $uri
     * @return mixed|UriInterface|string|string[]
     */
    protected function checkForYoutube($uri)
    {
        if (is_string($uri) && strpos('http://www.youtube', $uri) === 0) {
            return str_replace('http://www.youtube', 'https://www.youtube', $uri);
        }
        if ($uri instanceof UriInterface) {
            if ($uri->getScheme() == 'http' && $uri->getHost() == 'www.youtube.com') {
                return $uri->withScheme('https');
            }
        }
        return $uri;
    }
}
