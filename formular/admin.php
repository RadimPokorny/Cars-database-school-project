<!DOCTYPE html>
<html>
<head>
    <title>Formulář</title>

    <style>

        *{
            margin: 0;
            padding: 0;
        }

        body{
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            height: 100%;
            width: 100%;
        }

    </style>

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
    <form method="post" action="">
    <label for="cars">Choose a brand:</label>
    </br>
    <select onchange="makeCarmodelsList(event)" name="cars" id="cars" name="znacka">
        <option value="1">Toyota</option>
        <option value="2">Ford</option>
        <option value="3">Opel</option>
    </select>
    </br>
    </br>
    <label for="cars">Choose a model</label>
    </br>
    <select name="models" id="modellist">
    </select>
    </br>
    </br>
    <label>Cena:</label>
    </br>
    <input type="text" name="cena"></input>
    </br>
    </br>
    <select id="cars" name="rok">
        <?php
            for($i = 1970; $i <= 2023; $i++){
                echo('<option value="'.$i.'">');
                echo($i);
                echo('</option>');
            }
        ?>
    </select>
    </br>
    </br>
    <label>Zadej vykon motoru ve Wattech<label>
    <br>
    <input name="vykon"type="number" min="10" max="3000"></input>
    <br>
    <label>Zadej typ prevodovky<label>
    <br>
    <input name="prevodovka"type="text" value=""></input>
    <br>
    <label>Zadej pocet dveri<label>
    <br>
    <input name="pocet_dveri"type="number" value=""></input>
    <br>
    <label>Zadej barvu karoserie<label>
    <br>
    <input name="barva" type="text" value=""></input>
    <br>
    <label>Pocet ujetych km<label>
    <br>
    <input name="tachometr_stav" type="number" min="0" max="3000000"></input>
    <br>
    <label>pocet radicich stupnu<label>
    <br>
    <input name="stupne" type="number" min="1" max="7"></input>
    <br>
    <label>Zadej odkaz na obrazek auta<label>
    <br>
    <input name="obrazek_auta" type="text" value=""></input>
    <br>
    <br>
    <input type="submit" value="Odeslat"></input>
            



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
    $pocetDveri = $_POST['pocet_dveri'];
    $barva = $_POST['barva'];
    $tachometrStav = $_POST['tachometr_stav'];
    $stupne = $_POST['stupne'];
    $obrazekAuta = $_POST['obrazek_auta'];
    
    // Vložení do tabulky cars
    $query = "INSERT INTO cars (prd_year, price, models_id) VALUES ('$year', '$price', '$selectedModel')";
    $query2 = "INSERT INTO carsinfo "
    
    if (mysqli_query($conn, $query)) {
        echo "Data byla úspěšně vložena do tabulky cars.";
    } else {
        echo "Chyba při vkládání dat: " . mysqli_error($yourDbConnection);
    }
}
?>


<script src="admin.js"></script>
</html>
