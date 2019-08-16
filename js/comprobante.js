$(document).ready(function() {
	var codigo		= document.getElementById('tableCodigo').className;
	var urlDominio = 'http://www.carsa.com.py/carsito_api/public/api/v1/100/' + codigo;
	
	$('#tableLoad').DataTable({
		processing	: true,
		destroy		: true,
		ajax		: {
			type				: 'GET',
			cache				: false,
			crossDomain			: true,
			crossOrigin			: true,
			contentType			: 'application/json; charset=utf-8',
			dataType			: 'json',
			url				: urlDominio,
			dataSrc				: 'data'
		},
		columnDefs	: [
			{ targets			: [0], visible : false, searchable : false, orderData : [0, 0] },
			{ targets			: [1], visible : true,  searchable : true,  orderData : [1, 0] },
			{ targets			: [2], visible : true,  searchable : true,  orderData : [2, 0] },
			{ targets			: [3], visible : true,  searchable : true,  orderData : [3, 0] },
			{ targets			: [4], visible : true,  searchable : true,  orderData : [4, 0] },
			{ targets			: [5], visible : true,  searchable : true,  orderData : [5, 0] },
			{ targets			: [6], visible : true,  searchable : true,  orderData : [6, 0] },
			{ targets			: [7], visible : true,  searchable : true,  orderData : [7, 0] }
		],
		columns		: [
			{ data				: 'comprobante_codigo', name : 'comprobante_codigo'},
			{ data				: 'operacion_numero', name : 'operacion_numero'},
			{ data				: 'operacion_fecha', name : 'operacion_fecha'},
			{ data				: 'comprobante_fecha', name : 'comprobante_fecha'},
			{ data				: 'comprobante_tipo', name : 'comprobante_tipo'},
			{ data				: 'comprobante_numero', name : 'comprobante_numero'},
			{ data				: 'comprobante_importe', name : 'comprobante_importe'},
			{ render			: function (data, type, full, meta) {return '<a href="../report/comprobante.php?id1=' + full.comprobante_codigo + '" role="button" class="btn btn-success"><i class="ti-printer"></i>&nbsp;</a>';}},
		]
	});
});