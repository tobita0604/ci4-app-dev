<p style="border-bottom:2px solid #ccc;"></p>
<div style="width: 1150px; margin: 0 auto; position: relative; clear: both;">
	<div class="title-header">
		<div>
			<form action="<?php echo base_url(); ?>menu_con" name="back_menu" method="post">
				<h1>移動方法状況確認画面</h1>
				<input type="submit" style="float: right; margin: 0 auto; margin-bottom: 10px; " name="menu_back" value="Menu" onclick="backMenu()">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			</form>
		</div>
		<hr>
		</hr>
	</div> <!-- Search Form -->
	<div>
		<p style="text-align: center; margin-top: 50px; font-size: 20px;">北海道内の移動方法</p>
		<div align="center">
			<table class="border2" width="100%" style="width: 500px; margin: 0 auto;">
				<tr>
					<th></th>
					<th colspan="2">シャトルバス</th>
					<th colspan="2">レンタカー（各自予約）</th>
				</tr>

				<?php if (!empty($result)): ?>
					<tr>
						<td style="text-align: center;">
							8/5（火）会場→ホテル
						</td>
						<td style="text-align: center;">
							<?= h(isset($result[0]['dep_bus']) ? $result[0]['dep_bus'] : 0) ?> 名
						</td>
						<td style="text-align: center;">
							<?= h(isset($result[0]['dep_bus_family']) ? $result[0]['dep_bus_family'] : 0) ?> 家族
						</td>
						<td style="text-align: center;">
							<?= h(isset($result[0]['dep_car']) ? $result[0]['dep_car'] : 0) ?> 名
						</td>
						<td style="text-align: center;">
							<?= h(isset($result[0]['dep_car_family']) ? $result[0]['dep_car_family'] : 0) ?> 家族
						</td>
					</tr>
					<tr>
						<td style="text-align: center;">
							8/9（土）ホテル→空港
						</td>
						<td style="text-align: center;">
							<?= h(isset($result[0]['arr_bus']) ? $result[0]['arr_bus'] : 0) ?> 名
						</td>
						<td style="text-align: center;">
							<?= h(isset($result[0]['arr_bus_family']) ? $result[0]['arr_bus_family'] : 0) ?> 家族
						</td>
						<td style="text-align: center;">
							<?= h(isset($result[0]['arr_car']) ? $result[0]['arr_car'] : 0) ?> 名
						</td>
						<td style="text-align: center;">
							<?= h(isset($result[0]['arr_car_family']) ? $result[0]['arr_car_family'] : 0) ?> 家族
						</td>
					</tr>
				<?php else: ?>
					<tr>
						<td style="text-align: center;">
							該当データがありません。
						</td>
					</tr>
				<?php endif; ?>
			</table>
		</div>
	</div>
</div>