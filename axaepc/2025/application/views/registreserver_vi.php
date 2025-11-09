<!-- CONTENTS-------------------------------------------------------------------------------------------------->
<div class="contents">
	<!-- Section1 about--------------------------------------------------->
	<style>
		th.required::after {
			content: "[必須]";
			color: red;
			font-weight: bold
		}

		.border2.gai th {
			background: #ffff99;
		}

		.gai tr:first-child th:first-child::after {
			content: "招待外";
			color: red;
		}
	</style>
	<section id="about">
		<div id="main">
			<!-- システムメッセージ -->
			<div id="systemMsg"></div>
			<div style="white-space:nowrap">
				<div class="arrow-container">
					<div id="zz" class="arrow-left"></div>
					<div id="zz" class="arrow-ctr">マイ<br class="nobr">ページ</div>
					<div id="zz" class="arrow-right"></div>
				</div>
				<div style="left:-2em" class="arrow-container current">
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
			<form action="<?php echo base_url(); ?>register_con/save_reserver" method="post" autocomplete="off" id="entry_data">
				<?php require(APPPATH . "views/element/csrf_input.php"); ?>
				<h2 style="background:#005084">EPC2024　参加受付　本人登録</h2>
				<table class="border2 invite" width="100%" id="invite0">
					<tr>
						<th width="30%">お名前</th>
						<td>
							<?= h($reserve['R01_Name']) ?>
							<input type="hidden" name="reserve[R01_Name]" value="<?= h($reserve['R01_Name']) ?>" />
						</td>
					</tr>
					<tr>
						<th>入賞者カテゴリー</th>
						<td>
							<?= get_label('カテゴリ', $common['R01_Category_Flg']) ?><br>
							<!--<?= $common['R01_Category_Flg'] == 'E1' ? DIAMOND_NOTE : '' ?>-->
						</td>
					</tr>
					<!--
		<tr>
			<th>１Q家族招待CP</th>
			<td>
				<?= get_label('1Q', $common['R01_1Q_Flg']) ?>
			</td>
		</tr>
-->
					<!--
		<tr>
			<th>４Qオプショナルツアー招待CP</th>
			<td>
				<?= get_label('4Q', $common['R01_4Q_Flg']) ?>
				<input type="hidden" name="R01_4Q_Flg" value="<?= $common['R01_4Q_Flg'] ?>">
			</td>
		</tr>
-->
					<!--
		<tr>
			<th>xx無料権利</th>
			<td>
				<?= get_label('パーク', $common['R01_Park_Flg']) ?>
				<?= $common['R01_Park_Flg'] == '1' ? PARK_NOTE : '' ?>
			</td>
		</tr>
-->
					<tr>
						<th>招待人数（本人含む）</th>
						<td>
							<?= h($common['R01_Free_Invites']) ?>
						</td>
					</tr>
					<tr>
						<th>自費参加者</th>
						<td>
							<?= h($common['R01_Charge_Invites']) ?><!--<?= INVITES_NOTE ?>-->
						</td>
					</tr>
				</table>
				<table class="border2 invite" width="100%" id="invite0">
					<tr>
						<th colspan="2">
							■ご本人様情報
							<input type="hidden" name="reserve[R01_Entry_Flg]" value="0" />
						</th>
					</tr>
					<tr>
						<th width="30%" class="required">お名前:姓（カタカナ）</th>
						<td>
							<input type="text" name="reserve[R01_Roma_Last]" id="R01_Roma_Last" value="<?= h($reserve['R01_Roma_Last']) ?>" />
							<span class="error_msg" id="R01_Roma_Last_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">お名前:名（カタカナ）</th>
						<td>
							<input type="text" name="reserve[R01_Roma_First]" id="R01_Roma_First" value="<?= h($reserve['R01_Roma_First']) ?>" />
							<span class="error_msg" id="R01_Roma_First_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">生年月日</th>
						<td>
							<?php
							$Number_arr = [];
							$Number_arr = explode_date($reserve['R01_Birthdate']);
							?>
							<input type="text" name="reserve[Birth_Year]" id="Birth_Year" value="<?= !empty($Number_arr[0]) ? h($Number_arr[0]) : '' ?>" size="4" class="digits" onchange="age_changed()" />年
							<input type="text" name="reserve[Birth_Month]" id="Birth_Month" value="<?= !empty($Number_arr[1]) ? h($Number_arr[1]) : '' ?>" size="4" class="digits" onchange="age_changed()" />月
							<input type="text" name="reserve[Birth_Day]" id="Birth_Day" value="<?= !empty($Number_arr[2]) ? h($Number_arr[2]) : '' ?>" size="4" class="digits" onchange="age_changed()" />日
							<span style="color:red;"><br>※生年月日は西暦からカレンダーで入力ください。基準日で年齢が自動表示されます。</span><br>
							<span class="error_msg" id="R01_Birthdate_error"></span>
						</td>
					</tr>
					<tr>
						<th>年齢<br><span style="color:red;">[自動表示]</span></th>
						<td>
							<input readonly type="text" name="reserve[R01_Age]" value="<?= h($reserve['R01_Age']) ?>" size="2" class="digits" />　<span style="color:red;">※<?= date('Y年m月d日', strtotime(DEPARTURE_DATE)); ?>基準</span><br>
							<span class="error_msg" id="R01_Age_error"></span4
									</td>
					</tr>
					<tr>
						<th class="required">性別</th>
						<td>
							<input type="hidden" name="reserve[R01_Gender]" value="0" />
							<input type="radio" id="R01_Gender_1" name="reserve[R01_Gender]" value="1" <?= '1' == $reserve['R01_Gender'] ? 'checked' : '' ?> />
							<label for="R01_Gender_1">男性</label><br>
							<input type="radio" id="R01_Gender_2" name="reserve[R01_Gender]" value="2" <?= '2' == $reserve['R01_Gender'] ? 'checked' : '' ?> />
							<label for="R01_Gender_2">女性</label><br>
							<p class="error_msg" id="R01_Gender_error"></p>
						</td>
					</tr>
					<tr>
						<th class="required">自宅郵便番号</th>
						<td>
							<input type="text" name="reserve[R01_Postal1]" value="<?= h($reserve['R01_Postal1']) ?>" size="3" class="digits" /> -
							<input type="text" name="reserve[R01_Postal2]" value="<?= h($reserve['R01_Postal2']) ?>" size="4" class="digits" />
							<span class="error_msg" id="R01_Postal_error"></span>
							<input type="button" value="住所検索" onclick="AjaxZip3.zip2addr('reserve[R01_Postal1]','reserve[R01_Postal2]','reserve[R01_Prefecture]','reserve[R01_Address]','reserve[R01_Address2]');" />
						</td>
					</tr>
					<tr>
						<th class="required">都道府県</th>
						<td>
							<select name="reserve[R01_Prefecture]">
								<option value="0" selected="selected">選択してください</option>
								<?php foreach (getPrefecture() as $id => $val): ?>
									<option value="<?php echo h($id) ?>" <?= $id == $reserve['R01_Prefecture'] ? 'selected' : '' ?>><?php echo $val ?></option>
								<?php endforeach; ?>
							</select>
							<span class="error_msg" id="R01_Prefecture_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">市区郡</th>
						<td>
							<input type="text" name="reserve[R01_Address]" value="<?= h($reserve['R01_Address']) ?>" size="35" />
							<span class="error_msg" id="R01_Address_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">町村名番地番号</th>
						<td>
							<input type="text" name="reserve[R01_Address2]" value="<?= h($reserve['R01_Address2']) ?>" size="35" />
							<span class="error_msg" id="R01_Address2_error"></span>
						</td>
					</tr>
					<tr>
						<th>建物名・部屋番号等</th>
						<td>
							<input type="text" name="reserve[R01_Address3]" value="<?= h($reserve['R01_Address3']) ?>" size="35" />
							<span class="error_msg" id="R01_Address3_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">連絡先電話番号</th>
						<td>
							<?php
							$Number_arr = [];
							$Number_arr = explode_date($reserve['R01_Tel_No']);
							?>
							<input type="text" name="reserve[Tel1]" value="<?= !empty($Number_arr[0]) ? h($Number_arr[0]) : '' ?>" size="4" /> -
							<input type="text" name="reserve[Tel2]" value="<?= !empty($Number_arr[1]) ? h($Number_arr[1]) : '' ?>" size="4" /> -
							<input type="text" name="reserve[Tel3]" value="<?= !empty($Number_arr[2]) ? h($Number_arr[2]) : '' ?>" size="4" />
							<span class="error_msg" id="R01_Tel_No_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">携帯電話番号</th>
						<td>
							<?
							$Number_arr = [];
							$Number_arr = explode_date($reserve['R01_Mobile_No']);
							?>
							<input type="text" name="reserve[Mobile1]" value="<?= !empty($Number_arr[0]) ? h($Number_arr[0]) : '' ?>" size="4" /> -
							<input type="text" name="reserve[Mobile2]" value="<?= !empty($Number_arr[1]) ? h($Number_arr[1]) : '' ?>" size="4" /> -
							<input type="text" name="reserve[Mobile3]" value="<?= !empty($Number_arr[2]) ? h($Number_arr[2]) : '' ?>" size="4" />
							<span class="error_msg" id="R01_Mobile_No_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">メールアドレス</th>
						<td>
							<input type="text" name="reserve[R01_Email]" value="<?= h($reserve['R01_Email']) ?>" size="35" />
							<span class="error_msg" id="R01_Email_error"></span><br>
							<input type="text" name="reserve[R01_Email_cfm]" value="<?= h($reserve['R01_Email']) ?>" size="35" />（確認用）
							<span class="error_msg" id="R01_Email_cfm_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">ご旅行中の緊急連絡先：お名前</th>
						<td>
							<input type="text" name="reserve[R01_Emer_Name]" value="<?= h($reserve['R01_Emer_Name']) ?>" /><span style="color:red;">※同行されないご家族の方に限ります。</span>
							<span class="error_msg" id="R01_Emer_Name_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">ご旅行中の緊急連絡先：続柄</th>
						<td>
							<select name="reserve[R01_Emer_Relationship]">
								<option value="" selected="selected">選択してください</option>
								<option value="配偶者" <?= strcmp("配偶者", $reserve['R01_Emer_Relationship']) == 0 ? 'selected' : '' ?>>配偶者</option>
								<option value="両親" <?= strcmp("両親", $reserve['R01_Emer_Relationship']) == 0 ? 'selected' : '' ?>>両親</option>
								<option value="子ども" <?= strcmp("子ども", $reserve['R01_Emer_Relationship']) == 0 ? 'selected' : '' ?>>子ども</option>
								<option value="兄弟姉妹" <?= strcmp("兄弟姉妹", $reserve['R01_Emer_Relationship']) == 0 ? 'selected' : '' ?>>兄弟姉妹</option>
								<option value="祖父母" <?= strcmp("祖父母", $reserve['R01_Emer_Relationship']) == 0 ? 'selected' : '' ?>>祖父母</option>
								<option value="配偶者の両親" <?= strcmp("配偶者の両親", $reserve['R01_Emer_Relationship']) == 0 ? 'selected' : '' ?>>配偶者の両親</option>
								<option value="その他" <?= strcmp("その他", $reserve['R01_Emer_Relationship']) == 0 ? 'selected' : '' ?>>その他</option>
							</select>
							<span class="error_msg" id="R01_Emer_Relationship_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">ご旅行中の緊急連絡先：電話番号</th>
						<td>
							<?
							$Number_arr = [];
							$Number_arr = explode_date($reserve['R01_Emer_Tel_No']);
							?>
							<input type="text" name="reserve[Emer1]" value="<?= !empty($Number_arr[0]) ? h($Number_arr[0]) : '' ?>" size="4" /> -
							<input type="text" name="reserve[Emer2]" value="<?= !empty($Number_arr[1]) ? h($Number_arr[1]) : '' ?>" size="4" /> -
							<input type="text" name="reserve[Emer3]" value="<?= !empty($Number_arr[2]) ? h($Number_arr[2]) : '' ?>" size="4" />
							<span class="error_msg" id="R01_Emer_Tel_No_error"></span>
						</td>
					</tr>
					<tr>
						<th class="required">請求書 送付先</th>
						<td>
							<input type="hidden" name="common[R01_Invoice_Flg]" value="0" />
							<input type="radio" id="R01_Invoice_Flg_1" name="common[R01_Invoice_Flg]" value="1" <?= '1' == $common['R01_Invoice_Flg'] ? 'checked' : '' ?> />
							<label for="R01_Invoice_Flg_1">ご自宅</label><br>
							<input type="radio" id="R01_Invoice_Flg_2" name="common[R01_Invoice_Flg]" value="2" <?= '2' == $common['R01_Invoice_Flg'] ? 'checked' : '' ?> />
							<label for="R01_Invoice_Flg_2">支社</label><br>
							<span class="error_msg" id="R01_Invoice_Flg_error"></span>
						</td>
					</tr>

					<tr>
						<th class="required">1日目ホテル夕食必要有無</th>
						<td>
							<input type="hidden" name="common[R01_DinnerHotel_Flg]" value="0" />
							<input type="radio" id="R01_DinnerHotel_Flg_1" name="common[R01_DinnerHotel_Flg]" value="1"
								<?= (!isset($common['R01_DinnerHotel_Flg']) || $common['R01_DinnerHotel_Flg'] == '1') ? 'checked' : '' ?> />
							<label for="R01_DinnerHotel_Flg_1">必要</label>

							<input type="radio" id="R01_DinnerHotel_Flg_2" name="common[R01_DinnerHotel_Flg]" value="2"
								<?= (isset($common['R01_DinnerHotel_Flg']) && $common['R01_DinnerHotel_Flg'] == '2') ? 'checked' : '' ?> />
							<label for="R01_DinnerHotel_Flg_2">不要</label>
							<br>
							<span style="color:red;">
								※専用バスにてホテルへ向かわれる方はホテルでビュッフェをご用意しております。<br>
								※レンタカーにてホテルへ向かわれる方は、ホテルでのご夕食の有無をお聞かせください。<br>
								※まだ未定の方は、”必要”を選択してください。
							</span>
						</td>
					</tr>
					<!--
		<tr class="bupload">
			<th class="">パンフレット用写真アップロード</th>
			<td>
				<?php
				if (!empty($common['R01_Brochure_Img'])) {
					$color = "#33BFDB";
					$value = "再アップロード";
				} else {
					$color = "red";
					$value = "アップロード";
				}
				?>
				<img id="R01_Brochure_Display" alt="アップロードしてください" onerror="this.onerror=null;this.src='<?= base_url() ?>img/noupload.png';" src="<?= base_url() . $common['R01_Brochure_Img'] ?>" style="max-width:300px"/><br>
				<input type="file" id="R01_Brochure_Img_File"/>
				<input type="button" id="R01_Brochure_Img_Btn" style="background:<?= $color; ?>;" value="<?= $value; ?>" onclick="savePhoto('<?= h($reserve['R01_Id']) ?>', 0, '.bupload', 'passport');"></input>
				<input type="hidden" name="common[R01_Brochure_Img]" id="R01_Brochure_Img" value="<?= $common['R01_Brochure_Img'] ?>"/>
				<p class="error_msg" id="R01_Brochure_Img_error"></p>
			</td>
		</tr>
-->
					<!--
		<tr>
			<th class="required" style="text-align: left;">沖縄滞在中の<br>レンタカーのご利用について</th>
			<td>
				<p>沖縄滞在中レンタカーの利用を希望する場合、那覇空港貸出⇔那覇空港返却にてご用意ください。</p>
				<input type="hidden" name="common[R01_Car_Rental]" value="0" />
				<input type="radio" id="R01_Car_Rental_1" name="common[R01_Car_Rental]" value="1" <?= '1' == $common['R01_Car_Rental'] ? 'checked' : '' ?>/>
				<label for="R01_Car_Rental_1">当サイトよりレンタカーの手配をする</label><br>
				<input type="radio" id="R01_Car_Rental_2" name="common[R01_Car_Rental]" value="2" <?= '2' == $common['R01_Car_Rental'] ? 'checked' : '' ?>/>
				<label for="R01_Car_Rental_2">ご自身でレンタカーを手配する</label><br>
				<input type="radio" id="R01_Car_Rental_3" name="common[R01_Car_Rental]" value="3" <?= '3' == $common['R01_Car_Rental'] ? 'checked' : '' ?>/>
				<label for="R01_Car_Rental_3">利用しない</label><br>
				<span class="error_msg" id="R01_Car_Rental_error"></span>
				「旅行会社にて手配を依頼する予定」をご選択された方については6月受付開始のオプショナルツアーと合わせてご案内いたします。
			</td>
		</tr>
		<input type="hidden" name="common[R01_4q]" value="" />
-->
					<input type="hidden" name="common[R01_Car_Rental]" value="1" />
					<!--
				<?php
				if (!empty($common['R01_4Q_Flg'])) {
				?>
		<tr>
			<th class="required" style="text-align: left;">４Qオプショナルツアー招待CP</th>
			<td>
				<p>【4Qオプショナルツアー招待客キャンペーン】に入賞されている方で、自費参加補助を選択された方は入賞グレードにより自費参加の補助を致します。あくまで自費参加の補助となりますので、招待者については適用外となります。</p>
				<p>オプショナルツアーまたは自費参加補助からご選択ください。</p>
				<p>オプショナルツアーをご選択された方は6月に受付開始となります。</p>
				<input type="radio" id="R01_4q_1" name="common[R01_4q]" value="0" <?= '0' == $common['R01_4q'] ? 'checked' : '' ?>/>
				<label for="R01_Car_Rental_1">オプショナルツアー</label><br>
				<input type="radio" id="R01_4q_2" name="common[R01_4q]" value="1" <?= '1' == $common['R01_4q'] ? 'checked' : '' ?>/>
				<label for="R01_4q_2">自費参加補助</label><br>
				<span class="error_msg" id="R01_4q_error"></span>
			</td>
		</tr>
<?php
				}
?>
-->
					<tr>
						<th class="">備考</th>
						<td>
							<textarea name="common[R01_Note]" style="width:100%" rows="5"><?= h($common['R01_Note']) ?></textarea>
						</td>
					</tr>
				</table>

			</form>
			<div style="text-align: center;margin-top:1em;">
				<div class="his-button" style="border-radius: 5px;">
					<input type="image" src="<?php echo base_url(); ?>img/back.png" onclick="go_back_entry_no();" />
					<?php if (empty($back_to_top)): ?>
						&nbsp;&nbsp;&nbsp;
						<input type="image" src="<?php echo base_url(); ?>img/next.png" onclick="return validate_reserver();" />
					<?php else: ?>
						&nbsp;&nbsp;&nbsp;
						<input type="image" src="<?php echo base_url(); ?>img/save.png" onclick="return validate_reserver(1);" />
					<?php endif; ?>
				</div>
			</div>
	</section>