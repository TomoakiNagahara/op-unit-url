<?php
/**
 * unit-url:/T_HOST.class.php
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

/** Used class.
 *
 */
use OP\OP_CORE;
use OP\Env;
use function OP\Notice;

/** T_HOST
 *
 * @created   2019-06-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class T_HOST extends TABLE
{
	/** trait.
	 *
	 */
	use OP_CORE;

	/** Table name.
	 *
	 * @var string
	 */
	const table = 't_host';

	/** Get ai.
	 *
	 * @param  string  $host
	 * @return integer $ai
	 */
	static function Ai($host)
	{
		//	...
		if(!Env::isLocalhost() and !gethostbynamel($host) ){
			Notice("This hostname could not be resolved. ($host)");
			return false;
		}

		//	...
		return self::_Ai(self::table, 'host', $host);
	}

	/** Get record by condition.
	 *
	 * <pre>
	 * $condition['host'] = 'example.com';
	 * </pre>
	 *
	 * @param   array  $condition
	 * @return  array  $record
	 */
	static function Get($condition)
	{
		return self::_Get(self::table, $condition);
	}

	/** Update
	 *
	 * @created  2019-06-14
	 * @copied   2019-07-04 from T_URL
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
	 * @param    integer     $ai
	 * @return   boolean     $io
	 */
	static function Delete($ai)
	{
		return self::_Delete(self::table, $ai);
	}

	/** Change https flag.
	 *
	 * @param     mixed        $host
	 * @param     bool         $io
	 */
	/*
	static function Https($host, bool $io):void
	{
		//	...
		$table = self::table;

		//	...
		if( is_numeric($host) ){
			$flag = self::DB()->QQL(" flag <- {$table}.ai   = $host ");
		}else{
			$hash = Hash($host);
			$flag = self::DB()->QQL(" flag <- {$table}.hash = $hash ");
		}

		//	...
		D($flag);

		//	...
		$flag = explode(',', $flag);

		//	...
		if( $io ){
			$flag[] = 'https';
		}else{
			D();
		}

		//	...
		self::Flag($host, $flag);
	}
	*/

	/** Change flag.
	 *
	 * @param     mixed        $host
	 * @param     mixed        $flag
	 */
	/*
	static function Flag($host, $flag):void
	{

	}
	*/

	/** Is https
	 *
	 * @param     mixed        $host
	 * @return    bool         $io
	 */
	/*
	static function isHttps($host):bool
	{

	}
	*/
}
