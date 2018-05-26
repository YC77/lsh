<?php

/**
 *   返回表格列表的json格式
 * @param $code   状态码
 * @param $data   返回的表格数据
 * @param string $msg 消息
 * @param int $count 总页数
 * @return string
 */
function ajaxTable($code, $data, $msg = '', $count = 0)
{
    exit(json_encode(["code" => $code, "msg" => $msg, "count" => $count, "data" => $data]));
}

/**
 * 返回ajax请求的数据
 * @param $code  状态码  0失败  1成功
 * @param string $msg 返回的消息
 * @param string $data 返回数据
 * @param string $url 跳转的路径
 */
function returnAjax($code, $msg = '', $data = '', $url = '')
{
    $arr['code'] = $code;
    if (empty($msg) == false) {
        $arr['msg'] = $msg;
    }
    if (empty($data) == false) {
        $arr['data'] = $data;
    }
    if (empty($url) == false) {
        $arr['url'] = $url;
    }
    exit(json_encode($arr));
}

/**
 * 更新数据时验证数据有没有修改过
 * @param $newData 用户输入的数据
 * @param $oldData 数据表的旧数据
 * @param $insertData 需要更新的数据
 * @return string 返回提示信息
 */
function updateCheck($newData, $oldData,&$insertData)
{
    foreach ($newData as $k => $v) {
        if (isset($oldData[$k]) == false || $v == $oldData[$k]) {
            continue;
        }
        $insertData[$k] = $v;
    }
    if (count($insertData) == 0) {
        return '数据没变化不需要修改';
    }
    return '';
}

function getPostData($arr){
    if (count($arr)==0){
        return [];
    }
    foreach ($arr as $k=>$v){
        if(is_numeric($k)){
            unset($arr[$k]);
        }
    }
    return $arr;
}