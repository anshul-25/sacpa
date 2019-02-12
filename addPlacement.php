<?php require("db.php") ?>

<div>
   <div class="buttoncontainer">
      <div class="form-group details">
         <div class="form-group">
            <label for="projectdetails"><strong>Placements Details</strong></label>
            <div class="form-row">
               <div class="form-group col-md-3"><input type="text" name="inputRegisterNo[]" class="form-control" id="inputRegisterNo" placeholder="Register No." pattern="[0-9]{7}" required></div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-4">
                  <select class="form-control" name="inputCompanyName[]" id="inputCompanyName" required>
                    <option selected disabled>Select Company</option>
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
              <div class="form-group col-md-4">
               <select name="inputRounds[]" id="inputRounds" class="form-control" required>
                  <option disabled selected>Rounds Qualified</option>
                  <option>0</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
               </select>
            </div>
         </div>
      </div>
   </div>
</div>
<a href="#" class="delete">Delete</a>
</div>