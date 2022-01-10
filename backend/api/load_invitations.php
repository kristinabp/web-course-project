<?php

require_once "../db/db.php";
require_once "../classes/invitation.php";

function getInvitations($connection) {
	$sql = "SELECT * FROM `invitations`";
	$query = $connection->prepare($sql);
	$query->execute([]);

  $invitations = array();
	while ($row = $query->fetch()) {
    $invitations = new Invitation($row['title'], $row['date'], $row['time'], $row['subject'], $row['place'], $row['user_id'], "dump");
    array_push($invitations, $invitation);
	}
	return $invitations;
}

try {
  $database = new DB();
  $connection = $database->getConnection();
  echo json_encode([
    'success' => true,
'message' => "успешно свързване с базата данни",
]);
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
  'message' => "Списък от покани",
  'value' => $invitations
]);

echo $response;

?>