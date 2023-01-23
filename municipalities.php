<?php include("header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">List of Municipalities</h1>
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="admin.php">Home</a></li>
						<li class="breadcrumb-item active">Municipalities</li>
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
				<div class="col-lg-7">
					<div class="card">
						<div class="card-body" id="municipalityList">
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
    function getAllMunicipalities(){
        $("#municipalityList").empty();
        $.ajax({
			url : "myAjax.php",
	        type: "GET",
	        dataType: "JSON",
            data: {getAllMunicipalities: "getAllMunicipalities"},
	        success: function(results){
				var JavTable = "<table class='table table-bordered table-striped tableDT'>";
				JavTable = JavTable + "<thead>";
				JavTable = JavTable + "<tr>";
				JavTable = JavTable + "<th>Province</th>";
				JavTable = JavTable + "<th>Municipality</th>";
                JavTable = JavTable + "<th>Status</th>";
                JavTable = JavTable + "<th>Action</th>";
				JavTable = JavTable + "</tr></thead><tbody id='municipalityRecords'>";
				$(JavTable).appendTo($("#municipalityList"));
				jQuery.each(results, function(index, item){
					console.log(item.name);
					var newRow = "<tr><td>";
					newRow = newRow + item.province_name + "</td><td>";
					newRow = newRow + item.name + "</td><td>";
                    newRow = newRow + item.status + "</td><td>";
					newRow = newRow + "<button type='button' class='btn btn-primary' onclick = 'editMunicipalityStatus(" + item.id + ")'>Edit Status</button></td></tr>";
					$(newRow).appendTo($("#municipalityRecords"));
				});
				var EndJavTable = "</tbody></table>";
				$(EndJavTable).appendTo($("#municipalityList"));
				$(".tableDT").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');					
			}
	    });
    }

    function editMunicipalityStatus(municipality_id){
        $("#statusDropdown").empty();
        $.ajax({
			url : "myAjax.php",
	        type: "GET",
	        dataType: "JSON",
            data: {getMunicipality: "getMunicipality", id: municipality_id},
	        success: function(results){
				jQuery.each(results, function(index, item){
                    $('#modalTitle').html("EDIT <b style='color:red'>" + item.name + "</b> STATUS");
                    $('#currentStatus').val(item.status);
                    $('#municipalityID').val(item.id);
                    const statuses = ["ECQ", "MECQ", "GCQ"];
                    for (let i = 0; i < statuses.length; i++) {
                        if(statuses[i] == item.status) continue;
                        var recordOptions = "<option value='" + statuses[i] + "'>" + statuses[i] + "</option>";
                        $(recordOptions).appendTo($("#statusDropdown"));
                    }
				});			
                $('#editMunicipalityStatusModal').modal('toggle');
			}
	    });
    }

    // $("#editMunicipalityStatusForm").submit(function(e){
	// 	e.preventDefault(); // avoid to execute the actual submit of the form.
	// 	var form = $(this);
	// 	var url = form.attr('action');
	// 	$.ajax({
	// 		type: "POST",
	// 		url: url,
	// 		data: form.serialize(), // serializes the form's elements.
	// 		success: function(data){
	// 			$('#editMunicipalityStatusModal').modal('toggle');
	// 			getAllMunicipalities();
	// 		}
	// 	});
	// });

    getAllMunicipalities();
</script>