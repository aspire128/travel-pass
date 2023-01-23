<?php include("header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Status Requirements</h1>
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="admin.php">Home</a></li>
						<li class="breadcrumb-item active">Status Requirements</li>
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
						<div class="card-body" id="requirementList">
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content -->
    <div class="modal fade" id="editRequirementsModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="actions.php" id="editRequirementsForm">
                        <div class="form-group row mb-3">
                            <label class="col-2">Requirements</label>
                            <div class="col-6">
							    <select name="requirement_id[]" class="select2" multiple="multiple" id="requirementsDropdown" required></select>
                            </div>
						</div>
                        <input type="text" name="status" class="form-control" id="status" hidden>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="editRequirements" form="editRequirementsForm" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<?php include("footer.php"); ?>
<script>
    function getStatusRequirements(){
        $("#requirementList").empty();
        $.ajax({
			url : "myAjax.php",
	        type: "GET",
	        dataType: "JSON",
            data: {getStatusRequirements: "getStatusRequirements"},
	        success: function(results){
				var JavTable = "<table class='table table-bordered table-striped tableDT'>";
				JavTable = JavTable + "<thead>";
				JavTable = JavTable + "<tr>";
				JavTable = JavTable + "<th>Status</th>";
                JavTable = JavTable + "<th>Requirements</th>";
                JavTable = JavTable + "<th>Action</th>";
				JavTable = JavTable + "</tr></thead><tbody id='requirementsRecords'>";
				$(JavTable).appendTo($("#requirementList"));
				jQuery.each(results, function(index, item){
					var newRow = "<tr><td>";
					newRow = newRow + item.status + "</td><td>";
                    newRow = newRow + item.status_requirement + "</td><td>";
					newRow = newRow + "<button type='button' class='btn btn-primary' onclick = 'editRequirementStatus(\"" + item.status + "\")'>Edit Requirements</button></td></tr>";
					$(newRow).appendTo($("#requirementsRecords"));
				});
				var EndJavTable = "</tbody></table>";
				$(EndJavTable).appendTo($("#requirementList"));
				$(".tableDT").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');					
			}
	    });
    }

    function editRequirementStatus(status){
        $("#requirementsDropdown").empty();
        $.ajax({
			url : "myAjax.php",
	        type: "GET",
	        dataType: "JSON",
            data: {getRequirements: "getRequirements"},
	        success: function(results){
                $('#modalTitle').html("EDIT <b style='color:red'>" + status + "</b> REQUIREMENTS");
                $('#status').val(status);
				jQuery.each(results, function(index, item){
                    var requirementOptions = "<option value='" + item.id + "'>" + item.name + "</option>";
                    $(requirementOptions).appendTo($("#requirementsDropdown"));
				});			
                $('#editRequirementsModal').modal('toggle');
			}
	    });
    }

    getStatusRequirements();
    
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>