<script>
	var myAjax = function(arg) {
		var opt = $.extend({}, $.ajaxSettings, arg);
		var jqXHR = $.ajax(opt);
		var defer = $.Deferred();

		jqXHR.done(function(data, statusText, jqXHR) {
			defer.resolveWith(this, arguments);
		});

		jqXHR.fail(function(jqXHR, statusText, errorThrown) {
			if (jqXHR.status == 403) {}

			defer.rejectWith(this, arguments);
		});
		jqXHR.always(function() {});

		return $.extend({}, jqXHR, defer.promise());
	};

	$(function() {
		$("#dialog-confirm").dialog({
			autoOpen: false,
			resizable: false,
			height: "auto",
			width: 400,
			modal: true,
			buttons: {
				"入力画面に戻る": function() {
					$(this).dialog("close");
				},
				"続行": function() {
					$('#entry_data').submit();
				},
			}
		});
		$('#Birth_Year,#Birth_Month,#Birth_Day').datepicker({
			changeYear: true,
			changeMonth: true,
			yearRange: "-100:+0",
			onSelect: function(dateText, inst) {
				var pieces = dateText.split('/');
				$('#Birth_Year').val(pieces[0]);
				$('#Birth_Month').val(pieces[1]);
				$('#Birth_Day').val(pieces[2]);
				age_changed();
			}
		});
		$('#Issue_Year,#Issue_Month,#Issue_Day').datepicker({
			changeYear: true,
			changeMonth: true,
			yearRange: "-30:+0",
			onSelect: function(dateText, inst) {
				var pieces = dateText.split('/');
				$('#Issue_Year').val(pieces[0]);
				$('#Issue_Month').val(pieces[1]);
				$('#Issue_Day').val(pieces[2]);
			}
		});
		$('#Valid_Year,#Valid_Month,#Valid_Day').datepicker({
			changeYear: true,
			changeMonth: true,
			yearRange: "-0:+30",
			onSelect: function(dateText, inst) {
				var pieces = dateText.split('/');
				$('#Valid_Year').val(pieces[0]);
				$('#Valid_Month').val(pieces[1]);
				$('#Valid_Day').val(pieces[2]);
			}
		});
		$("#R01_Cancel_Flg").checkboxradio();
		$('.digits').change(function(e) {
			if (!is_numeric(e.target.value)) {
				e.target.value = '';
				alert('半角数字で入力してください');
			}
		});
		$('#R01_Roma_Last,#R01_Roma_First').change(function(e) {
			e.target.value = e.target.value.toUpperCase();
		});
		$('[name*=R01_Baby_Bassinet]:checked').each(function(idx, ele) {
			bassinet_flag(ele);
		});
		invite_changed();
		age_changed();

	});

	function invite_changed() {
		var free = Number($('[name*=R01_Free_Invites]').val()) || 0;
		var cost = Number($('[name*=R01_Charge_Invites]').val()) || 0;
		var total = free + cost;
		$('tr.invite').hide();
		for (var i = 0; i < total; i++) {
			$('tr#invite' + i).show();
			if (i >= free) {
				$('tr#invite' + i).addClass('gai');
			}
		}
	}

	function bassinet_flag(ele) {
		var is_checked = $(ele).val();
		if (is_checked == '1') {
			$('#bassinet').show();
		} else {
			$('#bassinet').hide();
		}
	}

	function copy_checked(ele) {
		var is_checked = $(ele).is(':checked');
		if (is_checked) {
			$('tr.copy').hide();
		} else {
			$('tr.copy').show();
		}
	}

	function age_changed() {
		var year = $('[name*=Birth_Year]').val();
		var month = $('[name*=Birth_Month]').val();
		var day = $('[name*=Birth_Day]').val();

		var birth_date = new Date(year + '-' + month + '-' + day);
		var departure_date = new Date('<?= DEPARTURE_DATE ?>');
		if (isNaN(birth_date)) {
			$('tr.baby').hide();
			$('tr.baby-bed').hide();
			$('tr.baby-bed2').hide();
			$('tr.baby-party').hide();
			$('tr.infant').hide();
			$('tr.infant-bed').hide();
			$('tr.infant-party').hide();
			$('tr.infant-chair').hide();
			$('tr.infant-bassinet').hide();
			$('[name*=R01_Baby_Bed]').prop('checked', false);
			$('[name*=R01_Baby_Meal]').prop('checked', false);
			$('[name*=R01_Baby_Chair]').prop('checked', false);
			$('[name*=R01_Baby_Bassinet]').prop('checked', false);
			$('[name*=R01_Infant_Bed]').prop('checked', false);
			$('[name*=R01_Infant_Chair]').prop('checked', false);
			$('[name*=R01_Infant_Bassinet]').prop('checked', false);
			return;
		}
		var age = calculate_age(birth_date, departure_date);
		$('[name*=R01_Age]').val(age);
		if (age < 3) {
			$('tr.baby').show();
			$('tr.infant').hide();
			$('[name*=R01_Baby_Meal]').prop('checked', false);
			$('[name=R01_Infant_Bed]').prop('checked', false);
			$('[name*=R01_Infant_Party]').prop('checked', false);
			$('[name*=R01_Infant_Chair]').prop('checked', false);
			$('[name*=R01_Infant_Bassinet]').prop('checked', false);
		} else if(age <= 5) {
			$('tr.baby').hide();
			$('tr.infant').show();
			$('[name*=R01_Baby_Bed]').prop('checked', false);
			$('[name*=R01_Baby_Meal]').prop('checked', false);
			$('[name*=R01_Baby_party]').prop('checked', false);
			$('[name*=R01_Baby_Chair]').prop('checked', false);
		} else {
			$('tr.baby').hide();
			$('tr.infant').hide();
			$('[name*=R01_Baby_Bed]').prop('checked', false);
			$('[name*=R01_Baby_Meal]').prop('checked', false);
			$('[name*=R01_Baby_Chair]').prop('checked', false);
			$('[name*=R01_Baby_Bassinet]').prop('checked', false);
			$('[name*=R01_Infant_Bed]').prop('checked', false);
			$('[name*=R01_Infant_Party]').prop('checked', false);
			$('[name*=R01_Infant_Chair]').prop('checked', false);
			$('[name*=R01_Infant_Bassinet]').prop('checked', false);
		}
	}

	function calculate_age(birth_date, departure_date) {
		var age = departure_date.getFullYear() - birth_date.getFullYear();
		var m = departure_date.getMonth() - birth_date.getMonth();
		if (m < 0 || (m === 0 && departure_date.getDate() < birth_date.getDate())) {
			age--;
		}
		return age;
	}

	function is_twelve(birth_date, departure_date) {
		birth_date.setFullYear(birth_date.getFullYear() + 6);
		if (birth_date > departure_date) {
			return false;
		} else {
			return true;
		}
	}

	function is_0(birth_date, departure_date) {
		birth_date.setFullYear(birth_date.getFullYear() + 1);
		if (birth_date > departure_date) {
			return false;
		} else {
			return true;
		}
	}


	function is_2(birth_date, departure_date) {
		birth_date.setFullYear(birth_date.getFullYear() + 2);
		if (birth_date > departure_date) {
			return false;
		} else {
			return true;
		}
	}

	function is_4(birth_date, departure_date) {
		birth_date.setFullYear(birth_date.getFullYear() + 4);
		if (birth_date > departure_date) {
			return false;
		} else {
			return true;
		}
	}
	function is_6(birth_date, departure_date) {
		birth_date.setFullYear(birth_date.getFullYear() + 6);
		if (birth_date > departure_date) {
			return false;
		} else {
			return true;
		}
	}
	function is_numeric(str) {
		return /^[0-9]*$/.test(str);
	}

	function is_alpha(str) {
		return /^[a-zA-Z]*$/.test(str);
	}

	function is_katakana(str) {
		return /^[ァ-ヶー　]*$/.test(str);
	}

	function set_message(id, message) {
		$('#' + id + '_error').text(message);
	}

	function confirm_save() {
		return confirm('必須項目が未入力、またはエラーがあります。入力中の内容を保存してTOPに戻ります。よろしいですか？');
	}

	function confirm_cancel() {
		return confirm('キャンセルします。よろしいですか？');
	}

	function validate_entry_no(skip_flg) {
		if (!$('#R01_Confirm_Flg').is(':checked')) {
			alert('同意しますにチェックを入れてください');
			return false;
		}
		if (skip_flg) {
			$('#entry_data').prop('action', '<?= base_url() ?>register_con/regist_member');
		} else {
			$('#entry_data').prop('action', '<?= base_url() ?>register_con/save_entry_no');
		}

		$('#entry_data').submit();
	}

	function validate_reserver(update_flag) {

		var success = true;

		var mobile1 = $('[name*=Mobile1]').val();
		var mobile2 = $('[name*=Mobile2]').val();
		var mobile3 = $('[name*=Mobile3]').val();
		if (!mobile1 || !mobile2 || !mobile3) {
			set_message('R01_Mobile_No', '※必須');
			success = false;
		} else if (!is_numeric(mobile1) || !is_numeric(mobile2) || !is_numeric(mobile3)) {
			set_message('R01_Mobile_No', '※半角数字で入力してください');
			success = false;
		} else {
			set_message('R01_Mobile_No', '');
		}

		var email = $('[name*=R01_Email]').val();
		var email_cfm = $('[name*=R01_Email_cfm]').val();
		if (!email) {
			set_message('R01_Email', '※必須');
			success = false;
		} else {
			set_message('R01_Email', '');
		}

		if (!email.match(/.+@.+\..+/)) {
			set_message('R01_Email', '※メールアドレスの形式で入力してください。');
		} else {
			set_message('R01_Email', '');
		}

		if (!email_cfm.match(/.+@.+\..+/)) {
			set_message('R01_Email_cfm', '※メールアドレスの形式で入力してください。');
		} else {
			set_message('R01_Email_cfm', '');
		}

		if (!email_cfm) {
			set_message('R01_Email_cfm', '※必須');
			success = false;
		} else if (email != email_cfm) {
			set_message('R01_Email_cfm', '※E-mailアドレスと確認用E-mailアドレスが違います。');
			success = false;
		} else {
			set_message('R01_Email_cfm', '');
		}

		if (!$('[name*=R01_Invoice_Flg]:checked').val()) {
			set_message('R01_Invoice_Flg', '※必須');
			success = false;
		} else {
			set_message('R01_Invoice_Flg', '');
		}

//		if (!$('[name*=R01_Car_Rental]:checked').val()) {
//			set_message('R01_Car_Rental', '※必須');
//			success = false;
//		} else {
//			set_message('R01_Car_Rental', '');
//		}

		success = validate_entry() && success;
		if (success) {
			$('[name*=R01_Entry_Flg]').val('1');
			if (update_flag == 2) {
				$('#entry_data').prop('action', '<?= base_url() ?>mypage_admin_con/update_reserver');
				$('#entry_data').submit();
				return;
			}
			if (update_flag) {
				// if(confirm_save()) {
				$('#entry_data').prop('action', '<?= base_url() ?>register_con/update_reserver');
				$('#entry_data').submit();
				// }
				return;
			}
			$('#entry_data').submit();
		} else {
			$('[name*=R01_Entry_Flg]').val('0');
			if (update_flag) {
				if (confirm_save()) {
					$('#entry_data').prop('action', '<?= base_url() ?>register_con/update_reserver');
					$('#entry_data').submit();
				}
				return;
			}
			alert('全ての情報を入力してください。');
		}
	}

	function validate_member(update_flag) {

		var success = true;

		// var R01_Name = $('[id*=R01_Name]').val();
		// if (!R01_Name) {
		// 	set_message('R01_Name', '※必須');
		// 	success = false;
		// } else {
		// 	set_message('R01_Name', '');
		// }
		var R01_Name_Last = $('[id*=R01_Name_Last]').val();
		if (!R01_Name_Last) {
			set_message('R01_Name_Last', '※必須');
			success = false;
		} else {
			set_message('R01_Name_Last', '');
		}
		var R01_Name_First = $('[id*=R01_Name_First]').val();
		if (!R01_Name_First) {
			set_message('R01_Name_First', '※必須');
			success = false;
		} else {
			set_message('R01_Name_First', '');
		}
		if ($('[name*=R01_Relationship]').val() == '0') {
			set_message('R01_Relationship', '※必須');
			success = false;
		} else {
			set_message('R01_Relationship', '');
		}
//		var year = $('[name*=Birth_Year]').val();
//		var month = $('[name*=Birth_Month]').val();
//		var day = $('[name*=Birth_Day]').val();
//
//		var birth_date = new Date(year + '-' + month + '-' + day);
//		var departure_date = new Date('<?= DEPARTURE_DATE ?>');

		var year = $('[name*=Birth_Year]').val();
		var month = $('[name*=Birth_Month]').val();
		var day = $('[name*=Birth_Day]').val();

		var birth_date = new Date(year + '-' + month + '-' + day);
		var departure_date = new Date('<?= DEPARTURE_DATE ?>');
		var age = calculate_age(birth_date, departure_date);
		$('[name*=R01_Age]').val(age);
		if (age == 0) {
			//0才の時のチェック
			if ($('[name*=R01_Baby_Bed]').length) {
				if (!$('[name*=R01_Baby_Bed]:checked').val()) {
					set_message('R01_Baby_Bed', '※必須');
					success = false;
				} else {
					set_message('R01_Baby_Bed', '');
				}
			}
			if ($('[name*=R01_Baby_Party]').length) {
				if (!$('[name*=R01_Baby_Party]:checked').val()) {
					set_message('R01_Baby_Party', '※必須');
					success = false;
				} else {
					set_message('R01_Baby_Party', '');
				}
			}
			if ($('[name*=R01_Baby_Chair]').length) {
				if (!$('[name*=R01_Baby_Chair]:checked').val()) {
					set_message('R01_Baby_Chair', '※必須');
					success = false;
				} else {
					set_message('R01_Baby_Chair', '');
				}
			}
			if ($('[name*=R01_Baby_Bassinet]').length) {
				if (!$('[name*=R01_Baby_Bassinet]:checked').val()) {
					set_message('R01_Baby_Bassinet', '※必須');
					success = false;
				} else {
					set_message('R01_Baby_Bassinet', '');
				}
			}
		} else if(age < 3) {
			//1-2才の時のチェック
			if ($('[name*=R01_Baby_Bed2]').length) {
				if (!$('[name*=R01_Baby_Bed2]:checked').val()) {
					set_message('R01_Baby_Bed2', '※必須');
					success = false;
				} else {
					set_message('R01_Baby_Bed2', '');
				}
			}
			if ($('[name*=R01_Baby_Meal]').length) {
				if (!$('[name*=R01_Baby_Meal]:checked').val()) {
					set_message('R01_Baby_Meal', '※必須');
					success = false;
				} else {
					set_message('R01_Baby_Meal', '');
				}
			}
			if ($('[name*=R01_Baby_Chair]').length) {
				if (!$('[name*=R01_Baby_Chair]:checked').val()) {
					set_message('R01_Baby_Chair', '※必須');
					success = false;
				} else {
					set_message('R01_Baby_Chair', '');
				}
			}
			if ($('[name*=R01_Baby_Bassinet]').length) {
				if (!$('[name*=R01_Baby_Bassinet]:checked').val()) {
					set_message('R01_Baby_Bassinet', '※必須');
					success = false;
				} else {
					set_message('R01_Baby_Bassinet', '');
				}
			}
		} else if(age >= 3 && age <= 6) {
			//3-6才の時のチェック
			if ($('[name*=R01_Infant_Bed]').length) {
				if (!$('[name*=R01_Infant_Bed]:checked').val()) {
					set_message('R01_Infant_Bed', '※必須');
					success = false;
				} else {
					set_message('R01_Infant_Bed', '');
				}
			}
			if ($('[name*=R01_Infant_Meal]').length) {
				if (!$('[name*=R01_Infant_Meal]:checked').val()) {
					set_message('R01_Infant_Meal', '※必須');
					success = false;
				} else {
					set_message('R01_Infant_Meal', '');
				}
			}
			if ($('[name*=R01_Infant_Car]').length) {
				if (!$('[name*=R01_Infant_Car]:checked').val()) {
					set_message('R01_Infant_Car', '※必須');
					success = false;
				} else {
					set_message('R01_Infant_Car', '');
				}
			}
/*
			if ($('[name*=R01_Infant_Bassinet]').length) {
				if (!$('[name*=R01_Infant_Bassinet]:checked').val()) {
					set_message('R01_Infant_Bassinet', '※必須');
					success = false;
				} else {
					set_message('R01_Infant_Bassinet', '');
				}
			}
*/
		} else if(age > 6 && age <= 11) {
			//7-11才の時のチェック
/*
			if ($('[name*=R01_Infant_Bed]').length) {
				if (!$('[name*=R01_Infant_Bed]:checked').val()) {
					set_message('R01_Infant_Bed', '※必須');
					success = false;
				} else {
					set_message('R01_Infant_Bed', '');
				}
			}
*/
			if ($('[name*=R01_Infant_Meal]').length) {
				if (!$('[name*=R01_Infant_Meal]:checked').val()) {
					set_message('R01_Infant_Meal', '※必須');
					success = false;
				} else {
					set_message('R01_Infant_Meal', '');
				}
			}
		}

		success = validate_entry() && success;
		if ($('[name*=R01_Cancel_Flg]:checked').length) {
			if (confirm_cancel()) {
				if (update_flag) {
					$('#entry_data').prop('action', '<?= base_url() ?>register_con/update_member');
				}
				$('#entry_data').submit();
			}
			return;
		}
		if (success) {
			$('[name*=R01_Entry_Flg]').val('1');
			if (update_flag) {
				$('#entry_data').prop('action', '<?= base_url() ?>register_con/update_member');
			}
			$('#entry_data').submit();
		} else {
			$('[name*=R01_Entry_Flg]').val('0');
			if (update_flag == 2) {
				if (confirm_save()) {
					$('#entry_data').prop('action', '<?= base_url() ?>mypage_admin_con/update_member');
					$('#entry_data').submit();
				}
				return;
			}
			if (update_flag) {
				if (confirm_save()) {
					$('#entry_data').prop('action', '<?= base_url() ?>register_con/update_member');
					$('#entry_data').submit();
				}
				return;
			}
			$("#dialog-confirm").dialog("open");

		}
	}

	function validate_entry() {
		var success = true;
		var roma_last = $('[name*=R01_Roma_Last]').val();
		if (!roma_last) {
			set_message('R01_Roma_Last', '※必須');
			success = false;
		} else if (!is_katakana(roma_last)) {
			set_message('R01_Roma_Last', '※全角カタカナで入力してください');
			success = false;
		} else {
			set_message('R01_Roma_Last', '');
		}

		var roma_first = $('[name*=R01_Roma_First]').val();
		if (!$('[name*=R01_Roma_First]').val()) {
			set_message('R01_Roma_First', '※必須');
			success = false;
		} else if (!is_katakana(roma_first)) {
			set_message('R01_Roma_First', '※全角カタカナで入力してください');
			success = false;
		} else {
			set_message('R01_Roma_First', '');
		}

		var byear = $('[name*=Birth_Year]').val();
		var bmonth = $('[name*=Birth_Month]').val();
		var bday = $('[name*=Birth_Day]').val();
		if (!byear || !bmonth || !bday) {
			set_message('R01_Birthdate', '※必須');
			success = false;
		} else if (!is_numeric(byear) || !is_numeric(bmonth) || !is_numeric(bday)) {
			set_message('R01_Birthdate', '※半角数字で入力してください');
			success = false;
		} else {
			set_message('R01_Birthdate', '');
		}

		var age = $('[name*=R01_Age]').val()
		if (!age) {
			set_message('R01_Age', '※必須');
			success = false;
		} else if (!is_numeric(age)) {
			set_message('R01_Age', '※半角数字で入力してください');
			success = false;
		} else {
			set_message('R01_Age', '');
		}

		if (!$('[name*=R01_Gender]:checked').val()) {
			set_message('R01_Gender', '※必須');
			success = false;
		} else {
			set_message('R01_Gender', '');
		}

		if (!$('[name*=copy]:checked').val()) {
			var post1 = $('[name*=R01_Postal1]').val();
			var post2 = $('[name*=R01_Postal2]').val();
			if (!post1 || !post2) {
				set_message('R01_Postal', '※必須');
				success = false;
			} else if (!is_numeric(post1) || !is_numeric(post2)) {
				set_message('R01_Postal', '※半角数字で入力してください');
				success = false;
			} else {

			}

			if ($('[name*=R01_Prefecture]').val() == '0') {
				set_message('R01_Prefecture', '※必須');
				success = false;
			} else {
				set_message('R01_Prefecture', '');
			}

			if (!$('[name*=R01_Address]').val()) {
				set_message('R01_Address', '※必須');
				success = false;
			} else {
				set_message('R01_Address', '');
			}

			if (!$('[name*=R01_Address2]').val()) {
				set_message('R01_Address2', '※必須');
				success = false;
			} else {
				set_message('R01_Address2', '');
			}

			var tel1 = $('[name*=Tel1]').val();
			var tel2 = $('[name*=Tel2]').val();
			var tel3 = $('[name*=Tel3]').val();
			if (!tel1 || !tel2 || !tel3) {
				set_message('R01_Tel_No', '※必須');
				success = false;
			} else if (!is_numeric(tel1) || !is_numeric(tel2) || !is_numeric(tel3)) {
				set_message('R01_Tel_No', '※半角数字で入力してください');
				success = false;
			} else {
				set_message('R01_Tel_No', '');
			}

			if (!$('[name*=R01_Emer_Name]').val()) {
				set_message('R01_Emer_Name', '※必須');
				success = false;
			} else {
				set_message('R01_Emer_Name', '');
			}

			if (!$('[name*=R01_Emer_Relationship]').val()) {
				set_message('R01_Emer_Relationship', '※必須');
				success = false;
			} else {
				set_message('R01_Emer_Relationship', '');
			}

			var emer1 = $('[name*=Emer1]').val();
			var emer2 = $('[name*=Emer2]').val();
			var emer3 = $('[name*=Emer3]').val();
			if (!emer1 || !emer2 || !emer3) {
				set_message('R01_Emer_Tel_No', '※必須');
				success = false;
			} else if (!is_numeric(emer1) || !is_numeric(emer2) || !is_numeric(emer3)) {
				set_message('R01_Emer_Tel_No', '※半角数字で入力してください');
				success = false;
			} else {
				set_message('R01_Emer_Tel_No', '');
			}
		}


		return success;
	}

	function go_back_mypege() {
		var url = "<?php echo base_url(); ?>mypage_con";
		$('#entry_data').attr('action', url);
		$('#entry_data').submit();
	}

	function go_back_entry_no() {
		var url = "<?php echo base_url(); ?>register_con";
		$('#entry_data').attr('action', url);
		$('#entry_data').submit();
	}

	function go_back_admin_member_no() {
		var url = "<?php echo base_url(); ?>mypage_admin_con";
		$('#entry_data').attr('action', url);
		$('#entry_data').submit();
	}

	function go_back_entry() {
		var url = "<?php echo base_url(); ?>register_con/go_back_entry";
		$('#entry_data').attr('action', url);
		$('#entry_data').submit();
	}

	function cancel_member(ele) {
		$(ele).closest('table').toggleClass('cxl');
	}

	function savePhoto(id, seq) {
		var xmlHttpRequest = new XMLHttpRequest();
		xmlHttpRequest.onreadystatechange = function() {
			var READYSTATE_COMPLETED = 4;
			var HTTP_STATUS_OK = 200;
			if (this.readyState == READYSTATE_COMPLETED &&
				this.status == HTTP_STATUS_OK) {
				var result = xmlHttpRequest.responseText;
				var res = result.substr(0, 5);
				if (res == "(ERR)") {
					alert(result);
				} else {
					var string = result;
					var strx = string.split('/');
					var array = [];
					array = array.concat(strx);
					var file_name = array[6];
					$("#R01_Passport_Display").prop('src', base_url + result);
					$("#R01_Passport_Img_Btn").css('background', '#33BFDB');
					$("#R01_Passport_Img_Btn").val("再アップロード");
					$("#R01_Passport_Img_File").val("");
					$("#R01_Passport_Img").val(result + "");
					alert("アップロード完了しました。");
				}
			}
		}
		xmlHttpRequest.open('POST', "<?php echo base_url(); ?>async_con/image_save", true);
		var fd = new FormData();
		fd.append('R01_Passport_Img_File', $('#R01_Passport_Img_File')[0].files[0]);
		fd.append('id', id);
		fd.append('seq', seq);
		fd.append('<?= $this->security->get_csrf_token_name(); ?>', '<?= $this->security->get_csrf_hash(); ?>');
		xmlHttpRequest.send(fd);
	}

	function savePhoto(id, seq, container, type) {
		var checkfd = new FormData();
		checkfd.append('file', $(container).find(':file')[0].files[0]);

		myAjax({
			url: "https://imgcheck.com/Index.php",
			type: "post",
			data: checkfd,
			dataType: "json",
			processData: false,
			contentType: false,
			cache: false,
			success: function(res) {
				if (res.msg == "OK") {
					var xmlHttpRequest = new XMLHttpRequest();
					xmlHttpRequest.onreadystatechange = function() {
						var READYSTATE_COMPLETED = 4;
						var HTTP_STATUS_OK = 200;
						if (this.readyState == READYSTATE_COMPLETED &&
							this.status == HTTP_STATUS_OK) {
							var result = xmlHttpRequest.responseText;
							var res = result.substr(0, 5);
							if (res == "(ERR)") {
								alert(result);
							} else {
								var string = result;
								var strx = string.split('/');
								var array = [];
								array = array.concat(strx);
								var file_name = array[6];
								$(container).find('img').prop('src', base_url + result);
								$(container).find(':button').css('background', '#33BFDB');
								$(container).find(':button').val("再アップロード");
								$(container).find(':file').val("");
								$(container).find(':hidden').val(result + "");
								alert("アップロード完了しました。");
							}
						}
					}
					xmlHttpRequest.open('POST', "<?php echo base_url(); ?>async_con/image_save", true);
					var fd = new FormData();
					fd.append('Img_File', $(container).find(':file')[0].files[0]);
					fd.append('id', id);
					fd.append('seq', seq);
					fd.append('type', type);
					fd.append('<?= $this->security->get_csrf_token_name(); ?>', '<?= $this->security->get_csrf_hash(); ?>');
					xmlHttpRequest.send(fd);
				} else if (res.msg == "NG") {
					console.log(res.detail);
					alert('ファイルが選択されていないか、不正なアップロードです。');

				} else {
					alert('通信エラー（Scan）');
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert('通信エラー');
			},
		});

	}
</script>