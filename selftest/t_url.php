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
$configer->Column( 'ai'              , 'bigint'   ,   11, false,   null, 'Auto increment id.',['unsigned'=>true] );
$configer->Column( 'score'           , 'bigint'   ,   11,  true,    '0', 'Score.'            ,['unsigned'=>false]);
$configer->Column( 'headless'        , 'tinyint'  ,    4,  true,   null, 'Headless flag.'    ,['unsigned'=>true] );
$configer->Column( 'http_status_code', 'tinyint'  ,    4,  true,   null, 'http status code.' ,['unsigned'=>true] );
$configer->Column( 'scheme'          , 'enum'     , null, false, 'http', 'URL scheme.'       ,['length'  =>'http,https']);
$configer->Column( 'host'            , 'bigint'   ,   11, false,   null, 'Host name.'        ,['unsigned'=>true] );
$configer->Column( 'path'            , 'bigint'   ,   11, false,   null, 'Path name.'        ,['unsigned'=>true] );
$configer->Column( 'query'           , 'bigint'   ,   11,  true,   null, 'Query value.'      ,['unsigned'=>true] );
$configer->Column( 'form'            , 'bigint'   ,   11,  true,   null, 'Form value.'       ,['unsigned'=>true] );
$configer->Column( 'auth'            , 'bigint'   ,   11,  true,   null, 'Auth value.'       ,['unsigned'=>true] );
$configer->Column( 'referer'         , 'bigint'   ,   11,  true,   null, 'Referer ai.'       ,['unsigned'=>true] );
$configer->Column( 'transfer'        , 'bigint'   ,   11,  true,   null, 'Transfer ai.'      ,['unsigned'=>true] );
$configer->Column( 'delete'          , 'tinyint'  ,    4, false,   null, 'Delete flag.'      ,['unsigned'=>true] );
$configer->Column( 'crawled'         , 'datetime' , null,  true,   null, 'Crawled data time.');
$configer->Column( 'created'         , 'datetime' , null,  true,   null, 'Created data time.');
$configer->Column( 'timestamp'       , 'timestamp', null, false,   null, 'Timestamp.');

//	...
$configer->Index( 'ai' ,     'ai', 'ai'                              , 'Auto increment id.' );
$configer->Index( 'URL', 'unique', 'host, path, query, form, delete ', 'Unique ids.'        );

//	Only for delete index.
/*
$configer->Index( 'host' , 'multi', 'host , deleted', 'For delete index.' );
$configer->Index( 'path' , 'multi', 'path , deleted', 'For delete index.' );
$configer->Index( 'query', 'multi', 'query, deleted', 'For delete index.' );
$configer->Index( 'form' , 'multi', 'form , deleted', 'For delete index.' );
$configer->Index( 'auth' , 'multi', 'auth , deleted', 'For delete index.' );
*/
