<?php
/**
 * Created by PhpStorm.
 * @author: moxiaobai
 * @since: 2017/5/15  20:05
 */

$client = new swoole_client(SWOOLE_SOCK_TCP);
$ret = $client->connect('127.0.0.1', 9504, 0.5);
var_dump($ret);
if(!$ret) {
    throw new Exception($client->errCode);
}

$client->send("stop\r\n\r\n");
$result =  $client->recv();
var_dump($result);
