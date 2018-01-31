<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class News extends Base
{

	public function index(){
		echo 'test';
	}
  	public function add(){
  		//判断是否是post进行提交
  		if(request()->isPost()){
  			$data = input('post.');

  			//入库操作
  			// $result = Db::table('ent_news')->insert($data);
  			// echo $result;
  			try {
  				$id = model("News")->add($data);
  			} catch (Exception $e) {
  				return $this->result('',0,'新增失败');
  			}
  
   			//判断是否插入成功
   			if($id){
  				return $this->result(['jump_url'=>url('news/index')],1,'添加成功');

   			}else{
   				return $this->result(['jump_url'=>url('News/index')],1,'添加失败');
   			}
  			//halt($info);
  			//echo json_encode($info);
  		}else{
  			return $this->fetch('',['cats'=>config('cat.lists')]);
  		}
  	}
}