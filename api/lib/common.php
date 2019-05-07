<?php
date_default_timezone_set('PRC');

/**
 * 跨域访问开启
 */
function crossDomain(){
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Headers:x-requested-with,content-type');
    header("Content-type: text/html; charset=utf-8");
}

/**
 * 接口返回数据
 */
function ajax($code,$msg,$data = []){
    echo json_encode([
        'code' => $code,
        'msg' => $msg,
        'data' => $data
    ]);
    die();
}

/**
 * 对外开放的显示异常信息
 */
function error($info){
    throw new Exception('<h1>'.$info.'</h1><br/><p>'.$_SERVER['PHP_SELF'].' <p><hr/>');
    die();
}

/**
 * 实例化类，运行程序
 */
function runApp(){
    $a = strrpos($_SERVER['PHP_SELF'],'/')+1;
    $b = strrpos($_SERVER['PHP_SELF'],'.')+1;
    $className = substr($_SERVER['PHP_SELF'],$a,$b-$a-1);
    try{
        $c = new $className;
        $c->run();
    }catch(Exception $e){
        displayException($e);
    }
}

/**
 * 显示异常信息
 */
function displayException($e){
    //异常处理
    echo $e->getMessage();
    $trace = $e->getTrace();
    foreach($trace as $k => $v){
        echo 'In file: '.$v['file'].',line '.$v['line'].'<br/>';
        echo 'Error function: '.$v['function'].',error info: <br/>';
        if($v['args']){
            foreach($v['args'] as $kk => $vv){
                echo $kk.'.'.$vv.'<br/>';
            }
        }else{
            echo '[none]';
        }
        
        echo '<br/><hr/>';
    }
}

/**
 * 二维数组下某个键变成数组索引
 */
function keyToIndex($array,$keyName){
    foreach($array as $k => $v){
        $array_[$v[$keyName]] = $v;
    }

    return $array_;
}

/**
 * 生成订单号
 */
function appendOrderId(){
    $pre = 'order'.date('Ymd').'_'; //14
    $randStr = substr(md5(time()),0,18); //18
    return $pre.$randStr;
}