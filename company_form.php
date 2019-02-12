<?php
require("db.php");

if(isset($_POST["submit"]))
{
	$inputCompanyName = $_POST["inputCompanyName"];
	$inputRoleOffered = $_POST["inputRoleOffered"];
	$inputCtcOrStipend = $_POST["inputCtcOrStipend"];
	$inputRoundsConducted = $_POST["inputRoundsConducted"];
	$inputDateOfVisit = $_POST["inputDateOfVisit"];

	foreach ($inputCompanyName as $key => $value)
	{
		$insert_query = "INSERT INTO `company`(`CompanyName`, `Role`, `CTC_or_Stipend`, `No_of_rounds_conducted`, `Date_of_visit`) VALUES ('$inputCompanyName[$key]','$inputRoleOffered[$key]',$inputCtcOrStipend[$key],$inputRoundsConducted[$key],'$inputDateOfVisit[$key]')";

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
	<title>Company Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script type="text/javascript">
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

					$(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><div class="form-group"><label><strong>Company Details '+x+'</strong></label><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputCompanyName[]" id="inputCompanyName" placeholder="Company Name" required></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputRoleOffered[]" id="inputRoleOffered" placeholder="role Offered"></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="number" class="form-control" name="inputCtcOrStipend[]" id="inputCtcOrStipend" step="0.01" placeholder="Stipend/CTC" required></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputRoundsConducted[]" id="inputRoundsConducted" placeholder="No. of Rounds Conducted" required></div>	</div><div class="form-row"><div class="form-group col-md-4"><input placeholder="Date of Visit" class="form-control" type="text" onfocus="(this.type=\'date\')" onblur="(this.type=\'text\')" id="inputDateOfVisit" name="inputDateOfVisit[]"></div>	</div></div></div></div><a href="#" class="delete">Delete</a></div>')
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
	</script>

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
							<label><strong>Company Details 1</strong></label>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputCompanyName[]" id="inputCompanyName" placeholder="Company Name" required>
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputRoleOffered[]" id="inputRoleOffered" placeholder="role Offered">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="number" class="form-control" name="inputCtcOrStipend[]" id="inputCtcOrStipend" placeholder="Stipend/CTC" step="0.01" required>
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="number" class="form-control" name="inputRoundsConducted[]" id="inputRoundsConducted" placeholder="No. of Rounds Conducted" min="0" max="8" required>
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input placeholder="Date of Visit" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="inputDateOfVisit" name="inputDateOfVisit[]">
								</div>	
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-outline-primary">Add Company +</button>
					<button type="Submit" name="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>