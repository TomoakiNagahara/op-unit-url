<?php
/**
 * unit-url:/selftest/t_host.php
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

/* @var $configer \OP\UNIT\SELFTEST\Configer  */

//  ...
$configer->Set('table', [
	'name'    => 't_host',
	'comment' => '',
]);

//  ...
$configer->Column( 'ai'        , 'bigint'   ,   11, false, null , 'Auto increment id.',['unsigned'=>true]);
$configer->Column( 'score'     , 'bigint'   ,   11, false,   '0', 'Score.'            );
$configer->Column( 'hash'      , 'char'     ,   10, false, null , 'Hash by host name.');
$configer->Column( 'host'      , 'text'     , null, false, null , 'Host name.'        );
$configer->Column( 'flag'      , 'set'      , null,  true, null , 'flags.'            ,['length'=>'https']);
$configer->Column( 'created'   , 'datetime' , null,  true, null , 'Created date time.');
$configer->Column( 'timestamp' , 'timestamp', null, false, null , 'Timestamp.'        );

//	...
$configer->Index('PRIMARY',     'ai',   'ai', 'Auto increment id.');
$configer->Index('hash'   , 'unique', 'hash', 'Hash by host name.');
