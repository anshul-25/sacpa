<?php

require("db.php");

if(isset($_POST["submit"]))
{
  $flag=0;
	// student_personal details
  $registerno = $_POST["inputRegisterNo"];
  $title = $_POST["inputTitle"];
  $registerno = $_POST["inputRegisterNo"];
  $firstname = $_POST["inputFirstName"];
  $lastname = $_POST["inputThirdName"];
  $phoneno = $_POST["inputPhone"];
  $emailid = $_POST["inputEmailid"];
  $house = $_POST["inputHouse"];
  $street = $_POST["inputStreet"];
  $city = $_POST["inputCity"];
  $zipcode = $_POST["inputZip"];
  $reservation = $_POST["inputReservation"];
  $programme = $_POST["inputProgramme"];
  $yod = $_POST["inputYOD"];
  $religion = $_POST["inputReligion"];


  $insert_query = "INSERT INTO student(RegisterNo,Title,FirstName,LastName,PhoneNo,EmailIdPersonal,HouseNo,Streetno,City_id,zipcode,Religion,ReservationCategory,ProgrammeID,Year_of_Admission) VALUES ($registerno,\"$title\", \"$firstname\",\"$lastname\",$phoneno,\"$emailid\",\"$house\",\"$street\",$city,$zipcode,\"$religion\",\"$reservation\",$programme,\"$yod\")";

  if ($conn->query($insert_query) === TRUE) 
  {
    // dependent details
     $d_title = $_POST["inputDependentTitle"];
     $d_firstname = $_POST["inputDependentFirstName"];
     $d_lastname = $_POST["inputDependentThirdName"];
     $d_relation = $_POST["inputDependentRelation"];
     $d_phone = $_POST["inputDependentPhone"];
     $d_email = $_POST["inputDependentEmail"];
     $d_profession = $_POST["inputDependentProfession"];
     $d_organisation = $_POST["inputDependentOrgName"];
     $d_income = $_POST["inputDependentAnnualIncome"];
     $d_house = $_POST["inputDependentHouse"];
     $d_street = $_POST["inputDependentStreet"];
     $d_city = $_POST["inputDependentCity"];
     $d_zipcode = $_POST["inputDependentZip"];

     $insert_query="INSERT INTO dependent(`idDependent`, `Title`, `Fname`, `Lname`, `Phoneno`, `EmailID`, `HouseNo`, `StreetNo`, `City_id`, `Zipcode`, `Relation`, `Profession`, `AnnualIncome`) VALUES ($registerno,\"$d_title\",\"$d_firstname\",\"$d_lastname\",$d_phone,\"$d_email\",\"$d_house\",\"$d_street\",$d_city,$d_zipcode,\"$d_relation\",\"$d_profession\",$d_income)";

     if ($conn->query($insert_query) === TRUE) 
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

?>
<!DOCTYPE html>
<html>
<head>
	<title>Personal form</title>
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
      <form action="#" method="POST">
        <div class="form-group">
          <label for="personaldetails"><strong>Personal Details</strong></label>
          <!-- <div class="form-group"> -->
           <div class="form-row">
            <div class="form-group col-md-3">
             <input type="text" class="form-control" name="inputRegisterNo"  id="inputRegisterNo" placeholder="Register No." pattern="[0-9]{7}" required>
           </div>
         </div>
         <!-- </div> -->
         <!-- <div class="form-group"> -->
          <div class="form-row">
           <div class="form-group col-md-3">
             <select name="inputTitle"  id="inputTitle" class="form-control" required>
               <option disabled selected>Select Title</option>
               <option>Mrs</option>
               <option>Mr</option>
               <option>Ms</option>
               <option>None</option>
             </select>
           </div>
           <div class="form-group col-md-3">
             <input type="text" class="form-control" name="inputFirstName"  id="inputFirstName" placeholder="First Name" required>
           </div>
           <div class="form-group col-md-3">
             <input type="text" class="form-control" name="inputThirdName"  id="inputThirdName" placeholder="Last Name" required>
           </div>
         </div>
         <!-- </div> -->

         <!-- <div class="form-group"> -->

          <div class="form-row">
           <div class="form-group col-md-6">
            <input type="text" class="form-control" name="inputHouse"   id="inputHouse"  placeholder="House name/no." required>
          </div>
          <div class="form-group col-md-6">
            <input type="text" class="form-control" name="inputStreet"  id="inputStreet" placeholder="Street name/no." required>
          </div>
        </div>
        <!-- </div> -->

        <div class="form-row" >
           <div class="form-group col-md-3">
           <select class="form-control" name="inputCountry" onchange="getStates(this.value,'#inputState')" id="inputCountry" required>
             <option selected="true" disabled>Please select country</option>

             <?php
             $country_sql="SELECT * FROM country ORDER BY Name ASC";
             $country_result=$conn->query($country_sql);

             if($country_result->num_rows > 0)
             {
               while($country_row=$country_result->fetch_assoc())
                 { ?>
                  <option value="<?php echo $country_row['idCountry']; ?>"><?php echo $country_row['Name']; ?></option>
                <?php   }
              }

              ?>
            </select>
          </div>
           <div class="form-group col-md-3">
            <select class="form-control" name="inputState"  id="inputState" onchange="getCity(this.value,'#inputCity')">
              <option selected disabled>Please select state</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <select name="inputCity"  id="inputCity" class="form-control" required>
              <option selected disabled>Please select city</option>
            </select>
          </div>
         

         

          <div class="form-group col-md-3">
            <input type="text" class="form-control" name="inputZip" id="inputZip" placeholder="Zip" required>
          </div>
        </div>

        <!-- <div class="form-group"> -->
         <div class="form-row">
          <div class="form-group col-md-3">

            <input type="text" class="form-control" name="inputPhone" id="inputPhone" pattern="[0-9]{10}" placeholder="Phone Number" required> 
          </div>
          <div class="form-group col-md-3">

            <input type="email" class="form-control" name="inputEmailid"  id="inputEmailid" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
          </div>
          <div class="form-group col-md-3">

            <input placeholder="DOB" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="inputDOB" id="inputDOB" required>
          </div>
          <div class="form-group col-md-3">

            <input type="text" class="form-control" name="inputReligion"  id="inputReligion" placeholder="Religion" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-3">

            <select class="form-control" name="inputReservation"  id="inputReservation" required>
             <option selected="true" disabled>Reservation Category</option>
             <option>General</option>
             <option>SC</option>
             <option>ST</option>
             <option>OBC - C</option>
             <option>OBC - NC</option>
             <option>Armed Forces</option>
             <option>Physically Handicapped</option>
             <option>Domicile</option>
             <option>None</option>
           </select>
         </div>
         <div class="form-group col-md-3">

           <select class="form-control" name="inputProgramme" id="inputProgramme" required>
             <option selected="true" disabled>Please select Programme</option>

             <?php
             $prog_sql="SELECT * FROM programme ORDER BY Course_Name ASC";
             $prog_result=$conn->query($prog_sql);

             if($prog_result->num_rows > 0)
             {
              while($prog_row=$prog_result->fetch_assoc())
                { ?>
                 <option value="<?php echo $prog_row['idCourse']; ?>"><?php echo $prog_row['Course_Name']; ?></option>
               <?php		}
             }

             ?>

           </select>
         </div>
         <div class="form-group col-md-3">

          <input type="Year" class="form-control" name="inputYOD"  id="inputYOD" placeholder="Year of Admission" required>
        </div>
      </div>

      <!-- </div> -->
    </div>

    <div class="form-group">
      <label for="dependentDetails"><strong>Guardian Details</strong></label>
      <!-- <div class="form-group"> -->
        <div class="form-row">
         <div class="form-group col-md-4">
           <select name="inputDependentTitle" id="inputDependentTitle" class="form-control" required>
             <option disabled selected>Select Title</option>
             <option>Mrs.</option>
             <option>Mr</option>
             <option>Ms</option>
             <option>Dr</option>
             <option>None</option>
           </select>
         </div>
         <div class="form-group col-md-4">
           <input type="text" class="form-control" name="inputDependentFirstName"  id="inputDependentFirstName" placeholder="First Name" required>
         </div>
         <div class="form-group col-md-4">
           <input type="text" class="form-control" name="inputDependentThirdName"  id="inputDependentThirdName" placeholder="Last Name" required>
         </div>
       </div>
       <!-- </div> -->

       <!-- <div class="form-group"> -->
        <div class="form-row">
         <div class="form-group col-md-4">
           <input type="text" class="form-control" name="inputDependentRelation"  id="inputDependentRelation" placeholder="Relation" required>
         </div>
         <div class="form-group col-md-4">
           <input type="text" class="form-control" name="inputDependentPhone"  id="inputDependentPhone" placeholder="Phone" pattern="[0-9]{10}" required>
         </div>
         <div class="form-group col-md-4">
           <input type="email" class="form-control" name="inputDependentEmail"  id="inputDependentEmail" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
         </div>
         <div class="form-group col-md-4">
           <input type="text" class="form-control" name="inputDependentProfession"  id="inputDependentProfession" placeholder="Profession" required>
         </div>
         <div class="form-group col-md-4">
           <input type="text" class="form-control" name="inputDependentOrgName"  id="inputDependentOrgName" placeholder="Organisation Name" required>
         </div>
         <div class="form-group col-md-4">
           <input type="number" step="0.01" class="form-control" name="inputDependentAnnualIncome" id="inputDependentAnnualIncome" placeholder="Annual Income" required>
         </div>
       </div>
       <!-- </div> -->
       <div class="form-row">
        <div class="form-group col-md-6">
         <input type="text" class="form-control" name="inputDependentHouse"  id="inputDependentHouse" placeholder="House name/no." required>
       </div>
       <div class="form-group col-md-6">
         <input type="text" class="form-control" name="inputDependentStreet"  id="inputDependentStreet" placeholder="Street name/no." required>
       </div>
     </div>

     <div class="form-row" >
       <div class="form-group col-md-3">
        <select class="form-control" name="inputDependentCountry" onchange="getStates(this.value,'#inputDependentState')" id="inputDependentCountry" required>
         <option selected="true" disabled>Please select country</option>

         <?php
         $country_sql="SELECT * FROM country ORDER BY Name ASC";
         $country_result=$conn->query($country_sql);

         if($country_result->num_rows > 0)
         {
           while($country_row=$country_result->fetch_assoc())
             { ?>
              <option value="<?php echo $country_row['idCountry']; ?>"><?php echo $country_row['Name']; ?></option>
            <?php   }
          }

          ?>
        </select>
      </div>
       <div class="form-group col-md-3">
        <select name="inputDependentState" id ="inputDependentState" onchange="getCity(this.value, '#inputDependentCity')"  class="form-control" required>
          <option selected disabled>Please select state</option>
        </select>
      </div>
      <div class="form-group col-md-3">
        <select name="inputDependentCity" id ="inputDependentCity" class="form-control" required>
          <option selected disabled>Please select city</option>
        </select>
      </div>
     
      <div class="form-group col-md-3">
        <input type="text" class="form-control" name="inputDependentZip"  id="inputDependentZip" placeholder="Zip" required>
      </div>
    </div>
  </div>
  <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>

<script type="text/javascript" src="common.js"></script>

</body>
</html>