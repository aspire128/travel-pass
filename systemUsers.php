<?php include("header.php"); ?>
<?php
    include("db_connection.php");
    $sql = "SELECT DISTINCT province_name FROM provinces";
    $provinces = $conn->query($sql);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">List of Users</h1>
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="travelApplication.php">Home</a></li>
						<li class="breadcrumb-item active">System Users</li>
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
				<div class="col-lg-10">
					<div class="card">
                        <div class="card-header">
                            <button class="btn btn-primary" onclick="resetModal()">New User</button>
						</div>
						<div class="card-body" id="usersList">
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content -->
    <div class="modal fade" id="editUserModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="actions.php" id="editUserForm">
                        <div class="form-group row mb-3">
                            <label class="col-2">Username</label>
                            <div class="col-6">
							    <input type="text" class="form-control" name="username" id="username" required>
                            </div>
						</div>
                        <div class="form-group row mb-3">
                            <label class="col-2">Password</label>
                            <div class="col-6">
							    <input type="text" name="password" id="password" class="form-control" required>
                            </div>
						</div>
                        <div class="form-group row mb-3">
                            <label class="col-2">Firstname</label>
                            <div class="col-6">
							    <input type="text" name="firstname" id="firstname" class="form-control" required>
                            </div>
						</div>
                        <div class="form-group row mb-3">
                            <label class="col-2">Middlename</label>
                            <div class="col-6">
							    <input type="text" name="middlename" id="middlename" class="form-control">
                            </div>
						</div>
                        <div class="form-group row mb-3">
                            <label class="col-2">Lastname</label>
                            <div class="col-6">
							    <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>
						</div>
                        <div class="form-group row mb-3">
                            <label class="col-2">User Type</label>
                            <div class="col-6">
							    <select name="usertype" id="usertype" class="form-control" required>
                                    <option value="" selected disabled>Choose an option</option>
                                    <option value="System Administrator">System Administrator</option>
                                    <option value="PNP Staff">PNP Staff</option>
                                    <option value="PNP Director">PNP Director</option>
                                </select>
                            </div>
						</div>
                        <div class="form-group row mb-3">
                            <label class="col-2">Designation</label>
                            <div class="col-6">
							    <select name="designation" id="designation" class="form-control" required>
                                    <option value="" selected disabled>Choose an option</option>
                                    <option value="All">All</option>
                                    <?php
                                        foreach($provinces as $row){
                                            echo "<option value='$row[province_name]'>$row[province_name]</option>";
                                        }
                                    ?>
                                </select>
                            </div>
						</div>
                        <input type="text" name="id" class="form-control" id="user_id" hidden>
                        <input type="text" name="mode" class="form-control" id="mode" hidden>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="editUserInfo" form="editUserForm" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<?php include("footer.php"); ?>
<script>
    function getAllUsers(){
        $("#usersList").empty();
        $.ajax({
			url : "myAjax.php",
	        type: "GET",
	        dataType: "JSON",
            data: {getAllUsers: "getAllUsers"},
	        success: function(results){
				var JavTable = "<table class='table table-bordered table-striped tableDT'>";
				JavTable = JavTable + "<thead>";
				JavTable = JavTable + "<tr>";
				JavTable = JavTable + "<th>Name</th>";
                JavTable = JavTable + "<th>Username</th>";
                JavTable = JavTable + "<th>User Type</th>";
                JavTable = JavTable + "<th>Designation</th>";
                JavTable = JavTable + "<th>Action</th>";
				JavTable = JavTable + "</tr></thead><tbody id='usersRecords'>";
				$(JavTable).appendTo($("#usersList"));
				jQuery.each(results, function(index, item){
                    var fullname = item.firstname + " " + item.middlename + " " + item.lastname;
					var newRow = "<tr><td>";
					newRow = newRow + fullname + "</td><td>";
                    newRow = newRow + item.username + "</td><td>";
                    newRow = newRow + item.usertype + "</td><td>";
                    newRow = newRow + item.designation + "</td><td>";
					newRow = newRow + "<button type='button' class='btn btn-primary' onclick = 'editUser(" + item.id + ")'>Edit Info</button></td></tr>";
					$(newRow).appendTo($("#usersRecords"));
				});
				var EndJavTable = "</tbody></table>";
				$(EndJavTable).appendTo($("#usersList"));
				$(".tableDT").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');					
			}
	    });
    }

    function editUser(user_id){
        $.ajax({
			url : "myAjax.php",
	        type: "GET",
	        dataType: "JSON",
            data: {editUser: "editUser", id: user_id},
	        success: function(results){
				jQuery.each(results, function(index, item){
                    var fullname = item.firstname + " " + item.middlename + " " + item.lastname;
                    $('#modalTitle').html("EDIT <b style='color:red'>" + fullname + "</b> INFO");
                    $('#username').val(item.username);
                    $('#password').val(item.password);
                    $('#firstname').val(item.firstname);
                    $('#middlename').val(item.middlename);
                    $('#lastname').val(item.lastname);
                    $('#user_id').val(item.id);
                    $('#mode').val("Edit");
                    $('#username').prop('readonly', true);
                    $("#usertype > option").each(function() {
                        if(this.text == item.usertype)
                            $('#usertype').val(this.text);
                    });
                    $("#designation > option").each(function() {
                        if(this.text == item.designation)
                            $('#designation').val(this.text);
                    });
				});			
                $('#editUserModal').modal('toggle');
			}
	    });
    }

    function resetModal(){
        $('#editUserForm')[0].reset();
        $('#modalTitle').html("NEW USER");
        $('#username').prop('readonly', false);
        $('#mode').val("Add");
        $('#editUserModal').modal('toggle');
    }

    getAllUsers();
</script>