<!DOCTYPE html>
<html>
<head>
	<title>Assignment 2</title>
</head>
<body align=center>
	<h3>Q3 Answer</h3>
	<table border='1' align='center'>
		<thead>
			<tr>
				<th>station_ID</th>
				<th>name</th>
                <th>available_pbs</th>
                <th>service_area_name</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// Fill your database connection information here
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "asm2";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			// SQL query
			$sql = "SELECT 
                        cs.station_ID,
                        cs.name,
                        cs.available_pbs,
                        sa.name AS service_area_name
        			FROM
                        ChargingStation cs
        			LEFT JOIN ServiceArea sa ON cs.location_ID = sa.service_area_ID # LEFT JOIN ???
        			ORDER BY 
                        cs.available_pbs DESC,
                        cs.station_ID ASC";
			$result = mysqli_query($conn, $sql);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
			  // Output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
				echo "
				<tr>
					<td>" . $row["station_ID"] . "</td>
					<td>" . $row["name"] . "</td>
					<td>" . $row["available_pbs"] . "</td>
                    <td>" . $row["service_area_name"] . "</td>
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