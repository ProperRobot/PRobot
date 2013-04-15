<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: index.php 13234 2009-08-24 08:20:04Z liguode $
*/

define('IN_UCHOME', TRUE);

error_reporting(0);
$_SGLOBAL = $_SCONFIG = $_SBLOCK = array();

//程序目錄
define('S_ROOT', substr(dirname(__FILE__), 0, -7));

//獲取時間
$_SGLOBAL['timestamp'] = time();

include_once(S_ROOT.'./source/function_common.php');
if(!@include_once(S_ROOT.'./config.php')) {
	@include_once(S_ROOT.'./config.new.php');
	show_msg('您需要首先將程序根目錄下面的 "config.new.php" 文件重命名為 "config.php"', 999);
}

//GPC過濾
if(!(get_magic_quotes_gpc())) {
	$_GET = saddslashes($_GET);
	$_POST = saddslashes($_POST);
}

//啟用GIP
if ($_SC['gzipcompress'] && function_exists('ob_gzhandler')) {
	ob_start('ob_gzhandler');
} else {
	ob_start();
}

$formhash = formhash();

$theurl = 'index.php';
$sqlfile = S_ROOT.'./data/install.sql';
if(!file_exists($sqlfile)) {
	show_msg('請上傳最新的 install.sql 數據庫結構文件到程序的 ./data 目錄下面，再重新運行本程序', 999);
}
$configfile = S_ROOT.'./config.php';

//變量
$step = empty($_GET['step'])?0:intval($_GET['step']);
$action = empty($_GET['action'])?'':trim($_GET['action']);
$nowarr = array('','','','','','','');

$lockfile = S_ROOT.'./data/install.lock';
if(file_exists($lockfile)) {
	show_msg('警告!您已經安裝過UCenter Home<br>
		為了保證數據安全，請立即手動刪除 install/index.php 文件<br>
		如果您想重新安裝UCenter Home，請刪除 data/install.lock 文件，並到UCenter後台應用管理處刪除該應用，再運行安裝文件');
}

//檢查config是否可寫
if(!@$fp = fopen($configfile, 'a')) {
	show_msg("文件 $configfile 讀寫權限設置錯誤，請設置為可寫，再執行安裝程序");
} else {
	@fclose($fp);
}

//提交處理
if (submitcheck('ucsubmit')) {

	//安裝UC配置
	$step = 1;

	//判斷域名是否解析
	$ucapi = preg_replace("/\/$/", '', trim($_POST['ucapi']));
	$ucip = trim($_POST['ucip']);

	if(empty($ucapi) || !preg_match("/^(http:\/\/)/i", $ucapi)) {
		show_msg('UCenter的URL地址不正確');
	} else {
		//檢查服務器 dns 解析是否正常, dns 解析不正常則要求用戶輸入ucenter的ip地址
		if(!$ucip) {
			$temp = @parse_url($ucapi);
			$ucip = gethostbyname($temp['host']);
			if(ip2long($ucip) == -1 || ip2long($ucip) === FALSE) {
				$ucip = '';
			}
		}
	}

	//驗證UCHome是否安裝
	if(!@include_once S_ROOT.'./uc_client/client.php') {
		show_msg('uc_client目錄不存在，請上傳安裝包中的 ./upload/uc_client 到程序根目錄');
	}
	$ucinfo = uc_fopen2($ucapi.'/index.php?m=app&a=ucinfo&release='.UC_CLIENT_RELEASE, 500, '', '', 1, $ucip);
	list($status, $ucversion, $ucrelease, $uccharset, $ucdbcharset, $apptypes) = explode('|', $ucinfo);
	$dbcharset = strtolower(trim($_SC['dbcharset'] ? str_replace('-', '', $_SC['dbcharset']) : $_SC['dbcharset']));
	$ucdbcharset = strtolower(trim($ucdbcharset ? str_replace('-', '', $ucdbcharset) : $ucdbcharset));
	$apptypes = strtolower(trim($apptypes));
	if($status != 'UC_STATUS_OK') {
		show_header();
		print<<<END
		<form id="theform" method="post" action="$theurl">
		<table class="datatable">
		<tr><td><strong>UCenter無法正常連接，返回錯誤 ( $status )，請確認UCenter的IP地址是否正確</strong><br><br></td></tr>
		<tr><td>UCenter服務器的IP地址: <input type="text" name="ucip" value="$ucip"> 例如：192.168.0.1</td></tr>
		</table>
		<table class=button>
		<tr><td>
		<input type="hidden" name="ucapi" value="$ucapi">
		<input type="hidden" name="ucfounderpw" value="$_POST[ucfounderpw]">
		<input type="submit" id="ucsubmit" name="ucsubmit" value="確認IP地址"></td></tr>
		</table>
		<input type="hidden" name="formhash" value="$formhash">
		</form>
END;
		show_footer();
		exit();
	} elseif($dbcharset && $ucdbcharset && $ucdbcharset != $dbcharset) {
		show_msg('UCenter 服務端字符集與當前應用的字符集不同，請下載 '.$ucdbcharset.' 編碼的 UCenter Home 進行安裝，下載地址：http://download.comsenz.com/');
	} elseif(strexists($apptypes, 'uchome')) {
		show_msg('已經安裝過一個UCenter Home產品，如果想繼續安裝，請先到 UCenter 應用管理中刪除已有的UCenter Home！');
	}
	$tagtemplates = 'apptagtemplates[template]='.urlencode('<a href="{url}" target="_blank">{subject}</a>').'&'.
		'apptagtemplates[fields][subject]='.urlencode('日誌標題').'&'.
		'apptagtemplates[fields][uid]='.urlencode('用戶 ID').'&'.
		'apptagtemplates[fields][username]='.urlencode('用戶名').'&'.
		'apptagtemplates[fields][dateline]='.urlencode('日期').'&'.
		'apptagtemplates[fields][spaceurl]='.urlencode('空間地址').'&'.
		'apptagtemplates[fields][url]='.urlencode('日誌地址');

	$uri = $_SERVER['REQUEST_URI']?$_SERVER['REQUEST_URI']:($_SERVER['PHP_SELF']?$_SERVER['PHP_SELF']:$_SERVER['SCRIPT_NAME']);
	$app_url = strtolower(substr($_SERVER['SERVER_PROTOCOL'], 0, strpos($_SERVER['SERVER_PROTOCOL'], '/'))).'://'.$_SERVER['HTTP_HOST'].preg_replace("/\/*install$/i", '', substr($uri, 0, strrpos($uri, '/install')));

	$postdata = "m=app&a=add&ucfounder=&ucfounderpw=".urlencode($_POST['ucfounderpw'])."&apptype=".urlencode('UCHOME')."&appname=".urlencode('個人家園')."&appurl=".urlencode($app_url)."&appip=&appcharset=".$_SC['charset'].'&appdbcharset='.$_SC['dbcharset'].'&release='.UC_CLIENT_RELEASE.'&'.$tagtemplates;
	$s = uc_fopen2($ucapi.'/index.php', 500, $postdata, '', 1, $ucip);
	if(empty($s)) {
		show_msg('UCenter用戶中心無法連接');
	} elseif($s == '-1') {
		show_msg('UCenter管理員帳號密碼不正確');
	} else {
		$ucs = explode('|', $s);
		if(empty($ucs[0]) || empty($ucs[1])) {
			show_msg('UCenter返回的數據出現問題，請參考:<br />'.shtmlspecialchars($s));
		} else {

			//處理成功
			$apphidden = '';
			//驗證是否可以直接聯接MySQL
			$link = mysql_connect($ucs[2], $ucs[4], $ucs[5], 1);
			$connect = $link && mysql_select_db($ucs[3], $link) ? 'mysql' : '';
			//返回
			foreach (array('key', 'appid', 'dbhost', 'dbname', 'dbuser', 'dbpw', 'dbcharset', 'dbtablepre', 'charset') as $key => $value) {
				if($value == 'dbtablepre') {
					$ucs[$key] = '`'.$ucs[3].'`.'.$ucs[$key];
				}
				$apphidden .= "<input type=\"hidden\" name=\"uc[$value]\" value=\"".$ucs[$key]."\" />";
			}
			//內置
			$apphidden .= "<input type=\"hidden\" name=\"uc[connect]\" value=\"$connect\" />";
			$apphidden .= "<input type=\"hidden\" name=\"uc[api]\" value=\"$_POST[ucapi]\" />";
			$apphidden .= "<input type=\"hidden\" name=\"uc[ip]\" value=\"$ucip\" />";

			show_header();
			print<<<END
			<form id="theform" method="post" action="$theurl">
			<table>
			<tr><td>UCenter註冊成功！當前程序ID標識為: $ucs[1]</td></tr>
			</table>

			<table class=button>
			<tr><td>$apphidden
			<input type="submit" id="uc2submit" name="uc2submit" value="進入下一步"></td></tr>
			</table>
			<input type="hidden" name="formhash" value="$formhash">
			</form>
END;
			show_footer();
			exit();
		}
	}

} elseif (submitcheck('uc2submit')) {

	//增加congfig配置
	$step = 2;

	//寫入config文件
	$configcontent = sreadfile($configfile);
	$keys = array_keys($_POST['uc']);
	foreach ($keys as $value) {
		$upkey = strtoupper($value);
		$configcontent = preg_replace("/define\('UC_".$upkey."'\s*,\s*'.*?'\)/i", "define('UC_".$upkey."', '".$_POST['uc'][$value]."')", $configcontent);
	}
	if(!$fp = fopen($configfile, 'w')) {
		show_msg("文件 $configfile 讀寫權限設置錯誤，請設置為可寫後，再執行安裝程序");
	}
	fwrite($fp, trim($configcontent));
	fclose($fp);

} elseif(!empty($_POST['sqlsubmit'])) {

	$step = 2;

	//先寫入config文件
	$configcontent = sreadfile($configfile);
	$keys = array_keys($_POST['db']);
	foreach ($keys as $value) {
		$configcontent = preg_replace("/[$]\_SC\[\'".$value."\'\](\s*)\=\s*[\"'].*?[\"']/is", "\$_SC['".$value."']\\1= '".$_POST['db'][$value]."'", $configcontent);
	}
	if(!$fp = fopen($configfile, 'w')) {
		show_msg("文件 $configfile 讀寫權限設置錯誤，請設置為可寫後，再執行安裝程序");
	}
	fwrite($fp, trim($configcontent));
	fclose($fp);
	
	if(empty($_POST['db']['tablepre'])) {
		show_msg("填寫的表名前綴不能為空");
	}

	//判斷UCenter Home數據庫
	$havedata = false;
	if(!@mysql_connect($_POST['db']['dbhost'], $_POST['db']['dbuser'], $_POST['db']['dbpw'])) {
		show_msg('數據庫連接信息填寫錯誤，請確認');
	}
	if(mysql_select_db($_POST['db']['dbname'])) {
		if(mysql_query("SELECT COUNT(*) FROM {$_POST['db']['tablepre']}space")) {
			$havedata = true;
		}
	} else {
		if(!mysql_query("CREATE DATABASE `".$_POST['db']['dbname']."`")) {
			show_msg('設定的UCenter Home數據庫無權限操作，請先手工操作後，再執行安裝程序');
		}
	}

	if($havedata) {
		show_msg('危險!指定的UCenter Home數據庫已有數據，如果繼續將會清空原有數據!', ($step+1));
	} else {
		show_msg('數據庫配置成功，進入下一步操作', ($step+1), 1);
	}

} elseif (submitcheck('opensubmit')) {

	//檢查用戶身份
	include_once(S_ROOT.'./data/data_config.php');

	$step = 5;

	dbconnect();

	//同步獲取用戶源
	$_SGLOBAL['timestamp'] = time();

	//UC註冊用戶
	if(!@include_once S_ROOT.'./uc_client/client.php') {
		showmessage('system_error');
	}
	$uid = uc_user_register($_POST['username'], $_POST['password'], 'webmastor@yourdomain.com');
	if($uid == -3) {
		//已存在，登錄
		if(!$passport = getpassport($_POST['username'], $_POST['password'])) {
			show_msg('輸入的用戶名密碼不正確，請確認');
		}
		$setarr = array(
			'uid' => $passport['uid'],
			'username' => addslashes($passport['username'])
		);
	} elseif($uid > 0) {
		$setarr = array(
			'uid' => $uid,
			'username' => $_POST['username']
		);
	} else {
		show_msg('輸入的用戶名無法註冊，請重新確認');
	}
	$setarr['password'] = md5("$setarr[uid]|$_SGLOBAL[timestamp]");//本地密碼隨機生成

	//更新本地用戶庫
	inserttable('member', $setarr, 0, true);

	//開通空間
	include_once(S_ROOT.'./source/function_space.php');
	$space = space_open($setarr['uid'], $_POST['username'], 1);

	//反饋受保護
	$result = uc_user_addprotected($_POST['username'], $_POST['username']);
	$_SGLOBAL['db']->query("UPDATE ".tname('space')." SET flag=1 WHERE username='$_POST[username]'");

	//清理在線session
	insertsession($setarr);

	//設置cookie
	ssetcookie('auth', authcode("$setarr[password]\t$setarr[uid]", 'ENCODE'), 2592000);

	//寫log
	if(@$fp = fopen($lockfile, 'w')) {
		fwrite($fp, 'UCenter Home');
		fclose($fp);
	}

	show_msg('<font color="red">恭喜! UCenter Home安裝全部完成!</font>
		<br>為了您的數據安全，請登錄ftp，刪除install目錄<br><br>
		您的管理員身份已經成功確認，並已經開通空間。接下來，您可以：<br>
		<br><a href="../space.php" target="_blank">進入我的空間</a>
		<br>進入我的主頁，開始UCenter Home之旅
		<br><a href="../admincp.php" target="_blank">進入管理平台</a>
		<br>以管理員身份對站點參數進行設置', 999);

}

if(empty($step)) {

	show_header();

	//檢查權限設置
	$checkok = true;
	$perms = array();
	if(!checkfdperm(S_ROOT.'./config.php', 1)) {
		$perms['config'] = '失敗';
		$checkok = false;
	} else {
		$perms['config'] = 'OK';
	}
	if(!checkfdperm(S_ROOT.'./attachment/')) {
		$perms['attachment'] = '失敗';
		$checkok = false;
	} else {
		$perms['attachment'] = 'OK';
	}
	if(!checkfdperm(S_ROOT.'./data/')) {
		$perms['data'] = '失敗';
		$checkok = false;
	} else {
		$perms['data'] = 'OK';
	}
	if(!checkfdperm(S_ROOT.'./uc_client/data/')) {
		$perms['uc_data'] = '失敗';
		$checkok = false;
	} else {
		$perms['uc_data'] = 'OK';
	}

	//安裝閱讀
	print<<<END
	<script type="text/javascript">
	function readme() {
		var tbl_readme = document.getElementById('tbl_readme');
		if(tbl_readme.style.display == '') {
			tbl_readme.style.display = 'none';
		} else {
			tbl_readme.style.display = '';
		}
	}
	</script>
	<table class="showtable">
	<tr><td>
	<strong>歡迎您使用UCenter Home</strong><br>
	通過 UCenter Home，作為建站者的您，可以輕鬆構建一個以好友關係為核心的交流網絡，讓站點用戶可以用一句話記錄生活中的點點滴滴；方便快捷地發佈日誌、上傳圖片；更可以十分方便的與其好友們一起分享信息、討論感興趣的話題；輕鬆快捷的瞭解好友最新動態。
	<br><a href="javascript:;" onclick="readme()"><strong>請先認真閱讀我們的軟件使用授權協議</strong></a>
	</td></tr>
	</table>

	<table>
	</td></tr>
	<tr><td>
	<strong>文件/目錄權限設置</strong><br>
	在您執行安裝文件進行安裝之前，先要設置相關的目錄屬性，以便數據文件可以被程序正確讀/寫/刪/創建子目錄。<br>
	推薦您這樣做：<br>使用 FTP 軟件登錄您的服務器，將服務器上以下目錄、以及該目錄下面的所有文件的屬性設置為777，win主機請設置internet來賓帳戶可讀寫屬性<br>
	<table class="datatable">
	<tr style="font-weight:bold;"><td>名稱</td><td>所需權限屬性</td><td>說明</td><td>檢測結果</td></tr>
	<tr><td><strong>./config.php</strong></td><td>讀/寫</td><td>系統配置文件</td><td>$perms[config]</td></tr>
	<tr><td><strong>./attachment/</strong> (包括本目錄、子目錄和文件)</td><td>讀/寫/刪</td><td>附件目錄</td><td>$perms[attachment]</td></tr>
	<tr><td><strong>./data/</strong> (包括本目錄、子目錄和文件)</td><td>讀/寫/刪</td><td>站點數據目錄</td><td>$perms[data]</td></tr>
	<tr><td><strong>./uc_client/data/</strong> (包括本目錄、子目錄和文件)</td><td>讀/寫/刪</td><td>uc_client數據目錄</td><td>$perms[uc_data]</td></tr>
	</table>
	</td></tr>
	</table>
END;

	if(!$checkok) {
		echo "<table><tr><td><b>出現問題</b>:<br>系統檢測到以上目錄或文件權限沒有正確設置<br>強烈建議正常設置權限後再刷新本頁面以便繼續安裝<br>否則系統可能會出現無法預料的問題 [<a href=\"$theurl?step=1\">強制繼續</a>]</td></tr></table>";
	} else {
		$ucapi = empty($_POST['ucapi'])?'/':$_POST['ucapi'];
		$ucfounderpw = empty($_POST['ucfounderpw'])?'':$_POST['ucfounderpw'];
		print <<<END
		<form id="theform" method="post" action="$theurl?step=1">
			<table class=button>
				<tr>
					<td><input type="submit" id="startsubmit" name="startsubmit" value="接受授權協議，開始安裝UCenter Home"></td>
				</tr>
			</table>
			<input type="hidden" name="ucapi" value="$ucapi" />
			<input type="hidden" name="ucfounderpw" value="$ucfounderpw" />
			<input type="hidden" name="formhash" value="$formhash">
		</form>
END;
	}

	print<<<END
	<table id="tbl_readme" style="display:none;" class="showtable">
	<tr>
	<td><strong>請您務必仔細閱讀下面的許可協議:</strong> </td></tr>
	<tr>
	<td>
	<div>中文版授權協議 適用於中文用戶
	<p>版權所有 (C) 2001-2009，康盛創想（北京）科技有限公司<br>保留所有權利。
	</p><p>感謝您選擇 UCenter Home。希望我們的努力能為您提供一個強大的社會化網絡(SNS)解決方案。通過 UCenter Home，建站者可以輕鬆構建一個以好友關係為核心的交流網絡，讓站點用戶可以用一句話記錄生活中的點點滴滴；方便快捷地發佈日誌、上傳圖片；更可以十分方便的與其好友們一起分享信息、討論感興趣的話題；輕鬆快捷的瞭解好友最新動態。
	</p><p>康盛創想（北京）科技有限公司為 UCenter Home 產品的開發商，依法獨立擁有 UCenter Home 產品著作權（中國國家版權局 著作權登記號 2006SR12091）。康盛創想（北京）科技有限公司網址為
	http://www.comsenz.com，UCenter Home 官方網站網址為 http://u.discuz.net。
	</p><p>UCenter Home 著作權已在中華人民共和國國家版權局註冊，著作權受到法律和國際公約保護。使用者：無論個人或組織、盈利與否、用途如何
	（包括以學習和研究為目的），均需仔細閱讀本協議，在理解、同意、並遵守本協議的全部條款後，方可開始使用 UCenter Home 軟件。
	</p><p>康盛創想（北京）科技有限公司擁有對本授權協議的最終解釋權。
	<ul type=i>
	<p>
	<li><b>協議許可的權利</b>
	<ul type=1>
	<li>您可以在完全遵守本最終用戶授權協議的基礎上，將本軟件應用於非商業用途，而不必支付軟件版權授權費用。
	<li>您可以在協議規定的約束和限制範圍內修改 UCenter Home 源代碼(如果被提供的話)或界面風格以適應您的網站要求。
	<li>您擁有使用本軟件構建的站點中全部會員資料、文章及相關信息的所有權，並獨立承擔與文章內容的相關法律義務。
	<li>獲得商業授權之後，您可以將本軟件應用於商業用途，同時依據所購買的授權類型中確定的技術支持期限、技術支持方式和技術支持內容，
	自購買時刻起，在技術支持期限內擁有通過指定的方式獲得指定範圍內的技術支持服務。商業授權用戶享有反映和提出意見的權力，相關意見
	將被作為首要考慮，但沒有一定被採納的承諾或保證。 </li></ul>
	<p></p>
	<li><b>協議規定的約束和限制</b>
	<ul type=1>
	<li>未獲商業授權之前，不得將本軟件用於商業用途（包括但不限於企業網站、經營性網站、以營利為目或實現盈利的網站）。購買商業授權請登陸http://www.discuz.com參考相關說明，也可以致電8610-51657885瞭解詳情。
	<li>不得對本軟件或與之關聯的商業授權進行出租、出售、抵押或發放子許可證。
	<li>無論如何，即無論用途如何、是否經過修改或美化、修改程度如何，只要使用 UCenter Home 的整體或任何部分，未經書面許可，程序頁面頁腳處
	的 UCenter Home 名稱和康盛創想（北京）科技有限公司下屬網站（http://www.comsenz.com、http://u.discuz.net） 的 鏈接都必須保留，而不能清除或修改。
	<li>禁止在 UCenter Home 的整體或任何部分基礎上以發展任何派生版本、修改版本或第三方版本用於重新分發。
	<li>如果您未能遵守本協議的條款，您的授權將被終止，所被許可的權利將被收回，並承擔相應法律責任。 </li></ul>
	<p></p>
	<li><b>有限擔保和免責聲明</b>
	<ul type=1>
	<li>本軟件及所附帶的文件是作為不提供任何明確的或隱含的賠償或擔保的形式提供的。
	<li>用戶出於自願而使用本軟件，您必須瞭解使用本軟件的風險，在尚未購買產品技術服務之前，我們不承諾提供任何形式的技術支持、使用擔保，
	也不承擔任何因使用本軟件而產生問題的相關責任。
	<li>康盛創想（北京）科技有限公司不對使用本軟件構建的站點中的文章或信息承擔責任。 </li></ul></li></ul>
	<p>有關 UCenter Home 最終用戶授權協議、商業授權與技術服務的詳細內容，均由 UCenter Home 官方網站獨家提供。康盛創想（北京）科技有限公司擁有在不 事先通知的情況下，修改授權協議和服務價目表的權力，修改後的協議或價目表對自改變之日起的新授權用戶生效。
	<p>電子文本形式的授權協議如同雙方書面簽署的協議一樣，具有完全的和等同的法律效力。您一旦開始安裝 UCenter Home，即被視為完全理解並接受本協議的各項條款，在享有上述條款授予的權力的同時，受到相關的約束和限制。協議許可範圍以外的行為，將直接違反本授權協議並構成侵權，我們有權隨時終止授權，責令停止損害，並保留追究相關責任的權力。 </p></div>
	</td></tr>
	</table>
END;

	show_footer();

} elseif($step == 1) {

	show_header();
	$ucapi = "http://";
	$ucfounderpw = '';
	$showdiv = 0;
	if($_POST['ucfounderpw']) {
		$showdiv = 1;
		$ucapi = trim($_POST['ucapi']);
		$ucfounderpw = trim($_POST['ucfounderpw']);
	}

	if($showdiv) {
		print<<<END
		<form id="theform" method="post" action="$theurl">
		<div>
			<table class="showtable">
				<tr><td><strong># UCenter 參數自動獲取</strong></td></tr>
				<tr><td id="msg2">UCenter的相關信息已成功獲取，請直接點擊下面的按鈕提交配置</td></tr>
			</table>
			<br/>
		</div>
		<div>
END;
	} else {
		$plus = '';
		if(!$ucfounderpw) {
			$plus = '<tr><td id="msg2">
					使用UCenter Home，首先需要您的站點安裝有統一存儲用戶帳號信息的UCenter用戶中心系統。<br>
					如果您的站點還沒有安裝過UCenter，請這樣操作：<br>
					1. <a href="http://download.comsenz.com/UCenter/" target="_blank"><b>請點擊這裡下載最新版本的UCenter</b></a>，並閱讀程序包中的說明進行UCenter的安裝。<br>
					2. 安裝完畢 UCenter 後，在下面填入UCenter的相關信息即可繼續進行UCenter Home 的安裝。<br>
				</td></tr>';
		}
		print<<<END
		<form id="theform" method="post" action="$theurl">
		<div>
			<table class="showtable">
				<tr><td><strong># 請填寫 UCenter 的相關參數</strong></td></tr>
				$plus
			</table>
			<br>
			<p style="font-weight:bold;">請輸入已安裝UCenter的信息:</p>
END;
	}
	print<<<END
		<table class=datatable>
			<tbody>
				<tr>
					<td>UCenter 的 URL:</td>
					<td><input type="text" id="ucapi" name="ucapi" size="60" value="$ucapi"><br>例如：http://www.discuz.net/ucenter</td>
				</tr>
				<tr>
					<td>UCenter 的創始人密碼:</td>
					<td><input type="password" id="ucfounderpw" name="ucfounderpw" size="20" value="$ucfounderpw"></td>
				</tr>
			</tbody>
		</table>
		<br>
	</div>
	<table class=button>
	<tr><td><input type="submit" id="ucsubmit" name="ucsubmit" value="提交UCenter配置信息"></td></tr>
	</table>
	<input type="hidden" id="ucfounder" name="ucfounder" size="20" value="">
	<input type="hidden" name="formhash" value="$formhash">
	</form>
END;
	show_footer();

} elseif ($step == 2) {

	//檢測目錄屬性
	show_header();
	//設置數據庫配置
	print<<<END
	<form id="theform" method="post" action="$theurl">

	<table class="showtable">
	<tr><td><strong># 設置UCenter Home數據庫信息</strong></td></tr>
	<tr><td id="msg1">這裡設置UCenter Home的數據庫信息</td></tr>
	</table>
	<table class=datatable>
	<tr>
	<td width="25%">數據庫服務器本地地址:</td>
	<td><input type="text" name="db[dbhost]" size="20" value="localhost"></td>
	<td width="30%">一般為localhost</td>
	</tr>
	<tr>
	<td>數據庫用戶名:</td>
	<td><input type="text" name="db[dbuser]" size="20" value=""></td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>數據庫密碼:</td>
	<td><input type="password" name="db[dbpw]" size="20" value=""></td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>數據庫字符集:</td>
	<td>
	<select name="db[dbcharset]" onchange="addoption(this)">
	<option value="$_SC[dbcharset]">$_SC[dbcharset]</option>
	<option value="addoption" class="addoption">+自定義</option>
	</select>
	</td>
	<td>MySQL版本>4.1有效</td>
	</tr>
	<tr>
	<td>數據庫名:</td>
	<td><input type="text" name="db[dbname]" size="20" value=""></td>
	<td>如果不存在，則會嘗試自動創建</td>
	</tr>
	<tr>
	<td>表名前綴:</td>
	<td><input type="text" name="db[tablepre]" size="20" value="uchome_"></td>
	<td>不能為空，默認為uchome_</td>
	</tr>
	</table>

	<table class=button>
	<tr><td><input type="submit" id="sqlsubmit" name="sqlsubmit" value="設置完畢,檢測我的數據庫配置"></td></tr>
	</table>
	<input type="hidden" name="formhash" value="$formhash">
	</form>
END;
	show_footer();

} elseif ($step == 3) {

	//鏈接數據庫
	dbconnect();

	//安裝數據庫
	//獲取最新的sql文
	$newsql = sreadfile($sqlfile);

	if($_SC['tablepre'] != 'uchome_') $newsql = str_replace('uchome_', $_SC['tablepre'], $newsql);//替換表名前綴

	//獲取要創建的表
	$tables = $sqls = array();
	if($newsql) {
		preg_match_all("/(CREATE TABLE ([a-z0-9\_\-`]+).+?\s*)(TYPE|ENGINE)+\=/is", $newsql, $mathes);
		$sqls = $mathes[1];
		$tables = $mathes[2];
	}
	if(empty($tables)) {
		show_msg("安裝SQL語句獲取失敗，請確認SQL文件 $sqlfile 是否存在");
	}

	$heaptype = $_SGLOBAL['db']->version()>'4.1'?" ENGINE=MEMORY".(empty($_SC['dbcharset'])?'':" DEFAULT CHARSET=$_SC[dbcharset]" ):" TYPE=HEAP";
	$myisamtype = $_SGLOBAL['db']->version()>'4.1'?" ENGINE=MYISAM".(empty($_SC['dbcharset'])?'':" DEFAULT CHARSET=$_SC[dbcharset]" ):" TYPE=MYISAM";
	$installok = true;
	foreach ($tables as $key => $tablename) {
		if(strpos($tablename, 'session')) {
			$sqltype = $heaptype;
		} else {
			$sqltype = $myisamtype;
		}
		$_SGLOBAL['db']->query("DROP TABLE IF EXISTS `$tablename`");
		if(!$query = $_SGLOBAL['db']->query($sqls[$key].$sqltype, 'SILENT')) {
			$installok = false;
			break;
		}
	}
	if(!$installok) {
		show_msg("<font color=\"blue\">數據表 ($tablename) 自動安裝失敗</font><br />反饋: ".mysql_error()."<br /><br />請參照 $sqlfile 文件中的SQL文，自己手工安裝數據庫後，再繼續進行安裝操作<br /><br /><a href=\"?step=$step\">重試</a>");
	} else {
		show_msg('數據表已經全部安裝完成，進入下一步操作', ($step+1), 1);
	}

} elseif ($step == 4) {

	//插入默認數據
	dbconnect();
	$privacy = array(
		'view' => array(
			'index' => 0,
			'profile' => 0,
			'friend' => 0,
			'wall' => 0,
			'feed' => 0,
			'mtag' => 0,
			'event' => 0,
			'doing' => 0,
			'blog' => 0,
			'album' => 0,
			'share' => 0,
			'poll' => 0
		),
		'feed' => array(
			'doing' => 1,
			'blog' => 1,
			'upload' => 1,
			'share' => 1,
			'poll' => 1,
			'joinpoll' => 1,
			'thread' => 1,
			'post' => 1,
			'mtag' => 1,
			'event' => 1,
			'join' => 1,
			'friend' => 1,
			'comment' => 1,
			'show' => 1,
			'spaceopen' => 1,
			'credit' => 1,
			'invite' => 1,
			'task' => 1,
			'profile' => 1,
			'album' => 1,
			'click' => 1
		)
	);
	//config
	$datas = array(
		"('sitename', '我的空間')",
		"('template', 'default')",
		"('adminemail', 'webmaster@".$_SERVER['HTTP_HOST']."')",
		"('onlinehold', '1800')",
		"('timeoffset', '8')",
		"('maxpage', '100')",
		"('starcredit', '100')",
		"('starlevelnum', '5')",
		"('cachemode', 'database')",
		"('cachegrade', '0')",
		"('allowcache', '1')",
		"('allowdomain', '0')",
		"('allowrewrite', '0')",
		"('allowwatermark', '0')",
		"('allowftp', '0')",
		"('holddomain', 'www|*blog*|*space*|x')",
		"('mtagminnum', '5')",
		"('feedday', '7')",
		"('feedmaxnum', '100')",
		"('feedfilternum', '10')",
		"('importnum', '100')",
		"('maxreward', '10')",
		"('singlesent', '50')",
		"('groupnum', '8')",
		"('closeregister', '0')",
		"('closeinvite', '0')",
		"('close', '0')",
		"('networkpublic', '1')",
		"('networkpage', '1')",
		"('seccode_register', '1')",
		"('uc_tagrelated', '1')",
		"('manualmoderator', '1')",
		"('linkguide', '1')",
		"('showall', '1')",
		"('sendmailday', '0')",
		"('realname', '0')",
		"('namecheck', '0')",
		"('namechange', '0')",
		"('name_allowviewspace', '1')",
		"('name_allowfriend', '1')",
		"('name_allowpoke', '1')",
		"('name_allowdoing', '1')",
		"('name_allowblog', '0')",
		"('name_allowalbum', '0')",
		"('name_allowthread', '0')",
		"('name_allowshare', '0')",
		"('name_allowcomment', '0')",
		"('name_allowpost', '0')",
		"('showallfriendnum', '10')",
		"('feedtargetblank', '1')",
		"('feedread', '1')",
		"('feedhotnum', '3')",
		"('feedhotday', '2')",
		"('feedhotmin', '3')",
		"('feedhiddenicon', 'friend,profile,task,wall')",
		"('uc_tagrelatedtime', '86400')",
		"('privacy', '".serialize($privacy)."')",
		"('cronnextrun', '$_SGLOBAL[timestamp]')",
		"('my_status', '0')",
		"('maxreward', '10')",
		"('uniqueemail', '1')",
		"('updatestat', '1')",
		"('my_showgift', '1')",
		"('topcachetime', '60')",
		"('newspacenum', '3')"
	);
	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('config'));
	$_SGLOBAL['db']->query("REPLACE INTO ".tname('config')." (var, datavalue) VALUES ".implode(',', $datas));

	//profield
	$datas = array(
		"('自由聯盟', 'text', '100', '0', '1')",
		"('地區聯盟', 'text', '100', '0', '1')",
		"('興趣聯盟', 'text', '100', '0', '1')"
	);
	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('profield'));
	$_SGLOBAL['db']->query("REPLACE INTO ".tname('profield')." (title,formtype,inputnum,manualmoderator,manualmember) VALUES ".implode(',', $datas));

	//用戶組
	$datas = array();
	$datas['grouptitle'] = array('站點管理員', '信息管理員', '貴賓VIP', '受限會員', '普通會員', '中級會員', '高級會員', '禁止發言', '禁止訪問');

	//核心設置
	$datas['gid'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
	$datas['system'] = array(-1, -1, 1, 0, 0, 0, 0, -1, -1);
	$datas['explower'] = array(0, 0, 0, -999999999, 0, 100, 1000, 0, 0);
	$datas['banvisit'] = array(0, 0, 0, 0, 0, 0, 0, 0, 1);
	$datas['searchignore'] = array(1, 1, 1, 0, 0, 0, 1, 0, 0);
	$datas['videophotoignore'] = array(1, 1, 0, 0, 0, 0, 0, 0, 0);
	$datas['spamignore'] = array(1, 1, 1, 0, 0, 0, 0, 0, 0);

	$datas['color'] = array('red', 'blue', 'green', '', '', '', '', '', '');
	$datas['icon'] = array('image/group/admin.gif', 'image/group/infor.gif', 'image/group/vip.gif', '', '', '', '', '', '');

	//基本設置
	$datas['maxfriendnum'] = array(0, 0, 0, 10, 100, 200, 300, 1, 1);
	$datas['maxattachsize'] = array(0, 0, 0, 10, 20, 50, 100, 1, 1);
	$datas['postinterval'] = array(0, 0, 0, 300, 60, 30, 10, 9999, 9999);
	$datas['searchinterval'] = array(0, 0, 0, 600, 60, 30, 10, 9999, 9999);
	
	$datas['verifyevent'] = array(0, 0, 0, 1, 0, 0, 0, 1, 1);

	$datas['domainlength'] = array(1, 3, 3, 0, 0, 5, 3, 99, 99);
	$datas['closeignore'] = array(1, 1, 0, 0, 0, 0, 0, 0, 0);
	$datas['seccode'] = array(0, 0, 0, 1, 0, 0, 0, 1, 1);

	$datas['allowhtml'] = array(1, 1, 1, 0, 0, 0, 1, 0, 0);
	$datas['allowcss'] = array(1, 1, 1, 0, 0, 0, 1, 0, 0);
	$datas['allowviewvideopic'] = array(1, 1, 1, 0, 0, 0, 0, 0, 0);
	
	$datas['allowtopic'] = array(1, 1, 0, 0, 0, 0, 0, 0, 0);
	$datas['allowstat'] = array(1, 1, 0, 0, 0, 0, 0, 0, 0);
	
	foreach (array('comment','blog','poll','doing','upload','share','mtag','thread','post','poke','friend','click','event','magic', 'pm', 'myop') as $value) {
		$datas['allow'.$value] = array(1, 1, 1, 0, 1, 1, 1, 0, 0);
	}

	//管理權限
	//站點設置
	foreach (array('config','usergroup','credit','profilefield','profield','censor','ad','cache','block','template','backup','stat','cron','app', 'network','name','task','report', 'eventclass', 'magic','magiclog','topic', 'batch', 'delspace', 'spacegroup', 'spaceinfo', 'spacecredit', 'spacenote', 'ip', 'hotuser', 'defaultuser', 'click', 'videophoto', 'log') as $value) {
		$datas['manage'.$value] = array(1, 0, 0, 0, 0, 0, 0, 0, 0);
	}

	//信息管理
	foreach (array('tag','mtag','feed','share','doing', 'blog','album','comment','thread', 'event', 'poll') as $value) {
		$datas['manage'.$value] = array(1, 1, 0, 0, 0, 0, 0, 0, 0);
	}

	$keys = array_keys($datas);
	$newdatas = array();
	$g_count = count($datas['grouptitle']);
	for ($i=0; $i<$g_count; $i++) {
		$thes = array();
		foreach ($keys as $value) {
			$thes[] = $datas[$value][$i];
		}
		$newdatas[$i] = "(".simplode($thes).")";
	}
	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('usergroup'));
	$_SGLOBAL['db']->query("REPLACE INTO ".tname('usergroup')." (".implode(',', $keys).") VALUES ".implode(',', $newdatas));

	//積分規則
	$ruls = array();
	//加積分
	$ruls[] = "('開通空間', 'register', '0', '0', '1', '1', '10', '0', '0')";
	$ruls[] = "('實名認證', 'realname', '0', '0', '1', '1', '20', '0', '20')";
	$ruls[] = "('郵箱認證', 'realemail', '0', '0', '1', '1', '40', '0', '40')";
	$ruls[] = "('成功邀請好友', 'invitefriend', '4', '0', '20', '1', '10', '0', '10')";
	$ruls[] = "('設置頭像', 'setavatar', '0', '0', '1', '1', '15', '0', '15')";
	$ruls[] = "('視頻認證', 'videophoto', '0', '0', '1', '1', '40', '0', '40')";
	$ruls[] = "('成功舉報', 'report', '4', '0', '0', '1', '2', '0', '2')";
	$ruls[] = "('更新心情', 'updatemood', '1', '0', '3', '1', '3', '0', '3')";
	$ruls[] = "('熱點信息', 'hotinfo', '4', '0', '0', '1', '10', '0', '10')";
	$ruls[] = "('每天登陸', 'daylogin', '1', '0', '1', '1', '15', '0', '15')";
	$ruls[] = "('訪問別人空間', 'visit', '1', '0', '10', '1', '1', '2', '1')";
	$ruls[] = "('打招呼', 'poke', '1', '0', '10', '1', '1', '2', '1')";
	$ruls[] = "('留言', 'guestbook', '1', '0', '20', '1', '2', '2', '2')";
	$ruls[] = "('被留言', 'getguestbook', '1', '0', '5', '1', '1', '2', '0')";
	$ruls[] = "('發表記錄', 'doing', '1', '0', '5', '1', '1', '0', '1')";
	$ruls[] = "('發表日誌', 'publishblog', '1', '0', '3', '1', '5', '0', '5')";
	$ruls[] = "('上傳圖片', 'uploadimage', '1', '0', '10', '1', '2', '0', '2')";
	$ruls[] = "('拍大頭貼', 'camera', '1', '0', '5', '1', '3', '0', '3')";
	$ruls[] = "('發表話題', 'publishthread', '1', '0', '5', '1', '5', '0', '5')";
	$ruls[] = "('回復話題', 'replythread', '1', '0', '10', '1', '1', '1', '1')";
	$ruls[] = "('創建投票', 'createpoll', '1', '0', '5', '1', '2', '0', '2')";
	$ruls[] = "('參與投票', 'joinpoll', '1', '0', '10', '1', '1', '1', '1')";
	$ruls[] = "('發起活動', 'createevent', '1', '0', '1', '1', '3', '0', '3')";
	$ruls[] = "('參與活動', 'joinevent', '1', '0', '1', '1', '1', '1', '1')";
	$ruls[] = "('推薦活動', 'recommendevent', '4', '0', '0', '1', '10', '0', '10')";
	$ruls[] = "('發起分享', 'createshare', '1', '0', '3', '1', '2', '0', '2')";
	$ruls[] = "('評論', 'comment', '1', '0', '40', '1', '1', '1', '1')";
	$ruls[] = "('被評論', 'getcomment', '1', '0', '20', '1', '1', '1', '0')";
	$ruls[] = "('安裝應用', 'installapp', '4', '0', '0', '1', '5', '3', '5')";
	$ruls[] = "('使用應用', 'useapp', '1', '0', '10', '1', '1', '3', '1')";
	$ruls[] = "('信息表態', 'click', '1', '0', '10', '1', '1', '1', '1')";
	//扣積分
	$ruls[] = "('修改實名', 'editrealname', '0', '0', '1', '0', '5', '0', '0')";
	$ruls[] = "('更改郵箱認證', 'editrealemail', '0', '0', '1', '0', '5', '0', '0')";
	$ruls[] = "('頭像被刪除', 'delavatar', '0', '0', '1', '0', '10', '0', '10')";
	$ruls[] = "('獲取邀請碼', 'invitecode', '0', '0', '1', '0', '0', '0', '0')";
	$ruls[] = "('搜索一次', 'search', '0', '0', '1', '0', '1', '0', '0')";
	$ruls[] = "('日誌導入', 'blogimport', '0', '0', '1', '0', '10', '0', '0')";
	$ruls[] = "('修改域名', 'modifydomain', '0', '0', '1', '0', '5', '0', '0')";
	$ruls[] = "('日誌被刪除', 'delblog', '0', '0', '1', '0', '10', '0', '10')";
	$ruls[] = "('記錄被刪除', 'deldoing', '0', '0', '1', '0', '2', '0', '2')";
	$ruls[] = "('圖片被刪除', 'delimage', '0', '0', '1', '0', '4', '0', '4')";
	$ruls[] = "('投票被刪除', 'delpoll', '0', '0', '1', '0', '4', '0', '4')";
	$ruls[] = "('話題被刪除', 'delthread', '0', '0', '1', '0', '4', '0', '4')";
	$ruls[] = "('活動被刪除', 'delevent', '0', '0', '1', '0', '6', '0', '6')";
	$ruls[] = "('分享被刪除', 'delshare', '0', '0', '1', '0', '4', '0', '4')";
	$ruls[] = "('留言被刪除', 'delguestbook', '0', '0', '1', '0', '4', '0', '4')";
	$ruls[] = "('評論被刪除', 'delcomment', '0', '0', '1', '0', '2', '0', '2')";
	
	$_SGLOBAL['db']->query("INSERT INTO ".tname('creditrule')." (`rulename`, `action`, `cycletype`, `cycletime`, `rewardnum`, `rewardtype`, `credit`, `norepeat`, `experience`) VALUES ".implode(',', $ruls));
			
	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('data'));
	//郵件設置
	$mails = array(
		'mailsend' => 1,
		'maildelimiter' => 0,
		'mailusername' => 1
	);
	data_set('mail', $mails);

	//縮略圖設置
	$settings = array(
		'thumbwidth' => 100,
		'thumbheight' => 100,
		'watermarkpos' => 4,
		'watermarktrans' => 75
	);
	data_set('setting', $settings);
	
	//隨便看看
	$network = array(
		'blog' => array('hot1'=>3, 'cache'=>600),
		'pic' => array('hot1'=>3, 'cache'=>700),
		'thread' => array('hot1'=>3, 'cache'=>800),
		'event' => array('cache'=>900),
		'poll' => array('cache'=>500),
	);
	data_set('network', $network);

	//計劃任務
	$datas = array(
		"1, 'system', '更新瀏覽數統計', 'log.php', $_SGLOBAL[timestamp], $_SGLOBAL[timestamp], -1, -1, -1, '0	5	10	15	20	25	30	35	40	45	50	55'",
		"1, 'system', '清理過期feed', 'cleanfeed.php', $_SGLOBAL[timestamp], $_SGLOBAL[timestamp], -1, -1, 3, '4'",
		"1, 'system', '清理個人通知', 'cleannotification.php', $_SGLOBAL[timestamp], $_SGLOBAL[timestamp], -1, -1, 5, '6'",
		"1, 'system', '同步UC的feed', 'getfeed.php', $_SGLOBAL[timestamp], $_SGLOBAL[timestamp], -1, -1, -1, '2	7	12	17	22	27	32	37	42	47	52'",
		"1, 'system', '清理腳印和最新訪客', 'cleantrace.php', $_SGLOBAL[timestamp], $_SGLOBAL[timestamp], -1, -1, 2, '3'"
	);
	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('cron'));
	$_SGLOBAL['db']->query("INSERT INTO ".tname('cron')." (available, type, name, filename, lastrun, nextrun, weekday, day, hour, minute) VALUES (".implode('),(', $datas).")");

	//用戶任務
	$datas = array();
	$datas[] = "1, '更新一下自己的頭像', '頭像就是你在這裡的個人形象。<br>設置自己的頭像後，會讓更多的朋友記住您。', 'avatar.php', 1, '', 0, 20, 'image/task/avatar.gif'";
	$datas[] = "1, '將個人資料補充完整', '把自己的個人資料填寫完整吧。<br>這樣您會被更多的朋友找到的，系統也會幫您找到朋友。', 'profile.php', '', 2, 0, 20, 'image/task/profile.gif'";
	$datas[] = "1, '發表自己的第一篇日誌', '現在，就寫下自己的第一篇日誌吧。<br>與大家一起分享自己的生活感悟。', 'blog.php', 3, '', 0, 5, 'image/task/blog.gif'";
	$datas[] = "1, '尋找並添加五位好友', '有了好友，您發的日誌、圖片等會被好友及時看到並傳播出去；<br>您也會在首頁方便及時的看到好友的最新動態。', 'friend.php', 4, '', 0, 50, 'image/task/friend.gif'";
	$datas[] = "1, '驗證激活自己的郵箱', '填寫自己真實的郵箱地址並驗證通過。<br>您可以在忘記密碼的時候使用該郵箱取回自己的密碼；<br>還可以及時接受站內的好友通知等等。', 'email.php', 5, '', 0, 10, 'image/task/email.gif'";
	$datas[] = "1, '邀請10個新朋友加入', '邀請一下自己的QQ好友或者郵箱聯繫人，讓親朋好友一起來加入我們吧。', 'invite.php', 6, '', 0, 100, 'image/task/friend.gif'";
	$datas[] = "1, '領取每日訪問大禮包', '每天登錄訪問自己的主頁，就可領取大禮包。', 'gift.php', 99, 'day', 0, 5, 'image/task/gift.gif'";

	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('task'));
	$_SGLOBAL['db']->query("INSERT INTO ".tname('task')." (`available`, `name`, `note`, `filename`, `displayorder`, `nexttype`, `nexttime`, `credit`, `image`) VALUES (".implode('),(', $datas).")");

	//活動分類
	$datas = array(
		"1, '生活/聚會', 0, '費用說明：\r\n集合地點：\r\n著裝要求：\r\n聯繫方式：\r\n注意事項：', 1",
		"2, '出行/旅遊', 0, '路線說明:\r\n費用說明:\r\n裝備要求:\r\n交通工具:\r\n集合地點:\r\n聯繫方式:\r\n注意事項:', 2",
		"3, '比賽/運動', 0, '費用說明：\r\n集合地點：\r\n著裝要求：\r\n場地介紹：\r\n聯繫方式：\r\n注意事項：', 4",
		"4, '電影/演出', 0, '劇情介紹：\r\n費用說明：\r\n集合地點：\r\n聯繫方式：\r\n注意事項：', 3",
		"5, '教育/講座', 0, '主辦單位：\r\n活動主題：\r\n費用說明：\r\n集合地點：\r\n聯繫方式：\r\n注意事項：', 5",
		"6, '其它', 0, '', 6"
	);	
	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('eventclass'));
	$_SGLOBAL['db']->query("INSERT INTO ".tname('eventclass')." (classid, classname, poster, template, displayorder) VALUES (".implode('),(', $datas).")");
	
	//道具
	$datas = array();
	$datas[] = "'invisible', '隱身草', '讓自己隱身登錄，不顯示在線，24小時內有效', '5', '50', '86400', '10', '86400', '1'";
	$datas[] = "'friendnum', '好友增容卡', '在允許添加的最多好友數限制外，增加10個好友名額', '3', '30', '86400', '999', '0', '1'";
	$datas[] = "'attachsize', '附件增容卡', '使用一次，可以給自己增加 10M 的附件空間', '3', '30', '86400', '999', '0', '1'";
	$datas[] = "'thunder', '雷鳴之聲', '發佈一條全站信息，讓大家知道自己上線了', '5', '500', '86400', '5', '86400', '1'";
	$datas[] = "'updateline', '救生圈', '把指定對象的發佈時間更新為當前時間', '5', '200', '86400', '999', '0', '1'";
		
	$datas[] = "'downdateline', '時空機', '把指定對象的發佈時間修改為過去的時間', '5', '250', '86400', '999', '0', '1'";		
	$datas[] = "'color', '彩色燈', '把指定對象的標題變成彩色的', '5', '50', '86400', '999', '0', '1'";
	$datas[] = "'hot', '熱點燈', '把指定對象的熱度增加站點推薦的熱點值', '5', '50', '86400', '999', '0', '1'";
	$datas[] = "'visit', '互訪卡', '隨機選擇10個好友，向其打招呼、留言或訪問空間', '2', '20', '86400', '999', '0', '1'";
	$datas[] = "'icon', '彩虹蛋', '給指定對象的標題前面增加圖標（最多8個圖標）', '2', '20', '86400', '999', '0', '1'";
		
	$datas[] = "'flicker', '彩虹炫', '讓評論、留言的文字閃爍起來', '3', '30', '86400', '999', '0', '1'";
	$datas[] = "'gift', '紅包卡', '在自己的空間埋下積分紅包送給來訪者', '2', '20', '86400', '999', '0', '1'";
	$datas[] = "'superstar', '超級明星', '在個人主頁，給自己的頭像增加超級明星標識', '3', '30', '86400', '999', '0', '1'";
	$datas[] = "'viewmagiclog', '八卦鏡', '查看指定用戶最近使用的道具記錄', '5', '100', '86400', '999', '0', '1'";
	$datas[] = "'viewmagic', '透視鏡', '查看指定用戶當前持有的道具', '5', '100', '86400', '999', '0', '1'";
		
	$datas[] = "'viewvisitor', '偷窺鏡', '查看指定用戶最近訪問過的10個空間', '5', '100', '86400', '999', '0', '1'";
	$datas[] = "'call', '點名卡', '發通知給自己的好友，讓他們來查看指定的對象', '5', '50', '86400', '999', '0', '1'";
	$datas[] = "'coupon', '代金券','購買道具時折換一定量的積分', '0', '0', '0', '0', '0', '1'";
	$datas[] = "'frame', '相框', '給自己的照片添上相框', '3', '30', '86400', '999', '0', '1'";
	$datas[] = "'bgimage', '信紙', '給指定的對象添加信紙背景', '3', '30', '86400', '999', '0', '1'";
		
	$datas[] = "'doodle', '塗鴉板', '允許在留言、評論等操作時使用塗鴉板', '3', '30', '86400', '999', '0', '1'";
	$datas[] = "'anonymous', '匿名卡', '在指定的地方，讓自己的名字顯示為匿名', '5', '50', '86400', '999', '0', '1'";
	$datas[] = "'reveal', '照妖鏡', '可以查看一次匿名用戶的真實身份', '5', '100', '86400', '999', '0', '1'";
	$datas[] = "'license', '道具轉讓許可證', '使用許可證，將道具贈送給指定好友', '1', '10', '3600', '999', '0', '1'";
	$datas[] = "'detector', '探測器', '探測埋了紅包的空間', '1', '10', '86400', '999', '0', '1'";
	
	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('magic'));
	$_SGLOBAL['db']->query("INSERT INTO ".tname('magic')."(`mid`, `name`, `description`, `experience`, `charge`, `provideperoid`, `providecount`, `useperoid`, `usecount`) VALUES (".implode('),(', $datas).")");		

	//表態
	$datas = array(
		"'1', '路過', 'luguo.gif', 'blogid'",
		"'2', '雷人', 'leiren.gif', 'blogid'",
		"'3', '握手', 'woshou.gif', 'blogid'",
		"'4', '鮮花', 'xianhua.gif', 'blogid'",
		"'5', '雞蛋', 'jidan.gif', 'blogid'",
		
		"'6', '漂亮', 'piaoliang.gif', 'picid'",
		"'7', '酷斃', 'kubi.gif', 'picid'",
		"'8', '雷人', 'leiren.gif', 'picid'",
		"'9', '鮮花', 'xianhua.gif', 'picid'",
		"'10', '雞蛋', 'jidan.gif', 'picid'",
		
		"'11', '搞笑', 'gaoxiao.gif', 'tid'",
		"'12', '迷惑', 'mihuo.gif', 'tid'",
		"'13', '雷人', 'leiren.gif', 'tid'",
		"'14', '鮮花', 'xianhua.gif', 'tid'",
		"'15', '雞蛋', 'jidan.gif', 'tid'"
	);
	$_SGLOBAL['db']->query("TRUNCATE TABLE ".tname('click'));
	$_SGLOBAL['db']->query("INSERT INTO ".tname('click')." (clickid, `name`, icon, idtype) VALUES (".implode('),(', $datas).")");

	show_msg('系統默認數據添加完畢，進入下一步操作', ($step+1), 1);

} elseif ($step == 5) {

	//更新緩存
	dbconnect();
	include_once(S_ROOT.'./source/function_cache.php');

	config_cache();
	usergroup_cache();
	profilefield_cache();
	profield_cache();
	censor_cache();
	block_cache();
	eventclass_cache();
	magic_cache();
	click_cache();
	task_cache();
	ad_cache();
	creditrule_cache();
	userapp_cache();
	app_cache();
	network_cache();

	$msg = <<<EOF
	<form method="post" action="$theurl">
	<table>
	<tr><td colspan="2">程序數據安裝完成!<br><br>
	最後，請輸入您在用戶中心UCenter的用戶名和密碼<br>系統將自動為您開通站內第一個空間，並將您設為管理員!
	</td></tr>
	<tr><td>您的用戶名</td><td><input type="text" name="username" value="" size="30"></td></tr>
	<tr><td>您的密碼</td><td><input type="password" name="password" value="" size="30"></td></tr>
	<tr><td></td><td><input type="submit" name="opensubmit" value="開通管理員空間"></td></tr>
	</table>
	<input type="hidden" name="formhash" value="$formhash">
	</form>
EOF;

	show_msg($msg, 999);
}

//頁面頭部
function show_header() {
	global $_SGLOBAL, $nowarr, $step, $theurl, $_SC;

	$nowarr[$step] = ' class="current"';
	print<<<END
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=$_SC[charset]" />
	<title> UCenter Home 程序安裝 </title>
	<style type="text/css">
	* {font-size:12px; font-family: Verdana, Arial, Helvetica, sans-serif; line-height: 1.5em; word-break: break-all; }
	body { text-align:center; margin: 0; padding: 0; background: #F5FBFF; }
	.bodydiv { margin: 40px auto 0; width:720px; text-align:left; border: solid #86B9D6; border-width: 5px 1px 1px; background: #FFF; }
	h1 { font-size: 18px; margin: 1px 0 0; line-height: 50px; height: 50px; background: #E8F7FC; color: #5086A5; padding-left: 10px; }
	#menu {width: 100%; margin: 10px auto; text-align: center; }
	#menu td { height: 30px; line-height: 30px; color: #999; border-bottom: 3px solid #EEE; }
	.current { font-weight: bold; color: #090 !important; border-bottom-color: #F90 !important; }
	.showtable { width:100%; border: solid; border-color:#86B9D6 #B2C9D3 #B2C9D3; border-width: 3px 1px 1px; margin: 10px auto; background: #F5FCFF; }
	.showtable td { padding: 3px; }
	.showtable strong { color: #5086A5; }
	.datatable { width: 100%; margin: 10px auto 25px; }
	.datatable td { padding: 5px 0; border-bottom: 1px solid #EEE; }
	input { border: 1px solid #B2C9D3; padding: 5px; background: #F5FCFF; }
	.button { margin: 10px auto 20px; width: 100%; }
	.button td { text-align: center; }
	.button input, .button button { border: solid; border-color:#F90; border-width: 1px 1px 3px; padding: 5px 10px; color: #090; background: #FFFAF0; cursor: pointer; }
	#footer { font-size: 10px; line-height: 40px; background: #E8F7FC; text-align: center; height: 38px; overflow: hidden; color: #5086A5; margin-top: 20px; }
	</style>
	<script type="text/javascript">
	function $(id) {
		return document.getElementById(id);
	}
	//添加Select選項
	function addoption(obj) {
		if (obj.value=='addoption') {
			var newOption=prompt('請輸入:','');
			if (newOption!=null && newOption!='') {
				var newOptionTag=document.createElement('option');
				newOptionTag.text=newOption;
				newOptionTag.value=newOption;
				try {
					obj.add(newOptionTag, obj.options[0]); // doesn't work in IE
				}
				catch(ex) {
					obj.add(newOptionTag, obj.selecedIndex); // IE only
				}
				obj.value=newOption;
			} else {
				obj.value=obj.options[0].value;
			}
		}
	}
	</script>
	</head>
	<body id="append_parent">
	<div class="bodydiv">
	<h1>UCenter Home程序安裝</h1>
	<div style="width:90%;margin:0 auto;">
	<table id="menu">
	<tr>
	<td{$nowarr[0]}>1.安裝開始</td>
	<td{$nowarr[1]}>2.設置UCenter信息</td>
	<td{$nowarr[2]}>3.設置數據庫連接信息</td>
	<td{$nowarr[3]}>4.創建數據庫結構</td>
	<td{$nowarr[4]}>5.添加默認數據</td>
	<td{$nowarr[5]}>6.安裝完成</td>
	</tr>
	</table>
END;
}

//頁面頂部
function show_footer() {
	print<<<END
	</div>
	<iframe id="phpframe" name="phpframe" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank"></iframe>
	<div id="footer">&copy; Comsenz Inc. 2001-2009 u.discuz.net</div>
	</div>
	<br>
	</body>
	</html>
END;
}


//顯示
function show_msg($message, $next=0, $jump=0) {
	global $theurl;

	$nextstr = '';
	$backstr = '';

	obclean();
	if(empty($next)) {
		$backstr .= "<a href=\"javascript:history.go(-1);\">返回上一步</a>";
	} elseif ($next == 999) {
	} else {
		$url_forward = "$theurl?step=$next";
		if($jump) {
			$nextstr .= "<a href=\"$url_forward\">請稍等...</a><script>setTimeout(\"window.location.href ='$url_forward';\", 1000);</script>";
		} else {
			$nextstr .= "<a href=\"$url_forward\">繼續下一步</a>";
			$backstr .= "<a href=\"javascript:history.go(-1);\">返回上一步</a>";
		}
	}

	show_header();
	print<<<END
	<table>
	<tr><td>$message</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>$backstr $nextstr</td></tr>
	</table>
END;
	show_footer();
	exit();
}

//檢查權限
function checkfdperm($path, $isfile=0) {
	if($isfile) {
		$file = $path;
		$mod = 'a';
	} else {
		$file = $path.'./install_tmptest.data';
		$mod = 'w';
	}
	if(!@$fp = fopen($file, $mod)) {
		return false;
	}
	if(!$isfile) {
		//是否可以刪除
		fwrite($fp, ' ');
		fclose($fp);
		if(!@unlink($file)) {
			return false;
		}
		//檢測是否可以創建子目錄
		if(is_dir($path.'./install_tmpdir')) {
			if(!@rmdir($path.'./install_tmpdir')) {
				return false;
			}
		}
		if(!@mkdir($path.'./install_tmpdir')) {
			return false;
		}
		//是否可以刪除
		if(!@rmdir($path.'./install_tmpdir')) {
			return false;
		}
	} else {
		fclose($fp);
	}
	return true;
}

?>
