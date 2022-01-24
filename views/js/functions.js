/**=======================================================
 *      CALCULATE NUMBER OF LEAVE DAYS
 * =======================================================*/
function get2DatesDay(startDate, endDate) {
	startDate = new Date(startDate);
	endDate = new Date(endDate);

	let diff = (endDate - startDate) / (1000 * 60 * 60 * 24) + 1;
	return diff;
}

/**=======================================================
 *      2 DIGIT DATE
 * =======================================================*/
function getDateFormat(date) {
	return date < 10 ? '0' + date : '' + date;
}

/**=======================================================
 *      TOAST SWEET ALERT
 * =======================================================*/
const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000
});

/**=================================================
 * 		GET URL PARAM
 * ==================================================*/
function getUrlParam(url, searchParam) {
	let newUrl = new URL(url);
	let params = new URLSearchParams(newUrl.search);
	return params.get(searchParam);
}
