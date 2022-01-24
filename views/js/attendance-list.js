/**===================================================
 * 		VIEW ALL EMPLOYEE MONTHLY ATTENDANCE IN TABLE
 * ===================================================*/
// $.ajax({
// 	url: 'ajax/view-attendance-datatable.ajax.php',
// 	success: function(res) {
// 		console.log(res);
// 	}
// });

$('.attendanceList').DataTable({
	scrollX: true,
	sorting: false,
	ordering: false,
	ajax: 'ajax/view-attendance-datatable.ajax.php'
});

/**===================================================
 * 		SHOW ATTENDANCE DETAILS IN MODAL BOX
 * ===================================================*/
$('.attendanceList').on('click', '.btnShowEmpAttendance', function() {
	$('#clockInTime').html();
	$('#clockOutTime').html();
	$('#stillWorkingText').addClass('d-none');

	let id = $(this).attr('id');

	let data = new FormData();
	data.append('attendanceId', id);

	$.ajax({
		url: 'ajax/view-attendance.ajax.php',
		method: 'POST',
		data: data,
		cache: false,
		processData: false,
		contentType: false,
		dataType: 'json',
		success: function(res) {
			let clockIn = res['clock_in'];
			let clockOut = res['clock_out'];

			// CALCULATE PERCENTAGE OF TOTAL WORKING TIME
			let startHour = Number(clockIn.slice(0, 2));
			let startMin = Number(clockIn.slice(3, 5));
			startMin = startMin == 0 ? 0 : 60 - startMin;
			let endHour = Number(clockOut.slice(0, 2)) - 1;
			let endMin = Number(clockOut.slice(3, 5));

			let date = new Date();
			let currHour = date.getHours() - 1;
			let currMin = date.getMinutes();

			let workingHour = 0;
			let workTimeHour = 0;
			let workTimeMin = 0;
			if (!endHour || endHour <= 0) {
				workingHour = (currHour - startHour) * 60 + currMin + startMin;
				workTimeHour = currHour - startHour;
				if (currMin + startMin >= 60) {
					workTimeHour += 1;
					workTimeMin = startMin + currMin - 60;
				} else {
					workTimeMin = startMin + currMin;
				}
			} else {
				workingHour = (endHour - startHour) * 60 + startMin + endMin;
				workTimeHour = endHour - startHour;
				if (startMin + endMin >= 60) {
					workTimeHour += 1;
					workTimeMin = startMin + endMin - 60;
				} else {
					workTimeMin = startMin + endMin;
				}
			}
			// PERCENTAGE
			let percent = workingHour * 100 / 540;
			progress(percent);

			// WORKING TIME
			workTimeMin = workTimeMin.toString().padStart(2, '0');
			workTimeHour = workTimeHour.toString().padStart(2, '0');

			// SHOW TIME
			$('#clockInTime').html(clockIn);
			$('#clockOutTime').html(clockOut);
			$('#workingHours').html(workTimeHour + ':' + workTimeMin + ' Hours');
		}
	});
});

function progress(percent) {
	percent = percent >= 100 ? 100 : percent;
	let circle = document.querySelector('#workingHourCircle');
	let radius = circle.getAttribute('r') * 2 * Math.PI;
	let bar = circle.getAttribute('stroke-dasharray') - radius * percent / 100;
	// console.log(radius);
	circle.setAttribute('stroke-dashoffset', bar);
}
