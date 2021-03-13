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

/**
 * Crawled column default value must be null.
 * That's because to make sure to search for null at least once to crawl.
 */
$configer->Column( 'ai'              , 'bigint'   ,   11, false,   null, 'Auto increment id.',['unsigned'=>true] );
$configer->Column( 'score'           , 'bigint'   ,   11, false,    '0', 'Score.'            ,['unsigned'=>false]);
$configer->Column( 'headless'        , 'tinyint'  ,    4,  true,   null, 'Headless flag.'    ,['unsigned'=>true] );
$configer->Column( 'http_status_code', 'int'      ,   11,  true,   null, 'http status code.' ,['unsigned'=>true] );
$configer->Column( 'scheme'          , 'int'      ,   11, false,      0, 'URL scheme.'       ,['unsigned'=>true] );
$configer->Column( 'host'            , 'bigint'   ,   11, false,      0, 'Host name.'        ,['unsigned'=>true] );
$configer->Column( 'port'            , 'int'      ,   11, false,      0, 'Host name.'        ,['unsigned'=>true] );
$configer->Column( 'path'            , 'bigint'   ,   11, false,      0, 'Path name.'        ,['unsigned'=>true] );
$configer->Column( 'query'           , 'bigint'   ,   11, false,      0, 'Query value.'      ,['unsigned'=>true] );
$configer->Column( 'form'            , 'bigint'   ,   11, false,      0, 'Form value.'       ,['unsigned'=>true] );
$configer->Column( 'auth'            , 'bigint'   ,   11,  true,   null, 'Auth value.'       ,['unsigned'=>true] );
$configer->Column( 'referer'         , 'bigint'   ,   11,  true,   null, 'Referer ai.'       ,['unsigned'=>true] );
$configer->Column( 'transfer'        , 'bigint'   ,   11,  true,   null, 'Transfer ai.'      ,['unsigned'=>true] );
$configer->Column( 'delete'          , 'tinyint'  ,    4,  true,   null, 'Delete flag.'      ,['unsigned'=>true] );
/*
$configer->Column( 'flags'           , 'set'      , null,  true,   null, 'Flags.',['length'=>'headless, delete']);
*/
$configer->Column( 'crawled'         , 'datetime' , null,  true,   null, 'Crawled data time.');
$configer->Column( 'created'         , 'datetime' , null,  true,   null, 'Created data time.');
$configer->Column( 'timestamp'       , 'timestamp', null, false,   null, 'Timestamp.');

//	MySQL does not include NULL in UNIQUE INDEX.
//	Conversely, If NULL is used, UNIQUE INDEX can be duplicated.
$configer->Index('PRIMARY',     'ai', 'ai', 'Auto increment id.'           );
/*
$configer->Index('SHP'    , 'unique', 'scheme, host, path             ', '');
$configer->Index('SHPQ'   , 'unique', 'scheme, host, path, query      ', '');
$configer->Index('SHPQA'  , 'unique', 'scheme, host, path, query, auth', '');
$configer->Index('SHPQF'  , 'unique', 'scheme, host, path, query, form', '');
*/
$configer->Index('SHPQFP' , 'unique', 'scheme, host, path, query, form, port', '');
$configer->Index('score'  ,  'index', 'score', '');
