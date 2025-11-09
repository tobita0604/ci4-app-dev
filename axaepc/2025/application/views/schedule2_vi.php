<div style="margin-top: 2em;">
	<div id="main" style="float: left; margin-top: 1px;">
		<div style="float: left">こんにちは <?php echo $R00_Sei;?> <?php echo $R00_Name;?> 様</div>
		<div style="float: right; margin-bottom: 10px !important;">
				<form name="pdf_download" id="pdf_download" method="post" action="https://aw.knt.co.jp/reinvent_demo/downloadpdf_con" target="blank">
					<input name="button" value="PDFダウンロード" style="width: 150px; height: 30px" type="submit">
				</form>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>
<div style="clear: both;"></div>
<section id="about">
	<div id="main">
		<div class="boxpost">

			<h2 style="margin-top: 0;">旅行行程</h2>
			<table class="form" width="100%">
				<tbody>
					<tr>
						<th width="12%" class="back_skybule" rowspan="4">利用航空便</th>
						<th width="12%" class="back_skybule">フライト<br>スケジュール
						</th>
						<td colspan="6">
							2018-02-05 PR 435 羽田 / セブ島  (  9:35 / 14:05 )<br/>
							2018-02-07 PR 436 セブ島 / 羽田  ( 15:00 / 20:30 )
						</td>
					</tr>
					<tr>
						<th class="back_skybule" rowspan="3">お手荷物</th>
						<th colspan="3">受託手荷物(お預けになるお荷物)</th>
						<th colspan="3">機内持込み手荷物</th>
					</tr>
					<tr>
						<th style="width: 20%;">サイズ</th>
						<th style="width: 8%;">重量</th>
						<th style="width: 6%;">個数</th>
						<th style="width: 22%;">サイズ</th>
						<th style="width: 10%;">重量</th>
						<th style="width: 10%;">個数</th>
					</tr>
					<tr>
						<td>3辺(縦・横・高さ)の和が<br/>
							<u>203cm</u>以内
							<br/>
							※キャスターと持ち手を含む
						</td>
						<td><u>23kg</u>/個</td>
						<td>2個</td>
						<td>３辺(縦・横・高さ)の和が<br/>
							<u>115cm</u>以内<br/>
							※キャスター・持ち手を含む
						</td>
						<td>合計が<u>10kg</u>以内
						</td>
						<td style="text-align: left !important;">
							手荷物1個<br/>
							身の回り品1個
						</td>
					</tr>
					<tr>
						<th rowspan="2" class="back_skybule">利用ホテル</th>
						<th class="back_skybule">ホテル</th>
						<td colspan="6">プランテーション ベイ リゾート アンド スパ<br>
							(Plantation Bay Resort and Spa)
						</td>
					</tr>
					<tr>
						<th class="back_skybule">部屋タイプ</th>
						<td colspan="6">2名1室                      ※ご同室者は、現地到着後、ご案内いたします</td>
					</tr>
					<tr>
						<th rowspan="1" class="back_skybule">オプショナルツアー</th>
						<th class="back_skybule">2日目</th>
						<td colspan="6">
						<?php if($R00_Optional=="1"){?>
							観光
						<?php }else if($R00_Optional=="1"){?>
							ゴルフ　レンタル：
							<?php 
								if($R00_Option_golf=="0"){
									echo "無し";
								}else if($R00_Option_golf=="1"){
									echo "右";
								}else if($R00_Option_golf=="0"){
									echo "左";
								}
							?>
						<?php }else{?>
							自由活動
						<?php }?>
						</td>
					</tr>
				</tbody>
			</table>
			<h2 style="margin-top: 0; margin-bottom: 10px !important;">ご集合案内</h2>
			<div style="float: right; margin-bottom: 10px !important;">
				<form name="pdf_download" id="pdf_download" method="post"
					action="https://aw.knt.co.jp/reinvent_demo/downloadpdf_con"
					target="blank">
					<input name="button" value="PDFダウンロード"
						style="width: 150px; height: 30px" type="submit">
				</form>
			</div>
			<br>
			<!--<p align="center">決定しましたら、ご案内いたします。</p>		-->
			<div class="shugo_info">
				<table class="group-table-title">
					<tbody>
						<tr>
							<th><b>ご出発当日のご案内</b></th>
						</tr>
					</tbody>
				</table>
				<br>
				<table class="form center" width="100%">
					<tbody>
						<tr>
							<td style="width: 10%;">ご集合</td>
							<td style="width: 90%; font-size: 14px !important;">
								
							</td>
						</tr>
						<tr>
							<td>ご集合場所<br>
							<span style="font-size: 10px !important;">(下記図参照)</span></td>
							<td style="width: 90%; font-size: 14px !important;">
								
							</td>
						</tr>
						<tr>
							<td>ご出発便</td>
							<td style="width: 90%; font-size: 14px !important;">
								
							</td>
						</tr>
						<tr>
							<td>ご出発当日<br>緊急連絡先
							</td>
							<td style="width: 90%; font-size: 14px !important;">
								
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
		</div>
		<!-- Post -->
		<!-- Main end -->
		<form name="reloadForm" id="reloadForm" action="" method="post">
		</form>
	</div>
</section>
