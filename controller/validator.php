<?php 
class Validator{
/* ----------------------------------------------
*  必須チェック
* -----------------------------------------------
*/
public static function nullChk($data){
	if(empty($data)) {
		return "未入力です";
	} 
	return '';
}

/* ----------------------------------------------
*  半角英数記号抜きチェック
* -----------------------------------------------
*/
public static function alphanumericChk($data){
	if(!(preg_match('/^[0-9a-zA-Z]+$/', $data))) {
		return "半角英数、記号抜きで入力してください";
	}
	return '';
}

/* ----------------------------------------------
*  不正なメールアドレスか否か
* -----------------------------------------------
*/
public static function mailChk($mail){
	if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		return "メールアドレスが不正です";
	}
	return '';
}

/* ----------------------------------------------
*  文字数チェック（下限と上限チェック）
* -----------------------------------------------
*/
public static function charLimitChk($data, $lower, $upper){	//データ、下限、上限
	if(mb_strlen($data, "UTF-8") > $upper || mb_strlen($data, "UTF-8") < $lower) {
		return $lower."文字以上".$upper."文字以内のみ有効です";
	}
	return '';
}

/* ----------------------------------------------
*  一致しているかどうかのチェック
* -----------------------------------------------
*/
public static function matchChk($data_a, $data_b, $target){	//データ1,データ2,比較対象(パスワードなど)
	if($data_a != $data_b) {
		return $target."が一致しません";
	}
	return '';
}

/* ----------------------------------------------
*  
* -----------------------------------------------
*/
public static function existErrChk($error){
	$flag = true;
	foreach($error as $key => $val){
		if(!empty($val)){
			$flag = false;
		}
	}
	return $flag;
}

}

 ?>