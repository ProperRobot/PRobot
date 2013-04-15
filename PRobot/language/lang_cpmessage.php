<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: lang_cpmessage.php 12878 2009-07-24 05:59:38Z xupeng $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$_SGLOBAL['cplang'] = array(
	//common
	'do_success' => '進行的操作完成了',

	//admincp.php
	'enter_the_password_is_incorrect' => '輸入的密碼不正確，請重新嘗試',
	'excessive_number_of_attempts_to_sign' => '您30分鐘內嘗試登錄管理平台的次數超過了3次，為了數據安全，請稍候再試',

	//admincp.php

	//admin/admincp_ad.php
	'no_authority_management_operation' => '對不起,您沒有權限進行本管理操作',
	'please_check_whether_the_option_complete_required' => '請檢查必填選項是否填寫完整',
	'please_choose_to_remove_advertisements' => '請至少選擇一個要刪除的廣告',
	'no_authority_management_operation_edittpl' => '安全考慮，在線編輯模板功能默認關閉，並且只有創始人可以操作。如果您想使用此功能，請修改config.php中的相關配置。',
	'no_authority_management_operation_backup' => '安全考慮，數據庫備份恢復操作只有創始人可以操作。如果您想使用此功能，請修改config.php中的相關配置。',

	//admin/admincp_album.php
	'at_least_one_option_to_delete_albums' => '請至少正確選擇一個要刪除的相冊',

	//admin/admincp_backup.php
	'data_import_failed_the_file_does_not_exist' => '數據導入失敗,文件不存在',
	'start_transferring_data' => '數據導入開始',
	'wrong_data_file_format_into_failure' => '數據導入失敗,文件格式不對',
	'documents_were_incorrect_length' => '文件名長度不正確',
	'backup_table_wrong' => '備份表出錯',
	'failure_writes_the_document_check_file_permissions' => '寫入文件失敗,請檢查文件權限',
	'successful_data_compression_and_backup_server_to' => '數據成功備份並壓縮至服務器',
	'backup_file_compression_failure' => '對不起,備份數據文件壓縮失敗,請檢查目錄權限',
	'shell_backup_failure' => 'SHELL備份失敗',
	'data_file_does_not_exist' => '對不起, 數據文件不存在,請檢查',
	'the_volumes_of_data_into_databases_success' => '分卷數據成功導入UCenter Home數據庫.',
	'data_file_does_not_exist' => '對不起數據文件不存在請檢查',
	'data_file_format_is_wrong_not_into' => '數據文件非格式，無法導入。',
	'directory_does_not_exist_or_can_not_be_accessed' => '目錄不存在或無法訪問，請檢查 \\1 目錄。',
	'vol_backup_database' => '分卷備份: 數據文件 # \\1 成功創建，程序將自動繼續。',
	'complete_database_backup' => '恭喜您，全部 \\1 個備份文件成功創建，備份完成。',
	'decompress_data_files_success' => '數據文件 # \\1 成功解壓縮，程序將自動繼續。',
	'data_files_into_success' => '數據文件 # \\1 成功導入，程序將自動繼續。',

	//admin/admincp_block.php
	'correctly_completed_module_name' => '請正確填寫數據模塊的名稱',
	'a_call_to_delete_the_specified_modules_success' => '指定的數據調用模塊刪除成功了',
	'designated_data_transfer_module_does_not_exist' => '指定的數據調用模塊不存在',
	'sql_statements_can_not_be_completed_for_normal' => '填寫的SQL語句不能正常查詢，請返回檢查。<br>服務器反饋：<br>ERROR: \\1<br>ERRNO. \\2',
	'enter_the_next_step' => '進入下一步操作',
	'choose_to_delete_the_data_transfer_module' => '請至少選擇一個要刪除的數據調用模塊',

	//admin/admincp_blog.php
	'the_correct_choice_to_delete_the_log' => '請至少正確選擇一個要刪除的日誌',
	'the_correct_choice_to_add_topic' => '推薦到指定熱點出錯，請確認是否正確操作',
	'add_topic_success' => '推薦到熱點完成了，產生了 \\1 個相關動態',

	//admin/admincp_cache.php

	//admin/admincp_censor.php

	//admin/admincp_comment.php
	'the_correct_choice_to_delete_comments' => '請至少正確選擇一個要刪除的評論',
	'choice_batch_action' => '請選擇要進行的操作類型',

	//admin/admincp_config.php
	'ip_is_not_allowed_to_visit_the_area' => '當前的IP( \\1 )不在允許訪問的IP範圍內，請檢查設置',
	'the_prohibition_of_the_visit_within_the_framework_of_ip' => '當前的IP( \\1 )在禁止訪問的IP範圍內，請檢查設置',

	'config_uc_dir_error' => '設置的UCenter物理路徑不正確，請返回檢查',

	//admin/admincp_credit.php
	'rules_do_not_exist_points' => '該積分規則不存在',

	//admin/admincp_cron.php
	'designated_script_file_incorrect' => '指定的腳本文件不正確',
	'implementation_cycle_incorrect_script' => '設定的腳本執行週期不正確',

	//admin/admincp_item.php
	'choose_to_delete_events' => '請至少正確選擇一個要刪除的事件',

	//admin/admincp_mtag.php
	'choose_to_delete_the_columns_tag' => '請至少正確選擇一個要刪除的群組',
	'designated_to_merge_the_columns_do_not_exist' => '要合併到的新群組還沒有創建，請先自行創建此群組後再進行合併',
	'the_successful_merger_of_the_designated_columns' => '合併指定的群組成功了',
	'columns_option_to_merge_the_tag' => '請至少正確選擇一個要合併的群組',
	'lock_open_designated_columns_tag_success' => '鎖定/開放指定的群組成功了',
	'recommend_designated_columns_tag_success' => '推薦/取消推薦指定的群組成功了',
	'choose_to_operate_columns_tag' => '請至少正確選擇一個要操作的群組',

	'failed_to_change_the_length_of_columns' => '欄目長度變更失敗，這可能是現存的數據已經超過新長度',

	//admin/admincp_pic.php
	'choose_to_delete_pictures' => '請至少正確選擇一個要刪除的圖片',

	//admin/admincp_post.php
	'choose_to_delete_the_topic' => '請至少正確選擇一個要刪除的話題',

	//admin/admincp_profield.php
	'there_is_no_designated_users_columns' => '指定操作的群組欄目不存在',
	'choose_to_delete_the_columns' => '請正確選擇要刪除的欄目',
	'have_one_mtag' => '刪除失敗，請至少要保留一個群組欄目',
	
	//admin/admincp_poll.php
	'the_correct_choice_to_delete_the_poll' => '請至少正確選擇一個要刪除的投票',

	//admin/admincp_report.php
	'the_right_to_report_the_specified_id' => '請正確指定舉報ID',

	//admin/admincp_share.php
	'please_delete_the_correct_choice_to_share' => '請正確選擇要刪除的分享',

	//admin/admincp_space.php
	'designated_users_do_not_exist' => '您指定的用戶不存在',
	'choose_to_delete_the_space' => '請正確選擇要刪除的空間',
	'not_have_permission_to_operate_founder' => '你沒有權限對創始人進行操作',
	'uc_error' => '與用戶中心通信出錯，請稍後再試',

	//admin/admincp_stat.php
	'choose_to_reconsider_statistical_data_types' => '請正確選擇要重新統計的數據類型',
	'data_processing_please_wait_patiently' => '<a href="\\1">處理數據中( \\2 )，請耐心等候...</a> (<a href="\\3">強制終止</a>)',

	//admin/admincp_tag.php
	'choose_to_delete_the_tag' => '請至少正確選擇一個要刪除的標籤',
	'to_merge_the_tag_name_of_the_length_discrepancies' => '指定的要合併到的tag名稱字符長度不符合要求(1~30個字符)',
	'the_tag_choose_to_merge' => '請至少正確選擇一個要合併的標籤',
	'choose_to_operate_tag' => '請至少正確選擇一個要操作的標籤',

	//admin/admincp_template.php
	'designated_template_files_can_not_be_restored' => '指定的模板文件不能恢復',
	'template_files_editing_failure_check_directory_competence' => '指定的模板文件無法編輯,請檢查 ./template 目錄權限設置',

	//admin/admincp_thread.php
	'choosing_to_operate_the_topic' => '請正確選擇要操作的話題',

	//admin/admincp_usergroup.php
	'user_group_does_not_exist' => '指定操作的用戶組不存在',
	'user_group_were_not_empty' => '指定的用戶組名不能為空',
	'integral_limit_duplication_with_other_user_group' => '指定的積分下限跟其他用戶組重複',
	'system_user_group_could_not_be_deleted' => '系統用戶組不能刪除',
	'integral_limit_error' => '指定的積分下限上能超過999999999，下限不能低於-999999998',

	//admin/admincp_userapp.php
	'my_register_sucess' => '成功開啟用戶應用服務',
	'my_register_error' => '開啟用戶應用服務失敗，失敗原因：<br>\\2 (ERRCODE:\\1)<br><br><a href="http://www.discuz.net/index.php?gid=141" target="_blank">如果有疑問，請訪問我們的技術論壇尋求幫助</a>。',
	'sitefeed_error' => '請正確添加動態標題、動態內容再提交發佈',

	//admin/admincp_event.php
	'choose_to_delete_the_columns_event'=>'請選擇要刪除的活動',
	'choose_to_grade_the_columns_event'=>'請選擇要設置的活動狀態，新狀態不能和原狀態相同',
	'have_no_eventclass'=>'刪除失敗，請保留至少一個活動分類',
	'poster_only_jpg_allowed'=>'由於您的服務器不支持生成縮略圖，您在此處只能上傳 jpg 格式的圖片'

);

?>