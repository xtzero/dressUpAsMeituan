<?php
require_once('lib/entry.php');

class order extends entry
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $this->param('method');
        if (in_array($this->method, [
            'createOrder',
            'getOrderInfo',
            'gotOrder',
            'applyCloseOrder',
            'getClosingOrderList',
            'shopCloseOrder',
            'listMyOrder',
            'orderList'
        ])) {
            $this->{$this->method}();
        } else {
            error('error method：' . $this->method);
        }
    }

    /**
     * 创建订单
     */
    public function createOrder()
    {
        $this->param('goodsList,name,*phone,*addr=eat_in_shop');
        $this->checkToken();

        if ($this->addr != 'eat_in_shop' && !$this->phone) {
            ajax(-2, '请填写联系方式');
        }

        $res = orderModel::createOrder($this->goodsList, $this->__userinfo['userid'], $this->name, $this->phone, $this->addr);
        switch ($res) {
            case -1:
                ajax(-1, '创建订单时出现错误，请稍后重试');
                break;
            case 1:
                ajax(1, '订单中有已下架商品，请重新添加');
                break;
            case 2:
                ajax(2, '余额不足，请联系店家充值');
                break;
            default:
                ajax(0, '创建订单成功', [
                    'orderId' => $res
                ]);
        }
    }

    /**
     * 获取订单信息，包括商品列表
     */
    public function getOrderInfo()
    {
        $this->param('orderId');
        $this->checkToken();

        $res = orderModel::getOrderInfo($this->orderId);
        switch ($res) {
            case 1:
                ajax(1, '该订单不存在');
                break;
            default:
                ajax(0, '成功', $res);
        }
    }

    /**
     * 店家接单
     */
    public function gotOrder()
    {
        $this->param('orderId');
        $this->checkToken();
        $this->checkUserType('admin');

        $res = orderModel::gotOrder($this->orderId);
        if ($res) {
            ajax(0, '成功');
        } else {
            ajax(-1, '系统错误，请稍后重试');
        }
    }

    /**
     * 申请关闭订单
     */
    public function applyCloseOrder()
    {
        $this->param('orderId');
        $this->param('checkToken');

        $res = orderModel::applyCloseOrder($this->__userinfo['userid'], $this->orderId);
        switch ($res) {
            case 1:
                ajax(0, '成功');
                break;
            case -1:
                ajax(1, '该订单不存在');
                break;
            case 0:
                ajax(-1, '申请关闭订单时出现错误');
                break;
        }
    }

    /**
     * 获取申请关闭的订单
     */
    public function getClosingOrderList()
    {
        $this->param('*page=1');
        $this->checkToken();
        $res = orderModel::getClosingOrderList($this->__userinfo['userid'], $this->page, 10);
        if ($res) {
            ajax(0, '成功', $res);
        } else {
            ajax(1, '没有更多啦');
        }
    }

    /**
     * 店家关闭订单
     */
    public function shopCloseOrder()
    {
        $this->checkToken();
        $this->checkUserType('admin');
        $this->param('orderId');

        $res = orderModel::closeOrder($this->orderId);
        if ($res) {
            ajax(0, '成功');
        } else {
            ajax(1, '关闭订单失败，请稍后重试');
        }
    }

    /**
     * 订单列表
     */
    public function listMyOrder()
    {
        $this->checkToken();
        $res = orderModel::listOrder($this->__userinfo['userid']);

        if ($res) {
            ajax(0, '成功', $res);
        } else {
            ajax(1, '没有任何数据');
        }
    }

    /**
     * 全部的订单列表
     */
    public function orderList()
    {
        $this->checkToken();
        $res = orderModel::listOrder();
        if ($res) {
            ajax(0, '成功', $res);
        } else {
            ajax(1, '没有任何数据');
        }
    }
}

runApp();