$(document).ready(function() {
	'use strict';
	var cuotas01 = 0;
	var cuotas02 = 0;
	var cuotas03 = 0;

	if($("#predictionTop030").length != 0) {
		cuotas01 = document.getElementById('predictionTop030').className;
	}

	if($("#predictionTop031").length != 0) {
		cuotas02 = document.getElementById('predictionTop031').className;
	}

	if($("#predictionTop032").length != 0) {
		cuotas03 = document.getElementById('predictionTop032').className;
	}

	var chart01 = c3.generate({
		bindto: '#predictionTop030',
		data: {
			columns: [['Pagadas', cuotas01]],
		  	type: 'gauge',
		  	onclick: function(d, i) {
				console.log('onclick', d, i);
		  	},
		  	onmouseover: function(d, i) {
				console.log('onmouseover', d, i);
		  	},
		  	onmouseout: function(d, i) {
				console.log('onmouseout', d, i);
		  	}
		},
	
		color: {
			pattern: ['#20aee3'],
		  	threshold: { values: [100] }
		},
		
		gauge: {
			width: 22
		},
		
		size: {
			height: 85,
			width: 200
		}
	});

	var chart02 = c3.generate({
		bindto: '#predictionTop031',
		data: {
			columns: [['Pagadas', cuotas02]],
		  	type: 'gauge',
		  	onclick: function(d, i) {
				console.log('onclick', d, i);
		  	},
		  	onmouseover: function(d, i) {
				console.log('onmouseover', d, i);
		  	},
		  	onmouseout: function(d, i) {
				console.log('onmouseout', d, i);
		  	}
		},
	
		color: {
			pattern: ['#24d2b5'],
			threshold: { values: [100] }
		},

		gauge: {
			width: 22
		},

		size: {
			height: 85,
		  	width: 200
		}
	});

	var chart03 = c3.generate({
		bindto: '#predictionTop032',
		data: {
			columns: [['Pagadas', cuotas03]],
		  	type: 'gauge',
		  	onclick: function(d, i) {
				console.log('onclick', d, i);
		  	},
		  	onmouseover: function(d, i) {
				console.log('onmouseover', d, i);
		  	},
		  	onmouseout: function(d, i) {
				console.log('onmouseout', d, i);
		 	}
		},
	
		color: {
			pattern: ['#ef6e6e'],
		  	threshold: { values: [100] }
		},

		gauge: {
			width: 22
		},
		
		size: {
			height: 85,
			width: 200
		}
	});
});