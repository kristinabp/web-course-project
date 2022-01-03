
<?php

session_start();

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['username']) || !isset($input['password'])) {
    echo json_encode([
        'success' => false,
        'message' => "Моля, попълнете потребителско име и парола.",
    ]);
} else {

    if (empty($input['username']) || empty($input['password'])) {
        echo json_encode([
            'success' => false,
            'message' => "Моля, попълнете потребителско име и парола.",
        ]);
    }
    else {

        $username = $input['username'];
        $password = $input['password'];

        require_once "../classes/User.php";

        $user = new User( $input['username'], $input['password'], null, null, null, null);

        try {

            $user->checkLogin();
            

            $_SESSION['username'] = $input['username'];

            echo json_encode([
                'success' => true,
                'username' => $_SESSION['username'],
            ]);
            
        } catch (Exception $e) {
            
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }  
}