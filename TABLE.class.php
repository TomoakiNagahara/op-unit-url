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
		$config = [];

		//	...
		$hash = self::Hash($val);

		//	...
		switch( $table ){
			case 't_scheme':
				unset($hash);
				$config['where']['scheme'] = $val;
				break;

			case 't_path':
				//	...
				if( $key === 'path' and strpos($val, '/') !== 0 ){
					throw new \Exception("This path is not document root path. ($val)");
				};
				break;
		};

		//	...
		$config['table'] = $table;
		$config['field'] = 'ai';
		$config['limit'] = 1;
		$config['cache'] = 60 * 60 * 24 * 1;
		if( $hash ?? null ){ $config['where']['hash'] = $hash; }

		//	...
		if( $ai = self::DB()->Select($config) ){
			return $ai;
		}

		//	...
		unset($config['field']);
		unset($config['limit']);
		unset($config['where']);
		$config['set']   = $update;
		$config['set'][] = " $key = $val  ";
		if( $hash ?? null ){ $config['set'][] = " hash = $hash "; }

		//	...
		if( $table === 't_host' ){
			$created = gmdate(_OP_DATE_TIME_);
			$config['set'][] = " created = {$created} ";
		}

		//	...
		return self::DB()->Insert($config);
	}

	/** Get record by condition.
	 *
	 * @created  2019-09-06
	 * @param    string      $table
	 * @param    array       $condition
	 * @return   array       $record
	 */
	static function _Get($table, $condition)
	{
		//	...
		$limit = $condition['limit'] ?? 1;
		$order = $condition['order'] ?? null;

		//	...
		unset($condition['limit']);
		unset($condition['order']);

		//	...
		$config = [];
		$config['table'] = $table;
		$config['limit'] = $limit;
		$config['where'] = $condition;
		$config['order'] = $order;

		//	...
		return self::DB()->Select($config);
	}

	/** Update
	 *
	 * @created  2019-08-15
	 * @param    string      $table
	 * @param    integer     $ai
	 * @param    array       $update
	 * @return   integer     $number
	 */
	/*
	static protected function _Update($table, $ai, $update)
	{
		//	...
		$config = [];
		$config['table'] = $table;
		$config['limit'] = 1;
		$config['where']['ai'] = $ai;
		$config['set']   = $update;

		//	...
		return self::DB()->Update($config);
	}
	*/

	/** Delete
	 *
	 * @created  2019-09-06
	 * @param    integer     $ai
	 * @return   boolean     $io
	 */
	static function _Delete($table, $ai)
	{
		//	...
		$config = [];

		//	...
		$config['table'] = $table;
		$config['limit'] = 1;
		$config['where']['ai'] = $ai;

		//	...
		return self::DB()->Delete($config);
	}
}
