<?php

// $url = urlencode(serialize($array));

$uri = $_SERVER['REQUEST_URI'];
$request = explode('?', $_SERVER['REQUEST_URI'], 2);
$routes = str_replace("/zech_mvc/system", "", $request[0]);
$par_data = unserialize(urldecode($_GET[q]));

$error_file = VIEWS_FOLDER.'error.php';
if($routes == '/' || $routes == '' || $routes == '/home'){
	$views_file = VIEWS_FOLDER.'home.php';
	$active_li = "home";
	$folder_file = "home";
}


/*
	START OF MODULE
*/
else if($routes == '/module-link'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/module_view.php';
	$active_li = trim($routes,'/');
}
/*
	END OF MODULE
*/

else{
	$views_file = $error_file;
}

$restricted_li = array(
	'min-sidebar'
);

$tree_module = array(
	'module-link'
);