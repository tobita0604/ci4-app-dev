<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
	<!-- Section1 about--------------------------------------------------->
	<style>
		dl.tours {
			padding-left: 2em;
		}

		dl.tours dt {
			display: inline-block;
			vertical-align: top;
		}

		dl.tours dd {
			display: inline-block;
		}

		td.time {
			word-break: keep-all;
		}

		table.border2 td.avail {
			text-align: center;
			vertical-align: middle;
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
			<form action="<?php echo base_url(); ?>option_con/save_option" method="post" autocomplete="off" id="option_data" onSubmit="return check_regist()">
				<h2 style="background:#005084">EPC2024 移動方法の登録　確認</h2>
				<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
				<input type="hidden" name="view_flg" value="7" />
				<?php if (!empty($this->session->tempdata('success_flash'))) : ?>
					<div class="alert alert-success" role="alert">
						<strong><?= $this->session->tempdata('success_flash'); ?></strong>
					</div>
				<?php endif; ?>

				<table class="border2" width="100%" style="table-layout:fixed">
					<tr>
						<th width="30%">ご参加者名</th>
						<th width="10%">年齢</th>
						<th>8/5（火）空港→会場/ホテル</th>
						<th>8/9（土）ホテル→空港</th>
					</tr>
					<?php foreach ($members as $member) : ?>
						<tr <?= !empty($member['R01_Cancel_Flg']) ? 'hidden' : '' ?>>
							<td>
								<?php
								echo $member['R01_Name'];
								?>
							</td>
							<td>
								<?php
								$age = calculate_age($member['R01_Birthdate']);
								if ($member['R01_Birthdate']!='0000-00-00') {
									echo $age . '才';
								}
								?>
							</td>

							<td>
								<?= !empty($member['R02_bus_dep']) && $member['R02_bus_dep'] == 0 ? '不参加' : '' ?>
								<?= !empty($member['R02_bus_dep']) && $member['R02_bus_dep'] == 1 ? 'シャトルバス' : '' ?>
								<?= !empty($member['R02_bus_dep']) && $member['R02_bus_dep'] == 2 ? 'レンタカー（各自予約）' : '' ?>
							<td>
								<?= !empty($member['R02_bus_arr']) && $member['R02_bus_arr'] == 0 ? '不参加' : '' ?>
								<?= !empty($member['R02_bus_arr']) && $member['R02_bus_arr'] == 1 ? 'シャトルバス' : '' ?>
								<?= !empty($member['R02_bus_arr']) && $member['R02_bus_arr'] == 2 ? 'レンタカー（各自予約）' : '' ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>


				<div style="text-align: center;margin-top:1em;">
					<div class="his-button" style="border-radius: 5px;">
						<a href="<?php echo base_url(); ?>option_con" style="margin-bottom: 10px;" class="btn btn--bule">戻る</a>
						&nbsp;&nbsp;&nbsp;
						<input type="submit" class="btn btn--orange" style="border:none; margin-bottom: 10px;" value="登録">
					</div>
				</div>

			</form>
			<br><br><br><br>

			<div id="contents">
				<section class="detail op_sp">
<!--
					<h2>オプショナルツアー</h2>
					<p class="mB20">沖縄での自由時間をより楽しく、有意義にお過ごしいただけますように、3月31日(金)、4月1日(土)にご参加いただけるオプショナルツアーをご用意いたしました。<br />
						ご参加をご希望の場合は、オプショナルツアー詳細をご参照の上、<strong><u>7月13日(水)までに専用サイトよりお申込みください。</u></strong></p>
					<p class="mB20">お支払いにつきましては、お申込み内容の確定後、8月上旬頃に近畿日本ツーリストコーポレートビジネスよりご請求書をお送りいたしますので、ご案内の期日(ご旅行開始前)までに各自お振込みまたはカードでのお支払いをお願いいたします。</p>
					<form name="defaultLink" method="post" action="https://etravels.jp/axa2024/" target="_blank">
						<input type="hidden" name="accpswd" value="axa2024">
					</form>
					<br />
					<p><strong>【注意事項】</strong><br />
						①コースは混載ツアーとなり、それぞれの催行人数は、詳細のご案内をご確認ください。<br />
						②一部のツアーは年齢制限や身長制限がございます。お申込み前に参加条件を必ずご確認ください。<br />
						※なお参加条件を満たしていなかった場合、当日ご参加をお断りすることがございます。その場合でもご返金はいたしかねますのであらかじめご了承ください。<br />
						③18歳未満の方のご参加は保護者の同伴を条件とします。<br />
						④催行人数により、ご指定いただいたお時間を変更していただく場合がございます。<br />
						⑤すべてのツアーにホテルからの往復送迎がついております。（権利放棄不可）<br />
						⑥夕食のお時間に重なるアクティビティもございますのでご注意ください。<br />
						⑦すべてのツアー（BC02おきなわワールド手作り体験を除く）には保険料が含まれております。<br />
						⑧必ず、各オプショナルツアーの注意事項をご確認の上、お申込みください。</p>
					<br />
					<p class="mt20"><strong>【キャンセルポリシー】</strong><br />
						お申込み後、お客様のご都合にてキャンセルをされる場合、お取消しされる日により、以下の通り既定の取消料が発生いたします。</p>
					<table class="mL20">
						<tr>
							<td></td>
							<td>お申込み期間</td>
							<td>無料</td>
						</tr>
						<tr>
							<td height="40">31日前まで</td>
							<td>お申込み期間終了～2022年7月22日(金)17:00</td>
							<td>10%</td>
						</tr>
						<tr>
							<td>30～21日前</td>
							<td>2022年7月22日(金)17:00～2022年8月2日(火)17:00</td>
							<td>20%</td>
						</tr>
						<tr>
							<td>20～11日前</td>
							<td>2022年8月2日(火)17:00～2022年8月12日(金)17:00</td>
							<td>50%</td>
						</tr>
						<tr>
							<td>10～3日前</td>
							<td>2022年8月12日(金)17:00～2022年8月19日(金)17:00</td>
							<td>80%</td>
						</tr>
						<tr>
							<td>2日前～当日または無連絡不参加</td>
							<td>2022年8月19日(金)17:00以降または無連絡不参加の場合</td>
							<td>100%</td>
						</tr>
					</table>

					<ul class="list">
						<li>※キャンセルのご連絡が休業日・営業時間外の場合、翌営業日の扱いとなりますので、あらかじめご了承ください。<br />
							　また、休業日・営業時間外にお送りいただいたお問合せは、翌営業日以降の返信となります。<br />
							&ensp;【営業日・営業時間】月～金 10:00～17:00　 (土・日・祝日・8/11～8/14は休み)　</li>
						<li>※第4Q入賞者の方で権利を使用してのお申込みの場合、取消料が発生するタイミングでのキャンセルの場合取消料は無料となりますが、権利放棄となります。</li>
					</ul>
					<br />
-->
					<div class="scroll mt50">
						<!--<p style="text-align: right;font-weight: bold;color: red;font-size: 120%;">※<span style="background-color: yellow;">　　　　　</span>は23日のみ実施の時間枠です。</p>-->
						<table class="border2" width="100%">
							<tr>
								<!--<th rowspan="2" width="7%">ID</th>-->
								<th rowspan="2" width="20%">ツアー名</th>
								<th colspan="3" width="20%">催行日</th>
								<th colspan="2" width="30%">料金</th>
								<th rowspan="2" width="15%">所要時間</th>
								<th rowspan="2" width="15%">参加条件</th>
							</tr>
							<tr>
								<th>8/6<br />(水)</th>
								<th>8/7<br />(木)</th>
								<th>8/8<br />(金)</th>
								<th>大人</th>
								<th>子供</th>
							</tr>
							<tr>
								<!--<td align="center">S01</td>-->
								<td rowspan="2">小樽観光コース </td>
								<td style="text-align:center">●</td>
								<td style="text-align:center">●</td>
								<td  style="text-align:center">&nbsp;</td>
								<td rowspan="2" align="center">9,999円<br>(18歳以上)</td>
								<td rowspan="2" align="center">9,999円</td>
								<td align="center">14:00-21:30</td>
								<td>夕食各自/乳幼児無料</td>
							</tr>
							<tr>
								<!--<td align="center">S01</td>-->
								<!--<td rowspan="2">小樽観光コース </td>-->
								<td style="text-align:center">&nbsp;</td>
								<td style="text-align:center">&nbsp;</td>
								<td  style="text-align:center">●</td>
								<!--<td align="center">2,500円<br>(18歳以上)</td>-->
								<!--<td align="center">1,800円(高校生)<br>1,000円(小・中学生)</td>-->
								<td align="center">9:00-16:00</td>
								<td>昼食各自/乳幼児無料</td>
							</tr>
							<tr>
								<!--<td align="center">S01</td>-->
								<td rowspan="2">洞爺湖・登別観光コース </td>
								<td style="text-align:center">●</td>
								<td style="text-align:center">●</td>
								<td  style="text-align:center">&nbsp;</td>
								<td rowspan="2" align="center">9,999円<br>(18歳以上)</td>
								<td rowspan="2" align="center">9,999円</td>
								<td align="center">10:30-19:00</td>
								<td>夕食各自/乳幼児無料</td>
							</tr>
							<tr>
								<!--<td align="center">S01</td>-->
								<!--<td rowspan="2">小樽観光コース </td>-->
								<td style="text-align:center">&nbsp;</td>
								<td style="text-align:center">&nbsp;</td>
								<td  style="text-align:center">●</td>
								<!--<td align="center">2,500円<br>(18歳以上)</td>-->
								<!--<td align="center">1,800円(高校生)<br>1,000円(小・中学生)</td>-->
								<td align="center">8:30-16:30</td>
								<td>昼食各自/乳幼児無料</td>
							</tr>
						</table>
					</div>
				</section>
			</div>
		</div>
	</section>
</div>