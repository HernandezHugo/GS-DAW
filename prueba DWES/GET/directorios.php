<?php

$files = scandir("./list_weather");
$today = date("Y-m-d", time());
$enabledHour = date("H-i", time() - 1740);

//1740

echo $today;
echo "<br>";
echo $enabledHour;

$idk2 = explode("_", $files[2]);

echo '<pre>';
echo var_dump($idk2);
echo '</pre>';


echo $_SERVER["SERVER_NAME"];
//echo '<pre>';
//echo var_dump($files);
//echo '</pre>';

//$idk = explode("_",end($files));
//echo '<pre>';
//echo var_dump($idk);
//echo '</pre>';
//echo $idk[1];


if ($idk2[0] >= $today) {
    if ($idk2[1] > $enabledHour) {
        echo 'Yow';
    }
}


/* foreach ($files as $file) {

    $doc_name_array = explode("_", $file);

    if (count($doc_name_array) > 1) {
        echo '<pre>';
        echo var_dump($doc_name_array);
        echo '</pre>';

        if ($doc_name_array[0] == $today) {
            echo 'hey';
        }
        if ($doc_name_array[1] < $enabledHour) {
            echo 'Yow';
        }
    }
} */
