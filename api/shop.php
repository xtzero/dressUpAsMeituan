<?php
require_once('lib/entry.php');
class shop extends entry{
	public function __construct(){
		parent::__construct();
	}

	public function run(){
		$this->param('method');
		if(in_array($this->method,[
            'listShop',
            'addShop',
			'delShop',
			'getShopInfo',
            'editShopInfo'
		])){
			$this->{$this->method}();
		}else{
			error('error method：'.$this->method);
		}
	}

	/**
	 * 添加商店
	 */
	private function addShop(){
		$this->param('name,*notice');
		$this->checkToken();
		$this->checkUserType('admin');

		$res = shopModel::addShop($this->name,$this->notice);
		if($res){
			ajax(0,'成功');
		}else{
			ajax(-1,'添加商品失败，请稍后重试');
		}
	}

	/**
	 * 列出商店
	 */
	private function listShop(){
		$this -> param('*page=ALL');
		$res = shopModel::listShop($this->page,10);
		ajax(0,'成功',$res);
	}

	/**
	 * 删除商店
	 */
	private function delShop(){
		$this->param('shopId');
		$this->checkToken();
		$this->checkUserType('admin');

		$res = shopModel::delShop($this->shopId);
		if($res){
			ajax(0,'成功');
		}else{
			ajax(-1,'失败');
		}
	}

	/**
	 * 获取店铺详情
	 */
	private function getShopInfo(){
		$this->param('shopId');

		$res = shopModel::getShopInfo($this->shopId);
		if($res){
			ajax(0,'成功',$res);
		}else{
			ajax(1,'没有获取到这个店铺');
		}
	}

    private function editShopInfo(){
	    $this->checkToken();
	    $this->param('shopId,key,value');

	    if (!in_array($this->key, ['name','descr','notice'])) {
	        ajax(1,'不允许修改这个字段');
        } else {
	        $res = shopModel::editShopInfo($this->shopId, $this->key, $this->value);
	        if ($res) {
	            ajax(0,'成功');
            } else {
	            ajax(-1, '修改店铺信息时出现错误，请稍后重试');
            }
        }
    }
}

runApp();