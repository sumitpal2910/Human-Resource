/**===============================================4
 *      SHOW EXPENSES IN TABLE
 * ===============================================*/
// $.ajax({
// 	url: 'ajax/expenses-datatable.ajax.php',
// 	success: function(res) {
// 		console.log(res);
// 	}
// });
$('.expensesTable').dataTable({
	responsive: true,
	ajax: 'ajax/expenses-datatable.ajax.php',
	processing: true,
	deferRender: true,
	retrieve: true
});

/**================================================
 * 		EDIT EXPENSE
 * ================================================*/
$('.expensesTable').on('click', 'button.btnEditExpense', function() {
	const id = $(this).attr('expenseId');

	window.location = `index.php?root=edit-expense&expenseId=${id}`;
});

/**================================================
 * 		DELETE EXPENSE
 * ================================================*/
$('.expensesTable').on('click', 'button.btnDeleteExpense', function() {
	let id = $(this).attr('expenseId');
	let bill = $(this).attr('bill');

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
			window.location = `index.php?root=expenses&deleteExpense=${id}&expBill=${bill}`;
		}
	});
});
