<section id="about">
	
	
	
<div id="main">
	

<!-- システムメッセージ -->








<div id="systemMsg">
</div>



<form action="<?php echo base_url();?>entry_con/confirm" method="post" autocomplete="off" id="entry_data" > 
 <table class="border2" width="100%"><tbody>
	<tr>
		<th width="35%" class="back_skybule"><div align="left">社員番号</div></th>
		<td class="f_weight_bolder" style="text-align:left;"><?php echo $R00_Id ;?></td>
	</tr>
 
	 
	
									
</tbody></table>
<p style="font-weight: bolder; color: #f00;font-size:15px">以下の情報を入力して下さい。</p>
<p  style="color: #f00;">※印は必須項目です。</p>

  <h2 style ="background:#005084">■アクサ生命保険株式会社　2021年度沖縄旅行に参加する</h2>
  <div style ="text-align: center;
    font-size: 20px;
    font-weight: bold;">
	<span class="error_msg" id="course_error" style="color:red;font-size:10;"></span></br>
  <input type ="radio" name ="course" id = "course1" value ="1" <?php if(($R00_kibou != "XX") && ($R00_kibou != "")){echo "checked" ;} ?> onchange = "handlechange();"><label for="course1"> 参加する</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type ="radio" name ="course" id = "course2" value = "0"  <?php if($R00_kibou == "XX") {echo "checked" ;} ?> onchange = "handlechange();"><label for="course2"> 参加しない</label>
  </div>
	<div id ="sanka_flag" style ="display:none;">
	<h2>■参加コースの選択</h2>
	
	<table class="border2" width="100%">
		<tr>
			<th>選択</th> 
			<th>コース名 </th>                       
			<th>旅行日程 </th> 
		</tr>
		<tr>
		 <p class="error_msg" id="courseselect_error" style="color:red;font-size:10;"></p>
			<td class="center">
				<input type="radio" name="R00_kibou" value="1" <?php if($R00_kibou == "1") {echo "checked" ;} ?> id = "courseselect1">
			</td>
			<td class="center">
				1班
			</td>
			<td class="center">
				2月5日(月)-2月7日(水)
			</td>
		</tr>
		<tr>
			<td class="center">
				<input type="radio" name="R00_kibou" value="2" <?php if($R00_kibou == "2") {echo "checked" ;} ?> id = "courseselect2">
			</td>
			<td class="center">
				2班
			</td>
			<td class="center">
				2月6日(火)-2月8日(木)

			</td>
		</tr>
	</table>
  <h2>■加者情報</h2>
  <h4>■基本情報</h4>
  <table class="border2" width="100%">
<tr>
<th colspan="2"><div align="center">◆基本情報</th></tr>
<tr><th width="30%">お名前（漢字）<strong class="required">※</strong></th>
	<td><p>姓
	  <input type="text" name="R00_Sei" id="R00_Sei" value="<?php echo $R00_Sei ; ?>"  style="width:25%;"  />
	例)山田</p>
	  <p>名
<input type="text" name="R00_Name" id="R00_Name" value="<?php echo $R00_Name ?>"  style="width:25%;" />
	  例)太郎</p>
	  <p class="error_msg" id="Name_Kanji_error" style="color:red;font-size:10;"></p></td>
</tr>
<tr><th>お名前（カナ）<strong class="required">※</strong></br>半角で入力してください。</th>
	<td><p>セイ
	  <input type="text" name="R00_Sei_Kana" id="R00_Sei_Kana" value="<?php echo $R00_Sei_Kana ?>"  style="width:25%;" /> 
	  
	  例)ﾔﾏﾀﾞ</p>
	  <p>メイ
        <input type="text" name="R00_Name_Kana" id="R00_Name_Kana" value="<?php echo $R00_Name_Kana ?>"  style="width:25%;"  />
	  例)ﾀﾛｳ</p>
	  <p class="error_msg" id="Name_Kana_error" style="color:red;font-size:10;"></p>
	  </td>
</tr>

<tr>
  <th>性別</th>
  <td>
	<input type="radio" id="R00_Sex_0" name="R00_Sex" value="0" <?php echo $R00_Sex==0 ? 'checked':''; ?>/><label for="R00_Sex_0">男性</label>
	<input type="radio" id="R00_Sex_1" name="R00_Sex" value="1" <?php echo $R00_Sex==1 ? 'checked':''; ?>/><label for="R00_Sex_1">女性</label>
  </td>
</tr>
<tr>

<th>生年月日<strong class="required">※</strong></th>
<td><input type="text" name="R00_Birth_Date" id="R00_Birth_Date" value="<?php echo htmlentities($R00_Birth_Date,ENT_QUOTES, "UTF-8"); ?>" size="30" />
<span class="error_msg" id="birthday_error" style="color:red;font-size:12;"></span>

</td>
</tr>
<tr>
<th>国籍<strong class="required">※</strong></th>
<td>
<input type="radio" id="R00_Nationality_0" name="R00_Nationality" value="日本" <?php echo $R00_Nationality=="日本" ? 'checked':''; ?> onchange ="country_flag();"/><label for="R00_Nationality_0">日本</label>&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" id="R00_Nationality_1" name="R00_Nationality" value="0" <?php if(($R00_Nationality!="日本")&&($R00_Nationality!="")){ echo  'checked' ;} ?> onchange ="country_flag();"/><label for="R00_Nationality_1">その他(その他の方は、国籍をご記入ください)</label>
	<input type="text" name="R00_Nationality_other" id="R00_Nationality_other" value="<?php echo $R00_Nationality ?>"  style="width:25%;display:none"  />
<span class="error_msg" id="country_error" style="color:red;font-size:12;"></span>


</td>
</tr>
<tr>
	<th>E-mail<strong class="required">※</strong></th>
	<td>
<p>パソコンメールアドレス、携帯メールアドレスどちらも可</p>

	<p><input type="text" name="R00_Email" id="R00_Email" style="width:50%;" value="<?php echo $R00_Email;?>"/>
      <br /></p>
      <span class="error_msg" id="Email_error" style="color:red;font-size:10;"></span>
      <p>
        <input type="text" name="R00_Email_conf" id="R00_Email_conf" value=""  style="width:50%;" />
        (確認)
        <span class="error_msg" id="Email_conf_error" style="color:red;font-size:10;"></span></p></td>
	</td>
	</tr>
</table>
  
  <table class="border2" width="100%">
<tr>
<th colspan="2"><div align="center">ご自宅住所・電話番号</th></tr>
<tr>
<th width="30%">郵便番号<br>（半角入力）</th>
<td><a id="anchor___search_7"></a>
	<input type="text" name="R00_Zip21" id="R00_Zip21" value="<?php echo $R00_Zip21 ;?>" style="width: 3em;" maxlength="3em" /> - 
	<input type="text" name="R00_Zip22" id="R00_Zip22" value="<?php echo $R00_Zip22 ;?>" style="width: 4em;" maxlength="4em" />
	<span class="error_msg" id="Prin_Postal_error"style="color:red;font-size:10;"></span><input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('R00_Zip21','R00_Zip22','R00_Town','R00_Address');"/><br>
</td>
</tr>
<tr>
<th>都道府県</th>

<td><select name="R00_Town" id="R00_Town">	<option value="" selected="selected">選択してください</option>
	<option value="1" <?php if($R00_Town==1 ){echo "selected";}?> >北海道</option>
	<option value="2" <?php if($R00_Town==2 ){echo "selected";}?> >青森県</option>
	<option value="3" <?php if($R00_Town==3 ){echo "selected";}?> >岩手県</option>
	<option value="4" <?php if($R00_Town==4 ){echo "selected";}?> >宮城県</option>
	<option value="5" <?php if($R00_Town==5 ){echo "selected";}?> >秋田県</option>
	<option value="6" <?php if($R00_Town==6 ){echo "selected";}?> >山形県</option>
	<option value="7" <?php if($R00_Town==7 ){echo "selected";}?> >福島県</option>
	<option value="8" <?php if($R00_Town==8 ){echo "selected";}?> >茨城県</option>
	<option value="9" <?php if($R00_Town==9 ){echo "selected";}?> >栃木県</option>
	<option value="10" <?php if($R00_Town==10 ){echo "selected";}?> >群馬県</option>
	<option value="11" <?php if($R00_Town==11 ){echo "selected";}?> >埼玉県</option>
	<option value="12" <?php if($R00_Town==12 ){echo "selected";}?> >千葉県</option>
	<option value="13" <?php if($R00_Town==13 ){echo "selected";}?> >東京都</option>
	<option value="14" <?php if($R00_Town==14 ){echo "selected";}?> >神奈川県</option>
	<option value="15" <?php if($R00_Town==15 ){echo "selected";}?> >新潟県</option>
	<option value="16" <?php if($R00_Town==16 ){echo "selected";}?> >富山県</option>
	<option value="17" <?php if($R00_Town==17 ){echo "selected";}?> >石川県</option>
	<option value="18" <?php if($R00_Town==18 ){echo "selected";}?> >福井県</option>
	<option value="19" <?php if($R00_Town==19 ){echo "selected";}?> >山梨県</option>
	<option value="20" <?php if($R00_Town==20 ){echo "selected";}?> >長野県</option>
	<option value="21" <?php if($R00_Town==21 ){echo "selected";}?> >岐阜県</option>
	<option value="22" <?php if($R00_Town==22 ){echo "selected";}?> >静岡県</option>
	<option value="23" <?php if($R00_Town==23 ){echo "selected";}?> >愛知県</option>
	<option value="24" <?php if($R00_Town==24 ){echo "selected";}?> >三重県</option>
	<option value="25" <?php if($R00_Town==25 ){echo "selected";}?> >滋賀県</option>
	<option value="26" <?php if($R00_Town==26 ){echo "selected";}?> >京都府</option>
	<option value="27" <?php if($R00_Town==27 ){echo "selected";}?> >大阪府</option>
	<option value="28" <?php if($R00_Town==28 ){echo "selected";}?> >兵庫県</option>
	<option value="29" <?php if($R00_Town==29 ){echo "selected";}?> >奈良県</option>
	<option value="30" <?php if($R00_Town==30 ){echo "selected";}?> >和歌山県</option>
	<option value="31" <?php if($R00_Town==31 ){echo "selected";}?> >鳥取県</option>
	<option value="32" <?php if($R00_Town==32 ){echo "selected";}?> >島根県</option>
	<option value="33" <?php if($R00_Town==33 ){echo "selected";}?> >岡山県</option>
	<option value="34" <?php if($R00_Town==34 ){echo "selected";}?> >広島県</option>
	<option value="35" <?php if($R00_Town==35 ){echo "selected";}?> >山口県</option>
	<option value="36" <?php if($R00_Town==36 ){echo "selected";}?> >徳島県</option>
	<option value="37" <?php if($R00_Town==37 ){echo "selected";}?> >香川県</option>
	<option value="38" <?php if($R00_Town==38 ){echo "selected";}?> >愛媛県</option>
	<option value="39" <?php if($R00_Town==39 ){echo "selected";}?> >高知県</option>
	<option value="40" <?php if($R00_Town==40 ){echo "selected";}?> >福岡県</option>
	<option value="41" <?php if($R00_Town==41 ){echo "selected";}?> >佐賀県</option>
	<option value="42" <?php if($R00_Town==42 ){echo "selected";}?> >長崎県</option>
	<option value="43" <?php if($R00_Town==43 ){echo "selected";}?> >熊本県</option>
	<option value="44" <?php if($R00_Town==44 ){echo "selected";}?> >大分県</option>
	<option value="45" <?php if($R00_Town==45 ){echo "selected";}?> >宮崎県</option>
	<option value="46" <?php if($R00_Town==46 ){echo "selected";}?> >鹿児島県</option>
	<option value="47" <?php if($R00_Town==47 ){echo "selected";}?> >沖縄県</option>
	<option value="99" <?php if($R00_Town==99 ){echo "selected";}?> >海外</option>
</select> 
<span class="error_msg" id="Prin_Prefectures_error" style="color:red;font-size:10;">
</td>
</tr>
<tr>
<th>それ以降の住所</th>
<td><input type="text" name="R00_Address" id="R00_Address" value="<?php echo $R00_Address ;?>" style="width:50%;" /><span class="error_msg" id="R00_Address" style="color:red;font-size:10;"></span>
</td>
</tr>
<tr>
<th>マンション名</th>
<td><input type="text" name="R00_Address2" id="R00_Address2" value="<?php echo $R00_Address2 ;?>" style="width:50%;"  /><span class="error_msg" id="R00_Address2" style="color:red;font-size:10;"></span>
</td>
</tr>

<tr>
<th>ご自宅TEL<br><span style="font-size:small">(半角入力。ハイフンを入れてください。）</span></th>
<td><input type="text" name="R00_Prin_Phone" id="R00_Prin_Phone" value="<?php echo $R00_Prin_Phone ;?>" style="width: 30%;"  />
</td>
</tr>
<tr>
<th>携帯電話番号<br><span style="font-size:small">(半角入力。ハイフンを入れてください。）</span></th>
<td><input type="text" name="R00_Prin_Fax" id="R00_Prin_Fax" value="<?php echo $R00_Prin_Fax ;?>" style="width: 30%;"  /></span>
</td>
</tr>
</table>
	  <table class="border2" width="100%">
	<tr>
	<th colspan="2"><div align="center">店舗情報</th></tr>

	<tr>
	<th width="30%">店舗名<strong class="required">※</strong></th>
	<td><input type="text" name="R00_Company" id="R00_Company" value="<?php echo $R00_Company ;?>" style="width:70%;" />
	<span class="error_msg" id="Emp_Company_Name_error" style="color:red;font-size:10;"></span>
	</td>
	</tr>
	
	<tr>
	<th>役職</th>
	<td><input type="text" name="R00_Division" id="R00_Division" value="<?php echo $R00_Division ;?>" style="width:70%;" /><span class="error_msg" id="Emp_Position_error" style="color:red;font-size:10;"></span></td><p class="error_msg" style="color:red;font-size:10;"></p>
	</tr>
	
	
	<!--<tr>
	<th>郵便番号</th>
	<td><a id="anchor___search_19"></a><input type="text" name="R00_Emp_Postal_1" id="R00_Emp_Postal_1" value="<?php echo $R00_Emp_Postal_1 ;?>" style="width: 3em;" maxlength="3em" /> - 
	<input type="text" name="R00_Emp_Postal_2" id="R00_Emp_Postal_2" value="<?php echo $R00_Emp_Postal_2 ;?>" style="width: 4em;" maxlength="4em" /><span class="error_msg" id="Emp_Postal_error" style="color:red;font-size:10;"></span>  <input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('R00_Emp_Postal_1','R00_Emp_Postal_2','R00_Emp_Prefectures','R00_Emp_City');"/></td><p class="error_msg" style="color:red;font-size:10;"></p>
	</tr>
	<tr>
	<th>都道府県</th>
	<td><select name="R00_Emp_Prefectures" id="R00_Emp_Prefectures">
		<option value="" selected="selected">選択してください</option>
		<option value="1" <?php if($R00_Emp_Prefectures==1 ){echo "selected";}?> >北海道</option>
		<option value="2" <?php if($R00_Emp_Prefectures==2 ){echo "selected";}?> >青森県</option>
		<option value="3" <?php if($R00_Emp_Prefectures==3 ){echo "selected";}?> >岩手県</option>
		<option value="4" <?php if($R00_Emp_Prefectures==4 ){echo "selected";}?> >宮城県</option>
		<option value="5" <?php if($R00_Emp_Prefectures==5 ){echo "selected";}?> >秋田県</option>
		<option value="6" <?php if($R00_Emp_Prefectures==6 ){echo "selected";}?> >山形県</option>
		<option value="7" <?php if($R00_Emp_Prefectures==7 ){echo "selected";}?> >福島県</option>
		<option value="8" <?php if($R00_Emp_Prefectures==8 ){echo "selected";}?> >茨城県</option>
		<option value="9" <?php if($R00_Emp_Prefectures==9 ){echo "selected";}?> >栃木県</option>
		<option value="10" <?php if($R00_Emp_Prefectures==10 ){echo "selected";}?> >群馬県</option>
		<option value="11" <?php if($R00_Emp_Prefectures==11 ){echo "selected";}?> >埼玉県</option>
		<option value="12" <?php if($R00_Emp_Prefectures==12 ){echo "selected";}?> >千葉県</option>
		<option value="13" <?php if($R00_Emp_Prefectures==13 ){echo "selected";}?> >東京都</option>
		<option value="14" <?php if($R00_Emp_Prefectures==14 ){echo "selected";}?> >神奈川県</option>
		<option value="15" <?php if($R00_Emp_Prefectures==15 ){echo "selected";}?> >新潟県</option>
		<option value="16" <?php if($R00_Emp_Prefectures==16 ){echo "selected";}?> >富山県</option>
		<option value="17" <?php if($R00_Emp_Prefectures==17 ){echo "selected";}?> >石川県</option>
		<option value="18" <?php if($R00_Emp_Prefectures==18 ){echo "selected";}?> >福井県</option>
		<option value="19" <?php if($R00_Emp_Prefectures==19 ){echo "selected";}?> >山梨県</option>
		<option value="20" <?php if($R00_Emp_Prefectures==20 ){echo "selected";}?> >長野県</option>
		<option value="21" <?php if($R00_Emp_Prefectures==21 ){echo "selected";}?> >岐阜県</option>
		<option value="22" <?php if($R00_Emp_Prefectures==22 ){echo "selected";}?> >静岡県</option>
		<option value="23" <?php if($R00_Emp_Prefectures==23 ){echo "selected";}?> >愛知県</option>
		<option value="24" <?php if($R00_Emp_Prefectures==24 ){echo "selected";}?> >三重県</option>
		<option value="25" <?php if($R00_Emp_Prefectures==25 ){echo "selected";}?> >滋賀県</option>
		<option value="26" <?php if($R00_Emp_Prefectures==26 ){echo "selected";}?> >京都府</option>
		<option value="27" <?php if($R00_Emp_Prefectures==27 ){echo "selected";}?> >大阪府</option>
		<option value="28" <?php if($R00_Emp_Prefectures==28 ){echo "selected";}?> >兵庫県</option>
		<option value="29" <?php if($R00_Emp_Prefectures==29 ){echo "selected";}?> >奈良県</option>
		<option value="30" <?php if($R00_Emp_Prefectures==30 ){echo "selected";}?> >和歌山県</option>
		<option value="31" <?php if($R00_Emp_Prefectures==31 ){echo "selected";}?> >鳥取県</option>
		<option value="32" <?php if($R00_Emp_Prefectures==32 ){echo "selected";}?> >島根県</option>
		<option value="33" <?php if($R00_Emp_Prefectures==33 ){echo "selected";}?> >岡山県</option>
		<option value="34" <?php if($R00_Emp_Prefectures==34 ){echo "selected";}?> >広島県</option>
		<option value="35" <?php if($R00_Emp_Prefectures==35 ){echo "selected";}?> >山口県</option>
		<option value="36" <?php if($R00_Emp_Prefectures==36 ){echo "selected";}?> >徳島県</option>
		<option value="37" <?php if($R00_Emp_Prefectures==37 ){echo "selected";}?> >香川県</option>
		<option value="38" <?php if($R00_Emp_Prefectures==38 ){echo "selected";}?> >愛媛県</option>
		<option value="39" <?php if($R00_Emp_Prefectures==39 ){echo "selected";}?> >高知県</option>
		<option value="40" <?php if($R00_Emp_Prefectures==40 ){echo "selected";}?> >福岡県</option>
		<option value="41" <?php if($R00_Emp_Prefectures==41 ){echo "selected";}?> >佐賀県</option>
		<option value="42" <?php if($R00_Emp_Prefectures==42 ){echo "selected";}?> >長崎県</option>
		<option value="43" <?php if($R00_Emp_Prefectures==43 ){echo "selected";}?> >熊本県</option>
		<option value="44" <?php if($R00_Emp_Prefectures==44 ){echo "selected";}?> >大分県</option>
		<option value="45" <?php if($R00_Emp_Prefectures==45 ){echo "selected";}?> >宮崎県</option>
		<option value="46" <?php if($R00_Emp_Prefectures==46 ){echo "selected";}?> >鹿児島県</option>
		<option value="47" <?php if($R00_Emp_Prefectures==47 ){echo "selected";}?> >沖縄県</option>
		<option value="99" <?php if($R00_Emp_Prefectures==99 ){echo "selected";}?> >海外</option>
	</select>
	<span class="error_msg" id="Emp_Prefectures_error" style="color:red;font-size:10;"></span>
	</td>
	</tr>
	<tr>
	<th>市区群町名</th>
	<td><input type="text" name="R00_Emp_City" id="R00_Emp_City" value="<?php echo $R00_Emp_City;?>" style="width:70%;"  /><span class="error_msg" id="Emp_City_error" style="color:red;font-size:10;"></span></td>
	</tr>
	<tr>
	<th>番地</th>
	<td><input type="text" name="R00_Emp_Towns_Villages" id="R00_Emp_Towns_Villages" value="<?php echo $R00_Emp_Towns_Villages;?>" style="width:70%;"  /><span class="error_msg" id="Emp_Towns_Villages_error" style="color:red;font-size:10;"></span></td>
	</tr>
	
	<tr>
	<th>店舗TEL</th>
	<td><input type="text" name="R00_Company_Tel" id="R00_Company_Tel" value="<?php echo $R00_Company_Tel;?>" style="width: 30%" />
	</td>
	</tr>-->
	
	
	
	</table>

			<table class="border2" width="100%">
		<tr>
		<th colspan="2"><div  align ="center">パスポート</div></th></tr>

		<tr>
			<th width="30%">パスポートの有無<strong class="required"></strong></th>
			<td>
			
			<input type ="radio" name ="R00_Passport_Flag" value = "0" <?php if($R00_Passport_Flag == 0 ){ echo "checked" ;} ?> id = "flag0" onchange="passport_flag();">持っている&nbsp;&nbsp;&nbsp;&nbsp;
			<input type ="radio" name ="R00_Passport_Flag" value = "1" <?php if($R00_Passport_Flag == 1 ){ echo "checked" ;} ?> id = "flag1" onchange="passport_flag();">持っていない&nbsp;&nbsp;&nbsp;&nbsp;
			<input type ="radio" name ="R00_Passport_Flag" value = "9" <?php if($R00_Passport_Flag == 9 ){ echo "checked" ;} ?> id = "flag9"onchange="passport_flag();">申請中
			<p class="error_msg" id ="pass_error" style="color:red;font-size:10;"></p>
			<div id ="pptflag" style ="display:none">
			<strong>受領予定日 : </strong><input type="text" name="R00_Passport_Issue" id="R00_Passport_Issue" value="<?php echo $R00_Passport_Issue ;?>" size="20" />
			<p class="error_msg" id ="issue_error" style="color:red;font-size:10;"></p>
			</div>
			<p><a href = "<?php echo base_url();?>/pdf/passport.pdf" target = "_blank">★パスポートの申請手続きについて</a></p>
			</td>
		</tr>
		
			
	
		
		<th>パスポート名<strong class="required"></strong><br></th>
		<td><p>Lastname
			<input type="text" name="R00_Passport_Sei" id="R00_Passport_Sei" value="<?php echo $R00_Passport_Sei ;?>"  style="width:25%;"  onChange="to_ucase(this);" />
			例)YAMADA</p>
			<p>Firstname
			  <input type="text" name="R00_Passport_Name" id="R00_Passport_Name" value="<?php echo $R00_Passport_Name ;?>"  style="width:25%;" onChange="to_ucase(this);"/>
			  例)TARO<br>
			<p class="error_msg" id ="Name_Roman_error" style="color:red;font-size:10;"></p>

		</td>
		
		</tr>
		<tr>
		<th width="30%">パスポート画像のアップロード<strong class="required"></strong></th> 
			<td>12月21日(木)17:00までに、パスポートの顔写真のページの画像キャプチャをアップロードしてください。
				<?php
					if(($R00_Passport_Upload_Name != NULL) && ($R00_Passport_Upload_Name != "")) {
						$color="#33BFDB";
						$value = "再アップロード"
					?>
						<p style = "display:block;font-size:15px;font-weight:bold !important"  id = "org_img">アップロード済みです。</p>
						<p style="display:none;"id="link">画像アップロード</p>
						<p style="display:block;font-size :15px"id="link1">
						<a href="#" onclick="getImage('<?php echo $R00_Id; ?>')" >アップロード済画像の確認</a>
						</p>
					<?php
					} else {
						$color="red";
						$value = "アップロード"
					?>	
						<p style = "display:none;font-size:15px;"  id = "org_img">アップロード済みです。</p>
						<p style="display:none;font-weight:bold"id="link">画像アップロード</p>
						<p style="display:none;font-size :15px"id="link1">
						<a href="#" onclick="getImage('<?php echo $R00_Id; ?>')" >アップロード済画像の確認</a>
						<p>
					<?php
					}
					?>
						<p style = "font-size:15px;font-weight:bold !important" id = "name2"></p>
						<p style="font-size :15px; display: none;" id="name">
						<a href="#" onclick="getImage('<?php echo $R00_Id; ?>')" >アップロード済画像の確認</a>
						</p>
						<input type="file" name ="R00_Passport_Img_File" id = "R00_Passport_Img_File"/><br><br>
						<input type="button" name="uploadclick" id="uploadclick" style="background:<?php echo $color;?>;" value="<?php echo $value;?>" onclick="savePhoto();"></input>
						<br><br>
	
	<input type="hidden" name ="R00_Passport_Upload_Name" id = "R00_Passport_Upload_Name" value = "<?php if(isset($R00_Passport_Upload_Name)){ echo $R00_Passport_Upload_Name;} else{echo '';}?>"/>
	最大アップロードサイズ：10MB
	<br>アップロード可能なファイルタイプ（jpeg,pdf）<br>
				<!--</form>--> 
			</td>
		</tr>
		<tr>
			<td colspan ="2">
				<!--パスポートコピーをご提出ください。</br>-->
				入国時6ヵ月+滞在日数以上の残存があるパスポートが必要です。また、未使用査証欄が見開き2ページ以上が必要です。<br>
				本ツアーサイトにログインの上、「マイページ」もしくは「パスポート画像のアップロード」ボタンから12月21日(木)17:00までにパスポートの顔写真のページの画像キャプチャをアップロードしてください。</br>
				申請から受領までに、通常１週間程度（土・日・休日を除く）かかります。遅くても、12月19日(火)までには申請をお済ませの上、12月27日(水)までに、ツアーサイトの「マイページ」もしくは「パスポート画像のアップロード」ボタンからアップロードしてください。<br>
<!--こちらから、パスポートコピーを送りください。</br>
ファイル名に社員番号とお名前を入れてください。</br>
<span style ="color:#FF0000;font-size:18px;font-weight:bold">12月21日(木)まで</span></br>期限に間に合わない方は、受領でき次第、近畿日本ツーリストまでお送りください。</br>
-->
			</td>
		</tr>

		
		
	</table>
    
    
		<table class="border2" width="100%">
		<tr>
		<th colspan="2"><div align="center">渡航中の国内連絡先</center></th></tr>
		<tr>
		<th width="30%">渡航中の国内連絡先　氏名<strong class="required">※</strong></br><span style ="color:#FF0000;font-size:13px">　＊カタカナで入力ください。</span></th>
		<td><input type="text" name="R00_emargency_mei" id="R00_emargency_mei" value="<?php echo $R00_emargency_mei ;?>" style="width:50%;" />
		<span class="error_msg" id="Emer_Contact_Name_error" style="color:red;font-size:10;"></span>
		 </td>
		</tr>
		<tr>
		<th>続柄<strong class="required">※</strong></th>
		<td><input type="text" name="R00_emargency_zoku" id="R00_emargency_zoku" value="<?php echo $R00_emargency_zoku ;?>" style="width:50%;" />
		<span class="error_msg" id="Emer_Relationship_error" style="color:red;font-size:10;"></span>
		</td>
		</tr>
		<tr>
		<th>電話番号<strong class="required">※</strong><br><span style="font-size:small">(半角入力。ハイフンを入れてください。）</span></th>
		<td><input type="text" name="R00_emargency_tel" id="R00_emargency_tel" value="<?php echo $R00_emargency_tel ;?>" style="width: 30%;" /> 
		<span class="error_msg" id="Emer_Phone_error" style="color:red;font-size:10;"></span>
		</td>
		</tr>
		
		</table>


		<h4 class="title">オプショナルツアーについて</h4>


	<table class="border2" width="100%">
		<tr>
		  <th width="30%" colspan ="3">2日目 <strong class="required">※</strong>
		  <span class="error_msg" id="optional_error" style="color:red;font-size:10;"></span></td>
		  </th>
		</tr>
		<tr>
		  <td><input type="radio" name="R00_Optional" id="R00_Optional0" value="1"  <?php if($R00_Optional == 1){echo "checked";}?> onchange ="change_option();"/><label for="R00_Optional0">観光(昼食事付・無料)</label>
		 </td>
		 <td style ="width: 60%;">
			<input type="radio" name="R00_Optional" id="R00_Optional1" value="2"   <?php if($R00_Optional == 2){echo "checked";}?> onchange ="change_option();"/>
			<label for="R00_Optional1">ゴルフ(別途23,000円の費用が発生します)</label>
			<table style ="width: 100%;display:none" id ="option_golf">
				<tr>
					<th style ="width: 40%;">レンタルクラブ <strong class="required">※</strong></th>
					<th style ="width: 60%;">レンタル靴 </th>
				</tr>
				<tr>
					<td class ="center" id = "club"><input type="radio" name="R00_Option_golf" id="R00_Option_golf0" value="1"  <?php if($R00_Option_golf == 1){echo "checked";}?>/><label for="R00_Option_golf0">右</label>
 <input type="radio" name="R00_Option_golf" id="R00_Option_golf1" value="2"  <?php if($R00_Option_golf == 2){echo "checked";}?>/><label for="R00_Option_golf1">左</label>
<input type="radio" name="R00_Option_golf" id="R00_Option_golf2" value="9"  <?php if($R00_Option_golf == 9){echo "checked";}?>/><label for="R00_Option_golf2">持参する</label>
					
					<span class="error_msg" id="club_error" style="color:red;font-size:10;"></span>
					</td>
					<td id ="shoes">
					<p style ="color:color:#FF0000;font-size:small">※レンタルシューズ各自お持ちください。</br>(要ソフトスパイクシューズ)</p>
					
				<input type="radio" name="R00_Option_shoes" id="R00_Option_shoes1" value="2" checked  <?php if($R00_Option_shoes == 2){echo "checked";}?> /><label for="R00_Option_shoes1">持参する</label>
					
					<span class="error_msg" id="shoes_error" style="color:red;font-size:10;"></span>
					
					</td>
				</tr>
			</table>	
			
		</td>		
			 <td><input type="radio" name="R00_Optional" id="R00_Optional9" value="9"  <?php if($R00_Optional ==9){echo "checked";}?> onchange ="change_option();"/><label for="R00_Optional0">自由行動</label>
		 </td>
		</tr>
	</table>
			
		<h4 class="title">おたばこについて</h4>


	<table class="border2" width="100%">
	<tr>
	  <th width="30%">喫煙(たばこ)の習慣 <strong class="required">※</strong></br><span style ="color:#FF0000;font-size:13px">　＊客室は全室禁煙となります。</span></th>
	  <td><input type="radio" name="R00_tabaco" id="R00_tabaco0" value="0"  <?php if($R00_tabaco == 0){echo "checked";}?>/><label for="R00_tabaco0">禁煙</label>
	  &nbsp; 
		<input type="radio" name="R00_tabaco" id="R00_tabaco1" value="1"   <?php if($R00_tabaco == 1){echo "checked";}?>/>
		喫煙    &nbsp; 
			
		<span class="error_msg" id="tabaco_error" style="color:red;font-size:10;"></span></td>
	</tr>

	</table>


	<h4 class="title">通信欄</h4>
	<table class="border2" width="100%">
	<tr>
	<th colspan="2"><div align="center">アレルギー等　ツアーデスクに伝えておきたい事がございましたらご入力ください。</center></th></tr>
	<tr>
	<th width="30%">通信欄<strong class="required"></strong><br></th>
	<td><textarea name="R00_Other_Memo" rows="4" style="width:90%;"><?php echo $R00_Other_Memo; ?></textarea></td>
	</tr></table>
	</div>
	<div style="text-align: center;margin-top:1em;">
	<div class="his-button" style="border-radius: 5px;">
		
		<input type="image"  src="<?php echo base_url();?>img/next.png" onclick="return ValidateForm();"/>
	</div>
	</div>
	</form>

</div>
</section>