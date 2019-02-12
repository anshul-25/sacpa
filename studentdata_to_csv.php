<?php
	require("db.php");


	$q1 = "Select RegisterNo from student";
	$register = $conn->query($q1);

	if($register->num_rows > 0)
	{
		$i=0;$j=0;$k=0;$l=0;$m=0;$n=0;$o=0;$p=0;$q=0;$r=0;$s=0;
		while ($row = $register->fetch_assoc())
		{
			//register no
			$regis[$r]=$row["RegisterNo"];
			$r=$r+1;

			//research
			$q2 = "Select idActivity from activity where Type=1 and Studentid = ".$row["RegisterNo"];
			$research = $conn->query($q2);
			if($research->num_rows > 0)
			{
				$research_presence[$i]=1;
			}
			else
			{
				$research_presence[$i]=0;
			}
			$i=$i+1;

			//project
			$q3 = "Select idActivity from activity where Type = 2 and Studentid = ".$row["RegisterNo"];
			$project = $conn->query($q3);
			if($project->num_rows > 0)
			{
				$project_presence[$j]=1;
			}
			else
			{
				$project_presence[$j]=0;
			}
			$j=$j+1;

			//clubs_organisation
			$q4 = "Select idClubs_Organisations from clubs_organisations where Studentid = ".$row["RegisterNo"];
			$clubs = $conn->query($q4);
			if($clubs->num_rows > 0)
			{
				$club_presence[$k]=1;
			}
			else
			{
				$club_presence[$k]=0;
			}
			$k=$k+1;

			//credit courses
			$q5 = "Select idCredit_Course from credit_course where Studentid = ".$row["RegisterNo"];
			$cc = $conn->query($q5);
			if($cc->num_rows > 0)
			{
				$cc_presence[$l]=1;
			}
			else
			{
				$cc_presence[$l]=0;
			}
			$l=$l+1;

			//internships
			$q6 = "Select idInternships from internships where StudentID = ".$row["RegisterNo"];
			$internships = $conn->query($q6);
			if($internships->num_rows > 0)
			{
				$internship_presence[$m]=1;
			}
			else
			{
				$internship_presence[$m]=0;
			}
			$m=$m+1;

			//managed_events
			$q7 = "Select idManaged_Events from managed_events where Studentid = ".$row["RegisterNo"];
			$managed_events = $conn->query($q7);
			if($managed_events->num_rows > 0)
			{
				$mevents_presence[$n]=1;
			}
			else
			{
				$mevents_presence[$n]=0;
			}
			$n=$n+1;

			//participated_events
			$q8 = "Select idParticipatedEvents from participated_events where StudentId = ".$row["RegisterNo"];
			$participated_events = $conn->query($q8);
			if($participated_events->num_rows > 0)
			{
				$pevents_presence[$o]=1;
			}
			else
			{
				$pevents_presence[$o]=0;
			}
			$o=$o+1;

			//class 10
			$q9 = "Select Total_Marks, Marks_obt from class10 where studentid = ".$row["RegisterNo"];
			$class10 = $conn->query($q9);
			if($class10->num_rows > 0)
			{
				$row1 = $class10->fetch_assoc();
				$per = ($row1["Marks_obt"]/$row1["Total_Marks"]);
				if($per >= 0.8)
				{
					$class10_grade[$s]=2;
				}
				elseif($per >= 0.6)
				{
					$class10_grade[$s]=1;
				}
				else
				{
					$class10_grade[$s]=0;
				}
			}
			else
			{
				$class10_grade[$s]=0;
			}
			$s=$s+1;

			//class12
			$q10 = "Select Total_marks, Marks_Obt from class12 where Studentid = ".$row["RegisterNo"];
			$class12 = $conn->query($q10);
			if($class12->num_rows > 0)
			{
				$row1 = $class12->fetch_assoc();
				$per = ($row1["Marks_Obt"]/$row1["Total_marks"]);
				if($per >= 0.8)
				{
					$class12_grade[$p]=2;
				}
				elseif($per >= 0.6)
				{
					$class12_grade[$p]=1;
				}
				else
				{
					$class12_grade[$p]=0;
				}
			}
			else
			{
				$class12_grade[$p]=0;
			}
			$p=$p+1;

			//semester_marks
			$total[]=0;$obtained[]=0;
			$q11= "Select * from sub_marks where Student_id=".$row["RegisterNo"];
			$submarks = $conn->query($q11);
			$num = $submarks->num_rows;
			$a=0;
			if($num > 0)
			{
				while($row1 = $submarks->fetch_assoc())
				{
					$q12= "Select * from subjects where idSubjects = '".$row1["Subject_id"]."'";
					$subjects=$conn->query($q12);

					//echo $subjects->fetch_assoc();
					
					if($subjects->num_rows > 0)
					{
						$row2=$subjects->fetch_assoc();
						$total[$a] = $row2["CIA1_Max"]+$row2["CIA2_Max"]+$row2["CIA3_Max"]+$row2["EndSem_Max"]+$row2["Attendance_Max"];
						$obtained[$a] = $row1["CIA1_Obt"]+$row1["CIA2_Obt"]+$row1["CIA3_Obt"]+$row1["EndSem_Obt"]+$row1["Atten_Obt"];
						$a=$a+1;
					}
				}

				$a=0;$total1=1;$obt=0;
				while ($a < $num)
				{
					$total1=$total1+$total[$a];
					$obt=$obt+$obtained[$a];
					$a=$a+1;
				}
				$per = ($obt/$total1);

				if($per >= 0.8)
				{
					$sem_grade[$q]=3;
				}
				elseif($per >= 0.6)
				{
					$sem_grade[$q]=2;
				}
				elseif($per >= 0.4)
				{
					$sem_grade[$q]=1;
				}
				else
				{
					$sem_grade[$q]=0;
				}
			}
			else
			{
				$sem_grade[$q]=0;
			}
			$q=$q+1;

		}//while loop end for student register nos


		$z=0;
		while($z < $register->num_rows)
		{
			$list[$z] = $regis[$z].",".$research_presence[$z].",".$project_presence[$z].","."$club_presence[$z]".","."$cc_presence[$z]".","."$internship_presence[$z]".","."$mevents_presence[$z]".",".$pevents_presence[$z].",".$class10_grade[$z].",".$class12_grade[$z].",".$sem_grade[$z];

			echo $list[$z]."<br>";
			$z=$z+1;
		}

		//inserting data into a csv file
		$csvfile = 'studentdata_all_db.csv';
		$header=array("RegisterNo","Research","Project","Club","CC","Internship","ManagedEvents","ParticipatedEvents","Class10","Class12","University_Grade");
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