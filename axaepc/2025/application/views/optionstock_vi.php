<p style="border-bottom:2px solid #ccc;"></p>
<div style="width: 1150px; margin: 0 auto; position: relative; clear: both;">
	<div class="title-header">
		<div>
			<form action="<?php echo base_url(); ?>menu_con" name="back_menu" method="post">
				<h1>予約状況確認画面</h1>
				<input type="submit" style="float: right; margin: 0 auto; margin-bottom: 10px; " name="menu_back" value="Menu" onclick="backMenu()">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			</form>
		</div>
		<hr>
		</hr>
	</div>


	<p style="text-align: center; margin-top: 50px; font-size: 20px;">OP予約状況
	<p>
	<div align="center">

		<?php
		// 並び順を定義
		$order = ['S01', 'H01', 'S02', 'H02'];

		// 並び順通りにデータを並べ替える
		$ordered_stock = [];
		foreach ($order as $id) {
			foreach ($stock as $value) {
				if ($value['M01_id'] === $id) {
					$ordered_stock[] = $value;
					break;
				}
			}
		}
		?>

		<table class="border2" width="100%" style="width: 1000px; margin: 0 auto;">
			<thead>
				<tr>
					<th style="text-align: center;" colspan="2">
						OP名
					</th>
					<th style="text-align: center;">
						日付
					</th>
					<th style="text-align: center;">
						総数
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($ordered_stock as $value) : ?>
					<?php
					$m01_id = $value['M01_id'];
					$m01_name = trim($value['M01_Name']);
					$r02_date = trim($value['R02_Date']);

					// 対応する予約数を取得（列名はM01_idに応じて Total が変わる）
					$reserve_key = $m01_id . '_Total';
					$reserve_count = isset($value[$reserve_key]) ? $value[$reserve_key] : 0;
					?>
					<tr>
						<td><?= $m01_id ?></td>
						<td><?= $m01_name ?></td>
						<?php if ($value['M01_id'] == "S01" || $value['M01_id'] == "S02") : ?>
							<td style="text-align: right;" rowspan="2"><?= $r02_date ?></td>
						<?php endif; ?>
						<td style="text-align: center;"><?= $reserve_count ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<!-- <table class="border2" width="100%" style="width: 1000px; margin: 0 auto;">

			<tr>
				<th style="text-align: center;" colspan="2">
					OP名
				</th>
				<th style="text-align: center;">
					日付
				</th>
				<th style="text-align: center;">
					総数
				</th>
			</tr>
			<?php foreach ($stock as $value) : ?>
				<tr>
					<td style="text-align: center;" rowspan="1">
						<?= $value['M01_id'] ?>
					</td>
					<td style="text-align: center;" rowspan="1">
						<?= trim($value['M01_Name']) ?>
					</td>
					<td style="text-align: center;" rowspan="2">
						<?= trim($value['R02_Date']) ?>
					</td>
					<?php if ($value['M01_id'] == "S01") : ?>
						<td style="text-align: center;" rowspan="1">
							<?= $value['S01_Total'] ?>
						</td>
					<?php elseif ($value['M01_id'] == "H01") : ?>
						<td style="text-align: center;" rowspan="1">
							<?= $value['H01_Total'] ?>
						</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>
		</table> -->

		<?php
		echo '<br>';
		echo '<br>';
		?>

	</div>
</div>