<?php include $_SERVER['DOCUMENT_ROOT']."/api/JsonDecoder.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="공기질 상태를 분석해주는 IoT 플랫폼입니다">
    <meta name="author" content="김태원">

    <title>Hybrid-IoT Platform</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-wifi"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Hybrid IoT</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>대시보드</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                공기질 데이터
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>공기질 기록</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="api.php">
                    <i class="fas fa-network-wired"></i>
                    <span>API</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                기타
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="https://github.com/twk1024/Hybrid-IoT" target="_blank">
                    <i class="fab fa-github"></i>
                    <span>GitHub</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/open-folder-with-document.png" alt="...">
                <p class="text-center mb-2"><strong>하이브리드 IoT 플랫폼</strong>은 탄소 배출량을 줄이고 공기질 개선을 목표로 제작된 오픈 소스 소프트웨어입니다.</p>
                <a class="btn btn-success btn-sm" href="https://github.com/twk1024/Hybrid-IoT">Source Code</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="input-group-append">
                        <a href="https://github.com/twk1024/Hybrid-IoT" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i class="fab fa-github fa-sm"></i> Source Code</a>
                </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">1+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    실시간 공기질 알림
                                </h6>
                                <?php
                                    echo "<a class=\"dropdown-item d-flex align-items-center\" href=\"#\">";
                                    echo "<div class=\"mr-3\">";
                                    if(getAirScoreStatus("KSGG01") == "매우 좋음" || getAirScoreStatus("KSGG01") == "좋음"){
                                        echo "<div class=\"icon-circle bg-success\">";
                                        echo "<i class=\"far fa-thumbs-up\"></i>";
                                        $message = "이 상태를 계속 유지해 보세요!";
                                    }else if(getAirScoreStatus("KSGG01") == "보통")
                                    {
                                        echo "<div class=\"icon-circle bg-primary\">";
                                        echo "<i class=\"fas fa-file-alt text-white\"></i>";
                                        $message = "조금 더 노력해서 공기질을 개선합시다!";
                                    }
                                    else if(getAirScoreStatus("KSGG01") == "나쁨")
                                    {
                                        echo "<div class=\"icon-circle bg-warning\">";
                                        echo "<i class=\"fas fa-exclamation-triangle text-white\"></i>";
                                        $message = "공기질 개선을 위한 노력이 필요합니다!";
                                    }
                                    else if(getAirScoreStatus("KSGG01") == "매우 나쁨")
                                    {
                                        echo "<div class=\"icon-circle bg-warning\">";
                                        echo "<i class=\"fas fa-exclamation-triangle text-white\"></i>";
                                        $message = "공기질 개선을 위한 노력이 필요합니다!";
                                    }

                                    echo "</div>";
                                    echo "</div>";
                                    echo "<div>";
                                    echo "<div class=\"small text-gray-500\">" . getLastDate("KSGG01") . "</div>";
                                    echo "<span class=\"font-weight-bold\">현재 공기질 상태가 '" . getAirScoreStatus("KSGG01") . "' 입니다. " . $message . "</span>";
                                    echo "</div>";
                                    echo "</a>";
                                ?>
                                <a class="dropdown-item text-center small text-gray-500" href="index.php">하이브리드 IoT 플랫폼</a></a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hybrid-IoT 1.0.0</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!--  <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    업데이트 정보
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-1 text-gray-800">REST API</h1>
                    <p class="mb-4">자유롭게 사용 가능한 Hybrid-IoT 플랫폼의 API입니다.</p>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-lg-6">

                            <!-- Overflow Hidden -->
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Query API</h6>
                                </div>
                                <div class="card-body">
                                    실시간 공기질 데이터에 접근할 수 있습니다.
                                    <br><br>
                                    <code>GET </code><a href="http://hybrid.diamc.kr/api/query.php?device_id=KSGG01&limit=1" target="_blank">http://hybrid.diamc.kr/api/query.php?device_id=[측정기 아이디]&limit=[최대 데이터 개수]</a>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-6">

                            <!-- Roitation Utilities -->
                            <div class="card">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">WeekQuery API</h6>
                                </div>
                                <div class="card-body">
                                    일주일 간의 공기질 데이터에 접근할 수 있습니다.
                                    <br><br>
                                    <code>GET </code><a href="http://hybrid.diamc.kr/api/weekQuery.php?device_id=KSGG01" target="_blank">http://hybrid.diamc.kr/api/weekQuery.php?device_id=[측정기 아이디]</a>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">

                            <!-- Roitation Utilities -->
                            <div class="card">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">OnlineCheck API</h6>
                                </div>
                                <div class="card-body">
                                    공기질 측정기와 플랫폼의 온라인 여부를 확인할 수 있습니다.
                                    <br><br>
                                    <code>GET </code><a href="http://hybrid.diamc.kr/api/onlineChecker.php?device_id=KSGG01" target="_blank">http://hybrid.diamc.kr/api/onlineChecker.php?device_id=[측정기 아이디]</a>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">API 서버 상태</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#OnlineCheckAPIModal">API 응답 본문</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> <i class="fas fa-circle text-success"></i>  <i class="fas fa-circle text-info"></i>
                                            <h6 class="m-0 font-weight-bold"><?php if(isOnline("KSGG01") == true) echo "모든 API 서비스가 정상 동작 중입니다."; else echo "일부 API 서비스에 문제가 발생했습니다." ?></h6>
                                        </span>
                                    </div>
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
                        <span>&copy; Hybrid-IoT 2021 by 김태원(twk1024@gmail.com)</span>
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

    <!-- Update Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">최근 업데이트 기록</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">1.0.0 - 하이브리드 IoT 플랫폼이 정식 출시되었습니다</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">닫기</button>
                    <a class="btn btn-primary" href="https://github.com/twk1024/Hybrid-IoT/releases">자세히 보기</a>
                </div>
            </div>
        </div>
    </div>

    
    <!-- OnlineCheckAPI Modal-->
    <div class="modal fade" id="OnlineCheckAPIModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hybrid-IoT REST API Result</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                            
                    </button>
                </div>
                <div class="modal-body">
                            <?php
                                echo "{<br>";
                                echo "&nbsp;&nbsp;&nbsp; \"device_id\": \"KSGG01\"<br>";
                                echo "&nbsp;&nbsp;&nbsp; \"online\": \"" . isOnline("KSGG01")  . "\"<br>";
                                echo "&nbsp;&nbsp;&nbsp; \"date\": \"" . getLastDate("KSGG01") . "\"<br>";
                                echo "}";
                            ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">닫기</button>
                    <a class="btn btn-primary" href="http://hybrid.diamc.kr/api/onlineChecker.php?device_id=KSGG01" target="_blank">자세히 보기</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>