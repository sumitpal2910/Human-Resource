/*=============================================
    ADD NEW DESIGNATON INPUT
=============================================== */
$('.btnAddDesignation').click(function() {
	$('.editDesignationDiv').children('.alert').remove();
	let counter = Number($('.designations').last().attr('counter')) + 1;
	$('.designationDiv, .editDesignationDiv').append(`<div class="form-group">
                             <input type="text"  class="form-control designations" counter="${counter}"  placeholder="Designation #${counter}">
                         </div>`);
});

/*===========================================
    CONVERT ALL DESIGNATION INTO A JSON DATA
=============================================*/
$('#createDepartment, #editDepartment').click(convertToJson);

/*===================================================
	SHOW DESIGNATION ON CLICK EDIT BUTTON
===================================================== */
$('.btnEditDept').click(function() {
	$('.editDesignationDiv').children().remove();
	let id = $(this).attr('deptId');

	let data = new FormData();
	data.append('departmentId', id);

	$.ajax({
		url: 'ajax/department.ajax.php',
		method: 'POST',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function(res) {
			$('#editDepartmentName').val(res['name']);
			$('#editDepartmentId').val(res['id']);
			if (res['designation']) {
				let designation = JSON.parse(res['designation']);

				for (let i = 0; i < designation.length; i++) {
					const element = designation[i];
					let desgId = element['id'];
					let desgName = element['name'];
					$('.editDesignationDiv').append(`
					<div class="form-group">
					<input type="text"  class="form-control designations" counter="${desgId}" value="${desgName}">
					</div>`);
				}
			} else {
				$('.editDesignationDiv').append(`
					<div class="alert alert-warning" role="alert">
						No Designation. CLick button to add
					</div>
					<div class="form-group">
                        <input type="text" name="" class="form-control designations" counter="1" id="" placeholder="Designation #1">
					</div>`);
			}
		}
	});
});

/*===========================================
    CONVERT ALL DESIGNATION INTO A JSON DATA
=============================================*/
function convertToJson() {
	let designation = [];
	let data = $('.designations');
	for (let i = 0; i < data.length; i++) {
		const element = data[i].value;
		const id = $(data[i]).attr('counter');
		if (element) {
			designation.push({
				id: id,
				name: element
			});
		}
	}
	console.log(designation);
	$('.allDesignations').val(JSON.stringify(designation));
}

/*===============================================
	DELETE DEPARTMENT
================================================= */
$('.btnDeleteDept').click(function() {
	let id = $(this).attr('deptId');
	let name = $(this).attr('deptName');

	Swal.fire({
		title: 'Are you sure?',
		html: `You want to Delete <strong> ${name}</strong> Department<br> All Employees Designations Will be Delete `,
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((res) => {
		if (res.value) {
			window.location = `index.php?root=departments&deleteDepartment=${id}`;
		}
	});
});
