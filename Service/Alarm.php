<?php

/**
 * 微信推送（http://sc.ftqq.com/3.version）
 */

namespace Service;

/**
 * 报警系统
 * 通知方式：短信通知、RTX通知、邮件通知
 *
 * @author: moxiaobai
 * @since : 2015/5/11 15:15
 */

class Alarm {

    const PUSH_SERVER = 'http://sc.ftqq.com/SCU60T29db0e2a2c17d9e3d4ec3e77d5a41a2055eee817beab5.send';

    /**
     * 报警：通知程序负责人处理
     *
     * @param $uid     程序员用户ID
     * @todo 通知方式自己实现
     * @return mixed
     */
    public static function noticeProgrammer($params) {
        $content = '';
        foreach($params as $val) {
            $content .= "* {$val} <br />";
        }
        $data  = array('text' => '定时程序执行失败', 'desp' => $content);
        return self::httpRequest(Alarm::PUSH_SERVER, $data);
    }


    /**
     * 报警：通知运维人员处理
     *
     * @todo   通知方式自己实现
     * @return mixed
     */
    public static function noticeOperational() {
        $data = array('text' =>'定时任务系统关闭');

        return self::httpRequest(Alarm::PUSH_SERVER, $data);

    }

    /**
     * Http请求
     *
     * @param $url
     * @param $data
     * @return mixed
     */
    private function httpRequest($url, $data) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}