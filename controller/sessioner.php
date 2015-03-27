<?php 

class Sessioner{

/* ----------------------------------------------
*  ログインセッションが保持されてるかチェックする
* -----------------------------------------------
*/
public static function chkSession(){
	if(empty($_SESSION["gakusei_no"])){
		header("Location: /test.php");
	}
}

/* ----------------------------------------------
*  Session を開始する
* -----------------------------------------------
*/
public static function open_session() {
	session_start();

	if($_SESSION['valid_user'] == false) {
		$user_id = post_conv($_POST['user_id']);
		$passwd = post_conv($_POST['passwd']);
		if(auth_login($user_id, $passwd)) {
			$_SESSION['valid_user'] = true;
			$_SESSION['user_id'] = $user_id;
			$_SESSION['passwd'] = $passwd;
			$tch_no = auth_get_user();
			$_SESSION['tch_no'] = $tch_no;
			$_SESSION['error_c'] = 0;
		} else {
			if($_SESSION['user_id'] == $user_id) {
				$err_c = $_SESSION['error_c'] = $_SESSION['error_c'] + 1;
					if($_SESSION['error_c'] > 3) {
						header("Location: login_error.php");
						return false;
					}
			} else {
				$err_c = $_SESSION['error_c'] = 0;
			}
			$_SESSION['user_id'] = $user_id;
			$msg = base64_encode('※ユーザＩＤとパスワードでログインして下さい。');
			header("Location: login.php?message=$msg");
		}
	}
}

/* ----------------------------------------------
*  Session をクローズする
* -----------------------------------------------
*/
public static function close_session() {
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy();
	header("Location:/test.php");
}

}
 ?>