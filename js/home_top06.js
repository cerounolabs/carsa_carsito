$(document).ready(function() {
	var codigo		= document.getElementById('tableCodigoTop06').className;
	var urlDominio	= 'https://api.carsa.com.py/carsito_api/public/v1/100/top06/' + codigo;
	
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
			{ targets			: [0],	visible : false,searchable : false,	orderData : [0, 0] },
			{ targets			: [1],	visible : true,	searchable : true,	orderData : [1, 0] },
			{ targets			: [2],	visible : true,	searchable : true,	orderData : [2, 0] },
			{ targets			: [3],	visible : true,	searchable : true,	orderData : [3, 0] },
			{ targets			: [4],	visible : false,searchable : false,	orderData : [4, 0] },
			{ targets			: [5],	visible : false,searchable : false,	orderData : [5, 0] },
			{ targets			: [6],	visible : false,searchable : false,	orderData : [6, 0] },
			{ targets			: [7],	visible : true,	searchable : true,	orderData : [7, 0] },
			{ targets			: [8],	visible : false,searchable : false,	orderData : [8, 0] },
			{ targets			: [9],	visible : true,	searchable : true,	orderData : [9, 0] },
			{ targets			: [10],	visible : false,searchable : false,	orderData : [10, 0] },
			{ targets			: [11],	visible : true,	searchable : true,	orderData : [11, 0] }
		],
		columns		: [
			{ data				: 'persona_cuenta', name : 'persona_cuenta'},
			{ data				: 'comprobante_tipo', name : 'comprobante_tipo'},
			{ data				: 'operacion_numero', name : 'operacion_numero', render: $.fn.dataTable.render.number('.', ',', 0, '')},
			{ data				: 'operacion_cuota', name : 'operacion_cuota'},
			{ data				: 'banca_nombre', name : 'banca_nombre'},
			{ data				: 'tigo_nombre', name : 'tigo_nombre'},
			{ data				: 'comprobante_numero', name : 'comprobante_numero', render: $.fn.dataTable.render.number('.', ',', 0, '')},
			{ data				: 'movimiento_fecha_original', name : 'movimiento_fecha_original'},
			{ data				: 'movimiento_hora_original', name : 'movimiento_hora_original'},
			{ data				: 'comprobante_importe_numero', name : 'comprobante_importe_numero', render: $.fn.dataTable.render.number('.', ',', 0, '')},
			{ data				: 'reversion_nombre', name : 'reversion_nombre'},
			{ render			: function (data, type, full, meta) {return '<a href="../report/comprobante.php?id1=' + full.comprobante_codigo + '" role="button" class="btn btn-success" target="_blank"><i class="ti-printer"></i>&nbsp;</a>';}},
		]
	});
});