<?php 
	include_once("connect.php");
	include_once("secure_common.php");

	session_start();

	 // セッション初期状態用の設定
	 if(!isset($_SESSION['id'])){$_SESSION['id']="";}
	 if(!isset($_SESSION['pw'])){$_SESSION['pw']="";}

	 if(!isset($_POST['part'])){$_POST['part']="";} //なんでこれだけnotice出されるのん…？
	 if(!isset($_POST['confirm_pw'])){$_POST['confirm_pw']="";}
 	
	$error = array();

	//エラーチェック
	if(!empty($_POST['flag'])){
		
		//IDの入力チェック
		if(empty(seq($_POST['id']))){
			$error[0] = "IDを入力してください"; 
		}else if(preg_match('/^[0-9a-zA-Z]+$/', seq($_POST['id'])) == 0){
			$error[0] = "IDは半角英数、記号抜きで入力してください"; 
		}else{
			//idが一意かどうか
			$sql = "SELECT COUNT(*) AS cnt FROM users WHERE user_id ='".seq($_POST['id'])."'";
			$result = mysql_query($sql);
			
			while($row = mysql_fetch_array($result)){
				$cnt = $row['cnt'];
			}
			if($cnt!=0){
				$error[0] = "すでに同じidのユーザが存在します"; 
			}
		}

		//パスワードの入力チェック
		if(empty(seq($_POST['pw']))){
			$error[1] = "パスワードを入力してください"; 
		}else if(preg_match('/^[0-9a-zA-Z]+$/', seq($_POST['pw'])) == 0){
			$error[1] = "パスワードは半角英数、記号抜きで入力してください"; 
		}

		//確認用パスワードの入力チェック
		if(empty(seq($_POST['confirm_pw']))){
			$error[2] = "確認用パスワードを入力してください"; 
		}else if(preg_match('/^[0-9a-zA-Z]+$/', seq($_POST['confirm_pw'])) == 0){
			$error[2] = "パスワードは半角英数、記号抜きで入力してください"; 
		}else if(seq($_POST['pw']) != seq($_POST['confirm_pw']) ){
			$error[2] = "パスワードが一致しません"; 
		}

		//部位選択の入力チェック
		if(empty(seq($_POST['part']))){
			$error[3] = "部位を選択してください"; 
		}

		//エラーがなければインサート
		if(empty($error)){
			$sql = "INSERT INTO users(user_id, user_pw) VALUE('". seq($_POST['id'])."','". hashy($_POST['pw'])."');";
			$resultAccount = mysql_query($sql);

			$sql = "INSERT INTO choises(user_id, part_id) VALUE('". seq($_POST['id'])."','". intval(seq($_POST['part']))."');";
			$resultPart = mysql_query($sql);

			if($resultAccount){ //userテーブルへのインサートがうまくいったら1が入る
				if($resultPart){ //choisesテーブルへのインサートがうまくいったら1が入る
					echo $resultAccount;
					echo $resultPart;
					$_SESSION['id'] = seq($_POST['id']);
					$_SESSION['pw'] = hashy($_POST['pw']);

					//一覧ページに自動的に遷移させるための記述
					header("Location: ../index.php");
				}
			}
			 
		}else{
			// foreach($error as $val){ //エラー内容を出力
			// 	print $val."<br>";
			// }
			// exit;
		}
	}

?>
	
