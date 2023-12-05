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

</form>