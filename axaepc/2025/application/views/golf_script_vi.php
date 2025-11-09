<script>
	$(function() {
		$('[name*=R02_Golf_Flg]').each(function(idx, ele){
			golf_flag(ele);
		});
	});
	function go_back(){
		var url = "<?php echo base_url();?>mypage_con";		
		$('#golf_data').attr('action', url);
		$('#golf_data').submit();
	}

	function go_conf_back(){
		var url = "<?php echo base_url();?>Golf_con";		
		$('#golf_data').attr('action', url);
		$('#golf_data').submit();
	}
	
	function golf_flag(ele) {
		$club = $(ele).closest('td').find('#R02_Golf_Club');
		$biko = $(ele).closest('td').find('#R02_Golf_Biko');
		$shoes = $(ele).closest('td').find('#R02_Golf_Shoes');
		if($(ele).val()!='0') {
			$club.closest('span').show();
			$biko.closest('span').show();
			$shoes.closest('span').show();
		} else {
			$club.closest('span').hide();
			$biko.closest('span').hide();
			$shoes.closest('span').hide();
			$club.val('0');
			$biko.val('');
			$shoes.val('99');
		}
	}
</script>
