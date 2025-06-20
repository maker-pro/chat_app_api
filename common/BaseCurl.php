<?php
/**
 * BaseCurl.php
 * User: Joe
 * Date: 2023/3/27
 * Time: 14:04
 */

namespace common;

use libs\Conf;

class BaseCurl
{
    private static $proxy_ip = null;
    private static $proxy_port = null;

    public static function extensionConfiguration()
    {
        self::$proxy_ip = Conf::get('proxy_ip');
        self::$proxy_port = Conf::get('proxy_port');
    }

    public static function httpRequest($url, $header = null, $data = null, $proxy = false)
    {
        // 加载扩展
        self::extensionConfiguration();

        $curl = curl_init();
        if (!empty($header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_HEADER, 0);               //返回response头部信息
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        if ($proxy) {
            curl_setopt($curl, CURLOPT_PROXY, self::$proxy_ip);         //代理服务器地址
            curl_setopt($curl, CURLOPT_PROXYPORT, self::$proxy_port);   //代理服务器端口
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT_MS, 60000);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}
