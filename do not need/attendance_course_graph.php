<?php
require("db.php");
$j=0;							
$regno = "select RegisterNo, CONCAT(FirstName, ' ', LastName) AS Name from student";# where ProgrammeID=".$course;
$res=$conn->query($regno);

while($row=$res->fetch_assoc())
{
	$total_percentage[$j] = 0;
	$attendance_array[$j][0]=$row["RegisterNo"];
	$attendance_array[$j][1]=$row["Name"];
	$m=2;
	$semno_query="select distinct SemesterNo from subjects";
	$res1=$conn->query($semno_query);
	while($m<8)
	{
		$attendance_array[$j][$m] = 0;
		$m=$m+1;
	}
	$m=2;

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
			$total_percentage[$j]=$total_percentage[$j]+$percentage; 
			$attendance_array[$j][$m] = $percentage;
			$m = $m+1;		
		}
	}//while
	$temp = $m-2;
	if($temp != 0)
	{
		$attendance_average[$j] = ($total_percentage[$j]/$temp);	
	}
	else
	{
		$attendance_average[$j] = 0;
	}
	$j=$j+1;							
}//while
?>

<html>
<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['line']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = new google.visualization.DataTable();
			data.addColumn('number', 'Semester');
			<?php 
			$k=0;
			while($k<$j) : ?>
				data.addColumn('number',<?php echo $attendance_array[$k][0]; ?>);		
				<?php $k=$k+1; ?>
			<?php endwhile ?>
			data.addRows([
				[1,  <?php $k=0; while($k<$j){ echo (float)$attendance_array[$k][2].","; $k=$k+1; } ?>],
				[2,  <?php $k=0; while($k<$j){ echo (float)$attendance_array[$k][3].","; $k=$k+1; } ?>],
				[3,  <?php $k=0; while($k<$j){ echo (float)$attendance_array[$k][4].","; $k=$k+1; } ?>],
				[4,  <?php $k=0; while($k<$j){ echo (float)$attendance_array[$k][5].","; $k=$k+1; } ?>],
				[5,  <?php $k=0; while($k<$j){ echo (float)$attendance_array[$k][6].","; $k=$k+1; } ?>],
				[6,  <?php $k=0; while($k<$j){ echo (float)$attendance_array[$k][7].","; $k=$k+1; } ?>],
				]);

			var options = {
				chart: {
					title: 'Student Attendance Performance'
				},
				width: 900,
				height: 500
			};

			var chart = new google.charts.Line(document.getElementById('linechart_material'));
			chart.draw(data, options);
			//chart.draw(data, google.charts.Line.convertOptions(options));
		}

	</script>
</head>
<body>
	<div id="linechart_material" style="width: 900px; height: 500px"></div>
</body>
</html>