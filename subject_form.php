<?php
require("db.php");

if(isset($_POST["submit"]))
{
	$inputSubjectId = $_POST["inputSubjectId"];
	$inputCourseDrop = $_POST["inputCourseDrop"];
	$inputSemesterNo = $_POST["inputSemesterNo"];
	$inputSubjectName = $_POST["inputSubjectName"];
	$inputCIA1MaxMarks = $_POST["inputCIA1MaxMarks"];
	$inputCIA2MaxMarks = $_POST["inputCIA2MaxMarks"];
	$inputCIA3MaxMarks = $_POST["inputCIA3MaxMarks"];
	$inputEndSemMaxMarks = $_POST["inputEndSemMaxMarks"];
	$inputAttnMaxMarks = $_POST["inputAttnMaxMarks"];
	$inputTotalHrsCond = $_POST["inputTotalHrsCond"];

	foreach ($inputSubjectId as $key => $value)
	{
		$insert_query = "INSERT INTO `subjects`(`idSubjects`, `CourseId`, `SemesterNo`, `Subj_Name`, `CIA1_Max`, `CIA2_Max`, `CIA3_Max`, `EndSem_Max`, `Attendance_Max`, `Max_Hours`) VALUES ('$inputSubjectId[$key]',$inputCourseDrop[$key],$inputSemesterNo[$key],'$inputSubjectName[$key]',$inputCIA1MaxMarks[$key],$inputCIA2MaxMarks[$key],$inputCIA3MaxMarks[$key],$inputEndSemMaxMarks[$key],$inputAttnMaxMarks[$key],$inputTotalHrsCond[$key])";

		if ($conn->query($insert_query) === TRUE) 
		{
			include 'modal_sample_success.html';
		} 
		else 
		{
			echo $conn->error;
			include 'modal_sample_unsuccess.html';
		}

	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Subject Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  	<!-- <script type="text/javascript">
	  	$(document).ready(function() 
	  	{
	    var max_fields      = 10;
	    var wrapper         = $(".details");
	    var add_button      = $(".btn-outline-primary");
	 
	    var x = 1;
	    $(add_button).click(function(e)
	    {
	        e.preventDefault();
	        if(x < max_fields)
	        {
	            x++;
	            
	             $(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><div class="form-group"><label><strong>Subject - '+x+'</strong></label><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputSubjectId" id="inputSubjectId" placeholder="Subject ID"></div>	</div><div class="form-row"><div class="form-group col-md-4"><select name="inputCourseDrop" id="inputCourseDrop" class="form-control"><option disabled selected>Select Course</option><option>Course1</option><option>Course2</option><option>Course3</option></select></div>	<div class="form-group col-md-4"><input type="text" class="form-control" name="inputSemesterNo" id="inputSemesterNo" placeholder="Semester Number"></div><div class="form-group col-md-4"><input type="text" class="form-control" name="inputSubjectName" id="inputSubjectName" placeholder="Subject Name"></div></div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputCIA1MaxMarks" id="inputCIA1MaxMarks" placeholder="CIA1 Max Marks"></div>	<div class="form-group col-md-4"><input type="text" class="form-control" name="inputCIA2MaxMarks" id="inputCIA2MaxMarks" placeholder="CIA2 Max Marks"></div><div class="form-group col-md-4"><input type="text" class="form-control" name="inputCIA3MaxMarks" id="inputCIA3MaxMarks" placeholder="CIA3 Max Marks"></div></div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputEndsemMaxMarks" id="inputEndsemMaxMarks" placeholder="End Sem Max Marks"></div>	<div class="form-group col-md-4"><input type="text" class="form-control" name="inputAttnMaxMarks" id="inputAttnMaxMarks" placeholder="Attendance Max Marks"></div><div class="form-group col-md-4"><input type="text" class="form-control" name="inputTotalHrsCond" id="inputTotalHrsCond" placeholder="Total Hours Conducted"></div></div></div></div></div><a href="#" class="delete">Delete</a></div>')
	        }
	      else
	      {
	        alert('You Reached the limits')
	      }
	    });
	 
	    $(wrapper).on("click",".delete", function(e){
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })
	  });      
	</script> -->
	<style type="text/css">

	html, body{
		height:100%; /* important to vertically align the container */
		margin:0;
		padding:0;
	}

	.vertical-center {
		min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
		min-height: 100vh; /* These two lines are counted as one 🙂       */
		display: flex;
		align-items: top;
	}

	.container
	{
		padding-right: 15px;
		padding-left: 15px;
		padding-top: 15px;
		padding-bottom: 15px;
	}

</style>
</head>

<body>
	<div class="vertical-center">
		<div class="container-fluid text-dark m-0 p-3">
			<div class="buttoncontainer">
				<form method="POST" action="#">
					<div class="form-group details">
						<div class="form-group">
							<label><strong>Subject Details</strong></label>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputSubjectId[]" id="inputSubjectId" placeholder="Subject ID" required>
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<select name="inputCourseDrop[]" id="inputCourseDrop" class="form-control">
										<option disabled selected>Select Course</option>
										<?php
										$course_sql="SELECT * FROM programme ORDER BY Course_Name ASC";
										$course_result=$conn->query($course_sql);

										if($course_result->num_rows > 0)
										{
											while($course_row=$course_result->fetch_assoc())
												{ ?>
													<option value="<?php echo $course_row['idCourse']; ?>"><?php echo $course_row['Course_Name']; ?></option>
												<?php   }
											}

											?>
										</select>
									</div>	
									<div class="form-group col-md-4">
										<select class="form-control" name="inputSemesterNo[]" id="inputSemesterNo" required>
											<option selected disabled>Enter semester no.</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
											<option>6</option>
											<option>7</option>
											<option>8</option>
										</select>
									</div>
									<div class="form-group col-md-4">
										<input type="text" class="form-control" name="inputSubjectName[]" id="inputSubjectName" placeholder="Subject Name">
									</div>		
								</div>

								<div class="form-row">
									<div class="form-group col-md-4">
										<input type="number" class="form-control" name="inputCIA1MaxMarks[]" id="inputCIA1MaxMarks" placeholder="CIA1 Max Marks" max="100" required>
									</div>	
									<div class="form-group col-md-4">
										<input type="number" class="form-control" name="inputCIA2MaxMarks[]" id="inputCIA2MaxMarks" placeholder="CIA2 Max Marks" max="100" required>
									</div>
									<div class="form-group col-md-4">
										<input type="number" class="form-control" name="inputCIA3MaxMarks[]" id="inputCIA3MaxMarks" placeholder="CIA3 Max Marks" max="100" required>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-md-4">
										<input type="number" class="form-control" name="inputEndSemMaxMarks[]" id="inputEndSemMaxMarks" placeholder="End Sem Max Marks" max="200" required>
									</div>	
									<div class="form-group col-md-4">
										<input type="number" class="form-control" name="inputAttnMaxMarks[]" id="inputAttnMaxMarks" placeholder="Attendance Max Marks" max="100" required>
									</div>
									<div class="form-group col-md-4">
										<input type="number" class="form-control" name="inputTotalHrsCond[]" id="inputTotalHrsCond" placeholder="Total Hours Conducted" max="100" required>
									</div>	
								</div>

							</div>
						</div>
						<br>
						<div class="addDetails">
						</div>
						<br>
						<button type="button" onclick="addSubject()" class="btn btn-outline-primary">Add Subject +</button>
						<button type="Submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="common.js"></script>
	</body>
	</html>