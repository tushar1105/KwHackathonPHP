<?php
// db connection.
include('includes/dbConnection.php');
  
  if(!empty($_POST)){

    //  print_r($_POST);
    // Step: 1 -> fetch data from form.
    //team information
    $teamName = $_POST['teamName'];
    $collegeName = $_POST['collegeName'];
    $collegeAddress = $_POST['textarea-collegeAddress'];
    $collegeCity = $_POST['collegeCity'];
    $collegeProvince = $_POST['collegeProvince'];
    //student: 1 - information
    $firstName1 = $_POST['firstName1'];
    $lastName1 = $_POST['lastName1'];
    $email1 = $_POST['email1'];
    //student: 2 - information
    $firstName2 = $_POST['firstName2'];
    $lastName2 = $_POST['lastName2'];
    $email2 = $_POST['email2'];


    // variables to display errors respective to each field.
    $errors = 0; // no errors = 0, errors = 1
    // team info errors.
    $teamNameError = '';
    $collegeNameError = '';
    $collegeAddressError = '';
    $collegeCityError = '';
    $collegeProvinceError = '';
    // student info errors.
    $firstName1Error = '';
    $lastName1Error = '';
    $email1Error = '';
    $firstName2Error = '';
    $lastName2Error = '';
    $email2Error = '';

    // Step: 2 -> validating user inputs.

    // Regular expressions/Validations used : 
// Alphabets only -> First Name, Last Name, City, College Name, Team Name, 
    $alphabetsOnlyRegex = '/^[a-zA-Z]+$/';
// Email : reference -> https://stackoverflow.com/questions/46155/how-can-i-validate-an-email-address-in-javascript : answer by -> community wiki.
    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';

    // team info.
    // team name.
    if (!preg_match($alphabetsOnlyRegex, $teamName)) {
      $teamNameError = "Team Name empty or not in correct format : Only alphabets allowed, no special characters or spaces.<br><br>";
      $errors = 1;
    }
    // college name.
    if (!preg_match($alphabetsOnlyRegex, $collegeName)) {
      $collegeNameError = "College Name empty or not in correct format : Only alphabets allowed, no special characters or spaces.<br><br>";
      $errors = 1;
    }
    // college address.
    if (empty($collegeAddress)) {
    $collegeAddressError = "College address cannot be empty.<br><br>";
    $errors = 1;
    }
    // college city.
    if (!preg_match($alphabetsOnlyRegex, $collegeCity)) {
      $collegeCityError = "City is empty or not in correct format : Only alphabets allowed, no special characters or spaces.<br><br>";
      $errors = 1;
    }
    // collge province.
    if ($collegeProvince == '0') {
      $collegeProvinceError = "Please select a Province.<br><br>";
      $errors = 1;
    }

    // student info.
    // student : 1
    // first name.
    if (!preg_match($alphabetsOnlyRegex, $firstName1)) {
        $firstName1Error = "First Name empty or not in correct format : Only alphabets allowed, no special characters or spaces.<br><br>";
        $errors = 1;
    }
     // last name.
     if (!preg_match($alphabetsOnlyRegex, $lastName1)) {
        $lastName1Error = "Last Name empty or not in correct format : Only alphabets allowed, no special characters or spaces.<br><br>";
        $errors = 1;
    }
    // email.
    if (!preg_match($emailRegex, $email1)) {
        $email1Error = "Email is empty or not in correct format : test@test.com.<br><br>";
        $errors = 1;
    }
    // student : 2
    // first name.
    if (!preg_match($alphabetsOnlyRegex, $firstName2)) {
      $firstName2Error = "First Name empty or not in correct format : Only alphabets allowed, no special characters or spaces.<br><br>";
      $errors = 1;
  }
   // last name.
   if (!preg_match($alphabetsOnlyRegex, $lastName2)) {
      $lastName2Error = "Last Name empty or not in correct format : Only alphabets allowed, no special characters or spaces.<br><br>";
      $errors = 1;
  }
  // email.
  if (!preg_match($emailRegex, $email2)) {
      $email2Error = "Email is empty or not in correct format : test@test.com.<br><br>";
      $errors = 1;
  }

    // Step:3 -> process data

    // Step:4 -> displaying output.
    if($errors == 1){
      $formMessage = '1 or more errors exist, Please fix the errors to continue.'; 
    }else{
      // generate receipt.
      $formMessage = "Registration Successful! View your summary below."; 
       


// fetch province name based on provice code.
// reference assignment 3.
$provinceWiseTaxRate = [];
  // objects representing tax rates for each province.
 // source : https://www.retailcouncil.org/resources/quick-facts/sales-tax-rates-by-province/
  $alberta = ["province" => "AB", "rate" => 0.05 ,"name" => "Alberta"];
  $britishColumbia = ["province" => "BC", "rate" => 0.12,"name" => "British Columbia"];
  $manitoba = ["province" => "MB", "rate" => 0.12,"name" => "Manitoba"];
  $newBrunswick = ["province" => "NB", "rate" => 0.15,"name" => "New Brunswick"];
  $nfl = ["province" => "NL", "rate" => 0.15,"name" => "Newfoundland and Labrador"];
  $northWestTerr = ["province" => "NT", "rate" => 0.05,"name" => "Northwest Territories"];
  $novaScotia = ["province" => "NS", "rate" => 0.15,"name" => "Nova Scotia"];
  $nunavut = ["province" => "NU", "rate" => 0.05,"name" => "Nunavut"];
  $ontario = ["province" => "ON", "rate" => 0.13,"name" => "Ontario"];
  $pei = ["province" => "PE", "rate" => 0.15,"name" => "Prince Edward Island"];
  $quebec = ["province" => "QC", "rate" => 0.149,"name" => "Quebec"];
  $saskatchewan = ["province" => "SK", "rate" => 0.11,"name" => "Saskatchewan"];
  $yukon = ["province" => "YT", "rate" => 0.05,"name" => "Yukon"];
  array_push($provinceWiseTaxRate,$alberta,$britishColumbia,$manitoba,$newBrunswick,$nfl,$northWestTerr,
  $novaScotia,$nunavut,$ontario,$pei,$quebec,$saskatchewan,$yukon);
//   print_r($provinceWiseTaxRate[0]);
// tax value to be applied.
$provinceName = '';
foreach ($provinceWiseTaxRate as $p) {
    if ($p["province"] == $collegeProvince) {
        $provinceName = $p["name"];
        break;
    }
}

// Registration Summary
$registrationSummary = "<h1>Registration Summary</h1>";
// personal information.
$teamInfo = "        
      <h3>Team Information</h3>
        <p>Team Name : $teamName
        <br>College Name : $collegeName
        <br>College Address : $collegeAddress
        <br>Collge City : $collegeCity
        <br>College Province/Territory : $provinceName
        </p>";
        // echo $personalInfo;

        $studentInfo = "
        <h3>Students in Team</h3>
            <table>
                <thead>
                    <th> S.no </th>
                    <th> First Name </th>
                    <th> Last Name</th>
                    <th> Email </th>
                </thead>
                <tbody>
                  <tr>
                  <td>1.</td>
                  <td>$firstName1</td>
                  <td>$lastName1</td>
                  <td>$email1</td>
                  </tr>
                  <tr>
                  <td>2.</td>
                  <td>$firstName2</td>
                  <td>$lastName2</td>
                  <td>$email2</td>
                  </tr>
                </tbody>
            </table>
            <br />
            ";

    // storing values in the database.
    // insert into kw_team_information table 
    $sqlQuery = "INSERT INTO `kw_team_information` (`id`,`team_name`, `college_name`, `college_address`, `college_city`, `college_province`,`created_at`) 
    VALUES (NULL,'$teamName', '$collegeName', '$collegeAddress', '$collegeCity', '$collegeProvince', current_timestamp())
    ";
    // echo "$sqlQuery";
    $db->query($sqlQuery);
    $last_id = $db->insert_id;
    // inserting the students into kw_student_information table using this id from the kw_team_information as the reference.
        // student: 1
        $sqlQueryInsert1 = "INSERT INTO `kw_student_information` (`id`,`first_name`, `last_name`, `email`, `team_id`) VALUES (NULL, '$firstName1', '$lastName1', '$email1','$last_id')";
        $db->query($sqlQueryInsert1);

        // student: 2
        $sqlQueryInsert2 = "INSERT INTO `kw_student_information` (`id`,`first_name`, `last_name`, `email`, `team_id`) VALUES (NULL, '$firstName2', '$lastName2', '$email2','$last_id')";
        $db->query($sqlQueryInsert2);
    
    $db->close();

    }
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TS</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="slicknav/slicknav.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include('includes/header.php'); ?>
<?php include('includes/menu.php'); ?>
    <main>
    <section class = "ts-step-head" id = "personalInfoHead">
            <h1>K-W Hackathon Registration</h1>
        </section>
    <form name="registrationForm" method="Post" action="">  
        <section class = "ts-step-head" id = "personalInfoHead">
            <h1>Step - 1 : Enter Team Information. </h1>
        </section>
        <span class = "errors">
          Note: Fields marked with (*) are mandatory.
        </span><br><br>
        <section class="user-info">
            <section class="ts-info" id="personalInfo">
                    
                        <label for="teamName">Team Name<span class = "errors">*</span></label>
                        <input id="teamName" placeholder="Team Name" class="textInput" type="text" name="teamName"
                        <?php 
          if(isset($teamName)){
            echo "value = $teamName";
          }
          ?>
                        ><br />
                        <span class = "errors">
          <?php 
            if(isset($teamNameError)){
              echo $teamNameError . "<br>";
              }
          ?>
        </span>
            
                        <label for="collegeName">College Name<span class = "errors">*</span></label>
                        <input id="collegeName" placeholder="College Name" class="textInput" type="text" name="collegeName"
                        <?php 
          if(isset($collegeName)){
            echo "value = $collegeName";
          }
          ?>
                        ><br />
                        <span class = "errors">
          <?php 
            if(isset($collegeNameError)){
              echo $collegeNameError . "<br>";
              }
          ?>
        </span>
            <label for="collegeAddress">College Address<span class = "errors">*</span></label>
            <textarea name="textarea-collegeAddress" id="collegeAddress" placeholder="College Address"><?php 
          if(isset($collegeAddress)){
            echo "$collegeAddress";
          }
          ?></textarea><br />
                        <span class = "errors">
          <?php 
            if(isset($collegeAddressError)){
              echo $collegeAddressError . "<br>";
              }
          ?>
        </span>
                        
        <label for="collegeCity">College City<span class = "errors">*</span></label>
        <input id="collegeCity" placeholder="College City" class="textInput" type="text" name="collegeCity"
                        <?php 
          if(isset($collegeCity)){
            echo "value = $collegeCity";
          }
          ?>
                        ><br />
                        <span class = "errors">
          <?php 
            if(isset($collegeCityError)){
              echo $collegeCityError . "<br>";
              }
          ?>
        </span>

         <label for="collegeProvince">College Province/Territory<span class = "errors">*</span></label>
          <select name="collegeProvince" id="collegeProvince" class="textInput">
              <option value="0" <?php echo ($collegeProvince == '0') ? 'selected' : ''; ?>>----- Select -----</option>
            <option value="AB" <?php echo ($collegeProvince == 'AB') ? 'selected' : ''; ?>>Alberta</option>
            <option value="BC" <?php echo ($collegeProvince == 'BC') ? 'selected' : ''; ?>>British Columbia</option>
            <option value="MB" <?php echo ($collegeProvince == 'MB') ? 'selected' : ''; ?>>Manitoba</option>
            <option value="NB" <?php echo ($collegeProvince == 'NB') ? 'selected' : ''; ?>>New Brunswick</option>
            <option value="NL" <?php echo ($collegeProvince == 'NL') ? 'selected' : ''; ?>>Newfoundland and Labrador</option>
            <option value="NT" <?php echo ($collegeProvince == 'NT') ? 'selected' : ''; ?>>Northwest Territories</option>
            <option value="NS" <?php echo ($collegeProvince == 'NS') ? 'selected' : ''; ?>>Nova Scotia</option>
            <option value="NU" <?php echo ($collegeProvince == 'NU') ? 'selected' : ''; ?>>Nunavut</option>
            <option value="ON" <?php echo ($collegeProvince == 'ON') ? 'selected' : ''; ?>>Ontario</option>
            <option value="PE" <?php echo ($collegeProvince == 'PE') ? 'selected' : ''; ?>>Prince Edward Island</option>
            <option value="QC" <?php echo ($collegeProvince == 'QC') ? 'selected' : ''; ?>>Quebec</option>
            <option value="SK" <?php echo ($collegeProvince == 'SK') ? 'selected' : ''; ?>>Saskatchewan</option>
            <option value="YT" <?php echo ($collegeProvince == 'YT') ? 'selected' : ''; ?>>Yukon</option>
                        </select><br />
                        <span class = "errors">
          <?php 
            if(isset($collegeProvinceError)){
              echo $collegeProvinceError . "<br>";
              }
          ?>
        </span>
            </section>
        </section>
        <section class = "ts-step-head">
            <h1>Step - 2 : Add Students to your team. </h1>
        </section>
        <section class = "user-cart">
            <section class = "ts-cart">
                <table id='itemsTable'>
                    <thead>
                        <th> S.no </th>
                        <th> First Name </th>
                        <th> Last Name </th>
                        <th> Email </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td><input type="text" id = "firstName1" name="firstName1" placeholder = "First Name"
                            <?php 
          if(isset($firstName1)){
            echo "value = $firstName1";
          }
          ?>
          >
          <br />
          <span class = "errors">
          <?php 
            if(isset($firstName1Error)){
              echo $firstName1Error . "<br>";
              }
          ?>
        </span>
            </td>
          <td><input type="text" id = "lastName1" name="lastName1" placeholder = "Last Name"
                            <?php 
          if(isset($lastName1)){
            echo "value = $lastName1";
          }
          ?>
          >             
        <br />
        <span class = "errors">
          <?php 
            if(isset($lastName1Error)){
              echo $lastName1Error . "<br>";
              }
          ?>
        </span>
                        </td>
                        <td><input type="text" id = "email1" name="email1" placeholder = "test@test.com"
                            <?php 
          if(isset($email1)){
            echo "value = $email1";
          }
          ?>
          >             
        <br />
        <span class = "errors">
          <?php 
            if(isset($email1Error)){
              echo $email1Error . "<br>";
              }
          ?>
        </span>
           </td>
            </tr>


            <tr>
                            <td>2.</td>
                            <td><input type="text" id = "firstName2" name="firstName2" placeholder = "First Name"
                            <?php 
          if(isset($firstName2)){
            echo "value = $firstName2";
          }
          ?>
          >
          <br />
          <span class = "errors">
          <?php 
            if(isset($firstName2Error)){
              echo $firstName2Error . "<br>";
              }
          ?>
        </span>
            </td>
          <td><input type="text" id = "lastName2" name="lastName2" placeholder = "Last Name"
                            <?php 
          if(isset($lastName2)){
            echo "value = $lastName2";
          }
          ?>
          >             
        <br />
        <span class = "errors">
          <?php 
            if(isset($lastName2Error)){
              echo $lastName2Error . "<br>";
              }
          ?>
        </span>
                        </td>
                        <td><input type="text" id = "email2" name="email2" placeholder = "test@test.com"
                            <?php 
          if(isset($email2)){
            echo "value = $email2";
          }
          ?>
          >             
        <br />
        <span class = "errors">
          <?php 
            if(isset($email2Error)){
              echo $email2Error . "<br>";
              }
          ?>
        </span>
           </td>
            </tr>
            
                    </tbody>
                </table>
            </section>
        </section>
        <br /><br />
        <section class="ts-error">
            <p id="errors" class = "errors">
            <?php 
            if(isset($errors)){
              echo $formMessage;
              }
            ?>
            </p>
        </section>
                        <input type="submit" value="Register Team" id = "submitButton" class = 'submit-btn'>
        </form>
        <section class = "ts-step-head" id = 'orderSummary'>
        <?php 
                echo $registrationSummary;
             ?>
    </section>
        <section class = "order-summary" id = 'order-summary-section'>
            <section class="ts-info-summary" id = "ts-personal-final">
            <?php 
                echo $teamInfo;
             ?>
            </section>
            <section class="ts-cart-summary" id = "ts-order-final">
            <?php 
                echo $studentInfo;
             ?>
            </section>
        </section>
    </main>
    <?php include('includes/footer.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="slicknav/jquery.slicknav.min.js"></script>
    <script src="js/slicknav.js"></script>
</body>
</html>