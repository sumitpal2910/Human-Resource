/**===============================================
 *      ADD HOLIDAY INPUT 
 * ===============================================*/
$('.btnAddHoliday').click(function() {
	$('.addHolidayDiv').append(`
                    <div class="form-group row">
                        <div class="col-6">
                            <input type="date" name="newHolidayDate[]" id="" class="form-control newHolidayDate" placeholder="Date">
                        </div>
                        <div class="col-6">
                            <input type="text" name="newHolidayOccasion[]" id="" class="form-control" placeholder="Occasion">
                        </div>
                    </div>`);
});

/**===============================================
 *      SHOW HOLIDAY IN TABLE
 * ===============================================*/
$('.holidayMonth').click(function() {
	$('#holidayList').children().remove();
	$('.holidaysTable').DataTable().destroy();

	let month = $(this).attr('month');

	// HOLIDAY LIST TABLE
	let months = [
		'January',
		'Febuary',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	];
	let mnt = months[Number(month - 1)];
	$('.holidayDiv').attr('id', mnt);
	$('.holidayDiv').attr('aria-labelledby', mnt + '-tab');
	$('.holidayTitle span').text(mnt);

	let data = new FormData();
	data.append('holidayMonth', month);

	$('.holidaysTable').DataTable({
		paging: false,
		searching: false,
		responsive: true,
		info: false,
		processing: true,
		serverSide: true,
		deferRender: true,
		retrieve: true,
		ajax: {
			url: 'ajax/holidays.ajax.php',
			type: 'POST',
			data: {
				holidayMonth: month
			}
		}
	});

	// $('.holidaysTable').DataTable();

	// $.ajax({
	// 	url: 'ajax/holidays.ajax.php',
	// 	type: 'POST',
	// 	data: data,
	// 	cache: false,
	// 	processData: false,
	// 	contentType: false,
	// 	dataType: 'json',
	// 	success: function(result) {
	// 		if (result) {
	// 			result.forEach((element, index) => {
	// 				let hDate = element['holiday_date'].slice(-2);
	// 				let holidayId = element['id'];
	// 				$('#holidayList').append(`<tr>
	// 						<td>${index + 1}</td>
	// 						<td>${hDate} ${element['month']} ${element['year']}</td>
	// 						<td>${element['occasion']}</td>
	// 						<td>${element['day']}</td>
	// 						<td><button type="button" class="btn btn-danger btn-sm btnDeleteHoliday" id='${holidayId}'><i class="fas fa-trash"></i> Delete</button></td>
	// 					</tr>`);
	// 			});
	// 		}
	// 	}
	// });
});

// SHOW HOLIDAY ON PAGE LOAD
document.querySelector('.holidayMonth.active').click();

/**===============================================
 *      DELETE HOLIDAY 
 * ===============================================*/
$('.holidaysTable').on('click', 'button.btnDeleteHoliday', function() {
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
			window.location = `index.php?root=holidays&deleteHoliday=${id}`;
		}
	});
});
