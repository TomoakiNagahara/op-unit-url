<?php
/**
 * unit-url:/Common.trait.php
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

/** OP_UNIT_URL_COMMON
 *
 * @created   2019-06-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
trait OP_UNIT_URL_COMMON
{
	/** Get hash string
	 *
	 * @param  string $value
	 * @return string $hash
	 */
	static function Hash($str)
	{
		return Hash($str);
	}

	/** Remove is physical delete if 0 reference.
	 *
	 * @created  2020-02-12
	 * @param    integer      $ai
	 * @param    string       $field
	 */
	static function Remove(int $ai, string $field)
	{
		//	...
		static $T_URL;

		//	...
		if(!$T_URL ){
			$T_URL = new T_URL();
		}

		//	...
		if(!$ai ){
			return;
		}

		//	...
		$table = "t_{$field}";

		//	...
		$where = [];
		$where[] = " {$field} = $ai ";
		$where[] = " delete  != 1   ";
		if( $T_URL->Count($where) ){
			return;
		}

		//	...
		$config = [];
		$config['table'] = $table;
		$config['limit'] = 1;
		$config['where'] = " ai = $ai ";
		if( $count = self::DB()->Delete($config) ){
			D(" Delete {$table}.ai = {$ai}, Count=$count ");
		}
	}
}
