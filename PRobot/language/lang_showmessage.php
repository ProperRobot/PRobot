<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: lang_showmessage.php 13183 2009-08-17 04:35:11Z xupeng $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$_SGLOBAL['msglang'] = array(

	'box_title' => '消息',

	//common
	'do_success' => '進行的操作完成了',
	'no_privilege' => '您目前沒有權限進行此操作',
	'no_privilege_realname' => '您需要填寫真實姓名後才能進行當前操作，<a href="cp.php?ac=profile">點這裡設置真實姓名</a>',
	'no_privilege_videophoto' => '您需要視頻認證通過後才能進行當前操作，<a href="cp.php?ac=videophoto">點這裡進行視頻認證</a>',
	'no_open_videophoto' => '目前站點已經關閉視頻認證功能',
	'is_blacklist' => '受對方的隱私設置影響，您目前沒有權限進行本操作',
	'no_privilege_newusertime' => '您目前處於見習期間，需要等待 \\1 小時後才能進行本操作',
	'no_privilege_avatar' => '您需要設置自己的頭像後才能進行本操作，<a href="cp.php?ac=avatar">點這裡設置</a>',
	'no_privilege_friendnum' => '您需要添加 \\1 個好友之後，才能進行本操作，<a href="cp.php?ac=friend&op=find">點這裡添加好友</a>',
	'no_privilege_email' => '您需要驗證激活自己的郵箱後才能進行本操作，<a href="cp.php?ac=profile&op=contact">點這裡激活郵箱</a>',
	'uniqueemail_check' => '您填入的郵箱地址已經被佔用，請嘗試使用其他郵箱',
	'uniqueemail_recheck' => '您要驗證的郵箱地址已經激活過了，請進入個人資料重新設置自己的郵箱',
	'you_do_not_have_permission_to_visit' => '您已被禁止訪問。',

	//mt.php
	'designated_election_it_does_not_exist' => '指定的群組不存在，您可以嘗試創建',
	'mtag_tagname_error' => '設置的群組名稱不符合要求',
	'mtag_join_error' => '加入指定的群組失敗，請嘗試搜索現有的相關群組，並在相應的群組中申請成為會員',
	'mtag_join_field_error' => '群組分類 \\1 下面最多只允許加入 \\2 個群組，您已經到達上限',
	'mtag_creat_error' => '您要查看的群組目前還沒有被創建',

	//index.php
	'enter_the_space' => '進入個人空間頁面',

	//network.php
	'points_deducted_yes_or_no' => '本次操作將扣減您 \\1 個積分，\\2 個經驗值，確認繼續？<br><br><a href="\\3" class="submit">繼續操作</a> &nbsp; <a href="javascript:history.go(-1);" class="button">取消</a>',
	'points_search_error' => "您現在的積分或經驗值不足，無法完成本次搜索",

	//source/cp_album.php
	'photos_do_not_support_the_default_settings' => '默認相冊不支持本設置',
	'album_name_errors' => '您沒有正確設置相冊名',

	//source/space_app.php
	'correct_choice_for_application_show' => '請選擇正確的應用進行查看',

	//source/do_login.php
	'users_were_not_empty_please_re_login' => '對不起，用戶名不能為空，請重新登錄',
	'login_failure_please_re_login' => '對不起,登錄失敗,請重新登錄',

	//source/cp_blog.php
	'no_authority_expiration_date' => '您當前權限已被管理員暫時限制，恢復的時間為：\\1',
	'no_authority_expiration' => '您當前權限已被管理員限制，請理解我們的管理',
	'no_authority_to_add_log' => '您目前沒有權限添加日誌',
	'no_authority_operation_of_the_log' => '您沒有權限操作該日誌',
	'that_should_at_least_write_things' => '至少應該寫一點東西',
	'failed_to_delete_operation' => '刪除失敗，請檢查操作',

	'click_error' => '沒有進行正常的表態操作',
	'click_item_error' => '要表態的對象不存在',
	'click_no_self' => '自己不能給自己表態',
	'click_have' => '您已經表過態了',
	'click_success' => '參與表態完成了',

	//source/cp_class.php
	'did_not_specify_the_type_of_operation' => '沒有正確指定要操作的分類',
	'enter_the_correct_class_name' => '請正確輸入分類名',

	'note_wall_reply_success' => '已經回復到 \\1 的留言板',

	//source/cp_comment.php

	'operating_too_fast' => "兩次發佈操作太快了，請等 \\1 秒鐘再試",
	'content_is_too_short' => '輸入的內容不能少於2個字符',
	'comments_do_not_exist' => '指定的評論不存在',
	'do_not_accept_comments' => '該日誌不接受評論',
	'sharing_does_not_exist' => '評論的分享不存在',
	'non_normal_operation' => '非正常操作',
	'the_vote_only_allows_friends_to_comment' => '該投票只允許好友評論',

	//source/cp_common.php
	'security_exit' => '你已經安全退出了\\1',

	//source/cp_doing.php
	'should_write_that' => '至少應該寫一點東西',
	'docomment_error' => '請正確指定要評論的記錄',

	//source/cp_invite.php
	'mail_can_not_be_empty' => '郵件列表不能為空',
	'send_result_1' => '郵件已經送出，您的好友可能需要幾分鐘後才能收到郵件',
	'send_result_2' => '<strong>以下郵件發送失敗:</strong><br/>\\1',
	'send_result_3' => '未找到相應的邀請記錄, 郵件重發失敗.',
	'there_is_no_record_of_invitation_specified' => '您指定的邀請記錄不存在',

	//source/cp_import.php
	'blog_import_no_result' => '"無法獲取原數據，請確認已正確輸入的站點URL和帳號信息，服務器返回:<br /><textarea name=\"tmp[]\" style=\"width:98%;\" rows=\"4\">\\1</textarea>"',
	'blog_import_no_data' => '獲取數據失敗，請參考服務器返回:<br />\\1',
	'support_function_has_not_yet_opened fsockopen' => '站點尚未開啟fsockopen函數支持，還不能使用本功能',
	'integral_inadequate' => "您現在的積分 \\1 不足以完成本次操作。本操作將需要積分: \\2",
	'experience_inadequate' => "您現在的經驗值\\1 不足以完成本次操作。本操作將需要經驗值: \\2",
	'url_is_not_correct' => '輸入的網站URL不正確',
	'choose_at_least_one_log' => '請至少選擇一個要導入的日誌',

	//source/cp_friend.php
	'friends_add' => '您和 \\1 成為好友了',
	'you_have_friends' => '你們已經是好友了',
	'enough_of_the_number_of_friends' => '您當前的好友數目達到系統限制，請先刪除部分好友',
	'enough_of_the_number_of_friends_with_magic' => '您當前的好友數目達到系統限制，<a id="a_magic_friendnum2" href="magic.php?mid=friendnum" onclick="ajaxmenu(event, this.id, 1)">使用好友增容卡增容</a>',
	'request_has_been_sent' => '好友請求已經發送，請等待對方驗證中',
	'waiting_for_the_other_test' => '正在等待對方驗證中',
	'please_correct_choice_groups_friend' => '請正確選擇分組好友',
	'specified_user_is_not_your_friend' => '指定的用戶還不是您的好友',

	//source/cp_mtag.php
	'mtag_managemember_no_privilege' => '您不能對當前選定的成員進行群組權限變更操作，請重新選擇',
	'mtag_max_inputnum' => '無法加入，您在欄目 "\\1" 中的群組數目已達到 \\2 個限制數目',
	'you_are_already_a_member' => '您已經是該群組的成員了',
	'join_success' => '加入成功，您現在是該群組的成員了',
	'the_discussion_topic_does_not_exist' => '對不起，參與討論的話題不存在',
	'content_is_not_less_than_four_characters' => '對不起，內容不能少於2個字符',
	'you_are_not_a_member_of' => '您不是該群組的成員',
	'unable_to_manage_self' => '您不能對自己進行操作',
	'mtag_joinperm_1' => '您已經選擇加入該群組，請等待群主審核您的加入申請',
	'mtag_joinperm_2' => '本群組需要收到群主邀請後才能加入',
	'invite_mtag_ok' => '成功加入該群組，您可以：<a href="space.php?do=mtag&tagid=\\1" target="_blank">立即訪問該群組</a>',
	'invite_mtag_cancel' => '忽略該群組邀請完成',
	'failure_to_withdraw_from_group' => '退出私密群組失敗,請先指定一個主群主',
	'fill_out_the_grounds_for_the_application' => '請填寫群主申請理由',

	//source/cp_pm.php
	'this_message_could_not_be_deleted' => '指定的短消息不能被刪除',
	'unable_to_send_air_news' => '不能發送空消息',
	'message_can_not_send' => '對不起，發送短消息失敗',
	'message_can_not_send1' => '發送失敗，您當前超出了24小時最大允許發送短消息數目',
	'message_can_not_send2' => '兩次發送短消息太快，請稍等一下再發送',
	'message_can_not_send3' => '您不能給非好友批量發送短消息',
	'message_can_not_send4' => '目前您還不能使用發送短消息功能',
	'not_to_their_own_greeted' => '不能向自己打招呼',
	'has_been_hailed_overlooked' => '招呼已經忽略了',

	//source/cp_profile.php
	'realname_too_short' => '真實姓名不能少於4個字符',
	'update_on_successful_individuals' => '個人資料更新成功了',

	//source/cp_poll.php
	'no_authority_to_add_poll' => '您目前沒有權限添加投票',
	'no_authority_operation_of_the_poll' => '您沒有權限操作該投票',
	'add_at_least_two_further_options' => '請至少添加兩個不相同的候選項',
	'the_total_reward_should_not_overrun' => '您的懸賞總額不能超過\\1',
	'wrong_total_reward' => '懸賞總額不能小於平均懸賞額度',
	'voting_does_not_exist' => '投票信息不存在',
	'already_voted' => '您已經投過票',
	'option_exceeds_the_maximum_number_of' => '不能添加了,最大不能超過20個投票項',
	'the_total_reward_should_not_be_empty' => '懸賞總額不能為空',
	'average_reward_should_not_be_empty' => '平均每人懸賞額度不能為空',
	'average_reward_can_not_exceed' => '平均每人懸賞最高不能超過\\1個積分',
	'added_option_should_not_be_empty' => '新增加的候選項不能為空',
	'time_expired_error' => '過期時間不能小於當前時間',
	'please_select_items_to_vote' => '請至少選擇一個投票選項',
	'fill_in_at_least_an_additional_value' => '請至少添加一種追加類型值',

	//source/cp_share.php
	'blog_does_not_exist' => '指定的日誌不存在',
	'logs_can_not_share' => '指定的日誌因隱私設置不能夠被分享',
	'album_does_not_exist' => '指定的相冊不存在',
	'album_can_not_share' => '指定的相冊因隱私設置不能夠被分享',
	'image_does_not_exist' => '指定的圖片不存在',
	'image_can_not_share' => '指定的圖片因隱私設置不能夠被分享',
	'topics_does_not_exist' => '指定的話題不存在',
	'mtag_fieldid_does_not_exist' => '指定的群組分類不存在',
	'tag_does_not_exist' => '指定的標籤不存在',
	'url_incorrect_format' => '分享的網址格式不正確',
	'description_share_input' => '請輸入分享的描述',
	'poll_does_not_exist' => '指定的投票不存在',
	'share_not_self' => '你不能分享自己發表的信息(或圖片)',
	'share_space_not_self' => '你不能分享自己的主頁',

	//source/cp_space.php
	'domain_length_error' => '設置的二級域名長度不能小於\\1個字符',
	'credits_exchange_invalid' => '兌換的積分方案有錯，不能進行兌換，請返回修改。',
	'credits_transaction_amount_invalid' => '您要轉賬或兌換的積分數量輸入有誤，請返回修改。',
	'credits_password_invalid' => '您沒有輸入密碼或密碼錯誤，不能進行積分操作，請返回。',
	'credits_balance_insufficient' => '對不起，您的積分餘額不足，兌換失敗，請返回。',
	'extcredits_dataerror' => '兌換失敗，請與管理員聯繫。',
	'domain_be_retained' => '您設定的域名被系統保留，請選擇其他域名',
	'not_enabled_this_feature' => '系統還沒有開啟本功能',
	'space_size_inappropriate' => '請正確指定要兌換的上傳空間大小',
	'space_does_not_exist' => '對不起，您指定的用戶空間不存在。',
	'integral_convertible_unopened' => '系統目前沒有開啟積分兌換功能',
	'two_domain_have_been_occupied' => '設置的二級域名已經有人使用了',
	'only_two_names_from_english_composition_and_figures' => '設置的二級域名需要由英文字母開頭且只由英文和數字構成',
	'two_domain_length_not_more_than_30_characters' => '設置的二級域名長度不能超過30個字符',
	'old_password_invalid' => '您沒有輸入舊密碼或舊密碼錯誤，請返回重新填寫。',
	'no_change' => '沒有做任何修改',
	'protection_of_users' => '受保護的用戶，沒有權限修改',

	//source/cp_sendmail.php
	'email_input' => '您還沒有設置郵箱，請在<a href="cp.php?ac=profile&op=contact">聯繫方式</a>中準確填寫您的郵箱',
	'email_check_sucess' => '您的郵箱（\\1）驗證激活完成了',
	'email_check_error' => '您輸入的郵箱驗證鏈接不正確。您可以在個人資料頁面，重新接收新的郵箱驗證鏈接。',
	'email_check_send' => '驗證郵箱的激活鏈接已經發送到您剛才填寫的郵箱,您會在幾分鐘之內收到激活郵件，請注意查收。',
	'email_error' => '填寫的郵箱格式錯誤,請重新填寫',

	//source/cp_theme.php
	'theme_does_not_exist' => '指定的風格不存在',
	'css_contains_elements_of_insecurity' => '您提交的內容含有不安全元素',

	//source/cp_upload.php
	'upload_images_completed' => '上傳圖片完成了',

	//source/cp_thread.php
	'to_login' => '您需要先登錄才能繼續本操作',
	'title_not_too_little' => '標題不能少於2個字符',
	'posting_does_not_exist' => '指定的話題不存在',
	'settings_of_your_mtag' => '有了群組才能發話題，你需要先設置一下你的群組。<br>通過群組，您可以結識與你有相同選擇的朋友，更可以一起交流話題。<br><br><a href="cp.php?ac=mtag" class="submit">設置我的群組</a>',
	'first_select_a_mtag' => '你至少應該選擇一個群組才能發話題。<br><br><a href="cp.php?ac=mtag" class="submit">設置我的群組</a>',
	'no_mtag_allow_thread' => '當前你參與的群組加入人數不足，還不能進行發話題操作。<br><br><a href="cp.php?ac=mtag" class="submit">設置我的群組</a>',
	'mtag_close' => '選擇的群組已經被鎖定，不能進行本操作',

	//source/space_album.php
	'to_view_the_photo_does_not_exist' => '出問題了，您要查看的相冊不存在',

	//source/space_blog.php
	'view_to_info_did_not_exist' => '出問題了，您要查看的信息不存在或者已經被刪除',

	//source/space_pic.php
	'view_images_do_not_exist' => '您要查看的圖片不存在',

	//source/mt_thread.php
	'topic_does_not_exist' => '指定的話題不存在',

	//source/do_inputpwd.php
	'news_does_not_exist' => '指定的信息不存在',
	'proved_to_be_successful' => '驗證成功，現在進入查看頁面',
	'password_is_not_passed' => '輸入的網站登錄密碼不正確,請返回重新確認',



	//source/do_login.php
	'login_success' => '登錄成功了，現在引導您進入登錄前頁面 \\1',
	'not_open_registration' => '非常抱歉，本站目前暫時不開放註冊',
	'not_open_registration_invite' => '非常抱歉，本站目前暫時不允許用戶直接註冊，需要有好友邀請鏈接才能註冊',

	//source/do_lostpasswd.php
	'getpasswd_account_notmatch' => '您的賬戶資料中沒有完整的Email地址，不能使用取回密碼功能，如有疑問請與管理員聯繫。',
	'getpasswd_email_notmatch' => '輸入的Email地址與用戶名不匹配，請重新確認。',
	'getpasswd_send_succeed' => '取回密碼的方法已經通過 Email 發送到您的信箱中，<br />請在 3 天之內修改您的密碼。',
	'user_does_not_exist' => '該用戶不存',
	'getpasswd_illegal' => '您所用的 ID 不存在或已經過期，無法取回密碼。',
	'profile_passwd_illegal' => '密碼空或包含非法字符，請返回重新填寫。',
	'getpasswd_succeed' => '您的密碼已重新設置，請使用新密碼登錄。',
	'getpasswd_account_invalid' => '對不起，創始人、受保護用戶或有站點設置權限的用戶不能使用取回密碼功能，請返回。',
	'reset_passwd_account_invalid' => '對不起，創始人、受保護用戶或有站點設置權限的用戶不能使用密碼重置功能，請返回。',

	//source/do_register.php
	'registered' => '註冊成功了，進入個人空間',
	'system_error' => '系統錯誤，未找到UCenter Client文件',
	'password_inconsistency' => '兩次輸入的密碼不一致',
	'profile_passwd_illegal' => '密碼空或包含非法字符，請重新填寫。',
	'user_name_is_not_legitimate' => '用戶名不合法',
	'include_not_registered_words' => '用戶名包含不允許註冊的詞語',
	'user_name_already_exists' => '用戶名已經存在',
	'email_format_is_wrong' => '填寫的 Email 格式有誤',
	'email_not_registered' => '填寫的 Email 不允許註冊',
	'email_has_been_registered' => '填寫的 Email 已經被註冊',
	'regip_has_been_registered' => '同一個IP在 \\1 小時內只能註冊一個賬號',
	'register_error' => '註冊失敗',

	//tag.php
	'tag_does_not_exist' => '指定的標籤不存在',

	//cp_poke.php
	'poke_success' => '已經發送，\\1下次訪問時會收到通知',
	'mtag_minnum_erro' => '本群組成員數不足 \\1 個，還不能進行本操作',

	//source/function_common.php
	'information_contains_the_shielding_text' => '對不起，發佈的信息中包含站點屏蔽的文字',
	'site_temporarily_closed' => '站點暫時關閉',
	'ip_is_not_allowed_to_visit' => '不能訪問，您當前的IP不在站點允許訪問的範圍內。',
	'no_data_pages' => '指定的頁面已經沒有數據了',
	'length_is_not_within_the_scope_of' => '分頁數不在允許的範圍內',

	//source/function_block.php
	'page_number_is_beyond' => '頁數是否超出範圍',
	//source/function_cp.php
	'incorrect_code' => '輸入的驗證碼不符，請重新確認',

	//source/function_space.php
	'the_space_has_been_closed' => '您要訪問的空間已被刪除，如有疑問請聯繫管理員',

	//source/network_album.php
	'search_short_interval' => '兩次搜索間隔太短，請等待 \\1 秒後再重試 (<a href="\\2">重新搜索</a>)',
	'set_the_correct_search_content' => '對不起，請設置正確的查找內容',

	//source/space_share.php
	'share_does_not_exist' => '要查看的分享不存在',

	//source/space_tag.php
	'tag_locked' => '標籤已經被鎖定',

	'invite_error' => '無法獲取好友邀請碼，請確認您是否有足夠的積分來進行本操作',
	'invite_code_error' => '對不起，您訪問的邀請鏈接不正確，請確認。',
	'invite_code_fuid' => '對不起，您訪問的邀請鏈接已經被他人使用了。',

	//source/do_invite.php
	'should_not_invite_your_own' => '對不起，您不能通過訪問自己的邀請鏈接來邀請自己。',
	'close_invite' => '對不起，系統已經關閉了好友邀請功能',

	'field_required' => '個人資料中的必填項目「\\1」 不能為空，請確認',
	'friend_self_error' => '對不起，您不能加自己為好友',
	'change_friend_groupname_error' => '指定的好友用戶組不能被操作',

	'mtag_not_allow_to_do' => '您不是該話題所在群組的成員，沒有權限進行本操作',

	//cp_task
	'task_unavailable' => '您要參與的有獎任務不存在或者還沒有開始，無法繼續操作',
	'task_maxnum' => '您要參與的有獎任務已經到達允許人數的上限了，該任務自動失效',
	'update_your_mood' => '請先更新一下您現在的心情狀態吧',

	'showcredit_error' => '填寫的數字需要大於0，並且小於您的積分數，請確認',
	'showcredit_fuid_error' => '您指定的用戶還不是你的好友，請確認',
	'showcredit_do_success' => '您已經成功增加上榜積分，趕快查看自己的最新排名吧',
	'showcredit_friend_do_success' => '您已經成功贈送好友上榜積分，好友會收到通知的',

	'submit_invalid' => '您的請求來路不正確或表單驗證串不符，無法提交。請嘗試使用標準的web瀏覽器進行操作。',
	'no_privilege_my_status' => '對不起，當前站點已經關閉了用戶多應用服務。',
	'no_privilege_myapp' => '對不起，該應用不存在或已關閉，您可以<a href="cp.php?ac=userapp&my_suffix=%2Fapp%2Flist">選擇其他應用</a>',

	'report_error' => '對不起，請正確指定要舉報的對象',
	'report_success' => '感謝您的舉報，我們會盡快處理',
	'manage_no_perm' => '您只能對自己發佈的信息進行管理<a href="javascript:;" onclick="hideMenu();">[關閉]</a>',
	'repeat_report' => '對不起，請不要重複舉報',
	'the_normal_information' => '要舉報的對象被管理員視為沒有違規，不需要再次舉報了',
	'friend_ignore_next' => '成功忽略用戶 \\1 的好友申請，繼續處理下一個請求中(<a href="cp.php?ac=friend&op=request">停止</a>)',
	'friend_addconfirm_next' => '您已經跟 \\1 成為了好友，繼續處理下一個好友請求中(<a href="cp.php?ac=friend&op=request">停止</a>)',

	//source/cp_event.php
	'event_title_empty'=>'活動名稱不能為空',
	'event_classid_empty'=>'必須選擇活動分類',
	'event_city_empty'=>'必須選擇活動城市',
	'event_detail_empty'=>'必須填寫活動介紹',
	'event_bad_time_range'=>'活動持續時間不能超過60天',
	'event_bad_endtime'=>'活動結束時間不能早於開始時間',
	'event_bad_deadline'=>'活動報名截止時間不能晚於活動結束時間',
	'event_bad_starttime'=>'活動開始時間不能早於現在',
	'event_already_full'=>'此活動參與人數已滿',
	'event_will_full' => '人數將超過活動參與人數限制',
	'no_privilege_add_event'=>'您沒有權限發起新活動',
	'no_privilege_edit_event'=>'您沒有權限編輯這個活動的信息',
	'no_privilege_manage_event_members' =>'您沒有權限管理這個活動的成員',
	'no_privilege_manage_event_comment' => '您沒有權限管理這個活動的評論',
	'no_privilege_manage_event_pic' => '您沒有權限管理這個活動的相冊',
	'no_privilege_do_eventinvite' =>'您沒有權限發送活動邀請',
	'event_does_not_exist'=>'活動不存在或已被刪除',
	'event_create_failed'=>'創建活動失敗，請檢查您的輸入信息',
	'event_need_verify'=>'活動創建成功，等待管理員審核',
	'upload_photo_failed'=>'上傳活動海報失敗',
	'choose_right_eventmember'=>'請選擇合適的活動成員進行操作',
	'choose_event_pic'=>'請選擇活動照片',
	'only_creator_can_set_admin'=>'只有創建者可以設置其他組織者',
	'event_not_set_verify'=>'活動不需要審核',
	'event_join_limit'=>'此活動只有通過邀請才能加入',
	'cannot_quit_event'=>'您不能退出活動，因為您還沒有加入活動或者您是這個活動的發起人',
	'event_not_public'=>'這是一個非公開活動，只有通過邀請才能查看',
	'no_privilege_do_event_invite' => '此活動不允用戶邀請好友',
	'event_under_verify' => '此活動正在審核中',
	'cityevent_under_condition' => '要瀏覽同城活動，需要先設置您的居住地',
	'event_is_over' => '此活動已經結束',
	'event_meet_deadline'=>'活動已經截止報名',
	'bad_userevent_status'=>'請選擇正確的活動成員狀態',
	'event_has_followed'=>'您已經關注了此活動',
	'event_has_joint'=>'您已經加入了此活動',
	'event_is_closed'=>'活動已經關閉',
	'event_only_allows_members_to_comment'=>'此活動只允許活動成員發表留言',
	'event_only_allows_admins_to_upload'=>'此活動只有組織者可以上傳照片',
	'event_only_allows_members_to_upload'=>'只有活動成員可以上傳活動照片',
	'eventinvite_does_not_exist'=>'您沒有該活動的活動邀請',
	'event_can_not_be_opened' => '此活動現在不能被開啟',
	'event_can_not_be_closed' => '此活動現在不能被關閉',
	'event_only_allows_member_thread' => '只有活動成員才能發表或回復活動話題',
	'event_mtag_not_match' => '指定群組沒有關聯到本活動',
	'event_memberstatus_limit' => '此活動為私密活動，只有活動成員才能訪問',
	'choose_event_thread' => '請選擇至少一個活動話題進行操作',

	//source/cp_magic.php
	'magicuse_success' => '道具使用成功了',
	'unknown_magic' => '指定的道具不存在或已被禁止使用',
	'choose_a_magic' => '請選擇一個道具',
	'magic_is_closed' => '此道具已被禁用',
	'magic_groupid_not_allowed' => '您所在的用戶組沒有權限使用道具',
	'input_right_buynum' => '請正確輸入要購買的數量',
	'credit_is_not_enough' => '您的積分不夠購買此道具',
	'not_enough_storage' => '道具庫存量不足，下次補給時間是 \\1',
	'magicbuy_success' => '道具購買成功，花費積分 \\1',
	'magicbuy_success_with_experence' => '道具購買成功，花費積分 \\1, 增加經驗 \\2',
	'bad_friend_username_given' => '輸入的好友名無效',
	'has_no_more_present_magic' => '您還沒有道具轉讓許可證，<a id="a_buy_license" href="cp.php?ac=magic&op=buy&mid=license" onclick="ajaxmenu(event, this.id, 1)">馬上去購買</a>',
	'has_no_more_magic' => '您還沒有道具 \\1，<a id="\\2" href="\\3" onclick="ajaxmenu(event, this.id, 1)">立刻購買</a>',
	'magic_can_not_be_presented' => '此道具不能被贈送',
	'magicpresent_success' => '已成功向 \\1 贈送了道具',
	'magic_store_is_closed' => '道具商店已經關閉',
	'magic_not_used_under_right_stage' => '此道具不能在當前場景使用',
	'magic_groupid_limit' => '您當前所在的用戶組不能購買該道具',
	'magic_usecount_limit' => '受道具使用週期限制，您現在還不能使用此道具。<br>請於 \\1 之後使用',
	'magicuse_note_have_no_friend' => '您沒有任何好友',
	'magicuse_author_limit' => '此道具只能對自己發佈的信息使用',
	'magicuse_object_count_limit' => '此道具對同一信息使用次數已達到上限（\\1 次）',
	'magicuse_object_once_limit' => '已經對該信息使用過此道具，不能重複使用',
	'magicuse_bad_credit_given' => '您輸入的積分數無效',
	'magicuse_not_enough_credit' => '您輸入的積分數超過所當前擁有的積分',
	'magicuse_bad_chunk_given' => '您輸入的單份積分數無效',
	'magic_gift_already_given_out' => '紅包已經被領完了',
	'magic_got_gift' => '您已經領取到了紅包：增加 \\1 個積分',
	'magic_had_got_gift' => '您已經領取過此次紅包了',
	'magic_has_no_gift' => '當前空間沒有設置紅包',
	'magicuse_object_not_exist' => '道具的作用對像不存在',
	'magicuse_bad_object' => '沒有正確選擇道具要作用的對象',
	'magicuse_condition_limit' => '道具的發起條件不足',
	'magicuse_bad_dateline' => '輸入的時間無效',
	'magicuse_not_click_yet' => '您還沒有對該信息表態過',
	'not_enough_coupon' => '代金券數目不足',
	'magicuse_has_no_valid_friend' => '道具使用失敗，沒有任何合法的好友',
	'magic_not_hidden_yet' => '您現在不是隱身狀態',
	'magic_not_for_sale' => '此道具不能通過購買獲得',
	'not_set_gift' => '您當前沒有設置紅包',
	'not_superstar_yet' => '您還不是超級明星',
	'no_flicker_yet' => '您還沒有對此信息使用彩虹炫',
	'no_color_yet' => '您還沒有對此信息使用彩色燈',
	'no_frame_yet' => '您還沒有對此信息使用相框',
	'no_bgimage_yet' => '您還沒有對此信息使用信紙',
	'bad_buynum' => '您輸入的購買數目有誤',

	'feed_no_found' => '指定要查看的動態不存在',
	'not_open_updatestat' => '站點沒有開啟趨勢統計功能',
	
	'topic_subject_error' => '標題長度不要少於4個字符',
	'topic_no_found' => '指定要查看的熱鬧不存在',
	'topic_list_none' => '目前還沒有可以參與的熱鬧',

	'space_has_been_locked' => '空間已被鎖定無法訪問，如有疑問請聯繫管理員',

	
);

?>