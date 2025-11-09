<script>
document.addEventListener("DOMContentLoaded", function() {
	var lazyloadImages;    

	if ("IntersectionObserver" in window) {
		lazyloadImages = document.querySelectorAll(".lazy");
		var imageObserver = new IntersectionObserver(function(entries, observer) {
			entries.forEach(function(entry) {
				if (entry.isIntersecting) {
					var image = entry.target;
					image.src = image.dataset.src;
					image.classList.remove("lazy");
					imageObserver.unobserve(image);
				}
			});
		});

		lazyloadImages.forEach(function(image) {
			imageObserver.observe(image);
		});
	} else {  
		var lazyloadThrottleTimeout;
		lazyloadImages = document.querySelectorAll(".lazy");

		function lazyload () {
			if(lazyloadThrottleTimeout) {
				clearTimeout(lazyloadThrottleTimeout);
			}    

			lazyloadThrottleTimeout = setTimeout(function() {
				var scrollTop = window.pageYOffset;
				lazyloadImages.forEach(function(img) {
					if(img.offsetTop < (window.innerHeight + scrollTop)) {
						img.src = img.dataset.src;
						img.classList.remove('lazy');
					}
				});
				if(lazyloadImages.length == 0) { 
					document.removeEventListener("scroll", lazyload);
					window.removeEventListener("resize", lazyload);
					window.removeEventListener("orientationChange", lazyload);
				}
			}, 20);
		}

		document.addEventListener("scroll", lazyload);
		window.addEventListener("resize", lazyload);
		window.addEventListener("orientationChange", lazyload);
	}
});
$(function(){
	$('a[disabled]').click(function(e){
		e.preventDefault();
	});
});
function alldownload(name, val)
{
	var form = document.createElement( 'form' );
	document.body.appendChild( form );
 	var input_1 = document.createElement( 'input' );
	input_1.setAttribute( 'type' , 'hidden' );
	input_1.setAttribute( 'name' , 'R01_Id' );
	input_1.setAttribute( 'value' , $('#R01_Id').val());
	form.appendChild( input_1 );
	
	// secure
	var input_2 = document.createElement( 'input' );
	input_2.setAttribute( 'type' , 'hidden' );
	input_2.setAttribute( 'name' , name );
	input_2.setAttribute( 'value' , val );
	form.appendChild( input_2 );

	form.setAttribute( 'action' , "<?php echo base_url();?>download_con/download_photo" );
	
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
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
			</form>
		</div>
		<hr></hr>
	</div>
	
	
	
	<br>
	<div style = "width: 1200px; margin: 0 auto;">
		<!-- SEARCH FORM START -->

<input type="button" name="alldownload" value="全件一括ダウンロード" onclick="alldownload('<?= $this->security->get_csrf_token_name(); ?>','<?= $this->security->get_csrf_hash(); ?>');"/>	
<form action="<?php echo base_url(); ?>download_con/photo" method="post" name="search" id="search">
<?php require(APPPATH . "views/element/csrf_input.php"); ?>
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
				<?php if($this->session->userdata('charger_type')=='9'): ?>
				&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="R01_Test_Flg" id="R01_Test_Flg" value="0"/>
				<input type="checkbox" name="R01_Test_Flg" id="R01_Test_Flg" value="1" <?php if($searchKey['R01_Test_Flg'] == '1') {echo "checked"; }?>/>
				<label for="R01_Test_Flg">テストデータを除く</label>
				<?php endif;?>
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
						<a download="<?php echo download_name($data)?>" href="<?=base_url().$data['R01_Brochure_Img']?>" <?=empty($data['R01_Brochure_Img'])?'disabled':'' ?>>
						<img alt="アップロードしてください" onerror="this.onerror=null;this.src='<?=base_url()?>img/noupload.png';" data-src="<?=base_url().$data['R01_Brochure_Img']?>" style="max-width:300px" class="lazy"/>
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