<?php
  $answer = "operation('-', 14, 2) -> 12";
  $q = substr($answer, 0, strpos($answer, "->"));
  var_dump($q);
  
?>