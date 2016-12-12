<?php
//设置页面内容是html编码格式是utf-8
header("Content-Type: text/plain;charset=utf-8");
require_once('./include/init.php');

//header("Content-Type: application/json;charset=utf-8");
//header("Content-Type: text/xml;charset=utf-8");
//header("Content-Type: text/html;charset=utf-8");
//header("Content-Type: application/javascript;charset=utf-8");
//定义一个多维数组，包含员工的信息，每条员工信息为一个数组


if ($_SERVER["REQUEST_METHOD"] == "GET") {
	search();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST"){
	create();
}



//创建员工
function create(){

	//判断信息是否填写完全
	if (!isset($_POST["name"]) || empty($_POST["name"])
		|| !isset($_POST["stuid"]) || empty($_POST["stuid"])
		|| !isset($_POST["xueyuan"]) || empty($_POST["xueyuan"])
		|| !isset($_POST["zhuanye"]) || empty($_POST["zhuanye"])
		|| !isset($_POST["tel"]) || empty($_POST["tel"])
		|| !isset($_POST["is_ganshi"]) || empty($_POST["is_ganshi"])) {
		echo "注册失败";
		return;
	}

	$db = new mysqli('localhost','root','zc5210','kechuang');
	$db->query('set names utf8');
	$sql = __autoExecute('zhaoxin',$_POST);
	//echo $sql;
	if($db->query($sql)){
		echo "注册成功";

	} else {
	    echo "注册失败";
	}
	//echo $sql;

	log::write($sql);


	//提示保存成功

  //print_r($_POST);
	//echo "注册成功";
	//echo "员工：" . $_POST["name"] . " 信息保存成功！";
}
