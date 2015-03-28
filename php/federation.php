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

	echo "Connected successfully<br>";

	echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";

	//Delete a federation if user hit the delete button
	if( $_POST["del"] != "" ) {
		$sql = "DELETE FROM federation
				WHERE id='" . $_POST["del"] . "'";
		if ($conn->query($sql) === TRUE) {
		    echo "Deleted " . $_POST["del"];
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	//Insert a new federation
	$sql = "";
	if( $_POST["zoneNum"] != "") {
		$sql = "INSERT INTO federation (FederationName, FederationFormalName, ZoneNumber, ZoneName, ContactName, Email, Phone, StreetAddress, City, Country,
				Website, Fax, Logo, Mission, Vision, Structure, Other, Notes)
				VALUES ('" . $_POST["fedBox"] . "', '" . $_POST["federationFormalName"] . "', '" . $_POST["zoneNum"] . "', '" . $_POST["zoneName"] 
					. "', '" . $_POST["fedContactName"] . "', '" . $_POST["email"] . "', '" . $_POST["phone"] . "', '" . $_POST["streetAddr"]
					. "', '" . $_POST["city"] . "', '" . $_POST["country"] . "', '" . $_POST["website"] 
					. "', '" . $_POST["fax"] . "', '" . $_POST["logo"] . "', '" . $_POST["mission"] 
					. "', '" . $_POST["vision"] . "', '" . $_POST["structure"] . "', '" . $_POST["other"]
					. "', '" . $_POST["notes"] . "')";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	echo "<br><br>";

	//display allthe federation data
	$sql = "SELECT * FROM federation";
	$result = $conn->query($sql);


	if ($result->num_rows > 0) {
		echo "<table class='table table-hover table-bordered'>";
		echo "<tr><th>Federation Name</th>
				<th>Federation Formal Name</th>
				<th>Zone Number</th>
				<th>Zone Name</th>
				<th>Contact Name</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Street Address</th>
				<th>City</th>
				<th>Country</th>
				<th>Website</th>
				<th>Fax</th>
				<th>Logo</th>
				<th>Mission</th>
				<th>Vision</th>
				<th>Structure</th>
				<th>Other</th>
				<th>Notes</th>
				<th>Delete?</th></tr>";
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	echo "<tr>";
	        echo "<td>" . $row["FederationName"]. "</td>" 
	        	. "<td>" . $row["FederationFormalName"]. "</td>"
	        	. "<td>" . $row["ZoneNumber"]. "</td>"
	        	. "<td>" . $row["ZoneName"]. "</td>"
	        	. "<td>" . $row["ContactName"]. "</td>"
	        	. "<td>" . $row["Email"]. "</td>"
	        	. "<td>" . $row["Phone"]. "</td>"
	        	. "<td>" . $row["StreetAddress"]. "</td>"
	        	. "<td>" . $row["City"]. "</td>"
	        	. "<td>" . $row["Country"]. "</td>"
	        	. "<td>" . $row["Website"]. "</td>"
	        	. "<td>" . $row["Fax"]. "</td>"
	        	. "<td>" . $row["Logo"]. "</td>"
	        	. "<td>" . $row["Mission"]. "</td>"
	        	. "<td>" . $row["Vision"]. "</td>"
	        	. "<td>" . $row["Structure"]. "</td>"
	        	. "<td>" . $row["Other"]. "</td>"
	        	. "<td>" . $row["Notes"]. "</td>"
	        	. "<td>" . "<form action='federation.php' method='post'><button name='del' value=" . $row["id"] . ">Delete</button></form>" . "</td>";
	        echo "</tr>";
	    }
	    echo "</table>";
	} else {
	    echo "0 results";
	}


?>