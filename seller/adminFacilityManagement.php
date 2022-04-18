<?php
   require __DIR__ . '/header.php'
  
?> 
<?php
/*if(isset($_POST['Delete']))
{
    $id= $_POST['id'];
    $sql_delete = "DELETE FROM facilityPic WHERE id = '$id'";
    if(mysqli_query($conn, $sql_delete))
    {
        ?>
            <script type="text/javascript">
                alert(" Deleted Successful");
                window.location.href = window.location.origin + "/seller/adminFacilityManagement.php";
            </script>
        <?php
    }
    else{
        echo '<script>alert("Failed")</script>';
    }
}*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_POST['id'], $_POST['dfacility']) && !empty($_POST['id']) && !empty($_POST['dfacility']) && $_POST['dfacility'] === 'delete' ){	
		
  $selectedPID = SanitizeString($_POST['id']);
  $sql = "DELETE FROM `facilityPic` WHERE  `id`=?";
  
  if($stmt = mysqli_prepare($conn, $sql)){
      mysqli_stmt_bind_param($stmt, 'i',$selectedPID); 	//s=string , d=decimal value i=ID
  
      mysqli_stmt_execute($stmt);
    
      if(mysqli_stmt_affected_rows($stmt) == 1)	//why check with 1? this sequal allow insert 1 row nia
      {
        echo "<script>alert('Delete successfully');</script>";
      }else{
        echo "<script>alert('Fail to Delete');</script>";
      }
  
      mysqli_stmt_close($stmt);
    }
}
  
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<!-- Select datatable CSS-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">


<!-- Page Content -->
<div class="container my-5">
  <div class="shadow-4 rounded-5 overflow-hidden">
    <h2>Facilities</h2>
    <br>
   
    <table class="table align-middle mb-0 bg-white">
      <thead class="bg-light">
        <tr>
          <th>Facility Name</th>
          <th>Hourly Rate</th>
          <th>Actions</th>
        </tr>
      </thead>
      
      <tbody>
      <?php
      $getPic= "SELECT * FROM facilityPic";
      $getCategory = mysqli_query($conn, $getPic);
      $showCategory = mysqli_fetch_all($getCategory, MYSQLI_ASSOC);
      foreach($showCategory as $facility): 
      ?>
        <tr>
         <td>
            <div class="d-flex align-items-center">
              <img src="/img/facility/<?php echo $facility["pic_cover"]?>" class="" alt="" name="" style="width: 150px; height: 150px"/>
              <div class="ms-3">
                <p class="fw-bold mb-1" ><?php echo $facility["title"]?></p>

              </div>
            </div>
          </td>
          <td>
            <p class="fw-normal mb-1"><?php echo $facility["price_per_hour"]?></p>
          </td>
          <td>
            <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold">Edit</button>
            
            <form action = <?php $_SERVER[($_SERVER["PHP_SELF"];?>] method ="POST">
              <input type = "hidden" name="id" value="del">
              <input type="submit" class="btn btn-danger btn-rounded btn-sm fw-bold" name="dfacility" value="delete">
            </form>
          </td>
        </tr>
        <?php endforeach ?> 
      </tbody>
      
    </table>
    
  </div>
</div>

<!-- Datatable -->
<script charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<!-- Select datatable JS-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script type ="module" src="../bootstrap/js/bootstrap.min.js"></script>




<?php
   require __DIR__ . '/footer.php'
?>
