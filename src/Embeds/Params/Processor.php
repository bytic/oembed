<?php

namespace ByTIC\Oembed\Embeds\Params;

use DOMDocument;
use Embed\OEmbed;

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
     * @var array
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
     * @param string|OEmbed $code
     * @param $params
     * @return string
     */
    public static function run($code, $params = []): string
    {
        if ($code instanceof OEmbed) {
            $code = $code->get('html');
        }

        $processor = new self($code, $params);
        return $processor->updateCode();
    }

    /**
     * @return string
     */
    protected function updateCode(): string
    {
        $dom = new DOMDocument();
        $dom->loadHTML($this->code, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom = $this->changeAttributes($dom);
        return $dom->saveHTML();
    }

    /**
     * @param DOMDocument $dom
     * @return DOMDocument
     */
    protected function changeAttributes(DOMDocument $dom): DOMDocument
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
    protected function getHtmlAttributes(): array
    {
        return $this->params;
    }
}
