<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
</head>
<body>



<?php
if (isset($_POST['car_data'])) {
    $carDataArray = explode(',', $_POST['car_data'][0]);
    // Output each element in the array
    echo '<div class="cars-box">';
    echo'<div class="car-box">';
    echo '<img src="'.$carDataArray[2].'"/>';
    echo '<p> Značka: '.$carDataArray[10].'</p>';
    echo '<p> Rok výroby:'.$carDataArray[0].'</p>';
    echo '<p> Cena: '.$carDataArray[1].'</p>';
    echo '<p> Edice:'.$carDataArray[3].'</p>';
    echo '<p> Výkon:'.$carDataArray[4].'</p>';
    echo '<p> Palivo: '.$carDataArray[5].'</p>';
    echo '<p> Počet dveří: '.$carDataArray[6].'</p>';
    echo '<p> Barva: '.$carDataArray[7].'</p>';
    echo '<p> Ujete KM: '.$carDataArray[8].'</p>';
    echo '<p> Řadící stupně: '.$carDataArray[9].'</p>';
    echo '</div>';
    
} else {
    echo "No car data received.";
}
echo '</div>';
echo '<a href="prispevky.php?znacka='.$carDataArray[11].'">Zpět na stránku</a>';

?>



</body>
</html>