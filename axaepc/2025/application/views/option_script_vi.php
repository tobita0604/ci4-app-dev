<script>
	var symbol = 0;
	var golf_symbol = 0;
	$(function() {
		$('[name*=R02_Option1]').each(function(idx, ele){
			time_op1(ele);
		});
		$('[name*=R02_Option2]').each(function(idx, ele){
			time_op2(ele);
		});
	});
	function go_back(){
		var url = "<?php echo base_url();?>option_con/confirm_option";		
		$('#option_data').attr('action', url);
		$('#option_data').submit();
	}
	
	function save_option() {
		// var url = "<?php echo base_url();?>option_con/save_option";
		// $('#option_data').attr('action', url);
		$('form').submit();
	}

	function time_op1(ele) {
		$club = $(ele).closest('td').find('#R02_Golf_Club');
		$shoes = $(ele).closest('td').find('#R02_Golf_Shoes');
		var str = $(ele).val().charAt(0);
		var str_check = $(ele).text();
		// 上位のeachで１人ずつ切り分けられないため、
		// "不参加"の文字で切り分ける
		if(str_check.match(/不参加/)){
			this.golf_symbol = 0;
		}
		if(str == 'G') {
			this.golf_symbol = 'G';
		}
		if(this.golf_symbol == 'G') {
			$club.closest('span').show();
			$shoes.closest('span').show();
		} else {
			$club.closest('span').hide();
			$shoes.closest('span').hide();
			$club.val('0');
			$shoes.val('0');
		}

		var str2 = $(ele).val();
		var str_check2 = $(ele).text();
		// 上位のeachで１人ずつ切り分けられないため、
		// "不参加"の文字で切り分ける
		if(str_check2.match(/不参加/)){
			this.symbol = 0;
		}

		$Option1_S01 = $(ele).closest('td').find('#R02_Option1_Time_S01');
		$Option1_S02 = $(ele).closest('td').find('#R02_Option1_Time_S02');
		$Option1_S03 = $(ele).closest('td').find('#R02_Option1_Time_S03');

		$Option1_A01 = $(ele).closest('td').find('#R02_Option1_Time_A01');
		$Option1_A02 = $(ele).closest('td').find('#R02_Option1_Time_A02');
		$Option1_A03 = $(ele).closest('td').find('#R02_Option1_Time_A03');
		$Option1_A04 = $(ele).closest('td').find('#R02_Option1_Time_A04');
		$Option1_A05 = $(ele).closest('td').find('#R02_Option1_Time_A05');
		$Option1_A06 = $(ele).closest('td').find('#R02_Option1_Time_A06');
		$Option1_A07 = $(ele).closest('td').find('#R02_Option1_Time_A07');
		
		$Option1_B01 = $(ele).closest('td').find('#R02_Option1_Time_B01');
		$Option1_B02 = $(ele).closest('td').find('#R02_Option1_Time_B02');
		$Option1_B03 = $(ele).closest('td').find('#R02_Option1_Time_B03');
		$Option1_B04 = $(ele).closest('td').find('#R02_Option1_Time_B04');

		$Option1_C01 = $(ele).closest('td').find('#R02_Option1_Time_C01');
		$Option1_C02 = $(ele).closest('td').find('#R02_Option1_Time_C02');
		$Option1_C03 = $(ele).closest('td').find('#R02_Option1_Time_C03');
		$Option1_C04 = $(ele).closest('td').find('#R02_Option1_Time_C04');

		$Option1_D01 = $(ele).closest('td').find('#R02_Option1_Time_D01');
		$Option1_D02 = $(ele).closest('td').find('#R02_Option1_Time_D02');
		$Option1_D03 = $(ele).closest('td').find('#R02_Option1_Time_D03');
		$Option1_D04 = $(ele).closest('td').find('#R02_Option1_Time_D04');

		$Option1_E01 = $(ele).closest('td').find('#R02_Option1_Time_E01');
		$Option1_E02 = $(ele).closest('td').find('#R02_Option1_Time_E02');
		$Option1_E03 = $(ele).closest('td').find('#R02_Option1_Time_E03');
		$Option1_E04 = $(ele).closest('td').find('#R02_Option1_Time_E04');

		if(4 >= str2.length){
			if(str2 == 'S01') {
				$Option1_S01.closest('span').show();
				this.symbol = 'S01';
			} else if (str2 == 'S02'){
				$Option1_S02.closest('span').show();
				this.symbol = 'S02';
			} else if (str2 == 'S03'){
				$Option1_S03.closest('span').show();
				this.symbol = 'S03';
			} else if (str2 == 'A01'){
				$Option1_A01.closest('span').show();
				this.symbol = 'A01';
			} else if (str2 == 'A02'){
				$Option1_A02.closest('span').show();
				this.symbol = 'A02';
			} else if (str2 == 'A03'){
				$Option1_A03.closest('span').show();
				this.symbol = 'A03';
			} else if (str2 == 'A04'){
				$Option1_A04.closest('span').show();
				this.symbol = 'A04';
			} else if (str2 == 'A05'){
				$Option1_A05.closest('span').show();
				this.symbol = 'A05';
			} else if (str2 == 'A06'){
				$Option1_A06.closest('span').show();
				this.symbol = 'A06';
			} else if (str2 == 'A07'){
				$Option1_A07.closest('span').show();
				this.symbol = 'A07';
			} else if (str2 == 'B01'){
				$Option1_B01.closest('span').show();
				this.symbol = 'B01';
			} else if (str2 == 'B02'){
				$Option1_B02.closest('span').show();
				this.symbol = 'B02';
			} else if (str2 == 'B03'){
				$Option1_B03.closest('span').show();
				this.symbol = 'B03';
			} else if (str2 == 'B04'){
				$Option1_B04.closest('span').show();
				this.symbol = 'B04';
			} else if (str2 == 'C01'){
				$Option1_C01.closest('span').show();
				this.symbol = 'C01';
			} else if (str2 == 'C02'){
				$Option1_C02.closest('span').show();
				this.symbol = 'C02';
			} else if (str2 == 'C03'){
				$Option1_C03.closest('span').show();
				this.symbol = 'C03';
			} else if (str2 == 'C04'){
				$Option1_C04.closest('span').show();
				this.symbol = 'C04';
			} else if (str2 == 'D01'){
				$Option1_D01.closest('span').show();
				this.symbol = 'D01';
			} else if (str2 == 'D02'){
				$Option1_D02.closest('span').show();
				this.symbol = 'D02';
			} else if (str2 == 'D03'){
				$Option1_D03.closest('span').show();
				this.symbol = 'D03';
			} else if (str2 == 'D04'){
				$Option1_D04.closest('span').show();
				this.symbol = 'D04';
			} else if (str2 == 'E01'){
				$Option1_E01.closest('span').show();
				this.symbol = 'E01';
			} else if (str2 == 'E02'){
				$Option1_E02.closest('span').show();
				this.symbol = 'E02';
			} else if (str2 == 'E03'){
				$Option1_E03.closest('span').show();
				this.symbol = 'E03';
			} else if (str2 == 'E04'){
				$Option1_E04.closest('span').show();
				this.symbol = 'E04';
			} else {
				if(this.symbol == 'S01') {
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'S02'){
					$Option1_S01.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'S03'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'A01'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'A02'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'A03'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'A04'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'A05'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'A06'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'A07'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'B01'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'B02'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'B03'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'B04'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'C01'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'C02'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'C03'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'C04'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'D01'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'D02'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'D03'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'D04'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'E01'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'E02'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'E03'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E04.closest('span').hide();
				} else if (this.symbol == 'E04'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
				} else if (this.symbol == '0'){
					$Option1_S01.closest('span').hide();
					$Option1_S02.closest('span').hide();
					$Option1_S03.closest('span').hide();
					$Option1_A01.closest('span').hide();
					$Option1_A02.closest('span').hide();
					$Option1_A03.closest('span').hide();
					$Option1_A04.closest('span').hide();
					$Option1_A05.closest('span').hide();
					$Option1_A06.closest('span').hide();
					$Option1_A07.closest('span').hide();
					$Option1_B01.closest('span').hide();
					$Option1_B02.closest('span').hide();
					$Option1_B03.closest('span').hide();
					$Option1_B04.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_C01.closest('span').hide();
					$Option1_C02.closest('span').hide();
					$Option1_C03.closest('span').hide();
					$Option1_C04.closest('span').hide();
					$Option1_D01.closest('span').hide();
					$Option1_D02.closest('span').hide();
					$Option1_D03.closest('span').hide();
					$Option1_D04.closest('span').hide();
					$Option1_E01.closest('span').hide();
					$Option1_E02.closest('span').hide();
					$Option1_E03.closest('span').hide();
					$Option1_E04.closest('span').hide();
				}
			}
		}
	}

	function time_op2(ele) {
		var str2 = $(ele).val();
		var str_check = $(ele).text();
		// eachで１人ずつ切り分けられないため、
		// "不参加"の文字で切り分ける
		if(str_check.match(/不参加/)){
			this.symbol = 0;
		}

		$Option2_S01 = $(ele).closest('td').find('#R02_Option2_Time_S01');
		$Option2_S02 = $(ele).closest('td').find('#R02_Option2_Time_S02');
		$Option2_S03 = $(ele).closest('td').find('#R02_Option2_Time_S03');

		$Option2_A01 = $(ele).closest('td').find('#R02_Option2_Time_A01');
		$Option2_A02 = $(ele).closest('td').find('#R02_Option2_Time_A02');
		$Option2_A03 = $(ele).closest('td').find('#R02_Option2_Time_A03');
		$Option2_A04 = $(ele).closest('td').find('#R02_Option2_Time_A04');
		$Option2_A05 = $(ele).closest('td').find('#R02_Option2_Time_A05');
		$Option2_A06 = $(ele).closest('td').find('#R02_Option2_Time_A06');
		$Option2_A07 = $(ele).closest('td').find('#R02_Option2_Time_A07');
		
		$Option2_B01 = $(ele).closest('td').find('#R02_Option2_Time_B01');
		$Option2_B02 = $(ele).closest('td').find('#R02_Option2_Time_B02');
		$Option2_B03 = $(ele).closest('td').find('#R02_Option2_Time_B03');
		$Option2_B04 = $(ele).closest('td').find('#R02_Option2_Time_B04');

		$Option2_C01 = $(ele).closest('td').find('#R02_Option2_Time_C01');
		$Option2_C02 = $(ele).closest('td').find('#R02_Option2_Time_C02');
		$Option2_C03 = $(ele).closest('td').find('#R02_Option2_Time_C03');
		$Option2_C04 = $(ele).closest('td').find('#R02_Option2_Time_C04');

		$Option2_D01 = $(ele).closest('td').find('#R02_Option2_Time_D01');
		$Option2_D02 = $(ele).closest('td').find('#R02_Option2_Time_D02');
		$Option2_D03 = $(ele).closest('td').find('#R02_Option2_Time_D03');
		$Option2_D04 = $(ele).closest('td').find('#R02_Option2_Time_D04');

		$Option2_E01 = $(ele).closest('td').find('#R02_Option2_Time_E01');
		$Option2_E02 = $(ele).closest('td').find('#R02_Option2_Time_E02');
		$Option2_E03 = $(ele).closest('td').find('#R02_Option2_Time_E03');
		$Option2_E04 = $(ele).closest('td').find('#R02_Option2_Time_E04');

		if(4 >= str2.length){
			if(str2 == 'S01') {
				$Option2_S01.closest('span').show();
				this.symbol = 'S01';
			} else if (str2 == 'S02'){
				$Option2_S02.closest('span').show();
				this.symbol = 'S02';
			} else if (str2 == 'S03'){
				$Option2_S03.closest('span').show();
				this.symbol = 'S03';
			} else if (str2 == 'A01'){
				$Option2_A01.closest('span').show();
				this.symbol = 'A01';
			} else if (str2 == 'A02'){
				$Option2_A02.closest('span').show();
				this.symbol = 'A02';
			} else if (str2 == 'A03'){
				$Option2_A03.closest('span').show();
				this.symbol = 'A03';
			} else if (str2 == 'A04'){
				$Option2_A04.closest('span').show();
				this.symbol = 'A04';
			} else if (str2 == 'A05'){
				$Option2_A05.closest('span').show();
				this.symbol = 'A05';
			} else if (str2 == 'A06'){
				$Option2_A06.closest('span').show();
				this.symbol = 'A06';
			} else if (str2 == 'A07'){
				$Option2_A07.closest('span').show();
				this.symbol = 'A07';
			} else if (str2 == 'B01'){
				$Option2_B01.closest('span').show();
				this.symbol = 'B01';
			} else if (str2 == 'B02'){
				$Option2_B02.closest('span').show();
				this.symbol = 'B02';
			} else if (str2 == 'B03'){
				$Option2_B03.closest('span').show();
				this.symbol = 'B03';
			} else if (str2 == 'B04'){
				$Option2_B04.closest('span').show();
				this.symbol = 'B04';
			} else if (str2 == 'C01'){
				$Option2_C01.closest('span').show();
				this.symbol = 'C01';
			} else if (str2 == 'C02'){
				$Option2_C02.closest('span').show();
				this.symbol = 'C02';
			} else if (str2 == 'C03'){
				$Option2_C03.closest('span').show();
				this.symbol = 'C03';
			} else if (str2 == 'C04'){
				$Option2_C04.closest('span').show();
				this.symbol = 'C04';
			} else if (str2 == 'D01'){
				$Option2_D01.closest('span').show();
				this.symbol = 'D01';
			} else if (str2 == 'D02'){
				$Option2_D02.closest('span').show();
				this.symbol = 'D02';
			} else if (str2 == 'D03'){
				$Option2_D03.closest('span').show();
				this.symbol = 'D03';
			} else if (str2 == 'D04'){
				$Option2_D04.closest('span').show();
				this.symbol = 'D04';
			} else if (str2 == 'E01'){
				$Option2_E01.closest('span').show();
				this.symbol = 'E01';
			} else if (str2 == 'E02'){
				$Option2_E02.closest('span').show();
				this.symbol = 'E02';
			} else if (str2 == 'E03'){
				$Option2_E03.closest('span').show();
				this.symbol = 'E03';
			} else {
				if(this.symbol == 'S01') {
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'S02'){
					$Option2_S01.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'S03'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'A01'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'A02'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'A03'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'A04'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'A05'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'A06'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'A07'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'B01'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'B02'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'B03'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'B04'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'C01'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'C02'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'C03'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'C04'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'D01'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'D02'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'D03'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'D04'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'E01'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'E02'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'E03'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E04.closest('span').hide();
				} else if (this.symbol == 'E04'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
				} else if (this.symbol == '0'){
					$Option2_S01.closest('span').hide();
					$Option2_S02.closest('span').hide();
					$Option2_S03.closest('span').hide();
					$Option2_A01.closest('span').hide();
					$Option2_A02.closest('span').hide();
					$Option2_A03.closest('span').hide();
					$Option2_A04.closest('span').hide();
					$Option2_A05.closest('span').hide();
					$Option2_A06.closest('span').hide();
					$Option2_A07.closest('span').hide();
					$Option2_B01.closest('span').hide();
					$Option2_B02.closest('span').hide();
					$Option2_B03.closest('span').hide();
					$Option2_B04.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_C01.closest('span').hide();
					$Option2_C02.closest('span').hide();
					$Option2_C03.closest('span').hide();
					$Option2_C04.closest('span').hide();
					$Option2_D01.closest('span').hide();
					$Option2_D02.closest('span').hide();
					$Option2_D03.closest('span').hide();
					$Option2_D04.closest('span').hide();
					$Option2_E01.closest('span').hide();
					$Option2_E02.closest('span').hide();
					$Option2_E03.closest('span').hide();
					$Option2_E04.closest('span').hide();
				}
			}
		}
	}

	function option1_flag(ele) {
		$club = $(ele).closest('td').find('#R02_Golf_Club');
		$shoes = $(ele).closest('td').find('#R02_Golf_Shoes');
		var str = $(ele).val().charAt(0);
		if(str == 'G') {
			$club.closest('span').show();
			$shoes.closest('span').show();
		} else {
			$club.closest('span').hide();
			$shoes.closest('span').hide();
			$club.val('0');
			$shoes.val('0');
		}

		var str2 = $(ele).val();
		$Option1_S01 = $(ele).closest('td').find('#R02_Option1_Time_S01');
		$Option1_S02 = $(ele).closest('td').find('#R02_Option1_Time_S02');
		$Option1_S03 = $(ele).closest('td').find('#R02_Option1_Time_S03');

		$Option1_A01 = $(ele).closest('td').find('#R02_Option1_Time_A01');
		$Option1_A02 = $(ele).closest('td').find('#R02_Option1_Time_A02');
		$Option1_A03 = $(ele).closest('td').find('#R02_Option1_Time_A03');
		$Option1_A04 = $(ele).closest('td').find('#R02_Option1_Time_A04');
		$Option1_A05 = $(ele).closest('td').find('#R02_Option1_Time_A05');
		$Option1_A06 = $(ele).closest('td').find('#R02_Option1_Time_A06');
		$Option1_A07 = $(ele).closest('td').find('#R02_Option1_Time_A07');
		
		$Option1_B01 = $(ele).closest('td').find('#R02_Option1_Time_B01');
		$Option1_B02 = $(ele).closest('td').find('#R02_Option1_Time_B02');
		$Option1_B03 = $(ele).closest('td').find('#R02_Option1_Time_B03');
		$Option1_B04 = $(ele).closest('td').find('#R02_Option1_Time_B04');

		$Option1_C01 = $(ele).closest('td').find('#R02_Option1_Time_C01');
		$Option1_C02 = $(ele).closest('td').find('#R02_Option1_Time_C02');
		$Option1_C03 = $(ele).closest('td').find('#R02_Option1_Time_C03');
		$Option1_C04 = $(ele).closest('td').find('#R02_Option1_Time_C04');

		$Option1_D01 = $(ele).closest('td').find('#R02_Option1_Time_D01');
		$Option1_D02 = $(ele).closest('td').find('#R02_Option1_Time_D02');
		$Option1_D03 = $(ele).closest('td').find('#R02_Option1_Time_D03');
		$Option1_D04 = $(ele).closest('td').find('#R02_Option1_Time_D04');

		$Option1_E01 = $(ele).closest('td').find('#R02_Option1_Time_E01');
		$Option1_E02 = $(ele).closest('td').find('#R02_Option1_Time_E02');
		$Option1_E03 = $(ele).closest('td').find('#R02_Option1_Time_E03');
		$Option1_E04 = $(ele).closest('td').find('#R02_Option1_Time_E04');

		$Option1_S01.closest('span').hide();
		$Option1_S02.closest('span').hide();
		$Option1_S03.closest('span').hide();
		$Option1_A01.closest('span').hide();
		$Option1_A02.closest('span').hide();
		$Option1_A03.closest('span').hide();
		$Option1_A04.closest('span').hide();
		$Option1_A05.closest('span').hide();
		$Option1_A06.closest('span').hide();
		$Option1_A07.closest('span').hide();
		$Option1_B01.closest('span').hide();
		$Option1_B02.closest('span').hide();
		$Option1_B03.closest('span').hide();
		$Option1_B04.closest('span').hide();
		$Option1_C01.closest('span').hide();
		$Option1_C02.closest('span').hide();
		$Option1_C03.closest('span').hide();
		$Option1_C04.closest('span').hide();
		$Option1_D01.closest('span').hide();
		$Option1_D02.closest('span').hide();
		$Option1_D03.closest('span').hide();
		$Option1_D04.closest('span').hide();
		$Option1_E01.closest('span').hide();
		$Option1_E02.closest('span').hide();
		$Option1_E03.closest('span').hide();
		$Option1_E04.closest('span').hide();

		$Option1_S01.val('0');
		$Option1_S02.val('0');
		$Option1_S03.val('0');
		$Option1_A01.val('0');
		$Option1_A02.val('0');
		$Option1_A03.val('0');
		$Option1_A04.val('0');
		$Option1_A05.val('0');
		$Option1_A06.val('0');
		$Option1_A07.val('0');
		$Option1_B01.val('0');
		$Option1_B02.val('0');
		$Option1_B03.val('0');
		$Option1_B04.val('0');
		$Option1_C01.val('0');
		$Option1_C02.val('0');
		$Option1_C03.val('0');
		$Option1_C04.val('0');
		$Option1_D01.val('0');
		$Option1_D02.val('0');
		$Option1_D03.val('0');
		$Option1_D04.val('0');
		$Option1_E01.val('0');
		$Option1_E02.val('0');
		$Option1_E03.val('0');
		$Option1_E04.val('0');

		if(str2 == 'S01') {
			$Option1_S01.closest('span').show();
		} else if (str2 == 'S02'){
			$Option1_S02.closest('span').show();
		} else if (str2 == 'S03'){
			$Option1_S03.closest('span').show();
		} else if (str2 == 'A01'){
			$Option1_A01.closest('span').show();
		} else if (str2 == 'A02'){
			$Option1_A02.closest('span').show();
		} else if (str2 == 'A03'){
			$Option1_A03.closest('span').show();
		} else if (str2 == 'A04'){
			$Option1_A04.closest('span').show();
		} else if (str2 == 'A05'){
			$Option1_A05.closest('span').show();
		} else if (str2 == 'A06'){
			$Option1_A06.closest('span').show();
		} else if (str2 == 'A07'){
			$Option1_A07.closest('span').show();
		} else if (str2 == 'B01'){
			$Option1_B01.closest('span').show();
		} else if (str2 == 'B02'){
			$Option1_B02.closest('span').show();
		} else if (str2 == 'B03'){
			$Option1_B03.closest('span').show();
		} else if (str2 == 'B04'){
			$Option1_B04.closest('span').show();
		} else if (str2 == 'C01'){
			$Option1_C01.closest('span').show();
		} else if (str2 == 'C02'){
			$Option1_C02.closest('span').show();
		} else if (str2 == 'C03'){
			$Option1_C03.closest('span').show();
		} else if (str2 == 'C04'){
			$Option1_C04.closest('span').show();
		} else if (str2 == 'D01'){
			$Option1_D01.closest('span').show();
		} else if (str2 == 'D02'){
			$Option1_D02.closest('span').show();
		} else if (str2 == 'D03'){
			$Option1_D03.closest('span').show();
		} else if (str2 == 'D04'){
			$Option1_D04.closest('span').show();
		} else if (str2 == 'E01'){
			$Option1_E01.closest('span').show();
		} else if (str2 == 'E02'){
			$Option1_E02.closest('span').show();
		} else if (str2 == 'E03'){
			$Option1_E03.closest('span').show();
		} else if (str2 == 'E04'){
			$Option1_E04.closest('span').show();
		}
	}

	function option2_flag(ele) {
		var str2 = $(ele).val();
		$Option2_S01 = $(ele).closest('td').find('#R02_Option2_Time_S01');
		$Option2_S02 = $(ele).closest('td').find('#R02_Option2_Time_S02');
		$Option2_S03 = $(ele).closest('td').find('#R02_Option2_Time_S03');

		$Option2_A01 = $(ele).closest('td').find('#R02_Option2_Time_A01');
		$Option2_A02 = $(ele).closest('td').find('#R02_Option2_Time_A02');
		$Option2_A03 = $(ele).closest('td').find('#R02_Option2_Time_A03');
		$Option2_A04 = $(ele).closest('td').find('#R02_Option2_Time_A04');
		$Option2_A05 = $(ele).closest('td').find('#R02_Option2_Time_A05');
		$Option2_A06 = $(ele).closest('td').find('#R02_Option2_Time_A06');
		$Option2_A07 = $(ele).closest('td').find('#R02_Option2_Time_A07');
		
		$Option2_B01 = $(ele).closest('td').find('#R02_Option2_Time_B01');
		$Option2_B02 = $(ele).closest('td').find('#R02_Option2_Time_B02');
		$Option2_B03 = $(ele).closest('td').find('#R02_Option2_Time_B03');
		$Option2_B04 = $(ele).closest('td').find('#R02_Option2_Time_B04');

		$Option2_C01 = $(ele).closest('td').find('#R02_Option2_Time_C01');
		$Option2_C02 = $(ele).closest('td').find('#R02_Option2_Time_C02');
		$Option2_C03 = $(ele).closest('td').find('#R02_Option2_Time_C03');
		$Option2_C04 = $(ele).closest('td').find('#R02_Option2_Time_C04');

		$Option2_D01 = $(ele).closest('td').find('#R02_Option2_Time_D01');
		$Option2_D02 = $(ele).closest('td').find('#R02_Option2_Time_D02');
		$Option2_D03 = $(ele).closest('td').find('#R02_Option2_Time_D03');
		$Option2_D04 = $(ele).closest('td').find('#R02_Option2_Time_D04');

		$Option2_E01 = $(ele).closest('td').find('#R02_Option2_Time_E01');
		$Option2_E02 = $(ele).closest('td').find('#R02_Option2_Time_E02');
		$Option2_E03 = $(ele).closest('td').find('#R02_Option2_Time_E03');
		$Option2_E04 = $(ele).closest('td').find('#R02_Option2_Time_E04');

		$Option2_S01.closest('span').hide();
		$Option2_S02.closest('span').hide();
		$Option2_S03.closest('span').hide();
		$Option2_A01.closest('span').hide();
		$Option2_A02.closest('span').hide();
		$Option2_A03.closest('span').hide();
		$Option2_A04.closest('span').hide();
		$Option2_A05.closest('span').hide();
		$Option2_A06.closest('span').hide();
		$Option2_A07.closest('span').hide();
		$Option2_B01.closest('span').hide();
		$Option2_B02.closest('span').hide();
		$Option2_B03.closest('span').hide();
		$Option2_B04.closest('span').hide();
		$Option2_C01.closest('span').hide();
		$Option2_C02.closest('span').hide();
		$Option2_C03.closest('span').hide();
		$Option2_C04.closest('span').hide();
		$Option2_D01.closest('span').hide();
		$Option2_D02.closest('span').hide();
		$Option2_D03.closest('span').hide();
		$Option2_D04.closest('span').hide();
		$Option2_E01.closest('span').hide();
		$Option2_E02.closest('span').hide();
		$Option2_E03.closest('span').hide();
		$Option2_E04.closest('span').hide();
		$Option2_S01.val('0');
		$Option2_S02.val('0');
		$Option2_S03.val('0');
		$Option2_A01.val('0');
		$Option2_A02.val('0');
		$Option2_A03.val('0');
		$Option2_A04.val('0');
		$Option2_A05.val('0');
		$Option2_A06.val('0');
		$Option2_A07.val('0');
		$Option2_B01.val('0');
		$Option2_B02.val('0');
		$Option2_B03.val('0');
		$Option2_B04.val('0');
		$Option2_C01.val('0');
		$Option2_C02.val('0');
		$Option2_C03.val('0');
		$Option2_C04.val('0');
		$Option2_D01.val('0');
		$Option2_D02.val('0');
		$Option2_D03.val('0');
		$Option2_D04.val('0');
		$Option2_E01.val('0');
		$Option2_E02.val('0');
		$Option2_E03.val('0');
		$Option2_E04.val('0');

		if(str2 == 'S01') {
			$Option2_S01.closest('span').show();
		} else if (str2 == 'S02'){
			$Option2_S02.closest('span').show();
		} else if (str2 == 'S03'){
			$Option2_S03.closest('span').show();
		} else if (str2 == 'A01'){
			$Option2_A01.closest('span').show();
		} else if (str2 == 'A02'){
			$Option2_A02.closest('span').show();
		} else if (str2 == 'A03'){
			$Option2_A03.closest('span').show();
		} else if (str2 == 'A04'){
			$Option2_A04.closest('span').show();
		} else if (str2 == 'A05'){
			$Option2_A05.closest('span').show();
		} else if (str2 == 'A06'){
			$Option2_A06.closest('span').show();
		} else if (str2 == 'A07'){
			$Option2_A07.closest('span').show();
		} else if (str2 == 'B01'){
			$Option2_B01.closest('span').show();
		} else if (str2 == 'B02'){
			$Option2_B02.closest('span').show();
		} else if (str2 == 'B03'){
			$Option2_B03.closest('span').show();
		} else if (str2 == 'B04'){
			$Option2_B04.closest('span').show();
		} else if (str2 == 'C01'){
			$Option2_C01.closest('span').show();
		} else if (str2 == 'C02'){
			$Option2_C02.closest('span').show();
		} else if (str2 == 'C03'){
			$Option2_C03.closest('span').show();
		} else if (str2 == 'C04'){
			$Option2_C04.closest('span').show();
		} else if (str2 == 'D01'){
			$Option2_D01.closest('span').show();
		} else if (str2 == 'D02'){
			$Option2_D02.closest('span').show();
		} else if (str2 == 'D03'){
			$Option2_D03.closest('span').show();
		} else if (str2 == 'D04'){
			$Option2_D04.closest('span').show();
		} else if (str2 == 'E01'){
			$Option2_E01.closest('span').show();
		} else if (str2 == 'E02'){
			$Option2_E02.closest('span').show();
		} else if (str2 == 'E03'){
			$Option2_E03.closest('span').show();
		} else if (str2 == 'E04'){
			$Option2_E04.closest('span').show();
		}
	}

	function check_jihi(){
		if(window.confirm('自費参加費（ご旅行代金補助）申し込みします。よろしいですか？')){ // 確認ダイアログを表示
			return true; // 「OK」時は送信を実行
		}
		else{ // 「キャンセル」時の処理
			return false; // 送信を中止
		}
	}

	function check_regist(){
		if(window.confirm('登録します。よろしいですか？')){ // 確認ダイアログを表示
			return true; // 「OK」時は送信を実行
		}
		else{ // 「キャンセル」時の処理
			return false; // 送信を中止
		}
	}
</script>
