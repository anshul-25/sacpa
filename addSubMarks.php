<?php require("db.php") ?>

<div>
   <div class="buttoncontainer">
      <div class="form-group details">
         <label for="projectdetails"><strong>Subject Marks</strong></label>
         <div class="form-row">
            <div class="form-group col-md-4">
            	<input type="text" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register Number" pattern="[0-9]{7}" required>
            </div>
            <div class="form-group col-md-4">
               <select name="inputSubject[]" id="inputSubject" class="form-control" required>
                  <option disabled selected>Select Subject</option>
                  <?php
                  $subj_sql="SELECT * FROM subjects ORDER BY Subj_Name ASC";
                  $subj_result=$conn->query($subj_sql);

                  if($subj_result->num_rows > 0)
                  {
                    while($subj_row=$subj_result->fetch_assoc())
                      { ?>
                        <option value="<?php echo $subj_row['idSubjects']; ?>"><?php echo $subj_row['Subj_Name']; ?></option>
                      <?php   }
                    }

                    ?>
               </select>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-4">
            	<input type="number" class="form-control" name="inputCIA1Marks[]" id="inputCIA1Marks" placeholder="CIA 1 Marks" max="100" required>
            </div>
            <div class="form-group col-md-4">
            	<input type="number" class="form-control" name="inputCIA2Marks[]" id="inputCIA2Marks" placeholder="CIA 2 Marks" max="100" required>
            </div>
            <div class="form-group col-md-4">
            	<input type="number" class="form-control" name="inputCIA3Marks[]" id="inputCIA3Marks" placeholder="CIA3 Marks" max="100" required>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-4">
            	<input type="number" class="form-control" name="inputHrsAttended[]" id="inputHrsAttended" placeholder="Hours Attended" max="100" required>
            </div>
            <div class="form-group col-md-4">
            	<input type="number" class="form-control" name="inputAttnMarks[]" id="inputAttnMarks" placeholder="Attendance Marks" max="100" required>
            </div>
            <div class="form-group col-md-4">
            	<input type="number" class="form-control" name="inputEndsemMarks[]" id="inputEndsemMarks" placeholder="End Sem Marks" max="100" required>
            </div>
         </div>
      </div>
   </div>
   <a href="#" class="delete">Delete</a>
</div>