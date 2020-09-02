<?php
// receive data from front end

  $user = $_POST['user'];
  $pass = $_POST['pass'];


//pacakage data and send to backend
  $url = "https://web.njit.edu/~sk2773/login.php";


  $ch = curl_init($url);

//open connection

  $data = array('user' => $user,'pass' => $pass);
  $postString = http_build_query($data, '', '&');

//curl_setopt($ch, CURLOPT_URL,  $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);



  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $result = curl_exec($ch);
  curl_close($ch);

  echo $result;

?>