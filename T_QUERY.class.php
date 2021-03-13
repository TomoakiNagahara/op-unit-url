<?php
/**
 * unit-url:/T_QUERY.class.php
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
use function html_entity_decode;

/** T_QUERY
 *
 * @created   2019-06-14
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class T_QUERY extends TABLE
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT_URL_COMMON, OP_UNIT_URL_DB;

	/** Table name.
	 *
	 * @var string
	 */
	const table = 't_query';

	/** Get ai.
	 *
	 * @param  string
	 * @return integer
	 */
	static function Ai($query)
	{
		//	...
		$query = urldecode($query);
		$query = html_entity_decode($query, ENT_QUOTES);

		//	...
		return self::_Ai(self::table, 'query', $query);
	}
}
