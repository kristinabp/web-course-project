<?php
//echo "hello";
$post = json_decode(file_get_contents("php://input"), true);
 

if(isset($post["user_id"])){
    // Get parameters

   
    $file = $post["user_id"]; // Decode URL-encoded string
    $imageFileType=$post["extension"];
    /* Check if the file name includes illegal characters
    like "../" using the regular expression */
    if(preg_match('/^[0-9]+$/i', $file)){
        $filepath = "../../frontend/images/" . $file .  '.' . $imageFileType;

        // Process download
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);

            die();
        } else {
            http_response_code(404);
	        die();
        }
    } else {
        die("Invalid file name!");
    }
}
?>