
<!DOCTYPE html>
<html>
<head>
	<title>Student Classification</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<form action="#" method="POST">
		<input class="form-control mr-sm-2 m-3" style="width: 30%;" name="inputRegisterNo" id="inputRegisterNo" type="text" placeholder="Register No." aria-label="registerno" pattern="[0-9]{7}" required> &nbsp; &nbsp;
		<button type="Submit" name="submit" class="btn btn-primary">Submit</button>
	</form>
	<?php


	if(isset($_POST["submit"]))
	{
		$register = $_POST["inputRegisterNo"];
		//echo "Algorithm output based on dummy data - <br>";
		echo "<br> <br>";
		$command = escapeshellcmd("decisiontree.py $register");
		$output = shell_exec($command);
		echo "&nbsp; &nbsp;".$output;
	}

	?>
</body>
</html>