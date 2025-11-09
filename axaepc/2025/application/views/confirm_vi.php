<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
<!-- Section1 about--------------------------------------------------->
<style>
	.border2.gai th {
		background: #ffff99;
	}
	.border2.cxl th,
	.border2.gai.cxl th {
		background: #e5e5e5;
	}
	.gai tr:first-child th:first-child::after {
		content: "自費";
		color: red;
	}
	.cxl tr:first-child th:first-child::after {
		content: "不参加";
		color: red;
	}
	.gai.cxl tr:first-child th:first-child::after {
		content: "自費 不参加";
		color: red;
	}
	tr.baby {
		display: none;
	}
	table.baby tr.baby{
		display: table-row;
	}
</style>
<section id="about">
<div id="main">
<!-- システムメッセージ -->
<div id="systemMsg"></div>
	<div style="white-space:nowrap">
	<div class="arrow-container">
		<div id="zz" class="arrow-left"></div>
		<div id="zz" class="arrow-ctr">マイ<br class="nobr">ページ</div>
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
	<div style="left:-6em" class="arrow-container current">
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
<form id="confirm_form" action="<?php echo base_url();?>register_con/end" method="post">
	<?php require(APPPATH . "views/element/csrf_input.php"); ?>
	<h2 style ="background:#005084">EPC2024　エントリー　確認</h2>
	<table class="border2" width="100%">
		<tr>
			<th width="30%">支社名</th>
			<td>
				<?=$common['R01_Branch_Name']?>
			</td>
		</tr>
		<tr>
			<th>お名前</th>
			<td>
				<?=h($reserve['R01_Name'])?>
				<input type="hidden" name="reserve[R01_Name]" value="<?=h($reserve['R01_Name'])?>"/>
			</td>
		</tr>
		<tr>
			<th>入賞者カテゴリー</th>
			<td>
				<?=get_label('カテゴリ',h($common['R01_Category_Flg']))?>
			</td>
		</tr>
<!--
		<tr>
			<th>１Q家族招待CP</th>
			<td>
				<?=get_label('1Q',h($common['R01_1Q_Flg']))?>
			</td>
		</tr>
		<tr>
			<th>４Q家族招待CP</th>
			<td>
				<?=get_label('4Q',h($common['R01_4Q_Flg']))?>
			</td>
		</tr>
		<tr>
			<th>xx無料権利</th>
			<td>
				<?=get_label('パーク',h($common['R01_Park_Flg']))?>
			</td>
		</tr>
-->
		<tr>
			<th>招待人数</th>
			<td>
				<?=h($common['R01_Free_Invites'])?>
			</td>
		</tr>
		<tr>
			<th>自費参加者</th>
			<td>
				<?=h($common['R01_Charge_Invites'])?>
			</td>
		</tr>
	</table>
	
	<table class="border2 invite" width="100%" id="invite0">
		<tr>
			<th colspan="2">■ご本人様情報</th>
		</tr>
		<tr>
			<th width="30%" class="required">お名前:姓（カタカナ）</th>
			<td>
				<?=h($reserve['R01_Roma_Last'])?>
			</td>
		</tr>
		<tr>
			<th class="required">お名前:名（カタカナ）</th>
			<td>
				<?=h($reserve['R01_Roma_First'])?>
			</td>
		</tr>
		<tr>
			<th class="required">生年月日</th>
			<td>
				<?=h($reserve['R01_Birthdate'])?>
			</td>
		</tr>
		<tr>
			<th class="required">年齢</th>
			<td>
				<?=h($reserve['R01_Age'])?>
			</td>
		</tr>
		<tr>
			<th class="required">性別</th>
			<td>
				<?=get_label('性別', h($reserve['R01_Gender']))?>
			</td>
		</tr>
		<tr>
			<th class="required">自宅郵便番号</th>
			<td>
				<?=h($reserve['R01_Postal1']).'-'.h($reserve['R01_Postal2'])?>
			</td>
		</tr>
		<tr>
			<th class="required">都道府県</th>
			<td>
				<?=getPrefecture(h($reserve['R01_Prefecture']))?>
			</td>
		</tr>
		<tr>
			<th class="required">市区郡</th>
			<td>
				<?=h($reserve['R01_Address'])?>
			</td>
		</tr>
		<tr>
			<th class="required">町村名番地番号</th>
			<td>
				<?=h($reserve['R01_Address2'])?>
			</td>
		</tr>
		<tr>
			<th>建物名・部屋番号等</th>
			<td>
				<?=h($reserve['R01_Address3'])?>
			</td>
		</tr>
		<tr>
			<th class="required">連絡先電話番号</th>
			<td>
				<?=h($reserve['R01_Tel_No'])?>
			</td>
		</tr>
		<tr>
			<th class="required">携帯電話番号</th>
			<td>
				<?=h($reserve['R01_Mobile_No'])?>
			</td>
		</tr>
		<tr>
			<th class="required">メールアドレス</th>
			<td>
				<?=h($reserve['R01_Email'])?>
			</td>
		</tr>
		<tr>
			<th class="required">ご旅行中の緊急連絡先：お名前</th>
			<td>
				<?=h($reserve['R01_Emer_Name'])?>
			</td>
		</tr>
		<tr>
			<th class="required">ご旅行中の緊急連絡先：続柄</th>
			<td>
				<?=h($reserve['R01_Emer_Relationship'])?>
			</td>
		</tr>
		<tr>
			<th class="required">ご旅行中の緊急連絡先：電話番号</th>
			<td>
				<?=h($reserve['R01_Emer_Tel_No'])?>
			</td>
		</tr>
		<tr>
			<th class="required">請求書 送付先</th>
			<td>
				<?=get_label('請求', h($common['R01_Invoice_Flg']))?>
			</td>
		</tr>
		<tr hidden>
			<th class="required">パンフレット用写真アップロード</th>
			<td>
				<img alt="アップロードしてください" onerror="this.onerror=null;this.src='<?=base_url()?>img/noupload.png';" src="<?=base_url().h($common['R01_Brochure_Img'])?>" style="max-width:300px"/>
			</td>
		</tr>
		<tr hidden>
			<th class="required">沖縄滞在中でのレンタカーのご利用について</th>
			<td>
				<?=get_label('レンタカー', h($common['R01_Car_Rental']))?>
			</td>
		</tr>
		<tr>
			<th class="required">備考</th>
			<td>
				<?=nl2br(h($common['R01_Note']))?>
			</td>
		</tr>
	</table>
	
	<?php 
	if(!empty_date($common['R01_Update_Date']) && !empty($invites)):
	for($no=1;$no<10;$no++): 
	$idx = $no - 1;
	$age = calculate_age($invites[$idx]['R01_Birthdate']);
	?>
	<?php foreach($invites[$idx] as $id => $val): ?>
	<input type="hidden" name="invites[<?=$idx?>][<?=$id?>]" value="<?=h($val)?>" />
	<?php endforeach; ?>
	<table class="border2 invite <?=!empty($invites[$idx]['R01_Cancel_Flg'])?'cxl':''?> <?=$age>-1&&$age<12?'baby':'' ?>" id="invite<?php echo $no?>" hidden>
		<tr>
			<th colspan="2">
				■<?=$no>=h($common['R01_Free_Invites'])?'':'招待'?>同伴者<?=$no?>
			</th>
		</tr>
		<tr>
			<th class="required" style="width:30%">お名前:姓</th>
			<td>
				<?=h($invites[$idx]['R01_Name_Last'])?>
			</td>
		</tr>
		<tr>
			<th class="required" style="width:30%">お名前:名</th>
			<td>
				<?=h($invites[$idx]['R01_Name_First'])?>
			</td>
		</tr>
		<tr>
			<th class="required">お名前:姓（カタカナ）</th>
			<td>
				<?=h($invites[$idx]['R01_Roma_Last'])?>
			</td>
		</tr>
		<tr>
			<th class="required">お名前:名（カタカナ）</th>
			<td>
				<?=h($invites[$idx]['R01_Roma_First'])?>
			</td>
		</tr>
		<tr>
			<th class="required">生年月日</th>
			<td>
				<?=h($invites[$idx]['R01_Birthdate'])?>
			</td>
		</tr>
		<tr>
			<th class="required">年齢</th>
			<td>
				<?=h($invites[$idx]['R01_Age'])?>
			</td>
		</tr>
		<tr>
			<th class="required">性別</th>
			<td>
				<?=get_label('性別', h($invites[$idx]['R01_Gender']))?>
			</td>
		</tr>
		<tr>
			<th class="required">続柄</th>
			<td>
				<?=empty($invites[$idx]['R01_Relationship'])?'':getRelationship(h($invites[$idx]['R01_Relationship']))?>
			</td>
		</tr>
		<tr>
			<th class="required">携帯電話番号</th>
			<td>
				<?=h($invites[$idx]['R01_Mobile_No'])?>
			</td>
		</tr>
		<tr>
			<th class="required">メールアドレス</th>
			<td>
				<?=h($invites[$idx]['R01_Email'])?>
			</td>
		</tr>
		<tr class="copy">
			<th class="required copy">自宅郵便番号</th>
			<td>
				<?=h($invites[$idx]['R01_Postal1']).'-'.h($invites[$idx]['R01_Postal2'])?>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">都道府県</th>
			<td>
				<?=empty($invites[$idx]['R01_Prefecture'])?'':getPrefecture(h($invites[$idx]['R01_Prefecture']))?>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">市区郡</th>
			<td>
				<?=h($invites[$idx]['R01_Address'])?>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">町村名番地番号</th>
			<td>
				<?=h($invites[$idx]['R01_Address2'])?>
			</td>
		</tr>
		<tr class="copy">
			<th>建物名・部屋番号等</th>
			<td>
				<?=h($invites[$idx]['R01_Address3'])?>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">連絡先電話番号</th>
			<td>
				<?=h($invites[$idx]['R01_Tel_No'])?>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">ご旅行中の緊急連絡先：お名前</th>
			<td>
				<?=h($invites[$idx]['R01_Emer_Name'])?>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">ご旅行中の緊急連絡先：続柄</th>
			<td>
				<?=h($invites[$idx]['R01_Emer_Relationship'])?>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">ご旅行中の：電話番号</th>
			<td>
				<?=h($invites[$idx]['R01_Emer_Tel_No'])?>
			</td>
		</tr>
		<!-- <tr class="baby">
			<th class="required">＜機内＞機内食について</th>
			<td>
				<?=get_label('機内食', h($invites[$idx]['R01_Baby_Meal']))?>
			</td>
		</tr> -->
		<!-- <tr class="baby">
			<th class="required">＜機内＞バシネットについて</th>
			<td>
				<?=get_label('バシネット', h($invites[$idx]['R01_Baby_Bassinet']))?>
				<?php if($invites[$idx]['R01_Baby_Bassinet']=='1'): ?>
				<br>
				身長 <?=h($invites[$idx]['R01_Baby_Height'])?>
				体重 <?=h($invites[$idx]['R01_Baby_Weight'])?>
				<?php endif; ?>
			</td>
		</tr> -->
		<tr class="baby">
			<th class="required">＜レストラン＞お子様用ハイチェアについて</th>
			<td>
				<?=get_label('ハイチェア', h($invites[$idx]['R01_Baby_Chair']))?>
			</td>
		</tr>
		<tr class="baby">
			<th class="required">＜ホテル＞ベビーベッドのご希望について</th>
			<td>
				<?=get_label('ベビーベッド', h($invites[$idx]['R01_Baby_Bed']))?>
			</td>
		</tr>
		<!-- <tr class="baby">
			<th class="required">＜滞在中＞ベビーカーのレンタルについて</th>
			<td>
				<?=get_label('ベビーカー', h($invites[$idx]['R01_Baby_Car']))?>
			</td>
		</tr> -->
	</table>
	<?php 
	endfor; 
	endif;
	?>
	<div style="text-align: center;">
	<div class="his-button" style="border-radius: 5px;">
	<?php if(empty_date($common['R01_Update_Date'])):?>
		<input type="image" src="<?php echo base_url();?>img/back.png" onclick="go_back_reserver();"/>
	<?php else:?>
		<input type="image" src="<?php echo base_url();?>img/back.png" onclick="go_back_entry();"/>
	<?php endif;?>
	&nbsp;&nbsp;&nbsp;
		<input type="image" src="<?php echo base_url();?>img/confirm.png"  onclick="reserve();"/>
	</div>
	</div>
	</form>
</section>