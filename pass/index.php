<?php 
	session_start();
	include_once('../'."controller/chkSession.php");
	include_once('../'."controller/setting.php");
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
	<meta name="format-detection" content="telephone=no,address=no,email=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://mplus-fonts.sourceforge.jp/webfonts/mplus_webfonts.css">
	<link rel="stylesheet" type="text/css" href="/common/css/reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="/common/css/common.css" media="all">
	<link rel="stylesheet" type="text/css" href="/common/css/info.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/index.css" media="all">
	<script src="/common/js/jquery-2.1.0.min.js"></script>
	<script>
		$(function(){
		});
	</script>
</head>
<body>
<div id="page">
	<div id="wrapper">
		<div class="addHeader">
			<div class="main info">
				<h1><img src="img/title_setting_2.png" width="100%" height="auto" alt="NEW USER"></h1>
				<form action="./" method="POST">
					<fieldset>
						<ul>
							<li>
								<span>現在パスワード</span>
								<input type="password" placeholder="○○文字以上" name="pw" value="<?php if (!empty($_POST['pw'])){ echo ($_POST['pw']); } ?>">
								<p class="er"><?php if (!empty($error[0])){ echo ($error[0]."<br>"); } ?></p>
							</li>
							<li>
								<span>新しいパスワード</span>
								<input type="password" placeholder="半角英数○〜○文字" name="new_pw" value="<?php if (!empty($_POST['new_pw'])){ echo ($_POST['new_pw']); } ?>">
								<p class="er"><?php if (!empty($error[1])){ echo ($error[1]."<br>"); } ?></p>
							</li>
							<li class="confirm">
								<span>パスワード確認用</span>
								<input type="password" placeholder="再度パスワードを入力してください" name="confirm_pw" value="<?php if (!empty($_POST['confirm_pw'])){ echo ($_POST['confirm_pw']); } ?>">
								<p class="er"><?php if (!empty($error[2])){ echo ($error[2]."<br>"); } ?></p>
							</li>
						</ul>
					</fieldset>
					<input type="hidden" name="flag" value="2">
					<input type="image" src="img/btn_setting_5.png" alt="確定">
				</form>
				<a href="../setting/index.php"><img src="/setting/img/btn_back_2.png" alt="" width="37px" height="52px"></a>
			</div><!-- /.main -->
		</div><!-- /.addHeader -->
	</div><!-- /#wrapper -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/common/inc/footer.php'); ?>
</div><!-- /#page -->
</body>
</html>