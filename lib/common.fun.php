<?php
/*
--------
常用函数库
--------
*/
//检查登录
function CheckViewWetside(){
	if (defined('INCOMSITE')==false) {
		header('location:http://localhost/comsite1703/index.php');
	}
}
function CheckLogin(){
	//用if判断session是否有登录信息adminUser
	if(empty($_SESSION['adminUser'])==true){
		//如果session没有adminUser这个登录信息，但是cookie有
		if(isset($_COOKIE['adminUser'])){
			//用json_decode去还原cookie的登录信息到session里面adminUser里
			$_SESSION['adminUser']=json_decode($_COOKIE['adminUser'],true);
		}else{
			//否则就是session和cookie都没有登录信息，就强行跳转回登录页
		    // JumpError("请去登录",'admin/admin_login.php');
			echo '<script>alert("请去登录");window.location.href="http://localhost/comsite1703/index.php?c=admin&a=login&admin=1"</script>' ;	
		}
	}
	
}
//失败跳转
function JumpError($word,$url){
	echo '<script>alert("操作失败,'.$word.'");window.location.href="http://'.$_SERVER['HTTP_HOST'].'/'.$url.'"</script>';
}
//正确跳转
function JumpSuccess($word,$url){
	echo '<script>alert("操作成功,'.$word.'");window.location.href="http://'.$_SERVER['HTTP_HOST'].'/'.$url.'"</script>';
}


//组装后台导航
function GetAdminNav(){
	//获取导航全部信息
	$data=DbGetAll('nav');
	//初始化一个字符串   $a='123';  $b=''; $b.=$a;  $b=$b.$a
	$nav='';
	//遍历所有数据
	foreach($data AS $k=>$v){
		if($v['nav_top']==0 && $v['admin']==0){	
		    if(C==$v['nav_en']){
				  $topCurrent='current';
			}else{
				  $topCurrent=''; 
			}
			$nav.='<li> <a href="#" class="nav-top-item '.$topCurrent.'">'.$v['nav_cn'].'</a>';
			  $nav.='<ul>';
				foreach($data AS $key=>$value){
					if($value['nav_top']==$v['id'] && $v['admin']==0){
						//把nav_en用下划线切成两半  0=>C  1=>A
						$urlArr=explode('_',$value['nav_en']);
						if(A==$urlArr[1] && C==$urlArr[0] ){
							  $secondCurrent='class="current"';
						}else{
							  $secondCurrent=''; 
						}
				       $nav.='<li><a '.$secondCurrent.' href="http://localhost/comsite1703/index.php'.$value['nav_url'].'" >'.$value['nav_cn'].'</a></li>';
					}
				}
			  $nav.='</ul>';
			$nav.='</li>';
	    }
	}
	//字符串全部拼接完毕后 ，直接输出拼接结果
	echo $nav;
}

//组装前台导航
function GetHomeNav(){
	//获取导航全部信息
	$data=DbGetAll('nav','','id asc');
	//初始化一个字符串   $a='123';  $b=''; $b.=$a;  $b=$b.$a
	$nav='';
	$nav.='<a href="http://'.$_SERVER['HTTP_HOST'].'/index.php" id="menu_index" class="menu_current">首页</a>';
	//遍历所有数据
	foreach($data AS $k=>$v){
		if($v['nav_top']==0 && $v['admin']==1){	
		    if(C==$v['nav_en']){
				  $topCurrent='class="menu_current"';
			}else{
				  $topCurrent=''; 
			}
			$nav.='<a href="http://localhost/comsite1703/index.php'.$v['nav_url'].'" '.$topCurrent.'>'.$v['nav_cn'].'</a>';       
	    }
	}
	//字符串全部拼接完毕后 ，直接输出拼接结果
	echo $nav;
}
function alladdslashes($data){
	if(is_array($data)){
		foreach($data as $k=>$v){
			$data[$k]=addslashes($v);
		}
	}else{
		$data = addslashes($data);
	}
	return $data;
}