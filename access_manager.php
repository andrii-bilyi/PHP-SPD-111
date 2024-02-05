<?php

// echo '<pre>' ;  // замість <?=  -- виведення до відповіді
// print_r( $_SERVER ) ;  // друк масиву
$uri = $_SERVER['REQUEST_URI'] ;
// якщо у запиті є гет-параметри (знак ?), то прибираємо цю частину
$pos = strpos( $uri, '?' ) ;
if( $pos > 0 ) {
	$uri = substr( $uri, 0, $pos ) ;
}
$routes = [
	'/'       => 'index.php',
	'/basics' => 'basics.php',
	'/layout' => 'layout.php',
] ;
if( isset( $routes[ $uri ] ) ) {   // у маршрутах є відповідний запис
	$page_body = $routes[ $uri ] ;
	include '_layout.php' ;
}
else {	
	echo "$uri not found" ;
}