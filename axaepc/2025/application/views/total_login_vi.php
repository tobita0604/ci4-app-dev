
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
				<h1>ログイン状況</h1>
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
		<table class="border" id = "table_rate" style="width: 900px; margin: 0 auto;">
			<tr>
				<th>ログイン済</th>
				<td style="text-align:center;"><?php echo $login[1]["logined"]." 名 / ".$login[3]["totalpax"]; ?> 名</td>
			</tr>
			<tr>
				<th>申込済</th>
				<td style="text-align:center;"><?php echo $login[2]["entryed"]." 名 / ".$login[1]["logined"]; ?> 名</td>
			</tr>
			<tr>
				<th>未ログイン</th>
				<td style="text-align:center;"><?php echo $login[0]["notlogin"]." 名 / ".$login[3]["totalpax"]; ?> 名</td>
			</tr>
		</table>	

		<p>&nbsp;</p>
	<!-- HIDDEN  -->
	</div>	
</div>
<!-- CONTENT END -->