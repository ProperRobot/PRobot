<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: blog.php 11056 2009-02-09 01:59:47Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$blogcount = getcount('blog', array('uid'=>$space['uid']));
if($blogcount) {

	$task['done'] = 1;//任務完成

} else {

	//任務完成嚮導
	$task['guide'] = '
		<strong>請按照以下的說明來參與本任務：</strong>
		<ul>
		<li>1. <a href="cp.php?ac=blog" target="_blank">新窗口打開發表日誌頁面</a>；</li>
		<li>2. 在新打開的頁面中，書寫自己的第一篇日誌，並進行發佈。</li>
		</ul>';

}

?>