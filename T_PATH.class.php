<?php
/**
 * unit-url:/T_PATH.class.php
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
use OP\Notice;

/** T_PATH
 *
 * @created   2019-06-14
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class T_PATH extends TABLE
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT_URL_COMMON, OP_UNIT_URL_DB;

	/** Table name.
	 *
	 * @var string
	 */
	const table = 't_path';

	/** Get ai.
	 *
	 */
	static function Ai($path)
	{
		//	...
		if( empty($path) ){
			$path = '/';
		}

		//	...
		if( strpos($path, '/') !== 0 ){
			Notice::Set("path is illegal. ($path)");
		}

		//	...
		if( strpos($path, '/./') or strpos($path, '/../') ){
			$path = self::RemoveRelativePath($path);
		}

		//	...
		if( strpos($path, '/./') ){
			$message = "Relative path. ($path)";
			Notice::Set($message);
		};

		//	...
		if( strpos($path, '/../') ){
			$message = "Relative path. ($path)";
			Notice::Set($message);
		};

		//	...
		if( preg_match('/[\'"#]/', $path) ){
			$message = "Path is include fragment or Quote. ($path)";
			D($message);

			/** Maybe JavaScript
			 *  https://local.debian.com/crawling/ai=1085
			 *  https://local.debian.com/gac.icann.org/topics/
			 *
			 *  href='"+myObj.data[i][1]+"'
			 */

		//	Notice::Set($message);
		//	throw new \Exception($message);
			return 0;
		};

		//	...
		if( strpos($path, '&quot;') ){
			$message = "&quot; was found. ($path)";
			D($message);
		//	throw new \Exception($message);
			return 0;
		}

		//	...
		return self::_Ai(self::table, 'path', $path);
	}

	/** Remove relative path.
	 *
	 * @created   2019-09-06
	 * @param     string       $path
	 * @return    string       $path
	 */
	static function RemoveRelativePath(string $path):string
	{
		//	...
		$dirs = [];

		//	...
		foreach( explode('/', $path) as $dir ){

			//	...
			if( $dir === '.' ){
				continue;
			}

			//	...
			if( $dir === '..' ){
				array_pop($dirs);
				continue;
			}

			//	...
			$dirs[] = $dir;
		}

		//	...
		return join('/', $dirs);
	}
}
