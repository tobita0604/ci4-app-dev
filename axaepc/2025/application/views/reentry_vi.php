<script>

var toggle = function() {
	var yoko = document.getElementById('yoko');
	if (yoko.style.display === 'block' || yoko.style.display === ''){
	yoko.style.display = 'none';
	$('#show_search').val('検索条件を表示');
	}else{
	yoko.style.display = 'block';
	$('#show_search').val('検索条件を隠す');
	}
}

</script>
<p style ="border-bottom:2px solid #ccc;"></p>
<div style ="width: 1150px; margin: 0 auto; position: relative; clear: both;">
	<div class="title-header">
		<div>
			<form action = "<?php echo base_url();?>menu_con" name = "back_menu" method="post">
				<h1>再入力許可設定画面</h1>
				<input type="submit" style="float: right; margin: 0 auto; margin-bottom: 10px; " name="menu_back" value="Menu" onclick="backMenu()">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			</form>
		</div>
		<?php if(!empty($this->session->tempdata('error_flash'))):?>
		<div class="alert alert-danger" role="alert">
			<strong><?= $this->session->tempdata('error_flash');?></strong>
		</div>
		<?php endif;?>
		<?php if(!empty($this->session->tempdata('success_flash'))):?>
		<div class="alert alert-success" role="alert">
			<strong><?= $this->session->tempdata('success_flash');?></strong>
		</div>
		<?php endif;?>
	<hr></hr>
	</div>
	<!-- Search Form -->
<div>
<!-- SEARCH FORM START -->
<?php 
$show_search = "block";
if(isset($searchbtn)){
if($searchbtn == "検索"){
	 $show_search = "none";
?>
<input type="button" name="show_search" id="show_search" value="検索条件を表示" class="show_search" onclick="toggle();">	
<?php } }?>
<form action="<?php echo base_url(); ?>reentry_con/search" method="post" name="search" id="search">
<?php require(APPPATH . "views/element/csrf_input.php"); ?>

<div class="yoko" id="yoko" style="display:<?php echo $show_search;?>">
<dl>
	<dt>再入力設定（許可中:停止）</dt>
	<dd>
		<select name="R01_reentry" id="R01_reentry">
			<option value="">全て</option>
			<option value="0" <?php if($searchKey['R01_reentry'] == '0') {echo "selected"; }?>>停止</option>
			<option value="1" <?php if($searchKey['R01_reentry'] == '1') {echo "selected"; }?>>許可中</option>
		</select>
	</dd>
	<dt>社員番号(半角)</dt><dd><input type="text" name="R01_Id" id="R01_Id" size="30" value="<?=$searchKey['R01_Id']?>"/></dd>
	<dt>お名前(漢字)</dt><dd><input type="text" name="R01_Name" id="R01_Name" size="9" value="<?=$searchKey['R01_Name']?>" /></dd>
	<dt>お名前(カタカナ)</dt>
	<dd>姓<input type="text" name="R01_Roma_Last" id="R01_Sei_Kana" size="9" value="<?=$searchKey['R01_Roma_Last']?>" />&nbsp;
		名<input type="text" name="R01_Roma_First" id="R01_Roma_First" size="9" value="<?=$searchKey['R01_Roma_First']?>" /></dd>
	<dt>メール(半角)</dt>
	<dd><input type="text" name="R01_Email" id="R01_Email" size="30" value="<?=$searchKey['R01_Email']?>" /></dd>

	<dt>支店名</dt>
	<dd>
		<select name="R01_Branch_Cd" id="R01_Branch_Cd">
			<option value="">全て</option>
			<?php foreach ($branches as $item) { ?>
			<option value="<?php echo  $item['R01_Branch_Cd'] ?>" <?php if($searchKey['R01_Branch_Cd'] == $item['R01_Branch_Cd']) {echo "selected"; }?> ><?php echo $item['R01_Branch_Name']; ?> </option>
			<?php } ?>
		</select>
	</dd>
	<dt>ログインステータス</dt>
	<dd>
		<select name="R01_Login_Flg" id="R01_Login_Flg">
			<option value="">全て</option>
			<option value="0" <?php if($searchKey['R01_Login_Flg'] == '0') {echo "selected"; }?>>未ログイン</option>
			<option value="1" <?php if($searchKey['R01_Login_Flg'] == '1') {echo "selected"; }?>>ログイン済</option>
		</select>
	</dd>	
	<dt>登録ステータス</dt>
	<dd>
		<select name="R01_Entry_Flg" id="R01_Entry_Flg">
			<option value="">全て</option>
			<option value="0" <?php if($searchKey['R01_Entry_Flg'] == '0') {echo "selected"; }?>>未登録</option>
			<option value="1" <?php if($searchKey['R01_Entry_Flg'] == '1') {echo "selected"; }?>>登録済</option>
		</select>
	</dd>
</dl>
</div>
<hr />
<p align="center" class="submit" style="margin-bottom: 5px">
<input type="submit" name="searchbtn" value="検索" id="searchbtn" />
<?php if($this->session->userdata('charger_type')=='9'): ?>
&nbsp;&nbsp;&nbsp;
<input type="hidden" name="R01_Test_Flg" id="R01_Test_Flg" value="0"/>
<input type="checkbox" name="R01_Test_Flg" id="R01_Test_Flg" value="1" <?php if($searchKey['R01_Test_Flg'] == '1') {echo "checked"; }?>/>
<label for="R01_Test_Flg">テストデータを除く</label>
<?php endif;?>
</p>

<!-- SEARCH FORM END -->

<!-- CSV START -->
<?php //if($this->session->userdata('charger_type')=='9'): ?>
<!-- <div style="margin: 0 auto; margin-left: 5px">
	<input type="submit" name="downloadcsv" id="downloadcsv" value="CSVダウンロード" class ="buttoncsv" ></input>
	<span style="float:right;font-size:120%;font-weight:bold;"><?php echo $count_resever; ?>件</span>
</div> -->
<?php //endif;?>
<!-- CSV END -->
</form><!-- Check with type_login = 2 or 9 -->	
<div align="center" > 
<table class="search" width="100%">
	<tr>
		<th>社員番号</th>
		<th>入賞カテゴリ</th>
		<th>お名前<br>(漢字)</th>
		<th>メールアドレス</th>
		<th>支店名</th>
		<th>招待人数</th>
		<th>最終ログイン</th>
		<th>登録日</th>
		<?php if($this->session->userdata('charger_type')=='9'): ?>
		<th>パスワード</th>
		<?php endif;?>
		<th>操作</th>
	</tr>
	
	<?php 
	$seq = 0;

	if($result != null) {
		foreach ($result  as $data ) {
			
			$seq = $seq +1;
			if($seq % 2 == 0){
				$bgc = "#ADD8E6";
			}else{
				$bgc = "#FFFFFF";
			}
			//DarkGray (削除)またキャンセル
			if($data['R01_Cancel_Flg'] == '1'){
				$bgc = "#A9A9A9";
			}
	?>
	<tr>
		<td style="text-align:center;white-space:nowrap">
			<?=$data['R01_Id'] ?>
		</td>
		<td>
			<?=get_label('カテゴリ', $data['R01_Category_Flg'])?>
		</td>
		<td>
			<?=$data['R01_Name']?>
		</td>
		<td>
			<?=$data['R01_Email']?>
		</td>
		<td>
			<?=$data['R01_Branch_Name']?>
		</td>
		<td>
			<?=$data['R01_Free_Invites']?>名
		</td>
		<td>
			<?=$data['R01_Last_Login_Date']?>
		</td>
		<td>
			<?=$data['R01_Update_Date']?>
		</td>
		<?php if($this->session->userdata('charger_type')=='9'): ?>
		<td>
			<?=$data['R01_Password']?>
		</td>
		<?php endif;?>
		<td style="text-align:center;white-space:nowrap">
			<button id="ReEntry" type="button" data-id="<?=$data['R01_Id']?>" data-reentry="<?=$data['R01_reentry']?>"><?=$data['R01_reentry']==0?'許可する':'停止する'?></button>
		</td>
	</tr>
	<?php
		}
	} else {
	?>
	<tr>
	<td colspan ="9" style="text-align:center" >データがありません。</td>
	</tr>
	<?php
	}
	?>
</table><!-- Check with type_login = 0 or 1 -->
</div>