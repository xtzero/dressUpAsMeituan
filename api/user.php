<?php
require_once('lib/entry.php');
class user extends entry{
	public function __construct(){
		crossDomain();
		parent::__construct();
	}

	public function run(){
		$this->param('method');
		if(in_array($this->method,[
			'getUserInfo',
			'setUserInfo',
			'addUserAddr',
			'listUserAddr',
			'deleteUserAddr',
			'wantGetMoney'
		])){
			$this->{$this->method}();
		}else{
			error('error method：'.$this->method);
		}
	}

	private function getUserInfo(){
		$this->param('*field=all');
		$this->checkToken();
		$res = userModel::getUserInfo($this->__userinfo['userid'],$this->field);
		if($res){
			ajax(0,'成功',$res);
		}else{
			ajax(1,'没有查询到结果',$this->__userinfo);
		}
	}

	private function setUserInfo(){
		$this->checkToken();
		$this->param('key,value');
		if(in_array($this->key,[
			'nickname',
			'icon'
		])){
			$res = userModel::setUserInfo($this->__userinfo['userid'],$this->key,$this->value);
			if($res){
				ajax(0,'成功');
			}else{
				ajax(-1,'修改失败，请稍后重试');
			}
		}else{
			ajax(1,'不支持修改的项目');
		}
	}

	private function addUserAddr(){
		$this->checkToken();
		$this->param('addr,name,phone');
		$res = userModel::addUserAddr($this->__userinfo['userid'],$this->addr,$this->name,$this->phone);
		if($res){
			ajax(0,'成功');
		}else{
			ajax(-1,'添加地址失败，请稍后重试');
		}
	}

	private function listUserAddr(){
		$this->checkToken();
		$res = userModel::getUserAddr($this->__userinfo['userid']);
		if($res){
			ajax(0,'成功',$res);
		}else{
			ajax(-1,'获取地址列表失败，请稍后重试');
		}
	}

	private function deleteUserAddr(){
		$this->checkToken();
		$this->param('addrId');
		$res = userModel::deleteUserAddr($this->__userinfo['userid'],$this->addrId);
		switch($res){
			case 0: ajax(0,'成功');break;
			case 1: ajax(1,'该地址不存在');break;
			case -1: ajax(-1,'删除地址失败，请稍后重试');break;
		}
	}

	/**
	 * 申请提现
	 */
	public function wantGetMoney(){
		$this->checkToken();
		$this->param('money');
		$res = moneyModel::wantGetMoney($this->__userinfo['userid'],$this->money);
		switch($res){
			case 1: ajax(1,'余额查询失败');break;
			case 2: ajax(2,'余额不足');break;
			case 3: ajax(3,'提交申请失败，请稍后重试');break;
			case -1: ajax(4,'扣除余额失败，请稍后重试');break;
			case 0: ajax(0,'成功');break;
		}
	}

	public function getAllWantGetMoney(){
		$this->checkToken();
		$this->checkUserType();
	}

	public function processGetMoney(){
		$this->checkToken();
		$this->param('getMoneyId');
	}
}

runApp();