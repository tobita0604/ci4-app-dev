<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
<!-- Section1 about---------------------------------------------------> 
<style>
	dl.tours{
		padding-left: 2em;
	}
	dl.tours dt {
		display:inline-block;
		vertical-align:top;
	}
	dl.tours dd {
		display:inline-block;
	}
	td.time {
		word-break:keep-all;
	}
	table.border2 td.avail {
		text-align:center;
		vertical-align:middle;
	}
	.btn,
	a.btn,
	button.btn {
	font-size: 1.3rem;
	font-weight: 700;
	line-height: 0.9;
	position: relative;
	display: inline-block;
	padding: 1rem 4rem;
	cursor: pointer;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-transition: all 0.3s;
	transition: all 0.3s;
	text-align: center;
	vertical-align: middle;
	text-decoration: none;
	letter-spacing: 0.1em;
	color: #212529;
	border-radius: 0.5rem;
	}
	.btn--orange,
	a.btn--orange {
	color: #fff;
	background-color: #eb6100;
	}
	.btn--orange:hover,
	a.btn--orange:hover {
	color: #fff;
	background: #f56500;
	}

	.btn--bule,
	a.btn--bule {
	color: #fff;
	background-color: #0027eb;
	}
	.btn--bule:hover,
	a.btn--bule:hover {
	color: #fff;
	background: #3b00eb;
	}
</style>
<section id="about">
<div id="main">
<!-- システムメッセージ -->
<div id="systemMsg"></div>
<form action="" method="post" autocomplete="off" id="car_rental" > 
	<h2 style ="background:#005084">EPC2024　移動方法の登録</h2>
	<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>"/>
	<input type="hidden" name="reserve[R01_User_Id]" value="<?= !empty($reserve['R01_User_Id'])?h($reserve['R01_User_Id']):''?>"/>
	<?php if(!empty($this->session->tempdata('success_flash'))):?>
		<div class="alert alert-success" role="alert">
			<strong><?= $this->session->tempdata('success_flash');?></strong>
		</div>
	<?php endif;?>

	<?php if(!empty($reserve)):?>
	<table class="border2" width="100%" style="table-layout:fixed">
		<tr>
			<th class="required" style="width:30%">予約クラス</th>
			<td>
				<?php if(!empty($rental_stocks)):?>
					<?php foreach($rental_stocks as $stocks):?>
						<?= !empty($stocks['R02_Class']) && !empty($reserve['R01_Class']) && $stocks['R02_Class'] == $reserve['R01_Class'] ? h($stocks['R02_Class']).'クラス':'';?>
					<?php endforeach;?>
				<?php endif;?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">貸出日時</th>
			<td>
				<?=date("Y年m月d日",strtotime(h($reserve['R01_FromDriveDate'])))?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">返却日時</th>
			<td>
			<?=date("Y年m月d日",strtotime(h($reserve['R01_ToDriveDate'])))?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">チャイルドシート</th>
			<td>
				<?php if(!empty($reserve['R01_Child_Seat'])):?>
					<?=v($this->child_seat, $reserve['R01_Child_Seat'])?>
				<?php else:?>
					不要
				<?php endif;?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">レンタカー安心パック（RAP）</th>
			<td>
				<?=h($reserve['R01_Car_Insurance'])?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">運転者氏名（漢字）</th>
			<td>
				<?=h($reserve['R01_Name_Kanji'])?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">運転者氏名（カナ）</th>
			<td>
				<?=h($reserve['R01_Name_Kana'])?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">免許証番号</th>
			<td>
				<?=h($reserve['R01_Driver_License_No'])?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">免許証有効期限</th>
			<td>
				<?=date('Y年m月d日',strtotime($reserve['R01_Driver_License_Expiry']))?>
			</td>
		</tr>
	</table>
	<?php else:?>
		<p>現在登録はありません。<br>登録をする場合は、以下の「登　録」ボタンから入力をお願いします。</p>
	<?php endif;?>
</form>
	
<div style="text-align: center;margin-top:1em;">
	<div class="his-button" style="border-radius: 5px;">
		<a onclick="go_back();" class="btn btn--bule">マイページに戻る</a>
<?php
//入力締め切り制御
	$today = date('Y-m-d H:i:s');
	$this->entry_limit = $this->config->item('entry_limit');
	if(($today < $this->entry_limit)||($common['R01_reentry']==1)){
?>
		&nbsp;&nbsp;&nbsp;
		<a href="<?php echo base_url(); ?>Transfer_con/edit" class="btn btn--orange">登　録</a>
<?php
	}
?>
</div>
</div>
<div>
<br>
<p>【注意事項について】</p>
<!--<p>●申込みいただいたレンタカーをキャンセルする場合は、再度申込み画面へ進み「キャンセル」ボタンを押してください。</p>-->
	<p>●道内での移動方法（空港⇔表彰式会場/ホテル）についてご登録をお願いいたます。</p>
	<p>●バスご利用の人数把握とレンタカー駐車場の利用状況把握の為、ご協力をお願いいたします。</p>
<br>
<!--
<p style="text-align: center; margin-top: 50px; font-size: 20px;">予約クラス在庫状況　(単位台数)<p>
<div align="center" > 
	<table class="border2" width="100%" style="width: 500px; margin: 0 auto;">
		<tr>
			<th></th>
			<th>RA</th>
			<th>EA</th>
			<th>WA</th>
		</tr>

		<?php foreach($rental_stocks_table as $stock):?>
			<tr>
				<td style="text-align: center;">
					<?php	if($stock['day']<30){$ym="2024年4月";}else{$ym="2024年3月";} ?>
					<?=$ym.$stock['day'] ?>日
				</td>
				<td style="text-align: center;">
					<?=$stock['RA'] ?>
				</td>
				<td style="text-align: center;">
					<?=$stock['EA']?>
				</td>
				<td style="text-align: center;">
					<?=$stock['WA']?>
				</td>
			</tr>
		<?php endforeach;?>
	</table>
</div>
-->
</div>
</section>