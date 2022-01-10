<?php

    require_once "../backend/db/db.php";

    session_start();
    var_dump($_SESSION);

    if(isset($_SESSION["user"]))
    {
        try {

            $db = new DB();
            $connection = $db->getConnection();

            $sql = "SELECT * 
            FROM invitations join users on invitations.user_id = users.id";
            $stmt = $connection->prepare($sql);
            $stmt->execute($_SESSION["user"]["id"]);
            $invitations= $stmt->fetchAll(PDO::FETCH_ASSOC);
            var_dump($invitations);


        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["status" => "ERROR", "message" => $e]);
        }
    }
    else
    {
        http_response_code(401);
        echo json_encode(["message" => "Потребителят не е ..."]);
    }
?>