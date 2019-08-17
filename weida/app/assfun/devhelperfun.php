<?php
	function dd(){
		var_dump(func_get_args());die;
	}


	function redirect($url){
		header("Location: $url");die;
	}