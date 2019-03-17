<?php

require("db.php");
$q_marks = "SELECT sub_marks.Subject_id, (sum(sub_marks.CIA1_Obt)+sum(sub_marks.CIA2_Obt)+sum(sub_marks.CIA3_Obt)+sum(sub_marks.EndSem_Obt)+sum(sub_marks.Atten_Obt)) as marks_obt, (sum(subjects.CIA1_Max)+sum(subjects.CIA2_Max)+sum(subjects.CIA3_Max)+sum(subjects.EndSem_Max)+sum(subjects.Attendance_Max)) as total_marks, subjects.SemesterNo from sub_marks, student,subjects where student.RegisterNo = sub_marks.Student_id and student.ProgrammeID=1 and student.Year_of_Admission=2017 and sub_marks.Subject_id = subjects.idSubjects and subjects.SemesterNo=1 GROUP by sub_marks.Subject_id";
  
  $res_marks = $conn->query($q_marks);
  print_r($res_marks);

  echo "<br>".$res_marks->num_rows;
  while ($row=$res_marks->fetch_assoc()) 
  {
  	echo "<br>";
  	print_r($row);
  }

  ?>