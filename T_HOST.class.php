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
	 */
	static function Ai($host)
	{
		return self::_Ai(self::table, 'host', $host);
	}
}
