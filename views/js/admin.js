/**===============================================
 *  EDIT ADMIN
 ==============================================*/
$('.btnEditAdmin').click(function() {
	let id = $(this).attr('id');

	window.location = `index.php?root=edit-admin&adminId=${id}`;
});


