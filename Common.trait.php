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
	/** Get DB
	 *
	 */
	static function Hash($str)
	{
		return substr(md5($str), 0, 10);
	}
}
