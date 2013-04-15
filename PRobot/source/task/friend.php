<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: friend.php 11056 2009-02-09 01:59:47Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if($space['friendnum']>=5) {

	$task['done'] = 1;//任務完成

} else {

	//嚮導
	$task['guide'] = '
		<strong>請按照以下的說明來參與本任務：</strong>
		<ul>
		<li>1. <a href="cp.php?ac=friend&op=find" target="_blank">新窗口打開尋找好友頁面</a>；</li>
		<li>2. 在新打開的頁面中，可以將系統自動給你找到的推薦用戶加為好友，也可以自己設置條件尋找並添加為好友；</li>
		<li>3. 接下來，您還需要等待對方批准您的好友申請。</li>
		</ul>';

}

?>