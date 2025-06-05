<!DOCTYPE html>
<html>
<head>
	<title>assignment 2</title>
</head>
<body align=center>
	<h3>Q8 Answer</h3>
	<table border='1' align='center'>
		<thead>
			<tr>
				<th>station_ID</th>
				<th>station_name</th>
				<th>available_pbs</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Database connection
			$server_name = "localhost";
			$user_name = "root";
			$password = "";
			$db_name = "asm2";

			$conn = mysqli_connect($server_name,$user_name,$password,$db_name);

			// SQL query
			$key = $_GET['service_area_ID'];
			$query = "SELECT 
            chargingStn.station_ID AS station_ID,
            chargingStn.name AS 'station_name',
            chargingStn.available_pbs AS 'available_pbs'	
          FROM 
            ChargingStation chargingStn
          WHERE 
            chargingStn.location_ID IN (
                SELECT $key
                UNION
                (SELECT childArea.service_area_ID
                FROM ServiceArea parentArea 
                    LEFT OUTER JOIN ServiceArea childArea ON childArea.parent_area_ID = parentArea.service_area_ID
                WHERE parentArea.service_area_ID = $key)
                UNION 
                (SELECT grandChildArea.service_area_ID
                FROM ServiceArea parentArea 
                    LEFT OUTER JOIN ServiceArea childArea ON childArea.parent_area_ID = parentArea.service_area_ID
                    LEFT OUTER JOIN ServiceArea grandChildArea ON grandChildArea.parent_area_ID = childArea.service_area_ID
                WHERE parentArea.service_area_ID = $key )
            )
          ORDER BY chargingStn.available_pbs DESC, chargingStn.station_ID ASC;";

			$result = mysqli_query($conn, $query);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
			  // Output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
			    echo "
			    <tr>
					<td>" . $row["station_ID"] . "</td>
					<td><a href='q9.php?station_ID=" . $row["station_ID"] . "'>" . $row["station_name"] . "</a></td>
					<td>" . $row["available_pbs"] . "</td>
			    </tr>";
			  }
			} else {
			  echo "0 results";
			}

			mysqli_close($conn);
			?>
		</tbody>
	</table>
	<br><a href='index.html'>back</a>
</body>
</html>
