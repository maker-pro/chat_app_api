<?php
/**
 * app.php
 * User: Joe
 * Date: 2023/3/21
 * Time: 15:15
 */

return [
    'name' => 'Admin',
    'debug' => false,

    // redis 配置
    'redis_host' => '127.0.0.1',
    'redis_port' => 6379,
    'redis_pwd' => 'eVzbbduRoh',

    // Mysql 配置
    'db_name' => 'chat_app',
    'db_host' => '127.0.0.1',
    'db_username' => 'chat_app',
    'db_pwd' => 'vQFPvsZE3',
    'db_port' => 3306,
    'db_encoding' => 'utf8mb4',

    'time_zone' => 'Asia/Shanghai',

    'redis_config' => [
        'user_key' => 'message_center:user:',
        'user_friend_list_key' => 'message_center:user:friend_list:',
        'user_room_list_key' => 'message_center:user:room_list:',

        'room_key' => 'message_center:room:',
        'room_user_list_key' => 'message_center:room:user_list:',
        'room_message_list_key' => 'message_center:room:message_list:',
        'room_message_list_length' => 100,
        'room_message_list_expire' => 86400,
        'room_message_list_expire_time' => 86400,
        'room_message_list_expire_time_key' =>'message_center:room:message_list:expire_time:'
    ]
];