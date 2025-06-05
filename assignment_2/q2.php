<!DOCTYPE html>
<html>
<head>
	<title>Assignment 2</title>
</head>
<body align=center>
	<h3>Q2 Answer</h3>
	<table border='1' align='center'>
		<thead>
			<tr>
				<th>coupon_ID</th>
				<th>discount_value</th>
                <th>member_ID</th>
                <th>name</th>
                <th>payment_amount</th>
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
            			c.coupon_ID,
            			c.discount_value,
            			m.member_ID,
            			m.name,
            			r.payment_amount
        			FROM
        			    Coupon c
        			INNER JOIN Member m ON c.member_ID = m.member_ID
        			INNER JOIN RentalTransaction r ON c.coupon_ID = r.coupon_ID
        			WHERE c.redemption = 1 # any other alternative to this?
        			ORDER BY r.payment_amount DESC, m.member_ID ASC";
			$result = mysqli_query($conn, $sql);

			// Check if data exists
			if (mysqli_num_rows($result) > 0) {
			  // Output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
				echo "
				<tr>
					<td>" . $row["coupon_ID"] . "</td>
					<td>" . number_format($row["discount_value"], 2) . "</td>
					<td>" . $row["member_ID"] . "</td>
					<td>" . $row["name"] . "</td>
					<td>" . number_format($row["payment_amount"], 2) . "</td>
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