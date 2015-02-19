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
	<link rel="stylesheet" type="text/css" href="/css/reset.css" media="all">
	<link rel="stylesheet" type="text/css" href="/css/common.css" media="all">
	<link rel="stylesheet" type="text/css" href="/css/share_main.css" media="all">
	<link rel="stylesheet" type="text/css" href="/css/history.css" media="all">
	<link rel="stylesheet" type="text/css" href="/css/top.css" media="all">
	<link rel="stylesheet" type="text/css" href="/css/data.css" media="all">
	<script type="text/javascript" src="/js/flipsnap.js"></script>
	<script src="/js/jquery-2.1.0.min.js"></script>
<!--	<script src="js/index.js"></script>-->
	<script>
		$(function(){
		});

		$(function(){
    		Flipsnap('.flipsnap');
		})
	</script>
</head>
<body>
<div id="page">
	<div id="wrapper" class="cf" class="viewport">
		<div class="flipsnap">
	
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/inc/history.php'); ?>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/inc/top.php'); ?>
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/inc/data.php'); ?>

		</div>
	
	</div><!-- /#wrapper -->
</div><!-- /#page -->
</body>
</html>