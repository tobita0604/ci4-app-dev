<script>
	$(function() {
		invite_changed();
	});
	
	
	function invite_changed() {
		var free = <?=$common['R01_Free_Invites']?>;
		var cost = <?=$common['R01_Charge_Invites']?>;
		var total = free + cost;
		$('table.invite').hide();
		for(var i=0;i<total;i++) {
			$('table#invite'+i).show();
			if (i>=free) {
				$('table#invite'+i).addClass('gai');
			}
		}
	}
	function go_back_entry(){
		var url = "<?php echo base_url();?>register_con/go_back_entry";
		$('#confirm_form').attr('action', url);
		$('#confirm_form').submit();
	}
	function reserve(){
		var url = "<?php echo base_url();?>register_con/end";
		$('#confirm_form').attr('action', url);
		$('#confirm_form').submit();
	}
	function go_back_reserver(){
		var url = "<?php echo base_url();?>register_con/regist_reserver";
		$('#confirm_form').attr('action', url);
		$('#confirm_form').submit();
	}
</script>
