<?php include("header.php"); ?>
<?php
    include("db_connection.php");
    $sql = "SELECT A.*, B.province_name as origin_province, B.name as origin_name, C.province_name as destination_province, C.name as destination_name FROM travels as A LEFT JOIN provinces as B on B.id = A.origin LEFT JOIN provinces as C on C.id = A.destination WHERE A.id = $_POST[id]";
    $result = $conn->query($sql);
    foreach($result as $row){
        $purpose = $row['purpose'];
        $date_of_travel = $row['date_of_travel'];
        $origin = "$row[origin_province] - $row[origin_name]";
        $destination = "$row[destination_province] - $row[destination_name]";
        $vehicle_type = $row['vehicle_type'];
        $color = $row['color'];
        $plate_number = $row['plate_number'];
        $status = $row['status'];
    }
    $sql = "SELECT * FROM travel_passengers WHERE travel_id = $_POST[id]";
    $passengers = $conn->query($sql);
    $sql = "SELECT * FROM travel_attachments WHERE travel_id = $_POST[id]";
    $attachments = $conn->query($sql);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Application Details</h1>
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="admin.php">Home</a></li>
						<li class="breadcrumb-item"><a href="travelApplications.php">Travel Applications</a></li>
                        <li class="breadcrumb-item active">View Application</li>
					</ol>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
                            <h2 class="text-center">Travel Authority (TA)</h2>
                            <p>This travel authority (TA) is granted to the person/s listed below to pass at the established Quarantine
                            Control Points (QCPs) Checkpoints, Seaports and Airports from point to origin to point of destination and 
                            vice versa as it may be deemed necessary.</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Passenger</td>
                                        <td>Date of Travel</td>
                                        <td>Origin</td>
                                        <td>Destination</td>
                                        <td>Vehicle</td>
                                        <td>Plate Number</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($result as $row){
                                            $fullname = ucwords("$row[lastname], $row[firstname]");
                                            echo "<tr>";
                                                echo "<td>$fullname</td>";
                                                echo "<td>$date_of_travel</td>";
                                                echo "<td>$origin</td>";
                                                echo "<td>$destination</td>";
                                                echo "<td>$vehicle_type - $color</td>";
                                                echo "<td>$plate_number</td>";
                                            echo "</tr>";
                                        }
                                        foreach($passengers as $row){
                                            $fullname = ucwords("$row[lastname], $row[firstname]");
                                            echo "<tr>";
                                                echo "<td>$fullname</td>";
                                                echo "<td>$date_of_travel</td>";
                                                echo "<td>$origin</td>";
                                                echo "<td>$destination</td>";
                                                echo "<td>$vehicle_type - $color</td>";
                                                echo "<td>$plate_number</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <p>Barangay Certificate/Medical Clearance Certificate, ORCR and Drivers License are available and the possession of each individual.</p>
                            <p>Purpose: <?php echo $purpose;?></p>
                            <p>Attachments:</p>
                            <ol>
                                <?php
                                    foreach($attachments as $row){
                                        echo "<li><a href='attachments/$row[filename]' target='_blank'>$row[filename]</a></li>";
                                    }
                                ?>
                            </ol>
                            <div class="row float-right">
                                <div class="form-group mb-3">
                                    <form method="POST" action="actions.php" id="updateTravelApplicationForm">
                                        <input type='hidden' value='<?php echo $_POST['id']?>' name='id'>
                                    </form>
                                    <?php
                                        if($status != "Rejected" AND $status != "Approved")
                                            echo "<button class='btn btn-lg btn-danger' onclick=\"$('#rejectModal').modal('toggle')\">Reject</button>";
                                        if($status == "Pending" AND $status != "Approved")
                                            echo "&nbsp&nbsp<button type='submit' name='updateTravelApplication' form='updateTravelApplicationForm' value='For Final Approval' class='btn btn-lg btn-primary'>Submit for Final Approval</button>";
                                        else if($status == "For Final Approval" AND $_SESSION['usertype'] == "PNP Director")
                                            echo "&nbsp&nbsp<button type='submit' name='updateTravelApplication' form='updateTravelApplicationForm' value='Approved' class='btn btn-lg btn-primary'>Approve</button>";
                                    ?>
                                    
                                </div>
                            </div>
						</div>
                        <div class="modal fade" id="rejectModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Reject Application</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="actions.php" id="updateTravelApplicationForm2">
                                            <div class="form-group row mb-3">
                                                <label class="col-2">Reason</label>
                                                <div class="col-6">
                                                    <textarea type="text" class="form-control" name="reason" required></textarea>
                                                </div>
                                            </div>
                                            <input type='hidden' value='<?php echo $_POST['id']?>' name='id'>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" name="updateTravelApplication" value="Rejected" form="updateTravelApplicationForm2" class="btn btn-danger">Reject</button>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include("footer.php"); ?>