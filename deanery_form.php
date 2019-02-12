<?php
	require("db.php");

	if(isset($_POST["submit"]))
	{
		$inputDeaneryName = $_POST["inputDeaneryName"];
		$inputDeanName = $_POST["inputDeanName"];
		$inputDeanContact = $_POST["inputDeanContact"];
		foreach ($inputDeaneryName as $key => $value)
		{
			$insert_query = "INSERT INTO `deneary`(`Deneary_Name`, `Dean`, `Dean_contact`) VALUES ('$inputDeaneryName[$key]','$inputDeanName[$key]','$inputDeanContact[$key]')";

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
	<title>Deanery Form</title>
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

					$(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><div class="form-group"><label><strong>Deanery - '+x+'</strong></label><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputDeaneryName[]" id="inputDeaneryName" placeholder="Deanery Name"></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputDeanName[]" id="inputDeanName" placeholder="Dean Name"></div>	</div><div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputDeanContact[]" id="inputDeanContact" pattern="[0-9]{10}" placeholder="Dean Contact"></div></div></div></div></div><a href="#" class="delete">Delete</a></div>')
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
							<label><strong>Deanery - 1</strong></label>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputDeaneryName[]" id="inputDeaneryName" placeholder="Deanery Name" required>
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputDeanName[]" id="inputDeanName" placeholder="Dean Name">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="inputDeanContact[]" id="inputDeanContact" pattern="[0-9]{10}" placeholder="Dean Contact">
								</div>	
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-outline-primary">Add Deanery +</button>
					<button type="Submit" name ="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="submitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="submitModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="odalTitle">Submitted Successfully</h5>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="location.href='http://localhost/sacpa/DataEntryUpdated.html';">Home</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>