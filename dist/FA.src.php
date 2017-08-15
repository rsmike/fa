<?php

/*
 * @TODO: stacking support
 * @TODO: list icons
 * @TODO: tests
 *
 * */

namespace rsmike\fa;

/*{METHODS_PHPDOC_PLACEHOLDER}*/

class FA
{
    /* Initial setup */
    public static $iconAlias = [];
    public static $defaultOptions = self::SPACE;

    const SPACE         = 0b000000000000000000000001;

    const PULL_LEFT     = 0b000000000000000000000010;
    const PULL_RIGHT    = 0b000000000000000000000100;
    const SIZE_LG       = 0b000000000000000000001000;
    const SIZE_2X       = 0b000000000000000000010000;
    const SIZE_3X       = 0b000000000000000000100000;
    const SIZE_4X       = 0b000000000000000001000000;
    const SIZE_5X       = 0b000000000000000010000000;
    const FIX_WIDTH     = 0b000000000000000100000000;
    const INVERSE       = 0b000000000000001000000000;
    const BORDER        = 0b000000000000010000000000;
    const SPIN          = 0b000000000000100000000000;
    const PULSE         = 0b000000000001000000000000;
    const ROT90         = 0b000000000010000000000000;
    const ROT180        = 0b000000000100000000000000;
    const ROT270        = 0b000000001000000000000000;
    const FLIP_V        = 0b000000010000000000000000;
    const FLIP_H        = 0b000000100000000000000000;

    private $name;
    private $class;
    private $css;
    private $options = 0;

    private static $faClasses = [
        self::PULL_LEFT => 'fa-pull-left',
        self::PULL_RIGHT => 'fa-pull-right',
        self::SIZE_LG => 'fa-lg',
        self::SIZE_2X => 'fa-2x',
        self::SIZE_3X => 'fa-3x',
        self::SIZE_4X => 'fa-4x',
        self::SIZE_5X => 'fa-5x',
        self::FIX_WIDTH => 'fa-fw',
        self::INVERSE => 'fa-inverse',
        self::BORDER => 'fa-border',
        self::SPIN => 'fa-spin',
        self::PULSE => 'fa-pulse',
        self::ROT90 => 'fa-rotate-90',
        self::ROT180 => 'fa-rotate-180',
        self::ROT270 => 'fa-rotate-270',
        self::FLIP_V => 'fa-flip-horizontal',
        self::FLIP_H => 'fa-flip-vertical',
    ];

    public function __toString() {
        $classes = ['fa'];
        $classes[] = 'fa-'.$this->name;

        foreach (self::$faClasses as $flag => $faClass) {
            if ($this->options & $flag) {
                $classes[] = $faClass;
            }
        }

        if ($this->class) {
            $classes[] = $this->class;
        }

        return '<i class="'.join(' ',$classes).($this->css?'" style="'.$this->css:'').'"></i>'.($this->options & self::SPACE?' ':'');
    }

    public function __construct($icon = '', $options = null) {
        $this->name = self::$iconAlias[$icon] ?? $icon;
        $this->options = $options ?? self::$defaultOptions;
    }

    public function set($options) {
        $this->options = $options;
        return $this;
    }

    public function css($css) {
        $this->css = $css;
        return $this;
    }

    public function class($class) {
        $this->class = $class;
        return $this;
    }

    /**
     * Shortcut static constructor for Font Awesome icons
     *
     * @param string $name function name is icon name
     * @param array $arguments argument[0] for options
     * @return string
     */
    public static function __callStatic($name, $arguments) {
        return new self(str_replace('_','-',$name), $arguments[0]??null);
    }
}