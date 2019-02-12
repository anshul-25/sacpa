<?php

require ("db.php");

if(isset($_POST["submit"]))
{
	$register = $_POST["inputRegisterNo"];
	$name = "Select FirstName, MiddleName, LastName from student where RegisterNo = ".$register;
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
	$name2 = $row["FirstName"]." ".$row["MiddleName"]." ".$row["LastName"];

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
	<title>Student Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<style>
		table, th, td 
		{
  			border: 1px solid black;
  			border-collapse: collapse;
		}
	</style>
</head>

<body>
	<form id="myform" action="#" method="POST">
		<div class="input-group m-3 col-sm-5">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">Register Number</span>
				<input type="text" name="inputRegisterNo" class="form-control" placeholder="Enter register No." aria-label="registerno" pattern="[0-9]{7}" required>
			</div>
			<div class="col-sm-1"> 
				<button type="Submit" name="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>

	<!-- 	<div class="input-group m-3 col-sm-5">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">Register Number</span>
				<input type="text" readonly name="inputRegisterNo" class="form-control-plaintext" aria-label="registerno">
			</div>
		</div> -->
	</form>
<?php
	if(isset($_POST["submit"]))
	{
		echo "
		<div class=\"input-group m-3 col-sm-5\">
			<div class=\"input-group-prepend\">
				<span class=\"input-group-text\" id=\"basic-addon1\">Register Number</span>
				<input type=\"text\" readonly name=\"RegisterNo\" class=\"form-control-plaintext\" value=\"".$register."\">
			</div>
		</div>";	


		echo "<label><b>Register No: </b>".$register."</label>";
		echo "<br><br>";
		echo "<label><b>Name: </b>".$name2."</label>";
		echo "<br><br>";
		echo "<label><b>Class 10</b> <br> Board: ".$c[1]."&nbsp; &nbsp; Stream: ".$c[0]."&nbsp &nbsp Marks: ".$c[3]."</label>";
		echo "<br><br>";
		echo "<label><b>Class 12</b> <br> Board: ".$c2[1]."&nbsp; &nbsp; Stream: ".$c2[0]."&nbsp &nbsp Marks: ".$c2[3]."</label>";
		echo "<br><br>";
		echo "<label><b>Programme: </b>".$course."</label>";
		
		//activity
		echo "<br><br>";
		if($i>0)
		{
			echo "<label><b>Activity </b></label>";
			echo "<table style=\"width:100%\">
			<tr>
			<th>Name</th>
			<th>Role</th> 
			<th>Type</th>
			</tr>";$k=0;
			while($k < $i)
			{
				echo "<tr>
				<td>".$act[$k][0]."</td>
				<td>".$act[$k][1]."</td>
				<td>".$act[$k][2]."</td>
				</tr>";
				$k=$k+1;	  
			}
			echo "</table>";
		}

		//clubs
		echo "<br><br>";
		if($j>0)
		{
			echo "<label><b>Clubs or Organisations </b></label>";
			echo "<table style=\"width:100%\">
			<tr>
			<th>Name</th>
			<th>Role</th>
			</tr>";$k=0;
			while($k < $j)
			{
				echo "<tr>
				<td>".$cl[$k][0]."</td>
				<td>".$cl[$k][1]."</td>
				</tr>";
				$k=$k+1;	  
			}
			echo "</table>";
		}

		//cc
		echo "<br><br>";
		if($l>0)
		{
			echo "<label><b>Credit Course </b></label>";
			echo "<table style=\"width:100%\">
			<tr>
			<th>Name</th>
			<th>Credits</th>
			<th>Marks</th>
			</tr>";$k=0;
			while($k < $l)
			{
				echo "<tr>
				<td>".$cc1[$k][0]."</td>
				<td>".$cc1[$k][1]."</td>
				<td>".$cc1[$k][2]."</td>
				</tr>";
				$k=$k+1;	  
			}
			echo "</table>";
		}

		//internships
		echo "<br><br>";
		if($m>0)
		{
			echo "<label><b>Internships </b></label>";
			echo "<table style=\"width:100%\">
			<tr>
			<th>Company Name</th>
			<th>Role</th>
			</tr>";$k=0;
			while($k < $m)
			{
				echo "<tr>
				<td>".$in[$k][0]."</td>
				<td>".$in[$k][1]."</td>
				</tr>";
				$k=$k+1;	  
			}
			echo "</table>";
		}

		//managed events
		echo "<br><br>";
		if($n>0)
		{
			echo "<label><b>Managed Events </b></label>";
			echo "<table style=\"width:100%\">
			<tr>
			<th>Name</th>
			<th>Role</th>
			</tr>";$k=0;
			while($k < $n)
			{
				echo "<tr>
				<td>".$me[$k][0]."</td>
				<td>".$me[$k][1]."</td>
				</tr>";
				$k=$k+1;	  
			}
			echo "</table>";
		}

		//participated events
		echo "<br><br>";
		if($o>0)
		{
			echo "<label><b>Participated Events </b></label>";
			echo "<table style=\"width:100%\">
			<tr>
			<th>Name</th>
			<th>Position</th>
			<th>Location</th>
			</tr>";$k=0;
			while($k < $o)
			{
				echo "<tr>
				<td>".$pe[$k][0]."</td>
				<td>".$pe[$k][1]."</td>
				<td>".$pe[$k][2]."</td>
				</tr>";
				$k=$k+1;	  
			}
			echo "</table>";
		}	
	}

?>

</body>
</html>