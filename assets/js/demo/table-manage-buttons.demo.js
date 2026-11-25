/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 5
Version: 5.2.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin/
*/

var handleDataTableButtons = function() {
	"use strict";
    var dynamicTitle = $('#heading_title').text();
	if ($('#data-table-buttons').length !== 0) {
		$('#data-table-buttons').DataTable({
			dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
			buttons: [
				{ extend: 'copy',footer: true, className: 'btn-sm', title: 'Somayya Institute of Technology, Chandrapur :- '+dynamicTitle },
				{ extend: 'csv',footer: true, className: 'btn-sm', title: 'Somayya Institute of Technology, Chandrapur :- '+dynamicTitle },
				{ extend: 'excel',footer: true, className: 'btn-sm', title: 'Somayya Institute of Technology, Chandrapur :- '+dynamicTitle },
				{ extend: 'pdf',footer: true, className: 'btn-sm', title: 'Somayya Institute of Technology, Chandrapur :- '+dynamicTitle },
				{ extend: 'print',footer: true, className: 'btn-sm', title: 'Somayya Institute of Technology, Chandrapur :- '+dynamicTitle }
			],
// 			responsive: true,
            responsive: false,
            scrollX: true,
            autoWidth: false,  
            scrollCollapse: true
		});
	}
};

var TableManageButtons = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDataTableButtons();
		}
	};
}();

$(document).ready(function() {
	TableManageButtons.init();
});