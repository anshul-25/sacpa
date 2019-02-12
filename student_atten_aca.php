<?php

require("db.php");

$q1 = "Select RegisterNo from student";
$register = $conn->query($q1);

if($register->num_rows > 0)
{
	$b=0;
	while ($row = $register->fetch_assoc())
	{
		$q2= "Select * from sub_marks where Student_id=".$row["RegisterNo"];
		$submarks = $conn->query($q2);
		$num = $submarks->num_rows;
		if($num > 0)
		{
			$a=0;
			while($row1 = $submarks->fetch_assoc())
			{
				$q3= "Select * from subjects where idSubjects = '".$row1["Subject_id"]."'";
				$subjects=$conn->query($q3);
		
				if($subjects->num_rows > 0)
				{
					$row2=$subjects->fetch_assoc();
					$total[$a] = $row2["CIA1_Max"]+$row2["CIA2_Max"]+$row2["CIA3_Max"]+$row2["EndSem_Max"]+$row2["Attendance_Max"];
					$obtained[$a] = $row1["CIA1_Obt"]+$row1["CIA2_Obt"]+$row1["CIA3_Obt"]+$row1["EndSem_Obt"]+$row1["Atten_Obt"];

					$per[$b]=round(($obtained[$a]/$total[$a]),2);
					$att[$b]=round(($row1["Hours_Attended"]/$row2["Max_Hours"]),2);
					$a=$a+1;
					$b=$b+1;
				}//each subject ends here

			}//all subjects for each student ends here
		}
		else
		{
			//echo "No academic entries found!";
		}
	}//each register no end

	$z=0;
	while($z < $b)
	{
		$list[$z] = $per[$z].",".$att[$z];
		echo $list[$z]."<br>";
		$z=$z+1;
	}

	//inserting data into a csv file
	$csvfile = 'studentdata_att_aca_db.csv';
	$header=array("Marks","Attendance");
	$file = fopen($csvfile,"w");
	fputcsv($file, $header);
	foreach ($list as $line) 
	{
		fputcsv($file, explode(',', $line));
	}
	fclose($file);
		
}//if loop end - checking if any student is there or not

else 
{
	echo "No student entry found!";
}

?>
