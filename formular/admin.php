<!DOCTYPE html>
<html>
<head>
    <title>Formulář</title>
    <link rel="stylesheet" href="style.css">

    <script>

    <?php


        require_once('getcarmodels.php');


        $carmakesArr= array("toyota", "ford", "opel");
 
        $toyotaArr = array();
        $fordArr = array();
        $opelArr = array();
        $models = getCarModels();

        if($models !== false && ($models->num_rows > 0)){

            while($row = $models -> fetch_row()){
                switch($row[2]){
                    case 1:{
                        $toyotaArr[$row[0]] = $row[1];
                        
                    } break;
                    case 2:{
                        $fordArr[$row[0]] = $row[1];
                        
                    }break;
                    case 3:{    
                        $opelArr[$row[0]] = $row[1];
                        
                    }break;
                }
            }
        }
    ?>

    var carmakes =<?php  echo json_encode($carmakesArr );  ?>;
	var toyota =<?php echo json_encode($toyotaArr );  ?>;
	var ford =<?php echo json_encode($fordArr );  ?>;
	var opel =<?php echo json_encode($opelArr );  ?>;
    </script>

</head>
<body>
<script src="admin.js"></script>
    <h1>Formulář</h1>
    <form method="post" action="" class="form">
    <label for="cars">Choose a brand:</label>
    <select onchange="makeCarmodelsList(event)" name="cars" id="cars" name="znacka">
        <option value="1">Toyota</option>
        <option value="2">Ford</option>
        <option value="3">Opel</option>
    </select>
    <label for="cars">Choose a model</label>
    <select name="models" id="modellist">
    </select>
    <label>Cena:</label>
    <input type="text" name="cena" placeholder="19999"></input>
    <label>Rok výroby:</label>
    <select id="cars" name="rok">
        <?php
            for($i = 1970; $i <= 2023; $i++){
                echo('<option value="'.$i.'">');
                echo($i);
                echo('</option>');
            }
        ?>
    </select>
    <label>Zadej vykon motoru ve Wattech</label>
    
    <input name="vykon"type="number" min="10" max="3000" value="150"></input>
    
    <label>Zadej typ prevodovky</label>
    
    <label>
        <input type="radio" name="prevodovka" value="manual" checked>
        Manuál
    </label>
    
    <label>
        <input type="radio" name="prevodovka" value="automat">
        Automat
    </label>

    <label>Zadej typ paliva</label>
    <label>
        <input type="radio" name="palivo" value="benzin" checked>
        Benzín
    </label>
    <label>
        <input type="radio" name="palivo" value="nafta">
        Nafta
    </label>
    <label>
        <input type="radio" name="palivo" value="lpg">
        LPG
    </label>
    <label>
        <input type="radio" name="palivo" value="elektro">
        Elektro
    </label>
    <label>Zadej pocet dveri</label>
    <input name="pocet_dveri"type="number" value="4"></input>
    <label>Zadej barvu karoserie</label>
    <input name="barva" type="text" placeholder="černá, modrá, bílá,.."></input>
    <label>Pocet ujetych km</label>
    <input name="tachometr_stav" type="number" min="0" max="3000000" placeholder="např. 3000km"></input>
    
    <label>pocet radicich stupnu</label>
    
    <input name="stupne" type="number" min="1" max="7" value="5"></input>
    
    <label>Zadej odkaz na obrazek auta</label>
            
    <input name="obrazek_auta" type="text" placeholder="www.example.com/img.jpg"></input>
    
    
    <input class="add-car-button" type="submit" value="Odeslat"></input>
            



    </form>
    <script src="admin.js"></script>
</body> 

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Předpokládá se, že máte připojení k databázi, které zde není zahrnuto.
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mycars";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $selectedModel = $_POST['models'];
    $price = $_POST['cena'];
    $year = $_POST['rok'];
    $vykon = $_POST['vykon'];
    $prevodovka = $_POST['prevodovka'];
    $palivo = $_POST['palivo'];
    $pocetDveri = $_POST['pocet_dveri'];
    $barva = $_POST['barva'];
    $tachometrStav = $_POST['tachometr_stav'];
    $stupne = $_POST['stupne'];
    $obrazekAuta = $_POST['obrazek_auta'];

    if($obrazekAuta == NULL){
        $obrazekAuta = "https://www.linearity.io/blog/content/images/2023/06/how-to-create-a-car-NewBlogCover.png";
    }
    
    // Vložení do tabulky cars
    $query = "INSERT INTO cars (prd_year, price, photo, models_id) VALUES ('$year', '$price','$obrazekAuta', '$selectedModel')";
    $query2 = "INSERT INTO carsinfo (vykon, palivo, pocet_dvere, barva, tachometr_stav, prevodovka) VALUES ('$vykon', '$palivo', '$pocetDveri', '$barva', '$tachometrStav', '$prevodovka')";
    
    if (mysqli_query($conn, $query) && mysqli_query($conn, $query2)) {
        echo "Data byla úspěšně vložena do tabulky cars.";
    } else {
        echo "Chyba při vkládání dat: " . mysqli_error($yourDbConnection);
    }
}
?>


<script src="admin.js"></script>
</html>
