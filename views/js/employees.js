/*===========================================================
		SHOW EMPLOYEE DATA IN DATATABLE
==============================================================*/
// $.ajax({
// 	url: 'ajax/employee-datatable.ajax.php',
// 	success: function(res) {
// 		console.log(res);
// 	}
// });
$('.employeesTable').dataTable({
	responsive: true,
	ajax: 'ajax/employee-datatable.ajax.php',
	processing: true,
	deferRender: true,
	retrieve: true
});

/*==================================
     IMAGE PREVIEW
==================================== */
$('.userImage').change(function() {
	let image = this.files[0];
	console.log(image);

	if (image['type'] !== 'image/jpeg' && image['type'] !== 'image/png') {
		$('.userImage').val('');
		Swal.fire({
			icon: 'error',
			title: 'Invalid Image Type',
			text: 'Image Type Should be jpeg or png',
			confirmButtonText: 'Close'
		});
	} else if (image['size'] > 2 * 1024 * 1024) {
		$('.userImage').val('');
		let imgSize = Number(image['size']) / 1024 / 1024;
		imgSize = imgSize.toFixed(2);

		Swal.fire({
			icon: 'error',
			title: 'Image Size Should be Less then 2 MB',
			text: `Your Image Size is ${imgSize} MB`,
			confirmButtonText: 'Close'
		});
	} else {
		let render = new FileReader();
		render.readAsDataURL(image);
		$(render).on('load', function() {
			$('.preview').attr('src', render.result);
		});
	}
});

/*================================================
EDIT EMPLOYEE	
================================================= */
$('.employeesTable').on('click', 'button.btnEditEmployee', function() {
	let id = $(this).attr('employeeId');
	window.location = `index.php?root=edit-employee&employeeId=${id}`;
	showDepartment();
});

/*=============================================
	SHOW DESIGNATION ACCORDING DEPARTMENT
=============================================== */
$('.department').change(showDepartment);

function showDepartment() {
	$('.deptDesignation').children().remove();
	$('.deptDesignation').html(`<option value="" disabled selected>Select Designation</option>`);
	let id = $('.department').val();

	let data = new FormData();
	data.append('departmentId', id);

	$.ajax({
		url: 'ajax/department.ajax.php',
		method: 'POST',
		data: data,
		processData: false,
		contentType: false,
		cache: false,
		dataType: 'json',
		success: function(res) {
			// console.log(res);
			let designations = JSON.parse(res['designation']);
			designations.forEach((element) => {
				$('.deptDesignation').append(`<option value="${element.id}"> ${element.name} </option>`);
			});
		}
	});
}

// showDepartment();

/*======================================================
	CHANGE EXIT DATE ON STATUS
======================================================== */
$('#editEmpStatus').change(function() {
	let status = $(this).val();

	if (status == 1) {
		$('#editEmpExitDate').val('');
	}
});

/*===============================================
	DELETE EMPLOYEE
================================================= */
$('.employeesTable').on('click', 'button.btnDeleteEmployee', function() {
	let id = $(this).attr('employeeId');

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
			window.location = `index.php?root=employees&employeeId=${id}`;
		}
	});
});
