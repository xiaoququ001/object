<?php
namespace app\admin\controller;
use think\Controller;
class Admin extends Base
{
    public function add()
    {
    	//判断是否有是post提交
    	if(request()->isPost()){

    		 // dump(input('post.'));
    		$data = input('post.');
    		$validate = validate('AdminUser');
    		// halt($validate->check($data));
    		//检测输入信息
    		if(!$validate->check($data)){
			    $this->error($validate->getError());
			}

			$data['password'] = md5($data['password']);
			$data['status'] = 1;
			try {
				$id = model('AdminUser')->add($data);
			} catch (Exception $e) {
				$this->error($e->getMessage());
			}
			if($id){
				$this->success('id为'.$id.'添加成功');
			}else{
				$this->error($e->getMessage());

			}
			//dump($data);
			// //实例化model
			// model('AdminUser')->add(1);

			// if($id){
			// 	$this->success('id为'.$id.'添加成功');
			// }else{
			//	$this->error($e->getMessage());
			// }
			

    	}else{
    	//加载首页模板
       	 return $this->fetch();
   		}

	}
}