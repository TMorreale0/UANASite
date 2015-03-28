<?php
	$servername = "localhost";
	$username = "uanadata";
	$password = "uanaadmin";
	$dbname = "FederationInfo";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	echo "Connected successfully\n";

	echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";

	if( $_POST["del"] != "" ) {
		$sql = "DELETE FROM people
				WHERE id='" . $_POST["del"] . "'";
		if ($conn->query($sql) === TRUE) {
		    echo "Deleted " . $_POST["del"];
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	if( $_POST["fedName"] != "") {
		if($_POST["title"] != "Other") {
			$sql = "INSERT INTO people (FederationName, Discipline, ZoneNumber, Title, FullName, Email, Phone)
				VALUES ('" . $_POST["fedName"] . "', '" . $_POST["discipline"] . "', '" . $_POST["zoneNum"] . "', '" . $_POST["title"]
					. "', '" . $_POST["fullName"] . "', '" . $_POST["email"] . "', '" . $_POST["phone"] . "')";
		} else {
			$sql = "INSERT INTO people (FederationName, Discipline, ZoneNumber, Title, FullName, Email, Phone)
				VALUES ('" . $_POST["fedName"] . "', '" . $_POST["discipline"] . "', '" . $_POST["zoneNum"] . "', '" . $_POST["title2"]
					. "', '" . $_POST["fullName"] . "', '" . $_POST["email"] . "', '" . $_POST["phone"] . "')";
		}
		

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	echo "<br><br>";

	$sql = "SELECT * FROM people";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo "<table class='table table-hover table-bordered'>";
		echo "<tr><th>Federation Name</th>
				<th>Discipline</th>
				<th>Zone Number</th>
				<th>Title</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Delete?</th></tr>";
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	echo "<tr>";
	        echo "<td>" . $row["FederationName"]. "</td>" 
	        	. "<td>" . $row["Discipline"]. "</td>"
	        	. "<td>" . $row["ZoneNumber"]. "</td>"
	        	. "<td>" . $row["Title"]. "</td>"
	        	. "<td>" . $row["FullName"]. "</td>"
	        	. "<td>" . $row["Email"]. "</td>"
	        	. "<td>" . $row["Phone"]. "</td>"
	        	. "<td>" . "<form action='people.php' method='post'><button name='del' value=" . $row["id"] . ">Delete</button></form>" . "</td>";
	        echo "</tr>";
	    }
	    echo "</table>";
	} else {
	    echo "0 results";
	}


?>