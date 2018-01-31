<?php
namespace app\common\model;
use think\Model;

class Base extends Model{

	protected $autoWriteTimestamp = true;
	
	public function add($data){

		//判断是否为数组
		if(!is_array($data)){
			exception('传入数据不合法');
		}
		$this->allowField(true)->save($data);

		return $this->id;
	}
}