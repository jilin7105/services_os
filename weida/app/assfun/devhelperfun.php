<?php
	function dd(){
		var_dump(func_get_args());die;
	}


	function redict($url){
		header("Location: $url");die;
	}