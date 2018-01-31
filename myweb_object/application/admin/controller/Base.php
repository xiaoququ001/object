<?php
	namespace app\admin\controller;
	use think\Controller;
	
	class Base extends Controller{

		//初始化
		public function _initialize(){
			//判断是否登录
			 $isLogin = $this->isLogin();
			if(!$isLogin){

				return $this->redirect('login/index');
			}

		}

		//判断是否登录
		public function isLogin(){
		
		
			//获取session信息
			$user = session('adminuser','','qjl_app');
			//halt($user);
			if($user && $user->id){
				return true;
			}
				return false;
      }

}