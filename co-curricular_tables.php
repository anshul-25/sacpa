<?php

require("db.php");

$activity = "select activity.Studentid, CONCAT(student.FirstName,\" \",student.LastName) as FullName, activity_type.Type_Name, activity.Name, activity.Role from activity,activity_type,student where student.RegisterNo = activity.Studentid and activity.Type = activity_type.idActivity_type and student.ProgrammeID=1 and student.Year_of_Admission=2016";

$clubs = "SELECT clubs_organisations.Studentid, concat(student.FirstName,\" \",student.LastName) as FullName, clubs_organisations.Name,clubs_organisations.Role from clubs_organisations,student where student.RegisterNo = clubs_organisations.Studentid and student.ProgrammeID=1 and student.Year_of_Admission=2016";

$credit_course = "SELECT credit_course.Studentid, concat(student.FirstName,\" \",student.LastName) as FullName, credit_course.Name, credit_course.Credits, ((credit_course.MarksObtained/credit_course.TotalMarks)*100) as mar, ((credit_course.HoursAttended/credit_course.HoursConducted)*100) as att FROM credit_course,student where credit_course.Studentid = student.RegisterNo and student.ProgrammeID=1 and student.Year_of_Admission=2016";

$internships = "SELECT internships.StudentID, concat(student.FirstName,\" \",student.LastName) as FullName, company.CompanyName, internships.Role, internships.WorkDescription from internships,student,company where company.idCompany = internships.CompanyID and internships.StudentID = student.RegisterNo and student.ProgrammeID=1 and student.Year_of_Admission=2016";

$managed_events = "SELECT managed_events.Studentid, concat(student.FirstName,\" \",student.LastName) as FullName, managed_events.Name,managed_events.Role from managed_events,student where managed_events.Studentid = student.RegisterNo and student.ProgrammeID=1 and student.Year_of_Admission=2016";

$participated_events = "SELECT participated_events.StudentId, concat(student.FirstName,\" \",student.LastName) as FullName, participated_events.name, participated_events.position, participated_events.location from participated_events,student where participated_events.StudentId = student.RegisterNo and student.ProgrammeID=1 and student.Year_of_Admission=2016";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tables</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

	<!---------- 	activity table---------- -->
	<br><h5> Activity Table </h5><br>
	<table class="table table-hover m-2" style="width:100%">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Register No</th>
				<th scope="col">Full Name</th> 
				<th scope="col">Topic</th>
				<th scope="col">Type</th>
				<th scope="col">Role</th>
			</tr>
		</thead>
		<?php 
		$k=0;
		$res=$conn->query($activity);
		while($row = $res->fetch_assoc())
		{
			?>

			<tbody id="reportTables">
				<tr>
					<th scope="row"><?php echo ($k+1) ?></th>
					<td><?php echo $row["Studentid"] ?></td>
					<td><?php echo $row["FullName"] ?></td>
					<td><?php echo $row["Name"] ?></td>
					<td><?php echo $row["Type_Name"] ?></td>
					<td><?php echo $row["Role"] ?></td>
				</tr>
			</tbody>

	<?php
			$k=$k+1;	  
		} //while
	?>
	</table>

	<!---------- 	clubs table---------- -->
	<br><h5> Clubs/Organisations Table </h5><br>
	<table class="table table-hover m-2" style="width:100%">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Register No</th>
				<th scope="col">Full Name</th> 
				<th scope="col">Organisation</th>
				<th scope="col">Role</th>
			</tr>
		</thead>
		<?php 
		$k=0;
		$res=$conn->query($clubs);
		while($row = $res->fetch_assoc())
		{
			?>

			<tbody id="reportTables">
				<tr>
					<th scope="row"><?php echo ($k+1) ?></th>
					<td><?php echo $row["Studentid"] ?></td>
					<td><?php echo $row["FullName"] ?></td>
					<td><?php echo $row["Name"] ?></td>
					<td><?php echo $row["Role"] ?></td>
				</tr>
			</tbody>

	<?php
			$k=$k+1;	  
		} //while
	?>
	</table>

	<!---------- 	credit course table---------- -->
	<br><h5> Credit Course Table </h5><br>
	<table class="table table-hover m-2" style="width:100%">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Register No</th>
				<th scope="col">Full Name</th> 
				<th scope="col">Course</th>
				<th scope="col">Credits</th>
				<th scope="col">Marks</th>
				<th scope="col">Attendance</th>
			</tr>
		</thead>
		<?php 
		$k=0;
		$res=$conn->query($credit_course);
		while($row = $res->fetch_assoc())
		{
			?>

			<tbody id="reportTables">
				<tr>
					<th scope="row"><?php echo ($k+1) ?></th>
					<td><?php echo $row["Studentid"] ?></td>
					<td><?php echo $row["FullName"] ?></td>
					<td><?php echo $row["Name"] ?></td>
					<td><?php echo $row["Credits"] ?></td>
					<td><?php echo round($row["mar"],2) ?></td>
					<td><?php echo round($row["att"],2) ?></td>
				</tr>
			</tbody>

	<?php
			$k=$k+1;	  
		} //while
	?>
	</table>

	<!---------- 	internships table---------- -->
	<br><h5> Internships Table </h5><br>
	<table class="table table-hover m-2" style="width:100%">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Register No</th>
				<th scope="col">Full Name</th> 
				<th scope="col">Company</th>
				<th scope="col">Role</th>
				<th scope="col">Work Description</th>
			</tr>
		</thead>
		<?php 
		$k=0;
		$res=$conn->query($internships);
		while($row = $res->fetch_assoc())
		{
			?>

			<tbody id="reportTables">
				<tr>
					<th scope="row"><?php echo ($k+1) ?></th>
					<td><?php echo $row["StudentID"] ?></td>
					<td><?php echo $row["FullName"] ?></td>
					<td><?php echo $row["CompanyName"] ?></td>
					<td><?php echo $row["Role"] ?></td>
					<td><?php echo $row["WorkDescription"] ?></td>
				</tr>
			</tbody>

	<?php
			$k=$k+1;	  
		} //while
	?>
	</table>

	<!---------- 	managed events table---------- -->
	<br><h5> Managed Events Table </h5><br>
	<table class="table table-hover m-2" style="width:100%">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Register No</th>
				<th scope="col">Full Name</th> 
				<th scope="col">Event Name</th>
				<th scope="col">Role</th>
			</tr>
		</thead>
		<?php 
		$k=0;
		$res=$conn->query($managed_events);
		while($row = $res->fetch_assoc())
		{
			?>

			<tbody id="reportTables">
				<tr>
					<th scope="row"><?php echo ($k+1) ?></th>
					<td><?php echo $row["Studentid"] ?></td>
					<td><?php echo $row["FullName"] ?></td>
					<td><?php echo $row["Name"] ?></td>
					<td><?php echo $row["Role"] ?></td>
				</tr>
			</tbody>

	<?php
			$k=$k+1;	  
		} //while
	?>
	</table>

	<!---------- 	participated events table---------- -->
	<br><h5> Participated Events Table </h5><br>
	<table class="table table-hover m-2" style="width:100%">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Register No</th>
				<th scope="col">Full Name</th> 
				<th scope="col">Event Name</th>
				<th scope="col">Position</th>
				<th scope="col">Location</th>
			</tr>
		</thead>
		<?php 
		$k=0;
		$res=$conn->query($participated_events);
		while($row = $res->fetch_assoc())
		{
			?>

			<tbody id="reportTables">
				<tr>
					<th scope="row"><?php echo ($k+1) ?></th>
					<td><?php echo $row["StudentId"] ?></td>
					<td><?php echo $row["FullName"] ?></td>
					<td><?php echo $row["name"] ?></td>
					<td><?php echo $row["position"] ?></td>
					<td><?php echo $row["location"] ?></td>
				</tr>
			</tbody>

	<?php
			$k=$k+1;	  
		} //while
	?>
	</table>

</body>
</html>