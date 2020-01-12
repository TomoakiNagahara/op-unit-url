<?php
/**
 * unit-url:/T_URL.class.php
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

/** T_URL
 *
 * @created   2019-06-14
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class T_URL
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT_URL_COMMON, OP_UNIT_URL_DB;

	/** Table name.
	 *
	 * @var string
	 */
	const table = 't_url';

	/** Get ai.
	 *
	 * @created  2019-06-14
	 */
	static function Ai($scheme, $host, $path, $query, $form, $auth)
	{
		//	...
		$config = [];
		$config['table'] = self::table;
		$config['field'] = 'ai';
		$config['limit'] = 1;
	//	$config['where']['scheme']= $scheme;
		$config['where']['host' ] = $host ;
		$config['where']['path' ] = $path ;
		$config['where']['query'] = $query;
		$config['where']['form' ] = $form ;

		//	...
		if( $auth ){
			$config['where']['auth' ] = $auth ;
		};

		//	...
		if( $record = self::DB()->Select($config) ){
			return $record['ai'];
		};

		//	...

		//	...
		$config['set'] = $config['where'] ;
		$config['set']['scheme'] = $scheme;
		$config['set']['auth' ]  = $auth  ;

		//	...
		$config['update']['auth'] = $auth ;

		//	...
		unset($config['where']);
		unset($config['limit']);
		unset($config['field']);

		//	...
		return self::DB()->Insert($config);
	}

	/** Update
	 *
	 * @created  2019-06-14
	 * @updated  2019-07-04
	 * @param    integer    $ai
	 * @param    array      $update
	 * @return   integer    $number
	 */
	static function Update($ai, $update)
	{
		//	...
		$config = [];
		$config['table']   = self::table;
		$config['limit']   = 1;
		$config['set']     = $update;
		$config['where'][] = " ai = $ai ";
		return self::DB()->Update($config);
	}
}
