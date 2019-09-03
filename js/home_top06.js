$(document).ready(function() {
	var codigo		= document.getElementById('tableCodigoTop06').className;
	var urlDominio	= 'http://api.carsa.com.py/carsito_api/public/v1/100/top06/' + codigo;
	
	$('#tableLoadTop06').DataTable({
		processing	: true,
		destroy		: true,
		searching	: false,
		paging		: false,
		lengthChange: false,
		info		: false,
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
			{ targets			: [2], visible : false, searchable : false, orderData : [2, 0] },
			{ targets			: [3], visible : true,  searchable : true,  orderData : [3, 0] },
			{ targets			: [4], visible : false, searchable : false, orderData : [4, 0] },
			{ targets			: [5], visible : false, searchable : false, orderData : [5, 0] },
			{ targets			: [6], visible : true,  searchable : true,  orderData : [6, 0] },
			{ targets			: [7], visible : false, searchable : false, orderData : [7, 0] },
			{ targets			: [8], visible : true,  searchable : true,  orderData : [8, 0] },
			{ targets			: [9], visible : true,  searchable : true,  orderData : [9, 0] }
		],
		columns		: [
			{ data				: 'caja_cuenta', name : 'caja_cuenta'},
			{ data				: 'caja_operacion', name : 'caja_operacion', render: $.fn.dataTable.render.number('.', ',', 0, '')},
			{ data				: 'caja_banca', name : 'caja_banca'},
			{ data				: 'caja_movimiento', name : 'caja_movimiento'},
			{ data				: 'caja_cuota', name : 'caja_cuota'},
			{ data				: 'caja_numero_movimiento', name : 'caja_numero_movimiento'},
			{ data				: 'caja_fecha', name : 'caja_fecha'},
			{ data				: 'caja_hora', name : 'caja_hora'},
			{ data				: 'caja_monto', name : 'caja_monto', render: $.fn.dataTable.render.number('.', ',', 0, '')},
			{ render			: function (data, type, full, meta) {return '<a href="../report/comprobante.php?id1=' + full.caja_operacion + '&id2='+ full.caja_numero_movimiento +'" role="button" class="btn btn-success"><i class="ti-printer"></i>&nbsp;</a>';}},
		]
	});
});