<?php
/**
 * Conf.php
 * User: Joe
 * Date: 2023/3/21
 * Time: 15:13
 */

namespace libs;

use Noodlehaus\Config;

class Conf
{
    public static function all()
    {
        $conf = new Config(CONF_PATH);
        return $conf->all();
    }

    public static function get($conf_key)
    {
        $conf = new Config(CONF_PATH);
        return $conf->get($conf_key);
    }
}

