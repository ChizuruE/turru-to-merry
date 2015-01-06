<?php 
	
	include_once("connect.php");
	include_once("secure_common.php");	

	//１日あたりの発毛スピード
		//あなたの経過日数はDBから引っ張ってくる
		$sql = "SELECT * FROM changes WHERE user_id='".seq($_SESSION['id'])."'";
		$result = mysql_query($sql) or exit('changesテーブル検索失敗');

		$sum = 0;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$period = $row['change_period']; //経過日数
			$theHairLength = $row['hair_length']; //最新のエントリー時の長さ
			if($period != 0){ //経過日数が0の場合
				$sum += $theHairLength / $period;
			}else{ //経過日数が0でも1に直してる（要検討）
				$sum += $theHairLength / ($period+1);
			}
		}

		$mySpeed = $sum / mysql_num_rows($result);
		echo $mySpeed."mm:あなたの発毛スピード<br>";


		//みんなの経過日数の計算もDBから引っ張ってくる
		$sql = "SELECT * FROM users";
		$results = mysql_query($sql) or exit('usersテーブル検索失敗(New)');
		$usersNumber = mysql_num_rows($results); //ユーザ数

		$sum = 0;//全ユーザの合計長さを格納
		while ($rowUsers = mysql_fetch_array($results, MYSQL_ASSOC)) {
			$eachUserId = $rowUsers['user_id'];
			//echo $eachUserId."：ユーザID<br>";

			$sql = "SELECT * FROM changes WHERE user_id='".$eachUserId."'";
			$result = mysql_query($sql) or exit('changesテーブル検索失敗');

			
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$period = $row['change_period']; //経過日数
				$theHairLength = $row['hair_length']; //最新のエントリー時の長さ
				if($period != 0){ //経過日数が0の場合
					$sum += $theHairLength / $period;
				}else{ //経過日数が0でも1に直してる（要検討）
					$sum += $theHairLength / ($period+1);
				}
			}
		}
		$yourSpeed = $sum / mysql_num_rows($results);
		echo $yourSpeed."mm:みんなの発毛スピード<br>";




















	//剃る頻度(1週間あたり)計算
		//自分のこと
			//差分＝最後にエントリーした日ー初めてエントリーした日
			$sqlNew = "SELECT * FROM entrys WHERE user_id='".seq($_SESSION['id'])."' ORDER BY entry_timestamp ASC limit 1";//最初にエントリーした日
			$sqlOld = "SELECT * FROM entrys WHERE user_id='".seq($_SESSION['id'])."' ORDER BY entry_timestamp DESC limit 1";//最後にエントリーした日
			$resultNew = mysql_query($sqlNew) or exit('DB検索失敗(New)');
			$resultOld = mysql_query($sqlOld) or exit('DB検索失敗(Old)');

			if(mysql_num_rows($resultNew)==0){//0件のとき
				//echo "DB検索の結果!user_idさんは一度もエントリーしていません";
				$myWeekCount = 0;
			}else if(mysql_num_rows($resultNew)>1 || mysql_num_rows($resultNew)>1){//1件だけ引っ張ってきたはずなのに複数引っ張られたとき
				//echo '１件ずつだけ取得してるのにいっぱいとかおかしい';
				$myWeekCount = 0;
			}else{
				//Newのtimestampを取得
				$rowNew = mysql_fetch_array($resultNew, MYSQL_ASSOC);			
			    $revNew  = $rowNew['entry_timestamp']; 
			    $revNew = new DateTime($revNew);
		    	//echo $revNew->format('Y-m-d H:i:sP') . "\n";

		    	//echo '<br>';
		    	//Oldのtimestampを取得
		    	$rowOld = mysql_fetch_array($resultOld, MYSQL_ASSOC);			
			    $revOld  = $rowOld['entry_timestamp']; 
			    $revOld = new DateTime($revOld);
		    	//echo $revOld->format('Y-m-d H:i:sP') . "\n";

		    	if($revNew == $revOld){//古いデータと新しいデータが完全一致してたら（今まで１回しかエントリーしていないということ）
		    		//echo '今まで一度しかエントリーしていないため統計がとれません';
		    		$myWeekCount = 0;
		    	}else{
					//echo '<br>';

			    	$dif = (int)(substr($revNew->diff($revOld)->format('%R%a'), 1)); //差分とってString型ににして「+」をとる
			    	//echo $dif;
			    	//echo gettype((int)$dif);//差分(int型)

			    	//echo '<br>';
					//今までエントリーした全回数
					$sql = "SELECT * FROM entrys WHERE user_id='".seq($_SESSION['id'])."'";
					$result = mysql_query($sql) or exit('DB検索失敗');
					$count = mysql_num_rows($result);

					//echo '<br>';
					//一応全件の中身を確認
					//while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				    //    echo "{$row['entry_timestamp']}にエントリーしています<br>";
			    	//}

			    	if($dif != 0){
			    		$myWeekCount = $count / $dif * 7 ; //全回数 ÷ 差分 * 7で１週間にどれぐらい剃ってるかが分かる
			    	}else{
			    		$myWeekCount = $count / ($dif+1) * 7 ; //全回数 ÷ 差分 * 7で１週間にどれぐらい剃ってるかが分かる【要検討】
			    	}
				}
			}
			echo $myWeekCount."回：あなた四捨五入前<br>";
			$myWeekCount = round($myWeekCount, 1);//小数点第一で四捨五入
			echo $myWeekCount."回：あなた";
			echo "<br>";
		//自分のこと終わり
			//echo '<br>';echo '<br>';echo '<br>';echo '<br>';


		//全体ユーザのこと
			//まずusersテーブルから各user_idwひっぱってくる
			//引っ張ってきたuser_idをキーに最新と最古のentryデータを取得し上記と同様に計算
			//出てきた値を全部足していく$sum
			//最後に全体のユーザ数で割る
			$sql = "SELECT * FROM users";
			$results = mysql_query($sql) or exit('usersテーブル検索失敗(New)');
			$usersNumber = mysql_num_rows($results); //ユーザ数
			//echo $usersNumber."人<br>";


			$sumWeekCount = 0;
			while ($rowUsers = mysql_fetch_array($results, MYSQL_ASSOC)) {
				$eachUserId = $rowUsers['user_id'];
				//echo $eachUserId."：ユーザID<br>";

				//差分＝最後にエントリーした日ー初めてエントリーした日
				$sqlNew = "SELECT * FROM entrys WHERE user_id='".$eachUserId."' ORDER BY entry_timestamp ASC limit 1";//最初にエントリーした日
				$sqlOld = "SELECT * FROM entrys WHERE user_id='".$eachUserId."' ORDER BY entry_timestamp DESC limit 1";//最後にエントリーした日
				$resultNew = mysql_query($sqlNew) or exit('DB検索失敗(New)');
				$resultOld = mysql_query($sqlOld) or exit('DB検索失敗(Old)');

				if(mysql_num_rows($resultNew)==0){//0件のとき
					//echo "DB検索の結果!".$eachUserId."さんは一度もエントリーしていません";
					//echo '<br>';
					$yourWeekCount = 0;
				}else if(mysql_num_rows($resultNew)>1 || mysql_num_rows($resultNew)>1){//1件だけ引っ張ってきたはずなのに複数引っ張られたとき
					//echo '１件ずつだけ取得してるのにいっぱいとかおかしい';
					//echo '<br>';
					$yourWeekCount = 0;
				}else{
					//Newのtimestampを取得
					$rowNew = mysql_fetch_array($resultNew, MYSQL_ASSOC);			
				    $revNew  = $rowNew['entry_timestamp']; 
				    $revNew = new DateTime($revNew);
			    	//echo $revNew->format('Y-m-d H:i:sP') . "\n";

			    	//echo '<br>';
			    	//Oldのtimestampを取得
			    	$rowOld = mysql_fetch_array($resultOld, MYSQL_ASSOC);			
				    $revOld  = $rowOld['entry_timestamp']; 
				    $revOld = new DateTime($revOld);
			    	//echo $revOld->format('Y-m-d H:i:sP') . "\n";

			    	if($revNew == $revOld){//古いデータと新しいデータが完全一致してたら（今まで１回しかエントリーしていないということ）
			    		//echo '今まで一度しかエントリーしていないため統計がとれません';
			    		//echo '<br>';
			    		$yourWeekCount = 0;
			    	}else{
						//echo '統計がとれます<br>';

				    	$dif = (int)(substr($revNew->diff($revOld)->format('%R%a'), 1)); //差分とってString型ににして「+」をとる
				    	//echo $dif."日";//差分(int型で○日)

				    	//echo '<br>';
						//今までエントリーした全回数
						$sql = "SELECT * FROM entrys WHERE user_id='".$eachUserId."'";
						$result = mysql_query($sql) or exit('DB検索失敗');
						$count = mysql_num_rows($result);

						//echo '<br>';
						if($dif!=0){
				    		$yourWeekCount = $count / $dif * 7 ; //全回数/差分*7で１週間にどれぐらい剃ってるかが分かる
				    	}else{
				    		$yourWeekCount = $count / ($dif+1) * 7 ;//要検討
				    	}
				    	//echo $yourWeekCount;
					}
				}
				//echo $yourWeekCount."回<br>";
				$sumWeekCount += $yourWeekCount;
			}
			
			$averageCount = $sumWeekCount / $usersNumber;
			echo $averageCount."回：みんなの平均四捨五入前<br>";
			$averageCount = round($averageCount, 1);//小数点第一で四捨五入
			echo $averageCount."回：みんなの平均";


		//全体ユーザのこと終わり

 ?>



