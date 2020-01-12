<?php
/**
 * unit-url:/selftest/t_url.php
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

//	...
$configer->Set('table', [
	'name'    => 't_url',
	'comment' => '',
]);

//	...
$configer->Column( 'ai'              , 'int',    11, false,   null, 'Auto increment id.',['unsigned'=>true]);
$configer->Column( 'score'           , 'int',    11, false,   null, 'Score.'            ,['unsigned'=>true]);
$configer->Column( 'http_status_code', 'int',    11,  true,   null, 'http status code.' ,['unsigned'=>true]);
$configer->Column( 'scheme'          , 'enum', null, false, 'http', 'URL scheme.'       ,['length'  =>'http,https']);
$configer->Column( 'host'            , 'int',    11, false,   null, 'Host name.'        ,['unsigned'=>true]);
$configer->Column( 'path'            , 'int',    11, false,   null, 'Path name.'        ,['unsigned'=>true]);
$configer->Column( 'query'           , 'int',    11, false,   null, 'Query value.'      ,['unsigned'=>true]);
$configer->Column( 'form'            , 'int',    11, false,   null, 'Form value.'       ,['unsigned'=>true]);
$configer->Column( 'timestamp'       , 'timestamp' ,  null,  false, null, 'Timestamp.');

//	...
$configer->Index('ai' ,     'ai', 'ai',                      'Auto increment id.');
$configer->Index('URL', 'unique', 'host, path, query, form', 'Unique ids.'       );
