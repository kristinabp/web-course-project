<?php
    session_start();

    require_once "../db/db.php";
    require_once "../classes/invitation.php";
    require_once "../classes/user.php";

    function getInvitations($connection) {
	    $sql = "SELECT * FROM `invitations`";
	    $query = $connection->prepare($sql);
	    $query->execute([]);

        $invitations = array();
	    while ($row = $query->fetch()) {
            $invitation = new Invitation($row['title'], $row['date'], $row['time'], $row['subject'], $row['place'],$row['user_id']);
            array_push($invitations, $invitation);
	    }
    	return $invitations;
    }

    function getUsers($connection)
    {
        $sql = "SELECT * FROM `users` WHERE `role_id` = 7 ";
        $query = $connection->prepare($sql);
        $query->execute([]);

        $users = array();
        $invitations = getInvitations($connection);

        while($row=$query->fetch())
        {  
        $upload=UserInv($row['id'],$invitations);
        $user=array('fn'=>$row['fn'],'username'=>$row['username'],'upload'=>$upload);
    
           array_push($users,$user);
        }
    
        return $users;
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

    $users=getUsers($connection);

    $response = json_encode([
        'success' => true,
        'message' => "Списък от всички покани.",
        'value' => $users,
    ]);



    function UserInv($id,$invitations)
    {
    $inv=(array)$invitations;
 
        foreach($inv as $invite)
      {
        $idd=$invite->user_id;
        if($idd==$id)
         {   
             return "Качил";  
         }
      }
       return "Некачил";
    }


    echo $response;
 ?>