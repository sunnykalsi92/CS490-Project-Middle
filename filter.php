<?php
// receive question query from front end
  $topic = $_POST['topic'];
  $difficulty = $_POST['difficulty'];
  $keyword = $_POST['keyword'];

  //pacakage data and send to backend
  $url = "https://web.njit.edu/~sk2773/getquestions.php";   


  $ch = curl_init($url);

//open connection

  $query = array('topic' => $topic,'difficulty' => $difficulty, 'keyword' => $keyword);
  $postString = http_build_query($query, '', '&');

//set options
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $result = curl_exec($ch);
  curl_close($ch);

  echo $result;

?>