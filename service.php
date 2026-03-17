<?php 

  // if(isset($_GET['submit'])){
  //   echo $_GET['email'];
  //   echo $_GET['problem'];
  //   echo $_GET['service'];

  // }
  
  include('config/db_connect.php');
  
  $email = $problem = $service = '';
  $errors = array('email'=>'', 'problem'=>'', 'service'=>'');

  if(isset($_POST['submit'])){
    

    // check email
    if(empty($_POST['email'])){
      $errors['email'] = 'An email is required <br />';
      //echo 'An email is required <br />';
    } else {
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'email must be valid';
        //echo 'email must be valid';

      }
    }
  }

    //check problem
    if(empty($_POST['problem'])){
      $errors['problem'] = 'A problem is required <br />';
      //echo 'A problem is required <br />';
    } else {
      $problem = $_POST['problem'];
      if(!preg_match('/^[a-zA-Z\s]+$/', $problem)){
        $errors['problem'] =  'problem must be letter and spaces only';
        //echo 'problem must be letter and spaces only';
      }
    }
    if(empty($_POST['service'])){
      $errors['service'] = 'A service is required <br />';
      //echo 'A service is required <br />';
    } else {
      $service = $_POST['service'];
      if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $service)){
        $errors['service'] = 'service must be comma separated';
        //echo 'service must be comma separated';
    }

  }
  
  if(array_filter($errors)){
    //echo 'errors in form';
  } else{


    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $problem = mysqli_real_escape_string($conn, $_POST['problem']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);

    //create sql
    $sql = "INSERT INTO services(problem,email,service) VALUES('$problem','$email','$service')";

    //save to database and check
    if(mysqli_query($conn, $sql)){
      //success
      header('location: index.php');
    } else{
      //error
      echo 'query error:'.mysqli_error($conn);
    }

    //echo 'form is valid';
    
  }

 ?>

 <!DOCTYPE html>
 <html>
 
 <?php include('C:\xampp\htdocs\tuts\template\header.php');?> 
  <section class="container black-text"><h4 class="center">Select Service</h4>
    <form class="white" action="service.php" method="POST">
      <label>Your Email:</label>
      <input type="text" name="email" value=<?php echo htmlspecialchars($email) ?>>
      <div class="red-text"><?php echo $errors['email']; ?></div>
       <label>Problem Title:</label>
      <input type="text" name="problem" value=<?php echo htmlspecialchars($problem) ?>>
      <div class="red-text"><?php echo $errors['problem']; ?></div>
       <label>Service (comma separated):</label>
      <input type="text" name="service" value=<?php echo htmlspecialchars($service) ?>>
      <div class="red-text"><?php echo $errors['service']; ?></div>
      <div class="center">
        <input type="submit" name="submit" value ="submit" class="btn brand z-depth-0">
      </div>
    </form>

  </section> 

   <?php include('C:\xampp\htdocs\tuts\template\footer.php'); ?>


   

 
 </html>