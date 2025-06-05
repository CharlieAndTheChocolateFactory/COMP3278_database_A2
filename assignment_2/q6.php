<!DOCTYPE html>
<html>
<head>
	<title>Assignment 2</title>
</head>
<body align=center>
	<h3>Q6 Answer</h3>
	<table border='1' align='center'>
		<thead>
			<tr>
				<th>station_ID</th>
				<th>station_name</th>
                <th>rental_income</th>
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
                            cs.name AS station_name,
                            SUM(rt.payment_amount) AS rental_income
                        FROM
                            ChargingStation cs
                        INNER JOIN RentalTransaction rt ON cs.station_ID = rt.station_ID
                        WHERE 
                            rt.end_datetime >= '2024-02-01 00:00:00' 
                            AND rt.end_datetime < '2024-02-29 23:59:59'
                        GROUP BY cs.station_ID
                        ORDER BY rental_income DESC, cs.station_ID ASC;";

                $result = mysqli_query($conn, $sql);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
			  // Output data of each row
			      while($row = mysqli_fetch_assoc($result)) {
				echo "
				<tr>
					<td>" . $row["station_ID"] . "</td>
					<td>" . $row["station_name"] . "</td>
					<td>" . number_format($row["rental_income"], 2) . "</td>
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