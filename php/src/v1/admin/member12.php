<?php 
include 'm_action.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ຜູ້​ແທນ</title>
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

        <div class="pagetitle py-2">
            <h1>ຜູ້​ແທນ</h1>

        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="modal fade" id="addModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ເພີ່ມຜູ້​ແທນ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" action="m_action" method="post" enctype="multipart/form-data">
                                                <div class="col-md-12">
                                                    <label for="m_code" class="form-label">​ລະ​ຫັດ​ພະ​ນັກ​ງານ</label>
                                                    <input type="text" name="m_code" class="form-control" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="m_name" class="form-label">​ຊື່ ແລະ ນາມ​ສະ​ກຸນ</label>
                                                    <input type="text" name="m_name" class="form-control" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="m_part" class="form-label">ກົມ​ກອງ​ບ່ອນ​ປະ​ຈຳ​ການ</label>
                                                    <input type="text" name="m_part" class="form-control" required>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">​ປິດ</button>
                                            <button type="submit" name="add" class="btn btn-primary" onclick="loads()">ເພີ່ມ​ຂໍ້​ມູນ</button>
                                            <button class="btn btn-primary" type="button" disabled id="load">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                ກຳ​ລັງ​ບັນ​ທຶກ...
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">
                                    ເພີ່ມຜູ້​ແທນ
                                </button>
                                <a href="excel" type="button" class="btn btn-success my-3" target="_blank">
                                    <i class="bi bi-filetype-xlsx"></i> EXCEL </a>
                                </a>
                            </div>


                            <?php
                            $query = "SELECT * FROM member order by m_id desc";
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
                                    <thead class="table-light text-center align-middle">
                                        <tr>
                                            <th>ລ/ດ</th>
                                            <th>ສະ​ຖາ​ນະ</th>
                                            <th>ຊື່​ເຂົ້າ​ລະ​ບົບ</th>
                                            <th>​ລະ​ຫັດ​ພະ​ນັກ​ງານ</th>
                                            <th>​ຊື່ ແລະ ນາມ​ສະ​ກຸນ</th>
                                            <th>ກົມ​ກອງ​ບ່ອນ​ປະ​ຈຳ​ການ</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $row) { ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <?php
                                                $sql = $conn->query("SELECT m_id FROM score WHERE m_id = '" . $row['m_id'] . "'");
                                                $row_cnt = $sql->num_rows;

                                                if ($row_cnt > 0) {
                                                    echo "<td class='text-success'>ທ່ານ​ລົງ​ຄະ​ແນນ​ສຳ​ເລັ​ດ​ແລ້​ວ</td>";
                                                } else {
                                                    echo "<td class='text-danger'>ທ່ານ​ຍັງ​ບໍ່​ທັນ​ລົງ​ຄະ​ແນນ</td>";
                                                } ?>
                                                <td><?= $row['m_username']; ?></td>
                                                <td><?= $row['m_code']; ?></td>
                                                <td class="text-start"><?= $row['m_name']; ?></td>
                                                <td><?= $row['m_part']; ?></td>
                                                <td>
                                                    <a href="#edit_<?= $row['m_id']; ?>" type="button" class="btn btn-primary" data-bs-toggle="modal"><i class="bi bi-pencil-square"></i></a>
                                                    <a data-id="<?= $row['m_id']; ?>" href="m_action?delete=<?= $row['m_id']; ?>" type="button" class="btn btn-danger delete-btn"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="edit_<?= $row['m_id']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">ແກ້​ໄຂຜູ້​ແທນ</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" action="m_action" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="m_id" value="<?= $row['m_id']; ?>">
                                                                <div class="col-md-12">
                                                                    <label for="m_code" class="form-label">​ລະ​ຫັດ​ພະ​ນັກ​ງານ</label>
                                                                    <input type="text" name="m_code" value="<?= $row['m_code']; ?>" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-12 mt-2">
                                                                    <label for="m_name" class="form-label">ຊື່ ແລະ ນາມ​ສະ​ກຸນ</label>
                                                                    <input type="text" name="m_name" value="<?= $row['m_name']; ?>" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-12 mt-2">
                                                                    <label for="m_part" class="form-label">ກົມ​ກອງ​ບ່ອນ​ປະ​ຈຳ​ການ</label>
                                                                    <input type="text" name="m_part" value="<?= $row['m_part']; ?>" class="form-control" required>
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">​ປິດ</button>
                                                            <button type="submit" name="update" class="btn btn-success">ອັບ​ເດດ​ຂໍ້​ມູນ</button>
                                                        </div>
                                                        </form>
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

        $(".delete-btn").click(function(e) {
            let userId = $(this).data('id');
            e.preventDefault();
            deleteConfirm(userId);
        })

        function deleteConfirm(userId) {
            Swal.fire({
                title: 'ຕ້ອງການຈະລົບຂໍ້ມູນອອກບໍ່?',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ຕົກລົງ',
                cancelButtonText: 'ຍົກເລີກ',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'm_action',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'ລົບຂໍ້ມູນສຳເລັດແລ້ວ',

                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'member';
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }

        document.getElementById("load").style.display = "none"

        function loads() {
            document.getElementById("add").style.display = "none"
            document.getElementById("load").style.display = "inline"
        }
    </script>

</body>

</html>