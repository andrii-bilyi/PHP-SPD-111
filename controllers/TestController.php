<?php

include_once "ApiController.php";

class TestController extends ApiController {
    
    protected function do_get() {
        $db = $this->connect_db_or_exit();   
        // виконання запитів
        $sql = "CREATE TABLE IF NOT EXISTS Users (
            `id` CHAR(36) PRIMARY KEY DEFAULT ( UUID()),
            `email` VARCHAR(128) NOT NULL,
            `name` VARCHAR(64) NOT NULL,
            `password` CHAR(64) NOT NULL COMMENT 'Hash of rassword',
            `avatar` VARCHAR(128) NULL
        ) ENGINE = INNODB, DEFAULT CHARSET = utf8mb4";  
        try{
            $db->query($sql);
        
        } catch (PDOException $ex) {
            http_response_code(500);
            echo "query error: ".$ex->getMessage();
            exit;        
        }   
        echo "Hello from do_get - Query OK";
    }
    protected function do_post() {
        
        echo "Hello from do_post";
    }
    /**
	* Оновлення даних користувача
	*/
	// protected function do_post() {
	// 	// $result = [ 'get' => $_GET, 'post' => $_POST, 'files' => $_FILES, ] ;
	// 	$result = [  // REST - як "шаблон" однаковості відповідей АПІ
	// 		'status' => 0,
	// 		'meta' => [
	// 			'api' => 'test',
	// 			'service' => 'profileupdate',
	// 			'time' => time()
	// 		],
	// 		'data' => [
	// 			'message' => ""
	// 		],
	// 	] ;
	// 	if( empty( $_POST[ "user-name" ] ) ) {
	// 		$result[ 'data' ][ 'message' ] = "Missing required parameter: 'ruser-name'" ;
	// 		$this->end_with( $result ) ;
	// 	}
	// 	$user_name = trim( $_POST[ "user-name" ] ) ;
	// 	if( strlen( $user_name ) < 2 ) {
	// 		$result[ 'data' ][ 'message' ] = "Validation violation: 'user-name' too short" ;
	// 		$this->end_with( $result ) ;
	// 	}
	// 	if( preg_match( '/\d/', $user_name ) ) {
	// 		$result[ 'data' ][ 'message' ] = 
	// 			"Validation violation: 'user-name' must not contain digit(s)" ;
	// 		$this->end_with( $result ) ;
	// 	}
		
	// 	if( empty( $_POST[ "user-password" ] ) ) {
	// 		$result[ 'data' ][ 'message' ] = "Missing required parameter: 'ruser-password'" ;
	// 		$this->end_with( $result ) ;
	// 	}
	// 	$user_password = $_POST[ "user-password" ] ;		
		
	// 	if( empty( $_POST[ "user-email" ] ) ) {
	// 		$result[ 'data' ][ 'message' ] = "Missing required parameter: 'ruser-email'" ;
	// 		$this->end_with( $result ) ;
	// 	}
	// 	$user_email = trim( $_POST[ "user-email" ] ) ;
		
	// 	$filename = null ;
	// 	if( ! empty( $_FILES[ 'user-avatar' ] ) ) {
	// 		// файл опціональний, але якщо переданий, то перевіряємо його
	// 		if( $_FILES[ 'user-avatar' ][ 'error' ] != 0
	// 		 || $_FILES[ 'user-avatar' ][ 'size' ] == 0
	// 		) {
	// 			$result[ 'data' ][ 'message' ] = "File upload error" ;
	// 			$this->end_with( $result ) ;
	// 		}
	// 		// перевіряємо тип файлу (розширення) на перелік допустимих
	// 		$ext = pathinfo( $_FILES[ 'user-avatar' ][ 'name' ], PATHINFO_EXTENSION ) ;
	// 		if( strpos( ".png.jpg.bmp", $ext ) === false ) {
	// 			$result[ 'data' ][ 'message' ] = "File type error" ;
	// 			$this->end_with( $result ) ;
	// 		}
	// 		// генеруємо ім'я для збереження, залишаємо розширення
	// 		do {
	// 			$filename = uniqid() . "." . $ext ;
	// 		}  // перевіряємо чи не потрапили в існуючий файл
	// 		while( is_file( "./wwwroot/avatar/" . $filename ) ) ;
			
	// 		// переносимо завантажений файл до нового розміщення
	// 		move_uploaded_file( 
	// 			$_FILES[ 'user-avatar' ][ 'tmp_name' ],
	// 			"./wwwroot/avatar/" . $filename ) ;
	// 	}
		
	// 	$db = $this->connect_db_or_exit() ;
		
	// 	// Оновлення даних профілю в базі даних
	// 	$sql = "UPDATE Users SET name = ?, email = ?, password = ?, avatar = ? WHERE id = ?";
	// 	try{
	// 		$stmt = $db->prepare($sql);
	// 		$stmt->execute([$user_name, $user_email, md5($user_password), $filename, $user['id']]);
	// 		// // Оновлення даних у сесії
	// 		// $user['name'] = $user_name;
	// 		// $user['email'] = $user_email;
	// 		// $user['password'] = $user_password;
	// 		// $user['avatar'] = $filename;
	// 		// $_SESSION['user'] = $user;			
	// 	}
	// 	catch( PDOException $ex ) {
	// 			http_response_code( 500 ) ;
	// 			echo "query error: " . $ex->getMessage() ;				
	// 			exit ;	
	// 		}
		
	// 	$result[ 'status' ] = 1 ;
	// 	$result[ 'data' ][ 'message' ] = "Update OK" ;
	// 	$this->end_with( $result ) ;


	// 	// // 1. у запиті залишаються "плейсхолдери" - знаки "?"
	// 	// $sql = "INSERT INTO Users(`email`,`name`,`password`,`avatar`) VALUES(?,?,?,?) ";
		
	// 	// try {                        
	// 	// 	$prep = $db->prepare( $sql ) ;  // 2. Запит готується
	// 	// 	// 3. Запит виконується з передачею параметрів
	// 	// 	$prep->execute( [
	// 	// 		$user_email,
	// 	// 		$user_name,
	// 	// 		md5( $user_password ),
	// 	// 		$filename
	// 	// 	] ) ;
	// 	// }                         
	// 	// catch( PDOException $ex ) {
	// 	// 	http_response_code( 500 ) ;
	// 	// 	echo "query error: " . $ex->getMessage() ;
	// 	// 	exit ;
	// 	// }
		
	// 	// $result[ 'status' ] = 1 ;
	// 	// $result[ 'data' ][ 'message' ] = "Signup OK" ;
	// 	// $this->end_with( $result ) ;
	// }
}