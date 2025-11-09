<!doctype html>
<html>
<head>

<title>2017年10-11月　店舗の絆強化コンテスト　報奨旅行| ネッツトヨタ東京株式会社 | 近畿日本ツーリスト</title>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
 <meta name="keywords" content="" />
 <meta name="description" content="" />
 <meta name="viewport" content="width=device-width,initial-scale=1.0">
 <meta name="robots" content="all" />
 <meta name="format-detection" content="telephone=no">
 <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" >
 
  <!-- CSS設定
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
 <link rel="stylesheet" href="<?php echo base_url();?>common/css/common.css" type="text/css" />
 <link rel="stylesheet" href="<?php echo base_url();?>common/css/contents.css" type="text/css" />
 <link rel="stylesheet" href="<?php echo base_url();?>common/css/style.css" type="text/css" />
 
<!-- Jquery
-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*--*-*-*-*-*-*-*-*-*-*--*-*-*-*-*-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript' src='<?php echo base_url();?>js/jquery-1.11.0.min.js?ver=4.2.2'></script>
 <link rel="stylesheet" href="<?php echo base_url();?>css/wide_slider.css" type="text/css" media="screen" >

<script src="<?php echo base_url();?>js/wide_slider.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jQueryAutoHeight.js"></script>
<script src="<?php echo base_url();?>common/js/common.js"></script>
 
 <!--NeedsColumn
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
<link rel="stylesheet" href="<?php echo base_url();?>css/needscolumn.css" type="text/css" media="screen" >
 <script src="<?php echo base_url();?>common/js/jquery.bxslider.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.sfSlider-min.js"></script>
<script src="<?php echo base_url();?>js/top.js"></script>

 <!--Navi onmouseoverで背景透過
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
 
 <script type="text/javascript">
 
window.onload = function(){
for(i=0 ; i<document.getElementsByClassName("menu__mega").length ; i++){
document.getElementsByClassName("menu__mega")[i].onmouseover = function(){
document.getElementById( "alpha" ).style.display  = "inherit";
}
document.getElementsByClassName("menu__mega")[i].onmouseout = function(){
document.getElementById( "alpha" ).style.display = "none";
}
}
}
</script>
 
</head>

<style>
	
</style>
<body id ="top_g">
<div id="wrapper">
	<div id="top">
		<div class="maintitle" style =" top: 20px;"><img src="<?php echo base_url();?>common/img/maintitlew.png" alt=""/></div>
		
		<div class="login_wrapper" style ="position: absolute;">
			 <form name="form1" id="form1" method="post" action="<?php echo base_url();?>first_index/login">
			 <img src="<?php echo base_url();?>common/img/maintitle2.png" alt="" height= "80px"/>
			 <p class ="maintext">このサイトは、ネッツ東京「2017年10-11月　店舗の絆強化コンテスト　報奨旅行」特設サイトです。事前にお知らせしている共通ログインパスワードを入力してください。</br>
（関係者以外の方は閲覧ご遠慮ください。）
</p>

				<hr></hr> 
					<p class="pass"><strong>共通ログインパスワード　</strong><input type="text" name="netID" /></p>
					</br></br>
					<p class="submit" style ="text-align:center"><input type="submit" class = "button_log" value=" O K " /></p></br>
				</form>
				
				
				
				
				
				<span style = "padding:20px;color:red; font-size:16px;font-weight:bold;"><?php if(isset($messager)){ echo $messager;} else { echo '';}?></span>
		  </div>
	</div>
	
	
</div>

</body>
</html>