<div id="btnPrint">
<?php
    require __DIR__ . '/header.php'
?>
</div>

<?php
  $shopId = $_SESSION['userid'];
  $sql_shop = "SELECT shop_name FROM shopProfile WHERE shop_id = '$shopId'";
  $shop_result = mysqli_query($conn, $sql_shop);
?>
  
<!-- Icon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
  <div class="container reportContainer">
    <div class="row">

    <?php
    while ($row = mysqli_fetch_assoc($shop_result))
        {
          $shopName = $row['shop_name'];
    ?>
      <h5 class="ml-3"><?php echo $shopName ?></h5>
    <?php
      }
    ?>
      
    </div>
    <div class="row statisticContainer">
      <h4><b>Sales Statistic</b><span id=""></span></h4>
      <?php
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT amount, quantity
          FROM orderDetails
          WHERE shop_id = '$shopId'";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "Amount: " . $row["amount"]. "   Quantity: " . $row["quantity"]. "";
            }
          } else {
           echo "<br> 0 result";
         }
         $conn->close();
        ?>

    </div>
    <div class="row categoryContainer">
      <h4><b>Sales by Category</b></h4>
      <p><span id=""></span></p>
    </div>
    <button id="btnPrint" onclick="hideButton()" class="printButton text-right">PRINT REPORT</button>
  </div>
</div>
<!-- /.container-fluid -->

<div id="btnPrint">
<?php
require __DIR__ . '/footer.php'
?>
</div>

<style>
body{
    background-color: #EEEDEE;
}
.reportContainer{
  background-color: white;
  margin: 25px auto;
  padding: 30px;
}

.statisticContainer{
  background-color: grey;
  margin-top: 20px;
  padding: 5px;
  color: #EEEDEE;
}

.categoryContainer{
  background-color: #EEEDEE;
  margin-top: 30px;
  padding: 5px;
  height: 200px; //should be remove after adding the review (id inside span of review)
}

.printButton{
  background-color: #0C1236;
  color: white;
  border: none;
  margin-top: 5px;
  padding: 5px 25px;
}
</style>

<script>
function hideButton() {
var x = document.getElementById("btnPrint");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});
</script>