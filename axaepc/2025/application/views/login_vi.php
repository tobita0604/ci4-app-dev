<body id ="top_g">
	<div id="wrapper">
		<div class="login_wrapper">
			<form action="<?php echo base_url();?>login_con/login" method="post">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
				<div style="text-align:left;"><img style="object-fit: contain; height:80px; font-family:contain;" src="<?php echo base_url();?>common/img/logo_2024.png" alt="" /></div>
				</br>
				<p></p>
				<p style="color: red; font-size: 120%; font-weight: bolder;text-align: center;"><?php if(isset($messager)) { echo h($messager);} ?></p>
				<div class="login_form">
					<dl>
						<dt></dt>
						<dd>ログインIDとパスワードを入力してください</dd>
						<!--<dd class="error_msg">システム調整のため、本日（2/19）12:00まで登録できません。</dd>-->
						<dt>ログインID</dt>
						<dd><input type="text" name="R00_Id" id="R00_Id" value="<?php if (isset($R00_Id)){echo h($R00_Id);} ?>">
						</dd>
						
						<?php if(isset($R00_Id_Err)){?>
							<dd><span style="color: red;"><?php echo $R00_Id_Err;?></span></dd>
						<?php }?>
						<dt>パスワード</dt>
						<dd><input type="password" name="R00_Password" id="R00_Password" value="" autocomplete="off"></dd>
						<?php if(isset($R00_Password_Err)){?>
							<dd><span style="color: red;"><?php echo $R00_Password_Err;?></span></dd>
						<?php }?>
					</dl>
					<p class="login_submit"><input type="submit" name="btn_submit"  class = "button_log" value="Login"></p>
					<p align="center"><a href="<?php echo base_url(); ?>login_con/forget_password" style="color: red; font-size: xx-small;">パスワードを忘れた方はこちらへ</a></p>
				</div>
			</form>
		</div>
	</div>
</body>
</html>