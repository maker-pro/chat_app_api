<?php
/**
 * Result.php
 * User: Joe
 * Date: 2023/3/21
 * Time: 17:13
 */

namespace common;

use libs\Conf;
use \Redis;

class RedisHelper
{
    private static $instance = null;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            $redis = new Redis();
            if (Conf::get('redis_host')) {
                define("REDIS_HOST", Conf::get('redis_host'));
                define("REDIS_PORT", Conf::get('redis_port'));
            } else {
                define("REDIS_HOST", '127.0.0.1');
                define("REDIS_PORT", 6379);
            }
            $redis->connect(REDIS_HOST, REDIS_PORT);
            if (Conf::get('redis_pwd')) {
                $redis->auth(Conf::get('redis_pwd'));
            }
            self::$instance = $redis;
        }
        return self::$instance;
    }

    public static function destoryInstance()
    {
        self::$instance = null;
    }
}
