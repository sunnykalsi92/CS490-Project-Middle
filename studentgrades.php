<?php
$user = $_POST['user'];  
$examname = $_POST['examname'];


//receive data from backend
$url = "https://web.njit.edu/~sk2773/getfinalresults.php"; 
$ch = curl_init($url);

$userRequest = array('student' => $user, 'exam' => $examname);
$postString = http_build_query($userRequest, '', '&');


curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

echo $result

?>