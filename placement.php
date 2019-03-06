<?php

require("db.php");


// ------------------------FOR STATISTICS-------------------------
$applicants="Select count(distinct Studentid) as si from placements";
$app_res=$conn->query($applicants);
$app_row=$app_res->fetch_assoc();

$selects="SELECT COUNT(p.Studentid) from placements p,company c where p.rounds_qualified=c.No_of_rounds_conducted and p.companyid = c.idCompany";
$sel_res=$conn->query($selects);
$sel_row=$sel_res->fetch_assoc();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Placements Reports</title>
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
	.modal-dialog-e
	{
		position: relative;
		display: table; 
		/*overflow-y: auto;    */
		overflow-x: auto;
		width: auto;
		min-width: 300px;   
		overflow-y: initial !important
	}
	.modal-body-e
	{
		height: 450px;
		overflow-y: auto;
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
</script>
</head>

<body>
	<div class="container-fluid row m-0 p-0" style="overflow-x: hidden;">
		<nav class="navbar navbar-expand-lg justify-content-between sticky-top sticky-offset" style="position: fixed;width: 100%;top: 0; background-color: #dcefdc;">
			<!-- <div class="container-fluid"> -->
				<div class="navbar-header">
					<a href="index.html">
						<img src="logo_green.png" alt="SACPA" height="50px"/>
					</a>
				</div>
				<!-- </div> -->
			</nav>

			<div class="row w-100 m-0" style="padding-top: 75px;">
				<div class="col-7 p-4">
					<div class="card-deck">
						<!-- -------------------------------------------CARD 1---------------------------------------------------->
						<!-- pie chart for card 1 -->
						<?php
						$que = "SELECT company.CompanyName, COUNT(placements.Studentid) from company, placements where placements.rounds_qualified = company.No_of_rounds_conducted and placements.companyid =company.idCompany GROUP by company.CompanyName";
						$res5 = $conn->query($que);
						?>
						<script type="text/javascript">
							google.charts.load('current', {'packages':['corechart']});
							google.charts.setOnLoadCallback(drawChart);

							function drawChart() {

								var data = google.visualization.arrayToDataTable([
									['Company', 'Selected Candidates'],
									<?php
									while($row=$res5->fetch_assoc())
									{
										echo "['".$row["CompanyName"]."',".$row["COUNT(placements.Studentid)"]."],";
									}
									?>
									]);

								var options = {
									title: 'Selected Candidates'
								};

								var chart = new google.visualization.PieChart(document.getElementById('piechart'));

								chart.draw(data, options);
							}
						</script>

						<?php
				// ----------FOR TABLE1-------
						$list="SELECT placements.Studentid,concat(student.FirstName,' ',student.LastName) as Name,company.CompanyName,company.Role,company.CTC_or_Stipend FROM placements, company, student where placements.rounds_qualified = company.No_of_rounds_conducted and placements.companyid = company.idCompany and placements.Studentid = student.RegisterNo";
						$res=$conn->query($list);
						?>
						<div class="card shadow-lg bg-white rounded">
							<h5 class="card-header">Students - Placed</h5>
							<div class="card-body">
								<div id="piechart"></div>
								<p class="card-text">Report containing details of students who have been placed.</p>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".placed_students_table">View</button>
								<div class="modal fade placed_students_table" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
									<div class="modal-dialog modal-lg" style="max-width:1000px;">
										<div class="modal-content">
											<div class="modal-header bg-info">
												<h5 class="modal-title">List of Placed Students</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body modal-body-e">
												<input class="form-control ml-3 mt-3" id="searchField1" type="text" placeholder="Search.." style="width:50%;"/>
												<br>


												<!-- if($i>0) -->
												<!-- { -->


												<table class="table table-hover m-2" style="max-width:1100px;">
													<thead>
														<tr>
															<th scope="col">#</th>
															<th scope="col">Register Number</th>
															<th scope="col">Name</th> 
															<th scope="col">Company Name</th>
															<th scope="col">Role Offered</th>
															<th scope="col">CTC/Stipend</th>
														</tr>
													</thead>

													<?php 
													$k=0;
													while($row=$res->fetch_assoc())
													{
														?>
														<tbody id="reportTables">
															<tr>
																<th scope="row"><?php echo($k+1) ?></th>
																<td><?php echo $row["Studentid"]?></td>
																<td><?php echo $row["Name"]?></td>
																<td><?php echo $row["CompanyName"]?></td>
																<td><?php echo $row["Role"]?></td>
																<td><?php echo $row["CTC_or_Stipend"]?></td>
															</tr>
														</tbody>
														<?php
														$k=$k+1;
											}//while
											?>
										</table>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- -------------------------------------------CARD 2-------------------------------------------------- -->
				<?php
				$t=0;$g=0;$a=0;

				$q="select p.Studentid,concat(s.FirstName,' ',s.LastName) as Name, SUM(p.rounds_qualified),SUM(c.No_of_rounds_conducted) from placements p, company c, student s where p.companyid = c.idCompany and p.Studentid NOT IN (SELECT p1.Studentid from placements p1, company c1 where p1.rounds_qualified = c1.No_of_rounds_conducted and p1.companyid = c1.idCompany) and p.Studentid = s.RegisterNo GROUP BY p.Studentid";
				$res = $conn->query($q);

				$i=0;
				while($row = $res->fetch_assoc())
				{
					$rate[$i][0] = $row["Studentid"];
					$rate[$i][1] = $row["Name"]; 
					$rate[$i][2] = round(($row["SUM(p.rounds_qualified)"]/$row["SUM(c.No_of_rounds_conducted)"]) * 100,2);
					if($rate[$i][2] >= 50)
					{
						$rate[$i][3] = "Technical/HR Interview";
						$t=$t+1;
					}
					else if($rate[$i][2] >= 30)
					{
						$rate[$i][3] = "Group Discussion";
						$g=$g+1;
					}
					else
					{
						$rate[$i][3] = "Aptitude";
						$a=$a+1;
					}

					$i=$i+1;
				}
				?>
				<!-- pie chart for card 2 -->
				<script type="text/javascript">
					google.charts.load('current', {'packages':['corechart']});
					google.charts.setOnLoadCallback(drawChart);

					function drawChart() {

						var data = google.visualization.arrayToDataTable([
							['Category', 'No of Students'],
							['Aptitude',<?php echo $a; ?>],
							['Group Discussion',<?php echo $g; ?>],
							['Technical/HR Interview',<?php echo $t; ?>]
							]);

						var options = {
							title: 'Student Requirement'
						};

						var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

						chart.draw(data, options);
					}
				</script>

				<div class="card shadow-lg bg-white rounded">
					<h5 class="card-header">Students - Requirements</h5>
					<div class="card-body">
						<div id="piechart2"></div>
						<p class="card-text">Report containing details of students who are not placed yet.</p>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".notplaced_students_table">View</button>
						<div class="modal fade notplaced_students_table" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
							<div class="modal-dialog modal-lg" style="max-width:1000px;">
								<div class="modal-content">
									<div class="modal-header bg-info">
										<h5 class="modal-title">List of Not Placed Students</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body modal-body-e">
										<input class="form-control ml-3 mt-3" id="searchField2" type="text" placeholder="Search.." style="width:50%;"/>

										<br>

										<?php
										if($i>0)
										{
											?>

											<table class="table table-hover m-2" style="max-width:1100px;">
												<thead>
													<tr>
														<th scope="col">#</th>
														<th scope="col">Register Number</th>
														<th scope="col">Name</th> 
														<th scope="col">Qualification Rate</th>
														<th scope="col">Needs help in -</th>
													</tr>
												</thead>

												<?php 
												$k=0;
												while($k<$i)
												{
													?>
													<tbody id="reportTables">
														<tr>
															<th scope="row"><?php echo($k+1) ?></th>
															<td><?php echo $rate[$k][0] ?></td>
															<td><?php echo $rate[$k][1] ?></td>
															<td><?php echo $rate[$k][2] ?></td>
															<td><?php echo $rate[$k][3] ?></td>

														</tr>
													</tbody>
													<?php
													$k=$k+1;
											}//while
											?>
										</table>
										<?php
										} //if($i>0)
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- -------------------------------------PHP FOR GRAPHS---------------------------------- -->
			<?php
			$q1 = "Select p.companyid,c.CompanyName, sum(c.No_of_rounds_conducted), sum(p.rounds_qualified),count(p.Studentid) from placements p, company c where p.rounds_qualified > 0 and p.companyid =c.idCompany group by c.CompanyName ORDER BY p.companyid ASC";
			$res1 = $conn->query($q1);

			$q2 = "Select p.companyid,count(p.Studentid) from placements p, company c where c.No_of_rounds_conducted = p.rounds_qualified and p.companyid=c.idCompany group by p.companyid order by p.companyid ASC";
			$res2 = $conn->query($q2);

			$i=0;

			while($row1 = $res1->fetch_assoc())
			{
				$arr[$i][0] = $row1["CompanyName"];
				$arr[$i][1] = $row1["sum(p.rounds_qualified)"];
				$arr[$i][2] = $row1["sum(c.No_of_rounds_conducted)"];
				$arr[$i][3] = $row1["count(p.Studentid)"];
				$arr[$i][4] = $row1["companyid"];
				$i=$i+1;
			}
			$k=0;
			while($row2 = $res2->fetch_assoc())
			{
				$temp[$k][0] = $row2["companyid"];
				$temp[$k][1] = $row2["count(p.Studentid)"];
				$k=$k+1;
			}
			$u=0;$j=0;
			$temp[$k][0]=0;$temp[$k][1]=0;
			while(($u < $i) || ($j < $k))
			{
				if($arr[$u][4]==$temp[$j][0])
				{
					$arr[$u][5]=$temp[$j][1];
					$u=$u+1;
					$j=$j+1;
					continue;
				}
				else
				{
					$arr[$u][5]=0;
					$u=$u+1;
					//$j=$j+1;
				}
			}
			?>
			<div class="card-deck mt-3">
<!-- -------------------------------------------CARD 3-------------------------------------------------- -->
				<script type="text/javascript">
					google.charts.load('current', {'packages':['bar']});
					google.charts.setOnLoadCallback(drawChart);
					var chart
					var data
					var options
					function drawChart() {
						data = google.visualization.arrayToDataTable([
							['Company', 'Appeared', 'Selected'],
							<?php
							$k=0;
							while($k<$i)
							{
								echo "['".$arr[$k][0]."',".(int)$arr[$k][3].",".(int)$arr[$k][5]."],";
								$k=$k+1;
							}
							?>
							]);

						options = {
							chart: {
								title: 'Placement Details',
								subtitle: 'Selected and Appeared Candidates for each Company'
							}
						};

					}
					function renderChart(){
						setTimeout(function(){
							chart = new google.charts.Bar(document.getElementById('columnchart_material'));
							chart.draw(data, google.charts.Bar.convertOptions(options));
						}, 400);
					}
				</script>
				<div class="card shadow-lg bg-white rounded">
					<h5 class="card-header">Company - Data Graph</h5>
					<div class="card-body">
						<p class="card-text">Graph representing total number of students appeared and selected for all the companies.</p>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".graph1" onclick="renderChart()">View</button>
						<div class="modal fade graph1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
							<div class="modal-dialog modal-lg" style="max-width: 1100px;">
								<div class="modal-content">
									<div class="modal-header bg-info">
										<h5 class="modal-title">Company vs Selected</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div id="columnchart_material" style="max-width: 1100px; height: 400px;" class="p-3"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
<!-- ---------------------------------------------------------CARD 4------------------------------------------------------->
				<?php
					$k=0;
					while($k<$i)
					{
						$temp = ($arr[$k][1]/$arr[$k][2])*100;
						$extra[$k][0]=$arr[$k][0];
						$extra[$k][1]=$arr[$k][5];
						$extra[$k][2]=$arr[$k][3];
						$extra[$k][3]=$temp;
					}

					

				?>
				<script type="text/javascript">
					google.charts.load('current', {'packages':['bar']});
					google.charts.setOnLoadCallback(drawChart1);
					var chart1
					var data1
					var options1
					function drawChart1() {
						data1 = google.visualization.arrayToDataTable([
							['Company', 'Selected', 'Participated','Round Qualified - Percentage'],
							<?php
							$k=0;
							while($k<$i)
							{
								$temp = ($arr[$k][1]/$arr[$k][2])*100;

								echo "['".$arr[$k][0]."',".(int)$arr[$k][5].",".(int)$arr[$k][3].",".(float)$temp."],";
								$k=$k+1;
							}
							?>
							]);

						options1 = {
							chart1: {
								title: 'Placement Information',
								subtitle: 'RUBRICS -- >=50 Interview || >=30 Group Discussion || >=0 Aptitude'
							}
							
						};

					}
					function renderChart1(){
						setTimeout(function(){
							chart1 = new google.charts.Bar(document.getElementById('columnchart_material2'));

							chart1.draw(data1, google.charts.Bar.convertOptions(options1));
						}, 400);
					}
				</script>   
				<div class="card shadow-lg bg-white rounded">
					<h5 class="card-header">Qualification Rate - Company wise</h5>
					<div class="card-body">
						<p class="card-text">Graph containing the qualification percentage of students per company.</p>
						<br>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".graph2" onclick="renderChart1()">View</button>
						<div class="modal fade graph2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
							<div class="modal-dialog modal-lg" style="max-width: 1100px;">
								<div class="modal-content">
									<div class="modal-header bg-info">
										<h5 class="modal-title">Company vs Qualified Percentage</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="alert alert-secondary" role="alert">
											RUBRICS -->=50 Interview || >=30 Group Discussion || >=0 Aptitude
										</div>
										<div id="columnchart_material2" style="max-width: 1100px; height: 400px;"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- </div> -->
		</div>

		<div class="col-5 p-4">
			<div class="alert alert-success shadow-sm rounded">
				<p><strong>Total Applicants - </strong><?php echo $app_row["si"] ?> </p>
				<p><strong>Total Selected Applicants - </strong><?php echo $sel_row["COUNT(p.Studentid)"] ?> </p>
				<p><strong>Not Selected - </strong><?php echo ($app_row["si"]-$sel_row["COUNT(p.Studentid)"]) ?></p>
				<p><strong>Selected Percentage - </strong><?php echo round(( $sel_row["COUNT(p.Studentid)"]/$app_row["si"] * 100 )) ?>%</p>
				<p><strong>Not Selected Percentage - </strong><?php echo round(( ($app_row["si"]-$sel_row["COUNT(p.Studentid)"])/$app_row["si"] * 100 ),2) ?>%</p>
				<br>
				<p><strong>No. of students requiring help in- </strong></p>
				<p>&nbsp; &nbsp;<b><i>Aptitude - </i></b><?php echo $a?></p>
				<p>&nbsp; &nbsp;<b><i>Group Discussion - </i></b><?php echo $g?></p>
				<p>&nbsp; &nbsp;<b><i>Tech/HR Interview - </i></b><?php echo $t?></p>
			</div>
		</div>
	</div>
</div>

</body>
</html>