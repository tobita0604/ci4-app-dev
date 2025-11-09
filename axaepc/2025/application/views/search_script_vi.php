

<script>
var sub_window = "";

function openOtherEditPage(R01_Id, name, val) {
	var postData_1 = R01_Id;
	var form = document.createElement( 'form' );
	document.body.appendChild( form );
	// Set post data with input_1
	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'R01_Id' );
	input_1.setAttribute( 'value' , postData_1 );
	form.appendChild( input_1 );

	// secure
	var input_2 = document.createElement( 'input' );
	input_2.setAttribute( 'type' , 'hidden' );
	input_2.setAttribute( 'name' , name );
	input_2.setAttribute( 'value' , val );
	form.appendChild( input_2 );

	// Set action post
	//form.setAttribute( 'action' , "<?php echo base_url();?>register_con/admin_view" ); // 新規登録
	form.setAttribute( 'action' , "<?php echo base_url();?>mypage_admin_con/admin_view" ); // マイページ
	form.setAttribute( 'method' , 'post' );
	// 指示されたタゲットの名前を設定
	form.setAttribute( 'target' , 'formresult');
	// タゲットはＷｉｎｄｏｗポップアップの設定
	sub_window = window.open("", 'formresult', 'scrollbars=yes,menubar=no,height=900,width=1400,resizable=yes,toolbar=no,status=no');
	form.submit();
}

function openNoteEditPage(R01_Id, name, val) {
	var postData_1 = R01_Id;
	var form = document.createElement( 'form' );
	document.body.appendChild( form );
	// Set post data with input_1
	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'R01_Id' );
	input_1.setAttribute( 'value' , postData_1 );
	form.appendChild( input_1 );

	// secure
	var input_2 = document.createElement( 'input' );
	input_2.setAttribute( 'type' , 'hidden' );
	input_2.setAttribute( 'name' , name );
	input_2.setAttribute( 'value' , val );
	form.appendChild( input_2 );

	// Set action post
	//form.setAttribute( 'action' , "<?php echo base_url();?>register_con/admin_view" ); // 新規登録
	form.setAttribute( 'action' , "<?php echo base_url();?>mypage_admin_con/note_view" ); // マイページ
	form.setAttribute( 'method' , 'post' );
	// 指示されたタゲットの名前を設定
	form.setAttribute( 'target' , 'formresult');
	// タゲットはＷｉｎｄｏｗポップアップの設定
	sub_window = window.open("", 'formresult', 'scrollbars=yes,menubar=no,height=800,width=1200,resizable=yes,toolbar=no,status=no');
	form.submit();
}

function openChargepaxPage(R01_Id, name, val) {
	var postData_1 = R01_Id;
	var form = document.createElement( 'form' );
	document.body.appendChild( form );
	// Set post data with input_1
	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'R01_Id' );
	input_1.setAttribute( 'value' , postData_1 );
	form.appendChild( input_1 );

	// secure
	var input_2 = document.createElement( 'input' );
	input_2.setAttribute( 'type' , 'hidden' );
	input_2.setAttribute( 'name' , name );
	input_2.setAttribute( 'value' , val );
	form.appendChild( input_2 );

	// Set action post
	form.setAttribute( 'action' , "<?php echo base_url();?>mypage_admin_con/chargepax_view" ); // 自費参加人数変更ページ
	form.setAttribute( 'method' , 'post' );
	// 指示されたタゲットの名前を設定
	form.setAttribute( 'target' , 'formresult');
	// タゲットはＷｉｎｄｏｗポップアップの設定
	sub_window = window.open("", 'formresult', 'scrollbars=yes,menubar=no,height=800,width=1200,resizable=yes,toolbar=no,status=no');
	form.submit();
}

function backMenu(){
	sub_window.close();
}

window.onbeforeunload = function () {
	sub_window.close();
}
</script>
