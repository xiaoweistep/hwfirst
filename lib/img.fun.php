<?php
/*
--------
图片函数库
--------
*/
//上传   $datas 上传信息   
function Uploads($datas){
	 //上传区域不为空
     if($datas['error']==0){	 
		 //获取当前日期年月，组成文件夹名
		 $dir='Uploads/'.date('Y').'_'.date('m').'_'.date('d');
		 //如果没有这个文件夹就建立该文件夹.一定要先建好Uploads这个文件夹才行
		 //print_r($dir);exit; 
		 if(file_exists($dir)==false){
			 //mkdir — 新建目录   0777 全权限(可读，可写，可操作)
			 mkdir($dir,0777);
		 }
		 
		 
		 if(is_dir($dir)){
			 echo 'haode';
		 }else{
			 echo '失败';
		 }
		 
		 //获取文件后缀  ◾strpos — 查找字符串首次出现的位置    ◾stripos — 查找字符串首次出现的位置（不区分大小写）
		 $tail=substr($datas['name'],stripos($datas['name'],'.')+1);
		 //in_array判断一个值是否在某个数组内  如果找到则返回 TRUE，否则返回 FALSE。 
		 if(in_array($tail,array('jpg','jpeg','png','gif'))==false){

				echo '<script>alert("图片格式不支持");window.location.href="http://localhost/comsite1703/index.php?c=news&a=add&admin=1"</script>' ;
		 }
		 //组装上传文件名
		 $filename='dodi_'.md5($datas['name'].time()).'.'.$tail;	 
		 //move_uploaded_file(字符串 原来位置 , 字符串 指定位置);
		 $result=move_uploaded_file($datas['tmp_name'],$dir.'/'.$filename);
		 
		 //如果成功则返回 TRUE，失败返回 FALSE。 
		 if($result==false){
	
				echo '<script>alert("上传失败");window.location.href="http://localhost/comsite1703/index.php?c=news&a=add&admin=1"</script>' ;				 
		 }else{
			 //WaterMark($dir.'/'.$filename);
			 return $dir.'/'.$filename;
		 }
	 }elseif($datas['error']==4){
		 	echo '<script>alert("没有上传图片");window.location.href="http://localhost/comsite1703/index.php?c=news&a=add&admin=1"</script>' ;		
	 }
	
}
//水印
function WaterMark($photo,$pos='正中'){
	$pho='watermark.png';
	//$shuiyin0='shuiyin.gif';  
	$info= getimagesize($pho);  //获得图片的信息  0是宽 1是高  bits是位数  mime是类型
	$infos=getimagesize($photo);//获得水印的信息 	
	switch($infos['mime']){
		case 'image/png':
		    $photos= imagecreatefrompng($photo);       //打开图片   	    
		    break;
		case 'image/jpeg':
		    $photos= imagecreatefromjpeg($photo);       //打开图片   
		    break;
		case 'image/gif':
		    $photos= imagecreatefromgif($photo);       //打开图片          
		    break;			
	}

    switch($info['mime']){
		case 'image/png':
	        $shuiyin= imagecreatefrompng($pho);//打开水印 
		    break;
		case 'image/jpeg':
	        $shuiyin= imagecreatefromjpeg($pho);//打开水印
		    break;
		case 'image/gif':
	        $shuiyin= imagecreatefromgif($pho);//打开水印 
		    break;			
	}

	$avg_x=$infos[0]/3;       //对图片进行X轴的三等分  
	$avg_y=$infos[1]/3;      //对图片进行Y轴的三等分  
	  
	$width= array(0,$avg_x,$avg_x*2);        //九宫格X轴所有坐标  
	$height= array(0,$avg_y,$avg_y*2);
	//var_dump($width);
	//var_dump($height);exit;
	// 九宫格Y轴所有坐标  
    switch($pos){
		case '左上':
            $x=$width[0];
			$y=$height[0];
		    break;
		case '中上':
            $x=$width[1];
			$y=$height[0];
		    break;
		case '右上':
            $x=$width[2];
			$y=$height[0];
		    break;	
		case '左中':
            $x=$width[0];
			$y=$height[1];
		    break;
		case '正中':
            $x=$width[1];
			$y=$height[1];
		    break;
		case '右中':
            $x=$width[2];
			$y=$height[1];
		    break;	
		case '左下':
            $x=$width[0];
			$y=$height[2];
		    break;
		case '中下':
            $x=$width[1];
			$y=$height[2];
		    break;
		case '右下':
            $x=$width[2];
			$y=$height[2];
		    break;				
	}
	//imagecopymerge($photos,$shuiyin,$x,$y,0,0,$info[0],$info[1],35); //生成带水印的图片 imagecopymerge()函数合并图片 参数（图片,水印,水印在图片上的X轴位置,水印在图片上的Y轴位置,水印起始X轴,水印起始Y轴,水印终止X轴,水印终止Y轴,水印透明度）  
    imagecopy($photos,$shuiyin,$x,$y,0,0,$info[0],$info[1]);//水印图无法透明，但不会留白底
 	switch($info['mime']){
		case 'image/png':
		    header("content-type:image/png"); 
            imagepng($photos,$photo);			
		    break;
		case 'image/jpeg':   
		    header("content-type:image/jpeg");  
			imagejpeg($photos,$photo);      
		    break;
		case 'image/gif':
		    header("content-type:image/gif"); 		   
			imagegif($photos,$photo);       
		    break;			
	}   
	//一个参数时  imagejpeg($photo) 此时输出到浏览器                                          三个参数 imagejpeg($photo,'new.jpg',100) 此时保存到文件夹中,且 数值100 是保存的图片的质量 
	//销毁图像
	@imagedestroy($shuiyin);
	@imagedestroy($photos);	
}
//缩略图
function ThumbPhoto(){
	
	
}
/*
**随机字符 
**$num   随机字符数
*/
function RandCode($num){
		//字符串库  1lo0 
		$codLib=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');
		//抽取结果
		$result='';
		//随机抽$num个字符
		for($a=1;$a<=$num;$a++){
			//随机从0到最后一个字符中抽一个
			//rand  小于32768
			$result.=$codLib[rand(0, count($codLib)-1)];
		}
		return $result;
}
//验证码
function Vcode(){
	//1、画图像（新建图像）imagecreatetruecolor(宽，高)
	$im = imagecreatetruecolor(80,30);
	//2、画背景  
	// 为一幅图像分配颜色  imagecolorallocate(画布,0~255,0~255,0~255);
	$back_color = imagecolorallocate($im,250,250,250);	
    //填充矩形 imagefilledrectangle(画布,起点x坐标,起点y坐标,终点x坐标,终点y坐标,颜色);
    imagefilledrectangle($im,0,0,80,30,$back_color);
	//生成验证码的字
	$codeStr=RandCode(4);
    //保存验证字符
	$_SESSION['vcode']=strtolower($codeStr);
	//填充字(画布,文字大小,文字角度,x坐标,y坐标,文字颜色,字体库)
	$startX=5;
	$starty=20;
	for($i=0;$i<4;$i++){
		$text_color = imagecolorallocate($im, 0, 0, 0);	
		imagefttext($im, 15 ,0, $startX+10, $starty, $text_color, 'Public/simsunb.ttf', $codeStr[$i]);
		$startX+=15;
	}
	//画点
	for($i = 0;$i<100;$i++){
		//随机点颜色
		$point_color = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		//imagesetpixel(画布,点x,点y,点颜色)
		imagesetpixel($im,mt_rand(0,80),mt_rand(0,30),$point_color);
	}
    //画线
	for($i = 0;$i<5;$i++){
		//线颜色
		$line_color = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		//弧线绘制 imagearc(资源集,圆心x,圆心y,弧度宽,弧度高,角度,终点,弧线)
		imagearc($im,mt_rand(1,80),mt_rand(1,30),mt_rand(1,80),mt_rand(0,50),mt_rand(0,180),mt_rand(180,360),$line_color);
	}
	ob_clean(); //注意一定要写上这行，清缓存  
	//图片输出时候一定要设定编码
	header('Cache-Control:max-age=1,s-maxage=1,no-cache,must-revalidate');
	//image/png image/jpeg  
	header('Content-type:image/png;charset=utf8');	
	/*
	生成图片
	imagepng  png图
	imagejpeg 
	imagegif
	imagewbmp 
	*/
	imagepng($im);
	//销毁内存中临时生成图片
	imagedestroy($im);
	
}