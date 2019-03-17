<?php

require("db.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Academic Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
	<div class="container-fluid m-0 p-0" style="overflow-x: hidden;">
		<nav class="navbar navbar-expand-lg justify-content-between sticky-top sticky-offset" style="position: fixed;width: 100%;top: 0; background-color: #dcefdc;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="index.html">
						<img src="logo_green.png" alt="SACPA" height="50px"/>
					</a>
				</div>
				<form class="form-inline" id="myform" action="#" method="POST">
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
					<button class="btn btn-outline-success my-2 my-sm-0" type="Submit" name="submit">Submit</button>
				</form>
			</div>
		</nav>

	<?php 

	if(isset($_POST["submit"]))
	{
		$register = $_POST["inputRegisterNo"];
		$q="Select * from sub_marks where Student_id=".$register;
		$res= $conn->query($q);
		if($res->num_rows > 0)
		{
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
		?>
<!-- -----------------------------------Marks for each------------------------------------------ -->
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
						legend: { position: 'right' },
						vAxis: {
							maxValue: '100',
							minValue: '0'
						},
						pointsVisible: 'true',
						// width: 900,
		    //     		height: 500
					};

					var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

					chart.draw(data, options);
				}
			</script>

<!-- -------------------------------------------Attendance for each---------------------------------------------- -->
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
						legend: { position: 'right' },
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
		} //if($sem > 0)
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
		?>
<!-- -----------------------------------------Marks for all------------------------------------------ -->
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
						legend: { position: 'right' },
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

<!-- ------------------------------------------------Attendance for all------------------------------------------ -->
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
						legend: { position: 'right' },
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
		}//else

	?>


	<div class="card-deck m-2" style="padding-top: 75px;">
	<!-- -----------------------CARD 1------------------------------------ -->
		<div class="card m-3 shadow-lg bg-white rounded" >
			<h5 class="card-header"><strong>MARKS</strong></h5>
			<div class="card-body" style="font-weight: bold;">
				<?php echo $register ?> - Semester <?php if($sem == 0){echo "All";} else {echo $sem;} ?>
				<div id="curve_chart2" style="width: 600px; height: 400px"></div>
			</div>
		</div>
	<!-- -----------------------CARD 2------------------------------------  -->
		<div class="card m-3 shadow-lg bg-white rounded">
			<h5 class="card-header"><strong>ATTENDANCE</strong></h5>
			<div class="card-body" style="font-weight: bold;">
				<?php echo $register ?> - Semester <?php if($sem == 0){echo "All";} else {echo $sem;} ?>
				<div id="curve_chart" style="width: 600px; height: 400px"></div>
			</div>
		</div>
	</div>

<?php
}
else
{
	include 'modal_unsuccess_reports.html';
}
} //end of if(isset)
?>
</div>
</body>
</html>