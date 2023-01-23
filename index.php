<?php
    include("db_connection.php");
    $sql = "SELECT * FROM provinces";
    $results = $conn->query($sql);
    $sql = "SELECT * FROM requirements";
    $results2 = $conn->query($sql);
    $sql = "SELECT DISTINCT province_name FROM provinces";
    $results3 = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AdminLTE 3 | Registration Page</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
	</head>
	<body class="hold-transition register-page">
		<div class="col-10">
			<div class="register-logo">
				<a href="#"><b>TRAVEL PASS </b>SYSTEM</a>
			</div>
			<div class="card">
				<div class="card-body register-card-body">
					<p class="login-box-msg">Apply for travel pass document</p>
					<form action="actions.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group mb-3 col-4">
                                <label>Firstname:</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Firstname" required>
                            </div>
                            <div class="form-group mb-3 col-4">
                                <label>Middlename:</label>
                                <input type="text" name="middlename" class="form-control" placeholder="Middlename">
                            </div>
                            <div class="form-group mb-3 col-4">
                                <label>Lastname:</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Lastname" required>
                            </div>
                            <div class="form-group mb-3 col-12">
                                <label>Address:</label>
                                <input type="text" name="physical_address" class="form-control" placeholder="Address" required>
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label>Birthdate:</label>
                                <input type="date" name="birthdate" data-toggle="tooltip" data-placement="top" title="Enter Birthday"  class="form-control" required>
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label>Gender:</label>
                                <select name="gender" class="form-control" required>
                                    <option value="" selected disabled>Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label>Contact Number:</label>
                                <input type="text" name="cp_number" class="form-control" placeholder="Cellphone Number" required>
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label>Email Address:</label>
                                <input type="email" name="email_address" class="form-control" placeholder="Email Address" required>
                            </div>
                            <div class="form-group mb-3 col-12">
                                <label>Purpose of Travel:</label>
                                <input type="text" name="purpose" class="form-control" placeholder="Purpose of Travel" required>
                            </div>
                            <div class="form-group mb-3 col-3">
                                <label>Place of Origin (Province):</label>
                                <select id="origin_province" class="form-control" onchange="loadOriginMunicipality()" required>
                                    <option value="" selected disabled>Place of Origin</option>
                                    <?php
                                        foreach($results3 as $opt){
                                            echo "<option value='$opt[province_name]'>$opt[province_name]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3 col-3">
                                <label>Place of Origin (Municipality):</label>
                                <select id="origin" name="origin" class="form-control" required>
                                    <option value="" selected disabled>Choose a province first</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 col-3">
                                <label>Destination (Province):</label>
                                <select id="destination_province" class="form-control" onchange="loadDestinationMunicipality()" required>
                                    <option value="" selected disabled>Destination</option>
                                    <?php
                                        foreach($results3 as $opt){
                                            echo "<option value='$opt[province_name]'>$opt[province_name]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3 col-3">
                                <label>Destination (Municipality):</label>
                                <select name="destination" id="destination" class="form-control" onchange="setRequirements()" required>
                                    <option value="" selected disabled>Choose a province first</option>
                                </select>
                            </div>
                            
                            <div class="form-group mb-3 col-4">
                                <label>Vehicly Type:</label>
                                <select name="vehicle_type" class="form-control" required>
                                    <option value="" selected disabled>Choose Vehicle Type</option>
                                    <option value="Pick Up">Pick Up</option>
                                    <option value="Sedan">Sedan</option>
                                    <option value="SUV">SUV</option>
                                    <option value="Truck">Truck</option>
                                    <option value="Van">Van</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 col-4">
                                <label>Plate Number:</label>
                                <input type="text" name="plate_number" class="form-control" placeholder="Plate Number">
                            </div>
                            <div class="form-group mb-3 col-4">
                                <label>Vehicle Color:</label>
                                <input type="text" name="color" class="form-control" placeholder="Color">
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label>Date of Travel:</label>
                                <input type="date" name="date_of_travel" data-toggle="tooltip" data-placement="top" title="Enter date of travel" class="form-control">
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label>Duration (By Day):</label>
                                <input type="number" name="duration" class="form-control" placeholder="Duration (By Day)">
                            </div>
                            <div class="form-group mb-3 col-5">
                                <label>No. of Passengers:</label>
                                <input type="number" name="no_of_passenger" id="no_of_passenger" class="form-control" placeholder="Enter number of passenger">
                            </div>
                            <div class="form-group mb-3 col-4" id="afterPassenger">
                                <label> </label><br>
                                <button class="btn btn-info" onclick="setPassengerFields()">Generate Field</button>
                            </div>
                            <?php
                                foreach($results2 as $row){
                                    $tmp = strtolower(str_replace(" ", "_", $row['name']));
                                    echo "<div class='form-group row mb-3 col-7 fileUploads' id='$tmp' style='display:none;'>";
                                        echo "<label class='col-3 text-right'>$row[name]</label>";
                                        echo "<div class='col-6'>";
                                            echo "<input type='file' name='$tmp' class='form-control'>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
						<div class="row">
							<div class="col-4">
								&nbsp
							</div>
							<!-- /.col -->
							<div class="col-4">
								<button type="submit" name="applyTraveler" class="btn btn-primary btn-block">Apply</button>
							</div>
							<!-- /.col -->
						</div>
					</form>
				</div>
				<!-- /.form-box -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.register-box -->
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
        <script>
            function setPassengerFields(){
                $('div.PassengerGenerated').remove();
                var ctr = $('#no_of_passenger').val();
                for(var a=0; a < ctr; a++){
                    var newInput = "<div class='form-group mb-3 col-4 PassengerGenerated'>";
                    newInput += "<label>Firstname</label><input type='text' name='passenger_firstname[]' class='form-control' placeholder='Passenger  " + (ctr-a) + " Firstname' required>";
                    newInput += "</div>";
                    newInput += "<div class='form-group mb-3 col-4 PassengerGenerated'>";
                    newInput += "<label>Middlename</label><input type='text' name='passenger_middlename[]' class='form-control' placeholder='Passenger  " + (ctr-a) + " Middlename'>";
                    newInput += "</div>";
                    newInput += "<div class='form-group mb-3 col-4 PassengerGenerated'>";
                    newInput += "<label>Lastname</label><input type='text' name='passenger_lastname[]' class='form-control' placeholder='Passenger  " + (ctr-a) + " Lastname' required>";
                    newInput += "</div>";
                    $(newInput).insertAfter("#afterPassenger");
                }
            }

            function loadOriginMunicipality(){
                $('#origin').empty();
                var province_name = $('#origin_province').val();
                $.ajax({
                    url : "myAjax.php",
                    type: "GET",
                    dataType: "JSON",
                    data: {getMunicipalitiesOnly: "getMunicipalitiesOnly", province_name: province_name},
                    success: function(results){
                        jQuery.each(results, function(index, item){
                            var opt = "<option value='" + item.id + "'>" + item.name + "</option>";
                            $(opt).appendTo($("#origin"));
                        });				
                    }
                });
            }

            function loadDestinationMunicipality(){
                $('#destination').empty();
                var province_name = $('#destination_province').val();
                $.ajax({
                    url : "myAjax.php",
                    type: "GET",
                    dataType: "JSON",
                    data: {getMunicipalitiesOnly: "getMunicipalitiesOnly", province_name: province_name},
                    success: function(results){
                        jQuery.each(results, function(index, item){
                            var opt = "<option value='" + item.id + "'>" + item.name + "</option>";
                            $(opt).appendTo($("#destination"));
                        });				
                    }
                });
            }

            function setRequirements(){
                var name = $("#destination").val();
                $.ajax({
                    url : "myAjax.php",
                    type: "GET",
                    dataType: "JSON",
                    data: {getMunicipalityRequirements: "getMunicipalityRequirements", name: name},
                    success: function(results){
                        $(".fileUploads").each(function() {
                            $(this).css("display", "none");
                        });
                        jQuery.each(results, function(index, item){
                            $("#"+item.name).css("display", "block");
                        });
                    }
                });
            }
        </script>
	</body>
</html>