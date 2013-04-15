<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: sample.php 11056 2009-02-09 01:59:47Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//內置變量：$task['done'] (完成標識變量) $task['result'] (結果文字) $task['guide'] (嚮導文字)

//判斷用戶是否完成了任務
$done = 0;

//---------------------------------------------------
//	編寫代碼，判讀用戶是否完成任務要求 $done = 1;
//---------------------------------------------------

if($done) {

	$task['done'] = 1;//任務完成
	$task['result'] = '......';//用戶參與任務看到的文字說明。支持html代碼
	
} else {

	//任務完成嚮導
	$task['guide'] = '......'; //指導用戶如何參與任務的文字說明。支持html代碼

}

?>