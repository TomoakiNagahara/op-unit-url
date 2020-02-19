<?php
/**
 * unit-url:/DB.trait.php
 *
 * @created   2019-06-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-06-13
 */
namespace OP\UNIT\URL;

/** Used class
 *
 */
use Exception;
use OP\Env;
use OP\Unit;

/** URL
 *
 * @created   2019-06-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
trait OP_UNIT_URL_DB
{
	/** Get DB
	 *
	 * @return \OP\IF_DATABASE
	 */
	static function DB()
	{
		/* @var $_DB \OP\UNIT\Database */
		static $_DB;

		//	...
		if(!$_DB){
			//	...
			$_DB = Unit::Instantiate('Database');

			//	...
			if(!$_DB->Connect( Env::Get('url')['database'] ?? [] ) ){
				throw new Exception("Do selftest!!");
			};
		};

		//	...
		return $_DB;
	}
}
