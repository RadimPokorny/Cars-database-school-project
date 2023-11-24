<?php

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

    $sql = "SELECT cars.id, cars.prd_year, cars.price, cars.photo, models.model_name
    FROM cars
    INNER JOIN models ON cars.models_id = models.id
    INNER JOIN carmakes ON models.carmakes_id = carmakes.id
    WHERE carmakes_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result

    if ($result !== false && ($result->num_rows > 0)) {

        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Year</th>
                    <th>Price</th>
                    <th>Photo</th>
                    <th>Model Name</th>
                </tr>";

        while ($row = $result->fetch_row()) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>"; // Assuming $row[3] contains the photo URL
            echo "<td>" . $row[4] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

    } else {
        echo "No results found.";
    }

    $result->free_result();
}

getCars($_GET["znacka"]);

?>
