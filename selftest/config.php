<?php
/**
 * unit-url:/selftest/config.php
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
namespace OP;

//	...
$config = [
	'prod'     => 'mysql',
	'host'     => 'localhost',
	'port'     => '3306',
	'user'     => 'url',
	'password' => 'url',
	'charset'  => 'utf8',
	'database' => 'op',
];

//	...
$config = array_merge( $config, Env::Get('url')['database'] ?? [] );

//	...
$prod     = $config['prod'];
$host     = $config['host'];
$port     = $config['port'];
$user     = $config['user'];
$password = $config['password'];
$database = $config['database'];
$charset  = $config['charset'];
$collate  = null;

//  Instantiate self-test configuration generator.
$configer = \OP\UNIT\Selftest::Configer();

//  DSN configuration.
$configer->DSN([
	'host'     => $host,
	'product'  => $prod,
	'port'     => $port,
]);

//  User configuration.
$configer->User([
	'host'     => $host,
	'name'     => $user,
	'password' => $password,
	'charset'  => $charset,
]);

//  Database configuration.
$configer->Database([
	'name'     => $database,
	'charset'  => $charset,
	'collate'  => $collate,
]);

//  Privilege configuration.
$configer->Privilege([
	'user'     => $user,
	'database' => $database,
	'table'    => '*',
	'privilege'=> 'insert, select, update, delete',
	'column'   => '*',
]);

//	...
include(__DIR__.'/t_scheme.php');
include(__DIR__.'/t_host.php' );
include(__DIR__.'/t_path.php' );
include(__DIR__.'/t_query.php');
include(__DIR__.'/t_form.php' );
include(__DIR__.'/t_auth.php' );
include(__DIR__.'/t_url.php'  );

//  Return selftest configuration.
return $configer->Get();
