<?php
$array1 = range(1, 10);
$array2 = array_reverse($array1);
print_r($array2);
echo "<br>";
//shuffle($array2);
/*
while(list($a,$b) = each($array2))
	echo $a."--".$b."<br>";
*/
$a = next($array2);
echo $a;
$b = next($array2);
echo $b;
$c = current($array2);
echo $c;
$d = reset($array2);
echo $d;
//print_r($array2);

echo '<hr>';

$array3 = array('key1'=> "value1", 'key2'=> "value2", 'key2'=> "value2");
extract($array3);
echo $key1;