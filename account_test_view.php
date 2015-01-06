<?php 
	include_once("controller/account.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>アカウント作成/インサート</title>
</head>
<body>
		<h1>アカウント作成画面</h1>
		<form action="account_test_view.php" method="POST">
			ID<input type="text" name="id" value="<?php if (!empty($_POST['id'])){ echo ($_POST['id']); } ?>"><br>
			<div>
				<?php if (!empty($error[0])){ echo ($error[0]); } ?>
			</div>


			パスワード<input type="password" name="pw" value="<?php if (!empty($_POST['pw'])){ echo ($_POST['pw']); } ?>"><br>
			<div>
				<?php if (!empty($error[1])){ echo ($error[1]); } ?>
			</div>


			確認用<input type="password" onPaste="return false;" name="confirm_pw" value="<?php if (!empty($_POST['confirm_pw'])){ echo ($_POST['confirm_pw']); } ?>"><br>
			<div>
				<?php if (!empty($error[2])){ echo ($error[2]); } ?>
			</div>


			<?php $part = ''?>
			部位
			<input type="radio" name="part" value="1" <?php if($part == '1'){echo 'checked';}?>> わき
			<input type="radio" name="part" value="2" <?php if($part == '2'){echo 'checked';}?>> うで
			<input type="radio" name="part" value="3" <?php if($part == '3'){echo 'checked';}?>> あし
			<br>
			<div>
				<?php if (!empty($error[3])){ echo ($error[3]); } ?>
			</div>

			<input type="hidden" name="flag" value="1">
			<input type="submit" value="送信">
		</form>
</body>
</html>