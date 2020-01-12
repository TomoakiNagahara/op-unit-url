<?php
/**
 * unit-url:/TABLE.class.php
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

/** TABLE
 *
 * @created   2019-06-14
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class TABLE
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT_URL_COMMON, OP_UNIT_URL_DB;

	/** Common Ai
	 *
	 * @created  2019-08-15
	 * @param    string      $table
	 * @param    string      $key
	 * @param    string      $val
	 * @param    array       $update
	 * @throws  \Exception
	 * @return   integer     $number
	 */
	static protected function _Ai($table, $key, $val, $update=[])
	{
		//	...
		if( empty($val) ){
			return 0;
		};

		//	...
		if( $table === 't_path' ){
			//	...
			if( $key === 'path' and strpos($val, '/') !== 0 ){
				throw new \Exception("This path is not document root path. ($val)");
			};
		};

		//	...
		$hash = self::Hash($val);

		//	...
		$config = [];
		$config['table'] = $table;
		$config['field'] = 'ai';
		$config['limit'] = 1;
		$config['where']['hash'] = $hash;

		//	...
		if( $record = self::DB()->Select($config) ){
			return $record['ai'];
		}

		//	...
		unset($config['field']);
		unset($config['limit']);
		unset($config['where']);
		$config['set']   = $update;
		$config['set'][] = " hash = $hash ";
		$config['set'][] = " $key = $val  ";

		//	...
		return self::DB()->Insert($config);
	}
}
