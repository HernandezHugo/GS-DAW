<?php

$q = $_GET["q"] ?? '';

$date = date("Y-m-d_H-i", time());

if ($q) {
  $json_weather = fopen($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/accu' . $date . "_weatherObj.json", "w");
  $q_decode = json_encode($q);
  fwrite($json_weather, json_decode($q_decode));
}
