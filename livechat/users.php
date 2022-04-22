<?php
    require __DIR__ . '/header.php'
?>
<?php 
  session_start();
  include_once "backend/db.php";
  if(!isset($_SESSION['userID'])){
    header("location: login.php");
  }
?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE userID = {$_SESSION['userID']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="php/images/<?php echo $row['profile_picture']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['username'] ?></span>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
<br>
<?php
    require __DIR__ . '/footer.php'
?>

<style>
    .campus-name{
        color:white;
        height:50px;
        overflow:hidden;
        text-align: center;   

    }


</style>
