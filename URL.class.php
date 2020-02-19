<?php
/**
 * unit-url:/URL.class.php
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
namespace OP\UNIT;

/** Used class.
 *
 */
use OP\OP_CORE;
use OP\OP_UNIT;
use OP\IF_UNIT;

/** URL
 *
 * @created   2019-06-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class URL implements IF_UNIT
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT, URL\OP_UNIT_URL;

	/** Delete relative all record.
	 *
	 * @created   2020-02-12
	 */
	function Delete($value)
	{
		//	...
		if( is_string($value) ){
			$parse = $this->Parse($value);
		}

		//	...
		if( is_numeric($value) ){
			$parse = $this->URL()->Get($value);
		}

		//	...
		D($parse);
	}
}
