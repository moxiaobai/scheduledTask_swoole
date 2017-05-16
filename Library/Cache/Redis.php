<?php

namespace Library\Cache;

/**
 * Class Redis
 * @package Library\Cache
 */
class Redis {

    /**
     * 实例化的Redis对象
     * @var Redis
     */
    private static $_instance = array();

    /**
     * 实例化的Memcache对象
     *
     * @var Redis
     * @return \Redis
     */
    public static function instance()
    {
        $project = APP_PROJECT;
        $config = \Yaconf::get("{$project}." . APP_ENV);
        if (!isset($config)) {
            throw new \Exception("Redis Config not set");
        }

        if (!isset(self::$_instance[$project])) {
            if (extension_loaded('Redis')) {
                self::$_instance[$project] = new \Redis();
            } else {
                throw new \Exception("extension Redis is not installed");
            }

            self::$_instance[$project]->connect($config['host'], $config['port']);
            if(isset($config['pwd']) && $config['pwd']){
                self::$_instance[$project]->auth($config['pwd']);
            }
        }

        return self::$_instance[$project];
    }

}