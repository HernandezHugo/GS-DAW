<?php

$q = $_GET["q"] ?? '';

$date = date("Y-m-d_H-i", time());

if ($q) {
  $q_decode = json_encode($q);

  
  $json_weather = fopen('../accu/' . $date . "_weatherObj.json", "w");
  fwrite($json_weather, json_decode($q_decode));
}
