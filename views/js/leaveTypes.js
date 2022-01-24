/*============================================
 *  SHOW DATA IN DATATABLE
============================================== */
// $.ajax({
// 	url: 'ajax/leavetype-datatable.ajax.php',
// 	success: function(res) {
// 		console.log(res);
// 	}
// });

$('.leaveTypeTable').DataTable({
	responsive: true,
	ajax: 'ajax/leavetype-datatable.ajax.php',
	processing: true,
	deferRender: true,
	retrieve: true
});

/*============================================
 *  EDIT LEAVE TYPE- SHOW DATA IN EDIT MODAL
============================================== */
$('.leaveTypeTable').on('click', 'button.btnEditLeaveType', function() {
	let id = $(this).attr('id');

	let data = new FormData();
	data.append('leaveTypeId', id);

	$.ajax({
		url: 'ajax/leavetypes.ajax.php',
		method: 'POST',
		data: data,
		cache: false,
		processData: false,
		contentType: false,
		dataType: 'json',
		success: function(res) {
			$('#editLeaveType').val(res['type']);
			$('#editLeaveTypeId').val(res['id']);
			$('#editLeaveTypeDays').val(res['number_of_day']);
		}
	});
});

/*============================================
 *  DELETE LEAVE TYPE
============================================== */
$('.leaveTypeTable').on('click', 'button.btnDeleteLeaveType', function() {
	let id = $(this).attr('id');

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((res) => {
		if (res.value) {
			window.location = `index.php?root=leave-types&deleteLeaveType=${id}`;
		}
	});
});
