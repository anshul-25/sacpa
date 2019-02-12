<?php require("db.php") ?>

<div>
   <div class="buttoncontainer">
      <div class="form-group">
         <label><strong>Subject Details</strong></label>
         <div class="form-row">
            <div class="form-group col-md-4"><input type="text" class="form-control" name="inputSubjectId[]" id="inputSubjectId" placeholder="Subject ID" required></div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-4">
               <select name="inputCourseDrop[]" id="inputCourseDrop" class="form-control" required>
                  <option disabled selected>Select Course</option>
                  <?php
                  $course_sql="SELECT * FROM programme ORDER BY Course_Name ASC";
                  $course_result=$conn->query($course_sql);

                  if($course_result->num_rows > 0)
                  {
                     while($course_row=$course_result->fetch_assoc())
                        { ?>
                           <option value="<?php echo $course_row['idCourse']; ?>"><?php echo $course_row['Course_Name']; ?></option>
                        <?php   }
                     }

                     ?>
                  </select>
               </div>
               <div class="form-group col-md-4">
                  <select class="form-control" name="inputSemesterNo[]" id="inputSemesterNo" required>
                     <option selected disabled>Enter semester no.</option>
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
               <div class="form-group col-md-4">
                  <input type="text" class="form-control" name="inputSubjectName[]" id="inputSubjectName" placeholder="Subject Name">
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputCIA1MaxMarks[]" id="inputCIA1MaxMarks" placeholder="CIA1 Max Marks" max="100" required>
               </div>
               <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputCIA2MaxMarks[]" id="inputCIA2MaxMarks" placeholder="CIA2 Max Marks" max="100" required>
               </div>
               <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputCIA3MaxMarks[]" id="inputCIA3MaxMarks" placeholder="CIA3 Max Marks" max="100" required>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputEndSemMaxMarks[]" id="inputEndSemMaxMarks" placeholder="End Sem Max Marks" max="200" required>
               </div>
               <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputAttnMaxMarks[]" id="inputAttnMaxMarks" placeholder="Attendance Max Marks" max="100" required>
               </div>
               <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputTotalHrsCond[]" id="inputTotalHrsCond" placeholder="Total Hours Conducted" max="100" required>
               </div>
            </div>
         </div>
      </div>
      <a href="#" class="delete">Delete</a>
   </div>