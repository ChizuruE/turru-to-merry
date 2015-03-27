<?php 
	require_once("common.php");
	require_once("sessioner.php");
	require_once("validator.php");
	// include_once("connect.php");
	include_once("secure_common.php");

	$common = new Common();
	$conn = $common -> connecting();

	$validator = new Validator();

	session_start();

	 // セッション初期状態用の設定
	 if(!isset($_SESSION['id'])){$_SESSION['id']="";}
	 if(!isset($_SESSION['pw'])){$_SESSION['pw']="";}

	 if(!isset($_POST['part'])){$_POST['part']="";} //なんでこれだけnotice出されるのん…？
	 if(!isset($_POST['confirm_pw'])){$_POST['confirm_pw']="";}
 	
	$error = array();

	if(!empty($_POST['flag'])){
		$id = $common -> escapeHTML($_POST['id']);
		$pw = $common -> escapeHTML($_POST['pw']);
		$confirm_pw = $common -> escapeHTML($_POST['confirm_pw']);
		$part = $common -> escapeHTML($_POST['part']);

		$error[0] = $validator -> nullChk($id);
		if(empty($error[0])) $error[0] = $validator -> alphanumericChk($id);
		if(empty($error[0])) $error[0] = $validator -> alphanumericChk($id);
		if(empty($error[0])) {
			$stmt = $conn -> prepare("SELECT COUNT(*) AS cnt FROM users WHERE user_id =:id");
			$stmt -> bindParam(':id', $id);
			try {
				$stmt -> execute();
			} catch(PDOException $e){
				//$error[0] = 'ID検索に失敗しました' .$e->getMessage();
			}
			$output['cnt'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
			if($output['cnt']!=0){
				$error[0] = "すでに同じidのユーザが存在します"; 
			}
		} 

		$error[1] = $validator -> nullChk($pw);
		if(empty($error[1])) $error[1] = $validator -> alphanumericChk($pw);
		if(empty($error[1])) $error[1] = $validator -> matchChk($pw, $confirm_pw, "パスワード");

		$error[2] = $validator -> nullChk($confirm_pw);
		if(empty($error[2])) $error[2] = $validator -> alphanumericChk($pw);

		$error[3] = $validator -> nulChk($part);

		if(empty($error)){

			$stmt = $conn ->prepare("INSERT INTO users(user_id, user_pw) VALUE(:id, :pw);");
			$stmt2 = $conn ->prepare("INSERT INTO choises(user_id, part_id) VALUE(:id, :part);");
			$stmt -> bindParam(':id', $id);
			$stmt -> bindParam(':pw', $pw);
			$stmt2 -> bindParam(':id', $id);
			$stmt2 -> bindParam(':part', intval($part));
			try {
				$result = $stmt -> execute();
				$result2 = $stmt2 -> execute();
			} catch(PDOException $e){
				echo "インサートに失敗しました";
			}

			if($result && $result2) {
				$_SESSION['id'] = $id;
				$_SESSION['pw'] = hashy($_POST['pw']);
				header("Location: ../index.php");
			}
		}
	}


	//エラーチェック
	if(!empty($_POST['flag'])){
		
		// //IDの入力チェック
		// if(empty(seq($_POST['id']))){
		// 	$error[0] = "IDを入力してください"; 
		// }else if(preg_match('/^[0-9a-zA-Z]+$/', seq($_POST['id'])) == 0){
		// 	$error[0] = "IDは半角英数、記号抜きで入力してください"; 
		// }else{
		// 	//idが一意かどうか
		// 	$sql = "SELECT COUNT(*) AS cnt FROM users WHERE user_id ='".seq($_POST['id'])."'";
		// 	$result = mysql_query($sql);
			
		// 	while($row = mysql_fetch_array($result)){
		// 		$cnt = $row['cnt'];
		// 	}
		// 	if($cnt!=0){
		// 		$error[0] = "すでに同じidのユーザが存在します"; 
		// 	}
		// }

		// //パスワードの入力チェック
		// if(empty(seq($_POST['pw']))){
		// 	$error[1] = "パスワードを入力してください"; 
		// }else if(preg_match('/^[0-9a-zA-Z]+$/', seq($_POST['pw'])) == 0){
		// 	$error[1] = "パスワードは半角英数、記号抜きで入力してください"; 
		// }

		// //確認用パスワードの入力チェック
		// if(empty(seq($_POST['confirm_pw']))){
		// 	$error[2] = "確認用パスワードを入力してください"; 
		// }else if(preg_match('/^[0-9a-zA-Z]+$/', seq($_POST['confirm_pw'])) == 0){
		// 	$error[2] = "パスワードは半角英数、記号抜きで入力してください"; 
		// }else if(seq($_POST['pw']) != seq($_POST['confirm_pw']) ){
		// 	$error[2] = "パスワードが一致しません"; 
		// }

		//部位選択の入力チェック
		// if(empty(seq($_POST['part']))){
		// 	$error[3] = "部位を選択してください"; 
		// }

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
	
