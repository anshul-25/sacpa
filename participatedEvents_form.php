<?php

require("db.php");


if(isset($_POST['submit']))
{

  $inputRegisterNo = $_POST["inputRegisterNo"];
  $inputParticipatedEventName = $_POST["inputParticipatedEventName"];
  $inputEventLocation = $_POST["inputEventLocation"];
  $inputDate = $_POST["inputDate"];
  $inputPosition = $_POST["inputPosition"];
  $inputMemberNo = $_POST["inputMemberNo"];

  foreach ($inputParticipatedEventName as $key => $value)
  {
    $insert_query = "INSERT INTO `participated_events`(`StudentId`, `name`, `position`, `location`, `date`,`No_of_members`) VALUES ($inputRegisterNo[$key],'$inputParticipatedEventName[$key]','$inputPosition[$key]','$inputEventLocation[$key]','$inputDate[$key]','$inputMemberNo[$key]')";

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
	<title>Participated Events Form</title>
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


          $(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><label for="projectdetails"><strong>Participated Events Details</strong></label><div class="form-row"><div class="form-group col-md-3"><input type="text" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" pattern="[0-9]{8}" placeholder="Register No."></div>  </div><div class="form-row"><div class="form-group col-md-6"><input type="text" class="form-control" name="inputParticipatedEventName[]" id="inputParticipatedEventName" placeholder="Event Name"></div>  <div class="form-group col-md-6"><input type="text" class="form-control" name="inputEventLocation[]" id="inputEventLocation" placeholder="Event Location"></div>  <div class="form-group col-md-3"><input placeholder="Date" type="date" class="form-control" onfocus="(this.type=\'date\')" onblur="(this.type=\'text\')" name="inputDate[]" id="inputDate" ></div></div><div class="form-row"> <div class="form-group col-md-4"><input type="text" class="form-control" name="inputPosition[]" id="inputPosition" placeholder="Position"></div><div class="form-group col-md-4"><select  name="inputMemberNo[]" id="inputMemberNo" class="form-control"><option selected>Number of Team Members</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></div></div> </div></div><a href="#" class="delete">Delete</a></div>')
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
            <label for="projectdetails"><strong>Participated Events Details</strong></label>
            <div class="form-row">
              <div class="form-group col-md-3">
               <input type="text" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo"  pattern="[0-9]{8}" placeholder="Register No.">
             </div>	
           </div>
           <div class="form-row">
            <div class="form-group col-md-6">
             <input type="text" class="form-control" name="inputParticipatedEventName[]" id="inputParticipatedEventName" placeholder="Event Name">
           </div>	
           <div class="form-group col-md-6">
             <input type="text" class="form-control" name="inputEventLocation[]" id="inputEventLocation" placeholder="Event Location">
           </div>	
           <div class="form-group col-md-3">
            <input placeholder="Date" type="date" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')" name="inputDate[]" id="inputDate" >
          </div>


        </div>
        <div class="form-row"> 
          <div class="form-group col-md-4">
            <input type="text" class="form-control" name="inputPosition[]" id="inputPosition" placeholder="Position">
          </div>

          <div class="form-group col-md-4">
            <select name="inputMemberNo[]" id="inputMemberNo" class="form-control" required>
              <option selected>Number of Team Members</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div> 
      </div>
      <!--  <button type="button" class="add_form_field btn btn-success">Add Event &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>  -->
      <!-- <br><br>
      <div class="form-row">
        <div class="form-group col-md-2">
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
      </div> -->
      <br>
      <button type="button" class="add_form_field btn btn-outline-primary">Add Participated Event +</button>
      <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
</div>

</body>
</html>