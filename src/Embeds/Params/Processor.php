<?php

namespace ByTIC\Oembed\Embeds\Params;

use ByTIC\Oembed\Oembed;
use DOMDocument;
use Embed\Adapters\Adapter;

/**
 * Class Processor
 * @package ByTIC\Oembed\Embeds\Params
 */
class Processor
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var []
     */
    protected $params = [];

    /**
     * Processor constructor.
     * @param $code
     * @param array $params
     */
    protected function __construct($code, $params = [])
    {
        $this->code = $code;
        $this->params = $params;
    }

    /**
     * @param string|\Embed\OEmbed $code
     * @param $params
     * @return string
     */
    public static function run($code, $params = [])
    {
        if ($code instanceof \Embed\OEmbed) {
            $code = $code->get('html');
        }

        $processor = new self($code, $params);
        return $processor->updateCode();
    }

    /**
     * @return string
     */
    protected function updateCode()
    {
        $dom = new DOMDocument();
        $dom->loadHTML($this->code, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom = $this->changeAttributes($dom);
        return $dom->saveHTML();
    }

    /**
     * @param DOMDocument $dom
     */
    protected function changeAttributes($dom)
    {
        $htmlAttributes = $this->getHtmlAttributes();
        foreach ($dom->getElementsByTagName('iframe') as $item) {
            foreach ($htmlAttributes as $name => $value) {
                $item->setAttribute($name, $value);
            }
        }
        return $dom;
    }

    /**
     * @return array
     */
    protected function getHtmlAttributes()
    {
        return $this->params;
    }
}
