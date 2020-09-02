<?php

//Section 1: Recieve & Set main Vairabls from Front - CHECK
$examname = $_POST['examname'];
//$examname = 'ggTest';
//$answers = ["def addOne(x):\n return(x+1)"];
$answers = $_POST['answers'];
$questionIDs = $_POST['questionids'];
//$questionIDs = [93]; 
//$username = 'student';
$username = $_POST['student'];
//$qpoints = [25];
$qpoints = $_POST['qpoints'];
$i = 0;

foreach($questionIDs as $value){
  //Section 2: Send Question ID to back and recieve Response  - CHECK
  $answer = urldecode($answers[$i]);
  $url = "https://web.njit.edu/~sk2773/checkanswer.php";
  $ch = curl_init($url);
  $questionID = array('questionID' => $value);
  $postString = http_build_query($questionID, '', '&');
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);

  //Section 3: Go Through Backends data and parse for information I want - CHECK
  $out = json_decode($result, true);
  $arr = $out[0];
  $functionName = $arr['functionname'];
  $numOfCases = $arr['testcasenum']; 
  $constr = $arr['const']; 
  $tc = $arr['testcases'];
  $testcases = array(); 
  $j=0;
  while($j < $numOfCases){
    array_push($testcases, urldecode($tc[$j]["testcase"]));
    $j+=1; 
  }
  
  //Section3.5: Create Dynamic Points to be Subtracted - working 
 
  if ($constr == 'none'){
   $other = 2; 
  } else {
    $other = 3; 
  }
  $perc = $numOfCases + $other; 
  $takeaway = -floor($qpoints[$i]/$perc);
 
  //Section 4: Get Grades
  // 4.1 get the functionNameGrade and/or Replace FunctionName  -working
  $lose = strstr($answer, "(");
  $fnc = " ".$functionName;
  $badFunc = str_replace($lose, "", $answer);
  if ("def"." ".$functionName != $badFunc) {
    $funcNameGrade = $takeaway; 
    $fn = strstr($badFunc, " "); 
    $answer = str_replace($fn, $fnc, $answer); 

  } else{
    $funcNameGrade = 0; 
  }
  
  //4.2 Constraint Checker - working
  if ($constr == 'none') {
    $constrGrade = 0;
  } else{
    $constrcheck = strpos($answer, $constr);
    if ($constrcheck == false){
      $constrGrade = $takeaway;
    } else {
      $constrGrade = 0;
      }
    }
  
  //4.3 Colon Check - working
  $firstLine = strstr($answer,"\n",true);
  $colonCheck = $firstLine[strlen($firstLine)- 1];
   if ($colonCheck == ':') {
      var_dump(1);
      $colonGrade = 0;
      } elseif ($colonCheck == " "){
        $e = 1; 
        $cc = $firstLine[strlen($firstLine)- $e];
        while($cc == " "){
          $cc = $firstLine[strlen($firstLine)- $e];
          $e+=1;
        }
        if($cc == ":") {
          var_dump(2);
          $colonGrade = 0; 
          $f = -($e-2);
          $fl = substr($firstLine, 0, $f); 
          $loss = strstr($answer, "\n");
          $answer = $fl.$loss; 
        } else{
          var_dump(3);
          $colonGrade = $takeaway; 
          $f = -($e-2);
          $fl = substr($firstLine, 0, $f); 
          $loss = strstr($answer, "\n");
          $answer = $fl.":".$loss; 
        }
      }else{
      var_dump(4);
      $colonGrade = $takeaway;
      $loss = strstr($answer, "\n");
      $gf = $firstLine.":";
      $answer = $gf.$loss;
    }

  
  // 4.4 Check Test Cases - working
  $p = 0;
  $testCaseGrades = array();
  $testCaseQuestions = array();
  $testCaseAnswers = array();
  $testCaseResults = array(); 
  while ($p <$numOfCases){
    $out = array();
    $tc = $testcases[$p]; 
    $tca = substr($tc, strpos($tc, ">") +2);
    $tcq = substr($tc, 0, strpos($tc, "->")); 
    if($constr == 'print'){
      if(strpos($answer, $constr) == True){
        $tester = $tcq;  
        }else{
        $tester = 'print(str('.$tcq.'))';
        }      
    } else{
      $tester = 'print(str('.$tcq.'))';
    }
    if ($answer[0] == ' ') {
      $newanswer = substr($answer, 1);
    }else {
    $newanswer = $answer; 
    }
    $newfile = $newanswer."\n".$tester;
    file_put_contents("q.py", $newfile);
    exec('python q.py', $out);
    if ($out[0] != $tca){
      $testcasescore = $takeaway;
      array_push($testCaseGrades, $testcasescore); 
      } else{
      $testcasescore = 0;
      array_push($testCaseGrades, $testcasescore); 
      }
    array_push($testCaseQuestions, urlencode($tcq));
    array_push($testCaseAnswers, urlencode($tca));
    array_push($testCaseResults, urlencode($out[0]));
    $p+=1;
    }
    

  //4.5 Get Total Grade - working
  $autograde = $qpoints[$i] + $funcNameGrade + $constrGrade + $colonGrade;
  $a = 0;
  while ($a < $numOfCases) {
    $autograde += $testCaseGrades[$a]; 
    $a +=1;
  }
  $posTak = $takeaway * -1;
  if( $autograde <=  $posTak){
      $funcNameGrade-= $autograde;
      $autograde = 0;
  }
  file_put_contents('ag.txt', $funcNameGrade."\n".$autograde);

//Section 6. Send Results to the Back

  $url = "https://web.njit.edu/~sk2773/saveresult.php";
  $ch = curl_init($url);
  $ag = array('testCaseGrades' => $testCaseGrades, 'student' => $username, 'functionnamescore' => $funcNameGrade, 'constraintscore' => $constrGrade, 'colonscore' => $colonGrade, 'testcasenum' => $numOfCases, 'answer' => $answers[$i], 'qpoints' => $qpoints[$i], 'exam' => $examname, 'questionid' => $questionIDs[$i], 'autograde' => $autograde, 'testcaseq' => $testCaseQuestions, 'testcasea' => $testCaseAnswers, 'testcaser' => $testCaseResults);
  $postString = http_build_query($ag, '', '&');
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  

//Section 7. Start the Loop Again
  $i+=1;   
}


?>