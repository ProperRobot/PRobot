<?php if(!defined('IN_UCHOME')) exit('Access Denied');?><?php subtplcheck('template/default/space_blog_list|template/default/header|template/default/space_menu|template/default/footer', '1366034918', 'template/default/space_blog_list');?><?php $_TPL['titles'] = array('日誌'); ?>
<?php $friendsname = array(1 => '僅好友可見',2 => '指定好友可見',3 => '僅自己可見',4 => '憑密碼可見'); ?>

<?php if(empty($_SGLOBAL['inajax'])) { ?>
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


<?php if(!empty($_SGLOBAL['inajax'])) { ?>
<div id="space_blog" class="feed">
<h3 class="feed_header">
<a href="cp.php?ac=blog" class="r_option" target="_blank">發表日誌</a>
日誌(共 <?=$count?> 篇)
</h3>
<?php if($count) { ?>
<ul class="line_list">
<?php if(is_array($list)) { foreach($list as $value) { ?>
<li>
<span class="gray r_option"><?php echo sgmdate('m-d H:i',$value[dateline],1); ?></span>
<h4><a href="space.php?uid=<?=$space['uid']?>&do=blog&id=<?=$value['blogid']?>" target="_blank" <?php if($value['magiccolor']) { ?> class="magiccolor<?=$value['magiccolor']?>"<?php } ?>><?=$value['subject']?></a></h4>
<div class="detail">
<?=$value['message']?>
</div>
</li>
<?php } } ?>
</ul>
<?php if($pricount) { ?>
<div class="c_form">本頁有 <?=$pricount?> 篇日誌因作者的隱私設置而隱藏</div>
<?php } ?>
<div class="page"><?=$multi?></div>
<?php } else { ?>
<div class="c_form">還沒有相關的日誌。</div>
<?php } ?>
</div>
<?php } else { ?>

<?php if($space['self']) { ?>
<div class="searchbar floatright">
<form method="get" action="space.php">
<input name="searchkey" value="" size="15" class="t_input" type="text">
<input name="searchsubmit" value="搜索日誌" class="submit" type="submit">
<input type="hidden" name="searchmode" value="1" />
<input type="hidden" name="do" value="blog" />
<input type="hidden" name="view" value="all" />
<input type="hidden" name="orderby" value="dateline" />
</form>
</div>
<h2 class="title"><img src="image/app/blog.gif" />日誌</h2>
<div class="tabs_header">
<ul class="tabs">
<?php if($space['friendnum']) { ?><li<?=$actives['we']?>><a href="space.php?uid=<?=$space['uid']?>&do=<?=$do?>&view=we"><span>好友最新日誌</span></a></li><?php } ?>
<li<?=$actives['all']?>><a href="space.php?uid=<?=$space['uid']?>&do=<?=$do?>&view=all"><span>大家的日誌</span></a></li>
<li<?=$actives['me']?>><a href="space.php?uid=<?=$space['uid']?>&do=<?=$do?>&view=me"><span>我的日誌</span></a></li>
<li<?=$actives['click']?>><a href="space.php?uid=<?=$space['uid']?>&do=<?=$do?>&view=click"><span>我表態過的日誌</span></a></li>
<li class="null"><a href="cp.php?ac=blog">發表新日誌</a></li>
</ul>
</div>		
<?php } else { ?>
<?php $_TPL['spacetitle'] = "日誌";
	$_TPL['spacemenus'][] = "<a href=\"space.php?uid=$space[uid]&do=$do&view=me\">TA的所有日誌</a>"; ?>
<div class="c_header a_header">
<div class="avatar48"><a href="space.php?uid=<?=$space['uid']?>"><?php echo avatar($space[uid],small); ?></a></div>
<?php if($_SGLOBAL['refer']) { ?>
<a class="r_option" href="<?=$_SGLOBAL['refer']?>">&laquo; 返回上一頁</a>
<?php } ?>
<p style="font-size:14px"><?=$_SN[$space['uid']]?>的<?=$_TPL['spacetitle']?></p>
<a href="space.php?uid=<?=$space['uid']?>" class="spacelink"><?=$_SN[$space['uid']]?>的主頁</a>
<?php if($_TPL['spacemenus']) { ?>
<?php if(is_array($_TPL['spacemenus'])) { foreach($_TPL['spacemenus'] as $value) { ?> <span class="pipe">&raquo;</span> <?=$value?><?php } } ?>
<?php } ?>
</div>

<div class="h_status">按照發佈時間排序</div>
<?php } ?>

<div id="content" style="width:640px;">
<?php if($_GET['orderby'] && $_GET['orderby'] != 'dateline') { ?>
<div class="h_status">
排行時間範圍：
<a href="space.php?do=blog&view=all&orderby=<?=$_GET['orderby']?>"<?=$day_actives['0']?>>全部</a><span class="pipe">|</span>
<a href="space.php?do=blog&view=all&orderby=<?=$_GET['orderby']?>&day=1"<?=$day_actives['1']?>>最近一天</a><span class="pipe">|</span>
<a href="space.php?do=blog&view=all&orderby=<?=$_GET['orderby']?>&day=2"<?=$day_actives['2']?>>最近兩天</a><span class="pipe">|</span>
<a href="space.php?do=blog&view=all&orderby=<?=$_GET['orderby']?>&day=7"<?=$day_actives['7']?>>最近七天</a><span class="pipe">|</span>
<a href="space.php?do=blog&view=all&orderby=<?=$_GET['orderby']?>&day=30"<?=$day_actives['30']?>>最近三十天</a><span class="pipe">|</span>
<a href="space.php?do=blog&view=all&orderby=<?=$_GET['orderby']?>&day=90"<?=$day_actives['90']?>>最近三個月</a><span class="pipe">|</span>
<a href="space.php?do=blog&view=all&orderby=<?=$_GET['orderby']?>&day=120"<?=$day_actives['120']?>>最近六個月</a>
</div>
<?php } ?>

<?php if($searchkey) { ?>
<div class="h_status">以下是搜索日誌 <span style="color:red;font-weight:bold;"><?=$searchkey?></span> 結果列表</div>
<?php } ?>

<?php if($count) { ?>
<div class="entry_list">
<ul>
<?php if(is_array($list)) { foreach($list as $value) { ?>
<li>
<div class="avatardiv">
<div class="avatar48"><a href="space.php?uid=<?=$value['uid']?>"><?php echo avatar($value[uid],small); ?></a></div>
<?php if($value['hot']) { ?><div class="digb"><?=$value['hot']?></div><?php } ?>
</div>

<div class="title">
<a href="cp.php?ac=share&type=blog&id=<?=$value['blogid']?>" id="a_share_<?=$value['blogid']?>" onclick="ajaxmenu(event, this.id, 1)" class="a_share">分享</a>
<h4><a href="space.php?uid=<?=$value['uid']?>&do=<?=$do?>&id=<?=$value['blogid']?>" <?php if($value['magiccolor']) { ?> class="magiccolor<?=$value['magiccolor']?>"<?php } ?>><?=$value['subject']?></a></h4>
<div>
<?php if($value['friend']) { ?>
<span class="r_option locked gray"><a href="<?=$theurl?>&friend=<?=$value['friend']?>" class="gray"><?=$friendsname[$value['friend']]?></a></span>
<?php } ?>
<a href="space.php?uid=<?=$value['uid']?>"><?=$_SN[$value['uid']]?></a> <span class="gray"><?php echo sgmdate('Y-m-d H:i',$value[dateline],1); ?></span>
</div>
</div>
<div class="detail image_right l_text s_clear" id="blog_article_<?=$value['blogid']?>">
<?php if($value['pic']) { ?><p class="image"><a href="space.php?uid=<?=$value['uid']?>&do=blog&id=<?=$value['blogid']?>"><img src="<?=$value['pic']?>" alt="<?=$value['subject']?>" /></a></p><?php } ?>
<?=$value['message']?>
</div>
<div class="gray">
<?php if($classarr[$value['classid']]) { ?>分類: <a href="space.php?uid=<?=$value['uid']?>&do=blog&classid=<?=$value['classid']?>"><?=$classarr[$value['classid']]?></a><span class="pipe">|</span><?php } ?>
<?php if($value['viewnum']) { ?><a href="space.php?uid=<?=$value['uid']?>&do=<?=$do?>&id=<?=$value['blogid']?>"><?=$value['viewnum']?> 次閱讀</a><span class="pipe">|</span><?php } ?>
<?php if($value['replynum']) { ?><a href="space.php?uid=<?=$value['uid']?>&do=<?=$do?>&id=<?=$value['blogid']?>#comment"><?=$value['replynum']?> 個評論</a><?php } else { ?>沒有評論<?php } ?>
</div>
</li>
<?php } } ?>
<?php if($pricount) { ?>
<li>
<div class="title">本頁有 <?=$pricount?> 篇日誌因作者的隱私設置而隱藏</div>
</li>
<?php } ?>
</ul>
</div>

<div class="page"><?=$multi?></div>

<?php } else { ?>
<div class="c_form">還沒有相關的日誌。</div>
<?php } ?>

</div>

<div id="sidebar" style="width:150px;">

<?php if($userlist) { ?>
<div class="cat">
<h3>按好友查看</h3>
<ul class="post_list line_list">
<li>
選擇好友:<br>
<select name="fuidsel" onchange="fuidgoto(this.value);">
<option value="">全部好友</option>
<?php if(is_array($userlist)) { foreach($userlist as $value) { ?>
<option value="<?=$value['fuid']?>"<?=$fuid_actives[$value['fuid']]?>><?=$_SN[$value['fuid']]?></option>
<?php } } ?>
</select>
</li>
</ul>
</div>
<?php } ?>

<?php if($classarr) { ?>
<div class="cat">
<h3>日誌分類</h3>
<ul class="post_list line_list">
<li<?php if(!$_GET['classid']) { ?> class="current"<?php } ?>><a href="space.php?uid=<?=$space['uid']?>&do=blog&view=me">全部日誌</a></li>
<?php if(is_array($classarr)) { foreach($classarr as $classid => $classname) { ?>
<li<?php if($_GET['classid']==$classid) { ?> class="current"<?php } ?>>
<?php if($space['self']) { ?>
<a href="cp.php?ac=class&op=edit&classid=<?=$classid?>" id="c_edit_<?=$classid?>" onclick="ajaxmenu(event, this.id)" class="c_edit">編輯</a>
<a href="cp.php?ac=class&op=delete&classid=<?=$classid?>" id="c_delete_<?=$classid?>" onclick="ajaxmenu(event, this.id)" class="c_delete">刪除</a>
<?php } ?>
<a href="space.php?uid=<?=$space['uid']?>&do=blog&classid=<?=$classid?>&view=me"><?=$classname?></a>
</li>
<?php } } ?>
</ul>
</div>
<?php } ?>

<?php if($_GET['view'] == 'click') { ?>
<div class="cat">
<h3>表態動作</h3>
<ul class="post_list line_list">
<li<?=$click_actives['all']?>><a href="space.php?do=blog&view=click">全部動作</a></li>
<?php if(is_array($clicks)) { foreach($clicks as $value) { ?>
<li<?=$click_actives[$value['clickid']]?>>
<a href="space.php?do=blog&view=click&clickid=<?=$value['clickid']?>"><?=$value['name']?></a>
</li>
<?php } } ?>
</ul>
</div>
<?php } elseif($_GET['view'] == 'all') { ?>
<div class="cat">
<h3>排行榜</h3>
<ul class="post_list line_list">
<li<?=$all_actives['all']?>><a href="space.php?do=blog&view=all">推薦閱讀</a></li>
<li<?=$all_actives['dateline']?>><a href="space.php?do=blog&view=all&orderby=dateline">最新發表</a></li>
<li<?=$all_actives['hot']?>><a href="space.php?do=blog&view=all&orderby=hot&day=<?=$_GET['hotday']?>">人氣排行</a></li>
<li<?=$all_actives['replynum']?>><a href="space.php?do=blog&view=all&orderby=replynum&day=<?=$_GET['hotday']?>">評論排行</a></li>
<li<?=$all_actives['viewnum']?>><a href="space.php?do=blog&view=all&orderby=viewnum&day=<?=$_GET['hotday']?>">查看排行</a></li>
<?php if(is_array($clicks)) { foreach($clicks as $value) { ?>
<li<?=$all_actives['click_'.$value['clickid']]?>><a href="space.php?do=blog&view=all&orderby=click_<?=$value['clickid']?>&day=<?=$_GET['hotday']?>"><?=$value['name']?>排行</a></li>
<?php } } ?>
</ul>

</div>
<?php } ?>

</div>

<script>
function fuidgoto(fuid) {
window.location.href = "space.php?do=blog&view=we&fuid="+fuid;
}
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