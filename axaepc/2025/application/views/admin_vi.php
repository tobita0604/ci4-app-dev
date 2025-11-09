<div class="login_wrapper">
<section id="about">
<div id="main100">
	<!-- FORM 設定開始　-->
	<div class="login_wrapper" style="background:#ddd">
		<h1>管理ログイン画面</h1>
		<br>
		<form action="<?php echo base_url();?>admin_con/admin_login" method="post">
			<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			<p style="color: red; font-size: 120%; font-weight: bolder;text-align: center;"><?php if(isset($messager)) { echo $messager;} ?></p>
			<div class="login_form">
				<dl>
				<dt>ログインID</dt>
				<dd><input type="text" name="user_id" id="user_id"></dd>
				<dt>Password</dt>
				<dd><input type="password" name="password" id="password" value="" ></dd>
				</dl>
				<p class="login_submit"><input type="submit" name="btn_submit" value="Login"></p>
			</div>
		</form>
	</div>
	<!-- FORM 設定終了　-->
	

</div>
</section>
</div>
</body>
</html>