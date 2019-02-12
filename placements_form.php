<?php
require("db.php");

if(isset($_POST["submit"]))
{
  $inputRegisterNo = $_POST["inputRegisterNo"];
  $inputCompanyName = $_POST["inputCompanyName"];
  $inputRounds = $_POST["inputRounds"];

  foreach ($inputCompanyName as $key => $value)
  {
    $insert_query = "INSERT INTO `placements`(`Studentid`, `companyid`, `rounds_qualified`) VALUES ($inputRegisterNo[$key],$inputCompanyName[$key],$inputRounds[$key])";

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
  <title>Placements Form</title>
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
      var add_button      = $(".btn-outline-primary");

      var x = 1;
      $(add_button).click(function(e)
      {
        e.preventDefault();
        if(x < max_fields)
        {
          x++;

          $(wrapper).append('<div><div class="buttoncontainer"><form> <div class="form-group details"><div class="form-group"><label for="projectdetails"><strong>Placements Details</strong></label><div class="form-row"><div class="form-group col-md-3"><input type="text" name="inputRegisterNo" class="form-control" id="inputRegisterNo" placeholder="Register No."></div>  </div> <div class="form-row"><div class="form-group col-md-4"><input type="text" class="form-control" name="inputCompanyName" id="inputCompanyName" placeholder="Company ID"></div>  <div class="form-group col-md-4"><select id="inputTitle" class="form-control"><option disabled selected>Rounds Qualified</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></div></div></div></div></div><a href="#" class="delete">Delete</a></div>')
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
        <form method="POST" action="#">
          <div class="form-group details">
            <div class="form-group">
              <label for="projectdetails"><strong>Placements Details</strong></label>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <input type="text" name="inputRegisterNo[]" class="form-control" id="inputRegisterNo" placeholder="Register No." pattern="[0-9]{7}" required>
                </div>  
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
            <div class="addDetails">
            </div>
            <br>
            <button type="button" onclick="addPlacement()" class="btn btn-outline-primary">Add Placement +</button>
            <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>

        <script type="text/javascript" src="common.js"></script>
      </body>
      </html>