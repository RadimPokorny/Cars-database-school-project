<head>


<link rel="stylesheet" href="style.css">

</head>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mycars";

$znackaid = $_GET["id"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT cars.id, cars.prd_year, cars.price, cars.photo,
        carsinfo.vykon, carsinfo.palivo, carsinfo.pocet_dvere,
        carsinfo.barva, carsinfo.tachometr_stav, carsinfo.prevodovka
        FROM cars
        INNER JOIN carsinfo ON cars.id = carsinfo.id
        WHERE cars.id = $znackaid";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<form class="show-cars" method="post" action="">';
        echo '<input type="hidden" name="id" value="' . $row["id"] . '"/>';
        echo '<label>Rok výroby: <input type="text" name="prd_year" value="' . $row["prd_year"] . '"></label><br>';
        echo '<label>Cena: <input type="text" name="price" value="' . $row["price"] . '"></label><br>';
        echo '<label>Odkaz na obrázek: <input type="text" name="photo" value="' . $row["photo"] . '"></label><br>';
        echo '<label>Výkon: <input type="text" name="vykon" value="' . $row["vykon"] . '"></label><br>';
        echo '<label>Palivo: <input type="text" name="palivo" value="' . $row["palivo"] . '"></label><br>';
        echo '<label>Počet dveří: <input type="text" name="pocet_dvere" value="' . $row["pocet_dvere"] . '"></label><br>';
        echo '<label>Barva: <input type="text" name="barva" value="' . $row["barva"] . '"></label><br>';
        echo '<label>Tachometr stav: <input type="text" name="tachometr_stav" value="' . $row["tachometr_stav"] . '"></label><br>';
        echo '<label>Převodovka: <input type="text" name="prevodovka" value="' . $row["prevodovka"] . '"></label><br>';
        echo '<input type="submit" value="Uložit změny">';
        echo '</form>';        
    }




} else {
    echo "0 results";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prd_year = $_POST["prd_year"];
    $price = $_POST["price"];
    $photo = $_POST["photo"];
    $vykon = $_POST["vykon"];
    $palivo = $_POST["palivo"];
    $pocet_dvere = $_POST["pocet_dvere"];
    $barva = $_POST["barva"];
    $tachometr_stav = $_POST["tachometr_stav"];
    $prevodovka = $_POST["prevodovka"];
    $id = $_POST["id"];
    
     $sql_update = "UPDATE cars 
     SET prd_year='$prd_year', price='$price', photo='$photo' 
     WHERE id='$id'";

$sql_update_info = "UPDATE carsinfo 
          SET vykon='$vykon', palivo='$palivo', pocet_dvere='$pocet_dvere',
          barva='$barva', tachometr_stav='$tachometr_stav', prevodovka='$prevodovka'
          WHERE id='$id'";

if ($conn->query($sql_update) === TRUE && $conn->query($sql_update_info) === TRUE) {
echo "Data byla úspěšně aktualizována.";
} else {
echo "Chyba při aktualizaci dat: " . $conn->error;
}
    }

$conn->close();
?>
