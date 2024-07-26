<?php include 'a_action.php'; ?>

<?php

$sql11 = "SELECT count(a_id) as ca_id FROM admin";

$result11 = $conn->query($sql11);

$row11 = $result11->fetch_assoc();

?>

<?php

$sql12 = "SELECT count(c_id) as cc_id FROM candidate";

$result12 = $conn->query($sql12);

$row12 = $result12->fetch_assoc();

?>

<?php

$sql13 = "SELECT count(m_id) as cco_id FROM member";

$result13 = $conn->query($sql13);

$row13 = $result13->fetch_assoc();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ໜ້າ​ຫຼັກ</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include '../style/stylesheet.php'; ?>

</head>

<body>

    <!-- ======= Header ======= -->
    <?php include '../navbar/navbar_a.php'; ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../sidebar/sidebar_a.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle py-2">
            <h1>ໜ້າ​ຫຼັກ</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">ຜູ້​ດູ​ແລລະບົບ</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $row11['ca_id']; ?> ທ່ານ</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">


                                <div class="card-body">
                                    <h5 class="card-title">ຜູ້​ສະ​ໝັກ</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $row12['cc_id']; ?> ທ່ານ</h6>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">


                                <div class="card-body">
                                    <h5 class="card-title">ຜູ້​ແທນ</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check2-square"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $row13['cco_id']; ?> ທ່ານ</h6>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->


            </div>
        </section>

    </main><!-- End #main -->



    <?php include '../style/script.php'; ?>

</body>

</html>