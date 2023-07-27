$(document).ready(function(){	
	$('#search').click(function(){
		$('#studentList').removeClass('hidden');		
		if ($.fn.DataTable.isDataTable("#studentList")) {
			$('#studentList').DataTable().clear().destroy();
		}
		var classid = $('#classid').val();
		var sectionid = $('#sectionid').val();
		var attendanceDate = $('#attendanceDate').val();		
		if(classid && sectionid && attendanceDate) {			
			$('#studentList').DataTable({
				"lengthChange": false,
				"processing":true,
				"serverSide":true,
				"order":[],
				"ajax":{
					url:"action.php",
					type:"POST",				
					data:{classid:classid, sectionid:sectionid, attendanceDate:attendanceDate, action:'getStudentsAttendance'},
					dataType:"json"
				},
				"columnDefs":[
					{
						"targets":[0],
						"orderable":false,
					},
				],
				"pageLength": 10
			});				
		}
	});	
});