<?php 
error_reporting(0);
define("SYSTEM_NAME", "ZECH MVC");
define("BASE_PATH", "http://localhost/zech_mvc/");
define("APP_FOLDER", "system/");
define("VIEWS_FOLDER", "views/");
// GLOBALS DATABASE CONFIG AND OTHERS
	$GLOBALS['config'] = array(
		'mysql' => array(
			'host'         => 'localhost',
			'username'     => 'root',
			'password'     => '',
			'database'	   => 'ehi_db'
		)
	);

// CLASSES AND FUNCTIONS (inside directory)
	define ("VALUE",serialize (array ("my_functions.php")));
	$today = date('H:i:s');
	$date = date('Y-m-d H:i:s', strtotime($today)+28800);

// START THE SESSION
	session_start();


// CONNECT TO DATABASE SERVER
	$database = $GLOBALS['config']['mysql']['database'];
	$host 	  = $GLOBALS['config']['mysql']['host'];
	$username = $GLOBALS['config']['mysql']['username'];
	$password = $GLOBALS['config']['mysql']['password'];

	@mysql_connect($host, $username, $password) or die("Cannot connect to MySQL Server");
	@mysql_select_db($database) or die ("Cannot connect to Database");
	@mysql_query("SET SESSION sql_mode=''");


// INCLUDE ALL FUNCTIONS
	foreach(unserialize(VALUE) as $val){
		if(!empty($val)){
			include  __DIR__ .'/'.$val;
		}
	}


// THIS WILL LOAD ONLY THE NEEDED CLASS
	spl_autoload_register(function($class){
		switch ($class) {
			case 'ModuleClass':
				require_once 'core/classes/module.class.php';
				break;
			default:
				break;
		}
	});
