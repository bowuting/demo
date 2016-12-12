<?php
/****
燕十八 公益PHP讲堂

论  坛: http://www.zixue.it
微  博: http://weibo.com/Yshiba
YY频道: 88354001
****/



/*
file init.php
作用:框架初始化
*/


// 初始化当前的绝对路径
// 换成正斜线是因为 win/linux都支持正斜线,而linux不支持反斜线




define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))) . '/');
define('DEBUG',true);

function __autoload($class) {
    if(strtolower(substr($class,-5)) == 'model') {
        require(ROOT . 'Model/' . $class . '.class.php');
    } else if(strtolower(substr($class,-4)) == 'tool') {
        require(ROOT . 'tool/' . $class . '.class.php');
    } else {
        require(ROOT . 'include/' . $class . '.class.php');
    }
}

function __autoExecute($table,$arr,$mode='insert',$where = ' where 1 limit 1') {
    /*    insert into tbname (username,passwd,email) values ('',)
    /// 把所有的键名用','接起来
    // implode(',',array_keys($arr));
    // implode("','",array_values($arr));
    */

    if(!is_array($arr)) {
        return false;
    }

    if($mode == 'update') {
        $sql = 'update ' . $table .' set ';
        foreach($arr as $k=>$v) {
            $sql .= $k . "='" . $v ."',";
        }
        $sql = rtrim($sql,',');
        $sql .= $where;


    }

    $sql = 'insert into ' . $table . ' (' . implode(',',array_keys($arr)) . ')';
    $sql .= ' values (\'';
    $sql .= implode("','",array_values($arr));
    $sql .= '\')';

    return $sql;
}

// 递归转义数组
function __addslashes($arr) {
    foreach($arr as $k=>$v) {
        if(is_string($v)) {
            $arr[$k] = addslashes($v);
        } else if(is_array($v)) {  // 再加判断,如果是数组,调用自身,再转
            $arr[$k] = _addslashes($v);
        }
    }

    return $arr;
}

// 过滤参数,用递归的方式过滤$_GET,$_POST,$_COOKIE,暂时不会
$_GET = __addslashes($_GET);
$_POST = __addslashes($_POST);
$_COOKIE = __addslashes($_COOKIE);


// 设置报错级别


if(defined('DEBUG')) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}
