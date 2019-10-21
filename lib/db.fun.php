<?php
/*
--------
数据库函数库
--------
*/
function DbConnect(){

    $GLOBALS['link']=mysqli_connect(DBHOST,DBUSER,DBPASS,DBBASE);

	if($GLOBALS['link']==false){
		die(mysqli_error($GLOBALS['link']));
	}	
	mysqli_query($GLOBALS['link'],'SET NAMES utf8');
}

//关闭数据库
function DbClose(){
	mysqli_close($GLOBALS['link']);
}
//查询字段本身的详细信息
function DbFieldsInfo($table){
	//链接数据库
	DbConnect();
	//写sql语句
    $sql="show full columns from `$table`";
	//得到结果
    $result=DbFetchAll($sql);
	//关闭数据库
	DbClose();
	//返回结果
	return $result;
}
/* //获取一条
function DbFetchOne($sql){
	 //执行sql语句
    $query=mysqli_query($GLOBALS['link'],$sql);
	return mysqli_fetch_assoc($query);
} */
function DbFetchOne($sql){
	 //执行sql语句
    $query=mysqli_query($GLOBALS['link'],$sql);
	return mysqli_fetch_assoc($query);
}

//获取很多条
function DbFetchAll($sql){
	//var_dump($sql);
    //执行sql语句
    $query=mysqli_query($GLOBALS['link'],$sql);
	//var_dump($query);exit;
	//初始化一个数组放最后的结果
	$data=array();
	//用mysqli_fetch_assoc一条条的从执行结果中获取实际内容
	while($row=mysqli_fetch_assoc($query)){
		$data[]=$row;
	}	
	return $data;	
}

//查询全部数据库数据
function DbGetAll($table,$where='',$order='id DESC'){
	//where这个参数不是空的时候 
	if(empty($where)==false){
		$where='WHERE '.$where;
	}
	DbConnect();
	//写sql语句
    $sql="SELECT * FROM `$table` $where ORDER BY $order";
	//接受结果
	$result=DbFetchAll($sql);
	DbClose();
	//返回结果
	return $result;
}
//根据条件查询
function DbGetWhere($table,$where){
	//链接数据库
	DbConnect();

	//写sql语句
    $sql="SELECT * FROM `$table` WHERE $where";
    $result=DbFetchAll($sql);
	//关闭数据库
	DbClose();
	//返回结果
	return $result;
}
//根据id查询
function DbGetById($table,$id){
	//链接数据库
	DbConnect();
	//写sql语句
    $sql="SELECT * FROM `$table` WHERE id=$id";
	//得到结果
    $result=DbFetchOne($sql);
	//var_dump(mysqli_error($result));exit;
	//var_dump($result);exit;
	//关闭数据库
	DbClose();
	//返回结果
	return $result;
}
//插入数据库
function DbAdd($table,$data){
	//链接数据库
	DbConnect();
    $keyStr='';//初始化添加数据的下标字符串
	$valueStr='';//初始化添加数据的值字符串
	foreach($data AS $k=>$v){
		$keyStr.='`'.$k.'`,';
		$valueStr.="'$v',";
	}
	$keyStr=substr($keyStr,0,-1);
	$valueStr=substr($valueStr,0,-1);

    $sql="INSERT INTO `$table`($keyStr) VALUES($valueStr)";
	$query=mysqli_query($GLOBALS['link'],$sql);	
	//操作sql
    //var_dump(mysqli_error($GLOBALS['link']));
	//var_dump($sql);exit;
	//关闭数据库
	DbClose();
	//返回执行结果
	return $query;
}
//更新数据库
function DbSave($table,$data){
    //链接数据库
	DbConnect();
    $updateStr='';//初始化更新数据的字符串
	foreach($data AS $k=>$v){
		$updateStr.="$k='$v',";
	}
	$updateStr=substr($updateStr,0,-1);
	//写sql语句
	//var_dump($data);exit;
	//var_dump($data['id']);exit;
	extract($data);
    $sql="UPDATE `$table` SET $updateStr WHERE id=$id";
	//操作sql
	//var_dump($sql);exit;
	$query=mysqli_query($GLOBALS['link'],$sql);
	
	//关闭数据库
	DbClose();
	//返回执行结果
	return $query;
}
//删除数据库
function DbDel($table,$id){
	//链接数据库
	DbConnect();
	//写sql语句
    $sql="DELETE FROM `$table` WHERE id=$id";
	//操作sql
	$query=mysqli_query($GLOBALS['link'],$sql);
	//关闭数据库
	DbClose();
	//返回执行结果
	return $query;
}