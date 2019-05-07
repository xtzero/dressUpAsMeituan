<?php
require_once('lib/entry.php');
class account extends entry{
	public function __construct(){
		crossDomain();
		parent::__construct();
	}

	public function run(){
		$this->param('method');
		switch($this->method){
			case 'signin': $this->signin();
			case 'login': $this->login();
			default: error('error method：'.$this->method);
		}
	}

	/**
	 * 注册
	 */
	private function signin(){
		$this->param('usr,pwd');
		if(accountModel::ifUserExist($this->usr)){
			ajax(1,'用户已存在');
		}else{
			$res = accountModel::addUser($this->usr,$this->pwd);
			if($res){
				ajax(0,'成功');
			}else{
				ajax(-1,'插入数据时出现错误，请稍后重试');
			}
		}
	}

	/**
	 * 登录
	 */
	private function login(){
		$this->param('usr,pwd');
		if(accountModel::ifUserExist($this->usr)){
			if($userinfo = accountModel::usrConfirm($this->usr,$this->pwd,true)){
				$today = date('Y-m-d H:i:s',time());
				$token = md5($this->usr.'|'.$today);
				$res = tokenModel::saveToken($token,$userinfo['id']);
				if($res){
					$userinfo = tokenModel::getTokenInfo($token);
					if($userinfo){
						$userinfo['token'] = $token;
						ajax(0,'成功',$userinfo);
					}else{
						ajax(-1,'插入数据时出现错误，请稍后重试',['ret' => -1]);
					}
				}else{
					ajax(-1,'插入数据时出现错误，请稍后重试',['ret' => -2]);
				}
			}else{
				ajax(2,'用户名或密码不正确');
			}
		}else{
			ajax(1,'用户不存在');
		}
	}
}

runApp();