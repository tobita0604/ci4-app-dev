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
				<h1>管理者レンタカー予約確認画面</h1>
				<input type="submit" style="float: right; margin: 0 auto; margin-bottom: 10px; " name="menu_back" value="Menu" onclick="backMenu()">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			</form>
		</div>
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
<form action="<?php echo base_url(); ?>CarRentalAdmin_con/search" method="post" name="search" id="search">
<?php require(APPPATH . "views/element/csrf_input.php"); ?>

<div class="yoko" id="yoko" style="display:<?php echo $show_search;?>">
<dl>
	<input type="hidden" name="R01_reentry" value=""> <!-- 再入力設定 -->
	<dt>社員番号(半角)</dt><dd><input type="text" name="R01_User_Id" id="R01_User_Id" size="30" value="<?=$searchKey['R01_User_Id']?>"/></dd>
	<dt>お名前(漢字)</dt><dd><input type="text" name="R01_Name_Kanji" id="R01_Name_Kanji" size="9" value="<?=$searchKey['R01_Name_Kanji']?>" /></dd>
	<dt>お名前(カタカナ)</dt><dd><input type="text" name="R01_Name_Kana" id="R01_Name_Kana" size="9" value="<?=$searchKey['R01_Name_Kana']?>" /></dd>

	<dt>予約クラス</dt>
	<dd>
		<select name="R01_Class" id="R01_Class">
			<?php if(!empty($rental_stocks)):?>
				<option value="">全て</option>
				<?php foreach($rental_stocks as $stocks):?>
					<option value="<?= $stocks['R02_Class'] ?>" <?php if($searchKey['R01_Class'] == $stocks['R02_Class']) {echo "selected"; }?> ><?= $stocks['R02_Class']; ?> </option>
				<?php endforeach;?>
			<?php endif;?>
		</select>
	</dd>
	<!-- <dt>予約日程</dt>
	<dd>
		<select name="R01_Schedule" id="R01_Schedule">
			<?php if(!empty($this->car_schedule)):?>
				<option value="0">全て</option>
				<?php foreach($this->car_schedule as $indx => $schedule):?>
					<option value="<?= $indx ?>" <?php if($searchKey['R01_Schedule'] == $indx) {echo "selected"; }?> ><?= $schedule; ?> </option>
				<?php endforeach;?>
			<?php endif;?>
		</select>
	</dd>	 -->
	<dt>チャイルドシート</dt>
	<dd>
		<select name="R01_Child_Seat" id="R01_Child_Seat">
			<?php if(!empty($this->child_seat)):?>
				<option value="0">全て</option>
				<?php foreach($this->child_seat as $indx => $seat):?>
					<option value="<?= $indx ?>" <?php if($searchKey['R01_Child_Seat'] == $indx) {echo "selected"; }?> ><?= $seat; ?> </option>
				<?php endforeach;?>
			<?php endif;?>
		</select>
	</dd>	
</dl>
</div>
<hr />

<?php if(!empty($rental_stocks)):?>
	<p style="text-align: center; margin-top: 50px; font-size: 20px;">クラス在庫状況<p>
<div align="center" > 
	<table class="border2" width="100%" style="width: 500px; margin: 0 auto;">
		<tr>
			<th></th>
			<th>S</th>
			<th>RA</th>
			<th>EA</th>
			<th>WA</th>
		</tr>

		<?php foreach($rental_stocks_table as $stock):?>
			<tr>
				<td style="text-align: center;">
					<?php if($stock['day'] > 25):?>
						2024年3月<?=$stock['day'] ?>日
					<?php else:?>
						2024年4月<?=$stock['day'] ?>日
					<?php endif;?>
				</td>
				<td style="text-align: center;">
					<?= isset($stock['S']) ? $stock['S'] : 0 ?>
				</td>
				<td style="text-align: center;">
					<?= isset($stock['RA']) ? $stock['RA'] : 0 ?>
				</td>
				<td style="text-align: center;">
					<?= isset($stock['EA']) ? $stock['EA'] : 0 ?>
				</td>
				<td style="text-align: center;">
					<?= isset($stock['WA']) ? $stock['WA'] : 0 ?>
				</td>
			</tr>
		<?php endforeach;?>
	</table>
</div>
<?php endif;?>
<br>
<p align="center" class="submit">
<input type="submit" name="searchbtn" value="検索" id="searchbtn" />
</p>

<!-- SEARCH FORM END -->

<!-- CSV START -->
<?php //if($this->session->userdata('charger_type')=='9'): ?>
<div style="margin: 0 auto; margin-left: 5px">
	<input type="submit" name="downloadcsv" id="downloadcsv" value="CSVダウンロード" class ="buttoncsv" ></input>
	<span style="float:right;font-size:120%;font-weight:bold;"><?php echo $count_resever; ?>件</span>
</div>
<?php //endif;?>
<!-- CSV END -->
</form><!-- Check with type_login = 2 or 9 -->	
<div align="center" > 
<table class="search" width="100%">
	<tr>
		<th>社員番号</th>
		<th>お名前<br>(漢字)</th>
		<th>お名前<br>(カナ)</th>
		<th>免許証番号</th>
		<th>免許証有効期限</th>
		<th>予約クラス</th>
		<th width="25%">予約日程</th>
		<th>チャイルドシート</th>
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
	?>
	<tr>
		<td style="text-align:center;white-space:nowrap">
			<?=$data['R01_User_Id'] ?>
		</td>
		<td>
			<?=$data['R01_Name_Kanji']?>
		</td>
		<td>
			<?=$data['R01_Name_Kana']?>
		</td>
		<td>
			<?=$data['R01_Driver_License_No']?>
		</td>
		<td>
			<?=$data['R01_Driver_License_Expiry']?>
		</td>
		<td>
			<?=$data['R01_Class']?>
		</td>
		<td>
			<?=date('n月j日 H時i分',strtotime($data['R01_FromDriveDate']." ".$data['R01_FromDriveTime']))?> ～ <?=date('n月j日 H時i分',strtotime($data['R01_ToDriveDate']." ".$data['R01_ToDriveTime']))?>
		</td>
		<td>
			<?=v($this->child_seat, $data['R01_Child_Seat'])?>
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