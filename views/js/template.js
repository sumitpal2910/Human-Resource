/*===============================================
    CUSTOM FILE INPUT
================================================= */
$(document).ready(function() {
	bsCustomFileInput.init();
});

/*=====================================
    DATA TABLE
======================================= */
$('.tables').DataTable({
	responsive: true
});

/*=====================================
    INPUT MASK
======================================= */
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { placeholder: 'dd/mm/yyyy' });
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { placeholder: 'mm/dd/yyyy' });
//Money Euro
$('[data-mask]').inputmask();

/*=======================================
    SELECT 2
========================================= */
$('.select2').select2();
