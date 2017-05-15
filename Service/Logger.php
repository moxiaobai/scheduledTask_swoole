<?php

/**
 *  日志系统类
 *
 * @author: moxiaobai
 * @since : 2015/5/7 12:06
 */

namespace Service;

use Library\Db\Mysql;

class Logger {

    /**
     * 定时器运行日志
     *
     * @param $data
     */
    public static function addTimerLog($data) {
        $db  = Mysql::instance('cron');
        $db->insert('t_log')->rows($data)->execute();
    }

}