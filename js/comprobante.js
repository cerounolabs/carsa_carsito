$(document).ready(function() {
	var codigo		= document.getElementById('tableCodigo').className;
	var estadoOpe 	= 1;
	var fecDesde 	= '';
	var fecHasta 	= '';

	if($("#estadoOpe").length != 0) {
		estadoOpe= document.getElementById('estadoOpe').value;
	}

	if($("#fechaDesde").length != 0) {
		fecDesde = document.getElementById('fechaDesde').value;
	}

	if($("#fechaHasta").length != 0) {
		fecHasta = document.getElementById('fechaHasta').value;
	}
	
	var urlDominio	= 'http://api.carsa.com.py/carsito_api/public/v1/200/'+codigo+'/'+fecDesde+'/'+fecHasta+'/'+estadoOpe;
	
	$('#tableLoad').DataTable({
		processing	: true,
		destroy		: true,
		searching	: true,
		paging		: true,
		lengthChange: true,
		info		: true,
		language	: {
            lengthMenu: "Mostrar _MENU_ registros por pagina",
            zeroRecords: "Nothing found - sorry",
            info: "Mostrando pagina _PAGE_ de _PAGES_",
            infoEmpty: "No hay registros disponibles.",
			infoFiltered: "(Filtrado de _MAX_ registros totales)",
			sZeroRecords: "No se encontraron resultados",
			sSearch: "buscar",
			oPaginate: {
				sFirst:    "Primero",
				sLast:     "Último",
				sNext:     "Siguiente",
				sPrevious: "Anterior"
			},
        },
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
			{ targets			: [4], visible : true, 	searchable : true,  orderData : [4, 0] },
			{ targets			: [5], visible : true,  searchable : true,  orderData : [5, 0] },
			{ targets			: [6], visible : true, 	searchable : true,  orderData : [6, 0] },
			{ targets			: [7], visible : true,  searchable : true,  orderData : [7, 0] },
			{ targets			: [8], visible : true,  searchable : true,  orderData : [8, 0] },
			{ targets			: [9], visible : true,  searchable : true,  orderData : [9, 0] }
		],
		columns		: [
			{ data				: 'caja_cuenta', name : 'caja_cuenta'},
			{ data				: 'caja_operacion', name : 'caja_operacion', render: $.fn.dataTable.render.number('.', ',', 0, '')},
			{ data				: 'caja_banca', name : 'caja_banca'},
			{ data				: 'caja_movimiento', name : 'caja_movimiento'},
			{ data				: 'caja_cuota', name : 'caja_cuota'},
			{ data				: 'caja_numero_movimiento', name : 'caja_numero_movimiento', render: $.fn.dataTable.render.number('.', ',', 0, '')},
			{ data				: 'caja_fecha', name : 'caja_fecha'},
			{ data				: 'caja_hora', name : 'caja_hora'},
			{ data				: 'caja_monto', name : 'caja_monto', render: $.fn.dataTable.render.number('.', ',', 0, '')},
			{ render			: function (data, type, full, meta) {return '<a href="../report/comprobante.php?id1=' + full.comprobante_codigo + '" role="button" class="btn btn-success"><i class="ti-printer"></i>&nbsp;</a>';}},
		]
	});
});