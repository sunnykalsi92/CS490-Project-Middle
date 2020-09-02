<?php
//Section 1: Receive Info From Front
  $exam = $_POST['exam']; 
  $teachergrade = $_POST['teachergrade'];
  $functionnamec = $_POST['functionnamec'];
  $comment = $_POST['comment'];
  $questionid = $_POST['questionid'];
  $student = $_POST['student'];
  $reply = '1';
  $testCaseNums = $_POST['testcasenum']; 
  $testcases1 = $_POST['test1c'];
  $testcases2 = $_POST['test2c']; 
  $testcases3 = $_POST['test3c'];
  $testcases4 = $_POST['test4c'];
  $colongrade = $_POST['colon'];
  $constrgrade = $_POST['constr'];
  
//Section 2: Set Counters
  $i = 0; 

//Section 3: Loop through each of the recieved questions to send individuall to back
  foreach ($questionid as $qid) {
    $url = "https://web.njit.edu/~sk2773/teachergrade.php";
    $test1c = $testcases1[$i]; 
    $test2c = $testcases2[$i]; 
    $test3c = $testcases3[$i]; 
    $test4c = $testcases4[$i]; 
    //Secton 3.2:  Send $updatedGrades to back
    $ch = curl_init($url);
    $updatedGrades = array('exam' => $exam, 'student' => $student, 'questionid' => $questionid[$i], 'comment' => $comment[$i], 'teachergrade' => $teachergrade[$i], 'functionnamec' => $functionnamec[$i], 'test1c' => $test1c, 'test2c' => $test2c, 'test3c' => $test3c, 'test4c' => $test4c,'testcasenum' =>  $testCaseNums[$i], 'colonscorec' => $colongrade[$i], 'constraintc' => $constrgrade[$i] );
    $postString = http_build_query($updatedGrades, '', '&');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $i = $i + 1;
    $result = curl_exec($ch);
    curl_close($ch);
    $value = json_decode($result, true);
    if($value['response'] != "200"){
            $reply = '0';
    }
  }
  header('Content-Type: application/json');
  echo json_encode(array('response'=>$reply));


?>