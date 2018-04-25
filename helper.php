<?php
//助手载入函数
$_helper=array();

function helper($helpers){
	if(is_array($helpers)){
		foreach ($helpers as $value) {
			helper($value);
		}
		return 'cc';
	}

	if(isset($_helper[$helpers])){
		return 'aa';
	}

	$helper_path=realpath(str_replace("\\", '/', dirname(__FILE__)));
	if(file_exists($helper_path.'/helper/'.$helpers.'.helper.php')){
		include_once($helper_path.'/helper/'.$helpers.'.helper.php');
		$_helper[$helpers]=true;
	}

	if(!isset($_helper[$helpers])){
		return false;
	}
	return 'bb';
}