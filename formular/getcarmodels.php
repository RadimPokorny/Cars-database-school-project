<?php
        // Připojení k databázi
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mycars";


        getCarModels();

function getCarModels(){

global $servername, $username, $password, $dbname;

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM models";
$result = $conn->query($sql);
// echo "Pocet modelu je" . $result->num_rows;
return $result;
}


?>