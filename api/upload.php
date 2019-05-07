<?php
require_once('lib/entry.php');
class upload extends entry{
	public function __construct(){
		parent::__construct();
	}

	public function run(){
		$this->param('method');
		if(in_array($this->method,[
			'uploadImage'
		])){
			$this->{$this->method}();
		}else{
			error('error method：'.$this->method);
		}
    }
    
    /**
     * 上传文件接口
     */
    public function uploadImage(){
        if($_FILES){
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $tmp_file = $file['tmp_name'];
            $error = $file['error'];
            if($error == 0){
                $filename = 'upload/'.(rand(1,99999999).time()).$file_name;
                $upload = move_uploaded_file($tmp_file, $filename);
                if($upload){
                    ajax(0,'成功',[
                        'filename' => $filename
                    ]);
                }else{
                    ajax(-2,'上传失败');
                }
            }else{
                ajax(-1,'上传失败');
            }
        }else{
            ajax(-2,'请上传文件');
        }
    }
}

runApp();