<?php if(!defined('IN_UCHOME')) exit('Access Denied');?><?php subtplcheck('template/default/cp_profile|template/default/header|template/default/cp_header|template/default/footer', '1366034529', 'template/default/cp_profile');?><?php if(empty($_SGLOBAL['inajax'])) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$_SC['charset']?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title><?php if($_TPL['titles']) { ?><?php if(is_array($_TPL['titles'])) { foreach($_TPL['titles'] as $value) { ?><?php if($value) { ?><?=$value?> - <?php } ?><?php } } ?><?php } ?><?php if($_SN[$space['uid']]) { ?><?=$_SN[$space['uid']]?> - <?php } ?><?=$_SCONFIG['sitename']?> - Powered by UCenter Home</title>
<script language="javascript" type="text/javascript" src="source/script_cookie.js"></script>
<script language="javascript" type="text/javascript" src="source/script_common.js"></script>
<script language="javascript" type="text/javascript" src="source/script_menu.js"></script>
<script language="javascript" type="text/javascript" src="source/script_ajax.js"></script>
<script language="javascript" type="text/javascript" src="source/script_face.js"></script>
<script language="javascript" type="text/javascript" src="source/script_manage.js"></script>
<style type="text/css">
@import url(template/default/style.css);
<?php if($_TPL['css']) { ?>
@import url(template/default/<?=$_TPL['css']?>.css);
<?php } ?>
<?php if(!empty($_SGLOBAL['space_theme'])) { ?>
@import url(theme/<?=$_SGLOBAL['space_theme']?>/style.css);
<?php } elseif($_SCONFIG['template'] != 'default') { ?>
@import url(template/<?=$_SCONFIG['template']?>/style.css);
<?php } ?>
<?php if(!empty($_SGLOBAL['space_css'])) { ?>
<?=$_SGLOBAL['space_css']?>
<?php } ?>
</style>
<link rel="shortcut icon" href="image/favicon.ico" />
<link rel="edituri" type="application/rsd+xml" title="rsd" href="xmlrpc.php?rsd=<?=$space['uid']?>" />
</head>
<body>

<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div id="header">
<?php if($_SGLOBAL['ad']['header']) { ?><div id="ad_header"><?php adshow('header'); ?></div><?php } ?>
<div class="headerwarp">
<h1 class="logo"><a href="index.php"><img src="template/<?=$_SCONFIG['template']?>/image/logo.gif" alt="<?=$_SCONFIG['sitename']?>" /></a></h1>
<ul class="menu">
<?php if($_SGLOBAL['supe_uid']) { ?>
<li><a href="space.php?do=home">首頁</a></li>
<li><a href="space.php">個人主頁</a></li>
<li><a href="space.php?do=friend">好友</a></li>
<li><a href="network.php">隨便看看</a></li>
<?php } else { ?>
<li><a href="index.php">首頁</a></li>
<?php } ?>

<?php if($_SGLOBAL['appmenu']) { ?>
<?php if($_SGLOBAL['appmenus']) { ?>
<li class="dropmenu" id="ucappmenu" onclick="showMenu(this.id)">
<a href="javascript:;">站內導航</a>
</li>
<?php } else { ?>
<li><a target="_blank" href="<?=$_SGLOBAL['appmenu']['url']?>" title="<?=$_SGLOBAL['appmenu']['name']?>"><?=$_SGLOBAL['appmenu']['name']?></a></li>
<?php } ?>
<?php } ?>

<?php if($_SGLOBAL['supe_uid']) { ?>
<li><a href="space.php?do=pm<?php if(!empty($_SGLOBAL['member']['newpm'])) { ?>&filter=newpm<?php } ?>">消息<?php if(!empty($_SGLOBAL['member']['newpm'])) { ?>(新)<?php } ?></a></li>
<?php if($_SGLOBAL['member']['allnotenum']) { ?><li class="notify" id="membernotemenu" onmouseover="showMenu(this.id)"><a href="space.php?do=notice"><?=$_SGLOBAL['member']['allnotenum']?>個提醒</a></li><?php } ?>
<?php } else { ?>
<li><a href="help.php">幫助</a></li>
<?php } ?>
</ul>

<div class="nav_account">
<?php if($_SGLOBAL['supe_uid']) { ?>
<a href="space.php?uid=<?=$_SGLOBAL['supe_uid']?>" class="login_thumb"><?php echo avatar($_SGLOBAL[supe_uid]); ?></a>
<a href="space.php?uid=<?=$_SGLOBAL['supe_uid']?>" class="loginName"><?=$_SN[$_SGLOBAL['supe_uid']]?></a>
<?php if($_SGLOBAL['member']['credit']) { ?>
<a href="cp.php?ac=credit" style="font-size:11px;padding:0 0 0 5px;"><img src="image/credit.gif"><?=$_SGLOBAL['member']['credit']?></a>
<?php } ?>
<br />
<?php if(empty($_SCONFIG['closeinvite'])) { ?>
<a href="cp.php?ac=invite">邀請</a> 
<?php } ?>
<a href="cp.php?ac=task">任務</a> 
<a href="cp.php?ac=magic">道具</a>
<a href="cp.php">設置</a> 
<a href="cp.php?ac=common&op=logout&uhash=<?=$_SGLOBAL['uhash']?>">退出</a>
<?php } else { ?>
<a href="do.php?ac=<?=$_SCONFIG['register_action']?>" class="login_thumb"><?php echo avatar($_SGLOBAL[supe_uid]); ?></a>
歡迎您<br>
<a href="do.php?ac=<?=$_SCONFIG['login_action']?>">登錄</a> | 
<a href="do.php?ac=<?=$_SCONFIG['register_action']?>">註冊</a>
<?php } ?>
</div>
</div>
</div>

<div id="wrap">

<?php if(empty($_TPL['nosidebar'])) { ?>
<div id="main">
<div id="app_sidebar">
<?php if($_SGLOBAL['supe_uid']) { ?>
<ul class="app_list" id="default_userapp">
<li><img src="image/app/doing.gif"><a href="space.php?do=doing">記錄</a></li>
<li><img src="image/app/album.gif"><a href="space.php?do=album">相冊</a><em><a href="cp.php?ac=upload" class="gray">上傳</a></em></li>
<li><img src="image/app/blog.gif"><a href="space.php?do=blog">日誌</a><em><a href="cp.php?ac=blog" class="gray">發表</a></em></li>
<li><img src="image/app/doing.gif"><a href="space.php?do=pronotice">物业通知</a></li>
<li><img src="image/app/poll.gif"/><a href="space.php?do=poll">投票</a><em><a href="cp.php?ac=poll" class="gray">發起</a></em></li>
<li><img src="image/app/mtag.gif"><a href="space.php?do=mtag">群組</a><em><a href="cp.php?ac=thread" class="gray">話題</a></em></li>
<li><img src="image/app/event.gif"/><a href="space.php?do=event">活動</a><em><a href="cp.php?ac=event" class="gray">發起</a></em></li>
<li><img src="image/app/share.gif"><a href="space.php?do=share">分享</a></li>
<li><img src="image/app/topic.gif"><a href="space.php?do=topic">熱鬧</a></li>
</ul>

<ul class="app_list topline" id="my_defaultapp">
<?php if($_SCONFIG['my_status']) { ?>
<?php if(is_array($_SGLOBAL['userapp'])) { foreach($_SGLOBAL['userapp'] as $value) { ?>
<li><img src="http://appicon.manyou.com/icons/<?=$value['appid']?>"><a href="userapp.php?id=<?=$value['appid']?>"><?=$value['appname']?></a></li>
<?php } } ?>
<?php } ?>
</ul>

<?php if($_SCONFIG['my_status']) { ?>
<ul class="app_list topline" id="my_userapp">
<?php if(is_array($_SGLOBAL['my_menu'])) { foreach($_SGLOBAL['my_menu'] as $value) { ?>
<li id="userapp_li_<?=$value['appid']?>"><img src="http://appicon.manyou.com/icons/<?=$value['appid']?>"><a href="userapp.php?id=<?=$value['appid']?>" title="<?=$value['appname']?>"><?=$value['appname']?></a></li>
<?php } } ?>
</ul>
<?php } ?>

<?php if($_SGLOBAL['my_menu_more']) { ?>
<p class="app_more"><a href="javascript:;" id="a_app_more" onclick="userapp_open();" class="off">展開</a></p>
<?php } ?>

<?php if($_SCONFIG['my_status']) { ?>
<div class="app_m">
<ul>
<li><img src="image/app_add.gif"><a href="cp.php?ac=userapp&my_suffix=%2Fapp%2Flist" class="addApp">添加應用</a></li>
<li><img src="image/app_set.gif"><a href="cp.php?ac=userapp&op=menu" class="myApp">管理應用</a></li>
</ul>
</div>
<?php } ?>

<?php } else { ?>
<div class="bar_text">
<form id="loginform" name="loginform" action="do.php?ac=<?=$_SCONFIG['login_action']?>&ref" method="post">
<input type="hidden" name="formhash" value="<?php echo formhash(); ?>" />
<p class="title">登錄站點</p>
<p>用戶名</p>
<p><input type="text" name="username" id="username" class="t_input" size="15" value="" /></p>
<p>密碼</p>
<p><input type="password" name="password" id="password" class="t_input" size="15" value="" /></p>
<p><input type="checkbox" id="cookietime" name="cookietime" value="315360000" checked /><label for="cookietime">記住我</label></p>
<p>
<input type="submit" id="loginsubmit" name="loginsubmit" value="登錄" class="submit" />
<input type="button" name="regbutton" value="註冊" class="button" onclick="urlto('do.php?ac=<?=$_SCONFIG['register_action']?>');">
</p>
</form>
</div>
<?php } ?>
</div>

<div id="mainarea">

<?php if($_SGLOBAL['ad']['contenttop']) { ?><div id="ad_contenttop"><?php adshow('contenttop'); ?></div><?php } ?>
<?php } ?>

<?php } ?>

<h2 class="title"><img src="image/icon/profile.gif">個人設置</h2>
<div class="tabs_header">
<a href="cp.php?ac=advance" class="r_option">&raquo; 高級管理</a>
<ul class="tabs">
<li<?=$actives['profile']?>><a href="cp.php?ac=profile"><span>個人資料</span></a></li>
<li<?=$actives['avatar']?>><a href="cp.php?ac=avatar"><span>我的頭像</span></a></li>
<?php if($_SCONFIG['videophoto']) { ?>
<li<?=$actives['videophoto']?>><a href="cp.php?ac=videophoto"><span>視頻認證</span></a></li>
<?php } ?>
<li<?=$actives['credit']?>><a href="cp.php?ac=credit"><span>我的積分</span></a></li>
<?php if($_SCONFIG['allowdomain'] && $_SCONFIG['domainroot'] && checkperm('domainlength')) { ?>
<li<?=$actives['domain']?>><a href="cp.php?ac=domain"><span>我的域名</span></a></li>
<?php } ?>
<?php if($_SCONFIG['sendmailday']) { ?>
<li<?=$actives['sendmail']?>><a href="cp.php?ac=sendmail"><span>郵件提醒</span></a></li>
<?php } ?>
<li<?=$actives['privacy']?>><a href="cp.php?ac=privacy"><span>隱私篩選</span></a></li>
<li<?=$actives['theme']?>><a href="cp.php?ac=theme"><span>個性化設置</span></a></li>
</ul>
</div>

<div class="l_status c_form">
<a href="cp.php?ac=profile&op=base"<?=$cat_actives['base']?>>基本資料</a><span class="pipe">|</span>
<a href="cp.php?ac=profile&op=contact"<?=$cat_actives['contact']?>>聯繫方式</a><span class="pipe">|</span>
<a href="cp.php?ac=profile&op=edu"<?=$cat_actives['edu']?>>教育情況</a><span class="pipe">|</span>
<a href="cp.php?ac=profile&op=work"<?=$cat_actives['work']?>>工作情況</a><span class="pipe">|</span>
<a href="cp.php?ac=profile&op=info"<?=$cat_actives['info']?>>個人信息</a>
</div>

<?php $farr = array(0=>'全用戶','1'=>'僅好友','3'=>'僅自己'); ?>
<form method="post" action="<?=$theurl?>&ref" class="c_form">

<?php if($_GET['op'] == 'base') { ?>

<table cellspacing="0" cellpadding="0" class="formtable">
<tr>
<th style="width:10em;">您的登錄用戶名:</th>
<td>
<?php echo stripslashes($space['username']); ?> (<a href="cp.php?ac=password">修改登錄密碼</a>)
</td>
<td></td>
</tr>
<?php if(!$_SCONFIG['realname']) { ?>
<tr>
<th style="width:10em;">真實姓名:</th>
<td>
<input type="text" id="name" name="name" value="<?php echo stripslashes($space['name']); ?>" class="t_input" />
</td>
<td>&nbsp;</td>
</tr>
<?php } else { ?>
<tr>
<th style="width:10em;">真實姓名:</th>
<td>
<?php if($space['name'] && empty($_GET['namechange'])) { ?>
<span style="font-weight:bold;"><?php echo stripslashes($space['name']); ?></span>
<?php if($_SCONFIG['namechange']) { ?>[<a href="<?=$theurl?>&namechange=1">修改</a>]<?php } ?>
<?php if($space['namestatus']) { ?>[<font color="red">認證通過</font>]<?php } else { ?><br>等待驗證中，您目前將只能使用用戶名，並且一些操作可能會受到限制<?php } ?>
<input type="hidden" name="name" value="<?php echo stripslashes($space['name']); ?>" />
<?php } else { ?>
<?php if($rncredit && $_GET['namechange']) { ?><img src="image/credit.gif" align="absmiddle"> 本操作需要支付積分 <?=$rncredit?> 個，您現在的積分 <?=$space['credit']?> 個。<br><?php } ?>
<?php if(empty($_SCONFIG['namechange'])) { ?>您的真實姓名一經確認，將不再允許再次修改，請真實填寫。<br><?php } ?>
<?php if($_SCONFIG['namecheck']) { ?>您填寫/修改真實姓名後，需要等待我們認證後才能有效，在認證通過之前，您將只能使用用戶名，並且一些操作可能會受到限制。<br><?php } ?>
<input type="text" id="name" name="name" value="<?php echo stripslashes($space['name']); ?>" class="t_input" /> (請輸入2～5個漢字)
<?php } ?>
</td>
<td>&nbsp;</td>
</tr>
<?php } ?>
<tr>
<th style="width:10em;">性別:</th>
<td>
<?php if(empty($space['sex'])) { ?>
<label for="sexm"><input id="sexm" type="radio" value="1" name="sex"<?=$sexarr['1']?> />男</label> 
<label for="sexw"><input id="sexw" type="radio" value="2" name="sex"<?=$sexarr['2']?> />女</label>
<span style="font-weight:bold;color:red;">(性別選擇確定後，將不能再次修改)</span>
<?php } else { ?>
<?php if($space['sex']==1) { ?>男<?php } else { ?>女<?php } ?>
<?php } ?>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<th style="width:10em;">婚戀狀態:</th>
<td>
<select id="marry" name="marry">
<option value="0">&nbsp;</option>
<option value="1"<?=$marryarr['1']?>>單身</option>
<option value="2"<?=$marryarr['2']?>>非單身</option>
</select>
<a href="cp.php?ac=friend&op=search&view=sex" target="_blank">&raquo; 查找男女朋友</a>
</td>
<td>
<select name="friend[marry]">
<option value="0"<?=$friendarr['marry']['0']?>>全用戶可見</option>
<option value="1"<?=$friendarr['marry']['1']?>>僅好友可見</option>
<option value="3"<?=$friendarr['marry']['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<tr>
<th>生日:</th>
<td>
<select id="birthyear" name="birthyear" onchange="showbirthday();">
<option value="0">&nbsp;</option>
<?=$birthyeayhtml?>
</select> 年 
<select id="birthmonth" name="birthmonth" onchange="showbirthday();">
<option value="0">&nbsp;</option>
<?=$birthmonthhtml?>
</select> 月 
<select id="birthday" name="birthday">
<option value="0">&nbsp;</option>
<?=$birthdayhtml?>
</select> 日
<a href="cp.php?ac=friend&op=search&view=birthyear" target="_blank">&raquo; 查找同生日朋友</a>
</td>
<td>
<select name="friend[birth]">
<option value="0"<?=$friendarr['birth']['0']?>>全用戶可見</option>
<option value="1"<?=$friendarr['birth']['1']?>>僅好友可見</option>
<option value="3"<?=$friendarr['birth']['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<tr>
<th>血型:</th>
<td>
<select id="blood" name="blood">
<option value="">&nbsp;</option>
<?=$bloodhtml?>
</select>
</td>
<td>
<select name="friend[blood]">
<option value="0"<?=$friendarr['blood']['0']?>>全用戶可見</option>
<option value="1"<?=$friendarr['blood']['1']?>>僅好友可見</option>
<option value="3"<?=$friendarr['blood']['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<tr>
<th>家鄉:</th>
<td id="birthcitybox">
<script type="text/javascript" src="source/script_city.js"></script>
<script type="text/javascript">
<!--
showprovince('birthprovince', 'birthcity', '<?=$space['birthprovince']?>', 'birthcitybox');
showcity('birthcity', '<?=$space['birthcity']?>', 'birthprovince', 'birthcitybox');

//-->
</script>
<a href="cp.php?ac=friend&op=search&view=birth" target="_blank">&raquo; 查找老鄉</a>
</td>
<td>
<select name="friend[birthcity]">
<option value="0"<?=$friendarr['birthcity']['0']?>>全用戶可見</option>
<option value="1"<?=$friendarr['birthcity']['1']?>>僅好友可見</option>
<option value="3"<?=$friendarr['birthcity']['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<tr>
<th>居住地:</th>
<td id="residecitybox">
<script type="text/javascript">
<!--
showprovince('resideprovince', 'residecity', '<?=$space['resideprovince']?>', 'residecitybox');
showcity('residecity', '<?=$space['residecity']?>', 'resideprovince', 'residecitybox');
//-->
</script>
<a href="cp.php?ac=friend&op=search&view=reside" target="_blank">&raquo; 查找同城</a>
</td>
<td>
<select name="friend[residecity]">
<option value="0"<?=$friendarr['residecity']['0']?>>全用戶可見</option>
<option value="1"<?=$friendarr['residecity']['1']?>>僅好友可見</option>
<option value="3"<?=$friendarr['residecity']['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<?php if(is_array($profilefields)) { foreach($profilefields as $value) { ?>
<tr>
<th><?=$value['title']?><?php if($value['required']) { ?>*<?php } ?>:</th>
<td>
<?=$value['formhtml']?>
<?php if($value['note']) { ?> <span class="gray"><?=$value['note']?></span><?php } ?>
</td>
<td>
<select name="friend[field_<?=$value['fieldid']?>]">
<?php $field_friendarr = $friendarr["field_$value[fieldid]"]; ?>
<option value="0"<?=$field_friendarr['0']?>>全用戶可見</option>
<option value="1"<?=$field_friendarr['1']?>>僅好友可見</option>
<option value="3"<?=$field_friendarr['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<?php } } ?>

<tr>
<th style="width:10em;">&nbsp;</th>
<td>
<input type="submit" name="nextsubmit" value="繼續下一項" class="submit" />
<input type="submit" name="profilesubmit" value="保存" class="submit" />
</td>
<td>&nbsp;</td>
</tr>
</table>

<?php } elseif($_GET['op'] == 'contact') { ?>

<table cellspacing="0" cellpadding="0" class="formtable">

<?php if($_GET['editemail']) { ?>
</table>

<div class="borderbox">
<table cellspacing="0" cellpadding="0" class="formtable">
<tbody>
<tr>
<th style="width:10em;">本網站的登錄密碼:</th>
<td>
<input type="password" id="password" name="password" value="" class="t_input" />
<br>為了您的賬號安全，更換新郵箱的時候，需要輸入您在本網站的密碼。
</td>
<td></td>
</tr>
<tr>
<th style="width:10em;">新郵箱:</th>
<td>
<input type="text" id="email" class="t_input" name="email" value="<?=$space['email']?>" />
<?php if($space['emailcheck']) { ?>
<br>注意：新填寫的郵箱只有在驗證激活之後，才可以生效。
<?php } ?>
</td>
<td></td>
</tr>
</tbody>
</table>
</div><br>

<table cellspacing="0" cellpadding="0" class="formtable">
<?php } else { ?>
<?php if(!$space['email']) { ?>
<tr>
<th style="width:10em;">本網站的登錄密碼:</th>
<td>
<input type="password" id="password" name="password" value="" class="t_input" />
<br>為了您的賬號安全，填寫郵箱的時候，需要輸入您在本網站的密碼。
</td>
<td></td>
</tr>
<?php } ?>
<tr>
<th style="width:10em;">常用郵箱:</th>
<td>
<?php if($space['email']) { ?>
<?=$space['email']?><br>
<?php if($space['emailcheck']) { ?>
當前郵箱已經驗證激活 (<a href="<?=$theurl?>&editemail=1">更換</a>)
<?php } else { ?>
郵箱等待驗證中...<br>
系統已經向該郵箱發送了一封驗證激活郵件，請查收郵件，進行驗證激活。<br>
如果沒有收到驗證郵件，您可以<a href="<?=$theurl?>&editemail=1">更換一個郵箱</a>，或者<a href="<?=$theurl?>&resend=1">重新接收驗證郵件</a>
<?php } ?>
<?php } else { ?>
<input type="text" id="email" class="t_input" name="email" value="" />
<br>請準確填寫，取回密碼、獲取通知的時候都會發送到該郵箱。
<br>系統同時會向該郵箱發送一封驗證激活郵件，請注意查收。<br>
<?php } ?>
<?php if($space['newemail']) { ?>
<p>您要更換的新郵箱：<strong><?=$space['newemail']?></strong> 需要激活後才能替換當前郵箱並生效。<br>
如果沒有收到驗證郵件，您可以<a href="<?=$theurl?>&resend=1">重新接收驗證郵件</a></p>
<?php } ?>
</td>
<td></td>
</tr>
<?php } ?>
<tr>
<th style="width:10em;">手機:</th>
<td>
<input type="text" class="t_input" name="mobile" value="<?=$space['mobile']?>" /> 
</td>
<td>
<select name="friend[mobile]">
<option value="0"<?=$friendarr['mobile']['0']?>>全用戶可見</option>
<option value="1"<?=$friendarr['mobile']['1']?>>僅好友可見</option>
<option value="3"<?=$friendarr['mobile']['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<tr>
<th style="width:10em;">QQ:</th>
<td>
<input type="text" class="t_input" name="qq" value="<?=$space['qq']?>" /> 
</td>
<td>
<select name="friend[qq]">
<option value="0"<?=$friendarr['qq']['0']?>>全用戶可見</option>
<option value="1"<?=$friendarr['qq']['1']?>>僅好友可見</option>
<option value="3"<?=$friendarr['qq']['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<tr>
<th>MSN:</th>
<td>
<input type="text" class="t_input" name="msn" value="<?=$space['msn']?>" /> 
</td>
<td>
<select name="friend[msn]">
<option value="0"<?=$friendarr['msn']['0']?>>全用戶可見</option>
<option value="1"<?=$friendarr['msn']['1']?>>僅好友可見</option>
<option value="3"<?=$friendarr['msn']['3']?>>僅自己可見</option>
</select>
</td>
</tr>

<tr>
<th style="width:10em;">&nbsp;</th>
<td>
<input type="submit" name="nextsubmit" value="繼續下一項" class="submit" />
<input type="submit" name="profilesubmit" value="保存" class="submit" />
</td>
<td>&nbsp;</td>
</tr>
</table>

<?php } elseif($_GET['op'] == 'edu') { ?>

<?php if($list) { ?>
<table cellspacing="0" cellpadding="0" class="listtable">
<tr class="title">
<td>學校/班級或院系</td>
<td>入學年份</td>
<td>隱私設置</td>
<td>操作</td>
</tr>
<?php if(is_array($list)) { foreach($list as $key => $value) { ?>
<?php if($key%2==1) { ?><tr class="line"><?php } else { ?><tr><?php } ?>
<td><?=$value['title']?><br><?=$value['subtitle']?></td>
<td><?=$value['startyear']?></td>
<td><?=$farr[$value['friend']]?></td>
<td><a href="<?=$theurl?>&subop=delete&infoid=<?=$value['infoid']?>">刪除信息</a><br><a href="cp.php?ac=friend&op=search&searchmode=1&type=edu&title=<?=$value['title_s']?>" target="_blank">尋找同學</a></td>
</tr>
<?php } } ?>
</table>
<br>
<?php } ?>

<table cellspacing="0" cellpadding="0" class="formtable">
<?php if($list) { ?>
<caption>
<h2>添加新學校</h2>
</caption>
<?php } ?>
<tbody id="oldtbody">
<tr>
<th style="width:10em;">學校名稱:</th>
<td>
<input type="text" name="title[]" value="" class="t_input">
</td>
</tr>
<tr>
<th>班級或院系:</th>
<td>
<input type="text" name="subtitle[]" value="" class="t_input">
</td>
</tr>
<tr>
<th>入學年份:</th>
<td>
<select name="startyear[]">
<?=$yearhtml?>
</select> 年
</td>
</tr>
<tr>
<th>隱私設置:</th>
<td>
<select name="friend[]">
<option value="0">全用戶可見</option>
<option value="1">僅好友可見</option>
<option value="3">僅自己可見</option>
</select>
</td>
</tr>
</tbody>

<tbody id="newtbody"></tbody>

<tr>
<th style="width:10em;">&nbsp;</th>
<td><a href="javascript:;" onclick="add_tbody();">添加新的學校信息</a></td>
</tr>
<tr>
<th style="width:10em;">&nbsp;</th>
<td>
<input type="submit" name="nextsubmit" value="繼續下一項" class="submit" />
<input type="submit" name="profilesubmit" value="保存" class="submit" /></td>
</tr>
</table>

<?php } elseif($_GET['op'] == 'work') { ?>


<?php if($list) { ?>
<table cellspacing="0" cellpadding="0" class="listtable">
<tr class="title">
<td>公司或機構/部門</td>
<td>工作時間</td>
<td>隱私設置</td>
<td>操作</td>
</tr>
<?php if(is_array($list)) { foreach($list as $key => $value) { ?>
<?php if($key%2==1) { ?><tr class="line"><?php } else { ?><tr><?php } ?>
<td><?=$value['title']?><br><?=$value['subtitle']?></td>
<td>
<?=$value['startyear']?>年<?=$value['startmonth']?>月 ~ 
<?php if($value['endyear']) { ?><?=$value['endyear']?>年<?php } ?>
<?php if($value['endmonth']) { ?><?=$value['endmonth']?>月<?php } ?>
<?php if(!$value['endyear'] && !$value['endmonth']) { ?>現在<?php } ?>
</td>
<td><?=$farr[$value['friend']]?></td>
<td><a href="<?=$theurl?>&subop=delete&infoid=<?=$value['infoid']?>">刪除信息</a><br><a href="cp.php?ac=friend&op=search&searchmode=1&type=work&title=<?=$value['title_s']?>" target="_blank">尋找同事</a></td>
</tr>
<?php } } ?>
</table>
<br>
<?php } ?>

<table cellspacing="0" cellpadding="0" class="formtable">
<?php if($list) { ?>
<caption>
<h2>添加新公司或機構</h2>
</caption>
<?php } ?>
<tbody id="oldtbody">
<tr>
<th style="width:10em;">公司或機構:</th>
<td>
<input type="text" name="title[]" value="" class="t_input">
</td>
</tr>
<tr>
<th>部門:</th>
<td>
<input type="text" name="subtitle[]" value="" class="t_input">
</td>
</tr>
<tr>
<th>工作時間:</th>
<td>
<select name="startyear[]">
<?=$yearhtml?>
</select> 年
<select name="startmonth[]">
<?=$monthhtml?>
</select> 月 ~ 
<select name="endyear[]">
<option value="">現在</option>
<?=$yearhtml?>
</select> 年
<select name="endmonth[]">
<option value=""></option>
<?=$monthhtml?>
</select>月
</td>
</tr>
<tr>
<th>隱私設置:</th>
<td>
<select name="friend[]">
<option value="0">全用戶可見</option>
<option value="1">僅好友可見</option>
<option value="3">僅自己可見</option>
</select>
</td>
</tr>
</tbody>

<tbody id="newtbody"></tbody>

<tr>
<th style="width:10em;">&nbsp;</th>
<td><a href="javascript:;" onclick="add_tbody();">添加新的公司或機構</a></td>
</tr>
<tr>
<th style="width:10em;">&nbsp;</th>
<td>
<input type="submit" name="nextsubmit" value="繼續下一項" class="submit" />
<input type="submit" name="profilesubmit" value="保存" class="submit" /></td>
</tr>
</table>

<?php } elseif($_GET['op'] == 'info') { ?>

<table cellspacing="0" cellpadding="0" class="formtable">
<?php $infoarr = array(
	'trainwith' => '我想結交',
	'interest' => '興趣愛好',
	'book' => '喜歡的書籍',
	'movie' => '喜歡的電影',
	'tv' => '喜歡的電視',
	'music' => '喜歡的音樂',
	'game' => '喜歡的遊戲',
	'sport' => '喜歡的運動',
	'idol' => '偶像',
	'motto' => '座右銘',
	'wish' => '最近心願',
	'intro' => '我的簡介'
); ?>
<tr>
<th>欄目</th>
<td>內容</td>
<td>隱私設置</td>
</tr>

<?php if(is_array($infoarr)) { foreach($infoarr as $key => $value) { ?>
<tr>
<th><?=$value?>:</th>
<td>
<textarea name="info[<?=$key?>]" rows="3" cols="50"><?=$list[$key]['title']?></textarea>
</td>
<td>
<select name="info_friend[<?=$key?>]">
<option value="0"<?=$friends[$key]['0']?>>全用戶可見</option>
<option value="1"<?=$friends[$key]['1']?>>僅好友可見</option>
<option value="3"<?=$friends[$key]['3']?>>僅自己可見</option>
</select>
</td>
</tr>
<?php } } ?>

<tr>
<th style="width:10em;">&nbsp;</th>
<td><input type="submit" name="profilesubmit" value="保存" class="submit" /></td>
</tr>
</table>
<?php } ?>


<input type="hidden" name="formhash" value="<?php echo formhash(); ?>" />
</form>

<script>
function add_tbody() {
for(i=0; i<$("oldtbody").rows.length; i++) {
newnode = $("oldtbody").rows[i].cloneNode(true);
$("newtbody").appendChild(newnode);
}
}
</script>

<?php if(empty($_SGLOBAL['inajax'])) { ?>
<?php if(empty($_TPL['nosidebar'])) { ?>
<?php if($_SGLOBAL['ad']['contentbottom']) { ?><br style="line-height:0;clear:both;"/><div id="ad_contentbottom"><?php adshow('contentbottom'); ?></div><?php } ?>
</div>

<!--/mainarea-->
<div id="bottom"></div>
</div>
<!--/main-->
<?php } ?>

<div id="footer">
<?php if($_TPL['templates']) { ?>
<div class="chostlp" title="切換風格"><img id="chostlp" src="<?=$_TPL['default_template']['icon']?>" onmouseover="showMenu(this.id)" alt="<?=$_TPL['default_template']['name']?>" /></div>
<ul id="chostlp_menu" class="chostlp_drop" style="display: none">
<?php if(is_array($_TPL['templates'])) { foreach($_TPL['templates'] as $value) { ?>
<li><a href="cp.php?ac=common&op=changetpl&name=<?=$value['name']?>" title="<?=$value['name']?>"><img src="<?=$value['icon']?>" alt="<?=$value['name']?>" /></a></li>
<?php } } ?>
</ul>
<?php } ?>

<p class="r_option">
<a href="javascript:;" onclick="window.scrollTo(0,0);" id="a_top" title="TOP"><img src="image/top.gif" alt="" style="padding: 5px 6px 6px;" /></a>
</p>

<?php if($_SGLOBAL['ad']['footer']) { ?>
<p style="padding:5px 0 10px 0;"><?php adshow('footer'); ?></p>
<?php } ?>

<?php if($_SCONFIG['close']) { ?>
<p style="color:blue;font-weight:bold;">
提醒：當前站點處於關閉狀態
</p>
<?php } ?>
<p>
<?=$_SCONFIG['sitename']?> - 
<a href="mailto:<?=$_SCONFIG['adminemail']?>">聯繫我們</a>
<?php if($_SCONFIG['miibeian']) { ?> - <a  href="http://www.miibeian.gov.cn" target="_blank"><?=$_SCONFIG['miibeian']?></a><?php } ?>
</p>
<p>
Powered by <a  href="http://u.discuz.net" target="_blank"><strong>UCenter Home</strong></a> <span title="<?php echo X_RELEASE; ?>"><?php echo X_VER; ?></span>
<?php if(!empty($_SCONFIG['licensed'])) { ?><a  href="http://license.comsenz.com/?pid=7&host=<?=$_SERVER['HTTP_HOST']?>" target="_blank">Licensed</a><?php } ?>
&copy; 2001-2010 <a  href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a>
</p>
<?php if($_SCONFIG['debuginfo']) { ?>
<p><?php echo debuginfo(); ?></p>
<?php } ?>
</div>
</div>
<!--/wrap-->

<?php if($_SGLOBAL['appmenu']) { ?>
<ul id="ucappmenu_menu" class="dropmenu_drop" style="display:none;">
<li><a href="<?=$_SGLOBAL['appmenu']['url']?>" title="<?=$_SGLOBAL['appmenu']['name']?>" target="_blank"><?=$_SGLOBAL['appmenu']['name']?></a></li>
<?php if(is_array($_SGLOBAL['appmenus'])) { foreach($_SGLOBAL['appmenus'] as $value) { ?>
<li><a href="<?=$value['url']?>" title="<?=$value['name']?>" target="_blank"><?=$value['name']?></a></li>
<?php } } ?>
</ul>
<?php } ?>

<?php if($_SGLOBAL['supe_uid']) { ?>
<ul id="membernotemenu_menu" class="dropmenu_drop" style="display:none;">
<?php $member = $_SGLOBAL['member']; ?>
<?php if($member['notenum']) { ?><li><img src="image/icon/notice.gif" width="16" alt="" /> <a href="space.php?do=notice"><strong><?=$member['notenum']?></strong> 個新通知</a></li><?php } ?>
<?php if($member['pokenum']) { ?><li><img src="image/icon/poke.gif" alt="" /> <a href="cp.php?ac=poke"><strong><?=$member['pokenum']?></strong> 個新招呼</a></li><?php } ?>
<?php if($member['addfriendnum']) { ?><li><img src="image/icon/friend.gif" alt="" /> <a href="cp.php?ac=friend&op=request"><strong><?=$member['addfriendnum']?></strong> 個好友請求</a></li><?php } ?>
<?php if($member['mtaginvitenum']) { ?><li><img src="image/icon/mtag.gif" alt="" /> <a href="cp.php?ac=mtag&op=mtaginvite"><strong><?=$member['mtaginvitenum']?></strong> 個群組邀請</a></li><?php } ?>
<?php if($member['eventinvitenum']) { ?><li><img src="image/icon/event.gif" alt="" /> <a href="cp.php?ac=event&op=eventinvite"><strong><?=$member['eventinvitenum']?></strong> 個活動邀請</a></li><?php } ?>
<?php if($member['myinvitenum']) { ?><li><img src="image/icon/userapp.gif" alt="" /> <a href="space.php?do=notice&view=userapp"><strong><?=$member['myinvitenum']?></strong> 個應用消息</a></li><?php } ?>
</ul>
<?php } ?>

<?php if($_SGLOBAL['supe_uid']) { ?>
<?php if(!isset($_SCOOKIE['checkpm'])) { ?>
<script language="javascript"  type="text/javascript" src="cp.php?ac=pm&op=checknewpm&rand=<?=$_SGLOBAL['timestamp']?>"></script>
<?php } ?>
<?php if(!isset($_SCOOKIE['synfriend'])) { ?>
<script language="javascript"  type="text/javascript" src="cp.php?ac=friend&op=syn&rand=<?=$_SGLOBAL['timestamp']?>"></script>
<?php } ?>
<?php } ?>
<?php if(!isset($_SCOOKIE['sendmail'])) { ?>
<script language="javascript"  type="text/javascript" src="do.php?ac=sendmail&rand=<?=$_SGLOBAL['timestamp']?>"></script>
<?php } ?>

<?php if($_SGLOBAL['ad']['couplet']) { ?>
<script language="javascript" type="text/javascript" src="source/script_couplet.js"></script>
<div id="uch_couplet" style="z-index: 10; position: absolute; display:none">
<div id="couplet_left" style="position: absolute; left: 2px; top: 60px; overflow: hidden;">
<div style="position: relative; top: 25px; margin:0.5em;" onMouseOver="this.style.cursor='hand'" onClick="closeBanner('uch_couplet');"><img src="image/advclose.gif"></div>
<?php adshow('couplet'); ?>
</div>
<div id="couplet_rigth" style="position: absolute; right: 2px; top: 60px; overflow: hidden;">
<div style="position: relative; top: 25px; margin:0.5em;" onMouseOver="this.style.cursor='hand'" onClick="closeBanner('uch_couplet');"><img src="image/advclose.gif"></div>
<?php adshow('couplet'); ?>
</div>
<script type="text/javascript">
lsfloatdiv('uch_couplet', 0, 0, '', 0).floatIt();
</script>
</div>
<?php } ?>
<?php if($_SCOOKIE['reward_log']) { ?>
<script type="text/javascript">
showreward();
</script>
<?php } ?>
</body>
</html>
<?php } ?><?php ob_out();?>