<?php
/**
 * unit-url:/Selftest.class.php
 *
 * @created   2019-06-21
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-06-21
 */
namespace OP\UNIT\URL;

/** Used class.
 *
 */
use OP\OP_CORE;

/** Selftest
 *
 * @created   2019-06-21
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class Selftest
{
	/** trait.
	 *
	 */
	use OP_CORE;

	/** Automatically.
	 *
	 */
	static function Auto()
	{
		//	...
		return Unit('Selftest')->Auto( self::Config() );
	}

	static function Config()
	{
		return include(__DIR__.'/selftest/config.php');
	}
}
