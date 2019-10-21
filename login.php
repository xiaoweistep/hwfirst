<?php
	include('lib/init.php');

	if(empty($_POST) == false){
		
		extract($_POST);
		$_POST=alladdslashes($_POST);
	
		$password=md5($password);
		if(isset($email)){
			$result=DbGetWhere('hw_users',"`username`='$username' AND `password`='$password'  AND `email`='$email'");
		}else{
			$result=DbGetWhere('hw_users',"`username`='$username' AND `password`='$password'");
		}
		if($result != null){
			$_SESSION['hw_users']=$result[0];
			if($remember == 1){
			setcookie('hw_users',json_encode($_SESSION['hw_users']),time()+3600*5,'/');
			}
			echo  1;
		}else{
			echo 0;
		}		
		die;
	}

	include('templates/header.html');
	include('templates/login.html');






?>