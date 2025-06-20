<?php
/**
 * UserController.php
 * User: Joe
 * Date: 2023/3/21
 * Time: 14:37
 */

namespace App\Controller\MessageCenterApi\V1;

use App\Controller\BaseController;
use common\RequestParam;
use common\Result;
use model\UserModel;
use Noodlehaus\ErrorException;

class UserController extends BaseController
{
    public function setUser()
    {
        $params = RequestParam::post();
        $userModel = new UserModel();
        try {
            $this->returnResult($userModel->setUser($params));
        } catch (ErrorException $e) {
            $this->returnResult('', Result::UNKNOWN_ERROR, $e->getMessage());
        }
    }

    public function getFriendList($params)
    {
        $userModel = new UserModel();
        try {
            $this->returnResult($userModel->getFriendList($params));
        } catch (ErrorException $e) {
            $this->returnResult('', Result::UNKNOWN_ERROR, $e->getMessage());
        }
    }

    public function addFriend($params) {
        $userModel = new UserModel();
        try {
            $this->returnResult($userModel->addFriend($params));
        } catch (ErrorException $e) {
            $this->returnResult('', Result::UNKNOWN_ERROR, $e->getMessage());
        }
    }
}