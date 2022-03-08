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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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

                    <!-- Card Layout View -->
                    <div class="row">
                        <!--/ A set of walkthrough screens in HTML/CSS/JS. A personal experiment with layering images, CSS3 transitions, & flexbox. 
                        -->
                        <button class="open-walkthrough">Start</button>
                        <div class="walkthrough show reveal">
                        <div class="walkthrough-pagination">
                            <a class="dot active"></a>
                            <a class="dot"></a>
                            <a class="dot"></a>
                            <a class="dot"></a>
                            <a class="dot"></a>
                        </div>
                        <div class="walkthrough-body">
                            <ul class="screens animate">
                            <li class="screen active">
                                <div class="media logo">
                                <img class="logo" src="https://s3.amazonaws.com/jebbles-codepen/icon.png"/>
                                </div>
                                <h3>
                                Product Intro
                                <br/>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                            </li>
                            <li class="screen">
                                <div class="media books">
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/book_icon_1.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/book_icon_2.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/book_icon_3.png"/>
                                </div>
                                <h3>
                                Data and File
                                <br/>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                            </li>
                            <li class="screen">
                                <div class="media bars">
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/bar_icon_axis.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/bar_icon_3.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/bar_icon_2.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/bar_icon_1.png"/>
                                </div>
                                <h3>
                                Analytics
                                <br/>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                            </li>
                            <li class="screen">
                                <div class="media files">
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/file_icon_1.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/file_icon_2.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/file_icon_3.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/file_icon_4.png"/>
                                </div>
                                <h3>
                                Reporting
                                <br/>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                            </li>
                            <li class="screen">
                                <div class="media comm">
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/comm_icon_1.png"/>
                                <img class="icon" src="https://s3.amazonaws.com/jebbles-codepen/comm_icon_2.png"/>
                                </div>
                                <h3>
                                Communications
                                <br/>
                                </h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                            </li>
                            </ul>
                            <button class="prev-screen">
                            <i class="icon-angle-left"></i>
                            </button>
                            <button class="next-screen">
                            <i class="icon-angle-right"></i>
                            </button>
                        </div>
                        <div class="walkthrough-footer">
                            <button class="button next-screen">Next</button>
                            <button class="button finish close" disabled="true">Finish</button>
                        </div>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>
body {
  color: white;
  font-family: "Lato";
  font-weight: light;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
  background: linear-gradient(150deg, #e6d3f9 0%, #e6d3f9 50%, #cea0f1 50%, #cea0f1 100%);
}
.open-walkthrough {
  border: 0;
  background: #5da3f2;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  font-size: 12px;
  height: 40px;
  width: 120px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -20px;
  margin-left: -60px;
}
.walkthrough {
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.23), 0 10px 40px rgba(0, 0, 0, 0.19);
  background: linear-gradient(to right bottom, #9e66c6, #6027e1);
  border-radius: 0;
  display: none;
  flex-direction: column;
  flex: 0 0 auto;
  font-size: 14px;
  height: 464px;
  overflow: hidden;
  transition: opacity 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  width: 280px;
  z-index: 1000;
}
.walkthrough.show {
  display: flex;
  opacity: 0;
  transform: translateY(72px);
}
.walkthrough.reveal {
  opacity: 1;
  transform: translateY(0);
}
.walkthrough .walkthrough-body {
  align-items: center;
  display: flex;
  flex: 1;
  text-align: center;
}
.walkthrough .walkthrough-body .prev-screen, .walkthrough .walkthrough-body .next-screen {
  align-self: stretch;
  background: none;
  border: 0;
  margin-top: 40px;
  color: rgba(255, 255, 255, 0.25);
  cursor: pointer;
  flex: 0 0 auto;
  font-size: 24px;
  opacity: 1;
  outline: none;
  padding: 16px;
  transform: scale(1);
  transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), color 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), opacity 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  z-index: 1000;
}
.walkthrough .walkthrough-body .prev-screen:hover, .walkthrough .walkthrough-body .next-screen:hover, .walkthrough .walkthrough-body .prev-screen:active, .walkthrough .walkthrough-body .next-screen:active {
  color: white;
  transform-origin: center;
  transform: scale(1.25);
}
.walkthrough .walkthrough-body .prev-screen:disabled, .walkthrough .walkthrough-body .next-screen:disabled {
  opacity: 0;
}
.walkthrough .walkthrough-body .prev-screen {
  order: 1;
}
.walkthrough .walkthrough-body .next-screen {
  order: 3;
}
.walkthrough .walkthrough-body .screens {
  flex: 1;
  align-self: stretch;
  position: relative;
  margin: 0 -16px;
  padding: 0;
  order: 2;
}
.walkthrough .walkthrough-body .screens .screen {
  position: absolute;
  list-style-type: none;
}
.walkthrough .walkthrough-body .media {
  background: rgba(255, 255, 255, 0.25);
  border-radius: 132px;
  height: 132px;
  margin: 32px auto;
  width: 132px;
}
.walkthrough .walkthrough-body h3 {
  font-size: 15px;
  line-height: 1.4em;
  text-transform: uppercase;
  letter-spacing: 0.15em;
}
.walkthrough .walkthrough-body p {
  line-height: 1.6em;
  font-size: 13px;
  margin-top: 16px;
  padding-top: 0;
  color: rgba(255, 255, 255, 0.8);
}
.walkthrough .walkthrough-pagination {
  align-items: center;
  display: flex;
  justify-content: center;
  margin-top: 24px;
}
.walkthrough .walkthrough-pagination .dot {
  background: rgba(0, 0, 0, 0.25);
  border-radius: 8px;
  height: 8px;
  margin: 0 4px;
  transform: scale(0.75);
  transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), background 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  width: 8px;
}
.walkthrough .walkthrough-pagination .dot.active {
  background: white;
  transform: scale(1);
  transition-delay: 0.4s;
}
.walkthrough .walkthrough-footer {
  display: flex;
  flex: 0 0 auto;
  justify-content: space-around;
  padding: 0;
}
.walkthrough .walkthrough-footer button {
  height: 40px;
  border: 0;
  background: #5da3f2;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  border-radius: 0;
  color: white;
  flex: 1;
  font-size: 12px;
  margin: 0;
  outline: 0;
  padding: 12px;
  transition: opacity 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), background 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  cursor: pointer;
}
.walkthrough .walkthrough-footer button:hover {
  background: #6babf3;
}
.walkthrough .walkthrough-footer button:active {
  background: #5da3f2;
}
.walkthrough .walkthrough-footer button:disabled {
  cursor: pointer;
}
.walkthrough .walkthrough-footer button.finish {
  background: #3e94f5;
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  opacity: 0;
  transform: scale(0, 1);
  transform-origin: center;
  transition: opacity 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), background 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.walkthrough .walkthrough-footer button.finish:hover {
  background: #4d9cf6;
}
.walkthrough .walkthrough-footer button.finish:active {
  background: #3e94f5;
}
.walkthrough .walkthrough-footer button.finish.active {
  transform: scale(1, 1);
  opacity: 1;
}
.walkthrough .screens {
  margin: 0;
}
.walkthrough .screens .media .status-badge {
  left: 136px;
  opacity: 0;
  position: absolute;
  top: 104px;
  transform: scale(0);
  transition: opacity 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  transition-delay: 0.6s;
}
.walkthrough .screens .media .status-badge i {
  display: inline;
}
.walkthrough .screens .media.logo .logo {
  margin-top: 20px;
  opacity: 0;
  transform: translateY(-60px);
  transition: opacity 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  width: 80px;
}
.walkthrough .screens .media .icon {
  position: absolute;
  opacity: 0;
  transform: translateY(-30px);
  transition: opacity 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
  width: 132px;
  left: 48px;
  top: 32px;
}
.walkthrough .screens .media.bars .icon {
  transform: translate(40px, 20px);
}
.walkthrough .screens .media.bars .icon:nth-of-type(2) {
  transform: scale(0.25);
  transform-origin: 30% 54%;
}
.walkthrough .screens .media.bars .icon:nth-of-type(3) {
  transform: scale(0.25);
  transform-origin: 30% 40%;
}
.walkthrough .screens .media.bars .icon:nth-of-type(4) {
  transform: scale(0.25);
  transform-origin: 30% 26%;
}
.walkthrough .screens .media.files .icon {
  transform: translate(40px, 20px);
}
.walkthrough .screens .media.comm .icon {
  transform: scale(0.25);
  transform-origin: 29% 73%;
}
.walkthrough .screens .media.comm .icon:nth-child(2) {
  transform-origin: 66% 85%;
}
.walkthrough .screens .screen {
  opacity: 0;
  position: absolute;
  transform: translateX(-72px);
  transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.walkthrough .screens .screen.active {
  opacity: 1;
  transform: translateX(0) scale(1);
  transition-delay: 0.4s;
}
.walkthrough .screens .screen.active ~ .screen {
  opacity: 0;
  transform: translateX(72px);
}
.walkthrough .screens .screen.active .media .status-badge {
  opacity: 1;
  transform: scale(1.75);
}
.walkthrough .screens .screen.active .media.logo .logo {
  opacity: 0.8;
  transform: translateY(0);
  transition-delay: 0.6s;
}
.walkthrough .screens .screen.active .media.logo .status-badge {
  transition-delay: 1s;
}
.walkthrough .screens .screen.active .media.books .icon {
  opacity: 1;
  transform: translateY(0);
  transition-delay: 0.6s;
}
.walkthrough .screens .screen.active .media.books .icon:nth-child(2) {
  transition-delay: 0.725s;
}
.walkthrough .screens .screen.active .media.books .icon:nth-child(3) {
  transition-delay: 0.85s;
}
.walkthrough .screens .screen.active .media.books .status-badge {
  transition-delay: 1.4s;
}
.walkthrough .screens .screen.active .media.bars .icon {
  opacity: 1;
  transform: translate(0) scale(1);
  transition-delay: 0.6s;
}
.walkthrough .screens .screen.active .media.bars .icon:nth-child(2) {
  transition-delay: 1.05s;
}
.walkthrough .screens .screen.active .media.bars .icon:nth-child(3) {
  transition-delay: 0.925s;
}
.walkthrough .screens .screen.active .media.bars .icon:nth-child(4) {
  transition-delay: 0.8s;
}
.walkthrough .screens .screen.active .media.files .icon {
  opacity: 1;
  transform: translateY(0);
  transition-delay: 0.9s;
}
.walkthrough .screens .screen.active .media.files .icon:nth-child(3) {
  transition-delay: 0.8s;
}
.walkthrough .screens .screen.active .media.files .icon:nth-child(2) {
  transition-delay: 0.7s;
}
.walkthrough .screens .screen.active .media.files .icon:nth-child(1) {
  transition-delay: 0.6s;
}
.walkthrough .screens .screen.active .media.files .status-badge {
  transition-delay: 1.6s;
}
.walkthrough .screens .screen.active .media.comm .icon {
  opacity: 1;
  transform: scale(1);
  transition-delay: 0.6s;
}
.walkthrough .screens .screen.active .media.comm .icon:nth-child(2) {
  transition-delay: 0.8s;
}
.walkthrough .screens .screen.active .media.comm .status-badge {
  transition-delay: 1.6s;
}


</style>

<script>
    $(document).ready ->
  walkthrough =
    index: 0
    
    nextScreen: ->
      if @index < @indexMax()
        @index++
        @updateScreen()

    prevScreen: ->
      if @index > 0
        @index--
        @updateScreen()
        
    updateScreen: ->
      @reset()
      @goTo @index
      @setBtns()
      
    setBtns: ->
      $nextBtn = $('.next-screen')
      $prevBtn = $('.prev-screen')
      $lastBtn = $('.finish')
      
      if walkthrough.index == walkthrough.indexMax()
        $nextBtn.prop('disabled', true);
        $prevBtn.prop('disabled', false);
        $lastBtn.addClass('active').prop('disabled', false);
        
      else if walkthrough.index == 0
        $nextBtn.prop('disabled', false)
        $prevBtn.prop('disabled', true)
        $lastBtn.removeClass('active').prop('disabled', true)
        
      else
        $nextBtn.prop('disabled', false)
        $prevBtn.prop('disabled', false)
        $lastBtn.removeClass('active').prop('disabled', true)


    goTo: (index) ->
      $('.screen').eq(index).addClass 'active'
      $('.dot').eq(index).addClass 'active'

    reset: ->
      $('.screen, .dot').removeClass 'active'

    indexMax: ->
      $('.screen').length - 1

    closeModal: ->
      $('.walkthrough, .shade').removeClass('reveal')
      setTimeout (=>
        $('.walkthrough, .shade').removeClass('show')
        @index = 0
        @updateScreen()
      ), 200

    openModal: ->
      $('.walkthrough, .shade').addClass('show')
      setTimeout (=>
        $('.walkthrough, .shade').addClass('reveal')
      ), 200
      @updateScreen()

  $('.next-screen').click ->
    walkthrough.nextScreen()

  $('.prev-screen').click ->
    walkthrough.prevScreen()

  $('.close').click ->
    walkthrough.closeModal()
    
  $('.open-walkthrough').click ->
    walkthrough.openModal()
    
  walkthrough.openModal()
 
  # Optionally use arrow keys to navigate walkthrough
  $(document).keydown (e) ->
    switch e.which
      when 37
        # left
        walkthrough.prevScreen()
      when 38
        # up
        walkthrough.openModal()
      when 39
        # right
        walkthrough.nextScreen()
      when 40
        # down
        walkthrough.closeModal()
      else
        return
    e.preventDefault()
    return
</script>