<?php

/**
 * 客户端请求
 *
 * @author: moxiaobai
 * @since : 2015/5/15 14:11
 */

require_once __DIR__ . '/Library/Autoloader.php';

//项目名称
define("APP_PROJECT", 'cron');

//系统环境
define('APP_ENV', ini_get('yaf.environ'));

use Service\Task;

global $argv;
$type = $argv[0];

$client = new swoole_client(SWOOLE_SOCK_TCP);

$client->on("receive", function($cli, $data){
    echo "Received: ".$data."\n";
});

//发起网络连接
$ret = $client->connect('127.0.0.1', 9503, 0.5);
if(!$ret) {
    echo "Over flow. errno=". $client->errCode;
}

switch ($type) {
    case 'add':
        //添加数据
        $data = array(
            's_id'       => 4,
            's_interval' => 3000,
            's_title'    => '我去我去',
            's_url'      => 'http://www.yaf.com/index/dept',
            'u_id'       => 1
        );
        $buffer = array('type'=>'add', 'list'=>$data);

        break;
    case 'delete':
        //删除数据
        $delData = array('s_id'=>3, 's_timerId'=>3);
        $buffer  = array('type'=>'del', 'list'=>$delData);

        break;
    default:
        exit('未知操作');
        break;
}



$buffer  = json_encode($buffer) . "\r\n\r\n";
$client->send($buffer);


$ret =  $client->recv();
print_r(json_decode($ret, true));


