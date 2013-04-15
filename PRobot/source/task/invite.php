<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: invite.php 12304 2009-06-03 07:29:34Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//用戶任務完成標識變量 		$task['done']
//任務完成結果html存儲變量 	$task['result']
//用戶任務嚮導html存儲變量 	$task['guide']

$query = $_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname('invite')." WHERE uid='$space[uid]' AND fuid>'0'");
$count = $_SGLOBAL['db']->result($query, 0);

if($count >= 10) {
	
	$task['done'] = 1;//任務完成

} else {

	//任務完成嚮導
	if($count) {
		$task['guide'] .= '<p style="color:red;">哇，厲害，您現在已經邀請了 '.$count.' 個好友了。繼續努力！</p><br>';
	}
	$task['guide'] .= '<strong>請按照以下的說明來完成本任務：</strong>
		<ul class="task">
		<li>在新窗口中打開<a href="cp.php?ac=invite" target="_blank">好友邀請頁面</a>；</li>
		<li>通過QQ、MSN等IM工具，或者發送郵件，把邀請鏈接告訴你的好友，邀請他們加入進來吧；</li>
		<li>您需要邀請10個好友才算完成。</li>
		</ul>';

}

?>