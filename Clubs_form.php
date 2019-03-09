<?php

require("db.php");


if(isset($_POST['submit']))
{

  $inputRegisterNo = $_POST["inputRegisterNo"];
  $inputClubName = $_POST["inputClubName"];
  if($inputClubName[0]==0)
  {
    $inputClubName=$_POST["inputClubName1"];
  }
  $inputStartDate = $_POST["inputStartDate"];
  $inputEndDate = $_POST["inputEndDate"];
  $inputRole = $_POST["inputRole"];
  $inputWorkDesc = $_POST["inputWorkDesc"];

  foreach ($inputClubName as $key => $value)
  {
    $insert_query = "INSERT INTO `clubs_organisations`(`Studentid`, `Name`, `Role`, `StartDate`, `EndDate`, `WorkDescription`) VALUES ($inputRegisterNo[$key],'$inputClubName[$key]','$inputRole[$key]','$inputStartDate[$key]','$inputEndDate[$key]','$inputWorkDesc[$key]')";

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
	<title>Club Form</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <!-- <script type="text/javascript">
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


          $(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><label for="projectdetails"><strong>Clubs/Organisations Details</strong></label><div class="form-row"><div class="form-group col-md-3"><input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999" required></div>  </div><div class="form-row"><div class="form-group col-md-12"><input type="text" class="form-control" name="inputClubName[]" id="inputClubName" placeholder="Club/Organisation Name"></div><div class="form-group col-md-6"><label for="startdate">Start Date</label><input type="date" class="form-control" name="inputStartDate[]" id="inputStartDate" ></div><div class="form-group col-md-6"><label for="enddate">End Date</label><input type="date" class="form-control" name="inputEndDate[]" id="inputEndDate" ></div></div><div class="form-row"><div class="form-group col-md-6"><input type="text" class="form-control" name="inputRole[]" id="inputRole" placeholder="Role"></div><div class="form-group col-md-6"><input type="text" class="form-control" name="inputWorkDesc[]" id="inputWorkDesc" placeholder="Work Description"></div></div></div></div></div><a href="#" class="delete">Delete</a></div>')
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
  <div class="vertical-center ">
    <div class="container-fluid  text-dark m-0 p-3">
      <div class="buttoncontainer">
        <form method="post" action="#">
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
         <!-- <button class="add_form_field btn btn-success">Add Clubs &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button> 
         <br><br>
         <div class="form-row">
          <div class="form-group col-md-2">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </div> -->
        <br>
        <div class="addDetails">
        </div>
        <br>
        <button type="button" onclick="addClubs()" class="add_form_field btn btn-outline-primary">Add Clubs/Organisation Event +</button>
        <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="common.js"></script>
</body>
</html>