<?php

class Autoloader
{
	static function register(){
		spl_autoload_register(array(__CLASS__,'Autoload'));
	}
	static function Autoload($ClassName){
		require root.'/'.str_replace('\\', '/', $ClassName).'.php';
	}
}