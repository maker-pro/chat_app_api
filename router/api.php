<?php
/**
 * api.php
 * User: Joe
 * Date: 2023/3/20
 * Time: 18:22
 */

//Param1 : 传值方式： GET/POST 大写
//Param2 : 参数：  / 斜杠就是没有参数（默认参数）
//Param3 : 命名空间+控制器@方法名：  这里我们后面会在dispath方法中定义默认在App/Controller、所以可以省略一部分命名空间

/** @var TYPE_NAME $r */
//$r->addRoute('GET', '/v1/category', 'MessageCenterApi\V1\BookController@index');
//$r->addRoute('GET', '/v1/category/{name}', 'MessageCenterApi\V1\BookController@index_name');
//$r->addRoute('GET', '/v1/category/{name}/{id:[0-9]+}', 'MessageCenterApi\V1\BookController@index_name_id');

$r->addRoute('POST', '/v1/set_user', 'MessageCenterApi\V1\UserController@setUser');
