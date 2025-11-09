<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
	<!-- Section1 about--------------------------------------------------->
	<style>
		th.required::after {
			content: "[必須]";
			color: red;
			font-weight: bold
		}

		table.border2 tr.gai th {
			background: #ffff99;
		}

		table.border2 tr.cxl th,
		table.border2 tr.gai.cxl th {
			background: #e5e5e5;
		}

		table.border2 tr.gai th::after {
			content: "自費";
			color: red;
		}

		a {
			color: black;
		}

		a:hover {
			color: black;
		}

		a:visited {
			color: black;
		}
	</style>
	<section id="about">
		<div id="main">
			<!-- システムメッセージ -->
			<div id="systemMsg"></div>
			<div style="white-space:nowrap">
				<div class="arrow-container current">
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
				<div style="left:-8em" class="arrow-container">
					<div id="zz" class="arrow-left"></div>
					<div id="zz" class="arrow-ctr">登録<br class="nobr">完了</div>
					<div id="zz" class="arrow-right"></div>
				</div>
			</div>
			<?php if (!empty($this->session->flashdata('error'))): ?>
				<div class="panel-body">
					<div class="alert alert-danger" role="alert" style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; padding: 15px; margin-bottom: 20px;">
						<?= $this->session->flashdata('error') ?>
					</div>
				</div>
			<?php endif; ?>
			<form action="<?php echo base_url(); ?>register_con/save_entry_no" method="post" autocomplete="off" id="entry_data">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
				<h2 style="background:#005084">EPC2024　<?= $reserve['R01_Entry_Flg'] == '1' ? 'マイページ' : 'エントリーフォーム' ?></h2>
				<?php
				//入力締め切り制御
				$allcancel = $common['R01_allcancel'];

				$today = date('Y-m-d H:i:s');
				$this->entry_limit = $this->config->item('entry_limit');
				if (($today < $this->entry_limit) || ($common['R01_reentry'] == 1)) {
				?>
					<p style="font-weight: bolder; color: #f00">
						※必要事項をご入力の上、マイページにてご本人・同伴者の登録状況が「登録済」になるよう全ての登録をお済ませください。<br>
						※同伴者のご登録は一部の情報入力途中でも仮保存ができます。<br>
						※登録完了後は、ページ上のログアウトをクリックしてください。<br>
						<!--※申込希望者本人がご入力ください。<br>
	※お一人様当たり１回のお申込みです。<br>
	※参加登録フォームは30分でタイムアウトとなります。ご注意ください。<br>-->
					</p>
					<p style="font-weight: bolder; color: #f00">
						※参加登録フォームは３０分でタイムアウトとなります。ご注意ください。<br>
						※申し込み締め切り前は変更可能です。<br>
						※締め切り日以降、変更の際は事務局までご連絡ください。<br>
						※一度登録した自費参加者人数は「追加」ができません。追加をご希望の場合はEPC2024事務局までご連絡ください。<br>
					</p>
				<?php
				} else {
				?>
					<p style="font-weight: bolder; color: #f00">
						参加登録受付は終了しました。<br><br>
					</p>
				<?php
				}
				?>
				<table class="border2" width="100%" style="margin-bottom: 15px !important;">

					<?php
					if ($allcancel == 0) {
					?>
						<tr>
							<th class="required">個人情報の取り扱い</th>
							<td>
								<input type="checkbox" id="R01_Confirm_Flg" value="1" <?= !empty_date($common['R01_Update_Date']) ? 'checked disabled' : '' ?> /> <span style="font-size:20px;font-weight:bold;">同意します</span>
								<?= !empty_date($common['R01_Update_Date']) ? '' : '<span style="color:red;">※個人情報の取り扱いについて下記をお読みになりチェックしてください。</span><br>' ?>
								<p>
									入力いただくお客様の個人情報は、お客様との連絡及び当該旅行サービスの提供のために利用させていただきます。<br>
									また、お申込みいただいた当該旅行サービスの手続きに必要な範囲内で、手配代行者に対しお客様の個人情報を提供いたします。<br>
									<br>プライバシー全文は<a href="https://www.knt.co.jp/privacy/web/" target="_blank"><span style="color:#000; font-weght: bold;"><u>こちら</u></span></a>をご覧ください。
								</p>
							</td>
						</tr>
					<?php
					}
					?>
					<tr>
						<th width="30%">支社名（2024年所属）</th>
						<td>
							<?= h($common['R01_Branch_Name']) ?>
						</td>
					</tr>
					<tr>
						<th>お名前</th>
						<td>
							<?= h($reserve['R01_Name']) ?>
						</td>
					</tr>
					<tr>
						<th>入賞者カテゴリー</th>
						<td>
							<?= get_label('カテゴリ', h($common['R01_Category_Flg'])) ?><br>
							<!--<?= h($common['R01_Category_Flg']) == 'E1' ? DIAMOND_NOTE : '' ?>-->
							<!-- <p>
					招待権１名分を使ってビジネスクラスへの変更を可能とします。<br>
					但し、フライトの混雑により、ご希望に添えない場合があります。<br>
					（１名分→１名様、フライトは先着順、同日の場合は同日着との抽選） <br>
					ご希望の際は備考欄へご記入いただくか、事務局へご連絡ください。<br>
				</p> -->
						</td>
					</tr>
					<!--
		<tr>
			<th>１Q家族招待CP</th>
			<td>
				<?= get_label('1Q', h($common['R01_1Q_Flg'])) ?>
			</td>
		</tr>
-->
					<!--
		<tr>
			<th>４Qオプショナルツアー招待CP</th>
			<td>
				<?= get_label('4Q', h($common['R01_4Q_Flg'])) ?>
			</td>
		</tr>
-->
					<!--
		<tr>
			<th>xx無料権利</th>
			<td>
				<?= get_label('パーク', h($common['R01_Park_Flg'])) ?>
				<?= h($common['R01_Park_Flg']) == '1' ? PARK_NOTE : '' ?>
			</td>
		</tr>
-->
					<tr>
						<th>招待人数（本人含む）</th>
						<td>
							<?= h($common['R01_Free_Invites']) ?><!--<?= INVITES_NOTE ?>-->
						</td>
					</tr>
					<?php
					if ($allcancel == 0) {
					?>
						<tr>
							<th>自費参加者</th>
							<td>
								<input type="hidden" name="common[R01_Charge_Invites]" value="<?= h($common['R01_Charge_Invites']) ?>" />
								<?php
								if ($reserve['R01_Entry_Flg'] == '1'):
									echo h($common['R01_Charge_Invites']);
								else: ?>
									<select name="common[R01_Charge_Invites]" onchange="invite_changed(this)">
										<?php $total_charge_person = 11 - $common['R01_Free_Invites']; ?>
										<?php for ($i = 0; $i < $total_charge_person; $i++): ?>
											<option value="<?= $i ?>" <?= $i == $common['R01_Charge_Invites'] ? 'selected' : '' ?>><?php echo $i ?></option>
										<?php endfor; ?>
									</select>
									　自費参加者の人数は登録後の追加ができませんのでご注意ください。
								<?php endif; ?>
							</td>
						</tr>
						<tr>
							<th>支社別 交通移動一覧</th>
							<td>
								<!--支社別 交通移動一覧は<a href="<?php echo base_url(); ?>pdf/Transportation_ EPC2024.pdf" target="_blank"><span style="color:#000; font-weght: bold;"><u>こちら</u></span></a>をご覧ください。-->
								<!-- 支社別 交通移動一覧は<a href="https://www.kntbc.jp/EPC2024/scjl/index.html" target="_blank"><span style="color:#000; font-weght: bold;"><u>こちら</u></span></a>をご覧ください。 -->
								支社別 交通移動一覧は<a href="https://www.kntbc.jp/epc2024/scjl/index.html" target="_blank"><span style="color:#000; font-weght: bold;"><u>こちら</u></span></a>をご覧ください。
							</td>
						</tr>
					<?php
					}
					?>
				</table>
			</form>
			<!--<p style="margin-bottom: 15px;">※オプショナルツアーやレンタカーのご案内は6月中を予定しております。</p>-->
			<?php if ($reserve['R01_Entry_Flg'] == '1'): ?>
				<input type="hidden" name="common[R01_Free_Invites]" value="<?= h($common['R01_Free_Invites']) ?>" />
				<table class="border2" width="100%" style="margin-bottom: 1em;">
					<tr class="invite" id="invite0">
						<th colspan="1"></th>
						<th colspan="1" style="text-align: left;">登録状況</th>
						<th colspan="1" style="text-align: left;border-right: none;">登録および確認はこちら</th>
						<th colspan="1" style="text-align: right;border-left: none;"><a href="<?php echo base_url(); ?>pdf/axa_m0131.pdf" target="_blank"><u>※同伴者<span style="color:red;">自費</span>の場合ご料金一覧</u></a></th>
					</tr>
					<tr class="invite" id="invite0">
						<th style="width:30%">ご本人様</th>
						<td colspan="1">
							<?php
							if ($allcancel == 1) {
							?>
								不参加
							<?php
							} else {
							?>
								登録済
							<?php
							}
							?>
						</td>
						<td colspan="2">
							<?php
							//入力締め切り制御
							$today = date('Y-m-d H:i:s');
							$this->entry_limit = $this->config->item('entry_limit');
							if (($today < $this->entry_limit) && ($common['R01_reentry'] == 1)) {
							?>
								<form action="<?php echo base_url(); ?>register_con/regist_reserver" method="post">
									<?php require(APPPATH . "views/element/csrf_input.php"); ?>
									<input type="submit" name="back_to_top" value="詳細" />
								</form>
							<?php
							} else {
							?>
								<form action="<?php echo base_url(); ?>register_con/regist_reserver" method="post">
									<?php require(APPPATH . "views/element/csrf_input.php"); ?>
									<input type="submit" name="back_to_top" value="詳細確認" />
								</form>
							<?php
							}
							?>
						</td>
					</tr>
					<?php
					if (!empty($invites)):
						for ($no = 1; $no < 10; $no++):
							$idx = $no - 1;
					?>
							<tr class="invite <?= !empty($invites[$idx]['R01_Cancel_Flg']) ? 'cxl' : '' ?>" id="invite<?= $no ?>">
								<th>
									■<?= $no >= $common['R01_Free_Invites'] ? '' : '招待' ?>同伴者<?= $no ?>
								</th>
								<td>
									<?php
									if (!empty($invites[$idx]['R01_Cancel_Flg'])):
										echo '不参加';
									elseif (!empty($invites[$idx]['R01_Entry_Flg'])):
										echo '登録済';
									else:
										echo '<span style="color: red;">未登録</span>';
									endif;
									?>
								</td>
								<td>
									<?php
									//入力締め切り制御
									$today = date('Y-m-d H:i:s');
									$this->entry_limit = $this->config->item('entry_limit');
									if (($today < $this->entry_limit) && ($common['R01_reentry'] == 1)) {
									?>
										<form action="<?php echo base_url(); ?>register_con/regist_member" method="post" style="display:inline-block">
											<?php require(APPPATH . "views/element/csrf_input.php"); ?>
											<input type="hidden" name="idx" value="<?= h($idx) ?>" />
											<input type="submit" name="back_to_top" value="詳細" />
										</form>
										<?php if (empty($invites[$idx]['R01_Cancel_Flg'])):	?>
											<form action="<?php echo base_url(); ?>register_con/cancel_member" method="post" style="display:inline-block">
												<?php require(APPPATH . "views/element/csrf_input.php"); ?>
												<input type="hidden" name="idx" value="<?= h($idx) ?>" />
												<input type="submit" value="参加しない" onclick="return confirm_cancel()" />
											</form>
										<?php endif; ?>
									<?php
									} else {
									?>
										<form action="<?php echo base_url(); ?>register_con/regist_member" method="post" style="display:inline-block">
											<?php require(APPPATH . "views/element/csrf_input.php"); ?>
											<input type="hidden" name="idx" value="<?= h($idx) ?>" />
											<input type="submit" name="back_to_top" value="詳細確認" />
										</form>
									<?php
									}
									?>
								</td>
								<td>
									<?php
									if (($today < $this->entry_limit) || ($common['R01_reentry'] == 1)) {
										if (($invites[$idx]['R01_Entry_Flg'] != 1) && ($invites[$idx]['R01_Cancel_Flg'] != 1)) {
									?>
											登録済になるよう入力ください。
										<?php
										} else {
										?>
											&nbsp;
										<?php
										}
									} else {
										?>
										&nbsp;
									<?php
									}
									?>
								</td>
							</tr>
					<?php
						endfor;
					endif;
					?>
				</table>
				<?php
				//入力締め切り制御
				$today = date('Y-m-d H:i:s');
				$this->entry_limit = $this->config->item('entry_limit');
				if (($today < $this->entry_limit) && ($common['R01_reentry'] == 1)) {
				?>
					<?php
					if (($common['R01_Free_Invites'] + $common['R01_Charge_Invites']) > 1) {
						//echo "count=".count($invites)."<br>";
						//var_dump($invites);
					?>
						<p style="font-size: 14px; color:red;">※同伴者登録を完了後、＜未登録＞表示の場合は、入力漏れ、または入力間違いがありますので、　再度登録内容をご確認ください。</p>
						<!--
<p style="font-size: 12px; line-height: 1.75rem; margin-top: 3px;">
■同伴者様ご入力について：入力途中でも保存し、完了するこができますが、締切日（5/13）までには<br>
必須項目についてはご入力いただき、表示が「済」になりますようお願い申し上げます。
</p>
-->
						<div style="text-align: center;margin-top:1em;">
							<div class="his-button" style="border-radius: 5px;">
								<input type="image" src="<?php echo base_url(); ?>img/next_passengers.png" onclick="validate_entry_no(1);" />
							</div>
						<?php
					}
						?>
						</div>
					<?php
				}
					?>

					<?php
					// 表示制御
					$this->current_date = date('Y-m-d H:i:s');
					$this->mypage_option_limit = date('Y-m-d H:i:s', strtotime($this->config->item('mypage_option_limit')));
					$this->mypage_option_4q_limit = date('Y-m-d H:i:s', strtotime($this->config->item('mypage_option_4q_limit')));
					$option_datetime = !empty($common['R01_4Q_Flg']) ? $this->mypage_option_4q_limit : $this->mypage_option_limit;
					?>
					<br><br>
					<table class="border2" width="100%" style="margin-bottom: 0px;;">
						<tr>
							<th width="100%" colspan="3">
								申込み・確認はこちら
							</th>
						</tr>
						<tr>
							<th width="33%">オプショナルツアー</th>
							<th width="33%">北海道内の移動について</th>
							<th width="33%">ゴルフコンペ</th>
						</tr>
						<tr>
							<td class="center">
								<?php if ($option_datetime <= $this->current_date): ?>
									<button><a href="<?php echo base_url(); ?>Option_con" style=" text-decoration: none;">申し込み</a></button>
								<?php else: ?>
									<button><a style=" text-decoration: none;">7月6日10：00から受付開始</a></button>
								<?php endif; ?>
							</td>
							<td class="center">
								<button value="申し込み"><a href="<?php echo base_url(); ?>Transfer_con" style=" text-decoration: none;">登　録</a></button>
							</td>
							<td class="center">
								<button value="申し込み"><a href="<?php echo base_url(); ?>Golf_con" style=" text-decoration: none;">申し込み</a></button>
							</td>
						</tr>
					</table>
					<!-- <p style="font-size: 12px; line-height: 1.75rem; margin-top: 3px;">※ご宿泊ホテル「ヒルトン沖縄北谷リゾート」開催のキッズアクティビティについては<br>　7月末に開催内容が決定されるため、それからのご案内となります。</p> -->
					<?php
					// 表示制御
					$this->current_date = date('Y-m-d H:i:s');
					$this->mypage_golf_limit = date('Y-m-d H:i:s', strtotime($this->config->item('mypage_golf_limit')));
					$this->mypage_car_limit = date('Y-m-d H:i:s', strtotime($this->config->item('mypage_car_limit')));
					?>
					<!--
	<?php if ($this->mypage_car_limit <= $this->current_date): ?>
		<br><br>
		<table class="border2" width="100%" style="margin-bottom: 0px;;">
			<tr>
				<th>レンタカー</th>
			</tr>
			<tr>
				<td class="center">
					<button value="申し込み"><a href="<?php echo base_url(); ?>CarRental_con" style=" text-decoration: none;">申し込み</a></button>
				</td>
			</tr>
		</table>
	<?php endif; ?>
	<?php if ($this->mypage_golf_limit <= $this->current_date): ?>
		<br><br>
		<table class="border2" width="100%" style="margin-bottom: 0px;;">
			<tr>
				<th>ゴルフコンペ</th>
			</tr>
			<tr>
				<td class="center">
					<button value="申し込み"><a href="<?php echo base_url(); ?>Golf_con" style=" text-decoration: none;">申し込み</a></button>
				</td>
			</tr>
		</table>
	<?php endif; ?>
-->
				<?php else: ?>
					<div style="text-align: center;margin-top:1em;">
						<div class="his-button" style="border-radius: 5px;">
							<?php
							if ($allcancel == 1) {
							?>
								<div style="align:center;font-size:18px;color:red;font-weight:bold;">
									「不参加として受付済」
								</div>
							<?php
							} else {
							?>
								<input type="image" src="<?php echo base_url(); ?>img/next.png" onclick="validate_entry_no();" />
							<?php
							}
							?>
						</div>
					</div>
				<?php endif; ?>

	</section>