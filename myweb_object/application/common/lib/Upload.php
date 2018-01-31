<?php

namespace app\common\lib;
//require '\qiniu\vendor\autoload.php';
//引入鉴权类
use Qiniu\Auth;
vendor('qiniu.autoload');  

//引入上传类
 use Qiniu\Storage\UploadManager;
	/**
	*七牛图片上传基类
	*
	**/
	class Upload{

		public static function image(){
			//判断上传是否成功
			//halt($_FILES['file']);
			$fileTmp = $_FILES['file']['tmp_name'];
			//echo $fileTmp;exit;
			$file = $_FILES['file']['name'];
			$img = explode('.',$file);
			//var_dump($img);exit;
			$ext = $img[1];

			if(empty($_FILES['file']['tmp_name'])){

				exception('您提交的图片不存在',404);
			}
			$config = config('qiniu');
			//构建鉴权对象
			// import('@.Common.Qiniu');
			$auth = new Auth($config['ak'],$config['sk']);
			//var_dump($auth);exit;
			//生成上传的token
			$upToken = $auth->uploadToken($config['bucket']);
			//echo $upToken;exit;
			//上传到七牛后保存的文件名
			$key = date('Y')."/".date('m')."/".substr(md5($fileTmp),0,5).date('Ymdhis').rand(0,9999).'.'.$ext;
			//echo $key;exit;
			// 构建 UploadManager 对象
			$uploadMgr = new UploadManager();
			list($ret, $err) = $uploadMgr->putFile($upToken,$key,$fileTmp);
			// halt($res);
			if($err !== null){
				return null;
			}else{
				return $key;
			}
		}
	}
