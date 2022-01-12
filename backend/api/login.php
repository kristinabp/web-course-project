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
           $user_info= $user->checkLogin();
           //var_dump($user_info);

            $_SESSION['username'] = $user_info['username'];
            $_SESSION['id']=$user_info['id'];
            $_SESSION['role_id']=$user_info['role_id'];

           // var_dump($_SESSION);
          

            echo json_encode([
                'success' => true,
                'username' => $_SESSION['username'],
                'role' => $_SESSION['role_id'],
                
                
            ]);
            
        } catch (Exception $e) {
            
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
                'role' =>false,
            ]);
        }
    }  
}
?>
