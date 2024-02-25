<?php

class ApiController {

    public function serve() {
        $method = strtolower($_SERVER['REQUEST_METHOD']) ; //метод запиту -GET, POST
        $action = "do_{$method}";
        //чи визначений у даному об'єкті метод з іменем $action
        if(method_exists($this,$action)){
            //якщо визначений, то викликаємо
            $this->$action();
            // $this->$action() == $this->do_get()
        }
        else{
            http_response_code(405);
            echo "Method Not Allowed";
        }
    }

    protected function connect_db_or_exit() {
        try {
            return new PDO(
                'mysql:host=localhost;dbname=php_spd_111;charset=utf8mb4', 
                'spd_111_user', 'spd_pass', [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]) ;

        } catch (PDOException $ex) {
            http_response_code(500);
            echo "Connection error: ".$ex->getMessage();
            exit;
        }
    }

    protected function end_with($result) {
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

}