<!DOCTYPE html>
<html>
<head>
	<title>Assignment 2</title>
</head>
<body align=center>
	<h3>Q7 Answer</h3>
	<table border='1' align='center'>
		<thead>
			<tr>
				<th>reservation_ID</th>
				<th>member_ID</th>
                <th>member_name</th>
                <th>station_ID</th>
                <th>reservation_datetime</th>
                <th>collect_datetime</th>
                <th>email</th>
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
                            r.reservation_ID,
                            r.member_ID,
                            m.name AS member_name,
                            r.station_ID,
                            r.reservation_datetime,
                            r.collect_datetime,
                            m.email
                        FROM
                            Reservation r
                        INNER JOIN Member m ON r.member_ID = m.member_ID
                        WHERE 
                            TIMESTAMPDIFF(MINUTE, r.reservation_datetime, r.collect_datetime) < 15
                        ORDER BY r.reservation_datetime ASC, r.reservation_ID DESC;";

                $result = mysqli_query($conn, $sql);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
			  // Output data of each row
			      while($row = mysqli_fetch_assoc($result)) {
				echo "
				<tr>
					<td>" . $row["reservation_ID"] . "</td>
                    <td>" . $row["member_ID"] . "</td>
                    <td>" . $row["member_name"] . "</td>
                    <td>" . $row["station_ID"] . "</td>
                    <td>" . $row["reservation_datetime"] . "</td>
                    <td>" . $row["collect_datetime"] . "</td>
                    <td>" . $row["email"] . "</td>
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