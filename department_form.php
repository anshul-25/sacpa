<?php
require("db.php");

if(isset($_POST["submit"]))
{
	$inputDepartmentName = $_POST["inputDepartmentName"];
	$inputHODName = $_POST["inputHODName"];
	$inputHODContact = $_POST["inputHODContact"];
	$inputDeanery = $_POST["inputDeanery"];

	foreach ($inputDepartmentName as $key => $value)
	{
		$insert_query = "INSERT INTO `department`(`Department_name`, `HOD`, `HOD_contact`, `Deneary_id`) VALUES ('$inputDepartmentName[$key]','$inputHODName[$key]','$inputHODContact[$key]',$inputDeanery[$key])";

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
	<title>Department Form</title>
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

					$(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><div class="form-group"><label><strong>Department - '+x+'</strong></label><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputDepartmentName" id="inputDepartmentName" placeholder="Department Name"></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputHODName" id="inputHODName" placeholder="HOD Name"></div></div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputHODContact" id="inputHODContact" placeholder="HOD Contact"></div>	</div><div class="form-row"><div class="form-group col-md-4"><select name="inputDeanery" id="inputDeanery" class="form-control"><option disabled selected>Select Deanery</option><option>Science</option><option>Commerce</option><option>DPS</option></select></div>	</div></div></div></div><a href="#" class="delete">Delete</a></div>')
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
	<div class="vertical-center ">
		<div class="container-fluid  text-dark m-0 p-3">
			<div class="buttoncontainer">
				<form method="POST" action="#">
					<div class="form-group details">
						<div class="form-group">
							<label><strong>Department Details</strong></label>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputDepartmentName[]" id="inputDepartmentName" placeholder="Department Name">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputHODName[]" id="inputHODName" placeholder="HOD Name">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputHODContact[]" id="inputHODContact" pattern="[0-9]{10}" placeholder="HOD Contact" required>
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<select name="inputDeanery[]" id="inputDeanery" class="form-control" required>
										<option disabled selected>Select Deanery</option>
										<?php
										$dept_sql="SELECT * FROM deneary ORDER BY Deneary_Name ASC";
										$dept_result=$conn->query($dept_sql);

										if($dept_result->num_rows > 0)
										{
											while($dept_row=$dept_result->fetch_assoc())
												{ ?>
													<option value="<?php echo $dept_row['idDeneary']; ?>"><?php echo $dept_row['Deneary_Name']; ?></option>
												<?php   }
											}

											?>
										</select>
									</div>	
								</div>
							</div>
						</div>
						<br>
						<div class="addDetails">
						</div>
						<br>
						<button type="button" onclick="addDepartment()" class="btn btn-outline-primary">Add Department +</button>
						<button type="Submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>	
		</div>
		<script type="text/javascript" src="common.js"></script>
	</body>
	</html>