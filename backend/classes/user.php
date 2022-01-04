<?php

    class User {

        public $id;
        public $fn;
        public $username;
        public $password;
        public $password2;
        public $role;
        public $email;

        function __construct($username, $password, $password2, $role, $email, $fn) {
            $this->username = $username;
            $this->password = $password;
            $this->password2 = $password2;
            $this->role = $role;
            $this->email = $email;
            $this->fn = $fn;
        }

        public function validate(): void
        {
            if(empty($this->username))
            {
                throw new Exception("Потребителското име е задължително.");
            }
            if(empty($this->password))
            {
                throw new Exception("Паролата е задължителна.");
            }
            if(empty($this->password2))
            {
                throw new Exception("Паролата е задължителна.");
            }
            if(empty($this->email))
            {
                throw new Exception("Имейлът е задължителен.");
            }
            if(empty($this->fn))
            {
                throw new Exception("Факултетният номер е задължителен.");
            }

            //username
            if(strlen($this->username)<2)
            {
                throw new Exception("Потребителското име трябва да е поне 2 символа.");
            }

            //password
            if($this->password != $this->password2)
            {
                throw new Exception("Паролите не съвпадат");
            }
            if(strlen($this->password) < 8)
            {
                throw new Exception("Паролата трябва да е поне 8 символа.");
            }
            
            //email
            $regex = "/^[a-z0-9_]+@[a-z]+\.[a-z]+$/";

            if (!preg_match($regex, $this->email)) {
                throw new Exception("Невалиден email.");
            }

            //fn
            if(strlen($this->fn)>5)
            {
                throw new Exception("Факултетният номер трябва да е най-много 5 цифри.");
            }

        }

        public function insertUser(): void
        {
            require_once "../db/db.php";

            try{
                $db = new DB();
                $connection = $db->getConnection();
            }
            catch (PDOException $e) {
                echo json_encode([
                    'success' => false,
                    'message' => "Неуспешно свързване с базата данни",
                ]);
            }

            $this->password = password_hash($this->password , PASSWORD_DEFAULT);
            $this->password2 = password_hash($this->password2, PASSWORD_DEFAULT);


            $sql = "INSERT INTO users (fn, username, password, role_id, email) VALUES (:fn, :username, :password, :role_id, :email)";
            $stmt = $connection->prepare($sql);
            $insertResult = $stmt->execute([
                "fn"=>$this->fn, 
                "username"=>$this->username, 
                "password"=>$this->password, 
                "role_id"=>$this->role, 
                "email"=>$this->email]);
            
            if (!$insertResult) {
                $errorInfo = $insertStatement->errorInfo();
                $errorMessage = "";
                
                if ($errorInfo[1] == 1062) {
                    $errorMessage = "Потребителското име вече съществува.";
                } else {
                    $errorMessage = "Грешка при запис на информацията.";
                }
                throw new Exception($errorMessage);
            }
	
        }
	    
	    public function checkLogin(): void {
        
            require_once "../db/db.php";
    
            try{
                $db = new DB();
                $conn = $db->getConnection();
            }
            catch (PDOException $e) {
                echo json_encode([
                    'success' => false,
                    'message' => "Неуспешно свързване с базата данни",
                ]);
                exit();
            }
            
            $selectStatement = $conn->prepare("SELECT * FROM `users` WHERE username = :username");
            $result = $selectStatement->execute(['username' => $this->username]);
            
            $dbUser = $selectStatement->fetch();
            if ($dbUser == false) {
                throw new Exception("Грешно потребителско име.");
            }
            
            if (!password_verify($this->password, $dbUser['password'])) {
                throw new Exception("Грешна парола.");
            }
    
        }


    }


?>
