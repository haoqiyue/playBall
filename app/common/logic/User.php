<?php

namespace app\common\logic;

/**
 * 会员逻辑
 */
class User extends LogicBase
{

    /**
     * 获取会员信息
     */
    public function getUserInfo($where = [], $field = true)
    {

        return $this->modelUser->getInfo($where, $field);
    }
}