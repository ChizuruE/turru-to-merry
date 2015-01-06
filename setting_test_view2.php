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
		<h1>設定編集画面</h1>
		<form action="setting_test_view2.php" method="POST">
			<table border="1">
				<tr>
					<td>現在のパスワード</td>
					<td><input type="password" name="pw" value="<?php if (!empty($_POST['pw'])){ echo ($_POST['pw']); } ?>"></td>
				</tr>
				<tr>
					<td>新しいパスワード</td>
					<td><input type="password" name="new_pw" value="<?php if (!empty($_POST['new_pw'])){ echo ($_POST['new_pw']); } ?>"></td>
				</tr>
				<tr>
					<td>パスワード確認用</td>
					<td><input type="password" name="confirm_pw" value="<?php if (!empty($_POST['confirm_pw'])){ echo ($_POST['confirm_pw']); } ?>"></td>
				</tr>
			</table>
			<div>
				<?php if (!empty($error[0])){ echo ($error[0]."<br>"); } ?>
				<?php if (!empty($error[1])){ echo ($error[1]."<br>"); } ?>
				<?php if (!empty($error[2])){ echo ($error[2]."<br>"); } ?>
			</div>
			<input type="hidden" name="flag" value="2">
			<button onClick="location.href='setting_test_view1.php'">確定</button>
		</form>
</body>
</html>