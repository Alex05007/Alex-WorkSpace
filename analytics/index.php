<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <title>Alex Analytics</title>
    <link rel="icon" href="../logo/Analytics.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

<?php
	$hostname = 'localhost:3307';
	include "../db.php";
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=alexanalytics", $username, $password);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="sidebar-brand-icon rotate-n-15">
                            <img src="../logo/Analytics.png" width="50px">
                        </div>
                        <div class="sidebar-brand-text mx-3" style="color:#000;">Alex Analytics</div>
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
                                                Todays views</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php
													//timp
													$today = 0;
													$day1 = date("Y:m:") . (intval(date("d"))-1);
													$day2 = date("Y:m:") . (intval(date("d"))-2);
													$day3 = date("Y:m:") . (intval(date("d"))-3);
													$day4 = date("Y:m:") . (intval(date("d"))-4);
													$day5 = date("Y:m:") . (intval(date("d"))-5);
													$day6 = date("Y:m:") . (intval(date("d"))-6);
													$dayv1=0;
													$dayv2=0;
													$dayv3=0;
													$dayv4=0;
													$dayv5=0;
													$dayv6=0;
													
													$j=0;
													$x=0;
													$b=0;
													$views = 0;
													$countrys = "";
													$country = array();
													$rezolutions = array();
													$rezol = array();
													$rezolutie = array();
													$r = array();
													
                                                    $sql = "SELECT * FROM `analytics` WHERE id='" . $_GET['id'] . "'";
                                                    $stmt = $conn->query($sql);
                                                    while ($row = $stmt->fetch()) {
														if ($row['timp'] == date("Y:m:d")) {
															$today++;
														}
														if ($row['timp'] == $day1)
															$dayv1++;
														if ($row['timp'] == $day2)
															$dayv2++;
														if ($row['timp'] == $day3)
															$dayv3++;
														if ($row['timp'] == $day4)
															$dayv4++;
														if ($row['timp'] == $day5)
															$dayv5++;
														if ($row['timp'] == $day6)
															$dayv6++;
														$views++;
														if (strpos(implode($country), $row['location']) === false) {
                                                        	$country[$j] .= $row['location'];
															$j++;
														}
														if ($row['resolutie'] != "") {
															if (strpos(implode($rezolutions), $row['rezolutie']) === false) {
																$rezolutions[$b] = $row['rezolutie'];
																$r[$row['rezolutie']] = $row['rezolutie'];
																$b++;
															}
															$rezol[$x] = $row['rezolutie'];
															$x++;
														}
														$countrys .= $row['location'];
                                                    }
													echo $today;
													for ($i=0; $i<count($rezolutions); $i++) {
														$rezolutie[$i] = substr_count(implode($rezol), $rezolutions[$i]);
													}
													echo $i;
                                                ?>
                                            </div>
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
                                                Total views</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $views; ?></div>
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
                                                Most entered country</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php
													if (count($country) > 1) {
														$top_contrys = array();
														for ($i=0; $i<count($country); $i++) {
															$top_contrys[substr_count($country[$i], $countrys)] = $country[$i];
														}
														echo implode($top_contrys);
													} else {
														echo $country[0];
													}
                                                ?>
                                                </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-globe-europe fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <<div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Views last week</h6>
                                </div>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Diplay sizes</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <!--<div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">100%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; Alex Sofonea - 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <?php
    	echo '<script id="area" src="js/demo/chart-area-demo.js" data-day="' . date("Y:m:d") . '" data-day2="' . $day1 . '" data-day3="' . $day2 . '" data-day4="' . $day3 . '" data-day5="' . $day4 . '" data-day6="' . $day5 . '" data-day7="' . $day6 . '" data-view="' . $today . '" data-view2="' . $dayv1 . '" data-view3="' . $dayv2 . '" data-view4="' . $dayv3 . '" data-view5="' . $dayv4 . '" data-view6="' . $dayv5 . '" data-view7="' . $dayv6 . '"></script>';
		echo '<script id="pie" src="js/demo/chart-pie-demo.js" data-rezp1="' . $rezolutie[0] . '" data-rezp2="' . $rezolutie[1] . '" data-rezp3="' . $rezolutie[2] . '" data-rezp4="1' . $rezolutie[3] . ' data-rezp5="' . $rezolutie[4] . '" data-rezl1="' . $r[$rezolutie[0]] . '" data-rezl2="' . $r[$rezolutie[1]] . '" data-rezl3="' . $r[$rezolutie[2]] . '" data-rezl4="' . $r[$rezolutie[3]] . '" data-rezl5="' . $r[$rezolutie[4]] . '"></script>';
    ?>

</body>

</html>