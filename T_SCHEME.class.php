<?php

/** namespace
 *
 */
namespace OP\UNIT\URL;

/** Used class.
 *
 */
use OP\OP_CORE;

/** T_SCHEME
 *
 */
class T_SCHEME extends TABLE
{
	/** trait.
	 *
	 */
	use OP_CORE;

	/** Table name.
	 *
	 * @var string
	 */
	const table = 't_scheme';

	/** Get ai.
	 *
	 * @param  string  $scheme
	 * @return integer $ai
	 */
	static function Ai($scheme)
	{
		return self::_Ai(self::table, 'scheme', $scheme);
	}
}
