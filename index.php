<?php 

  include('config/db_connect.php');

  //write query for services
  $sql = 'SELECT problem, service, id FROM services ORDER BY created_at';
  
  //make query & get result
  $result = mysqli_query($conn, $sql);

  //fetch resulting rows as an array
  $services = mysqli_fetch_all($result, MYSQLI_ASSOC);

  //freeing result from memory
  mysqli_free_result($result);

  //close connection
  mysqli_close($conn);

  explode(',', $services[0]['service']);

  //print_r($services);



 ?>

 <!DOCTYPE html>
 <html>
 
 <?php include('C:\xampp\htdocs\tuts\template\header.php'); ?>



  <h4 class="center grey-text">Services</h4>

  <div class="container">
    <div class="row">
      
      <?php foreach($services as $service):?>

        <div class="col s6 md3">
          <div class="card z-depth-0">
            <div class="card-content center">
              <h6><?php echo htmlspecialchars($service['problem']);?></h6>
              <ul><?php foreach(explode(',',$service['service']) as $ser) : ?>
                <li><?php echo htmlspecialchars($ser); ?></li>
                
                <?php endforeach; ?>
              </ul>
              
            </div>
            <div class="card-action right align"><a class="brand-text" href="details.php?id=<?php echo $service['id']?>">more info</a>
            </div>
          </div>
        </div>


      <?php endforeach; ?>
    </div>
  </div>

 
   <?php include('C:\xampp\htdocs\tuts\template\footer.php');
 ?>


   

 
 </html>