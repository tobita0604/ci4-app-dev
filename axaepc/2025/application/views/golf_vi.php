<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
<!-- Section1 about---------------------------------------------------> 
<style>
	dl.tours{
		padding-left: 2em;
	}
	dl.tours dt {
		display:inline-block;
		vertical-align:top;
	}
	dl.tours dd {
		display:inline-block;
	}
	td.time {
		word-break:keep-all;
	}
	table.border2 td.avail {
		text-align:center;
		vertical-align:middle;
	}
	.btn,
	a.btn,
	button.btn {
	font-size: 1.3rem;
	font-weight: 700;
	line-height: 0.9;
	position: relative;
	display: inline-block;
	padding: 1rem 4rem;
	cursor: pointer;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-transition: all 0.3s;
	transition: all 0.3s;
	text-align: center;
	vertical-align: middle;
	text-decoration: none;
	letter-spacing: 0.1em;
	color: #212529;
	border-radius: 0.5rem;
	}
	.btn--orange,
	a.btn--orange {
	color: #fff;
	background-color: #eb6100;
	}
	.btn--orange:hover,
	a.btn--orange:hover {
	color: #fff;
	background: #f56500;
	}

	.btn--bule,
	a.btn--bule {
	color: #fff;
	background-color: #0027eb;
	}
	.btn--bule:hover,
	a.btn--bule:hover {
	color: #fff;
	background: #3b00eb;
	}
</style>
<section id="about">
<div id="main">
<!-- システムメッセージ -->
<div id="systemMsg"></div>
<form action="<?php echo base_url();?>Golf_con/save" method="post" autocomplete="off" id="golf_data" > 
	<h2 style ="background:#005084">EPC2024　ゴルフコンペ申込</h2>
	<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>"/>
	<?php if(!empty($this->session->tempdata('success_flash'))):?>
		<div class="alert alert-success" role="alert">
			<strong><?= $this->session->tempdata('success_flash');?></strong>
		</div>
	<?php endif;?>

	<table class="border2" width="100%" style="table-layout:fixed;margin-bottom:1em;">
		<tr>
			<th width="30%">オプショナルツアー<br>ご参加者名</th>
			<th width="10%">年齢</th>
			<th>ゴルフコンペ</th>
		</tr>
		<?php foreach($members as $member): ?>
			<tr <?=!empty($member['R01_Cancel_Flg'])?'hidden':''?>>
				<td>
				<?php
					echo h($member['R01_Name']);
				?>
				</td>
				<td>
				<?php
					$age = calculate_age($member['R01_Birthdate']);
					//if($age != -1) {
					if ($member['R01_Birthdate']!='0000-00-00') {
						echo $age.'才';
					}
				?>
				</td>

				<td>
					<select style="width:100%" name="option[<?=$member['R01_seq']?>][R02_Golf_Flg]" id="R02_Golf_Flg" onchange="golf_flag(this)">
						<option value="0">不参加</option>
						<option value="1" <?=$member['R02_Golf_Flg']=='1'?'selected':''?>>申込み</option>
					</select>

					<span class="club">
					クラブ
					<select style="width:100%" name="option[<?=$member['R01_seq']?>][R02_Golf_Club]" id="R02_Golf_Club">
						<option value="0">持参する</option>
						<option value="1" <?=$member['R02_Golf_Club']=='1'?'selected':''?>>レンタルクラブ（ゴルフ場へ直接予約）</option>
					</select>
					</span>
<!--
					<span class="shoes">
					レンタルシューズ
					<select style="width:100%" name="option[<?=$member['R01_seq']?>][R02_Golf_Shoes]" id="R02_Golf_Shoes">
						<option value="99">持参する</option>
						<?php
						for($size=22;$size<=28;$size+=0.5):
						?>
						<option value="<?=$size?>" <?=$member['R02_Golf_Shoes']==$size?'selected':''?>><?=$size?>cm</option>
						<?php
						endfor;
						?>
					</select>
-->
					備考
						<div>
							<textarea id="R02_Golf_Biko" name="option[<?=$member['R01_seq']?>][R02_Golf_Biko]" rows="4" cols="30"><?= h($member['R02_Golf_Biko']) ?></textarea>
						</div>
					</span>

				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<br>
	●ゴルフコンペ実施日　8月6日（水）

<div style="text-align: center;margin-top:1em;">
	<div class="his-button" style="border-radius: 5px;">
		<a onclick="go_conf_back();" class="btn btn--bule">戻る</a>
		&nbsp;&nbsp;&nbsp;
		<input type="submit" class="btn btn--orange" style="border:none" value="登録">
	</div>
</div>
</form>
<br><br><br><br>
<p>
	<strong>注意事項について</strong><br>
	<ul class="notes">
	<li>
	●申込みいただいた内容をキャンセルする場合は、再度申込み画面へ進み「申込み」を「不参加」へ戻し登録ボタンを押してください。	</li>
	<li>
	●クラブをレンタルする方について、現地にてお支払いをお願いいたします。
	</li>
	<li>
	●ゴルフ場はホテル併設のニセコビレッジリゾート内にございます。
	</li>
	<li>
	●コンペ当日は、ホテル内のロッカールームをご利用いただけます。
	</li>
	<li>
	●事前にゴルフバッグを送付する場は、<a href="https://www.kntbc.jp/ec/test/2025/axa_2024/op/golf.html" target="_blank">こちら</a>をご確認ください。
	</li>
<!--
	<li>
	●8月の沖縄はとても暑いため、熱中症などにお気を付けください。熱中症対策として、日焼け止め、お飲み物、氷嚢（ひょうのう）など各自にご用意をお願いいたします。
	</li>
-->
</p>

</div>
</section>