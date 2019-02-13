<?php
require('db.php');



$regno = "select RegisterNo from student";
$res=$conn->query($regno);
$i=0;
while($row=$res->fetch_assoc())
{
	$semno_query="select distinct SemesterNo from subjects";
	$res1=$conn->query($semno_query);

	while($row1=$res1->fetch_assoc()) 
	{
		$total = 0;
		$obtained = 0;
		$subject_id_query = "select s.Max_Hours, sm.Hours_Attended from sub_marks sm, subjects s where Student_id=".$row["RegisterNo"]." AND sm.Subject_id=s.idSubjects AND s.SemesterNo=".$row1["SemesterNo"];
		$res2=$conn->query($subject_id_query);
		
		while($row2=$res2->fetch_assoc())
		{
			$total=$total + $row2["Max_Hours"];
			$obtained = $obtained + $row2["Hours_Attended"];
			
		}
		if($total != 0)
		{
			$percentage = ($obtained/$total) * 100;
			$a[$i]=$percentage;
			#echo $percentage."<br>";
			$i=$i+1;
		}
	}//while
	

}//while

?>
<html>
<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Semester', 'Attendance'],
				<?php
				$n=0;
				while($n < $i)
				{
					if($a[$n] > 0)
					{
						echo "[\"Semester ".($n+1)."\",".(float)$a[$n]."],";
					}
					$n=$n+1;  
				}
				?>
				]);

			var options = {
				title: 'Attendance Track - Course',
				//curveType: 'function',
				legend: { position: 'bottom' }
			};

			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

			chart.draw(data, options);
		}
	</script>
</head>
<body>
	<div id="curve_chart" style="width: 900px; height: 500px"></div>
</body>
</html>