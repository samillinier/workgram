
$(document).ready(function() {

      loadSampleChartDemo2();
});


function loadSampleChartDemo2(){

var seriesData_5 = [ [], [],[]];

	var random = new Rickshaw.Fixtures.RandomData(50);

	for (var i = 0; i < 50; i++) {
		random.addData(seriesData_5);
	}

	rick = new Rickshaw.Graph( {
		element: document.querySelector('#profile_skill_chart'),
		height: 200,
		renderer: 'area',
		series: [
			{
				data: seriesData_5[0],
				color: '#736086',
				name:'Downloads'
			},{
				data: seriesData_5[1],
				color: '#f8a4a3',
				name:'Uploads'
			},
			{
				data: seriesData_5[2],
				color: '#eceff1',
				name:'All'
			}
		]
	} );
	
	var hoverDetail = new Rickshaw.Graph.HoverDetail( {
		graph: rick
	});
	
	random.addData(seriesData_5);
	rick.update();
	
	var ticksTreatment = 'glow';
	
	var xAxis = new Rickshaw.Graph.Axis.Time( {
	graph: rick,
	ticksTreatment: ticksTreatment,
	timeFixture: new Rickshaw.Fixtures.Time.Local()
	});

	xAxis.render();

	var yAxis = new Rickshaw.Graph.Axis.Y( {
		graph: rick,
		tickFormat: Rickshaw.Fixtures.Number.formatKMBT,
		ticksTreatment: ticksTreatment
	});
	
	var legend = new Rickshaw.Graph.Legend( {
	graph: rick,
	element: document.getElementById('legend_2')
	});	
	
	yAxis.render();
	
	var shelving = new Rickshaw.Graph.Behavior.Series.Toggle( {
		graph: rick,
		legend: legend
	} );

	var order = new Rickshaw.Graph.Behavior.Series.Order( {
		graph: rick,
		legend: legend
	} );

	var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight( {
		graph: rick,
		legend: legend
	} );

	//Sparkline Charts
	$("#mini-chart-orders_2").sparkline([1,4,6,2,0,5,6,4,6], {
		type: 'bar',
		height: '30px',
		barWidth: 6,
		barSpacing: 2,
		barColor: '#f35958',
		negBarColor: '#f35958'
	});
	//Sparkline Charts
	$("#mini-chart-other_2").sparkline([1,4,6,2,0,5,6,4], {
		type: 'bar',
		height: '30px',
		barWidth: 6,
		barSpacing: 2,
		barColor: '#0aa699',
		negBarColor: '#0aa699'
	});		
}