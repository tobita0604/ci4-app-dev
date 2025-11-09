<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
<!-- Section1 about---------------------------------------------------> <section id="about">
<div id="main">


<div id="systemMsg"></div>
<div style="white-space:nowrap">
<div class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">マイ<br class="nobr">ページ</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-2em" class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">本人<br class="nobr">登録</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-4em" class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">同伴者<br class="nobr">登録</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-6em" class="arrow-container">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">情報<br class="nobr">確認</div>
	<div id="zz" class="arrow-right"></div>
</div>
<div style="left:-8em" class="arrow-container current">
	<div id="zz" class="arrow-left"></div>
	<div id="zz" class="arrow-ctr">登録<br class="nobr">完了</div>
	<div id="zz" class="arrow-right"></div>
</div>
</div>
<!-- フォーム -->
<form action="<?php echo base_url();?>register_con" method="post" autocomplete="off">
<h2 style ="background:#005084">EPC2024　エントリー　完了</h2>

<h1 style="color: #f00;">お申込みを受付ました</h1>
	<?php 
	if (isset($reload_flag) && $reload_flag == 1) {
	?>
<p>
	<label style="color: red;font-weight: bold;font-size: large;">
	処理中に異常が発生しました。<br>
	（ブラウザの戻るボタンや、当画面の再読込が行われた可能性があります）。<br>
	下の「完了」ボタンを押してマイページにて登録内容をご確認ください。
	</label>
</p>
	<?php 
	}
	?>

<p>&nbsp;</p>
<p>&nbsp;</p>

<div class="comp center">
  <p>この度は「EPC2024」に参加申込をいただき、誠にありがとうございます。<br>
  マイページにて内容の確認、オプショナルツアー、北海道内の移動について、ゴルフコンペの申込み、および同伴者登録をお願いいたします。</p>
  <p>&nbsp;</p>
  ご不明な点がございましたら、下記事務局あてにお問い合わせください。
  <p>&nbsp;</p>
 
</div>


<div style="text-align: center">
<div class="his-button" style="border-radius: 5px;"><a href="<?php echo base_url(); ?>register_con" ><img style="width: fit-content;" src="<?php echo base_url(); ?>img/mypage.png"></a>  
</div>
</div>
</form>




</div>
</section>
