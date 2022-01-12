<?php
    session_start();

    $phpInput = json_decode(file_get_contents('php://input'), true);
    require_once "../classes/invitation.php";

    $invitation = new Invitation($phpInput['title'], $phpInput['date'], $phpInput['time'], $phpInput['subject'],
                    $phpInput['place'], $_SESSION['id']);


    try {
        $invitation->validate();
        $invitation->insertInvitation();
        echo json_encode(['success' => true, 'role' => $_SESSION['role_id']]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage(),
        ]);
    }
?>
