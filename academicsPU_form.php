<?php

require("db.php");


if(isset($_POST['submit']))
{
  $flag=0;
  //class 10
  $inputRegisterNo10 = $_POST["inputRegisterNo10"];
  $inputExamRegisterNo10 = $_POST["inputExamRegisterNo10"];
  $inputStream10 = $_POST["inputStream10"];
  $inputBoard10 =$_POST["inputBoard10"];
  $inputTotalMarks10= $_POST["inputTotalMarks10"];
  $inputMarksObtained10 = $_POST["inputMarksObtained10"];
  $inputYear10 = $_POST["inputYear10"];

  //class 12
  $inputRegisterNo12 = $_POST["inputRegisterNo12"];
  $inputExamRegisterNo12 = $_POST["inputExamRegisterNo12"];
  $inputStream12 = $_POST["inputStream12"];
  $inputBoard12 =$_POST["inputBoard12"];
  $inputTotalMarks12= $_POST["inputTotalMarks12"];
  $inputMarksObtained12 = $_POST["inputMarksObtained12"];
  $inputYear12 = $_POST["inputYear12"];

  $insert_query1 = "INSERT INTO `class10`(`studentid`, `exam_regno`, `Stream`, `Board`, `Total_Marks`, `Marks_obt`, `Year`) VALUES ($inputRegisterNo10,$inputExamRegisterNo10,'$inputStream10','$inputBoard10',$inputTotalMarks10,$inputMarksObtained10,$inputYear10)";

  $insert_query2 = "INSERT INTO `class12`(`Studentid`, `Exam_reg_no`, `Board`, `Stream`, `Total_marks`, `Marks_Obt`, `Year`) VALUES ($inputRegisterNo12,$inputExamRegisterNo12,'$inputBoard12','$inputStream12',$inputTotalMarks12,$inputMarksObtained12,$inputYear12)";

  if(($inputMarksObtained10 <= $inputTotalMarks10) && ($inputMarksObtained12 <= $inputTotalMarks12))
  {
    if($conn->query($insert_query1) === TRUE)
    {
      if($conn->query($insert_query2) === TRUE)
      {
        include 'modal_sample_success.html';
      }
      else
      {
        include 'modal_sample_unsuccess.html';        
      }
    }
    else
    {
      include 'modal_sample_unsuccess.html';
    }
  }
  else
  {
    include 'modal_sample_unsuccess_maxmarks.html';
  }
}

?>

  <!DOCTYPE html>
  <html>
  <head>
   <title>Academics Form</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
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
    <div class="container-fluid text-dark m-0 p-3">
      <form id="myForm" method="POST" onsubmit="return validateForm()" action="#">
       <label for="projectdetails"><strong>ACADEMICS DETAILS - Pre University</strong></label>
       <div class="form-group">


        <label for="projectdetails"><strong>Class 10</strong></label>
        <div class="form-row">
          <div class="form-group col-md-4">
            <input type="number" name="inputRegisterNo10" class="form-control" id="inputRegisterNo10" placeholder="Register Number" max="99999999" required>
          </div>  
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <input type="text" name="inputExamRegisterNo10" class="form-control" id="inputExamRegisterNo10" placeholder="Exam Register No." required>
          </div>  
          <div class="form-group col-md-4">
            <select name="inputStream10" class="form-control" id="inputStream10" required>
              <option selected disabled>Select Stream</option>
              <option>Science</option>
              <option>Commerce</option>
              <option>Humanities</option>
              <option>General</option>
            </select>
          </div>  
          <div class="form-group col-md-4">
            <input type="text" name="inputBoard10" class="form-control" id="inputBoard10" placeholder="Board" required>
          </div>  
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <input type="number" name="inputTotalMarks10" class="form-control" id="inputTotalMarks10" step="0.01" placeholder="Total Marks" max="1200" required>
          </div>  
          <div class="form-group col-md-4">
            <input type="number" name="inputMarksObtained10" class="form-control" id="inputMarksObtained10" step="0.01" placeholder="Marks Obtained" max="1200" required>
          </div>  
          <div class="form-group col-md-4">
            <input type="number" name="inputYear10" class="form-control" id="inputYear10" placeholder="Year of Exam" min="1900" max="2500" required>
          </div>
        </div>
      </div>

      <div class="form-group">
       <label for="projectdetails"><strong>Class 12</strong></label>
       <div class="form-row">
        <div class="form-group col-md-4">
          <input type="number" name="inputRegisterNo12" class="form-control" id="inputRegisterNo12" placeholder="Register Number" max="99999999" required>
        </div>  
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <input type="text" name="inputExamRegisterNo12" class="form-control" id="inputExamRegisterNo12" placeholder="Exam Register No." required>
        </div>  
        <div class="form-group col-md-4">
         <select name="inputStream12" class="form-control" id="inputStream12" required>
          <option selected disabled>Select Stream</option>
          <option>Science</option>
          <option>Commerce</option>
          <option>Humanities</option>
          <option>General</option>
        </select>
      </div>  
      <div class="form-group col-md-4">
        <input type="text" name="inputBoard12" class="form-control" id="inputBoard12" placeholder="Board">
      </div>  
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <input type="number" name="inputTotalMarks12" class="form-control" id="inputTotalMarks12" step="0.01" placeholder="Total Marks" max="1200" required>
      </div>  
      <div class="form-group col-md-4">
        <input type="number" name="inputMarksObtained12" class="form-control" id="inputMarksObtained12" step="0.01" placeholder="Marks Obtained" max="1200" required>
      </div>  
      <div class="form-group col-md-4">
        <input type="number" name="inputYear12" class="form-control" id="inputYear12" placeholder="Year of Exam" min="1900" max="2500" required>
      </div>
    </div>
  </div>

  <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
</form>

<script>

  function validateForm()
  {
    var x = parseFloat(document.forms["myForm"]["inputTotalMarks10"].value());
    var y = parseFloat(document.forms["myForm"]["inputMarksObtained10"].value());
    if (y > x)
    {
      alert("Marks Obtained in Class 10 should be less than Total Marks");
      return false;
    }

    var a = parseFloat(document.forms["myForm"]["inputTotalMarks12"].value());
    var b = parseFloat(document.forms["myForm"]["inputMarksObtained12"].value());
    if(b>a)
    {
      alert("Marks Obtained in Class 12 should be less than Total Marks");
      return false;
    }
  }

</script>
</div>
</div>
</body>
</html>