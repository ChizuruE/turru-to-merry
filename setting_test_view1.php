<?php 
	session_start();
	include_once("controller/chkSession.php");
	include_once("controller/setting.php");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>設定</title>
</head>
<body>
		<h1>設定表示画面</h1>
		<form action="setting_test_view1.php" method="POST">
		<table border="1">
			<tr>
				<td>ID</td>
				<td><?php if (!empty($id)) { echo $id; } ?></td>
			</tr>
			<tr>
				<td>PASS</td>
				<td><?php if (!empty($pw)) { echo "******"; } ?></td>
			</tr>
		</table>
		<input type="hidden" name="flag" value="1">
		<button onClick="location.href='setting_test_view2.php'">パスワード変更</button>	
		</form>
		<form action="setting_test_view1.php" method="POST">
		<table>
			<tr>
				<td>PART</td>
				<td>
					わき<input type="radio" name="part" value="1" <?php if ($part_name == "わき") { echo "checked"; }?>><br>
					うで<input type="radio" name="part" value="2" <?php if ($part_name == "うで") { echo "checked"; }?>><br>
					あし<input type="radio" name="part" value="3" <?php if ($part_name == "あし") { echo "checked"; }?>><br>
				</td>
			</tr>
		</table>
		
		<input type="hidden" name="flag" value="3">
		<button onClick="location.href='setting_test_view1.php'">変更確定</button>
		</form>
		
		<br>
		<button onClick="location.href='main_test_view.php'">メイン画面①へ</button>
		
</body>
</html>
