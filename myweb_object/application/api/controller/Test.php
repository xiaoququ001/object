<?php
namespace app\api\controller;
use think\Controller;
use think\Request;  
use think\controller\Rest;  
//use think\controller\Rest;
class Test extends  Rest
{
	public function index(){

		return [
			'qhj',
			'qujingl',
		];
	}

	public function update($id=0){
		echo $id;
	}
    public function save(){
    	return input("post.");
    }

}