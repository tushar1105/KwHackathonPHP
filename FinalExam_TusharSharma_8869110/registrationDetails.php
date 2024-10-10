<?php
    // db connection
  include('includes/dbConnection.php');

  if(!isset($_SESSION['username'])){
    header('Location: login.php');
    // to stop execution of the rest of the page.
    exit();
  }


  if(!empty($_GET)){
    $id = $_GET['id'];
    $sqlQuery = "SELECT * FROM `kw_team_information` WHERE `id` = $id";
    $result = $db->query($sqlQuery);
    if($result->num_rows == 0):
        $output = "Sorry, no registrations found";
    else:
        $orderSummary = "<h1>Registration Summary</h1>";
        //user info
        while($row = $result->fetch_assoc()):
            $teamName = $row['team_name'];
            $collegeName = $row['college_name'];
            $collegeAddress = $row['college_address'];
            $collegeCity = $row['college_city'];
            $collegeProvince = $row['college_province'];

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

            $personalInfo = "        
        <h3>Team Information</h3>
        <p>Team Name : $teamName
        <br>College Name : $collegeName
        <br>College Address : $collegeAddress
        <br>Collge City : $collegeCity
        <br>College Province/Territory : $provinceName
        </p>";
        endwhile;
    endif;

    //order info
    $orderQuery = "SELECT * FROM `kw_student_information` WHERE `team_id` = $id";
    $result = $db->query($orderQuery);
    if($result->num_rows == 0):
        $output = "Sorry, no students found";
    else:
        //order info
        $orderItemsString = '';
        while($row = $result->fetch_assoc()):
            $orderItemsString .= "<tr>";
            $orderItemsString .= "<td>" . htmlspecialchars($row['first_name']) . "</td>";
            $orderItemsString .= "<td>" . htmlspecialchars($row['last_name']) . "</td>";
            $orderItemsString .= "<td>" . htmlspecialchars($row['email']) . "</td>";
            $orderItemsString .= "</tr>";
        endwhile;
    endif;

            $orderInfo = "
        <h3>Students in Team</h3>
            <table>
                <thead>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Email </th>
                </thead>
                <tbody>
                $orderItemsString
                </tbody>
            </table>
            <br />
            ";   
   }

?>
<!DOCTYPE html>
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
        <section class = "ts-step-head" id = "orderSummary">
          <h1>Registration Summary</h1>
        </section>
        <section class = "order-summary" id = 'order-summary-section'>
            <section class="ts-info-summary" id = "ts-personal-final">
            <?php 
                echo $personalInfo;
             ?>
            </section>
            <section class="ts-cart-summary" id = "ts-order-final">
            <?php 
                echo $orderInfo;
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