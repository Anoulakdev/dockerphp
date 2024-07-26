<?php include 's_action.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ລົງ​ຄະ​ແນນ</title>
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
                <h1>ລົງ​ຄະ​ແນນ</h1>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">
                        <div class="row">

                            <!-- Sales Card -->

                            <div class="card">

                                <div class="card-body">

                                    <?php
                                    $result = $conn->query("SELECT * FROM score WHERE m_id = '" . $_SESSION["m_id"] . "'");
                                    $row_cnt = $result->num_rows;

                                    if ($row_cnt > 0) { ?>

                                        <h1 class="my-5 text-success">ທ່ານ​ໄດ້​ລົງ​ຄະ​ແນນ​ສ​ຳ​ເລັ​ດ​ແລ້ວ</h1>

                                    <?php } else { ?>

                                        <h4 class="my-4"><i class="bi bi-asterisk"></i> ຈົ່ງເລືອກ​ເອົາ 2 ຄົນທີ່​ທ່ານບໍ່​ເອົາ.</h4>

                                        <form class="row g-3" action="s_action" method="post">
                                            <input type="hidden" name="m_id" value="<?= $_SESSION['m_id']; ?>">

                                            <?php
                                            $query = "SELECT * FROM candidate";
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $data = array();
                                            while ($row = $result->fetch_assoc()) {
                                                $data[] = $row;
                                            }
                                            ?>


                                            <div class="scrollable-table">
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
                                                                <td><input class="form-check-input" type="checkbox" name="c_id[]" value="<?= $row['c_id']; ?>"></td>
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

                                            <div class="col-md-10">
                                                <button disabled type="submit" name="add" id="add" class="btn btn-primary">ລົງ​ຄະ​ແນນ</button>
                                                <button class="btn btn-primary" type="button" disabled id="load">
                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    ກຳ​ລັງ​ລົງ​ຄະ​ແນນ...
                                                </button>
                                            </div>
                                        </form>

                                    <?php } ?>
                                </div>

                            </div>

                        </div>

                    </div>
                </div><!-- End Left side columns -->

        </div>
        </section>

        </div>

    </main><!-- End #main -->



    <?php include '../style/script.php'; ?>

    <script>
        var checkboxs = document.getElementsByName('c_id[]');
        var submitButton = document.getElementById('add');
        var limit = 2;
        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].onclick = function() {
                var checkedCount = document.querySelectorAll('input[name="c_id[]"]:checked').length;
                if (checkedCount >= limit) {
                    for (var j = 0; j < checkboxs.length; j++) {
                        if (!checkboxs[j].checked) {
                            checkboxs[j].disabled = true;
                            submitButton.disabled = false;
                        }
                    }
                } else {
                    for (var j = 0; j < checkboxs.length; j++) {
                        checkboxs[j].disabled = false;
                        submitButton.disabled = true;
                    }
                }
            }
        }

        document.getElementById("load").style.display = "none"

        function loads() {
            document.getElementById("add").style.display = "none"
            document.getElementById("load").style.display = "inline"
        }
    </script>

</body>

</html>