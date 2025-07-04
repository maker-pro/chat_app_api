<?php
/**
 * app.php
 * User: Joe
 * Date: 2023/3/20
 * Time: 18:17
 */

namespace bootstrap;

use common\Result;
use libs\Conf;

class App
{
    private static $routeInfo = [];

    public static function run()
    {
        self::denfDir();
        self::getUrl();
        self::route();
        self::whoops_error();
    }

    private static function denfDir()
    {
        define('ROOT_PATH', dirname(__DIR__) . '/');
        define('CONF_PATH', ROOT_PATH . 'config/');
        define('RESOURCE', ROOT_PATH . 'resource/');
        define('CACHE', ROOT_PATH . 'caching/');
    }

    private static function getUrl()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            include ROOT_PATH . 'router/api.php';
        });
        /** 下面都是基础实现的方法 在fast-router有**/
        // 获取传输类型以及.com后的参数
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];     // 路径后面不要加 "/", 不然会报错
        $uri = str_replace('//', '/', $uri);
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                Result::toJson([], Result::ROUTE_ERROR, 'route not found');
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                Result::toJson([], Result::ROUTE_ERROR, 'route method not allowed');
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                // ... call $handler with $vars
                break;
        }
        /** 上面都是基础实现的方法 在fast-router有**/
        //把对应的参数与控制器的关系放在静态变量方便分发
        self::$routeInfo = $routeInfo;
    }

    public static function whoops_error()
    {
        // whoops报错插件
        //根据app.php中的debug判断是否报错
        $bool = Conf::get('debug');
        if ($bool) {
            $whoops = new \Whoops\Run;
            $errorTitle = '框架出错了！';
            $option = new \Whoops\Handler\PrettyPageHandler();
            $option->setPageTitle($errorTitle);
            $whoops->pushHandler($option);
            $whoops->register();
            ini_set('display_error', 'On');
        } else {
            ini_set('display_error', 'Off');
        }
    }

    /**
     *  分发路由
     */
    public static function route()
    {
        if (self::$routeInfo[0] != 0) {
            //把方法、控制器根据@符号炸开
            $routerMessage = explode('@', self::$routeInfo[1]);
            //由于我们控制都是在app/的Controller里面我们这里为什么可以大写由于自动加载做了对应关系
            $controller = 'App\\Controller\\' . $routerMessage[0];
            $controller = str_replace('/', '\\', $controller);
            $action = $routerMessage[1];
            $obj = new $controller;
            try {
                if (isset(self::$routeInfo[2])) {
                    $obj->$action(self::$routeInfo[2]);
                } else {
                    $obj->$action();
                }
            } catch (\Exception $e) {
                Result::toJson([], Result::UNKNOWN_ERROR, $e->getMessage());
            }
        } else {
            Result::toJson([], Result::ROUTE_ERROR, Result::ROUTE_ERROR_MSG);
        }
    }
}