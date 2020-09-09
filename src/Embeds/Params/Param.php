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
    public const AUTOPLAY = 'autoPlay';

    /**
     * @var string
     */
    public const SHOW_INFOS = 'showInfos';

    /**
     * @var string
     */
    public const SHOW_BRANDING = 'showBranding';

    /**
     * Whether or not to show related videos at the end.
     *
     * @var string
     */
    public const SHOW_RELATED = 'showRelated';

    /**
     *    Hex code of the player's background color.
     *
     * @var string
     */
    public const BACKGROUND_COLOR = 'backgroundColor';

    /**
     *    Hex code of the player's foreground color.
     *
     * @var string
     */
    public const FOREGROUND_COLOR = 'foregroundColor';

    /**
     * Hex code of the player's highlight color.
     *
     * @var string
     */
    public const HIGHLIGHT_COLOR = 'highlightColor';

    /**
     * The number of seconds at which the video must start.
     *
     * @var string
     */
    public const START = 'start';
}
