<?php include 's_action.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ລາຍ​ລະ​ອຽດ​ການ​ລົງ​ຄະ​​ແນນ</title>
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
    <?php include '../navbar/navbar_a.php'; ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../sidebar/sidebar_a.php'; ?>

    <main id="main" class="main">
        <div class="container">

            <div class="pagetitle py-2">
                <h1>ລາຍ​ລະ​ອຽດ​ການ​ລົງ​ຄະ​​ແນນ</h1>

            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-end">

                                    <a href="excel" type="button" class="btn btn-success my-3" target="_blank">
                                        <i class="bi bi-filetype-xlsx"></i> EXCEL </a>
                                </div>


                                <?php
                                $query = "SELECT sc.*, co.*, c.*  FROM score as sc inner join counter as co on sc.co_id = co.co_id inner join candidate as c on sc.c_id = c.c_id WHERE sc.sc_result = 0 order by s_no ASC";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $data = array();
                                while ($row = $result->fetch_assoc()) {
                                    $data[] = $row;
                                }
                                ?>
                                <!-- Default Table -->
                                <div class="scrollable-table">
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th>ລ/ດ</th>
                                                <th>ກຳ​ມ​ະ​ການ</th>
                                                <th>ເລກ​ທີໃບ​ລົງ​ຄະ​ແນນ</th>
                                                <th>​ຜູ້​ສະ​ໝັກ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($data as $row){ ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row['co_name']; ?></td>
                                                    <td><?= $row['s_no']; ?></td>
                                                    <td><?= $row['c_name']; ?></td>
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

    <script>
        $(function() {
            $("#example").DataTable({
                "oLanguage": {
                    "sProcessing": "ກຳລັງດຳເນີນການ...",
                    "sLengthMenu": "ສະແດງ _MENU_ ແຖວ",
                    "sZeroRecords": "ບໍ່ມີຂໍ້ມູນຄົ້ນຫາ",
                    "sInfo": "ສະແດງ _START_ ຖີງ _END_ ຈາກ _TOTAL_ ແຖວ",
                    "sInfoEmpty": "ສະແດງ 0 ຖີງ 0 ຈາກ 0 ແຖວ",
                    "sInfoFiltered": "(ຈາກຂໍ້ມູນທັງໝົດ _MAX_ ແຖວ)",
                    "sSearch": "ຄົ້ນຫາ :",
                    "oPaginate": {
                        "sFirst": "ເລີ່ມຕົ້ນ",
                        "sPrevious": "ກັບຄືນ",
                        "sNext": "ຕໍ່ໄປ",
                        "sLast": "ສຸດທ້າຍ"
                    }
                },
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>

</body>

</html>