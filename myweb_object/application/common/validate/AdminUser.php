<?php
namespace app\common\validate;
use think\validate;

class AdminUser extends validate{
	 protected $rule =   [
        'username'  => 'require|max:25',
        'password' =>'require|max:25',
      
    ];
}