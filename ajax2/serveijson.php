<?php

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");

header('Content-Type: application/json');

try {
$fileContents = file_get_contents("server.conf");
} catch (Exception $e) {
    echo "El servei no troba el fitxer de configuració";
}
$array = explode(",", $fileContents);
$host = str_replace("host:", "", $array[0]);
$dbname = str_replace("dbname:", "", $array[1]);
$user = str_replace("user:", "", $array[2]);
$password = str_replace("password:", "", $array[3]);
$options = "host=$host dbname=$dbname user=$user password=$password";


//L'usuari jsonuser només té permisos per a fer consultes select
try {
    //$dbconn = pg_connect("host=localhost dbname=postgres user=jsonuser password=jsonuser");
    $dbconn = pg_connect($options);
}   catch (Exception $e) {
            $myObj = new stdClass;
    
    if (!strpos($e, "autentifi")) 
        $myObj->error="Can't connect to db";
    else
        $myObj->error="Authentication error";

    $myJson = json_encode($myObj);
    echo $myJson;
    return;
}



//$query = 'SELECT * FROM json.registre';

$query = $_REQUEST["q"];

try {
$result = pg_query($query);
} catch (Exception $e) {
    $myObj = new stdClass;
    
    if (strpos($e, "permiso denegado")) 
        $myObj->error="You don't have permission to do this query.";
    else
        $myObj->error="Query error.";

    $myJson = json_encode($myObj);
    echo $myJson;
    return;
}

if (pg_num_rows($result) < 1) {
    $myObj = new stdClass;
    $headArray = [];
    $count = 0;

    $i = pg_num_fields($result);
  for ($j = 0; $j < $i; $j++) {
      $fieldname = pg_field_name($result, $j);
      array_push($headArray, $fieldname);
  }

    $myObj->result="No rows found";
    $myObj->headers=$headArray;
    $myJson = json_encode($myObj);
    echo $myJson;
    return;
}

while($row = pg_fetch_assoc($result))
    {
        $data[] = $row;
    }

    if(isset($data))
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    ?>
