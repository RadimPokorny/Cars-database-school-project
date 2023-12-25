<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

<?php

//Pokud budu chtít smazat záznamy, použiju sql dotaz: ALTER TABLE carsinfo AUTO_INCREMENT = 1 ALTER TABLE cars AUTO_INCREMENT = 1;
function getCars($id) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mycars";

    $response = array();

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT cars.id, cars.prd_year, cars.price, cars.photo, models.model_name, carsinfo.vykon, carsinfo.palivo, carsinfo.pocet_dvere, carsinfo.barva, carsinfo.tachometr_stav, carsinfo.prevodovka, carmakes.makename
    FROM cars
    INNER JOIN models ON cars.models_id = models.id
    INNER JOIN carmakes ON models.carmakes_id = carmakes.id
    LEFT JOIN carsinfo ON cars.id = carsinfo.id
    WHERE carmakes_id=?";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result

    $znacka = $_GET["znacka"];

    if ($result !== false && ($result->num_rows > 0)) {

        echo '<div class="cars-box">';

        while ($row = $result->fetch_row()) {

            $array = array($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $znacka);

            echo'<div class="car-box">';
            echo '<img src="' . $row[3] . '"></img>'; //Obrázek
            echo '<p class="model">'.$row[11]. ' ' . $row[4] . '</p>'; //Model auta
            echo '<p>Datum výroby: ' . $row[1] . '</p>';
            echo '<p class="cena" >Cena: ' . $row[2] . '</p>'; //Cena
            echo '
                <form method="post" action="newpage.php">
                <input type="hidden" name="car_data[]" value="' . implode(',', $array) . '"/>
                <input type="hidden" name="znacka" value="'.$znacka.'"/>
                <input type="submit" name="submit" value="Víc info" /> 
                </form>
            
            ';

            
            echo '</div>';


        }
        echo '</div>';

    } else {
        echo "No results found.";
    }

    

    $result->free_result();
}


getCars($_GET["znacka"]);

?>
</body>

</html>
