/*================================================
	CLOCK
==================================================== */
function clock() {
	let date = new Date();

	let hour = date.getHours().toString().padStart(2, '0');
	let min = date.getMinutes().toString().padStart(2, '0');
	let sec = date.getSeconds().toString().padStart(2, '0');
	let time = `${hour}:${min}:${sec}`;
	$('#clock').html(time);
}
setInterval(clock, 1000);

/**======================================================
 * 		SHOW ATTENDANCE IN DATA TABLE
 * ======================================================*/

// let data = new FormData();
// data.append('employeeId', 5);
// $.ajax({
// 	url: 'ajax/emp-attendance.ajax.php',
// 	method: 'POST',
// 	data: data,
// 	processData: false,
// 	cache: false,
// 	contentType: false,
// 	// contentType:'json',
// 	success: function(res) {
// 		console.log(res);
// 	}
// });

let employeeId = $('#dataTableEmployeeId').val();
$('.empAttendanceTable').DataTable({
	responsive: true,
	processing: true,
	Paginate: true,
	// "order": [[ 1, "desc" ]],
	ajax: {
		url: 'ajax/emp-attendance.ajax.php',
		type: 'POST',
		data: {
			employeeId: employeeId
		}
	}
});
