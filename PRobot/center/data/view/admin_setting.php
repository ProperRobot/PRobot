<?php if(!defined('UC_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>

<script src="js/common.js" type="text/javascript"></script>

<div class="container">
	<?php if($updated) { ?>
		<div class="correctmsg"><p>更新成功。</p></div>
	<?php } elseif($a == 'register') { ?>
		<div class="note fixwidthdec"><p class="i">允許/禁止的 Email 地址只需填寫 Email 的域名部分，每行一個域名，例如 @hotmail.com</p></div>
	<?php } ?>
	<?php if($a == 'ls') { ?>
		<div class="mainbox nomargin">
			<form action="admin.php?m=setting&a=ls" method="post">
				<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
				<table class="opt">
					<tr>
						<th colspan="2">日期格式:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="dateformat" value="<?php echo $dateformat;?>" /></td>
						<td>使用 yyyy(yy) 表示年，mm 表示月，dd 表示天。如 yyyy-mm-dd 表示 2000-1-1</td>
					</tr>
					<tr>
						<th colspan="2">時間格式:</th>
					</tr>
					<td>
						<input type="radio" id="hr24" class="radio" name="timeformat" value="1" <?php echo $timeformat[1];?> /><label for="hr24">24 小時制</label>
						<input type="radio" id="hr12" class="radio" name="timeformat" value="0" <?php echo $timeformat[0];?> /><label for="hr12">12 小時制</label>
					</td>
					</tr>
					<tr>
						<th colspan="2">時區:</th>
					</tr>
					<tr>
						<td>
							<select name="timeoffset">
								<option value="-12" <?php echo $checkarray['012'];?>>(GMT -12:00) Eniwetok, Kwajalein</option>
								<option value="-11" <?php echo $checkarray['011'];?>>(GMT -11:00) Midway Island, Samoa</option>
								<option value="-10" <?php echo $checkarray['010'];?>>(GMT -10:00) Hawaii</option>
								<option value="-9" <?php echo $checkarray['09'];?>>(GMT -09:00) Alaska</option>
								<option value="-8" <?php echo $checkarray['08'];?>>(GMT -08:00) Pacific Time (US &amp; Canada), Tijuana</option>
								<option value="-7" <?php echo $checkarray['07'];?>>(GMT -07:00) Mountain Time (US &amp; Canada), Arizona</option>
								<option value="-6" <?php echo $checkarray['06'];?>>(GMT -06:00) Central Time (US &amp; Canada), Mexico City</option>
								<option value="-5" <?php echo $checkarray['05'];?>>(GMT -05:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>
								<option value="-4" <?php echo $checkarray['04'];?>>(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz</option>
								<option value="-3.5" <?php echo $checkarray['03.5'];?>>(GMT -03:30) Newfoundland</option>
								<option value="-3" <?php echo $checkarray['03'];?>>(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is</option>
								<option value="-2" <?php echo $checkarray['02'];?>>(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena</option>
								<option value="-1" <?php echo $checkarray['01'];?>>(GMT -01:00) Azores, Cape Verde Islands</option>
								<option value="0" <?php echo $checkarray['0'];?>>(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
								<option value="1" <?php echo $checkarray['1'];?>>(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>
								<option value="2" <?php echo $checkarray['2'];?>>(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa</option>
								<option value="3" <?php echo $checkarray['3'];?>>(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi</option>
								<option value="3.5" <?php echo $checkarray['3.5'];?>>(GMT +03:30) Tehran</option>
								<option value="4" <?php echo $checkarray['4'];?>>(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi</option>
								<option value="4.5" <?php echo $checkarray['4.5'];?>>(GMT +04:30) Kabul</option>
								<option value="5" <?php echo $checkarray['5'];?>>(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
								<option value="5.5" <?php echo $checkarray['5.5'];?>>(GMT +05:30) Bombay, Calcutta, Madras, New Delhi</option>
								<option value="5.75" <?php echo $checkarray['5.75'];?>>(GMT +05:45) Katmandu</option>
								<option value="6" <?php echo $checkarray['6'];?>>(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk</option>
								<option value="6.5" <?php echo $checkarray['6.5'];?>>(GMT +06:30) Rangoon</option>
								<option value="7" <?php echo $checkarray['7'];?>>(GMT +07:00) Bangkok, Hanoi, Jakarta</option>
								<option value="8" <?php echo $checkarray['8'];?>>(GMT +08:00) &#x5317;&#x4eac;(Beijing), Hong Kong, Perth, Singapore, Taipei</option>
								<option value="9" <?php echo $checkarray['9'];?>>(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
								<option value="9.5" <?php echo $checkarray['9.5'];?>>(GMT +09:30) Adelaide, Darwin</option>
								<option value="10" <?php echo $checkarray['10'];?>>(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok</option>
								<option value="11" <?php echo $checkarray['11'];?>>(GMT +11:00) Magadan, New Caledonia, Solomon Islands</option>
								<option value="12" <?php echo $checkarray['12'];?>>(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island</option>
							</select>
						</td>
						<td>默認為: GMT +08:00</td>
					</tr>

					<tr>
						<th colspan="2">發短消息最少註冊天數:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="pmsendregdays" value="<?php echo $pmsendregdays;?>" /></td>
						<td>註冊天數少於此設置的，不允許發送短消息，0為不限制，此舉為了限制機器人發廣告</td>
					</tr>
					<tr>
						<th colspan="2">同一用戶在 24 小時內允許發起兩人會話的最大數:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="privatepmthreadlimit" value="<?php echo $privatepmthreadlimit;?>" /></td>
						<td>同一用戶在 24 小時內可以發起的兩人會話數的最大值，建議在 30 - 100 範圍內取值，0 為不限制，此舉為了限制通過機器批量發廣告</td>
					</tr>
					<tr>
						<th colspan="2">同一用戶在 24 小時內允許發起群聊會話的最大數:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="chatpmthreadlimit" value="<?php echo $chatpmthreadlimit;?>" /></td>
						<td>同一用戶在 24 小時內可以發起的群聊會話的最大值，建議在 30 - 100 範圍內取值，0 為不限制，此舉為了限制通過機器批量發廣告</td>
					</tr>
					<tr>
						<th colspan="2">參與同一群聊會話的最大用戶數:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="chatpmmemberlimit" value="<?php echo $chatpmmemberlimit;?>" /></td>
						<td>同一會話最多能有多少用戶參與設置，建議在 30 - 100 範圍內取值，0為不限制</td>
					</tr>
					<tr>
						<th colspan="2">發短消息灌水預防:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="pmfloodctrl" value="<?php echo $pmfloodctrl;?>" /></td>
						<td>兩次發短消息間隔小於此時間，單位秒，0 為不限制，此舉為了限制通過機器批量發廣告</td>
					</tr>

					<tr>
						<th colspan="2">啟用短消息中心:</th>
					</tr>
					<tr>
					<td>
						<input type="radio" id="pmcenteryes" class="radio" name="pmcenter" value="1" <?php echo $pmcenter[1];?> onclick="$('hidden1').style.display=''"  /><label for="pmcenteryes">是</label>
						<input type="radio" id="pmcenterno" class="radio" name="pmcenter" value="0" <?php echo $pmcenter[0];?> onclick="$('hidden1').style.display='none'" /><label for="pmcenterno">否</label>
					</td>
					<td>是否啟用短消息中心功能，不影響使用短消息接口應用程序的使用</td>
					</tr>
					<tbody id="hidden1" <?php echo $pmcenter['display'];?>>
					<tr>
						<th colspan="2">開啟發送短消息驗證碼:</th>
					</tr>
					<tr>
						<td>
							<input type="radio" id="sendpmseccodeyes" class="radio" name="sendpmseccode" value="1" <?php echo $sendpmseccode[1];?> /><label for="sendpmseccodeyes">是</label>
							<input type="radio" id="sendpmseccodeno" class="radio" name="sendpmseccode" value="0" <?php echo $sendpmseccode[0];?> /><label for="sendpmseccodeno">否</label>
						</td>
						<td>是否開啟短消息中心發送短消息驗證碼，可以防止使用機器狂發短消息</td>
					</tr>
					</tbody>
				</table>
				<div class="opt"><input type="submit" name="submit" value=" 提 交 " class="btn" tabindex="3" /></div>
			</form>
		</div>
	<?php } elseif($a == 'register') { ?>
		<div class="mainbox nomargin">
			<form action="admin.php?m=setting&a=register" method="post">
				<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
				<table class="opt">
					<tr>
						<th colspan="2">是否允許同一 Email 地址註冊多個用戶:</th>
					</tr>
					<tr>
						<td>
							<input type="radio" id="yes" class="radio" name="doublee" value="1" <?php echo $doublee[1];?> /><label for="yes">是</label>
							<input type="radio" id="no" class="radio" name="doublee" value="0" <?php echo $doublee[0];?> /><label for="no">否</label>
						</td>
					</tr>
					<tr>
						<th colspan="2">允許的 Email 地址:</th>
					</tr>
					<tr>
						<td><textarea class="area" name="accessemail"><?php echo $accessemail;?></textarea></td>
						<td valign="top">只允許使用這些域名結尾的 Email 地址註冊。</td>
					</tr>
					<tr>
						<th colspan="2">禁止的 Email 地址:</th>
					</tr>
					<tr>
						<td><textarea class="area" name="censoremail"><?php echo $censoremail;?></textarea></td>
						<td valign="top">禁止使用這些域名結尾的 Email 地址註冊。</td>
					</tr>
					<tr>
						<th colspan="2">禁止的用戶名:</th>
					</tr>
					<tr>
						<td><textarea class="area" name="censorusername"><?php echo $censorusername;?></textarea></td>
						<td valign="top">可以設置通配符，每個關鍵字一行，可使用通配符 "*" 如 "*版主*"(不含引號)。</td>
					</tr>
				</table>
				<div class="opt"><input type="submit" name="submit" value=" 提 交 " class="btn" tabindex="3" /></div>
			</form>
		</div>
	<?php } else { ?>
		<div class="mainbox nomargin">
			<form action="admin.php?m=setting&a=mail" method="post">
				<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
				<table class="opt">
					<tr>
						<th colspan="2">郵件來源地址:</th>
					</tr>
					<tr>
						<td><input name="maildefault" value="<?php echo $maildefault;?>" type="text"></td>
						<td>當發送郵件不指定郵件來源時，默認使用此地址作為郵件來源</td>
					<tr>
						<th colspan="2">郵件發送方式:</th>
					</tr>
					<tr>
						<td colspan="2">
							<label><input class="radio" name="mailsend" value="1"<?php if($mailsend == 1) { ?> checked="checked"<?php } ?> onclick="$('hidden1').style.display = 'none';$('hidden2').style.display = 'none';" type="radio"> 通過 PHP 函數的 sendmail 發送(推薦此方式)</label><br />
							<label><input class="radio" name="mailsend" value="2"<?php if($mailsend == 2) { ?> checked="checked"<?php } ?> onclick="$('hidden1').style.display = '';$('hidden2').style.display = '';" type="radio"> 通過 SOCKET 連接 SMTP 服務器發送(支持 ESMTP 驗證)</label><br />
							<label><input class="radio" name="mailsend" value="3"<?php if($mailsend == 3) { ?> checked="checked"<?php } ?> onclick="$('hidden1').style.display = '';$('hidden2').style.display = 'none';" type="radio"> 通過 PHP 函數 SMTP 發送 Email(僅 Windows 主機下有效, 不支持 ESMTP 驗證)</label>
						</td>
					</tr>
					<tbody id="hidden1"<?php if($mailsend == 1) { ?> style="display:none"<?php } ?>>
					<tr>
						<td colspan="2">SMTP 服務器:</td>
					</tr>
					<tr>
						<td>
							<input name="mailserver" value="<?php echo $mailserver;?>" class="txt" type="text">
						</td>
						<td valign="top">設置 SMTP 服務器的地址</td>
					</tr>
					<tr>
						<td colspan="2">SMTP 端口:</td>
					</tr>
					<tr>
						<td>
							<input name="mailport" value="<?php echo $mailport;?>" type="text">
						</td>
						<td valign="top">設置 SMTP 服務器的端口，默認為 25</td>
					</tr>
					</tbody>
					<tbody id="hidden2"<?php if($mailsend == 1 || $mailsend == 3) { ?> style="display:none"<?php } ?>>
					<tr>
						<td colspan="2">SMTP 服務器要求身份驗證:</td>
					</tr>
					<tr>
						<td>
							<label><input type="radio" class="radio" name="mailauth"<?php if($mailauth == 1) { ?> checked="checked"<?php } ?> value="1" />是</label>
							<label><input type="radio" class="radio" name="mailauth"<?php if($mailauth == 0) { ?> checked="checked"<?php } ?> value="0" />否</label>
						</td>
						<td valign="top">如果 SMTP 服務器要求身份驗證才可以發信，請選擇「是」</td>
					</tr>
					<tr>
						<td colspan="2">發信人郵件地址:</td>
					</tr>
					<tr>
						<td>
							<input name="mailfrom" value="<?php echo $mailfrom;?>" class="txt" type="text">
						</td>
						<td valign="top">如果需要驗證, 必須為本服務器的郵件地址。郵件地址中如果要包含用戶名，格式為「username &lt;user@domain.com&gt;」</td>
					</tr>
					<tr>
						<td colspan="2">SMTP 身份驗證用戶名:</td>
					</tr>
					<tr>
						<td>
							<input name="mailauth_username" value="<?php echo $mailauth_username;?>" type="text">
						</td>
						<td valign="top"></td>
					</tr>
					<tr>
						<td colspan="2">SMTP 身份驗證密碼:</td>
					</tr>
					<tr>
						<td>
							<input name="mailauth_password" value="<?php echo $mailauth_password;?>" type="text">
						</td>
						<td valign="top"></td>
					</tr>
					</tbody>
					<tr>
						<th colspan="2">郵件頭的分隔符:</th>
					</tr>
					<tr>
						<td>
							<label><input class="radio" name="maildelimiter"<?php if($maildelimiter == 1) { ?> checked="checked"<?php } ?> value="1" type="radio"> 使用 CRLF 作為分隔符</label><br />
							<label><input class="radio" name="maildelimiter"<?php if($maildelimiter == 0) { ?> checked="checked"<?php } ?> value="0" type="radio"> 使用 LF 作為分隔符</label><br />
							<label><input class="radio" name="maildelimiter"<?php if($maildelimiter == 2) { ?> checked="checked"<?php } ?> value="2" type="radio"> 使用 CR 作為分隔符</label>
						</td>
						<td>
							請根據您郵件服務器的設置調整此參數
						</td>
					</tr>
					<tr>
						<th colspan="2">收件人地址中包含用戶名:</th>
					</tr>
					<tr>
						<td>
							<label><input type="radio" class="radio" name="mailusername"<?php if($mailusername == 1) { ?> checked="checked"<?php } ?> value="1" />是</label>
							<label><input type="radio" class="radio" name="mailusername"<?php if($mailusername == 0) { ?> checked="checked"<?php } ?> value="0" />否</label>
						</td>
						<td valign="top">選擇「是」將在收件人的郵件地址中包含論壇用戶名</td>
					</tr>
					<tr>
						<th colspan="2">屏蔽郵件發送中的全部錯誤提示:</th>
					</tr>
					<tr>
						<td>
							<label><input type="radio" class="radio" name="mailsilent"<?php if($mailsilent == 1) { ?> checked="checked"<?php } ?> value="1" />是</label>
							<label><input type="radio" class="radio" name="mailsilent"<?php if($mailsilent == 0) { ?> checked="checked"<?php } ?> value="0" />否</label>
						</td>
						<td valign="top">&nbsp;</td>
					</tr>
				</table>
				<div class="opt"><input type="submit" name="submit" value=" 提 交 " class="btn" tabindex="3" /></div>
			</form>
		</div>
	<?php } ?>
</div>

<?php include $this->gettpl('footer');?>