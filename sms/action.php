<?php
include('class/School.php');
$school = new School();

if(!empty($_POST['action']) && $_POST['action'] == 'listClasses') {
	$school->listClasses();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addClass') {
	$school->addClass();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getClass') {
	$school->getClassesDetails();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateClass') {
	$school->updateClass();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteClass') {
	$school->deleteClass();
}
if(!empty($_POST['action']) && $_POST['action'] == 'listStudent') {
	$school->listStudent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addStudent') {
	$school->addStudent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudentDetails') {
	$school->getStudentDetails();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateStudent') {
	$school->updateStudent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteStudent') {
	$school->deleteStudent();
}
/********sections********/
if(!empty($_POST['action']) && $_POST['action'] == 'listSections') {
	$school->listSections();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addSection') {
	$school->addSection();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getSection') {
	$school->getSection();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateSection') {
	$school->updateSection();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteSection') {
	$school->deleteSection();
}
/********sections********/
if(!empty($_POST['action']) && $_POST['action'] == 'listTeacher') {
	$school->listTeacher();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addTeacher') {
	$school->addTeacher();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getTeacher') {
	$school->getTeacher();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateTeacher') {
	$school->updateTeacher();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteTeacher') {
	$school->deleteTeacher();
}
/********Subject********/
if(!empty($_POST['action']) && $_POST['action'] == 'listSubject') {
	$school->listSubject();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addSubject') {
	$school->addSubject();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getSubject') {
	$school->getSubject();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateSubject') {
	$school->updateSubject();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteSubject') {
	$school->deleteSubject();
}
/********attendance********/
if(!empty($_POST['action']) && $_POST['action'] == 'getStudents') {
	$school->getStudents();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateAttendance') {
	$school->updateAttendance();
}
if(!empty($_POST['action']) && $_POST['action'] == 'attendanceStatus') {
	$school->attendanceStatus();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudentsAttendance') {
	$school->getStudentsAttendance();
}
?>