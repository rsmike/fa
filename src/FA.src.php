<?php

namespace rsmike\fa;

/*{METHODS_PHPDOC_PLACEHOLDER}*/

class FA
{
    /* Initial setup */
    public static $iconAlias = [];
    public static $defaultOptions = 0;

    /* Modifiers */
    const FA_PULL_LEFT = 1 << 1;
    const FA_PULL_RIGHT = 1 << 2;

    const FA_SIZE_LG = 1 << 3;
    const FA_SIZE_2X = 1 << 4;
    const FA_SIZE_3X = 1 << 5;
    const FA_SIZE_4X = 1 << 6;
    const FA_SIZE_5X = 1 << 7;
    const FA_FIX_WIDTH = 1 << 8;

    const FA_INVERSE = 1 << 9;
    const FA_BORDER = 1 << 10;

    const FA_SPIN = 1 << 11;
    const FA_PULSE = 1 << 12;

    const FA_ROT90 = 1 << 13;
    const FA_ROT180 = 1 << 14;
    const FA_ROT270 = 1 << 15;

    const FA_FLIP_V = 1 << 16;
    const FA_FLIP_H = 1 << 17;

    private $attrs = [];

    private $wording = '';
    private $options = 0;

    const PAD_CLASS = 'fa-pad';

    const FA_CLASSES = [
        self::FA_PULL_LEFT => 'fa-pull-left',
        self::FA_PULL_RIGHT => 'fa-pull-right',
        self::FA_SIZE_LG => 'fa-lg',
        self::FA_SIZE_2X => 'fa-2x',
        self::FA_SIZE_3X => 'fa-3x',
        self::FA_SIZE_4X => 'fa-4x',
        self::FA_SIZE_5X => 'fa-5x',
        self::FA_FIX_WIDTH => 'fa-fw',
        self::FA_INVERSE => 'fa-inverse',
        self::FA_BORDER => 'fa-border',
        self::FA_SPIN => 'fa-spin',
        self::FA_PULSE => 'fa-pulse',
        self::FA_ROT90 => 'fa-rotate-90',
        self::FA_ROT180 => 'fa-rotate-180',
        self::FA_ROT270 => 'fa-rotate-270',
        self::FA_FLIP_V => 'fa-flip-vertical',
        self::FA_FLIP_H => 'fa-flip-horizontal',
    ];

    public function __toString() {
        if ($this->options) {
            foreach (self::FA_CLASSES as $flag => $faClass) {
                if ($this->options & $flag) {
                    $this->attrs['class'][] = $faClass;
                }
            }
        }

        $tag = ['i'];
        foreach ($this->attrs as $key => $attr) {
            $tag[] = $key . '="' . join(' ', (array)$attr) . '"';
        }

        return '<' . join(' ', $tag) . '></i>' . $this->wording;
    }

    /**
     * FA constructor.
     * @param string $icon Icon name
     * @param string $wording
     * @param int $options
     */
    public function __construct($icon = '', $wording = null, $options = null) {
        $this->attrs['class'] = ['fa', 'fa-' . (self::$iconAlias[$icon] ?? $icon)];
        $this->wording = $wording ? (' ' . $wording) : '';
        $this->options = $options ?? self::$defaultOptions;
    }

    /**
     * Add HTML attributes for the icon
     *
     * Example:
     * echo FA::check('ok')->attr(['class'=>'text-success', 'data-container'=>'body']);
     * will produce <i class="fa fa-ok" class="text-success" data-container="body">
     *
     * @param $attributes array
     * @return static
     */
    public function att($attributes = []) {
        $this->attrs = array_merge_recursive($this->attrs, $attributes);
        return $this;
    }

    /**
     * Set modifiers for the icon
     *
     * Example:
     * echo FA::check('ok')->mod(FA::FA_ROT90&FA::FA_SPIN);
     * is equivalent to
     * echo FA::check('ok', FA::FA_ROT90&FA::FA_SPIN);
     *
     * @param $options
     * @return static
     */
    public function mod($options) {
        $this->options = $options;
        return $this;
    }

    /**
     * @deprecated
     * @param $css
     * @return static
     */
    public function style($css) {
        return $this->css($css);
    }

    /**
     * Add custom style for the icon
     *
     * Example:
     * echo FA::check('ok')->css('padding-right:20px');
     * echo FA::check('ok', FA::FA_ROT90&FA::FA_SPIN)->css('padding-right:20px');
     *
     * @param $css string
     * @return static
     */
    public function css($css) {
        $css = trim($css);
        if (substr($css, -1) !== ';') {
            $css = $css . ';';
        }
        return $this->att(['style' => $css]);
    }

    /**
     * Add bootstrap tooltip for the icon (data-toggle="tooltip" and title)
     *
     * Example:
     * echo FA::check('ok')->tooltip('We are fine');
     *
     * @param $tooltip string
     * @param null|string $placement left, top, bottom, right. Defaults to top
     * @param bool $container whether to add 'data-container=body' to the tooltip
     * @return static
     */
    public function tooltip($tooltip, $placement = null, $container = false) {
        if ($placement) {
            $this->att(['data-placement' => $placement]);
        }
        if ($container) {
            $this->att(['data-container' => 'body']);
        }
        return $this->att(['data-toggle' => 'tooltip', 'title' => htmlspecialchars($tooltip)]);
    }

    /**
     * Add custom class for the icon
     *
     * Example:
     * echo FA::check('ok')->class('text-danger');
     * echo FA::check('ok', FA::FA_ROT90&FA::FA_SPIN)->class('text-danger');
     *
     * @param $class string | array
     * @return static
     */
    public function class($class) {
        return $this->att(['class' => $class]);
    }

    /**
     * Turns on "Link title mode". When this is activated, a (nonstandard!) "fa-a" padding class is added instead of a simple space between icon and wording.
     * This should avoid underline hover effect on leading space for link titles.
     *
     * !!! Must be styled separately, e.g.
     * .fa.fa-pad:after {
     *   content: " ";
     *   display: inline-block;
     *   width: 0.4em;
     * }
     *
     * Example:
     * echo '<a href = "#">'.FA::check('ok')->pad().'</a>';
     *
     * @return static
     */
    public function pad() {
        $this->wording = ltrim($this->wording);
        return $this->att(['class' => self::PAD_CLASS]);
    }

    /**
     * Shortcut static constructor for Font Awesome icons
     *
     * Example:
     * echo FA::check('ok');
     * echo FA::check(FA::FA_ROT90&FA::FA_SPIN);
     * echo FA::check('ok', FA::FA_ROT90&FA::FA_SPIN);
     *
     * @param string $name function name is fa icon name
     * @param array $arguments
     *  [0] string for wording OR int for options
     *  [1] for options (only if wording is set)
     * @return static
     */
    public static function __callStatic($name, $arguments) {
        if (isset($arguments[0])) {
            if (is_string($arguments[0])) {
                $wording = $arguments[0];
                $options = $arguments[1] ?? null;
            } else {
                $wording = null;
                $options = $arguments[0];
            }
        } else {
            $wording = $options = null;
        }
        return new self(str_replace('_', '-', $name), $wording, $options);
    }
}