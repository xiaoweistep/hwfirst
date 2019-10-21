<?php
$data='{
	"auth": {
		"identity": {
			"methods": ["password"],
			"password": {
				"user": {
					"name": "exampleuser：用户名称",
					"password": "Examplepassword123：用户密码",
					"domain": {
						"name": "用户所属账号的名称"
					}
				}
			}
		},
		"scope": {
			"domain": {
				"name": "exampledomain: 用户所属账号的名称"
			}
		}
	}
  }';



	//include('lib/init.php');
	//$data = 'searchType=mobile&searchKey=0086-13710245637';  
	$curlobj = curl_init();	
	curl_setopt($curlobj, CURLOPT_URL, "http://hwfirst.test/register.php");      
	curl_setopt($curlobj, CURLOPT_HEADER, 0); 
	curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt($curlobj, CURLOPT_POST, 1);  
	curl_setopt($curlobj, CURLOPT_POSTFIELDS, $data);  
	curl_setopt($curlobj, CURLOPT_HTTPHEADER, array("application/x-www-form-urlencoded; charset=utf-8", 
		"Content-length: ".strlen($data)
		));  

	date_default_timezone_set('PRC'); // 使用Cookie时，必须先设置时区
	curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查从证书中检查SSL加密算法是否存在
	curl_setopt($curlobj, CURLOPT_SSL_VERIFYHOST, 2); // 

	
	$rtn = curl_exec($curlobj);   
	var_dump($rtn);die;
	if(!curl_errno($curlobj)){
		// $info = curl_getinfo($curlobj); 
		// print_r($info);
		echo $rtn;  
	} else {
	  echo 'Curl error: ' . curl_error($curlobj);
	}
	curl_close($curlobj);

		die;




	

include('templates/header.html');
include('templates/register.html');




?>