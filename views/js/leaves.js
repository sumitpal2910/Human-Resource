/**=======================================================
 *      CALCULATE NUMBER OF LEAVE DAYS
 * =======================================================*/
$('.leaveEndDate').on('input', function() {
	let endDate = $(this).val();
	let startDate = $(this).parent().parent().children('.leaveDateDiv').children('.leaveStartDate').val();

	let diff = get2DatesDay(startDate, endDate);

	$('.leaveDay').val(diff);
});

// ------------------------------------------------------------ EMPLOYEE ---------------------------------------------------------

/**=======================================================
 *      SHOW EMPLOYEE LEAVE IN DATATABLE
 * =======================================================*/
let leaveEmployeeId = $('#employeeId').val();

// let data = new FormData();
// data.append('employeeId', leaveEmployeeId);
// $.ajax({
// 	url: 'ajax/leave-employee.ajax.php',
// 	type: 'POST',
// 	data: data,
// 	contentType: false,
// 	processData: false,
// 	cache: false,
// 	success: function(res) {
// 		console.log(res);
// 	}
// });

$('.employeeLeaveTable').DataTable({
	responsive: true,
	processing: true,
	deferRender: true,
	retrieve: true,
	ajax: {
		url: 'ajax/leave-employee.ajax.php',
		type: 'POST',
		data: {
			employeeId: leaveEmployeeId
		}
	}
});

/**=======================================================
 *      EDIT EMPLOYEE LEAVE 
 * =======================================================*/
$('.employeeLeaveTable').on('click', 'button.btnEditEmployeeLeave', function() {
	$('#editEmployeeLeave').prop('disabled', false);

	let id = $(this).attr('id');

	let data = new FormData();
	data.append('leaveId', id);

	$.ajax({
		url: 'ajax/leave-employee.ajax.php',
		type: 'POST',
		data: data,
		contentType: false,
		processData: false,
		cache: false,
		dataType: 'json',
		success: function(res) {
			$('#editLeaveId').val(res['id']);
			$('#editLeaveType').val(res['leave_type_id']);
			$('#editLeaveStartDate').val(res['start_date']);
			$('#editLeaveEndDate').val(res['end_date']);
			$('#editLeaveDay').val(res['number_of_day']);
			$('#editLeaveReason').val(res['reason']);

			// SHOW STATUS
			let date = new Date();
			let currDate = `${date.getFullYear()}-${getDateFormat(date.getMonth() + 1)}-${getDateFormat(
				date.getDate()
			)}`;
			console.log(currDate);
			let status = '';
			switch (res['status']) {
				case 'pending':
					switch (res['apply_date']) {
						case currDate:
							status = "<span class='badge badge-primary'>New</span>";
							break;

						default:
							status = "<span class='badge badge-warning'>Pending</span>";
							break;
					}
					break;
				case 'approved':
					status = "<span class='badge badge-success'>Approved</span>";
					break;
				case 'rejected':
					status = "<span class='badge badge-danger'>Rejected</span>";
					break;
			}

			$('#editLeaveStatus').html(`Edit Leave ${status}`);

			if (res['status'] === 'approved') {
				$('#editEmployeeLeave').prop('disabled', true);
			}
		}
	});
});

// -----

// --------------------------------------------------------------------- ADMIN ------------------------------------------------------------------

// -----
/**==============================================================
 * 		ADMIN SHOW LEAVE IN DATATABLE
 * ==============================================================*/
$.ajax({
	url: 'ajax/view-leave-datatable.ajax.php',
	success: function(res) {
		console.log(res);
	}
});
function showLeaveDataTable() {
	$('.showLeaveTable').DataTable({
		sorting: false,
		responsive: true,
		scrollX: true,
		ajax: 'ajax/view-leave-datatable.ajax.php'
	});
}
showLeaveDataTable();

/**==============================================================
 * 		EDIT LEAVE
 * ==============================================================*/
$('.showLeaveTable').on('click', 'button.btnEditLeave', function() {
	let id = $(this).attr('id');

	let data = new FormData();
	data.append('leaveId', id);

	$.ajax({
		url: 'ajax/leave-employee.ajax.php',
		type: 'POST',
		data: data,
		contentType: false,
		processData: false,
		cache: false,
		dataType: 'json',
		success: function(res) {
			$('#adminEditLeaveId').val(res['id']);
			$('#adminEditLeaveEmpId').val(res['employee_id']);
			$('#adminEditLeaveType').val(res['leave_type_id']);
			$('#adminEditLeaveStartDate').val(res['start_date']);
			$('#adminEditLeaveEndDate').val(res['end_date']);
			$('#adminEditLeaveDay').val(res['number_of_day']);
			$('#adminEditLeaveStatus').val(res['status']);
			$('#adminEditLeaveStatusActual').val(res['status']);
			$('#adminEditLeaveReason').val(res['reason']);
			$('#adminEditLeaveApplyDate').val(res['apply_date']);

			// EMPLOYEE REQUEST
			let eData = new FormData();
			eData.append('employeeId', res['employee_id']);
			$.ajax({
				url: 'ajax/employees.ajax.php',
				type: 'POST',
				data: eData,
				contentType: false,
				processData: false,
				cache: false,
				dataType: 'json',
				success: function(empRes) {
					let employee = empRes['name'] + ' (' + empRes['code'] + ')';
					$('#adminEditLeaveEmployee').val(employee);
				}
			});

			// REMAIN LEAVE
			let rlData = new FormData();
			rlData.append('remainLeave', res['employee_id']);
			$.ajax({
				url: 'ajax/leave-admin.ajax.php',
				type: 'POST',
				data: rlData,
				contentType: false,
				processData: false,
				cache: false,
				dataType: 'json',
				success: function(rlRes) {
					$('#adminEditLeaveRemain').val(rlRes);
				}
			});

			// SHOW STATUS
			let date = new Date();
			let currDate = `${date.getFullYear()}-${getDateFormat(date.getMonth() + 1)}-${getDateFormat(
				date.getDate()
			)}`;

			let status = '';
			switch (res['status']) {
				case 'pending':
					switch (res['apply_date']) {
						case currDate:
							status = "<span class='badge badge-primary'>New</span>";
							break;

						default:
							status = "<span class='badge badge-warning'>Pending</span>";
							break;
					}
					break;
				case 'approved':
					status = "<span class='badge badge-success'>Approved</span>";
					break;
				case 'rejected':
					status = "<span class='badge badge-danger'>Rejected</span>";
					break;
			}

			$('#editLeaveStatus').html(`Edit Leave ${status}`);
		}
	});
});

/**==============================================================
 * 		SHOW REMAIN LEAVE ON ADD EMPLOYEE LEAVE MODAL
 * ==============================================================*/
$('#newAdminLeaveEmployee').on('change', function() {
	$('#newAdminLeaveRemain').val();

	let id = $(this).val();
	console.log(id);

	let data = new FormData();
	data.append('remainLeave', id);
	$.ajax({
		url: 'ajax/leave-admin.ajax.php',
		type: 'POST',
		data: data,
		contentType: false,
		processData: false,
		cache: false,
		dataType: 'json',
		success: function(res) {
			console.log(res);
			$('#newAdminLeaveRemain').val(res);
		}
	});
});

/**=======================================================
 *      APPROVED LEAVE 
 * =======================================================*/
$('.showLeaveTable').on('click', 'button.btnApprovedLeave', function() {
	let element = $(this);
	let id = $(this).attr('id');

	let data = new FormData();
	data.append('approvedLeave', id);
	$.ajax({
		url: 'ajax/leave-admin.ajax.php',
		type: 'POST',
		data: data,
		contentType: false,
		processData: false,
		cache: false,
		success: function(res) {
			if (res == 'ok') {
				let status = $(element).parent().parent().parent().children()[8];
				$(status).html(`<h5><span class='badge badge-success adminLeaveStatus'>Approved</span></h5>`);

				Toast.fire({
					icon: 'success',
					title: 'Leave Application Approved'
				});
			}
		}
	});

	refreshLeaveTable();
});

let leaveTimeoutId;
function refreshLeaveTable() {
	if (leaveTimeoutId) {
		clearTimeout(leaveTimeoutId);
	}
	leaveTimeoutId = setTimeout(() => {
		$('.showLeaveTable').DataTable().destroy();
		showLeaveDataTable();
	}, 3000);
}

/**=======================================================
 *      REJECTED LEAVE 
 * =======================================================*/
$('.showLeaveTable').on('click', 'button.btnRejectedLeave', function() {
	let element = $(this);
	let id = $(this).attr('id');

	let data = new FormData();
	data.append('rejectLeave', id);
	$.ajax({
		url: 'ajax/leave-admin.ajax.php',
		type: 'POST',
		data: data,
		contentType: false,
		processData: false,
		cache: false,
		success: function(res) {
			if (res == 'ok') {
				let status = $(element).parent().parent().parent().children()[8];
				$(status).html(`<h5><span class='badge badge-danger adminLeaveStatus'>Rejected</span></h5>`);

				Toast.fire({
					icon: 'error',
					title: 'Leave Application Rejected'
				});
			}
		}
	});

	refreshLeaveTable();
});

/**=======================================================
 *      DELETE LEAVE 
 * =======================================================*/
$('.employeeLeaveTable, .showLeaveTable').on('click', 'button.btnDeleteLeave', function() {
	let id = $(this).attr('id');
	console.log(id);

	Swal.fire({
		title: 'Are you sure?',
		text: 'If You delete, Your Remaining Leave will not Change!',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((res) => {
		if (res.value) {
			window.location = `index.php?root=apply-leave&deleteLeave=${id}`;
		}
	});
});
