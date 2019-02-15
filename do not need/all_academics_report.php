<?php
require('db.php');



$regno = "select RegisterNo, FirstName, LastName from student";
$res=$conn->query($regno);

while($row=$res->fetch_assoc())
{
	$semno_query="select distinct SemesterNo from subjects";
	$res1=$conn->query($semno_query);

	while($row1=$res1->fetch_assoc()) 
	{
		$total = 0;
		$obtained = 0;
		$subject_id_query = "select sm.Subject_id, s.SemesterNo, s.CIA1_Max, s.CIA2_Max, s.CIA3_Max, s.EndSem_Max, s.Attendance_Max, sm.CIA1_Obt, sm.CIA2_Obt, sm.CIA3_Obt, sm.EndSem_Obt, sm.Atten_Obt from sub_marks sm, subjects s where Student_id=".$row["RegisterNo"]." AND sm.Subject_id=s.idSubjects AND s.SemesterNo=".$row1["SemesterNo"];
		$res2=$conn->query($subject_id_query);
		
		while($row2=$res2->fetch_assoc())
		{
			$total=$total + $row2["CIA1_Max"] + $row2["CIA2_Max"] + $row2["CIA3_Max"] + $row2["EndSem_Max"] + $row2["Attendance_Max"];
			$obtained = $obtained + $row2["CIA1_Obt"] + $row2["CIA2_Obt"] + $row2["CIA3_Obt"] + $row2["EndSem_Obt"] + $row2["Atten_Obt"];
			
		}
		if($total != 0)
		{
			$percentage = ($obtained/$total) * 100;
			echo $percentage."<br>";
		}
	}//while
	

}//while

?>

