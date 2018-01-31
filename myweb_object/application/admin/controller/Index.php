<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Base
{
    public function index()
    {
    	//加载首页模板
    	//halt(session('adminuser','','qjl_app'));
        return $this->fetch();
    }

    public function welcome(){
    	return $this->fetch();
    }

 }
