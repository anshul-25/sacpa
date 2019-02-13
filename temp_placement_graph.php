<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


$q1 = "Select Name,sum(total), sum(conducted),count(Sl_No) from placements where Conducted > 0 group by Name";
$res1 = $conn->query($q1);

$q2 = "Select count(Sl_No) from placements where Total = Conducted group by Name";
$res2 = $conn->query($q2);

$i=0;
while($row1 = $res1->fetch_assoc())
{
	$a[$i][0] = $row1["Name"];
	$a[$i][1] = $row1["sum(conducted)"];
	$a[$i][2] = $row1["sum(total)"];
	$a[$i][3] = $row1["count(Sl_No)"];
	$i=$i+1;
}

$i=0;
while($row2 = $res2->fetch_assoc())
{
	$a[$i][4] = $row2["count(Sl_No)"];
	$i=$i+1;
}


?>
<!DOCTYPE html>

<html>
<head>
	<title>Placement Graph</title>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['bar']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Company', 'Appeared', 'Selected'],
				<?php
				$k=0;
				while($k<$i)
				{
					echo "['".$a[$k][0]."',".(int)$a[$k][3].",".(int)$a[$k][4]."],";
					$k=$k+1;
				}
				?>
				]);

			var options = {
				chart: {
					title: 'Placement Details',
					subtitle: 'Selected and Appeared Candidates for each Company'
				}
			};

			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		}
	</script>

	<script type="text/javascript">
		google.charts.load('current', {'packages':['bar']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Company', 'Selected', 'Participated','Round Qualified - Percentage'],
				<?php
				$k=0;
				while($k<$i)
				{
					$temp = ($a[$k][1]/$a[$k][2])*100;
					
					echo "['".$a[$k][0]."',".(int)$a[$k][4].",".(int)$a[$k][3].",".(float)$temp."],";
					$k=$k+1;
				}
				?>
				]);

			var options = {
				chart: {
					title: 'Placement Information',
					subtitle: 'Student Performance - Percentage',
				}
			};

			var chart = new google.charts.Bar(document.getElementById('columnchart_material2'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		}
	</script>   
</head>
<body>
	<br><br>
	<div class="p-3" id="columnchart_material" style="width: 800px; height: 500px;"></div>
	<br><br>
	<div id="columnchart_material2" style="width: 800px; height: 500px;"></div>
</body>
</html>