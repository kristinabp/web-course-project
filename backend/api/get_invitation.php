<?php
    $phpInput = json_decode(file_get_contents('php://input'), true);
    require_once "../classes/invitation.php";

    $invitation = new Invitation($phpInput['title'], $phpInput['fn'], $phpInput['date'], $phpInput['time'], $phpInput['subject'],
                    $phpInput['place']);


    try {
        $invitation->validate();
        $invitation->insertInvitation();
        $userRole = $invitation->getUserRole();
        echo json_encode(['success' => true, 'role' => $userRole]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage(),
        ]);
    }
?>
