<?php
/**
 * DB.php
 * User: Joe
 * Date: 2023/3/21
 * Time: 17:43
 */

namespace common;

class DB {
    public static function getRedisInstance() {
        return RedisHelper::getInstance();
    }

    public static function getMysqlInstance() {
        return MysqlPdoHelper::getInstance();
    }
}