<?php
/**
* IAuth相关文件
*/
namespace app\common\lib;

	class IAuth{
		/**
		* 设置密码
		*/
		public static function setPassword($data){
			return md5($data);
		}
	}
