<?php

require("db.php");


if(isset($_POST['submit']))
{

  $inputRegisterNo = $_POST["inputRegisterNo"];
  $inputManagedEventName = $_POST["inputManagedEventName"];
  $inputEventLocation = $_POST["inputEventLocation"];
  $inputStartDate = $_POST["inputStartDate"];
  $inputEndDate = $_POST["inputEndDate"];
  $inputRole = $_POST["inputRole"];
  $inputManagedEventsDesc = $_POST["inputManagedEventsDesc"];

  foreach ($inputManagedEventName as $key => $value)
  {
    $insert_query = "INSERT INTO `managed_events`(`Studentid`, `Name`, `StartDate`, `EndDate`, `Role`, `WorkDescription`, `Location`) VALUES ($inputRegisterNo[$key],'$inputManagedEventName[$key]','$inputStartDate[$key]','$inputEndDate[$key]','$inputRole[$key]','$inputManagedEventsDesc[$key]','$inputEventLocation[$key]')";

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
	<title>Managed Events Form</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
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


          $(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><label for="projectdetails"><strong>Managed Events Details</strong></label><div class="form-row"><div class="form-group col-md-3"><input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999"></div>  </div><div class="form-row"><div class="form-group col-md-6"><input type="text" class="form-control" name="inputManagedEventName[]" id="inputManagedEventName" placeholder="Event Name"></div>  <div class="form-group col-md-6"><input type="text" class="form-control" name="inputEventLocation[]" id="inputEventLocation" placeholder="Event Location"></div> <div class="form-group col-md-3"><input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type=\'date\')" onblur="(this.type=\'text\')" name="inputStartDate[]" id="inputStartDate" ></div><div class="form-group col-md-3"><input placeholder="End Date" class="form-control" type="text" onfocus="(this.type=\'date\')" onblur="(this.type=\'text\')" name="inputEndDate[]" id="inputEndDate" ></div></div><div class="form-row"> <div class="form-group col-md-4"><input type="text" class="form-control" name="inputRole[]" id="inputRole" placeholder="Role"></div> <div class="form-group col-md-4"><input type="text" class="form-control" name="inputManagedEventsDesc[]" id="inputManagedEventsDesc" placeholder="Work Description"></div></div> </div></div><a href="#" class="delete">Delete</a></div>')
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
  </script>
  
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
        <form method="POST" action="#">
          <div class="form-group details">
            <label for="projectdetails"><strong>Managed Events Details</strong></label>
            <div class="form-row">
              <div class="form-group col-md-3">
               <input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999" required>
             </div>	
           </div>
           <div class="form-row">
            <div class="form-group col-md-6">
             <input type="text" class="form-control" name="inputManagedEventName[]" id="inputManagedEventName" placeholder="Event Name">
           </div>	
           <div class="form-group col-md-6">
             <input type="text" class="form-control" name="inputEventLocation[]" id="inputEventLocation" placeholder="Event Location">
           </div>	
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
            <input type="text" class="form-control" name="inputManagedEventsDesc[]" id="inputManagedEventsDesc" placeholder="Work Description">
          </div>
        </div> 
      </div>
       <br>
      <button type="button" class="add_form_field btn btn-outline-primary">Add Managed Event +</button>
      <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
    </form>  
  </div>
</div>
</div>
</body>
</html>