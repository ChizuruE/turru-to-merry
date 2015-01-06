<?php 
	session_start();
	include_once("controller/statistics.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>メイン②</title>
</head>
<body>
		<h1>メイン②画面</h1>
		<span name="your_length">5</label>mm
		<span name="one_length">6</label>mm

		<br>

		<span name="your_count">5</label>回
		<span name="one_count">3</label>回

		<br>

		<button onClick="location.href='main_test_view.php'">←メイン画面①へ</button>
</body>
</html>