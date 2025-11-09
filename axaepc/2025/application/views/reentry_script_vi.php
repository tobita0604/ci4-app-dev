<script>
	var sub_window = "";

	$(document).on("click", "#ReEntry", function() {
		var reentry_flg;
		var reentry_msg;

		var _reentry_flg = $(this).data('reentry');
		var id = $(this).data('id');
		var url = '<?= base_url() ?>Reentry_con/entrychange';

		// 許可中なら停止中に、停止中なら許可中に、flagを変更
		if(_reentry_flg == 0){
			reentry_flg = 1;
			reentry_msg = '入力[許可]してよろしいですか？（現在：停止中）';
		} else {
			reentry_flg = 0;
			reentry_msg = '入力[停止]してよろしいですか？（現在：許可中）';
		}

		var result = confirm(reentry_msg);
		if (result) {
			submit_hidden(url, {
				id: id,
				reentry_flg: reentry_flg,
				'<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
			}, 'post');
		} else {
			return false; // 処理を終了
		}
	});

	function backMenu() {
		sub_window.close();
	}

	window.onbeforeunload = function() {
		sub_window.close();
	}

	function submit_hidden(path, params, method) {
		method = method || "post";

		var form = document.createElement("form");
		form.setAttribute("method", method);
		form.setAttribute("action", path);

		for (var key in params) {
			if (params.hasOwnProperty(key)) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", key);
				hiddenField.setAttribute("value", params[key]);

				form.appendChild(hiddenField);
			}
		}

		document.body.appendChild(form);
		form.submit();
	}
</script>