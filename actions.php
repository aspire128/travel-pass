<?php
    include("db_connection.php");
    session_start();

    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: login.php");
    }

    if(isset($_POST["login"])){
        $sql = "SELECT * FROM users WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
            foreach($results as $row){
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["password"] = $row["password"];
                $_SESSION["usertype"] = $row["usertype"];
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["middlename"] = $row["middlename"];
                $_SESSION["lastname"] = $row["lastname"];
                $_SESSION["designation"] = $row["designation"];
            }
			header("Location: travelApplications.php");
		}
        else{
            header("Location: login.php?error=1");
        }
    }

    if(isset($_POST["editMunicipalityStatus"])){
        $sql = "UPDATE provinces SET status = '$_POST[status]' WHERE id = $_POST[municipalityID]";
        $conn->query($sql);
        header("Location: municipalities.php");
    }

    if(isset($_POST["editRequirements"])){
        $sql = "DELETE FROM status_requirements WHERE status = '$_POST[status]'";
        $conn->query($sql);
        foreach($_POST["requirement_id"] as $row){
            $sql = "INSERT INTO status_requirements VALUES(id, '$_POST[status]', $row)";
            $conn->query($sql);
        }
        header("Location: status_requirements.php");
    }

    if(isset($_POST["applyTraveler"])){
        $sql = "INSERT INTO travels VALUES(id, '$_POST[firstname]', '$_POST[middlename]', '$_POST[lastname]', '$_POST[physical_address]', '$_POST[birthdate]', '$_POST[gender]', '$_POST[cp_number]', '$_POST[email_address]', '$_POST[purpose]', '$_POST[origin]', '$_POST[destination]', '$_POST[vehicle_type]', '$_POST[plate_number]', '$_POST[color]', '$_POST[date_of_travel]', '$_POST[duration]', 'Pending')";
        $conn->query($sql);
        $travel_id = $conn->insert_id;
        for($x=0; $x < $_POST['no_of_passenger']; $x++){
            $sql = "INSERT INTO travel_passengers VALUES(id, $travel_id, '" . $_POST['passenger_firstname'][$x] . "', '" . $_POST['passenger_middlename'][$x] . "' ,'" . $_POST['passenger_lastname'][$x] . "')";
            $conn->query($sql);
        }
        $sql = "SELECT * FROM provinces WHERE id = '$_POST[destination]'";
		$results = $conn->query($sql);
		while($row = $results->fetch_assoc()) {
            $status = $row['status'];
        }
        $sql = "SELECT B.name FROM status_requirements as A LEFT JOIN requirements as B ON B.id = A.requirement_id WHERE A.status = '$status'";
        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
			while($row = $results->fetch_assoc()) {
                $tmp = strtolower(str_replace(" ", "_", $row['name']));
				//file upload begin
                $tmpFilePath = $_FILES[$tmp]['tmp_name'];
                $newFilePath = "attachments/$travel_id-".$_FILES[$tmp]['name'];
                $filename = "$travel_id-".$_FILES[$tmp]['name'];
                move_uploaded_file($tmpFilePath, $newFilePath);
                $sql = "INSERT INTO travel_attachments VALUES (id, $travel_id, '$filename')";
                $conn->query($sql);
                //file upload end
			}
		}
        header("Location: applyTravelSuccess.php");
    }

    if(isset($_POST["updateTravelApplication"])){
        if($_POST['updateTravelApplication'] == "Rejected"){
            $sql = "UPDATE travels SET status = '$_POST[updateTravelApplication]' WHERE id = $_POST[id]";
            $conn->query($sql);
            $sql = "INSERT INTO travel_rejected VALUES(id, $_POST[id], '$_POST[reason]')";
            $conn->query($sql);
        }
        else{
            $sql = "UPDATE travels SET status = '$_POST[updateTravelApplication]' WHERE id = $_POST[id]";
            $conn->query($sql);
        }
        header("Location: travelApplications.php");
    }

    if(isset($_POST["editUserInfo"])){
        if($_POST['mode'] == "Add"){
            $sql = "INSERT INTO users VALUES(id, '$_POST[username]', '$_POST[password]', '$_POST[usertype]', '$_POST[firstname]', '$_POST[middlename]', '$_POST[lastname]', '$_POST[designation]')";
            $conn->query($sql);
        }
        else{
            $sql = "UPDATE users SET password = '$_POST[password]', usertype = '$_POST[usertype]', firstname = '$_POST[firstname]', middlename = '$_POST[middlename]', lastname = '$_POST[lastname]', designation = '$_POST[designation]' WHERE id = $_POST[id]";
            echo $sql;
            $conn->query($sql);
        }
        header("Location: systemUsers.php");
    }
?>