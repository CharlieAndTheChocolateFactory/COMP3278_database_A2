<!DOCTYPE html>
<html>
<head>
	<title>assignment 2</title>
</head>
<body align=center>
	<h3>Q9 Answer</h3>
	<!-- <table border='1' align='center'>
		<thead>
			<tr>
				<th>reservation_ID</th>
				<th>member_ID</th>
				<th>reservation_datetime</th>
                <th>member_name</th>
                <th>email</th>
                <th>contact_number</th>
			</tr>
		</thead>
		<tbody> -->
			<?php
			// Database connection
			$server_name = "localhost";
			$user_name = "root";
			$password = "";
			$db_name = "asm2";

			$conn = mysqli_connect($server_name,$user_name,$password,$db_name);

			// SQL query
			$key = $_GET['station_ID'];
			$query = "SELECT 
                        r.reservation_ID AS reservation_ID,
                        r.member_ID AS member_ID,
                        r.reservation_datetime AS reservation_datetime,
                        m.name AS member_name,
                        m.email AS email ,
                        m.contact_number AS contact_number
                    FROM 
                        Reservation r
                    JOIN Member m ON r.member_ID = m.member_ID
                    WHERE 
                        r.station_ID = (SELECT station_ID FROM ChargingStation WHERE station_ID = $key)
                    ORDER BY r.reservation_datetime ASC, r.member_ID DESC;";

			$result = mysqli_query($conn, $query);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
                echo "<table border='1' align='center'>
                <thead>
                    <tr>
                        <th>reservation_ID</th>
                        <th>member_ID</th>
                        <th>reservation_datetime</th>
                        <th>member_name</th>
                        <th>email</th>
                        <th>contact_number</th>
                    </tr>
                </thead>
                <tbody>";
			  // Output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
			    echo "
			    <tr>
                    <td>" . $row["reservation_ID"] . "</td>
                    <td>" . $row["member_ID"] . "</td>
                    <td>" . $row["reservation_datetime"] . "</td>
                    <td>" . $row["member_name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["contact_number"] . "</td>
			    </tr>";
			  }
              echo "</tbody> </table>";
			} else {
			  echo "0 results";
			}

			mysqli_close($conn);
			?>
		<!-- </tbody>
	</table> -->
	<br><a href='index.html'>back</a>
</body>
</html>
