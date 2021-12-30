<?php

    $phpInput = json_decode(file_get_contents('php://input'), true);
    require_once "../classes/user.php";

    $user = new User($phpInput['username'], $phpInput['password'], $phpInput['password2'], $phpInput['role'], $phpInput['email'],
                    $phpInput['fn']);


    try {
        $user->validate();
        $user->insertUser();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage(),
        ]);
}
