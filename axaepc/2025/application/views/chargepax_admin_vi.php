<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
<!-- Section1 about---------------------------------------------------> <style>
	th.required::after {
		content: "[必須]";
		color:red;
		font-weight:bold
	}
	table.border2 tr.gai th {
		background: #ffff99;
	}
	table.border2 tr.cxl th,
	table.border2 tr.gai.cxl th	{
		background: #e5e5e5;
	}
	table.border2 tr.gai th::after {
		content: "自費";
		color:red;
	}
	a {
		color: black;
	}
	
	a:hover {
		color: black;
	}
	a:visited {
		color: black;
	}
</style>
<section id="about">
<div id="main">
<form action="<?php echo base_url();?>register_con/save_chaegepax" method="post" autocomplete="off" id="entry_data" > 
	<?php require(APPPATH . "views/element/csrf_input.php"); ?>
	<h2 style ="background:#005084">自費参加者人数変更</h2>
	<table class="border2" width="100%" style="margin-bottom: 15px !important;">
		<tr>
			<th width="30%">ID</th>
			<td>
				<?=h($common['R01_Id'])?>
	<!--<br>session=<?= $this->session->userdata('user_data'); ?>　です。-->
			</td>
		</tr>
		<tr>
			<th>支社名</th>
			<td>
				<?=h($common['R01_Branch_Name'])?>
			</td>
		</tr>
		<tr>
			<th>お名前</th>
			<td>
				<?=h($reserve['R01_Name'])?>
			</td>
		</tr>
		<tr>
			<th>入賞者カテゴリー</th>
			<td>
				<?=get_label('カテゴリ',h($common['R01_Category_Flg']))?><br>
			</td>
		</tr>
		<tr>
			<th>招待人数（本人含む）</th>
			<td>
				<?=h($common['R01_Free_Invites'])?><!--<?=INVITES_NOTE ?>-->
			</td>
		</tr>
		<tr>
			<th>自費参加者人数<br><span style="color:red;">※人数は増加のみ可能です。</span></th>
			<td>
				<?=h($common['R01_Charge_Invites'])?>&nbsp;名　⇒　<!--<?=INVITES_NOTE ?>-->
				<select name="Charge_Invites">
<?php
	for($p=($common['R01_Charge_Invites']+1); $p<11; $p++){
?>
					<option value="<?=$p;?>"><?=$p;?>
<?php
	}
?>
				</select>&nbsp;名へ変更する
			</td>
		</tr>
	</table>
	<div style="text-align:center;color:red;">
		<?= $this->session->userdata('sysmsg'); ?>
	</div>
	<div style="text-align:center;">
		<input type="button" onclick="window.close();" value="　閉じる　">
		　　
		<input type="submit" value="　更　新　">
	</div>
	<input type="hidden" name="kid" value="<?=h($common['R01_Id'])?>">
</form>
<br><br><br>
</section>