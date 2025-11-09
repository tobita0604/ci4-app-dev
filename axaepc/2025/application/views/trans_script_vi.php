<script>
	function go_back(){
		var url = "<?php echo base_url();?>mypage_con";		
		$('#option_data').attr('action', url);
		$('#option_data').submit();
	}

	function go_conf_back(){
		var url = "<?php echo base_url();?>Transfer_con";		
		$('#option_data').attr('action', url);
		$('#option_data').submit();
	}

	// function check_regist() {
	// 	$('form').submit();
	// }
	
	function check(){
	if(window.confirm('申し込みをキャンセルします。よろしいですか？')){ // 確認ダイアログを表示
		return true; // 「OK」時は送信を実行
	}
	else{ // 「キャンセル」時の処理
		return false; // 送信を中止
	}

}
</script>
