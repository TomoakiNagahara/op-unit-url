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
	 */
	static protected function _Ai($table, $key, $val)
	{
		//	...
		if( empty($val) ){
			return 0;
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
		$config['set'][] = " hash = $hash ";
		$config['set'][] = " $key = $val  ";

		//	...
		return self::DB()->Insert($config);
	}
}
