<?php

    class Invitation {
        public $title;
        public $fn;
        public $date;
        public $time;
        public $subject;
        public $place;

        public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

        public function __construct6($title, $fn, $date, $time, $subject, $place) {
            $this->title = $title;
            $this->fn = $fn;
            $this->date = $date;
            $this->time = $time;
            $this->subject = $subject;
            $this->place = $place;
        }

        public function __construct7($title, $date, $time, $subject, $place, $user_id, $dump) {
            $this->title = $title;
            $this->date = $date;
            $this->time = $time;
            $this->subject = $subject;
            $this->place = $place;
            $this->fn = getUserFn($user_id);
        }

        private function getUserFn($id): int
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

            $sql = "SELECT users.fn 
                    FROM invitations 
                    join users on invitations.user_id = users.id 
                    WHERE users.id = $id";
            $stmt = $connection->prepare($sql);
            $userId = $selectStatement->fetch();
            return $userId;
        }

        public function validate(): void
        {
            if(empty($this->title))
            {
                throw new Exception("Името на презентацията е задължително.");
            }
            if(empty($this->date))
            {
                throw new Exception("Датата е задължителна.");
            }
            if(empty($this->time))
            {
                throw new Exception("Часът е задължителен.");
            }
            if(empty($this->subject))
            {
                throw new Exception("Името на предмета е задължително.");
            }
            if(empty($this->fn))
            {
                throw new Exception("Факултетният номер е задължителен.");
            }

        }

        public function insertInvitation(): void
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

            $user_id = getUserId();
            $sql = "INSERT INTO invitations (title, date, time, subject, place, user_id) VALUES (:title, :date, :time, :subject, :place, :user_id)";
            $stmt = $connection->prepare($sql);
            $insertResult = $stmt->execute([
                "title"=>$this->title, 
                "date"=>$this->date, 
                "time"=>$this->time, 
                "subject"=>$this->subject, 
                "place"=>$this->place,
                "user_id"=>$user_id]);
            
            if (!$insertResult) {
                $errorInfo = $insertStatement->errorInfo();
                $errorMessage = "Грешка при запис на информацията.";
                throw new Exception($errorMessage);
            }
	
        }

        private function getUserId(): int
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

            $sql = "SELECT users.id 
                    FROM invitations 
                    join users on invitations.user_id = users.id 
                    WHERE users.fn = $this->fn";
            $stmt = $connection->prepare($sql);
            $userId = $selectStatement->fetch()[0];
            return $userId;
        }

        public function getUserRole(): int
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

            $sql = "SELECT users.role_id 
                    FROM invitations 
                    join users on invitations.user_id = users.id 
                    WHERE users.fn = $this->fn";
            $stmt = $connection->prepare($sql);
            $userRole = $selectStatement->fetch()[0];
            return $userRole;
        }
    }


?>