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
		$subject_id_query = "select sm.Subject_id, s.SemesterNo, s.CIA1_Max, s.CIA2_Max, s.CIA3_Max, s.EndSem_Max, s.Attendance_Max, sm.CIA1_Obt, sm.CIA2_Obt, sm.CIA3_Obt, sm.EndSem_Obt, sm.Atten_Obt from sub_marks sm, subjects s where Student_id=".$row["RegisterNo"]." AND sm.Subject_id=s.idSubjects AND s.SemesterNo=".$row1["SemesterNo"];
		$res2=$conn->query($subject_id_query);
		
		while($row2=$res2->fetch_assoc())
		{
			$total=$total + $row2["CIA1_Max"] + $row2["CIA2_Max"] + $row2["CIA3_Max"] + $row2["EndSem_Max"] + $row2["Attendance_Max"];
			$obtained = $obtained + $row2["CIA1_Obt"] + $row2["CIA2_Obt"] + $row2["CIA3_Obt"] + $row2["EndSem_Obt"] + $row2["Atten_Obt"];
			
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
				['Semester', 'Marks'],
				<?php
				$n=0;
				while($n < $i)
				{
					if($a[$n] > 0)
					{
						echo "[".($n+1).",".(float)$a[$n]."],";
					}
					$n=$n+1;  
				}
				?>
				]);

			var options = {
				title: 'Academic Performance - Course',
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