<!DOCTYPE html>
<html>
<head>
	<title>Assignment 2</title>
</head>
<body align=center>
	<h3>Q4 Answer</h3>
	<table border='1' align='center'>
		<thead>
			<tr>
				<th>member_ID</th>
				<th>name</th>
                <th>rental_count</th>
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
                        m.member_ID,
                        m.name,
                        COUNT(rt.transaction_ID) AS rental_count
        			FROM
                        Member m
        			INNER JOIN RentalTransaction rt ON m.member_ID = rt.member_ID
                    GROUP BY m.member_ID
                    ORDER BY rental_count DESC, m.member_ID ASC";
			$result = mysqli_query($conn, $sql);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
			  // Output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
				echo "
				<tr>
					<td>" . $row["member_ID"] . "</td>
					<td>" . $row["name"] . "</td>
					<td>" . $row["rental_count"] . "</td>
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