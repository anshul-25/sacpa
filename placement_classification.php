<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$t=0;$g=0;$a=0;

$q="SELECT Register_No, Name,SUM(Total_Rounds), SUM(Rounds_completed) from placements where Register_No NOT IN (SELECT Register_No from placements where Total_Rounds=Rounds_completed ) GROUP by Register_No";
$res = $conn->query($q);

$i=0;
while($row = $res->fetch_assoc())
{
	$rate[$i][0] = $row["Register_No"];
	$rate[$i][1] = $row["Name"]; 
	$rate[$i][2] = round(($row["SUM(Rounds_completed)"]/$row["SUM(Total_Rounds)"]) * 100,2);
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
<!DOCTYPE html>
<html>
<head>
	<title>Placement Classification</title>
</head>
<body>
	<table>
		<tr>
			<th>Register No.</th>
			<th>Name</th>
			<th>Qualification Rate</th>
			<th>Needs help in - </th>
		</tr>
		<?php
			$k = 0;
			while($k<$i)
			{
				echo "<tr>";
				echo "<td>".$rate[$k][0]."</td>";
				echo "<td>".$rate[$k][1]."</td>";
				echo "<td>".$rate[$k][2]."</td>";
				echo "<td>".$rate[$k][3]."</td>";
				echo "</tr>";
				$k=$k+1;
			}
		?>

	</table>
	<?php 
		echo "<br><br> No of students requiring help in - <br>";
		echo "<br> &nbsp;&nbsp; Aptitude = ".$a;
		echo "<br> &nbsp;&nbsp; Group Discussion = ".$g;
		echo "<br> &nbsp;&nbsp; Technical/HR Interview = ".$t;
	?>

</body>
</html>
