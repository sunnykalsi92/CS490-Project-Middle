<?php


	$questionIDs = $_POST['questionIDs'];
	$points = $_POST['points'];


	$examName = $_POST['examname'];

	$reply = '1';
	$i=0;
	foreach($questionIDs as $value){
    $url = "https://web.njit.edu/~sk2773/questiontoexam.php";
	  $ch = curl_init($url);

	  $exam = array('questionID' => $questionIDs[$i],'examname' => $examName, 'points' => $points[$i]);
	  $postString = http_build_query($exam, '', '&');
	  curl_setopt($ch, CURLOPT_POST, 1);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  $result = curl_exec($ch);
	  curl_close($ch);
	  $i = $i+1;

	  $value = json_decode($result, true);
		if($value['response'] != "200"){
			$reply = '0';
		}
	}
header('Content-Type: application/json');
	echo json_encode(array('response'=>$reply));

?>