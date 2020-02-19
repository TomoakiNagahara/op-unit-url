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

/** use
 *
 */
use function OP\Html;

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

	/** Selftest
	 *
	 */
	static function Selftest()
	{
		static $_unit;
		return $_unit ? $_unit : $_unit = new Selftest();
	}

	/** URL
	 *
	 * @return T_URL
	 */
	static function URL()
	{
		static $_url;
		return $_url ? $_url : $_url = new T_URL();
	}

	/** Host
	 *
	 * @return T_HOST
	 */
	static function Host()
	{
		static $_host;
		return $_host ? $_host : $_host = new T_HOST();
	}

	/** Path
	 *
	 * @created  2019-08-01
	 * @return   T_PATH
	 */
	static function Path()
	{
		static $_path;
		return $_path ? $_path: $_path = new T_PATH();
	}

	/** Query
	 *
	 * @created  2019-08-01
	 * @return   T_QUERY
	 */
	static function Query()
	{
		static $_query;
		return $_query ? $_query: $_query = new T_QUERY();
	}

	/** Form
	 *
	 * @created  2019-08-01
	 * @return   T_FORM
	 */
	static function Form()
	{
		static $_form;
		return $_form ? $_form: $_form = new T_FORM();
	}

	/** Auth
	 *
	 * @created  2019-08-15
	 * @return   T_AUTH
	 */
	static function Auth()
	{
		static $_auth;
		return $_auth ? $_auth: $_auth = new T_AUTH();
	}

	/** Get t_url single record.
	 *
	 * @created  2019-06-13
	 * @param    array
	 * @return   array
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
	 * @param    array
	 * @return   array
	 */
	static function Records($config=[])
	{
		//	..
		$config['table'] = 't_url.host <= t_host.ai, t_url.path <= t_path.ai, t_url.query <= t_query.ai, t_url.form <= t_form.ai, t_url.auth <= t_auth.ai';
		$config['field'] = '*, t_url.ai as ai, t_url.score as score, t_url.timestamp as timestamp';

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
	static function Register($parsed)
	{
		/*
		//	...
		if( is_string($parsed) ){
			$parsed = self::Parse($parsed);
		};
		*/

		//	Register Host, Path, Query, Form.
		$ai = self::Ai($parsed);

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
		$parsed  = is_string($url) ? self::Parse($url): $url;
		$referer = $parsed['referer'] ?? null;

		//	...
		$scheme = $parsed['scheme'] ?? 'http';
		$host   = T_HOST::Ai($parsed['host']);
		$path   = T_PATH::Ai($parsed['path']);
		$query  = isset($parsed['query']) ? T_QUERY::Ai($parsed['query']) : null;
		$form   = isset($parsed['form' ]) ? T_FORM ::Ai($parsed['form' ]) : null;
		if( isset($parsed['user']) and isset($parsed['pass']) ){
			$auth = T_AUTH::Ai($parsed['user'], $parsed['pass']);
		}else{
			$auth = null;
		}
		$ai    = T_URL::Ai($scheme, $host, $path, $query, $form, $auth, $referer);

		//	...
		return $ai;
	}

	/** Update to http_status_code.
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
		if( strpos($url, '/')  === 0 ){
		}else if( strpos($url, 'http://')  === 0 ){
		}else if( strpos($url, 'https://') === 0 ){
		}else{
		//	throw new \Exception("Illegal URL format. ($url)");
			$url = '//'.$url;
		};

		//	...
		$parsed = parse_url($url);

		//	Force init all assoc key.
		foreach( ['scheme','host','path','port','query'] as $key ){
			if(!isset($parsed[$key]) ){
				$parsed[$key] = null;
			};
		};

		//	Form
		if(($parsed['query'][0] ?? null) === '!' ){
			$parsed['form']  = substr($parsed['query'], 1);
			$parsed['query'] = null;
		}

		//	...
		if( $parsed['path'] ){
			$parsed['path'] = str_replace('//', '/', $parsed['path']);
		}else{
			$parsed['path'] = '/';
		};

		//	...
		return $parsed;
	}

	/** Build URL from parsed array.
	 *
	 * @created 2019-06-11
	 * @param   array      $parsed
	 * @param   array      $condition
	 * @return  string     $url
	 */
	static function Build($parsed, $condition=null)
	{
		//	...
		if( $parsed['auth'] ?? null ){
			list($parsed['user'], $parsed['pass']) = explode(':', $parsed['auth']);
		};

		//	...
		if( empty($parsed['scheme']) ){
			$parsed['scheme'] = 'http';
		}

		//	...
		if( $condition ){
			$parsed = array_merge($parsed, $condition);
		}

		//	...
		$scheme   = ($parsed['scheme']   ?? null);
		$host     = ($parsed['host']     ?? null);
		$port     = ($parsed['port']     ?? '80');
		$path     = ($parsed['path']     ?? '/' );
		$query    = ($parsed['query']    ?? null);
		$user     = ($parsed['user']     ?? null);
		$pass     = ($parsed['pass']     ?? null);
		/*
		$fragment = ($parsed['fragment'] ?? null);
		*/

		//	...
		$scheme = $scheme ? $scheme.':': null;

		//	...
		$port = ($port === '80') ? null: ':'.$port;

		//	...
		$query = ($query) ? '?'.$query: null;

		//	...
		$auth = $user ? "{$user}:{$pass}@": null;

		//	...
		return "{$scheme}//{$auth}{$host}{$port}{$path}{$query}";
	}

	/** Get URL.
	 *
	 * @created   2019-06-13
	 * @param     integer      $where
	 * @param     array        $condition
	 * @return    string       $url
	 */
	static function Get(int $ai, $condition=null)
	{
		//	...
		$config = [];
		$config['where'][] = " t_url.ai = $ai ";
		$record = self::Record($config);

		//	...
		return self::Build($record, $condition);
	}

	/** Update record of URL.
	 *
	 * <pre>
	 * $ai = 1;
	 * $update = [
	 *   'field1' => $value1,
	 *   'field2' => $value2,
	 * ];
	 * $io = self::Update($ai, $update);
	 * </pre>
	 *
	 * @created  2019-06-13
	 * @param    integer    $ai
	 * @param    array      $update
	 * @return   boolean
	 */
	static function Update($ai, $update, $where=[])
	{
		//	...
		$config = [];
		$config['table'] = 't_url';
		$config['limit'] =  1;
		$config['set']   = $update;
		$config['where'] = $where;
		$config['where'][] = "ai = $ai";

		//	...
		return self::DB()->Update($config) ? true: false;
	}

	/** Delete record of URL by ai.
	 *
	 * @created   2019-09-10
	 * @modified  2020-02-12
	 * @param     integer|string
	 * @return    boolean
	 */
	static function Delete($value)
	{
		//	...
		if( is_array($value) ){
			//	Parced array is convert to correct URL.
			$value = self::Build($value);
		}

		//	...
		if( is_string($value) ){
			$parsed = self::Parse($value);
		}

		//	...
		if( is_numeric($value) ){
			$config = [];
			$config['where']['t_url.ai'] = $value;
			$parsed = self::Record($config);
		}

		//	Get host ai.
		$config = [];
		$config['table'] = T_HOST::table;
		$config['limit'] = 1;
		$config['where']['hash'] = Hash($parsed['host'] );
		if(!$ai_host = self::Host()->DB()->Select($config)['ai'] ?? null ){
			D("Host was not exists. ({$parsed['host']})", $config);
			return;
		}

		//	Search all target path.
		$config = [];
		$config['table'] = "t_url.path <= t_path.ai ";
		$config['limit'] = -1;
		$config['group'] = 't_path.path';
		$config['where'][] = " t_url.delete != 1 ";
		$config['where'][] = " t_url.host    = {$ai_host} ";
		$config['where'][] = " t_path.path like {$parsed['path']}% ";
		foreach( self::Path()->DB()->Select($config) as $record ){
			//	...
			$exists = true;

			//	...
			$ai_path = $record['ai'];

			//	...
			$where = [];
			$where['host'] = $ai_host;
			$where['path'] = $ai_path;
			$num = self::URL()->Delete($where);


			D( $num, self::URL()->DB()->Query() );


			//	...
			Html("Target path : {$record['path']}");
			Html("Setted delete flag at applicable record. that include different URL Queries : {$num}");
		}

		//	...
		if( empty($exists) ){
			Html("Not found target record.");
		}
	}

	/** Remove records for which the delete flag is set.
	 *
	 */
	static function Remove()
	{
		//	...
		$remove = 0;

		//	...
		$config = [];
		$config['limit']  = -1;
		$config['delete'] = 1;
		foreach( self::URL()->Select($config) as $record ){

			//	...
			self::Host() ->Remove( $record['host']  ?? 0, 'host'  );
			self::Path() ->Remove( $record['path']  ?? 0, 'path'  );
			self::Query()->Remove( $record['query'] ?? 0, 'query' );
			self::Form() ->Remove( $record['form']  ?? 0, 'form'  );
			self::Auth() ->Remove( $record['auth']  ?? 0, 'auth'  );

			//	...
			$config = [];
			$config['table'] = T_URL::table;
			$config['limit'] = 1;
			$config['where'] = " ai = {$record['ai']} ";
			$remove += self::URL()->DB()->Delete($config);
		}

		//	...
		Html("Removed $remove records.");
	}
}
