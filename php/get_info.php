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

	//Federation Info
	$sql = "SELECT * FROM federation WHERE FederationName='" . $_POST['Fed'] ."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	//People Info
	//get all people
	$sql_people = "SELECT * FROM people WHERE FederationName='" . $_POST['Fed']."'";
	$result_people = $conn->query($sql_people);
	$other_people = "";
	
	if($result_people->num_rows > 0) {
		while($row_people = $result_people->fetch_assoc()) {
			switch($row_people["Title"]) {
				case "President":
					$row_president = $row_people;
					break;
				case "Vice President":
					$row_vp = $row_people;
					break;
				case "Secretary":
					$row_secretary = $row_people;
					break;
				default:
					$other_people = $other_people . "{
						'name':'". $row_people['FullName']."',
						'title':'". $row_people['Title']."',
						'email':'". $row_people['Email']."',
						'phone':'". $row_people['Phone']."',
					},";
					break;
			}
		}
	}

	echo "
		{
		'name':'". $row["FederationFormalName"] ."',
		'address':'". $row["StreetAddress"] ."',
		'phone':'". $row["Phone"] ."',
		'fax':'". $row["Fax"] ."',
		'email':'". $row["Email"] ."',
		'website':'". $row["Website"] ."',
		'mission':'". $row["Mission"] ."',
		'vision':'". $row["Vision"] ."',
		'structure':'". $row["Structure"] ."',
		'notes':'". $row["Notes"] ."',
		'othernotes':'". $row["Other"] ."',
		'logo':'". $row["Logo"] ."',
		'president': {
			'name':'". $row_president["FullName"]."',
			'email':'". $row_president["Email"]."',
			'phone':'". $row_president["Phone"]."'
		},
		'vicepresident': {
			'name':'". $row_vp["FullName"]."',
			'email':'". $row_vp["Email"]."',
			'phone':'". $row_vp["Phone"]."'
		},
		'secretary': {
			'name':'". $row_secretary["FullName"]."',
			'email':'". $row_secretary["Email"]."',
			'phone':'". $row_secretary["Phone"]."'
		},
		'other': [". $other_people."]
	}

	";

?>