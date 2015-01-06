<?php 
	$url = "localhost";
	$user = "root";
	$pw = "";
	$db = "merry";

	//MySQLへ接続
	$conn = mysql_connect($url,$user,$pw)or die ("失敗");

	//データベース選択
	$sdb = mysql_select_db($db,$conn) or die("失敗");

	//文字コード設定
	mysql_set_charset('utf8');
 ?>