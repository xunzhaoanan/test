<?php
header('Content-Type: text/html; charset=utf-8');

function my_error($errno,$errcon) {
	echo 'some error happend,error num:'.$errno.'<br>';
	echo $errcon;
	exit();
}

set_error_handler("my_error",E_);

//$fp = fopen('sss.txt', 'r');
class Person {
	private $a=90;

	public static function add_a($num) {
		self::$a += $num;
	}
}
$p1 = new Person;
echo $p1->a;
echo 'OK!'; 


/* 
function my_error2($errno,$errcon) {
	echo 'some error happend,error num:'.$errno.'<br>';
	echo $errcon;
	//exit();
}

set_error_handler("my_error2",E_USER_WARNING);

$age = 3;
if ($age > 1) {
	trigger_error('年龄过大',E_USER_NOTICE);
}

$momey = 100;
if ($momey > 50) {
	trigger_error('金额过大',E_USER_WARNING);
}
 */

/* 
function my_exception($e) {
	echo '我是顶级处理器--'.$e->getMessage();
}

set_exception_handler('my_exception');

try {
	addUser('zhangpeng');
	updateUser('aaa');
}catch (Exception $e) {
	//echo '错误信息：'.$e->getMessage();
	throw $e;
}


function addUser($username) {
	if ($username != "zhangpeng") {
		throw new Exception('添加失败');
	}
}

function updateUser($username) {
	if ($username != "zhangpeng") {
		throw new Exception('修改失败');
	}
} */


