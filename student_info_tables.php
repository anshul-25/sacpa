<?php

require ("db.php");

if(isset($_POST["submit"]))
{
	$register = $_POST["inputRegisterNo"];
	$name = "Select FirstName, LastName, EmailIdPersonal from student where RegisterNo = ".$register;
	$activity = "Select a.Name,a.Role,at.Type_Name from activity a, activity_type at where a.Type = at.idActivity_type and Studentid =".$register;
	$class10 = "Select Stream, Board, Total_Marks, Marks_obt from class10 where studentid =".$register;
	$class12 = "Select Stream, Board, Total_marks, Marks_Obt from class12 where Studentid =".$register;
	$clubs = "Select Name,Role from clubs_organisations where Studentid =".$register;
	$cc = "Select Name,Credits, TotalMarks, MarksObtained from credit_course where Studentid =".$register;
	$internships = "Select c.CompanyName, i.Role from company c, internships i where i.CompanyID = c.idCompany and StudentID =".$register;
	$mevents = "Select Name, Role from managed_events where Studentid =".$register;
	$pevents = "Select name,position,location from participated_events where StudentId =".$register;
	$prog = "Select p.Course_Name from student s, programme p where s.ProgrammeID = p.idCourse and s.RegisterNo =".$register;
	$placement = "Select * from placements where Studentid =".$register;

	//name
	$res = $conn->query($name); 
	$row=$res->fetch_assoc(); 
	$name2 = $row["FirstName"]." ".$row["LastName"];
	$email=$row["EmailIdPersonal"];

	//class10
	$res = $conn->query($class10); 
	$row=$res->fetch_assoc(); 
	$c[0] = $row["Stream"];
	$c[1] = $row["Board"];
	$c[3] = ($row["Marks_obt"]/$row["Total_Marks"])*100;

	//class12
	$res = $conn->query($class12); 
	$row=$res->fetch_assoc(); 
	$c2[0] = $row["Stream"];
	$c2[1] = $row["Board"];
	$c2[3] = ($row["Marks_Obt"]/$row["Total_marks"])*100;

	//course
	$res=$conn->query($prog);
	$row = $res->fetch_assoc();
	$course=$row["Course_Name"];

	//activity
	$i=0;
	$res=$conn->query($activity);
	if($res->num_rows > 0)
	{
		while($row = $res->fetch_assoc())
		{
			$act[$i][0]=$row["Name"];
			$act[$i][1]=$row["Role"];
			$act[$i][2]=$row["Type_Name"];
			$i=$i+1;
		}
	}

	//clubs
	$j=0;
	$res=$conn->query($clubs);
	if($res->num_rows > 0)
	{
		while($row = $res->fetch_assoc())
		{
			$cl[$j][0]=$row["Name"];
			$cl[$j][1]=$row["Role"];
			$j=$j+1;
		}
	}

	//cc
	$l=0;
	$res=$conn->query($cc);
	if($res->num_rows > 0)
	{
		while($row = $res->fetch_assoc())
		{
			$cc1[$l][0]=$row["Name"];
			$cc1[$l][1]=$row["Credits"];
			$cc1[$l][2]=($row["MarksObtained"]/$row["TotalMarks"])*100;
			$l=$l+1;
		}
	}

	//internships
	$m=0;
	$res=$conn->query($internships);
	if($res->num_rows > 0)
	{
		while($row = $res->fetch_assoc())
		{
			$in[$m][0]=$row["CompanyName"];
			$in[$m][1]=$row["Role"];
			$m=$m+1;
		}
	}

	//managed events
	$n=0;
	$res=$conn->query($mevents);
	if($res->num_rows > 0)
	{
		while($row = $res->fetch_assoc())
		{
			$me[$n][0]=$row["Name"];
			$me[$n][1]=$row["Role"];
			$n=$n+1;
		}
	}

	//participated events
	$o=0;
	$res=$conn->query($pevents);
	if($res->num_rows > 0)
	{
		while($row = $res->fetch_assoc())
		{
			$pe[$o][0]=$row["name"];
			$pe[$o][1]=$row["position"];
			$pe[$o][2]=$row["location"];
			$o=$o+1;
		}
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Student Info</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<style type="text/css">
	.card {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		max-width: 300px;
		margin: auto;
		text-align: center;
		font-family: arial;
		align-items: center;
		height: 100vh;
	}

	.title {
		color: grey;
		font-size: 18px;
	}
	.sticky-offset {
    top: 56px;
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
</script>

</head>

<body style="overflow-y: hidden;">
	<div class="container-fluid row">
		<!-- --------------TOP NAV BAR------------- -->
		<nav class="navbar navbar-light justify-content-between sticky-top sticky-offset" style="position: fixed;width: 100%;top: 0; background-color: #dcefdc">
			<a href="http:\\localhost\sacpa\index.html">
				<img src="http:\\localhost\sacpa\logo_green.png" alt="SACPA" height="50px"/>
			</a>
			<form class="form-inline" id="myform" action="#" method="POST">
				<input class="form-control mr-sm-2" name="inputRegisterNo" type="text" placeholder="Register No." aria-label="registerno" pattern="[0-9]{7}" required>
				<button class="btn btn-outline-success my-2 my-sm-0" type="Submit" name="submit">Submit</button>
			</form>
		</nav>

		<?php
		if(isset($_POST["submit"]))
		{
		// ------------------------SIDE PROFILE--------------------------
		echo "
		<div id=\"maincontainer\" class=\"container-fluid row\" style=\"padding-top: 75px;\">
			<div class=\"col-3 bg-light m-0\">
				<div class=\"card p-3\">
					<img src=\"http:\\\\localhost\sacpa\outline_avatar.png\" alt=\"Photo\" style=\"max-width: 100%; vertical-align: middle;height: auto;\">
					<h1>".$name2."</h1>
					<p class=\"title\">".$register."</p>
					<p>".$course."</p>
					<p>".$email."</p>
				</div>
			</div>";



	// 		<!-- ------------------------SIDE CONTENTS----------------------------------------------- -->
	//      <!-- ------------------------NAV TABS---------------------------------------------------- -->
			echo "
			<div class=\"col-9\">
			
			<ul class=\"nav nav-tabs\" role=\"tablist\">
				<li class=\"nav-item\">
					<a href=\"#PUTable\" class=\"nav-link active\" role=\"tab\" data-toggle=\"tab\" aria-expanded=\"true\">Pre-University</a>
				</li>
				<li class=\"nav-item\">
					<a href=\"#activityTable\" class=\"nav-link\" role=\"tab\" data-toggle=\"tab\">Activity</a>
				</li>
				<li class=\"nav-item\">
					<a href=\"#clubsTable\" class=\"nav-link\" role=\"tab\" data-toggle=\"tab\">Clubs</a>
				</li>

				<li class=\"nav-item\">
					<a href=\"#CCTable\" class=\"nav-link\" role=\"tab\" data-toggle=\"tab\">Credit Course</a>
				</li>

				<li class=\"nav-item\">
					<a href=\"#internshipsTable\" class=\"nav-link\" role=\"tab\" data-toggle=\"tab\">Internships</a>
				</li>

				<li class=\"nav-item\">
					<a href=\"#managedEventsTable\" class=\"nav-link\" role=\"tab\" data-toggle=\"tab\">Managed Events</a>
				</li>

				<li class=\"nav-item\">
					<a href=\"#participatedEventsTable\" class=\"nav-link\" role=\"tab\" data-toggle=\"tab\">Participated Events</a>
				</li>
			</ul>";

	// 		<!-- ----TAB CONTENTS---- -->
			echo "
			<div class=\"tab-content\" id=\"nav-contents\">
				<div id=\"PUTable\" class=\"tab-pane fade show active\" role=\"tabpanel\" aria-labelledby=\"PU-tab\">
					<div class=\"container row mt-3 p-0\" style=\"width:70%;\">
						<div class=\"card border-primary mb-3 col-sm-6 p-0\" style=\"height:100%;\">
							<div class=\"class-header p-3 bg-light\" style=\"width:100%;\">CLASS 10</div>
							<div class=\"class-body text-primary p-3\">
								<p class=\"card-text\"><strong>Board: </strong>".$c[1]."</p>
								<p class=\"card-text\"><strong>Stream: </strong>".$c[0]."</p>
								<p class=\"card-text\"><strong>Marks: </strong>".$c[3]."</p>
							</div>
						</div>
						<div class=\"card border-primary mb-3 col-sm-6 p-0\" style=\"height:100%;\">
							<div class=\"class-header p-3 bg-light\" style=\"width:100%;\">CLASS 12</div>
							<div class=\"class-body text-primary p-3\">
								<p class=\"card-text\"><strong>Board: </strong>".$c2[1]."</p>
								<p class=\"card-text\"><strong>Stream: </strong>".$c2[0]."</p>
								<p class=\"card-text\"><strong>Marks: </strong>".$c2[3]."</p>
							</div>
						</div>
					</div>
				</div>

				<div id=\"activityTable\" class=\"tab-pane fade\" role=\"tabpanel\" aria-labelledby=\"activity-tab\">
				<input class=\"form-control m-2\" id=\"searchField1\" type=\"text\" placeholder=\"Search..\">
  				<br>";
					if($i>0)
					{
						echo "<table class=\"table table-hover m-3\" style=\"width:90%\">
						<thead>
						<tr>
						<th scope=\"col\">#</th>
						<th scope=\"col\">Name</th>
						<th scope=\"col\">Role</th> 
						<th scope=\"col\">Type</th>
						</tr>
						</thead>";$k=0;
						while($k < $i)
						{
							echo "
							<tbody id=\"reportTables1\">
							<tr>
							<th scope=\"row\">".($k+1)."</th>
							<td>".$act[$k][0]."</td>
							<td>".$act[$k][1]."</td>
							<td>".$act[$k][2]."</td>
							</tr>
							</tbody>";
							$k=$k+1;	  
						} //while
						echo "</table>";
					} //if($i>0)
					else
					{
						echo "<div class=\"alert alert-danger m-3\">
    						<strong>No Research/Project!</strong>
  						</div>";
					}
				echo "</div>

				<div id=\"clubsTable\" class=\"tab-pane fade\" role=\"tabpanel\" aria-labelledby=\"clubs-tab\">
				<input class=\"form-control m-2\" id=\"searchField2\" type=\"text\" placeholder=\"Search..\">
  				<br>";
					if($j>0)
					{
						
						echo "<table class=\"table table-hover m-3\" style=\"width:90%\">
						<thead>
						<tr>
						<th scope=\"col\">#</th>
						<th scope=\"col\">Name</th>
						<th scope=\"col\">Role</th> 
						</tr>
						</thead>";$k=0;
						while($k < $j)
						{
							echo "
							<tbody id=\"reportTables2\">
							<tr>
							<th scope=\"row\">".($k+1)."</th>
							<td>".$cl[$k][0]."</td>
							<td>".$cl[$k][1]."</td>
							</tr>
							</tbody>";
							$k=$k+1;	  
						} //while
						echo "</table>";
					} //if($j>0)
					else
					{
						echo "<div class=\"alert alert-danger m-3\">
    						<strong>No Clubs/Organisation!</strong>
  						</div>";
					}
				echo "</div>

				<div id=\"CCTable\" class=\"tab-pane fade\" role=\"tabpanel\" aria-labelledby=\"CC-tab\">
				<input class=\"form-control m-2\" id=\"searchField3\" type=\"text\" placeholder=\"Search..\">
  				<br>";
					if($l>0)
					{
						
						echo "<table class=\"table table-hover m-3\" style=\"width:90%\">
						<thead>
						<tr>
						<th scope=\"col\">#</th>
						<th scope=\"col\">Name</th>
						<th scope=\"col\">Credits</th> 
						<th scope=\"col\">Marks</th> 
						</tr>
						</thead>";$k=0;
						while($k < $l)
						{
							echo "
							<tbody id=\"reportTables3\">
							<tr>
							<th scope=\"row\">".($k+1)."</th>
							<td>".$cc1[$k][0]."</td>
							<td>".$cc1[$k][1]."</td>
							<td>".$cc1[$k][2]."</td>
							</tr>
							</tbody>";
							$k=$k+1;	  
						} //while
						echo "</table>";
					} //if($j>0)
					else
					{
						echo "<div class=\"alert alert-danger m-3\">
    						<strong>No Credit Course!</strong>
  						</div>";
					}
				echo "</div>

				<div id=\"internshipsTable\" class=\"tab-pane fade\" role=\"tabpanel\" aria-labelledby=\"internships-tab\">
				<input class=\"form-control m-2\" id=\"searchField4\" type=\"text\" placeholder=\"Search..\">
  				<br>";
				if($m>0)
					{
						
						echo "<table class=\"table table-hover m-3\" style=\"width:90%\">
						<thead>
						<tr>
						<th scope=\"col\">#</th>
						<th scope=\"col\">Company Name</th>
						<th scope=\"col\">Role</th> 
						</tr>
						</thead>";$k=0;
						while($k < $m)
						{
							echo "
							<tbody id=\"reportTables4\">
							<tr>
							<th scope=\"row\">".($k+1)."</th>
							<td>".$in[$k][0]."</td>
							<td>".$in[$k][1]."</td>
							</tr>
							</tbody>";
							$k=$k+1;	  
						} //while
						echo "</table>";
					} //if($j>0)
					else
					{
						echo "<div class=\"alert alert-danger m-3\">
    						<strong>No Internships!</strong>
  						</div>";
					}
				echo "</div>

				<div id=\"managedEventsTable\" class=\"tab-pane fade\" role=\"tabpanel\" aria-labelledby=\"managedEvents-tab\">
				<input class=\"form-control m-2\" id=\"searchField5\" type=\"text\" placeholder=\"Search..\">
  				<br>";
					if($n>0)
					{
						
						echo "<table class=\"table table-hover m-3\" style=\"width:90%\">
						<thead>
						<tr>
						<th scope=\"col\">#</th>
						<th scope=\"col\">Event Name</th>
						<th scope=\"col\">Role</th> 
						</tr>
						</thead>";$k=0;
						while($k < $n)
						{
							echo "
							<tbody id=\"reportTables5\">
							<tr>
							<th scope=\"row\">".($k+1)."</th>
							<td>".$me[$k][0]."</td>
							<td>".$me[$k][1]."</td>
							</tr>
							</tbody>";
							$k=$k+1;	  
						} //while
						echo "</table>";
					} //if($j>0)
					else
					{
						echo "<div class=\"alert alert-danger m-3\">
    						<strong>No Managed Events!</strong>
  						</div>";
					}
				echo "</div>

				<div id=\"participatedEventsTable\" class=\"tab-pane fade\" role=\"tabpanel\" aria-labelledby=\"participatedEvents-tab\">
				<input class=\"form-control m-2\" id=\"searchField6\" type=\"text\" placeholder=\"Search..\">
  				<br>";
					if($o>0)
					{
						
						echo "<table class=\"table table-hover m-3\" style=\"width:90%\">
						<thead>
						<tr>
						<th scope=\"col\">#</th>
						<th scope=\"col\">Event Name</th>
						<th scope=\"col\">Position</th> 
						<th scope=\"col\">Location</th> 
						</tr>
						</thead>";$k=0;
						while($k < $o)
						{
							echo "
							<tbody id=\"reportTables6\">
							<tr>
							<th scope=\"row\">".($k+1)."</th>
							<td>".$pe[$k][0]."</td>
							<td>".$pe[$k][1]."</td>
							<td>".$pe[$k][2]."</td>
							</tr>
							</tbody>";
							$k=$k+1;	  
						} //while
						echo "</table>";
					} //if($j>0)
					else
					{
						echo "<div class=\"alert alert-danger m-3\">
    						<strong>No Participated Events!</strong>
  						</div>";
					}
				echo "</div>

			</div>
		</div>
	</div>";
	}
	?>
</div>
</body>
</html>