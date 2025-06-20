<?php
/**
 * BaseController.php
 * User: Joe
 * Date: 2023/3/22
 * Time: 13:42
 */

namespace App\Controller;

use common\Result;

class BaseController
{
    public function returnResult($data, $code = 200, $message = '')
    {
        Result::toJson($data, $code, $message);
    }
}