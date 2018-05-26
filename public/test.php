<?php
//$tx=file_get_contents('https://www.baidu.com');
header('Content-type: text/html; charset=utf-8');
$word="百度：https://www.baidu.com
淘宝：https://www.taobao.com
京东：http://www.jd.com
天猫：https://tmall.com
一号店：http://yhd.com";

$partern='/(https|http)://\w+\.+\w+(\.\w+)*/';

preg_match_all($word,$partern,$arr);
print_r($arr);

