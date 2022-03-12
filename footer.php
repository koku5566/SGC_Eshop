</div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="page-footer font-small mdb-color pt-4">

            <!-- Footer Links -->
            <div class="container text-center text-md-left">

                <!-- Footer links -->
                <div class="row text-center text-md-left mt-3 pb-3">

                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Company name</h6>
                    <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
                    consectetur
                    adipisicing elit.</p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
                    <p>
                    <a href="#!">MDBootstrap</a>
                    </p>
                    <p>
                    <a href="#!">MDWordPress</a>
                    </p>
                    <p>
                    <a href="#!">BrandFlow</a>
                    </p>
                    <p>
                    <a href="#!">Bootstrap Angular</a>
                    </p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
                    <p>
                    <a href="#!">Your Account</a>
                    </p>
                    <p>
                    <a href="#!">Become an Affiliate</a>
                    </p>
                    <p>
                    <a href="#!">Shipping Rates</a>
                    </p>
                    <p>
                    <a href="#!">Help</a>
                    </p>
                </div>

                <!-- Grid column -->
                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                    <p>
                    <i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                    <p>
                    <i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
                    <p>
                    <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                    <p>
                    <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                </div>
                <!-- Grid column -->

                </div>
                <!-- Footer links -->

                <hr>

                <!-- Grid row -->
                <div class="row d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-7 col-lg-8">

                    <!--Copyright-->
                    <p class="text-center text-md-left">© 2020 Copyright:
                    <a href="https://mdbootstrap.com/">
                        <strong> MDBootstrap.com</strong>
                    </a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-5 col-lg-4 ml-lg-0">

                    <!-- Social buttons -->
                    <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                        <a class="btn-floating btn-sm rgba-white-slight mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn-floating btn-sm rgba-white-slight mx-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn-floating btn-sm rgba-white-slight mx-1">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                        </li>
                        <li class="list-inline-item">
                        <a class="btn-floating btn-sm rgba-white-slight mx-1">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        </li>
                    </ul>
                    </div>

                </div>
                <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </div>
            <!-- Footer Links -->

            </footer>
            <!-- Footer -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; 2021 SEGi College Penang 198901010318 (187620-W). All Rights Reserved. Privacy Policy | Privacy Notice</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
          /*An array containing all the product name list for search purpose:*/
            var json_data = <?php echo json_encode($productArray); ?>;
            var productList = [];
            for(var i in json_data)
            {
                productList.push(json_data[i].product_name);
            }  
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/classic.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    
</body>

</html>