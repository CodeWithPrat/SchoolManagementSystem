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
<script src="js/students.js"></script>
<?php include('inc/container.php');?>
<div class="container">	
	<?php include('side-menu.php');	?>
	<div class="content">
		<div class="container-fluid">
			<div>   
				<a href="#"><strong><span class="ti-crown"></span> Student Section</strong></a>
				<hr>		
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-10">
							<h3 class="panel-title"></h3>
						</div>
						<div class="col-md-2" align="right">
							<button type="button" name="add" id="addStudent" class="btn btn-success btn-xs">Student Admission</button>
						</div>
					</div>
				</div>
				<table id="studentList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Reg No</th>
							<th>Roll No</th>	
							<th>Name</th>
							<th>Photo</th>	
							<th>Class</th>
							<th>Section</th>				
								
							<th></th>
							<th></th>							
						</tr>
					</thead>
				</table>
				
			</div>			
		</div>		
	</div>	
</div>	
<div id="studentModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="studentForm" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Student</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="mobile" class="control-label">Admission Number</label>							
						<input type="number" class="form-control" id="registerNo" name="registerNo" placeholder="Admission Number..">							
					</div>	
					<div class="form-group">
						<label for="mobile" class="control-label">Roll Number</label>							
						<input type="number" class="form-control" id="rollNo" name="rollNo" placeholder="Roll Number..">							
					</div>	
					<div class="form-group">
						<label for="mname" class="control-label">Academic Year*</label>	
						<select name="year" id="year" class="form-control" required>
							<option value="">Select Year</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
						</select>
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Admission Date</label>							
						<input type="text" class="form-control"  id="admission_date" name="admission_date" placeholder="mm/dd/yyyy">							
					</div>		
					<div class="form-group">
						<label for="mname" class="control-label">Class*</label>	
						<select name="classid" id="classid" class="form-control" required>
							<option value="">Select</option>
							<?php echo $school->classList(); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="mname" class="control-label">Section</label>	
						<select name="sectionid" id="sectionid" class="form-control" required>
							<option value="">Select</option>
							<?php echo $school->getSectionList(); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="firstname" class="control-label">Name*</label>
						<input type="text" class="form-control" id="sname" name="sname" placeholder="Student Name" required>				
					</div>	
					<div class="form-group">
						<label for="firstname" class="control-label">Photo*</label>
						<input type="file" class="form-control" id="photo" name="photo" placeholder="Student photo" required>				
					</div>						
					<div class="form-group">
						<label for="gender" class="control-label">Gender</label><br>							
						<label class="radio-inline">
							<input type="radio" name="gender" id="male" value="male" required>Male
						</label>
						<label class="radio-inline">
							<input type="radio" name="gender" id="female" value="female" required>Female
						</label>							
					</div>	
					<div class="form-group">
						<label for="email" class="control-label">Date of Birth</label>							
						<input type="text" class="form-control"  id="dob" name="dob" placeholder="mm/dd/yyyy">							
					</div>	
					<div class="form-group">
						<label for="email" class="control-label">Email</label>							
						<input type="email" class="form-control"  id="email" name="email" placeholder="Email">							
					</div>	
					<div class="form-group">
						<label for="mobile" class="control-label">Mobile</label>							
						<input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile">							
					</div>		
					<div class="form-group">
						<label for="address" class="control-label">Address</label>							
						<textarea class="form-control" rows="2" id="address" name="address" placeholder="Address"></textarea>							
					</div>
					<div class="form-group">
						<label for="fname" class="control-label">Father Name</label>							
						<input type="text" class="form-control" id="fname" name="fname" placeholder="Father name...">							
					</div>	
					<div class="form-group">
						<label for="mname" class="control-label">Mother Name</label>							
						<input type="text" class="form-control" id="mname" name="mname" placeholder="Mother Name...">						
					</div>									
				</div>
				<div class="modal-footer">
					<input type="hidden" name="studentid" id="studentid" />
					<input type="hidden" name="action" id="action" value="updateStudent" />
					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php include('inc/footer.php');?>