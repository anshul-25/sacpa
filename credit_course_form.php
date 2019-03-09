<?php  
require("db.php");

if (isset($_POST["submit"])) 
{
  $inputRegisterNo=$_POST["inputRegisterNo"];
  $inputCCName=$_POST["inputCCName"];
    //print_r($inputCCName);
  if($inputCCName[0] == 0)
  {
    $inputCCName = $_POST["inputCCName1"];
  }
  else
  {
    $inputCCName=$_POST["inputCCName"]; 
  }
  $credits=$_POST["credits"];
  $inputTotalMarks=$_POST["inputTotalMarks"];
  $inputMarksObt=$_POST["inputMarksObt"];
  $inputHrsConducted=$_POST["inputHrsConducted"];
  $inputHrsAttended=$_POST["inputHrsAttended"];

  if($inputMarksObt[0] <= $inputTotalMarks[0])
  {
    foreach ($inputCCName as $key => $value)
    {
      $insert_query="INSERT INTO `credit_course`(`Studentid`, `Name`, `Credits`, `TotalMarks`, `MarksObtained`, `HoursConducted`, `HoursAttended`) VALUES ($inputRegisterNo[$key],'$inputCCName[$key]',$credits[$key],$inputTotalMarks[$key],$inputMarksObt[$key],$inputHrsConducted[$key],$inputHrsAttended[$key])" ;

      if ($conn->query($insert_query)===TRUE) 
      {
        include 'modal_sample_success.html';
      } 
      else
      {
        include 'modal_sample_unsuccess.html';
      }
    }  
  }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Credit Course Form</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

 <!--  <script type="text/javascript">
    $(document).ready(function() 
    {
      var max_fields      = 10;
      var wrapper         = $(".details");
      var add_button      = $(".btn-outline-primary");

      var x = 1;
      $(add_button).click(function(e)
      {
        e.preventDefault();
        if(x < max_fields)
        {
          x++;

          $(wrapper).append('<div><div class="buttoncontainer"><div class="form-group details"><div class="form-group"><label for="projectdetails"><strong>Credit Course Details</strong></label><div class="form-row"><div class="form-group col-md-4"><input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." required></div><div class="form-group col-md-4"><input type="text" class="form-control" name="inputCCName[]" id="inputCCName" placeholder="Credit Course Name" required></div> <div class="form-group col-md-4"><select name="credits[]" id="credits" class="form-control" required><option disabled selected>Credits</option><option>1</option><option>2</option><option>3</option><option>4</option></select></div></div><div class="form-row"><div class="form-group col-md-3"><input type="number" class="form-control" name="inputTotalMarks[]" id="inputTotalMarks" max="100" placeholder="Total Marks"></div> <div class="form-group col-md-3"><input type="number" class="form-control" name="inputMarksObt[]" id="inputMarksObt" placeholder="Marks Obtained" max="100"></div> <div class="form-group col-md-3"><input type="number" class="form-control" name="inputHrsConducted[]" id="inputHrsConducted" placeholder="Hours Conducted" max="100"></div> <div class="form-group col-md-3"><input type="number" class="form-control" name="inputHrsAttended[]" id="inputHrsAttended" placeholder="Hours Attended" max="100"></div> </div></div></div></div><a href="#" class="delete">Delete</a></div>')
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
        <form action="#" method="POST">
          <div class="form-group details">
            <div class="form-group">
              <label for="projectdetails"><strong>Credit Course Details</strong></label>
              <div class="form-row">
                <div class="form-group col-md-4">
                 <input type="number" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register No." max="99999999" required>
               </div>
               <div class="form-group col-md-4">
                 <select name="inputCCName[]" id="inputCCName" class="form-control" onchange="getCC()">
                   <option value="" disabled selected>Select Credit Course</option>
                   <?php
                   $q="Select distinct Name from credit_course";
                   $r=$conn->query($q);

                   while($row=$r->fetch_assoc())
                   {
                    echo "<option>".$row['Name']."</option>";
                  }
                  ?>
                  <option value="0">Other</option>
                </select>
              </div>
              <div class="form-group col-md-4">
               <input type="text" class="form-control" name="inputCCName1[]" id="inputCCName1" placeholder="Other" disabled>
             </div> 
             <script type="text/javascript">
               function getCC()
               {
                if(document.getElementById("inputCCName").value == 0)
                {
                  document.getElementById("inputCCName1").disabled = false;
                }
                else
                {
                  document.getElementById("inputCCName1").disabled = true; 
                }
              }
            </script>
            <div class="form-group col-md-4">
             <select name="credits[]" id="credits" class="form-control" required>
              <option disabled selected>Credits</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </div> 
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
           <input type="number" class="form-control" name="inputTotalMarks[]" id="inputTotalMarks" placeholder="Total Marks" max="100" required>
         </div>	
         <div class="form-group col-md-3">
           <input type="number" class="form-control" name="inputMarksObt[]" id="inputMarksObt" placeholder="Marks Obtained" max="100" required>
         </div> 
         <div class="form-group col-md-3">
           <input type="number" class="form-control" name="inputHrsConducted[]" id="inputHrsConducted" placeholder="Hours Conducted" max="100" required>
         </div> 
         <div class="form-group col-md-3">
           <input type="number" class="form-control" name="inputHrsAttended[]" id="inputHrsAttended" placeholder="Hours Attended" max="100" required>
         </div> 
       </div>
     </div>
   </div>

   <br>
   <div class="addDetails">
   </div>
   <br>
   <button type="button" onclick="addCC()" class="btn btn-outline-primary">Add Credit Course +</button>
   <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
 </form>
</div>
</div>
</div>
<script type="text/javascript" src="common.js"></script>
</body>
</html>