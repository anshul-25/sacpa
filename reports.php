<?php 
require("db.php");

	if (isset($_POST["submit"])) 
	{

		$male = "Select count(title) from student where title = 'Mr'";
		$female = "Select count(title) from student where title = 'Ms' or title = 'Mrs'";
		$other = "Select count(title) from student where title ='None'";

		$res = $conn->query($male);
		$m = $res->fetch_assoc();

		$res = $conn->query($female);
		$f = $res->fetch_assoc();

		$res = $conn->query($other);
		$o = $res->fetch_assoc();

	}
?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>All Students Report - Course wise</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			function drawChart() {

				var data = google.visualization.arrayToDataTable([
					['Gender', 'No of students'],
					['Male', <?php echo $m["count(title)"]; ?>],
					['Female', <?php echo $f["count(title)"]; ?>],
					['Other', <?php echo $o["count(title)"]; ?>]
					]);

				var options = {
					'legend.position': 'top',
					'legend.alignment':'center'
				};

				var chart = new google.visualization.PieChart(document.getElementById('piechart'));

				chart.draw(data, options);
			}
		</script>
		<style type="text/css">
			.sticky-offset
			{
				top: 56px;
			}

			.nav-item
			{
				color: #5CB85C
			}

			.modal-dialog
			{
				position: relative;
				display: table; /* This is important */ 
				overflow-y: auto;    
				overflow-x: auto;
				width: auto;
				min-width: 300px;   
			}

	</style>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#searchField1").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#reportTables tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
		$(document).ready(function(){
			$("#searchField2").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#reportTables tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
		$(document).ready(function(){
			$("#searchField3").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#reportTables tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
		
	</script>
</head>

<body>
	<div class="container-fluid row m-0 p-0" style="overflow-x: hidden;">
		<nav class="navbar navbar-expand-lg justify-content-between sticky-top sticky-offset" style="position: fixed;width: 100%;top: 0; background-color: #dcefdc;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="http:\\localhost\sacpa\index.html">
						<img src="http:\\localhost\sacpa\logo_green.png" alt="SACPA" height="50px"/>
					</a>
				</div>
				<form class="form-inline" id="myform" action="#" method="POST">
					<select class="form-control mr-2" name="inputCourse" id="inputCourse">
						<option selected="true" disabled>Please select Programme</option>

						<?php
						$prog_sql="SELECT * FROM programme ORDER BY Course_Name ASC";
						$prog_result=$conn->query($prog_sql);

						if($prog_result->num_rows > 0)
						{
							while($prog_row=$prog_result->fetch_assoc())
								{ ?>
									<option value="<?php echo $prog_row['idCourse']; ?>"><?php echo $prog_row['Course_Name']; ?></option>
								<?php		}
							}

							?>

						</select>
						<button class="btn btn-outline-success my-2 my-sm-0" type="Submit" name="submit">Submit</button>
					</form>
				</div>
			</nav>

			<?php
			if (isset($_POST["submit"]))
			{
				?>

			<div class="row" >
				<div class="card-deck m-3" style="padding-top: 75px;">
					<!-- ---------------------------------FOR FIRST CARD------------------------------------------------- -->
					<?php
					$course = $_POST["inputCourse"];
					$studInfo = "select RegisterNo, FirstName, LastName, PhoneNo, EmailIdPersonal, ReservationCategory, Year_of_Admission from student s where s.ProgrammeID =" .$course;

					$i = 0;
					$res = $conn->query($studInfo);
					if($res->num_rows > 0)
					{
						while ($row = $res->fetch_assoc()) 
						{
							$studentInfo_array[$i][0] = $row["RegisterNo"];
							$studentInfo_array[$i][1] = $row["FirstName"];
							$studentInfo_array[$i][2] = $row["LastName"];
							$studentInfo_array[$i][3] = $row["PhoneNo"];
							$studentInfo_array[$i][4] = $row["EmailIdPersonal"];
							$studentInfo_array[$i][5] = $row["ReservationCategory"];
							$studentInfo_array[$i][6] = $row["Year_of_Admission"];
							$i=$i+1;
						}
	} //if

	?>
	<div class="card">
		<h5 class="card-header">Personal Information Report</h5>
		<div class="card-body">
			<div id="piechart" ></div>
			<p class="card-text">Report containing the personal details of all the students of a particular course</p>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentPersonalInfoTable">View</button>
			<div class="modal fade studentPersonalInfoTable" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Personal Information Report</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<input class="form-control ml-3 mt-3" id="searchField1" type="text" placeholder="Search.." style="width:50%;"/>
						<br>

						<?php
						if($i>0)
						{
							?>

							<table class="table table-hover m-2" style="width:90%">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Register Number</th>
										<th scope="col">First Name</th> 
										<th scope="col">Last Name</th>
										<th scope="col">Phone Number</th>
										<th scope="col">Email ID</th>
										<th scope="col">Reservation Category</th>
										<th scope="col">Year Of Admission</th>
									</tr>
								</thead>
								<?php 
								$k=0;
								while($k < $i)
								{
									?>

									<tbody id="reportTables">
										<tr>
											<th scope="row"><?php echo ($k+1) ?></th>
											<td><?php echo $studentInfo_array[$k][0] ?></td>
											<td><?php echo $studentInfo_array[$k][1] ?></td>
											<td><?php echo $studentInfo_array[$k][2] ?></td>
											<td><?php echo $studentInfo_array[$k][3] ?></td>
											<td><?php echo $studentInfo_array[$k][4] ?></td>
											<td><?php echo $studentInfo_array[$k][5] ?></td>
											<td><?php echo $studentInfo_array[$k][6] ?></td>
										</tr>
									</tbody>

									<?php
									$k=$k+1;	  
									} //while
									?>
								</table>
								<?php
							} //if($i>0)?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- --------------------------------------------------FOR SECOND CARD------------------------------------ -------->
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
		?>

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
					
					// width: 300,
					// height: 160
				};

				var chart = new google.charts.Line(document.getElementById('linechart_material'));
				chart.draw(data, options);
					//chart.draw(data, google.charts.Line.convertOptions(options));
				}

		</script>

	<div class="card">
		<h5 class="card-header">Academics Report</h5>
		<div class="card-body">
			<div id="linechart_material"></div>
			<p class="card-text">Report containing the Academic details of all the students of a particular course</p>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentAcademicInfoTable">View</button>
			<div class="modal fade studentAcademicInfoTable" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Academic Information Report</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<input class="form-control ml-3 mt-3" id="searchField2" type="text" placeholder="Search.." style="width:50%;"/>
						<br>

						<?php
						if($j>0)
						{
							?>

							<table class="table table-hover m-2" style="width:90%">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Register Number</th>
										<th scope="col">Name</th> 
										<th scope="col">Semester 1</th>
										<th scope="col">Semester 2</th>
										<th scope="col">Semester 3</th>
										<th scope="col">Semester 4</th>
										<th scope="col">Semester 5</th>
										<th scope="col">Semester 6</th>
										<th scope="col">Total</th>
									</tr>
								</thead>

								<?php 
								$k=0;
								while($k < $j)
								{
									?>

									<tbody id="reportTables">
										<tr>
											<th scope="row"><?php echo ($k+1) ?></th>
											<td><?php echo $academic_array[$k][0] ?></td>
											<td><?php echo $academic_array[$k][1] ?></td>
											<td><?php if (empty($academic_array[$k][2])) echo "NA"; else echo round($academic_array[$k][2],2) ?></td>
											<td><?php if (empty($academic_array[$k][3])) echo "NA"; else echo round($academic_array[$k][3],2) ?></td>
											<td><?php if (empty($academic_array[$k][4])) echo "NA"; else echo round($academic_array[$k][4],2) ?></td>
											<td><?php if (empty($academic_array[$k][5])) echo "NA"; else echo round($academic_array[$k][5],2) ?></td>
											<td><?php if (empty($academic_array[$k][6])) echo "NA"; else echo round($academic_array[$k][6],2) ?></td>
											<td><?php if (empty($academic_array[$k][7])) echo "NA"; else echo round($academic_array[$k][7],2) ?></td>
											<td><?php if ($average_percentage[$k]==0) echo "NA"; else echo round($average_percentage[$k],2) ?></td>
										</tr>
									</tbody>

									<?php
									$k=$k+1;	  
									} //while
									?>
								</table>
								<?php
							} //if($i>0)?>
						</div>
					</div>
				</div>
			</div>
		</div>




		<!-- --------------------------------------------------FOR THIRD CARD------------------------------------ -------->
		<?php

		$j=0;							
		$regno = "select RegisterNo, CONCAT(FirstName, ' ', LastName) AS Name from student where ProgrammeID=".$course;
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
				// chart: {
				// 	title: 'Student Attendance Performance'
				// },
				// width: 300,
				// height: 160
			};

			var chart = new google.charts.Line(document.getElementById('linechart_material2'));
			chart.draw(data, options);
			//chart.draw(data, google.charts.Line.convertOptions(options));
		}

	</script>

<div class="card">
	<h5 class="card-header">Attendance Report</h5>
	<div class="card-body">
		<div id="linechart_material2"></div>
		<p class="card-text">Report containing the Attendance details of all the students of a particular course</p>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentAttendanceInfoTable">View</button>
		<div class="modal fade studentAttendanceInfoTable" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Attendance Information Report</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<input class="form-control ml-3 mt-3" id="searchField3" type="text" placeholder="Search.." style="width:50%;"/>
					<br>

					<?php
					if($j>0)
					{
						?>

						<table class="table table-hover m-2" style="width:90%">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Register Number</th>
									<th scope="col">Name</th> 
									<th scope="col">Semester 1</th>
									<th scope="col">Semester 2</th>
									<th scope="col">Semester 3</th>
									<th scope="col">Semester 4</th>
									<th scope="col">Semester 5</th>
									<th scope="col">Semester 6</th>
									<th scope="col">Total</th>
								</tr>
							</thead>

							<?php 
							$k=0;
							while($k < $j)
							{
								?>

								<tbody id="reportTables">
									<tr>
										<th scope="row"><?php echo ($k+1) ?></th>
										<td><?php echo $attendance_array[$k][0] ?></td>
										<td><?php echo $attendance_array[$k][1] ?></td>
										<td><?php if (empty($attendance_array[$k][2])) echo "NA"; else echo round($attendance_array[$k][2],2) ?></td>
										<td><?php if (empty($attendance_array[$k][3])) echo "NA"; else echo round($attendance_array[$k][3],2) ?></td>
										<td><?php if (empty($attendance_array[$k][4])) echo "NA"; else echo round($attendance_array[$k][4],2) ?></td>
										<td><?php if (empty($attendance_array[$k][5])) echo "NA"; else echo round($attendance_array[$k][5],2) ?></td>
										<td><?php if (empty($attendance_array[$k][6])) echo "NA"; else echo round($attendance_array[$k][6],2) ?></td>
										<td><?php if (empty($attendance_array[$k][7])) echo "NA"; else echo round($attendance_array[$k][7],2) ?></td>
										<td><?php if (empty($attendance_average[$k])) echo "NA"; else echo round($attendance_average[$k],2) ?></td>
									</tr>
								</tbody>

								<?php
								$k=$k+1;	  
									} //while
									?>
								</table>
								<?php
							} //if($i>0)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
</div> 

<div class="row" >
	<div class="card-deck m-3">
		<?php
		 $q="SELECT co.Name, COUNT(co.idCountry) from city c, state s, country co, student st where st.City_id = c.idCity and c.state_id = s.idState and s.country_id = co.idCountry GROUP BY co.idCountry";

 		 $res = $conn->query($q);
		?>

		<script type="text/javascript">
			google.charts.load('current', {
	        'packages':['geochart'],
	        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
	      });
	      google.charts.setOnLoadCallback(drawRegionsMap);

	      function drawRegionsMap() 
	      {
	        var data = google.visualization.arrayToDataTable([
	          ['Country', 'Popularity'],
	          <?php
	          while($row = $res->fetch_assoc())
	          {
	            echo "['".$row["Name"]."',".$row["COUNT(co.idCountry)"]."],";
	          }
	          ?>
	        ]);

	        var options = {};

	        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

	        chart.draw(data, options);
	      }
		</script>

		<div class="card">
			<h5 class="card-header">Demographic distribution</h5>
			<div class="card-body">

				<p class="card-text">Geographical graph displaying the demographic distribution of students</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".geo_modal">View</button>
				<div class="modal fade geo_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Demographic distribution</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
							</div>
							<!-- ---put data here--- -->
							<div id="regions_div" style="width: 900px; height: 500px;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<h5 class="card-header">Attendance vs Academic Correlation</h5>
			<div class="card-body">
				<p class="card-text">Graph to show if there is any relation between academic marks and attendance</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentAttendanceInfoTable">View</button>
			</div>
		</div>
		<div class="card">
			<h5 class="card-header">Attendance vs Academic Correlation</h5>
			<div class="card-body">
				<p class="card-text">Graph to show if there is any relation between academic marks and attendance</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentAttendanceInfoTable">View</button>
			</div>
		</div>
	</div>
</div>


	<?php
} #if (isset($_POST["submit"]))
?>
</div>
</body>
</html>