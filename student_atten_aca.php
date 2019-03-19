<?php

require("db.php");

$q1x = "select DISTINCT sub_marks.Student_id from sub_marks";
$registerx = $conn->query($q1x);

if($registerx->num_rows > 0)
{
	$bx=0;
	while ($rowx = $registerx->fetch_assoc())
	{
		$q2x = "select (sum(sub_marks.CIA1_Obt+sub_marks.CIA2_Obt+sub_marks.CIA3_Obt+sub_marks.EndSem_Obt+sub_marks.Atten_Obt)/sum(subjects.CIA1_Max+subjects.CIA2_Max+subjects.CIA3_Max+subjects.EndSem_Max+subjects.Attendance_Max)) as avrg, (sub_marks.Hours_Attended/subjects.Max_hours) as att from sub_marks, subjects where sub_marks.Subject_id=subjects.idSubjects and sub_marks.Student_id=".$rowx["Student_id"]." GROUP BY sub_marks.Subject_id";
		$res2x = $conn->query($q2x);
		while($row1x = $res2x->fetch_assoc())
		{
			$perx[$bx]=round($row1x["avrg"],2);
			$attx[$bx]=round($row1x["att"],2);
			$bx=$bx+1;
		}
	
	}//each reg no. ends here

	$zx=0;
	while($zx < $bx)
	{
		$listx[$zx] = ($attx[$zx]*100).",".($perx[$zx]*100);
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
