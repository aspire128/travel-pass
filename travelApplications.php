<?php include("header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">List of Travel Applications</h1>
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="admin.php">Home</a></li>
						<li class="breadcrumb-item active">Travel Applications</li>
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
						<div class="card-body" id="travelList">
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content -->
    <div class="modal fade" id="editMunicipalityStatusModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="actions.php" id="editMunicipalityStatusForm">
                        <div class="form-group row mb-3">
                            <label class="col-2">Current Status</label>
                            <div class="col-6">
							    <input type="text" class="form-control" id="currentStatus" readonly>
                            </div>
						</div>
                        <div class="form-group row mb-3">
                            <label class="col-2">New Status</label>
                            <div class="col-6">
							    <select name="status" id="statusDropdown" class="form-control" required></select>
                            </div>
						</div>
                        <input type="text" name="municipalityID" class="form-control" id="municipalityID" hidden>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="editMunicipalityStatus" form="editMunicipalityStatusForm" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<?php include("footer.php"); ?>
<script>
    function getAllTravelApplications(){
        $("#travelList").empty();
        var accountDesignation = "<?php echo $_SESSION['designation'];?>";
        $.ajax({
			url : "myAjax.php",
	        type: "GET",
	        dataType: "JSON",
            data: {getAllTravelApplications: "getAllTravelApplications"},
	        success: function(results){
				var JavTable = "<table class='table table-bordered table-striped tableDT'>";
				JavTable = JavTable + "<thead>";
				JavTable = JavTable + "<tr>";
				JavTable = JavTable + "<th>Name</th>";
                JavTable = JavTable + "<th>Origin</th>";
                JavTable = JavTable + "<th>Destination</th>";
                JavTable = JavTable + "<th>Purpose</th>";
                JavTable = JavTable + "<th>Status</th>";
                JavTable = JavTable + "<th>Action</th>";
				JavTable = JavTable + "</tr></thead><tbody id='travelRecords'>";
				$(JavTable).appendTo($("#travelList"));
				jQuery.each(results, function(index, item){
                    var fullname = item.lastname + ", " + item.firstname + " " + item.middlename;
                    fullname = toTitleCase(fullname);
					var newRow = "<tr><td>";
					newRow = newRow + fullname + "</td><td>";
                    newRow = newRow + item.origin_province + " - " + item.origin_city + "</td><td>";
                    newRow = newRow + item.destination_province + " - " + item.destination_city + "</td><td>";
                    newRow = newRow + item.purpose + "</td><td>";
                    newRow = newRow + item.status + "</td><td>";
					newRow = newRow + "<form method='POST' action='viewApplication.php'><input type='hidden' value='" + item.id + "' name='id'><button type='submit' class='btn btn-primary'>View Application</button></form></td></tr>";
                    if(accountDesignation == "All" || accountDesignation == item.origin_province){
                        $(newRow).appendTo($("#travelRecords"));
                    }
				});
				var EndJavTable = "</tbody></table>";
				$(EndJavTable).appendTo($("#travelList"));
				$(".tableDT").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');					
			}
	    });
    }

    function toTitleCase(str) {
        return str.replace(
            /\w\S*/g,
            function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }
        );
    }

    getAllTravelApplications();
</script>