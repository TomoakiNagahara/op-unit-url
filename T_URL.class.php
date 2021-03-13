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
use OP\Env;

/** T_URL
 *
 * @created   2019-06-14
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class T_URL extends TABLE
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
	static function Ai($scheme, $host, $port, $path, $query, $form, $auth, $referer=null)
	{
		//	...
		$config = [];
		$config['table'] = self::table;
		$config['field'] = 'ai, scheme';
		$config['limit'] = 1;
		$config['order'] = 'created';
		$config['cache'] = Env::isAdmin() ? 1: 60 * 60 * 24 * 1;

		//	...
		$where = [];
		$where['host' ]  = $host  ;
		$where['port']   = $port  ;
		$where['path' ]  = $path  ;
		$where['query']  = $query ;
		$where['form' ]  = $form  ;
		/*
		//	...
		if( $scheme ){ $where['scheme'] = $scheme; }
		if( $auth   ){ $where['auth']   = $auth  ; }
		//	...
		*/
		$config['where'] = $where;

		//	...
		if( $record = self::DB()->Select($config) ){

			/* The scheme does not update automatically.
			 * Please update explicitly with 301.
			if( $scheme ){
				self::Update($record['ai'], ['scheme'=>$scheme]);
			}
			*/

			//	...
			return $record['ai'];
		};

		//	Insert
		$config = [];
		$config['table'] = self::table;
		$config['set']   = $where;
		$config['set']['created'] = gmdate(_OP_DATE_TIME_);
		if($referer){
			$config['set']['referer'] = $referer;
		}

		//	...
		if( $scheme === 'https' ){
			$config['set']['scheme']    = $scheme;
			$config['update']['scheme'] = $scheme;
		}

		//	...
		if( $port ){
			$config['set']['port']    = $port;
			$config['update']['port'] = $port;
		}

		//	...
		if( $auth ){
			$config['set']['auth']    = $auth;
			$config['update']['auth'] = $auth;
		}

		//	...
		return self::DB()->Insert($config);
	}

	/** Count
	 *
	 * @created   2020-02-12
	 * @param     array        $where
	 * @return    number       $count
	 */
	static function Count($where)
	{
		//	...
		$config = [];
		$config['table'] = self::table;
		$config['where'] = $where;
		return self::DB()->Count($config);
	}

	/** Select
	 *
	 * @created   2020-02-12
	 * @param     array        $condition
	 * @return    number       $count
	 */
	static function Select(array $condition)
	{
		//	...
		unset($condition['table']);

		//	...
		$config = [];
		$config['table'] = self::table;
		$config['limit'] = $condition['limit'] ?? 1;

		//	...
		unset($condition['limit']);

		//	...
		$config['where'] = $condition;

		//	...
		return self::DB()->Select($config);
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

	/** Delete
	 *
	 * @created  2020-02-13
	 * @param    array      $where
	 * @return   integer    $number
	 */
	static function Delete($where)
	{
		//	...
		$where[] = 'delete != 1';

		//	...
		$config = [];
		$config['table'] = self::table;
		$config['limit'] = -1;
		$config['where'] = $where;
		$config['set'][] = ' delete = 1 ';
		return self::DB()->Update($config);
	}
}
