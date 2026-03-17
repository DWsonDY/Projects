<?php 

  session_start();

  //$_SESSION['name'] = 'link'; to override name input

  if ($_SERVER['QUERY_STRING'] == 'noname') {
    unset($_SESSION['name']); //to unset single var
    // session_unset(); to unset all var
  }

  $name = $_SESSION['name'] ?? 'Guest';

    //get cookie

    $gender = $_COOKIE['gender'] ?? 'Unknown';


 ?>


<head>
 	<title>First Project</title>
 	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
      .brand{
        background: #6d8f8d !important;
      }
      .brand-text{
        color: #6d8f8d !important;
      }
      form{
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
      }
    </style>
 </head>
   <body class="grey lighten-4">
    <nav class="white z-depth-0">
      <div class="container">
        <a href="index.php" class="brand-logo brand-text">Ninja for Hire</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
          <li class="black-text">Hello <?php echo htmlspecialchars($name); ?></li>
          <li class="black-text">(<?php echo htmlspecialchars($gender); ?>)</li>
          <li><a href="service.php" class="btn brand z-depth-0">select service</a></li>
        </ul>
      </div>
    </nav>