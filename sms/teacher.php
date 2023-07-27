<?php 
include('class/School.php');
$school = new School();
$school->adminLoginStatus();
include('inc/header.php');
?>
<title>webdamn.com : Demo School Management System with PHP & MySQL</title>
<?php include('include_files.php');?>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/teacher.js"></script>
<?php include('inc/container.php');?>
<div class="container">	
	<?php include('side-menu.php');	?>
	<div class="content">
		<div class="container-fluid">
			<div>   
				<a href="#"><strong><span class="ti-crown"></span> Teachers Section</strong></a>
				<hr>		
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-10">
							<h3 class="panel-title"></h3>
						</div>
						<div class="col-md-2" align="right">
							<button type="button" name="add" id="addTeacher" class="btn btn-success btn-xs">Add New Teacher</button>
						</div>
					</div>
				</div>
				<table id="teacherList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>	
							<th>Assigned Subjects</th>	
							<th>Class</th>	
							<th>Sections</th>								
							<th></th>
							<th></th>							
						</tr>
					</thead>
				</table>
				
			</div>			
		</div>		
	</div>	
</div>	
<div id="teacherModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="teacherForm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Teacher</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="teacher" class="control-label">Class Name*</label>
						<input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="Teacher Name" required>					
					</div>								
				</div>
				<div class="modal-footer">
					<input type="hidden" name="teacherid" id="teacherid" />
					<input type="hidden" name="action" id="action" value="updateTeacher" />
					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>