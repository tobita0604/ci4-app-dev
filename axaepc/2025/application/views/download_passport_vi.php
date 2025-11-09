<script>
$(function(){
	$('a[disabled]').click(function(e){
		e.preventDefault();
	});
});
function alldownload()
{
	var form = document.createElement( 'form' );
	document.body.appendChild( form );
 	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'R01_Id' );
	input_1.setAttribute( 'value' , $('#R01_Id').val());
	form.appendChild( input_1 );
	
	form.setAttribute( 'action' , "<?php echo base_url();?>download_con/download_passport" );
	
	form.setAttribute( 'method' , 'post' );
	// 指示されたタゲットの名前を設定
	form.setAttribute( 'target' , '_blank');
	
	form.submit();
	
}

</script>

	<p style ="border-bottom:2px solid #ccc;"></p>
	
	<div style ="width: 1150px;
    margin: 0 auto;
    position: relative;
    clear: both;">
	<div class="title-header">
				<div>
					<form action = "<?php echo base_url();?>menu_con" name = "back_menu" method="post">
						<h1>パスポート画像ダウンロード画面</h1>
						<input type="submit" style="float: right; margin: 0 auto; margin-bottom: 10px; " name="menu_back" value="Menu" onclick="backMenu()">
					</form>
				</div>
		<hr></hr>
	</div>
	
	
	
	<br>
	<div style = "width: 1200px; margin: 0 auto;">
		<!-- SEARCH FORM START -->

<input type="button" name="alldownload" value="全件一括ダウンロード" onclick="alldownload();"/>	
<form action="<?php echo base_url(); ?>download_con/passport" method="post" name="search" id="search">
	<div class="yoko" id="yoko" 
		<dl>
			<dt>登録ID(半角)</dt>
			<dd>
				<input type="text" name="R01_Id" id="R01_Id" size="30" value="<?php if (isset($searchKey['R01_Id'])) {echo $searchKey['R01_Id'];}?>"/>
			</dd>
		</dl>
	</div>

				
			<hr />
			<p align="center" class="submit">
				<input type="submit" name="searchbtn" value="検索" id="searchbtn" />
			</p>
			<div style="margin: 0 auto; margin-left: 5px">
				<span style="float:right;font-size:120%;font-weight:bold;" ><?php echo $count_resever;?>件</span>
				<input type='hidden' value=<?php echo $count_resever;?> id = "count"/> 
				
			</div>
			
			</form><!-- Check with type_login = 2 or 9 -->	
			<div align="center" > 
			<table class="border2" width="100%">
				<tr>
					<th>登録ID</th>
					<th>支店名</th>
					<th>お名前</th>
					<th>プレビュー　</br>※クリックしてダウンロード</th>
				</tr>
				
				<?php 
				$seq = 0;
			
				if($result != null) {
					foreach ($result  as $data ) {
						
						$seq = $seq +1;
						if($seq % 2 == 0){
							$bgc = "#ADD8E6";
						}else{
							$bgc = "#FFFFFF";
						}
						//DarkGray (削除)またキャンセル
						if($data['R01_Cancel_Flg'] == '1'){
							$bgc = "#A9A9A9";
						}
				?>
				<tr>
					<td style="text-align:center;white-space:nowrap">
						<?=$data['R01_Id'];?>
						<?=!empty($data['R01_Cancel_Flg'])?'キャンセル':'';?>
					</td>
					<td>
						<?=$data['R01_Branch_Name'];?>
					</td>
					 
                    <td>
						<?=$data['R01_Name'];?>
					</td>
                    <td style="text-align:center" >
						<a download href="<?=base_url().$data['R01_Passport_Img']?>" <?=empty($data['R01_Passport_Img'])?'disabled':'' ?>>
						<img alt="アップロードしてください" onerror="this.onerror=null;this.src='<?=base_url()?>img/noupload.png';" src="<?=base_url().$data['R01_Passport_Img']?>" style="max-width:300px"/>
						</a>
					</td>
				
				</tr>
				<?php
					}
				} else {
				?>
				<tr>
				<td colspan ="4" style="text-align:center" >データがありません。</td>
				</tr>
				<?php
				}
				?>
			</table><!-- Check with type_login = 0 or 1 -->
			
			</div>
	</div>
</body>
</html>	