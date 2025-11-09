<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker-ja.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxzip3.js"></script>
<script>
//画像保存
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
