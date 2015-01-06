<?php 

	include_once("connect.php");
	include_once("secure_common.php");

	//件数を取得
	//user_idから選択された履歴をDB内で検索
	$sql = "SELECT * FROM entrys where user_id='".seq($_SESSION['id'])."' ORDER BY entry_timestamp DESC";
	$result = mysql_query($sql) or exit('entryの抽出に失敗'); //エントリーが15件以内の場合

	$offset = 0;
	$sql_limited = "SELECT * FROM entrys where user_id='".seq($_SESSION['id'])."' ORDER BY entry_timestamp DESC limit 15 offset 0";
	$result_limited = mysql_query($sql_limited) or exit('entryの抽出に失敗'); //エントリーが15件より大きい場合

	// //ボタンが押されたら
	// if(!empty($_POST['flag'])){
		

	// }


	//削除ボタンが押されたら
	if(!empty($_POST['flag_del'])){
		echo "post:".$_POST['flag_del'];
		$sql_del = "DELETE FROM entrys  WHERE entry_timestamp='".$_POST['flag_del']."'";
		$result_del = mysql_query($sql_del) or exit('削除に失敗'); 

		if($result_del){
			echo '削除成功';
			header("Location: rev_test_view.php");
		}else{
			echo '失敗';
		}
	}




?>
	
