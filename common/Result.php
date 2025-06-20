<?php
/**
 * Result.php
 * User: Joe
 * Date: 2023/3/21
 * Time: 17:13
 */

namespace common;

class Result
{
    // 错误状态
    const ROUTE_ERROR = 4001;       				// 路由错误
    const ROUTE_ERROR_MSG = 'route error';       	// 路由错误描述
	
    const UNKNOWN_ERROR = 4004;     				// 未知错误
	const UNKNOWN_ERROR_MSG = 'unknown error';          // 未知错误

    const NOT_FOUND_TABLE = 5004;     				// 没有数据表错误
    const NOT_FOUND_TABLE_MSG = 'not found table';  // 没有数据表错误描述

    public static function toJson($data, $code = 200, $message = '')
    {
        echo json_encode([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
        die;
    }
}