<?php 
require("db.php"); 
?>

<div>
	<div class="buttoncontainer">
		<div class="form-group">
			<label><strong>Programme Details</strong></label>
			<div class="form-row">
				<div class="form-group col-md-4"><input type="text" class="form-control" name="inputProgramName[]" id="inputProgramName" placeholder="Program Name"></div>
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
					<select name="inputDepartmentDrop[]" id="inputDepartmentDrop" class="form-control">
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
					<div class="form-group col-md-4"><input type="text" class="form-control" name="inputCoordinator[]" id="inputCoordinator" placeholder="Co-ordinator Name"></div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<input type="text" class="form-control" name="inputCoordinatorContact[]" id="inputCoordinatorContact" placeholder="Co-ordinator Contact" pattern="[0-9]{10}" >
					</div>
				</div>
			</div>
		</div>
		<a href="#" class="delete">Delete</a>
	</div>