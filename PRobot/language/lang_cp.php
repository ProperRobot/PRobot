<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: lang_cp.php 13194 2009-08-18 07:44:40Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$_SGLOBAL['cplang'] = array(

	'by' => '通過',
	'tab_space' => ' ',
	'feed_comment_space' => '{actor} 在 {touser} 的留言板留了言',
	'feed_comment_image' => '{actor} 評論了 {touser} 的圖片',
	'feed_comment_blog' => '{actor} 評論了 {touser} 的日誌 {blog}',
	'feed_comment_poll' => '{actor} 評論了 {touser} 的投票 {poll}',
	'feed_comment_event' => '{actor} 在 {touser} 組織的活動 {event} 中留言了',
	'feed_comment_share' => '{actor} 對 {touser} 分享的 {share} 發表了評論',
	'share' => '分享',
	'share_action' => '分享了',
	'note_wall' => '在留言板上給你<a href="\\1" target="_blank">留言</a>',
	'note_wall_reply' => '回復了你的<a href="\\1" target="_blank">留言</a>',
	'note_pic_comment' => '評論了你的<a href="\\1" target="_blank">圖片</a>',
	'note_pic_comment_reply' => '回復了你的<a href="\\1" target="_blank">圖片評論</a>',
	'note_blog_comment' => '評論了你的日誌 <a href="\\1" target="_blank">\\2</a>',
	'note_blog_comment_reply' => '回復了你的<a href="\\1" target="_blank">日誌評論</a>',
	'note_poll_comment' => '評論了你的投票 <a href="\\1" target="_blank">\\2</a>',
	'note_poll_comment_reply' => '回復了你的<a href="\\1" target="_blank">投票評論</a>',
	'note_share_comment' => '評論了你的 <a href="\\1" target="_blank">分享</a>',
	'note_share_comment_reply' => '回復了你的<a href="\\1" target="_blank">分享評論</a>',
	'note_event_comment' => '在你組織的活動裡<a href="\\1" target="_blank">留言</a>了',
	'note_event_comment_reply' => '回復了你在活動中的<a href="\\1" target="_blank">留言</a>',
	'note_show_out' => '訪問了你的主頁後，你在競價排名榜中最後一個積分也被消費掉了',
	'note_space_bar' => '把你設置為站點推薦用戶了',

	'note_click_blog' => '對你的日誌 <a href="\\1" target="_blank">\\2</a> 做了表態',
	'note_click_thread' => '對你的話題 <a href="\\1" target="_blank">\\2</a> 做了表態',
	'note_click_pic' => '對你的 <a href="\\1" target="_blank">圖片</a> 做了表態',

	'wall_pm_subject' => '您好，我給您留言了',
	'wall_pm_message' => '我在您的留言板給你留言了，[url=\\1]點擊這裡去留言板看看吧[/url]',
	'note_showcredit' => '贈送給您 \\1 個競價積分，幫助提升在<a href="space.php?do=top" target="_blank">競價排行榜</a>中的名次',
	'feed_showcredit' => '{actor} 贈送給 {fusername} 競價積分 {credit} 個，幫助好友提升在<a href="space.php?do=top" target="_blank">競價排行榜</a>中的名次',
	'feed_showcredit_self' => '{actor} 增加競價積分 {credit} 個，提升自己在<a href="space.php?do=top" target="_blank">競價排行榜</a>中的名次',
	'feed_doing_title' => '{actor}：{message}',
	'note_doing_reply' => '在<a href="\\1" target="_blank">記錄</a>中對你進行了回復',
	'feed_friend_title' => '{actor} 和 {touser} 成為了好友',
	'note_friend_add' => '和你成為了好友',
	'note_poll_invite' => '邀請你一起參與 <a href="\\1" target="_blank">《\\2》</a>的\\3投票',
	'reward' => '懸賞',
	'reward_info' => '參與投票可獲得  \\1 積分',
	'poll_separator' => '"、"',

	'feed_upload_pic' => '{actor} 上傳了新圖片',

	'feed_click_blog' => '{actor} 送了一個「{click}」給 {touser} 的日誌 {subject}',
	'feed_click_thread' => '{actor} 送了一個「{click}」給 {touser} 的話題 {subject}',
	'feed_click_pic' => '{actor} 送了一個「{click}」給 {touser} 的圖片',

	'friend_subject' => '<a href="\\2" target="_blank">\\1 請求加你為好友</a>',
	'comment_friend' =>'<a href="\\2" target="_blank">\\1 給你留言了</a>',
	'photo_comment' => '<a href="\\2" target="_blank">\\1 評論了你的照片</a>',
	'blog_comment' => '<a href="\\2" target="_blank">\\1 評論了你的日誌</a>',
	'poll_comment' => '<a href="\\2" target="_blank">\\1 評論了你的投票</a>',
	'share_comment' => '<a href="\\2" target="_blank">\\1 評論了你的分享</a>',
	'friend_pm' => '<a href="\\2" target="_blank">\\1 給你發私信了</a>',
	'poke_subject' => '<a href="\\2" target="_blank">\\1 向你打招呼</a>',
	'mtag_reply' => '<a href="\\2" target="_blank">\\1 回復了你的話題</a>',
	'event_comment' => '<a href="\\2" target="_blank">\\1 評論了你的活動</a>',

	'friend_pm_reply' => '\\1 回復了你的私信',
	'comment_friend_reply' => '\\1 回復了你的留言',
	'blog_comment_reply' => '\\1 回復了你的日誌評論',
	'photo_comment_reply' => '\\1 回復了你的照片評論',
	'poll_comment_reply' => '\\1 回復了你的投票評論',
	'share_comment_reply' => '\\1 回復了你的分享評論',
	'event_comment_reply' => '\\1 回復了你的活動評論',

	'invite_subject' => '\\1邀請您加入\\2，並成為TA的好友',
	'invite_massage' => '<table border="0">
		<tr>
		<td valign="top">\\1</td>
		<td valign="top">
		<h3>Hi，我是\\2，在\\3上建立了個人主頁，邀請您也加入並成為我的好友</h3><br>
		請加入到我的好友中，你就可以通過我的個人主頁瞭解我的近況，分享我的照片，隨時與我保持聯繫<br>
		<br>
		邀請附言：<br>
		\\4
		<br><br>
		<strong>請你點擊以下鏈接，接受好友邀請：</strong><br>
		<a href="\\5">\\5</a><br>
		<br>
		<strong>如果你擁有\\3上面的賬號，請點擊以下鏈接查看我的個人主頁：</strong><br>
		<a href="\\6">\\6</a><br>
		</td></tr></table>',

	'app_invite_subject' => '\\1邀請您加入\\2，一起來玩\\3',
	'app_invite_massage' => '<table border="0">
		<tr>
		<td valign="top">\\1</td>
		<td valign="top">
		<h3>Hi，我是\\2，在\\3上玩 \\7，邀請您也加入一起玩</h3><br>
		<br>
		邀請附言：<br>
		\\4
		<br><br>
		<strong>請你點擊以下鏈接，接受好友邀請一起玩\\7：</strong><br>
		<a href="\\5">\\5</a><br>
		<br>
		<strong>如果你擁有\\3上面的賬號，請點擊以下鏈接查看我的個人主頁：</strong><br>
		<a href="\\6">\\6</a><br>
		</td></tr></table>',

	'feed_mtag_add' => '{actor} 創建了新群組 {mtags}',
	'note_members_grade_-9' => '將你從群組 <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a> 請出',
	'note_members_grade_-2' => '將你在群組 <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a> 的成員身份修改為 待審核',
	'note_members_grade_-1' => '將你在群組 <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a> 中禁言',
	'note_members_grade_0' => '將你在群組 <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a> 的成員身份修改為 普通成員',
	'note_members_grade_1' => '將你設為了群組 <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a> 的明星成員',
	'note_members_grade_8' => '將你設為了群組 <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a> 的副群主',
	'note_members_grade_9' => '將你設為了群組 <a href="space.php?do=mtag&tagid=\\1" target="_blank">\\2</a> 的群主',
	'feed_mtag_join' => '{actor} 加入了群組 {mtag} ({field})',
	'mtag_joinperm_2' => '需邀請才可加入',
	'feed_mtag_join_invite' => '{actor} 接受 {fromusername} 的邀請，加入了群組 {mtag} ({field})',
	'person' => '人',
	'delete' => '刪除',

	'space_update' => '{actor} 被SHOW了一下',

	'active_email_subject' => '您的郵箱激活郵件',
	'active_email_msg' => '請複製下面的激活鏈接到瀏覽器進行訪問，以便激活你的郵箱。<br>郵箱激活鏈接:<br><a href="\\1" target="_blank">\\1</a>',
	'share_space' => '分享了一個用戶',
	'note_share_space' => '分享了你的空間',
	'share_blog' => '分享了一篇日誌',
	'note_share_blog' => '分享了你的日誌 <a href="\\1" target="_blank">\\2</a>',
	'share_album' => '分享了一個相冊',
	'note_share_album' => '分享了你的相冊 <a href="\\1" target="_blank">\\2</a>',
	'default_albumname' => '默認相冊',
	'share_image' => '分享了一張圖片',
	'album' => '相冊',
	'note_share_pic' => '分享了你的相冊 \\2 中的<a href="\\1" target="_blank">圖片</a>',
	'share_thread' => '分享了一個話題',
	'mtag' => '群組',
	'note_share_thread' => '分享了你的話題 <a href="\\1" target="_blank">\\2</a>',
	'share_mtag' => '分享了一個群組',
	'share_mtag_membernum' => '現有 {membernum} 名成員',
	'share_tag' => '分享了一個標籤',
	'share_tag_blognum' => '現有 {blognum} 篇日誌',
	'share_link' => '分享了一個網址',
	'share_video' => '分享了一個視頻',
	'share_music' => '分享了一個音樂',
	'share_flash' => '分享了一個 Flash',
	'share_event' => '分享了一個活動',
	'share_poll' => '分享了一個\\1投票',
	'note_share_poll' => '分享了你的投票 <a href="\\1" target="_blank">\\2</a>',
	'event_time' => '活動時間',
	'event_location' => '活動地點',
	'event_creator' => '發起人',
	'feed_task' => '{actor} 完成了有獎任務 {task}',
	'feed_task_credit' => '{actor} 完成了有獎任務 {task}，領取了 {credit} 個獎勵積分',
	'the_default_style' => '默認風格',
	'the_diy_style' => '自定義風格',
	'feed_thread' => '{actor} 發起了新話題',
	'feed_eventthread' => '{actor} 發起了新活動話題',

	'feed_thread_reply' => '{actor} 回復了 {touser} 的話題 {thread}',
	'note_thread_reply' => '回復了你的話題',
	'note_post_reply' => '在話題 <a href=\\"\\1\\" target="_blank">\\2</a> 中回復了你的<a href=\\"\\3\\" target="_blank">回帖</a>',
	'thread_edit_trail' => '<ins class="modify">[本話題由 \\1 於 \\2 編輯]</ins>',
	'create_a_new_album' => '創建了新相冊',
	'not_allow_upload' => '您現在沒有權限上傳圖片',
	'get_passwd_subject' => '取回密碼郵件',
	'get_passwd_message' => '您只需在提交請求後的三天之內，通過點擊下面的鏈接重置您的密碼：<br />\\1<br />(如果上面不是鏈接形式，請將地址手工粘貼到瀏覽器地址欄再訪問)<br />上面的頁面打開後，輸入新的密碼後提交，之後您即可使用新的密碼登錄了。',
	'file_is_too_big' => '文件過大',
	'feed_blog_password' => '{actor} 發表了新加密日誌 {subject}',
	'feed_blog' => '{actor} 發表了新日誌',
	'feed_poll' => '{actor} 發起了新投票',
	'note_poll_finish' => '您發起的<a href="\\1" target="_blank">《\\2》</a>的投票已結束,<a href="\\1" target="_blank">去寫寫投票總結</a>',
	'take_part_in_the_voting' => '{actor} 參與了 {touser} 的{reward}投票 <a href="{url}" target="_blank">{subject}</a>',
	'lack_of_access_to_upload_file_size' => '無法獲取上傳文件大小',
	'only_allows_upload_file_types' => '只允許上傳jpg、jpeg、gif、png標準格式的圖片',
	'unable_to_create_upload_directory_server' => '服務器無法創建上傳目錄',
	'inadequate_capacity_space' => '空間容量不足，不能上傳新附件',
	'mobile_picture_temporary_failure' => '無法轉移臨時圖片到服務器指定目錄',
	'ftp_upload_file_size' => '遠程上傳圖片失敗',
	'comment' => '評論',
	'upload_a_new_picture' => '上傳了新圖片',
	'upload_album' => '更新了相冊',
	'the_total_picture' => '共 \\1 張圖片',
	'feed_invite' => '{actor} 發起邀請，和 {username} 成為了好友',
	'note_invite' => '接受了您的好友邀請',
	'space_open_subject' => '快來打理一下您的個人主頁吧',
	'space_open_message' => 'hi，我今天去拜訪了一下您的個人主頁，發現您自己還沒有打理過呢。趕快來看看吧。地址是：\\1space.php',
	'feed_space_open' => '{actor} 開通了自己的個人主頁',
	
	'feed_profile_update_base' => '{actor} 更新了自己的基本資料',
	'feed_profile_update_contact' => '{actor} 更新了自己的聯繫方式',
	'feed_profile_update_edu' => '{actor} 更新了自己的教育情況',
	'feed_profile_update_work' => '{actor} 更新了自己的工作信息',
	'feed_profile_update_info' => '{actor} 更新了自己的興趣愛好等個人信息',
	
	'apply_mtag_manager' => '想申請成為 <a href="\\1" target="_blank">\\2</a> 的群主，理由如下:\\3。<a href="\\1" target="_blank">(點擊這裡進入管理)</a>',
	'feed_add_attachsize' => '{actor} 用 {credit} 個積分兌換了 {size} 附件空間，可以上傳更多的圖片啦(<a href="cp.php?ac=credit&op=addsize">我也來兌換</a>)',

	'event'=>'活動',
	'event_set_delete' => '管理員取消了您組織的活動 \\1',
	'event_set_verify' => '管理員審核通過了您組織的活動 <a href="\\1" target="_blank">\\2</a>',
	'event_set_unverify' => '管理員審核沒有通過您組織的活動 <a href="\\1" target="_blank">\\2</a>',
	'event_set_recommend' => '管理員推薦了您組織的活動 <a href="\\1" target="_blank">\\2</a>',
	'event_set_unrecommend' => '管理員取消推薦了您組織的活動 <a href="\\1" target="_blank">\\2</a>',
	'event_set_open' => '管理員開啟了您組織的活動 <a href="\\1" target="_blank">\\2</a>',
	'event_set_close' => '管理員關閉了您組織的活動 <a href="\\1" target="_blank">\\2</a>',
	'event_add' => '{actor} 發起了新活動',
	'event_feed_info' => '<strong>{title}</strong><br/>地點：{province} {city} {location} <br/>時間：{starttime} - {endtime}',
	'event_join' => '{actor} 參加了 <a href="space.php?uid={uid}" target="_blank">{username}</a> 的活動 <a href="space.php?do=event&id={eventid}" target="_blank">{title}</a>',
	'event_join_member' => '參加了您組織的活動 <a href="\\1" target="_blank">\\2</a>',
	'event_quit_member' => '退出了您組織的活動 <a href="\\1" target="_blank">\\2</a>',
	'event_join_verify' => '申請參加您組織的活動 <a href="\\1" target="_blank">\\2</a>，趕緊去<a href="\\3" target="_blank">審核</a>吧',
	'eventmember_set_verify' => '通過了您參加活動 <a href="\\1" target="_blank">\\2</a> 的申請',
	'eventmember_unset_verify' => '把您在活動 <a href="\\1" target="_blank">\\2</a> 中的身份設為了待審核',
	'eventmember_set_admin' => '把您設為了活動 <a href="\\1" target="_blank">\\2</a> 的組織者',
	'eventmember_unset_admin' => '取消了您作為活動 <a href="\\1" target="_blank">\\2</a> 的組織者身份',
	'eventmember_set_delete' => '把您請出了活動 <a href="\\1" target="_blank">\\2</a>',
	'event_feed_share_pic_title'=>'{actor} 共享了新照片到活動相冊',
	'event_feed_share_pic_info'=>'<b><a href="space.php?do=event&id={eventid}&view=pic" target="_blank">{title}</a></b><br/>共 {picnum} 張照片',
	'event_accept_invite' => '接受您的邀請參加了活動 <a href="\\1" target="_blank">\\2</a> ',
	'event_accept_success' => '成功參加該活動，您可以：<a href="\\1" target="_blank">立即訪問該活動</a>',

	//道具：source/magic/*
	'magicunit' => '個',
	'magic_note_wall' => '在留言板上給你<a href="\\1" target="_blank">留言</a>',
	'magic_call' => '在\\1中點了你的名，<a href="\\2" target="_blank">快去看看吧</a>',
	'magicuse_thunder_announce_title' => '<strong>{username} 發出了「雷鳴之聲」</strong>',
	'magicuse_thunder_announce_body' => '大家好，我上線啦<br><a href="space.php?uid={uid}" target="_blank">歡迎來我家串個門</a>',
	'magic_present_note' => '送給你一個道具 \\1, <a href="\\2">趕快去看看吧</a>',
	//用戶組升級獲贈道具
	'upgrade_magic_award' => '恭喜你等級提升為 \\1，並獲贈以下道具：\\2',
	//管理員向用戶贈送道具
	'present_user_magics' => '您收到了管理員贈送的道具：\\1',
	'has_not_more_doodle' => '您沒有塗鴉板了',

	'do_stat_login' => '來訪用戶',
	'do_stat_register' => '新註冊用戶',
	'do_stat_invite' => '好友邀請',
	'do_stat_appinvite' => '應用邀請',
	'do_stat_add' => '信息發佈',
	'do_stat_comment' => '信息互動',
	'do_stat_space' => '用戶互動',
	'do_stat_login' => '來訪用戶',
	'do_stat_doing' => '記錄',
	'do_stat_blog' => '日誌',
	'do_stat_pic' => '圖片',
	'do_stat_poll' => '投票',
	'do_stat_event' => '活動',
	'do_stat_share' => '分享',
	'do_stat_thread' => '話題',
	'do_stat_docomment' => '記錄回復',
	'do_stat_blogcomment' => '日誌評論',
	'do_stat_piccomment' => '圖片評論',
	'do_stat_pollcomment' => '投票評論',
	'do_stat_pollvote' => '參與投票',
	'do_stat_eventcomment' => '活動評論',
	'do_stat_eventjoin' => '參加活動',
	'do_stat_sharecomment' => '分享評論',
	'do_stat_post' => '話題回帖',
	'do_stat_click' => '表態',
	'do_stat_wall' => '留言',
	'do_stat_poke' => '打招呼'
);

?>