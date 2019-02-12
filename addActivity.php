<?php require("db.php"); ?>
<div>
 <div class="buttoncontainer">
  <div class="form-group">
   <label for="projectdetails"><strong>Activity Details - <?php echo $_GET['x']; ?></strong></label>
   <div class="form-row">
    <div class="form-group col-md-3">
     <input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999" required>
   </div>
   <div class="form-group col-md-3">
     <select name ="inputActivityType[]" id="inputActivityType" class="form-control" required>
      <option selected disabled>Select activity type</option>
      <?php
      $activity_sql="SELECT * FROM activity_type ORDER BY Type_Name ASC";
      $activity_result=$conn->query($activity_sql);

      if($activity_result->num_rows > 0)
      {
       while($activity_row=$activity_result->fetch_assoc())
        { ?>
         <option value="<?php echo $activity_row['idActivity_type']; ?>"><?php echo $activity_row['Type_Name']; ?></option>
       <?php   }
     }

     ?>
   </select>
 </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
   <input type="text" class="form-control" name="inputProjectName[]" id="inputProjectName" placeholder="Topic">
 </div> 
 <div class="form-group col-md-6">
   <input type="text" class="form-control"  name = "inputProjectDomain[]" id="inputProjectDomain" placeholder="Upload Link">
 </div> 
 <div class="form-group col-md-3">
  <input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="inputStartDate[]" id="inputStartDate" >
</div>
<div class="form-group col-md-3">
  <input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="inputEndDate[]" id="inputEndDate" >
</div>

</div>
<div class="form-row">
  <div class="form-group col-md-3">
   <input type="text" class="form-control" name="inputRole[]" id="inputRole" placeholder="Role">
 </div>
 <div class="form-group col-md-3">
   <input type="text" class="form-control" name="inputProjectWorkDesc[]" id="inputProjectWorkDesc" placeholder="Work Description">
 </div>

 <div class="form-group col-md-3">
   <select name="inputMemberNo[]" id="inputMemberNo" class="form-control" required>
     <option selected>Number of Team Members</option>
     <option>1</option>
     <option>2</option>
     <option>3</option>
     <option>4</option>
     <option>5</option>
   </select>
 </div>
 <div class="form-group col-md-3">
  <input type="number" stipend="0.01" class="form-control" name="inputStipend[]" id="inputStipend" placeholder="Stipend" required>
</div>
</div>
</div>
</div>
<a href="#" class="delete">Delete</a>
<br><br>
</div>