<?php

require("db.php")
?>

<div>
   <div class="buttoncontainer">
      <div class="form-group">
         <label><strong>Department Details</strong></label>
         <div class="form-row">
            <div class="form-group col-md-4"><input type="text" class="form-control" name="inputDepartmentName[]" id="inputDepartmentName" placeholder="Department Name"></div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-4"><input type="text" class="form-control" name="inputHODName[]" id="inputHODName" placeholder="HOD Name"></div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-4"><input type="text" class="form-control" name="inputHODContact[]" id="inputHODContact" pattern="[0-9]{10}" placeholder="HOD Contact" required></div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-4">
               <select name="inputDeanery[]" id="inputDeanery" class="form-control">
                  <option disabled selected>Select Deanery</option>
                  <?php
                  $dept_sql="SELECT * FROM deneary ORDER BY Deneary_Name ASC";
                  $dept_result=$conn->query($dept_sql);

                  if($dept_result->num_rows > 0)
                  {
                     while($dept_row=$dept_result->fetch_assoc())
                        { ?>
                           <option value="<?php echo $dept_row['idDeneary']; ?>"><?php echo $dept_row['Deneary_Name']; ?></option>
                        <?php   }
                     }

                     ?>
                  </select>
               </div>
            </div>
         </div>
      </div>
      <a href="#" class="delete">Delete</a>
</div>