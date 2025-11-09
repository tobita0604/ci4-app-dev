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
		content: "招待外";
		color:red;
	}
</style>
<section id="about">
<div id="main">
<!-- システムメッセージ -->
<div id="systemMsg"></div>
<div style="white-space:nowrap">
<div class="arrow-container current">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">人数<br class="nobr">登録</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-2em" class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">本人<br class="nobr">登録</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-4em" class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">同伴者<br class="nobr">登録</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-6em" class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">情報<br class="nobr">確認</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-8em" class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">登録<br class="nobr">完了</div>
	<div id="zz" class="arrow-right"></div>
</div>
</div>
<form action="<?php echo base_url();?>mypage_con/save_entry_no" method="post" autocomplete="off" id="entry_data" > 
	<?php require(APPPATH . "views/element/csrf_input.php"); ?>
	<h2 style ="background:#005084">EPC2024　<?=$reserve['R01_Entry_Flg']=='1'?'マイページ':'エントリーフォーム'?></h2>
	<p style="font-weight: bolder; color: #f00">
		・登録の受付は終了いたしました<!--（写真は除く）-->。<br>
	</p>
	<p>
<!--		　ご変更や取り消しにつきましては、以下へご連絡お願いいたします。<br>
		　(株)近畿日本ツーリストコーポレートビジネス　トラベルサービスセンター東日本　担当：藤野・石渡<br>
		　〒160-0023　東京都新宿区西新宿8-14-24　西新宿KFビル３階<br>
		　TEL：03-6730-3220　FAX：03-6730-3229<br>
		　受付時間　月～金 10：00～17：00（土・日・祝日は休業）＊4月27日(土)～5月6日(月)はお休みをいただいております。<br>
		・写真のアップロードは可能です。ログイン後、個人の入力画面よりアップロードをお願いします。<br>
	</p>
	<p style="font-weight: bolder; color: #f00">
		　締め切り　4月26日(金)<br><br>
	</p>
-->
	<p>
		<!--必要事項をご入力の上、送信ボタンを押してください。<br>-->
		<!--※申込希望者本人がご入力ください。<br>
		※お一人様当たり１回のお申込みです。<br>-->
	</p>
<!--
	<p style="font-weight: bolder; color: #f00">
		※参加登録フォームは３０分でタイムアウトとなります。ご注意ください。<br>
		※申し込み締め切り前は変更可能です。<br>
		※締め切り日以降、変更の際は事務局までご連絡ください。<br>
		※１度登録した同伴者人数は変更できません。変更をご希望の場合はEPC2024事務局までご連絡ください。<br>
	</p>
-->	
	<table class="border2" width="100%">
		<tr>
			<th class="required">個人情報の取り扱い</th>
			<td>
				<input type="checkbox" id="R01_Confirm_Flg" value="1" <?=!empty_date($common['R01_Update_Date'])?'checked disabled':''?>/>同意します
				<p>
					入力いただくお客様の個人情報は、お客様との連絡及び当該旅行サービスの提供のために利用させていただきます。<br>
					また、お申込みいただいた当該旅行サービスの手続きに必要な範囲内で、手配代行者に対しお客様の個人情報を提供いたします。<br>
					<br>プライバシー全文は<a href="https://www.knt.co.jp/privacy/web/" >こちら</a>をご覧ください。
				</p>
			</td>
		</tr>
		<tr>
			<th width="30%">支社名</th>
			<td>
				<?=$common['R01_Branch_Name']?>
			</td>
		</tr>
		<tr>
			<th>お名前</th>
			<td>
				<?=$reserve['R01_Name']?>
			</td>
		</tr>
		<tr>
			<th>入賞者カテゴリー</th>
			<td>
				<?=get_label('カテゴリ',$common['R01_Category_Flg'])?><br>
				<?=$common['R01_Category_Flg']=='E1'?DIAMOND_NOTE:''?>
			</td>
		</tr>
<!--
		<tr>
			<th>１Q家族招待CP</th>
			<td>
				<?=get_label('1Q',$common['R01_1Q_Flg'])?>
			</td>
		</tr>
		<tr>
-->
<!--
			<th>４Qオプショナルツアー招待CP</th>
			<td>
				<?=get_label('4Q',$common['R01_4Q_Flg'])?>
			</td>
		</tr>
-->
<!--
			<tr>
			<th>xx無料権利</th>
			<td>
				<?=get_label('パーク',$common['R01_Park_Flg'])?>
				<?=$common['R01_Park_Flg']=='1'?PARK_NOTE:''?>
			</td>
		</tr>
-->
		<tr>
			<th>招待人数（本人含む）</th>
			<td>
				<?=$common['R01_Free_Invites']?><!--<?=INVITES_NOTE ?>-->
				<input type="hidden" name="common[R01_Free_Invites]" value="<?=$common['R01_Free_Invites']?>"/>
			</td>
		</tr>
		<tr>
			<th>自費参加者</th>
			<td>
				<input type="hidden" name="common[R01_Charge_Invites]" value="<?=$common['R01_Charge_Invites']?>"/>
				<?php 
				if($reserve['R01_Entry_Flg']=='1'): 
				echo $common['R01_Charge_Invites'];
				else: ?>
				<select name="common[R01_Charge_Invites]" onchange="invite_changed(this)">
					<?php for($i=0;$i<9;$i++):?>
					<option value="<?=$i?>" <?=$i==$common['R01_Charge_Invites']?'selected':''?>><?php echo $i ?></option>
					<?php endfor; ?>
				</select>
				<?php endif; ?>
			</td>
		</tr>
	</table>
</form>
<?php if($reserve['R01_Entry_Flg']=='1'): ?>
<table class="border2" width="100%">
	<tr class="invite" id="invite0">
		<th colspan="3">登録状況</th>
	</tr>
	<tr class="invite" id="invite0">
		<th style="width:30%">ご本人様</th>
		<td>
			済
		</td>
		<td>
		<form action="<?php echo base_url();?>mypage_con/regist_reserver" method="post">
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
			echo '済';
			else:
			echo '未';
			endif;
			?>
		</td>
		<td>
			<form action="<?php echo base_url();?>mypage_con/regist_member" method="post" style="display:inline-block">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
				<input type="hidden" name="idx" value="<?=$idx?>" />
				<input type="submit" name="back_to_top" value="詳細" />
			</form>
		</td>
	</tr>
	<?php 
	endfor; 
	endif;
	?>
</table>

<br><br>
<table class="border2" width="100%">
	<tr>
		<th>オプショナルツアー</th>
	</tr>
	<tr>
		<td class="center">
			<input type="button" value="6月頃受付開始予定" />
<!--
		<?php if(date('Y-m-d H:i:s') > OPTION_LIMIT): ?>
		<form action="<?php echo base_url();?>option_con/confirm_option" method="post">
			<input type="hidden" name="idx" value="<?=$idx?>" />
			<input type="submit" value="オプショナルツアー内容確認" />
		</form>
		<?php else: ?>
		<form action="<?php echo base_url();?>option_con" method="post">
			<input type="hidden" name="idx" value="<?=$idx?>" />
			<input type="submit" value="オプショナルツアー申込へ" />
		</form>
		<?php endif; ?>
-->
		</td>
	</tr>
</table>
<?php endif; ?>

	
</section>