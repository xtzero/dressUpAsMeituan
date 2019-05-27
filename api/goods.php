<?php
require_once('lib/entry.php');
class goods extends entry{
	public function __construct(){
		parent::__construct();
	}

	public function run(){
		$this->param('method');
		if(in_array($this->method,[
			'addGoods',
			'listGoods',
			'deleteGoods',
			'addPriceControl',
			'deletePriceControl',
            'listAllGoods'
		])){
			$this->{$this->method}();
		}else{
			error('error method：'.$this->method);
		}
	}

	/**
	 * 添加商品
	 */
	private function addGoods(){
		$this->param('shopId,name,*describe,price,*image');
		$this->checkToken();
		$this->checkUserType('admin');

		$res = goodsModel::addGoods($this->name,$this->price,$this->image,$this->shopId,$this->describe);
		if($res){
			ajax(0,'成功');
		}else{
			ajax(-1,'添加商品失败，请稍后重试');
		}
	}

	/**
	 * 列出商品
	 */
	private function listGoods(){
		$this -> param('shopId,*page=1');
		$res = goodsModel::listGoods($this->shopId,$this->page,10);
		ajax(0,'成功',$res);
	}

	/**
	 * 删除商品
	 */
	private function deleteGoods(){
		$this->param('goodId');
		$this->checkToken();
		$this->checkUserType('admin');

		$res = goodsModel::deleteGoods($this->goodId);
		if($res){
			ajax(0,'成功');
		}else{
			ajax(-1,'失败');
		}
	}

	/**
	 * 为商品添加改价机制
	 */
	public function addPriceControl(){
		$this->param('goodId,incOrDec,price,type,begin,end');
		$this->checkToken();
		$this->checkUserType('admin');

		$res = goodsModel::addPriceControl($this->goodId,$this->incOrDec,$this->price,$this->type,$this->begin,$this->end);
		switch($res){
			case -1: ajax(1,'该产品已经存在改价机制，请先删除再添加');break;
			case 1 : ajax(0,'成功');break;
			case 0 : ajax(-1,'系统繁忙，请稍后重试');break;
		}
	}

	/**
	 * 删除改价机制（恢复原价）
	 */
	public function deletePriceControl(){
		$this->param('goodId');
		$this->checkToken();
		$this->checkUserType('admin');

		$res = goodsModel::deletePriceControl($this->goodId);
		if($res){
			ajax(0,'成功');
		}else{
			ajax(-1,'系统繁忙，请稍后重试');
		}
	}

	public function listAllGoods() {
	    $this->checkToken();
	    $this->checkUserType('admin');

	    $res = goodsModel::listGoods(false,1,1000000);

        if($res){
            ajax(0,'成功',$res);
        }else{
            ajax(-1,'系统繁忙，请稍后重试');
        }
    }
}

runApp();