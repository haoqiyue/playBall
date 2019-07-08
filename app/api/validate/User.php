<?php

namespace app\api\validate;

/**
 * 会员验证器
 */
class User extends ApiBase
{

    // 验证规则
    protected $rule = [
        'phone'  => 'require|max:11|/^1[34578]{1}[0-9]{9}$/',
        'code'  => 'require',
    ];

    // 验证提示
    protected $message = [
        'phone.require'    => '手机号不能为空',
        'phone.max:11|/^1[34578]{1}[0-9]{9}$/'    => '手机号格式错误',
        'code.require'    => '验证码不能为空',
    ];

    // 应用场景
    protected $scene = [
        'login'  =>  ['phone.require','phone.max:11|/^1[34578]{1}[0-9]{9}$/','code'],
    ];
}

