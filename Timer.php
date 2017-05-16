<?php

/**
 * 计划任务系统
 *
 * @author: moxiaobai
 * @since : 2015/5/13 15:46
 */

require_once __DIR__ . '/Library/Autoloader.php';

//项目名称
define("APP_PROJECT", 'cron');

//系统环境
define('APP_ENV', ini_get('yaf.environ'));

use Service\Task;
use Service\Logger;
use Service\Alarm;
use Service\Curl;

class TimerServer {

    private $_server;

    public function __construct($cmd) {
        if($cmd === 'start') {
            $this->_server = new swoole_server("127.0.0.1", 9503);
            $this->_server->set(array(
                'worker_num'      => 1,   //必须设置为1
                'max_request'     => 10000,
                'open_eof_check'  => true,        //打开EOF检测
                'package_eof'     => "\r\n\r\n", //设置EOF
                'open_eof_split'  => true,        //启用EOF自动分包
                //'dispatch_mode'  => 2,
                'task_worker_num' => 2,
                'debug_mode'      => 1 ,
                'daemonize'       => true,
                'pid_file'        => __DIR__ . '/Log/swoole.pid',
                'log_file'        => __DIR__ . '/Log/swoole.log'
            ));

            //增加监听的端口
            $this->_server->addlistener("127.0.0.1", 9504, SWOOLE_SOCK_UDP);

            //设置事件回调
            $this->_server->on('Start',       array($this, 'onStart'));
            $this->_server->on('WorkerStart', array($this, 'onWorkerStart'));
            $this->_server->on('Receive',     array($this, 'onReceive'));
            $this->_server->on('Shutdown',    array($this, 'onShutdown'));
            $this->_server->on('Task',        array($this, 'onTask'));
            $this->_server->on('Finish',      array($this, 'onFinish'));

            $this->_server->start();
        } else {
            $this->manage($cmd);
        }
    }

    //主进程的主线程回调此函数
    public function onStart($server) {
        echo '服务器启动: ' . date('m-d H:i:s') . ' 主进程Pid:' . $server->master_pid . " 管理进程Pid:" . $server->manager_pid . PHP_EOL;

        //设置主进程名称
        swoole_set_process_name('scheduledTask');
    }

    //worker启动，初始化任务
    public function onWorkerStart(swoole_server $server , $worker_id) {
        // 在Worker进程开启时绑定定时器
        echo '定时任务启动: ' . date('Y-m-d H:i:s') . PHP_EOL;

        $taskList = Task::getTaskList();

        //获取所有符合条件的计划任务，添加定时器
        if($taskList) {
            foreach($taskList as $val) {

                //任务执行间隔时间
                $timeInterval = $val['s_interval'] * 1000;

                //添加定时器，返回定时器ID
                $timerId =  $server->tick($timeInterval, array($this, 'onTimer'), $val);

                //更新任务定时器ID
                Task::updateTimer($val['s_id'], $timerId);

                echo "[定时器ID: {$timerId}] ---- [任务ID: {$val['s_id']}] ----[启动时间:]" .  date('Y-m-d H:i:s') . PHP_EOL;

            }
        }
    }

    /**
     * 对外提供接口
     *
     * @param  $server      swoole_server对象
     * @param $fd           TCP客户端连接的文件描述符
     * @param $from_id      TCP连接所在的Reactor线程ID
     * @param $data         收到的数据内容
     */
    public function onReceive(swoole_server $server, $fd, $from_id, $data) {
        if(empty($data)) {
            // 发送数据给客户端，请求包错误
            $data = array('code'=>500, 'msg'=>'非法请求', 'data'=>null);
            $server->send($fd, json_encode($data));
        }

        //局域网管理
        $connectionInfo = $server->connection_info($fd, $from_id);
        if($connectionInfo['server_port'] == '9504') {
            $data = trim($data);
            switch($data) {
                case 'stop':
                    echo '关闭服务器: ' . date('Y-m-d H:i:s') . PHP_EOL;

                    $server->shutdown();
                    $server->send($fd, '服务器关闭成功');

                    break;
                case 'reload':
                    echo '重启所有worker进程: ' . date('Y-m-d H:i:s') . PHP_EOL;

                    $server->reload();
                    $server->send($fd, '服务器Worker重启成功');

                    break;
                case 'status':
                    $info = '';
                    $info  .= "\033[1A\n\033[K-----------------------\033[47;30m Swoole \033[0m-----------------------------\n\033[0m";
                    $info  .= 'Swoole version:' . SWOOLE_VERSION . "          PHP version:" . PHP_VERSION . "\n";
                    $info  .=  "------------------------\033[47;30m WORKERS \033[0m-------------------------------\n";
                    $info  .=  "\033[47;30muser\033[0m" . str_pad('',
                        14 - strlen('user')) . "\033[47;30mworker\033[0m" . str_pad('',
                        14 - strlen('worker')) . "\033[47;30mlisten\033[0m" . str_pad('',
                        14 - strlen('listen')). "\033[47;30mprocesses\033[0m \033[47;30m" . "status\033[0m\n";

                    echo "----------------------------------------------------------------\n";

                    $stats = $server->stats();
                    $server->send($fd, $info);

                    break;
                default:
                    $server->send($fd, '非法请求');

                    break;
            }

            //关闭Connection
            //$server->close($fd);

        } else {
            $data = json_decode($data, true);

            //任务数据
            $list = $data['list'];

            //请求类型
            $type = $data['type'];
            switch($type) {
                //添加定时器
                case 'add':
                    //添加定时器
                    $timeInterval = $list['s_interval'];
                    $taskId       = $list['s_id'];

                    $timerId =  $server->tick($timeInterval, array($this, 'onTimer'), $list);

                    //更新任务
                    Task::updateTimer($taskId, $timerId);

                    $data = array('code'=>200, 'msg'=>'添加定时器成功', 'data'=>null);
                    $server->send($fd, json_encode($data));
					
					echo "[添加定时器ID: {$timerId}] ---- [任务ID: {$list['s_id']}] ----[启动时间:]" .  date('Y-m-d H:i:s') . PHP_EOL;

                    break;
                //修改定时器
                case 'edit':
                    //修改url,定时器间隔时间

                    $data = array('code'=>200, 'msg'=>'修改定时器成功', 'data'=>null);
                    $server->send($fd,  json_encode($data));
                    break;

                //删除定时器
                case 'del':
                    //任务ID
                    $taskId  = $list['s_id'];

                    //定时器ID
                    $timerId = $list['s_timerId'];

                    //删除定时器
                    swoole_timer_clear($timerId);

                    //删除任务
                    Task::delTask($taskId);

                    $data = array('code'=>200, 'msg'=>'删除定时器成功', 'data'=>null);
                    $server->send($fd,  json_encode($data));

                    echo "[删除定时器ID: {$timerId}] ---- [任务ID: {$taskId}] ----[删除时间:]" .  date('Y-m-d H:i:s') . PHP_EOL;

                    break;


                default:
                    $data = array('code'=>500, 'msg'=>'非法请求1', 'data'=>null);
                    $server->send($fd, json_encode($data));

                    break;
            }
        }
    }

    //监听服务器关闭事件
    public function onShutdown(swoole_server $server) {
        echo '服务器关闭: ' . date('Y-m-d H:i:s') . PHP_EOL;

        //清除定时器记录
        Task::clearTimer();

        //通知运维人员
        Alarm::noticeOperational();
    }

    public function onTask(swoole_server $serv, $task_id, $from_id, $data) {

    }

    public function onFinish(swoole_server $serv, $task_id, $data) {

    }

    /**
     * 定时器回调方法
     *
     * @param $timerId    定时器ID
     * @param $params     参数
     */
    public function onTimer($timerId, $params) {
        //echo "[定时器ID: {$timerId}]----------->[执行时间:]" .  date('Y-m-d H:i:s') . PHP_EOL;

        $taskId       = $params['s_id'];        //任务ID
        $title        = $params['s_title'];     //任务名称
        $url          = $params['s_url'];       //任务Url
        $starTime     = $params['s_startTime'];  //任务开始执行时间
        $endTime      = $params['s_endTime'];  //任务结束时间
        //$uid          = $params['u_id'];        //定时任务负责人

        //判断程序是否在执行时间范围内
        $now = date('Y-m-d H:i:s');
        if($now >= $starTime && $now <= $endTime) {
            $responseResult = Curl::get($url);
            $result         = $responseResult['result'];
            $httpCode       = $responseResult['code'];
            $msg            = $responseResult['msg'];

            //判断http请求
            $status = 1;
            if(!is_null($msg) || $httpCode != 200) {
                $status = 2; //状态为2表示失败
                $result = $msg;
            }

            //判断是否按照要求输出数据
            if(is_null(json_decode($result, true))) {
                $status = 2; //状态为2表示失败
            } else {
                $returnData   = json_decode($result, true);
                $returnStatus = isset($returnData['status'])  ? $returnData['status'] : 1;
                if($returnStatus == 0) {
                    $status = 2;
                }
            }

            //运行出错，发送报警
            if($status == 2) {
                Alarm::noticeProgrammer($params);
            }

            //todo 任务运行日志
            $logData = array(
                'task_id'  => $taskId,
                'title'    => $title,
                'code'     => $httpCode,
                'status'   => $status,
                'result'   => $result,
                'addtime'  => date('Y-m-d H:i:s')
            );
            Logger::addTimerLog($logData);
        }
    }

    /**
     * 内网管理
     *
     * @param $cmd
     * @throws Exception
     */
    private function manage($cmd) {
        if(!in_array($cmd, array('start', 'stop', 'reload', 'status'))) {
            exit("Start parameter does not exist\n");
        }

        $client = new swoole_client(SWOOLE_SOCK_UDP, SWOOLE_SOCK_SYNC);
        $ret = $client->connect('127.0.0.1', 9504, 0.5);
        if(!$ret) {
            throw new Exception($client->errCode);
        }

        $client->send("{$cmd}\r\n\r\n");
        $ret =  $client->recv();
        echo $ret . PHP_EOL;
    }
}


global $argv;
$startFile = $argv[0];

if(!isset($argv[1])) {
    exit("Usage: php {$startFile} {start|stop|reload|status}\n");
}

new TimerServer($argv[1]);