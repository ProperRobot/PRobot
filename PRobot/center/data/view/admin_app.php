<?php if(!defined('UC_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>

<script src="js/common.js" type="text/javascript"></script>
<script type="text/javascript">
var apps = new Array();
var run = 0;
function testlink() {
	if(apps[run]) {
		$('status_' + apps[run]).innerHTML = '正在連接...';
		$('link_' + apps[run]).src = $('link_' + apps[run]).getAttribute('testlink') + '&sid=<?php echo $sid;?>';
	}
	run++;
}
window.onload = testlink;
</script>
<div class="container">
	<?php if($a == 'ls') { ?>
		<h3 class="marginbot">應用列表<a href="admin.php?m=app&a=add" class="sgbtn">添加新應用</a></h3>
		<?php if(!$status) { ?>
			<div class="note fixwidthdec">
				<p class="i">如果出現「通信失敗」，請點擊「編輯」嘗試設置應用域名對應的 IP。</p>
			</div>
		<?php } elseif($status == '2') { ?>
			<div class="correctmsg"><p>應用列表成功更新。</p></div>
		<?php } ?>
		<div class="mainbox">
			<?php if($applist) { ?>
				<form action="admin.php?m=app&a=ls" method="post">
					<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
					<table class="datalist fixwidth" onmouseover="addMouseEvent(this);">
						<tr>
							<th nowrap="nowrap"><input type="checkbox" name="chkall" id="chkall" onclick="checkall('delete[]')" class="checkbox" /><label for="chkall">刪除</label></th>
							<th nowrap="nowrap">ID</th>
							<th nowrap="nowrap">應用名稱</th>
							<th nowrap="nowrap">應用的主 URL</th>
							<th nowrap="nowrap">通信情況</th>
							<th nowrap="nowrap">詳情</th>
						</tr>
						<?php $i = 0;?>
						<?php foreach((array)$applist as $app) {?>
							<tr>
								<td width="50"><input type="checkbox" name="delete[]" value="<?php echo $app['appid'];?>" class="checkbox" /></td>
								<td width="35"><?php echo $app['appid'];?></td>
								<td><a href="admin.php?m=app&a=detail&appid=<?php echo $app['appid'];?>"><strong><?php echo $app['name'];?></strong></a></td>
								<td><a href="<?php echo $app['url'];?>" target="_blank"><?php echo $app['url'];?></a></td>
								<td width="90"><div id="status_<?php echo $app['appid'];?>"></div><script id="link_<?php echo $app['appid'];?>" testlink="admin.php?m=app&a=ping&inajax=1&url=<?php echo urlencode($app['url']);?>&ip=<?php echo urlencode($app['ip']);?>&appid=<?php echo $app['appid'];?>&random=<?php echo rand()?>"></script><script>apps[<?php echo $i;?>] = '<?php echo $app['appid'];?>';</script></td>
								<td width="40"><a href="admin.php?m=app&a=detail&appid=<?php echo $app['appid'];?>">編輯</a></td>
							</tr>
							<?php $i++?>
						<?php } ?>
						<tr class="nobg">
							<td colspan="9"><input type="submit" value="提 交" class="btn" /></td>
						</tr>
					</table>
					<div class="margintop"></div>
				</form>
			<?php } else { ?>
				<div class="note">
					<p class="i">目前沒有相關記錄!</p>
				</div>
			<?php } ?>
		</div>
	<?php } elseif($a == 'add') { ?>
		<h3 class="marginbot">添加新應用<a href="admin.php?m=app&a=ls" class="sgbtn">返回應用列表</a></h3>
		<div class="mainbox">
			<table class="opt">
				<tr>
					<th>選擇安裝方式:</th>
				</tr>
				<tr>
					<td>
						<input type="radio" name="installtype" class="radio" checked="checked" onclick="$('url').style.display='none';$('custom').style.display='';" />自定義安裝
						<input type="radio" name="installtype" class="radio" onclick="$('url').style.display='';$('custom').style.display='none';" />URL 安裝 (推薦)
					</td>
				</tr>
			</table>
			<div id="url" style="display:none;">
				<form method="post" action="" target="_blank" onsubmit="document.appform.action=document.appform.appurl.value;" name="appform">
					<table class="opt">
						<tr>
							<th>應用程序安裝地址:</th>
						</tr>
						<tr>
							<td><input type="text" name="appurl" size="50" value="http://domainname/install/index.php" style="width:300px;" /></td>
						</tr>
					</table>
					<div class="opt">
						<input type="hidden" name="ucapi" value="<?php echo UC_API;?>" />
						<input type="hidden" name="ucfounderpw" value="<?php echo $md5ucfounderpw;?>" />
						<input type="submit" name="installsubmit"  value=" 安 裝 " class="btn" />
					</div>
				</form>
			</div>
			<div id="custom">
				<form action="admin.php?m=app&a=add" method="post">
				<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
					<table class="opt">
						<tr>
							<th colspan="2">應用類型:</th>
						</tr>
						<tr>
							<td>
							<select name="type">
								<?php foreach((array)$typelist as $typeid => $typename) {?>
									<option value="<?php echo $typeid;?>"> <?php echo $typename;?> </option>
								<?php }?>
							</select>
							</td>
							<td></td>
						</tr>
						<tr>
							<th colspan="2">應用名稱:</th>
						</tr>
						<tr>
							<td><input type="text" class="txt" name="name" value="" /></td>
							<td>限 20 字節。</td>
						</tr>
						<tr>
							<th colspan="2">應用的主 URL:</th>
						</tr>
						<tr>
							<td><input type="text" class="txt" name="url" value="" /></td>
							<td>該應用與 UCenter 通信的接口 URL，結尾請不要加「/」 ，應用的通知只發送給主 URL</td>
						</tr>
						<tr>
							<th colspan="2">應用 IP:</th>
						</tr>
						<tr>
							<td><input type="text" class="txt" name="ip" value="" /></td>
							<td>正常情況下留空即可。如果由於域名解析問題導致 UCenter 與該應用通信失敗，請嘗試設置為該應用所在服務器的 IP 地址。</td>
						</tr>
						<tr>
							<th colspan="2">通信密鑰:</th>
						</tr>
						<tr>
							<td><input type="text" class="txt" name="authkey" value="" /></td>
							<td>只允許使用英文字母及數字，限 64 字節。應用端的通信密鑰必須與此設置保持一致，否則該應用將無法與 UCenter 正常通信。</td>
						</tr>


						<tr>
							<th colspan="2">應用的物理路徑:</th>
						</tr>
						<tr>
							<td>
								<input type="text" class="txt" name="apppath" value="" />
							</td>
							<td>默認請留空，如果填寫的為相對路徑（相對於UC），程序會自動轉換為絕對路徑，如 ../</td>
						</tr>
						<tr>
							<th colspan="2">查看個人資料頁面地址:</th>
						</tr>
						<tr>
							<td>
								<input type="text" class="txt" name="viewprourl" value="" />
							</td>
							<td>URL中域名後面的部分，如：/space.php?uid=%s 這裡的 %s 代表uid</td>
						</tr>
						<tr>
							<th colspan="2">應用接口文件名稱:</th>
						</tr>
						<tr>
							<td>
								<input type="text" class="txt" name="apifilename" value="uc.php" />
							</td>
							<td>應用接口文件名稱，不含路徑，默認為uc.php</td>
						</tr>
						<tr>
							<th colspan="2">標籤單條顯示模板:</th>
						</tr>
						<tr>
							<td><textarea class="area" name="tagtemplates"></textarea></td>
							<td valign="top">當前應用的標籤數據顯示在其它應用時的單條數據模板。</td>
						</tr>

						<tr>
							<th colspan="2">標籤模板標記說明:</th>
						</tr>
						<tr>
							<td><textarea class="area" name="tagfields"><?php echo $tagtemplates['fields'];?></textarea></td>
							<td valign="top">一行一個標記說明條目，用逗號分割標記和說明文字。如：<br />subject,主題標題<br />url,主題地址</td>
						</tr>
						<tr>
							<th colspan="2">是否開啟同步登錄:</th>
						</tr>
						<tr>
							<td>
								<input type="radio" class="radio" id="yes" name="synlogin" value="1" /><label for="yes">是</label>
								<input type="radio" class="radio" id="no" name="synlogin" value="0" checked="checked" /><label for="no">否</label>
							</td>
							<td>開啟同步登錄後，當用戶在登錄其他應用時，同時也會登錄該應用。</td>
						</tr>
						<tr>
							<th colspan="2">是否接受通知:</th>
						</tr>
						<tr>
							<td>
								<input type="radio" class="radio" id="yes" name="recvnote" value="1"/><label for="yes">是</label>
								<input type="radio" class="radio" id="no" name="recvnote" value="0" checked="checked" /><label for="no">否</label>
							</td>
							<td></td>
						</tr>
					</table>
					<div class="opt"><input type="submit" name="submit" value=" 提 交 " class="btn" tabindex="3" /></div>
				</form>
			</div>
		</div>
	<?php } else { ?>
		<h3 class="marginbot">編輯應用<a href="admin.php?m=app&a=ls" class="sgbtn">返回應用列表</a></h3>
		<?php if($updated) { ?>
			<div class="correctmsg"><p>更新成功。</p></div>
		<?php } elseif($addapp) { ?>
			<div class="correctmsg"><p>成功添加應用。</p></div>
		<?php } ?>
		<div class="mainbox">
			<form action="admin.php?m=app&a=detail&appid=<?php echo $appid;?>" method="post">
			<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
				<table class="opt">
					<tr>
						<th colspan="2">ID: <?php echo $appid;?></th>
					</tr>
					<tr>
						<th colspan="2">應用類型:</th>
					</tr>
					<tr>
						<td>
						<select name="type">
							<?php foreach((array)$typelist as $typeid => $typename) {?>
							<option value="<?php echo $typeid;?>" <?php if($typeid == $type) { ?>selected="selected"<?php } ?>> <?php echo $typename;?> </option>
							<?php }?>
						</select>
						</td>
						<td></td>
					</tr>

					<tr>
						<th colspan="2">應用名稱:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="name" value="<?php echo $name;?>" /></td>
						<td>限 20 字節。</td>
					</tr>
					<tr>
						<th colspan="2">應用的主 URL:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="url" value="<?php echo $url;?>" /></td>
						<td>該應用與 UCenter 通信的接口 URL，結尾請不要加「/」 ，應用的通知只發送給主 URL</td>
					</tr>
					<tr>
						<th colspan="2">應用的其他 URL:</th>
					</tr>
					<tr>
						<td><textarea name="extraurl" class="area"><?php echo $extraurl;?></textarea></td>
						<td>該應用可以訪問的其他 URL，結尾請不要加「/」 ，每行一個，只有在同步登錄是請求該 URL</td>
					</tr>
					<tr>
						<th colspan="2">應用 IP:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="ip" value="<?php echo $ip;?>" /></td>
						<td>正常情況下留空即可。如果由於域名解析問題導致 UCenter 與該應用通信失敗，請嘗試設置為該應用所在服務器的 IP 地址。</td>
					</tr>
					<tr>
						<th colspan="2">通信密鑰:</th>
					</tr>
					<tr>
						<td><input type="text" class="txt" name="authkey" value="<?php echo $authkey;?>" /></td>
						<td>只允許使用英文字母及數字，限 64 字節。應用端的通信密鑰必須與此設置保持一致，否則該應用將無法與 UCenter 正常通信。</td>
					</tr>

					<tr>
						<th colspan="2">應用的物理路徑:</th>
					</tr>
					<tr>
						<td>
							<input type="text" class="txt" name="apppath" value="<?php echo $apppath;?>" />
						</td>
						<td>默認請留空，如果填寫的為相對路徑（相對於UC），程序會自動轉換為絕對路徑，如 ../</td>
					</tr>
					<tr>
						<th colspan="2">查看個人資料頁面地址:</th>
					</tr>
					<tr>
						<td>
							<input type="text" class="txt" name="viewprourl" value="<?php echo $viewprourl;?>" />
						</td>
						<td>URL中域名後面的部分，如：/space.php?uid=%s 這裡的 %s 代表uid</td>
					</tr>
					<tr>
						<th colspan="2">應用接口文件名稱:</th>
					</tr>
					<tr>
						<td>
							<input type="text" class="txt" name="apifilename" value="<?php echo $apifilename;?>" />
						</td>
						<td>應用接口文件名稱，不含路徑，默認為uc.php</td>
					</tr>

					<tr>
						<th colspan="2">標籤單條顯示模板:</th>
					</tr>
					<tr>
						<td><textarea class="area" name="tagtemplates"><?php echo $tagtemplates['template'];?></textarea></td>
						<td valign="top">當前應用的標籤數據顯示在其它應用時的單條數據模板。</td>
					</tr>
					<tr>
						<th colspan="2">標籤模板標記說明:</th>
					</tr>
					<tr>
						<td><textarea class="area" name="tagfields"><?php echo $tagtemplates['fields'];?></textarea></td>
						<td valign="top">一行一個標記說明條目，用逗號分割標記和說明文字。如：<br />subject,主題標題<br />url,主題地址</td>
					</tr>
					<tr>
						<th colspan="2">是否開啟同步登錄:</th>
					</tr>
					<tr>
						<td>
							<input type="radio" class="radio" id="yes" name="synlogin" value="1" <?php echo $synlogin[1];?> /><label for="yes">是</label>
							<input type="radio" class="radio" id="no" name="synlogin" value="0" <?php echo $synlogin[0];?> /><label for="no">否</label>
						</td>
						<td>開啟同步登錄後，當用戶在登錄其他應用時，同時也會登錄該應用。</td>
					</tr>
					<tr>
						<th colspan="2">是否接受通知:</th>
					</tr>
					<tr>
						<td>
							<input type="radio" class="radio" id="yes" name="recvnote" value="1" <?php echo $recvnotechecked[1];?> /><label for="yes">是</label>
							<input type="radio" class="radio" id="no" name="recvnote" value="0" <?php echo $recvnotechecked[0];?> /><label for="no">否</label>
						</td>
						<td></td>
					</tr>
				</table>
				<div class="opt"><input type="submit" name="submit" value=" 提 交 " class="btn" tabindex="3" /></div>
<?php if($isfounder) { ?>
				<table class="opt">
					<tr>
						<th colspan="2">應用的 UCenter 配置信息:</th>
					</tr>
					<tr>
						<th>
<textarea class="area" onFocus="this.select()">
define('UC_CONNECT', 'mysql');
define('UC_DBHOST', '<?php echo UC_DBHOST;?>');
define('UC_DBUSER', '<?php echo UC_DBUSER;?>');
define('UC_DBPW', '<?php echo UC_DBPW;?>');
define('UC_DBNAME', '<?php echo UC_DBNAME;?>');
define('UC_DBCHARSET', '<?php echo UC_DBCHARSET;?>');
define('UC_DBTABLEPRE', '`<?php echo UC_DBNAME;?>`.<?php echo UC_DBTABLEPRE;?>');
define('UC_DBCONNECT', '0');
define('UC_KEY', '<?php echo $authkey;?>');
define('UC_API', '<?php echo UC_API;?>');
define('UC_CHARSET', '<?php echo UC_CHARSET;?>');
define('UC_IP', '');
define('UC_APPID', '<?php echo $appid;?>');
define('UC_PPP', '20');
</textarea>
						</th>
						<td>當應用的 UCenter 配置信息丟失時可複製左側的代碼到應用的配置文件中</td>
					</tr>
				</table>
<?php } ?>
			</form>
		</div>
	<?php } ?>
</div>

<?php include $this->gettpl('footer');?>