<?php
session_start();

// $phpInput = json_decode(file_get_contents('php://input'), true);
require_once "../classes/invitation.php";


$invitation = new Invitation(
  $_POST['title'],
  $_POST['date'],
  $_POST['time'],
  $_POST['subject'],
  $_POST['place'],
  $_SESSION['id']
);


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

////////////////

$target_dir = "../../frontend/images/";
$ext = explode('.', $_FILES["invitation"]["name"]);
$imageFileType = strtolower($ext[1]);

$target_file = $target_dir . basename($_SESSION['id']) .  '.' . $imageFileType;
$uploadOk = 1;

//var_dump($target_file );
//var_dump($imageFileType);


// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["invitation"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
// var_dump($_FILES["invitation"]["name"]);
//var_dump($_FILES["invitation"]["type"]);
//var_dump($_FILES["invitation"]["size"]);
//var_dump($_FILES["invitation"]["tmp_name"]);


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["invitation"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg"
  && $imageFileType !== "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["invitation"]["tmp_name"], $target_file)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["invitation"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
