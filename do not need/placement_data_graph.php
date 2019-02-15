<?php

require("db.php");
$q = "Select count(p.Studentid), c.CompanyName from placements p, company c where p.companyid = c.idCompany group by p.companyid";
$res=$conn->query($q);

if($res->num_rows > 0)
{
	$i=0;
	while($row = $res->fetch_assoc())
	{
		$a[$i][0] = $row["CompanyName"];
		$a[$i][1] = $row["count(p.Studentid)"];

		$q1="Select count(p.Studentid) from placements p, company c where p.companyid = c.idCompany and p.rounds_qualified=c.No_of_rounds_conducted and c.CompanyName =\"".$a[$i][0]."\"";
		$result = $conn->query($q1);
		$row2=$result->fetch_assoc();

		$a[$i][2]=$row2["count(p.Studentid)"];
		$i = $i+1;
	}
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