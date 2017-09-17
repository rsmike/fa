# PHP Font awesome

Awesome PHP Font Awesome library. 

Includes autocomplete for most IDEs.

## Usage

#### Icon only
`echo FA::check();` generates `<i class="fa fa-check>`

#### Icon with wording
`echo FA::check('Submit');` generates `<i class="fa fa-check> Submit` 

*Note a space between icon and wording.*

#### Icon with options 
`echo FA::check(FA::FA_BORDER | FA_FLIP_H);`  generates `<i class="fa fa-check fa-border fa-flip-horizontal>`

*Possible options are: FA_PULL_LEFT, FA_PULL_RIGHT, FA_SIZE_LG, FA_SIZE_2X, FA_SIZE_3X, FA_SIZE_4X, FA_SIZE_5X, FA_FIX_WIDTH, FA_INVERSE, FA_BORDER, FA_SPIN, FA_PULSE, FA_ROT90, FA_ROT180, FA_ROT270, FA_FLIP_V, FA_FLIP_H;*

#### Icon with wording and options
`echo FA::check('Submit', FA::FA_ROT90);`

*Options should go as a second parameter. If the first parameter is not a string, it considered to be options and the second parameter is ignored.*

#### Icon with additional custom class
`echo FA::check('Submit', FA::FA_ROT90)->class('text-danger my-class');` generates `<i class="fa fa-check fa-rotate-90 text-danger my-class"></i> Submit`

*Class applies to the icon itself (not the wording)*

#### Icon with Bootstrap-compatible tooltip
`echo FA::exclamation_triangle()->tooltip('Data not verified');` generates `<i class="fa fa-exclamation-triangle" data-toggle="tooltip" title="Data not verified"></i>`


#### Icon with additional CSS style
`echo FA::check()->style('margin-left: 20px');` generates `<i class="fa fa-check" style="margin-left: 20px"></i>`

#### Applying modifiers after construction
`echo FA::check('Submit')->mod(FA::FA_ROT90);` generates `<i class="fa fa-check fa-rotate-90"></i> Submit`

#### Using icon as an object

```
$ok = FA::check();
$ko = clone $ok;

$ok->class('text-danger');
$ko->mod(FA_FLIP_H);

echo $ok, $ko;
```

## Installation

Either run
```bash
$ composer require rsmike/fa:~1.0
```

or add
```
"rsmike/fa": "~1.0"
```
to the `require` section of your `composer.json` file.

"fortawesome/font-awesome" package is a dependency and will be installed automatically.

### Changelog
##### v1.0
* initial public version
* FA icons 4.7 

### TODO

 * stacking support
 * list icons
 * tests
