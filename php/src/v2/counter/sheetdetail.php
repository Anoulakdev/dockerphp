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
    <?php include '../navbar/navbar_co.php'; ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../sidebar/sidebar_co.php'; ?>

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

                                <div class="my-3">

                                </div>


                                <?php
                                $query = "SELECT DISTINCT s_no FROM score WHERE co_id = '" . $_SESSION['co_id'] . "' order by s_no DESC";
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
                                                <th>ເລກ​ທີໃບ​ລົງ​ຄະ​ແນນ</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($data as $row) { ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row['s_no']; ?></td>

                                                    <td>
                                                        <a href="#views_<?= $row['s_no']; ?>" type="button" class="btn btn-outline-dark" data-bs-toggle="modal"><i class="bi bi-eye-fill"></i></a>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="views_<?= $row['s_no']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">ໄດ້​ເລືອກຄົນທີ່​ທ່ານບໍ່​ເອົາ</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $query2 = "SELECT c.c_name FROM score as sc inner join candidate as c on sc.c_id = c.c_id where sc.sc_result = 0 AND sc.s_no = '" . $row['s_no'] . "'";
                                                                $stmt2 = $conn->prepare($query2);
                                                                $stmt2->execute();
                                                                $result2 = $stmt2->get_result();
                                                                ?>

                                                                <?php $i1 = 1; ?>
                                                                <?php foreach ($result2 as $row2) { ?>

                                                                    <ol start="<?= $i1++; ?>">
                                                                        <li>
                                                                            <?= $row2['c_name']; ?>
                                                                        </li>
                                                                    </ol>

                                                                <?php } ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">​ປິດ</button>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

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