<?php

/** namespace
 *
 */
namespace OP;

/* @var $configer \OP\UNIT\SELFTEST\Configer  */

//  ...
$configer->Set('table', [
	'name'    => 't_scheme',
	'comment' => '',
]);

//  ...
$configer->Column( 'ai'        , 'int'      ,   11, false, null , 'Auto increment id.',['unsigned'=>true]);
$configer->Column( 'scheme'    , 'varchar'  ,   10, false, null , 'Scheme.'   );
$configer->Column( 'timestamp' , 'timestamp', null, false, null , 'Timestamp.');

//	...
$configer->Index('PRIMARY',     'ai',     'ai', 'Auto increment id.');
$configer->Index('scheme' , 'unique', 'scheme', 'Scheme.'           );
