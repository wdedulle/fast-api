<?php
// allow origin
header('Access-Control-Allow-Origin: *');
// add any additional headers you need to support here
header('Access-Control-Allow-Headers: *');

use Janis\Api\Finance;
define( 'VENDOR_PATH', realpath( __DIR__ . '/vendor' ) );

$loader = require_once  VENDOR_PATH . '/autoload.php';

try {
	if( ! isset( $_GET['request'] ) ) {
		throw new Exception( 'no request' );
	}
	$API = new Finance( $_GET['request'] );
	echo $API->process();
} catch ( Exception $e ) {
	echo json_encode( array( 'error' => $e->getMessage() ) );
}