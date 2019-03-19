<?php

require("db.php");

$q1x = "Select RegisterNo from student";
$registerx = $conn->query($q1x);

if($registerx->num_rows > 0)
{
	$bx=0;
	while ($rowx = $registerx->fetch_assoc())
	{
		$q2x= "Select * from sub_marks where Student_id=".$rowx["RegisterNo"];
		$submarksx = $conn->query($q2x);
		$numx = $submarksx->num_rows;
		if($numx > 0)
		{
			$ax=0;
			while($row1x = $submarksx->fetch_assoc())
			{
				$q3x= "Select * from subjects where idSubjects = '".$row1x["Subject_id"]."'";
				$subjectsx=$conn->query($q3x);
		
				if($subjectsx->num_rows > 0)
				{
					$row2x=$subjectsx->fetch_assoc();
					$totalx[$ax] = $row2x["CIA1_Max"]+$row2x["CIA2_Max"]+$row2x["CIA3_Max"]+$row2x["EndSem_Max"]+$row2x["Attendance_Max"];
					$obtainedx[$ax] = $row1x["CIA1_Obt"]+$row1x["CIA2_Obt"]+$row1x["CIA3_Obt"]+$row1x["EndSem_Obt"]+$row1x["Atten_Obt"];

					$perx[$bx]=round(($obtainedx[$ax]/$totalx[$ax]),2);
					$attx[$bx]=round(($row1x["Hours_Attended"]/$row2x["Max_Hours"]),2);
					$ax=$ax+1;
					$bx=$bx+1;
				}//each subject ends here

			}//all subjects for each student ends here
		}
		else
		{
			//echo "No academic entries found!";
		}
	}//each register num. end

	$zx=0;
	while($zx < $bx)
	{
		$listx[$zx] = ($perx[$zx]*100).",".($attx[$zx]*100);
		//echo $list[$z]."<br>";
		$zx=$zx+1;
	}

	//inserting data into a csv file
	$csvfile = 'studentdata_att_aca_db.csv';
	//$header=array("Marks","Attendance");
	$file = fopen($csvfile,"w");
	//fputcsv($file, $header);
	foreach ($listx as $line) 
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
