<?php
/**
 * unit-url:/URL.trait.php
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

/** URL
 *
 * @created   2019-06-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
trait OP_UNIT_URL
{
	/** trait
	 *
	 */
	use OP_UNIT_URL_DB;

	/** Host
	 *
	 */
	static function Host()
	{
		static $_host;
		return $_host ? $_host : $_host = new T_HOST();
	}

	/** Path
	 *
	 */
	static function Path()
	{

	}

	/** Query
	 *
	 */
	static function Query()
	{

	}

	/** Get t_url single record.
	 *
	 * @created  2019-06-13
	 */
	static function Record($config=[])
	{
		//	...
		$config['limit'] = 1;

		//	...
		return self::Records($config);
	}

	/** Get t_url multiple records.
	 *
	 * @created  2019-06-13
	 */
	static function Records($config=[])
	{
		//	..
		$config['table'] = 't_url.host <= t_host.ai, t_url.path <= t_path.ai, t_url.query <= t_query.ai';
		$config['field'] = '*, t_url.ai as ai, t_url.timestamp as timestamp';

		//	...
		if( empty($config['limit']) ){
			$config['limit'] = 100;
		};

		//	...
		if( empty($config['where']) ){
			$config['where'][] = " t_url.ai >= 1 ";
		};

		//	...
		return self::DB()->Select($config);
	}

	/** Register URL.
	 *
	 * @created  2019-06-13
	 * @param    string|array  $url
	 * @return   integer       $ai
	 */
	static function Register($url)
	{
		//	...
		$ai = self::Ai($url);

		//	...
		$config = [];
		$config['table']   = 't_url';
		$config['limit']   = 1;
		$config['set'][]   = " score + 1 ";
		$config['where'][] = " ai = $ai  ";
		self::DB()->Update($config);

		//	...
		return $ai;
	}

	/** Get auto increment number.
	 *
	 * @created  2019-06-14
	 * @param    string|array  $url
	 * @return   integer       $ai
	 */
	static function Ai($url)
	{
		//	...
		if( is_string($url) ){
			$parsed = self::Parse($url);
		}else if( is_array($url) ){
			$parsed = $url;
		}else{
			$type = gettype($url);
			throw new \Exception("This type is not support. ({$type})");
		};

		//	...
		$https = $parsed['scheme'] === 'https' ? 1: 0;
		$host  = T_HOST ::Ai($parsed['host'] );
		$path  = T_PATH ::Ai($parsed['path']  ?? null);
		$query = T_QUERY::Ai($parsed['query'] ?? null);
		$form  = T_FORM ::Ai(null);
		$ai    = T_URL  ::Ai($https, $host, $path, $query, $form);

		//	...
		return $ai;
	}

	/**
	 *
	 * @created  2019-06-14
	 */
	static function HttpStatusCode($url, $status)
	{
		//	...
		if( is_numeric($url) ){
			$ai = $url;
		}else{
			$ai = self::Ai($url);
		};

		//	...
		return T_URL::Update($ai, 'http_status_code', $status);
	}

	/** Parse URL.
	 *
	 * @created  2019-06-13
	 * @param    string      $url
	 * @return   array       $parsed
	 */
	static function Parse($url)
	{
		//	...
		if( strpos($url, '//')  === 0 ){
		}else if( strpos($url, 'http://')  === 0 ){
		}else if( strpos($url, 'https://') === 0 ){
		}else{
			$url = '//' . $url;
		};

		//	...
		$parsed = [];

		//	...
		foreach( ['scheme','host','path','port','query'] as $key ){
			if(!isset($parsed[$key]) ){
				$parsed[$key] = null;
			};
		};

		//	...
		if(!$parsed['path'] ){
			$parsed['path'] = '/';
		};

		//	...
		return array_merge( $parsed, parse_url($url) );
	}

	/** Build URL from parsed array.
	 *
	 * @created 2019-06-11
	 * @param   array      $parsed
	 * @return  string     $url
	 */
	function Build($parsed)
	{
		//	...
		$scheme =($parsed['scheme'] ?? null) ?? 'http';
		$host   =($parsed['host']   ?? null);
		$port   =($parsed['port']   ?? '80');
		$path   =($parsed['path']   ?? '/' );
		$query  =($parsed['query']  ?? null);

		//	...
		$port = ($port === '80') ? null: ':'.$port;

		//	...
		$query = ($query) ? '?'.$query: null;

		//	...
		return "{$scheme}://{$host}{$port}{$path}{$query}";
	}

	/** Get URL.
	 *
	 * @created  2019-06-13
	 */
	static function Get($where=[])
	{
		//	...
		$config = [];
		$config['where'] = $where;
		$record = self::Record($config);

		//	...
		$scheme = $record['https'] ? 'https': 'http';
		$host   = $record['host'];
		$path   = $record['path'];
		$query  = $record['query'] ? '?'.$record['query']: null;

		//	...
		return "{$scheme}://{$host}{$path}{$query}";
	}

	/** Update record of URL.
	 *
	 * @created  2019-06-13
	 * @param    integer    $ai
	 * @param    array      $update
	 * @return   boolean
	 */
	static function Update($ai, $update)
	{
		//	...
		$config = [];
		$config['table'] = 't_url';
		$config['limit'] =  1;
		$config['set']   = $update;
		$config['where'][] = "ai = $ai";

		//	...
		return self::DB()->Update($config) ? true: false;
	}
}
