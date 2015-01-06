<?php 

	include_once("connect.php");
	include_once("secure_common.php");

	 // セッション初期状態用の設定
	 if(!isset($_SESSION['id'])){$_SESSION['id']="";}
	 if(!isset($_SESSION['pw'])){$_SESSION['pw']="";}

	$error = array();

	if(!empty($_POST['flag'])){
			
		//DB内検索チェック
		$sql= "SELECT * FROM users where user_id='".seq($_POST['id'])."' AND user_pw='".hashy($_POST['pw'])."'";
		$result = mysql_query($sql) or exit("データの抽出に失敗しました。");


		if(mysql_num_rows($result)!=0){ //0じゃないなら一致でログイン成功
			$_SESSION['id'] = seq($_POST['id']);
			$_SESSION['pw'] = hashy($_POST['pw']);
			//メイン画面に遷移
			header("Location: ../index.php");
				exit;
		}else{ //0なら検索結果ゼロ
			$error[0] = "idかパスワードが一致しません"; 
		}
	}


?>
	
