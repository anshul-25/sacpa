<?php 
	require("db.php");

	if (isset($_POST["submit"])) 
	{
		$course = $_POST["inputCourse"];
		// $courseid = "select idCourse from programme where Course_Name = \"".$course."\"";
		
		// $res = $conn->query($courseid);
		// $row=$res->fetch_assoc();

		$studInfo = "select RegisterNo, FirstName, MiddleName, LastName, PhoneNo, EmailIdPersonal, ReservationCategory, Year_of_Admission from student s where s.ProgrammeID =" .$course;



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

	}//if(isset($_POST["submit"]))
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
	<style type="text/css">
		.sticky-offset {
    		top: 56px;
    	}

    	.nav-item
    	{
    		color: #5CB85C
    	}

    .modal-dialog{
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
			$("#searchField").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#reportTables tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});

		
	</script>
</head>

<body>
	<div class="container-fluid row m-0 p-0">
		<nav class="navbar navbar-expand-lg justify-content-between sticky-top sticky-offset" style="position: fixed;width: 100%;top: 0; background-color: #dcefdc;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="http:\\localhost\sacpa\index.html">
						<img src="http:\\localhost\sacpa\logo_green.png" alt="SACPA" height="50px"/>
					</a>
				</div>
				<form class="form-inline" id="myform" action="#" method="POST">
					<!-- <input class="form-control mr-sm-2" name="inputCourse" type="text" placeholder="Enter Course" aria-label="course" required> -->
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
				<!-- <div id="studentInfoTable" style="padding-top: 75px;"> -->
				<!-- <input class="form-control ml-3" id="searchField" type="text" placeholder="Search.." style="width:50%;"/>
  				<br>
 -->
						<div class="card-deck m-3" style="padding-top: 75px;">
							<div class="card">
								<h5 class="card-header">Personal Information Report</h5>
								<div class="card-body">
									<p class="card-text">Report containing the personal details of all the students of a particular course</p>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".studentInfoTable">View</button>
									<div class="modal fade studentInfoTable" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 75px;">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												 <div class="modal-header">
											        <h5 class="modal-title">Personal Information Report</h5>
											        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          <span aria-hidden="true">&times;</span>
											        </button>
											      </div>
												<input class="form-control ml-3 mt-3" id="searchField" type="text" placeholder="Search.." style="width:50%;"/>
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

							<div class="card">
								<h5 class="card-header">Academics Report</h5>
								<div class="card-body">
									<p class="card-text">Report containing the Academic details of all the students of a particular course</p>
									<a href="#" class="btn btn-primary">View</a>
								</div>
							</div>

							<div class="card">
								<h5 class="card-header">Attendance Report</h5>
								<div class="card-body">
									<p class="card-text">Report containing the attendance details of all the students of a particular course</p>
									<a href="#" class="btn btn-primary">View</a>
								</div>
							</div>
						</div>
			<?php
			} #if (isset($_POST["submit"]))
		?>
	</div>
</body>
</html>