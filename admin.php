<?php require_once("Includes/DB.php");  ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/functions.php"); ?>
<?php require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/Styles.css" />
    <title>Comments</title>
  </head>

  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
      <div class="container">
        <a href="#" class="navbar-brand text-white"><i class="fas fa-cart-plus"></i>  E-SHOP</a>
        <button
          class="navbar-toggler"
          data-toggle="collapse"
          data-target="#navbarcollapseCMS"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="#" class="nav-link text-white"
                ><i class="fas fa-user text-success"></i> My profile</a
              >
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="Logout.php" class="nav-link text-white">
                <i class="fas fa-user-times text-danger"></i> Logout</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Area -->
    <section class="container py-2 mb-4">
        <div class="row" style="min-height:30px;">
           <div class="col-lg-12" style="min-height:30px;">
           <h1>Manage Orders</h1>

           <table class="table table-striped table-hover">
             <thead class="thead-dark">
               <tr>
                 <th>No.</th>
                 <th>Date&Time</th>
                 <th>Product x count</th>
                 <th>Name</th>
                 <th>Phone</th>
                 <th>Country</th>
                 <th>City</th>
                 <th>Address</th>
               </tr>
             </thead>

           <?php
           $ConnectionDB;
           $sql = "SELECT* FROM delivery "; 
           $Execute = $ConnectionDB->query($sql);
           $SrNo = 0 ;
           while($DataRows=$Execute->fetch()){
             $number = $DataRows["number"];
             $date = $DataRows["date"];
             $name = $DataRows["name"];
             $phone = $DataRows["phone"];
             $country = $DataRows["country"];
             $city = $DataRows["city"];
             $address = $DataRows["address"];
             $products = $DataRows["products"];

             $SrNo++;
           ?>
           <tbody>
             <tr>
               <td><?php echo $SrNo; ?></td>
               <td><?php echo htmlentities($date); ?></td>
               <td><?php echo htmlentities($products); ?></td>  
               <td><?php echo htmlentities($name); ?></td>
               <td><?php echo htmlentities($phone); ?></td>
               <td> <?php echo htmlentities($country); ?> </td>
               <td> <?php echo htmlentities($city); ?> </td>
               <td> <?php echo htmlentities($address); ?> </td>
             </tr>
           </tbody>
           <?php } ?>
           </table>


           </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white fixed-bottom">
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="lead text-center">
              Kourpidis paris &copy;<span id="year"></span>
            </p>
          </div>
        </div>
      </div>
    </footer>

    <script
      src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
      integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
      crossorigin="anonymous"
    ></script>

    <script>
      // Get the current year for the copyright
      $("#year").text(new Date().getFullYear());
    </script>
  </body>
</html>
