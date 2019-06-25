<?php 
session_start();
?>
<head>
    <?php 
	echo file_get_contents("header.html"); 
	?>
 </head>
<body>
<?php
//CASE1:  IF THE SESSION IS LOADED AND PROCESS IS RUNNING..
if ($_SESSION['loaded'] && file_exists( "/proc/".$_SESSION['pid'])) {

		print "<p align=\"CENTER\"> <b>  Your request to search is well received. <br/><br/> In most cases, the results will be available on the current page within five minutes. The current page will be automatically refreshed after every 5 seconds to see if there is any update on your result. </b></p> <br/>";
		$_SESSION['Time_now'] = microtime(true);
		$_SESSION['Timpe_since_query_submitted'] = $_SESSION['Time_now'] - $_SESSION['Time_start'];
		print "<p align=\"CENTER\"> <b>  Time passed since query received : ". $_SESSION['Timpe_since_query_submitted'] ." seconds </b></p> <br/>";
		echo("<meta http-equiv='refresh' content='5'>");
} 


//CASE3: IF THE SESSION IS NOT LOADED..EVERYTHING NEEDS TO BE SET FOR THE FIRST TIME..
if (!$_SESSION['loaded']){
		$_SESSION['loaded'] = true;
		$_SESSION['Time_start'] = microtime(true); 
		//Taking input
		$Sequence 				= htmlspecialchars($_POST['inputsequence']);
		$sessionid				= session_id();
		// The main search command to run
		$cmd = "bash Searchinmtbgenomes_seq '$Sequence' '$sessionid'";
		//The remaining processing
		$command =  $cmd . ' > /dev/null 2>&1 & echo $!; ';
		$_SESSION['pid'] = 	exec($command);
		//Printing
		print "<p align=\"CENTER\"> <b>  Your request to search is well received. <br/><br/> In most cases, the results will be available on the current page within five minutes. The current page will be automatically refreshed after every 5 seconds to see if there is any update on your result. </b></p> <br/>";
		echo("<meta http-equiv='refresh' content='5'>");
}

//CASE2: IF THE SESSION IS LODADED BUT PROCESS IS COMPLETED..
if ($_SESSION['loaded'] && !file_exists( "/proc/".$_SESSION['pid'])) {
				
		$_SESSION['Time_end'] 		= microtime(true);
		$_SESSION['Execution_time'] = $_SESSION['Time_end'] - $_SESSION['Time_start'];
		$sessionid					= session_id();
		
		//Preparing data for summary
		$Current_number_of_genomes = shell_exec("grep -c -P -v '^#' Database/assembly_summary.txt");
		$date = date('Y-m-d');
		$Number_of_positive_genomes = (int)(shell_exec("grep -c -P -v '^#' tmp/'$sessionid'.annotated.txt"));
		$Number_of_negative_genomes = (int)($Current_number_of_genomes - $Number_of_positive_genomes);
			
?>
<!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            
			//DRAWING THE PIE CHART FOR PRESENCE/ABSENCE
			google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Order', 'Amount'],
                        ['Genomes positive', parseInt('<?php echo $Number_of_positive_genomes; ?>')],
                        ['Genomes negative', parseInt('<?php echo $Number_of_negative_genomes; ?>')]
                ]); 
			var options = {
					legend: {position: 'bottom'},
					chartArea: {width:'100%',height:'75%'},
					pieHole: 0.4,
					width: 250,
					height: 200,
                };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
					
				</script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Year of isolation for strains');
      data.addColumn('number', 'Count');
      data.addRows([
	  <?php echo shell_exec("bash Isolation_year.sh '$sessionid'");
	  ?>
      ]);

      var options = {
		legend: {position: 'none'},
		chartArea: {width:'100%',height:'100%'},
        width: 250,
        height: 200,
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
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Number of strains'],
		<?php echo shell_exec("bash Geolocation.sh '$sessionid'");
	  ?>
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Assembly accession');
        data.addColumn('string', 'Bioproject');
        data.addColumn('string', 'Biosample');
		data.addColumn('string', 'Assembly level');
		data.addColumn('string', 'Date of collection');
		data.addColumn('string', 'Place of isolation');
		data.addColumn('string', 'Disease');
		data.addColumn('string', 'Clinical specimen');
        data.addRows([
		<?php
		
		//Reads the Table
		$tab = "\t";
		$fp = fopen('tmp/'.$sessionid.'.annotated.txt', 'r');
		while ( !feof($fp) )
		{
			$line = fgets($fp, 2048);
			$line = trim($line); //Don't read last empty line
			if ($line != "") {
			$data_txt = str_getcsv($line, $tab);
			//Get First Line of Data over here
		
			$Assembly = $data_txt[0];
			$Bioproject = $data_txt[1];
			$Biosample = $data_txt[2];
			$level = $data_txt[3];
			$Date_of_collection = $data_txt[4];
			$Place_of_isolation = $data_txt[5];
			$Disease = $data_txt[6];
			$Clinical_specimen = $data_txt[7];
			print "['".$Assembly."','".$Bioproject."','".$Biosample."','".$level."','".$Date_of_collection."','".$Place_of_isolation."','".$Disease."','".$Clinical_specimen."'],";
			}
		//exit;
		}                              

		fclose($fp);
		
?>
 ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
<div class='Figures_container'>
 <div id="piechart" style="width: 250px; height: 200px" ></div> <br/>
  <div id="line_top_x" style="width: 250px; height: 200px" ></div><br/>
   <div id="regions_div" style="width: 250px; height: 200px"></div><br/>
   <?php		
		//Final remarks after chart
		echo '<p align=\"CENTER\"><a href="http://www.searchinmtbgenomes.com/tmp/'.$sessionid.'.annotated.txt">Download the list of positive genomes</a><br/>';
		echo "Search completed in ".  $_SESSION['Execution_time'] . " seconds</b>.</p>";
?>
</div>
<div class='Table_container'>
<div id="table_div"></div>
</div>
 <div id="clear"></div><br/>
<?php		
		
		//Close the session
		session_unset();
		session_destroy();
		session_write_close();
		session_regenerate_id(true);
		$_POST = array();
} 

?>
</body>
<?php echo file_get_contents("footer.html"); ?>
</body>