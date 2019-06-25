<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Isolation year');
      data.addColumn('number', 'Count');
      data.addRows([
        ["1",  37.8],
        ["2",  30.9],
        ["3",  25.4],
      ]);

      var options = {
        title: {position: 'none'},
		legend: {position: 'none'},
		chartArea: {width:'100%',height:'100%'},
        width: 500,
        height: 500,
        axes: {
          x: {
            0: {side: 'botttom'},
          }
        },

      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));
      chart.draw(data, google.charts.Line.convertOptions(options));
    }
	
	
  </script>
  <script type="text/javascript">
  	google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Order', 'Amount'],
                        ['Present', parseInt(6)],
                        ['Absent', parseInt(4)]
                ]); 
			var options = {
                    title: {position: 'none'},
					legend: {position: 'bottom'},
					chartArea: {width:'100%',height:'75%'},
					pieHole: 0.4,
					width: 150,
					height: 100,
                };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
  </script>
   <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          ['Germany', 10],
          ['United States', 300],
          ['Brazil', 15],
          ['Canada', 20],
          ['France', 250],
          ['XYZ', 1000]
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
</head>
<body>
 <!-- <div id="piechart" style="width: 10%;float:right;padding: 2em;"></div>
  <div id="line_top_x" style="width: 10%;float:left;padding: 2em;"></div> -->
   <div id="regions_div" style="width: 900px; height: 500px;"></div>
 </body>
</html>