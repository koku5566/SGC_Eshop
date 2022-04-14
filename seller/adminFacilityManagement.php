<?php
   require __DIR__ . '/header.php'
  
?> 
<?php
   
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
          <th></th>
          <th></th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
         <td>
            <div class="d-flex align-items-center">
              <img src="" class="rounded-circle" alt=""style="width: 45px; height: 45px"/>
              <div class="ms-3">
                <p class="fw-bold mb-1">name</p>

              </div>
            </div>
          </td>
          <td>
            <p class="fw-bold mb-1">xxx</p>
          </td>
          <td>
          </td>
          <td></td>
          <td>
            <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">Edit</button>
            <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">Delete</button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <img src="" class="rounded-circle" alt=""style="width: 45px; height: 45px"/>
              <div class="ms-3">
                <p class="fw-bold mb-1">name</p>

              </div>
            </div>
          </td>
          <td>
            <p class="fw-normal mb-1">xxx</p>

          </td>
          <td>
          </td>
          <td></td>
          <td>
            <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">Edit</button>
            <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">Delete</button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <img src="" class="rounded-circle" alt=""style="width: 45px; height: 45px"/>
              <div class="ms-3">
                <p class="fw-bold mb-1">name</p>

              </div>
            </div>
          </td>
          <td>
            <p class="fw-normal mb-1">xxx</p>
          </td>
          <td>
          </td>
          <td>
          </td>
          <td>
            <button type="button" class="btn btn-link btn-rounded btn-sm" data-mdb-ripple-color="dark">Edit</button>
            <button type="button" class="btn btn-link btn-rounded btn-sm" data-mdb-ripple-color="dark">Delete</button>
          </td>
        </tr>
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
