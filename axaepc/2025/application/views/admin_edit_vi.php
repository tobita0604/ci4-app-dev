<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<title><?php if (isset($title)) {echo $title;} else { echo "Edit";} ?></title>

<!-- CSS START -->
<link rel="stylesheet" href="<?php echo base_url();?>css/styles.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/admin_edit.css" type="text/css" />

<!-- CSS END -->
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker-ja.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxzip3.js"></script>
<!-- JS , JQUERY END -->


<script>
$(document).ready(function(){
	var R00_Nationality_1 = document.getElementById("R00_Nationality_1");
	var R00_Nationality_other = document.getElementById("R00_Nationality_other");
	
	var flag9  = document.getElementById("flag9");
	var pptflag = document.getElementById("pptflag");
	
	var R00_Optional1 = document.getElementById("R00_Optional1");
	var option_golf = document.getElementById("option_golf");
		
		if(R00_Nationality_1.checked){
			
			R00_Nationality_other.style.display = "block";
		}else{
			R00_Nationality_other.style.display = "none";
		}
		
		if(flag9.checked){
			
			pptflag.style.display = "block";
		}else{
			pptflag.style.display = "none";
		}
		
		
		if(R00_Optional1.checked){
			
			option_golf.style.display = "block";
		}else{
			option_golf.style.display = "none";
		}
		
			
});

</script>

<script>
function loadSubmitForm() {
	
	var success="";
		
		if(document.getElementById("R00_kibou").value=="") {
			setHisu("course_error","※必項");
			success="false";
		}else
		{
			setHisu("course_error","");
			//document.getElementById("birthday_error").innerText="";
			success=success+"";
		} 
		
		if(document.getElementById("R00_Sei").value=="" || document.getElementById("R00_Name").value=="")
		{
			setHisu("Name_Kanji_error","※必項");
			success="false";
		}else{
			var kanji1 = document.getElementById("R00_Sei").value;
			var kanji2 = document.getElementById("R00_Name").value;
			var kan = kanji1 + kanji2 ; 
			
			for(var i=0; i<kan.length; i++){
           // 1文字ずつ文字コードをエスケープし、その長さが4文字以上なら全角 
            var len=escape(kan.charAt(i)).length;			
            if(len>=4){
                setHisu("Name_Kanji_error","");
				success=success+"";
            }else{
				setHisu("Name_Kanji_error","※全角文字は含まれていません");
				//document.getElementById("Name_Kanji_error").innerText="※全角文字は含まれていません";
				success="false"; 
			}
			}		       
			
		}
		
		
		if(document.getElementById("R00_Sei_Kana").value=="" || document.getElementById("R00_Name_Kana").value=="")
		{
			setHisu("Name_Kana_error","※必項");
			//document.getElementById("Name_Kana_error").innerText="※必項";
			success="false";
		}else{
			var kana1 = document.getElementById("R00_Sei_Kana").value ;
			var kana2 = document.getElementById("R00_Name_Kana").value ;
			var kana = kana1 + kana2;			
			//if (kana.match(/^[ｱ-ﾝﾞﾟ]+$/)) { 2018/12/18 Ken
			if (kana.match(/^[ｦ-ﾟ]*$/)) {
				setHisu("Name_Kana_error","");
				//document.getElementById("Name_Kana_error").innerText="";
				success=success+"";
			}else{
				setHisu("Name_Kana_error","※半角で入力してください。");
				//document.getElementById("Name_Kana_error").innerText="※全角カナのみで入力してください。。";
				success="false";
			}			
		}

		
		if((document.getElementById("R00_Birth_Date").value==""))
		{
			setHisu("birthday_error","※必項");
			//document.getElementById("birthday_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("birthday_error","");
			//document.getElementById("birthday_error").innerText="";
			success=success+"";
		}
		if((document.getElementById("R00_Zip21").value !="")||(document.getElementById("R00_Zip22").value != ""))
		
		{	var zip1 = document.getElementById("R00_Zip21").value;
			var zip2 = document.getElementById("R00_Zip21").value ;
			var zip = zip1 + zip2 ;			
			if(zip.match(/[^0-9]/g)){
				setHisu("Prin_Postal_error"," ※半角数字のみで入力してください。");
				//document.getElementById("Prin_Phone_error").innerText=" ※ 数値以外が含まれています";
                success="false";				
			}else
			{
				setHisu("Prin_Postal_error","");
				//document.getElementById("birthday_error").innerText="";
				success=success+"";
			}
		}	
		if((document.getElementById("R00_Nationality_0").checked == false) && (document.getElementById("R00_Nationality_1").checked == false))
		{
			setHisu("country_error","※必項");
			//document.getElementById("birthday_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("country_error","");
			//document.getElementById("birthday_error").innerText="";
			success=success+"";
		}
		
		if(document.getElementById("R00_Company").value=="")
		{
			setHisu("Emp_Company_Name_error","※必項");
			//document.getElementById("Prin_Postal_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_Company_Name_error","");
			//document.getElementById("Prin_Postal_error").innerText="";
			success=success+"";
		}
		
		
		
		if(document.getElementById("R00_Email").value=="")
		{
			setHisu("Email_error","※必項");
			//document.getElementById("Email_error").innerText="※必項";
			success="false";
		}else{
			var email = document.getElementById("R00_Email").value;			
			var Seiki=/[!#-9A-~]+@+[a-z0-9]+.+[^.]$/i;				
			if(email.match(Seiki)){	
				setHisu("Email_error","");
				//document.getElementById("Email_error").innerText="";
				success=success+"";								              
            }else{
				setHisu("Email_error","※メールアドレスの形式が不正です");
				//document.getElementById("Email_error").innerText="※メールアドレスの形式が不正です";
				success="false";
			}
			
		}

		
		
		if((document.getElementById("flag0").checked == false) && (document.getElementById("flag1").checked == false) && (document.getElementById("flag9").checked == false))
		{
			setHisu("pass_error","※必項");
			//document.getElementById("birthday_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("pass_error","");
			//document.getElementById("birthday_error").innerText="";
			success=success+"";
		}
		if(document.getElementById("flag9").checked == true){
			if(document.getElementById("R00_Passport_Issue").value==""){
				
			setHisu("issue_error","※必項");
			//document.getElementById("birthday_error").innerText="※必項";
			success="false";
			}
				else
			{
				setHisu("issue_error","");
				//document.getElementById("birthday_error").innerText="";
				success=success+"";
			}
		}
		
		if((document.getElementById("R00_Optional0").checked == false) && (document.getElementById("R00_Optional1").checked == false) && (document.getElementById("R00_Optional9").checked == false))
		{
			setHisu("optional_error","※必項");
			//document.getElementById("birthday_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("optional_error","");
			//document.getElementById("birthday_error").innerText="";
			success=success+"";
		}
		
		
		if(document.getElementById("R00_Optional1").checked == true){
			 if( $("#club input[type = radio]:checked").length <= 0){
				setHisu("club_error","※必項");
				//document.getElementById("birthday_error").innerText="※必項";
				success="false";
			}else{
				setHisu("club_error","");
				//document.getElementById("birthday_error").innerText="";
				success=success+"";
			}
			
			
			
			
		}
		
		
		
		if(document.getElementById("R00_emargency_mei").value=="")
		{
			setHisu("Emer_Contact_Name_error","※必項");
			//document.getElementById("Emer_Contact_Name_error").innerText="※必項";
			success="false";
		}else
		{
			var kana = document.getElementById("R00_emargency_mei").value ;	
			if (kana.match(/^[ァ-ン　]+$/)) {
				setHisu("Emer_Contact_Name_error","");
				//document.getElementById("Emer_Contact_Name_error").innerText="";
				success=success+"";
			}else{
				setHisu("Emer_Contact_Name_error","※全角カナのみで入力してください。");
				//document.getElementById("Emer_Contact_Name_error").innerText="※全角カナのみで入力してください。";
				success="false";
			}	
		}
		
		if(document.getElementById("R00_emargency_zoku").value=="")
		{
			setHisu("Emer_Relationship_error","※必項");
			//document.getElementById("Emer_Relationship_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emer_Relationship_error","");
			//document.getElementById("Emer_Relationship_error").innerText="";
			success=success+"";
		}
		
		if(document.getElementById("R00_emargency_tel").value=="")
		{
			setHisu("Emer_Phone_error","※必項");
			//document.getElementById("Emer_Phone_error").innerText="※必項";
			success="false";
		}else
		{	
				
			setHisu("Emer_Phone_error","");	
			//document.getElementById("Emer_Phone_error").innerText="";
			success=success+"";
				
			
		}
	
		
		
		//alert(success);
		if(success=="")
		{
			var confirm = window.confirm("更新します、よろしいですか？");
			if(confirm) {
				$("#edit_info_form").submit();
				return true;
			} else {
				return false;
			}
		}else
		{

			alert("全部の項目を入力してください");
			return false;
		}
	
	
	
}
function setHisu(Id,value){
		var test = document.getElementById(Id);
		if(test.textContent){
			test.textContent　=　value;
		} else {
			test.innerText　=　value;
		}
	}
	
<?php if($update_status == 1){?>
setTimeout(function(){
	alert("更新成功しました。");
	},300);
<?php }else if($update_status == 2){ ?>
setTimeout(function(){
	alert("更新失敗しました。");
	},300);
<?php } ?>

</script>

<script>
function closeWindow() {
	window.opener.$("#searchbtn" ).trigger( "click" );
	window.close();
}
</script>

<script>
$(function(){
	$("#R00_Birth_Date").datepicker({
		dateFormat: 'yy/mm/dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-2:+5"
	});
	$("#R00_Passport_Issue").datepicker({
		dateFormat: 'yy/mm/dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-2:+5"
	});
	
});

</script>
<script>
function country_flag(){
		if(document.getElementById("R00_Nationality_1").checked == true){
			document.getElementById("R00_Nationality_other").style.display = "block";	
		}else{
			document.getElementById("R00_Nationality_other").style.display = "none";
			document.getElementById("R00_Nationality_other").value = "";			
		}
}
function passport_flag(){
		if(document.getElementById("flag9").checked == true){
			document.getElementById("pptflag").style.display = "block";	
		}else{
			document.getElementById("pptflag").style.display = "none";	
			document.getElementById("R00_Passport_Issue").value = "";		
		}
	}
	function change_option()
	{
		if(document.getElementById("R00_Optional1").checked == true){
			document.getElementById("option_golf").style.display = "block";	
		}else{
			document.getElementById("option_golf").style.display = "none";
			document.getElementById("R00_OptionShoes_Size").value = "";
			$("#option_golf  input[type = radio]").prop("checked", false);
					
		}
	}
	
function openMyPage(){
	
	var r00_id = document.getElementById("R00_Id").value;
	var r00_password = document.getElementById("R00_Password").value;
	var r00_year = document.getElementById("R00_Birth_Year").value;
	var r00_month = document.getElementById("R00_Birth_Month").value;
	var r00_day = document.getElementById("R00_Birth_Date").value;

	var form = document.createElement( 'form' );
	document.body.appendChild( form );
	// Set post data with input_1 and input_2
	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'R00_Id' );
	input_1.setAttribute( 'value' , r00_id );
	form.appendChild( input_1 );

	var input_2 = document.createElement( 'input' );
	input_2.setAttribute( 'type' , 'hidden' );
	input_2.setAttribute( 'name' , 'R00_Password' );
	input_2.setAttribute( 'value' , r00_password );
	form.appendChild( input_2 );

	var input_3 = document.createElement( 'input' );
	input_3.setAttribute( 'type' , 'hidden' );
	input_3.setAttribute( 'name' , 'R00_Birth_Year' );
	input_3.setAttribute( 'value' , r00_year );
	form.appendChild( input_3 );

	var input_4 = document.createElement( 'input' );
	input_4.setAttribute( 'type' , 'hidden' );
	input_4.setAttribute( 'name' , 'R00_Birth_Month' );
	input_4.setAttribute( 'value' , r00_month );
	form.appendChild( input_4 );

	var input_5 = document.createElement( 'input' );
	input_5.setAttribute( 'type' , 'hidden' );
	input_5.setAttribute( 'name' , 'R00_Birth_Date' );
	input_5.setAttribute( 'value' , r00_day );
	form.appendChild( input_5 );
	
	// Set action post
	form.setAttribute( 'action' , "<?php echo base_url();?>menu_con/openMypage" );
	form.setAttribute( 'method' , 'post' );
	// 指示されたタゲットの名前を設定
	form.setAttribute( 'target' , '_blank');
	form.submit();
}

function resetPassword(R00_Id) {
	if(window.confirm("パスワードを初期化することになってよろしいでしょうか？")) {
		$.ajax({
			url: '<?php echo base_url();?>menu_con/resetPassword',
			type: 'POST',
			dataType : 'text',
			data: {
				"R00_Id" : R00_Id,
			},
			success: function(text) {
				if (text == "success") {
					document.getElementById("R00_Password").value = "";
					alert("パスワード初期化しました。");
				} else {
					alert("パスワード初期化出来ません。");
				}
			},
			error: function() {
				alert("パスワード初期化出来ません。");
			}
		});
		
		return true;
	} else {
		return false;
	}
}
function savePhoto(){	
	var file="R00_Passport_Img_File";
	var userid = document.getElementById("R00_Id").value;  
			var xmlHttpRequest = new XMLHttpRequest();
			xmlHttpRequest.onreadystatechange = function()
			{
				var READYSTATE_COMPLETED = 4;
				var HTTP_STATUS_OK = 200;
				//alert(this.readyState);
				//alert(this.status);
				if( this.readyState == READYSTATE_COMPLETED
				&& this.status == HTTP_STATUS_OK )
			{
				var result = xmlHttpRequest.responseText; 
				
				var res = result.substr(0, 5);
				if( res == "(ERR)")
				{
				alert(result);
				}else
				{
				var string =result;
				var strx   = string.split('/');
				var array  = [];
				array = array.concat(strx);
				var file_name=array[6];
				document.getElementById("uploadclick").style.background="#33BFDB";
				document.getElementById("uploadclick").value="再アップロード";
				document.getElementById("link").style.display="none";
				document.getElementById("link1").style.display="none";
				document.getElementById("org_img").style.display="none";
				document.getElementById("name").style.display="block";
				document.getElementById("R00_Passport_Upload_Name").value = result + "";
				alert("アップロード完了しました。");
				}
			}
		}
			xmlHttpRequest.open('POST',"<?php echo base_url(); ?>entry_con/image_save2",true );
			var fd = new FormData();
			fd.append('R00_Passport_Img_File', $('input[type=file]')[0].files[0]);
			fd.append('userid',userid)
			xmlHttpRequest.send(fd);
}


	//画像preview
function getImage(R00_Id) {
	var postData_1 = R00_Id;
	var form = document.createElement( 'form' );
	document.body.appendChild( form );
	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'R00_Id' );
	input_1.setAttribute( 'value' , postData_1 );
	form.appendChild( input_1 );
	form.setAttribute( 'action' , "<?php echo base_url();?>mypage_con/getImageConfirm" );
	form.setAttribute( 'method' , 'post' );
	// 指示されたタゲットの名前を設定
	form.setAttribute( 'target' , '_blank');
	form.submit();	
}
</script>







</head>
<body> <!-- onload="check_day();" -->
<div class="title-header" style="margin-top: 0px;">
			<div>
				<label style="font: bold; font-size: 35px; color: white; font-family: Arial, Tahoma;">参加者情報編集画面</label>
				<div style="float: right;">
				<?php 
					if ($Charger_Type != "9") { ?>
					<input type="submit" class="button button-glow button-rounded button-royal" name="open_mypage" id="open_mypage" value="My Page"  style="margin: 0 auto; margin-bottom: 10px; " onclick="openMyPage()" />
				<?php } ?>
				&nbsp;&nbsp;
				<input type="submit" class="button button-glow button-rounded button-royal" name="close_form" id="close_form" value="Close"  style="float: right; margin: 0 auto; margin-bottom: 10px; " onclick="closeWindow()" >
				</div>
			</div>
	<hr></hr>
</div>
	
<!-- ADD ACCOUNT INFORMATION START -->
<div>
	<table id="form" width="100%">
		<tbody>
			<tr>
				<th style="width: 30%;">管理番号</th>
				<td>
					<label name="register_id" id="register_id">
					<?php if (isset($R00_Id)) { echo $R00_Id; } else {echo ""; } ?>
					</label>
				</td>
			</tr>
			<tr>
				<th style="width: 30%;">お名前</th>
				<td>
					<label name="register_name" id="register_name">
					<?php 
						if (!isset($R00_Sei)) {
							$R00_Sei = '';
						}
						
						if (!isset($R00_Name)) {
							$R00_Name = '';
						}
						
						echo $R00_Sei . " " . $R00_Name;
					?>
					</label>
				</td>
			</tr>
			<?php if ($Charger_Type != "9") { ?>
				<tr>
					<th style="width: 30%;">ステータス</th>
					<td>
						<input type="radio" name="R00_Cancel_Flag" value="0" <?php if($R00_Cancel_Flag=="0"){ echo "checked"; }?> onclick="$('#R00_Cancel_Flag_Temp').val('0');"/>予約
						<input type="radio" name="R00_Cancel_Flag" value="1" <?php if($R00_Cancel_Flag=="1"){ echo "checked"; }?> onclick="$('#R00_Cancel_Flag_Temp').val('1');"/>キャンセル
						<input type="radio" name="R00_Cancel_Flag" value="2" <?php if($R00_Cancel_Flag=="2"){ echo "checked"; }?> onclick="$('#R00_Cancel_Flag_Temp').val('2');"/>削除
					</td>
				</tr>
				<?php if($R00_Cancel_Flag == "1"){ ?>
				<tr>
					<th style="width: 30%;">キャンセル日付</th>
					<td><?php echo $R00_Cancel_Date;?></td>
				</tr>
				<?php }?>
				<?php }?>
		</tbody>
	</table>
</div>

<form action="<?php echo base_url(); ?>menu_con/edit_info" method="post" name="edit_info_form" id="edit_info_form" >


<!-- START TAB ENTRY SOURCE -->
<div id="entry">
	<table id="form" width="100%">
	<tbody>
		<tr>
			<th colspan="2"><div align="center">ご参加コース</th><div></tr>
		</tr>
		<tr>
			<th style="width: 30%;" >参加班</th>
			<td><span class="error_msg" id="course_error" style="color:red;font-size:10;"></span></br>
				<select name="R00_kibou" id="R00_kibou">
											<option value="" <?php if($R00_kibou == '') { echo "selected"; }?> >全て</option>
											<option value="XX" <?php if($R00_kibou == "XX") { echo "selected"; }?> >参加しない</option>
											<option value="1" <?php if($R00_kibou == "1") { echo "selected"; }?> >1班</option>
											<option value="2" <?php if($R00_kibou == "2") { echo "selected"; }?> >2班</option>
										</select>
			</td>
		</tr>
		
		<tr>
			<th style="width: 30%;" >確定班</th>
			<td><span class="error_msg" id="course_error" style="color:red;font-size:10;"></span></br>
				<select name="R00_Flight_Id" id="R00_Flight_Id">
											<option value=""   <?php if($R00_Flight_Id == '') { echo "selected"; }?> >--</option>
											<option value="XX" <?php if($R00_Flight_Id == "XX") { echo "selected"; }?> >参加しない</option>
											<option value="1P" <?php if($R00_Flight_Id == "1P") { echo "selected"; }?> >1班 フィリピン航空</option>
											<option value="1V" <?php if($R00_Flight_Id == "1V") { echo "selected"; }?> >1班 バニラエア</option>
											<option value="2P" <?php if($R00_Flight_Id == "2P") { echo "selected"; }?> >2班 フィリピン航空</option>
											<option value="2V" <?php if($R00_Flight_Id == "2V") { echo "selected"; }?> >2班 バニラエア</option>
											<option value="VIP" <?php if($R00_Flight_Id == "VIP") { echo "selected"; }?> >社長専用</option>
										</select>
			</td>
		</tr>
		
	</tbody>
	</table>
	
	<table id="form" width="100%" >
	<tbody>
		<tr>
			<th colspan="2"><div align="center">基本情報</div></th>
		</tr>
		<tr>
			<th style="width: 30%;" >お名前(漢字)</th>
			<td style="width: 70%;" >
				<font color="#000000">姓 </font>
				<input type="text" name="R00_Sei" id="R00_Sei" size="9" value="<?php if (isset($R00_Sei)) { echo $R00_Sei; } else { echo ""; } ?>" />&nbsp;
				<font color="#000000">名 </font>
				<input type="text" name="R00_Name" id="R00_Name" size="9" value="<?php if (isset($R00_Name)) { echo $R00_Name; } else { echo ""; } ?>" />
				 <p class="error_msg" id="Name_Kanji_error" style="color:red;font-size:10;"></p>
			</td>
		</tr>
		
		<tr>
			<th style="width: 30%;" >お名前(カナ)</th>
			<td>
				<font color="#000000">姓</font>
				<input type="text" name="R00_Sei_Kana" id="R00_Sei_Kana" size="9" value="<?php if (isset($R00_Sei_Kana)) { echo $R00_Sei_Kana; } else { echo ""; } ?>" />&nbsp;
				<font color="#000000">名</font>
				<input type="text" name="R00_Name_Kana" id="R00_Name_Kana" size="9" value="<?php if (isset($R00_Name_Kana)) { echo $R00_Name_Kana; } else { echo ""; } ?>" />
				 <p class="error_msg" id="Name_Kana_error" style="color:red;font-size:10;"></p>
			</td>
		</tr>
		
		<tr>
			<th style="width: 30%;" >性別</th>
			<td>
				<input type="radio" name="R00_Sex" id="R00_Sex_0" value="0" <?php if( isset($R00_Sex) && $R00_Sex == "0"){echo "checked";} ?> />
				<label for="R00_Sex_0">男性</label>
				<input type="radio" name="R00_Sex" id="R00_Sex_1" value="1" <?php if( isset($R00_Sex) && $R00_Sex == "1"){echo "checked";} ?> />
				<label for="R00_Sex_1">女性</label>
			</td>
		</tr>
		<tr>
			<th style="width: 30%;" >生年月日</th>
			<td>
				<input type="text" name="R00_Birth_Date" id="R00_Birth_Date" value="<?php echo htmlentities($R00_Birth_Date,ENT_QUOTES, "UTF-8"); ?>" size="30" />
				<span class="error_msg" id="birthday_error" style="color:red;font-size:12;"></span>
			</td>
		</tr>
		<tr>
			<th style="width: 30%;">国籍</th>
			<td>
				<input type="radio" id="R00_Nationality_0" name="R00_Nationality" value="日本" <?php echo $R00_Nationality=="日本" ? 'checked':''; ?> onchange ="country_flag();"/><label for="R00_Nationality_0">日本</label>&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" id="R00_Nationality_1" name="R00_Nationality" value="0" <?php if(($R00_Nationality!="日本")&&($R00_Nationality!="")){ echo  'checked' ;} ?> onchange ="country_flag();"/><label for="R00_Nationality_1">その他(その他の方は、国籍をご記入ください)</label>
	<input type="text" name="R00_Nationality_other" id="R00_Nationality_other" value="<?php echo $R00_Nationality ?>"  style="width:25%;display:none"  />
<span class="error_msg" id="country_error" style="color:red;font-size:12;"></span>
			</td>
		</tr>
		<tr>
	<th>E-mail</th>
	<td> <input type="text" name="R00_Email" id="R00_Email" style="width:50%;" value="<?php echo $R00_Email;?>"/>
	 <span class="error_msg" id="Email_error" style="color:red;font-size:10;"></span>
    </td>
	
	</tr>
	</tbody>
	</table>
		
	<table id="form" width="100%">
	<tbody>
		<tr>
			<th colspan="2"><div align="center">ご自宅住所・電話番号・E-MAILアドレス</div></th>
		</tr>
		<tr>
			<th style="width: 30%;">郵便番号</th>
			<td>
				<input type="text" name="R00_Zip21" id="R00_Zip21" maxlength="3" size="4" value="<?php if (isset($R00_Zip21)){ echo $R00_Zip21; }?>" /> -
				<input type="text" name="R00_Zip22" id="R00_Zip22" maxlength="4" size="5" value="<?php if (isset($R00_Zip22)){ echo $R00_Zip22; }?>" /> &nbsp;&nbsp;
				
				<span class="error_msg" id="Prin_Postal_error"style="color:red;font-size:10;"></span>
				<input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('R00_Zip21','R00_Zip22','R00_Town','R00_Address');"/><br>
			</td>
		</tr>
		<tr>
			<th style="width: 30%;">都道府県</th>
			<td>
				<select name="R00_Town" id="R00_Town">	<option value="" selected="selected">選択してください</option>
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
			</td>
		</tr>
		<tr>
			<th style="width: 30%;">それ以降の住所</td>
			<td>
				<input type="text" name="R00_Address" id="R00_Address" maxlength="100" size="30" value="<?php if (isset($R00_Address)){ echo $R00_Address; }?>" />
			</td>
		</tr>
		<tr>
			<th style="width: 30%;">マンション名</td>
			<td>
				<input type="text" name="R00_Address2" id="R00_Address2" maxlength="100" size="30" value="<?php if (isset($R00_Address2)){ echo $R00_Address2; }?>" />
			</td>
		</tr>
		
		<tr>
			<th style="width: 30%;" >ご自宅TEL</th>
			<td>
				<input type="text" name="R00_Prin_Phone" id="R00_Prin_Phone" value="<?php echo $R00_Prin_Phone ;?>" style="width: 30%;"  />
			</td>
		</tr>
		<tr>
			<th style="width: 30%;" >携帯電話番号</th>
			<td>
				<input type="text" name="R00_Prin_Fax" id="R00_Prin_Fax" value="<?php echo $R00_Prin_Fax ;?>" style="width: 30%;"  />
			</td>
		</tr>
		
	</tbody>
	</table>
	
	<table id="form" width="100%">
	<tbody>
		<tr>
			<th colspan="2"><div align="center">店舗情報</th><div></tr>
		</tr>
		<tr>
			<th style="width: 30%;" >店舗名</th>
			<td>
				<input type="text" name="R00_Company" id="R00_Company" value="<?php echo $R00_Company ;?>" style="width:70%;" />
				<span class="error_msg" id="Emp_Company_Name_error" style="color:red;font-size:10;"></span>
			</td>
		</tr>
		<tr>
			<th style="width: 30%;" >役職</th>
			<td>
				<input type="text" name="R00_Division" id="R00_Division" value="<?php echo $R00_Division ;?>" style="width:70%;" />
				<span class="error_msg" id="Emp_Position_error" style="color:red;font-size:10;"></span>
			</td>
		</tr>
		
	
	
	
	
	
	</tbody>
	</table>

	<table id="form" width="100%">
	<tbody>
		<tr>
			<th colspan="2"><div  align ="center">パスポート情報</div></th>
		</tr>
		<tr>
			<th style="width: 30%;" >パスポートの有無</th>
			<td>
				
			<input type ="radio" name ="R00_Passport_Flag" value = "0" <?php if($R00_Passport_Flag == 0 ){ echo "checked" ;} ?> id = "flag0" onchange="passport_flag();">持っている&nbsp;&nbsp;&nbsp;&nbsp;
			<input type ="radio" name ="R00_Passport_Flag" value = "1" <?php if($R00_Passport_Flag == 1 ){ echo "checked" ;} ?> id = "flag1" onchange="passport_flag();">持っていない&nbsp;&nbsp;&nbsp;&nbsp;
			<input type ="radio" name ="R00_Passport_Flag" value = "9" <?php if($R00_Passport_Flag == 9 ){ echo "checked" ;} ?> id = "flag9"onchange="passport_flag();">申請中
			<p class="error_msg" id ="pass_error" style="color:red;font-size:10;"></p>
			<div id ="pptflag" style ="display:none">
			<strong>受領予定日 : </strong><input type="text" name="R00_Passport_Issue" id="R00_Passport_Issue" value="<?php echo $R00_Passport_Issue ;?>" size="20" />
			<p class="error_msg" id ="issue_error" style="color:red;font-size:10;"></p>
			</div>
			
			</td>
		</tr>
		<tr>
			<th style="width: 30%;" >パスポート名</th>
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
		<th ><div align="center">パスポート画像のアップロード</div></th>
		
			<td>パスポートの顔写真のページの画像キャプチャをアップロードしてください。</br>
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
						最大アップロードサイズ：10MB
	<br>アップロード可能なファイルタイプ（jpeg,pdf）<br>
						<input type="hidden" name ="R00_Passport_Upload_Name" id = "R00_Passport_Upload_Name" value = "<?php if(isset($R00_Passport_Upload_Name)){ echo $R00_Passport_Upload_Name;} else{echo '';}?>"/>
				</td>
		</tr>
		
	</tbody>
	</table>
	
	
	
	<table id="form" width="100%">
	<tbody>
		<tr>
			<th colspan="2"><div align="center">渡航中の国内連絡先</center></th>
		</tr>
		<tr>
			<th style="width: 30%;">渡航中の国内連絡先　氏名</th>
			<td>
				<input type="text" name="R00_emargency_mei" id="R00_emargency_mei" value="<?php echo $R00_emargency_mei ;?>" style="width:50%;" />
				<span class="error_msg" id="Emer_Contact_Name_error" style="color:red;font-size:10;"></span>
		 	</td>
		</tr>
		
		<tr>
			<th style="width: 30%;" >続柄</th>
			<td>
				<input type="text" name="R00_emargency_zoku" id="R00_emargency_zoku" value="<?php echo $R00_emargency_zoku ;?>" style="width:50%;" />
				<span class="error_msg" id="Emer_Relationship_error" style="color:red;font-size:10;"></span>
			</td>
		</tr>
		<tr>
			<th style="width: 30%;" >電話番号</th>
			<td>
				<input type="text" name="R00_emargency_tel" id="R00_emargency_tel" value="<?php echo $R00_emargency_tel ;?>" style="width: 30%;" /> 
				<span class="error_msg" id="Emer_Phone_error" style="color:red;font-size:10;"></span>
			</td>
		</tr>
	</tbody>
	</table>
	
	
	<table id="form" width="100%">
	<tbody>
		<tr>
			<th colspan="3"><div align="center">オプショナルツアーについて</center></th>
		</tr>
		
		  <th width="30%" colspan ="3">2日目 <strong class="required">※</strong>
		  <span class="error_msg" id="optional_error" style="color:red;font-size:10;"></span></td>
		  </th>
		</tr>
		<tr>
		  <td><input type="radio" name="R00_Optional" id="R00_Optional0" value="1"  <?php if($R00_Optional == 1){echo "checked";}?> onchange ="change_option();"/><label for="R00_Optional0">観光(昼食事付・無料)</label>
		 </td>
		 <td style ="width: 60%;">
			<input type="radio" name="R00_Optional" id="R00_Optional1" value="2"   <?php if($R00_Optional == 2){echo "checked";}?> onchange ="change_option();"/>
			<label for="R00_Optional1">ゴルフ(別途費用が発生します)</label>
			<table style ="width: 100%;display:none" id ="option_golf">
				<tr>
					<th style ="width: 40%;">レンタルクラブ <strong class="required">※</strong></th>
					<th style ="width: 60%;">レンタル靴 <strong class="required">※</strong></th>
				</tr>
				<tr>
					<td class ="center" id = "club"><input type="radio" name="R00_Option_golf" id="R00_Option_golf0" value="1"  <?php if($R00_Option_golf == 1){echo "checked";}?>/><label for="R00_Option_golf0">右</label>
 &nbsp; &nbsp; &nbsp;  <input type="radio" name="R00_Option_golf" id="R00_Option_golf1" value="2"  <?php if($R00_Option_golf == 2){echo "checked";}?>/><label for="R00_Option_golf1">左</label>
 &nbsp; &nbsp; &nbsp;<input type="radio" name="R00_Option_golf" id="R00_Option_golf2" value="9"  <?php if($R00_Option_golf == 9){echo "checked";}?>/><label for="R00_Option_golf2">持参する</label>
					
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
	</tbody>
	</table>
	<table id="form" width="100%">
	<tr>
	  <th width="30%">喫煙(たばこ)の習慣 <strong class="required">※</strong></br><span style ="color:#FF0000;font-size:13px">　＊客室は全室禁煙となります。</span></th>
	  <td><input type="radio" name="R00_tabaco" id="R00_tabaco0" value="0"  <?php if($R00_tabaco == 0){echo "checked";}?>/><label for="R00_tabaco0">禁煙</label>
	  &nbsp; 
		<input type="radio" name="R00_tabaco" id="R00_tabaco1" value="1"   <?php if($R00_tabaco == 1){echo "checked";}?>/>
		喫煙    &nbsp; 
			
		</td>
	</tr>

	</table>				
	<table id="form" width="100%">
		<tr>
			<th colspan="2"><div align="center">その他</div></th>
		</tr>
		<tr>
			<th style="width: 30%;" >備考</th>
			<td>
				<textarea name="R00_Other_Memo" rows="4" cols="70"><?php if (isset($R00_Other_Memo)) { echo $R00_Other_Memo; } else { echo ""; } ?></textarea>
			</td>
		</tr>
	</table>
	
	
	
	<table id="form" width="100%">
	<tbody>
		<th colspan="2"><div align="center">パスワード</div></th>
		<tr>
			<th>パスワード</th>
			<td>
				<input type="text" name="R00_Password" id="R00_Password" size="30" value="<?php if (isset($R00_Password)) { echo $R00_Password; } else { echo ""; } ?>" readonly />
				&nbsp;&nbsp;&nbsp;
				<input type="button" name="reset_pass" id="reset_pass" value="初期化" onclick="resetPassword('<?php echo $R00_Id; ?>');"></input>
			</td>
		</tr>
	</tbody>
	</table>
</div>
<!-- END TAB ENTRY SOURCE -->




<!-- START HIDDEN DATA POST -->
<div>
<input type="hidden" name="R00_Id" id="R00_Id" value="<?php echo $R00_Id; ?>" />
</div>
<!-- END HIDDEN DATA POST -->


<div>
<hr />
<p align="center" class="submit">
<input class="button button-3d" type="submit" name="update_btn" value="更新" id="update_btn" style="margin: 0 auto;" onclick="return loadSubmitForm()"/>
</p>
</div>

</form>

<!-- END SEARCH VIEW WITH LOGIN_TYPE 9 マイクロソフトアカウント  -->
</body>
</html>
<script>
	function toFixed(value, precision) {
		var precision = precision || 0,
			power = Math.pow(10, precision),
			absValue = Math.abs(Math.round(value * power)),
			result = (value < 0 ? '-' : '') + String(Math.floor(absValue / power));

		if (precision > 0) {
			var fraction = String(absValue % power),
			padding = new Array(Math.max(precision - fraction.length, 0) + 1).join('0');
			result += '.' + padding + fraction;
		}

		return result;
	}

	
	
	
</script>	