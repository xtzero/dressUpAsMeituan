<?php
require_once('lib/entry.php');
class money extends entry{
	public function __construct(){
		crossDomain();
		parent::__construct();
	}

	public function run(){
		$this->param('method');
		if(in_array($this->method,[
            'addMoney',
            'disMoney'
		])){
			$this->{$this->method}();
		}else{
			error('error method：'.$this->method);
		}
	}

	public function addMoney(){
        $this->checkToken();
        $this->checkUserType('admin');
        $this->param('userid,money');
        
        $res = moneyModel::addMoney($this->userid,$this->money);
        switch($res){
            case 1: ajax(1,'余额查询失败');
            case -1: ajax(-1,'充值失败，请稍后重试');
            case 0: ajax(0,'成功');
        }
    }

    public function disMoney(){
        $this->checkToken();
        $this->checkUserType('admin');
        $this->param('userid,money');
        
        $res = moneyModel::disMoney($this->userid,$this->money);
        switch($res){
            case 1: ajax(1,'余额查询失败');
            case 2: ajax(2,'余额不足');
            case -1: ajax(-1,'减少余额失败，请稍后重试');
            case 0: ajax(0,'成功');
        }
    }
}

runApp();