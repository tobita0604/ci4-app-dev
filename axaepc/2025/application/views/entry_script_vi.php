<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker-ja.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxzip3.js"></script>
<script>
	window.onload = function(){
	var sanka_flag = document.getElementById("sanka_flag");
	var R00_Nationality_1 = document.getElementById("R00_Nationality_1");
	var R00_Nationality_other = document.getElementById("R00_Nationality_other");
	var course2  = document.getElementById("course2");
	var course1 = document.getElementById("course1");
	
	var flag9  = document.getElementById("flag9");
	var pptflag = document.getElementById("pptflag");
	
	var R00_Optional1 = document.getElementById("R00_Optional1");
	var option_golf = document.getElementById("option_golf");
		if(course1.checked){
			
			sanka_flag.style.display = "block";
		}else{
			sanka_flag.style.display = "none";
		}
		
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
		/*if(document.getElementById("R00_Option_shoes0").checked == true){
        document.getElementById("R00_OptionShoes_Size").disabled = false;
        document.getElementById("R00_OptionShoes_Size").style.background  = "white";
		}else{
			document.getElementById("R00_OptionShoes_Size").disabled = true;
			document.getElementById("R00_OptionShoes_Size").style.background  = "rgb(192, 192, 192)";
		}*/
			
		
		
	}
	$(function() {
		$( "#R00_Passport_Issue" ).datepicker({
			changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0'
		});
		$( "#R00_Birth_Date" ).datepicker({
			changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0'
	});
	});
	function handlechange(){
		if(document.getElementById("course1").checked == true){
			document.getElementById("sanka_flag").style.display = "block";	
		}else{
			document.getElementById("sanka_flag").style.display = "none";	
		}
	}
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
	/*function ChangeBox() {
   
    if(document.getElementById("R00_Option_shoes0").checked == true){
        document.getElementById("R00_OptionShoes_Size").disabled = false;
        document.getElementById("R00_OptionShoes_Size").style.background  = "white";
    }else{
        document.getElementById("R00_OptionShoes_Size").disabled = true;
        document.getElementById("R00_OptionShoes_Size").style.background  = "rgb(192, 192, 192)";
    }

	}*/
	
	
	function ValidateForm()
	{
		var success="";
		
		if((document.getElementById("course1").checked == false) && (document.getElementById("course2").checked == false)) {
			setHisu("course_error","※必項");
			success="false";
		}else
		{
			setHisu("course_error","");
			//document.getElementById("birthday_error").innerText="";
			success=success+"";
		} 
		if(document.getElementById("course1").checked == true) {
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
		if((document.getElementById("courseselect1").checked == false) && (document.getElementById("courseselect2").checked == false))
		{
			setHisu("courseselect_error","※必項");
			//document.getElementById("birthday_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("courseselect_error","");
			//document.getElementById("birthday_error").innerText="";
			success=success+"";
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
			if (kana.match(/^[\uff65-\uff9f]+$/)) {
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

		if(document.getElementById("R00_Email_conf").value=="")
		{
			setHisu("Email_conf_error","※必項");
			//document.getElementById("Email_conf_error").innerText="※必項";
			success="false";
		}else　
		{
			if((document.getElementById("R00_Email_conf").value)!=(document.getElementById("R00_Email").value))
			{
				setHisu("Email_conf_error","※E-mailアドレスと確認用E-mailアドレスが違います。");
				//document.getElementById("Email_conf_error").innerText="※E-mailアドレスと確認用E-mailアドレスが違います。";
				success="false";
			}else
			{
				setHisu("Email_conf_error","");				
				//document.getElementById("Email_conf_error").innerText="";
				success=success+"";
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
		if((document.getElementById("R00_tabaco0").checked == false) && (document.getElementById("R00_tabaco1").checked == false))
		{
			setHisu("tabaco_error","※必項");
			//document.getElementById("birthday_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("tabaco_error","");
			//document.getElementById("birthday_error").innerText="";
			success=success+"";
		}
		
		
		
		
		
		
		/*if(document.getElementById("R01_Prin_City").value=="")
		{
			setHisu("Prin_City_error","※必項");
			//document.getElementById("Prin_City_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Prin_City_error","");
			//document.getElementById("Prin_City_error").innerText="";
			success=success+"";
		}
		if(document.getElementById("R01_Prin_Towns_Villages").value=="")
		{
			setHisu("Prin_Towns_Villages_error","※必項");
			//document.getElementById("Prin_Towns_Villages_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Prin_Towns_Villages_error","");
			//document.getElementById("Prin_Towns_Villages_error").innerText="";
			success=success+"";
		}
	*/
		
		
		/*if(document.getElementById("R00_Emp_Company_Name").value=="")
		{
			setHisu("Emp_Company_Name_error","※必項");
			//document.getElementById("Emp_Company_Name_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_Company_Name_error","");
			//document.getElementById("Emp_Company_Name_error").innerText="";
			success=success+"";
		}
		/*if(document.getElementById("R01_Emp_Company_Name_En").value=="")
		{
			setHisu("Emp_Company_Name_En_error","※必項");
			//document.getElementById("Emp_Company_Name_En_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_Company_Name_En_error","");
			//document.getElementById("Emp_Company_Name_En_error").innerText="";
			success=success+"";
		}
		if(document.getElementById("R01_Emp_Affiliation").value=="")
		{
			setHisu("Emp_Affiliation_error","※必項");
			//document.getElementById("Emp_Affiliation_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_Affiliation_error","");
			//document.getElementById("Emp_Affiliation_error").innerText="";
			success=success+"";
		}
		
		if(document.getElementById("R01_Emp_Position").value=="")
		{
			setHisu("Emp_Position_error","※必項");
			//document.getElementById("Emp_Position_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_Position_error","");
			//document.getElementById("Emp_Position_error").innerText="";
			success=success+"";
		}	
		if(document.getElementById("R01_Emp_Position_En").value=="")
		{
			setHisu("Emp_Position_En_error","※必項");
			//document.getElementById("Emp_Position_En_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_Position_En_error","");
			//document.getElementById("Emp_Position_En_error").innerText="";
			success=success+"";
		}
		if((document.getElementById("R01_Emp_Postal_1").value=="")||(document.getElementById("R01_Emp_Postal_2").value==""))
		{
			setHisu("Emp_Postal_error","※必項");
			//document.getElementById("Emp_Postal_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_Postal_error","");
			//document.getElementById("Emp_Postal_error").innerText="";
			success=success+"";
		}
		if(document.getElementById("R01_Emp_City").value=="")
		{
			setHisu("Emp_City_error","※必項");
			//document.getElementById("Emp_City_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_City_error","");
			//document.getElementById("Emp_City_error").innerText="";
			success=success+"";
		}
		if(document.getElementById("R01_Emp_Towns_Villages").value=="")
		{
			setHisu("Emp_Towns_Villages_error","※必項");
			//document.getElementById("Emp_Towns_Villages_error").innerText="※必項";
			success="false";
		}else
		{
			setHisu("Emp_Towns_Villages_error","");
			//document.getElementById("Emp_Towns_Villages_error").innerText="";
			success=success+"";
		}
	
		if((document.getElementById("R01_Emp_Phone1").value=="")||(document.getElementById("R01_Emp_Phone2").value=="")||(document.getElementById("R01_Emp_Phone3").value==""))
		{
			setHisu("Emp_Phone_error","※必項");
			//document.getElementById("Emp_Phone_error").innerText="※必項";
			success="false";
		}
		else
		{	var phon1 = document.getElementById("R01_Emp_Phone1").value;
			var phon2 = document.getElementById("R01_Emp_Phone2").value ;
			var phon3 = document.getElementById("R01_Emp_Phone3").value ;
			var phone = phon1 + phon2 + phon3 ;			
			if(phone.match(/[^0-9]/g)){
				setHisu("Emp_Phone_error","※ 数値以外が含まれています");
				//document.getElementById("Emp_Phone_error").innerText=" ※ 数値以外が含まれています";
                success="false";				
			}else{
				if((11<phone.length) ||(10>phone.length)){
				setHisu("Emp_Phone_error","※入力値が間違っています");
				//document.getElementById("Emp_Phone_error").innerText="※入力値が間違っています";
				success="false"
			
				}else{
					setHisu("Emp_Phone_error","");
					//document.getElementById("Emp_Phone_error").innerText="";
					success=success+"";
				}
				
			}  
		}
		
		
		if((document.getElementById("R01_keitai_Phone1").value=="")||(document.getElementById("R01_keitai_Phone2").value=="")||(document.getElementById("R01_keitai_Phone3").value==""))
		{
			setHisu("Emp_keitai_error","※必項");
			//document.getElementById("Emp_Phone_error").innerText="※必項";
			success="false";
		}
		else
		{	var phon1 = document.getElementById("R01_keitai_Phone1").value;
			var phon2 = document.getElementById("R01_keitai_Phone2").value ;
			var phon3 = document.getElementById("R01_keitai_Phone3").value ;
			var phone = phon1 + phon2 + phon3 ;			
			if(phone.match(/[^0-9]/g)){
				setHisu("Emp_Phone_error","※ 数値以外が含まれています");
				//document.getElementById("Emp_Phone_error").innerText=" ※ 数値以外が含まれています";
                success="false";				
			}else{
				if((11<phone.length) ||(10>phone.length)){
				setHisu("Emp_Phone_error","※入力値が間違っています");
				//document.getElementById("Emp_Phone_error").innerText="※入力値が間違っています";
				success="false"
			
				}else{
					setHisu("Emp_keitai_error","");
					//document.getElementById("Emp_Phone_error").innerText="";
					success=success+"";
				}
				
			}  
		}		
		
		*/
		
		
		
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
		
		/*if(document.getElementById("R00_emargency_mei").value=="" )
		{
			setHisu("Emer_Contact_Name_error","※必項");	
			//document.getElementById("Emer_Contact_Name_error").innerText="※必項";
			success="false";
		}else{
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
		}*/
		
		}
		
		if(success=="")
		{
			return true;
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

	

	
	function to_ucase(obj){
		var wText = obj.value;
		obj.value = wText.toUpperCase();
	}
	
	function savePhoto(){
			var file="R00_Passport_Img_File";
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
			xmlHttpRequest.open('POST',"<?php echo base_url(); ?>entry_con/image_save",true );
			var fd = new FormData();
			fd.append('R00_Passport_Img_File', $('input[type=file]')[0].files[0]);
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
