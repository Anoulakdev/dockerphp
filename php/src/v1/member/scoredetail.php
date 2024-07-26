<?php include 's_action.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ລາຍ​ລະ​ອຽດ​ການ​ລົງ​ຄະ​​ແນນທີ່​ທ່ານບໍ່​ເອົາ</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include '../style/stylesheet.php'; ?>

    <style>
        .scrollable-table {
            width: 100%;
            overflow-x: auto;
        }

        .scrollable-table table {
            width: 100%;
            white-space: nowrap;
        }
    </style>


</head>

<body>

    <!-- ======= Header ======= -->
    <?php include '../navbar/navbar_m.php'; ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../sidebar/sidebar_m.php'; ?>

    <main id="main" class="main">
        <div class="container-fluid">



            <div class="pagetitle py-2">
                <h1>ລາຍ​ລະ​ອຽດ​ການ​ລົງ​ຄະ​​ແນນທີ່​ທ່ານບໍ່​ເອົາ</h1>

            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">

                                <?php
                                $query = "SELECT sc.*, c.* FROM score as sc inner join candidate as c on sc.c_id = c.c_id where sc.sc_result = 0 AND sc.m_id = '" . $_SESSION['m_id'] . "' ";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $data = array();
                                while ($row = $result->fetch_assoc()) {
                                    $data[] = $row;
                                }
                                ?>
                                <!-- Default Table -->
                                <div class="scrollable-table mt-4">
                                    <table class="table" id="example">
                                        <thead class="table-light text-center align-middle">
                                            <tr>
                                                <th rowspan="2">ລ/ດ</th>
                                                <th rowspan="2">ຮູບ​ພາບ</th>
                                                <th rowspan="2">​ຊື່ ແລະ ນາມ​ສະ​ກຸນ</th>
                                                <th rowspan="2">​ອາ​ຍຸ</th>
                                                <th colspan="3" class="text-center">ຕຳ​ແໜ່ງ</th>
                                                <th rowspan="2">ກົມ​ກອງ​ບ່ອນ​ປະ​ຈຳ​ການ</th>
                                                <th rowspan="2">ໝາຍ​ເຫດ</th>
                                            </tr>
                                            <tr>
                                                <th>ພັກ</th>
                                                <th>​ລັດ</th>
                                                <th>​ຊາ​ວ​ໜຸ່ມ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center align-middle">
                                            <?php $i = 1; ?>
                                            <?php foreach ($data as $row) { ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td>
                                                        <?php if ($row['c_pic'] != "") { ?>
                                                            <img src="../uploads/candidate/<?= $row['c_pic']; ?>" width="60" height="65" class="rounded-circle">
                                                        <?php } else { ?>
                                                            <img src="../assets/img/profile-picture.jpg" alt="Profile" width="60" height="65" class="rounded-circle">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-start"><?= $row['c_name']; ?></td>
                                                    <td><?= $row['c_age']; ?></td>
                                                    <td><?= $row['c_phak']; ?></td>
                                                    <td><?= $row['c_lat']; ?></td>
                                                    <td><?= $row['c_saonoum']; ?></td>
                                                    <td><?= $row['c_part']; ?></td>
                                                    <td><?= $row['c_reason']; ?></td>

                                                </tr>



                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Default Table Example -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </main><!-- End #main -->



    <?php include '../style/script.php'; ?>


</body>

</html>