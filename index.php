<?php
    require __DIR__ . '/header.php'
?>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['restaurant']))
        {
            $_SESSION['Restaurant_ID'] = $_POST['restaurant'];
            echo("<script>window.location.href = \"main.php\";</script>");
        }
    }
?>
                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">

                    <!-- Content Row - Slidebar and SlideShow -->
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-0">
                            <div class="browse-menus">
                                <div class="browse-menu active">
                                    <ul class="main-menu">
                                        <li class="menu-item" style="display: list-item;">
                                        <a href="https://burgerthemes.com/demo/lite/storebiz/product-category/uncategorized/" class="nav-link">Uncategorized</a>
                                        </li>
                                        <li class="menu-item" style="display: list-item;">
                                        <a href="https://burgerthemes.com/demo/lite/storebiz/product-category/beauty/" class="nav-link">Beauty</a>
                                        </li>
                                        <li class="menu-item menu-item-has-children" style="display: list-item;">
                                            <a href="https://burgerthemes.com/demo/lite/storebiz/product-category/clothing/" class="nav-link">Clothing</a>
                                            <ul class="dropdown-menu">
                                                <li class="menu-item">
                                                <a href="https://burgerthemes.com/demo/lite/storebiz/product-category/clothing/accessories/" class="dropdown-item">Accessories</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item" style="display: list-item;">
                                        <a href="https://burgerthemes.com/demo/lite/storebiz/product-category/electronic/" class="nav-link">Electronic</a>
                                        </li>
                                        <li class="menu-item" style="display: list-item;">
                                        <a href="https://burgerthemes.com/demo/lite/storebiz/product-category/fashion/" class="nav-link">Fashion</a>
                                        </li>
                                        <li class="menu-item" style="display: list-item;">
                                        <a href="https://burgerthemes.com/demo/lite/storebiz/product-category/music/" class="nav-link">Music</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- Slideshow -->
                        <div class="col-xl-6 col-lg-4">
                            <div class="slideshow">
                                <!-- Slideshow Items -->
                                <div class="slideshow-items">
                                <div class="item">
                                    <div class="item-image-container">
                                    <img class="item-image" src="https://png.pngtree.com/background/20210714/original/pngtree-vibrant-green-red-and-yellow-low-poly-abstract-banner-background-picture-image_1238020.jpg" />
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item-image-container">
                                    <img class="item-image" src="https://png.pngtree.com/thumb_back/fw800/background/20201113/pngtree-abstract-triangle-shapes-design-banner-image_469727.jpg" />
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item-image-container">
                                    <img class="item-image" src="https://png.pngtree.com/background/20210714/original/pngtree-yellow-red-green-and-blue-color-low-poly-abstract-banner-design-picture-image_1238027.jpg" />
                                    </div>
                                </div>
                                </div>
                                <div class="controls">
                                <ul>
                                    <li class="control" data-index="0"></li>
                                    <li class="control" data-index="1"></li>
                                    <li class="control" data-index="2"></li>
                                </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4">
                            <div class="row">
                                
                            </div>
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

    .sidebar{

    }
    .slideshow {
    position: relative;
    width: 100%;
    height: 50vh;
    justify-content: space-around;
    }

    .slideshow-items {
    position: relative;
    width: 100%;
    height: 300px;
    }

    .item {
    position: absolute;
    width: 100%;
    height: auto;
    }

    .item-image-container {
    position: relative;
    width: 100%;
    }

    .item-image-container::before {
    content: '';
    position: absolute;
    top: -1px;
    left: 0;
    width: 101%;
    background: #b0b0b0;
    opacity: 0;
    z-index: 1;
    }

    .item-image {
    position: relative;
    width: 100%;
    height: auto;
    opacity: 0;
    display: block;
    /* transition: property name | duration | timing-function | delay  */
    transition: opacity .3s ease-out .45s;
    }

    .item.active .item-image {
    opacity: 1;
    }

    .item.active .item-image-container::before {
    opacity: .8;
    }

    .item-description {
    position: absolute;
    top: 182px;
    right: 0;
    width: 50%;
    padding-right: 4%;
    line-height: 1.8;
    }

    /* Staggered Vertical Items ------------------------------------------------------*/
    .item-header {
    position: absolute;
    top: 150px;
    left: 1.8%;
    z-index: 100;
    }

    .item-header .vertical-part {
    font-family: 'Montserrat', sans-serif;
    -webkit-font-smoothing: auto;
    font-size: 7vw;
    color: #fff;
    }

    .vertical-part {
    overflow: hidden;
    display: inline-block;
    }

    .vertical-part b {
    display: inline-block;
    transform: translateY(100%);
    color:white;
    }

    .item-header .vertical-part b {
    transition: .5s;
    }

    .item-description .vertical-part b {
    transition: .21s;
    }

    .item.active .item-header .vertical-part b {
    transform: translateY(0);
    }

    .item.active .item-description .vertical-part b {
    transform: translateY(0);
    }

    /* Controls ----------------------------------------------------------------------*/
    .controls {
    position: relative;
    text-align: right;
    z-index: 1000;
    }

    .controls ul {
    list-style: none;
    }

    .controls ul li {
    display: inline-block;
    width: 10px;
    height: 10px;
    margin: 3px;
    background:#bdbdd5;;
    cursor: pointer;
    }

    .controls ul li.active {
    background:#6a6a77;;
    }

    /* Category Menu */
    .browse-menus {
        position:relative;
        z-index:1;
    }

    .browse-menus .browse-menu{
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        heigh:auto;
        z-index:0;
        background-color:#ffffff;
    }

    .browse-menu ul.main-menu{
        border: 1px solid var(--bs-gray-light);
    }

    .browse-menu .main-menu li{
        border-bottom: 1px solid #e1e1e1;
        position: relative;
        list-style: none;
    }

    .browse-menu .main-menu li a{
        padding: 0 18px;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: flex-start;
        line-height:50px;
    }

    .browse-menu .dropdown-menu {
        top: 0;
        left: 100%;
        border-bottom-width: 4px;
        border-style: solid;
        border-color: var(--bs-primary);
        position: absolute;
        z-index: 99;
        width: 220px;
        background: var(--bs-white);
        padding: 4px 0;
        margin: 0;
        border: 0;
        border-top-color: currentcolor;
        border-top-style: none;
        border-right-color: currentcolor;
        border-right-style: none;
        border-bottom-color: currentcolor;
        border-bottom-style: none;
        border-bottom-width: 0px;
        border-left-color: currentcolor;
        border-left-style: none;
        border-radius: 0;
        -moz-box-shadow: 0 -8px 16px rgba(0, 0, 0, 0.075);
        box-shadow: 0 -8px 16px rgba(0, 0, 0, 0.075);
        font-size: 1rem;
        text-align: left;
        display: block;
        opacity: 0;
        visibility: hidden;
        -webkit-transform: scaleY(0);
        transform: scaleY(0);
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        -webkit-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    

</style>

<script>
    // Master DOManipulator v2 ------------------------------------------------------------
    const items = document.querySelectorAll('.item'),
    controls = document.querySelectorAll('.control'),
    activeDelay = .76,
    interval = 5000;

    let current = 0;

    const slider = {
        init: () => {
            controls.forEach(control => control.addEventListener('click', (e) => { slider.clickedControl(e) }));
            controls[current].classList.add('active');
            items[current].classList.add('active');
        },
        nextSlide: () => { // Increment current slide and add active class
            slider.reset();
            if (current === items.length - 1) current = -1; // Check if current slide is last in array
            current++;
            controls[current].classList.add('active');
            items[current].classList.add('active');
        },
        clickedControl: (e) => { // Add active class to clicked control and corresponding slide
            slider.reset();
            clearInterval(intervalF);

            const control = e.target,
            dataIndex = Number(control.dataset.index);

            control.classList.add('active');
            items.forEach((item, index) => { 
            if (index === dataIndex) { // Add active class to corresponding slide
                item.classList.add('active');
            }
            })
            current = dataIndex; // Update current slide
            intervalF = setInterval(slider.nextSlide, interval); // Fire that bad boi back up
        },
        reset: () => { // Remove active classes
            items.forEach(item => item.classList.remove('active'));
            controls.forEach(control => control.classList.remove('active'));
        }
    }

    let intervalF = setInterval(slider.nextSlide, interval);
    slider.init();
</script>