<?php 

class Common{

public static function connecting(){
	try {
		$dsn = 'mysql:dbname=merry;host=localhost';
		$user = 'root';
		$password = '';
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);
		$conn = new PDO($dsn, $user, $password, $options);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		} catch (PDOException $e){
		//接続時にErrorが発生したときにError Messageを表示させてProgramを終了させる
			echo ('Error:'.$e->getMessage());
			exit;
		}
		return $conn;
}

function escapeHTML($data){
	return htmlspecialchars($data,ENT_QUOTES,'UTF-8');
}

function hashy($data){
	return substr(crypt(seq($data),'se'),2);
}

}
 ?>