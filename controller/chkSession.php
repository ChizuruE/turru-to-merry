<?php 
	if(empty($_SESSION['id']) || empty($_SESSION['pw'])){
		header("Location: login_test_view.php");
	}
 ?>