<!DOCTYPE html>
<html>
<head>
	<title>Assignment 2</title>
</head>
<body align=center>
	<h3>Q5 Answer</h3>
	<table border='1' align='center'>
		<thead>
			<tr>
				<th>station_ID</th>
				<th>station_name</th>
                <th>sum_of_completed_reservation</th>
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
			// $sql = "SELECT 
            //             r.station_ID,
            //             cs.name AS station_name,
            //             COUNT(r.reservation_ID) AS sum_of_completed_reservation
        	// 		FROM
            //             Reservation r
        	// 		LEFT JOIN ChargingStation cs ON r.station_ID = cs.station_ID
            //         LEFT JOIN ServiceArea sa ON cs.location_ID = sa.service_area_ID
            //         WHERE
            //             r.status = 1
            //             AND (sa.name = 'Central and West' OR sa.parent_area_ID IN (
            //                 SELECT service_area_ID FROM ServiceArea WHERE name = 'Central and West' OR parent_area_ID IN (
            //                     SELECT service_area_ID FROM ServiceArea WHERE name = 'Central and West'
            //                 )
            //             ))
            //         GROUP BY r.station_ID, cs.station_name                        
            //         ORDER BY sum_of_completed_reservation DESC, r.station_ID ASC;";
                      
			// $result = mysqli_query($conn, $sql);

                $sql = "SELECT 
                            cs.station_ID,
                            cs.name AS station_name,
                            COUNT(r.reservation_ID) AS sum_of_completed_reservation
                        FROM
                            Reservation r
                        RIGHT JOIN ChargingStation cs ON r.station_ID = cs.station_ID AND r.status = 1
                        INNER JOIN (SELECT * FROM ServiceArea WHERE name = 'Central and West' OR parent_area_ID IN (
                            SELECT service_area_ID FROM ServiceArea WHERE name = 'Central and West' OR parent_area_ID IN (
                                SELECT service_area_ID FROM ServiceArea WHERE name = 'Central and West'
                            )
                        )) sa ON cs.location_ID = sa.service_area_ID
                        -- WHERE
                            -- r.status = 1
                        GROUP BY r.station_ID, cs.name                        
                        ORDER BY sum_of_completed_reservation DESC, r.station_ID ASC;";

                $result = mysqli_query($conn, $sql);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
			  // Output data of each row
			      while($row = mysqli_fetch_assoc($result)) {
				echo "
				<tr>
					<td>" . $row["station_ID"] . "</td>
					<td>" . $row["station_name"] . "</td>
					<td>" . $row["sum_of_completed_reservation"] . "</td>
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