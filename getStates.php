<?php
require("db.php");


if(isset($_GET["countryid"]) && !empty($_GET["countryid"]))
{
	$countryid=$_GET["countryid"];

	$state_sql="SELECT * FROM state WHERE country_id='$countryid' ORDER BY name ASC";
	$state_result=$conn->query($state_sql);

	if($state_result->num_rows > 0)
	{
		while($state_row=$state_result->fetch_assoc())
			{ ?>
				<option value="<?php echo $state_row['idState']; ?>"><?php echo $state_row['name']; ?></option>
			<?php		}
		}



	}
	else
	{
		echo '<option selected disabled>Please select state</option>';
	}
	?>