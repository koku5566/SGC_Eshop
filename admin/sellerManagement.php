<?php
    require __DIR__ . '/header.php'
?>

<div class="container managementContainer">

  <div class="row">
    <div class="input-group">
      <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
      <button type="button" class="btn btn-outline-primary">search</button>
    </div>
  </div>

  <div class="row">
    <h2>Seller</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Years</th>
          <th scope="col">Action</th>
          <th scope="col">Set Preffer</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>natasha</td>
          <td>natasha@gmail.com</td>
          <td>01123456789</td>
          <td>7</td>
          <td>EDIT<br>DELETE</td>
          <td></td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>natasha</td>
          <td>natasha@gmail.com</td>
          <td>01123456789</td>
          <td>7</td>
          <td>EDIT<br>DELETE</td>
          <td></td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>natasha</td>
          <td>natasha@gmail.com</td>
          <td>01123456789</td>
          <td>7</td>
          <td>EDIT<br>DELETE</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  
</div>

<?php
    require __DIR__ . '/footer.php'
?>

<style>
body{
    background-color: #EEEDEE;
}

.managementContainer{
  background-color: white;
  margin: 25px auto;
  padding: 30px;
}
</style>