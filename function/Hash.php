<?php
/**
 * unit-url:/function/Hash.php
 *
 * @created   2020-02-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP\UNIT\URL;

/** Generate hash key.
 *
 * @created   ????
 * @moved     2020-02-13   Common.trait.php --> function/Hash.php
 * @param     string       $value
 * @return    string       $hash
 */
function Hash($str)
{
	return substr(md5($str), 0, 10);
}
