<?php

namespace model;

use Noodlehaus\ErrorException;

class UserModel extends BaseModel
{
    protected $table = 'user';
    protected $userBaseKey = null;
    protected $userBaseFriendListKey = null;
    public function __construct()
    {
        parent::__construct();
        $this->userBaseKey = $this->redis_keys['user_key'];
        $this->userBaseFriendListKey = $this->redis_keys['user_friend_list_key'];
    }

    /**
     * @throws ErrorException
     */
    public function setUser($params)
    {
        if ($params['name'] && $params['nid']) {
            $userKey = $this->userBaseKey . $params['nid'];
            if ($this->redis_object->get($userKey)) {
                throw new ErrorException('user already exists');
            } else {
                $this->redis_object->set($userKey, $params['name']);
            }
        } else {
            throw new ErrorException('user info error');
        }
        return 'success';
    }

    /**
     * @throws ErrorException
     */
    public function getFriendList($params) {
        if ($params['nid']) {
            $friendListKey = $this->userBaseFriendListKey . $params['nid'];
            $friendList = $this->redis_object->lrange($friendListKey, 0, -1);
            if ($friendList) {
                return $friendList;
            }
            throw new ErrorException('not friend list');
        }
        return [];
    }

    public function addFriend($params)
    {

    }
}