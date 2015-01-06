<?php 
	include_once("connect.php");
	include_once("secure_common.php");

	if(!isset($_POST['pw'])){$_POST['pw']="";}
	if(!isset($_POST['new_pw'])){$_POST['new_pw']="";}
	if(!isset($_POST['confirm_pw'])){$_POST['confirm_pw']="";}

	//choisesテーブルからDBからpart_idを取得
	$id = seq($_SESSION['id']);
	$pw = seq($_SESSION['pw']);
	$sql = "SELECT * FROM choises where user_id='".seq($_SESSION['id'])."'";
	$result = mysql_query($sql) or exit('IDの抽出に失敗');
	if(mysql_num_rows($result)==1){

		//user_idからpart_idを取得
		$row = mysql_fetch_array($result, MYSQL_ASSOC); //このへんの指定がおかしい？
	    $part_id  = $row['part_id']; 
	    //echo "あなたの部位が確認できました。{$part_id}があなたの部位です。<br>";

	    //partsテーブルからpart_nameを取得
	    $sql = "SELECT * FROM parts where part_id='".$part_id."'";
	    $result = mysql_query($sql) or exit('part_idの抽出に失敗');

	    if(mysql_num_rows($result)==1){
		    $row = mysql_fetch_array($result, MYSQL_ASSOC); //このへんの指定がおかしい？
			$part_name = $row['part_name'];
			//echo $part_name;
		}


	}else if(mysql_num_rows($result)==0){
		echo 'IDないやないか';
	}else{
		echo 'IDいっぱいあるやないかやり直し';
	}
	
	// pw変更用処理
	$error = array();

	//エラーチェック
	if(!empty($_POST['flag'])){
		if($_POST['flag'] === '1') {//パスワード変更画面にいく
			echo 'hhhh';
			//header("Location: ../pass/index.php");
			//exit;
		}else if($_POST['flag'] === '2') {//パスワード変更を行う

			//現在のパスワードの入力チェック
			if(empty(seq($_POST['pw']))){
				$error[0] = "現在のパスワードを入力してださい"; 
			}else if( hashy($_POST['pw']) != $_SESSION['pw']){
				$error[0] = "現在のパスワードが一致しません"; 
			}

			//新しいパスワードの入力チェック
			if(empty(seq($_POST['new_pw']))){
				$error[1] = "新しいパスワードを入力してください"; 
			}else if(preg_match('/^[0-9a-zA-Z]+$/', seq($_POST['new_pw'])) == 0){
				$error[1] = "新しいパスワードは半角英数、記号抜きで入力してください";  
			}
			
			//確認用パスワードの入力チェック
			if(empty(seq($_POST['confirm_pw']))){
				$error[2] = "確認用パスワードを入力してください"; 
			}else if(preg_match('/^[0-9a-zA-Z]+$/', seq($_POST['confirm_pw'])) == 0){
				$error[2] = "確認用パスワードは半角英数、記号抜きで入力してください"; 
			}else if(seq($_POST['new_pw']) != seq($_POST['confirm_pw']) ){
				$error[2] = "新しいパスワードと確認用パスワードが一致しません"; 
			}

			//エラーがなければアップデート
			if(count($error) == 0){
				echo hashy($_POST['new_pw']);
				$sql = "UPDATE users SET user_pw='". hashy($_POST['new_pw'])."' where user_id='".seq($_SESSION['id'])."'";
				$resultAccount = mysql_query($sql);
				if($resultAccount){ //userテーブルへのアップデートがうまくいったら1が入る
					$_SESSION['pw'] = hashy($_POST['new_pw']);
					echo hashy($_POST['new_pw']);

					//設定ページ1に自動的に遷移させるための記述
					header("Location: ../setting/index.php");
					exit;
				}
			}else{
				//foreach($error as $val){ //エラー内容を出力
				//	print $val."<br>";
				//}
			}
		} else {//部位変更を行う
			$sql = "UPDATE choises SET part_id=".intval($_POST['part'])." where user_id='".seq($_SESSION['id'])."'";
				$resultAccount = mysql_query($sql);
				if($resultAccount){ //userテーブルへのアップデートがうまくいったら1が入る
					$_SESSION['pw'] = hashy($_POST['pw']);
					//設定ページ1に自動的に遷移させるための記述
					header("Location: ../setting/index.php");
					exit;
			}
		}
	}

 ?>