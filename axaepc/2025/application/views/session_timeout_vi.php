<script>
<?php 
$CI =& get_instance();
//コンフィグ
$CI->load->config('config');
$sess_expiration = $CI->config->item('sess_expiration');

echo "var time_out = ".$sess_expiration * 1000;
echo ";";
?>
var c = 0; max_count = 10; logout = true;
startTimer();
function startTimer(){
	setTimeout(function(){
		alert("セッションはタイムアウトとなります");
		location.href = '<?php echo base_url();?>login_con';

	}, time_out);
}

function resetTimer(){
	logout = false;
	startTimer();
}

function timedCount() {
    c = c + 1;
   	remaining_time = max_count - c;
   	if( remaining_time == 0 && logout ){
   		$('#logout_popup').modal('hide');
		location.href = '<?php echo base_url();?>login_con';

	}else{
    	$('#timer').html(remaining_time);
    	t = setTimeout(function(){timedCount()}, 1000);
	}
}

function startCount() {
   timedCount();
}
</script>
