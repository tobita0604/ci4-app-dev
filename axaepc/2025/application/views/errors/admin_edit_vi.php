<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- <meta name="viewport" content="user-scalable = yes"> -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"> -->
<!-- <meta name="apple-mobile-web-app-capable" content="yes"> -->
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>-->
<meta name="viewport" content="width=device-960px">
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<meta http-equiv="Content-Style-Type" content="text/css" />
<title><?php if (isset($title)) {echo $title;} else { echo "Edit";} ?></title>

<!-- CSS START -->
<link rel="stylesheet" href="<?php echo base_url();?>css/styles.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/admin_edit.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css" type="text/css" />
<!-- CSS END -->

<!-- JS , JQUERY START -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker-ja.js"></script>
<!-- 
<script type="text/javascript" src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>
<script type="text/javascript" src="https://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3-https.js" charset="UTF-8"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
 -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxzip3.js"></script>
<!-- JS , JQUERY END -->

<style>
table#form4 {
	margin-left: auto;
	margin-right: auto;
	margin-bottom: 10px;
}
#form4 th {
	text-align: left;
	border-right:1px solid #CCCCCC;
	border-left:1px solid #CCCCCC;
	border-top:1px solid #CCCCCC;
	border-bottom:1px solid #CCCCCC;
	background-color: #EAE8F2;
	padding: 5px 10px;
	font-size:14px;
}
#form4 td {
	width: 70%;
	text-align: left;
	background-color: ;
	border-right:1px solid #CCCCCC;
	border-left:1px solid #CCCCCC;
	border-top:1px solid #CCCCCC;
	border-bottom:1px solid #CCCCCC;
	padding: 5px 10px;
}


table#form5 {
	margin-left: auto;
	margin-right: auto;
	margin-bottom: 10px;
}
#form5 th {
	width: 20%;
	text-align: left;
	border-right:1px solid #CCCCCC;
	border-left:1px solid #CCCCCC;
	border-top:1px solid #CCCCCC;
	border-bottom:1px solid #CCCCCC;
	background-color: #EAE8F2;
	padding: 5px 10px;
	font-size:14px;
}
#form5 td {
	text-align: left;
	background-color: ;
	border-right:1px solid #CCCCCC;
	border-left:1px solid #CCCCCC;
	border-top:1px solid #CCCCCC;
	border-bottom:1px solid #CCCCCC;
	padding: 5px 10px;
}


</style>


<script>
// window.onload = function(){
	
// }

$(function(){
	var j_0 = document.getElementById("reg");
	var j_15 = document.getElementById("nonreg");
	var j_16 = document.getElementById("travelcost");
	var j_17 = document.getElementById("payment");
	var j_19 = document.getElementById("arrangement");
	
	var tui0 = document.getElementById("tmp_101");
	
	var tui15 = document.getElementById("tmp_102");
	var tui16 = document.getElementById("tmp_103");
	var tui17 = document.getElementById("tmp_104");
	var tui19 = document.getElementById("tmp_106");

	
	if(tui0.checked){
		j_0.style.display = "block";
	}else{
		j_0.style.display = "none";
	}


	if(tui15.checked){
		j_15.style.display = "block";
	}else{
		j_15.style.display = "none";
	}

	if(tui16.checked){
		j_16.style.display = "block";
	} else {
		j_16.style.display = "none";
	}

	if(tui17.checked){
		j_17.style.display = "block";
	} else {
		j_17.style.display = "none";
	}
	

	if(tui19.checked){
		j_19.style.display = "block";
	} else {
		j_19.style.display = "none";
	}
	

	var optional_flag = document.getElementById("optional_flag").value;
	if(optional_flag == 1) {
		var optional_item_list = document.getElementsByClassName("optional_item");
		for (var i = 0; i < optional_item_list.length; i++) {
			document.getElementById("optional_item" + i).style.display = "block";

			var status_name = "M01_Optional_Resever_Status" + i;
			var status = $('input[name ="' + status_name + '"]:checked').val();
			if(status == 3) {
				$("#M01_Optional_Cancel_Charge" + i).prop('disabled', false);
				
			} else {
				$("#M01_Optional_Cancel_Charge" + i).prop('disabled', true);
				$("#M01_Optional_Cancel_Charge" + i).val('0');
			}
			
			var payment_type = document.getElementsByName("M01_Optional_Payment_Type" + i);
			var optional_payment_after = document.getElementById("optional_payment_after" + i);
			var optional_invoice_send = document.getElementsByName("R01_Optional_Invoice_Send" + i);
			var optional_invoice_send_after = document.getElementById("optional_invoice_send_after" + i);

			var optional_credit_after = document.getElementById("optional_credit_after" + i);
			
			for (var m = 0, length = payment_type.length; m < length; m++) {
				if (payment_type[m].checked ) {
					if(payment_type[m].value == 0) {
						optional_payment_after.style.display = "block";
					} else {
						optional_payment_after.style.display = "none";
					}

					if(payment_type[m].value == 1) {
						optional_credit_after.style.display = "block";
					} else {
						optional_credit_after.style.display = "none";
					}
					break;
				} 
 			}
			
			for (var k = 0, length = optional_invoice_send.length; k < length; k++) {
				if (optional_invoice_send[k].checked ) {
					if(optional_invoice_send[k].value == 2) {
						optional_invoice_send_after.style.display = "block";
					} else {
						optional_invoice_send_after.style.display = "none";
					}
					break;
				} 
 			}
		}
	}

	
	onclick = function() {

		if(tui0.checked){
			j_0.style.display = "block";
		}else{
			j_0.style.display = "none";
		}
		
		if (tui15.checked) {
			j_15.style.display = "block";
		} else {
			j_15.style.display = "none";
		}
		
		if(tui16.checked){
			j_16.style.display = "block";
		} else {
			j_16.style.display = "none";
		}

		if(tui17.checked){
			j_17.style.display = "block";
		} else {
			j_17.style.display = "none";
		}
		

		if(tui19.checked){
			j_19.style.display = "block";
		} else {
			j_19.style.display = "none";
		}

		var optional_flag = document.getElementById("optional_flag").value;
		if(optional_flag == 1) {
			var optional_item_list = document.getElementsByClassName("optional_item");
			for (var i = 0; i < optional_item_list.length; i++) {
				document.getElementById("optional_item" + i).style.display = "block";

				var status_name = "M01_Optional_Resever_Status" + i;
				var status = $('input[name ="' + status_name + '"]:checked').val();
				if(status == 3) {
					$("#M01_Optional_Cancel_Charge" + i).prop('disabled', false);
				} else {
					$("#M01_Optional_Cancel_Charge" + i).prop('disabled', true);
					$("#M01_Optional_Cancel_Charge" + i).val('0');
				}
				
				var payment_type = document.getElementsByName("M01_Optional_Payment_Type" + i);
				var optional_payment_after = document.getElementById("optional_payment_after" + i);
				var optional_invoice_send = document.getElementsByName("R01_Optional_Invoice_Send" + i);
				var optional_invoice_send_after = document.getElementById("optional_invoice_send_after" + i);
				var optional_credit_after = document.getElementById("optional_credit_after" + i);
				
				for (var m = 0, length = payment_type.length; m < length; m++) {
					if (payment_type[m].checked ) {
						if(payment_type[m].value == 0) {
							optional_payment_after.style.display = "block";

							for (var k = 0, length = optional_invoice_send.length; k < length; k++) {
								if (optional_invoice_send[k].checked ) {
									if(optional_invoice_send[k].value == 2) {
										optional_invoice_send_after.style.display = "block";
									} else {
										optional_invoice_send_after.style.display = "none";
									}
									break;
								} 
				 			}
							
						} else {
							optional_payment_after.style.display = "none";
							optional_invoice_send_after.style.display = "none";
						}

						if(payment_type[m].value == 1) {
							optional_credit_after.style.display = "block";
						} else {
							optional_credit_after.style.display = "none";
						}
						
						break;
					}
	 			}
			}
		}
	}
});

</script>

<script>
	function courseShow(){
		var  selectBox = document.getElementById("R01_course");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		if(selectedValue == "D"){
			document.getElementById("course_d").style.display = "block";
			document.getElementById("course_a").style.display = "none";
			document.getElementById("course_b").style.display = "none";
			document.getElementById("course_c").style.display = "none";
			document.getElementById("dhotel").style.display = "block";
			document.getElementById("bhotel").style.display = "none";
			document.getElementById("ahotel").style.display = "none";
			
		}
		if(selectedValue == "A"){ 
			document.getElementById("course_d").style.display = "none";
			document.getElementById("course_a").style.display = "block";
			document.getElementById("course_b").style.display = "none";
			document.getElementById("course_c").style.display = "none";
			document.getElementById("dhotel").style.display = "none";
			document.getElementById("bhotel").style.display = "none";
			document.getElementById("ahotel").style.display = "block";
		}
		if(selectedValue == "B"){
			document.getElementById("course_d").style.display = "none";
			document.getElementById("course_a").style.display = "none";
			document.getElementById("course_b").style.display = "block";
			document.getElementById("course_c").style.display = "none";
			document.getElementById("dhotel").style.display = "none";
			document.getElementById("bhotel").style.display = "block";
			document.getElementById("ahotel").style.display = "none";
		
		}
		if(selectedValue == "C"){
			document.getElementById("course_d").style.display = "none";
			document.getElementById("course_a").style.display = "none";
			document.getElementById("course_b").style.display = "none";
			document.getElementById("course_c").style.display = "block";
			document.getElementById("dhotel").style.display = "none";
			document.getElementById("bhotel").style.display = "none";
			document.getElementById("ahotel").style.display = "block";
		}
	}
	function Changeair_tehai() {
		var air_tehai = $("input[name='R01_air_tehai']:checked").val();
			if(air_tehai == "1"){
				document.getElementById("air_tehai").style.display = "block";
			}else{
				document.getElementById("air_tehai").style.display = "none";
			}

	}
	function Changehotel_tehai() {
		var hotel_tehai = $("input[name='R01_hotel_tehai']:checked").val();
			if(hotel_tehai == "1"){
				document.getElementById("hotel_tehai").style.display = "block";
			}else{
				document.getElementById("hotel_tehai").style.display = "none";
			}

	}
	function showOtherAirportInput() {
		var select_dep_airport = document.getElementById("R01_Dep_Airport").value;
		var select_other_airport_div = document.getElementById("R01_Other_Airport_Div");

		var display_flag_0 = document.getElementById("R01_Other_Airport_Disply_Flag_0");
		
		if ((select_dep_airport == "0") || (select_dep_airport == "1")) {
			select_other_airport_div.style.display = "none";
		} else {
			select_other_airport_div.style.display = "block";
			display_flag_0.checked = true;
		}
	}

	function radio_choice_room_0() {
			document.getElementById("choice_room_after").style.display = "none";
	} 
	function radio_choice_room_1() {
			document.getElementById("choice_room_after").style.display = "block";
	}

	function radio_invoice_0() {
		document.getElementById("invoice_after").style.display = "block";
		var radio_invoice_temp = document.getElementById("R01_Invoice_Send_2");
		
		if(radio_invoice_temp.checked) {
			document.getElementById("invoice_send_after").style.display = "block";
		}
	}

	function radio_invoice_1() {
		document.getElementById("invoice_after").style.display = "none";
		document.getElementById("invoice_send_after").style.display = "none";
	}

	function radio_invoice_send_0() {
		document.getElementById("invoice_send_after").style.display = "none";
	}

	function radio_invoice_send_1() {
		document.getElementById("invoice_send_after").style.display = "none";
	}

	function radio_invoice_send_2() {
		document.getElementById("invoice_send_after").style.display = "block";
	}

	function closeWindow() {
		window.opener.$("#searchbtn" ).trigger( "click" );
		window.close();
	}
	
</script>

<script>
function savePhoto(){
	var file="R01_Passport_upload";
	var userid=document.getElementById("R01_Reservation_No").value;
	var xmlHttpRequest = new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange = function() {
		var READYSTATE_COMPLETED = 4;
		var HTTP_STATUS_OK = 200;
		//alert(this.readyState);
		//alert(this.status);
		if( this.readyState == READYSTATE_COMPLETED && this.status == HTTP_STATUS_OK ) {
			var result = xmlHttpRequest.responseText;
			var res = result.substr(0, 5);
			if( res == "(ERR)") {
				alert(result);
			} else {
				var string =result;
				var strx   = string.split('/');
				var array  = [];
				array = array.concat(strx);
				var file_name=array[5];
				document.getElementById("uploadclick").style.background="#33BFDB";
				document.getElementById("uploadclick").value="再アップロード";
				document.getElementById("R01_Passport_upload_Name").value=file_name;
				document.getElementById("link").style.display="none";
				document.getElementById("link1").style.display="none";
				document.getElementById("org_img").style.display="none";
// 				document.getElementById("name2").innerHTML="アップロード済みです。";
// 				document.getElementById("name").innerHTML = "<a href='"+result+"' target='_blank'>アップロード済画像の確認</a>";
				document.getElementById("name").style.display="block";
				document.getElementById("remove_img").style.display="block";
				alert("アップロード完了しました。");
			}
		}
	}
	xmlHttpRequest.open('POST',"<?php echo base_url(); ?>mypage_con/image_save",true );
	var fd = new FormData();
	fd.append('R01_Passport_upload', $('input[type=file]')[0].files[0]);
	fd.append('userid',userid)
	xmlHttpRequest.send(fd);
}
</script>

<script>

$(function(){
	$("#R01_Payment_Date_1").datepicker({
		dateFormat: 'yy/mm/dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});
	$("#R01_Payment_Date_2").datepicker({
		dateFormat: 'yy/mm/dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});
	$("#R01_Payment_Date_3").datepicker({
		dateFormat: 'yy-mm-dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});
	$("#R01_Payment_Date_4").datepicker({
		dateFormat: 'yy-mm-dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});
	$("#R01_Payment_Date_5").datepicker({
		dateFormat: 'yy-mm-dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});
	
	$("#R01_Register_Payment_Deadline").datepicker({
		dateFormat: 'yy-mm-dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});
});

</script>

<script>
function loadSubmitForm() {
	var confirm = window.confirm("更新します、よろしいですか？");
	if(confirm) {
		return true;
	} else {
		return false;
	}
}

<?php if($update_status == 1){?>
setTimeout(function(){
	alert("更新成功しました。");
	//window.opener.$("#searchbtn" ).trigger( "click" );
	//window.close();
	},300);
<?php }else if($update_status == 2){ ?>
setTimeout(function(){
	alert("更新失敗しました。");
	},300);
<?php } ?>
</script>

<script type="text/javascript">
function openMyPage(charger_type){
	
	var r01_id = document.getElementById("R01_Reservation_No").value;
	var r01_password = document.getElementById("R01_password").value;

	var form = document.createElement( 'form' );
	document.body.appendChild( form );
	// Set post data with input_1 and input_2
	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'r01_id' );
	input_1.setAttribute( 'value' , r01_id );
	form.appendChild( input_1 );
	var input_2 = document.createElement( 'input' );
	input_2.setAttribute( 'type' , 'hidden' );
	input_2.setAttribute( 'name' , 'r01_password' );
	input_2.setAttribute( 'value' , r01_password );
	form.appendChild( input_2 );
	
	// Set action post
	form.setAttribute( 'action' , "<?php echo base_url();?>menu_con/openMypage" );
	form.setAttribute( 'method' , 'post' );
	// 指示されたタゲットの名前を設定
	form.setAttribute( 'target' , '_blank');
	form.submit();
}

function getImage(R01_Reservation_No) {
	var postData_1 = R01_Reservation_No;

	var form = document.createElement( 'form' );
	document.body.appendChild( form );
	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'R01_Reservation_No' );
	input_1.setAttribute( 'value' , postData_1 );
	form.appendChild( input_1 );
	
	form.setAttribute( 'action' , "<?php echo base_url();?>menu_con/getImageConfirm" );
	form.setAttribute( 'method' , 'post' );
	// 指示されたタゲットの名前を設定
	form.setAttribute( 'target' , '_blank');
	
	form.submit();
	
}


function removePhoto(R01_Reservation_No) {
	if(window.confirm("画像を削除してよろしいですか？")) {
		$.ajax({
			url: '<?php echo base_url();?>menu_con/removeImage',
			type: 'POST',
			dataType : 'text',
			data: {
				"R01_Reservation_No" : R01_Reservation_No,
			},
			success: function(text) {
				if (text == "success") {
					document.getElementById("link").style.display="none";
					document.getElementById("link1").style.display="none";
					document.getElementById("org_img").style.display="none";
					document.getElementById("name").style.display="none";
					clearFileInput(document.getElementById("R01_Passport_upload"));
					alert("削除しました。");
				} else {
					alert("削除失敗しました。");
				}
			},
			error: function() {
				alert("削除失敗しました。");
			}
		});
		
		return true;
	} else {
		return false;
	}
}

function clearFileInput(ctrl) {
	  try {
	    ctrl.value = null;
	  } catch(ex) { }
	  if (ctrl.value) {
	    ctrl.parentNode.replaceChild(ctrl.cloneNode(true), ctrl);
	  }
	}

</script>

<script>

function formatMoney(value) {
	var num = value.toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "円";
	return num;
}

$(function(){
	
	var R01_total_fee_str = $("#R01_total_fee_temp").text();
	var R01_total_fee = parseInt(R01_total_fee_str);
	
	$("#R01_total_fee_temp").text(formatMoney(R01_total_fee));

	var R01_Payment_Date_1 = $("#R01_Payment_Date_1").val();
	var R01_Payment_Date_2 = $("#R01_Payment_Date_2").val();
	var R01_Payment_Date_3 = $("#R01_Payment_Date_3").val();
	var R01_Payment_Date_4 = $("#R01_Payment_Date_4").val();
	var R01_Payment_Date_5 = $("#R01_Payment_Date_5").val();

	if (R01_Payment_Date_1 == "0000-00-00") {
		$("#R01_Payment_Date_1").val("");
	}
	if (R01_Payment_Date_2 == "0000-00-00") {
		$("#R01_Payment_Date_2").val("");
	}
	if (R01_Payment_Date_3 == "0000-00-00") {
		$("#R01_Payment_Date_3").val("");
	}
	if (R01_Payment_Date_4 == "0000-00-00") {
		$("#R01_Payment_Date_4").val("");
	}
	if (R01_Payment_Date_5 == "0000-00-00") {
		$("#R01_Payment_Date_5").val("");
	}
	
	
	var R01_Payment_Amount_1_str = $("#R01_Payment_Amount_1").val();
	if (R01_Payment_Amount_1_str == "0") {
		$("#R01_Payment_Amount_1").val("");
	}
	var R01_Payment_Amount_1 = parseInt(R01_Payment_Amount_1_str);
	
	var R01_Payment_Amount_2_str = $("#R01_Payment_Amount_2").val();
	if (R01_Payment_Amount_2_str == "0") {
		$("#R01_Payment_Amount_2").val("");
	}
	var R01_Payment_Amount_2 = parseInt(R01_Payment_Amount_2_str);
	
	var R01_Payment_Amount_3_str = $("#R01_Payment_Amount_3").val();
	if (R01_Payment_Amount_3_str == "0") {
		$("#R01_Payment_Amount_3").val("");
	}
	var R01_Payment_Amount_3 = parseInt(R01_Payment_Amount_3_str);

	var R01_Payment_Amount_4_str = $("#R01_Payment_Amount_4").val();
	if (R01_Payment_Amount_4_str == "0") {
		$("#R01_Payment_Amount_4").val("");
	}
	var R01_Payment_Amount_4 = parseInt(R01_Payment_Amount_4_str);

	var R01_Payment_Amount_5_str = $("#R01_Payment_Amount_5").val();
	if (R01_Payment_Amount_5_str == "0") {
		$("#R01_Payment_Amount_5").val("");
	}
	var R01_Payment_Amount_5 = parseInt(R01_Payment_Amount_5_str);

	var R01_payment_total = R01_Payment_Amount_1 + R01_Payment_Amount_2 + R01_Payment_Amount_3 + R01_Payment_Amount_4 + R01_Payment_Amount_5;
	$("#R01_payment_total").text(formatMoney(R01_payment_total)) ;
	var R01_payment_balance = R01_total_fee - R01_payment_total;
	$("#R01_payment_balance").text(formatMoney(R01_payment_balance));
});


$(function(){
	var optional_flag = $(':hidden[name="optional_flag"]').val();
	if(optional_flag == 1) {
		
		var optional_item_list = $(".optional_item");
		var optional_cost_total_str = $("#M01_Optional_Tour_Cost_Total").text();
		var optional_cost_total = parseInt(optional_cost_total_str);

		for (var i = 0; i < optional_item_list.length; i++) {

			var optional_cancel_charge = $("#M01_Optional_Cancel_Charge" + i).val();
			var optional_cancel = parseInt(optional_cancel_charge);
			
			var optional_cost_obj = $("#M01_Optional_Tour_Cost_1" + i);
			var optional_tour_cost_str = optional_cost_obj.text();
			var optional_tour_cost = parseInt(optional_tour_cost_str);
			optional_cost_obj.text(formatMoney(optional_tour_cost));

			var status_name = "M01_Optional_Resever_Status" + i;
			var optional_status = $('input[name ="' + status_name + '"]:checked').val();
			if(optional_status == 2) {
				optional_cost_total += optional_tour_cost;
			} else if(optional_status == 3) {
				optional_cost_total += optional_cancel;
			} else {
				optional_cost_total += 0;
			}

			$("#M01_Optional_Tour_Cost_Total").text(formatMoney(optional_cost_total));
			$("#M01_Optional_Tour_Cost_Total_Temp1").text(formatMoney(optional_cost_total));
			$(':hidden[name="R01_Optional_Cost_Total"]').val(optional_cost_total);
		}
	}
});

$(function(){
	var optional_flag = $(':hidden[name="optional_flag"]').val();
	if(optional_flag == 1) {
		
		var optional_item_list = $(".optional_item");
		var optional_cost_total_str = $("#M01_Optional_Tour_Cost_Total").text();
		var optional_cost_total = parseInt(optional_cost_total_str);

		for (var i = 0; i < optional_item_list.length; i++) {
			
			$('input[name ="' + "M01_Optional_Resever_Status" + i + '"]').change({index : i}, function(event) {
				
				total = 0;
				for (var k = 0; k < optional_item_list.length; k++) {
					var optional_cost_obj = $("#M01_Optional_Tour_Cost" + k);
					var optional_tour_cost_str = optional_cost_obj.val();
					var optional_tour_cost = parseInt(optional_tour_cost_str);

					var optional_cancel_charge = $("#M01_Optional_Cancel_Charge" + k).val();
					var optional_cancel = parseInt(optional_cancel_charge);
					
					var status_name = "M01_Optional_Resever_Status" + k;
					var status = $('input[name ="' + status_name + '"]:checked').val();
					if(status == 2) {
						total += optional_tour_cost;
					} else if(status == 3) {
						total += optional_cancel;
					} else {
						total += 0;
					}
				}

				$("#M01_Optional_Tour_Cost_Total").text(formatMoney(total));
				$("#M01_Optional_Tour_Cost_Total_Temp1").text(formatMoney(total));
				$(':hidden[name="R01_Optional_Cost_Total"]').val(total);
			});
		}
	}
});

</script>


<script>
$(function() {
	// 手配
	$("#R03_Departure_Japan_Date").datepicker({
		dateFormat: 'yy-mm-dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});

	$("#R03_Departure_Current_Date").datepicker({
		dateFormat: 'yy-mm-dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});

	$("#R03_Hotel_Checkin_Date").datepicker({
		dateFormat: 'yy-mm-dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});

	$("#R03_Hotel_Checkout_Date").datepicker({
		dateFormat: 'yy-mm-dd' ,
		changeMonth:true, 
		changeYear:true,
		numberOfMonths: 1,
		yearRange: "-5:+5"
	});


	var japan_date = $("#R03_Departure_Japan_Date").val();
	if ( japan_date == "0000-00-00" ){
		$("#R03_Departure_Japan_Date").val("");
	}

	var current_date = $("#R03_Departure_Current_Date").val();
	if ( current_date == "0000-00-00" ){
		$("#R03_Departure_Current_Date").val("");
	}

	var checkin_date = $("#R03_Hotel_Checkin_Date").val();
	if ( checkin_date == "0000-00-00" ){
		$("#R03_Hotel_Checkin_Date").val("");
	}

	var checkout_date = $("#R03_Hotel_Checkout_Date").val();
	if ( checkout_date == "0000-00-00" ){
		$("#R03_Hotel_Checkout_Date").val("");
	}
});

$(function(){
	var optional_flag = $(':hidden[name="optional_flag"]').val();
	if(optional_flag == 1) {
		
		var optional_item_list = $(".optional_item");
		var optional_cost_total_str = $("#M01_Optional_Tour_Cost_Total").text();
		var optional_cost_total = parseInt(optional_cost_total_str);

		for (var i = 0; i < optional_item_list.length; i++) {
			
			$('input[name ="' + "M01_Optional_Cancel_Charge" + i + '"]').change({index : i}, function(event) {

				var cancel_charge_str = $("#M01_Optional_Cancel_Charge" + i).val();
				var cancel_charge = parseInt(cancel_charge_str);
				
				total = 0;
				for (var k = 0; k < optional_item_list.length; k++) {
					var optional_cost_obj = $("#M01_Optional_Tour_Cost" + k);
					var optional_tour_cost_str = optional_cost_obj.val();
					var optional_tour_cost = parseInt(optional_tour_cost_str);

					var optional_cancel_charge = $("#M01_Optional_Cancel_Charge" + k).val();
					var optional_cancel = parseInt(optional_cancel_charge);
					
					var status_name = "M01_Optional_Resever_Status" + k;
					var status = $('input[name ="' + status_name + '"]:checked').val();
					if(status == 2) {
						total += optional_tour_cost;
					} else if(status == 3) {
						total += optional_cancel;
					} else {
						total += 0;
					}
				}

				$("#M01_Optional_Tour_Cost_Total").text(formatMoney(total));
				$("#M01_Optional_Tour_Cost_Total_Temp1").text(formatMoney(total));
				$(':hidden[name="R01_Optional_Cost_Total"]').val(total);
			});
		}
	}
});


$(function(){
	var R01_Optional_Cost_Total = $("#R01_Optional_Cost_Total").val();
	$("#M01_Optional_Tour_Cost_Total_Temp1").text(formatMoney(parseInt(R01_Optional_Cost_Total)));
	var R01_total_fee = $("#R01_total_fee").val();

	var Cost_Total = parseInt(R01_Optional_Cost_Total) + parseInt(R01_total_fee);
	$("#Cost_Total").text(formatMoney(Cost_Total));
});

</script>


<!-- 
<?php if($R01_Cancel_Flag=="1" || $R01_Cancel_Flag=="2"){ ?>
 	<script>
 	$( document ).ready(function(){
 		$(":input").prop('disabled', true);
 	});
 	</script>
<?php }?>
 -->
</head>
<body onload ="courseShow();Changehotel_tehai();Changeair_tehai()">
	<div class="title-header" style="margin-top: 0px;">
				<div>
					<label style="font: bold; font-size: 35px; color: white; font-family: Arial, Tahoma;">登録者情報編集画面</label>
					<div style="float: right;">
					<?php 
						if (($Charger_Type == "2") || ($Charger_Type == "9")) { ?>
						<input type="submit" class="button button-glow button-rounded button-royal" name="open_mypage" id="open_mypage" value="My Page"  style="margin: 0 auto; margin-bottom: 10px; " onclick="openMyPage(<?php echo $Charger_Type; ?>)" >
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
					<th style="width: 30%;">登録ID</th>
					<td>
						<label name="register_id" id="register_id">
						<?php if (isset($R01_Reservation_No)) { echo $R01_Reservation_No; } else {echo ""; } ?>
						</label>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;">お名前</th>
					<td>
						<label name="register_name" id="register_name">
						<?php 
							if (!isset($R01_Name_Kanji_Sei)) {
								$R01_Name_Kanji_Sei = '';
							}
							
							if (!isset($R01_Name_Kanji_Mei)) {
								$R01_Name_Kanji_Me = '';
							}
							
							echo htmlentities($R01_Name_Kanji_Sei,ENT_QUOTES, "UTF-8") . " " . htmlentities($R01_Name_Kanji_Mei,ENT_QUOTES, "UTF-8");
						?>
						</label>
					</td>
				</tr>
				<?php if (($Charger_Type == "2") || ($Charger_Type == "9")) { ?>
				<tr>
					<th style="width: 30%;">ステータス</th>
					<td>
						<input type="radio" name="R01_Cancel_Flag" value="0" <?php if($R01_Cancel_Flag=="0"){ echo "checked"; }?> onclick="$('#R01_Cancel_Flag_Temp').val('0');"/>予約
						<input type="radio" name="R01_Cancel_Flag" value="1" <?php if($R01_Cancel_Flag=="1"){ echo "checked"; }?> onclick="$('#R01_Cancel_Flag_Temp').val('1');"/>キャンセル
						<input type="radio" name="R01_Cancel_Flag" value="2" <?php if($R01_Cancel_Flag=="2"){ echo "checked"; }?> onclick="$('#R01_Cancel_Flag_Temp').val('2');"/>削除
					</td>
				</tr>
				<?php if($R01_Cancel_Flag=="1"){ ?>
				<tr>
					<th style="width: 30%;">キャンセル日付</th>
					<td><?php echo $R01_Cancel_Date;?></td>
				</tr>
				<?php }?>
				<?php }?>
			</tbody>
		</table>
	</div>
	<!-- ADD ACCOUNT INFORMATION END -->
	
<!-- START EDIT VIEW WITH LOGIN_TYPE 2 and 9 これから「２と９」 -->

<?php if (($Charger_Type == "2") || ($Charger_Type == "9")) { ?> <!-- get $Charger_Type from menu_con/edit method -->
<!-- CHANGE INFO FORM START -->
<form action="<?php echo base_url(); ?>menu_con/edit_info" method="post" name="edit_info_form" id="edit_info_form" onsubmit="return loadSubmitForm()" >

<table  id="form" width="100%" style="margin-top: -10px;">
<tbody>
<?php if ($Charger_Type == "9") { ?>
	<tr>
		<th style="width: 30%;">レジトレーション状態</th>
		<td>
			<input type="radio" name="R01_Registration" id="R01_Registration_0" value="0" <?php if(isset($R01_Registration) && $R01_Registration == "0"){ echo "checked"; }?> />
			<label for="R01_Registration_0">代行登録</label>
			<input type="radio" name="R01_Registration" id="R01_Registration_1" value="1" <?php if(isset($R01_Registration) && $R01_Registration == "1"){ echo "checked"; }?> />
			<label for="R01_Registration_1">ご自身で参加登録する</label>
		</td>
	</tr>
	<?php } elseif ($Charger_Type == "2") { ?>
			<input type="hidden" name="R01_Registration_Flag" id="R01_Registration_Flag" value="<?php echo $R01_Registration; ?>" />
	<?php } ?>
</tbody>
</table>

<!-- START TAB SELECT REGISTER CONTENT -->
<div id="control-tab">
			<table id="form" width="100%">
				<tbody>
				<tr>
					<input type="hidden" id="R01_Cancel_Flag_Temp" name="R01_Cancel_Flag_Temp" value="<?php echo $R01_Cancel_Flag; ?>"/>
					<th style="width: 30%;" >登録内容</th>
					<td>
						<input type="radio" name="R01_Registration_Temp" id="tmp_101" value="0" <?php if($R01_Registration == "0"){echo "checked";} ?> <?php if ($R01_Registration == "1") {echo "disabled=\"disabled\""; } else {echo ""; } ?> />
						<label for="tmp_101">代行登録を希望する</label>
						<input type="radio" name="R01_Registration_Temp" id="tmp_102" value="1" <?php if($R01_Registration == "1"){echo "checked";} ?> />
						<label for="tmp_102">ご自身で参加登録する</label>
						<input type="radio" name="R01_Registration_Temp" id="tmp_103" value="2" <?php if($R01_Registration_Temp == "2"){echo "checked";} ?> />
						<label for="tmp_103">旅行代金</label>
						<input type="radio" name="R01_Registration_Temp" id="tmp_104" value="3" <?php if($R01_Registration_Temp == "3"){echo "checked";} ?> />
						<label for="tmp_104">入金</label>
						<!--<input type="radio" name="R01_Registration_Temp" id="tmp_105" value="4" <?php if($R01_Registration_Temp == "4"){echo "checked";} ?> />
						<label for="tmp_105">オプショナルツアー</label>-->
						<input type="radio" name="R01_Registration_Temp" id="tmp_106" value="5" <?php if($R01_Registration_Temp == "5"){echo "checked";} ?> />
						<label for="tmp_106">手配情報</label><br />
					</td>
				</tr>
				</tbody>
			</table>
</div>
<!-- END TAB SELECT REGISTER CONTENT -->


<!-- START Arrangement SOURCE 手配情報部分 -->
<div id="arrangement" style="display: none;">
			
				<table id="form" width="100%" style="margin-bottom: 0px;">
					<tbody>
						<tr>
							<th colspan="2"><div align="center">AIR手配</div></th>
						</tr>
					</tbody>
				</table>
				<table id="form" width="100%" style="margin-bottom: 10px; ">
				<tbody>
					<tr>
						<th width="30%" >HIS手配or自己手配</th>
						<td>
							<input type="text" name="R03_AIR_Arrangement_Object" id="R03_AIR_Arrangement_Object" value="<?php if (isset($R03_AIR_Arrangement_Object)){ echo htmlentities($R03_AIR_Arrangement_Object,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th style="width: 30%;">出発空港</th>
						<td >
							<label>
							<?php 
							if (isset($R01_Dep_Airport)) {
								if ($R01_Dep_Airport == "0") {
									echo "成田空港発着";
								} elseif ($R01_Dep_Airport == "1") {
									echo "羽田空港発着";
								} else {
									if (isset($R01_Other_Airport)) {
										echo "その他日本国内空港: " . $R01_Other_Airport;
									} else {
										echo "";
									}
								}
							}
							?>
							</label>
						</td>
					</tr>
					<tr>
						<th width="30%">日本出発日</th>
						<td>
							<input type="text" name="R03_Departure_Japan_Date" id="R03_Departure_Japan_Date" value="<?php if (isset($R03_Departure_Japan_Date)){ echo $R03_Departure_Japan_Date;} else {echo "";} ?>" size="12" />
						</td>
					</tr>
					<tr>
						<th width="30%" >現地出発日</th>
						<td>
							<input type="text" name="R03_Departure_Current_Date" id="R03_Departure_Current_Date" value="<?php if (isset($R03_Departure_Current_Date)) { echo $R03_Departure_Current_Date; } else { echo ""; } ?>" size="12" />
						</td>
					</tr>
					<tr>
						<th width="30%" >手配クラス</th>
						<td>
							<input type="text" name="R03_AIR_Arrangement_Class" id="R03_AIR_Arrangement_Class" value="<?php if (isset($R03_AIR_Arrangement_Class)) { echo htmlentities($R03_AIR_Arrangement_Class,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%">手配1エアー</th>
						<td>
							<table>
								<tr>
									<th>日付</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_1_Date" id="R03_AIR_Arrangement_1_Date" value="<?php if (isset($R03_AIR_Arrangement_1_Date)) { echo htmlentities($R03_AIR_Arrangement_1_Date,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
									<th>便名・時間</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_1_Flight" id="R03_AIR_Arrangement_1_Flight" value="<?php if (isset($R03_AIR_Arrangement_1_Flight)) { echo htmlentities($R03_AIR_Arrangement_1_Flight,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th width="30%" >手配2エアー</th>
						<td>
							<table>
								<tr>
									<th>日付</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_2_Date" id="R03_AIR_Arrangement_2_Date" value="<?php if (isset($R03_AIR_Arrangement_2_Date)) { echo htmlentities($R03_AIR_Arrangement_2_Date,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
									<th>便名・時間</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_2_Flight" id="R03_AIR_Arrangement_2_Flight" value="<?php if (isset($R03_AIR_Arrangement_2_Flight)) { echo htmlentities($R03_AIR_Arrangement_2_Flight,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					
					<tr>
						<th width="30%">手配3エアー</th>
						<td>
							<table>
								<tr>
									<th>日付</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_3_Date" id="R03_AIR_Arrangement_3_Date" value="<?php if (isset($R03_AIR_Arrangement_3_Date)) { echo htmlentities($R03_AIR_Arrangement_3_Date,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
									<th>便名・時間</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_3_Flight" id="R03_AIR_Arrangement_3_Flight" value="<?php if (isset($R03_AIR_Arrangement_3_Flight)) { echo htmlentities($R03_AIR_Arrangement_3_Flight,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th width="30%" >手配4エアー</th>
						<td>
							<table>
								<tr>
									<th>日付</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_4_Date" id="R03_AIR_Arrangement_4_Date" value="<?php if (isset($R03_AIR_Arrangement_4_Date)) { echo htmlentities($R03_AIR_Arrangement_4_Date,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
									<th>便名・時間</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_4_Flight" id="R03_AIR_Arrangement_4_Flight" value="<?php if (isset($R03_AIR_Arrangement_4_Flight)) { echo htmlentities($R03_AIR_Arrangement_4_Flight,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th width="30%">手配5エアー</th>
						<td>
							<table>
								<tr>
									<th>日付</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_5_Date" id="R03_AIR_Arrangement_5_Date" value="<?php if (isset($R03_AIR_Arrangement_5_Date)) { echo htmlentities($R03_AIR_Arrangement_5_Date,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
									<th>便名・時間</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_5_Flight" id="R03_AIR_Arrangement_5_Flight" value="<?php if (isset($R03_AIR_Arrangement_5_Flight)) { echo htmlentities($R03_AIR_Arrangement_5_Flight,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th width="30%">手配6エアー</th>
						<td>
							<table>
								<tr>
									<th>日付</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_6_Date" id="R03_AIR_Arrangement_6_Date" value="<?php if (isset($R03_AIR_Arrangement_6_Date)) { echo htmlentities($R03_AIR_Arrangement_6_Date,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
									<th>便名・時間</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_6_Flight" id="R03_AIR_Arrangement_6_Flight" value="<?php if (isset($R03_AIR_Arrangement_6_Flight)) { echo htmlentities($R03_AIR_Arrangement_6_Flight,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th width="30%">手配7エアー</th>
						<td>
							<table>
								<tr>
									<th>日付</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_7_Date" id="R03_AIR_Arrangement_7_Date" value="<?php if (isset($R03_AIR_Arrangement_7_Date)) { echo htmlentities($R03_AIR_Arrangement_7_Date,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
									<th>便名・時間</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_7_Flight" id="R03_AIR_Arrangement_7_Flight" value="<?php if (isset($R03_AIR_Arrangement_7_Flight)) { echo htmlentities($R03_AIR_Arrangement_7_Flight,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				
					<tr>
						<th width="30%">手配8エアー</th>
						<td>
							<table>
								<tr>
									<th width="10%">日付</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_8_Date" id="R03_AIR_Arrangement_8_Date" value="<?php if (isset($R03_AIR_Arrangement_8_Date)) { echo htmlentities($R03_AIR_Arrangement_8_Date,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
									<th width="10%">便名・時間</th>
									<td>
										<input type="text" name="R03_AIR_Arrangement_8_Flight" id="R03_AIR_Arrangement_8_Flight" value="<?php if (isset($R03_AIR_Arrangement_8_Flight)) { echo htmlentities($R03_AIR_Arrangement_8_Flight,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th width="30%" >特記事項（シート／マイレージ）</th>
						<td>
							<textarea name="R03_AIR_Special_Report" id="R03_AIR_Special_Report" rows="5" cols="120"><?php if (isset($R03_AIR_Special_Report)){ echo htmlentities($R03_AIR_Special_Report,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?></textarea>
						</td>
					</tr>
					<tr>
						<th width="30%" >ESTA（要・不要）</th>
						<td>
							<input type="text" name="R03_ESTA_Flag" id="R03_ESTA_Flag" value="<?php if (isset($R03_ESTA_Flag)){ echo htmlentities($R03_ESTA_Flag,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%" >ESTA備考</th>
						<td>
							<textarea name="R03_ESTA_Note" id="R03_ESTA_Note" rows="5" cols="120"><?php if (isset($R03_ESTA_Note)){ echo htmlentities($R03_ESTA_Note,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?></textarea>
						</td>
					</tr>
				</tbody>
				</table>
				
				<table id="form" width="100%" style="margin-top: 20px; margin-bottom: 0px;">
					<tbody>
						<tr>
							<th colspan="2"><div align="center">ホテル手配</div></th>
						</tr>
					</tbody>
				</table>
				<table id="form4"  width="100%" style="margin-bottom: 10px; ">
				<tbody>
					<tr>
						<th width="30%" >HIS手配or自己手配</th>
						<td>
							<input type="text" name="R03_Hotel_Arrangement_Object" id="R03_Hotel_Arrangement_Object" value="<?php if (isset($R03_Hotel_Arrangement_Object)){ echo htmlentities($R03_Hotel_Arrangement_Object,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%" >ホテル名</th>
						<td>
							<input type="text" name="R03_Hotel_Name" id="R03_Hotel_Name" value="<?php if (isset($R03_Hotel_Name)){ echo htmlentities($R03_Hotel_Name,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%" >ホテルカテゴリー</th>
						<td>
							<input type="text" name="R03_Hotel_Category" id="R03_Hotel_Category" value="<?php if (isset($R03_Hotel_Category)){ echo htmlentities($R03_Hotel_Category,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%" >部屋タイプ</th>
						<td>
							<input type="text" name="R03_Hotel_Room_Type" id="R03_Hotel_Room_Type" value="<?php if (isset($R03_Hotel_Room_Type)){ echo htmlentities($R03_Hotel_Room_Type,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%" >チェックイン日</th>
						<td>
							<input type="text" name="R03_Hotel_Checkin_Date" id="R03_Hotel_Checkin_Date" value="<?php if (isset($R03_Hotel_Checkin_Date)){ echo $R03_Hotel_Checkin_Date; } else { echo ""; } ?>" size="12" />
						</td>
					</tr>
					<tr>
						<th width="30%" >チェックアウト日</th>
						<td>
							<input type="text" name="R03_Hotel_Checkout_Date" id="R03_Hotel_Checkout_Date" value="<?php if (isset($R03_Hotel_Checkout_Date)){ echo $R03_Hotel_Checkout_Date; } else { echo ""; } ?>" size="12" />
						</td>
					</tr>
					<tr>
						<th width="30%" >特記事項</th>
						<td>
							<textarea name="R03_Hotel_Special_Report" id="R03_Hotel_Special_Report" rows="5" cols="120"><?php if (isset($R03_Hotel_Special_Report)){ echo htmlentities($R03_Hotel_Special_Report,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?></textarea>
						</td>
					</tr>
				</tbody>
				</table>
				
				<table id="form" width="100%" style="margin-top: 20px; margin-bottom: 0px;">
					<tbody>
						<tr>
							<th colspan="2"><div align="center">送迎</div></th>
						</tr>
					</tbody>
				</table>
				<table  id="form4" width="100%" style="margin-top: 0px; margin-bottom: 20px;">
				<tbody>
					<tr>
						<th width="30%" >HIS手配or自己手配</th>
						<td>
							<input type="text" name="R03_Pickup_Arrangement_Object" id="R03_Pickup_Arrangement_Object" value="<?php if (isset($R03_Pickup_Arrangement_Object)){ echo htmlentities($R03_Pickup_Arrangement_Object,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%" >IN TRF</th>
						<td>
							<input type="text" name="R03_Pickup_IN_TRF" id="R03_Pickup_IN_TRF" value="<?php if (isset($R03_Pickup_IN_TRF)){ echo htmlentities($R03_Pickup_IN_TRF,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%" >OUT TRF</th>
						<td>
							<input type="text" name="R03_Pickup_OUT_TRF" id="R03_Pickup_OUT_TRF" value="<?php if (isset($R03_Pickup_OUT_TRF)){ echo htmlentities($R03_Pickup_OUT_TRF,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
						</td>
					</tr>
					<tr>
						<th width="30%" >特記事項</th>
						<td>
							<textarea name="R03_Pickup_Special_Report" id="R03_Pickup_Special_Report" rows="5" cols="120"><?php if (isset($R03_Pickup_Special_Report)){ echo htmlentities($R03_Pickup_Special_Report,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?></textarea>
						</td>
					</tr>
				</tbody>
				</table>
				
				<table id="form" width="100%" style="margin-bottom: 0px;">
					<tbody>
						<tr>
							<th colspan="2"><div align="center">オプショナル手配</div></th>
						</tr>
					</tbody>
				</table>
				<table id="form5" width="100%" style="margin-bottom: 10px; ">
				<tbody>
					<tr>
						<th width="30%">ナイアガラの滝とアウトレット</th>
						<td>
							<table style="margin-left: -5px;">
								<tr>
									<th>STS</th>
									<td>
										<input type="text" name="R03_Opt1_Arrangement_Status" id="R03_Opt1_Arrangement_Status" value="<?php if (isset($R03_Opt1_Arrangement_Status)) { echo htmlentities($R03_Opt1_Arrangement_Status,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
								<tr>
									<th>特記事項</th>
									<td>
										<textarea name="R03_Opt1_Arrangement_Special_Report" id="R03_Opt1_Arrangement_Special_Report" rows="5" cols="120"><?php if (isset($R03_Opt1_Arrangement_Special_Report)) { echo htmlentities($R03_Opt1_Arrangement_Special_Report,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?></textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th width="30%">ナイアガラの滝とワイナリーツアー</th>
						<td>
							<table style="margin-left: -5px;">
								<tr>
									<th>STS</th>
									<td>
										<input type="text" name="R03_Opt2_Arrangement_Status" id="R03_Opt2_Arrangement_Status" value="<?php if (isset($R03_Opt2_Arrangement_Status)) { echo htmlentities($R03_Opt2_Arrangement_Status,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
								<tr>
									<th>特記事項</th>
									<td>
										<textarea name="R03_Opt2_Arrangement_Special_Report" id="R03_Opt2_Arrangement_Special_Report" rows="5" cols="120"><?php if (isset($R03_Opt2_Arrangement_Special_Report)) { echo htmlentities($R03_Opt2_Arrangement_Special_Report,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?></textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th width="30%">Angus Glenゴルフコンペ</th>
						<td>
							<table style="margin-left: -5px;">
								<tr>
									<th>STS</th>
									<td>
										<input type="text" name="R03_Opt3_Arrangement_Status" id="R03_Opt3_Arrangement_Status" value="<?php if (isset($R03_Opt3_Arrangement_Status)) { echo htmlentities($R03_Opt3_Arrangement_Status,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
										&nbsp;&nbsp;&nbsp;
										<label>※レンタルクラブがあります。</label>
									</td>
								</tr>
								<tr>
									<th>特記事項</th>
									<td>
										<textarea name="R03_Opt3_Arrangement_Special_Report" id="R03_Opt3_Arrangement_Special_Report" rows="5" cols="120"><?php if (isset($R03_Opt3_Arrangement_Special_Report)) { echo htmlentities($R03_Opt3_Arrangement_Special_Report,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?></textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th width="30%">オンタリオサイエンスセントローレンス</th>
						<td>
							<table style="margin-left: -5px;">
								<tr>
									<th>STS</th>
									<td>
										<input type="text" name="R03_Opt4_Arrangement_Status" id="R03_Opt4_Arrangement_Status" value="<?php if (isset($R03_Opt4_Arrangement_Status)) { echo htmlentities($R03_Opt4_Arrangement_Status,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?>" size="30" />
									</td>
								</tr>
								<tr>
									<th>特記事項</th>
									<td>
										<textarea name="R03_Opt4_Arrangement_Special_Report" id="R03_Opt4_Arrangement_Special_Report" rows="5" cols="120"><?php if (isset($R03_Opt4_Arrangement_Special_Report)) { echo htmlentities($R03_Opt4_Arrangement_Special_Report,ENT_QUOTES, "UTF-8"); } else { echo ""; } ?></textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
				</table>
				<input type="hidden" name="R03_Reservation_No" id="R03_Reservation_No" value="<?php echo $R03_Reservation_No; ?>" />
				
</div>
<!-- END Arrangement SOURCE 手配情報部分 -->





<!--START Check optional flag: 0 -> optional null , 1 -> optional excist data -->
<input type="hidden" name="optional_flag" id="optional_flag" value="<?php echo $optional_flag; ?>" />
<!--END Check optional flag: 0 -> optional null , 1 -> optional excist data  -->


<!-- START OPTIONAL TOUR SOURCE オプショナルツアー管理部分 -->
<div id="optional" style="display: none;">
				<table id="form" width="100%" style="margin-bottom: 10px;">
				<tbody>
					<tr>
						<th colspan="2"><div align="center">オプショナルツアー</div></th>
					</tr>
				</tbody>
				</table>
				<?php 
				// Kiem tra optional co hay khong. Neu co thi thuc hien hien thi va thay doi. Neu khong thi show text
				if ($optional == "") {
				?>
				<table id="form" width="100%" style="margin-bottom: 10px;">
				<tbody>
					<tr>
						<td align="center">まだ、オプショナルツアーを予約していません</td>
						<input type="hidden" name="R01_Optional_Cost_Total" id="R01_Optional_Cost_Total" value="0" />
					</tr>
				</tbody>
				</table>
				<!-- Dat trong vong for cac optional ma nguoi dung nay da tham gia -->
				<?php 
				} else {
					// Vong for START
					$count = 1;
					$optional_length = count($optional);
					foreach ($optional as $key => $optional_item) {
						echo "<div class=\"optional_item\" id=\"optional_item" . $key ."\" style=\"display: none;\"> ";
				?>
				<!-- START div optional-item -->
					<table id="form" width="100%" style="margin-bottom: 0px; margin-top: 25px;">
					<tbody>
						<tr>
							<th width="30%" ><?php echo "オプショナルツアー名 " .$key; ?> </th>
							<td>
								<label name="<?php echo "M01_Optional_Tour_Name" . $key; ?>" id="<?php echo "M01_Optional_Tour_Name" . $key; ?>" style="float: left ;" >
								<?php 
								echo $optional_item['M01_Optional_Tour_Name'];
								?>
								</label>
								<input type="hidden" name="<?php echo "M01_Optional_No".$key; ?>" id="<?php echo "M01_Optional_No".$key; ?>" value="<?php echo $optional_item['M01_Optional_No']; ?>" />
							</td>
						</tr>
						<tr>
							<th width="30%" >日付</th>
							<td>
								<label name="<?php echo "M01_Optional_Tour_Date" . $key; ?>" id="<?php echo "M01_Optional_Tour_Date" . $key; ?>" style="float: left ;" >
								<?php 
								date_default_timezone_set("Asia/Tokyo");
								
								$originalDate = $optional_item['M01_Optional_Tour_Date'];
								$newDate = date("Y年m月d日", strtotime($originalDate));
								
								echo $newDate;
								
								?>
								</label>
							</td>
						</tr>
						<tr>
							<th width="30%" >お申込み状況</th>
							<td>
								<input type="radio" name="<?php echo "M01_Optional_Resever_Status" . $key; ?>" id="<?php echo "M01_Optional_Resever_Status" . $key . "_0"; ?>" value="1" <?php if($optional_item['M01_Optional_Resever_Status'] == 1){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Resever_Status" . $key . "_0"; ?>">現在手配中（回答待ち）</label>
								<input type="radio" name="<?php echo "M01_Optional_Resever_Status" . $key; ?>" id="<?php echo "M01_Optional_Resever_Status" . $key . "_1"; ?>" value="2" <?php if($optional_item['M01_Optional_Resever_Status'] == 2){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Resever_Status" . $key . "_1"; ?>">手配済</label>
								<input type="radio" name="<?php echo "M01_Optional_Resever_Status" . $key; ?>" id="<?php echo "M01_Optional_Resever_Status" . $key . "_2"; ?>" value="3" <?php if($optional_item['M01_Optional_Resever_Status'] == 3){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Resever_Status" . $key . "_2"; ?>">キャンセル済</label>
								<input type="radio" name="<?php echo "M01_Optional_Resever_Status" . $key; ?>" id="<?php echo "M01_Optional_Resever_Status" . $key . "_3"; ?>" value="4" <?php if($optional_item['M01_Optional_Resever_Status'] == 4){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Resever_Status" . $key . "_3"; ?>">不催行</label>
							</td>
						</tr>
						<tr>
							<th width="30%" >オプショナルツアー代金</th>
							<td>
								<label name="<?php echo "M01_Optional_Tour_Cost_1" . $key; ?>" id="<?php echo "M01_Optional_Tour_Cost_1" . $key; ?>" style="float: left ;" >
								<?php 
								echo $optional_item['M01_Optional_Tour_Cost_1'];
								?>
								</label>
								<label name="<?php echo "M01_Optional_Tour_Cost_1_Note" . $key; ?>" id="<?php echo "M01_Optional_Tour_Cost_1_Note" . $key; ?>" style="float: right ;" >
								<?php 
								echo $optional_item['M01_Optional_Tour_Cost_1_Note'];
								?>
								</label>
								<input type="hidden" name="<?php echo "M01_Optional_Tour_Cost".$key; ?>" id="<?php echo "M01_Optional_Tour_Cost".$key; ?>" value="<?php echo $optional_item['M01_Optional_Tour_Cost_1']; ?>" />
								<input type="hidden" name="<?php echo "M01_Optional_Tour_Rental_Gold_Flag".$key; ?>" id="<?php echo "M01_Optional_Tour_Rental_Gold_Flag".$key; ?>" value="<?php echo $optional_item['M01_Optional_Tour_Rental_Gold_Flag']; ?>" />
							</td>
						</tr>
						<!-- 2016/06/14 オプショナルキャンセルする場合は、キャンセル料をかかる追加  START -->
						<tr>
							<th width="30%">オプショナルツアーキャンセルチャージ</th>
							<td>
								<input type="text" style="text-align: right;" name="<?php echo "M01_Optional_Cancel_Charge" . $key; ?>" id="<?php echo "M01_Optional_Cancel_Charge" . $key; ?>" value="<?php if (isset($optional_item['M01_Optional_Cancel_Charge'])) { echo $optional_item['M01_Optional_Cancel_Charge']; } else { echo "0"; } ?>" size="15" />円
							</td>
						</tr>
						<!-- 2016/06/14 オプショナルキャンセルする場合は、キャンセル料をかかる追加  END -->
						
						<!--START ゴルドレンタルがあれば表示する. Can phai check flag neu co thi moi hien thi phan nay -->
						<?php 
						// START Check flag code php
						if ($optional_item['M01_Optional_Tour_Rental_Gold_Flag'] == "0") {
						?>
						<tr>
							<th width="30%" >レンタルクラブ</th>
							<td>
								<input type="radio" name="<?php echo "M01_Optional_Tour_Rental" . $key; ?>" id="<?php echo "M01_Optional_Tour_Rental" . $key . "_0"; ?>" value="0" <?php if($optional_item['M01_Optional_Tour_Rental'] == "0"){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Tour_Rental" . $key . "_0"; ?>">右きき</label>
								<input type="radio" name="<?php echo "M01_Optional_Tour_Rental" . $key; ?>" id="<?php echo "M01_Optional_Tour_Rental" . $key . "_1"; ?>" value="1" <?php if($optional_item['M01_Optional_Tour_Rental'] == "1"){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Tour_Rental" . $key . "_1"; ?>">左きき</label>
								<input type="radio" name="<?php echo "M01_Optional_Tour_Rental" . $key; ?>" id="<?php echo "M01_Optional_Tour_Rental" . $key . "_2"; ?>" value="2" <?php if($optional_item['M01_Optional_Tour_Rental'] == "2"){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Tour_Rental" . $key . "_2"; ?>">不要</label>
							</td>
						</tr>
						<?php 
						// END Check flag code php
						} else {
							echo "";
						}
						?>
						<!--END Hien thi lua chon gold rental. Can phai check flag neu co thi moi hien thi phan nay -->
						<tr>
							<th width="30%" >お支払方法</th>
							<td>
								<input type="radio" name="<?php echo "M01_Optional_Payment_Type" . $key; ?>" id="<?php echo "M01_Optional_Payment_Type" . $key . "_0"; ?>" value="0" <?php if($optional_item['M01_Optional_Payment_Type'] == "0"){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Payment_Type" . $key . "_0"; ?>">請求書払い</label>
								<input type="radio" name="<?php echo "M01_Optional_Payment_Type" . $key; ?>" id="<?php echo "M01_Optional_Payment_Type" . $key . "_1"; ?>" value="1" <?php if($optional_item['M01_Optional_Payment_Type'] == "1"){echo "checked";} ?> />
								<label for="<?php echo "M01_Optional_Payment_Type" . $key . "_1"; ?>">クレジットカード払い</label>
							</td>
						</tr>
						</tbody>
					</table>
					
					
					<div id="<?php echo "optional_credit_after" . $key;?>" style="
						<?php 
						//check block; or none;
						if ($optional_item['M01_Optional_Payment_Type'] == "1") {
							echo "block;";
						} else {
							echo "none;";
						}
						?>
					" >
						<table id="form"  width="100%" style="margin-bottom: 0px; margin-top: 0px;" >
							<tbody>
								<tr>
									<th>URL</th>
									<td>
										<input type="text" name="<?php echo "M01_Optional_Credit_URL" . $key; ?>" id="<?php echo "M01_Optional_Credit_URL" . $key; ?>" value="<?php if (isset($optional_item['M01_Optional_Credit_URL'])) { echo htmlentities($optional_item['M01_Optional_Credit_URL'],ENT_QUOTES, "UTF-8"); }?>" size="30" />
									</td>
								</tr>
								<tr>
									<th>文言</th>
									<td>
										<textarea name="<?php echo "M01_Optional_Credit_Words" . $key; ?>" id="<?php echo "M01_Optional_Credit_Words" . $key; ?>" rows="5" cols="120"><?php if (isset($optional_item['M01_Optional_Credit_Words'])) { echo htmlentities($optional_item['M01_Optional_Credit_Words'],ENT_QUOTES, "UTF-8"); }?></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
						
						<!-- START Neu lua chon payment type = 0 thi se show phan nay  -->
					<div id="<?php echo "optional_payment_after" . $key; ?>" style="
						<?php 
						//check block; or none;
						if ($optional_item['M01_Optional_Payment_Type'] == "0") {
							echo "block;";
						} else {
							echo "none;";
						}
						?>
					" >	
						<table id="form"  width="100%" style="margin-bottom: 0px; margin-top: 0px;" >
							<tbody>
								<tr>
									<th>請求書の送付先</th>
									<td>
										<input type="radio" name="<?php echo "R01_Optional_Invoice_Send" . $key;?>" id="<?php echo "R01_Optional_Invoice_Send" . $key . "_0";?>" value="0"  <?php if($optional_item['R01_Optional_Invoice_Send'] == "0"){echo "checked";} ?> />
										<label for="<?php echo "R01_Optional_Invoice_Send" . $key . "_0";?>">ご自宅</label>
										<input type="radio" name="<?php echo "R01_Optional_Invoice_Send" . $key;?>" id="<?php echo "R01_Optional_Invoice_Send" . $key . "_1";?>" value="1"  <?php if($optional_item['R01_Optional_Invoice_Send'] == "1"){echo "checked";} ?> />
										<label for="<?php echo "R01_Optional_Invoice_Send" . $key . "_1";?>">勤務先</label>
										<input type="radio" name="<?php echo "R01_Optional_Invoice_Send" . $key;?>" id="<?php echo "R01_Optional_Invoice_Send" . $key . "_2";?>" value="2"  <?php if($optional_item['R01_Optional_Invoice_Send'] == "2"){echo "checked";} ?> />
										<label for="<?php echo "R01_Optional_Invoice_Send" . $key . "_2";?>">その他</label>
									</td>
								</tr>
								<tr>
									<th>ご請求書の宛名</th>
									<td>
										<input type="text" name="<?php echo "R01_Optional_Invoice_Addr_Name" . $key; ?>" id="<?php echo "R01_Optional_Invoice_Addr_Name" . $key; ?>" value="<?php if (isset($optional_item['R01_Optional_Invoice_Addr_Name'])) { echo htmlentities($optional_item['R01_Optional_Invoice_Addr_Name'],ENT_QUOTES, "UTF-8"); }?>" size="30" />
									</td>
								</tr>
							</tbody>
						</table>
					</div>
						
					<div id="<?php echo "optional_invoice_send_after" . $key; ?>" style="
						<?php 
						//check block; or none;
						if ($optional_item['R01_Optional_Invoice_Send'] == "2") {
							echo "block;";
						} else {
							echo "none;";
						}
						?>
					" >	
						<table id="form" width="100%" style="margin-top: 0px; margin-bottom: 0px;">
							<tbody>
								<tr>
									<th colspan="2"><div align="center">送付先について</div></th>
								</tr>
								<tr>
									<th>お名前</th>
									<td>
										<font color="#000000">姓 </font>
										<input type="text" name="<?php echo "R01_Optional_Invoice_Sei" . $key; ?>" id="<?php echo "R01_Optional_Invoice_Sei" . $key; ?>" value="<?php echo htmlentities($optional_item['R01_Optional_Invoice_Sei'],ENT_QUOTES, "UTF-8"); ?>" size="9" />
										<font color="#000000">名</font>
										<input type="text" name="<?php echo "R01_Optional_Invoice_Mei" . $key; ?>" id="<?php echo "R01_Optional_Invoice_Mei" . $key; ?>" value="<?php echo htmlentities($optional_item['R01_Optional_Invoice_Mei'],ENT_QUOTES, "UTF-8"); ?>" size="9" />
									</td>
								</tr>
								<tr>
									<th>郵便番号</th>
									<td>
										<input type="text" name="<?php echo "R01_Optional_Invoice_Postal_1" . $key; ?>" id="<?php echo "R01_Optional_Invoice_Postal_1" . $key; ?>" value="<?php echo $optional_item['R01_Optional_Invoice_Postal_1']; ?>" size="3" maxlength="3" /> - 
										<input type="text" name="<?php echo "R01_Optional_Invoice_Postal_2" . $key; ?>" id="<?php echo "R01_Optional_Invoice_Postal_2" . $key; ?>" value="<?php echo $optional_item['R01_Optional_Invoice_Postal_2']; ?>" size="4" maxlength="4"/> &nbsp;&nbsp;
										<input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('<?php echo "R01_Optional_Invoice_Postal_1" . $key; ?>','<?php echo "R01_Optional_Invoice_Postal_2" . $key; ?>','<?php echo "R01_Optional_Invoice_Prefectures" . $key; ?>','<?php echo "R01_Optional_Invoice_City" . $key; ?>');"/>
									</td>
								</tr>
								<tr>
									<th>都道府県</th>
									<td>
										<select name="<?php echo "R01_Optional_Invoice_Prefectures" . $key; ?>" id="<?php echo "R01_Optional_Invoice_Prefectures" . $key; ?>">	
											<option value="" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == "" ){echo "selected";}?> >選択してください</option>
											<option value="1" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 1 ){echo "selected";}?> >北海道</option>
											<option value="2" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 2 ){echo "selected";}?> >青森県</option>
											<option value="3" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 3 ){echo "selected";}?> >岩手県</option>
											<option value="4" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 4 ){echo "selected";}?> >宮城県</option>
											<option value="5" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 5 ){echo "selected";}?> >秋田県</option>
											<option value="6" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 6 ){echo "selected";}?> >山形県</option>
											<option value="7" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 7 ){echo "selected";}?> >福島県</option>
											<option value="8" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 8 ){echo "selected";}?> >茨城県</option>
											<option value="9" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 9 ){echo "selected";}?> >栃木県</option>
											<option value="10" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 10 ){echo "selected";}?> >群馬県</option>
											<option value="11" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 11 ){echo "selected";}?> >埼玉県</option>
											<option value="12" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 12 ){echo "selected";}?> >千葉県</option>
											<option value="13" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 13 ){echo "selected";}?> >東京都</option>
											<option value="14" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 14 ){echo "selected";}?> >神奈川県</option>
											<option value="15" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 15 ){echo "selected";}?> >新潟県</option>
											<option value="16" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 16 ){echo "selected";}?> >富山県</option>
											<option value="17" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 17 ){echo "selected";}?> >石川県</option>
											<option value="18" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 18 ){echo "selected";}?> >福井県</option>
											<option value="19" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 19 ){echo "selected";}?> >山梨県</option>
											<option value="20" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 20 ){echo "selected";}?> >長野県</option>
											<option value="21" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 21 ){echo "selected";}?> >岐阜県</option>
											<option value="22" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 22 ){echo "selected";}?> >静岡県</option>
											<option value="23" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 23 ){echo "selected";}?> >愛知県</option>
											<option value="24" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 24 ){echo "selected";}?> >三重県</option>
											<option value="25" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 25 ){echo "selected";}?> >滋賀県</option>
											<option value="26" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 26 ){echo "selected";}?> >京都府</option>
											<option value="27" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 27 ){echo "selected";}?> >大阪府</option>
											<option value="28" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 28 ){echo "selected";}?> >兵庫県</option>
											<option value="29" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 29 ){echo "selected";}?> >奈良県</option>
											<option value="30" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 30 ){echo "selected";}?> >和歌山県</option>
											<option value="31" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 31 ){echo "selected";}?> >鳥取県</option>
											<option value="32" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 32 ){echo "selected";}?> >島根県</option>
											<option value="33" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 33 ){echo "selected";}?> >岡山県</option>
											<option value="34" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 34 ){echo "selected";}?> >広島県</option>
											<option value="35" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 35 ){echo "selected";}?> >山口県</option>
											<option value="36" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 36 ){echo "selected";}?> >徳島県</option>
											<option value="37" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 37 ){echo "selected";}?> >香川県</option>
											<option value="38" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 38 ){echo "selected";}?> >愛媛県</option>
											<option value="39" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 39 ){echo "selected";}?> >高知県</option>
											<option value="40" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 40 ){echo "selected";}?> >福岡県</option>
											<option value="41" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 41 ){echo "selected";}?> >佐賀県</option>
											<option value="42" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 42 ){echo "selected";}?> >長崎県</option>
											<option value="43" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 43 ){echo "selected";}?> >熊本県</option>
											<option value="44" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 44 ){echo "selected";}?> >大分県</option>
											<option value="45" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 45 ){echo "selected";}?> >宮崎県</option>
											<option value="46" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 46 ){echo "selected";}?> >鹿児島県</option>
											<option value="47" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 47 ){echo "selected";}?> >沖縄県</option>
											<option value="99" <?php if($optional_item['R01_Optional_Invoice_Prefectures'] == 99 ){echo "selected";}?> >海外</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>市区郡</th>
									<td>
										<input type="text" name="<?php echo "R01_Optional_Invoice_City" . $key; ?>" id="<?php echo "R01_Optional_Invoice_City" . $key; ?>" value="<?php echo htmlentities($optional_item['R01_Optional_Invoice_City'],ENT_QUOTES, "UTF-8"); ?>" size="30" />
									</td>
								</tr>
								<tr>
									<th>町村～番地</th>
									<td>
										<input type="text" name="<?php echo "R01_Optional_Invoice_Towns_Villages" . $key; ?>" id="<?php echo "R01_Optional_Invoice_Towns_Villages" . $key; ?>" value="<?php echo htmlentities($optional_item['R01_Optional_Invoice_Towns_Villages'],ENT_QUOTES, "UTF-8"); ?>" size="30" />
									</td>
								</tr>
								<tr>
									<th>ビル・マンション名</th>
									<td>
										<input type="text" name="<?php echo "R01_Optional_Invoice_Building_Name" . $key;?>" id="<?php echo "R01_Optional_Invoice_Building_Name" . $key; ?>" value="<?php echo htmlentities($optional_item['R01_Optional_Invoice_Building_Name'],ENT_QUOTES, "UTF-8"); ?>" size="30" />
									</td>
								</tr>
								<tr>
									<th>電話番号</th>
									<td>
										<input type="text" name="<?php echo "R01_Optional_Invoice_Phone1" . $key;?>" id="<?php echo "R01_Optional_Invoice_Phone1" . $key;?>" value="<?php echo $optional_item['R01_Optional_Invoice_Phone1']; ?>" size="5" maxlength="5" /> - 
										<input type="text" name="<?php echo "R01_Optional_Invoice_Phone2" . $key;?>" id="<?php echo "R01_Optional_Invoice_Phone2" . $key;?>" value="<?php echo $optional_item['R01_Optional_Invoice_Phone2']; ?>" size="4" maxlength="4" /> - 
										<input type="text" name="<?php echo "R01_Optional_Invoice_Phone3" . $key;?>" id="<?php echo "R01_Optional_Invoice_Phone3" . $key;?>" value="<?php echo $optional_item['R01_Optional_Invoice_Phone3']; ?>" size="4" maxlength="4" />
									</td>
								</tr>
							</tbody>
							</table>
						</div>
						<!-- END Neu lua chon payment type = 0 thi se show phan nay  -->
				<?php 
						echo "</div>";
						if ($count%$optional_length == 0) {
							break;
						}
						$count++;
					// Vong for END
					}
				} // Ket thuc hien thi optional voi dieu kien ton tai $optional array
				?>
				
				<?php 
				if ($optional != "") {
				?>
				<table id="form" width="100%" style="margin-bottom: 10px; margin-top: 25px;">
				<tbody>
					<tr>
						<th width="30%">代金合計</th>
						<td>
							<label name="M01_Optional_Tour_Cost_Total" id="M01_Optional_Tour_Cost_Total" style="float: left ;" >0</label>
							<input type="hidden" name="R01_Optional_Cost_Total" id="R01_Optional_Cost_Total" value="0"/>
						</td>
					</tr>
				</tbody>
				</table>
				
				<?php
				} else {
					echo "";
				}
				?>
				<!-- END div optional-item -->
</div>
<!-- END OPTIONAL TOUR SOURCE -->




<!-- START TAB PAYMENT SOURCE -->
<div id="payment" style="display: none;">
				<!-- START 旅行代金  -->
				<table id="form" width="100%" style="margin-bottom: 0px;">
				<tbody>
					<tr>
						<th colspan="2"><div align="center">旅行代金入金</div></th>
					</tr>
				</tbody>
				</table>
				
				
				<table id="form" width="100%" style="margin-bottom: 0px; margin-top: 10px;">
				<tbody>
					<tr>
						<th width="30%" >お申込み金</th>
						<td>
							<input type="text" name="R01_Register_Payment" id="R01_Register_Payment" value="<?php echo $R01_Register_Payment; ?>" size="8" style="text-align: right;" />円
						</td>
					</tr>
					<tr>
						<th width="30%" >お申込み金入金期限</th>
						<td>
							<input type="text" name="R01_Register_Payment_Deadline" id="R01_Register_Payment_Deadline" value="<?php echo $R01_Register_Payment_Deadline; ?>" size="10" />
						</td>
					</tr>
				</tbody>
				</table>
				
					
				<table id="form" width="100%" style="margin-bottom: 0px; margin-top: 10px;">
				<tbody>
					<tr>
						<th width="30%" >旅行代金合計</th>
						<td>
							<label name="R01_total_fee_temp" id="R01_total_fee_temp" style="float: right;">
								<?php
								if(isset($R01_total_fee)) {
									echo $R01_total_fee;
								} ?>
							</label>
							<input type="hidden" name="R01_total_fee_temp_2" id="R01_total_fee_temp_2" value="<?php echo $R01_total_fee; ?>" />
						</td>
					</tr>
				</tbody>
				</table>
				
				<table id="form" width="100%" style="margin-bottom: 0px; margin-top: 0px;">
				<tbody>
					<tr>
						<th style="width: 15%"><nobr>入金日1</nobr></th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Date_1" id="R01_Payment_Date_1" value="<?php if (isset($R01_Payment_Date_1)){ echo $R01_Payment_Date_1; } ?>" size="6"/>
						</td>
						<th style="width: 15%">入金種別1</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Type_1" id="R01_Payment_Type_1" value="<?php if (isset($R01_Payment_Type_1)){ echo htmlentities($R01_Payment_Type_1,ENT_QUOTES, "UTF-8"); } ?>" size="8" style="text-align: left;" />
						</td>
						<th style="width: 15%">金額1</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Amount_1" id="R01_Payment_Amount_1" value="<?php if (isset($R01_Payment_Amount_1)){ echo $R01_Payment_Amount_1; } ?>" size="8" style="text-align: right;" onchange="changePaymentTotal()" />
						</td>
						<th style="width: 15%">備考1</th>
						<td style="width: 12%">
							<textarea name="R01_Payment_Note_1" rows="4" cols="20"><?php if (isset($R01_Payment_Note_1)) { echo htmlentities($R01_Payment_Note_1,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
				</tbody>
				</table>
				<table id="form" width="100%" style="margin-bottom: 0px; margin-top: 0px;">
				<tbody>	
					<tr>
						<th style="width: 15%"><nobr>入金日2</nobr></th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Date_2" id="R01_Payment_Date_2" value="<?php if (isset($R01_Payment_Date_2)){ echo $R01_Payment_Date_2; } ?>" size="6"/>
						</td>
						<th style="width: 15%">入金種別2</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Type_2" id="R01_Payment_Type_2" value="<?php if (isset($R01_Payment_Type_2)){ echo htmlentities($R01_Payment_Type_2,ENT_QUOTES, "UTF-8"); } ?>" size="8" style="text-align: left;"  />
						</td>
						<th style="width: 15%">金額2</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Amount_2" id="R01_Payment_Amount_2" value="<?php if (isset($R01_Payment_Amount_2)){ echo $R01_Payment_Amount_2; } ?>" size="8" style="text-align: right;" onchange="changePaymentTotal()" />
						</td>
						<th style="width: 15%">備考2</th>
						<td style="width: 12%">
							<textarea name="R01_Payment_Note_2" rows="4" cols="20"><?php if (isset($R01_Payment_Note_2)) { echo htmlentities($R01_Payment_Note_2,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
				</tbody>
				</table>
				<table id="form" width="100%" style="margin-bottom: 0px; margin-top: 0px;">
				<tbody>	
					<tr>
						<th style="width: 15%"><nobr>入金日3</nobr></th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Date_3" id="R01_Payment_Date_3" value="<?php if (isset($R01_Payment_Date_3)){ echo $R01_Payment_Date_3; } ?>" size="6"/>
						</td>
						<th style="width: 15%">入金種別3</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Type_3" id="R01_Payment_Type_3" value="<?php if (isset($R01_Payment_Type_3)){ echo htmlentities($R01_Payment_Type_3,ENT_QUOTES, "UTF-8"); } ?>" size="8" style="text-align: left;" />
						</td>
						<th style="width: 15%">金額3</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Amount_3" id="R01_Payment_Amount_3" value="<?php if (isset($R01_Payment_Amount_3)){ echo $R01_Payment_Amount_3; } ?>" size="8" style="text-align: right;" onchange="changePaymentTotal()"/>
						</td>
						<th style="width: 15%">備考3</th>
						<td style="width: 12%">
							<textarea name="R01_Payment_Note_3" rows="4" cols="20"><?php if (isset($R01_Payment_Note_3)) { echo htmlentities($R01_Payment_Note_3,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
				</tbody>
				</table>
				<table id="form" width="100%" style="margin-bottom: 0px; margin-top: 0px;">
				<tbody>	
					<tr>
						<th style="width: 15%"><nobr>入金日4</nobr></th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Date_4" id="R01_Payment_Date_4" value="<?php if (isset($R01_Payment_Date_4)){ echo $R01_Payment_Date_4; } ?>" size="6"/>
						</td>
						<th style="width: 15%">入金種別4</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Type_4" id="R01_Payment_Type_4" value="<?php if (isset($R01_Payment_Type_4)){ echo htmlentities($R01_Payment_Type_4,ENT_QUOTES, "UTF-8"); } ?>" size="8" style="text-align: left;" />
						</td>
						<th style="width: 15%">金額4</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Amount_4" id="R01_Payment_Amount_4" value="<?php if (isset($R01_Payment_Amount_4)){ echo $R01_Payment_Amount_4; } ?>" size="8" style="text-align: right;" onchange="changePaymentTotal()"/>
						</td>
						<th style="width: 15%">備考4</th>
						<td style="width: 12%">
							<textarea name="R01_Payment_Note_4" rows="4" cols="20"><?php if (isset($R01_Payment_Note_4)) { echo htmlentities($R01_Payment_Note_4,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
				</tbody>
				</table>
				<table id="form" width="100%" style="margin-bottom: 0px; margin-top: 0px;">
				<tbody>	
					<tr>
						<th style="width: 15%"><nobr>入金日5</nobr></th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Date_5" id="R01_Payment_Date_5" value="<?php if (isset($R01_Payment_Date_5)){ echo $R01_Payment_Date_5; } ?>" size="6"/>
						</td>
						<th style="width: 15%">入金種別5</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Type_5" id="R01_Payment_Type_5" value="<?php if (isset($R01_Payment_Type_5)){ echo htmlentities($R01_Payment_Type_5,ENT_QUOTES, "UTF-8"); } ?>" size="8" style="text-align: left;" />
						</td>
						<th style="width: 15%">金額5</th>
						<td style="width: 12%">
							<input type="text" name="R01_Payment_Amount_5" id="R01_Payment_Amount_5" value="<?php if (isset($R01_Payment_Amount_5)){ echo $R01_Payment_Amount_5; } ?>" size="8" style="text-align: right;" onchange="changePaymentTotal()"/>
						</td>
						<th style="width: 15%">備考5</th>
						<td style="width: 12%">
							<textarea name="R01_Payment_Note_5" rows="4" cols="20"><?php if (isset($R01_Payment_Note_5)) { echo htmlentities($R01_Payment_Note_5,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
				</tbody>
				</table>
				<table id="form" width="100%" style="margin-top: 0px;">
				<tbody>
					<tr>
						<th width="70%" style="text-align: right;" >入金合計</th>
						<td width="30%">
							<label name="R01_payment_total" id="R01_payment_total" style="float: right;">
							</label>
						</td>
					</tr>
					<tr>
						<th width="70%" style="text-align: right;" >残高</th>
						<td width="30%">
							<label name="R01_payment_balance" id="R01_payment_balance" style="float: right;">
							</label>
						</td>
					</tr>
				</tbody>
				</table>
				<!-- END 旅行代金  -->
				
				
				
</div>
			
			<script>	
			function changePaymentTotal() {
				
				var R01_total_fee_str = $("#R01_total_fee_temp_2").val();
				var R01_total_fee = parseInt(R01_total_fee_str);
				
				var R01_Payment_Amount_1_str = $("#R01_Payment_Amount_1").val();
				if (R01_Payment_Amount_1_str == "") {
					R01_Payment_Amount_1_str = "0";
				}
				var R01_Payment_Amount_1 = parseInt(R01_Payment_Amount_1_str);
				
				var R01_Payment_Amount_2_str = $("#R01_Payment_Amount_2").val();
				if (R01_Payment_Amount_2_str == "") {
					R01_Payment_Amount_2_str = "0";
				}
				var R01_Payment_Amount_2 = parseInt(R01_Payment_Amount_2_str);
				
				var R01_Payment_Amount_3_str = $("#R01_Payment_Amount_3").val();
				if (R01_Payment_Amount_3_str == "") {
					R01_Payment_Amount_3_str = "0";
				}
				var R01_Payment_Amount_3 = parseInt(R01_Payment_Amount_3_str);

				var R01_Payment_Amount_4_str = $("#R01_Payment_Amount_4").val();
				if (R01_Payment_Amount_4_str == "") {
					R01_Payment_Amount_4_str = "0";
				}
				var R01_Payment_Amount_4 = parseInt(R01_Payment_Amount_4_str);

				var R01_Payment_Amount_5_str = $("#R01_Payment_Amount_5").val();
				if (R01_Payment_Amount_5_str == "") {
					R01_Payment_Amount_5_str = "0";
				}
				var R01_Payment_Amount_5 = parseInt(R01_Payment_Amount_5_str);

				var R01_payment_total = R01_Payment_Amount_1 + R01_Payment_Amount_2 + R01_Payment_Amount_3 + R01_Payment_Amount_4 + R01_Payment_Amount_5;
				$("#R01_payment_total").text(formatMoney(R01_payment_total)) ;
				var R01_payment_balance = R01_total_fee - R01_payment_total;
				$("#R01_payment_balance").text(formatMoney(R01_payment_balance));
			}

			</script>
<!-- END TAB PAYMENT SOURCE -->



<!-- START TAB TRAVEL COST SOURCE -->
<div id="travelcost" style="display: none;">
				<table id="form" width="100%">
				<tbody>
					<tr>
						<th colspan="2"><div align="center">旅行代金について</div></th>
					</tr>
					<tr>
						<th width="35%">ご旅行代金 </th>
						<td>
							<input type="hidden" name="R01_Dep_Airport_Temp" id="R01_Dep_Airport_Temp" value="<?php echo $R01_Dep_Airport; ?>"  />
							<input type="radio" name="R01_Choice_Room_Temp" id="room_0" value="0" <?php if($R01_Choice_Room == "0"){echo "checked";}?> onchange="changeTotalTravelCost()" /><label for="room_0">1名1室</label>
							<input type="radio" name="R01_Choice_Room_Temp" id="room_1" value="1" <?php if($R01_Choice_Room == "1"){echo "checked";}?> onchange="changeTotalTravelCost()" /><label for="room_1">2名1室</label>
							<br />
							<input type="text" name="R01_travel_fee" id="R01_travel_fee" size="10" style="text-align: right;" value="<?php if(isset($R01_travel_fee)) { echo $R01_travel_fee; } ?>" onchange="changeTotalTravelCost()"/>円
						</td>
					</tr>
					<tr>
						<th>燃油サーチャージ</th>
						<td>
							<input type="text" name="R01_fuel_surcharge" id="R01_fuel_surcharge" size="10" style="text-align: right;" value="<?php if(isset($R01_fuel_surcharge)) { echo $R01_fuel_surcharge; }?>" onchange="changeTotalTravelCost()"/>円
						</td>
					</tr>
					<tr>
						<th>空港施設使用料<br>空港旅客保安サービス料</th>
						<td>
							<input type="text" name="R01_airport_tax" id="R01_airport_tax" size="10" style="text-align: right;" value="<?php if(isset($R01_airport_tax)) { echo $R01_airport_tax; } ?>" onchange="changeTotalTravelCost()" />円
						</td>
					</tr>
					<tr>
						<th>現地空港税・出国税</th>
						<td>
							<input type="text" name="R01_arr_airport_tax" id="R01_arr_airport_tax" size="10" style="text-align: right;" value="<?php if(isset($R01_arr_airport_tax)) { echo $R01_arr_airport_tax; } ?>" onchange="changeTotalTravelCost()" />円
						</td>
					</tr>
					<tr>
						<th>WPC 2016 参加登録費</th>
						<td>
							<table>
								<tr>
									<th>USD</th>
									<td>
										<input type="text" name="R01_wpc2016_fee_usd" id="R01_wpc2016_fee_usd" size="10" style="text-align: right;" value="<?php if(isset($R01_wpc2016_fee_usd)) { echo $R01_wpc2016_fee_usd; } ?>" onchange="changeTotalTravelCost()" />
									</td>
								</tr>
								<tr>
									<th>レート</th>
									<td>
										<input type="text" name="R01_wpc1026_rate" id="R01_wpc1026_rate" size="10" style="text-align: right;" value="<?php if(isset($R01_wpc1026_rate)) { echo $R01_wpc1026_rate; } ?>" onchange="changeTotalTravelCost()" />
									</td>
								</tr>
								<tr>
									<th>日本円換算</th>
									<td>
										<input type="text" name="R01_wpc2016_fee_jpy" id="R01_wpc2016_fee_jpy" size="10" style="text-align: right;" value="<?php if(isset($R01_wpc2016_fee_jpy)) { echo $R01_wpc2016_fee_jpy; } ?>" onchange="changeTotalTravelCost()" />円
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th>キャンセルチャージ</th>
						<td>
							<input type="text" name="R01_Cancel_Charge" id="R01_Cancel_Charge" size="10" style="text-align: right;" value="<?php if(isset($R01_Cancel_Charge)) { echo $R01_Cancel_Charge; } ?>" onchange="changeTotalTravelCost()" />円
						</td>
					</tr>
					<tr>
						<th>小計</th>
						<td>
							<input type="text" name="R01_total_fee" id="R01_total_fee" size="10" style="text-align: right;" value="<?php if(isset($R01_total_fee)) { echo $R01_total_fee; } ?>" onchange="changeTotalTravelCost()" readonly="readonly" />円
						</td>
					</tr>
				</tbody>
				</table>
				
				<table id="form" width="100%">
				<tbody>
					<tr>
						<th>オプショナルツアー代金合計</th>
						<td>
							<label name="M01_Optional_Tour_Cost_Total_Temp1" id="M01_Optional_Tour_Cost_Total_Temp1" style="float: left ;" >0</label>
						</td>
					</tr>
				</tbody>
				</table>
				
				<table id="form" width="100%">
				<tbody>
					<tr>
						<th>合計</th>
						<td>
							<label name="Cost_Total" id="Cost_Total" style="float: left ;" >0</label>
						</td>
					</tr>
				</tbody>
				</table>
</div>
			
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
			
			function changeTotalTravelCost() {
				var R01_Dep_Airport_Temp = document.getElementById("R01_Dep_Airport_Temp").value;
				var r01_choice_room_0 = document.getElementById("room_0");
				var r01_choice_room_1 = document.getElementById("room_1");
				var R01_travel_fee = document.getElementById("R01_travel_fee").value;
				var R01_fuel_surcharge = document.getElementById("R01_fuel_surcharge").value;
				var R01_airport_tax = document.getElementById("R01_airport_tax").value;
				var R01_arr_airport_tax = document.getElementById("R01_arr_airport_tax").value;
				var R01_wpc2016_fee_usd = document.getElementById("R01_wpc2016_fee_usd").value;
				var R01_wpc1026_rate = document.getElementById("R01_wpc1026_rate").value;
				var R01_wpc2016_fee_jpy = document.getElementById("R01_wpc2016_fee_jpy").value;

				var R01_Cancel_Charge = document.getElementById("R01_Cancel_Charge").value;
				
				var R01_total_fee = document.getElementById("R01_total_fee").value;

				if ((R01_travel_fee == "") || (R01_fuel_surcharge == "") || (R01_airport_tax == "") || (R01_wpc2016_fee_usd == "") || (R01_wpc1026_rate == "") || (R01_Cancel_Charge == "")){
					alert("入力してください。");
				} else {
					R01_wpc2016_fee_jpy = toFixed((parseInt(R01_wpc2016_fee_usd) * parseFloat(R01_wpc1026_rate)), -1);
					document.getElementById("R01_wpc2016_fee_jpy").value = R01_wpc2016_fee_jpy;
					R01_total_fee = parseInt(R01_travel_fee) + parseInt(R01_fuel_surcharge) + parseInt(R01_airport_tax) + parseInt(R01_arr_airport_tax) + parseInt(R01_wpc2016_fee_jpy) + parseInt(R01_Cancel_Charge);
					document.getElementById("R01_total_fee").value = R01_total_fee;

					var R01_Optional_Cost_Total = $("#R01_Optional_Cost_Total").val();
					var Cost_Total = parseInt(R01_Optional_Cost_Total) + parseInt(R01_total_fee);
					$("#Cost_Total").text(formatMoney(Cost_Total));
				}
			}
			</script>
<!-- END TAB TRAVEL COST SOURCE -->


		
<!-- START TAB REGISTRATION SOURCE -->
				<div id="reg">
						<table id="form" width="100%">
				<tr>
					<th style="text-align: left;width: 30%;">1. 仕事の役割について</th>
					<td>
					<div id ="R01_Que1" >
					<p style = "color:red" id = "resgi1"></p>

					<select name="R01_Que1" id = "R01_Que1">
					<option value="">　   </option>
					<option value="1" <?php if($R01_Que1 == "1"){echo "selected";} ?> >　Academic / Researcher</option>
					<option value="2" <?php if($R01_Que1 == "2"){echo "selected";} ?> >　Advisor / Consultant</option>
					<option value="3" <?php if($R01_Que1 == "3"){echo "selected";} ?> >　Business Executive</option>
					<option value="4" <?php if($R01_Que1 == "4"){echo "selected";} ?> >　Developer / Engineer</option>
					<option value="5" <?php if($R01_Que1 == "5"){echo "selected";} ?> >　Entrepreneur (Founder / Co-Founder)</option>
					<option value="6" <?php if($R01_Que1 == "6"){echo "selected";} ?> >　IT Executive</option>
					<option value="7" <?php if($R01_Que1 == "7"){echo "selected";} ?> >　IT Professional or Technical Manager</option>
					<option value="8" <?php if($R01_Que1 == "8"){echo "selected";} ?> >　Press / Industry Analyst</option>
					<option value="9" <?php if($R01_Que1 == "9"){echo "selected";} ?> >　Sales / Marketing</option>
					<option value="10" <?php if($R01_Que1 == "10"){echo "selected";} ?> >　Student</option>
					<option value="11" <?php if($R01_Que1 == "11"){echo "selected";} ?> >　Solution or Systems Architect</option>
					<option value="12" <?php if($R01_Que1 == "12"){echo "selected";} ?> >　System Administrator</option>
					<option value="13" <?php if($R01_Que1 == "13"){echo "selected";} ?> >　Venture Capitalist </option>
					</select>
					<div>
					</td>
				</tr>

				<tr>
					<th style="text-align: left;">2.業種</th>
					<td>
						<div id ="R01_Que2" >
						  <p style = "color:red" id = "resgi2"></p>
						<select name="R01_Que2" id = "R01_Que2">
						<option value="">　   </option>
						<option value="1" <?php if($R01_Que2 == "1"){echo "selected";} ?> >　Agriculture & Mining </option>
						<option value="2" <?php if($R01_Que2 == "2"){echo "selected";} ?> >　Computers & Electronics</option>
						<option value="3" <?php if($R01_Que2 == "3"){echo "selected";} ?> >　Consumer Goods </option>
						<option value="4" <?php if($R01_Que2 == "4"){echo "selected";} ?> >　Education </option>
						<option value="5" <?php if($R01_Que2 == "5"){echo "selected";} ?> >　Energy & Utilities </option>
						<option value="6" <?php if($R01_Que2 == "6"){echo "selected";} ?> >　Financial Services </option>
						<option value="7" <?php if($R01_Que2 == "7"){echo "selected";} ?> >　Gaming </option>
						<option value="8" <?php if($R01_Que2 == "8"){echo "selected";} ?> >　Government </option>
						<option value="9" <?php if($R01_Que2 == "9"){echo "selected";} ?> >　Healthcare </option>
						<option value="10" <?php if($R01_Que2 == "10"){echo "selected";} ?> >　Life Sciences </option>
						<option value="11" <?php if($R01_Que2 == "11"){echo "selected";} ?> >　Manufacturing</option>
						<option value="12" <?php if($R01_Que2 == "12"){echo "selected";} ?> >　Media & Entertainment </option>
						<option value="13" <?php if($R01_Que2 == "13"){echo "selected";} ?> >　Non-Profit Organization</option>
						<option value="14" <?php if($R01_Que2 == "14"){echo "selected";} ?> >　Professional Services </option>
						<option value="15" <?php if($R01_Que2 == "15"){echo "selected";} ?> >　Real Estate & Construction </option>
						<option value="16" <?php if($R01_Que2 == "16"){echo "selected";} ?> >　Retail </option>
						<option value="17" <?php if($R01_Que2 == "17"){echo "selected";} ?> >　Software & Internet </option>
						<option value="18" <?php if($R01_Que2 == "18"){echo "selected";} ?> >　Telecommunications </option>
						<option value="19" <?php if($R01_Que2 == "19"){echo "selected";} ?> >　Transportation and Logistics</option>
						<option value="20" <?php if($R01_Que2 == "20"){echo "selected";} ?> >　Travel and Hospitality </option>
						<option value="21" <?php if($R01_Que2 == "21"){echo "selected";} ?> >　Wholesale & Distribution </option>
						<option value="22" <?php if($R01_Que2 == "22"){echo "selected";} ?> >　Other </option>
						</select>
						</div>
					</td>
				</tr>
				<tr>
					<th style="text-align: left;">3.会社の種類</th>
					<td>
						<div id ="R01_Que3" >
						  <p style = "color:red" id = "resgi3"></p>
						<select name="R01_Que3" id = "R01_Que3">
						<option value="">　   </option>
						<option value="1" <?php if($R01_Que3 == "1"){echo "selected";} ?> >　Education</option>
						<option value="2" <?php if($R01_Que3 == "2"){echo "selected";} ?> >　Enterprise</option>
						<option value="3" <?php if($R01_Que3 == "3"){echo "selected";} ?> >　Government - State & Local</option>
						<option value="4" <?php if($R01_Que3 == "4"){echo "selected";} ?> >　Government - Federal</option>
						<option value="5" <?php if($R01_Que3 == "5"){echo "selected";} ?> >　Non-Profit</option>
						<option value="6" <?php if($R01_Que3 == "6"){echo "selected";} ?> >　Self Employed</option>
						<option value="7" <?php if($R01_Que3 == "7"){echo "selected";} ?> >　Small-Medium Business</option>
						<option value="8" <?php if($R01_Que3 == "8"){echo "selected";} ?> >　Start-Up</option>
						<option value="9" <?php if($R01_Que3 == "9"){echo "selected";} ?> >　Not applicable</option>
						</select>
						</div>
					</td>
				</tr>



				<tr>
					<th style="text-align: left;">4.会社の規模</th>
					<td>
						<div id ="R01_Que4" >
						  <p style = "color:red" id = "resgi4"></p>
						<select name="R01_Que4" id = "R01_Que4">
						<option value="">　   </option>
						<option value="1" <?php if($R01_Que4 == "1"){echo "selected";} ?> >　従業員数 1-19名</option>
						<option value="2" <?php if($R01_Que4 == "2"){echo "selected";} ?> >　従業員数 20-99名</option>
						<option value="3" <?php if($R01_Que4 == "3"){echo "selected";} ?> >　従業員数 100-499名</option>
						<option value="4" <?php if($R01_Que4 == "4"){echo "selected";} ?> >　従業員数 500-999名</option>
						<option value="5" <?php if($R01_Que4 == "5"){echo "selected";} ?> >　従業員数 1,000-9,999名</option>
						<option value="6" <?php if($R01_Que4 == "6"){echo "selected";} ?> >　従業員数 10,000名以上</option>
						</select>
						</div>
					</td>
				</tr>


				<tr>
					<th style="text-align: left;">5.AWSの利用について</th>
					<td>
						<div id ="R01_Que6" >
						  <p style = "color:red" id = "resgi6"></p>
						<select name="R01_Que6" id = "R01_Que6">
						<option value="">　   </option>
						<option value="1" <?php if($R01_Que6 == "1"){echo "selected";} ?> >　AWSは利用していません</option>
						<option value="2" <?php if($R01_Que6 == "2"){echo "selected";} ?> >　評価/実験にAWSを利用しています</option>
						<option value="3" <?php if($R01_Que6 == "3"){echo "selected";} ?> >　開発/テストにAWSを利用しています</option>
						<option value="4" <?php if($R01_Que6 == "4"){echo "selected";} ?> >　AWSの単一の製品・サービスを利用しています</option>
						<option value="5" <?php if($R01_Que6 == "5"){echo "selected";} ?> >　複数のAWS製品・サービスを利用しています</option>
						</select>
						</div>
					</td>
				</tr>



				<tr>
					<th style="text-align: left;">6. re:Inventの参加経験(複数回答可)</th>
					<td>
					<div id = "R01_Que7">
					  <p style = "color:red" id = "resgi7"></p>
					<input type="checkbox" name="R01_Que7[]" id="tmp_701" value="1" <?php if($R01_Que7[0] == "1"){echo "checked";} ?> /><label for="tmp_701">2012</label><br>
					<input type="checkbox" name="R01_Que7[]" id="tmp_702" value="2" <?php if($R01_Que7[1] == "2"){echo "checked";} ?> /><label for="tmp_702">2013</label><br>
					<input type="checkbox" name="R01_Que7[]" id="tmp_703" value="3" <?php if($R01_Que7[2] == "3"){echo "checked";} ?> /><label for="tmp_703">2014</label><br>
					<input type="checkbox" name="R01_Que7[]" id="tmp_704" value="4" <?php if($R01_Que7[3] == "4"){echo "checked";} ?> /><label for="tmp_704">2015</label><br>
					<input type="checkbox" name="R01_Que7[]" id="tmp_705" value="5" <?php if($R01_Que7[4] == "5"){echo "checked";} ?> /><label for="tmp_705">2016</label><br>
					<input type="checkbox" name="R01_Que7[]" id="tmp_706" value="6" <?php if($R01_Que7[5] == "6"){echo "checked";} ?> /><label for="tmp_706">過去に参加したことはない</label><br>

					</div>
					</td>
				</tr>


				<tr>
				<th style="text-align: left;">7. プロモーションコードをお持ちですか</th>
				<td>
				  <p style = "color:red" id = "resgi9"></p>

				<input type="radio" name="R01_Que9" id="tmp_201" value="1" <?php if($R01_Que9 == "1"){echo "checked";} ?> /><label for="tmp_201">いいえ</label>
				<input type="radio" name="R01_Que9" id="tmp_202" value="2" <?php if($R01_Que9 == "2"){echo "checked";} ?> /><label for="tmp_201">はい</label><br>
				<div id="promotioncode">お持ちの場合は必ずご入力ください。<br>
				<p style = "color:red" id = "resgi91"></p>
				<input type="text" name="R01_Que9_Oth" id="R01_Que9_Oth" value="<?php echo $R01_Que9_Oth; ?>" style="width: 30%;" />
				</div>
				</td>
				</tr>

		</table>
</div>
<!-- END TAB REGISTRATION SOURCE -->



<!-- START TAB ENTRY SOURCE -->
<div id="nonreg">
		<table id="form" width="100%">
			<tbody>
				<th colspan="2"><div align="center">コース選択</div></th>
				<tr>
					<th style="width: 30%;" >コース名</th>
					<td >
						<select name="R01_course" id="R01_course" onchange="courseShow()">
						<?php foreach ($courseall as $row ){?>
								<option value="<?php echo $row['M05_course_id'];?>" <?php if (isset($R01_course) && ($R01_course == $row['M05_course_id'])) {echo "selected";} ?> ><?php echo "[".$row['M05_course_id']."]".$row['M05_course_title'];?></option>
						<?php }?>
						</select>
						&nbsp;&nbsp;&nbsp;
						<input type="radio" name="R01_Other_Airport_Disply_Flag" id="R01_Other_Airport_Disply_Flag_0" value="0" <?php if (isset($R01_Other_Airport_Disply_Flag) && ($R01_Other_Airport_Disply_Flag == "0")) {echo " checked";} ?>>お見積もり表示
						<input type="radio" name="R01_Other_Airport_Disply_Flag" id="R01_Other_Airport_Disply_Flag_1" value="1" <?php if (isset($R01_Other_Airport_Disply_Flag) && ($R01_Other_Airport_Disply_Flag == "1")) {echo " checked";} ?>>実価額表示
						<div id="R01_Other_Airport_Div" name="R01_Other_Airport_Div" 
						style="<?php 
								if (isset($R01_Dep_Airport) && ($R01_Dep_Airport == "2") ) {
									echo "display: block;";
								} else {
									echo "display: none;";
								}
							?>" >
							<br>
							<input type="text" name="R01_Other_Airport" id="R01_Other_Airport" size="30" value="<?php if (isset($R01_Other_Airport)){ echo htmlentities($R01_Other_Airport,ENT_QUOTES, "UTF-8"); }?>" />
						</div>
					</td>
				</tr>
				<tr>
					<th>利用航空会社</th>
					<td>
							<div id="course_d" style="display:none">
								<input type="radio" name="R01_air_tehai"  <?php if (isset($R01_air_tehai) && ($R01_air_tehai == "0")) {echo " checked";}?> value="0" id="R01_air_tehai_0" onchange ="Changeair_tehai();" >
								航空機は自分で手配
							  &nbsp; &nbsp; 
							
								<input type="radio" name="R01_air_tehai" <?php if (isset($R01_air_tehai) && ($R01_air_tehai == "1")) {echo " checked";} ?> value="1" id="R01_air_tehai_1" onchange ="Changeair_tehai();" >
								航空機手配を依頼する
							<div id="air_tehai">
								<table class="formd" width="100%">
								<tr>
									<th width="5%">&nbsp;</th>
									<th width="16%">日時</th>
									<th width="16%">航空会社</th>
									<th width="10%">便名</th>
									<th width="15%">区間</th>
									<th width="25%">時間帯</th>
								</tr>
								<?php
									
										$R01_going1_year = NULL;
										$R01_going1_month = NULL;
										$R01_going1_day = NULL;
										if(isset($R01_going1_date)){
											$R01_going1= explode('-',$R01_going1_date);
											$R01_going1_year = $R01_going1[0];
											$R01_going1_month = $R01_going1[1];
											$R01_going1_day = $R01_going1[2];
										}
										$R01_going2_year = NULL;
										$R01_going2_month = NULL;
										$R01_going2_day = NULL;
										if(isset($R01_going2_date)){
											$R01_going2= explode('-',$R01_going2_date);
											$R01_going2_year = $R01_going2[0];
											$R01_going2_month = $R01_going2[1];
											$R01_going2_day = $R01_going2[2];
										}
										$R01_going3_year = NULL;
										$R01_going3_month = NULL;
										$R01_going3_day = NULL;
										if(isset($R01_going3_date)){
											$R01_going3= explode('-',$R01_going3_date);
											$R01_going3_year = $R01_going1[0];
											$R01_going3_month = $R01_going1[1];
											$R01_going3_day = $R01_going1[2];
										}

								?>
				
								<tr>
					
									<td rowspan="3" style="text-align:center;">往路</td>
									<td style="text-align:center;">
										<select name="R01_going1_month" id="R01_going1_month">
											<option value = "" ></option>
											<?php for($month=1; $month<13; $month++ ){?>
											<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_going1_month == str_pad($month,2,'0',STR_PAD_LEFT)){ echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>月
										<select name="R01_going1_day" id="R01_going1_day">
											<option value = "" ></option>
											<?php for($day=1; $day<32; $day++ ){?>
												<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_going1_day == str_pad($day,2,'0',STR_PAD_LEFT)){ echo "selected";}?>> <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>日
										
									<td style="text-align:center;"><input name="R01_going1_aviation" type="text" id="R01_going1_aviation" value="<?php echo $R01_going1_aviation;?>" style="width:100%;"></td>
									<td style="text-align:center;"><input name="R01_going1_flight" type="text" id="R01_going1_flight" style="width:100%;" value="<?php echo $R01_going1_flight;?>"></td>
									<td style="text-align:center;"><input type="text" name="R01_going1_from" id="R01_going1_from"   value="<?php echo $R01_going1_from;?>"></br>
									 
									  <input type="text" name="R01_going1_to" id="R01_going1_to"  value="<?php echo $R01_going1_to;?>"></td>
									<td style="text-align:center;"><p>
									  <input type="text" name="R01_going1_deptime" id="R01_going1_deptime" style="width:35%;" value="<?php echo $R01_going1_deptime;?>">
									発/
									  <input type="text" name="R01_going1_arrtime" id="R01_going1_arrtime" style="width:35%;" value="<?php echo $R01_going1_arrtime;?>">
									  着
									</p>
									</td>
										

								</tr>
								<tr>
									<td style="text-align:center;">
										<select name="R01_going2_month" id="R01_going2_month">
											<option value = "" ></option>
											<?php for($month=1; $month<13; $month++ ){?>
											<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_going2_month == str_pad($month,2,'0',STR_PAD_LEFT)){ echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>月
										<select name="R01_going2_day" id="R01_going2_day">
											<option value = "" ></option>
											<?php for($day=1; $day<32; $day++ ){?>
												<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_going2_day == str_pad($day,2,'0',STR_PAD_LEFT)){ echo "selected";}?>> <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>日
										
									<td style="text-align:center;"><input name="R01_going2_aviation" type="text" id="R01_going2_aviation" value="<?php echo $R01_going2_aviation;?>" style="width:100%;"></td>
									<td style="text-align:center;"><input name="R01_going2_flight" type="text" id="R01_going2_flight" style="width:100%;" value="<?php echo $R01_going2_flight;?>"></td>
									<td style="text-align:center;"><input type="text" name="R01_going2_from" id="R01_going2_from"   value="<?php echo $R01_going2_from;?>"></br>
									 
									  <input type="text" name="R01_going2_to" id="R01_going2_to"  value="<?php echo $R01_going2_to;?>"></td>
									<td style="text-align:center;"><p>
									  <input type="text" name="R01_going2_deptime" id="R01_going2_deptime" style="width:35%;" value="<?php echo $R01_going2_deptime;?>">
									発/
									  <input type="text" name="R01_going2_arrtime" id="R01_going2_arrtime" style="width:35%;" value="<?php echo $R01_going2_arrtime;?>">
									  着
									</p>
									</td>
										

								</tr>
									<tr>
									<td style="text-align:center;">
										<select name="R01_going3_month" id="R01_going3_month">
											<option value = "" ></option>
											<?php for($month=1; $month<13; $month++ ){?>
											<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_going3_month == str_pad($month,2,'0',STR_PAD_LEFT)){ echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>月
										<select name="R01_going3_day" id="R01_going3_day">
											<option value = "" ></option>
											<?php for($day=1; $day<32; $day++ ){?>
												<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_going3_day == str_pad($day,2,'0',STR_PAD_LEFT)){ echo "selected";}?>> <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>日
										
									<td style="text-align:center;"><input name="R01_going3_aviation" type="text" id="R01_going3_aviation" value="<?php echo $R01_going3_aviation;?>" style="width:100%;"></td>
									<td style="text-align:center;"><input name="R01_going3_flight" type="text" id="R01_going3_flight" style="width:100%;" value="<?php echo $R01_going3_flight;?>"></td>
									<td style="text-align:center;"><input type="text" name="R01_going3_from" id="R01_going3_from"   value="<?php echo $R01_going3_from;?>"></br>
									 
									  <input type="text" name="R01_going3_to" id="R01_going3_to"  value="<?php echo $R01_going3_to;?>"></td>
									<td style="text-align:center;"><p>
									  <input type="text" name="R01_going3_deptime" id="R01_going3_deptime" style="width:35%;" value="<?php echo $R01_going3_deptime;?>">
									発/
									  <input type="text" name="R01_going3_arrtime" id="R01_going3_arrtime" style="width:35%;" value="<?php echo $R01_going3_arrtime;?>">
									  着
									</p>
									</td>
										

								</tr>
				
									<?php
									
										$R01_return1_year = NULL;
										$R01_return1_month = NULL;
										$R01_return1_day = NULL;
										if(isset($R01_return1_date)){
											$R01_return1= explode('-',$R01_return1_date);
											$R01_return1_year = $R01_return1[0];
											$R01_return1_month = $R01_return1[1];
											$R01_return1_day = $R01_return1[2];
										}
										$R01_return2_year = NULL;
										$R01_return2_month = NULL;
										$R01_return2_day = NULL;
										if(isset($R01_return2_date)){
											$R01_return2= explode('-',$R01_return2_date);
											$R01_return2_year = $R01_return2[0];
											$R01_return2_month = $R01_return2[1];
											$R01_return2_day = $R01_return2[2];
										}
										$R01_return3_year = NULL;
										$R01_return3_month = NULL;
										$R01_return3_day = NULL;
										if(isset($R01_return3_date)){
											$R01_return3= explode('-',$R01_return3_date);
											$R01_return3_year = $R01_return1[0];
											$R01_return3_month = $R01_return1[1];
											$R01_return3_day = $R01_return1[2];
										}

								?>
				
								<tr>
					
									<td rowspan="3" style="text-align:center;">復路</td>
									<td style="text-align:center;">
										<select name="R01_return1_month" id="R01_return1_month">
											<option value = "" ></option>
											<?php for($month=1; $month<13; $month++ ){?>
											<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_return1_month == str_pad($month,2,'0',STR_PAD_LEFT)){ echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>月
										<select name="R01_return1_day" id="R01_return1_day">
											<option value = "" ></option>
											<?php for($day=1; $day<32; $day++ ){?>
												<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_return1_day == str_pad($day,2,'0',STR_PAD_LEFT)){ echo "selected";}?>> <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>日
										
									<td style="text-align:center;"><input name="R01_return1_aviation" type="text" id="R01_return1_aviation" value="<?php echo $R01_return1_aviation;?>" style="width:100%;"></td>
									<td style="text-align:center;"><input name="R01_return1_flight" type="text" id="R01_return1_flight" style="width:100%;" value="<?php echo $R01_return1_flight;?>"></td>
									<td style="text-align:center;"><input type="text" name="R01_return1_from" id="R01_return1_from"   value="<?php echo $R01_return1_from;?>"></br>
									 
									  <input type="text" name="R01_return1_to" id="R01_return1_to"  value="<?php echo $R01_return1_to;?>"></td>
									<td style="text-align:center;"><p>
									  <input type="text" name="R01_return1_deptime" id="R01_return1_deptime" style="width:35%;" value="<?php echo $R01_return1_deptime;?>">
									発/
									  <input type="text" name="R01_return1_arrtime" id="R01_return1_arrtime" style="width:35%;" value="<?php echo $R01_return1_arrtime;?>">
									  着
									</p>
									</td>
										

								</tr>
								<tr>
									<td style="text-align:center;">
										<select name="R01_return2_month" id="R01_return2_month">
											<option value = "" ></option>
											<?php for($month=1; $month<13; $month++ ){?>
											<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_return2_month == str_pad($month,2,'0',STR_PAD_LEFT)){ echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>月
										<select name="R01_return2_day" id="R01_return2_day">
											<option value = "" ></option>
											<?php for($day=1; $day<32; $day++ ){?>
												<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_return2_day == str_pad($day,2,'0',STR_PAD_LEFT)){ echo "selected";}?>> <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>日
										
									<td style="text-align:center;"><input name="R01_return2_aviation" type="text" id="R01_return2_aviation" value="<?php echo $R01_return2_aviation;?>" style="width:100%;"></td>
									<td style="text-align:center;"><input name="R01_return2_flight" type="text" id="R01_return2_flight" style="width:100%;" value="<?php echo $R01_return2_flight;?>"></td>
									<td style="text-align:center;"><input type="text" name="R01_return2_from" id="R01_return2_from"   value="<?php echo $R01_return2_from;?>"></br>
									 
									  <input type="text" name="R01_return2_to" id="R01_return2_to"  value="<?php echo $R01_return2_to;?>"></td>
									<td style="text-align:center;"><p>
									  <input type="text" name="R01_return2_deptime" id="R01_return2_deptime" style="width:35%;" value="<?php echo $R01_return2_deptime;?>">
									発/
									  <input type="text" name="R01_return2_arrtime" id="R01_return2_arrtime" style="width:35%;" value="<?php echo $R01_return2_arrtime;?>">
									  着
									</p>
									</td>
										

								</tr>
									<tr>
									<td style="text-align:center;">
										<select name="R01_return3_month" id="R01_return3_month">
											<option value = "" ></option>
											<?php for($month=1; $month<13; $month++ ){?>
											<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_return3_month == str_pad($month,2,'0',STR_PAD_LEFT)){ echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>月
										<select name="R01_return3_day" id="R01_return3_day">
											<option value = "" ></option>
											<?php for($day=1; $day<32; $day++ ){?>
												<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_return3_day == str_pad($day,2,'0',STR_PAD_LEFT)){ echo "selected";}?>> <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?></option>
											<?php }?>
										</select>日
										
									<td style="text-align:center;"><input name="R01_return3_aviation" type="text" id="R01_return3_aviation" value="<?php echo $R01_return3_aviation;?>" style="width:100%;"></td>
									<td style="text-align:center;"><input name="R01_return3_flight" type="text" id="R01_return3_flight" style="width:100%;" value="<?php echo $R01_return3_flight;?>"></td>
									<td style="text-align:center;"><input type="text" name="R01_return3_from" id="R01_return3_from"   value="<?php echo $R01_return3_from;?>"></br>
									 
									  <input type="text" name="R01_return3_to" id="R01_return3_to"  value="<?php echo $R01_return3_to;?>"></td>
									<td style="text-align:center;"><p>
									  <input type="text" name="R01_return3_deptime" id="R01_return3_deptime" style="width:35%;" value="<?php echo $R01_return3_deptime;?>">
									発/
									  <input type="text" name="R01_return3_arrtime" id="R01_return3_arrtime" style="width:35%;" value="<?php echo $R01_return3_arrtime;?>">
									  着
									</p>
									</td>
										

								</tr>
								<tr>
									  <th colspan="3" style="text-align:center;">希望クラス(国際線)</th>
									  <td colspan="4" style="text-align:left;"><select name="R01_flight_class" id="R01_flight_class">
										<option  value="E"  <?php if (isset($R01_flight_class) && ($R01_flight_class == 'E')) {echo "selected";} ?>>エコノミークラス</option>
										<option value="P" <?php if (isset($R01_flight_class) && ($R01_flight_class == 'P')) {echo "selected";} ?>>プレミアムエコノミー</option>
										<option value="B" <?php if (isset($R01_flight_class) && ($R01_flight_class == 'B')) {echo "selected";} ?>>ビジネスクラス</option>
										<option value="F" <?php if (isset($R01_flight_class) && ($R01_flight_class == 'F')) {echo "selected";} ?>>ファーストクラス</option>
										<option value="S" <?php if (isset($R01_flight_class) && ($R01_flight_class == 'S')) {echo "selected";} ?>>その他</option>

									  </select></td>
								</tr>
								<tr>
									<th colspan="3" style="text-align:center;">航空機に関する連絡欄</th>
									<td colspan="4" style="text-align:left;"><p>
										<textarea name="R01_flight_Memo" rows="4" style="width:100%;"><?php echo nl2br($R01_flight_Memo) ;?></textarea>
									</td>
								</tr>
				

								<input type="submit" id="reload" style="display:none;"/>
							</table>			
								
							</div>
							</div><!-----------------course_d END---------------------->
							<div id="course_sel">
								<?php 
									if(isset($zaiko )){ ?>
								<div id="course_a">
										<?php foreach ($zaiko as $row ){
											if($row['M05_course'] == "A"){
											$stock = $row['M05_stock'] - $row['M05_rsv'];
					
											if ($stock > 0){
											?>
									 
											<label><input type="radio" name="R01_apt" value="<?php echo $row['M05_apt']."&".$row['M05_flight'];?>" <?php if (isset($R01_apt) && ($R01_apt == $row['M05_apt']) && ($R01_aviation == $row['M05_flight']) && ($R01_course == $row['M05_course'])) {echo "checked";} ?> id="flightselect_<?php echo $row['M05_id'];?>"><?php echo $row['M05_apt']."-".$row['M05_flight'];?></label></br>
									  
											<?php
											
											}else{?>
												 <input type="radio"  disabled name="R01_apt" value="<?php echo $row['M05_apt']."&".$row['M05_flight'];?>" <?php if (isset($R01_apt) && ($R01_apt == $row['M05_apt']) && ($R01_aviation == $row['M05_flight']) && ($R01_course == $row['M05_course'])) {echo "checked";} ?> id="flightselect_<?php echo $row['M05_id'];?>"><?php echo '満席: '.$row['M05_apt']."-".$row['M05_flight'];?></br>
											<?php	 
												}?>
											
											<?php 
											}
										} ?>
								</div><!--------course_a END----------->
								<div id="course_b">
										<?php foreach ($zaiko as $row ){	
											if($row['M05_course'] == "B"){
											$stock = $row['M05_stock'] - $row['M05_rsv'];
					
											if ($stock > 0){
											?>
									 
											<label><input type="radio" name="R01_apt" value="<?php echo $row['M05_apt']."&".$row['M05_flight'];?>" <?php if (isset($R01_apt) && ($R01_apt == $row['M05_apt']) && ($R01_aviation == $row['M05_flight']) && ($R01_course == $row['M05_course'])) {echo "checked";} ?> id="flightselect_<?php echo $row['M05_id'];?>"><?php echo $row['M05_apt']."-".$row['M05_flight'];?></label></br>
									  
											<?php
											
											}else{?>
												 <input type="radio"   name="R01_apt" value="<?php echo $row['M05_apt']."&".$row['M05_flight'];?>" <?php if (isset($R01_apt) && ($R01_apt == $row['M05_apt']) && ($R01_aviation == $row['M05_flight']) && ($R01_course == $row['M05_course'])) {echo "checked";} ?> id="flightselect_<?php echo $row['M05_id'];?>" disabled><?php echo '満席: '.$row['M05_apt']."-".$row['M05_flight'];?></br>
											<?php	 
												}?>
											
											<?php 
											}
										} ?>

								</div><!--------course_b END----------->
								<div id="course_c">
										<?php foreach ($zaiko as $row ){	
											if($row['M05_course'] == "C"){
											$stock = $row['M05_stock'] - $row['M05_rsv'];
					
											if ($stock > 0){
											?>
									 
											<label><input type="radio" name="R01_apt" value="<?php echo $row['M05_apt']."&".$row['M05_flight'];?>" <?php if (isset($R01_apt) && ($R01_apt == $row['M05_apt']) && ($R01_aviation == $row['M05_flight']) && ($R01_course == $row['M05_course'])) {echo "checked";} ?> id="flightselect_<?php echo $row['M05_id'];?>"><?php echo $row['M05_apt']."-".$row['M05_flight'];?></label></br>
									  
											<?php
											
											}else{?>
												 <input type="radio"  disabled name="R01_apt" value="<?php echo $row['M05_apt']."&".$row['M05_flight'];?>" <?php if (isset($R01_apt) && ($R01_apt == $row['M05_apt']) && ($R01_aviation == $row['M05_flight']) && ($R01_course == $row['M05_course'])) {echo "checked";} ?> id="flightselect_<?php echo $row['M05_id'];?>"><?php echo '満席: '.$row['M05_apt']."-".$row['M05_flight'];?></br>
											<?php	 
												}?>
											
											<?php 
											}
										} ?>
								</div><!--------course_c END----------->
								<?php	} ?>
							</div>
						
					</td>

				</tr>
				<tr>
					<th>利用ホテル希望</th>
					<td>
						<div id="dhotel"> 
								<input type="radio" name="R01_hotel_tehai" value="0"  <?php if (isset($R01_hotel_tehai) && ($R01_hotel_tehai == "0")) {echo " checked";} ?> id="R01_hotel_tehai_0" onchange="Changehotel_tehai();"> ホテル(宿泊)は自分で手配
								&nbsp; &nbsp; 
								<input type="radio" name="R01_hotel_tehai" value="1"  <?php if (isset($R01_hotel_tehai) && ($R01_hotel_tehai == "1")) {echo " checked";} ?> id="R01_hotel_tehai_1" onchange="Changehotel_tehai();"> ホテル(宿泊)手配を依頼する

							
								<table class="form" width="100%" id="hotel_tehai">
									<tr>
										<th>ホテル名</th>
										<th>日時</th>
									</tr>
									<tr>
					 
										<td><input type="radio" name="R01_hotel" value="ザ・ベネチアン/パラッツォ" id="hotelselect_1001" <?php if (isset($R01_hotel) && ($R01_hotel == 'ザ・ベネチアン/パラッツォ')) {echo "checked";} ?>>ザ・ベネチアン/パラッツォ</td>

									<?php
									
										$R01_hotel_ci_year = NULL;
										$R01_hotel_ci_month = NULL;
										$R01_hotel_ci_day = NULL;
										if(isset($R01_hotel_ci_date)){
											$R01_hotel_ci= explode('-',$R01_hotel_ci_date);
											$R01_hotel_ci_year = $R01_hotel_ci[0];
											$R01_hotel_ci_month = $R01_hotel_ci[1];
											$R01_hotel_ci_day = $R01_hotel_ci[2];
										}
										$R01_hotel_co_year = NULL;
										$R01_hotel_co_month = NULL;
										$R01_hotel_co_day = NULL;
										if(isset($R01_hotel_co_date)){
											$R01_hotel_co= explode('-',$R01_hotel_co_date);
											$R01_hotel_co_year = $R01_hotel_co[0];
											$R01_hotel_co_month = $R01_hotel_co[1];
											$R01_hotel_co_day = $R01_hotel_co[2];
										}
										

								?>
										<td rowspan="3" style="text-align:center;"><p>チェックイン
											<select name="R01_hotel_ci_month" id="R01_hotel_ci_month">
												<option value = "" ></option>
												<?php for($month=1; $month<13; $month++ ){?>
												<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_hotel_ci_month == str_pad($month,2,'0',STR_PAD_LEFT)){ echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?></option>
												<?php }?>
											</select>月
											<select name="R01_hotel_ci_day" id="R01_hotel_ci_day">
												<option value = "" ></option>
												<?php for($day=1; $day<32; $day++ ){?>
													<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_hotel_ci_day == str_pad($day,2,'0',STR_PAD_LEFT)){ echo "selected";}?>> <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?></option>
												<?php }?>
											</select>日
										/チェックアウト
												<select name="R01_hotel_co_month" id="R01_hotel_co_month">
												<option value = "" ></option>
												<?php for($month=1; $month<13; $month++ ){?>
												<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_hotel_co_month == str_pad($month,2,'0',STR_PAD_LEFT)){ echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?></option>
												<?php }?>
											</select>月
											<select name="R01_hotel_co_day" id="R01_hotel_co_day">
												<option value = "" ></option>
												<?php for($day=1; $day<32; $day++ ){?>
													<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>"  <?php if($R01_hotel_co_day == str_pad($day,2,'0',STR_PAD_LEFT)){ echo "selected";}?>> <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?></option>
												<?php }?>
											</select>日
											  </p>
										  </td>
					
	

									</tr>
									<tr>
										  <td><input type="radio" name="R01_hotel" value="トレジャーアイランド" id="hotelselect_1003" <?php if (isset($R01_hotel) && ($R01_hotel == 'トレジャーアイランド')) {echo "checked";} ?>>
										  トレジャーアイランド</td>
									</tr>
									<tr>
									  <td><input type="radio" name="R01_hotel" value="その他のホテル" id="hotelselect_1099" <?php if (isset($R01_hotel) && ($R01_hotel == 'その他のホテル')) {echo "checked";} ?>  >その他のホテル
										<p><span style="text-align:center;">
										  ホテル名
											  <input name="R01_other_hotel" type="text" id="R01_other_hotel" style="width:50%;" value ="<?php echo $R01_other_hotel;?>" >
									  </span></p></td>
									</tr>
									<tr>
									  <th colspan="3" style="text-align:center;">ホテルに関する連絡欄</th>
												</tr>
							<tr>
							  <td colspan="3" style="text-align:left;"><p>
								<textarea style="width:100%;" name="R01_hotel_Memo" rows="4" ><?php echo nl2br($R01_hotel_Memo) ;?></textarea>
								</p>
							   </td>
					</tr>
							
				
							<input type="submit" id="reload" style="display:none;"/>
						</table>

				</div>
				<div id="bhotel">
					<input type="radio" name="R01_hotel" value="ザ・ベネチアン" id="hotelselect_1001" checked>ザ・ベネチアン
				</div>
				<div id="ahotel">
						<?php foreach ($hotel as $row ){?>

						<?php 
							if($row['M05_hotelid']<9999){
						?>			 
							<input type="radio" name="R01_hotel" value="<?php echo $row['M05_hotel_name'];?>" <?php if (isset($R01_hotel) && ($R01_hotel == $row['M05_hotel_name'])) {echo "checked";} ?> id="R01_hotel_<?php echo $row['M05_hotelid'];?>"><?php echo $row['M05_hotel_name'];?></br>                
							
							
						<?php 
							}
						}
						?>	
				</div>
					
						


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
						<input type="text" name="R01_Name_Kanji_Sei" id="R01_Name_Kanji_Sei" size="9" value="<?php echo $R01_Name_Kanji_Sei; //if (isset($R01_Name_Kanji_Sei)){echo htmlentities($R01_Name_Kanji_Sei,ENT_QUOTES, "UTF-8"); }?>" />&nbsp;
						<font color="#000000">名 </font>
						<input type="text" name="R01_Name_Kanji_Mei" id="R01_Name_Kanji_Mei" size="9" value="<?php if (isset($R01_Name_Kanji_Mei)){echo htmlentities($R01_Name_Kanji_Mei,ENT_QUOTES, "UTF-8"); }?>"  />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >お名前(カナ)</th>
					<td>
						<font color="#000000">姓</font>
						<input type="text" name="R01_Name_Kana_Sei" id="R01_Name_Kana_Sei" size="9" value="<?php if (isset($R01_Name_Kana_Sei)){echo htmlentities($R01_Name_Kana_Sei,ENT_QUOTES, "UTF-8"); }?>" />&nbsp;
						<font color="#000000">名</font>
						<input type="text" name="R01_Name_Kana_Mei" id="R01_Name_Kana_Mei" size="9" value="<?php if (isset($R01_Name_Kana_Mei)){echo htmlentities($R01_Name_Kana_Mei,ENT_QUOTES, "UTF-8"); }?>" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >お名前(ローマ字)</th>
					<td>
						<font color="#000000">姓</font>
						<input type="text" name="R01_Name_Roman_Sei" id="R01_Name_Roman_Sei" size="9" value="<?php if (isset($R01_Name_Roman_Sei)){echo htmlentities($R01_Name_Roman_Sei,ENT_QUOTES, "UTF-8"); }?>" />&nbsp;
						<font color="#000000">名</font>
						<input type="text" name="R01_Name_Roman_Mei" id="R01_Name_Roman_Mei" size="9" value="<?php if (isset($R01_Name_Roman_Mei)){echo htmlentities($R01_Name_Roman_Mei,ENT_QUOTES, "UTF-8"); }?>" />&nbsp;
						<font color="#000000">ミドル</font>
						<input type="text" name="R01_Name_Roman_Mid" id="R01_Name_Roman_Mid" size="9" value="<?php if (isset($R01_Name_Roman_Mid)){echo htmlentities($R01_Name_Roman_Mid,ENT_QUOTES, "UTF-8"); }?>" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >生年月日</th>
					<td>
						<select name="R01_Birth_Year" id="R01_Birth_Year">	
							<option value="">年</option>
							<?php for($year=1925; $year<1998; $year++ ){?>
							<option value="<?php echo $year;?>" <?php if($R01_Birth_Year==$year ){echo "selected";}?> > <?php echo $year;?>年</option>
							<?php }?>
						</select>
						<select name="R01_Birth_Month" id="R01_Birth_Month">	
							<option value="">月</option>
							<?php for($month=1; $month<13; $month++ ){?>
							<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>" <?php if($R01_Birth_Month==str_pad($month,2,'0',STR_PAD_LEFT) ){echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>月</option>
							<?php }?>
						</select>
						<select name="R01_Birth_Date" id="R01_Birth_Date">	
							<option value="">日</option>
							<?php for($day=1; $day<32; $day++ ){?>
							<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>" <?php if($R01_Birth_Date==str_pad($day,2,'0',STR_PAD_LEFT) ){echo "selected";}?> > <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>日</option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;">国籍</th>
					<td>
						<select name="R01_Country" id="R01_Country">
							<option value="" >選択してください</option>
							<option value="1" <?php if($R01_Country == "1" ){echo "selected";}?> >日本</option>
							<option value="2" <?php if($R01_Country == "2" ){echo "selected";}?> >アイスランド</option>
							<option value="3" <?php if($R01_Country == "3" ){echo "selected";}?> >ジンバブエ</option>
							<option value="4" <?php if($R01_Country == "4" ){echo "selected";}?> >ザンビア</option>
							<option value="5" <?php if($R01_Country == "5" ){echo "selected";}?> >ザイール</option>
							<option value="6" <?php if($R01_Country == "6" ){echo "selected";}?> >南アフリカ</option>
							<option value="7" <?php if($R01_Country == "7" ){echo "selected";}?> >ユーゴスラビア</option>
							<option value="8" <?php if($R01_Country == "8" ){echo "selected";}?> >イエメン</option>
							<option value="9" <?php if($R01_Country == "9" ){echo "selected";}?> >サモア</option>
							<option value="10" <?php if($R01_Country == "10" ){echo "selected";}?> >ウォリス・フツナ</option>
							<option value="11" <?php if($R01_Country == "11" ){echo "selected";}?> >バヌアツ</option>
							<option value="12" <?php if($R01_Country == "12" ){echo "selected";}?> >ベトナム</option>
							<option value="13" <?php if($R01_Country == "13" ){echo "selected";}?> >アメリカ領ヴァージン諸島</option>
							<option value="14" <?php if($R01_Country == "14" ){echo "selected";}?> >イギリス領ヴァージン諸島</option>
							<option value="15" <?php if($R01_Country == "15" ){echo "selected";}?> >ベネズエラ</option>
							<option value="16" <?php if($R01_Country == "16" ){echo "selected";}?> >セントビンセント・グレナディーン</option>
							<option value="17" <?php if($R01_Country == "17" ){echo "selected";}?> >バチカン</option>
							<option value="18" <?php if($R01_Country == "18" ){echo "selected";}?> >ウズベキスタン</option>
							<option value="19" <?php if($R01_Country == "19" ){echo "selected";}?> >アメリカ</option>
							<option value="20" <?php if($R01_Country == "20" ){echo "selected";}?> >ウルグアイ</option>
							<option value="21" <?php if($R01_Country == "21" ){echo "selected";}?> >合衆国領有小離島</option>
							<option value="22" <?php if($R01_Country == "22" ){echo "selected";}?> >ウクライナ</option>
							<option value="23" <?php if($R01_Country == "23" ){echo "selected";}?> >ウガンダ</option>
							<option value="24" <?php if($R01_Country == "24" ){echo "selected";}?> >タンザニア</option>
							<option value="25" <?php if($R01_Country == "25" ){echo "selected";}?> >台湾</option>
							<option value="26" <?php if($R01_Country == "26" ){echo "selected";}?> >ツバル</option>
							<option value="27" <?php if($R01_Country == "27" ){echo "selected";}?> >トルコ</option>
							<option value="28" <?php if($R01_Country == "28" ){echo "selected";}?> >チュニジア</option>
							<option value="29" <?php if($R01_Country == "29" ){echo "selected";}?> >トリニダード・トバゴ</option>
							<option value="30" <?php if($R01_Country == "30" ){echo "selected";}?> >トンガ</option>
							<option value="31" <?php if($R01_Country == "31" ){echo "selected";}?> >東ティモール</option>
							<option value="32" <?php if($R01_Country == "32" ){echo "selected";}?> >トルクメニスタン</option>
							<option value="33" <?php if($R01_Country == "33" ){echo "selected";}?> >トケラウ</option>
							<option value="34" <?php if($R01_Country == "34" ){echo "selected";}?> >タジキスタン</option>
							<option value="35" <?php if($R01_Country == "35" ){echo "selected";}?> >タイ</option>
							<option value="36" <?php if($R01_Country == "36" ){echo "selected";}?> >トーゴ</option>
							<option value="37" <?php if($R01_Country == "37" ){echo "selected";}?> >チャド</option>
							<option value="38" <?php if($R01_Country == "38" ){echo "selected";}?> >タークス・カイコス諸島</option>
							<option value="39" <?php if($R01_Country == "39" ){echo "selected";}?> >シリア</option>
							<option value="40" <?php if($R01_Country == "40" ){echo "selected";}?> >セーシェル</option>
							<option value="41" <?php if($R01_Country == "41" ){echo "selected";}?> >シント・マールテン島</option>
							<option value="42" <?php if($R01_Country == "42" ){echo "selected";}?> >スワジランド</option>
							<option value="43" <?php if($R01_Country == "43" ){echo "selected";}?> >スウェーデン</option>
							<option value="44" <?php if($R01_Country == "44" ){echo "selected";}?> >スロベニア</option>
							<option value="45" <?php if($R01_Country == "45" ){echo "selected";}?> >スロバキア</option>
							<option value="46" <?php if($R01_Country == "46" ){echo "selected";}?> >スリナム</option>
							<option value="47" <?php if($R01_Country == "47" ){echo "selected";}?> >サントメ・プリンシペ</option>
							<option value="48" <?php if($R01_Country == "48" ){echo "selected";}?> >セルビア</option>
							<option value="49" <?php if($R01_Country == "49" ){echo "selected";}?> >サンピエール島・ミクロン島</option>
							<option value="50" <?php if($R01_Country == "50" ){echo "selected";}?> >ソマリア</option>
							<option value="51" <?php if($R01_Country == "51" ){echo "selected";}?> >サンマリノ</option>
							<option value="52" <?php if($R01_Country == "52" ){echo "selected";}?> >エルサルバドル</option>
							<option value="53" <?php if($R01_Country == "53" ){echo "selected";}?> >シエラレオネ</option>
							<option value="54" <?php if($R01_Country == "54" ){echo "selected";}?> >ソロモン諸島</option>
							<option value="55" <?php if($R01_Country == "55" ){echo "selected";}?> >スヴァールバル諸島,ヤンマイエン島</option>
							<option value="56" <?php if($R01_Country == "56" ){echo "selected";}?> >セントヘレナ・アセンション,トリスタン・ダ・クーニャ</option>
							<option value="57" <?php if($R01_Country == "57" ){echo "selected";}?> >サウスジョージア・サウスサンドウィッチ諸島</option>
							<option value="58" <?php if($R01_Country == "58" ){echo "selected";}?> >シンガポール</option>
							<option value="59" <?php if($R01_Country == "59" ){echo "selected";}?> >セネガル</option>
							<option value="60" <?php if($R01_Country == "60" ){echo "selected";}?> >スーダン</option>
							<option value="61" <?php if($R01_Country == "61" ){echo "selected";}?> >セルビア・モンテネグロ</option>
							<option value="62" <?php if($R01_Country == "62" ){echo "selected";}?> >サウジアラビア</option>
							<option value="63" <?php if($R01_Country == "63" ){echo "selected";}?> >ルワンダ</option>
							<option value="64" <?php if($R01_Country == "64" ){echo "selected";}?> >ロシア</option>
							<option value="65" <?php if($R01_Country == "65" ){echo "selected";}?> >ルーマニア</option>
							<option value="66" <?php if($R01_Country == "66" ){echo "selected";}?> >パラオ共和国</option>
							<option value="67" <?php if($R01_Country == "67" ){echo "selected";}?> >ルーマニア</option>
							<option value="68" <?php if($R01_Country == "68" ){echo "selected";}?> >レユニオン</option>
							<option value="69" <?php if($R01_Country == "69" ){echo "selected";}?> >カタール</option>
							<option value="70" <?php if($R01_Country == "70" ){echo "selected";}?> >フランス領ポリネシア</option>
							<option value="71" <?php if($R01_Country == "71" ){echo "selected";}?> >パレスチナ</option>
							<option value="72" <?php if($R01_Country == "72" ){echo "selected";}?> >パラグアイ</option>
							<option value="73" <?php if($R01_Country == "73" ){echo "selected";}?> >ポルトガル</option>
							<option value="74" <?php if($R01_Country == "74" ){echo "selected";}?> >北朝鮮</option>
							<option value="75" <?php if($R01_Country == "75" ){echo "selected";}?> >プエルトリコ</option>
							<option value="76" <?php if($R01_Country == "76" ){echo "selected";}?> >ポーランド</option>
							<option value="77" <?php if($R01_Country == "77" ){echo "selected";}?> >パプアニューギニア</option>
							<option value="78" <?php if($R01_Country == "78" ){echo "selected";}?> >パラオ</option>
							<option value="79" <?php if($R01_Country == "79" ){echo "selected";}?> >フィリピン</option>
							<option value="80" <?php if($R01_Country == "80" ){echo "selected";}?> >ペルー</option>
							<option value="81" <?php if($R01_Country == "81" ){echo "selected";}?> >ピトケアン</option>
							<option value="82" <?php if($R01_Country == "82" ){echo "selected";}?> >パナマ</option>
							<option value="83" <?php if($R01_Country == "83" ){echo "selected";}?> >パキスタン</option>
							<option value="84" <?php if($R01_Country == "84" ){echo "selected";}?> >オマーン</option>
							<option value="85" <?php if($R01_Country == "85" ){echo "selected";}?> >ニュージーランド</option>
							<option value="86" <?php if($R01_Country == "86" ){echo "selected";}?> >ナウル</option>
							<option value="87" <?php if($R01_Country == "87" ){echo "selected";}?> >ネパール</option>
							<option value="88" <?php if($R01_Country == "88" ){echo "selected";}?> >ノルウェー</option>
							<option value="89" <?php if($R01_Country == "89" ){echo "selected";}?> >オランダ</option>
							<option value="90" <?php if($R01_Country == "90" ){echo "selected";}?> >ニウエ</option>
							<option value="91" <?php if($R01_Country == "91" ){echo "selected";}?> >ニカラグア</option>
							<option value="92" <?php if($R01_Country == "92" ){echo "selected";}?> >ナイジェリア</option>
							<option value="93" <?php if($R01_Country == "93" ){echo "selected";}?> >ノーフォーク島</option>
							<option value="94" <?php if($R01_Country == "94" ){echo "selected";}?> >ニジェール</option>
							<option value="95" <?php if($R01_Country == "95" ){echo "selected";}?> >ニューカレドニア</option>
							<option value="96" <?php if($R01_Country == "96" ){echo "selected";}?> >ナミビア</option>
							<option value="97" <?php if($R01_Country == "97" ){echo "selected";}?> >マヨット</option>
							<option value="98" <?php if($R01_Country == "98" ){echo "selected";}?> >マレーシア</option>
							<option value="99" <?php if($R01_Country == "99" ){echo "selected";}?> >マラウイ</option>
							<option value="100" <?php if($R01_Country == "100" ){echo "selected";}?> >モーリシャス</option>
							<option value="101" <?php if($R01_Country == "101" ){echo "selected";}?> >マルティニーク</option>
							<option value="102" <?php if($R01_Country == "102" ){echo "selected";}?> >モントセラト</option>
							<option value="103" <?php if($R01_Country == "103" ){echo "selected";}?> >モーリタニア</option>
							<option value="104" <?php if($R01_Country == "104" ){echo "selected";}?> >モザンビーク</option>
							<option value="105" <?php if($R01_Country == "105" ){echo "selected";}?> >北マリアナ諸島</option>
							<option value="106" <?php if($R01_Country == "106" ){echo "selected";}?> >モンゴル</option>
							<option value="107" <?php if($R01_Country == "107" ){echo "selected";}?> >モンテネグロ</option>
							<option value="108" <?php if($R01_Country == "108" ){echo "selected";}?> >ミャンマー</option>
							<option value="109" <?php if($R01_Country == "109" ){echo "selected";}?> >マルタ</option>
							<option value="110" <?php if($R01_Country == "110" ){echo "selected";}?> >マリ</option>
							<option value="111" <?php if($R01_Country == "111" ){echo "selected";}?> >マケドニア共和国</option>
							<option value="112" <?php if($R01_Country == "112" ){echo "selected";}?> >マーシャル諸島</option>
							<option value="113" <?php if($R01_Country == "113" ){echo "selected";}?> >メキシコ</option>
							<option value="114" <?php if($R01_Country == "114" ){echo "selected";}?> >モルディブ</option>
							<option value="115" <?php if($R01_Country == "115" ){echo "selected";}?> >マダガスカル</option>
							<option value="116" <?php if($R01_Country == "116" ){echo "selected";}?> >モルドバ</option>
							<option value="117" <?php if($R01_Country == "117" ){echo "selected";}?> >モナコ</option>
							<option value="118" <?php if($R01_Country == "118" ){echo "selected";}?> >モロッコ</option>
							<option value="119" <?php if($R01_Country == "119" ){echo "selected";}?> >サン・マルタン島</option>
							<option value="120" <?php if($R01_Country == "120" ){echo "selected";}?> >マカオ</option>
							<option value="121" <?php if($R01_Country == "121" ){echo "selected";}?> >ラトビア</option>
							<option value="122" <?php if($R01_Country == "122" ){echo "selected";}?> >ルクセンブルク</option>
							<option value="123" <?php if($R01_Country == "123" ){echo "selected";}?> >リトアニア</option>
							<option value="124" <?php if($R01_Country == "124" ){echo "selected";}?> >レソト</option>
							<option value="125" <?php if($R01_Country == "125" ){echo "selected";}?> >スリランカ</option>
							<option value="126" <?php if($R01_Country == "126" ){echo "selected";}?> >リヒテンシュタイン</option>
							<option value="127" <?php if($R01_Country == "127" ){echo "selected";}?> >セントルシア</option>
							<option value="128" <?php if($R01_Country == "128" ){echo "selected";}?> >リビア</option>
							<option value="129" <?php if($R01_Country == "129" ){echo "selected";}?> >リベリア</option>
							<option value="130" <?php if($R01_Country == "130" ){echo "selected";}?> >レバノン</option>
							<option value="131" <?php if($R01_Country == "131" ){echo "selected";}?> >ラオス</option>
							<option value="132" <?php if($R01_Country == "132" ){echo "selected";}?> >クウェート</option>
							<option value="133" <?php if($R01_Country == "133" ){echo "selected";}?> >韓国</option>
							<option value="134" <?php if($R01_Country == "134" ){echo "selected";}?> >セントクリストファー・ネイビス</option>
							<option value="135" <?php if($R01_Country == "135" ){echo "selected";}?> >キリバス</option>
							<option value="136" <?php if($R01_Country == "136" ){echo "selected";}?> >カンボジア</option>
							<option value="137" <?php if($R01_Country == "137" ){echo "selected";}?> >キルギス</option>
							<option value="138" <?php if($R01_Country == "138" ){echo "selected";}?> >ケニア</option>
							<option value="139" <?php if($R01_Country == "139" ){echo "selected";}?> >カザフスタン</option>
							<option value="140" <?php if($R01_Country == "140" ){echo "selected";}?> >ヨルダン</option>
							<option value="141" <?php if($R01_Country == "141" ){echo "selected";}?> >ジャージー</option>
							<option value="142" <?php if($R01_Country == "142" ){echo "selected";}?> >ジャマイカ</option>
							<option value="143" <?php if($R01_Country == "143" ){echo "selected";}?> >イタリア</option>
							<option value="144" <?php if($R01_Country == "144" ){echo "selected";}?> >イスラエル</option>
							<option value="145" <?php if($R01_Country == "145" ){echo "selected";}?> >イラク</option>
							<option value="146" <?php if($R01_Country == "146" ){echo "selected";}?> >イラン</option>
							<option value="147" <?php if($R01_Country == "147" ){echo "selected";}?> >アイルランド</option>
							<option value="148" <?php if($R01_Country == "148" ){echo "selected";}?> >イギリス領インド洋地域</option>
							<option value="149" <?php if($R01_Country == "149" ){echo "selected";}?> >インド</option>
							<option value="150" <?php if($R01_Country == "150" ){echo "selected";}?> >マン島</option>
							<option value="151" <?php if($R01_Country == "151" ){echo "selected";}?> >インドネシア</option>
							<option value="152" <?php if($R01_Country == "152" ){echo "selected";}?> >ハワイ（アメリカ）</option>
							<option value="153" <?php if($R01_Country == "153" ){echo "selected";}?> >ハンガリー</option>
							<option value="154" <?php if($R01_Country == "154" ){echo "selected";}?> >ハイチ</option>
							<option value="155" <?php if($R01_Country == "155" ){echo "selected";}?> >クロアチア</option>
							<option value="156" <?php if($R01_Country == "156" ){echo "selected";}?> >ホンジュラス</option>
							<option value="157" <?php if($R01_Country == "157" ){echo "selected";}?> >ハード島,マクドナルド諸島</option>
							<option value="158" <?php if($R01_Country == "158" ){echo "selected";}?> >香港</option>
							<option value="159" <?php if($R01_Country == "159" ){echo "selected";}?> >ガイアナ</option>
							<option value="160" <?php if($R01_Country == "160" ){echo "selected";}?> >グアム</option>
							<option value="161" <?php if($R01_Country == "161" ){echo "selected";}?> >フランス領ギアナ</option>
							<option value="162" <?php if($R01_Country == "162" ){echo "selected";}?> >グアテマラ</option>
							<option value="163" <?php if($R01_Country == "163" ){echo "selected";}?> >グリーンランド</option>
							<option value="164" <?php if($R01_Country == "164" ){echo "selected";}?> >グレナダ</option>
							<option value="165" <?php if($R01_Country == "165" ){echo "selected";}?> >ギリシャ</option>
							<option value="166" <?php if($R01_Country == "166" ){echo "selected";}?> >赤道ギニア</option>
							<option value="167" <?php if($R01_Country == "167" ){echo "selected";}?> >ギニアビサウ</option>
							<option value="168" <?php if($R01_Country == "168" ){echo "selected";}?> >ガンビア</option>
							<option value="169" <?php if($R01_Country == "169" ){echo "selected";}?> >グアドループ</option>
							<option value="170" <?php if($R01_Country == "170" ){echo "selected";}?> >ギニア</option>
							<option value="171" <?php if($R01_Country == "171" ){echo "selected";}?> >ジブラルタル</option>
							<option value="172" <?php if($R01_Country == "172" ){echo "selected";}?> >ガーナ</option>
							<option value="173" <?php if($R01_Country == "173" ){echo "selected";}?> >ガーンジー</option>
							<option value="174" <?php if($R01_Country == "174" ){echo "selected";}?> >グルジア</option>
							<option value="175" <?php if($R01_Country == "175" ){echo "selected";}?> >イギリス</option>
							<option value="176" <?php if($R01_Country == "176" ){echo "selected";}?> >ガボン</option>
							<option value="177" <?php if($R01_Country == "177" ){echo "selected";}?> >ミクロネシア連邦</option>
							<option value="178" <?php if($R01_Country == "178" ){echo "selected";}?> >フェロー諸島</option>
							<option value="179" <?php if($R01_Country == "179" ){echo "selected";}?> >フランス</option>
							<option value="180" <?php if($R01_Country == "180" ){echo "selected";}?> >フォークランド諸島</option>
							<option value="181" <?php if($R01_Country == "181" ){echo "selected";}?> >フィジー</option>
							<option value="182" <?php if($R01_Country == "182" ){echo "selected";}?> >フィンランド</option>
							<option value="183" <?php if($R01_Country == "183" ){echo "selected";}?> >エチオピア</option>
							<option value="184" <?php if($R01_Country == "184" ){echo "selected";}?> >エストニア</option>
							<option value="185" <?php if($R01_Country == "185" ){echo "selected";}?> >スペイン</option>
							<option value="186" <?php if($R01_Country == "186" ){echo "selected";}?> >西サハラ</option>
							<option value="187" <?php if($R01_Country == "187" ){echo "selected";}?> >エリトリア</option>
							<option value="188" <?php if($R01_Country == "188" ){echo "selected";}?> >エジプト</option>
							<option value="189" <?php if($R01_Country == "189" ){echo "selected";}?> >エクアドル</option>
							<option value="190" <?php if($R01_Country == "190" ){echo "selected";}?> >アルジェリア</option>
							<option value="191" <?php if($R01_Country == "191" ){echo "selected";}?> >ドミニカ共和国</option>
							<option value="192" <?php if($R01_Country == "192" ){echo "selected";}?> >デンマーク</option>
							<option value="193" <?php if($R01_Country == "193" ){echo "selected";}?> >ドミニカ国</option>
							<option value="194" <?php if($R01_Country == "194" ){echo "selected";}?> >ジブチ</option>
							<option value="195" <?php if($R01_Country == "195" ){echo "selected";}?> >ドイツ</option>
							<option value="196" <?php if($R01_Country == "196" ){echo "selected";}?> >チェコ</option>
							<option value="197" <?php if($R01_Country == "197" ){echo "selected";}?> >キプロス</option>
							<option value="198" <?php if($R01_Country == "198" ){echo "selected";}?> >ケイマン諸島</option>
							<option value="199" <?php if($R01_Country == "199" ){echo "selected";}?> >クリスマス島</option>
							<option value="200" <?php if($R01_Country == "200" ){echo "selected";}?> >キュラソー</option>
							<option value="201" <?php if($R01_Country == "201" ){echo "selected";}?> >キューバ</option>
							<option value="202" <?php if($R01_Country == "202" ){echo "selected";}?> >コスタリカ</option>
							<option value="203" <?php if($R01_Country == "203" ){echo "selected";}?> >カーボベルデ</option>
							<option value="204" <?php if($R01_Country == "204" ){echo "selected";}?> >コモロ</option>
							<option value="205" <?php if($R01_Country == "205" ){echo "selected";}?> >コロンビア</option>
							<option value="206" <?php if($R01_Country == "206" ){echo "selected";}?> >クック諸島</option>
							<option value="207" <?php if($R01_Country == "207" ){echo "selected";}?> >コンゴ共和国</option>
							<option value="208" <?php if($R01_Country == "208" ){echo "selected";}?> >コンゴ民主共和国</option>
							<option value="209" <?php if($R01_Country == "209" ){echo "selected";}?> >カメルーン</option>
							<option value="210" <?php if($R01_Country == "210" ){echo "selected";}?> >コートジボワール</option>
							<option value="211" <?php if($R01_Country == "211" ){echo "selected";}?> >中国</option>
							<option value="212" <?php if($R01_Country == "212" ){echo "selected";}?> >チリ</option>
							<option value="213" <?php if($R01_Country == "213" ){echo "selected";}?> >スイス</option>
							<option value="214" <?php if($R01_Country == "214" ){echo "selected";}?> >コンゴ民主共和国</option>
							<option value="215" <?php if($R01_Country == "215" ){echo "selected";}?> >ココス諸島</option>
							<option value="216" <?php if($R01_Country == "216" ){echo "selected";}?> >カナダ</option>
							<option value="217" <?php if($R01_Country == "217" ){echo "selected";}?> >中央アフリカ</option>
							<option value="218" <?php if($R01_Country == "218" ){echo "selected";}?> >ボツワナ</option>
							<option value="219" <?php if($R01_Country == "219" ){echo "selected";}?> >ブーベ島</option>
							<option value="220" <?php if($R01_Country == "220" ){echo "selected";}?> >ブータン</option>
							<option value="221" <?php if($R01_Country == "221" ){echo "selected";}?> >ブルネイ</option>
							<option value="222" <?php if($R01_Country == "222" ){echo "selected";}?> >バルバドス</option>
							<option value="223" <?php if($R01_Country == "223" ){echo "selected";}?> >ブラジル</option>
							<option value="224" <?php if($R01_Country == "224" ){echo "selected";}?> >ボリビア</option>
							<option value="225" <?php if($R01_Country == "225" ){echo "selected";}?> >バミューダ諸島</option>
							<option value="226" <?php if($R01_Country == "226" ){echo "selected";}?> >ベリーズ</option>
							<option value="227" <?php if($R01_Country == "227" ){echo "selected";}?> >ベラルーシ</option>
							<option value="228" <?php if($R01_Country == "228" ){echo "selected";}?> >サン・バルテルミー島</option>
							<option value="229" <?php if($R01_Country == "229" ){echo "selected";}?> >ボスニア・ヘルツェゴビナ</option>
							<option value="230" <?php if($R01_Country == "230" ){echo "selected";}?> >バハマ</option>
							<option value="231" <?php if($R01_Country == "231" ){echo "selected";}?> >バーレーン</option>
							<option value="232" <?php if($R01_Country == "232" ){echo "selected";}?> >ブルガリア</option>
							<option value="233" <?php if($R01_Country == "233" ){echo "selected";}?> >バングラデシュ</option>
							<option value="234" <?php if($R01_Country == "234" ){echo "selected";}?> >ブルキナファソ</option>
							<option value="235" <?php if($R01_Country == "235" ){echo "selected";}?> >ボネール、シント・ユースタティウス,サバ</option>
							<option value="236" <?php if($R01_Country == "236" ){echo "selected";}?> >ベナン</option>
							<option value="237" <?php if($R01_Country == "237" ){echo "selected";}?> >ベルギー</option>
							<option value="238" <?php if($R01_Country == "238" ){echo "selected";}?> >ブルンジ</option>
							<option value="239" <?php if($R01_Country == "239" ){echo "selected";}?> >アゼルバイジャン</option>
							<option value="240" <?php if($R01_Country == "240" ){echo "selected";}?> >オーストリア</option>
							<option value="241" <?php if($R01_Country == "241" ){echo "selected";}?> >オーストラリア</option>
							<option value="242" <?php if($R01_Country == "242" ){echo "selected";}?> >アンティグア・バーブーダ</option>
							<option value="243" <?php if($R01_Country == "243" ){echo "selected";}?> >フランス領南方・南極地域</option>
							<option value="244" <?php if($R01_Country == "244" ){echo "selected";}?> >南極</option>
							<option value="245" <?php if($R01_Country == "245" ){echo "selected";}?> >アメリカ領サモア</option>
							<option value="246" <?php if($R01_Country == "246" ){echo "selected";}?> >アルメニア</option>
							<option value="247" <?php if($R01_Country == "247" ){echo "selected";}?> >アルゼンチン</option>
							<option value="248" <?php if($R01_Country == "248" ){echo "selected";}?> >アラブ首長国連邦</option>
							<option value="249" <?php if($R01_Country == "249" ){echo "selected";}?> >オランダ領アンティル</option>
							<option value="250" <?php if($R01_Country == "250" ){echo "selected";}?> >アンドラ</option>
							<option value="251" <?php if($R01_Country == "251" ){echo "selected";}?> >アルバニア</option>
							<option value="252" <?php if($R01_Country == "252" ){echo "selected";}?> >オーランド諸島</option>
							<option value="253" <?php if($R01_Country == "253" ){echo "selected";}?> >アンギラ</option>
							<option value="254" <?php if($R01_Country == "254" ){echo "selected";}?> >アンゴラ</option>
							<option value="255" <?php if($R01_Country == "255" ){echo "selected";}?> >アフガニスタン</option>
							<option value="256" <?php if($R01_Country == "256" ){echo "selected";}?> >アルバ</option>
						</select> 
					</td>
				</tr>
			</tbody>
			</table>
				
			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">ご自宅住所・電話番号</div></th>
				</tr>
				<tr>
					<th style="width: 30%;">郵便番号</th>
					<td>
						<input type="text" name="R01_Prin_Postal_1" id="R01_Prin_Postal_1" maxlength="3" size="4" value="<?php if (isset($R01_Prin_Postal_1)){ echo $R01_Prin_Postal_1; }?>" /> -
						<input type="text" name="R01_Prin_Postal_2" id="R01_Prin_Postal_2" maxlength="4" size="5" value="<?php if (isset($R01_Prin_Postal_2)){ echo $R01_Prin_Postal_2; }?>" /> &nbsp;&nbsp;
						<input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('R01_Prin_Postal_1','R01_Prin_Postal_2','R01_Prin_Prefectures','R01_Prin_City');"/><br>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;">都道府県</th>
					<td>
						<select name="R01_Prin_Prefectures" id="R01_Prin_Prefectures">
							<option value="" <?php if($R01_Prin_Prefectures == "" ){echo "selected";}?> >選択してください</option>
							<option value="1" <?php if($R01_Prin_Prefectures == 1 ){echo "selected";}?> >北海道</option>
							<option value="2" <?php if($R01_Prin_Prefectures == 2 ){echo "selected";}?> >青森県</option>
							<option value="3" <?php if($R01_Prin_Prefectures == 3 ){echo "selected";}?> >岩手県</option>
							<option value="4" <?php if($R01_Prin_Prefectures == 4 ){echo "selected";}?> >宮城県</option>
							<option value="5" <?php if($R01_Prin_Prefectures == 5 ){echo "selected";}?> >秋田県</option>
							<option value="6" <?php if($R01_Prin_Prefectures == 6 ){echo "selected";}?> >山形県</option>
							<option value="7" <?php if($R01_Prin_Prefectures == 7 ){echo "selected";}?> >福島県</option>
							<option value="8" <?php if($R01_Prin_Prefectures == 8 ){echo "selected";}?> >茨城県</option>
							<option value="9" <?php if($R01_Prin_Prefectures == 9 ){echo "selected";}?> >栃木県</option>
							<option value="10" <?php if($R01_Prin_Prefectures == 10 ){echo "selected";}?> >群馬県</option>
							<option value="11" <?php if($R01_Prin_Prefectures == 11 ){echo "selected";}?> >埼玉県</option>
							<option value="12" <?php if($R01_Prin_Prefectures == 12 ){echo "selected";}?> >千葉県</option>
							<option value="13" <?php if($R01_Prin_Prefectures == 13 ){echo "selected";}?> >東京都</option>
							<option value="14" <?php if($R01_Prin_Prefectures == 14 ){echo "selected";}?> >神奈川県</option>
							<option value="15" <?php if($R01_Prin_Prefectures == 15 ){echo "selected";}?> >新潟県</option>
							<option value="16" <?php if($R01_Prin_Prefectures == 16 ){echo "selected";}?> >富山県</option>
							<option value="17" <?php if($R01_Prin_Prefectures == 17 ){echo "selected";}?> >石川県</option>
							<option value="18" <?php if($R01_Prin_Prefectures == 18 ){echo "selected";}?> >福井県</option>
							<option value="19" <?php if($R01_Prin_Prefectures == 19 ){echo "selected";}?> >山梨県</option>
							<option value="20" <?php if($R01_Prin_Prefectures == 20 ){echo "selected";}?> >長野県</option>
							<option value="21" <?php if($R01_Prin_Prefectures == 21 ){echo "selected";}?> >岐阜県</option>
							<option value="22" <?php if($R01_Prin_Prefectures == 22 ){echo "selected";}?> >静岡県</option>
							<option value="23" <?php if($R01_Prin_Prefectures == 23 ){echo "selected";}?> >愛知県</option>
							<option value="24" <?php if($R01_Prin_Prefectures == 24 ){echo "selected";}?> >三重県</option>
							<option value="25" <?php if($R01_Prin_Prefectures == 25 ){echo "selected";}?> >滋賀県</option>
							<option value="26" <?php if($R01_Prin_Prefectures == 26 ){echo "selected";}?> >京都府</option>
							<option value="27" <?php if($R01_Prin_Prefectures == 27 ){echo "selected";}?> >大阪府</option>
							<option value="28" <?php if($R01_Prin_Prefectures == 28 ){echo "selected";}?> >兵庫県</option>
							<option value="29" <?php if($R01_Prin_Prefectures == 29 ){echo "selected";}?> >奈良県</option>
							<option value="30" <?php if($R01_Prin_Prefectures == 30 ){echo "selected";}?> >和歌山県</option>
							<option value="31" <?php if($R01_Prin_Prefectures == 31 ){echo "selected";}?> >鳥取県</option>
							<option value="32" <?php if($R01_Prin_Prefectures == 32 ){echo "selected";}?> >島根県</option>
							<option value="33" <?php if($R01_Prin_Prefectures == 33 ){echo "selected";}?> >岡山県</option>
							<option value="34" <?php if($R01_Prin_Prefectures == 34 ){echo "selected";}?> >広島県</option>
							<option value="35" <?php if($R01_Prin_Prefectures == 35 ){echo "selected";}?> >山口県</option>
							<option value="36" <?php if($R01_Prin_Prefectures == 36 ){echo "selected";}?> >徳島県</option>
							<option value="37" <?php if($R01_Prin_Prefectures == 37 ){echo "selected";}?> >香川県</option>
							<option value="38" <?php if($R01_Prin_Prefectures == 38 ){echo "selected";}?> >愛媛県</option>
							<option value="39" <?php if($R01_Prin_Prefectures == 39 ){echo "selected";}?> >高知県</option>
							<option value="40" <?php if($R01_Prin_Prefectures == 40 ){echo "selected";}?> >福岡県</option>
							<option value="41" <?php if($R01_Prin_Prefectures == 41 ){echo "selected";}?> >佐賀県</option>
							<option value="42" <?php if($R01_Prin_Prefectures == 42 ){echo "selected";}?> >長崎県</option>
							<option value="43" <?php if($R01_Prin_Prefectures == 43 ){echo "selected";}?> >熊本県</option>
							<option value="44" <?php if($R01_Prin_Prefectures == 44 ){echo "selected";}?> >大分県</option>
							<option value="45" <?php if($R01_Prin_Prefectures == 45 ){echo "selected";}?> >宮崎県</option>
							<option value="46" <?php if($R01_Prin_Prefectures == 46 ){echo "selected";}?> >鹿児島県</option>
							<option value="47" <?php if($R01_Prin_Prefectures == 47 ){echo "selected";}?> >沖縄県</option>
							<option value="99" <?php if($R01_Prin_Prefectures == 99 ){echo "selected";}?> >海外</option>
						</select> 
					</td>
				</tr>
				<tr>
					<th style="width: 30%;">市区郡</td>
					<td>
						<input type="text" name="R01_Prin_City" id="R01_Prin_City" maxlength="100" size="30" value="<?php if (isset($R01_Prin_City)){ echo htmlentities($R01_Prin_City,ENT_QUOTES, "UTF-8"); }?>" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;">町村～番地</th>
					<td>
						<input type="text" name="R01_Prin_Towns_Villages" id="R01_Prin_Towns_Villages" maxlength="100" size="30" value="<?php if (isset($R01_Prin_Towns_Villages)){ echo htmlentities($R01_Prin_Towns_Villages,ENT_QUOTES, "UTF-8"); }?>" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;">ビル・マンション名</th>
					<td>
						<input type="text" name="R01_Prin_Building_Name" id="R01_Prin_Building_Name" maxlength="100" size="30" value="<?php if (isset($R01_Prin_Building_Name)){ echo htmlentities($R01_Prin_Building_Name,ENT_QUOTES, "UTF-8"); }?>" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >電話番号(半角入力）</th>
					<td>
						<input type="text" name="R01_Prin_Phone1" id="R01_Prin_Phone1" value="<?php echo $R01_Prin_Phone1;?>" size="5" maxlength="5" /> - 
						<input type="text" name="R01_Prin_Phone2" id="R01_Prin_Phone2" value="<?php echo $R01_Prin_Phone2;?>" size="4" maxlength="4" /> - 
						<input type="text" name="R01_Prin_Phone3" id="R01_Prin_Phone3" value="<?php echo $R01_Prin_Phone3;?>" size="4" maxlength="4" />
					</td>
				</tr>
			</tbody>
			</table>
			
			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">勤務先情報</th><div></tr>
				</tr>
				<tr>
					<th style="width: 30%;" >会社名</th>
					<td>
						<input type="text" name="R01_Emp_Company_Name" id="R01_Emp_Company_Name" size="30" value="<?php if (isset($R01_Emp_Company_Name)){ echo htmlentities($R01_Emp_Company_Name,ENT_QUOTES, "UTF-8"); }?>"/>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >会社名(英語)</th>
					<td>
						<input type="text" name="R01_Emp_Company_Name_En" id="R01_Emp_Company_Name_En" size="30" value="<?php if (isset($R01_Emp_Company_Name_En)){ echo htmlentities($R01_Emp_Company_Name_En,ENT_QUOTES, "UTF-8"); }?>"/>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >所属部署名</th>
					<td>
						<input type="text" name="R01_Emp_Affiliation" id="R01_Emp_Affiliation" value="<?php if (isset($R01_Emp_Affiliation)){ echo htmlentities($R01_Emp_Affiliation,ENT_QUOTES, "UTF-8"); }?>"/>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >所属部署名（英文）</th>
					<td>
						<input type="text" name="R01_Emp_Affiliation_En" id="R01_Emp_Affiliation_En" value="<?php echo htmlentities($R01_Emp_Affiliation_En,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >役職</th>
					<td>
						<input type="text" name="R01_Emp_Position" id="R01_Emp_Position" value="<?php echo htmlentities($R01_Emp_Position,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>	
				</tr>
				<tr>
					<th style="width: 30%;" >役職（英文）</th>
					<td>
						<input type="text" name="R01_Emp_Position_En" id="R01_Emp_Position_En" value="<?php echo htmlentities($R01_Emp_Position_En,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >郵便番号</th>
					<td>
						<input type="text" name="R01_Emp_Postal_1" id="R01_Emp_Postal_1" value="<?php echo $R01_Emp_Postal_1;?>" size="3" maxlength="3" /> - 
						<input type="text" name="R01_Emp_Postal_2" id="R01_Emp_Postal_2" value="<?php echo $R01_Emp_Postal_2;?>" size="4" maxlength="4" /> &nbsp;&nbsp; 
						<input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('R01_Emp_Postal_1','R01_Emp_Postal_2','R01_Emp_Prefectures','R01_Emp_City');"/>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >都道府県</th>
					<td>
						<select name="R01_Emp_Prefectures" id="R01_Emp_Prefectures">	
							<option value="" <?php if($R01_Prin_Prefectures == "" ){echo "selected";}?> >選択してください</option>
							<option value="1" <?php if($R01_Emp_Prefectures == 1 ){echo "selected";}?> >北海道</option>
							<option value="2" <?php if($R01_Emp_Prefectures == 2 ){echo "selected";}?> >青森県</option>
							<option value="3" <?php if($R01_Emp_Prefectures == 3 ){echo "selected";}?> >岩手県</option>
							<option value="4" <?php if($R01_Emp_Prefectures == 4 ){echo "selected";}?> >宮城県</option>
							<option value="5" <?php if($R01_Emp_Prefectures == 5 ){echo "selected";}?> >秋田県</option>
							<option value="6" <?php if($R01_Emp_Prefectures == 6 ){echo "selected";}?> >山形県</option>
							<option value="7" <?php if($R01_Emp_Prefectures == 7 ){echo "selected";}?> >福島県</option>
							<option value="8" <?php if($R01_Emp_Prefectures == 8 ){echo "selected";}?> >茨城県</option>
							<option value="9" <?php if($R01_Emp_Prefectures == 9 ){echo "selected";}?> >栃木県</option>
							<option value="10" <?php if($R01_Emp_Prefectures == 10 ){echo "selected";}?> >群馬県</option>
							<option value="11" <?php if($R01_Emp_Prefectures == 11 ){echo "selected";}?> >埼玉県</option>
							<option value="12" <?php if($R01_Emp_Prefectures == 12 ){echo "selected";}?> >千葉県</option>
							<option value="13" <?php if($R01_Emp_Prefectures == 13 ){echo "selected";}?> >東京都</option>
							<option value="14" <?php if($R01_Emp_Prefectures == 14 ){echo "selected";}?> >神奈川県</option>
							<option value="15" <?php if($R01_Emp_Prefectures == 15 ){echo "selected";}?> >新潟県</option>
							<option value="16" <?php if($R01_Emp_Prefectures == 16 ){echo "selected";}?> >富山県</option>
							<option value="17" <?php if($R01_Emp_Prefectures == 17 ){echo "selected";}?> >石川県</option>
							<option value="18" <?php if($R01_Emp_Prefectures == 18 ){echo "selected";}?> >福井県</option>
							<option value="19" <?php if($R01_Emp_Prefectures == 19 ){echo "selected";}?> >山梨県</option>
							<option value="20" <?php if($R01_Emp_Prefectures == 20 ){echo "selected";}?> >長野県</option>
							<option value="21" <?php if($R01_Emp_Prefectures == 21 ){echo "selected";}?> >岐阜県</option>
							<option value="22" <?php if($R01_Emp_Prefectures == 22 ){echo "selected";}?> >静岡県</option>
							<option value="23" <?php if($R01_Emp_Prefectures == 23 ){echo "selected";}?> >愛知県</option>
							<option value="24" <?php if($R01_Emp_Prefectures == 24 ){echo "selected";}?> >三重県</option>
							<option value="25" <?php if($R01_Emp_Prefectures == 25 ){echo "selected";}?> >滋賀県</option>
							<option value="26" <?php if($R01_Emp_Prefectures == 26 ){echo "selected";}?> >京都府</option>
							<option value="27" <?php if($R01_Emp_Prefectures == 27 ){echo "selected";}?> >大阪府</option>
							<option value="28" <?php if($R01_Emp_Prefectures == 28 ){echo "selected";}?> >兵庫県</option>
							<option value="29" <?php if($R01_Emp_Prefectures == 29 ){echo "selected";}?> >奈良県</option>
							<option value="30" <?php if($R01_Emp_Prefectures == 30 ){echo "selected";}?> >和歌山県</option>
							<option value="31" <?php if($R01_Emp_Prefectures == 31 ){echo "selected";}?> >鳥取県</option>
							<option value="32" <?php if($R01_Emp_Prefectures == 32 ){echo "selected";}?> >島根県</option>
							<option value="33" <?php if($R01_Emp_Prefectures == 33 ){echo "selected";}?> >岡山県</option>
							<option value="34" <?php if($R01_Emp_Prefectures == 34 ){echo "selected";}?> >広島県</option>
							<option value="35" <?php if($R01_Emp_Prefectures == 35 ){echo "selected";}?> >山口県</option>
							<option value="36" <?php if($R01_Emp_Prefectures == 36 ){echo "selected";}?> >徳島県</option>
							<option value="37" <?php if($R01_Emp_Prefectures == 37 ){echo "selected";}?> >香川県</option>
							<option value="38" <?php if($R01_Emp_Prefectures == 38 ){echo "selected";}?> >愛媛県</option>
							<option value="39" <?php if($R01_Emp_Prefectures == 39 ){echo "selected";}?> >高知県</option>
							<option value="40" <?php if($R01_Emp_Prefectures == 40 ){echo "selected";}?> >福岡県</option>
							<option value="41" <?php if($R01_Emp_Prefectures == 41 ){echo "selected";}?> >佐賀県</option>
							<option value="42" <?php if($R01_Emp_Prefectures == 42 ){echo "selected";}?> >長崎県</option>
							<option value="43" <?php if($R01_Emp_Prefectures == 43 ){echo "selected";}?> >熊本県</option>
							<option value="44" <?php if($R01_Emp_Prefectures == 44 ){echo "selected";}?> >大分県</option>
							<option value="45" <?php if($R01_Emp_Prefectures == 45 ){echo "selected";}?> >宮崎県</option>
							<option value="46" <?php if($R01_Emp_Prefectures == 46 ){echo "selected";}?> >鹿児島県</option>
							<option value="47" <?php if($R01_Emp_Prefectures == 47 ){echo "selected";}?> >沖縄県</option>
							<option value="99" <?php if($R01_Emp_Prefectures == 99 ){echo "selected";}?> >海外</option>
						</select>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >市区郡</th>
					<td>
						<input type="text" name="R01_Emp_City" id="R01_Emp_City" value="<?php echo htmlentities($R01_Emp_City,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >町村～番地</th>
					<td>
						<input type="text" name="R01_Emp_Towns_Villages" id="R01_Emp_Towns_Villages" value="<?php echo htmlentities($R01_Emp_Towns_Villages,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >ビル・マンション名</th>
					<td>
						<input type="text" name="R01_Emp_Building_Name" id="R01_Emp_Building_Name" value="<?php echo htmlentities($R01_Emp_Building_Name,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >会社電話番号</th>
					<td>
						<input type="text" name="R01_Emp_Phone1" id="R01_Emp_Phone1" value="<?php echo $R01_Emp_Phone1;?>" size="5" maxlength="5" /> - 
						<input type="text" name="R01_Emp_Phone2" id="R01_Emp_Phone2" value="<?php echo $R01_Emp_Phone2;?>" size="4" maxlength="4" /> - 
						<input type="text" name="R01_Emp_Phone3" id="R01_Emp_Phone3" value="<?php echo $R01_Emp_Phone3;?>" size="4" maxlength="4" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >会社WEBサイトURL</th>
					<td>
						<input type="text" name="R01_Emp_Web_Url" id="R01_Emp_Web_Url" value="<?php echo htmlentities($R01_Emp_Web_Url,ENT_QUOTES, "UTF-8");?>" size="55" maxlength="55" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >マイクロソフト営業担当者名</th>
					<td>
						<input type="text" name="R01_Emp_Micro_Sales_Name" id="R01_Emp_Micro_Sales_Name" value="<?php echo htmlentities($R01_Emp_Micro_Sales_Name,ENT_QUOTES, "UTF-8");?>" size="55" maxlength="55" />
					</td>
				</tr>		
			</tbody>
			</table>

			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div  align ="center">パスポート／eTA情報</div></th>
				</tr>
				<tr>
					<th style="width: 30%;" >パスポート番号(半角英数）</th>
					<td>
						<input type="text" name="R01_Passport_Number" id="R01_Passport_Number" value="<?php echo $R01_Passport_Number;?>" size="30" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >パスポート有効期限(半角英数）</th>
					<td>
						<select name="R01_Passport_Exp_Year" id="R01_Passport_Exp_Year">	
							<option value="">年</option>
							<?php for($year=2016; $year<2027; $year++ ){?>
								<option value="<?php echo $year;?>" <?php if($R01_Passport_Exp_Year==$year ){echo "selected";}?> > <?php echo $year;?>年</option>
							<?php }?>
						</select>
						<select name="R01_Passport_Exp_Month" id="R01_Passport_Exp_Month">	
							<option value="">月</option>
							<?php for($month=1; $month<13; $month++ ){?>
								<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>" <?php if($R01_Passport_Exp_Month==str_pad($month,2,'0',STR_PAD_LEFT) ){echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>月</option>
							<?php }?>
						</select>
						<select name="R01_Passport_Exp_Date" id="R01_Passport_Exp_Date">	
							<option value="">日</option>
							<?php for($day=1; $day<32; $day++ ){?>
								<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>" <?php if($R01_Passport_Exp_Date==str_pad($day,2,'0',STR_PAD_LEFT) ){echo "selected";}?> > <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>日</option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >eTA取得日(半角英数）</th>
					<td>
						<select name="R01_Passport_Issue_Year" id="R01_Passport_Issue_Year"><option value="2016" selected>2016年</option>
						<?php for($year=2015; $year<=2015; $year++ ){?>
							<option value="<?php echo $year;?>" <?php if($R01_Passport_Issue_Year==$year ){echo "selected";}?> > <?php echo $year;?>年</option>
						<?php }?>
						</select>
						<select name="R01_Passport_Issue_Month" id="R01_Passport_Issue_Month">	<option value="">月</option>
						<?php for($month=1; $month<13; $month++ ){?>
							<option value="<?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>" <?php if($R01_Passport_Issue_Month==str_pad($month,2,'0',STR_PAD_LEFT) ){echo "selected";}?> > <?php echo str_pad($month,2,'0',STR_PAD_LEFT);?>月</option>
						<?php }?>
						</select>
						<select name="R01_Passport_Issue_Date" id="R01_Passport_Issue_Date">	<option value="">日</option>
							<?php for($day=1; $day<32; $day++ ){?>
								<option value="<?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>" <?php if($R01_Passport_Issue_Date==str_pad($day,2,'0',STR_PAD_LEFT) ){echo "selected";}?> > <?php echo str_pad($day,2,'0',STR_PAD_LEFT);?>日</option>
							<?php }?>
						</select>
					</td>
				</tr>
			</tbody>
			</table>
			
			<table id="form" width="100%">
			<tbody>
				<tr>
				<th colspan="2"><div align="center">パスポート画像のアップロード</div></th>
				</tr>
				<tr>
					<td>パスポートの顔写真のページの画像キャプチャをアップロードしてください。</br>
						<br>
						<?php
						//if(isset($data['R01_Passport_upload']))
						if(($R01_Passport_upload!= NULL) && ($R01_Passport_upload != "")) {
							$color="#33BFDB";
							$value = "再アップロード"
						?>
							<p style="display:block;font-size:15px;font-weight:bold !important"  id = "org_img">アップロード済みです。</p>
							<p style="display:none;"id="link">画像アップロード</p>
							<p style="display:block;font-size :15px"id="link1">
							<a href="#" onclick="getImage('<?php echo $R01_Reservation_No; ?>')" >アップロード済画像の確認</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" name="remove_img" id="remove_img" value="画像削除" onclick="removePhoto('<?php echo $R01_Reservation_No; ?>');"></input>
							</p>
						<?php
						} else {
							$color="red";
							$value = "アップロード"
						?>	
							<p style="display:none;font-size:15px;"  id = "org_img">アップロード済みです。</p>
							<p style="display:none;font-weight:bold"id="link">画像アップロード</p>
							<p style="display:none;font-size :15px"id="link1">
							<a href="#" onclick="getImage('<?php echo $R01_Reservation_No; ?>')" >アップロード済画像の確認</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" name="remove_img" id="remove_img" value="画像削除" onclick="removePhoto('<?php echo $R01_Reservation_No; ?>');"></input>
							</p>
						<?php
						}
						?>
							<p style = "font-size:15px;font-weight:bold !important" id = "name2"></p>
							<p style="font-size :15px; display: none;" id="name">
							<a href="#" onclick="getImage('<?php echo $R01_Reservation_No; ?>')" >アップロード済画像の確認</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" name="remove_img" id="remove_img" value="画像削除" onclick="removePhoto('<?php echo $R01_Reservation_No; ?>');"></input>
							</p>
							<input type="file" name ="R01_Passport_upload" id = "R01_Passport_upload"/><br><br>
							
							<input type="button" name="uploadclick" id="uploadclick" style="background:<?php echo $color;?>;" value="<?php echo $value;?>" onclick="savePhoto();"></input>
							<br><br>
							<input type="hidden" name="R01_Passport_upload_Name" id="R01_Passport_upload_Name" value="<?php echo htmlentities($R01_Passport_upload,ENT_QUOTES, "UTF-8"); ?>" />
							最大アップロードサイズ：10MB</br>
							
							アップロード可能なファイルタイプ（jpeg,pdf,gif,png）
					</td>
				</tr>
			</tbody>
			</table>
			
			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">緊急連絡先</center></th>
				</tr>
				<tr>
					<th style="width: 30%;">緊急連絡先　お名前</th>
					<td>
						<input type="text" name="R01_Emer_Contact_Name" id="R01_Emer_Contact_Name" value="<?php echo htmlentities($R01_Emer_Contact_Name,ENT_QUOTES, "UTF-8");?>" size="30" />
				 	</td>
				</tr>
				<tr>
					<th style="width: 30%;" >続柄</th>
					<td>
						<input type="text" name="R01_Emer_Relationship" id="R01_Emer_Relationship" value="<?php echo htmlentities($R01_Emer_Relationship,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >電話番号(半角数字）</th>
					<td>
						<input type="text" name="R01_Emer_Phone1" id="R01_Emer_Phone1" value="<?php echo $R01_Emer_Phone1;?>" size="5" maxlength="5" /> - 
						<input type="text" name="R01_Emer_Phone2" id="R01_Emer_Phone2" value="<?php echo $R01_Emer_Phone2;?>" size="4" maxlength="4" /> - 
						<input type="text" name="R01_Emer_Phone3" id="R01_Emer_Phone3" value="<?php echo $R01_Emer_Phone3;?>" size="4" maxlength="4" />
					</td>
				</tr>
			</tbody>
			</table>
			
			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">E-mailアドレス</div></th>
				</tr>
				<tr>
					<th style="width: 30%;" >メール(半角)</th>
					<td>
						<input type="text" name="R01_Email" id="R01_Email" size="30" value="<?php if (isset($R01_Email)){ echo htmlentities($R01_Email,ENT_QUOTES, "UTF-8"); }?>" />
					</td>
				</tr>
			</tbody>
			</table>
			
			<!--<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">海外旅行保険について</center></th>
				</tr>
				<tr>
					<th style="width: 30%;" >海外旅行保険</th>
					<td>
						<select name="R01_Overseas_Insurance" id="R01_Overseas_Insurance">
							<option value="0" <?php if($R01_Overseas_Insurance == "0"){echo "selected";}?> /><label for="tmp_24">H.I.S.にて海外旅行保険に加入する</label><br>
							<option value="1" <?php if($R01_Overseas_Insurance == "1"){echo "selected";}?> /><label for="tmp_25">既に他社で加入している（これから加入する）</label><br>
							<option value="2" <?php if($R01_Overseas_Insurance == "2"){echo "selected";}?> /><label for="tmp_26">今回は加入しない</label>
						</select>
					</td>
				</tr>
			</tbody>
			</table>-->
			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">生活習慣について</center></th>
				</tr>
				<tr>
					<th style="width: 30%;" >喫煙(たばこ)の習慣</th>
					<td>
						<input type="radio" name="R01_tabaco" id="R01_tabaco0" value="0" <?php if($R01_tabaco == "0"){echo "checked";}?> ><label for="tmp_2">喫煙</label>&nbsp; &nbsp;
						<input type="radio" name="R01_tabaco" id="R01_tabaco1" value="1" <?php if($R01_tabaco == "1"){echo "checked";}?> ><label for="tmp_3">禁煙</label>&nbsp; &nbsp;
						<input type="radio" name="R01_tabaco" id="R01_tabaco2" value="2" <?php if($R01_tabaco == "2"){echo "checked";}?> ><label for="tmp_4">どちらでもよい</label></span></td>
					</td>
				</tr>
			</tbody>
			</table>
			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">ディナー参加について</div></th>
				</tr>
				<tr>
					<th>Japan Night(11/27 夕刻予定)</th>
					<td>
						<input type="radio" name="R01_Welcome_Dinner" id="R01_Welcome_Dinner_0" value="0" <?php if($R01_Welcome_Dinner == 0){echo "checked";}?> /><label for="R01_Welcome_Dinner_0">参加</label> 
						<input type="radio" name="R01_Welcome_Dinner" id="R01_Welcome_Dinner_1" value="1" <?php if($R01_Welcome_Dinner ==1){echo "checked";}?> /><label for="R01_Welcome_Dinner_1">欠席</label>
					</td>
				</tr>
				
			</tbody>
			</table>
			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">渡航手続き</div></th>
				</tr>
				<tr>
					<th>渡航手続き代行希望</th>
					<td>
						<input type="radio" name="R01_toko" id="R01_toko_0" value="0" <?php if($R01_toko == 0){echo "checked";}?> /><label for="R01_tokor_0">希望しない</label> 
						<input type="radio" name="R01_toko" id="R01_toko_1" value="1" <?php if($R01_toko == 1){echo "checked";}?> /><label for="R01_toko_1">米国出入国関連書類作成+日本の税関申告書の作成代行</label>
					</td>
				</tr>
				<tr>
					<th>ESTA申請書類作成代行</th>
					<td>
						<input type="radio" name="R01_esta" id="R01_esta_0" value="0" <?php if($R01_esta == 0){echo "checked";}?> /><label for="R01_esta_0">希望しない</label> 
						<input type="radio" name="R01_esta" id="R01_esta_1" value="1" <?php if($R01_esta ==1){echo "checked";}?> /><label for="R01_esta_1">依頼する</label>
					</td>
				</tr>
			</tbody>
			</table>
			<table id="form" width="100%">
				<tr>
					<th colspan="2"><div align="center">通信欄</div></th>
				</tr>
				<tr>
					<th style="width: 30%;" >通信欄</th>
					<td>
						<textarea name="R01_Other_Memo" rows="4" cols="70"><?php echo htmlentities($R01_Other_Memo,ENT_QUOTES, "UTF-8"); ?></textarea>
					</td>
				</tr>
			</table>
			
			<table id="form" width="100%">
				<tr>
					<th colspan="2"><div align="center">お部屋について</div></th>
				<tr>
				<tr>
					<th style="width: 30%;" >部屋のご希望</th>
					<td>
						<input type="radio" name="R01_Choice_Room" id="R01_Choice_Room_0" value="0" <?php if($R01_Choice_Room == 0){echo "checked";}?> onclick="radio_choice_room_0()" />
						<label for="R01_Choice_Room_0">1名1室</label> 
						<input type="radio" name="R01_Choice_Room" id="R01_Choice_Room_1" value="1" <?php if($R01_Choice_Room == 1){echo "checked";}?> onclick="radio_choice_room_1()" />
						<label for="R01_Choice_Room_1">2名1室</label>
					</td>
				</tr>
			</table>
			
			<div id="choice_room_after" style="display: <?php 
			if (isset($R01_Choice_Room) && ($R01_Choice_Room == 1)) {
				echo "block;";
			} else {
				echo "none;";
			}
			?>" >
			<table id="form" width="100%">
				<th colspan="2"><div align="center">同室者情報</center></th>
				<tr>
					<th>会社名</th>
					<td>
						<input type="text" name="R01_Tog_Company_Name" id="R01_Tog_Company_Name" value="<?php echo htmlentities($R01_Tog_Company_Name,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th>お名前</th>
					<td>
						<input type="text" name="R01_Tog_Name" id="R01_Tog_Name" value="<?php echo htmlentities($R01_Tog_Name,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th>E-mailアドレス</th>
					<td>
						<input type="text" name="R01_Tog_Email" id="R01_Tog_Email" value="<?php echo htmlentities($R01_Tog_Email,ENT_QUOTES, "UTF-8");?>" size="40" />
					</td>
				</tr>
			</table>
			</div>
			
			<table id="form" width="100%">
			<tbody>
				<th colspan="2"><div align="center">請求書</div></th>
				<tr>
					<th style="width: 30%;">請求書について</th>
					<td>
						<input type="radio" name="R01_Invoice" id="R01_Invoice_0" value="0" <?php if($R01_Invoice == "0"){echo "checked";}?> onclick="radio_invoice_0()" /><label for="R01_Invoice_0">要</label>
						<input type="radio" name="R01_Invoice" id="R01_Invoice_1" value="1" <?php if($R01_Invoice == "1"){echo "checked";}?> onclick="radio_invoice_1()" /><label for="R01_Invoice_1">不要</label>
						
					</td>
				</tr>
			</tbody>
			</table>
			
			<div id="invoice_after" style="display: <?php 
			if (isset($R01_Invoice) && ($R01_Invoice == "0")) {
				echo "block;";
			} else {
				echo "none;";
			}
			?>" >
			<table id="form" width="100%">
				<tr>
					<th>請求書の送付先</th>
					<td>
						<input type="radio" name="R01_Invoice_Send" id="R01_Invoice_Send_0" value="0" <?php if($R01_Invoice_Send == "0"){echo "checked";}?> onclick="radio_invoice_send_0()" /><label for="R01_Invoice_Send_0">ご自宅</label>
						<input type="radio" name="R01_Invoice_Send" id="R01_Invoice_Send_1" value="1" <?php if($R01_Invoice_Send == "1"){echo "checked";}?> onclick="radio_invoice_send_1()" /><label for="R01_Invoice_Send_1">勤務先</label>
						<input type="radio" name="R01_Invoice_Send" id="R01_Invoice_Send_2" value="2" <?php if($R01_Invoice_Send == "2"){echo "checked";}?> onclick="radio_invoice_send_2()" /><label for="R01_Invoice_Send_2">その他</label>
					</td>
				</tr>
				<tr>
					<th>ご請求書の宛名</th>
					<td>
						<input type="text" name="R01_Invoice_Addr_Name" id="R01_Invoice_Addr_Name" value="<?php echo htmlentities($R01_Invoice_Addr_Name,ENT_QUOTES, "UTF-8"); ?>" size="30" />
					</td>
				</tr>
			</table>
			</div>

			<div id="invoice_send_after" style="display: <?php 
				if ($R01_Invoice_Send == "0" || $R01_Invoice_Send == "1") {
					echo "none;";
				} else {
					echo "block;";
				}
			?>" >
			<table id="form" width="100%">
			<tbody>
				<tr>
					<th colspan="2"><div align="center">送付先について<div></th>
				</tr>
				<tr>
					<th>お名前</th>
					<td>
						<font color="#000000">姓 </font>
						<input type="text" name="R01_Invoice_Sei" id="R01_Invoice_Sei" value="<?php echo htmlentities($R01_Invoice_Sei,ENT_QUOTES, "UTF-8");?>" size="9" />
						<font color="#000000">名</font>
						<input type="text" name="R01_Invoice_Mei" id="R01_Invoice_Mei" value="<?php echo htmlentities($R01_Invoice_Mei,ENT_QUOTES, "UTF-8");?>" size="9" />
					</td>
				</tr>
				<tr>
					<th>郵便番号</th>
					<td>
						<input type="text" name="R01_Invoice_Postal_1" id="R01_Invoice_Postal_1" value="<?php echo $R01_Invoice_Postal_1;?>" size="3" maxlength="3" /> - 
						<input type="text" name="R01_Invoice_Postal_2" id="R01_Invoice_Postal_2" value="<?php echo $R01_Invoice_Postal_2;?>" size="4" maxlength="4"/> &nbsp;&nbsp;
						<input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('R01_Invoice_Postal_1','R01_Invoice_Postal_2','R01_Invoice_Prefectures','R01_Invoice_City');"/>
					</td>
				</tr>
				<tr>
					<th>都道府県</th>
					<td>
						<select name="R01_Invoice_Prefectures" id="R01_Invoice_Prefectures">	
							<option value="" <?php if($R01_Invoice_Prefectures == '' ){echo "selected";}?> >選択してください</option>
							<option value="1" <?php if($R01_Invoice_Prefectures == 1 ){echo "selected";}?> >北海道</option>
							<option value="2" <?php if($R01_Invoice_Prefectures == 2 ){echo "selected";}?> >青森県</option>
							<option value="3" <?php if($R01_Invoice_Prefectures == 3 ){echo "selected";}?> >岩手県</option>
							<option value="4" <?php if($R01_Invoice_Prefectures == 4 ){echo "selected";}?> >宮城県</option>
							<option value="5" <?php if($R01_Invoice_Prefectures == 5 ){echo "selected";}?> >秋田県</option>
							<option value="6" <?php if($R01_Invoice_Prefectures == 6 ){echo "selected";}?> >山形県</option>
							<option value="7" <?php if($R01_Invoice_Prefectures == 7 ){echo "selected";}?> >福島県</option>
							<option value="8" <?php if($R01_Invoice_Prefectures == 8 ){echo "selected";}?> >茨城県</option>
							<option value="9" <?php if($R01_Invoice_Prefectures == 9 ){echo "selected";}?> >栃木県</option>
							<option value="10" <?php if($R01_Invoice_Prefectures == 10 ){echo "selected";}?> >群馬県</option>
							<option value="11" <?php if($R01_Invoice_Prefectures == 11 ){echo "selected";}?> >埼玉県</option>
							<option value="12" <?php if($R01_Invoice_Prefectures == 12 ){echo "selected";}?> >千葉県</option>
							<option value="13" <?php if($R01_Invoice_Prefectures == 13 ){echo "selected";}?> >東京都</option>
							<option value="14" <?php if($R01_Invoice_Prefectures == 14 ){echo "selected";}?> >神奈川県</option>
							<option value="15" <?php if($R01_Invoice_Prefectures == 15 ){echo "selected";}?> >新潟県</option>
							<option value="16" <?php if($R01_Invoice_Prefectures == 16 ){echo "selected";}?> >富山県</option>
							<option value="17" <?php if($R01_Invoice_Prefectures == 17 ){echo "selected";}?> >石川県</option>
							<option value="18" <?php if($R01_Invoice_Prefectures == 18 ){echo "selected";}?> >福井県</option>
							<option value="19" <?php if($R01_Invoice_Prefectures == 19 ){echo "selected";}?> >山梨県</option>
							<option value="20" <?php if($R01_Invoice_Prefectures == 20 ){echo "selected";}?> >長野県</option>
							<option value="21" <?php if($R01_Invoice_Prefectures == 21 ){echo "selected";}?> >岐阜県</option>
							<option value="22" <?php if($R01_Invoice_Prefectures == 22 ){echo "selected";}?> >静岡県</option>
							<option value="23" <?php if($R01_Invoice_Prefectures == 23 ){echo "selected";}?> >愛知県</option>
							<option value="24" <?php if($R01_Invoice_Prefectures == 24 ){echo "selected";}?> >三重県</option>
							<option value="25" <?php if($R01_Invoice_Prefectures == 25 ){echo "selected";}?> >滋賀県</option>
							<option value="26" <?php if($R01_Invoice_Prefectures == 26 ){echo "selected";}?> >京都府</option>
							<option value="27" <?php if($R01_Invoice_Prefectures == 27 ){echo "selected";}?> >大阪府</option>
							<option value="28" <?php if($R01_Invoice_Prefectures == 28 ){echo "selected";}?> >兵庫県</option>
							<option value="29" <?php if($R01_Invoice_Prefectures == 29 ){echo "selected";}?> >奈良県</option>
							<option value="30" <?php if($R01_Invoice_Prefectures == 30 ){echo "selected";}?> >和歌山県</option>
							<option value="31" <?php if($R01_Invoice_Prefectures == 31 ){echo "selected";}?> >鳥取県</option>
							<option value="32" <?php if($R01_Invoice_Prefectures == 32 ){echo "selected";}?> >島根県</option>
							<option value="33" <?php if($R01_Invoice_Prefectures == 33 ){echo "selected";}?> >岡山県</option>
							<option value="34" <?php if($R01_Invoice_Prefectures == 34 ){echo "selected";}?> >広島県</option>
							<option value="35" <?php if($R01_Invoice_Prefectures == 35 ){echo "selected";}?> >山口県</option>
							<option value="36" <?php if($R01_Invoice_Prefectures == 36 ){echo "selected";}?> >徳島県</option>
							<option value="37" <?php if($R01_Invoice_Prefectures == 37 ){echo "selected";}?> >香川県</option>
							<option value="38" <?php if($R01_Invoice_Prefectures == 38 ){echo "selected";}?> >愛媛県</option>
							<option value="39" <?php if($R01_Invoice_Prefectures == 39 ){echo "selected";}?> >高知県</option>
							<option value="40" <?php if($R01_Invoice_Prefectures == 40 ){echo "selected";}?> >福岡県</option>
							<option value="41" <?php if($R01_Invoice_Prefectures == 41 ){echo "selected";}?> >佐賀県</option>
							<option value="42" <?php if($R01_Invoice_Prefectures == 42 ){echo "selected";}?> >長崎県</option>
							<option value="43" <?php if($R01_Invoice_Prefectures == 43 ){echo "selected";}?> >熊本県</option>
							<option value="44" <?php if($R01_Invoice_Prefectures == 44 ){echo "selected";}?> >大分県</option>
							<option value="45" <?php if($R01_Invoice_Prefectures == 45 ){echo "selected";}?> >宮崎県</option>
							<option value="46" <?php if($R01_Invoice_Prefectures == 46 ){echo "selected";}?> >鹿児島県</option>
							<option value="47" <?php if($R01_Invoice_Prefectures == 47 ){echo "selected";}?> >沖縄県</option>
							<option value="99" <?php if($R01_Invoice_Prefectures == 99 ){echo "selected";}?> >海外</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>市区郡</th>
					<td>
						<input type="text" name="R01_Invoice_City" id="R01_Invoice_City" value="<?php echo htmlentities($R01_Invoice_City,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th>町村～番地</th>
					<td>
						<input type="text" name="R01_Invoice_Towns_Villages" id="R01_Invoice_Towns_Villages" value="<?php echo htmlentities($R01_Invoice_Towns_Villages,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th>ビル・マンション名</th>
					<td>
						<input type="text" name="R01_Invoice_Building_Name" id="R01_Invoice_Building_Name" value="<?php echo htmlentities($R01_Invoice_Building_Name,ENT_QUOTES, "UTF-8");?>" size="30" />
					</td>
				</tr>
				<tr>
					<th>電話番号</th>
					<td>
						<input type="text" name="R01_Invoice_Phone1" id="R01_Invoice_Phone1" value="<?php echo $R01_Invoice_Phone1;?>" size="5" maxlength="5" /> - 
						<input type="text" name="R01_Invoice_Phone2" id="R01_Invoice_Phone2" value="<?php echo $R01_Invoice_Phone2;?>" size="4" maxlength="4" /> - 
						<input type="text" name="R01_Invoice_Phone3" id="R01_Invoice_Phone3" value="<?php echo $R01_Invoice_Phone3;?>" size="4" maxlength="4" />
					</td>
				</tr>
			</tbody>
			</table>
			</div>

			<table id="form" width="100%">
				<tbody>
					<tr>
						<th colspan="2"><div align="center">オーガナイザ備考<div></th>
					</tr>
					<tr>
						<th style="width: 30%;" >備考1</th>
						<td>
							<textarea name="R01_Note0_1" rows="4" cols="70"><?php if (isset($R01_Note0_1)) { echo htmlentities($R01_Note0_1,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
					<tr>
						<th style="width: 30%;" >備考2</th>
						<td>
							<textarea name="R01_Note0_2" rows="4" cols="70"><?php if (isset($R01_Note0_2)) { echo htmlentities($R01_Note0_2,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
					<tr>
						<th style="width: 30%;" >備考3</th>
						<td>
							<textarea name="R01_Note0_3" rows="4" cols="70"><?php if (isset($R01_Note0_3)) { echo htmlentities($R01_Note0_3,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
			
			<table id="form" width="100%">
				<tbody>
					<tr>
						<th colspan="2"><div align="center">管理者備考<div></th>
					</tr>
					<tr>
						<th style="width: 30%;" >備考1</th>
						<td>
							<textarea name="R01_Note2_1" rows="4" cols="70"><?php if (isset($R01_Note2_1)) { echo htmlentities($R01_Note2_1,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
					<tr>
						<th style="width: 30%;" >備考2</th>
						<td>
							<textarea name="R01_Note2_2" rows="4" cols="70"><?php if (isset($R01_Note2_2)) { echo htmlentities($R01_Note2_2,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
					<tr>
						<th style="width: 30%;" >備考3</th>
						<td>
							<textarea name="R01_Note2_3" rows="4" cols="70"><?php if (isset($R01_Note2_3)) { echo htmlentities($R01_Note2_3,ENT_QUOTES, "UTF-8"); }?></textarea>
						</td>
					</tr>
				</tbody>
			</table>

			<table id="form" width="100%">
			<tbody>
				<th colspan="2"><div align="center">パスワード</div></th>
				<tr>
					<th>パスワード</th>
					<td>
						<input type="text" name="R01_password" id="R01_password" value="<?php if (isset($R01_password)){ echo htmlentities($R01_password,ENT_QUOTES, "UTF-8"); } ?>" size="30" />
					</td>
				</tr>
			</tbody>
			</table>
</div>
<!-- END TAB ENTRY SOURCE -->




<!-- START HIDDEN DATA POST -->
<div>
	<input type="hidden" name="Charger_Type" id="Charger_Type" value="<?php echo $Charger_Type; ?>" />
	<input type="hidden" name="R01_Reservation_No" id="R01_Reservation_No" value="<?php echo $R01_Reservation_No; ?>" ></input>
</div>
<!-- END HIDDEN DATA POST -->

<div>
<hr />
<p align="center" class="submit">
<input class="button button-3d" type="submit" name="update_btn" value="更新" id="update_btn" style="margin: 0 auto;" /> <!-- onclick="loadSubmitForm()" -->
</p>
</div>

</form>
<!-- CHANGE INFO FORM END -->
<!-- END SEARCH VIEW WITH LOGIN_TYPE 2 and 9 これまで「２と９」 -->


<!-- START SEARCH VIEW WITH LOGIN_TYPE 0 and 1 -->
<?php } else {?>
<div>
		<form action="<?php echo base_url(); ?>menu_con/edit_info" method="post" name="edit_info_form" id="edit_info_form" onsubmit="return loadSubmitForm()" >
			<div>
			<input type="hidden" name="Charger_Type" id="Charger_Type" value="<?php echo $Charger_Type; ?>" />
			<input type="hidden" name="R01_Reservation_No" id="R01_Reservation_No" value="<?php echo $R01_Reservation_No; ?>" />
			</div>
			
			<table id="form" width="100%">
				<tbody>
				<tr>
					<th colspan="2"><div align="center">備考について<div></th>
				</tr>
				<tr>
					<th style="width: 30%;" >申込み種別</th>
					<td>
						<textarea name="R01_Note0_1" rows="6" cols="70"><?php if (isset($R01_Note0_1)) { echo htmlentities($R01_Note0_1,ENT_QUOTES, "UTF-8"); }?></textarea>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >Registration ID</th>
					<td>
						<textarea name="R01_Note0_2" rows="6" cols="70"><?php if (isset($R01_Note0_2)) { echo htmlentities($R01_Note0_2,ENT_QUOTES, "UTF-8"); }?></textarea>
					</td>
				</tr>
				<tr>
					<th style="width: 30%;" >備考3</th>
					<td>
						<textarea name="R01_Note0_3" rows="6" cols="70"><?php if (isset($R01_Note0_3)) { echo htmlentities($R01_Note0_3,ENT_QUOTES, "UTF-8"); }?></textarea>
					</td>
				</tr>
				</tbody>
			</table>
			<hr />
			<p align="center" class="submit">
			<input class="button button-3d" type="submit" name="update_btn_2" value="更新" id="update_btn_2" style="margin: 0 auto;" />
			</p>
		</form>
</div>
	<?php } ?>
<!-- END SEARCH VIEW WITH LOGIN_TYPE 0 and 1 -->
</body>
</html>