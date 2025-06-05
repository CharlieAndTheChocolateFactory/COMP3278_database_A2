<!DOCTYPE html>
<html>
<head>
	<title>assignment 2</title>
</head>
<body align=center>
	<h3>Question 8_1</h3>
	<?php
	// Database connection
	$server_name = "localhost";
	$user_name = "root";
	$password = "";
	$db_name = "asm2";

	$conn = mysqli_connect($server_name,$user_name,$password,$db_name);

    // use post method to send information
	
    echo "<form action='q8.php' method='GET'>";
        echo "<select name='service_area_ID'>";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT 
                    TopLevel.service_area_ID AS 'service_area_ID',
                    TopLevel.name AS 'service_area_name',
                    COUNT(Station.station_ID) AS 'charging_station_count'
                FROM 
                    ServiceArea TopLevel
                LEFT OUTER JOIN ServiceArea MidLevel ON MidLevel.parent_area_ID = TopLevel.service_area_ID
                LEFT OUTER JOIN ServiceArea LowLevel ON LowLevel.parent_area_ID = MidLevel.service_area_ID
                INNER JOIN ChargingStation Station ON (LowLevel.service_area_ID = Station.location_ID OR MidLevel.service_area_ID = Station.location_ID OR TopLevel.service_area_ID = Station.location_ID) 
                WHERE
                    TopLevel.parent_area_ID IS NULL
                GROUP BY 
                    TopLevel.service_area_ID
                HAVING 
                    COUNT(Station.station_ID) >= 1
                ORDER BY 
                    'charging_station_count' DESC, TopLevel.service_area_ID ASC";

 

        $result = mysqli_query($conn, $query);

        // Check if query was successful
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            echo "<option value='".$row['service_area_ID']."'>";
            echo $row['service_area_name'];
            echo ": ";
            echo $row['charging_station_count'];
            echo "</option>";
        }
		echo "</select>";
        echo "<br>"; 
         	
		echo "<br><input type='submit' name='submit' value='submit'>";

	echo "</form>";

	mysqli_close($conn);
	?>
	<br><a href='index.html'>back</a>
</body>
</html>


