<?php require("db.php"); ?>


<div>
 <div class="buttoncontainer">
  <div class="form-group details">
   <div class="form-group">
    <label for="projectdetails"><strong>Internship Details</strong></label>
    <div class="form-row">
      <div class="form-group col-md-4">
        <input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999" required>
      </div>
      <div class="form-group col-md-4">
        <input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="inputStartDate" name="inputStartDate[]" required>
      </div>
      <div class="form-group col-md-4">
       <input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="inputEndDate" name="inputEndDate[]" required>
     </div>
   </div>
   <div class="form-row">
     <div class="form-group col-md-4">
      <select name="inputCompany[]" id="inputCompany" class="form-control" required>
       <option disabled selected>Select Company</option>
       <?php
       $activity_sql="SELECT * FROM company ORDER BY CompanyName ASC";
       $activity_result=$conn->query($activity_sql);

       if($activity_result->num_rows > 0)
       {
        while($activity_row=$activity_result->fetch_assoc())
          { ?>
            <option value="<?php echo $activity_row['idCompany']; ?>"><?php echo $activity_row['CompanyName']; ?></option>
          <?php   }
        }

        ?>
      </select>
    </div>
    <div class="form-group col-md-4"><input type="text" class="form-control" name="inputWorkDesc[]" id="inputWorkDesc" placeholder="Work Description"></div>
    <div class="form-group col-md-4"><input type="text" class="form-control" name="inputRole[]" id="inputRole" placeholder="Role"></div>
  </div>
</div>
</div>
</div>
<a href="#" class="delete">Delete</a>
</div>