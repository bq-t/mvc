<?
	session_start();

	require_once 'config.php';

	function __autoload($c) {

		if(file_exists("app/controllers/".$c.".php")) {
			require_once "app/controllers/".$c.".php";
		}
		if(file_exists("app/models/".$c.".php")) {
			require_once "app/models/".$c.".php";
		}
		
	}

	if($_GET['route']) {
		$class = trim(strip_tags($_GET['route']));
	}
	else {
		$class = 'main';	
	}

	if(class_exists($class)) {
		
		$obj = new $class;
		$obj->get_body($class);
	}
	else {
		exit("<p>ER404R</p>");
	}