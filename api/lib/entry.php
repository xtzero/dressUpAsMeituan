<?php
    error_reporting(E_ALL);
    require_once('common.php');
    require_once('db.php');
    require_once('dbUtil.php');
    class entry{
        function __construct(){}
        
        function run(){
            error('没有定义run方法');
        }
        /**
         * 参数验证方法
         * @param $paramStr
         * @param $method
         * 
         * par1
         * *par1
         * *par1=123
         * par1>>int
         * *par1=123>>int
         *      ֧int、string、float、array
         */
        public function param($paramStr,$method = 'g'){
            $paramArr = explode(',',$paramStr);
            $needButNone = array();
            $successCount = 0;
            foreach($paramArr as $k => $v){
                /**
                 * paramConfirm('*par1=123,par2,*par3=123>>int',par2>>float)
                 * $k === 0
                 * $v === *par1=123
                 * 
                 * $k === 1
                 * $v === par2
                 * 
                 * $k === 2
                 * $v === *par3=123>>int
                 * 
                 * $k === 3
                 * $v === par2>>float
                 */
                $_key = trim($v);
                if(strpos($_key,'*') !== false){
                    $valueKind = false;
                    if(strpos($_key,'>>') !== false){
                        $_keyAndValueAndKind = explode('>>',$_key);
                        $_keyAndValue = $_keyAndValueAndKind[0];
                        $valueKind = $_keyAndValueAndKind[1];
                    }else{
                        $_keyAndValue = $_key;
                    }
                    $keyAndValue = explode('=',$_keyAndValue);
                    $key = substr(trim($keyAndValue[0]),1);
                    $defaultValue = trim($keyAndValue[1]);

                    if($method == 'p'){
                        @$value = $_POST[$key];
                    } else {
                        @$value = $_GET[$key];
                    }

                    if(isset($value)){
                        switch($valueKind){
                            case 'int'      : $value = (int)$value;break;
                            case 'float'    : $value = (float)$value;break;
                            case 'string'   : $value = (string)$value;break;
                            case 'array'    : $value = json_decode($value);break;
                        }
                        $this->{$key} = trim($value);
                        $successCount ++;
                    }
                    else if($defaultValue){
                        switch($valueKind){
                            case 'int'      : $defaultValue = (int)$defaultValue;break;
                            case 'float'    : $defaultValue = (float)$defaultValue;break;
                            case 'string'   : $defaultValue = (string)$defaultValue;break;
                            case 'array'    : $defaultValue = json_decode($defaultValue);break;
                        }
                    
                        $this->{$key} = $defaultValue;
                        $successCount ++;
                    }
                }else{
                    $valueKind = false;
                    if(strpos($_key,'>>') !== false){
                        $keyAndKind = explode('>>',$_key);
                        $key = $keyAndKind[0];
                        $valueKind = $keyAndKind[1];
                    } else{
                        $key = $_key;
                    }

                    if($method == 'p'){
                        @$value = $_POST[$key];
                    } else {
                        @$value = $_GET[$key];
                    }
                    
                    
                    if(isset($value)){
                        switch($valueKind){
                            case 'int'      : $value = (int)$value;break;
                            case 'float'    : $value = (float)$value;break;
                            case 'string'   : $value = (string)$value;break;
                            case 'array'    : $value = json_decode($value);break;
                        }
                        $this->{$key} = trim($value);
                        $successCount ++;
                    }else{
                        array_push($needButNone,$key);
                    }
                }
            }

            if(!empty($needButNone)){
                error('缺少参数：'.implode('、',$needButNone));
            }else{
                return $successCount;
            }
        }

        /**
         * 检查token方法
         */
        public function checkToken(){
            $this->param('token');
            $userinfo = tokenModel::getTokenInfo($this->token);
            if($userinfo){
                $this->__userinfo = $userinfo;
            }else{
                ajax(100001,'登录态已过期，请重新登录。');
            }
        }

        /**
         * 检查用户类型方法
         */
        public function checkUserType($needType){
            if($this->__userinfo){
                if(is_array($needType)){
                    if(!in_array($this->__userinfo['type'],$needType)){
                        ajax(100002,'用户类型不符合要求');
                    }
                }else{
                    if($this->__userinfo['type'] != $needType){
                        ajax(100003,'用户类型不符合要求');
                    }
                }
            }else{
                error('checkUserType之前请先checkToken!');
            }
        }
    }