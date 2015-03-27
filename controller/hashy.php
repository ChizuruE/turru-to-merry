<?php 
class Hashy{
	const SALT_LENGS = 16;

/* ----------------------------------------------
*  ソルトを作る関数
* -----------------------------------------------
*/
	private function make_salt() {
		//16進数
		$salt_words = '0123456789abcdef';
		$max = strlen($salt_words) - 1;
		$salt = '';
		for($i = 0; $i < self::SALT_LENGS; $i++) {
		    $salt .= substr($salt_words, mt_rand(0, $max), 1);
		}
		return $salt;
	}


/* ----------------------------------------------
*  ソルトを生成してパスワードをハッシュ化
* -----------------------------------------------
*/
	public function hash_password($password) {
		$salt = $this->make_salt();
		return $this->hash($password, $salt);
	}


/* ----------------------------------------------
*  パスワード生成のおおもとのメソッド
* -----------------------------------------------
*/
	public function make_password($password = null) {

		if(empty($password)) {
			//パスワードを生成する
			$password_words = '0123456789abcdefghijklmnopqrstuvwxyz';
			$max = strlen($password_words) - 1;
			$first_password = "";

			//取りあえず8文字ランダムで
			for($i = 0; $i < 8; $i++) {
				$first_password .= substr($password_words, mt_rand(0, $max), 1);
			}

		} else {
			$first_password = $password;
		}

		//DBインサート用のパスワードを生成
		$insert_password = $this -> hash_password($first_password);

	}

/* ----------------------------------------------
*  
* -----------------------------------------------
*/
	private function hash($password, $salt) {
		//ソルト＋ハッシュ（パスワード＋ソルト）
		return $salt . hash('sha256', $password . $salt);
	}



}

?>