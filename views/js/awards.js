/**===========================================
 * 		SHOW AWARDS IN TABLE
 * ===========================================*/
// $.ajax({
// 	url: 'ajax/awards-datatable.ajax.php',
// 	success: function(res) {
// 		console.log(res);
// 	}
// });

$('.awardsTable').dataTable({
	responsive: true,
	ajax: 'ajax/awards-datatable.ajax.php',
	processing: true,
	deferRender: true,
	retrieve: true,
	ordering: false
});

/**================================================
 *      AUTO ADD YEAR
 * ===============================================*/
$('.awardYear').each(function() {
	const editYear = $('#awardEditYear').val();
	let year = new Date().getFullYear();
	console.log(year);
	let current = year;
	year -= 3;
	for (let i = 0; i < 6; i++) {
		if (year + i == current) {
			$(this).append(`<option value="${year + i}" selected>${year + i}</option>`);
		} else {
			$(this).append(`<option value="${year + i}">${year + i}</option>`);
		}
	}
	if (editYear) {
		$(this).prepend(`<option value="${editYear}" selected>${editYear}</option>`);
	}
});

/**================================================
 * 		EDIT AWARD
 * ================================================*/
$('.awardsTable').on('click', 'button.btnEditAward', function() {
	const id = $(this).attr('awardId');
	const empId = $(this).attr('employeeId');

	window.location = `index.php?root=edit-award&awardId=${id}&employeeId=${empId}`;
});

/**================================================
 * 		DELETE AWARD
 * ================================================*/
$('.awardsTable').on('click', 'button.btnDeleteAward', function() {
	let id = $(this).attr('awardId');

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.value) {
			window.location = `index.php?root=awards&deleteAward=${id}`;
		}
	});
});
