<?php

$modelsVolkswagen[] = "Golf";
$modelsVolkswagen[] = "Polo";
$modelsVolkswagen[] = "Passat";
$modelsVolkswagen[] = "Tiguan";
$modelsVolkswagen[] = "Caddy";
$modelsVolkswagen[] = "Touran";
$modelsVolkswagen[] = "Touareg";

$modelsSeat[] = "Leon";
$modelsSeat[] = "Ibiza";
$modelsSeat[] = "Ateca";
$modelsSeat[] = "Tarraco";
$modelsSeat[] = "Alhambra";

$modelsBmw[] = "Serie 3";
$modelsBmw[] = "Serie 1";
$modelsBmw[] = "X5";
$modelsBmw[] = "X1";
$modelsBmw[] = "X6";
$modelsBmw[] = "Z4";

$modelsAudi[] = "A1";
$modelsAudi[] = "A3";
$modelsAudi[] = "A4";
$modelsAudi[] = "A6";
$modelsAudi[] = "Q3";
$modelsAudi[] = "Q5";



// get the q parameter from URL
$q = $_REQUEST["q"];

$html = "";

switch ($q) {
    case 'seat':
        $useArray = $modelsSeat;
        break;
    case 'audi':
        $useArray = $modelsAudi;
        break;
    case 'volkswagen':
        $useArray = $modelsVolkswagen;
        break;
    case 'bmw':
        $useArray = $modelsBmw;
        break;
}

foreach ($useArray as $model) {
    echo "<option value=\"$model\">$model</option>";
}

?>