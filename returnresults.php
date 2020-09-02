<?php
// receive request from front 
$username = $_POST['username']; 

$examname = $_POST['examname'];


//pass the request to the back
$url = "https://web.njit.edu/~sk2773/getautograded.php"; 

$ch = curl_init($url);

$tgr = array('student' => $username, 'exam' => $examname);
$postString = http_build_query($tgr, '', '&');

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//get the auto-graded results from db 
$result = curl_exec($ch);
curl_close($ch);

//  echo the results to front 
echo $result;

?>