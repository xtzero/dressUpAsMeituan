<?php
/**
 * 账号相关model
 */
class accountModel{
	/**
	 * 检查用户是否存在
	 */
	public static function ifUserExist($usr){
		$res = db::init() -> query("SELECT * FROM user WHERE usr='{$usr}' AND valid=1",true);
		if($res){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * 用户直接存入数据库
	 */
	public static function addUser($usr,$pwd){
		$today = date('Y-m-d H:i:s',time());
		$pwd = md5(md5($pwd));
		$res = db::init() -> query("INSERT INTO user(usr,pwd,valid,create_at,update_at) VALUES('{$usr}','{$pwd}',1,'{$today}','{$today}');");
		return $res;
	}

	/**
	 * 检查用户密码 
	 */
	public static function usrConfirm($usr,$pwd,$returnUserInfo = false){
		$pwd = md5(md5($pwd));
		$res = db::init() -> query("SELECT * FROM user WHERE usr='{$usr}' AND pwd='{$pwd}' AND valid=1;",true);
		if($res){
			if($returnUserInfo){
				return $res[0];
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
}

/**
 * token相关
 */
class tokenModel{
	/**
	 * 获取token信息
	 */
	public static function getTokenInfo($token){
		$today = date('Y-m-d H:i:s',time());
		$fields = 'user.id as userid,user.usr,user.nickname,user.icon,user.type';
		$res = db::init() -> query("SELECT {$fields} FROM token LEFT JOIN user ON token.userid=user.id WHERE token.token='{$token}' AND token.die_at>'{$today}' AND user.valid=1;",true);
		if($res){
			return $res[0];
		}else{
			return false;
		}
	}

	/**
	 * 存入token
	 */
	public static function saveToken($token,$userid){
		$today = date('Y-m-d H:i:s',time());
		$sevenDaysAfter = date('Y-m-d H:i:s',time() + 604800);
		$res = db::init() -> query("INSERT INTO token(userid,token,create_at,die_at) VALUES({$userid},'{$token}','{$today}','{$sevenDaysAfter}');");
		if($res){
			return true;
		}else{
			return false;
		}
	}
}

/**
 * 商品相关
 */
class goodsModel{
	/**
	 * 添加商品
	 */
	public static function addGoods($name,$price,$image = '',$shopId,$describe = ''){
		$today = date('Y-m-d H:i:s',time());
		$sql = "INSERT INTO goods(shopId,`name`,create_at,price,image,valid,`describe`) VALUES({$shopId},'{$name}','{$today}',{$price},'{$image}',1,'{$describe}');";
		$res = db::init() -> query($sql);
		return (bool)$res;
	}

	/**
	 * 列出商品
	 */
	public static function listGoods($shopId = FALSE,$page = 1,$pageLimit = 1000000){
		$beginIndex = ($page - 1) * $pageLimit;

		//要取到所有的商品
        if ($shopId) {
            $sql = "SELECT * FROM goods WHERE shopId={$shopId} AND valid=1 LIMIT {$beginIndex},{$pageLimit}";
        } else {
            $sql = "SELECT * FROM goods WHERE valid=1 LIMIT {$beginIndex},{$pageLimit}";
        }

		$goodsArr = db::init() -> query($sql,true);

		if($goodsArr){
			//所有商品id的字符串
			$goodIdsStr = implode(',',array_keys(keyToIndex($goodsArr,'id')));
			$goodsArr = self::calcPrice($goodsArr);
		}

		$shopsSql = "SELECT * FROM shop WHERE id IN ({$goodIdsStr});";
		$shops = db::init() -> query($shopsSql, true);

		if ($shops) {
		    $shops = keyToIndex($shops, 'id');
		    foreach ($goodsArr as $k => $v) {
		        $goodsArr[$k]['shopname'] = $shops[$v['shopId']]['name'];
            }
        }

		return $goodsArr;
	}

	/**
	 * 计算物品列表的价格
	 */
	public static function calcPrice($goodsArr){
		//所有商品id的字符串
		$goodIdsStr = implode(',',array_keys(keyToIndex($goodsArr,'id')));
			
		//获取所有相关的改价机制
		$sql = "SELECT * FROM good_price_control WHERE goodId IN ({$goodIdsStr}) AND valid=1 AND begin_at<now() AND end_at>now()";
		$allPriceControls = db::init() -> query($sql,true);
		if($allPriceControls){
			$allPriceControls_ = keyToIndex($allPriceControls,'goodId');
			// echo '全部的价格控制：<br/>';
			// var_dump($allPriceControls_);
			// echo '<br/>全部的物品<br/>';
			// var_dump($goodsArr);
			foreach($goodsArr as $k => $v){
				//处理改价机制
				
				// echo '<br/>物品'.$k.'<br/>';
				// var_dump($v);

				if(!$allPriceControls_[$v['id']]){
					continue;
				}
				
				//原始价格
				$oriPrice = $v['price'];
				
				//涨价/降价的方式。1是增/减n元，2是打n折，3是直接变成n
				$type = $allPriceControls_[$v['id']]['type'];
				//涨价或者降价，1是降价，2是涨价
				$incOrDec = $allPriceControls_[$v['id']]['incOrDec'];
				//涨价降价的数值
				$priceNum = $allPriceControls_[$v['id']]['price'];

				switch($type){				
					//1是增/减n元
					case 1: {
						if($incOrDec == 1){
							$newPrice = $oriPrice - $priceNum;
						}else{
							$newPrice = $oriPrice + $priceNum;
						}
					}break;

					//2是打n折
					case 2: {
						if($incOrDec == 1){
							$newPrice = $oriPrice * ($priceNum / 10);
						}else{
							$newPrice = $oriPrice * $priceNum;
						}
					}break;

					//3是直接变成n
					case 3: {
						$newPrice = $priceNum;
					}break;
				}

				$goodsArr[$k]['newPrice'] = $newPrice;

				//开始时间
				$goodsArr[$k]['priceChangeBeginAt'] = $allPriceControls_[$v['id']]['begin_at'];
				//结束时间
				$goodsArr[$k]['priceChangeEndAt'] = $allPriceControls_[$v['id']]['end_at'];

                $goodsArr[$k]['priceChangePrice'] = $allPriceControls_[$v['id']]['price'];
                $goodsArr[$k]['priceChangeType'] = $allPriceControls_[$v['id']]['type'];
                $goodsArr[$k]['priceChangeIncOrDec'] = $allPriceControls_[$v['id']]['incOrDec'];
			}
		}

		return $goodsArr;
	}

	/**
	 * 删除商品
	 */
	public static function deleteGoods($goodsId){
		$sql = "UPDATE goods SET valid=0 WHERE id={$goodsId};";
		$res = db::init() -> query($sql);
		return $res;
	}

	/**
	 * 为商品添加价格控制
	 */
	public static function addPriceControl($goodId,$incOrDec,$price,$type,$begin,$end){
		$sql = "SELECT * FROM good_price_control WHERE goodId={$goodId} AND begin_at<now() AND end_at>now() AND valid=1;";
		$ifExistPriceControl = db::init() -> query($sql,true);
		if($ifExistPriceControl){
			return -1;
		}else{
			$sql = "INSERT INTO good_price_control(goodId,incOrDec,price,type,create_at,begin_at,end_at,valid) VALUES({$goodId},{$incOrDec},{$price},{$type},'now()','{$begin}','{$end}',1);";
			$res = db::init() -> query($sql);
			return (bool)$res?1:0;
		}
	}

	/**
	 * 商品恢复原价
	 */
	public static function deletePriceControl($goodsId){
		$sql = "UPDATE good_price_control SET valid=0 WHERE goodId={$goodsId};";
		$res = db::init() -> query($sql);
		return (bool)$res;
	}
}

/**
 * 订单相关
 */
class orderModel{
	/**
	 * 创建订单
	 */
	public static function createOrder($goodIds,$userid,$name,$phone,$addr){
		$orderId = appendOrderId();
		$goodsArr = db::init() -> query("SELECT * FROM goods WHERE id IN ({$goodIds}) AND valid=1;",true);
		$goodsIdsValidIs1 = implode(',',array_keys(keyToIndex($goodsArr,'id')));
		if(strlen($goodIds) == strlen($goodsIdsValidIs1)){
			//计算好的商品列表
			$goodsArr_ = goodsModel::calcPrice($goodsArr);

			//计算原价和订单价
			$oriPrice = 0;
			$price = 0;
			foreach($goodsArr_ as $k => $v){
				$oriPrice += $v['price'];

				if($v['newPrice']){
					$price += $v['newPrice'];
				}else{
					$price += $v['price'];
				}
			}

			if(moneyModel::disMoney($userid,$price,$reason = 'system dis') === 0){
				//保存订单信息
				$saveOrderSql = "INSERT INTO `order`(id,userid,create_at,ori_price,price,name,phone,addr) VALUES('{$orderId}',{$userid},now(),{$oriPrice},{$price},'{$name}','{$phone}','{$addr}');";
				$saveOrder = db::init() -> query($saveOrderSql);

				//保存订单物品信息
				$saveOrderGoodsSql = "INSERT INTO `order_goods`(orderId,goodId,create_at,ori_price,price) VALUES";
				$saveOrderGoodsSqlTailArr = [];
				foreach($goodsArr_ as $k => $v){
					if($v['newPrice']){
						$price = $v['newPrice'];
					}else{
						$price = $v['price'];
					}

					$oriPrice = $v['price'];

					array_push($saveOrderGoodsSqlTailArr,"('{$orderId}',{$v['id']},now(),{$oriPrice},{$price})");
				}

				$saveOrderGoodsSql .= implode(',',$saveOrderGoodsSqlTailArr);
				$saveOrderGoods = db::init() -> query($saveOrderGoodsSql);

				if($saveOrder && $saveOrderGoods){
					return $orderId;
				}else{
					return -1;
				}		
			}else{
				//余额不足
				return 2;
			}
		}else{
			//有商品已下架
			return 1;
		}
	}

	/**
	 * 查看订单信息
	 */
	public static function getOrderInfo($orderId){
		$orderInfoSql = "SELECT * FROM `order` WHERE id='{$orderId}' AND valid=1;";
		$orderInfo = db::init() -> query($orderInfoSql,true);
		if($orderInfo){
			$orderGoodsSql = "SELECT * FROM order_goods og LEFT JOIN goods AS g ON og.goodId=g.id WHERE og.orderId='{$orderId}';";
			$orderGoods = db::init() -> query($orderGoodsSql,true);
			
			$orderInfo['goodsList'] = $orderGoods;

			return $orderInfo;
		}else{
			//该订单不存在
			return 1;
		}
	}

	/**
	 * 店家接单
	 */
	public static function gotOrder($orderId){
		$sql = "UPDATE order SET status=1 WHERE id={$orderId} AND status=2 AND valid=1;";
		$res = db::init() -> query($sql);

		return (bool)$res;
	}

	/**
	 * 用户申请关闭订单
	 */
	public static function applyCloseOrder($userid,$orderId){
		$orderExistSql = "SELECT * FROM order WHERE id={$orderId} AND userid={$userid} AND valid=1;";
		$orderExist = db::init() -> query($orderExistSql);

		if($orderExist){
			$closeOrderSql = "UPDATE order SET status=-1 WHERE id={$orderId} AND userid={$userid} AND valid=1";
			$closeOrder = db::init() -> query($closeOrderSql);
			if($closeOrder){
				return 1;
			}else{
				return 0;
			}
		}else{
			//订单不存在
			return -1;
		}
	}

	/**
	 * 获取待关闭的订单
	 */
	public static function getClosingOrderList($userid,$page,$pageLimit = 10){
		$beginIndex = ($page - 1) * $pageLimit;
		$fields = '*';
		$listSql = "SELECT {$fields} FROM order WHERE userid={$userid} AND valid=1 LIMIT {$beginIndex},{$pageLimit};";
		$list = db::init() -> query($listSql,true);

		return $list;
	}

	/**
	 * 关闭订单
	 */
	public function closeOrder($orderId){
		$sql = "UPDATE order SET status=0 WHERE id={$orderId} AND valid=1;";
		$res = db::init() -> query($sql);

		return (bool)$res;
	}

	/**
	 * 订单列表
	 */
	public static function listOrder($userid = false){
	    if ($userid) {
            $sql = "SELECT * FROM `order` WHERE userid={$userid} AND valid=1";
        } else {
            $sql = "SELECT * FROM `order` WHERE valid=1";
        }

		$res = db::init()->query($sql,true);

		if($res){
			foreach($res as $k => $v){
				$orderId = $v['id'];
				$goodSql = "SELECT * FROM order_goods og LEFT JOIN goods AS g ON og.goodId=g.id WHERE og.orderId='{$orderId}';";
				$goods = db::init() -> query($goodSql,true);
				$res[$k]['goods'] = $goods;
			}	

			return $res;
		}else{
			return false;
		}
	}
}

/**
 * 商店相关
 */
class shopModel{
	public static function addShop($name,$notice = ''){
		$sql = "INSERT INTO shop(name,notice,create_at,valid) VALUES('{$name}','{$notice}',now(),1);";
		$res = db::init() -> query($sql);
		return (bool)$res;
	}

	public static function listShop($page = 1,$pageLimit = 10){
		$fields = 'id,name,notice,create_at';
		if($page == "ALL"){
			$sql = "SELECT {$fields} FROM shop WHERE valid=1;";
		}else{
			$beginIndex = ($page - 1) * $pageLimit;
			$sql = "SELECT {$fields} FROM shop WHERE valid=1 LIMIT {$beginIndex},{$pageLimit};";
		}
		
		
		$res = db::init() -> query($sql,true);
		return $res;
	}

	public static function delShop($shopId){
		$sql = "UPDATE shop SET valid=0 WHERE id={$shopId};";
		$res = db::init() -> query($sql);
		return (bool)$res;
	}

	public static function getShopInfo($shopId){
		$sql = "SELECT * FROM shop WHERE id={$shopId} AND valid=1;";
		$res = db::init() -> query($sql,true);
		if($res){
			return $res[0];
		}else{
			return false;
		}
	}

	public static function editShopInfo($shopId,$key,$value){
	    $sql = "UPDATE shop SET {$key}='{$value}' WHERE id={$shopId};";
	    $res = db::init() -> query($sql);
	    return $res;
    }
}

/**
 * 用户信息相关
 */
class userModel{
	public static function getUserInfo($userid,$field = '*'){
		if($field == 'all'){
			$field = 'id,usr,nickname,icon,restMoney';
		}

		$sql = "SELECT {$field} FROM user WHERE id={$userid} AND valid=1;";
		$res = db::init() -> query($sql,true);
		if($res){
			return $res[0];
		}else{
			return false;
		}
	}

	public static function setUserInfo($userid,$key,$value){
		$sql = "UPDATE user SET {$key}='{$value}' WHERE id={$userid} AND valid=1;";
		$res = db::init() -> query($sql);
		return $res;
	}

	public static function addUserAddr($userid,$addr,$name,$phone){
		$sql = "INSERT INTO user_addr(userid,addr,name,phone,valid,create_at) VALUES({$userid},'{$addr}','{$name}','{$phone}',1,now());";
		$res = db::init() -> query($sql);
		return $res;
	}

	public static function getUserAddr($userid){
		$sql = "SELECT * FROM user_addr WHERE userid={$userid} AND valid=1;";
		$res = db::init() -> query($sql,true);
		if($res){
			return $res;
		}else{
			return false;
		}
	}

	public static function deleteUserAddr($userid,$addrId){
		$ifBelongSql = "SELECT id FROM user_addr WHERE id={$addrId} AND userid={$userid} AND valid=1;";
		$ifBelong = db::init() -> query($ifBelongSql,true);
		if($ifBelong){
			$sql = "UPDATE user_addr SET valid=0 WHERE id={$addrId} AND valid=1";
			$res = db::init() -> query($sql);
			return (bool)$res?0:-1;
		}else{
			//这个地址不属于这个用户，或者是不存在
			return 1;
		}
	}

	public static function listAllUser(){
	    $sql = "SELECT * FROM user";
	    $res = db::init() -> query($sql,true);

	    return $res;
    }
}

/**
 * 余额相关
 */
class moneyModel{
	public static function addMoney($userid,$money,$reason = 'system add'){
		$restMoney = userModel::getUserInfo($userid,'restMoney');
		if($restMoney){
			$sql1 = "UPDATE user SET restMoney=restMoney+{$money} WHERE id={$userid} AND valid=1;";
			$r = $restMoney['restMoney'] + $money;
			$sql2 = "INSERT INTO money_log(userid,money,afterChange,create_at,reason) VALUES({$userid},{$money},{$r},now(),'{$reason}');";

			$res = db::init() -> trans([$sql1,$sql2]);
			return $res?0:-1;
		}else{
			//余额查询失败
			return 1;
		}
	}

	public static function disMoney($userid,$money,$reason = 'system dis'){
		$restMoney = userModel::getUserInfo($userid,'restMoney');
		if($restMoney){
			$r = $restMoney['restMoney'] - $money;
			if($r >= 0){
				$sql1 = "UPDATE user SET restMoney=restMoney-{$money} WHERE id={$userid} AND valid=1;";
				$money = $money * -1;
				$sql2 = "INSERT INTO money_log(userid,money,afterChange,create_at,reason) VALUES({$userid},{$money},{$r},now(),'{$reason}');";

				$res = db::init() -> trans([$sql1,$sql2]);
				return $res?0:-1;	
			}else{
				//余额不足
				return 2;
			}
		}else{
			//余额查询失败
			return 1;
		}
	}

	public function wantGetMoney($userid,$money){
		$disMoney = self::disMoney($userid,$money,'apply gey money');
		if($disMoney == 0){
			$addLogSql = "INSERT INTO want_get_money(userid,money,create_at,valid) VALUES({$userid},{$money},now(),1);";
			$res = db::init() -> query($addLogSql);
			if($res){
				return 0;
			}else{
				return 3;
			}
		}else{
			return $disMoney;
		}
	}
}