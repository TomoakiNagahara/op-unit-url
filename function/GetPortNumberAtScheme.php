<?php

/** namespace
 *
 */
namespace OP\UNIT\URL;

/** Generate hash key.
 *
 * @param     string       $shceme
 * @return    integer      $number
 */
function GetPortNumberAtScheme(string $scheme)
{
	//	...
	switch( strtolower(rtrim($scheme, ':')) ){
		case 'http':
			$port = 80;
			break;

		case 'https':
			$port = 443;
			break;

		default:
			throw new \Exception("This scheme is not define yet. ($scheme)");
	}

	//	...
	return $port;
}
