<?php
namespace rsmike\FA;

include_once('../dist/FA.php');

echo FA::ok();
echo PHP_EOL;
echo FA::ok('test');
echo PHP_EOL;
echo FA::ok('test')->pad();
echo PHP_EOL;
echo FA::ok()->att(['a1'=>'test1', 'a2'=>'test2']);
echo PHP_EOL;
echo FA::ok()->att(['a1'=>'test1', 'a2'=>'test2'])->att(['a1'=>['test1.2','test1.3'], 'a2'=>'test22','a3'=>'test3']);
echo PHP_EOL;
echo FA::ok('test')->tooltip('hey');
echo PHP_EOL;
echo FA::ok('test')->tooltip('hey','top',true);
echo PHP_EOL;
echo FA::ok()->css('test-css:15px')->css('test-css:15px;')->att(['style'=>'test-css:15px']);
echo PHP_EOL;
echo FA::ok()->class('test class')->class(['cla1','cla2',false,null,'cla3']);
echo PHP_EOL;

?>
