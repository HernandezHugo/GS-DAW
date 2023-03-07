<?php

$files = scandir("./list_weather");
$today = date("Y-m-d", time());
$myHour = date("H-i", time());

echo '<pre>';
echo var_dump($files);
echo '</pre>';


foreach ($files as $file) {

    $doc_name_array = explode("_", $file);

    if (count($doc_name_array) > 1) {
        echo '<pre>';
        echo var_dump($doc_name_array);
        echo '</pre>';


        if ($doc_name_array[0] == $today) {
            echo 'hey';
        }
        if ($doc_name_array[1] > $myHour) {
            echo 'Yow';
        }
    }
}
