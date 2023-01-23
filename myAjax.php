<?php
	include("db_connection.php");
    session_start();
	
	if(isset($_GET["getAllMunicipalities"])){
		$sql = "SELECT * FROM provinces ORDER BY province_name ASC";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
				// echo "$row[id] - $row[province_name] - $row[name] - $row[status]<hr>";
				$arr[] = ["id" => $row["id"], "province_name" => $row["province_name"], "name" => $row["name"], "status" => $row["status"]];
			}
		}
		echo json_encode($arr);
	}

    if(isset($_GET["getMunicipality"])){
		$sql = "SELECT * FROM provinces WHERE id=$_GET[id]";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
				$arr[] = ["id" => $row["id"], "name" => $row["name"], "status" => $row["status"]];
			}
		}
		echo json_encode($arr);
	}

	if(isset($_GET["getMunicipalitiesOnly"])){
		$sql = "SELECT * FROM provinces WHERE province_name = '$_GET[province_name]'";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
				$arr[] = ["id" => $row["id"], "name" => $row["name"]];
			}
		}
		echo json_encode($arr);
	}

    if(isset($_GET["getStatusRequirements"])){
		$sql = "SELECT * FROM status";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
                $sql2 = "SELECT B.name FROM status_requirements as A LEFT JOIN requirements as B ON B.id = A.requirement_id WHERE A.status = '$row[status]'";
                $status_requirement = "";
                $list = $conn->query($sql2);
                if ($list->num_rows > 0) {
                    while($row2 = $list->fetch_assoc()) {
                        $status_requirement = $status_requirement . "$row2[name]<br>";
                    }
                }
				$arr[] = ["status" => $row["status"], "status_requirement" => $status_requirement];
			}
		}
		echo json_encode($arr);
	}

    if(isset($_GET["getRequirements"])){
		$sql = "SELECT * FROM requirements";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
				$arr[] = ["id" => $row["id"], "name" => $row["name"]];
			}
		}
		echo json_encode($arr);
	}

    if(isset($_GET["getMunicipalityRequirements"])){
		$sql = "SELECT * FROM provinces WHERE id = '$_GET[name]'";
		$results = $conn->query($sql);
		while($row = $results->fetch_assoc()) {
            $status = $row['status'];
        }
        $sql = "SELECT B.name FROM status_requirements as A LEFT JOIN requirements as B ON B.id = A.requirement_id WHERE A.status = '$status'";
        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
                $tmp = strtolower(str_replace(" ", "_", $row['name']));
				$arr[] = ["name" => $tmp];
			}
		}
		echo json_encode($arr);
	}

    if(isset($_GET["getAllTravelApplications"])){
		$sql = "SELECT A.*, B.province_name as origin_province, B.name as origin_city, C.province_name as destination_province, C.name as destination_city FROM travels as A LEFT JOIN provinces as B ON B.id = A.origin LEFT JOIN provinces as C ON C.id = A.destination";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
				$arr[] = ["id" => $row["id"], "firstname" => $row["firstname"], "middlename" => $row["middlename"], "lastname" => $row["lastname"], "origin" => $row["origin"], "origin_province" => $row["origin_province"], "origin_city" => $row["origin_city"], "destination" => $row["destination"], "destination_province" => $row["destination_province"], "destination_city" => $row["destination_city"], "purpose" => $row["purpose"], "status" => $row["status"]];
			}
		}
		echo json_encode($arr);
	}

    if(isset($_GET["getAllUsers"])){
		$sql = "SELECT * FROM users";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
				$arr[] = ["id" => $row["id"], "firstname" => $row["firstname"], "middlename" => $row["middlename"], "lastname" => $row["lastname"], "usertype" => $row["usertype"], "designation" => $row["designation"], "username" => $row["username"], "password" => $row["password"]];
			}
		}
		echo json_encode($arr);
	}

    if(isset($_GET["editUser"])){
		$sql = "SELECT * FROM users WHERE id = $_GET[id]";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
				$arr[] = ["id" => $row["id"], "firstname" => $row["firstname"], "middlename" => $row["middlename"], "lastname" => $row["lastname"], "usertype" => $row["usertype"], "designation" => $row["designation"], "username" => $row["username"], "password" => $row["password"]];
			}
		}
		echo json_encode($arr);
	}
?>