<?php
require("db.php");
?>

<div>
	<div class="buttoncontainer">
		<div class="form-group details">
			<div class="form-group">
				<label for="projectdetails"><strong>Credit Course Details</strong></label>
				<div class="form-row">
					<div class="form-group col-md-4">
						<input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999" required>
					</div>
					<div class="form-group col-md-4">
						<select name="inputCCName[]" id="inputCCName" class="form-control" onchange="getCC()">
							<option value="" disabled selected>Select Credit Course</option>
							<?php
							$q="Select distinct Name from credit_course";
							$r=$conn->query($q);

							while($row=$r->fetch_assoc())
							{
								echo "<option>".$row['Name']."</option>";
							}
							?>
							<option value="0">Other</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<input type="text" class="form-control" name="inputCCName1[]" id="inputCCName1" placeholder="Other" disabled>
					</div> 
					<script type="text/javascript">
						function getCC()
						{
							if(document.getElementById("inputCCName").value == 0)
							{
								document.getElementById("inputCCName1").disabled = false;
							}
							else
							{
								document.getElementById("inputCCName1").disabled = true; 
							}
						}
					</script>
					<div class="form-group col-md-4">
						<select name="credits[]" id="credits" class="form-control" required>
							<option disabled selected>Credits</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
						</select>
					</div> 
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
						<input type="number" class="form-control" name="inputTotalMarks[]" id="inputTotalMarks" placeholder="Total Marks" max="100" required>
					</div>	
					<div class="form-group col-md-3">
						<input type="number" class="form-control" name="inputMarksObt[]" id="inputMarksObt" placeholder="Marks Obtained" max="100" required>
					</div> 
					<div class="form-group col-md-3">
						<input type="number" class="form-control" name="inputHrsConducted[]" id="inputHrsConducted" placeholder="Hours Conducted" max="100" required>
					</div> 
					<div class="form-group col-md-3">
						<input type="number" class="form-control" name="inputHrsAttended[]" id="inputHrsAttended" placeholder="Hours Attended" max="100" required>
					</div> 

				</div>


			</div>

		</div>
	</div>
	<a href="#" class="delete">Delete</a>
</div>