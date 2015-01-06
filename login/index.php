<?php 
    session_start();
	include_once('../'."controller/login.php");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
	<meta name="format-detection" content="telephone=no,address=no,email=no">
	<title>ログイン</title>
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
                    <h1><img src="img/title_login.png" width="100%" height="auto" alt="LOGIN"></h1>
                    <form action="./" method="POST">
                        <fieldset>
                            <ul>
                                <li>
                                	<span>ID</span>
                                	<input type="text" name="id" value="<?php if (!empty($_POST['id'])){ echo ($_POST['id']); } ?>">
                                </li>
                                <li>
                                	<span>PASS</span>
                                	<input type="password" name="pw" value="<?php if (!empty($_POST['pw'])){ echo ($_POST['pw']); } ?>">
                                </li>
                            </ul>
                            <p class="er"><?php if (!empty($error[0])){ echo ($error[0]); } ?></p>
                        <div class="btns">
                        <input type="hidden" name="flag" value="1">
                        <input type="image" name="login" src="/login/img/btn_login.png" alt="ログイン">
                        <input type="image" name="account" src="/login/img/btn_signup.png" alt="アカウント作成" formaction="/start/">
                        </div>
                        </fieldset>
                    </form>
                </div>
		</div><!-- /.addHeader -->
	</div><!-- /#wrapper -->
	<?php include_once('../common/inc/footer.php'); ?>
</div><!-- /#page -->
</body>
</html>