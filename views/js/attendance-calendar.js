/**=========================================================
 * 		RECIVE DATA OF SEARCH EMPLOYEE
 * =========================================================*/
$('#attCalSubmit').click(function() {
	$('#attCalWorkingDay').html('');
	$('#attCalPresent').html('');
	$('#attCalLate').html('');
	$('#attCalAbsent').html('');
	$('#attCalHoliday').html('');
	$('#calendar').html('');

	let employeeId = $('#attCalEmployee').val();
	let month = $('#attCalMonth').val();
	let year = $('#attCalYear').val();

	// SHOW ALERT
	if (employeeId == 0 || !employeeId) {
		Swal.fire({
			icon: 'warning',
			text: 'Select  an Employee',
			confirmButtonText: 'Close'
		});
	}
	attendanceCalendar(employeeId, month, year);

	// SENDING REQUEST TO GET EMPLOYEE ALL ATTENDNACE
	let data = new FormData();
	data.append('attendanceOverview', 1);
	data.append('employeeId', employeeId);
	data.append('month', month);
	data.append('year', year);
	$.ajax({
		url: 'ajax/view-attendance.ajax.php',
		method: 'POST',
		data: data,
		processData: false,
		cache: false,
		contentType: false,
		dataType: 'json',
		success: function(res) {
			$('#attCalWorkingDay').html(res['working_day']);
			$('#attCalPresent').html(res['present']);
			$('#attCalLate').html(res['late']);
			$('#attCalAbsent').html(res['absent']);
			$('#attCalHoliday').html(res['holiday']);
			$('#attCalLeave').html(res['leave']);
		}
	});
});

/**===============================================================
 * 		DISPLAY CALENDAR
  * ===============================================================*/
function attendanceCalendar(employeeId, month, year) {
	let m = month.toString().padStart(2, '0');
	const Calendar = FullCalendar.Calendar;
	const calendarEl = document.querySelector('#calendar');

	let calendar = new Calendar(calendarEl, {
		// eventColor: '#378006',
		plugins: [
			'bootstrap',
			'interaction',
			'dayGrid'
		],
		header: {
			left: '',
			center: 'title',
			right: 'today'
		},
		themeSystem: 'bootstrap',
		fixedWeekCount: false,
		events: {
			url: 'ajax/view-attendance.ajax.php',
			method: 'POST',
			extraParams: {
				fullCal: 1,
				employeeId: employeeId,
				month: month,
				year: year
			}
		}
	});
	// DESTROY
	calendar.destroy();

	// CHANGE TODAY BG COLOR
	$('.fc-today').removeClass('alert-info');
	$('.fc-today').css({ backgroundColor: '#c4ffcc' });

	// Change MOnth Name
	let date = year + '-' + m + '-01';
	calendar.gotoDate(date);

	// Render
	calendar.render();
}
let date = new Date();
attendanceCalendar(0, date.getMonth() + 1, date.getFullYear());

/**======================================================
 * 		SEARCH IF VIEW-EMPLOYEE PARAM IS SET 
 * ======================================================*/
let param = getUrlParam(window.location, 'view-employee');
if (param) {
	document.querySelector('#attCalSubmit').click();
}
