<?php

require("db.php");


if(isset($_POST['submit']))
{

  $inputRegisterNo = $_POST["inputRegisterNo"];
  $inputActivityType = $_POST["inputActivityType"];
  $inputProjectName = $_POST["inputProjectName"];
  $inputProjectDomain = $_POST["inputProjectDomain"];
  $inputStartDate = $_POST["inputStartDate"];
  $inputEndDate = $_POST["inputEndDate"];
  $inputRole = $_POST["inputRole"];
  $inputProjectWorkDesc = $_POST["inputProjectWorkDesc"];
  $inputMemberNo = $_POST["inputMemberNo"];
  $inputStipend = $_POST["inputStipend"];

  foreach ($inputProjectName as $key => $value)
  {
    $insert_query = "INSERT INTO `activity`(`Studentid`, `Type`, `StartDate`, `EndDate`, `Name`, `Role`, `WorkDescription`, `Stipend`, `No_of_team_members`, `Work_link`) VALUES ($inputRegisterNo[$key],$inputActivityType[$key],'$inputStartDate[$key]','$inputEndDate[$key]','$inputProjectName[$key]','$inputRole[$key]','$inputProjectWorkDesc[$key]',$inputStipend[$key],$inputMemberNo[$key],'$inputProjectDomain[$key]')";

    if ($conn->query($insert_query) === TRUE) 
    {
      include 'modal_sample_success.html';
    } 
    else 
    {
      include 'modal_sample_unsuccess.html';
    }

  }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Activity Form</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <!-- 
  <script type="text/javascript">
  $(document).ready(function() 
  {
    var max_fields      = 10;
    var wrapper         = $(".details");
    var add_button      = $(".add_form_field");
 
    var x = 1;
    $(add_button).click(function(e)
    {
        e.preventDefault();
        if(x < max_fields)
        {
            x++;
             

             $(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><label for="projectdetails"><strong>Activity Details - '+x+'</strong></label><div class="form-row"><div class="form-group col-md-3"><input type="text" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No."></div>  <div class="form-group col-md-3"><select name ="inputActivityType[]" id="inputActivityType" class="form-control"><option selected>Research</option><option>Project</option></select></div></div><div class="form-row"><div class="form-group col-md-6"><input type="text" class="form-control" id="inputProjectName" placeholder="Research Name"></div>  <div class="form-group col-md-6"><input type="text" class="form-control" id="inputProjectDomain" placeholder="Upload Link"></div>  <div class="form-group col-md-3"><label for="startdate">Start Date</label><input type="date" class="form-control" id="inputStartDate"></div><div class="form-group col-md-3"><label for="enddate">End Date</label><input type="date" class="form-control" id="inputEndDate" ></div></div><div class="form-row"><div class="form-group col-md-3"><input type="text" class="form-control" id="inputProjectRole" placeholder="Role"></div><div class="form-group col-md-3"><input type="text" class="form-control" id="inputProjectWorkDesc" placeholder="Work Description"></div><div class="form-group col-md-3"><select id="inputMemberNo" class="form-control"><option selected>Number of Team Members</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></div><div class="form-group col-md-3"><input type="text" class="form-control" id="inputProjectWorkDesc" placeholder="Stipend"></div></div></div></div><a href="#" class="delete">Delete</a></div>')
        }
      else
      {
        alert('You Reached the limits')
      }
    });
 
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  });
</script> -->

<style type="text/css">
html, body{
  height:100%; /* important to vertically align the container */
  margin:0;
  padding:0;
}

.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one 🙂       */
  display: flex;
  align-items: top;
}

.container
{
 padding-right: 15px;
 padding-left: 15px;
 padding-top: 15px;
 padding-bottom: 15px;
}
</style>
</head>

<body>
  <div class="vertical-center">
    <div class="container-fluid text-dark m-0 p-3">
      <div class="buttoncontainer">
        <div class="form-group details">
          <form method="post" action="#">
            <label for="projectdetails"><strong>Activity Details - 1</strong></label>
            <div class="form-row">
              <div class="form-group col-md-3">
               <input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999" required>
             </div>	
             <div class="form-group col-md-3">
              <select name="inputActivityType[]" id="inputActivityType" class="form-control" required>
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
        <div class="addDetails">
        </div>
        <br>
        <!-- <button type="button" onclick="addActivity()" class="add_form_field btn btn-success">Add Activity &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button> 
        <br><br>
        <div class="form-row">
          <div class="form-group col-md-2">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </div> -->
        <button type="button" onclick="addActivity()" class="btn btn-outline-primary">Add Activity +</button>
        <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="common.js"></script>
</body>
</html>