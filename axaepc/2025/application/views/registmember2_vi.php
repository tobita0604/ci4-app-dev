<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
<!-- Section1 about---------------------------------------------------> 
<style>
	th.required::after {
		content: "[必須]";
		color:red;
		font-weight:bold
	}
	.border2.gai th {
		background: #ffff99;
	}
	.border2.cxl th {
		background: #e5e5e5;
	}
	.border2.gai.cxl th {
		background: #e5e5e5;
	}
	.gai tr:first-child th:first-child::after {
		content: "招待外";
		color:red;
	}
	/*.cxl tr:first-child th:first-child::after {
		content: "不参加";
		color:red;
	}
	.gai.cxl tr:first-child th:first-child::after {
		content: "招待外 不参加";
		color:red;
	}*/
</style>
<section id="about">
<div id="main">
<!-- システムメッセージ -->
<div id="systemMsg"></div>
<div style="white-space:nowrap">
<div class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">人数<br class="nobr">登録</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-2em" class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">本人<br class="nobr">登録</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-4em" class="arrow-container current">
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
<form action="<?php echo base_url();?>register_con/save_member" method="post" autocomplete="off" id="entry_data" > 
	<?php require(APPPATH . "views/element/csrf_input.php"); ?>
	<?php 
	$no = $idx + 1;
	?>
	<h2 style ="background:#005084">EPC2021沖縄大会　参加受付　同伴者<?=$no?>登録</h2>
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<table class="border2 invite" width="100%" id="invite0">
		<tr>
			<th width="30%">お名前</th>
			<td>
				<?=$reserve['R01_Name']?>
				<input type="hidden" name="reserve[R01_Name]" value="<?=$reserve['R01_Name']?>"/>
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
			<th>４Q家族招待CP</th>
			<td>
				<?=get_label('4Q',$common['R01_4Q_Flg'])?>
			</td>
		</tr>
		<tr>
			<th>xx無料権利</th>
			<td>
				<?=get_label('パーク',$common['R01_Park_Flg'])?>
				<?=$common['R01_Park_Flg']=='1'?PARK_NOTE:''?>
			</td>
		</tr>
		<tr>
-->
			<th>招待人数（本人含む）</th>
			<td>
				<?=$common['R01_Free_Invites']?>
			</td>
		</tr>
		<tr>
			<th>自費参加者</th>
			<td>
				<?=$common['R01_Charge_Invites']?><?=INVITES_NOTE ?>
			</td>
		</tr>
	</table>
	<table class="border2 invite <?=!empty($invites[$idx]['R01_Cancel_Flg'])?'cxl':''?> <?=$gai?>" id="invite<?=$no?>">
		<tr>
			<th colspan="2">
				■<?=$no<$common['R01_Free_Invites']?'招待':''?>同伴者<?=$no?>
				<?php if($no<$common['R01_Free_Invites'] && $common['R01_Update_Date']=='0000-00-00 00:00:00'):?>
				<br>
				※ご招待の同伴者が参加されない場合は、
				未入力のまま「次へ」へお進みください。
				<?php endif; ?>
				<input type="hidden" name="invite[R01_Entry_Flg]" value="0"/>
				<input type="hidden" name="invite[R01_Cancel_Flg]" value="0"/>
				<?php if(date('Y-m-d H:i:s') < ENTRY_LIMIT): ?>
				<span style="float:right">
					<input type="checkbox" id="R01_Cancel_Flg" name="invite[R01_Cancel_Flg]" value="1" <?=!empty($invites[$idx]['R01_Cancel_Flg'])?'checked':''?> onclick="cancel_member(this)">
					<label for="R01_Cancel_Flg">不参加</label>
				</span>
				<?php endif;?>
			</th>
		</tr>
		<tr>
			<th class="required" style="width:30%">お名前</th>
			<td>
				<input type="text" name="invite[R01_Name]" value="<?=$invites[$idx]['R01_Name']?>" />
				<span class="error_msg" id="R01_Name_error"></span>
			</td>
		</tr>
		<tr>
			<th class="required">お名前:姓（カタカナ）</th>
			<td>
				<input type="text" name="invite[R01_Roma_Last]" id="R01_Roma_Last" value="<?=$invites[$idx]['R01_Roma_Last']?>" />
				<span class="error_msg" id="R01_Roma_Last_error"></span>
			</td>
		</tr>
		<tr>
			<th class="required">お名前:名（カタカナ）</th>
			<td>
				<input type="text" name="invite[R01_Roma_First]" id="R01_Roma_First" value="<?=$invites[$idx]['R01_Roma_First']?>" />
				<span class="error_msg" id="R01_Roma_First_error"></span>
			</td>
		</tr>
		<tr>
			<th class="required">生年月日</th>
			<td>
				<?
					$Number_arr = explode_date($invites[$idx]['R01_Birthdate']);
				?>
				<input type="text" name="invite[Birth_Year]" id="Birth_Year" value="<?=$Number_arr[0]?>" size="4" class="digits" onchange="age_changed()"/>年
				<input type="text" name="invite[Birth_Month]" id="Birth_Month" value="<?=$Number_arr[1]?>" size="4" class="digits" onchange="age_changed()"/>月
				<input type="text" name="invite[Birth_Day]" id="Birth_Day" value="<?=$Number_arr[2]?>" size="4" class="digits" onchange="age_changed()"/>日
				<span class="error_msg" id="R01_Birthdate_error"></span>
			</td>
		</tr>
		<tr>
			<th class="required">年齢</th>
			<td>
				<input type="text" name="invite[R01_Age]" value="<?=$invites[$idx]['R01_Age']?>" size="2" class="digits"/>
				<span class="error_msg" id="R01_Age_error"></span>
			</td>
		</tr>
		<tr>
			<th class="required">性別</th>
			<td>
				<input type="hidden" name="invite[R01_Gender]" value="0" />
				<input type="radio" id="R01_Gender_1" name="invite[R01_Gender]" value="1" <?='1'==$invites[$idx]['R01_Gender']?'checked':''?>/>
				<label for="R01_Gender_1">男性</label><br>
				<input type="radio" id="R01_Gender_2" name="invite[R01_Gender]" value="2" <?='2'==$invites[$idx]['R01_Gender']?'checked':''?>/>
				<label for="R01_Gender_2">女性</label><br>
				<p class="error_msg" id="R01_Gender_error"></p>
			</td>
		</tr>
		<tr>
			<th class="required">続柄</th>
			<td>
				入賞者本人の <select name="invite[R01_Relationship]">
					<option value="0" selected="selected">選択してください</option>
					<?php foreach(getRelationship() as $id => $val):?>
					<option value="<?php echo $id ?>" <?=$id==$invites[$idx]['R01_Relationship']?'selected':''?>><?php echo $val ?></option>
					<?php endforeach;?>
				</select> 
				<span class="error_msg" id="R01_Relationship_error"></span><br>
				※注意：「本部承認済」は事前に本部が承認したもののみ選択できます
				
			</td>
		</tr>
		<tr>
			<th class="">携帯電話番号</th>
			<td>
				<?
					$Number_arr = explode_date($invites[$idx]['R01_Mobile_No']);
				?>
				<input type="text" name="invite[Mobile1]" value="<?=$Number_arr[0]?>" size="4"/> -
				<input type="text" name="invite[Mobile2]" value="<?=$Number_arr[1]?>" size="4"/> -
				<input type="text" name="invite[Mobile3]" value="<?=$Number_arr[2]?>" size="4"/>
				<span class="error_msg" id="R01_Mobile_No_error"></span>
			</td>
		</tr>
		<tr>
			<th class="">メールアドレス</th>
			<td>
				<input type="text" name="invite[R01_Email]" value="<?=$invites[$idx]['R01_Email']?>" size="35"/>
				<span class="error_msg" id="R01_Email_error"></span><br>
				<input type="text" name="invite[R01_Email_cfm]" value="<?=$invites[$idx]['R01_Email']?>" size="35"/>（確認用）
				<span class="error_msg" id="R01_Email_cfm_error"></span>
			</td>
		</tr>
		<tr>
			<th colspan="2">
				<input type="checkbox" name="invite[copy]" value="1" onchange="copy_checked(this)" />代表者と同じ 
			</th>
		</tr>
		<tr class="copy">
			<th class="required copy">自宅郵便番号</th>
			<td>
				<input type="text" name="invite[R01_Postal1]" value="<?=$invites[$idx]['R01_Postal1']?>" size="3" class="digits"/> -
				<input type="text" name="invite[R01_Postal2]" value="<?=$invites[$idx]['R01_Postal2']?>" size="4" class="digits"/>
				<span class="error_msg" id="R01_Postal_error"></span>
				<input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('invite[R01_Postal1]','invite[R01_Postal2]','invite[R01_Prefecture]','invite[R01_Address]');"/>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">都道府県</th>
			<td>
				<select name="invite[R01_Prefecture]">
					<option value="0" selected="selected">選択してください</option>
					<?php foreach(getPrefecture() as $id => $val):?>
					<option value="<?php echo $id ?>" <?=$id==$invites[$idx]['R01_Prefecture']?'selected':''?>><?php echo $val ?></option>
					<?php endforeach;?>
				</select> 
				<span class="error_msg" id="R01_Prefecture_error"></span>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">自宅住所</th>
			<td>
				<input type="text" name="invite[R01_Address]" value="<?=$invites[$idx]['R01_Address']?>" size="35"/>
				<span class="error_msg" id="R01_Address_error"></span>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">連絡先電話番号</th>
			<td>
				<?
					$Number_arr = explode_date($invites[$idx]['R01_Tel_No']);
				?>
				<input type="text" name="invite[Tel1]" value="<?=$Number_arr[0]?>" size="4"/> -
				<input type="text" name="invite[Tel2]" value="<?=$Number_arr[1]?>" size="4"/> -
				<input type="text" name="invite[Tel3]" value="<?=$Number_arr[2]?>" size="4"/>
				<span class="error_msg" id="R01_Tel_No_error"></span>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">沖縄ご旅行中の緊急連絡先：お名前</th>
			<td>
				<input type="text" name="invite[R01_Emer_Name]" value="<?=$invites[$idx]['R01_Emer_Name']?>" />
				<span class="error_msg" id="R01_Emer_Name_error"></span>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">沖縄ご旅行中の緊急連絡先：続柄</th>
			<td>
				<input type="text" name="invite[R01_Emer_Relationship]" value="<?=$invites[$idx]['R01_Emer_Relationship']?>" />
				<span class="error_msg" id="R01_Emer_Relationship_error"></span>
			</td>
		</tr>
		<tr class="copy">
			<th class="required">沖縄ご旅行中の緊急連絡先：電話番号</th>
			<td>
				<?
					$Number_arr = explode_date($invites[$idx]['R01_Emer_Tel_No']);
				?>
				<input type="text" name="invite[Emer1]" value="<?=$Number_arr[0]?>" size="4"/> -
				<input type="text" name="invite[Emer2]" value="<?=$Number_arr[1]?>" size="4"/> -
				<input type="text" name="invite[Emer3]" value="<?=$Number_arr[2]?>" size="4"/>
				<span class="error_msg" id="R01_Emer_Tel_No_error"></span>
			</td>
		</tr>
		<tr class="baby">
			<th colspan="2">
				お子様アンケート
			</th>
		</tr>
		<tr class="baby">
			<th class="required">＜レストラン＞お子様用ハイチェアについて</th>
			<td>
				<input type="hidden" name="invite[R01_Baby_Chair]" value="0" />
				<input type="radio" id="R01_Baby_Chair_1" name="invite[R01_Baby_Chair]" value="1" <?='1'==$invites[$idx]['R01_Baby_Chair']?'checked':''?>/>
				<label for="R01_Baby_Chair_1">希望する</label><br>
				<input type="radio" id="R01_Baby_Chair_2" name="invite[R01_Baby_Chair]" value="2" <?='2'==$invites[$idx]['R01_Baby_Chair']?'checked':''?>/>
				<label for="R01_Baby_Chair_2">希望しない</label>
				<p class="error_msg" id="R01_Baby_Chair_error"></p>
				２歳以下のお子様に限り、パーティ時にハイチェアをご用意することが可能です。<br>
				ただし、席数が非常に少ないため、ご希望にそえない場合もございますので、予めご 了承ください。<br>
			</td>
		</tr>
		<tr class="baby">
			<th class="required">＜ホテル＞ベビーベッドのご希望について</th>
			<td>
				<input type="hidden" name="invite[R01_Baby_Bed]" value="0" />
				<input type="radio" id="R01_Baby_Bed_1" name="invite[R01_Baby_Bed]" value="1" <?='1'==$invites[$idx]['R01_Baby_Bed']?'checked':''?>/>
				<label for="R01_Baby_Bed_1">希望する</label><br>
				<input type="radio" id="R01_Baby_Bed_2" name="invite[R01_Baby_Bed]" value="2" <?='2'==$invites[$idx]['R01_Baby_Bed']?'checked':''?>/>
				<label for="R01_Baby_Bed_2">希望しない</label>
				<p class="error_msg" id="R01_Baby_Bed_error"></p>
				ベビーベッドサイズ　102cm x 67cm x 98cm<br>
				※0歳～1歳半まで利用できます。<br>
				ホテルの安全規則により、ベビーベッド用の毛布と枕のご用意はございません。
			</td>
		</tr>
	</table>
	
</form>
<div style="text-align: center;margin-top:1em;">
<div class="his-button" style="border-radius: 5px;">
	
<?php if(empty($back_to_top)):?>
	<input type="image"  src="<?php echo base_url();?>img/back.png" onclick="go_back_entry();"/>
<?php else:?>
	<input type="image"  src="<?php echo base_url();?>img/back.png" onclick="go_back_entry_no();"/>
<?php endif;?>

</div>
</div>
	
</section>
<div id="dialog-confirm" title="確認">
	<p>未入力の項目があります。<br>後程入力する場合、「続行」ボタンを押して全参加者の入力後、最後の確認画面で更新すると保存されます。<br>3/7（木）までに入力ください。</p>
</div>