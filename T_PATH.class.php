<?php
/**
 * unit-url:/T_PATH.class.php
 *
 * @created   2019-06-14
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-06-14
 */
namespace OP\UNIT\URL;

/** Used class.
 *
 */
use OP\OP_CORE;

/** T_PATH
 *
 * @created   2019-06-14
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class T_PATH extends TABLE
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT_URL_COMMON, OP_UNIT_URL_DB;

	/** Table name.
	 *
	 * @var string
	 */
	const table = 't_path';

	/** Get ai.
	 *
	 */
	static function Ai($path)
	{
		//	...
		if( strpos($path, '/./') ){
			throw new \Exception("Relative path. ($path)");
		};

		//	...
		if( strpos($path, '/../') ){
			throw new \Exception("Relative path. ($path)");
		};

		//	...
		if( preg_match('/[\'"#]/', $path) ){
			throw new \Exception("Include fragment or Quote. ($path)");
		};

		return self::_Ai(self::table, 'path', $path);
	}
}
