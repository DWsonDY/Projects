<?php 

 include('config/db_connect.php');

 if(isset($_POST['delete'])){

 	$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

 	$sql = "DELETE FROM services WHERE id = $id_to_delete";

 	if(mysqli_query($conn, $sql)){
 		//success
 		header('location: index.php');
 	} {
 		//failure
 		echo 'query error: '.mysqli_error($conn);
 	}

 }

  //check GET request id parameter

  if(isset($_GET['id'])){
    
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    //make sql

    $sql = "SELECT * FROM services WHERE id = $id";

    //get the query results

    $result = mysqli_query($conn, $sql);

    //fetch result in array format
    $service = mysqli_fetch_assoc($result);

    //free result
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

   


 }


 ?>


 <!DOCTYPE html>
 <html>
 
   <?php include('C:\xampp\htdocs\tuts\template\header.php'); ?>


   <div class="container center">
   	
   	<?php if($service): ?>
   		<h4><?php echo htmlspecialchars($service['problem']); ?></h4>
   		<p>Created by: <?php echo htmlspecialchars($service['email']); ?></p>
   		<p><?php echo date($service['created_at']); ?></p>
   		<h5>Services</h5>
   		<p><?php echo htmlspecialchars($service['service']); ?></p>

   		<!-- Delete Form-->
   		<form action="details.php" method="POST">
   			<input type="hidden" name="id_to_delete" value="<?php echo $service['id'] ?>">
   			<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
   		</form>

   	<?php else: ?>
   		<h5>No services available!</h5>

   	<?php endif; ?>
   </div>


   <?php include('C:\xampp\htdocs\tuts\template\footer.php');
 ?>

 </html>