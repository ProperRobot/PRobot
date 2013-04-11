<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: cp_pronotice.php 13026 2009-08-06 02:17:33Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

//检查信息
$pnid = empty($_GET['pnid'])?0:intval($_GET['pnid']);
$op = empty($_GET['op'])?'':$_GET['op'];

$pronotice = array();
if($pnid) {
	$query = $_SGLOBAL['db']->query("SELECT bf.*, b.* FROM ".tname('pronotice')." b 
		LEFT JOIN ".tname('pronoticefield')." bf ON bf.pnid=b.pnid 
		WHERE b.pnid='$pnid'");
	$pronotice = $_SGLOBAL['db']->fetch_array($query);
}

//权限检查
if(empty($pronotice)) {
	if(!checkperm('allowpronotice')) {
		ckspacelog();
		showmessage('no_authority_to_add_log');
	}
	
	//实名认证
	ckrealname('');
	
	//视频认证
	ckvideophoto('pronotice');
	
	//新用户见习
	cknewuser();
	
	//判断是否发布太快
	$waittime = interval_check('post');
	if($waittime > 0) {
		showmessage('operating_too_fast','',1,array($waittime));
	}
	
	//接收外部标题
	$pronotice['subject'] = empty($_GET['subject'])?'':getstr($_GET['subject'], 80, 1, 0);
	$pronotice['message'] = empty($_GET['message'])?'':getstr($_GET['message'], 5000, 1, 0);
	
} else {
	
	if($_SGLOBAL['supe_uid'] != $pronotice['uid'] && !checkperm('managepronotice')) {
		showmessage('no_authority_operation_of_the_log');
	}
}

//添加编辑操作
if(submitcheck('pronoticesubmit')) {

	if(empty($pronotice['pnid'])) {
		$pronotice = array();
	} else {
		if(!checkperm('allowpronotice')) {
			ckspacelog();
			showmessage('no_authority_to_add_log');
		}
	}
	
	//验证码
	if(checkperm('seccode') && !ckseccode($_POST['seccode'])) {
		showmessage('incorrect_code');
	}
	
	include_once(S_ROOT.'./source/function_pronotice.php');
	if($newpronotice = pronotice_post($_POST, $pronotice)) {
		if(empty($pronotice) && $newpronotice['topicid']) {
			$url = 'space.php?do=topic&topicid='.$newpronotice['topicid'].'&view=pronotice';
		} else {
			$url = 'space.php?uid='.$newpronotice['uid'].'&do=pronotice&id='.$newpronotice['pnid'];
		}
		showmessage('do_success', $url, 0);
	} else {
		showmessage('that_should_at_least_write_things');
	}
}

if($_GET['op'] == 'delete') {
	//删除
	if(submitcheck('deletesubmit')) {
		include_once(S_ROOT.'./source/function_delete.php');
		if(deletepronotices(array($pnid))) {
			showmessage('do_success', "space.php?uid=$pronotice[uid]&do=pronotice&view=me");
		} else {
			showmessage('failed_to_delete_operation');
		}
	}
	
} elseif($_GET['op'] == 'goto') {
	
	$id = intval($_GET['id']);
	$uid = $id?getcount('pronotice', array('pnid'=>$id), 'uid'):0;

	showmessage('do_success', "space.php?uid=$uid&do=pronotice&id=$id", 0);
	
} elseif($_GET['op'] == 'edithot') {
	//权限
	if(!checkperm('managepronotice')) {
		showmessage('no_privilege');
	}
	
	if(submitcheck('hotsubmit')) {
		$_POST['hot'] = intval($_POST['hot']);
		updatetable('pronotice', array('hot'=>$_POST['hot']), array('pnid'=>$pronotice['pnid']));
		if($_POST['hot']>0) {
			include_once(S_ROOT.'./source/function_feed.php');
			feed_publish($pronotice['pnid'], 'pnid');
		} else {
			updatetable('feed', array('hot'=>$_POST['hot']), array('id'=>$pronotice['pnid'], 'idtype'=>'pnid'));
		}
		
		showmessage('do_success', "space.php?uid=$pronotice[uid]&do=pronotice&id=$pronotice[pnid]", 0);
	}
	
} else {
	//添加编辑
	//获取个人分类
	$classarr = $pronotice['uid']?getclassarr($pronotice['uid']):getclassarr($_SGLOBAL['supe_uid']);
	//获取相册
	$albums = getalbums($_SGLOBAL['supe_uid']);
	
	$tags = empty($pronotice['tag'])?array():unserialize($pronotice['tag']);
	$pronotice['tag'] = implode(' ', $tags);
	
	$pronotice['target_names'] = '';
	
	$friendarr = array($pronotice['friend'] => ' selected');
	
	$passwordstyle = $selectgroupstyle = 'display:none';
	if($pronotice['friend'] == 4) {
		$passwordstyle = '';
	} elseif($pronotice['friend'] == 2) {
		$selectgroupstyle = '';
		if($pronotice['target_ids']) {
			$names = array();
			$query = $_SGLOBAL['db']->query("SELECT username FROM ".tname('space')." WHERE uid IN ($pronotice[target_ids])");
			while ($value = $_SGLOBAL['db']->fetch_array($query)) {
				$names[] = $value['username'];
			}
			$pronotice['target_names'] = implode(' ', $names);
		}
	}
	
	
	$pronotice['message'] = str_replace('&amp;', '&amp;amp;', $pronotice['message']);
	$pronotice['message'] = shtmlspecialchars($pronotice['message']);
	
	$allowhtml = checkperm('allowhtml');
	
	//好友组
	$groups = getfriendgroup();
	
	//参与热点
	$topic = array();
	$topicid = $_GET['topicid'] = intval($_GET['topicid']);
	if($topicid) {
		$topic = topic_get($topicid);
	}
	if($topic) {
		$actives = array('pronotice' => ' class="active"');
	}
	
	//菜单激活
	$menuactives = array('space'=>' class="active"');
}

include_once template("cp_pronotice");

?>