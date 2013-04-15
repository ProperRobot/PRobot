<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: email.php 12304 2009-06-03 07:29:34Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if($space['emailcheck']) {

	$task['done'] = 1;//任務完成

} else {

	//任務完成嚮導
	$task['guide'] = '
		<strong>請按照以下的說明來參與本任務：</strong>
		<ul>
		<li><a href="cp.php?ac=profile&op=contact" target="_blank">新窗口打開賬號設置頁面</a>；</li>
		<li>在新打開的設置頁面中，將自己的郵箱真實填寫，並點擊「驗證郵箱」按鈕；</li>
		<li>幾分鐘後，系統會給你發送一封郵件，收到郵件後，請按照郵件的說明，訪問郵件中的驗證鏈接就可以了。</li>
		</ul>';

}

?>