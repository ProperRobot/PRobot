<?php if(!defined('IN_UCHOME')) exit('Access Denied');?><?php subtplcheck('template/default/cp_magic|template/default/header|template/default/footer', '1366034909', 'template/default/cp_magic');?><?php if(empty($_SGLOBAL['inajax'])) { ?>
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


<?php if($op == "buy") { ?>

<h1>購買道具</h1>
<a class="float_del" title="關閉" href="javascript:hideMenu();">關閉</a>
<div class="toolly" id="__magicbuy_<?=$mid?>">
<?php if($ac=='magic') { ?>	
<form id="magicbuy_<?=$mid?>" action="cp.php?ac=magic&mid=<?=$mid?>&op=buy" method="post">
<?php } else { ?>		
<form id="magicbuy_<?=$mid?>" action="magic.php?mid=<?=$mid?>&op=buy&idtype=<?=$idtype?>&id=<?=$id?><?=$extra?>" method="post">
<?php } ?>
<div class="magic_img">
<img src="image/magic/<?=$mid?>.gif" alt="<?=$magic['name']?>" />
</div>
<div class="magic_info">
<h3><?=$magic['name']?></h3>
<p class="gray"><?=$magic['description']?></p>
<?php if($magic['experience']) { ?>
<p>增加經驗: <span><?=$magic['experience']?></span></p>
<?php } ?>
<p>
道具單價: <span><?=$magic['charge']?></span> 積分
<?php if($discount > 0) { ?>
（享受 <?=$discount?> 折優惠 <span><?=$charge?></span> 積分 ）
<?php } elseif($discount < 0) { ?>
（享受 <span>免費</span> 折扣 ）
<?php } ?>				
</p>
<p>現有庫存: <span><?=$magicstore['storage']?></span> 個</p>
<p>購買數量: <input class="t_input" type="text" name="buynum" value="1" style="width:40px;" /> 個（當前最多可購買 <?=$magicstore['maxbuy']?> 個）</p>
<?php if($coupon['count']) { ?>
<p>用代金券: <input class="t_input" type="text" name="coupon" value="0" style="width:40px;" /> 張（每張抵用 100 積分，擁有 <?=$coupon['count']?> 張）</p>
<?php } ?>
<p class="btn_line">
<input type="hidden" name="formhash" value="<?php echo formhash() ?>" />
<input type="hidden" name="refer" value="<?=$_SGLOBAL['refer']?>"/>
<input type="hidden" name="buysubmit" value="1" />
<?php if($_SGLOBAL['inajax']) { ?>
<?php if($ac=='magic') { ?>
<input type="button" class="submit" id="buysubmit_btn" value="購買" onclick="ajaxpost('magicbuy_<?=$mid?>', 'magicBought', 2000)" />
<?php } else { ?>
<input type="button" class="submit" id="buysubmit_btn" value="購買" onclick="ajaxpost('magicbuy_<?=$mid?>')" />
<?php } ?>
<?php } else { ?>
<input type="submit" class="submit" id="buysubmit_btn" value="購買">
<?php } ?>
</p>
</div>
</form>
</div>

<?php } elseif($op == "present") { ?>

<h1>贈送道具</h1>
<a class="float_del" title="關閉" href="javascript:hideMenu();">關閉</a>
<div class="popupmenu_inner" id="__magicpresent_<?=$mid?>">
<form id="magicpresent_<?=$mid?>" action="cp.php?ac=magic&mid=<?=$mid?>" method="post">
<p>
要贈送的道具：<?=$magic['name']?>
</p>
<p>
好友的用戶名：
<input type="text" name="fusername" />
</p>
<p class="btn_line">
<input type="hidden" name="formhash" value="<?php echo formhash() ?>" />
<input type="hidden" name="refer" value="<?=$_SGLOBAL['refer']?>"/>
<input type="hidden" name="presentsubmit" value="1" />
<?php if($_SGLOBAL['inajax']) { ?>
<input type="button" class="submit" name="presentsubmit_btn" value="贈送" onclick="ajaxpost('magicpresent_<?=$mid?>', 'magicPresent', 2000)" />
<?php } else { ?>
<input type="submit" class="submit" name="presentsubmit_btn" value="贈送">
<?php } ?>
</p>
</form>
</div>
<?php } elseif($op == "showusage") { ?>

<h1>道具使用示例圖</h1>
<a class="float_del" title="關閉" href="javascript:hideMenu();">關閉</a>
<div class="popupmenu_inner">
<img src="image/magic/usage/<?=$mid?>.gif" />		
</div>

<?php } elseif($op == 'appear') { ?>

<h1>恢復在線狀態</h1>
<a class="float_del" title="關閉" href="javascript:hideMenu();">關閉</a>
<div class="popupmenu_inner" id="__appearform">
<form action="cp.php?ac=magic&op=<?=$op?>" method="post" id="appearform">
<p>
您確定要取消隱身效果，恢復在線狀態嗎？
</p>
<p class="btn_line">
<input type="hidden" name="formhash" value="<?php echo formhash() ?>" />
<input type="hidden" name="refer" value="<?=$_SGLOBAL['refer']?>"/>
<input type="hidden" name="appearsubmit" value="1" />
<input type="submit" class="submit" value="確定" />
</p>
</form>
</div>

<?php } elseif($op == 'retrieve') { ?>

<h1>回收紅包</h1>
<a class="float_del" title="關閉" href="javascript:hideMenu();">關閉</a>
<div class="popupmenu_inner" id="__retrieveform">
<form action="cp.php?ac=magic&op=<?=$op?>" method="post" id="retrieveform">
<p>
紅包當前剩餘積分 <?=$leftcredit?> ，您確定要回收嗎？
</p>
<p class="btn_line">
<input type="hidden" name="formhash" value="<?php echo formhash() ?>" />
<input type="hidden" name="refer" value="<?=$_SGLOBAL['refer']?>"/>
<input type="hidden" name="retrievesubmit" value="1" />
<input type="submit" class="submit" value="確定" />
</p>
</form>
</div>

<?php } elseif(in_array($op, array('cancelsuperstar', 'cancelflicker', 'cancelcolor', 'cancelframe', 'cancelbgimage'))) { ?>

<h1>取消道具效果</h1>
<a class="float_del" title="關閉" href="javascript:hideMenu();">關閉</a>
<div class="popupmenu_inner" id="__cancelform">
<form action="cp.php?ac=magic&op=<?=$op?>&id=<?=$_GET['id']?>&idtype=<?=$_GET['idtype']?>" method="post" id="cancelform">
<p>
您確定要取消道具 <?=$_SGLOBAL['magic'][$mid]?> 的效果嗎？
</p>
<p class="btn_line">
<input type="hidden" name="formhash" value="<?php echo formhash() ?>" />
<input type="hidden" name="refer" value="<?=$_SGLOBAL['refer']?>"/>
<input type="hidden" name="cancelsubmit" value="1" />
<input type="submit" class="submit" value="確定" />
</p>
</form>
</div>

<?php } else { ?>

<h2 class="title"><img src="image/icon/magic.gif">道具中心</h2>
<div class="tabs_header">
<ul class="tabs">
<li<?=$actives['store']?>><a href="cp.php?ac=magic&view=store"><span>道具商店</span></a></li>
<li<?=$actives['me']?>><a href="cp.php?ac=magic&view=me"><span>我的道具</span></a></li>
<li<?=$actives['log']?>><a href="cp.php?ac=magic&view=log"><span>道具記錄</span></a></li>
</ul>
</div>

<div style="float:none;">

<?php if($_GET['view'] == "me") { ?>

<?php if($mid) { ?>
<p class="notice">
當前只顯示與你操作相關的單個道具，
<a href="cp.php?ac=magic&view=<?=$_GET['view']?>">點擊此處查看全部道具</a>
</p>
<p>&nbsp;</p>
<?php } ?>

<?php if($list) { ?>
<ul id="magiclist" class="magic_list">
<?php if(is_array($list)) { foreach($list as $key=>$value) { ?>
<li id="magic_<?=$key?>">
<div class="magic_img">
<img src="image/magic/<?=$key?>.gif" alt="<?=$magics[$key]['name']?>" />
</div>
<div class="magic_info">
<h3><?=$magics[$key]['name']?></h3>
<p class="gray">
<?=$magics[$key]['description']?>
</p>
<p>
<a id="a_present_<?=$key?>" href="cp.php?ac=magic&op=present&mid=<?=$key?>" onclick="ajaxmenu(event, this.id, 1)" class="m_button<?php if($key=='license') { ?> m_off<?php } ?>">贈送</a>
擁有 <span id="magiccount_<?=$key?>"><?=$value['count']?></span> 個
</p>
</div>
</li>
<?php } } ?>
</ul>
<?php } else { ?>
<p>您還沒有購買任何道具，<a href="cp.php?ac=magic&view=store">去道具商店看看</a></p>
<?php } ?>
<?php } elseif($_GET['view'] == 'log') { ?>

<div class="h_status">
查看：
<a <?=$types['in']?> href="cp.php?ac=magic&view=<?=$_GET['view']?>&type=in">獲得記錄</a>
<span class="pipe">|</span>
<a <?=$types['present']?> href="cp.php?ac=magic&view=<?=$_GET['view']?>&type=present">贈送記錄</a>
<span class="pipe">|</span>
<a <?=$types['out']?> href="cp.php?ac=magic&view=<?=$_GET['view']?>&type=out">使用記錄</a>
</div>

<?php if($_GET['type'] == 'in') { ?>
<?php if($list) { ?>
<ul class="line_list">
<?php if(is_array($list)) { foreach($list as $value) { ?>
<li>

<?php if($value['type'] == '3') { ?>
升級獲得
<?php } elseif($value['type'] == '2') { ?>
獲得了
<?php if($value['fromid']) { ?>
<a href="space.php?uid=<?=$value['fromid']?>" target="_blank"><?=$_SN[$value['fromid']]?></a>
<?php } else { ?>
管理員
<?php } ?>
贈送的
<?php } else { ?>
購買了
<?php } ?>
<a href="cp.php?ac=magic&view=store&mid=<?=$value['mid']?>" target="_blank">
<?=$_SGLOBAL['magic'][$value['mid']]?>
</a>
<?=$value['count']?>
個
<span class="gray">(<?php echo sgmdate('m-d H:i', $value[dateline], true) ?>)</span>
</li>
<?php } } ?>
</ul>
<div class="page"><?=$multi?></div>
<?php } else { ?>
<p>您近期沒有道具收入記錄</p>
<?php } ?>
<?php } elseif($_GET['type'] == 'present') { ?>
<?php if($list) { ?>
<ul class="line_list">
<?php if(is_array($list)) { foreach($list as $value) { ?>
<li>
向
<a href="space.php?uid=<?=$value['uid']?>"><?=$_SN[$value['uid']]?></a>
贈送了
<a href="cp.php?ac=magic&view=store&mid=<?=$value['mid']?>" target="_blank">
<?=$_SGLOBAL['magic'][$value['mid']]?>
</a>
<span class="gray">(<?php echo sgmdate('m-d H:i', $value[dateline], true) ?>)</span>
</li>
<?php } } ?>
</ul>
<div class="page"><?=$multi?></div>
<?php } else { ?>
<p>您近期沒有向他人贈送道具的記錄</p>
<?php } ?>		
<?php } else { ?>
<?php if($list) { ?>
<ul class="line_list">
<?php if(is_array($list)) { foreach($list as $value) { ?>
<li>
使用了
<a href="cp.php?ac=magic&view=store&mid=<?=$value['mid']?>" target="_blank">
<?=$_SGLOBAL['magic'][$value['mid']]?>
</a>
<?=$value['count']?> 次
<?php if($value['mid'] == 'invisible') { ?>
; &nbsp;失效時間：<?php echo sgmdate('m-d H:i', $value[expire]) ?>
<?php } elseif($value['mid'] == 'gift') { ?>
; &nbsp;剩餘積分數：<?=$value['data']['left']?>
<?php } elseif($value['mid'] == 'superstar') { ?>
; &nbsp;失效時間：<?php echo sgmdate('m-d H:i', $value[expire]) ?>
<?php } ?>
<span class="gray">(<?php echo sgmdate('m-d H:i', $value[dateline], true) ?>)</span>
</li>
<?php } } ?>
</ul>
<div class="page"><?=$multi?></div>
<?php } else { ?>
<p>您近期沒有道具使用記錄</p>
<?php } ?>
<?php } ?>

<?php } else { ?>
<div class="h_status">
排序：
<a <?=$orders['default']?> href="cp.php?ac=magic&view=<?=$view?>&order=defalut">默認</a>
<span class="pipe">|</span>
<a <?=$orders['hot']?> href="cp.php?ac=magic&view=<?=$view?>&order=hot">熱門</a>
</div>

<?php if($mid) { ?>
<p class="notice">
當前只顯示與你操作相關的單個道具，
<a href="cp.php?ac=magic&view=<?=$_GET['view']?>">點擊此處查看全部道具</a>
</p>
<p>&nbsp;</p>
<?php } ?>

<ul id="magiclist" class="magic_list">
<?php if(is_array($list)) { foreach($list as $key=>$value) { ?>
<li id="magic_<?=$key?>">
<div class="magic_img">
<a id="a_i_buy_<?=$key?>" href="cp.php?ac=magic&op=buy&mid=<?=$key?>" onclick="ajaxmenu(event, this.id, 1)">
<img src="image/magic/<?=$key?>.gif" alt="<?=$magics[$key]['name']?>" />
</a>
</div>
<div class="magic_info">
<h3>
<?=$magics[$key]['name']?>
<?php if($_GET['order'] == 'hot') { ?>
<small class="gray" style="margin-left:10px;">已售出 <?=$value['sellcount']?> 件</small>
<?php } ?>
</h3>
<p class="gray"><?=$magics[$key]['description']?></p>
<p>
<?php if(in_array($space['groupid'], $magics[$key]['forbiddengid']) || in_array($mid, $blacklist)) { ?>
<a id="a_buy_<?=$key?>" href="cp.php?ac=magic&op=buy&mid=<?=$key?>" onclick="ajaxmenu(event, this.id, 1)" class="m_button m_off">不能購買</a><span><?=$magics[$key]['charge']?></span> 積分/個
<?php } else { ?>
<a id="a_buy_<?=$key?>" href="cp.php?ac=magic&op=buy&mid=<?=$key?>" onclick="ajaxmenu(event, this.id, 1)" class="m_button">購買</a><span><?=$magics[$key]['charge']?></span> 積分/個
<?php } ?>
</p>
</div>
</li>
<?php } } ?>
</ul>
<?php } ?>

</div><!--//<div id="content" style="float:none;width:690px;">//-->
<script type="text/javascript">
<!--
function magicBought(id, result) {
var ids = explode('_', id);
var mid = ids[1];
if($('a_buy_'+mid)) {
$('a_buy_'+mid).innerHTML = '繼續購買';
}
}
function magicPresent(id, result) {
var ids = explode('_', id);
var mid = ids[1];
if($('a_present_'+mid)) {
$('a_present_'+mid).innerHTML = '繼續贈送';
}
if($('magiccount_'+mid)) {
$('magiccount_'+mid).innerHTML = parseInt($('magiccount_'+mid).innerHTML) - 1;
}
}
-->
</script>

<?php } ?>

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