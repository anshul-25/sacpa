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


$q = "Select Name,sum(total), sum(conducted) from placements where Conducted > 0 group by Name";
$res = $conn->query($q);

$i=0;
while($row = $res->fetch_assoc())
{
	$a[$i][0] = $row["Name"];
	$a[$i][1] = $row["sum(conducted)"];
	$a[$i][2] = $row["sum(total)"];
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
						echo "['".$a[$k][0]."',".(int)$a[$k][1].",".(int)$a[$k][2]."],";
						$k=$k+1;
					}
				?>
				]);

			var options = {
				chart: {
					title: 'Placement Details',
					subtitle: 'Selected and Appeared Candidates for each Company',
				}
			};

			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		}
	</script>
</head>
<body>
	<br><br>
	<div class="p-3" id="columnchart_material" style="width: 800px; height: 500px;"></div>
</body>
</html>