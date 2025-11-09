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
</style>
<section id="about">
<div>

<form action="<?php echo base_url();?>mypage_admin_con/save_entry_no" method="post" autocomplete="off" id="entry_data" > 
	<?php require(APPPATH . "views/element/csrf_input.php"); ?>
	<h2 style ="background:#005084">EPC2024　マイページ（管理者編集）</h2>

	<table class="border2" width="100%" style="margin-bottom: 15px !important;">
		<tr>
			<th class="required">個人情報の取り扱い</th>
			<td>
				<input type="checkbox" id="R01_Confirm_Flg" value="1" <?=!empty_date($common['R01_Update_Date'])?'checked disabled':''?>/> 同意します
				<p>
					入力いただくお客様の個人情報は、お客様との連絡及び当該旅行サービスの提供のために利用させていただきます。<br>
					また、お申込みいただいた当該旅行サービスの手続きに必要な範囲内で、手配代行者に対しお客様の個人情報を提供いたします。<br>
					<br>プライバシー全文は<a href="https://www.knt.co.jp/privacy/web/" target="_blank">こちら</a>をご覧ください。
				</p>
			</td>
		</tr>
		<tr>
			<th width="30%">支社名</th>
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
				<!--<?=h($common['R01_Category_Flg'])=='E1'?DIAMOND_NOTE:''?>-->
				<!-- <p>
					招待権１名分を使ってビジネスクラスへの変更を可能とします。<br>
					但し、フライトの混雑により、ご希望に添えない場合があります。<br>
					（１名分→１名様、フライトは先着順、同日の場合は同日着との抽選） <br>
					ご希望の際は備考欄へご記入いただくか、事務局へご連絡ください。<br>
				</p> -->
			</td>
		</tr>
<!--
		<tr>
			<th>１Q家族招待CP</th>
			<td>
				<?=get_label('1Q',h($common['R01_1Q_Flg']))?>
			</td>
		</tr>
-->
		<!-- <tr>
			<th>４Qオプショナルツアー招待CP</th>
			<td>
				<?=get_label('4Q',h($common['R01_4Q_Flg']))?>
			</td>
		</tr> -->
<!--
		<tr>
			<th>xx無料権利</th>
			<td>
				<?=get_label('パーク',h($common['R01_Park_Flg']))?>
				<?=h($common['R01_Park_Flg'])=='1'?PARK_NOTE:''?>
			</td>
		</tr>
-->
		<tr>
			<th>招待人数（本人含む）</th>
			<td>
				<?=h($common['R01_Free_Invites'])?><!--<?=INVITES_NOTE ?>-->
			</td>
		</tr>
		<tr>
			<th>自費参加者</th>
			<td>
				<input type="hidden" name="common[R01_Charge_Invites]" value="<?=h($common['R01_Charge_Invites'])?>"/>
				<?php 
				if($reserve['R01_Entry_Flg']=='1'): 
				echo h($common['R01_Charge_Invites']);
				else: ?>
				<select name="common[R01_Charge_Invites]" onchange="invite_changed(this)">
					<?php for($i=0;$i<9;$i++):?>
					<option value="<?=$i?>" <?=$i==$common['R01_Charge_Invites']?'selected':''?>><?php echo $i ?></option>
					<?php endfor; ?>
				</select>
				　自費参加者の人数は登録後の変更ができませんのでご注意ください。
				<?php endif; ?>
			</td>
		</tr>
	</table>
</form>
<!-- <p style="margin-bottom: 15px;">※オプショナルツアーやレンタカーのご案内は6月中を予定しております。</p> -->
<?php if($reserve['R01_Entry_Flg']=='1'): ?>
<input type="hidden" name="common[R01_Free_Invites]" value="<?=h($common['R01_Free_Invites'])?>"/>
<table class="border2" width="100%">
	<tr class="invite" id="invite0">
		<th colspan="1"></th>
		<th colspan="1" style="text-align: left;">登録状況</th>
		<th colspan="1" style="text-align: left;">登録および確認はこちら</th>
	</tr>
	<tr class="invite" id="invite0">
		<th style="width:30%">ご本人様</th>
		<td>
			登録済
		</td>
		<td>
		<form action="<?php echo base_url();?>mypage_admin_con/regist_reserver" method="post">
			<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			<input type="submit" name="back_to_top" value="詳細" />
		</form>
		</td>
	</tr>
	<?php 
	if(!empty($invites)):
	for($no=1;$no<10;$no++): 
	$idx = $no - 1;
	?>
	<tr class="invite <?=!empty($invites[$idx]['R01_Cancel_Flg'])?'cxl':''?>" id="invite<?=$no?>">
		<th>
			■<?=$no>=$common['R01_Free_Invites']?'':'招待'?>同伴者<?=$no?>
		</th>
		<td>
			<?php
			if(!empty($invites[$idx]['R01_Cancel_Flg'])):
			echo '不参加';
			elseif(!empty($invites[$idx]['R01_Entry_Flg'])):
			echo '登録済';
			else:
			echo '<span style="color: red;">未登録</span>';
			endif;
			?>
		</td>
		<td>
			<form action="<?php echo base_url();?>mypage_admin_con/regist_member" method="post" style="display:inline-block">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
				<input type="hidden" name="idx" value="<?=h($idx)?>" />
				<input type="submit" name="back_to_top" value="詳細" />
			</form>
			<?php if(empty($invites[$idx]['R01_Cancel_Flg'])):	?>
			<form action="<?php echo base_url();?>mypage_admin_con/cancel_member" method="post" style="display:inline-block">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
				<input type="hidden" name="idx" value="<?=h($idx)?>" />
				<input type="submit" value="キャンセル" onclick="return confirm_cancel()"/>
			</form>
			<?php endif; ?>
		</td>
	</tr>
	<?php 
	endfor; 
	endif;
	?>
</table>
<!-- <p style="font-size: 12px; line-height: 1.75rem; margin-top: 3px;">
■同伴者様ご入力について：入力途中でも保存し、完了するこができますが、締切日（5/13）までには<br>
必須項目についてはご入力いただき、表示が「済」になりますようお願い申し上げます。
</p>

<div style="text-align: center;margin-top:1em;">
<div class="his-button" style="border-radius: 5px;">
	<input type="image"  src="<?php echo base_url();?>img/next_passengers.png" onclick="validate_entry_no(1);"/>
</div>
</div> -->
<br><br>
<table class="border2" width="100%" style="margin-bottom: 0px;;">
	<tr>
		<th>オプショナルツアー</th>
	</tr>
	<tr>
		<td class="center">
		<?php /*if(date('Y-m-d H:i:s') > OPTION_LIMIT): ?>
		<form action="<?php echo base_url();?>option_con/confirm_option" method="post">
			<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			<input type="hidden" name="idx" value="<?=$idx?>" />
			<input type="submit" value="オプショナルツアー内容確認" />
		</form>
		<?php else: ?>
		<form action="<?php echo base_url();?>option_con" method="post">
			<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			<input type="hidden" name="idx" value="<?=$idx?>" />
			<input type="submit" value="オプショナルツアー申込へ" />
		</form>
		<?php endif */; ?>
			<button><a href="<?php echo base_url();?>Option_con" style=" text-decoration: none;">申し込み</a></button>
		</td>
	</tr>
</table>
<!-- <p style="font-size: 12px; line-height: 1.75rem; margin-top: 3px;">※ご宿泊ホテル「ヒルトン沖縄北谷リゾート」開催のキッズアクティビティについては<br>　7月末に開催内容が決定されるため、それからのご案内となります。</p> -->
	<?php
		// 表示制御
		$this->current_date = date('Y-m-d H:i:s');
		$this->mypage_golf_limit = date('Y-m-d H:i:s', strtotime($this->config->item('mypage_golf_limit')));
		$this->mypage_car_limit = date('Y-m-d H:i:s', strtotime($this->config->item('mypage_car_limit')));
	?>
	<?php if($this->mypage_car_limit <= $this->current_date): ?>
		<br><br>
		<table class="border2" width="100%" style="margin-bottom: 0px;;">
			<tr>
				<th>北海道内の移動について</th>
			</tr>
			<tr>
				<td class="center">
					<button value="申し込み"><a href="<?php echo base_url();?>Transfer_con" style=" text-decoration: none;">登録</a></button>
				</td>
			</tr>
		</table>
	<?php endif; ?>
	<?php if($this->mypage_golf_limit <= $this->current_date): ?>
		<br><br>
		<table class="border2" width="100%" style="margin-bottom: 0px;;">
			<tr>
				<th>ゴルフコンペ</th>
			</tr>
			<tr>
				<td class="center">
					<button value="申し込み"><a href="<?php echo base_url();?>Golf_con" style=" text-decoration: none;">申し込み</a></button>
				</td>
			</tr>
		</table>
	<?php endif; ?>
<?php else: ?>
<div style="text-align: center;margin-top:1em;">
<div class="his-button" style="border-radius: 5px;">
	<input type="image"  src="<?php echo base_url();?>img/next.png" onclick="validate_entry_no();"/>
</div>
</div>
<?php endif; ?>
	
</section>