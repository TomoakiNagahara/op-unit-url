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
		return self::_Ai(self::table, 'host', $host);
	}

	/** Get record by condition.
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
	 * @created  2019-09-06
	 * @param    integer     $ai
	 * @return   boolean     $io
	 */
	static function Delete($ai)
	{
		return self::_Delete(self::table, $ai);
	}
}
