<?php
require('db.php');
?>

<div>
	<div class="buttoncontainer">
		<div class="form-group details">
			<label for="projectdetails"><strong>Clubs/Organisations Details</strong></label>
			<div class="form-row">
				<div class="form-group col-md-3">
					<input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999" required>
				</div>	
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<select name="inputClubName[]" id="inputClubName" class="form-control" onchange="getClubs()">
						<option value="" selected disabled>Select Club/Organisation</option>
						<?php
						$q="Select distinct Name from clubs_organisations";
						$r=$conn->query($q);
						while($row=$r->fetch_assoc())
						{
							echo "<option>".$row["Name"]."</option>";
						}
						?>
						<option value="0">Other</option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<input type="text" class="form-control" name="inputClubName1[]" id="inputClubName1" placeholder="Club/Organisation Name" disabled>
				</div>	
				<script type="text/javascript">
					function getClubs()
					{
						if(document.getElementById('inputClubName').value == 0)
						{
							document.getElementById('inputClubName1').disabled = false;
						}
						else
						{
							document.getElementById('inputClubName1').disabled = true; 
						}
					}
				</script>
				<div class="form-group col-md-6">
					<input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="inputStartDate[]" id="inputStartDate" >
				</div>
				<div class="form-group col-md-6">
					<input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="inputEndDate[]" id="inputEndDate" >
				</div>	 
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<input type="text" class="form-control" name="inputRole[]" id="inputRole" placeholder="Role">
				</div>
				<div class="form-group col-md-6">
					<input type="text" class="form-control" name="inputWorkDesc[]" id="inputWorkDesc" placeholder="Work Description">
				</div>
			</div>
		</div>
	</div>
	<a href="#" class="delete">Delete</a>
</div>