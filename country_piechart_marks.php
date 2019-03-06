<?php
require('db.php');

$country_list="select co.idCountry, co.Name from student s, city ci, state st, country co where s.City_id=ci.idCity and ci.state_id=st.idState and st.country_id=co.idCountry group by co.Name";


$res1=$conn->query($country_list);

$percentage=0;
// $agg=0;
$i=0;

while($row1=$res1->fetch_assoc())
{
	$total=0;
	$obtained=0;
	$subject_id_query = "select sm.Subject_id, s.SemesterNo, s.CIA1_Max, s.CIA2_Max, s.CIA3_Max, s.EndSem_Max, s.Attendance_Max, sm.CIA1_Obt, sm.CIA2_Obt, sm.CIA3_Obt, sm.EndSem_Obt, sm.Atten_Obt from sub_marks sm, subjects s, student stu, city ci, state st, country co where sm.Subject_id=s.idSubjects AND sm.Student_id=stu.RegisterNo AND stu.City_id=ci.idCity AND ci.state_id=st.idState AND st.country_id=".$row1["idCountry"];

	$agg[$i][0]=$row1["Name"];

	$res2=$conn->query($subject_id_query);
	$agg[$i][1]=0;
	while($row2=$res2->fetch_assoc())
	{
		$total=$total + $row2["CIA1_Max"] + $row2["CIA2_Max"] + $row2["CIA3_Max"] + $row2["EndSem_Max"] + $row2["Attendance_Max"];
		$obtained = $obtained + $row2["CIA1_Obt"] + $row2["CIA2_Obt"] + $row2["CIA3_Obt"] + $row2["EndSem_Obt"] + $row2["Atten_Obt"];

	}
	if($total != 0)
	{
		$percentage = ($obtained/$total) * 100;
		$agg[$i][1]=$agg[$i][1]+$percentage;
		// $avg[$i]=$agg/$res2->num_rows;
		$i=$i+1;
	}

}//while

//print_r($agg);

?>


<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Country', 'Average Marks'],
          <?php
          	$k=0;
          	while($k<$i)
          	{
          		echo "['".$agg[$k][0]."',".$agg[$k][1]."],";
          		$k=$k+1;
          	}

          ?>
        ]);

        var options = {
          title: 'Demographic Distribution - Marks'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>