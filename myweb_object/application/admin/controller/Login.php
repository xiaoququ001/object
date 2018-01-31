<?php
	namespace app\admin\controller;
	use think\Controller;
	use app\common\lib\IAuth;
	class Login extends Base{

		public function _initialize(){

		}
		public function index(){
			$isLogin = $this->isLogin();
			if($isLogin){
				return $this->redirect('index/index');
			}else{
				return $this->fetch();
			}
		}

		public function check(){
			//获取传递的值
			if(request()->isPost()){
			$data = input('post.');
			$validate = validate('AdminUser');
			//dump($data);
			//检测验证码是否正确
			if(!captcha_check($data['code'])){
				return $this->error('验证码不正确');
			}

    		// halt($validate->check($data));
    		//检测输入信息
    		if(!$validate->check($data)){
			    $this->error($validate->getError());
			}
			try{
				$user = model('AdminUser')->get(['username'=>$data['username']]);
				//$res = Db::table('admin_user')->where('username','admin')->find();
				//dump($res);
				// halt($res);
				if(!$user || $user->status!=1){
					$this->error('该用户不存在');
				}
				if(IAuth::setPassword($data['password']) != $user['password']){
					//halt(md5($data['password']) );
					//halt($res['password']);
					$this->error('密码不正确');

				}

				$udata = [
					'last_login_time'=>time(),
					'last_login_ip'=>request()->ip(),
					];
					//halt($udata);
				model('AdminUser')->save($udata,['id'=>$user->id]);
			}catch(\Exception $e){
				$this->error($e->getMessage());
			}

		// //将用户信息保存到session中
			 session('adminuser',$user,'qjl_app');

			//halt($user);
			$this->success('登录成功','index/index');
		}else{
			$this->error('请求不合法');
		}
	}

	//用户退出操作
	public function logout(){
		//清除session信息
		session(null,'qjl_app');
		//跳转到登录页面
		$this->redirect('login/index');
	}
}