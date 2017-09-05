<?php
/**
 * Created by PhpStorm.
 * User: rsmike
 * Date: 14/08/2017
 * Time: 02:05
 */

const PLACEHOLDER = '/*{METHODS_PHPDOC_PLACEHOLDER}*/';
const INFILE = __DIR__.'/FA.src.php';
const OUTFILE = __DIR__.'/../src/FA.php';
const SIGNATURE = '* @method static static {FA_ID}(string|int $text = null, int $options = null) Generates "{FA_NAME}" icon';

$icons = yaml_parse_file(__DIR__.'/../vendor/fortawesome/font-awesome/src/icons.yml')['icons'];
$config = yaml_parse_file(__DIR__.'/../vendor/fortawesome/font-awesome/_config.yml')['fontawesome'];

echo 'Parsing Font Awesome icons file (' . count($icons) . ' icons)';

$output = '/**' . PHP_EOL;
$output .= '* Font Awesome icons version '.$config['version'].' ('.count($icons).' icons)'.PHP_EOL;
$output .= '*'.PHP_EOL;
foreach ($icons as $icon) {
    $iconName = str_replace('-', '_', $icon['id']);
    $output .= str_replace(['{FA_ID}', '{FA_NAME}'], [$iconName, $icon['name']], SIGNATURE) . PHP_EOL;
}
$output .= ' **/';

file_put_contents(OUTFILE, str_replace(PLACEHOLDER, $output, file_get_contents(INFILE)));
