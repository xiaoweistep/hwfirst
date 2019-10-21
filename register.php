<?php
	include('lib/init.php');
	if(empty($_POST)==false){

		extract($_POST);
		unset($_POST['choose_country_id']);
		unset($_POST['password_agin']);
		unset($_POST['agree']);
		$_POST['password']=md5($_POST['password']);
		$_POST['user_registered']=time();
		$query=DbAdd('hw_users',$_POST);
		if($query  > 0){
			include('gosuccess.php');
		}else{
			include('gofail.php');
		}
		exit;
	}
include('templates/header.html');
include('templates/register.html');




?>