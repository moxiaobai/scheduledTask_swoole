<?php

namespace Service;

/**
 * 计划任务类
 *
 * @author: moxiaobai
 * @since : 2015/5/6 18:17
 */

use Library\Db\Mysql;

class Task {

    /**
     * 获取符合条件的任务列表
     */
    public static function getTaskList() {
        $db  = Mysql::instance('cron');
        $now = date('Y-m-d H:i:s');

        return $db->select('*')->from('t_schedule')
                        ->where("s_status = 1")
                        ->where("'{$now}' <= s_endTime")
                        ->order('s_id', 'ASC')
                        ->fetchAll();
    }

    /**
     * 更新任务定时器
     *
     * @param $taskId   任务ID
     * @param $timerId  定时器ID
     */
    public static function updateTimer($taskId, $timerId) {
        $db        = Mysql::instance('cron');
        $runTime   = date('Y-m-d H:i:s');

        $data = array('s_runTime'=>$runTime, 's_timerId'=>$timerId, 's_running_state'=>2);
        return $db->update('t_schedule')->rows($data)->where('s_id', $taskId)->execute();
    }

    /**
     * worker停止，清除所有定时器
     */
    public static function clearTimer() {
        $db        = Mysql::instance('cron');
        $stopTime   = date('Y-m-d H:i:s');

        $data = array('s_stopTime'=>$stopTime, 's_timerId'=>-1, 's_running_state'=>1);
        return $db->update('t_schedule')->rows($data)->where("1=1")->execute();
    }

    /**
     * 删除任务
     *
     * @param $taskId 任务ID
     * @return mixed
     * @throws Exception
     */
    public static function delTask($taskId) {
        $db        = Mysql::instance('cron');
        $stopTime  = date('Y-m-d H:i:s');

        $data = array('s_stopTime'=>$stopTime, 's_timerId'=>-1, 's_running_state'=>1);
        return $db->update('t_schedule')->rows($data)->where('s_id', $taskId)->execute();
    }
}