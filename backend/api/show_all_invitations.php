<?php
    session_start();

    require_once "../db/db.php";
    require_once "../classes/invitation.php";

    function getInvitations($connection) {
	    $sql = "SELECT * FROM `invitations`";
	    $query = $connection->prepare($sql);
	    $query->execute([]);

        $invitations = array();
	    while ($row = $query->fetch()) {
            $invitation = new Invitation($row['title'], $row['date'], $row['time'], $row['subject'], $row['place'], $_SESSION['id']);
            array_push($invitations, $invitation);
	    }
    	return $invitations;
    }

    try {
        $database = new DB();
        $connection = $database->getConnection();
    }
    catch (PDOException $e) {
	    echo json_encode([
		    'success' => false,
            'message' => "Неуспешно свързване с базата данни",
            'value' => null
        ]);
        exit();
    }

    $invitations = getInvitations($connection);

    $response = json_encode([
        'success' => true,
        'message' => "Списък от всички покани.",
        'value' => $invitations,
    ]);

    echo $response;

?>