<?php 
	session_start();
	include_once("controller/login.php");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン</title>
</head>
<body>
		<h1>ログイン画面</h1>
		<form action="login_test_view.php" method="POST">
			ID<input type="text" name="id" value="<?php if (!empty($_POST['id'])){ echo ($_POST['id']); } ?>"><br>
			
			パスワード<input type="password" name="pw" value="<?php if (!empty($_POST['pw'])){ echo ($_POST['pw']); } ?>"><br>
			<div>
				<?php if (!empty($error[0])){ echo ($error[0]); } ?>
			</div>

			<input type="hidden" name="flag" value="1">
			<input type="submit" value="送信" name='login.php'>
		</form>

		<button onClick="location.href='account_test_view.php'">アカウント作成画面へ</button>
</body>
</html>