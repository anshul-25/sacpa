<?php
require("db.php");

if(isset($_POST["submit"]))
{
	$inputProgramName = $_POST["inputProgramName"];
	$inputNoOfSemesters = $_POST["inputNoOfSemesters"];
	$inputDepartmentDrop = $_POST["inputDepartmentDrop"];
	$inputCoordinator = $_POST["inputCoordinator"];
	$inputCoordinatorContact = $_POST["inputCoordinatorContact"];

	foreach ($inputProgramName as $key => $value)
	{
		$insert_query = "INSERT INTO `programme`(`Course_Name`, `No_of_semesters`, `Department_id`, `Coordinator`, `Coordinator_contact`) VALUES ('$inputProgramName[$key]',$inputNoOfSemesters[$key],$inputDepartmentDrop[$key],'$inputCoordinator[$key]','$inputCoordinatorContact[$key]')";

		if ($conn->query($insert_query) === TRUE) 
		{
			include 'modal_sample_success.html';
		} 
		else 
		{
			include 'modal_sample_unsuccess.html';
		}

	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Program Form</title>
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

					$(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><div class="form-group"><label><strong>Program - '+x+'</strong></label><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputProgramName[]" id="inputProgramName" placeholder="Program Name"></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputNoOfSemesters[]" id="inputNoOfSemesters" placeholder="No. of semesters"></div>	</div><div class="form-row"><div class="form-group col-md-4"><select name="inputDepartmentDrop[]" id="inputDepartmentDrop" class="form-control"><option disabled selected>Select Department</option><option>Dept1</option><option>Dept2</option><option>Dept3</option></select></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputCoordinator" id="inputCoordinator" placeholder="Co-ordinator Name"></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputCoordinatorContact" id="inputCoordinatorContact" placeholder="Co-ordinator Contact"></div>	</div></div></div></div><a href="#" class="delete">Delete</a></div>')
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
							<label><strong>Programme Details</strong></label>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputProgramName[]" id="inputProgramName" placeholder="Program Name">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<select class="form-control" name="inputNoOfSemesters[]" id="inputNoOfSemesters" required>
										<option selected disabled>No. of Semesters</option>
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
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<select name="inputDepartmentDrop[]" id="inputDepartmentDrop" class="form-control" required>
										<option disabled selected>Select Department</option>

										<?php
										$dept_sql="SELECT * FROM department ORDER BY Department_name ASC";
										$dept_result=$conn->query($dept_sql);

										if($dept_result->num_rows > 0)
										{
											while($dept_row=$dept_result->fetch_assoc())
												{ ?>
													<option value="<?php echo $dept_row['idDepartment']; ?>"><?php echo $dept_row['Department_name']; ?></option>
												<?php   }
											}

											?>
										</select>
									</div>	
								</div>
								<div class="form-row">
									<div class="form-group col-md-4">
										<input type="text" class="form-control" name="inputCoordinator[]" id="inputCoordinator" placeholder="Co-ordinator Name">
									</div>	
								</div>
								<div class="form-row">
									<div class="form-group col-md-4">
										<input type="text" class="form-control" name="inputCoordinatorContact[]" id="inputCoordinatorContact" placeholder="Co-ordinator Contact" pattern="[0-9]{10}" >
									</div>	
								</div>
							</div>
						</div>
						<br>
						<div class="addDetails">
						</div>
						<br>
						<button type="button" onclick="addProgramme()" class="btn btn-outline-primary">Add Program +</button>
						<button type="Submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="common.js"></script>
	</body>
	</html>