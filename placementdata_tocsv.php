<?php

require("db.php");

$q1 = "Select RegisterNo from student";
$register = $conn->query($q1);

if($register->num_rows > 0)
{
	while ($row = $register->fetch_assoc())
	{
		$q2 = "Select rounds_qualified from placements where Studentid=".$row["RegisterNo"];
		$qrounds = $conn->query($q2);

		if($qrounds->num_rows > 0)
		{
			while($row2 = $qrounds->fetch_assoc())
			{
				$q3="Select No_of_rounds_conducted from company where idCompany=".$row2["companyid"];
				$trounds = $conn->query($q3);
				$row3=$trounds->fetch_assoc();
				if($row3["No_of_rounds_conducted"] === $row2["rounds_qualified"])
				{
					arr[$k]=-1;
				}
				elseif($row3["No_of_rounds_conducted"] > $row2["rounds_qualified"])
				{
					arr[$k]=$row2["rounds_qualified"];
				}
				else
				{
					arr[$k]=100;
				}
			}
		}
		else
		{

		}
	}
}
else
{
	echo "No student entry found!";
}

?>