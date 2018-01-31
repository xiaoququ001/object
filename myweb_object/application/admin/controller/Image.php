<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\common\lib\Upload;
class Image extends Base
{
    public function upload0(){


    	$file = Request::instance()->file('file');
    	// halt($file);
    	//将上传文件放到指定文件夹下
    	$info = $file->move('upload');
    	if($info && $info->getPathname()){
    		$data=[
    			'status'=>1,
    			'message'=>'ok',
    			'data'=>'/'.$info->getPathname(),
    		];

    		echo json_encode($data);exit;
    	}

    		echo json_encode(['status'=>0,'message'=>'上传失败']);
    	// $data =[
    	// 	'status'=>1,
    	// 	'message'=>'ok',
    	// 	'data'=>'http://dl.bizhi.sogou.com/images/2012/01/19/174522.jpg',

    	// ];
    }
    /*七牛云的上传图片操作*/
    public function upload(){
    	try {
    		$image = Upload::image();
    	} catch (Exception $e) {
    		echo json_encode(['status'=>0,'message'=>$e->getMessage()]);
    	}
    	
    	//var_dump($image);
    	if($image){
    		$data=[
    			'status'=>1,
    			'message'=>'ok',
    			'data'=>config('qiniu.image_url').'/'.$image,
    		];
    		echo json_encode($data);exit;
    	}else{
    		echo json_encode(['status'=>0,'message'=>'上传失败']);
    	}
    }
}