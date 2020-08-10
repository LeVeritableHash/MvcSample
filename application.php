<?php
session_start();
ob_start();
define('root', __dir__);
define('siteurl', "http://localhost/mvc/");
define('project', "000");
require 'app/autoloader.php';
Autoloader::register();

$Database = new app\database('localhost','root','','demo');


	$array = array(
		'demo' => 'core/controller/demo.php',
	);
	$Mvc = new app\mvc($array);


require root.'/'.$Mvc->PagePath;
$Listener=ob_get_clean();
if(is_array($Mvc->Replace)):
foreach($Mvc->Replace as $key => $value):
	$Listener = str_replace($key, $value, $Listener);
endforeach;
endif;
echo $Listener;
?>