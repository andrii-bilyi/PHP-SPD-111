<?php

// echo '<pre>' ;  // замість <?=  -- виведення до відповіді
// print_r( $_SERVER ) ;  // друк масиву
$uri = $_SERVER['REQUEST_URI'] ;
// якщо у запиті є гет-параметри (знак ?), то прибираємо цю частину
$pos = strpos( $uri, '?' ) ;
if( $pos > 0 ) {
	$uri = substr( $uri, 1, $pos - 1 ) ;
}
else{
	$uri = substr( $uri, 1);
}
if($uri != ""){
	$filename = "./wwwroot/{$uri}" ;
	//без зазначення типу контенту файли можуть бути ігноровані
	if(is_readable($filename)){ //запит URI - існуючий файл
		$ext = pathinfo($filename,PATHINFO_EXTENSION);
		//echo $ext ; exit ;
		unset($content_type); //если есть $content_type - то его удаляет
		switch( $ext ){
			case 'png':
			case 'bmp':
			case 'gif': 
				$content_type = "image/{$ext}" ; break;
			case 'jpg': 
			case 'jpeg': 
				$content_type = "image/jpeg" ; break;
			case 'js': 
				$content_type = "text/javascript" ; break;
			case 'css':
			case 'html':
				$content_type = "text/{$ext}" ; break ;		
		}
		if(isset($content_type)){
			header("Content-Type: {$content_type}");
			readfile($filename); //передає тіло файлу до HTTP-відповіді		
		}
		else{
			http_response_code( 404 );
			echo "Not found";
		}
		exit; //кінець роботи PHP скріпта	
	}
	
} 

$routes = [
	''       => 'index.php',
	'basics' => 'basics.php',
	'layout' => 'layout.php',
	'api' => 'api.php',
	'signup' => 'signup.php',
	'profileupdate' => 'profileupdate.php'	
] ;
if( isset( $routes[ $uri ] ) ) {   // у маршрутах є відповідний запис
	$page_body = $routes[ $uri ] ;
	include '_layout.php' ;
}
else {	
	//перевіряємо, чи є такий контролер - [Uri]Controller
	$uri_name = ucfirst($uri); //перша літера переводиться у UpperCase
	$controller_name = "{$uri_name}Controller"; //TestController
	$controller_path = "./controllers/{$controller_name}.php";
	// echo $controller_path; exit;
	if( is_readable($controller_path)){ //є контролер
		include $controller_path ; //означення класу контролера
		$controller_object = new $controller_name();
		$controller_object->serve() ;
	}
	else{
		echo "$uri not found" ;
	}	
}