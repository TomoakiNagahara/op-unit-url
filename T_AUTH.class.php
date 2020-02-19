<?php
/**
 * unit-url:/T_AUTH.class.php
 *
 * @created   2019-08-15
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-08-15
 */
namespace OP\UNIT\URL;

/** Used class.
 *
 */
use OP\OP_CORE;

/** T_AUTH
 *
 * @created   2019-08-15
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class T_AUTH extends TABLE
{
	/** trait.
	 *
	 * @created   2019-08-15
	 */
	use OP_CORE, OP_UNIT_URL_COMMON, OP_UNIT_URL_DB;

	/** Table name.
	 *
	 * @created   2019-08-15
	 * @var       string
	 */
	const table = 't_auth';

	/** Get ai.
	 *
	 * @created   2019-08-15
	 * @param     string     $auth
	 * @return    number     $ai
	 */
	static function Ai($user, $pass)
	{
		return ($user and $pass) ? self::_Ai(self::table, 'auth', "{$user}:{$pass}"): null;
	}
}
