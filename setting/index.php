<?php 
	session_start();
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
				<h1><img src="img/title_setting.png" width="100%" height="auto" alt="NEW USER"></h1>
				
					<fieldset>
						<ul>
							<li><span>ID</span><span class="txt"><?php if (!empty(seq($_SESSION['id']))){ echo (seq($_SESSION['id'])); } ?></span></li>
							<li><span>PASS</span><span class="txt">***********</span></li>
						</ul>

						<a href="/pass/index.php"><input type="image" src="img/btn_setting_4.png" alt="パスワード変更"></a>

				<form action="." method="POST">
						<ul>
							<li class="radio">
								<span>PART</span>
								<div>
									<p>管理する選択部位</p>
									<label><input type="radio" name="part" value="1" <?php if ($part_name == "わき") { echo "checked"; }?> >わき</label>
									<label><input type="radio" name="part" value="2" <?php if ($part_name == "うで") { echo "checked"; }?> >うで</label>
									<label><input type="radio" name="part" value="3" <?php if ($part_name == "あし") { echo "checked"; }?> >あし</label>
								</div>
							</li>
						</ul>
					</fieldset>
				
					<input type="hidden" name="flag" value="1">
					<input type="image" src="img/btn_setting_3.png" alt="変更確定">
				</form>
				<a href="../"><img src="/setting/img/btn_back_2.png" alt="" width="37px" height="52px"></a>
			</div><!-- /.main -->
		</div><!-- /.addHeader -->
	</div><!-- /#wrapper -->
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/common/inc/footer.php'); ?>
</div><!-- /#page -->
</body>
</html>