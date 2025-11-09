<section id="about">
	
	<div id="main">
		<!-- システムメッセージ -->
		<form action="" name="confirm_form" id="confirm_form" method="post" autocomplete="off" >
			<div id="systemMsg">
			</div>	
			<h2>お申し込み内容の確認</h2>
			
			<?php if($R00_kibou == "XX"){?>
				<h1>2017年10-11月　店舗の絆強化コンテスト　報奨旅行に参加しない</h1>
			<?php }else{?>
			
				<h4>コース選択</h4>
				<table class="border2" width="100%">
					<tr>
						<th>コース名</th>
						<td><?php echo $R00_kibou.'班';?>	</td>
					</tr>
				</table>
				<h4 class="title">ツアー申込（基本情報の登録）</h4>

				<table class="border2" width="100%">
					<tr>
						<th colspan="2"><div align="center">◆基本情報</div></th>
					</tr>
					<tr>
						<th width="30%">お名前（漢字）<strong class="required"></strong></th>
						<td><?php echo $R00_Sei.' '.$R00_Name;?>　</td>
					</tr>
					<tr>
						<th>お名前（カナ）<strong class="required"></strong></th>
						<td><?php echo $R00_Sei_Kana.' '.$R00_Name_Kana;?></td>
					</tr>
					<tr>
						<th>性別</th>
						<td><?php echo $R00_Sex == '0'?'男性':'女性';?></td>
					</tr>
					<tr>
						<th>生年月日</th>
						<td><?php echo $this->convert_format->ChangeJpDate($R00_Birth_Date);?></td>
					</tr>
					<tr>
						<th>国籍</th>
						<td><?php if($R00_Nationality == "0"){ echo $R00_Nationality_other ;}else{echo $R00_Nationality;}?></td>
					</tr>
					<tr>
						<th>E-mail</th>
						<td><?php echo $R00_Email;?></td>
					</tr>
				</table>
				<table class="border2" width="100%">
					<tr>
						<th colspan="2"><div align="center">ご自宅住所・電話番号</div></th>
					</tr>
					<tr>
						<th width="30%">郵便番号<strong class="required"></strong></th>
						<td>〒<?php echo $R00_Zip21.'-'.$R00_Zip22;?>
						</td>
					</tr>
					<tr>
						<th>都道府県<strong class="required"></strong></th>
						<td>
							<?php if($R00_Town != ""){ echo getPrefecture($R00_Town); }?>
						</td>
					</tr>
					<tr>
						<th>それ以降の住所<strong class="required"></strong></th>
						<td><?php echo $R00_Address;?></td>
					</tr>
					<tr>
						<th>マンション名<strong class="required"></strong></th>
						<td><?php echo $R00_Address2;?></td>
					</tr>
					<!--<tr>
						<th>ビル・マンション名</th>
						<td><?php echo $R00_Prin_Towns_Villages;?></td>
					</tr>-->
					<tr>
						<th>ご自宅TEL<strong class="required"></strong></th>
						<td><?php echo $R00_Prin_Phone;?></td>
					</tr>
					<tr>
						<th>携帯電話番号<strong class="required"></strong></th>
						<td><?php echo $R00_Prin_Fax;?></td>
					</tr>
				</table>
				<table class="border2" width="100%">
					<tr>
						<th colspan="2"><div align="center">店舗情報</div></th>
					</tr>

					<tr>
						<th width="30%">店舗名</th>
						<td><?php echo $R00_Company;?></td>
					</tr>

					<tr>
						<th>役職</th>
						<td><?php echo $R00_Division;?></td>
					</tr>
					<!--<tr>
						<th>郵便番号</th>
						<td><?php echo $R00_Emp_Postal_1.'-'.$R00_Emp_Postal_2;?></td>
					</tr>
					<tr>
					<th>都道府県</th>
						<td><?php if($R00_Emp_Prefectures != ""){ echo getPrefecture($R00_Emp_Prefectures); } ?></td>
					</tr>
					<tr>
						<th>市区群町名</th>
						<td><?php echo $R00_Emp_City;?></td>
					</tr>

					<tr>
						<th>番地</th>
						<td><?php echo $R00_Emp_Towns_Villages;?></td>
					</tr>

					<!--<tr>
						<th>ビル・マンション名</th>
						<td><?php echo $R00_Emp_Building_Name;?></td>
					</tr>

					<tr>
						<th>店舗TEL</th>
						<td><?php echo $R00_Company_Tel;?></td>
					</tr>
					-->

					
				</table>
				<table class="border2" width="100%" id ="ppt_img">
					<tr>
						<th colspan="2"><div align="center">パスポート</div></th>
					</tr>

					<tr>
						<th width="30%">パスポートの有無<strong class="required"></strong></th>
						<td>
							<?php if($R00_Passport_Flag==0){?>
								持っている 
							<?php }elseif($R00_Passport_Flag==1){?>
								持っていない
							<?php }elseif($R00_Passport_Flag==9){?>
								申請中
							<?php } ?>
						</td>
					</tr>

					<tr>
						<th>申請予定日<strong class="required"></strong></th>
						<td><?php echo $R00_Passport_Flag==9 ? $R00_Passport_Issue: '';?></td>
					</tr>

					<tr>
						<th>パスポート名<strong class="required"></strong></th>
						<td><?php echo $R00_Passport_Sei.' '.$R00_Passport_Name?></td>
					</tr>
					<tr >
				<th >パスポート顔写真ページデータ</th>
				<td>
							
					<?php
					if(($R00_Passport_Upload_Name != NULL) && ($R00_Passport_Upload_Name != "")) {
						$color="#33BFDB";
						$value = "再アップロード"
					?>
						<p style = "display:block;font-size:15px;font-weight:bold !important"  id = "org_img">アップロード済みです。</p>
						<p style="display:none;"id="link">画像アップロード</p>
						<p style="display:block;font-size :15px"id="link1">
						<a href="#" onclick="getImage('<?php echo $R00_Id; ?>')" >アップロード済画像の確認</a>
						</p>
					<?php
					} else {
						$color="red";
						$value = "アップロード"
					?>	
						<p style = "display:none;font-size:15px;"  id = "org_img">アップロード済みです。</p>
						<p style="display:none;font-weight:bold"id="link">画像アップロード</p>
						<p style="display:none;font-size :15px"id="link1">
						<a href="#" onclick="getImage('<?php echo $R00_Id; ?>')" >アップロード済画像の確認</a>
						<p>
					<?php
					}
					?>
						<p style = "font-size:15px;font-weight:bold !important" id = "name2"></p>
						<p style="font-size :15px; display: none;" id="name">
						<a href="#" onclick="getImage('<?php echo $R00_Id; ?>')" >アップロード済画像の確認</a>
						</p>
						<input type="file" name ="R00_Passport_Img_File" id = "R00_Passport_Img_File"/><br><br>
						<input type="button" name="uploadclick" id="uploadclick" style="background:<?php echo $color;?>;" value="<?php echo $value;?>" onclick="savePhoto();" />
						
						<input type="hidden" name ="R00_Passport_Upload_Name" id = "R00_Passport_Upload_Name" value = "<?php if(isset($R00_Passport_Upload_Name)){ echo $R00_Passport_Upload_Name;} else{echo '';}?>"/>
				</td>
			</tr>			
				</table>



				<table class="border2" width="100%">
					<tr>
						<th colspan="2">
						<div align="center">渡航中の国内連絡先</div></th>
					</tr>

					<tr>
						<th width="30%">渡航中の国内連絡先　氏名（カナ）<strong class="required"></strong></th>
						<td><?php echo $R00_emargency_mei;?></td>
					</tr>

					<tr>
						<th>続柄<strong class="required"></strong></th>
						<td><?php echo $R00_emargency_zoku;?></td>
					</tr>

					<tr>
						<th>電話番号<strong class="required"></strong></th>
						<td><?php echo $R00_emargency_tel;?></td>
					</tr>
					
				</table>
				
				<h4 class="title">オプショナルツアーについて</h4>
				<table class="border2" width="100%">
					<?php if(isset($R00_Optional)){ if($R00_Optional != 2){$golf_row = 1; }  } ?>
						<?php if(isset($R00_Optional)){ if($R00_Optional == 2){$golf_row = 3;}  } ?>
					<tr>
						<th width="30%" rowspan = "<?php echo $golf_row; ?>">2日目</th>
						<td <?php if(isset($R00_Optional)){ if($R00_Optional == 2){?> colspan ="2 "   <?php }  } ?> >

						<?php if(isset($R00_Optional)){ if($R00_Optional == 1){echo "観光"; }  } ?>
						<?php if(isset($R00_Optional)){ if($R00_Optional == 2){echo "ゴルフ"; }  } ?>
						<?php if(isset($R00_Optional)){ if($R00_Optional == 9){echo "自由行動"; }  } ?>
						<?php //if(isset($entry['R00_Optional'])){ if($entry['R00_Optional'] == 9){echo "自由行動"; }  } ?>
						</td>
					</tr>
					<?php if(isset($R00_Optional)){ if($R00_Optional == 2){   ?>
						<tr>
							<th>レンタルクラブ</th>
							<th>レンタル靴</th>
						</tr>
						<tr>
							<td>

							<?php if(isset($R00_Option_golf)){ if($R00_Option_golf == 1){echo "右"; }  } ?>
							<?php if(isset($R00_Option_golf)){ if($R00_Option_golf == 2){echo "左"; }  } ?>
							<?php if(isset($R00_Option_golf)){ if($R00_Option_golf == 9){echo "持参する"; }  } ?>
							</td>
							<td>
<p style ="color:color:#FF0000;font-size:small">※レンタルシューズ各自お持ちください。</br>(要ソフトスパイクシューズ)</p>
							<?php if(isset($R00_Option_shoes)){ if($R00_Option_shoes == 2){echo "持参する"; }  } ?>
							</td>
						
						</tr>
					
					
					
					<?php }  }?>
				</table>
				
				<h4 class="title">生活習慣について</h4>
				<table class="border2" width="100%">
					<tr>
						<th width="30%">喫煙(たばこ)の習慣</br><span style ="color:#FF0000;font-size:13px">　＊客室は全室禁煙となります。</span></th>
						<td>

						<?php if($R00_tabaco == 0){echo "禁煙";}?>
						<?php if($R00_tabaco == 1){echo "喫煙";}?>
						</td>
					</tr>
				</table>
				<h4 class="title">通信欄</h4>
				<table class="border2" width="100%">
					<tr>
						<th width="30%">通信欄<strong class="required"></strong><br></th>
						<td><?php echo nl2br($R00_Other_Memo);?></td>
					</tr>
				</table>			
				
			<?php }?>
				
		</form>
	</div>
</section>

