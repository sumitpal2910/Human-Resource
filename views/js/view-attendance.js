/**==========================================================
 * 		VIEW ATTENDANCE SEND AJAX REQUEST
 * ==========================================================*/
// let data = new FormData();
// data.append('employeeId', 0);
// data.append('month', 7);
// data.append('year', 2021);
// $.ajax({
// 	url: 'ajax/attendance-overview.ajax.php',
// 	type: 'POST',
// 	data: data,
// 	processData: false,
// 	contentType: false,
// 	cache: false,
// 	dataType: 'json',
// 	success: function(res) {
// 		console.log(res);
// 	}
// });

/**==========================================================
 * 		SEARCH EMPLOYEE DETAILS
$ * ============================================================*/
$('#attOvSubmit').click(function() {
	let empId = $('#attOvEmployee').val();
	let month = $('#attOvMonth').val();
	let year = $('#attOvYear').val();

	$('.viewAttendance').DataTable().destroy();
	viewAttendanceOverview(empId, month, year);
});

/**========================================================
 * 		SHOW DATA TABLE FUNCTION
 * ======================================================== */
function viewAttendanceOverview(id, m, y) {
	$('.viewAttendance').DataTable({
		ajax: {
			url: 'ajax/attendance-overview.ajax.php',
			type: 'POST',
			data: {
				employeeId: id,
				month: m,
				year: y
			}
		}
	});
}

viewAttendanceOverview(0, 0, 0);

/**========================================================
 * 		SEND TO CALENDAR OVERVIEW ON CLICK VIEW BUTTON
 * ======================================================== */
$('.viewAttendance').on('click', 'button.btnEmpViewAtt', function() {
	let empId = $(this).attr('empId');
	console.log(empId);

	window.location = `index.php?root=attendance-calender&view-employee=${empId}`;
});
