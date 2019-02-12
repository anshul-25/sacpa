<?php

require("db.php");

if(isset($_POST["submit"]))
{
	$register = $_POST["inputRegisterNo"];
	$sem = $_POST["semester"];

	if($sem > 0)
	{
		$marks = "Select s.Hours_Attended,s.CIA1_Obt,s.CIA2_Obt,s.CIA3_Obt,s.EndSem_Obt,s.Atten_Obt, su.SemesterNo, su.Subj_Name, su.CIA1_Max, su.CIA2_Max, su.CIA3_Max, su.EndSem_Max, su.Attendance_Max, su.Max_Hours from sub_marks s, subjects su where s.Subject_id = su.idSubjects and su.SemesterNo =".$sem." and Student_id=".$register;
		$result=$conn->query($marks);

		if($result->num_rows > 0)
		{
			$x=0;
			while($row = $result->fetch_assoc())
			{
				$g_marks[$x][0]=$row["Subj_Name"];
				$g_marks[$x][1]=(($row["CIA1_Obt"]+$row["CIA2_Obt"]+$row["CIA3_Obt"]+$row["EndSem_Obt"]+$row["Atten_Obt"])/($row["CIA1_Max"]+$row["CIA2_Max"]+$row["CIA3_Max"]+$row["EndSem_Max"]+$row["Attendance_Max"]))*100;
				$g_marks[$x][2]=($row["Hours_Attended"]/$row["Max_Hours"])*100;

				$x=$x+1;
			}	
		}
	}
	else
	{
		$marks = "Select s.Hours_Attended,s.CIA1_Obt,s.CIA2_Obt,s.CIA3_Obt,s.EndSem_Obt,s.Atten_Obt, su.SemesterNo, su.Subj_Name, su.CIA1_Max, su.CIA2_Max, su.CIA3_Max, su.EndSem_Max, su.Attendance_Max, su.Max_Hours from sub_marks s, subjects su where s.Subject_id = su.idSubjects and Student_id=".$register;
		$result=$conn->query($marks);

		if($result->num_rows > 0)
		{
			$x=0; $o=0;
			while($o<7)
			{
				$g_marks[$o][0]="0";
				$g_marks[$o][1]=0;
				$g_marks[$o][2]=0;
				$g_marks[$o][3]=0;
				$g_marks[$o][4]=0;
				$o = $o + 1;
			}
			while($row = $result->fetch_assoc())
			{
				$x = $row["SemesterNo"]-1;
				$g_marks[$x][0]="Semester ".($x+1);
				$g_marks[$x][1]= $g_marks[$x][1]+($row["CIA1_Obt"]+$row["CIA2_Obt"]+$row["CIA3_Obt"]+$row["EndSem_Obt"]+$row["Atten_Obt"]);
				$g_marks[$x][2]= $g_marks[$x][2]+($row["CIA1_Max"]+$row["CIA2_Max"]+$row["CIA3_Max"]+$row["EndSem_Max"]+$row["Attendance_Max"]);
				$g_marks[$x][3]=$g_marks[$x][3]+$row["Hours_Attended"];
				$g_marks[$x][4]=$g_marks[$x][4]+$row["Max_Hours"];
				//echo $g_marks[$x][0]."<br>".$g_marks[$x][1]."<br>".$g_marks[$x][2]."<br>".$g_marks[$x][3]."<br>".$g_marks[$x][4]."<br>";
			}
		}
	}
	
	
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Marks and Attendance</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<form class="form-inline m-3" id="myform" action="#" method="POST">
		<input class="form-control mr-sm-2" name="inputRegisterNo" id="inputRegisterNo" type="text" placeholder="Register No." aria-label="registerno" pattern="[0-9]{7}" required> &nbsp; &nbsp;
		<select name="semester"  id="semester" class="form-control">
			<option selected disabled="">Select Semester</option>
			<option value=0>All</option>
			<option value=1>1</option>
			<option value=2>2</option>
			<option value=3>3</option>
			<option value=4>4</option>
			<option value=5>5</option>
			<option value=6>6</option>
		</select> &nbsp; &nbsp;
		<button type="Submit" name="submit" class="btn btn-primary">Submit</button>
	</form>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<?php 

	if(isset($_POST["submit"]))
	{
		if($sem > 0)
		{
			?>
			<!-- Marks -->
			<script type="text/javascript">
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Subject', 'Marks'],
						<?php
						if(isset($_POST["submit"]))
						{
							$n=0;
							while($n < $x)
							{
								echo "[\"".$g_marks[$n][0]."\",".(float)$g_marks[$n][1]."],";
								$n=$n+1;
							}
						}
						?>
						]);


					var options = {
						title: 'Student Performance - Marks',
						subtitle: '<?php echo $register." [Semester - ".$sem."]" ?> ',
						//curveType: 'function',
						legend: { position: 'bottom' },
						vAxis: {
							maxValue: '100',
							minValue: '0'
						},
						pointsVisible: 'true'
					};

					var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

					chart.draw(data, options);
				}
			</script>

			<!-- Attendance -->
			<script type="text/javascript">
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Subject', 'Attendance'],
						<?php
						if(isset($_POST["submit"]))
						{
							$n=0;
							while($n < $x)
							{
								echo "[\"".$g_marks[$n][0]."\",".(float)$g_marks[$n][2]."],";
								$n=$n+1;
							}
						}
						?>
						]);

					var options = {
						title: 'Student Performance - Attendance',
						subtitle: '<?php echo $register." [Semester - ".$sem."]" ?> ',
						//curveType: 'function',
						legend: { position: 'bottom' },
						vAxis: {
							maxValue: '100',
							minValue: '0'
						},
						pointsVisible: 'true'
					};

					var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

					chart.draw(data, options);
				}
			</script>
			<?php
		}
		else
		{
			?>
			<!-- Marks -->
			<script type="text/javascript">
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Semester', 'Marks'],
						<?php
						if(isset($_POST["submit"]))
						{
							$n=0;
							while($n < 7)
							{
								if($g_marks[$n][0] != "0")
								{
									$mar = ($g_marks[$n][1]/$g_marks[$n][2])*100;
									echo "[\"".$g_marks[$n][0]."\",".(float)$mar."],";
								}
								$n=$n+1;  
							}
						}
						?>
						]);

					var options = {
						title: 'Student Performance - Marks',
						subtitle: '<?php echo $register; ?> ',
						//curveType: 'function',
						legend: { position: 'bottom' },
						vAxis: {
							maxValue: '100',
							minValue: '0'
						},
						pointsVisible: 'true'
					};

					var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

					chart.draw(data, options);
				}
			</script>

			<!-- Attendance -->
			<script type="text/javascript">
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				function drawChart() {
					var data = google.visualization.arrayToDataTable([
						['Semester','Attendance'],
						<?php
						if(isset($_POST["submit"]))
						{
							$n=0;
							while($n < 7)
							{
								if($g_marks[$n][0] != "0")
								{
									$att = ($g_marks[$n][3]/$g_marks[$n][4])*100;
									echo "[\"".$g_marks[$n][0]."\",".(float)$att."],";
								}
								$n=$n+1;  
							}
						}
						?>
						]);

					var options = {
						title: 'Student Performance - Attendance',
						subtitle: '<?php echo $register; ?> ',
						//curveType: 'function',
						legend: { position: 'bottom' },
						vAxis: {
							maxValue: '100',
							minValue: '0'
						},
						pointsVisible: 'true'
					};

					var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

					chart.draw(data, options);
				}
			</script>
			<?php
		}

	}

	?>
	<div id="curve_chart2" style="width: 900px; height: 500px"></div>
	<div id="curve_chart" style="width: 900px; height: 500px"></div>	
	


</body>
</html>