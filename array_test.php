<?php
/* $array1 = range(1, 10);
$array2 = array_reverse($array1);
print_r($array2);
echo "<br>"; */
//shuffle($array2);
/*
while(list($a,$b) = each($array2))
	echo $a."--".$b."<br>";
*/

/* 
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
echo $key2; */
/* 
$a = array('one');
$a[] = &$a;
var_dump($a); */
/* 
class Person {
	private static $a=90;
	
	public static function add_a($num) {
		self::$a += $num;
	}
}

class Stu extends Person {
	public function stu_add($num) {
		//$this->add_a($num);
		parent :: add_a($num);
	}
} */

//$stu1 = new Stu();

//$stu1->stu_add(1);
//echo $stu1::$a;
//$p1 = new Person();
//$p2 = new Person();
//echo $p1->add_a(1);
//echo $p2->add_a(2);
//echo Person::$a;
//echo $p1::$a;


/* 
$arr1 = range(1,3);
$arr1[] = 4;
echo print_r(123); */

$arr = array('aaa'=>111,'bbb'=>222);
$arr[]='ccc';
print_r($arr);
