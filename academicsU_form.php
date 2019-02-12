<?php
require("db.php");


if(isset($_POST["submit"]))
{
  $inputRegisterNo = $_POST["inputRegisterNo"];
  $inputSubject = $_POST["inputSubject"];
  $inputCIA1Marks = $_POST["inputCIA1Marks"];
  $inputCIA2Marks = $_POST["inputCIA2Marks"];
  $inputCIA3Marks = $_POST["inputCIA3Marks"];
  $inputEndsemMarks = $_POST["inputEndsemMarks"];
  $inputHrsAttended = $_POST["inputHrsAttended"];
  $inputAttnMarks = $_POST["inputAttnMarks"];

  $q = "Select CIA1_Max, CIA2_Max, CIA3_Max, EndSem_Max, Attendance_Max, Max_Hours from subjects WHERE idSubjects=\"".$inputSubject[0]."\"";
  $res = $conn->query($q);
  $row = $res->fetch_assoc();

  if($inputCIA1Marks[0] <= $row["CIA1_Max"] && $inputCIA2Marks[0] <= $row["CIA2_Max"] && $inputCIA3Marks[0] <= $row["CIA3_Max"] && $inputEndsemMarks[0] <= $row["EndSem_Max"] && $inputHrsAttended[0] <= $row["Max_Hours"] && $inputAttnMarks[0] <= $row["Attendance_Max"])
  {

    foreach ($inputSubject as $key => $value)
    {
      $insert_query = "INSERT INTO `sub_marks`(`Student_id`, `Subject_id`, `Hours_Attended`, `CIA1_Obt`, `CIA2_Obt`, `CIA3_Obt`, `EndSem_Obt`, `Atten_Obt`) VALUES ($inputRegisterNo[$key],'$inputSubject[$key]',$inputHrsAttended[$key],$inputCIA1Marks[$key],$inputCIA2Marks[$key],$inputCIA3Marks[$key],$inputEndsemMarks[$key],$inputAttnMarks[$key])";

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
  else
  {
    include 'modal_unsuccess_maxmarks.html';
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
      <form method="POST" action="#">
        <label><strong>ACADEMICS DETAILS - University</strong></label>
        <div class="buttoncontainer">
          <div class="form-group details">
            <label for="projectdetails"><strong>Subject Marks</strong></label>
            <div class="form-row">
              <div class="form-group col-md-4">
                <input type="text" class="form-control" name="inputRegisterNo[]" id="inputRegisterNo" placeholder="Register Number" pattern="[0-9]{7}" required>
              </div>  
              <div class="form-group col-md-4">
                <select name="inputSubject[]" id="inputSubject" class="form-control" required>
                  <option disabled selected>Select Subject</option>
                  <?php
                  $subj_sql="SELECT * FROM subjects ORDER BY Subj_Name ASC";
                  $subj_result=$conn->query($subj_sql);

                  if($subj_result->num_rows > 0)
                  {
                    while($subj_row=$subj_result->fetch_assoc())
                      { ?>
                        <option value="<?php echo $subj_row['idSubjects']; ?>"><?php echo $subj_row['Subj_Name']; ?></option>
                      <?php   }
                    }

                    ?>
                  </select>
                </div>  
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputCIA1Marks[]" id="inputCIA1Marks" placeholder="CIA 1 Marks" max="100" required>
                </div>  
                <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputCIA2Marks[]" id="inputCIA2Marks" placeholder="CIA 2 Marks" max="100" required>
                </div>
                <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputCIA3Marks[]" id="inputCIA3Marks" placeholder="CIA 3 Marks" max="100" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputHrsAttended[]" id="inputHrsAttended" placeholder="Hours Attended" max="100" required>
                </div>
                <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputAttnMarks[]" id="inputAttnMarks" placeholder="Attendance Marks" max="100" required>
                </div>
                <div class="form-group col-md-4">
                  <input type="number" class="form-control" name="inputEndsemMarks[]" id="inputEndsemMarks" placeholder="End Sem Marks" max="200" required>
                </div>  
              </div>
            </div>
            <div class="addDetails">
            </div>
            <br>
            <button type="button" onclick="addSubMarks()" class="btn btn-outline-primary">Add Subject +</button>
            <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="common.js"></script>


  </body>
  </html>