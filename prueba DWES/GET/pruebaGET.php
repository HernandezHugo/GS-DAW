<?php

$q = $_GET["q"] ?? '';

$files = scandir("./list_weather");
$today = date("Y-m-d", time());
$enabledHour = date("H-i", time() - 1740);

$date = date("Y-m-d_H-i", time() - 86400);


if ($q) {
  $json_weather = fopen("./list_weather/" . $date . "_weatherObj.json", "w");
  $q_decode = json_encode($q);
  //fwrite($json_weather, json_decode($q_decode));
}
