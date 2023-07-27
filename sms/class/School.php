<?php
session_start();
require('config.php');
class School extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $userTable = 'sms_user';
	private $studentTable = 'sms_students';
	private $classesTable = 'sms_classes';
	private $sectionsTable = 'sms_section';
	private $teacherTable = 'sms_teacher';
	private $subjectsTable = 'sms_subjects';
	private $attendanceTable = 'sms_attendance';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database ->password;
			$this -> dbName = $database -> dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}	
	public function adminLoginStatus (){
		if(empty($_SESSION["adminUserid"])) {
			header("Location: index.php");
		}
	}
	public function isLoggedin (){
		if(!empty($_SESSION["adminUserid"])) {	
			return true;
		} else {
			return false;
		}
	}
	public function adminLogin(){		
		$errorMessage = '';
		if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {	
			$email = $_POST['email'];
			$password = $_POST['password'];
			$sqlQuery = "SELECT * FROM ".$this->userTable." 
				WHERE email='".$email."' AND password='".md5($password)."' AND status = 'active' AND type = 'administrator'";
			$resultSet = mysqli_query($this->dbConnect, $sqlQuery) or die("error".mysql_error());
			$isValidLogin = mysqli_num_rows($resultSet);	
			if($isValidLogin){
				$userDetails = mysqli_fetch_assoc($resultSet);
				$_SESSION["adminUserid"] = $userDetails['id'];
				$_SESSION["admin"] = $userDetails['first_name']." ".$userDetails['last_name'];
				header("location: dashboard.php"); 		
			} else {		
				$errorMessage = "Invalid login!";		 
			}
		} else if(!empty($_POST["login"])){
			$errorMessage = "Enter Both user and password!";	
		}
		return $errorMessage; 		
	}	
	public function listClasses(){		
		$sqlQuery = "SELECT c.id, c.name, s.section, t.teacher 
			FROM ".$this->classesTable." as c
			LEFT JOIN ".$this->sectionsTable." as s ON c.section = s.section_id
			LEFT JOIN ".$this->teacherTable." as t ON c.teacher_id = t.teacher_id ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' WHERE (c.id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR c.name LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR s.section LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.teacher LIKE "%'.$_POST["search"]["value"].'%" ';				
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY c.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$classesData = array();	
		while( $classes = mysqli_fetch_assoc($result) ) {		
			$classesRows = array();			
			$classesRows[] = $classes['id'];
			$classesRows[] = $classes['name'];	
			$classesRows[] = $classes['section'];	
			$classesRows[] = $classes['teacher'];	
			$classesRows[] = '<button type="button" name="update" id="'.$classes["id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$classesRows[] = '<button type="button" name="delete" id="'.$classes["id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$classesData[] = $classesRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$classesData
		);
		echo json_encode($output);
	}
	public function addClass () {
		if($_POST["cname"]) {
			$insertQuery = "INSERT INTO ".$this->classesTable."(name, section, teacher_id) 
				VALUES ('".$_POST["cname"]."', '".$_POST["sectionid"]."', '".$_POST["teacherid"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}
	public function getClassesDetails(){
		$sqlQuery = "SELECT c.id, c.name, s.section, s.section_id, t.teacher_id 
			FROM ".$this->classesTable." as c
			LEFT JOIN ".$this->sectionsTable." as s ON c.section = s.section_id 
			LEFT JOIN ".$this->teacherTable." as t ON c.teacher_id = t.teacher_id
			WHERE c.id = '".$_POST["classid"]."'";		
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateClass() {
		if($_POST['classid']) {	
			$updateQuery = "UPDATE ".$this->classesTable." 
			SET Name = '".$_POST["cname"]."', section = '".$_POST["sectionid"]."', teacher_id = '".$_POST["teacherid"]."'
			WHERE id ='".$_POST["classid"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}	
	public function deleteClass(){
		if($_POST["classid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->classesTable."
				WHERE id = '".$_POST["classid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}
	/*****************Student methods****************/
	public function listStudent(){		
		$sqlQuery = "SELECT s.id, s.name, s.photo, s.gender, s.dob, s.mobile, s.email, s.current_address, s.father_name, s.mother_name,s.admission_no, s.roll_no, s.admission_date, s.academic_year, c.name as class, se.section 
			FROM ".$this->studentTable." as s
			LEFT JOIN ".$this->classesTable." as c ON s.class = c.id
			LEFT JOIN ".$this->sectionsTable." as se ON s.section = se.section_id ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' WHERE (s.id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.gender LIKE "%'.$_POST["search"]["value"].'%" ';		
			$sqlQuery .= ' OR s.mobile LIKE "%'.$_POST["search"]["value"].'%" ';		
			$sqlQuery .= ' OR s.admission_no LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR s.roll_no LIKE "%'.$_POST["search"]["value"].'%" ';			
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY s.id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$studentData = array();	
		while( $student = mysqli_fetch_assoc($result) ) {		
			$studentRows = array();			
			$studentRows[] = $student['id'];
			$studentRows[] = $student['admission_no'];
			$studentRows[] = $student['roll_no'];
			$studentRows[] = $student['name'];	
			$studentRows[] = "<img width='40' height='40' src='upload/".$student['photo']."'>";
			$studentRows[] = $student['class'];
			$studentRows[] = $student['section'];		
			$studentRows[] = '<button type="button" name="update" id="'.$student["id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$studentRows[] = '<button type="button" name="delete" id="'.$student["id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$studentData[] = $studentRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$studentData
		);
		echo json_encode($output);
	}
	public function addStudent () {
		if($_POST["sname"]) {			
			$target_dir = "upload/";
			$fileName = time().$_FILES["photo"]["name"];
			$targetFile = $target_dir . basename($fileName);
			if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
				echo "The file $fileName has been uploaded.";					
			} else {
				echo "Sorry, there was an error uploading your file.";
			}					
			$insertQuery = "INSERT INTO ".$this->studentTable."(name, email, mobile, gender, current_address, father_name, mother_name, class, section, admission_no, roll_no, academic_year, admission_date, dob, photo) 
				VALUES ('".$_POST["sname"]."', '".$_POST["email"]."', '".$_POST["mobile"]."', '".$_POST["gender"]."', '".$_POST["address"]."', '".$_POST["fname"]."', '".$_POST["mname"]."', '".$_POST["classid"]."', '".$_POST["sectionid"]."', '".$_POST["registerNo"]."', '".$_POST["rollNo"]."', '".$_POST["year"]."', '".$_POST["admission_date"]."', '".$_POST["dob"]."', '".$fileName."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}
	public function getStudentDetails(){
		$sqlQuery = "SELECT s.id, s.name, s.photo, s.gender, s.dob, s.mobile, s.email, s.current_address, s.father_name, s.mother_name,s.admission_no, s.roll_no, s.admission_date, s.academic_year, s.class, s.section 
			FROM ".$this->studentTable." as s
			LEFT JOIN ".$this->classesTable." as c ON s.class = c.id 
			WHERE s.id = '".$_POST["studentid"]."'";		
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateStudent() {
		if($_POST['studentid']) {	
			if($_FILES["photo"]["name"]) {
				$target_dir = "upload/";
				$fileName = time().$_FILES["photo"]["name"];
				$targetFile = $target_dir . basename($fileName);
				if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
					echo "The file $fileName has been uploaded.";
					$photoUpdate = ", photo = '$fileName'";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
			$updateQuery = "UPDATE ".$this->studentTable." 
			SET name = '".$_POST["sname"]."', email = '".$_POST["email"]."', mobile = '".$_POST["mobile"]."', gender = '".$_POST["gender"]."', current_address = '".$_POST["address"]."', father_name = '".$_POST["fname"]."', mother_name = '".$_POST["mname"]."', class = '".$_POST["classid"]."', section = '".$_POST["sectionid"]."', admission_no = '".$_POST["registerNo"]."', roll_no = '".$_POST["rollNo"]."', academic_year = '".$_POST["year"]."', admission_date = '".$_POST["admission_date"]."', dob = '".$_POST["dob"]."' $photoUpdate
			WHERE id ='".$_POST["studentid"]."'";
			echo $updateQuery;
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}	
	public function deleteStudent(){
		if($_POST["studentid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->studentTable."
				WHERE id = '".$_POST["studentid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}
	public function classList(){		
		$sqlQuery = "SELECT * FROM ".$this->classesTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$classHTML = '';
		while( $class = mysqli_fetch_assoc($result)) {
			$classHTML .= '<option value="'.$class["id"].'">'.$class["name"].'</option>';	
		}
		return $classHTML;
	}
	/*****************Section methods****************/
	public function listSections(){		
		$sqlQuery = "SELECT s.section_id, s.section 
			FROM ".$this->sectionsTable." as s ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' WHERE (s.section_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR s.section LIKE "%'.$_POST["search"]["value"].'%" ';					
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY s.section_id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$sectionData = array();	
		while( $section = mysqli_fetch_assoc($result) ) {		
			$sectionRows = array();			
			$sectionRows[] = $section['section_id'];
			$sectionRows[] = $section['section'];				
			$sectionRows[] = '<button type="button" name="update" id="'.$section["section_id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$sectionRows[] = '<button type="button" name="delete" id="'.$section["section_id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$sectionData[] = $sectionRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$sectionData
		);
		echo json_encode($output);
	}
	public function addSection () {
		if($_POST["section_name"]) {
			$insertQuery = "INSERT INTO ".$this->sectionsTable."(section) 
				VALUES ('".$_POST["section_name"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}
	public function getSection(){
		$sqlQuery = "
			SELECT * FROM ".$this->sectionsTable." 
			WHERE section_id = '".$_POST["sectionid"]."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateSection() {
		if($_POST['sectionid']) {	
			$updateQuery = "UPDATE ".$this->sectionsTable." 
			SET section = '".$_POST["section_name"]."'
			WHERE section_id ='".$_POST["sectionid"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}	
	public function deleteSection(){
		if($_POST["sectionid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->sectionsTable."
				WHERE section_id = '".$_POST["sectionid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}
	public function getSectionList(){		
		$sqlQuery = "SELECT * FROM ".$this->sectionsTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$sectionHTML = '';
		while( $section = mysqli_fetch_assoc($result)) {
			$sectionHTML .= '<option value="'.$section["section_id"].'">'.$section["section"].'</option>';	
		}
		return $sectionHTML;
	}
	/*****************Section methods****************/
	public function listTeacher(){		
		$sqlQuery = "SELECT t.teacher_id, t.teacher, s.subject, c.name, se.section			
			FROM ".$this->teacherTable." as t 
			LEFT JOIN ".$this->subjectsTable." as s ON t.subject_id = s.subject_id
			LEFT JOIN ".$this->classesTable." as c ON t.teacher_id = c.teacher_id
			LEFT JOIN ".$this->sectionsTable." as se ON c.section = se.section_id ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' WHERE (t.teacher_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.teacher LIKE "%'.$_POST["search"]["value"].'%" ';					
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.teacher_id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$teacherData = array();	
		while( $teacher = mysqli_fetch_assoc($result) ) {		
			$teacherRows = array();			
			$teacherRows[] = $teacher['teacher_id'];
			$teacherRows[] = $teacher['teacher'];
			$teacherRows[] = $teacher['subject'];
			$teacherRows[] = $teacher['name'];	
			$teacherRows[] = $teacher['section'];				
			$teacherRows[] = '<button type="button" name="update" id="'.$teacher["teacher_id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$teacherRows[] = '<button type="button" name="delete" id="'.$teacher["teacher_id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$teacherData[] = $teacherRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$teacherData
		);
		echo json_encode($output);
	}
	public function addTeacher () {
		if($_POST["teacher_name"]) {
			$insertQuery = "INSERT INTO ".$this->teacherTable."(teacher) 
				VALUES ('".$_POST["teacher_name"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}
	public function getTeacher(){
		$sqlQuery = "
			SELECT * FROM ".$this->teacherTable." 
			WHERE teacher_id = '".$_POST["teacherid"]."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateTeacher() {
		if($_POST['teacherid']) {	
			$updateQuery = "UPDATE ".$this->teacherTable." 
			SET teacher = '".$_POST["teacher_name"]."'
			WHERE teacher_id ='".$_POST["teacherid"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}	
	public function deleteTeacher(){
		if($_POST["teacherid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->teacherTable."
				WHERE teacher_id = '".$_POST["teacherid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}
	/*****************Subject methods****************/
	public function listSubject(){		
		$sqlQuery = "SELECT subject_id, subject, type, code 
			FROM ".$this->subjectsTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' WHERE (subject_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR subject LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR type LIKE "%'.$_POST["search"]["value"].'%" ';	
			$sqlQuery .= ' OR code LIKE "%'.$_POST["search"]["value"].'%" ';				
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY subject_id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$subjectData = array();	
		while( $subject = mysqli_fetch_assoc($result) ) {		
			$subjectRows = array();			
			$subjectRows[] = $subject['subject_id'];
			$subjectRows[] = $subject['subject'];	
			$subjectRows[] = $subject['code'];	
			$subjectRows[] = $subject['type'];				
			$subjectRows[] = '<button type="button" name="update" id="'.$subject["subject_id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$subjectRows[] = '<button type="button" name="delete" id="'.$subject["subject_id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$subjectData[] = $subjectRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$subjectData
		);
		echo json_encode($output);
	}
	public function addSubject () {
		if($_POST["subject"]) {
			$insertQuery = "INSERT INTO ".$this->subjectsTable."(subject, type, code) 
				VALUES ('".$_POST["subject"]."', '".$_POST["s_type"]."', '".$_POST["code"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}
	public function getSubject(){
		$sqlQuery = "
			SELECT * FROM ".$this->subjectsTable." 
			WHERE subject_id = '".$_POST["subjectid"]."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateSubject() {
		if($_POST['subjectid']) {	
			$updateQuery = "UPDATE ".$this->subjectsTable." 
			SET subject = '".$_POST["subject"]."', type = '".$_POST["s_type"]."', code = '".$_POST["code"]."'
			WHERE subject_id ='".$_POST["subjectid"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}	
	public function deleteSubject(){
		if($_POST["subjectid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->subjectsTable."
				WHERE subject_id = '".$_POST["subjectid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}
	public function getTeacherList(){		
		$sqlQuery = "SELECT * FROM ".$this->teacherTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$teacherHTML = '';
		while( $teacher = mysqli_fetch_assoc($result)) {
			$teacherHTML .= '<option value="'.$teacher["teacher_id"].'">'.$teacher["teacher"].'</option>';	
		}
		return $teacherHTML;
	}
	/* Student attendance */
	public function getStudents(){		
		if($_POST["classid"] && $_POST["sectionid"]) {
			$attendanceYear = date('Y'); 
			$attendanceMonth = date('m'); 
			$attendanceDay = date('d'); 
			$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;	
			
			$sqlQueryCheck = "SELECT * FROM ".$this->attendanceTable." 
				WHERE class_id = '".$_POST["classid"]."' AND section_id = '".$_POST["sectionid"]."' AND attendance_date = '".$attendanceDate."'";	
			$resultAttendance = mysqli_query($this->dbConnect, $sqlQueryCheck);	
			$attendanceDone = mysqli_num_rows($resultAttendance);
			
			$query = '';
			if($attendanceDone) {
				$query = "AND a.attendance_date = '".$attendanceDate."'";
			}
		
			$sqlQuery = "SELECT s.id, s.name, s.photo, s.gender, s.dob, s.mobile, s.email, s.current_address, s.father_name, s.mother_name,s.admission_no, s.roll_no, s.admission_date, s.academic_year, a.attendance_status, a.attendance_date
				FROM ".$this->studentTable." as s
				LEFT JOIN ".$this->attendanceTable." as a ON s.id = a.student_id
				WHERE s.class = '".$_POST["classid"]."' AND s.section='".$_POST["sectionid"]."' $query ";
			$sqlQuery .= "GROUP BY a.student_id ";	
			if(!empty($_POST["search"]["value"])){
				$sqlQuery .= ' AND (s.id LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR s.admission_no LIKE "%'.$_POST["search"]["value"].'%" ';	
				$sqlQuery .= ' OR s.roll_no LIKE "%'.$_POST["search"]["value"].'%" )';			
			}
			if(!empty($_POST["order"])){
				$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			} else {
				$sqlQuery .= 'ORDER BY s.id DESC ';
			}
			if($_POST["length"] != -1){
				$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
			}	
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			
			$studentData = array();	
			
			while($student = mysqli_fetch_assoc($result) ) {	
				$checked = array();
				$checked[1] = '';
				$checked[2] = '';
				$checked[3] = '';
				$checked[4] = '';
				if($student['attendance_date'] == $attendanceDate) {
					if($student['attendance_status'] == '1') {
						$checked[1] = 'checked';
					} else if($student['attendance_status'] == '2') {
						$checked[2] = 'checked';
					} else if($student['attendance_status'] == '3') {
						$checked[3] = 'checked';
					} else if($student['attendance_status'] == '4') {
						$checked[4] = 'checked';
					}	
				}				
				$studentRows = array();			
				$studentRows[] = $student['id'];
				$studentRows[] = $student['admission_no'];
				$studentRows[] = $student['roll_no'];
				$studentRows[] = $student['name'];	
				$studentRows[] = '
				<input type="radio" id="attendencetype1_'.$student['id'].'" value="1" name="attendencetype_'.$student['id'].'" autocomplete="off" '.$checked['1'].'>
				<label for="attendencetype_'.$student['id'].'">Present</label>
				<input type="radio" id="attendencetype2_'.$student['id'].'" value="2" name="attendencetype_'.$student['id'].'" autocomplete="off" '.$checked['2'].'>
				<label for="attendencetype'.$student['id'].'">Late </label>
				<input type="radio" id="attendencetype3_'.$student['id'].'" value="3" name="attendencetype_'.$student['id'].'" autocomplete="off" '.$checked['3'].'>
				<label for="attendencetype3_'.$student['id'].'"> Absent </label>
				<input type="radio" id="attendencetype4_'.$student['id'].'" value="4" name="attendencetype_'.$student['id'].'" autocomplete="off" '.$checked['4'].'><label for="attendencetype_'.$student['id'].'"> Half Day </label>';					
				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$studentData
			);
			echo json_encode($output);
			
		}
	}
	public function updateAttendance(){	
		$attendanceYear = date('Y'); 
		$attendanceMonth = date('m'); 
		$attendanceDay = date('d'); 
		$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;		
		$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
			WHERE class_id = '".$_POST["att_classid"]."' AND section_id = '".$_POST["att_sectionid"]."' AND attendance_date = '".$attendanceDate."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$attendanceDone = mysqli_num_rows($result);
		if($attendanceDone) {
			foreach($_POST as $key => $value) {				
				if (strpos($key, "attendencetype_") !== false) {
					$student_id = str_replace("attendencetype_","", $key);
					$attendanceStatus = $value;					
					if($student_id) {
						$updateQuery = "UPDATE ".$this->attendanceTable." SET attendance_status = '".$attendanceStatus."'
						WHERE student_id = '".$student_id."' AND class_id = '".$_POST["att_classid"]."' AND section_id = '".$_POST["att_sectionid"]."' AND attendance_date = '".$attendanceDate."'";
						mysqli_query($this->dbConnect, $updateQuery);
					}
				}				
			}	
			echo "Attendance updated successfully!";			
		} else {
			foreach($_POST as $key => $value) {				
				if (strpos($key, "attendencetype_") !== false) {
					$student_id = str_replace("attendencetype_","", $key);
					$attendanceStatus = $value;					
					if($student_id) {
						$insertQuery = "INSERT INTO ".$this->attendanceTable."(student_id, class_id, section_id, attendance_status, attendance_date) 
						VALUES ('".$student_id."', '".$_POST["att_classid"]."', '".$_POST["att_sectionid"]."', '".$attendanceStatus."', '".$attendanceDate."')";
						mysqli_query($this->dbConnect, $insertQuery);
					}
				}
				
			}
			echo "Attendance save successfully!";
		}	
	}
	public function attendanceStatus(){	
		$attendanceYear = date('Y'); 
		$attendanceMonth = date('m'); 
		$attendanceDay = date('d'); 
		$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;		
		$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
			WHERE class_id = '".$_POST["classid"]."' AND section_id = '".$_POST["sectionid"]."' AND attendance_date = '".$attendanceDate."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$attendanceDone = mysqli_num_rows($result);
		if($attendanceDone) {
			echo "Attendance already submitted!";
		} 
	}
	public function getStudentsAttendance(){		
		if($_POST["classid"] && $_POST["sectionid"] && $_POST["attendanceDate"]) {
			$sqlQuery = "SELECT s.id, s.name, s.photo, s.gender, s.dob, s.mobile, s.email, s.current_address, s.father_name, s.mother_name,s.admission_no, s.roll_no, s.admission_date, s.academic_year, a.attendance_status
				FROM ".$this->studentTable." as s
				LEFT JOIN ".$this->attendanceTable." as a ON s.id = a.student_id
				WHERE s.class = '".$_POST["classid"]."' AND s.section='".$_POST["sectionid"]."' AND a.attendance_date = '".$_POST["attendanceDate"]."'";
			if(!empty($_POST["search"]["value"])){
				$sqlQuery .= ' AND (s.id LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR s.name LIKE "%'.$_POST["search"]["value"].'%" ';
				$sqlQuery .= ' OR s.admission_no LIKE "%'.$_POST["search"]["value"].'%" ';	
				$sqlQuery .= ' OR s.roll_no LIKE "%'.$_POST["search"]["value"].'%" ';	
				$sqlQuery .= ' OR a.attendance_date LIKE "%'.$_POST["search"]["value"].'%" )';
			}
			if(!empty($_POST["order"])){
				$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			} else {
				$sqlQuery .= 'ORDER BY s.id DESC ';
			}
			if($_POST["length"] != -1){
				$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
			}	
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			
			$studentData = array();	
			
			while($student = mysqli_fetch_assoc($result) ) {					
				$attendance = '';
				if($student['attendance_status'] == '1') {
					$attendance = '<small class="label label-success">Present</small>';
				} else if($student['attendance_status'] == '2') {
					$attendance = '<small class="label label-warning">Late</small>';
				} else if($student['attendance_status'] == '3') {
					$attendance = '<small class="label label-danger">Absent</small>';
				} else if($student['attendance_status'] == '4') {
					$attendance = '<small class="label label-info">Half Day</small>';
				}				
				$studentRows = array();			
				$studentRows[] = $student['id'];
				$studentRows[] = $student['admission_no'];
				$studentRows[] = $student['roll_no'];
				$studentRows[] = $student['name'];		
				$studentRows[] = $attendance;					
				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$studentData
			);
			echo json_encode($output);
			
		}
	}
}
?>