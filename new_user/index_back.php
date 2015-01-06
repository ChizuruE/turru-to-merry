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
				<h1><img src="img/title_new_user.png" width="100%" height="auto" alt="NEW USER"></h1>
				<form action="">
					<fieldset>
						<ul>
							<li>
								<span>ID</span>
								<input type="text" placeholder="○○文字以上">
								<p class="er">※IDを入力してください。</p>
							</li>
							<li>
								<span>PASS</span>
								<input type="password" placeholder="半角英数○〜○文字">
								<p class="er">※パスワードを入力してください。</p>
							</li>
							<li class="confirm">
								<span>確認用</span>
								<input type="password" placeholder="再度パスワードを入力してください">
								<p class="er">※パスワードが相違しています。</p>
							</li>
							<li class="radio">
								<span>PART</span>
								<div class="radio">
									<p>管理する選択部位</p>
									<label><input type="radio" name="part">わき</label>
									<label><input type="radio" name="part">うで</label>
									<label><input type="radio" name="part">あし</label>
								</div><!-- /.radio -->
								<p class="er">※部位を選択してください。</p>
							</li>
						</ul>
					</fieldset>
					<input type="image" src="img/btn_signup.png" alt="アカウント作成">
				</form>
			</div><!-- /.main -->
		</div><!-- /.addHeader -->
	</div><!-- /#wrapper -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/common/inc/footer.php'); ?>
</div><!-- /#page -->
</body>
</html>