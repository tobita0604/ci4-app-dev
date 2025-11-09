<div style="margin-top: 2em;">
	<div id="main" style="float: left; margin-top: 1px;">
		<div style="float: left">こんにちは <?php echo $R00_Sei;?> <?php echo $R00_Name;?> 様</div>
		<div style="clear: both;">&nbsp;</div>
<?php
	if($R00_Flight_Id != "XX"){
?>
		<p align="left">
			今回のご旅行用に「旅のしおり」をご用意しております。詳細が載っていますので、必ずご覧ください。<br>
			「旅のしおりダウンロード」ボタンからご確認ください。
		</p>
		<p align="right"><a href="<?php echo base_url(); ?>pdf/<?php echo $R00_Shiori; ?>" download="<?php echo $R00_Shiori; ?>"><input name="button" value="旅のしおりダウンロード" style="width: 160px; height: 30px" type="submit"></a>
</p>
	</div>
</div>
<div style="clear: both;"></div>
<section id="about">
	<div id="main">
		<div class="boxpost">
			
			<h2 style="margin-top: 0;">ご案内</h2>
			<table class="form" width="100%">
				<tbody>
					<tr>
						<th width="18%" class="back_skybule" >ホテル</th>
						<td>
							プランテーション ベイ リゾート アンド スパ<br/>
							(Plantation Bay Resort and Spa) <br/>
							■住所<br/>
							MARIGONDON MACTAN ISLAND 6015 CEBU PHILIPPINES<br/>
							■電話/FAX<br/>
							(032)5059800／(032)3405988<br/>
						</td>
					</tr>
<?php
	switch	($R00_Flight_Id) {
		case	"1P":
?>
					<tr>
						<th width="18%" class="back_skybule" >
							１班　フィリピン航空<br/>
							フライトスケジュール
						</th>
						<td>
							2月5日（月）　フィリピン航空435便　成田空港／セブ　（09:35／14:05）<br/>
							2月7日（水）　フィリピン航空436便　セブ／成田空港　（15:00／20:30）
						</td>
					</tr>
<?php
			break;
		case	"2P":
?>
					<tr>
						<th width="18%" class="back_skybule" >
							２班　フィリピン航空<br/>
							フライトスケジュール
						</th>
						<td>
							2月6日（火）　フィリピン航空435便　成田空港／セブ　（09:35／14:05）<br/>
							2月8日（木）　フィリピン航空436便　セブ／成田空港　（15:00／20:30）
						</td>
					</tr>
<?php
			break;
		case	"1V":
?>
					<tr>
						<th width="18%" class="back_skybule" >
							１班　バニラエア<br/>
							フライトスケジュール
						</th>
						<td>
							2月5日（月）　バニラエア601便　成田空港／セブ　（10:00／14:30）<br/>
							2月7日（水）　バニラエア604便　セブ／成田空港　（15:20／20:55）
						</td>
					</tr>
<?php
			break;
		case	"2V":
?>
					<tr>
						<th width="18%" class="back_skybule" >
							２班　バニラエア<br/>
							フライトスケジュール
						</th>
						<td>
							2月6日（火）　バニラエア601便　成田空港／セブ　（10:00／14:30）<br/>
							2月8日（木）　バニラエア604便　セブ／成田空港　（15:20／20:55）
						</td>
					</tr>
					<?php
			break;
		case	"VIP":
?>
					<tr>
						<th width="18%" class="back_skybule" >
							フライトスケジュール
						</th>
						<td>
							2月5日（月）　フィリピン航空435便　成田空港／セブ　（09:35／14:05）<br/>
							2月8日（木）　フィリピン航空436便　セブ／成田空港　（15:00／20:30）
						</td>
					</tr>
<?php
			}
?>
					<tr>
						<th width="18%" class="back_skybule" >オプション（2日目）</th>
						<td>
						
<?php
			switch	($R00_Optional){
				case	1:
					echo "観光";
					break;
				case	2:
					echo "ゴルフ　レンタルクラブ：";
					if($R00_Option_golf==1){
						echo "(右)";
					}else{
						if($R00_Option_golf==2){
							echo "(左)";
						}else{
							echo "持参";
						}
					}
					echo "<br><br>";
					echo "【ゴルフをお申込みの方へ】<br>";
					echo "自己負担23,000円を<span style='color:red;'>2/2（金）までに</span>、下記の口座にお振込みをお願いいたします。<br>レンタルクラブをお申込みの方は、レンタル費2,000円も合算してお振込みください。<br>";
					echo "<br>";
					echo "三井住友銀行　近畿第一支店　普通口座　　4952792<br>口座名：近畿日本ツーリスト株式会社（キンキニッポンツーリスト）<br><br>※請求書をご希望の方は、近畿日本ツーリスト　第３営業支店までご連絡ください。<br>電話：03-6891-9303（担当：堀口・山田　徹）";
					break;
				case	9:
					echo "自由行動";
					break;
			}
?>
				<br/>
						</td>
					</tr>
	
				</tbody>
			</table>
			
			<h2 style="margin-top: 0;">お手荷物</h2>
			<table class="form" width="100%">
				<tbody>
<?php if($R00_BusinessClass == 0) { ?>				
<?php
	switch	($R00_Flight_Id) {
		case	"1P":
		case	"2P":
?>
	
					<tr>
						<!--<th width="14%">航空会社</th>-->
						<th width="12%">受託/持ち込み</th>
						<th width="46%">サイズ</th>
						<th width="14%">重量</th>
						<th width="14%">個数</th>
					</tr>
					<tr>
						<!--<td width="14%" rowspan="2">フィリピン航空</td>-->
						<td width="12%">受託手荷物</td>
						<td>3辺（縦・横・高さ）の和が158cm以内<br/>※キャスターと持ち手を含む</td>
						<td>23kg／個</td>
						<td>2個</td>
					</tr>
					<tr>
						<td width="12%" class="back_skybule">機内持ち込み手荷物</td>
						<td>サイズ指定なし</td>
						<td>合計が7kg以内</td>
						<td>手荷物1個<br/>身の回り品1個</td>
					</tr>
<?php
			break;
		case	"1V":
		case	"2V":
?>
					<tr>
						<!--<td width="14%" rowspan="2">バニラエア</td>-->
						<td width="12%">受託手荷物</td>
						<td>3辺（縦・横・高さ）の和が203cm以内、かつ一辺の長さが120cm以内　　※キャスターと持ち手を含む<br/>★ゴルフバックお預け　参考料金　片道3，000円（1バッグ）</td>
						<td>20kg/個</td>
						<td>1個</td>
					</tr>
					<tr>
						<td width="12%" class="back_skybule">機内持ち込み手荷物</td>
						<td>各辺が55cmＸ40cmＸ25cm以内かつ、3辺の合計が115cm以内　　※キャスターと持ち手を含む<br/>
							★1辺でも規定サイズを超えた物は持込みできません。<br/>
							★ご自身で購入されて機内に持ち込みになったアルコール飲料は、機内でお飲みいただけません。（機内販売のアルコールのみ飲酒可能）</td>
						<td>合計が7kg以内</td>
						<td>手荷物1個<br/>身の回り品1個</td>
					</tr>

<?php
			}
}			
?>


<?php
	switch	($R00_BusinessClass) {
		case	"1":
?>

					<tr>
						
						<th>フィリピン航空</th>
						<th>サイズ</th>
						<th>重量</th>
						<th>個数</th>
					</tr>
					<tr>
						<td width="12%" class="back_skybule">受託手荷物</td>
						<td>3辺（縦・横・高さ）の和が158cm以内　　※キャスターと持ち手を含む</td>
						<td>32kg／個</td>
						<td>2個</td>
					</tr>
					<tr>
						<td width="12%" class="back_skybule">機内持ち込み手荷物</td>
						<td>サイズ指定なし</td>
						<td>合計が7kg以内</td>
						<td>手荷物1個　身の回り品1個</td>
					</tr>
<?php
			}
?>



				</tbody>
			</table>
			<h2 style="margin-top: 0; margin-bottom: 10px !important;">ご集合案内</h2>
			<div style="float: right; margin-bottom: 10px !important;">
<!--
				<form name="pdf_download" id="pdf_download" method="post"
					action="<?php echo site_url();?>downloadpdf_con"
					target="blank">
					<input name="button" value="PDFダウンロード"
						style="width: 150px; height: 30px" type="submit">
				</form>
-->
			</div>
			<br>
<?php
	switch	($R00_BusinessClass) {
		case	"1":
?>
			<!--<p align="center">決定しましたら、ご案内いたします。</p>		-->
			<div class="shugo_info">
				<table class="group-table-title">
					<tbody>
						<tr>
							<th><b>フィリピン航空</b></th>
						</tr>
					</tbody>
				</table>
				<br>
				<table class="form center" width="100%">
					<tbody>
						<tr>
							<td style="width: 10%;">ご集合</td>
							<td style="width: 90%; font-size: 14px !important;">
<?php
			if(($R00_Flight_Id == "VIP") || (substr($R00_Flight_Id,0,1)=="1")){
				echo "				2月5日（月曜日）　07:35";
			}else{
				if(substr($R00_Flight_Id,0,1)=="2"){
					echo "				2月6日（火曜日）　07:35";
				}
			}
?>
							</td>
						</tr>
						<tr>
							<td>ご集合場所</td>
							<td style="width: 90%; font-size: 14px !important;">
								成田国際空港　第2旅客ターミナル　3階国際線出発ロビー　北団体カウンター20・21・22・23番
							</td>
						</tr>
						<tr>
							<td>ご出発便</td>
							<td style="width: 90%; font-size: 14px !important;">
								フィリピン航空435便　09:35出発予定
							</td>
						</tr>
						<tr>
							<td>ご出発当日<br>緊急連絡先
							</td>
							<td style="width: 90%; font-size: 14px !important;">
								近畿日本ツーリスト　成田空港サービスセンター　　TEL：0476-34-8777（7時～22時）
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>			
<?php
	}
?>			
			
<?php  if($R00_BusinessClass == 0) { ?>			
<?php
	switch	($R00_Flight_Id) {
		case	"1P":
		case	"2P":
?>
			<!--<p align="center">決定しましたら、ご案内いたします。</p>		-->
			<div class="shugo_info">
				<table class="group-table-title">
					<tbody>
						<tr>
							<th><b>フィリピン航空</b></th>
						</tr>
					</tbody>
				</table>
				<br>
				<table class="form center" width="100%">
					<tbody>
						<tr>
							<td style="width: 10%;">ご集合</td>
							<td style="width: 90%; font-size: 14px !important;">
<?php
			if(substr($R00_Flight_Id,0,1)=="1"){
				echo "				2月5日（月曜日）　07:35";
			}else{
				if(substr($R00_Flight_Id,0,1)=="2"){
					echo "				2月6日（火曜日）　07:35";
				}
			}
			
?>
							</td>
						</tr>
						<tr>
							<td>ご集合場所</td>
							<td style="width: 90%; font-size: 14px !important;">
								成田国際空港　第2旅客ターミナル　3階国際線出発ロビー　北団体カウンター20・21・22・23番
							</td>
						</tr>
						<tr>
							<td>ご出発便</td>
							<td style="width: 90%; font-size: 14px !important;">
								フィリピン航空435便　09:35出発予定
							</td>
						</tr>
						<tr>
							<td>ご出発当日<br>緊急連絡先
							</td>
							<td style="width: 90%; font-size: 14px !important;">
								近畿日本ツーリスト　成田空港サービスセンター　　TEL：0476-34-8777（7時～22時）
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
<?php
			break;
		case	"1V":
		case	"2V":
?>
			<div class="shugo_info">
				<table class="group-table-title">
					<tbody>
						<tr>
							<th><b>バニラエア</b></th>
						</tr>
					</tbody>
				</table>
				<br>
				<table class="form center" width="100%">
					<tbody>
						<tr>
							<td style="width: 10%;">ご集合</td>
							<td style="width: 90%; font-size: 14px !important;">
<?php
			if(substr($R00_Flight_Id,0,1)=="1"){
				echo "				2月5日（月曜日）　08:00";
			}else{
				if(substr($R00_Flight_Id,0,1)=="2"){
					echo "				2月6日（火曜日）　08:00";
				}
			}
?>
							</td>
						</tr>
						<tr>
							<td>ご集合場所</td>
							<td style="width: 90%; font-size: 14px !important;">
								成田国際空港　第3旅客ターミナル　2階出発ロビー　W団体カウンター<br/>
								※第2旅客ターミナルから、アクセス通路を歩いて約15分（500メートル）。ターミナル間の連絡バスにて約5分。<br/>
								※JR／京成電車の駅はございません。第2旅客ターミナルからのご移動になります。
							</td>
						</tr>
						<tr>
							<td>ご出発便</td>
							<td style="width: 90%; font-size: 14px !important;">
								バニラエア601便　10:00出発予定
							</td>
						</tr>
						<tr>
							<td>ご出発当日<br>緊急連絡先
							</td>
							<td style="width: 90%; font-size: 14px !important;">
								近畿日本ツーリスト　成田空港サービスセンター　　TEL：0476-34-8777（7時～22時）
							</td>
						</tr>
					</tbody>
				</table>
			</div>
<?php
			break;
		}
}		
?>
		</div>
		<!-- Post -->
		<!-- Main end -->
		<form name="reloadForm" id="reloadForm" action="" method="post">
		</form>
<?php
}else{
?>
		<p align="left">
			ご案内はございません。<br>
		</p>
<?php
	}
?>
	</div>
</section>
