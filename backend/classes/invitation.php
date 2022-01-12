<?php

    class Invitation {
        public $title;
        public $user_id;
        public $date;
        public $time;
        public $subject;
        public $place;

        function __construct($title, $date, $time, $subject, $place, $user_id) {
            $this->title = $title;
            $this->date = $date;
            $this->time = $time;
            $this->subject = $subject;
            $this->place = $place;
            $this->user_id = $user_id;
        }

        public function validate(): void
        {
            if(empty($this->title))
            {
                echo $this->title;
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

            $sql = "INSERT INTO invitations (title, date, time, subject, place, user_id) VALUES (:title, :date, :time, :subject, :place, :user_id)";
            $stmt = $connection->prepare($sql);
            $insertResult = $stmt->execute([
                "title"=>$this->title, 
                "date"=>$this->date, 
                "time"=>$this->time, 
                "subject"=>$this->subject, 
                "place"=>$this->place,
                "user_id"=>$this->user_id]);
            
            if (!$insertResult) {
                $errorInfo = $insertStatement->errorInfo();
                $errorMessage = "Грешка при запис на информацията.";
                throw new Exception($errorMessage);
            }
	
        }
        
    }


?>