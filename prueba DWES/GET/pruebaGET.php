<?php

$q = $_GET["q"] ?? '';
$today = date("Y-m-d", time());
$myHour = date("H-i", time());

$date = date("Y-m-d_H-i", time());


if ($q !== "") {
  $json_weather = fopen("./list_weather/" . $date . "_weatherObj.json", "w");
  $q_decode = json_encode($q);
  fwrite($json_weather, json_decode($q_decode));
}
