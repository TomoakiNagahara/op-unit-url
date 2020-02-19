<?php
/**
 * unit-url:/autoloader.php
 *
 * @created   2019-06-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
//	...
spl_autoload_register( function($name)
{
	//	...
	if( 0 !== strpos($name, 'OP\UNIT\URL') ){
		return;
	};

	//	...
	$temp = explode('\\', $name);

	//	...
	switch( array_pop($temp) ){
		case 'URL':
			$path  = __DIR__."/URL.class.php";
			break;

		case 'OP_UNIT_URL':
			$path  = __DIR__."/URL.trait.php";
			break;

		case 'OP_UNIT_URL_COMMON':
			$path  = __DIR__."/Common.trait.php";
			break;

		case 'OP_UNIT_URL_DB':
			$path  = __DIR__."/DB.trait.php";
			break;

		case 'TABLE':
			$path  = __DIR__."/TABLE.class.php";
			break;

		case 'T_URL':
			$path  = __DIR__."/T_URL.class.php";
			break;

		case 'T_HOST':
			$path  = __DIR__."/T_HOST.class.php";
			break;

		case 'T_PATH':
			$path  = __DIR__."/T_PATH.class.php";
			break;

		case 'T_QUERY':
			$path  = __DIR__."/T_QUERY.class.php";
			break;

		case 'T_FORM':
			$path  = __DIR__."/T_FORM.class.php";
			break;

		case 'T_AUTH':
			$path  = __DIR__."/T_AUTH.class.php";
			break;

		case 'Selftest':
			$path  = __DIR__."/Selftest.class.php";
			break;

		default:
	};

	//	...
	if( empty($path) ){
		return;
	};

	//	...
	if( file_exists($path) ){
		include($path);
	}else{
		OP\Notice::Set("Does not exists this file. ($path)");
	};
});
