<?php
$_CACHE['apps'] = array (
  1 => 
  array (
    'appid' => '1',
    'type' => 'UCHOME',
    'name' => '個人家園',
    'url' => 'http://localhost:8080/uchome',
    'ip' => '',
    'viewprourl' => '',
    'apifilename' => 'uc.php',
    'charset' => 'utf-8',
    'dbcharset' => 'utf8',
    'synlogin' => '1',
    'recvnote' => '1',
    'extra' => false,
    'tagtemplates' => '<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
	<item id="template"><![CDATA[<a href="{url}" target="_blank">{subject}</a>]]></item>
	<item id="fields">
		<item id="subject"><![CDATA[日誌標題]]></item>
		<item id="uid"><![CDATA[用戶 ID]]></item>
		<item id="username"><![CDATA[用戶名]]></item>
		<item id="dateline"><![CDATA[日期]]></item>
		<item id="spaceurl"><![CDATA[空間地址]]></item>
		<item id="url"><![CDATA[日誌地址]]></item>
	</item>
</root>',
    'allowips' => '',
  ),
);

?>