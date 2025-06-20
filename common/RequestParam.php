<?php
/**
 * RequestParam.php
 * User: Joe
 * Date: 2023/3/29
 * Time: 17:09
 */

namespace common;

class RequestParam
{
    /**
     * PHP 处理请求中所有的数据
     * @param $key
     * @return mixed|string
     */
    public static function requestAllParams($key = '')
    {
        $key = trim($key);
        if (empty($key)) {
            return $_REQUEST;
        }
        if (isset($_REQUEST[$key])) {
            return trim($_REQUEST[$key]);
        } else {
            return '';
        }
    }

    /**
     * PHP 处理 Get 数据
     * @param $key
     * @return mixed|string
     */
    public static function get($key = '')
    {
        $key = trim($key);
        if (empty($key)) {
            return $_GET;
        }
        if (isset($_GET[$key])) {
            return trim($_GET[$key]);
        } else {
            return '';
        }
    }

    /**
     * PHP 处理 Post 数据
     * @param $key
     * @return mixed|string
     */
    public static function post($key = '')
    {
        $key = trim($key);
        if (empty($key)) {
            return $_POST;
        }
        if (isset($_POST[$key])) {
            return trim($_POST[$key]);
        } else {
            return '';
        }
    }

    /**
     * PHP 处理 Request Payload 数据
     * @param $key
     * @return mixed|string
     */
    public static function requestPayload($key = '')
    {
        $key = trim($key);
        $request_payload_params = json_decode(file_get_contents('php://input'), true);
        if (empty($key)) {
            return $request_payload_params;
        }
        if (isset($request_payload_params[$key])) {
            return trim($request_payload_params[$key]);
        } else {
            return '';
        }
    }
}