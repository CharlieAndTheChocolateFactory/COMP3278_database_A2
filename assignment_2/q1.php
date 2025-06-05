<!DOCTYPE html>
<html>
<head>
	<title>Assignment 2</title>
</head>
<body align=center>
	<h3>Q1 Answer</h3>
	<table border='1' align='center'>
		<thead>
			<tr>
				<th>station_ID</th>
				<th>name</th>
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
                        c.station_ID,
                        c.name
                    FROM
                        ChargingStation c
                    WHERE
                        c.name LIKE 'Pokfulam%'
                        ORDER BY c.station_ID ASC";
			$result = mysqli_query($conn, $sql);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
			  // Output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
			    echo "
			    <tr>
				    <td>" . $row["station_ID"] . "</td>
				    <td>" . $row["name"] . "</td>
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
