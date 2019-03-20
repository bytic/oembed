<?php

namespace ByTIC\Oembed\Embeds\Params;

/**
 * Class Param
 * @package ByTIC\Oembed\Embeds\Params
 */
class Param
{

    /**
     * Whether or not to start the video when it is loaded.
     *
     * @var string
     */
    const AUTOPLAY = 'autoPlay';

    /**
     * @var string
     */
    const SHOW_INFOS = 'showInfos';

    /**
     * @var string
     */
    const SHOW_BRANDING = 'showBranding';

    /**
     * Whether or not to show related videos at the end.
     *
     * @var string
     */
    const SHOW_RELATED = 'showRelated';

    /**
     *    Hex code of the player's background color.
     *
     * @var string
     */
    const BACKGROUND_COLOR = 'backgroundColor';

    /**
     *    Hex code of the player's foreground color.
     *
     * @var string
     */
    const FOREGROUND_COLOR = 'foregroundColor';

    /**
     * Hex code of the player's highlight color.
     *
     * @var string
     */
    const HIGHLIGHT_COLOR = 'highlightColor';

    /**
     * The number of seconds at which the video must start.
     *
     * @var string
     */
    const START = 'start';
}
