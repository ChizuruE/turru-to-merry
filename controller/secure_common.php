<?php 
	function seq($data){
		return htmlspecialchars($data,ENT_QUOTES,'UTF-8');
	}

	function hashy($data){
		return substr(crypt(seq($data),'se'),2);
	}
 ?>