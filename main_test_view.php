<!-- 変更 -->

<?php 
	session_start();
	include_once("controller/chkSession.php");
	include_once("controller/entry.php");
	// include_once("controller/statistics.php");

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>メイン画面/インサート</title>
</head>
<body>
		<h1>メイン画面</h1>

		<form action="main_test_view.php" method="POST">
			<div><span name="passed"><?php if (isset($interval)){ echo ($interval); } ?></span>日経過</div><br>

			<input type="radio" name="hair_id" value="1"> 短い
			<input type="radio" name="hair_id" value="2" checked>普通
			<input type="radio" name="hair_id" value="3"> 長い
			<br>

			<input type="hidden" name="flag" value="1">
			<input type="submit" value="送信" name='entry.php'>
		</form>

		<br>
			<button onClick="location.href='setting_test_view1.php'">設定画面へ</button>
		<br>
		
		<button onClick="location.href='rev_test_view.php'">←履歴︎へ</button>
		<button onClick="location.href='sub_test_view.php'">︎︎︎メイン画面②へ→</button>


	
</body>
</html>