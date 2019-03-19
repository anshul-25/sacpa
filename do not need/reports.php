<?php 
require("db.php");
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
		/*overflow-y: auto;    */
		overflow-x: auto;
		width: auto;
		min-width: 300px;   
		overflow-y: initial !important
	}
	.modal-body
	{
		height: 450px;
		overflow-y: auto;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$("#searchField1").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#reportTables1 tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	$(document).ready(function(){
		$("#searchField2").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#reportTables2 tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	$(document).ready(function(){
		$("#searchField3").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#reportTables3 tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	$(document).ready(function(){
		$("#searchField4").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#reportTables4 tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	$(document).ready(function(){
		$("#searchField5").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#reportTables5 tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	$(document).ready(function(){
		$("#searchField6").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#reportTables6 tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	$(document).ready(function(){
		$("#searchField7").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#reportTables7 tr").filter(function() {
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
					<a href="index.html">
						<img src="logo_green.png" alt="SACPA" height="50px"/>
					</a>
				</div>
				<form class="form-inline" id="myform" action="#" method="POST">
					<select class="form-control mr-2" name="inputCourse" id="inputCourse" required>
						<option value="">Please Select Programme</option>
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
						<select class="form-control mr-2" name="inputBatch" id="inputBatch" required>
							<option value="">Select Batch</option>
							<?php
							$batch_q="select DISTINCT Year_of_Admission from student order by Year_of_Admission ASC";
							$batch_r=$conn->query($batch_q);

							if($batch_r->num_rows > 0)
							{
								while($batch_row = $batch_r->fetch_assoc())
								{
									?>
									<option><?php echo $batch_row["Year_of_Admission"]; ?></option>
									<?php
								}
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
				$batch = $_POST["inputBatch"];
				$course = $_POST["inputCourse"];

				if($course == 1)
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
					?>
					<div class="row w-100 m-5" style="padding-top: 75px; text-align: center;" >
						<!-- ---------------------------------FOR FIRST CARD------------------------------------------------- -->

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

						<?php
						$course = $_POST["inputCourse"];
						$studInfo = "select RegisterNo, FirstName, LastName, PhoneNo, EmailIdPersonal, ReservationCategory, Year_of_Admission from student s where s.ProgrammeID =" .$course." and s.Year_of_Admission =".$batch;

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
						<div class="col-4">
							<div class="card shadow-lg bg-white rounded">
								<h5 class="card-header">Personal Information Report</h5>
								<div class="card-body">
									<div id="piechart" ></div>
									<p class="card-text">Report containing the personal details of all the students of a particular course</p>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentPersonalInfoTable">View</button>
									<div class="modal fade studentPersonalInfoTable" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
										<div class="modal-dialog modal-lg" style="max-width: 1200px;">
											<div class="modal-content">
												<div class="modal-header" style="background-color: #73bf73;">
													<h5 class="modal-title text-light ml-4">Personal Information Report</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<input class="form-control ml-3 mt-3" id="searchField1" type="text" placeholder="Search.." style="width:50%;"/>
													<br>

													<?php
													if($i>0)
													{
														?>

														<table class="table table-hover m-2" style="width:100%">
															<thead>
																<tr>
																	<th scope="col">#</th>
																	<th scope="col">Reg No</th>
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

																<tbody id="reportTables1">
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
								</div>
								<?php
							} //if($i>0)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- --------------------------------------------------FOR SECOND CARD------------------------------------ -------->
	<?php
			//php code for card 2 graph

	$q_semcount = "Select COUNT(distinct subjects.SemesterNo) as num from subjects,sub_marks where sub_marks.Subject_id = subjects.idSubjects";
	$res_semcount = $conn->query($q_semcount);
	$r_semcount = $res_semcount->fetch_assoc();

	$h=1;
	while($h<=$r_semcount["num"])
	{

		$q_marks = "SELECT sub_marks.Subject_id, (sum(sub_marks.CIA1_Obt)+sum(sub_marks.CIA2_Obt)+sum(sub_marks.CIA3_Obt)+sum(sub_marks.EndSem_Obt)+sum(sub_marks.Atten_Obt)) as marks_obt, (sum(subjects.CIA1_Max)+sum(subjects.CIA2_Max)+sum(subjects.CIA3_Max)+sum(subjects.EndSem_Max)+sum(subjects.Attendance_Max)) as total_marks, subjects.SemesterNo from sub_marks, student,subjects where student.RegisterNo = sub_marks.Student_id and student.ProgrammeID=".$course." and student.Year_of_Admission=".$batch." and sub_marks.Subject_id = subjects.idSubjects and subjects.SemesterNo=".$h." GROUP by sub_marks.Subject_id";
		$res_marks = $conn->query($q_marks);

		$agg_batch[$h-1][0]=$h; 
		$agg_batch[$h-1][1]=0;
		$agg_batch[$h-1][2]=0;

		while($r_marks = $res_marks->fetch_assoc())
		{
			$agg_batch[$h-1][1]=$agg_batch[$h-1][1]+$r_marks["marks_obt"];
			$agg_batch[$h-1][2]=$agg_batch[$h-1][2]+$r_marks["total_marks"];
		}
		$agg_batch[$h-1][3]=($agg_batch[$h-1][1]/$agg_batch[$h-1][2])*100;

		$h=$h+1;
	}
			//print_r($agg_batch);
	?>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Semester', 'Marks'],
				<?php
				$l=0;
				while($l<$h-1)
				{
					echo "['Semester ".$agg_batch[$l][0]."',".$agg_batch[$l][3]."],";
					$l=$l+1;
				}

				?>
				]);

			var options = {
				title: 'Academic Performance - Batch wise',
				legend: { position: 'bottom' }
			};

			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

			chart.draw(data, options);
		}
	</script>

	<!-- ------------ php code for table in card 2 and graph in card 7 ------------- -->
	<?php
	require("db.php");
	$j2=0;							
	$regno = "select RegisterNo, CONCAT(FirstName, ' ', LastName) AS Name from student where ProgrammeID =".$course." and Year_of_Admission =".$batch;
	$res=$conn->query($regno);

	while($row=$res->fetch_assoc())
	{
		$total_percentage[$j2]=0;
		$academic_array[$j2][0]=$row["RegisterNo"];
		$academic_array[$j2][1]=$row["Name"];
		$m=2;
		$semno_query="select distinct SemesterNo from subjects";
		$res1=$conn->query($semno_query);
		while($m<8)
		{
			$academic_array[$j2][$m] = 0;
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
				$total_percentage[$j2]=$total_percentage[$j2]+$percentage; 
				$academic_array[$j2][$m] = $percentage;
				$m = $m+1;

			}
			}//while
			$temp = $m-2;
			if($temp != 0)
			{
				$average_percentage[$j2] = ($total_percentage[$j2]/$temp);	
			}
			else
			{
				$average_percentage[$j2] = 0;
			}
			$j2=$j2+1;							
		}//while
		?>
		<div class="col-8">
			<div class="card shadow-lg bg-white rounded">
				<h5 class="card-header">Academics Report</h5>
				<div class="card-body">
					<div id="curve_chart"></div>
					<p class="card-text"><br>Consolidated academic report for all students of a particular course</p>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentAcademicInfoTable">View</button>
					<div class="modal fade studentAcademicInfoTable" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
						<div class="modal-dialog modal-lg" style="max-width:1300px;">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #73bf73;">
									<h5 class="modal-title text-light ml-4">Academic Information Report</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input class="form-control ml-3 mt-3" id="searchField2" type="text" placeholder="Search.." style="width:50%;"/>
									<br>

									<?php
									if($j2>0)
									{
										?>

										<table class="table table-hover m-2" style="max-width:1600px;">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Reg No</th>
													<th scope="col">Name</th> 
													<th scope="col">Semester 1</th>
													<th scope="col">Semester 2</th>
													<th scope="col">Semester 3</th>
													<th scope="col">Semester 4</th>
													<th scope="col">Semester 5</th>
													<th scope="col">Semester 6</th>
													<th scope="col">Total</th>
													<th scope="col" style="width: 10%;">Grade</th>
												</tr>
											</thead>

											<?php 
											$k=0;
											while($k < $j2)
											{
												?>

												<tbody id="reportTables2">
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
														<td>
															<?php
															if($average_percentage[$k]>=80)
																echo "First Class with Distinction";
															else if($average_percentage[$k]>=60)
																echo "First Class";
															else if($average_percentage[$k]>=50)
																echo "Second Class";
															else if ($average_percentage[$k]>=40)
																echo "Pass Class";
															else if($average_percentage[$k]>0)
																echo "Fail";
															else
																echo "NA";


															?>
														</td>
													</tr>
												</tbody>

												<?php
												$k=$k+1;	  
									} //while
									?>
								</table>
							</div>
							<?php
						} //if($i>0)?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


<!-- --------------------------------------------------FOR THIRD CARD------------------------------------ -------->

<?php
			//php code for card 3 graph

$q_semcount = "Select COUNT(distinct subjects.SemesterNo) as num from subjects,sub_marks where sub_marks.Subject_id = subjects.idSubjects";
$res_semcount = $conn->query($q_semcount);
$r_semcount = $res_semcount->fetch_assoc();

$h=1;
while($h<=$r_semcount["num"])
{

	$q_marks = "SELECT sub_marks.Subject_id, sum(sub_marks.Hours_Attended) as att_obt, sum(subjects.Max_Hours) as att_total, subjects.SemesterNo from sub_marks, student,subjects where student.RegisterNo = sub_marks.Student_id and student.ProgrammeID=".$course." and student.Year_of_Admission=".$batch." and sub_marks.Subject_id = subjects.idSubjects and subjects.SemesterNo=".$h." GROUP by sub_marks.Subject_id";
	$res_marks = $conn->query($q_marks);

	$agg_batch[$h-1][0]=$h; 
	$agg_batch[$h-1][1]=0;
	$agg_batch[$h-1][2]=0;

	while($r_marks = $res_marks->fetch_assoc())
	{
		$agg_batch[$h-1][1]=$agg_batch[$h-1][1]+$r_marks["att_obt"];
		$agg_batch[$h-1][2]=$agg_batch[$h-1][2]+$r_marks["att_total"];
	}
	$agg_batch[$h-1][3]=($agg_batch[$h-1][1]/$agg_batch[$h-1][2])*100;

	$h=$h+1;
}
			//print_r($agg_batch);
?>
<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Semester', 'Attendance'],
			<?php
			$l=0;
			while($l<$h-1)
			{
				echo "['Semester ".$agg_batch[$l][0]."',".$agg_batch[$l][3]."],";
				$l=$l+1;
			}

			?>
			]);

		var options = {
			title: 'Attendance Statistics - Batch wise',
			legend: { position: 'bottom' }
		};

		var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

		chart.draw(data, options);
	}
</script>

<!-- php code for table in card 3 and graph in card 8 -->

<?php

$j3=0;							
$regno = "select RegisterNo, CONCAT(FirstName, ' ', LastName) AS Name from student where ProgrammeID =".$course." and Year_of_Admission = ".$batch;
$res=$conn->query($regno);

while($row=$res->fetch_assoc())
{
	$total_percentage[$j3] = 0;
	$attendance_array[$j3][0]=$row["RegisterNo"];
	$attendance_array[$j3][1]=$row["Name"];
	$m=2;
	$semno_query="select distinct SemesterNo from subjects";
	$res1=$conn->query($semno_query);
	while($m<8)
	{
		$attendance_array[$j3][$m] = 0;
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
			$total_percentage[$j3]=$total_percentage[$j3]+$percentage; 
			$attendance_array[$j3][$m] = $percentage;
			$m = $m+1;		
		}
	}//while
	$temp = $m-2;
	if($temp != 0)
	{
		$attendance_average[$j3] = ($total_percentage[$j3]/$temp);	
	}
	else
	{
		$attendance_average[$j3] = 0;
	}
	$j3=$j3+1;							
}//while
?>
<div class="row w-100 m-5" style="text-align: center; padding-top: 20px;">
	<!-- ------------------------------3RD CARD----------------------------- -->
	<div class="col-8">
		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Attendance Report</h5>
			<div class="card-body">
				<div id="curve_chart2"></div>
				<p class="card-text"><br>Consolidated attendance report for all students of a particular course</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentAttendanceInfoTable">View</button>
				<div class="modal fade studentAttendanceInfoTable" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
					<div class="modal-dialog modal-lg" style="max-width:1400px;">
						<div class="modal-content">
							<div class="modal-header" style="background-color: #73bf73;">
								<h5 class="modal-title text-light ml-4">Attendance Information Report</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input class="form-control ml-3 mt-3" id="searchField3" type="text" placeholder="Search.." style="width:50%;"/>
								<br>

								<?php
								if($j3>0)
								{
									?>

									<table class="table table-hover m-2" style="max-width:1430px;">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Reg No</th>
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
										while($k < $j3)
										{
											?>

											<tbody id="reportTables3">
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
							</div>
							<?php
						} //if($i>0)?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- -------------------------------------------------------4TH CARD------------------------------------ -->
<div class="col-4">
	<?php
	$q="SELECT co.Name, COUNT(co.idCountry) from city c, state s, country co, student st where st.ProgrammeID =".$course." and st.Year_of_Admission = ".$batch." and st.City_id = c.idCity and c.state_id = s.idState and s.country_id = co.idCountry GROUP BY co.idCountry";
	$res = $conn->query($q);
	$i=0;
	while($row = $res->fetch_assoc())
	{
		$a[$i][0]=$row["Name"];
		$a[$i][1]=$row["COUNT(co.idCountry)"];
		$i=$i+1;
	}
	?>
	<!-- Card Graph -->
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = google.visualization.arrayToDataTable([
				['Country', 'Popularity'],
				<?php 
				$k=0;
				while($k<$i)
				{
					echo "['".$a[$k][0]."',".$a[$k][1]."],";
					$k=$k+1;
				}
				?>
				]);

			var options = {
				title: 'Demographic Distribution - Popularity'
			};

			var chart = new google.visualization.PieChart(document.getElementById('country_count_pie'));

			chart.draw(data, options);
		}
	</script>

	<!-- Modal Graph -->
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
				$k=0;
				while($k<$i)
				{
					echo "['".$a[$k][0]."',".$a[$k][1]."],";
					$k=$k+1;
				}
				?>
				]);

			var options = {};

			var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

			chart.draw(data, options);
		}
	</script>

	<div class="card shadow-lg bg-white rounded">
		<h5 class="card-header">Demographic distribution - Count</h5>
		<div class="card-body">
			<div id="country_count_pie"></div>
			<p class="card-text">Geographical graph displaying the demographic distribution of students</p>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".geo_modal">View</button>
			<div class="modal fade geo_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header" style="background-color: #73bf73;">
							<h5 class="modal-title text-light ml-4">Demographic distribution</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body p-5" style="overflow-y: hidden;">
							<div id="regions_div" style="width: 900px; height: 500px;"></div>	
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>   <!-------2nd row-->

<div class="row w-100 m-5" style="text-align: center; padding-top: 20px;">
	<div class="col-8">
		<!-- ------------------------------------------5TH CARD-------------------------------- -->


		<!-- modal graph -->
		<script type="text/javascript">
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			function drawChart() 
			{
				var data = google.visualization.arrayToDataTable([
					['Attendance', 'Marks'],
					<?php
					$n=0;$i=0;
					$csv = array();
					$file = fopen('studentdata_att_aca.csv', 'r');

					while (($result = fgetcsv($file)) !== false)
					{
						$csv[] = $result;
						$n=$n+1;
					}

					fclose($file);
					while ($i < $n)
					{
						echo "[".$csv[$i][0].",".$csv[$i][1]."],";
						$i=$i+1;
					}
					?>
					]);

				var options = {
					title: 'Attendance vs. Marks regression line',
					hAxis: {title: 'Attendance', minValue: 60, maxValue: 100},
					vAxis: {title: 'Marks', minValue: 60, maxValue: 100},
					legend: 'none',
					trendlines: { 0: {} },
					// width: 900,
					height: 348
				};

				var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

				chart.draw(data, options);
			}
		</script>
		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Attendance vs Academic Correlation</h5>
			<div class="card-body">
				<div id="chart_div"></div>
				<p class="card-text">Graph to show if there is any relation between academic marks and attendance</p>
				
			</div>
		</div>
	</div>

	<div class="col-4">
		<!-- ---------------------------------------------------6TH CARD-------------------------------------- -->
		<?php
		require('db.php');

		$country_list="select co.idCountry, co.Name from student s, city ci, state st, country co where s.ProgrammeID =".$course." and s.Year_of_Admission = ".$batch." and s.City_id=ci.idCity and ci.state_id=st.idState and st.country_id=co.idCountry group by co.Name";


		$res1=$conn->query($country_list);

		$percentage=0;
// $agg=0;
		$i=0;

		while($row1=$res1->fetch_assoc())
		{
			$total=0;
			$obtained=0;
			$subject_id_query = "select sm.Subject_id, s.SemesterNo, s.CIA1_Max, s.CIA2_Max, s.CIA3_Max, s.EndSem_Max, s.Attendance_Max, sm.CIA1_Obt, sm.CIA2_Obt, sm.CIA3_Obt, sm.EndSem_Obt, sm.Atten_Obt from sub_marks sm, subjects s, student stu, city ci, state st, country co where sm.Subject_id=s.idSubjects AND sm.Student_id=stu.RegisterNo AND stu.City_id=ci.idCity AND ci.state_id=st.idState AND st.country_id=".$row1["idCountry"];

			$agg[$i][0]=$row1["Name"];

			$res2=$conn->query($subject_id_query);
			$agg[$i][1]=0;
			while($row2=$res2->fetch_assoc())
			{
				$total=$total + $row2["CIA1_Max"] + $row2["CIA2_Max"] + $row2["CIA3_Max"] + $row2["EndSem_Max"] + $row2["Attendance_Max"];
				$obtained = $obtained + $row2["CIA1_Obt"] + $row2["CIA2_Obt"] + $row2["CIA3_Obt"] + $row2["EndSem_Obt"] + $row2["Atten_Obt"];

			}
			if($total != 0)
			{
				$percentage = ($obtained/$total) * 100;
				$agg[$i][1]=$agg[$i][1]+$percentage;
		// $avg[$i]=$agg/$res2->num_rows;
				$i=$i+1;
			}

		}
		?>

		<!-- card graph -->
		<script type="text/javascript">
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			function drawChart() {

				var data = google.visualization.arrayToDataTable([
					['Country', 'Average Marks'],
					<?php
					$k=0;
					while($k<$i)
					{
						echo "['".$agg[$k][0]."',".$agg[$k][1]."],";
						$k=$k+1;
					}

					?>
					]);

				var options = {
					title: 'Demographic Distribution - Marks',
					height: 245
				};

				var chart = new google.visualization.PieChart(document.getElementById('country_marks_pie'));

				chart.draw(data, options);
			}
		</script>
		<!-- modal graph -->
		<script type="text/javascript">
			google.charts.load('current', {
				'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
    });
			google.charts.setOnLoadCallback(drawRegionsMap);

			function drawRegionsMap() {
				var data = google.visualization.arrayToDataTable([
					['Country', 'Average Percentage'],
					<?php
					$k=0;
					while($k<=$i)
					{
						echo "['".$agg[$k][0]."',".$agg[$k][1]."],";
						$k=$k+1;
					}
					?>
					]);

				var options = {};

				var chart = new google.visualization.GeoChart(document.getElementById('regions_div2'));

				chart.draw(data, options);
			}
		</script>


		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Demographic Distribution - Academics</h5>
			<div class="card-body">
				<div id="country_marks_pie"></div>
				<p class="card-text">Students' academic analysis on demographic data</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".geo_modal2">View</button>

				<div class="modal fade geo_modal2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="background-color: #73bf73;">
								<h5 class="modal-title text-light ml-4">Demographic Distribution - Academics</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body p-5" style="overflow-y: hidden;">
								<div id="regions_div2" style="width: 900px; height: 500px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div> <!--3rd row-->

<div class="row w-100 m-5" style="text-align: center; padding-top: 20px;">

	<!-- --------------------------7TH CARD------------------------- -->
	<div class="col-6">
		<script type="text/javascript">
			google.charts.load('current', {'packages':['line']});
			google.charts.setOnLoadCallback(drawChart);
			var chart
			var data
			var options
			function drawChart() {

				data = new google.visualization.DataTable();
				data.addColumn('string', 'Semester');
				<?php 
				$k=0;
				while($k<$j2) : ?>
					data.addColumn('number',<?php echo $academic_array[$k][0]; ?>);		
					<?php $k=$k+1; ?>
				<?php endwhile ?>
				data.addRows([
					['Semester 1',  <?php $k=0; while($k<$j2){ echo (float)$academic_array[$k][2].","; $k=$k+1; } ?>],
					['Semester 2',  <?php $k=0; while($k<$j2){ echo (float)$academic_array[$k][3].","; $k=$k+1; } ?>],
					['Semester 3',  <?php $k=0; while($k<$j2){ echo (float)$academic_array[$k][4].","; $k=$k+1; } ?>],
					['Semester 4',  <?php $k=0; while($k<$j2){ echo (float)$academic_array[$k][5].","; $k=$k+1; } ?>],
					['Semester 5',  <?php $k=0; while($k<$j2){ echo (float)$academic_array[$k][6].","; $k=$k+1; } ?>],
					['Semester 6',  <?php $k=0; while($k<$j2){ echo (float)$academic_array[$k][7].","; $k=$k+1; } ?>],
					]);

				options = {
					pointsVisible: 'true',
					legend : {position: 'none'}
					// width: 300,
					// height: 160
				};


				var chart = new google.charts.Line(document.getElementById('linechart_material3'));
				chart.draw(data, options);
			}
		</script>

		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Academics Report</h5>
			<div class="card-body">
				<div id="linechart_material3"></div>
				<br>
				<p class="card-text">Graph representing academic performance of all students.</p>
			</div>
		</div>
	</div>

	<!-- -----------------------------------8TH CARD---------------------------- -->
	<div class="col-6">
		<script type="text/javascript">
			google.charts.load('current', {'packages':['line']});
			google.charts.setOnLoadCallback(drawChart);
			var chart
			var options
			var chart
			function drawChart() {

				data = new google.visualization.DataTable();
				data.addColumn('string', 'Semester');
				<?php 
				$k=0;
				while($k<$j3) : ?>
					data.addColumn('number',<?php echo $attendance_array[$k][0]; ?>);		
					<?php $k=$k+1; ?>
				<?php endwhile ?>
				data.addRows([
					['Semester 1',  <?php $k=0; while($k<$j3){ echo (float)$attendance_array[$k][2].","; $k=$k+1; } ?>],
					['Semester 2',  <?php $k=0; while($k<$j3){ echo (float)$attendance_array[$k][3].","; $k=$k+1; } ?>],
					['Semester 3',  <?php $k=0; while($k<$j3){ echo (float)$attendance_array[$k][4].","; $k=$k+1; } ?>],
					['Semester 4',  <?php $k=0; while($k<$j3){ echo (float)$attendance_array[$k][5].","; $k=$k+1; } ?>],
					['Semester 5',  <?php $k=0; while($k<$j3){ echo (float)$attendance_array[$k][6].","; $k=$k+1; } ?>],
					['Semester 6',  <?php $k=0; while($k<$j3){ echo (float)$attendance_array[$k][7].","; $k=$k+1; } ?>],
					]);

				options = {
					pointsVisible: 'true',
					legend : {position: 'none'}
				};
				

				chart = new google.charts.Line(document.getElementById('linechart_material4'));
				chart.draw(data, options);

			}

		</script>

		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Attendance Report</h5>
			<div class="card-body">
				<div id="linechart_material4"></div>
				<br>
				<p class="card-text">Graph representing attendance statistics of all students.</p>
				
			</div>
		</div>
	</div>
	
</div> <!---4th row--->

<div class="row w-100 m-5" style="text-align: center; padding-top: 20px;">

	<!-- --------------------------------------9TH CARD-------------------------------- -->
	<div class="col-8">
		<?php

		//php code for card graph 

		$q_activity = "SELECT activity_type.Type_Name,COUNT(DISTINCT activity.Studentid) as c from activity,activity_type,student WHERE student.RegisterNo = activity.Studentid and student.ProgrammeID=".$course." and student.Year_of_Admission=".$batch." and activity_type.idActivity_type = activity.Type GROUP by activity.Type";
		$res_activity=$conn->query($q_activity);

		$q_club = "SELECT COUNT(DISTINCT clubs_organisations.Studentid) as club FROM clubs_organisations,student where student.RegisterNo = clubs_organisations.Studentid and student.ProgrammeID=".$course." and student.Year_of_Admission=".$batch;
		$res_club=$conn->query($q_club);
		$r_club = $res_club->fetch_assoc();

		$q_cc = "SELECT COUNT(DISTINCT credit_course.Studentid) as cc from credit_course,student where student.RegisterNo = credit_course.Studentid and student.ProgrammeID=".$course." and student.Year_of_Admission=".$batch;
		$res_cc=$conn->query($q_cc);
		$r_cc = $res_cc->fetch_assoc();

		$q_int = "SELECT COUNT(DISTINCT internships.StudentID) as inter from internships,student WHERE student.RegisterNo = internships.StudentID and student.ProgrammeID=".$course." and student.Year_of_Admission=".$batch;
		$res_int=$conn->query($q_int);
		$r_int = $res_int->fetch_assoc();

		$q_me = "SELECT COUNT(DISTINCT managed_events.Studentid) as me from managed_events,student where student.RegisterNo = managed_events.Studentid and student.ProgrammeID=".$course." and student.Year_of_Admission=".$batch;
		$res_me=$conn->query($q_me);
		$r_me = $res_me->fetch_assoc();

		$q_pe = "SELECT COUNT(DISTINCT participated_events.StudentId) as pe from participated_events,student where student.RegisterNo = participated_events.Studentid and student.ProgrammeID=".$course." and student.Year_of_Admission=".$batch;
		$res_pe=$conn->query($q_pe);
		$r_pe = $res_pe->fetch_assoc();

		?>

		<script type="text/javascript">
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			function drawChart() {
				var data = google.visualization.arrayToDataTable([
					['Type', 'Count'],
					<?php
					while($r_activity = $res_activity->fetch_assoc())
					{
						echo "['".$r_activity["Type_Name"]."',".$r_activity["c"]."],";
					}
					echo "['Organisations',".$r_club["club"]."],";
					echo "['Credit Course',".$r_cc["cc"]."],";
					echo "['Internships',".$r_int["inter"]."],";
					echo "['Managed Events',".$r_me["me"]."],";
					echo "['Participated Events',".$r_pe["pe"]."]";
					?>
					]);

				var options = {
					title: 'Co-curricular statistics',
					subtitle: 'Count of students involved in each',
					legend: { position: 'none'},
					height: 350,	
					hAxis: {title: "Type" , direction:-1, slantedText:true, slantedTextAngle:45 }				
				};

				var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material2'));
				chart.draw(data, options);
			}

		</script>

		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Co-curricular Report</h5>
			<div class="card-body">
				<div id="columnchart_material2"></div>
				<br>
				<p class="card-text">Graph representing co-curricular statistics of all students.</p>
			</div>
		</div>
	</div>


	<!-- ----------------------------10TH CARD------------------------ -->
	<?php


	// ----------------------for GRAPH----------------------
	$activitygraph="select count(a.Studentid), att.Type_Name from activity a, activity_type att, student s where a.Type = att.idActivity_type and s.ProgrammeID=1 and s.Year_of_Admission=2016 and s.RegisterNo=a.Studentid GROUP BY Type";
	$res=$conn->query($activitygraph);

	//---------------------for Table----------------
	$activitytable="select s.RegisterNo, concat(s.FirstName, ' ', s.LastName ) as Name, att.Type_Name as 'Activity Type', a.Name, a.StartDate, a.EndDate, a.Role, a.No_of_team_members, a.Stipend from student s, activity a, activity_type att where s.RegisterNo=a.Studentid and a.Type=att.idActivity_type";
	$res1=$conn->query($activitytable);

	$b=0;
	while($row=$res->fetch_assoc())
	{
		$arr[$b][0]=$row["Type_Name"];
		$arr[$b][1]=$row["count(a.Studentid)"];
		$b=$b+1;
	}
	?>

	<script type="text/javascript">
		google.charts.load("current", {packages:['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				["Activity", "Count"],

				<?php
				$k=0;
				while($k<$b)
				{
					echo "['".$arr[$k][0]."',".$arr[$k][1]."],";
					$k=$k+1;
				}

				?>

				]);

			var options = {
				title: "Student count for activity",
				//width: 600,
				height: 298,
				//bar: {groupWidth: "95%"},
				legend: { position: "none" },
			};
			var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
			chart.draw(data, options);
		}
	</script>
	<div class="col-4">
		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Project/Research Report</h5>
			<div class="card-body">
				<div id="columnchart_values"></div>
				<p class="card-text">Report containing the academic activity details of all the students of a particular course</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".activity_table">View</button>
				<div class="modal fade activity_table" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
					<div class="modal-dialog modal-lg" style="max-width: 1200px;">
						<div class="modal-content">
							<div class="modal-header" style="background-color: #73bf73;">
								<h5 class="modal-title text-light ml-4">Project/Research Report</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input class="form-control ml-3 mt-3" id="searchField4" type="text" placeholder="Search.." style="width:50%;"/>
								<br>

								<?php
								if($i>0)
								{
									?>

									<table class="table table-hover m-2" style="width:100%">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Register No.</th>
												<th scope="col">Student Name</th>
												<th scope="col">Activity Type</th>
												<th scope="col">Activity Name</th>
												<th scope="col">Start Date</th>
												<th scope="col">End Date</th>
												<th scope="col">Role</th>
												<th scope="col">No. of team memebers</th>
												<th scope="col">Stipend</th>
											</tr>
										</thead>
										<?php 
										$k=0;
										while($row1=$res1->fetch_assoc())
										{
											?>

											<tbody id="reportTables4">
												<tr>
													<td scope="row"><?php echo ($k+1) ?></td>
													<td><?php echo $row1["RegisterNo"] ?></td>
													<td><?php echo $row1["Name"] ?></td>
													<td><?php echo $row1["Activity Type"] ?></td>
													<td><?php echo $row1["Name"] ?></td>
													<td><?php echo $row1["StartDate"] ?></td>
													<td><?php echo $row1["EndDate"] ?></td>
													<td><?php echo $row1["Role"] ?></td>
													<td><?php echo $row1["No_of_team_members"] ?></td>
													<td><?php echo $row1["Stipend"] ?></td>
												</tr>
											</tbody>

											<?php
											$k=$k+1;	  
										} //while
										?>
									</table>
								</div>
								<?php
							} //if($i>0)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!--5th row-->

<div class="row w-100 m-5" style="text-align: center; padding-top: 20px;">
	<!-- ----------------------------11TH CARD----------------- -->
	<?php


		// -----------------------for table----------------------------
	$clubsinfo="select s.RegisterNo, concat(s.Firstname,' ', s.LastName) as Name, c.Name as 'Club Name', c.Role  from student s, clubs_organisations c where ProgrammeID=1 and Year_of_Admission=2016 and s.RegisterNo=c.Studentid";
	$res=$conn->query($clubsinfo);

		//-------------------------for Graph------------------------------
	$clubscount="select count(s.RegisterNo), c.Name from student s, clubs_organisations c where ProgrammeID=1 and Year_of_Admission=2016 and s.RegisterNo=c.Studentid group by c.Name";
	$res1=$conn->query($clubscount);

	$i=0;
	while($row1=$res1->fetch_assoc())
	{

		$arr[$i][0] = $row1["Name"];
		$arr[$i][1] = $row1["count(s.RegisterNo)"];
		$i=$i+1;
	}
	?>
	<script type="text/javascript">
		google.charts.load("current", {packages:['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				["Clubs", "Count"],

				<?php
				$k=0;
				while($k<$i)
				{
					echo "['".$arr[$k][0]."',".$arr[$k][1]."],";
					$k=$k+1;
				}

				?>

				]);

			var options = {
				title: "No. of students participating in clubs/organisations",
				//width: 600,
				height: 300,
				//bar: {groupWidth: "95%"},
				legend: { position: "none" },
			};
			var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values1"));
			chart.draw(data, options);
		}
	</script>

	<div class="col-4">
		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Organisations/Clubs Report</h5>
			<div class="card-body">
				<div id="columnchart_values1"></div>
				<p class="card-text">Report containing the count of students in each organisations or clubs for a particular course</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".clubs_table">View</button>
				<div class="modal fade clubs_table" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
					<div class="modal-dialog modal-lg" style="max-width: 1200px;">
						<div class="modal-content">
							<div class="modal-header" style="background-color: #73bf73;">
								<h5 class="modal-title text-light ml-4">Organisations/Clubs Report</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input class="form-control ml-3 mt-3" id="searchField5" type="text" placeholder="Search.." style="width:50%;"/>
								<br>

								<?php
								if($i>0)
								{
									?>

									<table class="table table-hover m-2" style="width:100%">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Register No.</th>
												<th scope="col">Student Name</th>
												<th scope="col">Club Name</th>
												<th scope="col">Role</th>
											</tr>
										</thead>
										<?php 
										$k=0;
										while($row=$res->fetch_assoc())
										{
											?>

											<tbody id="reportTables5">
												<tr>
													<td scope="row"><?php echo ($k+1) ?></td>
													<td><?php echo $row["RegisterNo"] ?></td>
													<td><?php echo $row["Name"] ?></td>
													<td><?php echo $row["Club Name"] ?></td>
													<td><?php echo $row["Role"] ?></td>
												</tr>
											</tbody>

											<?php
											$k=$k+1;	  
										} //while
										?>
									</table>
								</div>
								<?php
							} //if($i>0)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ------------------------------12TH CARD----------------------- -->
	<?php


//---------------for graph---------
	$cc_count="select count(s.RegisterNo), cc.Name from student s, credit_course cc where s.ProgrammeID=1 and s.Year_of_Admission=2016 and s.RegisterNo=cc.Studentid group by cc.Name";
	$res=$conn->query($cc_count);

//for table
	$cc_table="select s.RegisterNo, concat(s.Firstname,' ', s.LastName) as Name, cc.Name as 'CC_Name', cc.Credits, cc.TotalMarks, cc.MarksObtained, cc.HoursConducted, cc.HoursAttended from student s, credit_course cc where s.ProgrammeID=1 and s.Year_of_Admission=2016 and s.RegisterNo=cc.Studentid";

	$res1=$conn->query($cc_table);

	$ct=0;
	while($row1=$res1->fetch_assoc())
	{
		$arr1[$ct][0]=$row1["RegisterNo"];
		$arr1[$ct][1]=$row1["Name"];
		$arr1[$ct][2]=$row1["CC_Name"];
		$arr1[$ct][3]=$row1["Credits"];
		$arr1[$ct][4]=($row1["MarksObtained"]/$row1["TotalMarks"])*100;
		$arr1[$ct][5]=($row1["HoursAttended"]/$row1["HoursConducted"])*100;
		$ct=$ct+1;

	}


	$c=0;
	while($row=$res->fetch_assoc())
	{
		$arr[$c][0]=$row["Name"];
		$arr[$c][1]=$row["count(s.RegisterNo)"];
		$c=$c+1;
	}
	?>
	<script type="text/javascript">
		google.charts.load("current", {packages:['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				["Credit Course", "Count"],

				<?php
				$k=0;
				while($k<$c)
				{
					echo "['".$arr[$k][0]."',".$arr[$k][1]."],";
					$k=$k+1;
				}

				?>

				]);

			var options = {
				title: "No. of students participating in Credit Course",
				//width: 600,
				height: 300,
				//bar: {groupWidth: "95%"},
				legend: { position: "none" },
			};
			var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
			chart.draw(data, options);
		}
	</script>
	<div class="col-4">
		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Credit Course Report</h5>
			<div class="card-body">
				<div id="columnchart_values2"></div>
				<p class="card-text">Report containing the credit course participation details of all the students of a particular course</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".cc_table">View</button>
				<div class="modal fade cc_table" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
					<div class="modal-dialog modal-lg" style="max-width: 1200px;">
						<div class="modal-content">
							<div class="modal-header" style="background-color: #73bf73;">
								<h5 class="modal-title text-light ml-4">Credit Course Report</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input class="form-control ml-3 mt-3" id="searchField6" type="text" placeholder="Search.." style="width:50%;"/>
								<br>

								<?php
								if($i>0)
								{
									?>

									<table class="table table-hover m-2" style="width:100%">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Register No.</th>
												<th scope="col">Student Name</th>
												<th scope="col">CC Name</th>
												<th scope="col">Credits</th>
												<th scope="col">Marks %</th>
												<th scope="col">Attendance %</th>
											</tr>
										</thead>
										<?php 
										$k=0;
										while($k<$ct)
										{
											?>

											<tbody id="reportTables6">
												<tr>
													<td scope="row"><?php echo ($k+1) ?></td>
													<td><?php echo $arr1[$k][0] ?></td>
													<td><?php echo $arr1[$k][1] ?></td>
													<td><?php echo $arr1[$k][2] ?></td>
													<td><?php echo $arr1[$k][3] ?></td>
													<td><?php echo $arr1[$k][4] ?></td>
													<td><?php echo $arr1[$k][5] ?></td>
												</tr>
											</tbody>

											<?php
											$k=$k+1;	  
										} //while
										?>
									</table>
								</div>
								<?php
							} //if($i>0)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- -----------------13TH CARD---------------- -->
	<?php


//for graph
	$internship_count="select count(i.StudentID), c.CompanyName from student s, internships i, company c where s.ProgrammeID=1 and s.Year_of_Admission=2016 and i.CompanyID=c.idCompany and s.RegisterNo=i.StudentID group by CompanyID";
	$res=$conn->query($internship_count);

//for table
	$internship_table="select s.RegisterNo, concat(s.Firstname,' ', s.LastName) as Name, c.CompanyName, i.WorkDescription, i.StartDate, i.EndDate, i.Role from student s, internships i, company c where s.ProgrammeID=1 and s.Year_of_Admission=2016 and s.RegisterNo=i.StudentID and i.CompanyID=c.idCompany";
	$res1=$conn->query($internship_table);

	$d=0;
	while($row=$res->fetch_assoc())
	{
		$arr[$d][0]=$row["CompanyName"];
		$arr[$d][1]=$row["count(i.StudentID)"];
		$d=$d+1;
	}

	?>
	<script type="text/javascript">
		google.charts.load("current", {packages:['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				["Company", "Count"],

				<?php
				$k=0;
				while($k<$d)
				{
					echo "['".$arr[$k][0]."',".$arr[$k][1]."],";
					$k=$k+1;
				}

				?>

				]);

			var options = {
				title: "Internship - no. of students per company",
				//width: 600,
				height: 300,
				//bar: {groupWidth: "95%"},
				legend: { position: "none" },
			};
			var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values3"));
			chart.draw(data, options);
		}
	</script>
	<div class="col-4">
		<div class="card shadow-lg bg-white rounded">
			<h5 class="card-header">Internship Report</h5>
			<div class="card-body">
				<div id="columnchart_values3"></div>
				<p class="card-text">Report containing the internship details of all the students of a particular course</p>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".interns_table">View</button>
				<div class="modal fade interns_table" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
					<div class="modal-dialog modal-lg" style="max-width: 1200px;">
						<div class="modal-content">
							<div class="modal-header" style="background-color: #73bf73;">
								<h5 class="modal-title text-light ml-4">Internship Report</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input class="form-control ml-3 mt-3" id="searchField7" type="text" placeholder="Search.." style="width:50%;"/>
								<br>

								<?php
								if($i>0)
								{
									?>

									<table class="table table-hover m-2" style="width:100%">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Register No.</th>
												<th scope="col">Student Name</th>
												<th scope="col">Company Name</th>
												<th scope="col">Work Description</th>
												<th scope="col">Start Date</th>
												<th scope="col">End Date</th>
												<th scope="col">role</th>
											</tr>
										</thead>
										<?php 
										$k=0;
										while($row1=$res1->fetch_assoc())
										{
											?>

											<tbody id="reportTables7">
												<tr>
													<td scope="row"><?php echo ($k+1) ?></td>
													<td><?php echo $row1["RegisterNo"] ?></td>
													<td><?php echo $row1["Name"] ?></td>
													<td><?php echo $row1["CompanyName"] ?></td>
													<td><?php echo $row1["WorkDescription"] ?></td>
													<td><?php echo $row1["StartDate"] ?></td>
													<td><?php echo $row1["EndDate"] ?></td>
													<td><?php echo $row1["Role"] ?></td>
												</tr>
											</tbody>

											<?php
											$k=$k+1;	  
										} //while
										?>
									</table>
								</div>
								<?php
							} //if($i>0)?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- 6th row-->

<?php
} //if(course==1)

else
{
	include 'modal_unsuccess_reports.html';
}

} #if (isset($_POST["submit"]))
?>

</div>
</body>
</html>