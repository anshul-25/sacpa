<?php
require("db.php");
$j=0;							
$regno = "select RegisterNo, CONCAT(FirstName, ' ', LastName) AS Name from student";
$res=$conn->query($regno);

while($row=$res->fetch_assoc())
{
	$total_percentage[$j]=0;
	$academic_array[$j][0]=$row["RegisterNo"];
	$academic_array[$j][1]=$row["Name"];
	$m=2;
	$semno_query="select distinct SemesterNo from subjects";
	$res1=$conn->query($semno_query);
	while($m<8)
	{
		$academic_array[$j][$m] = 0;
		$m=$m+1;
	}
	$m=2;
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
			$total_percentage[$j]=$total_percentage[$j]+$percentage; 
			$academic_array[$j][$m] = $percentage;
			$m = $m+1;
			
		}
	}//while
	$temp = $m-2;
	if($temp != 0)
	{
		$average_percentage[$j] = ($total_percentage[$j]/$temp);	
	}
	else
	{
		$average_percentage[$j] = 0;
	}
	$j=$j+1;							
}//while
#print_r($academic_array);


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
					data.addColumn('number',<?php echo $academic_array[$k][0]; ?>);		
					<?php $k=$k+1; ?>
		  <?php endwhile ?>
			data.addRows([
				[1,  <?php $k=0; while($k<$j){ echo (float)$academic_array[$k][2].","; $k=$k+1; } ?>],
				[2,  <?php $k=0; while($k<$j){ echo (float)$academic_array[$k][3].","; $k=$k+1; } ?>],
				[3,  <?php $k=0; while($k<$j){ echo (float)$academic_array[$k][4].","; $k=$k+1; } ?>],
				[4,  <?php $k=0; while($k<$j){ echo (float)$academic_array[$k][5].","; $k=$k+1; } ?>],
				[5,  <?php $k=0; while($k<$j){ echo (float)$academic_array[$k][6].","; $k=$k+1; } ?>],
				[6,  <?php $k=0; while($k<$j){ echo (float)$academic_array[$k][7].","; $k=$k+1; } ?>],
				]);

			var options = {
				chart: {
					title: 'Student Academic Performance'
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