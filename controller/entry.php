<?php 

	include_once("connect.php");
	include_once("secure_common.php");

	if(!isset($_POST['flag'])){$_POST['flag']="";}//なんでこれだけnoticeでるの…
	
	//user_idから選択された部位をDB内で検索
	$sql = "SELECT * FROM choises where user_id='".seq($_SESSION['id'])."'";
	$result = mysql_query($sql) or exit('IDの抽出に失敗');
	if(mysql_num_rows($result)==1){
		//echo "ユーザ認証できました。{$_SESSION['id']}様のページです。<br>";

		//user_idからpart_idを取得
		$row = mysql_fetch_array($result, MYSQL_ASSOC); //このへんの指定がおかしい？
		//while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	    	$_SESSION['part_id']  = $row['part_id']; 
	        //echo "あなたの部位が確認できました。{$_SESSION['part_id']}があなたの部位です。<br>";
    	//}

	}else if(mysql_num_rows($result)==0){
		echo 'IDないやないか';
	}else{
		echo 'IDいっぱいあるやないかやり直し';
	}




//経過日数を計算し表示させる

	//最新の剃りtimestampを取得
	$sql = "SELECT * FROM entrys WHERE user_id='".seq($_SESSION['id'])."' ORDER BY entry_timestamp DESC limit 1";
	$result = mysql_query($sql) or exit('DB検索失敗');

	if(mysql_num_rows($result)==0){
		//echo "DB検索の結果、user_idさんは一度もエントリーしていません";
	}else if(mysql_num_rows($result)==1){ //ちゃんと1件だけ取得できてる
		//echo 'DB検索の結果、最新のデータを1件取り出しました。<br>';
		$row = mysql_fetch_array($result, MYSQL_ASSOC);			
	    $rev  = $row['entry_timestamp']; 
	    //echo "剃り履歴：{$rev}<br>";

    	//String型からDateTime型に変換
    	$rev = new DateTime($rev);

    	//今日の日付を取得
    	$now = new DateTime();
    	//echo $now->format('Y-m-d H:i:sP') . "\n";

    	//差分を取得
    	//$interval = $rev->diff($now);
    	//$interval = substr($interval->format('%R%a'), 1); //String型にする
    	$interval = substr($rev->diff($now)->format('%R%a'), 1); //差分とってString型ににして「+」をとる
    	//echo $interval; //画面に表示させる差分

	}else{
		echo '１件だけ取得してるのにいっぱいとかおかしい';
	}




    //ボタンが押されたら
	if(!empty($_POST['flag'])){

		//送られてきたentryデータをDBにインサート
		$sql =  "INSERT INTO entrys(hair_id, part_id, user_id) VALUE('". seq($_POST['hair_id'])."','". seq($_SESSION['part_id'])."','". seq($_SESSION['id'])."');";
		$result = mysql_query($sql) or exit("データの抽出に失敗しました。");

		if($result){ //0じゃないならインサート成功

			//①メイン画面に出す経過日数をリセット（最新の剃りtimestampを取得）
			$sql = "SELECT * FROM entrys WHERE user_id='".seq($_SESSION['id'])."' ORDER BY entry_timestamp DESC limit 1";
			$result = mysql_query($sql) or exit('DB検索失敗');

			if(mysql_num_rows($result)==0){
				echo "DB検索の結果、user_idさんは一度もエントリーしていません";
			}else if(mysql_num_rows($result)==1){ //ちゃんと1件だけ取得できてる
				$row = mysql_fetch_array($result, MYSQL_ASSOC);			
			    $rev  = $row['entry_timestamp']; 
		    	$rev = new DateTime($rev);
		    	$now = new DateTime();
		    	$interval = substr($rev->diff($now)->format('%R%a'), 1); //差分とってString型ににして「+」をとる
		    	//echo $interval; //画面に表示させる差分


		    //②changesテーブルに差分と長さを格納（１日あたりの発毛スピード計算用：statistics.php用）
		    $sql = "SELECT * FROM entrys WHERE user_id='".seq($_SESSION['id'])."'";
		    $result = mysql_query($sql);
		    if(mysql_num_rows($result) < 2){ //エントリー数が2個以下

		    }else{
		    	$sql = "SELECT * FROM entrys WHERE user_id='".seq($_SESSION['id'])."' ORDER BY entry_timestamp DESC limit 2";
		    	$result = mysql_query($sql) or exit('DB検索失敗');
		    	$cnt = 0;
		    	while($row = mysql_fetch_array($result)){
		    		if($cnt==0){
		    			$entryNew = $row['entry_timestamp'];//最新
		    			$newHair = $row['hair_id'];//最新エントリ時の長さ
		    		}else{
		    			$entryNewSecond = $row['entry_timestamp'];//２番目に新しい
		    		}
		    		$cnt++;
		    	}
		    	$revNewest = new DateTime($entryNew);//最新
		    	$revNewSecond = new DateTime($entryNewSecond);//２番目に新しい
		    	$diff = substr($revNewest->diff($revNewSecond)->format('%R%a'), 1); //差分とってString型ににして「+」をとる
		    	echo $diff;

		    	//hair_idからhair_lengthを取得
		    	$sqlHair = "SELECT * FROM hairs WHERE hair_id='".$newHair."'";
		    	$resultHair = mysql_query($sqlHair) or exit('DB検索失敗');
		    	if(mysql_num_rows($resultHair) == 1){
		    		$rowLength = mysql_fetch_array($resultHair, MYSQL_ASSOC);
		    		$hairLength  = $rowLength['hair_length']; 

		    		//changesテーブルに差分と長さを格納
		    		$sqlChanges =  "INSERT INTO changes(change_id, change_period, hair_length, user_id) VALUE('". '' ."','". $diff."','". $hairLength."','".seq($_SESSION['id'])."');";
		    		$resultChanges = mysql_query($sqlChanges) or exit('DBインサート失敗');

		    		if($resultChanges){ //0じゃないならインサート成功
		    			echo '成功！！！';
		    		}else{
		    			echo '失敗…';
		    		}

		    	}else{
		    		echo 'hair_lengthがみつかりません';
		    	}

		    	
		    }



			}else{
				echo '１件だけ取得してるのにいっぱいとかおかしい';
			}
				//メイン画面に遷移
				//header("Location: main_test_view.php");
				//exit;
		}else{ //0なら失敗
			// echo 'id：'.seq($_POST['id']).'<br>';
			// echo 'パスワード：'.hashy($_POST['pw']).'<br>';
			// echo '$result：'.mysql_num_rows($result).'<br>';
			echo 'インサート失敗';
		}

	}else{
		// echo 'ボタン押されてないよ';
	}

	



?>
	
