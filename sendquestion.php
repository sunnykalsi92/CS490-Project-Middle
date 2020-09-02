<?php

$topic = $_POST['topic'];
$difficulty = $_POST['difficulty'];
$question = $_POST['question'];
$functionname = $_POST['functionname'];
$testcases = $_POST['testcases'];
$constr = $_POST['constr'];
$testcasenum = $_POST['testcasenum'];


//pacakage data and send to backend
$url = "https://web.njit.edu/~sk2773/questiontobank.php"; 


$ch = curl_init($url);

//open connection

$q = array('testcases' => $testcases, 'testcasenum' => $testcasenum,  'constr'=> $constr, 'topic' => $topic,'difficulty' => $difficulty, 'question' => $question, 'functionname' => $functionname, 'testcasenum' => $testcasenum);
$postString = http_build_query($q, '', '&');

//set options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
echo $result;
curl_close($ch);

?>