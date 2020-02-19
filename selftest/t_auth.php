<?php
/**
 * unit-url:/selftest/t_auth.php
 *
 * @created   2020-02-13
 * @version   1.0
 * @package   unit-url
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2020-02-13
 */
namespace OP;

/* @var $configer \OP\UNIT\SELFTEST\Configer  */

//	...
$configer->Set('table', [
	'name'    => 't_auth',
	'comment' => '',
]);

//	...
$configer->Column( 'ai'        , 'bigint'   ,   11, false, null, 'Auto increment id.',['unsigned'=>true]);
$configer->Column( 'hash'      , 'char'     ,   10, false, null, 'Hash by host name.');
$configer->Column( 'auth'      , 'text'     , null, false, null, 'auth value.'       );
$configer->Column( 'timestamp' , 'timestamp', null, false, null, 'Timestamp.'        );

//	...
$configer->Index(  'ai',     'ai',   'ai', 'auto increment id.'  );
$configer->Index('hash', 'unique', 'hash', 'Hash by query value.');
