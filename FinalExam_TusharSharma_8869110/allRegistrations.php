<?php

// db connection
include('includes/dbConnection.php');

if(!isset($_SESSION['username'])){
  header('Location: login.php');
  // to stop execution of the rest of the page.
  exit();
}

//select query 
$selectQuery = "SELECT * FROM `kw_team_information`;";

//execute query.
$result = $db->query($selectQuery);
//print_r($result);

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
    <section class = "ts-step-head">
      <h1>Welcome Admin</h1>
    </section>
    <section class = "ts-step-head">
      <h1>All Registrations</h1>
    </section>
      <section class = "ts-cart">
      <table class="ordersTable">
        <thead>
          <tr>
          <!-- for table to be accessible, add scope column for headings and scope row in atleast one row. -->
          <th scope = "column">Team Number</th>
          <th scope = "column">Team Name</th>
          <th scope = "column">College Name</th>
          <th scope = "column">College City</th>
          <th scope = "column">View Details</th>
          </tr>
      </thead>
      <tbody>
        <?php
         if($result->num_rows == 0):
          echo 'Sorry, no registrations yet.';
         else:
            while($row = $result->fetch_assoc()):
          ?>
            <tr>
            <td scope = "row"><?php echo $row['id']?></td>
            <td><?php echo $row['team_name']?></td>
            <td><?php echo $row['college_name']?></td>
            <td><?php echo $row['college_city']?></td>
            <td>
              <a href = "registrationDetails.php?id=<?php echo $row['id']?>">Details</a>
            </td>
          </tr>
          <?php
          endwhile;
         endif;
        ?>
      </tbody>
    </table>
  </section>
    
    </main>
    <?php include('includes/footer.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="slicknav/jquery.slicknav.min.js"></script>
    <script src="js/slicknav.js"></script>
</body>
</html>