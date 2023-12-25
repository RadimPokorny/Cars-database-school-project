<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="mycars";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>
<head>


<link rel="stylesheet" href="style.css">

</head>
<form class="show-cars" action="prispevky.php" method="get">
<Label>Vyber značku</Label>
<select name="znacka">
    <option value="1">Toyota</option>
    <option value="2">Ford</option>
    <option value="3">Opel</option>
</select>
<input type="submit" value="Zobrazit"></input>

</form>
<br>
<a href="admin.php"><button class="add-car-button">Přidat nové auto</button></a>

<form class="show-cars" action="edit_car.php" method="get">
    <input type="number" name="id" min="0" max="2023" required placeholder="Zadej cislo ID daneho auta"/>
    <input style="border: none;
    background-color: rgb(54, 54, 235);
    color:rgb(231, 231, 231);
    padding: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    height:auto !important;"type="submit" class="edit-car-button"value="Odeslat"></input>
</form>