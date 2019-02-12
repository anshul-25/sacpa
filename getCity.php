<?php
require("db.php");


if(isset($_GET["stateid"]) && !empty($_GET["stateid"]))
{
	$stateid=$_GET["stateid"];

	$city_sql="SELECT * FROM city WHERE state_id='$stateid' ORDER BY name ASC";
	$city_result=$conn->query($city_sql);

	if($city_result->num_rows > 0)
	{
		while($city_row=$city_result->fetch_assoc())
			{ ?>
				<option value="<?php echo $city_row['idCity']; ?>"><?php echo $city_row['name']; ?></option>
			<?php		}
		}



	}
	else
	{
		echo '<option selected disabled>Please select city</option>';
	}
	?>