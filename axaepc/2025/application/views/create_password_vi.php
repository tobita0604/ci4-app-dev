<!doctype html>
<html>
<head>

<title>EPC2024 お申込みサイト</title>

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
 
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui-1.12.1.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.6.0.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.12.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker-ja.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxzip3.js"></script>
</head>


<body id ="top_g">
<div id="wrapper">
	
	<!--<div class="maintitle" style =" top: 20px;"><img src="<?php echo base_url();?>common/img/maintitlew.png" alt=""/></div>-->
	
	<div class="login_wrapper" style ="position: absolute;">
		<h1>パスワード設定</h1>
		<form action="<?php echo base_url();?>login_con/create_password" method="post">
			<?php require(APPPATH . "views/element/csrf_input.php"); ?>
		<p style="color: red; font-size: 120%; font-weight: bolder;text-align: center;"><?php if(isset($messager)) { echo $messager;} ?></p>
		<div class="login_form">
			<dl>
				<dt style="width:auto;">ログインID</dt>
				<dd><label><?php echo h($R00_Id);?></label></dd>
				<dt style="width:auto;">新しいパスワード</dt>
				<dd><input type="password" name="R00_Password" id="R00_Password" value="" maxlength="16"></dd>
				<dt style="width:auto;">パスワード (確認)</dt>
				<dd><input type="password" name="R00_Password_con" id="R00_Password_con" value="" maxlength="16"></dd>
			</dl>
			<p style="color: red;">パスワードポリシー<br>・パスワードは8文字以上(大小英数含む)を入力ください。</p>
			<p class="login_submit"><input type="submit" class = "button_log" name="btn_submit" value="パスワード設定"></p>
			<!--<p align="center"><a href="<?php echo base_url(); ?>mypage_con/forget_password" style="color: red; font-size: xx-small;">パスワードを忘れた方はこちらへ</a></p>-->
		</div>
		</form>
	</div>
</div>

</body>
</html>