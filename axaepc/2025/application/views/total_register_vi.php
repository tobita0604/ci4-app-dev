
<script>
function refresh_yoyaku_data() {
	document.refresh_data.submit();
}
</script>
<style>
	td {
		background: white;
	}
	table.border th{
		color:#FFF;
		background:#77cc6d;
		border: 1px solid #000;
		padding: 3px 5px;
	}
	table.border th,td{
		vertical-align: middle;
	}	
	.title_c{
		margin: 0 auto;
		margin-bottom: 1em;
		width: 900px;
		clear: both;
		text-align: right;
	}
	table.con th {
		border-top:none !important;
		border-left:none !important;
		width:10%;
	}
	table.con td {
		border-right:none !important;
		border-top:none !important;
		width:90%;
		padding:3px!important;
		
	}
	table.con{
		width:100%;
	}
</style>

<p style ="border-bottom:2px solid #ccc;"></p>
<div style ="width: 1150px; margin: 0 auto; position: relative; clear: both;">
	<div class="title-header">
		<div>
			<form action = "<?php echo base_url();?>menu_con" name = "back_menu" method="post">
				<h1>登録状況</h1>
				<input type="submit" style="float: right; margin: 0 auto; margin-bottom: 10px; " name="menu_back" value="Menu" onclick="backMenu()">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			</form>
		</div>
		<hr></hr>
	</div>
<!-- CONTENT START -->
<div id="main-wrapper">
	<div align="center" > 
		<div class="title_c">
		<input type="button"  value="最新の情報更新" onclick="location.reload(); ">
		</div>
		<div style="clear:both"></div>
			<table class="border2" width="100%" style="width: 900px; margin: 0 auto;">
				<tr>
					<th colspan="3">入賞者</th>
					<th colspan="6">同伴者</th>
					<th rowspan="2">合計</th>
				</tr>
				<tr>
					<th>登録済</th>
					<th>未登録</th>
					<th>小計</th>
					<th>大人</th>
					<th>子供A(6-19)</th>
					<th>子供B(3-5)</th>
					<th>幼児(0-2)</th>
					<th>未登録</th>
					<th>小計</th>
				</tr>
				<tr>
					<td><?=$register[0]['entryedreserver']?>名</td>
					<td><?=$register[1]['notentryreserver']?>名</td>
					<?php $sum1=$register[0]['entryedreserver']+$register[1]['notentryreserver']?>
					<td><?=$sum1?>名</td>
					<td><?=$register[2]['entryedadultmember']?>名</td>
					<td><?=$register[3]['entryedchildmemberA']?>名</td>
					<td><?=$register[4]['entryedchildmemberB']?>名</td>
					<td><?=$register[5]['entryedchildmemberC']?>名</td>
					<td><?=$register[6]['notentrymember']?>名</td>
					<?php $sum2=$register[2]['entryedadultmember']+$register[3]['entryedchildmemberA']+$register[4]['entryedchildmemberB']+$register['5']['entryedchildmemberC']+$register[6]['notentrymember']	?>
					<td><?=$sum2?>名</td>
					<td><?=$sum1+$sum2?>名</td>
				</tr>
			</table><!-- Check with type_login = 0 or 1 -->

		</div>
	</div>
</body>
</html>			